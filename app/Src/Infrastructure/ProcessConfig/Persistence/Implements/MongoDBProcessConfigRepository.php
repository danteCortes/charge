<?php

namespace App\Src\Infrastructure\ProcessConfig\Persistence\Implements;

use App\Src\Domain\ProcessConfig\Entities\ProcessConfig;
use App\Src\Domain\ProcessConfig\Factories\PaginateFactory;
use App\Src\Domain\ProcessConfig\Repositories\ProcessConfigRepository;
use App\Src\Domain\ProcessConfig\ValueObjects\ProcessConfigId;
use App\Src\Infrastructure\ImportFile\Persistence\Mappers\ImportFileMapper;
use App\Src\Infrastructure\ProcessConfig\Persistence\Mappers\ProcessConfigMapper;
use App\Src\Infrastructure\ProcessConfig\Persistence\Models\ProcessConfigModel;
use App\Src\Shared\Domain\Entities\Paginate;
use App\Src\Shared\Domain\ValueObjects\Page;
use App\Src\Shared\Domain\ValueObjects\PerPage;
use App\Src\Shared\Domain\ValueObjects\Search;
use MongoDB\BSON\Regex;

class MongoDBProcessConfigRepository implements ProcessConfigRepository
{
    public function save(ProcessConfig $entity): ProcessConfig
    {
        $model = ProcessConfigMapper::toModel($entity);
        $model->save();

        return ProcessConfigMapper::toEntity($model);
    }

    public function findById(ProcessConfigId $id): ?ProcessConfig
    {
        $model = ProcessConfigModel::find($id->value());

        return $model ? ProcessConfigMapper::toEntity($model) : null;
    }

    /**
     * @return App\Src\Domain\ImportFile\Entities\ImportFile[]
     */
    public function files(ProcessConfigId $id): array
    {
        $model = ProcessConfigModel::find($id->value());
        if (! $model) {
            return [];
        }

        $entities = [];
        foreach ($model->files as $file) {
            $entities[] = ImportFileMapper::toEntity($file);
        }

        return $entities;
    }

    public function search(Page $page, PerPage $perPage, ?Search $search): Paginate
    {
        $basePipeline = [
            ['$lookup' => [
                'from' => 'companies',
                'let' => ['companyId' => ['$toObjectId' => '$company_id']],
                'pipeline' => [
                    ['$match' => ['$expr' => ['$eq' => ['$_id', '$$companyId']]]],
                ],
                'as' => 'company',
            ]],
            ['$unwind' => ['path' => '$company', 'preserveNullAndEmptyArrays' => true]],

            ['$lookup' => [
                'from' => 'countries',
                'let' => ['countryId' => ['$toObjectId' => '$company.country_id']],
                'pipeline' => [
                    ['$match' => ['$expr' => ['$eq' => ['$_id', '$$countryId']]]],
                ],
                'as' => 'country',
            ]],
            ['$unwind' => ['path' => '$country', 'preserveNullAndEmptyArrays' => true]],

            ['$lookup' => [
                'from' => 'load_types',
                'let' => ['loadTypeId' => ['$toObjectId' => '$load_type_id']],
                'pipeline' => [
                    ['$match' => ['$expr' => ['$eq' => ['$_id', '$$loadTypeId']]]],
                ],
                'as' => 'load_type',
            ]],
            ['$unwind' => ['path' => '$load_type', 'preserveNullAndEmptyArrays' => true]],

            ['$lookup' => [
                'from' => 'layouts',
                'let' => ['layoutId' => ['$toObjectId' => '$layout_id']],
                'pipeline' => [
                    ['$match' => ['$expr' => ['$eq' => ['$_id', '$$layoutId']]]],
                ],
                'as' => 'layout',
            ]],
            ['$unwind' => ['path' => '$layout', 'preserveNullAndEmptyArrays' => true]],
        ];

        if ($search) {
            $basePipeline[] = ['$match' => [
                '$or' => [
                    ['company.name' => new Regex($search->value(), 'i')],
                    ['company.code' => new Regex($search->value(), 'i')],
                    ['template_name' => new Regex($search->value(), 'i')],
                ],
            ]];
        }

        // Total
        $countPipeline = array_merge($basePipeline, [['$count' => 'total']]);
        $countResult = ProcessConfigModel::raw(fn ($c) => $c->aggregate($countPipeline))->first();
        $total = $countResult['total'] ?? 0;

        // Items de la página actual
        $skip = ($page->value() - 1) * $perPage->value();

        $itemsPipeline = array_merge($basePipeline, [
            ['$skip' => $skip],
            ['$limit' => $perPage->value()],
        ]);

        $items = ProcessConfigModel::raw(fn ($c) => $c->aggregate($itemsPipeline))->map(fn ($item) => [
            'id' => (string) $item['_id'],
            'company_code' => $item['company']['code'] ?? null,
            'company_name' => $item['company']['name'] ?? null,
            'company_status' => $item['company']['status'] ?? null,
            'country' => $item['country']['name'] ?? null,
            'loadType' => $item['loadType']['name'] ?? null,
            'layout' => $item['layout']['name'] ?? null,
            'responsible' => $item['responsible'] ?? null,
            'templateName' => $item['template_name'] ?? null,
            'startDate' => $item['start_date'] ?? null,
            'records' => $item['records'] ?? null,
        ])->toArray();

        $lastPage = $total > 0 ? (int) ceil($total / $perPage->value()) : 1;
        $firstItem = $total > 0 ? $skip + 1 : null;
        $lastItem = $total > 0 ? min($skip + $perPage->value(), $total) : null;

        return PaginateFactory::fromPrimitives(
            $total,
            $perPage->value(),
            $page->value(),
            $lastPage,
            $firstItem,
            $lastItem,
            $items,
        );
    }
}

<?php

namespace App\Src\Infrastructure\ImportFile\Persistence\MongoDB;

use App\Src\Domain\ColumnAssignment\Entities\ColumnAssignment;
use App\Src\Domain\ColumnAssignment\Factories\ColumnAssignmentFactory;
use App\Src\Domain\ImportFile\Entities\ImportFile;
use App\Src\Domain\ImportFile\Repositories\ImportFileRepository;
use App\Src\Domain\ImportFile\ValueObjects\FileId;
use App\Src\Infrastructure\ImportFile\Persistence\Mappers\ImportFileMapper;
use App\Src\Infrastructure\ImportFile\Persistence\Models\ImportFileModel;

final class MongoDBImportFileRepository implements ImportFileRepository
{
    public function store(ImportFile $entity): ImportFile
    {
        $model = ImportFileMapper::toModel($entity);
        $model->save();

        return ImportFileMapper::toEntity($model);
    }

    public function findById(FileId $id): ImportFile
    {
        $model = ImportFileModel::find($id->value());

        return ImportFileMapper::toEntity($model);
    }

    public function delete(FileId $id): ImportFile
    {
        $model = ImportFileModel::find($id->value());
        $model->delete();

        return ImportFileMapper::toEntity($model);
    }

    /**
     * @return ColumnAssignment
     */
    public function getColumnAssignmentsByImportFile(FileId $id): array
    {
        $model = ImportFileModel::find($id->value());

        $columnAssignments = $model->columnAssignmentsModel->map(function ($column) {
            return ColumnAssignmentFactory::fromPrimitives(
                $column->_id,
                $column->import_file_id,
                $column->column_name,
                $column->system_field_id,
            );
        });

        return $columnAssignments->all();
    }
}

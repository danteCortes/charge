<?php

use App\Src\Domain\SystemField\Entities\SystemField;
use App\Src\Infrastructure\SystemField\Persistence\Implements\MongoDBSystemFieldRepository;
use App\Src\Infrastructure\SystemField\Persistence\Models\SystemFieldModel;
use Tests\TestCase;

uses(TestCase::class);
beforeEach(function () {
    SystemFieldModel::truncate();
});

test('list system fields returns mapped entities', function () {

    SystemFieldModel::create([
        'name' => 'RUT',
        'description' => 'rut',
        'required' => true,
    ]);

    SystemFieldModel::create([
        'name' => 'Nombre completo',
        'description' => 'fullname',
    ]);

    $repository = new MongoDBSystemFieldRepository;

    $result = $repository->list();

    expect($result)->toHaveCount(2);
    expect($result[0])->toBeInstanceOf(SystemField::class);
});

<?php

uses(TestCase::class);

use App\Src\Domain\ImportFile\Enums\FileFormat;
use App\Src\Domain\ImportFile\Factories\ImportFileFactory;
use App\Src\Infrastructure\ImportFile\Persistence\Implements\CsvPreviewGenerator;
use Tests\TestCase;

function makeFile(string $content, array $overrides = [])
{
    $path = sys_get_temp_dir().'/test_'.uniqid().'.csv';

    file_put_contents($path, $content);

    return ImportFileFactory::fromPrimitives(
        id: '1',
        fileName: 'test.csv',
        fileFormat: 'CSV',
        fileSize: strlen($content),
        storagePath: $path,
        decimalSeparator: null,
        fileEncoding: $overrides['encoding'] ?? 'UTF-8',
        fileDelimiter: $overrides['delimiter'] ?? ',',
        spreadsheet: null,
        fileStatus: 'Pendiente',
        processConfig: '1',
        firstRowHeaders: $overrides['headers'] ?? true,
    );
}

it('generates preview with headers', function () {
    $file = makeFile("nombre,edad\nJuan,30\nAna,25", []);

    $generator = new CsvPreviewGenerator;

    $result = $generator->preview($file);

    expect($result->columns())->toBe(['nombre', 'edad']);
    expect($result->rows())->toHaveCount(2);
});

it('generates columns when no headers', function () {
    $file = makeFile(
        "Juan,30\nAna,25",
        ['headers' => false]
    );

    $generator = new CsvPreviewGenerator;
    $result = $generator->preview($file);

    expect($result->columns())->toBe(['col_1', 'col_2']);
    expect($result->rows())->toHaveCount(2);
});

it('supports custom delimiter', function () {
    $file = makeFile(
        "nombre;edad\nJuan;30",
        ['delimiter' => ';']
    );

    $generator = new CsvPreviewGenerator;
    $result = $generator->preview($file);

    expect($result->columns())->toBe(['nombre', 'edad']);
});

it('limits rows to 3', function () {
    $file = makeFile("a,b\n1,2\n3,4\n5,6\n7,8");

    $generator = new CsvPreviewGenerator;
    $result = $generator->preview($file);

    expect($result->rows())->toHaveCount(3);
});

it('converts encoding to utf8', function () {
    $content = mb_convert_encoding("nombre,edad\nJosé,30", 'Latin1', 'UTF-8');

    $file = makeFile($content, ['encoding' => 'Latin1']);

    $generator = new CsvPreviewGenerator;
    $result = $generator->preview($file);

    expect($result->rows()[0][0])->toBe('José');
});

it('normalizes inconsistent rows', function () {
    $file = makeFile("a,b,c\n1,2\n3,4,5,6");

    $generator = new CsvPreviewGenerator;
    $result = $generator->preview($file);

    expect($result->rows()[0])->toHaveCount(3); // padded
    expect($result->rows()[1])->toHaveCount(3); // truncated
});

it('returns empty preview for empty file', function () {
    $file = makeFile("\n");

    $generator = new CsvPreviewGenerator;
    $result = $generator->preview($file);

    expect($result->columns())->toBe([]);
    expect($result->rows())->toBe([]);
});

it('supports only delimited formats', function () {
    $generator = new CsvPreviewGenerator;

    expect($generator->supports(FileFormat::CSV))->toBeTrue();
    expect($generator->supports(FileFormat::TXT))->toBeTrue();
    expect($generator->supports(FileFormat::JSON))->toBeFalse();
});

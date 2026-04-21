<?php

namespace App\Src\Infrastructure\ImportFile\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Src\Application\ImportFile\DTOs\ImportFileDTO;
use App\Src\Application\ImportFile\UseCases\DeleteImportFileUseCase;
use App\Src\Application\ImportFile\UseCases\GenerateFilePreviewUseCase;
use App\Src\Application\ImportFile\UseCases\StoreImportFilesUseCase;
use App\Src\Application\ImportFile\UseCases\UpdateImportFileUseCase;
use App\Src\Infrastructure\ImportFile\Http\Requests\StoreImportFileRequest;
use App\Src\Infrastructure\ImportFile\Http\Requests\UpdateImportFileRequest;
use App\Src\Infrastructure\ImportFile\Persistence\Models\ImportFileModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportFileController extends Controller
{
    public function __construct(
        private StoreImportFilesUseCase $storeImportFilesUseCase,
        private UpdateImportFileUseCase $updateImportFilesUseCase,
        private GenerateFilePreviewUseCase $generateFilePreviewUseCase,
        private DeleteImportFileUseCase $deleteImportFileUseCase,
    ) {}

    public function store(StoreImportFileRequest $request): JsonResponse
    {
        $response = [];
        foreach ($request->file('files') as $file) {
            $path = $file->store('imports');

            $dto = ImportFileDTO::create(
                $file->getClientOriginalname(),
                strtoupper($file->getClientOriginalExtension()),
                $file->getSize(),
                $path,
                null,
                null,
                null,
                null,
                $request->process_config,
                true,
                null,
                null,
                0,
                0,
                0,
            );

            $response[] = $this->storeImportFilesUseCase->execute($dto);
        }

        return response()->json([
            'message' => 'Archivos procesados',
            'data' => $response,
        ]);
    }

    public function update(UpdateImportFileRequest $request, string $id): JsonResponse
    {
        $dto = ImportFileDTO::create(
            $request->input('name'),
            $request->input('format'),
            $request->input('size'),
            $request->input('path'),
            $request->input('process_config'),
            $request->input('separator'),
            $request->input('encoding'),
            $request->input('delimiter'),
            $request->input('spreadsheet'),
            $request->input('first_row_headers'),
        );
        $response = $this->updateImportFilesUseCase->execute($dto, $id);

        return response()->json([
            'message' => 'Archivo modificado',
            'data' => $response,
        ]);
    }

    public function preview(string $id): JsonResponse
    {
        $result = $this->generateFilePreviewUseCase->execute($id);

        return response()->json($result);
    }

    public function delete(string $id): JsonResponse
    {
        $this->deleteImportFileUseCase->execute($id);

        return response()->json('El archivo fué eliminado con éxito.');
    }

    public function spreadsheets(string $id): JsonResponse
    {
        $model = ImportFileModel::find($id);

        // Obtener la ruta completa usando Storage
        $fullPath = Storage::disk('private')->path($model->path);

        // Verificar si existe
        if (! Storage::disk('private')->exists($model->path)) {
            return response()->json([
                'error' => 'El archivo no existe',
            ], 404);
        }

        $reader = IOFactory::createReaderForFile($fullPath);
        $spreadsheet = $reader->load($fullPath);
        $sheetNames = $spreadsheet->getSheetNames();

        return response()->json($sheetNames);
    }
}

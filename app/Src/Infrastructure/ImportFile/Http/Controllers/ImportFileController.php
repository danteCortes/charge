<?php

namespace App\Src\Infrastructure\ImportFile\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Src\Application\ImportFile\DTOs\ImportFileDTO;
use App\Src\Application\ImportFile\UseCases\GenerateFilePreviewUseCase;
use App\Src\Application\ImportFile\UseCases\StoreImportFilesUseCase;
use App\Src\Application\ImportFile\UseCases\UpdateImportFileUseCase;
use App\Src\Infrastructure\ImportFile\Http\Requests\StoreImportFileRequest;
use App\Src\Infrastructure\ImportFile\Http\Requests\UpdateImportFileRequest;
use Illuminate\Http\JsonResponse;

class ImportFileController extends Controller
{
    public function __construct(
        private StoreImportFilesUseCase $storeImportFilesUseCase,
        private UpdateImportFileUseCase $updateImportFilesUseCase,
        private GenerateFilePreviewUseCase $generateFilePreviewUseCase,
    ) {}

    public function store(StoreImportFileRequest $request): JsonResponse
    {
        $response = [];
        foreach ($request->file('files') as $file) {
            $path = $file->store('imports');

            $dto = ImportFileDTO::create(
                $file->getClientOriginalname(),
                $file->getClientOriginalExtension(),
                $file->getSize(),
                $path,
                $request->process_config,
                null,
                null,
                null,
                null,
                true
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
}

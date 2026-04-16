<?php

namespace App\Src\Infrastructure\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Src\Application\DTOs\ArrayFilesDTO;
use App\Src\Application\DTOs\ImportFileDTO;
use App\Src\Application\UseCases\StoreImportFilesUseCase;
use App\Src\Infrastructure\Http\Requests\StoreImportFileRequest;
use Illuminate\Http\JsonResponse;

class ImportFileController extends Controller
{
    public function __construct(
        private StoreImportFilesUseCase $storeImportFilesUseCase
    ) {}

    public function store(StoreImportFileRequest $request): JsonResponse
    {
        $filesDTO = [];
        foreach ($request->file('files') as $file) {
            $path = $file->store('imports');
            $filesDTO[] = ImportFileDTO::create(
                $file->getClientOriginalname(),
                $file->getClientOriginalExtension(),
                $file->getSize(),
                $path
            );

            $dto = ArrayFilesDTO::create($filesDTO);
        }
        $response = $this->storeImportFilesUseCase->execute($dto);

        return response()->json([
            'message' => 'Archivos procesados',
            'data' => $response,
        ]);
    }
}

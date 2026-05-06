<?php

namespace App\Src\Infrastructure\SystemField\Http\Services;

use App\Src\Infrastructure\SystemField\Persistence\Models\SystemFieldModel;
use Illuminate\Http\JsonResponse;

class SystemFieldService
{
    public function index(): JsonResponse
    {
        $fields = SystemFieldModel::all()
            ->sortBy('position')
            ->map(fn ($field) => [
                'id' => (string) $field->_id,
                'name' => $field->name ?? '',
                'column' => $field->column ?? '',
                'required' => (bool) ($field->required ?? false),
                'position' => (int) ($field->position ?? 0),
            ])
            ->values();

        return response()->json(['systemFields' => $fields]);
    }
}

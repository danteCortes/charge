<?php

namespace App\Src\Infrastructure\ImportFile\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImportFileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fileName' => ['required', 'string'],
            'fileFormat' => ['required', 'string', 'in:CSV,XLSX,TXT,XML,JSON'],
            'fileSize' => ['required', 'integer'],
            'storagePath' => ['required', 'string'],
            'decimalSeparator' => ['nullable', 'string'],
            'fileEncoding' => ['nullable', 'string'],
            'fileDelimiter' => ['nullable', 'string'],
            'spreadsheet' => ['nullable', 'string'],
            'processConfig' => ['required', 'string', 'exists:process_configurations,_id'],
            'firstRowHeaders' => ['required', 'boolean'],
            'key' => ['nullable', 'string'],
            'position' => ['nullable', 'integer'],
            'validRows' => ['nullable', 'integer'],
            'duplicatedRows' => ['nullable', 'integer'],
            'errorRows' => ['nullable', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            // Add your messages here
        ];
    }

    public function attributes(): array
    {
        return [
            // Add your attributes here
        ];
    }
}

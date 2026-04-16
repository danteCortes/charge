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
            'name' => ['required', 'string'],
            'format' => ['required', 'string', 'in:CSV,XLSX,TXT,XML,JSON'],
            'size' => ['required', 'integer'],
            'path' => ['required', 'string'],
            'separator' => ['required', 'string'],
            'encoding' => ['required', 'string'],
            'delimiter' => ['nullable', 'string'],
            'spreadsheet' => ['nullable', 'integer'],
            'first_row_headers' => ['required', 'boolean'],
            'process_config' => ['required', 'string', 'exists:process_configurations,_id'],
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

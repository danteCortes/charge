<?php

namespace App\Src\Infrastructure\ColumnAssignment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateColumnAssignmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'import_file_id' => ['required', 'string', 'exists:files,_id'],
            'column_name' => ['required', 'string'],
            'system_field_id' => ['required', 'string', 'exists:system_fields,_id'],
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

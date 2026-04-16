<?php

namespace App\Src\Infrastructure\ProcessConfig\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProcessConfigRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company' => ['nullable', 'string', 'exists:companies,_id'],
            'load_type' => ['nullable', 'string', 'exists:load_types,_id'],
            'process_type' => ['nullable', 'string', 'in:Flujo,Refresco'],
            'layout' => ['nullable', 'string', 'exists:layouts,_id'],
            'responsible' => ['nullable', 'string'],
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

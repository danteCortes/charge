<?php

namespace App\Src\Infrastructure\ProcessConfig\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProcessConfigRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company' => ['required', 'string', 'exists:companies,_id'],
            'load_type' => ['required', 'string', 'exists:load_types,_id'],
            'process_type' => ['required', 'string', 'in:Flujo,Refresco'],
            'layout' => ['required', 'string', 'exists:layouts,_id'],
            'responsible' => ['required', 'string'],
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

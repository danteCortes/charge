<?php

namespace App\Src\Infrastructure\ProcessConfig\Http\Requests;

use App\Src\Application\ProcessConfig\DTOs\ProcessConfigDTO;
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
            'layout' => ['nullable', 'string', 'exists:layouts,_id'],
            'responsible' => ['nullable', 'string'],
            'template_name' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'company' => 'empresa',
            'load_type' => 'tipo de carga',
            'layout' => 'interfaz',
            'responsible' => 'responsable',
            'template_name' => 'nombre del template',
        ];
    }

    public function toDTO(): ProcessConfigDTO
    {
        return ProcessConfigDTO::create(
            $this->validated('company'),
            $this->validated('load_type'),
            $this->validated('layout'),
            $this->validated('responsible'),
            $this->validated('template_name'),
        );
    }
}

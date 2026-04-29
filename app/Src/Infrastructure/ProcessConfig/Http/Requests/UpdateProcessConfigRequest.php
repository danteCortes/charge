<?php

namespace App\Src\Infrastructure\ProcessConfig\Http\Requests;

use App\Src\Application\ProcessConfig\DTOs\ProcessConfigDTO;
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
            'template_name' => ['required', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'company' => 'empresa',
            'load_type' => 'tipo de carga',
            'process_type' => 'tipo de proceso',
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
            $this->validated('process_type'),
            $this->validated('layout'),
            $this->validated('responsible'),
            $this->validated('template_name'),
        );
    }
}

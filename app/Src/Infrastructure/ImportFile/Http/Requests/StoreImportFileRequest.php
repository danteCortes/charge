<?php

namespace App\Src\Infrastructure\ImportFile\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreImportFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'files' => ['array', 'required', 'min:1'],
            'files.*' => ['file', 'required', 'mimes:csv,txt,xlsx', 'max:10240'],
            'process_config' => ['required', 'string', 'exists:processes,_id'],
        ];
    }
}

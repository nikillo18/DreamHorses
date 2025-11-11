<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRaceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'horse_id' => 'required|exists:horses,id',
            'date' => 'required|date|before_or_equal:today',
            'place' => 'nullable|integer|min:1',
            'distance' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'jockey' => 'required|string|max:50',
            'hipodromo' => 'required|string|max:100',
            'video' => 'nullable|url',
        ];
    }
    public function messages(): array
    {
    return [
        'date.before_or_equal' => 'La fecha de la carrera debe ser anterior o igual a hoy.',
    ];
    }

}

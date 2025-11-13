<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; 
class UpdateHorseRequest extends FormRequest
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
        'name' => 'required|string|max:100',
        'breed' => 'required|string|max:100',
        'color' => 'required|string|max:50',
        'birth_date' => 'required|date|before_or_equal:today',
        'gender' => 'required|in:male,female',
        'father_name' => 'nullable|string|max:100',
        'mother_name' => 'nullable|string|max:100',
        'boss_id' => 'nullable|exists:users,id',
        'caretaker_id' => 'nullable|exists:users,id',
        'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
        'number_microchip' => [
            'nullable',
            'string',
            'max:15',
            Rule::unique('horses', 'number_microchip')->ignore($this->horse),
            ]
    ];
    }
    public function messages(): array
{
    return [
        'birth_date.before_or_equal' => 'La fecha de nacimiento  debe ser anterior o igual a hoy.',
        'photos.*.image' => 'Cada archivo debe ser una imagen.',
        'photos.*.mimes' => 'Las imágenes deben ser de tipo jpeg, png, jpg o gif.',
        'photos.*.max' => 'Cada imagen no debe superar los 1MB.',
        'number_microchip.unique' => 'El número de microchip ya está registrado para otro caballo.',

    ];
}
}

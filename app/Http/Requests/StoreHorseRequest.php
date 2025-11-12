<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHorseRequest extends FormRequest
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
        'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
        'number_microchip' => 'nullable|string|max:15',
        'boss_id' => 'nullable|exists:users,id',
        'caretaker_id' => 'nullable|exists:users,id',
    ];
    }
    public function messages(): array
    {
    return [
        'birth_date.before_or_equal' => 'La fecha de nacimiento  debe ser anterior o igual a hoy.',
        'photos.*.max' => 'Cada imagen no puede superar 1 MB.',
        'photos.*.mimes' => 'Solo se permiten imágenes con formato JPEG, PNG, JPG o GIF.',
        'photos.*.image' => 'El archivo seleccionado debe ser una imagen válida.',
    ];
    }
}

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
        'birth_date' => 'required|date',
        'gender' => 'required|in:male,female',
        'father_name' => 'nullable|string|max:100',
        'mother_name' => 'nullable|string|max:100',
        'caretaker_id' => 'required|exists:caretakers,id',
        'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'number_microchip' => 'nullable|string|max:15',
    ];
    }
}

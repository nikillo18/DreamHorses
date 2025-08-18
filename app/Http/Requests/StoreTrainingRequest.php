<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrainingRequest extends FormRequest
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
            'date' => 'required|date',
            'distance' => 'required|integer|min:0',
            'duration_minutes' => 'required|integer|min:0',
            'type_training' => 'required|string|max:100',
            'comments' => 'nullable|string|max:100',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVetVisitRequest extends FormRequest
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
            'horse_id'     => 'required|exists:horses,id',
            'visit_date'   => 'required|date',
            'vet_name'     => 'required|string|max:100',
            'vet_phone'    => 'nullable|string|max:20',
            'diagnosis'    => 'required|string|max:120',
            'treatment'    => 'required|string|max:120',
            'next_visit'   => 'nullable|date|after_or_equal:visit_date',

        ];
    }
}

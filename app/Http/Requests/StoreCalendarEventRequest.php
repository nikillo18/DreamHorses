<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCalendarEventRequest extends FormRequest
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
            'title' => 'required|string|max:100',
            'horse_id' => 'required|exists:horses,id',
            'event_date' => 'required|date',
            'event_time' => 'required|date_format:H:i',
            'category' => 'required|string|max:50',
            'description' => 'nullable|text|max:150',
        ];
    }
}

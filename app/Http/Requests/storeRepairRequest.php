<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeRepairRequest extends FormRequest
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
            'fullname' => 'required|unique:repairs,fullname|max:50',
            'dni' => 'required|unique:repairs,dni|max:100',
            'phone' => 'required|unique:repairs,phone|max:100',
            'location' => 'required|max:150',
            'vehicle' => 'required|max:150',
            'image_path' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'type_repair' => 'required|max:150',
            'price' => 'required|max:100',
            'details' => 'nullable|max:255',
        ];
    }
}

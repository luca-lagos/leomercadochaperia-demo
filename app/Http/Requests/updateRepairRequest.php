<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateRepairRequest extends FormRequest
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
        $repair = $this->route('repair');
        return [
            'fullname' => 'required|unique:repairs,fullname,' . $repair->id . '|max:50',
            'dni' => 'required|,unique:repairs,dni,' . $repair->id . '|max:100',
            'phone' => 'required|unique:repairs,phone,' . $repair->id . '|max:100',
            'location' => 'required|unique:repairs,location,' . $repair->id . '|max:150',
            'vehicle' => 'required|unique:repairs,vehicle,' . $repair->id . '|max:150',
            'image_path' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'type_repair' => 'required|unique:repairs,type_repair,' . $repair->id . '|max:150',
            'price' => 'required|unique:repairs,price,' . $repair->id . '|max:100',
            'details' => 'nullable|max:255',
        ];
    }
}

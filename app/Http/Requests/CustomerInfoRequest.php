<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'address_1' => 'required|string|max:255',
            'address_2' => 'nullable|string|max:255',
            'postcode' => 'required|numeric|max:50',
            'city' => 'required|string|max:50',
            'identity' => 'required|numeric|max:50',
            'telp' => 'required|numeric|max:100'
        ];
    }
}

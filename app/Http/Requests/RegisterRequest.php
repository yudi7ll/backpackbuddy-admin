<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:customers',
            'email' => 'required|email|max:100|unique:customers',
            'password' => 'required|confirmed|max:255',
            'address_1' => 'required|string|max:255',
            'address_2' => 'nullable|string',
            'postcode' => 'required|numeric|digits_between:1,20',
            'city' => 'required|string|max:255',
            'identity' => 'required|string|max:255',
            'telp' => 'required|numeric|digits_between:5,20',
        ];
    }
}

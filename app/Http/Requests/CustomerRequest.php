<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'username' => 'required|string|max:100|unique:customers,username,' . $this->id,
            'email' => 'required|string|max:100|unique:customers,email,' . $this->id,
            'password' => 'required_with:password_confirmation|string|min:8|confirmed'
        ];
    }
}

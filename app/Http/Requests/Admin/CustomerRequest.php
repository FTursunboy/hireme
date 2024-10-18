<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $rules = [
            'name' => 'required',
            'status' => 'required',
            'phone' => 'required|unique:users,phone_number',
        ];

        return $rules;
    }



}

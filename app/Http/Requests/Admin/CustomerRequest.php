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
        ];

        if ($this->isMethod('patch')) {
            $rules['phone'] = [
                'required',
                Rule::unique('users', 'phone_number')->ignore($this->customer->id),
            ];
        } else {
            // Для других методов, например POST (создание), уникальность обязательно проверяется
            $rules['phone'] = 'required|unique:users,phone_number';
        }

        return $rules;
    }



}

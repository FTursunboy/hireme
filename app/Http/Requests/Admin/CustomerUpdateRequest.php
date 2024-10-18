<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerUpdateRequest extends FormRequest
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
            'phone' => [
                'required',
                Rule::unique('users', 'phone_number')->ignore($this->customer->id)
            ],
        ];

        return $rules;
    }



}

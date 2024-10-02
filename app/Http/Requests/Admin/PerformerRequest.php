<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PerformerRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'phone' => 'required|unique:profiles,phone',
            'min_service_cost' => 'required',
            'service_description' => 'required'
        ];
    }


}

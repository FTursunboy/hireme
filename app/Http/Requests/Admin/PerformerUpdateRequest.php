<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PerformerUpdateRequest extends FormRequest
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
            'phone' => [
                'required',
                Rule::unique('profiles', 'phone')->ignore($this->performer->id)
            ],
            'min_service_cost' => 'required',
            'service_description' => 'required'
        ];
    }


}

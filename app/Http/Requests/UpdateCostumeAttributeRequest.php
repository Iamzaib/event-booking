<?php

namespace App\Http\Requests;

use App\Models\CostumeAttribute;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCostumeAttributeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('costume_attribute_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
        ];
    }
}

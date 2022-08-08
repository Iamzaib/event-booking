<?php

namespace App\Http\Requests;

use App\Models\Costume;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCostumeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('costume_edit');
    }

    public function rules()
    {
        return [
            'costume_title' => [
                'string',
                'required',
            ],
            'costume_details' => [
                'string',
                'nullable',
            ],
            'costume_price' => [
                'required',
            ],
            'options.*' => [
                'integer',
            ],
            'options' => [
                'array',
            ],
        ];
    }
}

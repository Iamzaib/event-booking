<?php

namespace App\Http\Requests;

use App\Models\Setting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSettingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('setting_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'setting_key' => [
                'string',
                'required',
                'unique:settings,setting_key,' . request()->route('setting')->id,
            ],
            'setting_value' => [
                'string',
                'required',
            ],
            'details' => [
                'string',
                'nullable',
            ],
        ];
    }
}

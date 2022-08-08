<?php

namespace App\Http\Requests;

use App\Models\EventAddon;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEventAddonRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_addon_edit');
    }

    public function rules()
    {
        return [
            'addon_title' => [
                'string',
                'required',
            ],
            'addon_details' => [
                'string',
                'nullable',
            ],
            'addon_price' => [
                'required',
            ],
        ];
    }
}

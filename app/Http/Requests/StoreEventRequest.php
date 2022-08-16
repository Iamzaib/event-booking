<?php

namespace App\Http\Requests;

use App\Models\Event;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEventRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_create');
    }

    public function rules()
    {
        return [
            'event_title' => [
                'string',
                'required',
            ],
            'duration' => [
                'string',
                'nullable',
            ],
            'daily_price' => [
                'required',
            ],
            'country_id' => [
                'required',
                'integer',
            ],
            'state_id' => [
                'required',
                'integer',
            ],
            'city_id' => [
                'required',
                'integer',
            ],
            'event_start' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'event_end' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'hotels.*' => [
                'integer',
            ],
            'hotels' => [
                'array',
            ],
        ];
    }
}

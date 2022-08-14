<?php

namespace App\Http\Requests;

use App\Models\Hotel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreHotelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('hotel_create');
    }

    public function rules()
    {
        return [
            'hotel_name' => [
                'string',
                'required',
            ],
            'amenities.*' => [
                'integer',
            ],
            'amenities' => [
                'array',
            ],
        ];
    }
}

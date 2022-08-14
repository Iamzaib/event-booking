<?php

namespace App\Http\Requests;

use App\Models\EventBooking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEventBookingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_booking_create');
    }

    public function rules()
    {
        return [
            'booking_details' => [
                'string',
                'nullable',
            ],
            'booking_event_id' => [
                'required',
                'integer',
            ],
            'booking_by_user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\BookingRoom;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBookingRoomRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('booking_room_edit');
    }

    public function rules()
    {
        return [
            'room_id' => [
                'required',
                'integer',
            ],
            'booking_for_id' => [
                'required',
                'integer',
            ],
            'room_booking_rate' => [
                'required',
            ],
            'booking_from' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'booking_to' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}

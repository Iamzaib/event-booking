<?php

namespace App\Http\Requests;

use App\Models\HotelRoom;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateHotelRoomRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('hotel_room_edit');
    }

    public function rules()
    {
        return [
            'hotel_id' => [
                'required',
                'integer',
            ],
            'room_title' => [
                'string',
                'required',
            ],
            'room_price' => [
                'required',
            ],
            'room_capacity' => [
                'string',
                'required',
            ],
        ];
    }
}

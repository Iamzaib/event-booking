<?php

namespace App\Http\Requests;

use App\Models\HotelRoom;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreHotelRoomRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('hotel_room_create');
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
        ];
    }
}

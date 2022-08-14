<?php

namespace App\Http\Requests;

use App\Models\HotelRoom;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyHotelRoomRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('hotel_room_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:hotel_rooms,id',
        ];
    }
}

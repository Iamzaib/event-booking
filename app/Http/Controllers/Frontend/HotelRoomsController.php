<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyHotelRoomRequest;
use App\Http\Requests\StoreHotelRoomRequest;
use App\Http\Requests\UpdateHotelRoomRequest;
use App\Models\Hotel;
use App\Models\HotelRoom;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HotelRoomsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('hotel_room_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hotelRooms = HotelRoom::with(['hotel'])->get();

        return view('frontend.hotelRooms.index', compact('hotelRooms'));
    }

    public function create()
    {
        abort_if(Gate::denies('hotel_room_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hotels = Hotel::pluck('hotel_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.hotelRooms.create', compact('hotels'));
    }

    public function store(StoreHotelRoomRequest $request)
    {
        $hotelRoom = HotelRoom::create($request->all());

        return redirect()->route('frontend.hotel-rooms.index');
    }

    public function edit(HotelRoom $hotelRoom)
    {
        abort_if(Gate::denies('hotel_room_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hotels = Hotel::pluck('hotel_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hotelRoom->load('hotel');

        return view('frontend.hotelRooms.edit', compact('hotelRoom', 'hotels'));
    }

    public function update(UpdateHotelRoomRequest $request, HotelRoom $hotelRoom)
    {
        $hotelRoom->update($request->all());

        return redirect()->route('frontend.hotel-rooms.index');
    }

    public function show(HotelRoom $hotelRoom)
    {
        abort_if(Gate::denies('hotel_room_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hotelRoom->load('hotel');

        return view('frontend.hotelRooms.show', compact('hotelRoom'));
    }

    public function destroy(HotelRoom $hotelRoom)
    {
        abort_if(Gate::denies('hotel_room_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hotelRoom->delete();

        return back();
    }

    public function massDestroy(MassDestroyHotelRoomRequest $request)
    {
        HotelRoom::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

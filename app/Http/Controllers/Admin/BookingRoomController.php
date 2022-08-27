<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBookingRoomRequest;
use App\Http\Requests\StoreBookingRoomRequest;
use App\Http\Requests\UpdateBookingRoomRequest;
use App\Models\BookingRoom;
use App\Models\EventBooking;
use App\Models\HotelRoom;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookingRoomController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('booking_room_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookingRooms = BookingRoom::with(['room', 'booking_for'])->get();

        return view('admin.bookingRooms.index', compact('bookingRooms'));
    }

    public function create()
    {
        abort_if(Gate::denies('booking_room_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rooms = HotelRoom::pluck('room_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $booking_fors = EventBooking::pluck('booking_details', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bookingRooms.create', compact('booking_fors', 'rooms'));
    }

    public function store(StoreBookingRoomRequest $request)
    {
        $bookingRoom = BookingRoom::create($request->all());

        return redirect()->route('admin.booking-rooms.index');
    }

    public function edit(BookingRoom $bookingRoom)
    {
        abort_if(Gate::denies('booking_room_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rooms = HotelRoom::pluck('room_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $booking_fors = EventBooking::pluck('booking_details', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bookingRoom->load('room', 'booking_for');

        return view('admin.bookingRooms.edit', compact('bookingRoom', 'booking_fors', 'rooms'));
    }

    public function update(UpdateBookingRoomRequest $request, BookingRoom $bookingRoom)
    {
        $bookingRoom->update($request->all());

        return redirect()->route('admin.booking-rooms.index');
    }

    public function show(BookingRoom $bookingRoom)
    {
        abort_if(Gate::denies('booking_room_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookingRoom->load('room', 'booking_for');

        return view('admin.bookingRooms.show', compact('bookingRoom'));
    }

    public function destroy(BookingRoom $bookingRoom)
    {
        abort_if(Gate::denies('booking_room_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookingRoom->delete();

        return back();
    }

    public function massDestroy(MassDestroyBookingRoomRequest $request)
    {
        BookingRoom::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

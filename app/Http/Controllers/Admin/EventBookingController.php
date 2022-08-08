<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEventBookingRequest;
use App\Http\Requests\StoreEventBookingRequest;
use App\Http\Requests\UpdateEventBookingRequest;
use App\Models\Event;
use App\Models\EventBooking;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventBookingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('event_booking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventBookings = EventBooking::with(['booking_event', 'booking_by_user'])->get();

        return view('admin.eventBookings.index', compact('eventBookings'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_booking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $booking_events = Event::pluck('event_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $booking_by_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.eventBookings.create', compact('booking_by_users', 'booking_events'));
    }

    public function store(StoreEventBookingRequest $request)
    {
        $eventBooking = EventBooking::create($request->all());

        return redirect()->route('admin.event-bookings.index');
    }

    public function edit(EventBooking $eventBooking)
    {
        abort_if(Gate::denies('event_booking_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $booking_events = Event::pluck('event_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $booking_by_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eventBooking->load('booking_event', 'booking_by_user');

        return view('admin.eventBookings.edit', compact('booking_by_users', 'booking_events', 'eventBooking'));
    }

    public function update(UpdateEventBookingRequest $request, EventBooking $eventBooking)
    {
        $eventBooking->update($request->all());

        return redirect()->route('admin.event-bookings.index');
    }

    public function show(EventBooking $eventBooking)
    {
        abort_if(Gate::denies('event_booking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventBooking->load('booking_event', 'booking_by_user');

        return view('admin.eventBookings.show', compact('eventBooking'));
    }

    public function destroy(EventBooking $eventBooking)
    {
        abort_if(Gate::denies('event_booking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventBooking->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventBookingRequest $request)
    {
        EventBooking::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

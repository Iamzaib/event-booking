<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTravelerRequest;
use App\Http\Requests\StoreTravelerRequest;
use App\Http\Requests\UpdateTravelerRequest;
use App\Models\Costume;
use App\Models\EventBooking;
use App\Models\EventTicket;
use App\Models\Traveler;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TravelerController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('traveler_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $travelers = Traveler::with(['booking', 'costume', 'tickets'])->get();

        return view('admin.travelers.index', compact('travelers'));
    }

    public function create()
    {
        abort_if(Gate::denies('traveler_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookings = EventBooking::pluck('booking_details', 'id')->prepend(trans('global.pleaseSelect'), '');

        $costumes = Costume::pluck('costume_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tickets = EventTicket::pluck('ticket_title', 'id');

        return view('admin.travelers.create', compact('bookings', 'costumes', 'tickets'));
    }

    public function store(StoreTravelerRequest $request)
    {
        $traveler = Traveler::create($request->all());
        $traveler->tickets()->sync($request->input('tickets', []));

        return redirect()->route('admin.travelers.index');
    }

    public function edit(Traveler $traveler)
    {
        abort_if(Gate::denies('traveler_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookings = EventBooking::pluck('booking_details', 'id')->prepend(trans('global.pleaseSelect'), '');

        $costumes = Costume::pluck('costume_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tickets = EventTicket::pluck('ticket_title', 'id');

        $traveler->load('booking', 'costume', 'tickets');

        return view('admin.travelers.edit', compact('bookings', 'costumes', 'tickets', 'traveler'));
    }

    public function update(UpdateTravelerRequest $request, Traveler $traveler)
    {
        $traveler->update($request->all());
        $traveler->tickets()->sync($request->input('tickets', []));

        return redirect()->route('admin.travelers.index');
    }

    public function show(Traveler $traveler)
    {
        abort_if(Gate::denies('traveler_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $traveler->load('booking', 'costume', 'tickets');

        return view('admin.travelers.show', compact('traveler'));
    }

    public function destroy(Traveler $traveler)
    {
        abort_if(Gate::denies('traveler_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $traveler->delete();

        return back();
    }

    public function massDestroy(MassDestroyTravelerRequest $request)
    {
        Traveler::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

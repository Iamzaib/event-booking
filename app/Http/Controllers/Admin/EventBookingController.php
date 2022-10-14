<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEventBookingRequest;
use App\Http\Requests\StoreEventBookingRequest;
use App\Http\Requests\UpdateEventBookingRequest;
use App\Models\Event;
use App\Models\EventBooking;
use App\Models\Hotel;
use App\Models\User;
use Carbon\CarbonPeriod;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;

class EventBookingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('event_booking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventBookings = EventBooking::with(['booking_event', 'booking_by_user'])->get();

        return view('admin.eventBookings.index', compact('eventBookings'));
    }
    public function create(Request $request){

    }
    public function create_booking(Request $request,Event $trip)
    {
        abort_if(Gate::denies('event_booking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $travelers=$request->travelers??1;
        $data['booking_events'] = Event::pluck('event_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $data['booking_by_users'] = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $data['travelers']=1;
        if($request->travelers>0){
            $data['travelers']=$request->travelers;
        }
//        $data['page_name']=$trip_title;
//        $data['page_type']='trip';
        $trip->load('country', 'state', 'city');
        $data['trip']=$trip;

        $period = CarbonPeriod::create(date('Y-m-d H:i:s',strtotime($trip->event_start)), date('Y-m-d H:i:s',strtotime($trip->event_end)));
        // Iterate over the period
        $dates=$period->toArray();
//        foreach ($period as $date) {
//
//        }
        foreach ($dates as $i=> $date){
            $dates[$i]=date('d-M-Y',strtotime($date));
        }

//        echo json_encode($pieces);exit;
        if($trip->duration>2){
            list($date_range_1, $date_range_2) = array_chunk($dates, ceil(count($dates) / 2));
            $data['range'][0]['date']=Arr::first($date_range_1).' > '.Arr::last($date_range_1);
            $data['range'][0]['duration']=count($date_range_1);
            $data['range'][0]['price']=($trip->daily_price*count($date_range_1))*$data['travelers'];
        }
        $data['low_total']=$data['range'][0]['price'];
        $data['low_deposit']=($data['range'][0]['price']*((float)DEPOSIT_AMOUNT_PERCENT/100));
        $installment=$data['range'][0]['price']-$data['low_deposit'];
        $data['low_installment']=($installment/(int)TOTAL_INSTALLMENTS);


        $data['total_event_tickets']=count($trip->tickets);
        $data['range'][1]['date']=date('d-M-Y',strtotime($trip->event_start)).' > '.date('d-M-Y',strtotime($trip->event_end));
        $data['range'][1]['duration']=count($dates);
        $data['range'][1]['price']=($trip->daily_price*$trip->duration)*$data['travelers'];
        $data['no_accommodation']=Hotel::find(2);
        return view('admin.eventBookings.create', $data);
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

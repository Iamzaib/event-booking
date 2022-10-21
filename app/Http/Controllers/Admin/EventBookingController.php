<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEventBookingRequest;
use App\Http\Requests\StoreEventBookingRequest;
use App\Http\Requests\UpdateEventBookingRequest;
use App\Models\BookingRoom;
use App\Models\Costume;
use App\Models\CostumeAttribute;
use App\Models\CostumeBookingAttribute;
use App\Models\Event;
use App\Models\EventAddon;
use App\Models\EventBooking;
use App\Models\EventTicket;
use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Models\InstallmentPayments;
use App\Models\Invoices;
use App\Models\Payment;
use App\Models\Traveler;
use App\Models\TripDateRange;
use App\Models\User;
use Carbon\CarbonPeriod;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class EventBookingController extends Controller
{
    private $request;
    public function __construct(Request $request)
    {
        $this->request=$request;
    }

    public function index()
    {
        abort_if(Gate::denies('event_booking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventBookings = EventBooking::with(['booking_event', 'booking_by_user'])->get();

        return view('admin.eventBookings.index', compact('eventBookings'));
    }
    public function create(Request $request){
        return redirect()->route('admin.events.index')->with('message','choose event to book');
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
        $range_low_price=$trip->date_ranges()->orderBy('range_price', 'asc')->first()->range_price;
        $data['low_total']=$range_low_price;
        $data['low_deposit']=($range_low_price*((float)DEPOSIT_AMOUNT_PERCENT/100));
        $installment=$range_low_price-$data['low_deposit'];
        $data['low_installment']=($installment/(int)TOTAL_INSTALLMENTS);


        $data['total_event_tickets']=count($trip->tickets);
        $data['range'][1]['date']=date('d-M-Y',strtotime($trip->event_start)).' > '.date('d-M-Y',strtotime($trip->event_end));
        $data['range'][1]['duration']=count($dates);
        $data['range'][1]['price']=($trip->daily_price*$trip->duration)*$data['travelers'];
        $data['no_accommodation']=Hotel::find(2);
        return view('admin.eventBookings.create', $data);
    }
    public function custom_order_process(){

        $rqv=$this->request;

        $rq=(object)$this->request->validate([
            "trip_id" => "required",
            "booking_by_user_id" => "required",
            "travelers" => "required",
            "range" => "required",
            'payment_type'=>'required',
            'room_persons' => 'required|array',
            'room_persons.*' => 'sometimes|integer',
            'costume'=>'array',
            'costume_option'=>'array',
            'ticket'=>'array',
            'addon'=>'array',
            'first_name'=>'required|array',
            'first_name.*'=>'required|string',
            'last_name'=>'required|array',
            'last_name.*'=>'required|string',
            'phone'=>'required|array',
            'phone.*'=>'required|string',
            'email'=>'required|array',
            'email.*'=>'required|email',
            'gender'=>'required|array',
            'gender.*'=>'required|string',
            'shirt_size'=>'required|array',
            'shirt_size.*'=>'required|string',
            'notes'=>'array',
        ]);
//dd($rq->input(),$rqv);
//        dd($this->request->input());
//        $rq=$rqv;
        $data['user']=$user=User::find($rq->booking_by_user_id);
        $data['trip']=$trip=Event::find($rq->trip_id);
        if(!isset($trip->id)){
            redirect()->back()->with($rq->input());
        }

        $rooms=[];
        $room_one_id=$room_total=0;
        foreach ($rq->room_persons as $room_id => $room_person){
            if($room_person>0){
                $rooms_traveler[$room_id]=$room_person;
                if($room_id>0){
                    $rooms[$room_id]=HotelRoom::find($room_id);
                    $room_one_id=$room_id;
                    $room_total+=(float)$rooms[$room_id]->room_price*$room_person;
                }
            }
        }
        $room='';
        if(count($rooms)==1){
            $room=$rooms[$room_one_id];
        }
        $total_traveler=$rq->travelers;
//        $subtotal=($trip->daily_price*$trip->duration)*$total_traveler;
//        $range_=explode('%',$rq->range);
//        $range=explode(' > ',Arr::first($range_));
//        for ($r=0, $rMax = count($range); $r< $rMax; $r++){
//            $range[$r]=date(config('panel.date_format'),strtotime($range[$r]));
//        }
////        var_dump($range);exit;
//        $duration=Arr::last($range_);
//        if($trip->duration>2) {
//            $subtotal=($trip->daily_price * $duration) * $total_traveler;
//        }
        $range=TripDateRange::find($rq->range);
        $total_traveler=$rq->travelers;
        $subtotal=$range->range_price*$total_traveler;



        $starting_total= $subtotal += $room_total;//!$this->session_order('starting_total')?$total:$this->session_order('starting_total');
        $data['savings']=0;
        $data['coupon_amount']=0.00;
        $data['coupon_code']='';
//        $data['processing_fee']=(float)PROCESSING_FEE;
//        $data['trip']=$trip;
        $data['room']=$room;
        $data['rooms']=$rooms;
        $data['booking']='';
        $data['user_details']=[];
        $data['user']=$user;


        $booking_details=$trip->event_title.' Booking By '.$user->name;
        $booking=EventBooking::create([
            'booking_details'=>$booking_details,
            'booking_event_id'=>$trip->id,
            'booking_by_user_id'=>$user->id,
            'order_payment_type'=>$rq->payment_type,
            'range_id'=>$rq->range,
            'booking_from'=>$range->range_start,
            'booking_to'=>$range->range_end,
            "billing_name"=> $user->name,
            "billing_lastname"=> $user->lastname,
            "billing_address"=>$user->address,
            "billing_address_2"=> $user->address_2,
            "billing_country_id"=> (int)$user->country_id,
            "billing_state_id" =>(int)$user->state_id,
            "billing_city_id" =>(int)$user->city_id,
        ]);
        if($room!=''){
            $booking->update([
                'room_id'=>$room->id,
                'room_price'=>$room->room_price,
            ]);
        }
        if(count($rooms)>0){
            foreach ($rooms as $room){
                BookingRoom::create([
                    'room_id'=>$room->id,
                    'booking_for_id'=>$booking->id,
                    'room_booking_rate'=>$room->room_price,
                    'booking_from'=>$range->range_start,
                    'booking_to'=>$range->range_end,
                ]);
            }
        }
        if(isset($rq->addon)&&count($rq->addon)>0){
            foreach ($rq->addon as $addon_id){
                $addon=EventAddon::find($addon_id);
                if(isset($addon->id)){
                    $data['addons'][$addon->id]=$addon;
                    $booking->booking_event_addons()->sync([$addon->id=>['addon_price'=>$addon->addon_price]]);
                    $subtotal+=(float)$addon->addon_price;
                }
            }
        }
        $data['costumes_options']=[];
        for($t=1;$t<=$total_traveler;$t++){
            $Traveler=Traveler::create([
                'booking_id'=>$booking->id,
                'first_name'=>$rq->first_name[$t],
                'last_name'=>$rq->last_name[$t],
                'email'=>$rq->email[$t],
                'phone'=>$rq->phone[$t],
                'gender'=>$rq->gender[$t],
                'shirt_size'=>$rq->shirt_size[$t],
                'notes'=>$rq->notes[$t],
            ]);
            $tID=$Traveler->id;
            if(isset($rq->costume)&&count($rq->costume)>0&&$rq->costume[$t]!=0){
//                if(){
                $costume=Costume::find($rq->costume[$t]);
                if(isset($costume->id)){
                    $data['costumes'][$costume->id]=$costume;
                    $booking->booking_event_costumes()->sync([$costume->id=>['costume_price'=>$costume->costume_price]]);
                    $Traveler->update(['costume_id'=>$costume->id]);
                    $subtotal+=(float)$costume->costume_price;
                    $user_details['roommate'][$t]['costume_id']=$costume->id;
                    foreach ($rq->costume_option[$t][$costume->id] as $option_id => $option_value){
                        $costume_attr=CostumeAttribute::find($option_id);
                        if(isset($costume_attr->id)&&$rq->costume_option[$t][$costume->id][$option_id]!=''){
//                            $data['costumes_options'][$t][$costume->id][$option_id]=$costume_attr;
//                            $data['costumes_options'][$t][$costume->id][$option_id]->value=$option_value;
                            CostumeBookingAttribute::create([
                                'booking_id'=>$booking->id,
                                'traveler_id'=>$tID,
                                'costume_id'=>$costume->id,
                                'costume_attribute_id'=>$option_id,
                                'values'=>$option_value,
                            ]);
                        }

                    }

                }
//                }
            }

            if(isset($rq->ticket)&&count($rq->ticket)>0&&count($rq->ticket[$t])>0){
                foreach ($rq->ticket[$t] as $ticket_id => $ticket){
                    $ticket_get=EventTicket::find($ticket_id);
                    if(isset($ticket_get->id)){
                        $Traveler->tickets()->sync($ticket_get->id);
                        $subtotal+=(float)$ticket_get->ticket_price;
                    }
                }
            }
        }

        $total=$subtotal+processing_fee($subtotal);
        $booking->update([
            'booking_total'=>$total,
        ]);
        $deposit=($total*((float)DEPOSIT_AMOUNT_PERCENT/100));
        $installment=(float)$total-(float)$deposit;
        $installment_1=($installment/(int)TOTAL_INSTALLMENTS);
//        $paymentMethod = $rq->payment_method;
//        $user=$user;
        $amount_to_paid=$total;
        if($rq->payment_type=='Installment'){
            $amount_to_paid=$deposit;
        }
       /* try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $payment= $user->charge(((float)$amount_to_paid*100), $paymentMethod);

        } catch (\Exception $exception) {
            //   return back()->with('error', );
//            echo $exception->getMessage();
            Session::flash('error',$exception->getMessage());
            return redirect()->back()->with('error',$exception->getMessage());
            exit;
        }*/
        $booking_payment=EventBooking::where('id',$booking->id)->update([
            'stripe_id'=>json_encode(['payment'=>'other/by admin']),
            'stripe_status'=>'successful'
        ]);
//        dd($rq->payment_type);
        $paymentUpdate=Payment::create([
            'payment_event_id'=>$trip->id,
            'payment_user_id'=>$user->id,
            'payment_booking_id'=>$booking->id,
            'amount_total'=>$total,
            'starting_total'=>$starting_total,
            'amount_paid'=>$amount_to_paid,
            'payment_method'=>'Other',
            'payment_details'=>json_encode(['payment'=>'other/by admin']),
            'savings'=>0,
            'coupon_amount'=>0,
            'coupon_code'=>'',
            'processing_fee'=>processing_fee($subtotal),
            'subtotal'=>$subtotal,
            'deposit'=>($rq->payment_type=='Installment'?$deposit:0),
            'installment'=>($rq->payment_type=='Installment'?$installment_1:0),
            'total_installments'=>($rq->payment_type=='Installment'?(int)TOTAL_INSTALLMENTS:0),
            'amount_balance'=>($rq->payment_type=='Installment'?($installment):0),
        ]);
        Invoices::create([
            'payment_id'=>$paymentUpdate->id,
            'amount_total'=>$total,
            'amount_paid'=>$amount_to_paid,
            'payment_done'=>$amount_to_paid,
            'payment_method'=>'Other',
            'payment_details'=>json_encode(['payment'=>'other/by admin']),
            'deposit'=>($rq->payment_type=='Installment'?$deposit:0),
            'installment'=>($rq->payment_type=='Installment'?$installment_1:0),
            'total_installments'=>($rq->payment_type=='Installment'?(int)TOTAL_INSTALLMENTS:0),
            'amount_balance'=>($rq->payment_type=='Installment'?($installment):0),
        ]);
        $booking->update([
            'status'=>'active'
        ]);
        if($rq->payment_type=='Installment'){
            for ($p=1;$p<=TOTAL_INSTALLMENTS;$p++){
                InstallmentPayments::create([
                    'payment_id'=>$paymentUpdate->id,
                    'amount_total'=>$total,
                    'amount_paid'=>$amount_to_paid,
                    'amount_balance'=>$installment,
                    'installment'=>$installment_1,
                    'total_installments'=>TOTAL_INSTALLMENTS,
                    'installment_no'=>$p,
                    'payment_method'=>'',
                    'payment_details'=>'',
                ]);
            }
        }
        return redirect()->route('admin.event-bookings.index');

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

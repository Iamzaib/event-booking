<?php


namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\BookingRoom;
use App\Models\City;
use App\Models\Costume;
use App\Models\CostumeAttribute;
use App\Models\CostumeBookingAttribute;
use App\Models\Country;
use App\Models\Event;
use App\Models\EventAddon;
use App\Models\EventBooking;
use App\Models\EventTicket;
use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Models\InstallmentPayments;
use App\Models\Invoices;
use App\Models\Payment;
use App\Models\State;
use App\Models\Traveler;
use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    private $request;
    public function __construct(Request $request)
    {
        $this->request=$request;
    }
    public function custom_order_process(){

//        $rq=$this->request;
        $rq=$this->request->validate([
            "trip_id" => "required",
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
            'terms'=>'array|required',
            'terms.*'=>'required',
            'payment_method'=>'required|string',
        ]);
//dd($rq->input(),$rqv);
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
        $subtotal=($trip->daily_price*$trip->duration)*$total_traveler;
        $range_=explode('%',$rq->range);
        $range=explode(' > ',Arr::first($range_));
        for ($r=0, $rMax = count($range); $r< $rMax; $r++){
            $range[$r]=date(config('panel.date_format'),strtotime($range[$r]));
        }
//        var_dump($range);exit;
        $duration=Arr::last($range_);
        if($trip->duration>2) {
            $subtotal=($trip->daily_price * $duration) * $total_traveler;
        }



        $starting_total= $subtotal += $room_total;//!$this->session_order('starting_total')?$total:$this->session_order('starting_total');
        $data['savings']=0;
        $data['coupon_amount']=0.00;
        $data['coupon_code']='';
        $data['processing_fee']=(float)PROCESSING_FEE;
//        $data['trip']=$trip;
        $data['room']=$room;
        $data['rooms']=$rooms;
        $data['booking']='';
        $data['user_details']=[];
        $data['user']=Auth::user();


        $booking_details=$trip->event_title.' Booking By '.Auth::user()->name;
        $booking=EventBooking::create([
            'booking_details'=>$booking_details,
            'booking_event_id'=>$trip->id,
            'booking_by_user_id'=>Auth::id(),
            'order_payment_type'=>$rq->payment_type,
            "billing_name"=> Auth::user()->name,
            "billing_lastname"=> Auth::user()->lastname,
            "billing_address"=>Auth::user()->address,
            "billing_address_2"=> Auth::user()->address_2,
            "billing_country_id"=> (int)Auth::user()->country_id,
            "billing_state_id" =>(int)Auth::user()->state_id,
            "billing_city_id" =>(int)Auth::user()->city_id,
        ]);
        if($room!=''){
            $booking->update([
                'room_id'=>$room->id,
                'room_price'=>$room->room_price,
                'booking_from'=>$range[0],
                'booking_to'=>$range[1],
            ]);
        }
        if(count($rooms)>0){
            foreach ($rooms as $room){
                BookingRoom::create([
                    'room_id'=>$room->id,
                    'booking_for_id'=>$booking->id,
                    'room_booking_rate'=>$room->room_price,
                    'booking_from'=>$range[0],
                    'booking_to'=>$range[1],
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

        $total=$subtotal+(float)PROCESSING_FEE;
        $booking->update([
            'booking_total'=>$total,
        ]);
        $deposit=($total*((float)DEPOSIT_AMOUNT_PERCENT/100));
        $installment=$total-$deposit;
        $installment_1=($installment/(int)TOTAL_INSTALLMENTS);
        $paymentMethod = $rq->payment_method;
        $user=Auth::user();
        $amount_to_paid=$total;
        if($rq->payment_type=='Installment'){
            $amount_to_paid=$deposit;
        }
        try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $payment= $user->charge(((float)$amount_to_paid*100), $paymentMethod);
            $booking_payment=EventBooking::where('id',$booking->id)->update([
                'stripe_id'=>$payment->id,
                'stripe_status'=>$payment->status
            ]);
        } catch (\Exception $exception) {
            //   return back()->with('error', );
//            echo $exception->getMessage();
            Session::flash('error',$exception->getMessage());
            return redirect()->back()->with('error',$exception->getMessage());
            exit;
        }
        $paymentUpdate=Payment::create([
            'payment_event_id'=>$trip->id,
            'payment_user_id'=>Auth::id(),
            'payment_booking_id'=>$booking->id,
            'amount_total'=>$total,
            'starting_total'=>$starting_total,
            'amount_paid'=>$amount_to_paid,
            'payment_method'=>'CC',
            'payment_details'=>json_encode($payment),
            'savings'=>0,
            'coupon_amount'=>0,
            'coupon_code'=>'',
            'processing_fee'=>(float)PROCESSING_FEE,
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
            'payment_method'=>'CC',
            'payment_details'=>json_encode($payment),
            'deposit'=>($rq->payment_type=='Installment'?$deposit:0),
            'installment'=>($rq->payment_type=='Installment'?$installment_1:0),
            'total_installments'=>($rq->payment_type=='Installment'?(int)TOTAL_INSTALLMENTS:0),
            'amount_balance'=>($rq->payment_type=='Installment'?($installment):0),
        ]);
        $booking->update([
                'status'=>($rq->payment_type=='Installment'?'pending-payment':'active')
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
        return redirect()->route('frontend.account.index',['tab'=>'trips']);

    }
    public function checkout_review($step,Event $trip,HotelRoom $room){
        if(!isset($trip->id)){
            abort(404);
        }
        $total_traveler=$this->request->travelers;
        $total=($trip->daily_price*$trip->duration)+($room->room_price*($trip->duration-1));
        $data['starting_total']=$total;//!$this->session_order('starting_total')?$total:$this->session_order('starting_total');
        $data['savings']=$this->session_order('savings')?$this->session_order('savings'):0;
        $data['coupon_amount']=$this->session_order('coupon_amount')?$this->session_order('coupon_amount'):0.00;
        $data['coupon_code']=$this->session_order('coupon_code')??'';
        $data['processing_fee']=(float)PROCESSING_FEE;
        $data['trip']=$trip;
        $data['room']=$room;
        $data['rooms']=[];
        $data['booking']='';
        $data['user_details']='';
        $data['user']=(Auth::check()?Auth::user():'');
        $data['addons']=$this->session_order('addons')?$this->session_order('addons'):[];
        $data['payment']=$this->session_order('payment')?$this->session_order('payment'):[];
        $data['costumes']=$this->session_order('costumes')?$this->session_order('costumes'):[];

        if(isset($this->request->addon)&&!array_key_exists($this->request->addon,$data['addons'])){
            $addon=EventAddon::find($this->request->addon);
            if($addon->id){
                $data['addons'][$addon->id]=$addon;
            }
        }
        if(isset($this->request->remove_addon)){
            if(array_key_exists($this->request->remove_addon,$data['addons'])){
                unset($data['addons'][$this->request->remove_addon]);
            }
        }
        if(isset($this->request->costume)&&!array_key_exists($this->request->costume,$data['costumes'])){
            $costume=Costume::find($this->request->costume);
            if($costume->id){
                $data['costumes'][$costume->id]=$costume;
            }
        }
        if(isset($this->request->remove_costume)){
            if(array_key_exists($this->request->remove_costume,$data['costumes'])){
                unset($data['costumes'][$this->request->remove_costume]);
            }
        }
        $data['costumes_options']=[];
        $data['booking_from']=$trip->event_start;
        $data['booking_to']=$trip->event_end;
        $data['event_tickets']=count($trip->tickets);
        $this->request->session()->put('order',$data);
        $order=new \checkout_order($data);

        $data['order']=$order;
        return view('front.checkout.review',$data);

    }
    public function checkout_userInfo($payment_info='f'){
        $order=new \checkout_order();
        if(!$order->order_exists){
          return  redirect()->route('home');
        }
        $data['cities']=$data['states']= [''=>trans('global.pleaseSelect')];
        if(Auth::check()){
            $user=Auth::user();
            if($user->country_id>0){
                $data['states'] = State::where('country_id',$user->country_id)->pluck('state_name', 'id')->prepend(trans('global.pleaseSelect'), '');
            }
            if($user->state_id>0) {
                $data['cities'] = City::where('state_id',$user->state_id)->pluck('city_name', 'id')->prepend(trans('global.pleaseSelect'), '');
            }
        }
        $data['countries'] = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $payment=[];
        $payment['type']=($payment_info=='i'?'Installment':'Full');
        $payment['amount']=($payment_info=='f'?$order->totals:$order->installments['deposit']);
        $payment['balance']=($payment_info=='f'?0:$order->installments['balance']);
        $order->payment=$payment;
//        $this->request->session()->remove('order.payment');
        $this->request->session()->put('order.payment',$payment);
//        print_r($order->payment);
        $data['user']=auth()->user();
        if(!Auth::check()){
            $this->request->session()->put('redirect_to_checkout',$payment_info);
        }else{
            $this->request->session()->remove('redirect_to_checkout');

        }
        $data['payment']=$payment;
        $data['order']=$order;
        $user_data=[];
        $user_data['first_name']=(isset($order->user_details['roommate'][1]['first_name'])?$order->user_details['roommate'][1]['first_name']:Auth::user()->name);
        $user_data['last_name']=(isset($order->user_details['roommate'][1]['last_name'])?$order->user_details['roommate'][1]['last_name']:Auth::user()->lastname);
        $user_data['email']=(isset($order->user_details['roommate'][1]['email'])?$order->user_details['roommate'][1]['email']:Auth::user()->email);
        $user_data['phone']=(isset($order->user_details['roommate'][1]['phone'])?$order->user_details['roommate'][1]['phone']:Auth::user()->phone);
        $user_data['gender']=(isset($order->user_details['roommate'][1]['gender'])?$order->user_details['roommate'][1]['gender']:Auth::user()->gender);
        $user_data['address']=(isset($order->user_details['roommate'][1]['address'])?$order->user_details['roommate'][1]['address']:Auth::user()->address);
        $user_data['address_2']=(isset($order->user_details['roommate'][1]['address_2'])?$order->user_details['roommate'][1]['address_2']:Auth::user()->address_2);
        $user_data['city_id']=(isset($order->user_details['roommate'][1]['city_id'])?$order->user_details['roommate'][1]['city_id']:Auth::user()->city_id);
        $user_data['country_id']=(isset($order->user_details['roommate'][1]['country_id'])?$order->user_details['roommate'][1]['country_id']:Auth::user()->country_id);
        $user_data['state_id']=(isset($order->user_details['roommate'][1]['state_id'])?$order->user_details['roommate'][1]['state_id']:Auth::user()->state_id);
//        var_dump($order->user);
        $data['user_data']=$user_data;
//        return response()->json($order->user);
        return view('front.checkout.userInfo',$data);
    }
    public function checkout_userInfo_update(){
        $user_details=[];
        $user_details['roommate'][1]['first_name']=$this->request->name;
        $user_details['roommate'][1]['last_name']=$this->request->lastname;
        $user_details['roommate'][1]['email']=$this->request->email??$this->request->user_email;
        $user_details['roommate'][1]['phone']=$this->request->phone_locale.' '.$this->request->phone;
        $user_details['roommate'][1]['gender']=$this->request->gender;
        $user_details['roommate'][1]['address']=$this->request->address;
        $user_details['roommate'][1]['address_2']=$this->request->address_2;
        $user_details['roommate'][1]['city_id']=$this->request->city_id;
        $user_details['roommate'][1]['country_id']=$this->request->country_id;
        $user_details['roommate'][1]['state_id']=$this->request->state_id;
        $user_details['roommate'][1]['notes']='';
        $count=2;
        foreach ($this->request->roommate as $roommate){
            $user_details['roommate'][$count]=$user_details['roommate'][1];
            $user_details['roommate'][$count]['first_name']=$roommate;
            $user_details['roommate'][$count]['last_name']='';
        }

        if(!Auth::check()){
            $validated =$this->validate($this->request,[
                'name' => [
                    'string',
                    'required',
                ],
                'lastname' => [
                    'string',
                    'nullable',
                ],
                'email' => [
                    'required',
                    'unique:users,email',
                ],
                'phone' => [
                    'string',
                    'required',
                    'unique:users,phone',
                ],
                'address' => [
                    'string',
                    'required',
                ],
                'password' => [
                    'string',
                    'confirmed',
                    'min:8'
                ],
                'address_2' => [
                    'string',
                    'nullable',
                ],
                'city_id' => [
                    'nullable',
                    'integer',
                ],
                'state_id' => [
                    'required',
                    'integer',
                ],
                'country_id' => [
                    'required',
                    'integer',
                ]
            ]);
            $user=User::create($validated);
            $data['user']=$user;
            $this->request->session()->put('order.user',$user);

        }
        $this->request->session()->put('order.user_details',$user_details);
        $order=new \checkout_order();
        $booking=$this->save_to_db($order);
        $this->request->session()->put('order.booking',$booking->first());
        if(!Auth::check()){
            Auth::login($user);
            return  redirect()->route('email_verification');
        }
       return redirect()->route('frontend.checkout_payment');
    }
    public function checkout_payment(){
        $order=new \checkout_order();
        if(!$order->order_exists){
         return  redirect()->route('home');
        }
//         echo "<pre>";var_dump(session('order'));exit;
            $user=Auth::user();
            if($user->country_id>0){
                $data['states'] = State::where('country_id',$user->country_id)->pluck('state_name', 'id')->prepend(trans('global.pleaseSelect'), '');
            }
            if($user->state_id>0) {
                $data['cities'] = City::where('state_id',$user->state_id)->pluck('city_name', 'id')->prepend(trans('global.pleaseSelect'), '');
            }
        $data['countries'] = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $data['order']=$order;

        $data['intent'] = auth()->user()->createSetupIntent();
        return view('front.checkout.payment',$data);
    }
    public function checkout_payment_save(){
        $paymentMethod = $this->request->payment_method;
        $user=Auth::user();
        try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
        } catch (\Exception $exception) {
            //   return back()->with('error', );
            return redirect()->back()->with('error',$exception->getMessage());
            exit;
        }
        $same_address=false;
        if((int)$this->request->address_same>0){
            $same_address=true;
        }

        $user_billing_details=[
            'name'=>($same_address?$user->name:$this->request->name),
            'lastname'=>($same_address?$user->lastname:$this->request->lastname),
            'address'=>($same_address?$user->address:$this->request->address),
            'address_2'=>($same_address?$user->address_2:$this->request->address_2),
            'country_id'=>($same_address?$user->country_id:$this->request->country_id),
            'state_id'=>($same_address?$user->state_id:$this->request->state_id),
            'city_id'=>($same_address?$user->city_id:$this->request->city_id),
        ];

        $this->request->session()->put('order.user_billing_detail',$user_billing_details);
        $this->request->session()->put('order.payment.stripe_payment_method',$paymentMethod);

        return redirect()->route('frontend.checkout_confirm');
    }
    public function checkout_confirm(){
        $user=Auth::user();
        $paymentMethods = $user->paymentMethods()->map(function($paymentMethod){
            return $paymentMethod->asStripePaymentMethod();
        });
        $this->request->session()->put('order.payment.methods',$paymentMethods);
        $order=new \checkout_order();
        if(!$order->order_exists){
          return  redirect()->route('home');
        }

//        echo "<code><pre>";var_dump($order);exit;
//        return response()->json($order);
        $data['order']=$order;
        return view('front.checkout.confirm',$data);
    }
    public function checkout_complete(){
        $order=new \checkout_order();
        if(!$order->order_exists){
            return  redirect()->route('home');
        }
        try {
            $user=Auth::user();
            $paymentMethod=$order->payment['stripe_payment_method'];
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $payment= $user->charge(($order->payment['amount']*100), $paymentMethod);
//            $booking_=$order->booking->first();
            $booking_payment=EventBooking::where('id',$order->booking->id)->update([
                'stripe_id'=>$payment->id,
                'stripe_status'=>$payment->status
            ]);

        } catch (\Exception $exception) {
            //   return back()->with('error', );
            echo $exception->getMessage();
            exit;
        }
        $booking=$this->save_to_db($order,true,'payment_update');
        return view('front.checkout.thank_you',$booking);
    }
    private function session_order($key){
        $key='order.'.$key;
        if($this->request->session()->exists($key)){
            return $this->request->session()->get($key);
        }
        return false;
    }
    private function save_to_db($order,$update=false,$type=''){
        if($update){
            if($type=='payment_update'){
                $booking=EventBooking::where('id',$order->trip->id);
                $booking->update([
                    "billing_name"=> $order->user['billing_detail']['name'],
                    "billing_lastname"=> $order->user['billing_detail']['lastname'],
                    "billing_address"=>$order->user['billing_detail']['address'],
                    "billing_address_2"=> $order->user['billing_detail']['address_2'],
                    "billing_country_id"=> (int)$order->user['billing_detail']['country_id'],
                    "billing_state_id" =>(int)$order->user['billing_detail']['state_id'],
                    "billing_city_id" =>(int)$order->user['billing_detail']['city_id'],
                ]);
                $payment=Payment::where('payment_booking_id',$booking->id);
                $payment->update([
                    'amount_paid'=>$order->payment['amount'],
                    'payment_method'=>'CC',
                    'payment_details'=>json_encode($order->payment['methods']),
                ]);
                return $booking;
            }

        }

        if(isset($order->booking->id)&&$order->booking->id!=''){
            $booking=EventBooking::where('id',$order->booking->id)->update([
                'booking_total'=>$order->totals,
                'order_payment_type'=>$order->payment['type'],
            ]);
            $payment=Payment::where('payment_booking_id',$booking->id)->update([
                'amount_total'=>$order->totals,
                'starting_total'=>$order->info['starting_total'],
                'savings'=>$order->info['savings'],
                'coupon_amount'=>$order->info['coupon_amount'],
                'coupon_code'=>$order->info['coupon_code'],
                'processing_fee'=>(float)PROCESSING_FEE,
                'subtotal'=>$order->subtotal,
                'deposit'=>($order->payment['type']=='Installment'?$order->installments['deposit']:0),
                'installment'=>($order->payment['type']=='Installment'?$order->installments['installment']:0),
                'total_installments'=>(int)TOTAL_INSTALLMENTS,
                'amount_balance'=>($order->payment['type']=='Installment'?$order->installments['balance']:0),
            ]);
            Traveler::where('booking_id',$booking->id)->delete();
            foreach ($order->user_details['roommate'] as $roommate){
                Traveler::create([
                    'booking_id'=>$booking->id,
                    'first_name'=>$roommate['first_name'],
                    'last_name'=>$roommate['last_name'],
                    'email'=>$roommate['email'],
                    'phone'=>$roommate['phone'],
                    'gender'=>$roommate['gender'],
                    'notes'=>($roommate['notes']??''),
                ]);
            }
            if($order->info['room']!=''){
                $booking->update([
                    'room_id'=>$order->info['room']->id,
                    'room_price'=>$order->info['room']->room_price,
                    'booking_from'=>$order->trip->event_start,
                    'booking_to'=>$order->trip->event_end,
                ]);
            }
            if(count($order->info['rooms'])>0){
                BookingRoom::where('booking_for_id',$booking->id)->delete();
                foreach ($order->info['rooms'] as $room){
                    BookingRoom::create([
                        'room_id' =>$room->id,
                        'booking_for_id'=>$booking->id,
                        'room_booking_rate'=>$room->room_price,
                        'booking_from'=>$order->info['booking_from'],
                        'booking_to'=>$order->info['booking_to'],
                    ]);
                }
            }

            $booking->booking_event_addons()->detach();
            $booking->booking_event_costumes()->detach();
            if(count($order->addons)>0){
                foreach ($order->addons as $addon){
                    $booking->booking_event_addons()->sync([$addon->id=>['addon_price'=>$addon->addon_price]]);
                }
            }
            if(count($order->costumes)>0){
                foreach ($order->costumes as $costume){
                    $booking->booking_event_costumes()->sync([$costume->id=>['costume_price'=>$costume->costume_price]]);
                }
            }
            CostumeBookingAttribute::where('booking_id',$booking->id)->delete();
            if(count($order->info['costumes_options'])>0){
                foreach ($order->info['costumes_options'] as $traveler_id => $costumes_option){
                    foreach ($costumes_option as $costume_id => $options){
                        foreach ($options as $option_id => $option){
                            CostumeBookingAttribute::create([
                                'booking_id'=>$booking->id,
                                'traveler_id'=>$traveler_id,
                                'costume_id'=>$costume_id,
                                'costume_attribute_id'=>$costumes_option,
                                'values'=>$option->value,
                            ]);
                        }
                    }
                }
            }
        }else{
            $booking_details=$order->trip->event_title.' Booking By '.$order->user->name;
            $booking=EventBooking::create([
                'booking_details'=>$booking_details,
                'booking_total'=>$order->totals,
                'booking_event_id'=>$order->trip->id,
                'booking_by_user_id'=>$order->user->id,
                'order_payment_type'=>$order->payment['type'],
            ]);
            $payment=Payment::create([
                'payment_event_id'=>$order->trip->id,
                'payment_user_id'=>$order->user->id,
                'payment_booking_id'=>$booking->id,
                'amount_total'=>$order->totals,
                'starting_total'=>$order->info['starting_total'],
                'savings'=>$order->info['savings'],
                'coupon_amount'=>$order->info['coupon_amount'],
                'coupon_code'=>$order->info['coupon_code'],
                'processing_fee'=>$order->info['starting_total'],
                'subtotal'=>$order->subtotal,
                'deposit'=>($order->payment['type']=='Installment'?$order->installments['deposit']:0),
                'installment'=>($order->payment['type']=='Installment'?$order->installments['installment']:0),
                'total_installments'=>(int)TOTAL_INSTALLMENTS,
                'amount_balance'=>($order->payment['type']=='Installment'?$order->installments['balance']:0),
            ]);
            foreach ($order->user_details['roommate'] as $roommate){
                Traveler::create([
                    'booking_id'=>$booking->id,
                    'first_name'=>$roommate['first_name'],
                    'last_name'=>$roommate['last_name'],
                    'email'=>$roommate['email'],
                    'phone'=>$roommate['phone'],
                    'gender'=>$roommate['gender'],
                    'notes'=>($roommate['notes']??''),
                ]);
            }
            if($order->info['room']!=''){
                $booking->update([
                    'room_id'=>$order->info['room']->id,
                    'room_price'=>$order->info['room']->room_price,
                    'booking_from'=>$order->trip->event_start,
                    'booking_to'=>$order->trip->event_end,
                ]);
            }
            if(count($order->info['rooms'])>0){
                foreach ($order->info['rooms'] as $room){
                    BookingRoom::create([
                        'room_id' =>$room->id,
                        'booking_for_id'=>$booking->id,
                        'room_booking_rate'=>$room->room_price,
                        'booking_from'=>$order->info['booking_from'],
                        'booking_to'=>$order->info['booking_to'],
                    ]);
                }
            }
            if(count($order->addons)>0){
                foreach ($order->addons as $addon){
                    $booking->booking_event_addons()->sync([$addon->id=>['addon_price'=>$addon->addon_price]]);
                }
            }
            if(count($order->costumes)>0){
                foreach ($order->costumes as $costume){
                    $booking->booking_event_costumes()->sync([$costume->id=>['costume_price'=>$costume->costume_price]]);
                }
            }
            if(count($order->info['costumes_options'])>0){
                foreach ($order->info['costumes_options'] as $traveler_id => $costumes_option){
                    foreach ($costumes_option as $costume_id => $options){
                        foreach ($options as $option_id => $option){
                            CostumeBookingAttribute::create([
                                'booking_id'=>$booking->id,
                                'traveler_id'=>$traveler_id,
                                'costume_id'=>$costume_id,
                                'costume_attribute_id'=>$costumes_option,
                                'values'=>$option->value,
                            ]);
                        }
                    }
                }
            }
        }


       return $booking;
    }
}

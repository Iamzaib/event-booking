<?php


namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Costume;
use App\Models\Country;
use App\Models\Event;
use App\Models\EventAddon;
use App\Models\HotelRoom;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    private $request;
    public function __construct(Request $request)
    {
        $this->request=$request;
    }
    public function checkout_review($step,Event $trip,HotelRoom $room){
        if(!isset($trip->id)){
            abort(404);
        }

        $total_traveler=$this->request->travelers;
        $data['starting_total']=$this->session_order('starting_total')?$this->session_order('starting_total'):($trip->daily_price*$trip->duration)+($room->room_price*($trip->duration-1));
        $data['savings']=$this->session_order('savings')?$this->session_order('savings'):0;
        $data['coupon_amount']=$this->session_order('coupon_amount')?$this->session_order('coupon_amount'):0.00;
        $data['coupon_code']=$this->session_order('coupon_code')??'';
        $data['processing_fee']=(float)PROCESSING_FEE;
        $data['trip']=$trip;
        $data['room']=$room;
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
        $data['event_tickets']=count($trip->tickets);
        $this->request->session()->put('order',$data);
        $order=new \checkout_order($data);

        $data['order']=$order;
        return view('front.checkout.review',$data);

    }
    public function checkout_userInfo($payment_info='f'){
        $order=new \checkout_order();
        if(!$order->order_exists){
            redirect()->route('home');
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
        $payment['type']=($payment_info=='i'?'Installment':'Full');
        $payment['amount']=($payment_info=='f'?$order->totals:$order->installments['deposit']);
        $payment['balance']=($payment_info=='f'?0:$order->installments['balance']);
        $order->payment=$payment;
        $this->request->session()->push('order.payment',$payment);
//        print_r($order->payment);
        $data['user']=auth()->user();
        if(!Auth::check()){
            $this->request->session()->put('redirect_to_checkout',$payment_info);
        }
        $data['payment']=$payment;
        $data['order']=$order;
        return view('front.checkout.userInfo',$data);
    }
    public function checkout_userInfo_update(){
        $user_details=[];
        foreach ($this->request->input() as $field => $value){
            if($field=='_token'||$field=='password'||$field=='password_confirmation')continue;
            $user_details[$field]=$value;
        }
        $this->request->session()->push('order.user.details',$user_details);

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
            User::create($validated);
            redirect()->route('confirm');
        }
       return redirect()->route('frontend.checkout_payment');

//        print_r($this->request->input());
    }
    public function checkout_payment(){
        $order=new \checkout_order();
        if(!$order->order_exists){
            redirect()->route('home');
        }
        $data['order']=$order;
        $data['intent'] = auth()->user()->createSetupIntent();
        return view('front.checkout.payment',$data);
    }
    private function session_order($key){
        $key='order.'.$key;
        if($this->request->session()->exists($key)){
            return $this->request->session()->get($key);
        }
        return false;
    }
}

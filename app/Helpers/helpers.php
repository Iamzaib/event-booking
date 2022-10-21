<?php
use App\Models\Setting;
include ('checkout_order.php');
if(!function_exists('display_currency')){
    function display_currency($amount){
        $amount=str_replace('.00','',$amount);
        $currency=Setting::where('setting_key','DEFAULT_CURRENCY')->first();
        if(isset($currency->setting_value)){
            return currency_icons($currency->setting_value).$amount;
        }
        return '$'.$amount;
    }
}
if(!function_exists('favorite_check')){
    function favorite_check($trip_id,$user_id): bool
    {
        if(isset($trip_id,$user_id)){
            $user=\App\Models\User::find($user_id);
            return $user->favourite_trips()->where('id', $trip_id)->count() > 0;
        }
        return false;
    }
}
if(!function_exists('currency_icons')){
    function currency_icons($currency){
        $icons=[
            'US Dollar'=>'$',
            'Pound'=>'£',
            'Euro'=>'&euro;'
        ];
        return $icons[$currency];
    }
}
function invoice_number($pid,$id)
{
    return 10000+$pid.'-'.(int)$id;
}
function city_name($id){
    return \App\Models\City::find($id)->city_name;
}
function state_name($id){
    return \App\Models\State::find($id)->state_name;
}
function country_name($id){
    return \App\Models\Country::find($id)->name;
}
function processing_fee($total){
    if($total>0){
        $p_fee_percent=(float)PROCESSING_FEE;
        return $total*($p_fee_percent/100);
    }
    return 0;
}


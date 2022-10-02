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



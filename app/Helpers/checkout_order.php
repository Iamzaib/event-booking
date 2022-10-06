<?php

//namespace App\Helpers;
if(!class_exists('checkout_order')){

    class checkout_order{
        public $info,$totals,$subtotal,$trip,$user,$addons,$costumes,$payment,$booking,$user_details;
        public bool $order_exists;
        public array $installments,$coupon;
        private $booking_id;

        public function __construct($data='',$booking_id='')
        {
            $this->order_exists=true;
            if($booking_id!==''&&auth()->check()) {
                $this->booking_id=$booking_id;
                $this->info=$this->query();
            }else{
                if ($data !== '') {
                    $this->info = $data;
                } elseif (session('order.trip') != '') {
                    $this->info = session('order');
                } else {
                    $this->order_exists = false;
                }
            }

            if($this->order_exists){
                $this->user=$this->info['user'];
                $this->user_details=$this->info['user_details'];
                $this->trip=$this->info['trip'];
                $this->booking=$this->info['booking'];
                $this->addons=$this->info['addons'];
                $this->payment=$this->info['payment'];
                $this->costumes=$this->info['costumes'];
                $this->coupon['code']=$this->info['coupon_code'];
                $this->coupon['amount']=$this->info['coupon_amount'];
                $this->totals=$this->total()['total'];
                $this->subtotal=$this->total()['subtotal'];
                $this->installments=$this->installment();
            }
        }

        private function total(): array
        {
            $totals['subtotal']=((float)$this->info['starting_total']);
            if((float)$this->info['savings']>0){
                $totals['subtotal']-=(float)$this->info['savings'];
            }if((float)$this->coupon['amount']>0){
                $totals['subtotal']-=(float)$this->coupon['amount'];
            }
            foreach ($this->addons as $addon){
                $totals['subtotal']+=(float)$addon->addon_price;
            }
            $totals['total']=$totals['subtotal']+(float)$this->info['processing_fee'];
            return $totals;
        }
          private function installment(): array
         {
            $installments['deposit']=(float)($this->totals*((float)DEPOSIT_AMOUNT_PERCENT/100));
            $installment=$this->totals-$installments['deposit'];
             $installments['installment']=($installment/(int)TOTAL_INSTALLMENTS);

             $installments['balance']=$installment;
             foreach ($installments as $type=> $installment_){
//                 $installments[$type]=number_format($installment_,2);
                 $installments[$type]=round($installments[$type],2);
             }
             return $installments;
         }
         private function query(){
           $data=[];
           $booking=\App\Models\EventBooking::find($this->booking_id);

           $payments=$booking->booking_payment;
             $data['starting_total']=$payments->starting_total;//!$this->session_order('starting_total')?$total:$this->session_order('starting_total');
             $data['savings']=$payments->savings;
             $data['coupon_amount']=$payments->coupon_amount;
             $data['coupon_code']=$payments->coupon_code;
             $data['processing_fee']=$payments->processing_fee;
             $data['trip']=$booking->booking_event;
             if($booking->booking_room!=''){
                 $data['room']=$booking->booking_room;
                 $data['rooms']=[];
             }else{
                 foreach ($booking->booking_rooms as $booking_room){
                     $room=$booking_room->room;
                     $room->room_price=$booking_room->room_booking_rate;
                     $data['rooms'][$room->id]=$room;
                 }
             }
             $data['addons']=[];
             foreach ($booking->booking_event_addons as $addon){
                 $data['addons'][$addon->id]=$addon;
                 $data['addons'][$addon->id]->addon_price=$addon->pivot->addon_price;
             }

             $data['payment']['type']=$booking->order_payment_type;
             $data['payment']['amount']=($booking->order_payment_type=='Installment'?($payments->deposit>=$payments->amount_paid?$payments->deposit:$payments->amount_paid):$booking->booking_total);
             $data['payment']['balance']=($booking->order_payment_type=='Installment'?$payments->amount_balance:0);
             $costume_attributes=[];

             foreach ($booking->booking_event_costumes as $costume){
                $data['costumes'][$costume->id]=$costume;
                $data['costumes'][$costume->id]->costume_price=$costume->pivot->costume_price;
             }
             foreach ($booking->booking_costumes_attributes as $booking_costumes_attribute){
                 $data['costumes_options'][$booking_costumes_attribute->traveler_id][$costume->id][$booking_costumes_attribute->costume_attribute_id]=$booking_costumes_attribute;
             }
             return $data;
         }

    }

}

<?php


//namespace App\Helpers;



if(!class_exists('checkout_order')){

    class checkout_order{
        public $order_exists,$info,$totals,$subtotal,$trip,$user,$addons,$costumes;
        public array $installments,$coupon,$payment;

        public function __construct($data='')
        {
            $this->order_exists=true;
            if($data!==''){
                $this->info=$data;
            }elseif(session('order')){
                    $this->info=session('order');

            }else{
                $this->order_exists=false;
                $this->info=[];
            }
            $this->user=auth()->user();
            $this->trip=$this->info['trip'];
            $this->addons=$this->info['addons'];
            $this->payment=$this->info['payment'];
            $this->costumes=$this->info['costumes'];
            $this->coupon['code']=$this->info['coupon_code'];
            $this->coupon['amount']=$this->info['coupon_amount'];
            $this->totals=$this->total()['total'];
            $this->subtotal=$this->total()['subtotal'];
            $this->installments=$this->installment();
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
    }

}

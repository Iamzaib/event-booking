@extends('layouts.front')

@section('styles')
@endsection
@section('content')
    <div class="checkutpagemain">
        <div class="container contch">
            <div class="checkout1box">
                <h1 class="arwsqft"><img src="{{asset('assets/front/img/arrow-square-left.svg')}}" /><a href="./tour-detail.html">Go back</a></h1>
                <h2>Review your trip.</h2>
                @if(DISPLAY_CHECKOUT_TOP_MSG==true)
                <div class="toptxtch">
                    <div class="txtch11">
                        <img class="bellimg1" src="{{asset('assets/front/img/notification-bing.svg')}}" />
                        <span>
                  {{CHECKOUT_TOP_MSG}}
                </span>
                @endif
                        <img src="{{asset('assets/front/img/close-square.svg')}}" class="closeimg11" />
                    </div>
                </div>
            </div>

            <div class="row padding20sec1ch">


                <div class="col-md-8">
                    <div class="row checkb1divd1">
                        <div class="col-md-5 prel padding0">
                            <div>
                                <img class="imgch" src="{{asset('assets/front/img/tourimg1.png')}}" />
                            </div>
                        </div>
                        <div class="col-md-7 checkb1sdivd1">
                            <div class="">
                                <a href="#" class="titlech">
                                    <h4 class="marbot0">{{$trip->event_title}}</h4>
                                </a>
                                <div class="cb1sbt1">
                                    <span><img src="{{asset('assets/front/img/locationsp.svg')}}" /> {{$trip->city->city_name}}, {{$trip->country->name}}</span>
                                    <span><img src="{{asset('assets/front/img/calendar.svg')}}" /> {{$trip->duration}} Days</span>
                                </div>
                                <div class="cb1sbt2">
                                    <div>
                                        <p>{{$room->details??''}}</p>
                                    </div>
                                    <div>
                                        <span>Change Room</span>
                                        <img src="{{asset('assets/front/img/arrow-square-down-light.svg')}}" />
                                    </div>
                                </div>
                                <div class="cb1sbt3">
                                    <button type="button" data-bs-toggle="modal" class="roomtrav" data-bs-target="#travelermodal">
                                        <img src="{{asset('assets/front/img/buliding.svg')}}" /> 1 room 2 travelers
                                    </button>
                                </div>

                                <div class="cb1sbt4">
                                    <p>
                                        Non-refundable
                                        <button type="button" class="tooltpbtn" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="The sales tax listed on the checkout page is only an estimate. Your invoice will contain the final sales tax, including state and local taxes, as well as any applicable rebates or fees. In California and Rhode Island, sales tax is collected on the unbundled price of iPhone.">
                                            <img src="{{asset('assets/front/img/question-circle-outlined.svg')}}" class="faquest" />
                                        </button>

                                    </p>
                                </div>

                                <div class="cb1sbt5">
                                    <h1 class="arwsqft" onclick="$('.room_details').toggle('fast','linear')"><a >Room Information</a> <img src="{{asset('assets/front/img/arrow-square-down.svg')}}" />
                                    </h1>
                                    <div class="room_details mt-2" style="display: none">
                                        <ul class="bullets2 bbbhssgdu">
                                        <li>{{$room->details}}</li>
                                        <li>Max {{$room->room_capacity}} Roommates</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="cb1sbt6">
                                    <div id="benefitsdescription">
                                        <div class="benefitsshowmorew packde1" onclick="$('.benefitsshow-more-height-2').toggle('fast','linear')">
                                            <span>Package Details</span> <img src="{{asset('assets/front/img/arrow-square-down-light.svg')}}" />
                                        </div>
                                        <div class="benefitstext benefitsshow-more-height-2" style="display: none">
                                            <ul class="bullets2 bbbhssgdu">
                                                <li>{{$trip->duration-1}} Nights Hotel Accommodation</li>
                                                @if($event_tickets>0)<li>{{$event_tickets}} Event Tickets</li>@endif

                                                @foreach($trip->costumes as $costume)
                                                    <li>{{$costume->costume_title}}</li>
                                                @endforeach
                                                @foreach($trip->addons as $addon)
                                                    <li>{{$addon->addon_title}}</li>
                                                @endforeach
{{--                                                <li>Professional Photographer</li>--}}
{{--                                                <li>Costume Pickup & Delivery</li>--}}
{{--                                                <li>Personal Concierge</li>--}}
{{--                                                <li>Welcome Bag</li>--}}
                                            </ul>
                                        </div>
                                    </div>

                                </div>


                            </div>

                        </div>
                    </div>

                    <h3 class="texthead22">Add Upgrades</h3>

                    <div class="upgradess">
                        @foreach($trip->addons as $addon)
                        <div class="dflexcb1 padbot0">
                            <div>
                                <p>
                                    <img src="{{asset('assets/front/img/upgrades.svg')}}" class="befimg" />
                                    <span id="addon_title_{{$addon->id}}">{{$addon->addon_title}}</span>
                                </p>
                            </div>
                            <div>
                                <h1 class="arwsqft" onclick="add_addon(this,'{{$addon->id}}','{{$addon->addon_price}}')"><a href="{{request()->fullUrlWithQuery([(array_key_exists($addon->id,$addons)?'addon':'remove_addon')=>'',(array_key_exists($addon->id,$addons)?'remove_addon':'addon') => $addon->id])}}">{{(array_key_exists($addon->id,$addons)?'Remove':'Add')}} </a><img src="{{asset('assets/front/img/add-square.svg')}}" /></h1>
                                <input type="hidden" name="addon[{{$addon->id}}]" id="addon_id{{$addon->id}}" >
                                <input type="hidden" name="addon_price[{{$addon->id}}]" id="addon_price{{$addon->id}}" >
                            </div>
                        </div>
                        @endforeach
{{--                        <div class="dflexcb1 padbot0">--}}
{{--                            <div>--}}
{{--                                <p>--}}
{{--                                    <img src="{{asset('assets/front/img/upgrades.svg')}}" class="befimg" />--}}
{{--                                    Fast Track Arrival Service--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <h1 class="arwsqft"><a href="#">Add </a><img src="{{asset('assets/front/img/add-square.svg')}}" /></h1>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="dflexcb1 padbot0">--}}
{{--                            <div>--}}
{{--                                <p>--}}
{{--                                    <img src="{{asset('assets/front/img/upgrades.svg')}}" class="befimg" />--}}
{{--                                    Island Tour--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <h1 class="arwsqft"><a href="#">Add </a><img src="{{asset('assets/front/img/add-square.svg')}}" /></h1>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="dflexcb1 padbot0">--}}
{{--                            <div>--}}
{{--                                <p>--}}
{{--                                    <img src="{{asset('assets/front/img/upgrades.svg')}}" class="befimg" />--}}
{{--                                    Travel Insurance--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <h1 class="arwsqft"><a href="#">Add </a><img src="{{asset('assets/front/img/add-square.svg')}}" /></h1>--}}
{{--                            </div>--}}
{{--                        </div>--}}


                    </div>

                    <div class="row">
                        <h3 class="texthead22">Choose a payment option.</h3>

                        <div class="col-md-6">
                            <div class="choosepaymemyrad">
                                <input type="radio" id="pay1" name="payment" value="installments">
                                <label for="pay1">

                                    <div class="boxchlabl">
                                        <h3>Deposit + Monthly Installments</h3>
                                        <h3><b>{{display_currency($order->installments['deposit'])}} Deposit + {{display_currency($order->installments['installment'])}} for {{TOTAL_INSTALLMENTS}} Months</b></h3>
                                    </div>
                                    <div>
                                        <ul class="bullets2 bbbhssgdu">
                                            <li>
                                                Pay Deposit and balance in remaining months
                                            </li>
                                            <li>Get rewards points</li>
                                            <li>
                                                Pay for your iPhone with low monthly
                                            </li>
                                        </ul>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="choosepaymemyrad">

                                <input type="radio" id="pay2"  name="payment" value="full">
                                <label for="pay2">

                                    <div class="boxchlabl">
                                        <h3>Pay in full</h3>
                                        <h3><b>{{display_currency($order->totals)}}</b></h3>
                                    </div>
                                    <div>
                                        <ul class="bullets2 bbbhssgdu">
                                            <li>
                                                Pay for your package in full
                                            </li>
                                            <li>
                                                Get 2X rewards points
                                            </li>
                                            <li>
                                                Pay for your iPhone with low monthly
                                            </li>
                                        </ul>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>


                    <div class="quextions">
                        <div class="upgradess">

                            <div class="dflexcb1 padbot0">
                                <div>
                                    <h3>Questions About Buying</h3>
                                </div>
                                <div>
                                    <h1 class="arwsqft"><img src="{{asset('assets/front/img/add-square.svg')}}" /></h1>
                                </div>
                            </div>



                        </div>
                    </div>




                </div>


                <div class="col-md-4">
                    <div class="pricech1 pricechb1">
                        <h2 class="">Price Details</h2>
                        <h1 class="">Add coupon code</h1>

                        <div class="mainmaxprice">
                            <div class="priceflex1">
                                <div>
                                    <p>Starting Price</p>
                                </div>
                                <div>
                                    <p id="starting_price">{{display_currency($order->info['starting_total'])}}</p>
                                </div>
                            </div>
                            @if($order->addons!='')
                                @foreach($order->addons as $addon)
                                    <div class="priceflex1 saving" id="addon_div_{{$addon->id}}">
                                        <div>
                                            <p>{{$addon->addon_title}}</p>
                                        </div>
                                        <div>
                                            <p id="saving-amount">{{display_currency($addon->addon_price)}}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            @if($savings>0)
                            <div class="priceflex1 saving">
                                <div>
                                    <p>Trip Saving</p>
                                </div>
                                <div>
                                    <p style="color: #039855 !important;" id="saving-amount">-{{display_currency($savings)}}</p>
                                </div>
                            </div>
                            @endif
                            @if($order->coupon['code']!='')
                            <div class="priceflex1 coupon">
                                <div>
                                    <p>Coupon (<span id="coupon-code">{{$order->coupon['code']}}</span>)</p>
                                </div>
                                <div>
                                    <p  style="color: #039855 !important;" id="coupon-saving">-{{$order->coupon['amount']}}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="mainmaxprice">
                            <div class="priceflex1">
                                <div>
                                    <p>Subtotal</p>
                                </div>
                                <div>
                                    <p><b id="subtotal">{{display_currency($order->subtotal)}}</b></p>
                                </div>
                            </div>
                            <div class="priceflex1">
                                <div  >
                                    <p class="prel">Processing Fees  <button type="button" class="tooltpbtn" data-bs-toggle="tooltip" data-bs-placement="top"
                                                                             title="The sales tax listed on the checkout page is only an estimate. Your invoice will contain the final sales tax, including state and local taxes, as well as any applicable rebates or fees. In California and Rhode Island, sales tax is collected on the unbundled price of iPhone.">
                                            <img src="{{asset('assets/front/img/info-circle.svg')}}" class="faquest" />
                                        </button></p>
                                </div>
                                <div>
                                    <p id="total">{{display_currency($order->info['processing_fee'])}}</p>
                                </div>
                            </div>

                        </div>

                        <div class="priceflex1">
                            <div>
                                <p>Total</p>
                            </div>
                            <div class="flex22">
                                <img src="{{asset('assets/front/img/usd.svg')}}" />
                                <h4>{{display_currency($order->totals)}}</h4>
                            </div>
                        </div>
                        <a href="" id="proceedCheckout">Proceed to checkout</a>

                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function (){
           $('input[name=payment]').on('change',function (){
               var url;
              if($(this).val()==='installments'){
                  url='{{route('frontend.checkout_info',['payment_info'=>'i'])}}';
              }else {
                  url='{{route('frontend.checkout_info',['payment_info'=>'f'])}}';
              }
              console.log($(this).val());
              $('#proceedCheckout').attr('href',url);
           });
        });
        var addons=[],addons_ids=[],starting_price={{$starting_total}},processing_fee={{$processing_fee}},savings={{$savings}},coupon={{$order->coupon['amount']}},subtotal={{$order->subtotal}};
        function add_addon(btn,addon_id,addon_price){
            // alert(addon_id)
            let id_found=false;

            for(var v=0;v<addons_ids.length;v++){
                if(addons_ids[v]===addon_id){id_found=true;}
            }
            if(id_found===false){
                var addon={id:addon_id,addon_price:addon_price};
                addons.push(addon);
                addons_ids.push(addon_id);
                // console.log(addons);
            }else{
                for (var i=0;i<addons.length;i++){
                    if(addons[i].id===addon_id){
                        addons.splice(i,1);
                        addons_ids.splice(addons_ids.indexOf(addon_id),1);
                        // console.log(addons);
                    }
                }
            }
            calculate_totals();
        }
        function calculate_totals(){
            var total=0;
            //total+=starting_price;
            total+=parseFloat(subtotal);
            for (var i=0;i<addons.length;i++){
                total+=parseFloat(addons[i].addon_price);
            }
            total+=processing_fee;
            console.info('total='+total);
        }
    </script>
@endsection

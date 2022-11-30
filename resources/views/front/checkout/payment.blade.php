@extends('layouts.front')

@section('styles')

@endsection
@section('content')

<div class="checkutpagemain pt125">
    <div class="container contch">
        <div>
            <h1 class="arwsqft"><img src="{{asset('assets/front/img/arrow-square-left.svg')}}" /><a href="{{route('frontend.checkout_info')}}">Go back</a></h1>
        </div>

        <div class="">
            <!-- <h3>Delivers: Mon, Aug 30</h3> -->
            <div class="row padding20sec1ch">


                <div class="col-md-8">
                    <h2 class="h2tard">
                        How do you want to pay?
                    </h2>
                    <div class="pad2min">

                            <div class="">
                                <div class="">
                                    <div class="button-group-pills text-center" data-toggle="buttons">
                                        <div class="col-md-12">
                                            <label class="btn btn-default btnrdiocust">
                                                <input type="radio" name="options" class="creditcardactive" />
                                                <div class="readiocustdiv">
                                                    <div>
                                                        <img src="{{asset('assets/front/img/cards222.svg')}}" />
                                                    </div>
                                                    <div>
                                                        <p>Credit or Debit Card</p>
                                                        <span>Apple Card, Visa, Mastercard, AMEX, Discover,
                            UnionPay</span>
                                                    </div>

                                                </div>
                                            </label>
                                            <form action="{{route('frontend.checkout_payment_save')}}" class="card-form" method="post">
                                            <div class="maindivcreditcard">
                                                <p>Enter your card information:</p>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div id="card-element"></div>
                                                        <div id="card-errors" role="alert"></div>
                                                        <input type="hidden" name="payment_method" class="payment-method">
{{--                                                        <div class="col-md-12">
   <div class="prel">--}}
{{--                                                            <input type="text" class="inputText intcardtxt" id="tbsp" onkeyup="addspace(this)" maxlength="19"--}}
{{--                                                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"--}}
{{--                                                                   required />--}}
{{--                                                            <span class="floating-label">Credit/Debit Card Number</span>--}}
{{--                                                            <img src="img/allcrads.svg" class="allcardclas" />--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-md-9">--}}
{{--                                                        <div class="prel">--}}
{{--                                                            <input type="text" class="inputText" id="tbNum" onkeyup="addslash(this)" maxlength="5"--}}
{{--                                                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"--}}
{{--                                                                   required />--}}
{{--                                                            <span class="floating-label">Expiration MM/YY</span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-md-3">--}}
{{--                                                        <div class="prel">--}}
{{--                                                            <input type="text" class="inputText" maxlength="3"--}}
{{--                                                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"--}}
{{--                                                                   required />--}}
{{--                                                            <span class="floating-label">CVV</span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
                                                </div>
                                                </div>
                                                <hr />

                                                <div class="billingadd">
                                                    <div class="topbillingad">
                                                        <div>
                                                            <p>Billing Address</p>
                                                        </div>
{{--                                                        <input type="hidden" name="address_same" id="address_same">--}}

                                                        <div class="mb-3 unchecked-address" onclick="check_address(1)">

                                                            <label class="chbox2q">
                                                                <i class="fa fa-square-o" aria-hidden="true"></i>&nbsp;same as traveler details
                                                            </label>&nbsp;

                                                        </div>
                                                        <div class="mb-3 checked-address" style="display: none" onclick="check_address(0)">

                                                            <label class="chbox2q">
                                                                <i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;same as traveler details
                                                            </label>

                                                        </div>
                                                    </div>
                                                    <div class="" id="billing-form" style="display: block">

                                                            @csrf
                                                            <input type="hidden" name="address_same" id="address_same">
                                                            <input type="hidden" name="card_holder_name" id="card_holder_name" value="{{auth()->user()->name.' '.auth()->user()->lastname}}">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="firstname" class="form-label">First name</label>
                                                                        <input type="text" class="form-control" name="name" placeholder="First name" id="firstname" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="lastname" class="form-label">Last name</label>
                                                                        <input type="text" class="form-control" name="lastname" placeholder="Last name" id="lastname" required="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">Street Address</label>
                                                                        <input type="text" class="form-control" name="address" placeholder="Street Address" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">Apt, Suite, Building</label>
                                                                        <input type="text" class="form-control" name="address2" placeholder="Apt, Suite, Building" required="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="country_id" class="form-label">Country/Region</label>
                                                                        <select class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country_id" id="country_id" >
                                                                            @foreach($countries as $id => $entry)
                                                                                <option value="{{ $id }}" {{ (old('country_id') ? old('country_id') : $user->country->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">City, State</label>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <select class="form-control select2 {{ $errors->has('state') ? 'is-invalid' : '' }}" name="state_id" id="state_id" >
                                                                                    @foreach($states as $id => $entry)
                                                                                        <option value="{{ $id }}" {{ (old('state_id') ? old('state_id') : $user->state->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id" >
                                                                                    @foreach($cities as $id => $entry)
                                                                                        <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : $user->city->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>

                                                    </div>

                                                </div>
                                            </div>
                                            </form>
                                        </div>
{{--                                        <div class="col-md-12">--}}
{{--                                            <label class="btn btn-default btnrdiocust">--}}
{{--                                                <input type="radio" name="options" />--}}
{{--                                                <div class="readiocustdiv">--}}
{{--                                                    <div>--}}
{{--                                                        <img src="{{asset('assets/front/img/paypallg.svg')}}" />--}}
{{--                                                    </div>--}}
{{--                                                    <div>--}}
{{--                                                        <p>Paypal</p>--}}
{{--                                                        <span>Rhoncus ac id vel diam. Diam et nisi, turpis rhoncus faucibus lacus, egestas imperdiet. </span>--}}
{{--                                                    </div>--}}

{{--                                                </div>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
                                    </div>



                                    <div class="prel mtnab2">
                                        <a href="#"  class="btn_1 pay btngrad btnch2new">Review</a>
                                    </div>
                                </div>
                            </div>

                    </div>

                </div>
                <div class="col-md-4">
                    <div class="pricech1">
                        <div class="priceflex1">
                            <div>
                                <h2>Price Details</h2>
                            </div>
                            <div class="flex22">
                                <img src="{{asset('assets/front/img/usd.svg')}}" />
                                <h4>{{display_currency($order->payment['amount'])}}</h4>
                            </div>
                        </div>
                        <a href="#" class="pay">Review</a>

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        let stripe = Stripe("{{ env('STRIPE_KEY') }}")
        let elements = stripe.elements()
        let style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        }
        let card = elements.create('card', {hidePostalCode: true,style: style})
        card.mount('#card-element')
        let paymentMethod = null
        $('.pay').on('click', function (e) {
            var name='';
            if($('#address_same').val()===0){
                name=$('#firstname').val()+' '+$('#lastname').val();
            }else{
                name=$('.card_holder_name').val();
            }
            $('.pay').attr('disabled', true)
            if (paymentMethod) {
                return true
            }
            stripe.confirmCardSetup(
                "{{ $intent->client_secret }}",
                {
                    payment_method: {
                        card: card,
                        billing_details: {name: name}
                    }
                }
            ).then(function (result) {
                console.log(result);
                if (result.error) {
                    $('#card-errors').text(result.error.message)
                    $('button.pay').removeAttr('disabled')
                } else {
                    paymentMethod = result.setupIntent.payment_method
                    $('.payment-method').val(paymentMethod);
                    $('.card-form').submit()
                }
            })
            return false
        })

        function check_address(show){
            $('.unchecked-address').toggle();
            $('.checked-address').toggle();
            $('#billing-form').toggle('fast');
            $('#address_same').val(show);

        }
        // $(function (){
        //    $('input[name="address_same"]').on('click', function (e){
        //       console.info(e);
        //       console.info(e.target);
        //       console.info($(e.target).attr('checked'));
        //    });
        // });
    </script>
@endsection

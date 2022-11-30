@extends('layouts.front')

@section('styles')
    <style>
        .inputTextCustom{
            display: inline;
            width: 95% !important;
            margin-right: 5px;
        }
    </style>
@endsection
@section('content')
    <div class="hero_in cart_section last">
        <div class="wrapper">
            <div class="container">
                <div class="bs-wizard clearfix">


{{--                    <div class="bs-wizard-step">--}}
{{--                        <div class="text-center bs-wizard-stepnum">Payment</div>--}}
{{--                        <div class="progress">--}}
{{--                            <div class="progress-bar"></div>--}}
{{--                        </div>--}}
{{--                        <a href="checkout.html" class="bs-wizard-dot"></a>--}}
{{--                    </div>--}}

{{--                    <div class="bs-wizard-step active">--}}
{{--                        <div class="text-center bs-wizard-stepnum">Finish!</div>--}}
{{--                        <div class="progress">--}}
{{--                            <div class="progress-bar"></div>--}}
{{--                        </div>--}}
{{--                        <a href="#0" class="bs-wizard-dot"></a>--}}
{{--                    </div>--}}
                </div>
                <!-- End bs-wizard -->
                <div id="confirm">
                    <h4>Order completed!</h4>
                    <p style="color: #fff;">You'll receive a confirmation email at {{auth()->user()->email}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

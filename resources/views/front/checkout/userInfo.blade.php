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
    <div class="checkutpagemain pt125">
        <div class="container contch">
            <div>
                <h1 class="arwsqft"><img src="{{asset('assets/front/img/arrow-square-left.svg')}}" /><a href="{{route('frontend.checkout_review',['step'=>'review','trip'=>$order->trip->id,'room'=>$order->info['room']->id])}}">Go back</a></h1>
            </div>

            <div class="newtxtp1">
                @guest
                    <h1 class="arwsqft"><a href="{{route('login')}}">Sign in to checkout faster </a> <img src="{{asset('assets/front/img/arrow-square-down.svg')}}" />
                </h1>
                @endguest
            </div>

            <div class="">
                <!-- <h3>Delivers: Mon, Aug 30</h3> -->
                <div class="row padding20sec1ch ">


                    <div class="col-md-8">

                        <div class="pad2min">
                            <form name="infoform" id="info_form" method="post" enctype="multipart/form-data" action="{{route('frontend.checkout_info_update')}}" >
                                @csrf
                                <div>
                                    <div class="checkoutcontent2" style="display: block;">
                                        <p>Enter your name and address</p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <!-- <div class="prel">
                                                     <input type="text" class="inputText " required />
                                                     <span class="floating-label">First name</span>
                                                   </div> -->
                                                    <label for="firstname" class="form-label">First name</label>
                                                    <input type="text" class="form-control" placeholder="First name" id="firstname"
                                                           required name="name" value="{{auth()->user()->name??''}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="lastname" class="form-label">Last name</label>
                                                    <input type="text" class="form-control" placeholder="Last name" name="lastname" value="{{auth()->user()->lastname??''}}" id="lastname" required="">
                                                    <!-- <div class="prel">
                                                      <input type="text" class="inputText " required />
                                                      <span class="floating-label">Last name</span>
                                                    </div> -->
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Phone number</label>
                                                    <div class="row">
                                                        <div class="col-4 pr0">
                                                            <select class="form-select formsele br1" name="phone_locale" formsele aria-label="Default select example">
                                                                <option value="+1" >US (+1)</option>
                                                                <option value="+44" >UK (+44)</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-8 pl0">
                                                            <input type="text" class="form-control bl1 pl0" name="phone" value="{{auth()->user()->phone??''}}" placeholder="(555) 000-0000">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3 ">
                                                    <label for="" class="form-label">Street Address</label>
                                                    <input type="text" name="address" class="form-control" placeholder="Street No etc" required value="{{auth()->user()->address??''}}">
{{--                                                    <img src="{{asset('assets/front/img/search22.svg')}}" />--}}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3 ">
                                                    <label for="" class="form-label">Building, House #</label>
                                                    <input type="text" class="form-control" name="address2" placeholder="Street No etc" value="{{auth()->user()->address2??''}}">
{{--                                                    <img src="{{asset('assets/front/img/search22.svg')}}" />--}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3 ">
                                                    <label for="country_id" class="form-label">Country</label>
                                                    <select class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country_id" id="country_id" required>
                                                        @foreach($countries as $id => $entry)
                                                            <option value="{{ $id }}" {{ (old('country_id') ? old('country_id') : auth()->user()->country->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3 ">
                                                    <label for="state_id" class="form-label">State</label>
                                                    <select class="form-control select2 {{ $errors->has('state') ? 'is-invalid' : '' }}" name="state_id" id="state_id" required>
                                                        @foreach($states as $id => $entry)
                                                            <option value="{{ $id }}" {{ (old('state_id') ? old('state_id') : auth()->user()->state->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3 ">
                                                    <label for="city_id" class="form-label">City</label>
                                                    <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id" >
                                                        @foreach($cities as $id => $entry)
                                                            <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : auth()->user()->city->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="mb-3 search222">--}}
{{--                                                    <label for="" class="form-label">Select Travel Agent</label>--}}
{{--                                                    <input type="text" class="form-control" placeholder="Travel Agents">--}}
{{--                                                    <img src="{{asset('assets/front/img/search22.svg')}}" />--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="col-md-6">
                                                <div class="mb-3 room_mate">
                                                    <label for="" class="form-label">Add Roommate</label>
                                                    <input type="text" class="form-control mb-2" name="roommate[]"  placeholder="Roommate Name">
                                                    <!-- <div class="prel">
                                                    <input type="text" class="inputText " required />
                                                    <span class="floating-label">Roommate Name</span>
                                                  </div> -->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3 textcon12">
                                                    <h1 class="arwsqft" onclick="manage_field()"><img src="{{asset('assets/front/img/add-square.svg')}}" /><a>Add Roommate</a></h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="checkoutcontent2" style="display: block; padding-top: 15px;">
                                        @guest
                                        <p>Manage your booking</p>
                                        <div class="createacc">
                                            <h2>Create an account</h2>
                                            <div class="textcheck1">
                                                <h5><img src="{{asset('assets/front/img/check1.svg')}}" /> Earn points for free trips</h5>
                                                <h5><img src="{{asset('assets/front/img/check1.svg')}}" /> Save with Member Prices</h5>
                                                <h5><img src="{{asset('assets/front/img/check1.svg')}}" /> Easily access your itineraries</h5>
                                            </div>
                                        </div>
                                        <div class="createacc">
                                            <h2>Confirmation email</h2>
                                            <h6>Please enter the email address where you would like to receive your confirmation.</h6>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" placeholder="you@company.com" name="email">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3 search222">
                                                    <label class="form-label">Password</label>
                                                    <input type="password" class="form-control" placeholder="Enter your password" name="password" />
                                                    <img src="{{asset('assets/front/img/eye-slash.svg')}}" onclick="view_password(this)"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3 search222">
                                                    <label class="form-label">Confirm Password</label>
                                                    <input type="password" class="form-control" placeholder="Enter your password" name="password_confirmation"/>
                                                    <img src="{{asset('assets/front/img/eye-slash.svg')}}" onclick="view_password(this)"/>
                                                </div>
                                            </div>
                                        </div>
                                        @endguest
                                            <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="chbox2q">
                                                    By creating an account, i agree to Carnival Utopia LLC's <a href="{{route('page_view',['page_name'=>'Terms and Conditions','pID'=>2])}}">Terms and Privacy
                                                        Policy</a>
                                                    <input type="checkbox" name="terms_conditions" value="1" required>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="prel mtnab2">
                                        <button type="submit" class="btn_1  btngrad btnch2new">Continue to payment</button>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>


                    <div class="col-md-4">
                        <div class="pricech1">
                            <div class="priceflex1">
                                <div>
                                    <h2>Price Details</h2>
                                </div>
                                <div class="flex22">
                                    <img src="{{asset('assets/front/img/usd.svg')}}" />
                                    <h4>{{display_currency($payment['amount'])}}</h4>
                                </div>
                            </div>
                            <a href="#" onclick="event.preventDefault();$('#info_form').submit()" >Review</a>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function manage_field(remove=''){
            if(remove!==''){
                $(remove).parent().remove();
                return false;
            }
            var new_fields='<div class="arwsqft"><input type="text" class="form-control inputTextCustom" name="roommate[]"  placeholder="Roommate Name"><a class="button w-25" onclick="manage_field(this)">x</a></div>';
            $('.room_mate').append(new_fields);
        }
        function view_password(btn){
           var field= $(btn).parent().find('input');
           if(field.attr('type')==='password'){
               field.attr('type','text');
           }else{
               field.attr('type','password');
           }
        }
    </script>
@endsection

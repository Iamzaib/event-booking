@extends('layouts.front')
@section('content')
<div class="">
    <div class="container margin_100_35">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 mblscroll">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{!isset(request()->tab)||(isset(request()->tab)&&request()->tab=='profile')?'active ':''}}"
                                id="general-tab" data-bs-toggle="tab" data-bs-target="#general" onclick="history.replaceState('', '', '?tab=profile');"
                                type="button" role="tab" aria-controls="general" aria-selected="true">
                            General
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{isset(request()->tab)&&request()->tab=='trips'?'active ':''}}" onclick="history.replaceState('', '', '?tab=trips');" id="mytrip-tab" data-bs-toggle="tab" data-bs-target="#mytrip" type="button"
                                role="tab" aria-controls="mytrip" aria-selected="true">
                            My Trips
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{isset(request()->tab)&&request()->tab=='payment'?'active ':''}}"  onclick="history.replaceState('', '', '?tab=payment');" id="paymentmethod-tab" data-bs-toggle="tab" data-bs-target="#paymentmethod"
                                type="button" role="tab" aria-controls="paymentmethod" aria-selected="false">
                            Payment
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{isset(request()->tab)&&request()->tab=='favorites'?'active ':''}}" onclick="history.replaceState('', '', '?tab=favorites');" id="Offers-tab" data-bs-toggle="tab" data-bs-target="#Offers" type="button"
                                role="tab" aria-controls="Offers" aria-selected="false">
                            Favorites
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{isset(request()->tab)&&request()->tab=='password'?'active ':''}}" onclick="history.replaceState('', '', '?tab=password');" id="chpass-tab" data-bs-toggle="tab" data-bs-target="#chpass" type="button"
                                role="tab" aria-controls="chpass" aria-selected="false">
                            Change Password
                        </button>
                    </li>
                    <li class="nav-item " role="presentation">
                        <button class="nav-link {{isset(request()->tab)&&request()->tab=='reviews'?'active ':''}}" onclick="history.replaceState('', '', '?tab=reviews');" id="Reviews-tab" data-bs-toggle="tab" data-bs-target="#Reviews" type="button"
                                role="tab" aria-controls="Reviews" aria-selected="false">
                            Reviews
                        </button>
                    </li>

                </ul>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade {{!isset(request()->tab)||(isset(request()->tab)&&request()->tab=='profile')?'active show':''}}" id="general" role="tabpanel" aria-labelledby="general-tab">
                        <div class="generaltabmin">
                            <div class="usercover1">
{{--                                <img class="userblurimg" src="{{$user->profileimage??asset('assets/front/img/profile-placeholder.png')}}" />--}}

                            </div>
                            <form action="{{route('frontend.account.save',['user'=>$user->id])}}" method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="userimgchngr">
                                <img class="userblurimg" id="profileimage" src="{{$user->profileimage?$user->profileimage->getUrl():asset('assets/front/img/profile-placeholder.svg')}}" />
                                <input type="file" id="profileimage-upload" name="profileimage-upload" onchange="readURL(this,'{{$user->profileimage?$user->profileimage->getUrl():asset('assets/front/img/profile-placeholder.svg')}}')" style="visibility: hidden">
                                <div class="editimgbar">
                                    <img src="{{asset('assets/front/img/edit-2.svg')}}" onclick="$('#profileimage-upload').trigger('click'); return false;" />
                                </div>
                                <input type="hidden" name="profileimage" id="finalupload">
                            </div>

                            <div class="genrelform">
                                <h2 class="heading003">Personal Information</h2>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">First name</label>
                                                <input type="text" class="form-control" value="{{$user->name}}" name="name" placeholder="First name"
                                                       id="firstname" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="lastname" class="form-label">Last name</label>
                                                <input type="text" class="form-control" value="{{$user->lastname}}" name="lastname" placeholder="Last name"
                                                       id="lastname" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                                <input type="email" class="form-control" value="{{$user->email}}" name="email" id="exampleInputEmail1"
                                                       placeholder="you@company.com" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="exampleInputphone" class="form-label">Phone</label>
                                                <input type="text" class="form-control" id="exampleInputphone" name="phone" value="{{$user->phone}}"
                                                       placeholder="you@company.com" required>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Gender</label>
                                                <div class="form-check">
                                                    <input class="form-check-input form-check-input2"  type="radio" name="gender"
                                                           id="flexRadioDefault1" value="male" {{$user->gender=='male'?'checked':''}}>
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Male
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input form-check-input2" type="radio" name="gender"
                                                           id="flexRadioDefault2" value="female" {{$user->gender=='female'?'checked':''}}>
                                                    <label class="form-check-label"  for="flexRadioDefault2">
                                                        Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="stad" class="form-label">Street Address</label>
                                                <input type="text" class="form-control" value="{{$user->address}}" name="address" placeholder="Street Address" id="stad" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="stad2" class="form-label">Apt, Suite, Building</label>
                                                <input type="text" class="form-control" value="{{$user->address_2}}" name="address_2" placeholder="Apt, Suite, Building" id="stad2"
                                                       required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="country_id" class="form-label">Country/Region</label>
                                                <select class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country_id" id="country_id" required>
                                                    @foreach($countries as $id => $entry)
                                                        <option value="{{ $id }}" {{ (old('country_id') ? old('country_id') : $user->country->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="cityst" class="form-label">City, State</label>
{{--                                                <input type="text" class="form-control" placeholder="Chhagalnaiya, Feni" id="cityst"--}}
{{--                                                       required>--}}
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <select class="form-control select2 {{ $errors->has('state') ? 'is-invalid' : '' }}" name="state_id" id="state_id" required>
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



                                    <button type="submit" class="btn_1 btngrad btnfull">Save Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade {{isset(request()->tab)&&request()->tab=='trips'?'active show':''}}" id="mytrip" role="tabpanel" aria-labelledby="mytrip-tab">
                        <div class="tripsmaindiv">
                            <h2 class="heading003">My Trips </h2>
                            <div class="row ">
                                @if(count($user->bookingByUserEventBookings)>0)
                                    @foreach($user->bookingByUserEventBookings as $booking)
                                        @if($booking->status!=''&&$booking->booking_payment)
                                        <div class="col-md-12 col-sm-12 col-12" >
                                            <div class="card mb-3 tripsdiv modaltripdetails1show" data-bs-toggle="modal" data-bs-target="#exampleModal{{$booking->id}}">
                                                <div>
                                                    <img src="{{ $booking->booking_event->featured_image?$booking->booking_event->featured_image->getUrl():asset('assets/front/img/tour_1.jpg')}}" class="card-img-top" alt="Trip Image" />
                                                </div>
                                                <div class="card-body">
                                                    <div class="tripsinfo1">
                                                        <h5 class="card-title" >{{$booking->booking_event->event_title}}</h5>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- Button trigger modal -->


                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{$booking->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
{{--                                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>--}}
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card mb-3  " >

                                                                <div class="card-body">
                                                                    <div class="row">
                                                                    <div class="col-5">
                                                                        <div>
                                                                            <img src="{{ $booking->booking_event->featured_image?$booking->booking_event->featured_image->getUrl():asset('assets/front/img/tour_1.jpg')}}" class="card-img-top" alt="Trip Image" />
                                                                        </div>
                                                                    </div>
                                                                        <div class="col-7">
                                                                             <span class="badge
                                                                @if($booking->status=='cancelled') bg-danger
                                                                @elseif($booking->status=='pending-payment') bg-danger
                                                                @else bg-success @endif">
                                                                        {{\App\Models\EventBooking::STATUS_SELECT[$booking->status]}}
                                                                    </span>
                                                                            <div class="tripsinfo1">
                                                                                <h5 class="card-title" >{{$booking->booking_event->event_title}}</h5>
                                                                            </div>
                                                                            <div id="benefitsdescription">
                                                                                <div class="benefitsshowmore1 packde1" onclick="$('.benefitstext1').toggle();">
                                                                                    <span>Show Package Details <i class="fa fa-chevron-down"></i></span>
                                                                                </div>
                                                                                <div class="benefitstext1 benefitsshow1-more-height mt-3" style="display:none;">
                                                                                    <ul class="bullets2 bbbhssgdu">
                                                                                        <li>{{$booking->booking_event->duration-1}} Nights Hotel Accommodation</li>
                                                                                        @if(count($booking->booking_event->tickets)>0)<li>{{count($booking->booking_event->tickets)}} Event Tickets</li>@endif
                                                                                        @foreach($booking->booking_event->amenities_includeds as $amenities_included)
                                                                                            <li>{{$amenities_included->title}}</li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-3 mt-3">
                                                                                <div class="col-6">Total: {{display_currency($booking->booking_payment->amount_total)}}</div>
{{--                                                                                <div class="col-2"></div>--}}
                                                                                <div class="col-6">Balance: {{display_currency($booking->booking_payment->amount_balance)}}</div>
                                                                            </div>
                                                                            @if($booking->booking_payment->amount_balance>0)
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <button class="btn_1  btngrad btnfull" data-bs-toggle="modal" data-bs-target="#paymodel{{$booking->id}}">
                                                                                        Pay Now
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                                @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
{{--                                                        <div class="modal-footer">--}}
{{--                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>--}}
{{--                                                            <button type="button" class="btn btn-primary">Save changes</button>--}}
{{--                                                        </div>--}}
                                                    </div>
                                                </div>
                                            </div>
                                            @if($booking->booking_payment->amount_balance>0)
                                                <div class="modal fade" id="paymodel{{$booking->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                               <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Pay By Card</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card mb-3  " >
                                                                    <form class="card-form" action="{{route('frontend.trip_balance_payment',['payment'=>$booking->booking_payment->id])}}" method="post">
                                                                    @csrf
                                                                        <input type="hidden" name="pay_amount" id="pay_amount">
                                                                    <div class="card-body">
                                                                        <h6 class="p-0">Amount</h6>
                                                                        <div class="tripsdiv">
                                                                        <div class="container">
                                                                        <div class="row pt-2 pb-2 border-bottom-1">
                                                                            <div class="col-6 input-col-custom-padding-05">
                                                                                <input type="radio" name="payment" value="custom"  class="form-check-circle amountradio " id="payradio1">
                                                                                <label for="payradio1">Enter Amount</label>
                                                                            </div>
                                                                            <div class="col-6 input-col-custom-padding-02">
                                                                                <input type="number" step=".01"  name="amount[custom]" max="{{$booking->booking_payment->amount_balance}}" value="{{$booking->booking_payment->amount_balance}}"  class=" form-control " id="amount_custom">
                                                                            </div>
                                                                        </div>
                                                                            <div class="row  pt-2 pb-2 border-bottom-2">
                                                                            <div class="col-6 input-col-custom-padding-05">
                                                                                <input type="radio" name="payment" value="full" checked class="form-check-circle amountradio " id="payradio2">
                                                                                <label for="payradio2">Complete</label>
                                                                            </div>
                                                                            <div class="col-6 input-col-custom-padding-02">
                                                                                <input type="text" name="amount" disabled value="{{$booking->booking_payment->amount_balance}}"  class=" form-control "  id="">
                                                                                <input type="hidden" name="amount[full]" id="amount_full" value="{{$booking->booking_payment->amount_balance}}">
                                                                            </div>
                                                                        </div>
                                                                        </div>
                                                                        </div>
                                                                        <h6 class="pt-3">Payment Method</h6>
                                                                            <div class="tripsdiv">
                                                                        <div class="container mt-2 ">

                                                                            @foreach($paymentMethods as $paymentmethod)
                                                                                <div class="row  pt-2 pb-2 border-bottom-1">
                                                                                    <div class="col-10 input-col-custom-padding-02">
                                                                                        <input type="radio" name="paymentmethod" value="{{$paymentmethod->id}}"  class="form-check-inline payradio " id="payment-method{{$loop->index}}">
                                                                                        <label for="payment-method{{$loop->index}}">{{ucfirst($paymentmethod->card->brand)}} ending in {{$paymentmethod->card->last4}}</label>
                                                                                    </div>
                                                                                    <div class="col-2">
                                                                                        <img src="{{asset('assets/front/img/'.$paymentmethod->card->brand.'.svg')}}" style="width:50px;height: auto;border-radius: 5px" class="imgcdpic" />
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach

                                                                            <div class="row  pt-2 pb-2 border-bottom-2">
                                                                                <a class="p-1" onclick="$('.stripe_form').toggle()"><strong>Add New Card</strong></a>
                                                                                <div class="col-12 stripe_form" style="display: none">
                                                                                    <div id="card-element" class="mt-3 mb-3"></div>
                                                                                    <div id="card-errors" role="alert"></div>
                                                                                    <input type="hidden" name="payment_method" class="payment-method">
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                            </div>
                                                                        <div class="row">
                                                                            <div class="col-9">
                                                                                &nbsp;
                                                                            </div>
                                                                            <div class="col-3">
                                                                                <span>Total: <span id="total_amount_payable">{{display_currency($booking->booking_payment->amount_balance)}}</span></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-6">
                                                                                <button class="cancel btn_1 btn-close-white btnfull">Cancel</button>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <button class="pay btn_1 btngrad btnfull">Pay</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        @endif
                                    @endforeach
                                @endif
{{--                                <div class="col-md-12 col-sm-12 col-12">--}}
{{--                                    <div class="card mb-3 tripsdiv modaltripdetails1show">--}}
{{--                                        <div>--}}
{{--                                            <img src="{{asset('assets/front/img/tour_2.jpg')}}" class="card-img-top" alt="Trip Image" />--}}
{{--                                        </div>--}}
{{--                                        <div class="card-body">--}}
{{--                                            <div class="tripsinfo1">--}}
{{--                                                <h5 class="card-title">Malesuada consequat hac quis commodo vel. Pellentesque.</h5>--}}

{{--                                            </div>--}}

{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                            </div>


                        </div>
                    </div>
                    <div class="tab-pane fade {{isset(request()->tab)&&request()->tab=='payment'?'active show':''}}" id="paymentmethod" role="tabpanel" aria-labelledby="paymentmethod-tab">
                        <div>
{{--                            <div class="alert alert-danger">--}}
{{--                                <i class="fe fe-info me-1"></i> You are near your API--}}
{{--                                limits.--}}
{{--                            </div>--}}
                            <div class="card mt2form2">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <!-- Title -->
                                            <h4 class="card-header-title">Payment methods</h4>
                                        </div>
                                        <div class="col-auto">
                                            <!-- Button -->
                                            <button class="btn_1  btngrad btn-sm btnsm2" href="#" style="font-size: 13px" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#addpayment">
                                                Add new
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- List group -->
                                    <div class="list-group list-group-flush my-n3">
                                        @if(count($paymentMethods)>0)
                                        @foreach($paymentMethods as $paymentmethod)
                                        <div class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <!-- Image -->
                                                    <img class="img-fluid" src="{{asset('assets/front/img/'.$paymentmethod->card->brand.'.svg')}}" alt="..." style="max-width: 38px" />
                                                </div>
                                                <div class="col ms-n2">
                                                    <!-- Heading -->
                                                    <h5 class="headingtbg2">{{ucfirst($paymentmethod->card->brand)}} ending in {{$paymentmethod->card->last4}}</h5>

                                                    <!-- Text -->
                                                    <small class="text-muted">
                                                        Expires {{$paymentmethod->card->exp_month}}/{{$paymentmethod->card->exp_year}}
                                                    </small>
                                                </div>
                                                <div class="col-auto me-n3">
                                                    <!-- Badge -->
                                                    @if($defaultpaymentMethod->id==$paymentmethod->id)
                                                    <span class="badge bglight2"> Default </span>
                                                        @endif
                                                </div>
                                                <div class="col-auto">
                                                    <!-- Dropdown -->
                                                    <div class="dropdown">
                                                        <a class="
                                      dropdown-ellipses dropdown-toggle
                                      colordrop
                                    " href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                           aria-expanded="false">
                                                            <img class="moreverti" src="{{asset('assets/front/img/more-vertical.svg')}}" />
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                                            @if($defaultpaymentMethod->id!=$paymentmethod->id)
                                                            <button class="dropdown-item" onclick="window.location.href='{{route('frontend.account.default_remove_payment',['paymentmethod'=>$paymentmethod->id])}}'">Set as default</button>
                                                          @endif
                                                            <button class="dropdown-item" onclick="window.location.href='{{route('frontend.account.default_remove_payment',['paymentmethod'=>$paymentmethod->id,'type'=>'remove'])}}'">Remove this</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- / .row -->
                                        </div>


                                            @endforeach
                                            @else
                                                <div class="list-group-item">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            No Payment Methods
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="addpayment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                                                                                        <h5 class="modal-title" id="exampleModalLabel">Add Payment Method</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card mb-3 tripsdiv " >

                                                <div class="card-body">
                                                    <h6 class="p-3">Enter your card information</h6>
                                                    <div class="container ">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <form action="{{route('frontend.account.add_payment_method')}}" method="post" id="paymentmethodform">
                                                                <div id="card-element" class="mt-3 mb-3"></div>
                                                                <div id="card-errors" role="alert"></div>
                                                                <input type="hidden" name="payment_method_add" class="payment-method_add">
                                                                    @csrf
                                                                <button class="pay btn_1 btngrad btnfull" data-type="addpayment" data-formid="paymentmethodform">Add Card</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt2form2">
                                <div class="card-header">
                                    <!-- Title -->
                                    <h4 class="card-header-title">Invoices</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-sm table-nowrap card-table">
                                        <thead>
                                        <tr>
                                            <th>Invoice ID</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody class="fs-base">
                                        @foreach($user->payments as $payments_user)
                                            @foreach($payments_user->invoices as $invoice)
                                            <tr>
                                                <td>
                                                    <a href="{{route('frontend.invoice_view',['invoice'=>$invoice->id])}}">Invoice #{{invoice_number($payments_user->id,$invoice->id)}}</a>
                                                </td>
                                                <td>
                                                    <time datetime="{{date('Y-m-d',strtotime($invoice->created_at))}}">{{date('M. d,Y',strtotime($invoice->created_at))}}</time>
                                                </td>
                                                <td>{{display_currency($invoice->payment_done)}}</td>
                                                <td>
                                                    <span class="badge bglight2">{{'Paid'}}</span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade {{isset(request()->tab)&&request()->tab=='favorites'?'active show':''}}" id="Offers" role="tabpanel" aria-labelledby="Offers-tab">
                        <div>
                            <div class="row">
                                <!-- <div class="col-md-3">
                                <img class="imgoff" src="{{asset('assets/front/img/vistaprint_logo_13.png')}}" />
                              </div> -->
                                <div class="col-md-12">
                                    <div class="offersecdiv">
                                        <h2>Favorite Trips</h2>
                                        <p>Your Favorite trips.</p>
{{--                                        <div class="announcement">--}}
{{--                                            <div class="coupon">--}}
{{--                                                <input type="text" value="CODEPEN50" id="couponCode" readonly />--}}
{{--                                                <div class="tooltip">--}}
{{--                                                    <button onclick="myFunction()" class="btnout" onmouseout="outFunc()">--}}
{{--                                                        <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>--}}
{{--                                                        Copy--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}


{{--                                            </div>--}}
{{--                                            <a href="#" class="btn_1 btngrad btnshopoff"> Shop Now</a>--}}
{{--                                        </div>--}}
                                        <div class="row">
                                            @foreach($user->favourite_trips as $featured_trip)
                                            <div class="col-xl-4 col-lg-4 col-md-4">
                                                <div class="box_grid">

                                                    <figure>
                                                        <a href="{{route('frontend.trip_view',['trip_title'=>$featured_trip->event_title,'event'=>$featured_trip->id])}}"><img src="{{ $featured_trip->featured_image?$featured_trip->featured_image->getUrl():asset('assets/front/img/tour_1.jpg')}}" class="img-fluid" alt="" width="800"
                                                                                                                                                                               height="533"></a>
                                                        <div class="tourdivf1">
                                                            {{--                                <div>--}}
                                                            {{--                                    <small><img src="{{ asset('assets/front/img/clock.png')}}" /> 25:26:31</small>--}}
                                                            {{--                                </div>--}}

{{--                                                            <div>--}}
{{--                                                                <img class="favoriteicoimg favourite" data-id="{{$featured_trip->id}}" src="{{ asset('assets/front/img/heart2.svg')}}" />--}}
{{--                                                            </div>--}}
                                                        </div>
                                                    </figure>

                                                    <div class="">
                                                        <a href="{{route('frontend.trip_view',['trip_title'=>$featured_trip->event_title,'event'=>$featured_trip->id])}}" class="titltxt">{{$featured_trip->event_title}}</a>
                                                        <div class="tourdivf2">
                                                            <div>
                                                                <img src="{{ asset('assets/front/img/calendar.svg')}}" />
                                                                <span>{{$featured_trip->duration}} Days</span>
                                                            </div>
                                                            <div>
                                                                <img src="{{ asset('assets/front/img/location.svg')}}" />
                                                                <span>{{$featured_trip->city->city_name}}, {{$featured_trip->country->name}}</span>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade {{isset(request()->tab)&&request()->tab=='password'?'active show':''}}" id="chpass" role="tabpanel" aria-labelledby="chpass-tab">
                        <div>
                            <div class="row justify-content-between align-items-center mb-5">
                                <div class="col-12 col-md-9 col-xl-7">

                                    <!-- Heading -->
                                    <h2 class="mb-2" style="font-size: 20px;     margin-bottom: .375rem!important;">
                                        Change your password
                                    </h2>

                                    <!-- Text -->
                                    <p class="text-muted mb-xl-0" style="font-size: 15px; line-height: 1.5;">
                                        We will email you a confirmation when changing your password, so please expect that email
                                        after
                                        submitting.
                                    </p>

                                </div>
                                <div class="col-12 col-xl-auto">

                                    <!-- Button -->
{{--                                    <button class="btn_1 btngrad">--}}
{{--                                        Forgot your password?--}}
{{--                                    </button>--}}

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 order-md-2">

                                    <!-- Card -->
                                    <div class="card bg-light border ms-md-4 cardmbygu">
                                        <div class="card-body cardpad">

                                            <!-- Text -->
                                            <p class="mb-2">
                                                Password requirements
                                            </p>

                                            <!-- Text -->
                                            <p class="small text-muted mb-2">
                                                To create a new password, you have to meet all of the following requirements:
                                            </p>

                                            <!-- List group -->
                                            <ul class="small text-muted ps-4 mb-0">
                                                <li>
                                                    Minimum 8 character
                                                </li>
                                                <li>
                                                    At least one special character
                                                </li>
                                                <li>
                                                    At least one number
                                                </li>
{{--                                                <li>--}}
{{--                                                    Can’t be the same as a previous password--}}
{{--                                                </li>--}}
                                            </ul>

                                        </div>
                                    </div>

                                </div>
                                <div class="col-12 col-md-6">

                                    <!-- Form -->
                                    <form method="POST" action="{{ route("frontend.profile.password") }}">

{{--                                        <div class="prel">--}}
{{--                                            <input type="password" class="inputText" required />--}}
{{--                                            <span class="floating-label">Current password</span>--}}
{{--                                        </div>--}}
                                        <div class="prel">
                                            <label for="password">New Password</label>
                                            <input type="password" class="inputText"  required name="password" id="password"/>
{{--                                            <span class="floating-label">New password</span>--}}
                                        </div>
                                        <div class="prel">
                                            <label for="password_confirmation">Confirm new password</label>
                                            <input type="password" class="inputText" required  name="password_confirmation" id="password_confirmation"/>
{{--                                            <span class="floating-label">Confirm new password</span>--}}
                                        </div>

                                        <!-- Submit -->
                                        <button class="btn_1 btngrad" type="submit">
                                            Update password
                                        </button>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade {{isset(request()->tab)&&request()->tab=='reviews'?'active show':''}}" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
                        <div>
                            <section id="reviews" class="gduuuuu">

                                <div class="reviews-container">


                                    <div class="reviews-container">
                                    @foreach($user->reviews as $review)
                                        <!-- /review-box -->
                                        <div class="review-box clearfix" style="padding-left: 0px;">

                                            <div class="rev-content">
                                                <div class="rating">
                                                    @for($star=1;$star<=$review->ratings;$star++)
                                                    <img src="{{asset('assets/front/img/star.svg')}}" style="width: 14px; height: 14px">
                                                    @endfor
                                                </div>
                                                <div class="rev-info">{{$user->name}} – {{date('M. d,Y',strtotime($review->review_date))}}:</div>
                                                <div class="rev-text">
                                                    <p>
                                                        {{$review->review_text}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>
                                    <!-- /review-container -->
                                </div>
                            </section>
                            @if(count($user->bookingByUserEventBookings)>0)
                            <div class="add-review">
                                <h5>Leave a Review</h5>
                                <form method="post" action="{{route('frontend.testimonials.store')}}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{auth()->id()}}">
                                    <input type="hidden" name="review_date" value="{{date(config('panel.date_format'))}}">
                                    <div class="row">

                                        <div class="form-group col-md-6">

                                                <label for="trip-event">Select Your Trip</label>
                                                <select name="event_trip_booking_id" id="trip-event" class="form-select" required>
                                                    <option>Select Your Trip</option>
                                                        @foreach($user->bookingByUserEventBookings as $booking)
                                                            <option value="{{$booking->id}}">{{$booking->booking_event->event_title.' ('.date('M. d,Y',strtotime($booking->booking_event->event_start)).')'}}</option>
                                                        @endforeach
                                                </select>
                                        </div>
                                        <div class="form-group col-md-6">

                                                <label for="ratings">Ratings(stars)</label>
                                                <select name="ratings" id="ratings" class="form-select" required style="">
                                                    <option value="1">1 (lowest)</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5" selected>5 (highest)</option>
                                                </select>
{{--                                                <div class="nice-select wide" tabindex="0"><span class="current">Ratting</span>--}}
{{--                                                    <ul class="list">--}}
{{--                                                        <li data-value="1" class="option">1 (lowest)</li>--}}
{{--                                                        <li data-value="2" class="option">2</li>--}}
{{--                                                        <li data-value="3" class="option">3</li>--}}
{{--                                                        <li data-value="4" class="option">4</li>--}}
{{--                                                        <li data-value="5" class="option selected">5 (highest)</li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}

                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                              <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                        style="height: 100px" name="review_text"></textarea>
                                                <label for="floatingTextarea2">Your Review</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 add_top_20">
                                            <input type="submit" value="Submit" class="btn_1  btngrad btngrad" id="submit-review">
                                        </div>
                                    </div>
                                </form>
                            </div>
                                @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- /row -->
    </div>
    <!-- /container -->
</div>
@endsection
@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/card/1.3.1/js/card.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $(".modaltripdetails1show").click(function () {
                $("#modaltripdetails1").modal("show");
            });
        });
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#imagePreview").css(
                        "background-image",
                        "url(" + e.target.result + ")"
                    );
                    $("#imagePreview").hide();
                    $("#imagePreview").fadeIn(650);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function () {
            readURL(this);
        });
    </script>
    <script>
        new Card({
            form: "form",
            formSelectors: {
                numberInput: "input[name=number]",
                expiryInput: "input[name=expiry]",
                cvcInput: "input[name=cvv]",
                nameInput: "input[name=name]",
            },

            width: 390, // optional — default 350px
            formatting: true,

            placeholders: {
                number: "•••• •••• •••• ••••",
                name: "Full Name",
                expiry: "••/••",
                cvc: "•••",
            },
        });
        function readURL(input,profileimg='') {
            var url = input.value;
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#profileimage').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
                var fd = new FormData();
                var files = input.files[0];
                fd.append('file', files);
                fd.append('_token', '{{csrf_token()}}');

                $.ajax({
                    url: '{{ route('frontend.account.storeMedia') }}',
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        console.log(response);
                        if(response.name){
                            $('#finalupload').val(response.name);
                        }
                        // if(response != 0){
                        //     alert('file uploaded');
                        // }
                        // else{
                        //     alert('file not uploaded');
                        // }
                    },
                });
            }else{
                $('#profileimage').attr('src', profileimg);
            }
        }
    </script>

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
        let paymentMethod = null;
        let payment_field=$('.payment-method');
        let payment_form=$('.card-form');
        let amount_type='full';
        $('.payradio').change(function (){
            paymentMethod=$(this).val();
        });
        $('.amountradio').change(function (){
            amount_type=$(this).val();
        });
        $('#amount_custom').change(function (){
            $('#total_amount_payable').html($(this).val());
        });
        let payment_method_only=false;
        $('.pay').on('click', function (e) {
            $(this).html('<img src="{{asset('loading.gif')}}" style="width: 35px;height: 35px;">');
            var name='{{auth()->user()->name.' '.auth()->user()->lastname}}';
            var pay_button=$(this);
            pay_button.attr('disabled', true)
            if(pay_button.data('type')=='addpayment'){
                payment_method_only=true;
                payment_field=$('.payment-method_add');
                payment_form=$('#paymentmethodform');
            }else{
                payment_method_only=false;
                payment_field=$('.payment-method');
                payment_form=$('.card-form');
                $('#pay_amount').val($('#amount_'+amount_type).val());
                console.log($('#pay_amount').val());
            }
            if (paymentMethod&&payment_method_only===false) {
                payment_field.val(paymentMethod);
                payment_form.submit();
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
                    pay_button.removeAttr('disabled');
                    pay_button.html('Add Card');
                } else {
                        paymentMethod = result.setupIntent.payment_method
                        payment_field.val(paymentMethod);
                        payment_form.submit()
                }
            })
            return false
        })
        $( "#amount_custom" ).change(function() {
            var max = parseFloat($(this).attr('max'));
            //var min = parseInt($(this).attr('min'));
            if ($(this).val() > max)
            {
                $(this).val(max);
            }
        });
    </script>
@endsection

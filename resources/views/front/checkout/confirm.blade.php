@extends('layouts.front')

@section('styles')

@endsection
@section('content')

    <div class="checkutpagemain pt125">
        <div class="container contch">
          <div>
            <h1 class="arwsqft"><img src="{{asset('assets/front/img/arrow-square-left.svg')}}" /><a href="./checkout3.html">Go back</a></h1>
          </div>

          <div class="">
            <!-- <h3>Delivers: Mon, Aug 30</h3> -->
            <div class="row padding20sec1ch ">


              <div class="col-md-8">
                <h2 class="h2tard">
Ready to book your trip?<br />
                  Let’s make sure everything’s right.
                </h2>
                <div class="dflexch1">
                  <div>
                    <img class="imgch" src="{{asset('assets/front/img/tour_1.jpg')}}" />
                  </div>

                  <div class="div2xd1">
                    <a href="#" class="titlech">
                      <h4 class="marbot0">{{$order->trip->title}}</h4>
                    </a>
                    <div id="benefitsdescription">
                      <div class="benefitsshowmore packde1">
                        <span>Show Package Details</span> <img src="{{asset('assets/front/img/arrow-square-down.svg')}}" />
                      </div>
                      <div class="benefitstext benefitsshow-more-height">
                        <ul class="bullets2 bbbhssgdu">
                            <li>{{$trip->duration-1}} Nights Hotel Accommodation</li>
                            @if($event_tickets>0)<li>{{$event_tickets}} Event Tickets</li>@endif

                            @foreach($trip->amenities_includeds as $amenities_included)
                                <li>{{$amenities_included->title}}</li>
                            @endforeach
                        </ul>
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
                  <a href="{{route('frontend.checkout_complete')}}">Pay {{display_currency($order->payment['amount'])}}</a>

                </div>
              </div>
            </div>
            <hr />
            <div class="shppingchadd">
              <div class="row">
                <div class="col-lg-4 col-md-4">
                  <div class="dtch1">
                    <h4 class="marbot0">Traveler Details</h4>
                    <a href="./checkout2.html" class="mt10 disblock editdtartyu"><img src="{{asset('assets/front/img/edit-22.svg')}}"
                        style="width: 16px;" /> Edit Details </a>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4">
                  <div class="dtch2">
                    <div class="">
                      <h5 class="marbot0">Details:</h5>
                    </div>
                    <div class="adressinf">

                      <span> Name : {{$order->user->name.' '.$order->user->lastname}}</span>

                      <span>Roomates: @foreach($order->user_details['roommate'] as $index => $roommate){{$roommate['first_name']}},@endforeach</span>
{{--                      <span>Travel Agent : Max Hope</span>--}}
                      <span>{{$order->user->phone}}</span>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4">
                  <div class="dtch3">
                    <div class="">
                      <h5 class="marbot0">Contact information:</h5>
                    </div>
                    <div class="adressinf">
                      <span>{{auth()->user()->email}}</span>
                      <span>{{auth()->user()->phone}}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <hr />
            <div class="shppingchadd">
              <div class="row">
                <div class="col-lg-4 col-md-4">
                  <div class="dtch1">
                    <h4 class="marbot0">Payment Details</h4>
                    <a href="{{route('frontend.checkout_payment')}}" class="mt10 disblock editdtartyu"><img src="{{asset('assets/front/img/edit-22.svg')}}"
                        style="width: 16px;" /> Edit Details </a>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4">
                  <div class="dtch2">
                    <div class="">
                      <h5 class="marbot0">Pay in full with:</h5>
                    </div>
                    <div class="adressinf">
                      <img src="{{asset('assets/front/img/'.$order->payment['methods'][0]->card->brand.'.svg')}}" class="imgcdpic" />
                      <span style="display: inline-block">**** **** **** {{$order->payment['methods'][0]->card->last4}}</span>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4">
                  <div class="dtch3">
                    <div class="">
                      <h5 class="marbot0">Billing Address:</h5>
                    </div>
                    <div class="adressinf">
                      <span>{{$order->info['user']['billing_detail']['name'].' '.$order->info['user']['billing_detail']['lastname']}}</span>
                      <span>{{$order->info['user']['billing_detail']['address']}}</span>
                      <span>{{$order->info['user']['billing_detail']['address_2']}}</span>
                      <span>{{$order->info['user']['billing_detail']['city_id']}}, {{$order->info['user']['billing_detail']['state_id']}}, {{$order->info['user']['billing_detail']['country_id']}}</span>
{{--                      <span>•• ••••••22</span>--}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <hr />
            <div class="shppingchadd termaconddiv">
              <div class="row">
                <div class="col-md-12">
                  <div class="dtch1">
                    <h4 class="">Terms & Conditions</h4>
                    <div class="mb-3 ">
                      <p>Before you continue, please be advised that by clicking on the “PAY” button below, you are
                        agreeing to and accepting the following terms:
                      </p>
                      <ul>
                        <li>Our customer terms of service located <a
                            href="https://carnivalutopia.com/terms-and-conditions">https://carnivalutopia.com/terms-and-conditions</a>
                        </li>
                        <li>Our customer participation agreement located <a
                            href="https://carnivalutopia.com/customer-participation-agreement/">https://carnivalutopia.com/customer-participation-agreement/</a>
                        </li>
                        <li>Deposits and payments are NON REFUNDABLE!</li>
                        <li>If you are booking your accommodation as part of a group, and members of your group drop out
or cancel, the remaining members of the group are responsible for the total cost of the
                          accommodation/room. The total cost of your reservation will automatically change.</li>
                        <li>Mas band section and size information CANNOT be changed after your choices have been
                          submitted to the band without an increase in cost to you.</li>
                        <li>J'ouvert band and size information CANNOT be changed after your choices have been submitted
                          to the band without an increase in cost to you.</li>
                        <li>Your event/fete list CANNOT be changed after tickets have been purchased for you without an
                          increase in cost to you.</li>
                        <li>The cost of your reservation is subject to change when prices are released by the hotel, mas
                          band, J'ouvert band and event promoters/organizers.</li>

                      </ul>
                      <p>
                        If you DO NOT agree with any of the above, please close your browser tab or navigate away from
                        this page. If you have any questions about the registration process, please email us at <a
                          href="mailto:info@carnivalutopia.com">info@carnivalutopia.com</a> with the subject line
                        “REGISTRATION ISSUE”.
                      </p>

                      <a href="{{route('frontend.checkout_complete')}}" class="bigbtn btn_1  btngrad  btnpayment ">Pay {{display_currency($order->payment['amount'])}} <i class="fa fa-lock"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

@endsection
@section('scripts')
@endsection

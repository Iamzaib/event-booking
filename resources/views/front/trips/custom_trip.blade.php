@extends('layouts.front')

@section('styles')
@endsection
@section('content')
    <div class="checkutpagemain">
        <div class="container contch">
            <div class="checkout1box custrip1">
                <h1 class="arwsqft"><img src="{{asset('assets/front/img/arrow-square-left.svg')}}" /><a href="./tour-detail.html">Go back</a></h1>
                <h2>Create your custom trip.</h2>
            </div>

            <div class="row padding20sec1ch">


                <div class="col-md-8">

                    <img src="{{asset('assets/front/img/tour2.png')}}" class="tourimg1ct" />
                    <div class="cb1sbt2">
                        <div>
                            <h4 class="marbot0 texthead22">{{$trip->event_title}}</h4>
                        </div>
                        <div>
                            <h4 class="marbot0 texthead22">{{display_currency($trip->daily_price*$trip->duration)}}</h4>
                        </div>
                    </div>
                    <div class="cb1sbt6">
                        <div id="benefitsdescription">
                            <div class="benefitsshowmore packde1">
                                <span>Show Package Details</span> <img src="{{asset('assets/front/img/arrow-square-down-light.svg')}}" />
                            </div>
                            <div class="benefitstext benefitsshow-more-height">
                                <ul class="bullets2 bbbhssgdu">
                                    <li>6 Nights Hotel Accommodation</li>
                                    <li>5 Event Tlckets</li>
                                    <li>Backline Costume</li>
                                    <li>Airport and Event Transfers</li>
                                    <li>Professional Photographer</li>
                                    <li>Costume Pickup & Delivery</li>
                                    <li>Personal Concierge</li>
                                    <li>Welcome Bag</li>
                                </ul>
                            </div>
                        </div>

                    </div>

                    <div class="cb1sbt7">
                        <div>
                            <h2>Travel From</h2>
                            <button>
                                <img src="{{asset('assets/front/img/calendar2.svg')}}" />
                                Pick a Date
                            </button>
                        </div>
                        <div>
                            <h2>Travel To</h2>
                            <button>
                                <img src="{{asset('assets/front/img/calendar2.svg')}}" />
                                Pick a Date
                            </button>
                        </div>
                    </div>

                    <div class="custrip2">
                        <h3 class="texthead22">Choose your Accomodation</h3>
                        <p>Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus </p>
                        <div class="row">
                            @foreach($trip->hotels as $hotel)
                            <div class="col-md-6">
                                <div class="choosepaymemyrad">
                                    <input type="radio" id="hotel{{$hotel->id}}" name="Accomodation">
                                    <label for="hotel{{$hotel->id}}">
                                        <div class="boxchlabl text-center border0 ">
                                            <h3 class="marbot0"><b>{{$hotel->hotel_name}}</b></h3>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                            <div class="col-md-6">
                                <div class="choosepaymemyrad">
                                    <input type="radio" id="hotel0" name="Accomodation" checked>
                                    <label for="hotel0">
                                        <div class="boxchlabl text-center border0 ">
                                            <h3 class="marbot0"><b>No Accomodation</b></h3>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="custrip2" id="room-selection">

                        <h3 class="texthead22">Choose your Room</h3>
                        <p>Lectus amet, sed et imperdiet. Varius id nam sem purus sed vel. Adipiscing sapien praesent bibendum non. Dui lectus in elit magna malesuada. Nulla arcu sapien gravida amet. Suscipit urna nunc amet enim et. Nunc consequat egestas. </p>
                        <div class="row">
                            @foreach($trip->hotels as $hotel)
                                @foreach($hotel->rooms as $room)
                            <div class="col-md-6" data-hotel="{{$hotel->id}}">
                                <div class="choosepaymemyrad">
                                    <input type="radio" id="room{{$room->id}}" name="room">
                                    <label for="room{{$room->id}}">
                                        <div class="boxchlabl border0 ">
                                            <h3 class="marbot0"><b>{{$room->room_title}}</b></h3>
                                            <p>
                                                {{$room->details}}
                                            </p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                                @endforeach
                           @endforeach

{{--                            <div class="col-md-6">--}}
{{--                                <div class="choosepaymemyrad">--}}
{{--                                    <input type="radio" id="room2" name="room" checked>--}}
{{--                                    <label for="room2">--}}
{{--                                        <div class="boxchlabl border0 ">--}}
{{--                                            <h3 class="marbot0"><b>Two Bedroom Suite</b></h3>--}}
{{--                                            <p>Room, 2 Queen Beds, Sleeps 4</p>--}}
{{--                                        </div>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>

                    </div>
                    <div class="custrip2">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <h3 class="texthead22">Choose your Occupancy</h3>
                                <p>Lectus amet, sed et imperdiet. Varius id nam sem purus sed vel. Adipiscing sapien praesent bibendum non.</p>
                            </div>
                            <div class="col-md-5 juniorsuit marbotmd">
                                <div class="dflexch1 bavgfh">
                                    <div>
                                        <p class="marbot0 ">Junior Suite</p>
                                    </div>
                                    <div class="chadch1">
                                        <button type="button" class="minusadults btncoubtnt">
                                            <img src="{{asset('assets/front/img/minus-circle (1).svg')}}" />
                                        </button>
                                        <input type="text" id="inputadults1" min="1" max="14" tabindex="-1" class="inputnums" value="2"
                                               readonly />
                                        <button type="button" class="plusadults btncoubtnt">
                                            <img src="{{asset('assets/front/img/plus-circle (1).svg')}}" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="custrip2">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <h3 class="texthead22">Choose your Gender</h3>
                                <p>Lectus amet, sed et imperdiet. Varius id nam sem purus sed vel. Adipiscing sapien praesent bibendum </p>
                            </div>
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="choosepaymemyrad">
                                            <input type="radio" id="gender1" name="gender" value="female" checked>
                                            <label for="gender1" class="marbot0 marbotmd">
                                                <div class="boxchlabl text-center border0 ">
                                                    <h3 class="marbot0"><b>Female</b></h3>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="choosepaymemyrad">
                                            <input type="radio" id="gender2" name="gender"  value="male">
                                            <label for="gender2" class="marbot0 marbotmd">
                                                <div class="boxchlabl text-center border0 ">
                                                    <h3 class="marbot0"><b>Male</b></h3>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    @if(count($trip->costumes)>0)
                    <div class="custrip2">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <h3 class="texthead22">Choose your Costume</h3>
                                <p>Lectus amet, sed et imperdiet. Varius id nam sem purus sed vel. Adipiscing sapien praesent bibendum </p>
                            </div>
                            <div class="col-md-5">
                                <!-- <div class="kravemd marbotmd">
                                  <p>KRAVE Frontline</p>
                                  <img src="{{asset('assets/front/img/arrow-square-down-light.svg')}}" />
                                </div> -->
                                <div>
                                    <select class="form-select" formsele="" name="costume" aria-label="Default select example">
                                        @foreach($trip->costumes as $costume)
                                        <option value="{{$costume->id}}" selected="">{{$costume->costume_title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>
                    @endif
                    <div class="custrip2">
                        <h3 class="texthead22">Choose your Event Tickets</h3>
                        <p>Lectus amet, sed et imperdiet. Varius id nam sem purus sed vel. Adipiscing sapien praesent bibendum non.</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="choosepaymemyrad">
                                    <input type="checkbox" id="event1" name="event1" checked>
                                    <label for="event1">
                                        <div class="boxchlabl priceflex1 border0 ">
                                            <div>
                                                <h3 class="marbot0" style="line-height: 22px;"><b>Fyah D Wuk</b></h3>
                                            </div>
                                            <div>
                                                <span class="smaltxt2">WED JUL 28</span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="choosepaymemyrad">
                                    <input type="checkbox" id="event2" name="event2" checked>
                                    <label for="event2">
                                        <div class="boxchlabl priceflex1 border0 ">
                                            <div>
                                                <h3 class="marbot0" style="line-height: 22px;"><b>Rise Barbados*</b></h3>
                                            </div>
                                            <div>
                                                <span class="smaltxt2">WED JUL 28</span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="choosepaymemyrad">
                                    <input type="checkbox" id="event3" name="event3">
                                    <label for="event3">
                                        <div class="boxchlabl priceflex1 border0 ">
                                            <div>
                                                <h3 class="marbot0" style="line-height: 22px;"><b> Lifted Cooler Experience*</b></h3>
                                            </div>
                                            <div>
                                                <span class="smaltxt2">WED JUL 28</span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="choosepaymemyrad">
                                    <input type="checkbox" id="event4" name="event4">
                                    <label for="event4">
                                        <div class="boxchlabl priceflex1 border0 ">
                                            <div>
                                                <h3 class="marbot0" style="line-height: 22px;"><b>Candy Coated Cruise</b></h3>
                                            </div>
                                            <div>
                                                <span class="smaltxt2">WED JUL 28</span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="choosepaymemyrad">
                                    <input type="checkbox" id="event5" name="event5">
                                    <label for="event5">
                                        <div class="boxchlabl priceflex1 border0 ">
                                            <div>
                                                <h3 class="marbot0" style="line-height: 22px;"><b>Mimosa Ultra Breakfast Party*</b></h3>
                                            </div>
                                            <div>
                                                <span class="smaltxt2">WED JUL 28</span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="choosepaymemyrad">
                                    <input type="checkbox" id="event6" name="event6">
                                    <label for="event6">
                                        <div class="boxchlabl priceflex1 border0 ">
                                            <div>
                                                <h3 class="marbot0" style="line-height: 22px;"><b>Limerz Cruise*</b></h3>
                                            </div>
                                            <div>
                                                <span class="smaltxt2">WED JUL 28</span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="choosepaymemyrad">
                                    <input type="checkbox" id="event7" name="event7">
                                    <label for="event7">
                                        <div class="boxchlabl priceflex1 border0 ">
                                            <div>
                                                <h3 class="marbot0" style="line-height: 22px;"><b>Mimosa Ultra Breakfast Party*</b></h3>
                                            </div>
                                            <div>
                                                <span class="smaltxt2">WED JUL 28</span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="choosepaymemyrad">
                                    <input type="checkbox" id="event8" name="event8">
                                    <label for="event8">
                                        <div class="boxchlabl priceflex1 border0 ">
                                            <div>
                                                <h3 class="marbot0" style="line-height: 22px;"><b>Limerz Cruise*</b></h3>
                                            </div>
                                            <div>
                                                <span class="smaltxt2">WED JUL 28</span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>


                        </div>

                    </div>

                    <div class="custrip2">
                        <h3 class="texthead22">Choose any Additional Services</h3>
                        <p>Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus </p>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="choosepaymemyrad">
                                    <input type="radio" id="service1" name="service">
                                    <label for="service1">
                                        <div class="boxchlabl text-center border0 ">
                                            <h3 class="marbot0"><b>Make Up</b></h3>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="choosepaymemyrad">
                                    <input type="radio" id="service2" name="service" checked>
                                    <label for="service2">
                                        <div class="boxchlabl text-center border0 ">
                                            <h3 class="marbot0"><b>Island Tour</b></h3>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="choosepaymemyrad">
                                    <input type="radio" id="service3" name="service">
                                    <label for="service3">
                                        <div class="boxchlabl text-center border0 ">
                                            <h3 class="marbot0"><b>Fast Track Arrival Service</b></h3>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="custrip2">
                        <div class="row">
                            <h3 class="texthead22">Choose a payment option.</h3>

                            <div class="col-md-6">
                                <div class="choosepaymemyrad">
                                    <input type="radio" id="pay1" name="radio">
                                    <label for="pay1">

                                        <div class="boxchlabl">
                                            <h3>Deposit + Monthly Installments</h3>
                                            <h3><b>$500 Deposit + $425 for 4 Months</b></h3>
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

                                    <input type="radio" id="pay2" name="radio">
                                    <label for="pay2">

                                        <div class="boxchlabl">
                                            <h3>Pay in full</h3>
                                            <h3><b>$2540.08</b></h3>
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
                    </div>
                    <div class="custrip2">
                        <div class="checkoutcontent2" style="display: block; padding-bottom: 15px;">
                            <h4 class="texthead22" style="margin: 20px 0;">Travel Details</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <!-- <label for="firstname" class="form-label">First name</label>
                                        <input type="text" class="form-control" placeholder="First name" id="firstname" required=""> -->
                                        <div class="prel">
                                            <input type="text" class="inputText " required />
                                            <span class="floating-label">First name</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <!-- <label for="lastname" class="form-label">Last name</label>
                                        <input type="text" class="form-control" placeholder="Last name" id="lastname" required=""> -->
                                        <div class="prel">
                                            <input type="text" class="inputText " required />
                                            <span class="floating-label">Last name</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Phone number</label>
                                        <div class="row phonetxtcols">
                                            <div class="col-3 col-md-3 pr0">
                                                <select class="form-select formsele br1" formsele="" aria-label="Default select example">
                                                    <option value="US" selected="">US</option>
                                                    <option value="UK" selected="">UK</option>
                                                </select>
                                            </div>
                                            <div class="col-9 col-md-9 pl0">
                                                <input type="text" class="form-control bl1 pl0" placeholder="+1 (555) 000-0000">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 search222">
                                        <label for="" class="form-label">Select Travel Agent</label>
                                        <input type="text" class="form-control" placeholder="Travel Agents">
                                        <img src="{{asset('assets/front/img/search22.svg')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 ">
                                        <!-- <label for="" class="form-label">Add Roommate</label>
                                        <input type="text" class="form-control" placeholder="Roommate Name"> -->
                                        <div class="prel">
                                            <input type="text" class="inputText " required />
                                            <span class="floating-label">Roommate Name</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 textcon12">
                                        <h1 class="arwsqft"><img src="{{asset('assets/front/img/add-square.svg')}}"><a>Add Roommate</a></h1>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="custrip2 border0">
                        <div class="checkoutcontent2" style="display: block; padding-bottom: 15px;">
                            <h4 class="texthead22" style="margin: 20px 0;">What’s your contact information?</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="EmailAddress" class="form-label">Email Address</label>
                                        <input type="text" class="form-control" placeholder="Email Address" id="EmailAddress" >
                                        <!-- <div class="prel">
                                          <input type="text" class="inputText " required />
                                          <span class="floating-label">Email Address</span>
                                        </div> -->
                                        <p class="ptag22">
                                            We’ll email you a receipt and send order updates to your mobile phone via SMS or iMessage.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Phone number</label>
                                        <div class="row">
                                            <div class="col-4 pr0">
                                                <select class="form-select formsele br1 marbot0" formsele="" aria-label="Default select example">
                                                    <option value="US" selected="">US</option>
                                                    <option value="UK" selected="">UK</option>
                                                </select>
                                            </div>
                                            <div class="col-8 pl0">
                                                <input type="text" class="form-control bl1 pl0" placeholder="+1 (555) 000-0000">
                                            </div>
                                        </div>
                                        <p class="ptag22">
                                            The phone number you enter can’t be changed after you place your order, so please make sure it’s correct.
                                        </p>
                                    </div>
                                </div>

                                <a href="#" class="btn_1  btngrad btnch2new">Continue to payment</a>



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
                                    <p>$2504</p>
                                </div>
                            </div>
                            <div class="priceflex1">
                                <div>
                                    <p>Trip Saving</p>
                                </div>
                                <div>
                                    <p style="color: #039855 !important;">-$2.96</p>
                                </div>
                            </div>
                            <div class="priceflex1">
                                <div>
                                    <p>Coupon (SAVE20)</p>
                                </div>
                                <div>
                                    <p  style="color: #039855 !important;">-$10.96</p>
                                </div>
                            </div>
                        </div>
                        <div class="mainmaxprice">
                            <div class="priceflex1">
                                <div>
                                    <p>Subtotal</p>
                                </div>
                                <div>
                                    <p><b>$2,490.08</b></p>
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
                                    <p >$50.00</p>
                                </div>
                            </div>

                        </div>

                        <div class="priceflex1">
                            <div>
                                <p>Total</p>
                            </div>
                            <div class="flex22">
                                <img src="{{asset('assets/front/img/usd.svg')}}" />
                                <h4>$2,540.08</h4>
                            </div>
                        </div>
                        <a href="./checkout2.html">Proceed to checkout</a>

                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
@section('scripts')
@endsection

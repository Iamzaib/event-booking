@extends('layouts.front')

@section('styles')
@endsection
@section('content')
    <div class="checkutpagemain">
        <div class="container contch">
            <div class="checkout1box custrip1">
                <h1 class="arwsqft"><img src="{{asset('assets/front/img/arrow-square-left.svg')}}" /><a href="{{route('trips')}}">Go back</a></h1>
                <h2>Create your custom trip.</h2>
            </div>

            <div class="row padding20sec1ch">
                <div class="row">
                    <div class="col-md-8">

                        <img src="{{asset('assets/front/img/tour2.png')}}" class="tourimg1ct" />
                        <div class="cb1sbt2">
                            <div>
                                <h4 class="marbot0 texthead22">{{$trip->event_title}}</h4>
                            </div>
                            <div>
                                <h4 class="marbot0 texthead22"><sup>Starting From</sup>&nbsp;<span id="starting_top" style="font-size: 20px"> {{display_currency(\Illuminate\Support\Arr::first($range)['price'])}}</span></h4>
                            </div>
                        </div>
                        <div class="cb1sbt6">
                            <div id="benefitsdescription">
                                <div class="benefitsshowmore packde1">
                                    <span>Show Package Details</span> <img src="{{asset('assets/front/img/arrow-square-down-light.svg')}}" />
                                </div>
                                <div class="benefitstext benefitsshow-more-height">
                                    <ul class="bullets2 bbbhssgdu">
                                        <li>{{$trip->duration-1}} Nights Hotel Accommodation</li>
                                        @if(count($trip->tickets)>0)<li>{{count($trip->tickets)}} Event Tickets</li>@endif

                                        @foreach($trip->amenities_includeds as $amenities_included)
                                            <li>{{$amenities_included->title}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="custrip2">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h3 class="texthead22">Total Travelers </h3>
                                    <p>You will be provided costume options when become available</p>
                                </div>
                                <div class="col-md-6">
                                <!-- <div class="kravemd marbotmd">
                                  <p>KRAVE Frontline</p>
                                  <img src="{{asset('assets/front/img/arrow-square-down-light.svg')}}" />
                                </div> -->
                                    <div>
                                        <form action="{{request()->url()}}" method="get">
                                            <select class="form-select" formsele="" name="travelers" onchange="window.location='{{request()->fullUrlWithQuery(['travelers'=>'trvlr'])}}'.replace('trvlr',this.value)" aria-label="Default select example">
                                                <option value="">Choose No. of Travelers</option>
                                                @for($i=1;$i<=10;$i++)
                                                    <option value="{{$i}}" {{$i==$travelers?'selected':''}}>{{$i}} Person(s)</option>
                                                @endfor
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            {{--                        <div>--}}

                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Choose Your Dates</h5>
                                </div>
                                @foreach($range as $index => $date_range)
                                    <div class="col-md-6">
                                        <div class="choosepaymemyrad">
                                            <input type="radio" id="range{{$index}}" class="date_range"  name="range" value="{{$date_range['date']}}%{{$date_range['price']}}">
                                            <label for="range{{$index}}">
                                                <div class="boxchlabl border0 ">
                                                    <p><img src="{{asset('assets/front/img/calendar2.svg')}}"/>Date</p>
                                                    <h3 class="marbot0 mt-2"><b>{{$date_range['date']}}</b></h3>
                                                    <h3 class="marbot0 mt-2 text-right" style="text-align: right"><sup>Starting From</sup>&nbsp;<b>{{display_currency($date_range['price'])}}</b></h3>
                                                    {{--                                                <p>Room, 2 Queen Beds, Sleeps 4</p>--}}
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                        <div class="custrip2">
                            <h3 class="texthead22">Choose your Accommodation</h3>
                            <p>Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus </p>
                            <div class="row">
                                @foreach($trip->hotels as $hotel)
                                    <div class="col-md-12">
                                        <div class="card" style="border: 1px solid #ced4da;border-radius: 6px">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-6"><strong>{{$hotel->hotel_name}}</strong></div>
                                                    <div class="col-6 text-center">No. of Person</div>
                                                </div>

                                            </div>
                                            <div class="card-body">
                                                <div class="row mt-3 pl-3 pr-3" style="    padding: 0 1rem;    border-bottom: 1px solid #ced4da;    margin: 0.1rem;">
                                                    <div class="col-6">
                                                        <h6><b>*No Accommodation</b></h6>
                                                        <p>
                                                            Number of travellers in your group if you have your own accommodation.
                                                        </p>
                                                    </div>
                                                    <div class="col-6">
                                                        <select name="room_persons[0]" class="form-control" data-roomprice="0" onchange="" id="">
                                                            <option value="0">--Please Select--</option>
                                                            @for($i=1;$i<=$travelers;$i++)
                                                                <option value="{{$i}}">{{$i}} Person(s)</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <hr style="margin:5px;background-color:#ced4da">
                                                </div>
                                                @foreach($hotel->rooms as $room)
                                                    <div class="row mt-3 pl-3 pr-3"  style="    padding: 0 1rem;    border-bottom: 1px solid #ced4da;    margin: 0.1rem;">
                                                        <div class="col-6">
                                                            <h6><b>{{$room->room_title}}</b></h6>
                                                            <p>
                                                                {{$room->details}}
                                                            </p>
                                                        </div>
                                                        <div class="col-6">
                                                            <select name="room_persons[{{$room->id}}]" class="form-control room" data-id="{{$room->id}}" data-roomprice="{{$room->room_price}}" id="">
                                                                <option value="0">--Please Select--</option>
                                                                @for($i=1;$i<=($room->room_capacity>$travelers?$travelers:$room->room_capacity);$i++)
                                                                    <option value="{{$i}}">{{$i}} Person(s)</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        {!! !$loop->last?'<hr style="margin:5px;background-color:#ced4da">':''!!}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                        @for($t=1;$t<=$travelers;$t++)
                            @if(count($trip->costumes)>0)
                                <div class="custrip2">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <h3 class="texthead22">Choose your Costume: Traveler {{$t}} </h3>
                                            <p>You will be provided costume options when become available</p>
                                        </div>
                                        <div class="col-md-6">
                                        <!-- <div class="kravemd marbotmd">
                                  <p>KRAVE Frontline</p>
                                  <img src="{{asset('assets/front/img/arrow-square-down-light.svg')}}" />
                                </div> -->
                                            <div>
                                                <select class="form-select costume" formsele="" name="costume[{{$t}}]"  data-traveler="{{$t}}"  aria-label="Default select example">
                                                    <option value="0">Choose Costume</option>
                                                    @foreach($trip->costumes as $costume)
                                                        <option value="{{$costume->id}}" >{{$costume->costume_title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @foreach($trip->costumes as $costume)
                                            @foreach($costume->options as $option)
                                                <div class="col-md-6 costume_options_{{$t}}{{$costume->id}} costume_options" style="display: none">
                                                    <label for="option_{{$option->id}}">
                                                        {{$option->title}}  &nbsp;</label>
                                                    @if($option->values!='')
                                                        <select class="form-select" name="costume_option[{{$t}}][{{$costume->id}}][{{$option->id}}]" id="option_{{$option->id}}">
                                                            <option value="">Select {{$option->title}} type</option>
                                                            @foreach(explode(',',$option->values) as $value)
                                                                <option value="{{$value}}">{{$value}}</option>
                                                            @endforeach
                                                        </select>
                                                    @else
                                                        <input type="text" class="form-control" name="costume_option[{{$t}}][{{$costume->id}}][{{$option->id}}]" id="option_{{$option->id}}" placeholder="Please Enter {{$option->title}}">
                                                    @endif

                                                </div>
                                            @endforeach
                                        @endforeach
                                    </div>


                                </div>
                            @endif
                            @if(count($trip->tickets)>0)
                                <div class="custrip2">
                                    <h3 class="texthead22">Choose your Event Tickets: Traveler {{$t}}</h3>
                                    <p>Lectus amet, sed et imperdiet. Varius id nam sem purus sed vel. Adipiscing sapien praesent bibendum non.</p>
                                    <div class="row">
                                        @foreach($trip->tickets as $ticket)
                                            <div class="col-md-6">
                                                <div class="choosepaymemyrad">
                                                    <input type="checkbox" id="ticket_{{$t}}{{$ticket->id}}" class="ticket" name="ticket[{{$t}}][{{$ticket->id}}]" data-traveler="{{$t}}" value="{{$ticket->id}}" data-ticketprice="{{$ticket->ticket_price}}">
                                                    <label for="ticket_{{$t}}{{$ticket->id}}">
                                                        <div class="boxchlabl priceflex1 border0 ">
                                                            <div>
                                                                <h3 class="marbot0" style="line-height: 22px;"><b>{{$ticket->ticket_title}}</b></h3>
                                                            </div>
                                                            <div>
                                                                <span class="smaltxt2">{{date('l M d',strtotime($ticket->ticket_date))}}</span>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            @endif

                            @if(count($trip->addons)>0&&$t==1)
                                <div class="custrip2">
                                    <h3 class="texthead22">Choose any Additional Services</h3>
                                    <p>Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus </p>
                                    <div class="row">
                                        @foreach($trip->addons as $addon)
                                            <div class="col-md-4">
                                                <div class="choosepaymemyrad">
                                                    <input type="checkbox" id="addon_{{$addon->id}}" class="addons" name="addon[{{$addon->id}}]" value="{{$addon->id}}" data-addonprice="{{$addon->addon_price}}">
                                                    <label for="addon_{{$addon->id}}" class="text-center">
                                                        <div class="boxchlabl priceflex1 d-block border0 ">
                                                            <div class="text-center">
                                                                <h3 class="marbot0 text-center" style="line-height: 22px;"><b>{{$addon->addon_title}}</b></h3>
                                                            </div>
                                                            {{--                                            <div>--}}
                                                            {{--                                                <span class="smaltxt2">{{date('l M d',strtotime($ticket->ticket_date))}}</span>--}}
                                                            {{--                                            </div>--}}
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            @endif
                        @endfor
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

                        <div class="container no-gutters">

                            <div class="row no-gutters">
                                <div class="col-md-12">
                                    <h4 class="texthead22" style="margin: 20px 0;">Travel Details</h4>
                                </div>
                                @for($t=1;$t<=$travelers;$t++)
                                    <div class="col-md-12">
                                        <div class="card" style="border: 1px solid #ced4da;border-radius: 6px">
                                            <div class="card-header">
                                                <h6 class="" style="margin: 20px 0;">Traveler {{$t}}</h6>
                                            </div>
                                            <div class="card-body p-3">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <!-- <label for="firstname" class="form-label">First name</label>
                                                            <input type="text" class="form-control" placeholder="First name" id="firstname" required=""> -->
                                                            <div class="prel">
                                                                <input type="text" class="inputText " required name="first_name[{{$t}}]" />
                                                                <span class="floating-label">First name</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <!-- <label for="lastname" class="form-label">Last name</label>
                                                            <input type="text" class="form-control" placeholder="Last name" id="lastname" required=""> -->
                                                            <div class="prel">
                                                                <input type="text" class="inputText " required name="last_name[{{$t}}]" />
                                                                <span class="floating-label">Last name</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Phone number</label>
                                                            <input type="text" class="form-control " name="phone[{{$t}}]" placeholder="+1 (555) 000-0000">
                                                            <input type="hidden" name="phone_locale" value="{{auth()->user()->country->short_code}}">
                                                            {{--                                                        <div class="row phonetxtcols">--}}
                                                            {{--                                                            <div class="col-3 col-md-3 pr0">--}}
                                                            {{--                                                                <select class="form-select formsele br1" formsele="" aria-label="Default select example">--}}
                                                            {{--                                                                    <option value="US" selected="">US</option>--}}
                                                            {{--                                                                    <option value="UK" selected="">UK</option>--}}
                                                            {{--                                                                </select>--}}
                                                            {{--                                                            </div>--}}
                                                            {{--                                                            <div class="col-9 col-md-9 pl0">--}}
                                                            {{--                                                                --}}
                                                            {{--                                                            </div>--}}
                                                            {{--                                                        </div>--}}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="EmailAddress" class="form-label">Email Address</label>
                                                            <input type="email" class="form-control" placeholder="Email Address" id="EmailAddress" name="email[{{$t}}]">
                                                            <!-- <div class="prel">
                                                              <input type="text" class="inputText " required />
                                                              <span class="floating-label">Email Address</span>
                                                            </div> -->
                                                            {{--                                                        <p class="ptag22">--}}
                                                            {{--                                                            We’ll email you a receipt and send order updates to your mobile phone via SMS or iMessage.--}}
                                                            {{--                                                        </p>--}}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label>{{ trans('cruds.user.fields.gender') }}</label>
                                                            @foreach(App\Models\User::GENDER_RADIO as $key => $label)
                                                                <div class="form-check {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                                                                    <input class="form-check-input" type="radio" id="gender_{{ $key }}" name="gender[{{$t}}]" value="{{ $key }}" >
                                                                    <label class="form-check-label" for="gender_{{ $key }}">{{ $label }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="shirt_size{{$t}}">Shirt Size</label>
                                                            <select name="shirt_size[{{$t}}]" class="form-select"  onchange="" id="shirt_size{{$t}}">
                                                                <option value="0">--Please Select--</option>
                                                                @for($i=10;$i<=30;$i++)
                                                                    <option value="{{$i}}">{{$i}} </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            {{--                                                        <div class="prel">--}}
                                                            <label for="Notes{{$t}}">Notes</label>
                                                            <textarea type="text" class="inputText " style="height: auto" id="Notes{{$t}}" rows="4"></textarea>
                                                            {{--                                                            <span class="floating-label">Notes</span>--}}
                                                            {{--                                                        </div>--}}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endfor
                            </div>
                            <div class="custrip2 border0">
                                <div class="checkoutcontent2" style="display: block; padding-bottom: 15px;">
                                    <div class="row">
                                        <a href="#" class="btn_1  btngrad btnch2new">Continue to payment</a>
                                    </div>
                                </div>
                            </div>



                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="pricech1 pricechb1">
                            <h2 class="">Price Details</h2>
{{--                            <h1 class="">Add coupon code</h1>--}}

                            <div class="mainmaxprice" id="subprices">
                                <div class="priceflex1">
                                    <div>
                                        <p>Starting Price</p>
                                    </div>
                                    <div>
                                        <p id="starting">{{display_currency(\Illuminate\Support\Arr::first($range)['price'])}}</p>
                                    </div>
                                </div>
{{--                                <div class="priceflex1">--}}
{{--                                    <div>--}}
{{--                                        <p>Trip Saving</p>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <p style="color: #039855 !important;">-$2.96</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="priceflex1">--}}
{{--                                    <div>--}}
{{--                                        <p>Coupon (SAVE20)</p>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <p  style="color: #039855 !important;">-$10.96</p>--}}
{{--                                    </div>--}}{{--   <div class="priceflex1">--}}
{{--                                    <div>--}}
{{--                                        <p>Trip Saving</p>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <p style="">$2.96</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div id="rooms">
                                    <span style="font-size: 17px;font-weight: bolder">Room(s)</span>

                                </div>
                                <div id="costume">
                                    <span style="font-size: 17px;font-weight: bolder">Costume(s)</span>

                                </div>
                                <div id="addons">
                                    <span style="font-size: 17px;font-weight: bolder">Addon(s)</span>

                                </div>
                                <div id="tickets">
                                    <span style="font-size: 17px;font-weight: bolder">Ticket(s)</span>

                                </div>


                                </div>

                            <div class="mainmaxprice">
                                <div class="priceflex1">
                                    <div>
                                        <p>Subtotal</p>
                                    </div>
                                    <div>
                                        <p id="subtotal"><b>{{display_currency(\Illuminate\Support\Arr::first($range)['price'])}}</b></p>
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
                                        <p >{{display_currency((float)PROCESSING_FEE)}}</p>
                                    </div>
                                </div>

                            </div>

                            <div class="priceflex1">
                                <div>
                                    <p>Total</p>
                                </div>
                                <div class="flex22">
                                    <img src="{{asset('assets/front/img/usd.svg')}}" />
                                    <h4 id="finaltotal">{{display_currency(\Illuminate\Support\Arr::first($range)['price']+(float)PROCESSING_FEE)}}</h4>
                                </div>
                            </div>
                            <a href="./checkout2.html">Proceed to checkout</a>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var addons=[],costumes=[],rooms=[],tickets=[],room_previous=[];
        var addons_titles=[],costumes_titles=[],rooms_titles=[],tickets_titles=[];
        var addons_added=[],costumes_added=[],rooms_added=[],tickets_added=[];
        var costume_total=0,addons_total=0,rooms_total=0,tickets_total=0,total=0,duration_total=0;

        @foreach($trip->addons as $addon)
            addons[{{$addon->id}}]='{{$addon->addon_price}}';
            addons_titles[{{$addon->id}}]='{{$addon->addon_title}}';
        @endforeach
            @foreach($trip->costumes as $costume)
                costumes[{{$costume->id}}]='{{$costume->costume_price}}';
                costumes_titles[{{$costume->id}}]='{{$costume->costume_title}}';
            @endforeach
                @foreach($trip->tickets as $ticket)
                tickets[{{$ticket->id}}]='{{$ticket->ticket_price}}';
                tickets_titles[{{$ticket->id}}]='{{$ticket->ticket_title}}';
            @endforeach

            @foreach($trip->hotels as $hotel)
                @foreach($hotel->rooms as $room)
                    rooms[{{$room->id}}]='{{$room->room_price>$room->discount_price?$room->discount_price:$room->room_price}}';
                    rooms_titles[{{$room->id}}]='{{$room->room_title}}';
                    room_previous[{{$room->id}}]='';
                @endforeach
            @endforeach

        $(function (){

            var subprices_div=$('#subprices');
                    subprices_div.find('#costume').hide();
                    subprices_div.find('#rooms').hide();
                    subprices_div.find('#addons').hide();
                    subprices_div.find('#tickets').hide();

            $('.date_range').change(function () {
                var val=$(this).val();
                val=val.split('%');
                console.log(duration_total=parseFloat(val[1]));
                console.log(duration_total);
                $('#starting').html('$'+duration_total.toFixed(2));
                $('#starting_top').html('$'+duration_total.toFixed(2));
                calculate_total();
            });
                    @if(count($trip->costumes)>0)
            $('.costume').change(function () {
                var trvlr=$(this).data('traveler');
                var costume_id=$(this).val();
                        console.log(costume_id);console.log(costumes);
                $('.costume_options').hide();
                $('.costume_options_'+trvlr+costume_id).fadeIn();
                let id_found=false;

                for(var v=0;v<costumes_added.length;v++){
                    if(costumes_added[v]===costume_id){id_found=true;}
                }
                if(id_found===false){
                    costumes_added.push(costume_id);
                    costume_total+=parseFloat(costumes[costume_id]);
                    var costume_this='<div class="priceflex1" id="costume_subtotal'+trvlr+costume_id+'">'+
                        '<div>'+
                        '<p>'+costumes_titles[costume_id]+' Traveler('+trvlr+')</p>'+
                        '</div>'+
                        '<div>'+
                        '<p style="">$'+(parseFloat(costumes[costume_id]))+'</p>'+
                        '</div>'+
                        '</div>';
                    subprices_div.find('#costume').append(costume_this);
                    subprices_div.find('#costume').show();
                }else{
                    for (var i=0;i<costumes_added.length;i++){
                        if(costumes_added[i]===costume_id){
                            costumes_added.splice(costumes_added.indexOf(costume_id),1);
                            costume_total-=parseFloat(costumes[costume_id]);
                            $('#costume_subtotal'+trvlr+costume_id).remove();
                        }
                    }
                    if(costumes_added.length<=0){
                        subprices_div.find('#costume').hide();
                    }
                }
                console.info(costume_total);
                calculate_total();
            });
            @endif
            @if(count($trip->addons)>0)
            $('.addons').change(function () {
                // var trvlr=$(this).data('traveler');
                //if(this.checked) {
                    console.log($(this).val());
                    var addon_id = $(this).val();
                    let id_found = false;

                    for (var v = 0; v < addons_added.length; v++) {
                        if (addons_added[v] === addon_id) {
                            id_found = true;
                        }
                    }
                    if (id_found === false&&this.checked) {
                        addons_added.push(addon_id);
                        addons_total += parseFloat(addons[addon_id]);
                        var addons_this='<div class="priceflex1" id="addon_subtotal'+addon_id+'">'+
                            '<div>'+
                            '<p>'+addons_titles[addon_id]+'</p>'+
                            '</div>'+
                            '<div>'+
                            '<p style="">$'+(parseFloat(addons[addon_id]))+'</p>'+
                            '</div>'+
                            '</div>';
                        subprices_div.find('#addons').show();
                        subprices_div.find('#addons').append(addons_this);
                    } else {
                        for (var i = 0; i < addons_added.length; i++) {
                            if (addons_added[i] === addon_id) {
                                addons_added.splice(addons_added.indexOf(addon_id), 1);
                                addons_total -= parseFloat(addons[addon_id]);
                                $('#addon_subtotal'+addon_id).remove();
                            }
                        }
                        if(addons_added.length<=0){
                            subprices_div.find('#addons').hide();
                        }
                    }
                    calculate_total();
                //}
            });
                    @endif
           @if(count($trip->tickets)>0)
                    $('.ticket').change(function () {
                        var trvlr=$(this).data('traveler');
                        var ticket_id=$(this).val();
                        let id_found=false;

                        for(var v=0;v<tickets_added.length;v++){
                            if(tickets_added[v]===ticket_id){id_found=true;}
                        }
                        if(id_found===false){
                            tickets_added.push(ticket_id);
                            tickets_total+=parseFloat(tickets[ticket_id]);
                            var ticket_this='<div class="priceflex1" id="ticket_subtotal'+trvlr+ticket_id+'">'+
                                '<div>'+
                                '<p>'+tickets_titles[ticket_id]+' Traveler('+trvlr+')</p>'+
                                '</div>'+
                                '<div>'+
                                '<p style="">$'+(parseFloat(tickets[ticket_id]))+'</p>'+
                                '</div>'+
                                '</div>';
                            subprices_div.find('#tickets').show();
                            subprices_div.find('#tickets').append(ticket_this);
                        }else{
                            for (var i=0;i<tickets_added.length;i++){
                                if(tickets_added[i]===ticket_id){
                                    tickets_added.splice(tickets_added.indexOf(ticket_id),1);
                                    tickets_total-=parseFloat(tickets[ticket_id]);
                                    $('#ticket_subtotal'+trvlr+ticket_id).remove();
                                }
                            }
                            if(tickets_added.length<=0){
                                subprices_div.find('#tickets').hide();
                            }
                        }
                        calculate_total();
                    });
                    @endif
            $('.room').change(function () {
                // var trvlr=$(this).data('traveler');
                //if($(this).val()!==0){

                    var room_persons=$(this).val();
                    var room_id = $(this).data('id');
                    let id_found = false;
                    if(parseInt(room_persons)!==0){console.log(rooms);}
                    console.log('persons:'+room_persons+'-id:'+room_id);
                    for (var v = 0; v < rooms_added.length; v++) {
                        if (rooms_added[v] === room_id) {
                            id_found = true;
                        }
                    }
                    var room_now_persons=0;
                    if (id_found === false||parseInt(room_persons)!==0) {
                        if(id_found===false){
                            rooms_added.push(room_id);
                        }else{
                            $('#room_subtotal'+room_id).remove();
                        }
                        console.log(rooms_added+' added')
                        rooms_total += (parseFloat(rooms[room_id])*parseInt(room_persons));
                        var room_this='<div class="priceflex1" id="room_subtotal'+room_id+'">'+
                            '<div>'+
                                '<p>'+rooms_titles[room_id]+' for '+room_persons+ '</p>'+
                            '</div>'+
                            '<div>'+
                                '<p style="">$'+(parseFloat(rooms[room_id])*parseInt(room_persons))+'</p>'+
                            '</div>'+
                        '</div>';
                        subprices_div.find('#rooms').show();
                        subprices_div.find('#rooms').append(room_this);
                        // console.log('persons:'+room_persons+'-id:'+room_id+'-price'+(parseFloat(rooms[room_id])*parseInt(room_persons)));
                    } else {
                        for (var i = 0; i < rooms_added.length; i++) {
                            if (rooms_added[i] === room_id) {
                                console.log(rooms_added);
                                rooms_added.splice(rooms_added.indexOf(room_id), 1);
                                if(parseInt(room_persons)===0){room_now_persons=room_previous[room_id];}else{room_now_persons=room_persons;}
                                rooms_total -= (parseFloat(rooms[room_id])*parseInt(room_now_persons));
                                $('#room_subtotal'+room_id).remove();
                            }
                        }
                        if(rooms_added.length<=0){
                            subprices_div.find('#rooms').hide();
                        }
                    }
                    room_previous[room_id]=room_persons;
                    calculate_total();
               // }


            });
        });
        function calculate_total(){
            total=0;
            total+=duration_total;
            total+=rooms_total;
            total+=tickets_total;
            total+=costume_total;
            total+=addons_total;

            var subtotal=total;
            $('#subtotal').html('$'+subtotal.toFixed(2));
            var processing={{(float)PROCESSING_FEE}};

            total+=processing;
            $('#finaltotal').html('$'+total.toFixed(2))
            console.log('total:'+total);

        }
    </script>
@endsection

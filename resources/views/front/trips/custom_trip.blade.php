@extends('layouts.front')

@section('styles')
<style>
.choosepaymemyrad input[type="radio"] + label p {
    font-weight: 400;
    font-size: 13px;
    line-height: 15px;
    color: #545455;
    letter-spacing: -.022em;
    margin-top: 4px;
    margin-bottom: 0px;
    width: 50%;
    float: left;
    margin-bottom: 15px;
}
	.choosepaymemyrad input[type="radio"]+label h3 {
    color: #545455;
    font-size: 13px;
    font-weight: 500;
    width: 50%;
    float: left;
    margin-bottom: 12px !important;
}
	.choosepaymemyrad .basic_inner_text {
    background-color: #dadada;
    padding: 4px 10px;
    border-radius: 5px;
}
	.choosepaymemyrad input[type="radio"]:checked+label .basic_inner_text {
   color: #4a00e0;
}
	.checkout1box h2 {
    font-size: 30px !important;
    margin-top: 35px !important;
}
</style>
@endsection
@section('content')
    <div class="checkutpagemain">
        <div class="container contch">
            <div class="checkout1box custrip1">
                <h1 class="arwsqft"><img src="{{asset('assets/front/img/arrow-square-left.svg')}}" /><a href="{{route('frontend.trip_view',['trip_title'=>str_replace(' ','-',$trip->event_title),'event'=>$trip->id])}}">Go back</a></h1>
                <h2>Create your trip.</h2>
                @if(isset($error))
                    {{$error}}
                    @endif
            </div>

            <div class="row padding20sec1ch">
                <form action="{{route('frontend.custom_order_process')}}" class="card-form" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8">

{{--                        <img src="{{asset('assets/front/img/tour2.png')}}" class="tourimg1ct" />--}}
                        @if($trip->featured_image)
                            <img src="{{ $trip->featured_image->getUrl() }}" class="tourimg1ct">
                        @else
                            <img src="{{asset('assets/front/img/tourdetailsbg1.png')}}" class="tourimg1ct" />
                        @endif
                        @csrf
                        <input type="hidden" name="trip_id" value="{{$trip->id}}">
                        <input type="hidden" name="travelers" value="{{$travelers}}">
                        <div class="cb1sbt2">
                            <div>
                                <h4 class="marbot0 texthead22">{{$trip->event_title}}</h4>
                            </div>
                            <div>
                                <h4 class="marbot0 texthead22"><sup>Starting From</sup>&nbsp;<span id="" style="font-size: 20px"> {{display_currency($low_total)}}</span></h4>
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
{{--                                        <form action="{{request()->url()}}" method="get">--}}
                                            <select class="form-select" formsele="" name="travelers" onchange="window.location='{{request()->fullUrlWithQuery(['travelers'=>'trvlr'])}}'.replace('trvlr',this.value)" aria-label="Default select example">
                                                <option value="">Choose No. of Travelers</option>
                                                @for($i=1;$i<=10;$i++)
                                                    <option value="{{$i}}" {{$i==$travelers?'selected':''}}>{{$i}} Person(s)</option>
                                                @endfor
                                            </select>
{{--                                        </form>--}}
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
{{--                                @foreach($range as $index => $date_range)--}}
                                    @foreach($trip->date_ranges as $date_range)
                                    <div class="col-md-6">
                                        <div class="choosepaymemyrad">
                                            <input type="radio" id="range{{$date_range->id}}" class="date_range" {{$loop->index===1?'checked':''}} name="range" data-range="{{date('d-M-Y',strtotime($date_range->range_start)).' > '.date('d-M-Y',strtotime($date_range->range_end))}}%{{$date_range->range_price}}" {{old('range','')==($date_range->id)?'checked':'' }} value="{{$date_range->id}}">
                                            <label for="range{{$date_range->id}}">
                                                <div class="boxchlabl border0 ">
													<div class="bottom_text_custom_trip">
                                                    <p class="basic_trip"><span class="basic_inner_text">{{$date_range->range_title}}</span></p>
                                                    <h3 class="marbot0 mt-2 text-right" style="text-align: right"><b><sup>Starting From</sup>&nbsp;{{display_currency($date_range->range_price)}}</b></h3>
                                                    {{--                                                <p>Room, 2 Queen Beds, Sleeps 4</p>--}}
                                                </div>
													<div class="top_text_custom_trip">
                                                    <p><img src="{{asset('assets/front/img/calendar2.svg')}}"/>Date</p>
                                                    <h3 class="marbot0 mt-2 text-right" style="text-align: right">{{date('d-M-Y',strtotime($date_range->range_start)).' > '.date('d-M-Y',strtotime($date_range->range_end))}}

														</b></h3>
                                                    {{--                                                <p>Room, 2 Queen Beds, Sleeps 4</p>--}}
                                                </div>
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
                                <div class="col-md-12">
                                    <div class="card" style="border: 1px solid #ced4da;border-radius: 6px">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-6"><strong>No Accommodation</strong></div>
                                                <div class="col-6 text-center">No. of Person</div>
                                            </div>

                                        </div>
                                        <div class="card-body">

                                            @foreach($no_accommodation->rooms as $room)
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
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @foreach($trip->hotels as $hotel)
                                    @if($hotel->id==2) @continue @endif
                                    <div class="col-md-12">
                                        <div class="card" style="border: 1px solid #ced4da;border-radius: 6px">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-6"><strong>{{$hotel->hotel_name}}</strong></div>
                                                    <div class="col-6 text-center">No. of Person</div>
                                                </div>

                                            </div>
                                            <div class="card-body">
{{--                                                <div class="row mt-3 pl-3 pr-3" style="    padding: 0 1rem;    border-bottom: 1px solid #ced4da;    margin: 0.1rem;">--}}
{{--                                                    <div class="col-6">--}}
{{--                                                        <h6><b>*No Accommodation</b></h6>--}}
{{--                                                        <p>--}}
{{--                                                            Number of travellers in your group if you have your own accommodation.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-6">--}}
{{--                                                        <select name="room_persons[0]" class="form-control room" data-roomprice="0" data-id="0" onchange="" id="">--}}
{{--                                                            <option value="0">--Please Select--</option>--}}
{{--                                                            @for($i=1;$i<=$travelers;$i++)--}}
{{--                                                                <option value="{{$i}}">{{$i}} Person(s)</option>--}}
{{--                                                            @endfor--}}
{{--                                                        </select>--}}
{{--                                                    </div>--}}
{{--                                                    <hr style="margin:5px;background-color:#ced4da">--}}
{{--                                                </div>--}}
                                                @foreach($hotel->rooms as $room)
                                                    @if (room_capacity_to_traveler($room->room_capacity, $travelers))

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
                                                        @endif
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
                                                        <option value="{{$costume->id}}" {{old('costume.'.$t)&&old('costume.'.$t)==$costume->id?'selected':''}}>{{$costume->costume_title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @foreach($trip->costumes as $costume)
                                            @foreach($costume->options as $option)
                                                <div class="col-md-6 costume_options_{{$t}}{{$costume->id}} costume_options_{{$t}} costume_options" style="display: {{old('costume.'.$t)&&old('costume.'.$t)==$costume->id?'block':'none'}}">
                                                    <label for="option_{{$option->id}}">
                                                        {{$option->title}}  &nbsp;</label>
                                                    @if($option->values!='')
                                                        <select class="form-select" name="costume_option[{{$t}}][{{$costume->id}}][{{$option->id}}]" id="option_{{$option->id}}">
                                                            <option value="">Select {{$option->title}} type</option>
                                                            @foreach(explode(',',$option->values) as $value)
                                                                <option value="{{$value}}" {{old('costume_option.'.$t.'.'.$costume->id.'.'.$option->id)&&old('costume_option.'.$t.'.'.$costume->id.'.'.$option->id)==$value?'selected':''}}>{{$value}}</option>
                                                            @endforeach
                                                        </select>
                                                    @else
                                                        <input type="text" class="form-control" name="costume_option[{{$t}}][{{$costume->id}}][{{$option->id}}]" id="option_{{$option->id}}" value="{{old('costume_option.'.$t.'.'.$costume->id.'.'.$option->id)}}" placeholder="Please Enter {{$option->title}}">
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
                                                    <input type="checkbox" id="ticket_{{$t}}{{$ticket->id}}" class="ticket" name="ticket[{{$t}}][{{$ticket->id}}]" {{old('ticket.'.$t.'.'.$ticket->id)&&old('ticket.'.$t.'.'.$ticket->id)==$ticket->id?'checked':''}} data-traveler="{{$t}}" value="{{$ticket->id}}" data-ticketprice="{{$ticket->ticket_price}}">
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
                                                    <input type="checkbox" id="addon_{{$addon->id}}" class="addons" name="addon[{{$addon->id}}]" {{old('addon.'.$addon->id)&&old('addon.'.$addon->id)==$addon->id?'checked':''}} value="{{$addon->id}}" data-addonprice="{{$addon->addon_price}}">
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
                                        <input type="radio" id="pay1" class="payment_type" name="payment_type" {{old('paymentmethod')=='Installment'?'checked':''}} value="Installment">
                                        <label for="pay1">

                                            <div class="boxchlabl">
                                                <h3>Deposit + Monthly Installments</h3>
                                                <h3><b id="install">{{display_currency($low_deposit)}} Deposit + {{display_currency($low_installment)}} for {{TOTAL_INSTALLMENTS}} Months</b></h3>
                                            </div>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="choosepaymemyrad">

                                        <input type="radio" id="pay2" name="payment_type" class="payment_type" {{old('paymentmethod')=='Full'?'checked':''}} value="Full">
                                        <label for="pay2">

                                            <div class="boxchlabl">
                                                <h3>Pay in full</h3>
                                                <h3><b class="finaltotal">{{display_currency($low_total+(float)PROCESSING_FEE)}}</b></h3>
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
                                                                <input type="text" class="inputText " required value="{{old('first_name.'.$t)}}" name="first_name[{{$t}}]" />
                                                                <span class="floating-label">First name</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <!-- <label for="lastname" class="form-label">Last name</label>
                                                            <input type="text" class="form-control" placeholder="Last name" id="lastname" required=""> -->
                                                            <div class="prel">
                                                                <input type="text" class="inputText " required value="{{old('last_name.'.$t)}}" name="last_name[{{$t}}]" />
                                                                <span class="floating-label">Last name</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Phone number</label>
                                                            <input type="text" class="form-control " value="{{old('phone.'.$t)}}"  name="phone[{{$t}}]" placeholder="+1 (555) 000-0000">
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
                                                            <input type="email" class="form-control" value="{{old('email.'.$t)}}" placeholder="Email Address" id="EmailAddress" name="email[{{$t}}]">
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
                                                                    <input class="form-check-input" type="radio" id="gender_{{ $key }}" name="gender[{{$t}}]" value="{{ $key }}" {{old('gender.'.$t)&&old('gender.'.$t)==$key?'checked':''}}>
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
                                                                    <option value="{{$i}}" {{old('shirt_size.'.$t)&&old('shirt_size.'.$t)==$i?'selected':''}}>{{$i}} </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            {{--                                                        <div class="prel">--}}
                                                            <label for="Notes{{$t}}">Notes</label>
                                                            <textarea type="text" class="inputText " name="notes[{{$t}}]" style="height: auto" id="Notes{{$t}}" rows="4">{{old('notes.'.$t)}}</textarea>
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
                        </div>
                         <div class="custrip2">
                                        <div class="row">
                                            <div class="col-12 mb-4" style="padding-left: 5px" >
                                                <h3 class="texthead22">Terms And Conditions.</h3>
                                                <div style="margin-left: 1.5rem">
                                                    <label for="terms" class="form-check-label"><input type="checkbox" class="form-check-inline" name="terms[]" id="terms">
                                                        &nbsp;You agree with out friendly&nbsp;<a href="{{route('page_view',['page_name'=>'Privacy-Policy','pID'=>2])}}">Privacy Policy</a></label>
                                                    <label for="terms" class="form-check-label"><input type="checkbox" class="form-check-inline form-check" name="terms[]" id="terms">
                                                        &nbsp;Nunc bibendum velit sit amet leo interdum, eget suscipit nulla posuere.</label>
                                                    <label for="terms" class="form-check-label"><input type="checkbox" class="form-check-inline form-check" name="terms[]" id="terms">
                                                        &nbsp;Aliquam risus velit, ornare sed bibendum at, tristique blandit nibh.</label>
                                                </div>

                                            </div>


                                            <div class="col-12">
                                                <div class="card" style="border: 1px solid #ced4da;border-radius: 6px">
                                                    <div class="card-header">
                                                        <h6 class="" style="margin: 20px 0;">Pay By Card</h6>
                                                    </div>
                                                    <div class="card-body p-3">
                                                        @if($payment_method!='')
                                                        <div class="row"><div class="col-3"><strong>Choose from already added Card(s)</strong></div></div>
                                                            @foreach($payment_method as $paymentmethod)
{{--                                                                @dd($paymentmethod)--}}
                                                                <div class="row mt-2">
                                                                    <div class="col-10">
                                                                        <input type="radio" name="paymentmethod" value="{{$paymentmethod->id}}" {{old('paymentmethod')==$paymentmethod->id?'checked':''}}  class="form-check-inline payradio " id="payment-method{{$paymentmethod->card->last4}}">
                                                                        <label for="payment-method{{$paymentmethod->card->last4}}">{{strtoupper($paymentmethod->card->brand)}} ending in {{$paymentmethod->card->last4}} Expiry ({{$paymentmethod->card->exp_month}}/{{$paymentmethod->card->exp_year}})</label>
                                                                    </div>
                                                                    <div class="col-2">
                                                                        <img src="{{asset('assets/front/img/'.$paymentmethod->card->brand.'.svg')}}" style="width:55px;height: auto;border-radius: 5px" class="imgcdpic" />
                                                                    </div>
                                                                </div>
                                                            @endforeach

                                                        @endif
                                                            <div class="row"><div class="col-3"><strong>Add new Card</strong></div></div>
                                                        <div id="card-element" class="mt-3 mb-3"></div>
                                                        <div id="card-errors" role="alert"></div>
                                                        <input type="hidden" name="payment_method" class="payment-method">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <div class="custrip2 border0">
                                <div class="checkoutcontent2" style="display: block; padding-bottom: 15px;">
                                    <div class="row">
                                        <button  class="btn_1 pay btngrad btnch2new">Book Now</button>
                                    </div>
                                </div>
                            </div>
{{--                        </div>--}}

                    </div>
                    <div class="col-md-4">
                        <div class="pricech1 pricechb1">
                            <h2 class=""><img src="{{asset('assets/front/img/trip-summary.JPG')}}" style="width: 30px;">Trip Summary</h2>
							<h6 class="marbot0 mt-2"  style="color: black;">{{$trip->event_title}}

														</h6>
						<h6 class="marbot0 mt-2"  style="color: black;">{{$date_range['date']}}

														</h6>
{{--                            <h1 class="">Add coupon code</h1>--}}

                            <div class="mainmaxprice" id="subprices">
                                <div class="priceflex1">
<!--
                                    <div>
                                        <p>Starting Price</p>
                                    </div>
-->
<!--
                                    <div>
                                        <p class="starting">{{display_currency($low_total)}}</p>
                                    </div>
-->
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
{{--                                    </div>--}}
{{--                                   <div class="priceflex1">--}}
{{--                                    <div>--}}
{{--                                        <p>Trip Saving</p>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <p style="">$2.96</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                @for($tr=1;$tr<=$travelers;$tr++)
                                    <input type="hidden" name="room_for_traveler[{{$tr}}]" id="room_for_traveler{{$tr}}" value="">
                                <div id="trvler_{{$tr}}">
                                    <h6 onclick="$('#tr_details{{$tr}}').toggle();$(this).find('i').toggleClass('fa-angle-up');" class="text-black mb-1">Traveler {{$tr}} <i class="fa  fa-angle-down"></i>   <span id="trvlertotal{{$tr}}" class="float-end">$0</span></h6>

                                    <div id="tr_details{{$tr}}" class="mb-2" style="display: none">
                                        <div id="trip_cost{{$tr}}" class="trip-cost1">
{{--                                            <h6 class="text-black" >Trip Cost</h6>--}}
                                            <div class="priceflex1">
                                                <div>
                                                    <p>Trip Cost</p>
                                                </div>
                                                <div>
                                                    <p id="trvlertotal_{{$tr}}" class="float-end">$0</p>
                                                </div>
                                            </div>
                                        </div>
{{--                                        <div id="costume{{$tr}}">--}}
{{--                                            <h6 class="text-black" style="display: none">Costume(s)</h6>--}}
{{--                                        </div>--}}
{{--                                        <div id="tickets{{$tr}}">--}}
{{--                                            <h6 class="text-black" style="display: none">Ticket(s)</h6>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                                @endfor
{{--                                <div id="rooms">--}}
{{--                                    <span style="font-size: 17px;font-weight: bolder">Room(s)</span>--}}

{{--                                </div>--}}

{{--                                <div id="addons">--}}
{{--                                    <span style="font-size: 17px;font-weight: bolder">Addon(s)</span>--}}

{{--                                </div>--}}



                                </div>

                            <div class="mainmaxprice">
                                <div class="priceflex1">
                                    <div>
                                        <p>Subtotal</p>
                                    </div>
                                    <div>
                                        <p id="subtotal"><b>{{display_currency($low_total)}}</b></p>
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
                                        <p id="processing_fee">{{display_currency(processing_fee($low_total))}}</p>
                                    </div>
                                </div>

                            </div>
                            <div id="Installment" class="mainmaxprice">
                                <span style="font-size: 17px;font-weight: bolder">Installment(s) Details</span>

                            </div>
                            <div class="priceflex1">
                                <div>
                                    <p>Total</p>
                                </div>
                                <div class="flex22">
                                    <img src="{{asset('assets/front/img/usd.svg')}}" />
                                    <h4 class="finaltotal">{{display_currency($low_total+processing_fee($low_total))}}</h4>
                                </div>
                            </div>
                            <a href="#" class="pay">Book Now</a>

                        </div>
                    </div>
                </div>
                </form>
            </div>


        </div>
    </div>
    <div id="room_toast">
        <div class="toast align-items-center text-white bg-danger border-0 room_toast" role="alert" aria-live="assertive" data-bs-autohide="false" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Rooms/Accomodations are not selectd for all Travelers
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
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
        let paymentMethod = null;
        $('.payradio').change(function (){
           paymentMethod=$(this).val();
        });
        $('.pay').on('click', function (e) {
            var name='{{auth()->user()->name.' '.auth()->user()->lastname}}';
            $('.pay').attr('disabled', true)
            if (paymentMethod) {
                $('.payment-method').val(paymentMethod);
                $('.card-form').submit();
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

    </script>
    <script>
        var addons=[],costumes=[],rooms=[],tickets=[],room_previous=[];
        var addons_titles=[],costumes_titles=[],rooms_titles=[],tickets_titles=[];
        var addons_added=[],costumes_added=[],rooms_added=[],tickets_added=[];
        var costume_total=0,addons_total=0,rooms_total=0,tickets_total=0,total=0,total_room_persons=0,duration_total= {{$low_total}};
        var date_ranges=[],room_range_pricing=[],date_range_id=0,room_price_one=[];
        @foreach($trip->date_ranges as $d_range)
        date_ranges[{{$d_range->id}}]={{$d_range->range_price}};
        @endforeach
var total_travelers={{$travelers}};
var travelers_total=[],costume_trvlr=[],ticket_trvlr=[],room_trvlr=[];
for(var tr=1;tr<=total_travelers;tr++){
    travelers_total[tr]=0;
    room_trvlr[tr]=0;
    room_price_one[tr]=0;
    costume_trvlr[tr]=0;
    ticket_trvlr[tr]=0;
}
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
                rooms[0]='{{NO_ACCOMMODATION_PRICE}}';
                rooms_titles[0]='{{'No Accommodation'}}';
                room_previous[0]='';
            @foreach($trip->hotels as $hotel)
                @foreach($hotel->rooms as $room)
                    rooms[{{$room->id}}]='{{$room->room_price>$room->discount_price?$room->discount_price:$room->room_price}}';
                    rooms_titles[{{$room->id}}]='{{$room->room_title}}';
                    room_previous[{{$room->id}}]='';
                @endforeach
            @endforeach
                    @foreach($room_prices as $date_range_id => $room_price)
                        @foreach($room_price as $room_id => $price)
                            if(typeof room_range_pricing[{{$date_range_id}}] === 'undefined') {
                                room_range_pricing[{{$date_range_id}}]=[];
                            }
                            room_range_pricing[{{$date_range_id}}][{{$room_id}}]={{$price}};
                        @endforeach
                    @endforeach
// console.info(room_range_pricing);
        $(function (){

            $('.payment_type').trigger('change');
            $('.date_range').each(function (){
                if ($(this).is(':checked')){
                    date_range_id=$(this).val();
                }
            });
            var subprices_div=$('#subprices');
                    subprices_div.find('#costume').hide();
                    subprices_div.find('#rooms').hide();
                    subprices_div.find('#addons').hide();
                    subprices_div.find('#tickets').hide();
                    $('#Installment').hide();
            $('.payment_type').change(function () {
            var payment_type=$(this).val();
                var total=$('.finaltotal').html().replace('$','');
                var Deposit={{(float)DEPOSIT_AMOUNT_PERCENT/100}};
                var totalinstallment_={{(int)TOTAL_INSTALLMENTS}};

                Deposit=parseFloat(total)*Deposit;
                var installment=(parseFloat(total)-Deposit)/totalinstallment_;
                console.log(payment_type+'$'+Deposit+' Deposit + $'+installment+' for '+totalinstallment_+' Months');
                $('#install').html('$'+Deposit.toFixed(2)+' Deposit + $'+installment.toFixed(2)+' for '+totalinstallment_+' Months')
                if(payment_type==='Installment'){console.log(payment_type+'$'+Deposit+' Deposit + $'+installment+' for '+totalinstallment_+' Months');
                    var Installment_this = '<div class="priceflex1" id="deposit-total">' +
                        '<div>' +
                        '<p>Deposit </p>' +
                        '</div>' +
                        '<div>' +
                        '<p style="">$' + (parseFloat(Deposit)).toFixed(2) + '</p>' +
                        '</div>' +
                        '</div>'+'<div class="priceflex1" id="installment-total">' +
                        '<div>' +
                        '<p> Installments/Month For (' + totalinstallment_ + ' Months)</p>' +
                        '</div>' +
                        '<div>' +
                        '<p style="">$' + (installment.toFixed(2)) + '</p>' +
                        '</div>' +
                        '</div>';
                    $('#Installment').show();
                    $('#Installment').append(Installment_this);
                }else{
                    $('#Installment').hide();
                    $('#deposit-total').remove();
                    $('#installment-total').remove();
                    calculate_total();
                }

            });
            $('.date_range').change(function () {
                var val=date_range_id=$(this).val();
                $('.trip-cost').find('.starting__').remove();
                var starting__ = '<div class="priceflex1 starting__" >' +
                    '<div>' +
                    '<p>Trip Cost</p>' +
                    '</div>' +
                    '<div>' +
                    '<p style="">$' + (parseFloat(date_ranges[val])) + '</p>' +
                    '</div>' +
                    '</div>';
                // val=val.split('%');
                $('.trip-cost').append(starting__);
                duration_total=parseFloat(date_ranges[val])*total_travelers;
                // console.log(duration_total);
                $('.starting').html('$'+duration_total.toFixed(2));
                // $('#starting_top').html('$'+duration_total.toFixed(2));
                //calculate_total();
            });
                    @if(count($trip->costumes)>0)
            $('.costume').change(function () {
                var trvlr = $(this).data('traveler');
                 var costume_id = $(this).val();
                 // if()
                         // console.log(costume_id);console.log(costumes);
                  if (typeof costumes_added[trvlr] === 'undefined'){
                      costumes_added[trvlr]=[];
                  }
                  if (typeof costume_id !== 'undefined'){
                      // console.log(costume_id+'-2');console.log(costumes);
                            $('.costume_options_'+trvlr).hide();
                        $('.costume_options_' + trvlr + costume_id).fadeIn();
                        let id_found = false;

                        for (var v = 0; v < costumes_added[trvlr].length; v++) {
                            if (costumes_added[trvlr][v] === costume_id) {
                                id_found = true;
                            }
                        }

                        if (id_found === false) {
                            costumes_added[trvlr].push(costume_id);
                            costume_total += parseFloat(costumes[costume_id]);
                            costume_trvlr[trvlr]=parseFloat(costumes[costume_id]);
                            var costume_this = '<div class="priceflex1" id="costume_subtotal' + trvlr + costume_id + '">' +
                                '<div>' +
                                '<p>' + costumes_titles[costume_id] + ' Traveler(' + trvlr + ')</p>' +
                                '</div>' +
                                '<div>' +
                                '<p style="">$' + (parseFloat(costumes[costume_id])) + '</p>' +
                                '</div>' +
                                '</div>';
                            // $('#costume'+trvlr).show();
                            $('#costume'+trvlr).append(costume_this);

                        } else {
                            for (var i = 0; i < costumes_added[trvlr].length; i++) {
                                if (costumes_added[trvlr][i] === costume_id) {
                                    costumes_added[trvlr].splice(costumes_added[trvlr].indexOf(costume_id), 1);
                                    costume_total -= parseFloat(costumes[costume_id]);
                                    costume_trvlr[trvlr]=0;
                                    $('#costume_subtotal' + trvlr + costume_id).remove();
                                }
                            }
                            if (costumes_added[trvlr].length <= 0) {
                                costume_trvlr[trvlr]=0;
                                $('#costume'+trvlr).hide();
                            }
                        }

                        calculate_total();
                    }
                  console.info(costumes_added);
            });
            @endif
            @if(count($trip->addons)>0)
            $('.addons').change(function () {
                // var trvlr=$(this).data('traveler');
                //if(this.checked) {
                //     console.log($(this).val());
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
                        if (typeof tickets_added[trvlr] === 'undefined'){
                            tickets_added[trvlr]=[];
                        }
                        for(var v=0;v<tickets_added[trvlr].length;v++){
                            if(tickets_added[trvlr][v]===ticket_id){id_found=true;}
                        }
                        if(id_found===false){
                            tickets_added[trvlr].push(ticket_id);
                            tickets_total+=parseFloat(tickets[ticket_id]);
                            ticket_trvlr[trvlr]=parseFloat(tickets[ticket_id]);

                            var ticket_this='<div class="priceflex1" id="ticket_subtotal'+trvlr+ticket_id+'">'+
                                '<div>'+
                                '<p>'+tickets_titles[ticket_id]+' Traveler('+trvlr+')</p>'+
                                '</div>'+
                                '<div>'+
                                '<p style="">$'+(parseFloat(tickets[ticket_id]))+'</p>'+
                                '</div>'+
                                '</div>';
                            // $('#tickets'+trvlr).show();
                            $('#tickets'+trvlr).append(ticket_this);
                        }else{
                            for (var i=0;i<tickets_added[trvlr].length;i++){
                                if(tickets_added[trvlr][i]===ticket_id){
                                    tickets_added[trvlr].splice(tickets_added[trvlr].indexOf(ticket_id),1);
                                    tickets_total-=parseFloat(tickets[ticket_id]);
                                    $('#ticket_subtotal'+trvlr+ticket_id).remove();
                                    ticket_trvlr[trvlr]=0;
                                }
                            }
                            if(tickets_added[trvlr].length<=0){
                                $('#tickets'+trvlr).hide();
                            }
                        }
                        console.log('');
                        calculate_total();
                    });
                    @endif
            $('.room').change(function () {
                // var trvlr=$(this).data('traveler');
                //if($(this).val()!==0){

                    var room_persons=parseInt($(this).val());
                    var room_id = $(this).data('id');
                    let id_found = false;
                    if(room_persons===0){
                        if(room_previous[room_id]>0){
                            rooms_total -= (parseInt(room_previous[room_id])*parseFloat(room_range_pricing[date_range_id][room_id]));

                            total_room_persons-=room_previous[room_id];
                            total_room_persons+=room_persons;
                            for(let tr=1;tr<=total_travelers;tr++){
                                if(room_trvlr[tr]==room_id){
                                    room_price_one[tr]=0;
                                    room_trvlr[tr]=0;
                                    $('#room_for_traveler'+tr).val('');
                                }
                            }
                            room_previous[room_id]=0;

                        }
                    }else{
                        if(room_previous[room_id]>0){
                            rooms_total -= (parseInt(room_previous[room_id])*parseFloat(room_range_pricing[date_range_id][room_id]));
                            total_room_persons-=room_previous[room_id];
                            for(let tr=1;tr<=total_travelers;tr++){
                                if(room_trvlr[tr]==room_id){
                                    room_price_one[tr]=0;
                                    room_trvlr[tr]=0;
                                }
                            }
                            room_previous[room_id]=room_persons;
                            rooms_total += (room_persons*parseFloat(room_range_pricing[date_range_id][room_id]));
                            total_room_persons+=room_persons;
                        }else{
                            room_previous[room_id]=room_persons;
                            rooms_total += (room_persons*parseFloat(room_range_pricing[date_range_id][room_id]));
                            total_room_persons+=room_persons;
                        }
                        var rm=room_persons;
                        for(let tr=1;tr<=total_travelers;tr++){
                            if(room_trvlr[tr]===0){
                                if(rm>0){
                                    room_price_one[tr]=parseFloat(room_range_pricing[date_range_id][room_id]);
                                    room_trvlr[tr]=room_id;
                                    $('#room_for_traveler'+tr).val(room_id);
                                    rm--;
                                }
                            }
                        }
                    }//
                        calculate_total();
                   /* //
                    //     if(room_id>0){
                        for (var v = 0; v < rooms_added.length; v++) {
                            if (rooms_added[v] === room_id) {
                                id_found = true;
                            }
                        }
                        var room_now_persons=0;
                        if (id_found === false) {
                            if(id_found===false){
                                rooms_added.push(room_id);
                            }else{
                                $('#room_subtotal'+room_id).remove();
                            }
                            console.log(parseFloat(room_range_pricing[date_range_id][room_id]));
                            rooms_total += (parseInt(room_persons)*parseFloat(room_range_pricing[date_range_id][room_id]));
                            var room_this='<div class="priceflex1" id="room_subtotal'+room_id+'">'+
                                '<div>'+
                                    '<p>'+rooms_titles[room_id]+' for '+room_persons+ '</p>'+
                                '</div>'+
                                '<div>'+
                                    '<p style="">$'+parseFloat(rooms[room_id])+'</p>'+
                                '</div>'+
                            '</div>';
                            subprices_div.find('#rooms').show();
                            subprices_div.find('#rooms').append(room_this);
                             total_room_persons-=room_previous[room_id];
                             total_room_persons+=parseInt(room_persons);
                            // console.log('persons:'+room_persons+'-id:'+room_id+'-price'+(parseFloat(rooms[room_id])*parseInt(room_persons)));
                        } else {
                            for (var i = 0; i < rooms_added.length; i++) {
                                if (rooms_added[i] === room_id) {
                                    console.log(rooms_added);

                                    if (parseInt(room_persons) === 0) {
                                        room_now_persons = room_previous[room_id];
                                        rooms_added.splice(rooms_added.indexOf(room_id), 1);
                                    } else {
                                        room_now_persons = room_persons;
                                    }
                                    total_room_persons -= room_now_persons;
                                    // if(room_persons===0){
                                    console.log(parseFloat(room_range_pricing[date_range_id][room_id]));
                                        rooms_total -= (parseInt(room_now_persons)*parseFloat(room_range_pricing[date_range_id][room_id]));
                                    // }
                                    $('#room_subtotal' + room_id).remove();
                                }
                            }
                            if (rooms_added.length <= 0) {
                                subprices_div.find('#rooms').hide();
                            }
                        }
                    // }else{
                    //         if(room_previous[room_id]&&room_previous[room_id]>0){
                    //             total_room_persons-=room_previous[room_id];
                    //         }
                    //         total_room_persons+=parseInt(room_persons);
                            // console.log('total room persons:'+total_room_persons);
                        // }
                    room_previous[room_id]=room_persons;
                    calculate_total();
               // }
*/
                        $(".room").each(function() {
                            var allowed=total_travelers-total_room_persons;
                            // console.log('total room persons left:'+allowed);
                            var selected=parseInt($(this).val());

                            $(this).find("option").each(function() {
                                var $thisOption = $(this);
                                if($thisOption.val() > allowed) {
                                    $thisOption.not(':selected').attr("disabled", "disabled");
                                }else{
                                    $thisOption.removeAttr('disabled');
                                }
                                // console.log('Allowed+Selected:'+(allowed+selected));
                                if ($thisOption.val()<=(allowed+selected)){
                                    $thisOption.removeAttr('disabled');
                                }
                            });
                        });

            });
        });

        function calculate_total(){
            total=0;
            if(rooms_total>0){
                total+=rooms_total;
            }else{
                no_room_toast();
                total+=duration_total;
            }
            console.log(room_price_one);
            for(var tr=1;tr<=total_travelers;tr++){
                var ttl=0;
                if(room_trvlr[tr]>0){
                    ttl+=parseFloat(room_range_pricing[date_range_id][room_trvlr[tr]]);
                }
                console.log(room_trvlr);
                if(costume_trvlr[tr]>0){
                    ttl+=parseFloat(costume_trvlr[tr]);
                }
                if(ticket_trvlr[tr]>0){
                    ttl+=parseFloat(ticket_trvlr[tr]);
                }

                // console.log(tr+' ti:'+ticket_trvlr[tr]);
                console.log(ttl+' total:'+ticket_trvlr[tr]);
                // console.log(tr+' cu:'+costume_trvlr[tr]);
                var t=parseFloat(ttl);
                console.log(t);
                travelers_total[tr]=ttl;
                $('#trvlertotal'+tr).html('$'+t.toFixed(2));
                $('#trvlertotal_'+tr).html('$'+t.toFixed(2));
            }

            if(tickets_total>0){
                total+=tickets_total;
            }if(costume_total>0){
                total+=costume_total;
            }if(addons_total>0){
                total+=addons_total;
            }

            // total+=costume_total;
            // total+=addons_total;

            var subtotal=total;
            $('#subtotal').html('$'+subtotal.toFixed(2));
            var processing=processing_fee(total);

            total+=processing;
            $('.finaltotal').html('$'+total.toFixed(2))
            $('#processing_fee').html('$'+processing.toFixed(2))
            // console.log('total:'+total);
            var Deposit={{(float)DEPOSIT_AMOUNT_PERCENT/100}};
            var totalinstallment_={{(int)TOTAL_INSTALLMENTS}};

            Deposit=total*Deposit;
            var installment=(total-Deposit)/totalinstallment_;
            // console.log(payment_type+'$'+Deposit+' Deposit + $'+installment+' for '+totalinstallment_+' Months');
            $('#install').html('$'+Deposit.toFixed(2)+' Deposit + $'+installment.toFixed(2)+' for '+totalinstallment_+' Months')
        }
        function processing_fee(total){
            const fee={{(float)PROCESSING_FEE}};
            return total*(fee/100);
        }
        function no_room_toast(){
            var room_toast=$('#room_toast').html();
            if($('.toast-container').find('.room_toast').length === 0){
                $('.toast-container').append(room_toast);
            }
            var toastElList = [].slice.call(document.querySelectorAll('.room_toast'))
            var toastList = toastElList.map(function(toastEl) {
                // Creates an array of toasts (it only initializes them)
                return new bootstrap.Toast(toastEl,options) // No need for options; use the default options
            });

            toastList.forEach(toast => toast.show());
        }
        function trleft(){
           var trleft_=total_travelers;
            for(var tr=1;tr<=total_travelers;tr++){
                if(room_trvlr[tr]===0)
                {
                    trleft_-=1;
                }
            }
            return trleft_;
        }
    </script>
@endsection

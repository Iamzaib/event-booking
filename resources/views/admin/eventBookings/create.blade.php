@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.eventBooking.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.event-bookings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="travelers">Total Travelers</label>
                <select class="form-control select2 {{ $errors->has('travelers') ? 'is-invalid' : '' }}" onchange="window.location='{{request()->fullUrlWithQuery(['travelers'=>'trvlr'])}}'.replace('trvlr',this.value)" name="travelers" id="travelers" required>
                    @for($i=1;$i<=10;$i++)
                        <option value="{{$i}}" {{$i==$travelers?'selected':''}}>{{$i}} Person(s)</option>
                    @endfor
                </select>
                @if($errors->has('travelers'))
                    <div class="invalid-feedback">
                        {{ $errors->first('travelers') }}
                    </div>
                @endif
{{--                <span class="help-block">{{ trans('cruds.eventBooking.fields.booking_event_helper') }}</span>--}}
            </div>
{{--            <div class="form-group">--}}
{{--                <label for="booking_details">{{ trans('cruds.eventBooking.fields.booking_details') }}</label>--}}
{{--                <input class="form-control {{ $errors->has('booking_details') ? 'is-invalid' : '' }}" type="text" name="booking_details" id="booking_details" value="{{ old('booking_details', '') }}">--}}
{{--                @if($errors->has('booking_details'))--}}
{{--                    <div class="invalid-feedback">--}}
{{--                        {{ $errors->first('booking_details') }}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                <span class="help-block">{{ trans('cruds.eventBooking.fields.booking_details_helper') }}</span>--}}
{{--            </div>--}}
            <div class="form-group">
                <label class="required" for="booking_event_id">{{ trans('cruds.eventBooking.fields.booking_event') }}</label>
                <select class="form-control select2 {{ $errors->has('booking_event') ? 'is-invalid' : '' }}" name="booking_event_id" id="booking_event_id" required>
                    @foreach($booking_events as $id => $entry)
                        <option value="{{ $id }}" {{ old('booking_event_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('booking_event'))
                    <div class="invalid-feedback">
                        {{ $errors->first('booking_event') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.eventBooking.fields.booking_event_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="booking_by_user_id">{{ trans('cruds.eventBooking.fields.booking_by_user') }}</label>
                <select class="form-control select2 {{ $errors->has('booking_by_user') ? 'is-invalid' : '' }}" name="booking_by_user_id" id="booking_by_user_id" required>
                    @foreach($booking_by_users as $id => $entry)
                        <option value="{{ $id }}" {{ old('booking_by_user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('booking_by_user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('booking_by_user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.eventBooking.fields.booking_by_user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="booking_total">{{ trans('cruds.eventBooking.fields.booking_total') }}</label>
                <input class="form-control {{ $errors->has('booking_total') ? 'is-invalid' : '' }}" type="number" name="booking_total" id="booking_total" value="{{ old('booking_total', '') }}" step="0.01">
                @if($errors->has('booking_total'))
                    <div class="invalid-feedback">
                        {{ $errors->first('booking_total') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.eventBooking.fields.booking_total_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.eventBooking.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\EventBooking::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', 'active') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.eventBooking.fields.status_helper') }}</span>
            </div>
            <hr>
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
                    <div class="card" style="border: 1px solid #ced4da;border-radius: 6px">
                        <div class="card-header">
                            <h3 class="texthead22">Choose your Costume: Traveler {{$t}} </h3>
                        </div>
                        <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-6">

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

                    </div>
                @endif
                @if(count($trip->tickets)>0)
                    <div class="card" style="border: 1px solid #ced4da;border-radius: 6px">
                        <div class="card-header">
                            <h3 class="texthead22">Choose your Event Tickets: Traveler {{$t}}</h3>
                            <p>Lectus amet, sed et imperdiet. Varius id nam sem purus sed vel. Adipiscing sapien praesent bibendum non.</p>
                        </div>
                        <div class="card-body">
                        <div class="row">
                            @foreach($trip->tickets as $ticket)
                                <div class="col-md-6">
                                    <div class="choosepaymemyrad">
                                        <input type="checkbox" id="ticket_{{$t}}{{$ticket->id}}" class="ticket form-check-input" name="ticket[{{$t}}][{{$ticket->id}}]" {{old('ticket.'.$t.'.'.$ticket->id)&&old('ticket.'.$t.'.'.$ticket->id)==$ticket->id?'checked':''}} data-traveler="{{$t}}" value="{{$ticket->id}}" data-ticketprice="{{$ticket->ticket_price}}">
                                        <label for="ticket_{{$t}}{{$ticket->id}}">
                                            <div class="boxchlabl priceflex1 border0 ">
                                                <div>
                                                    <h3 class="marbot0" style="line-height: 22px;"><b>{{$ticket->ticket_title}}</b></h3>

                                                    <span class="smaltxt2">{{date('l M d',strtotime($ticket->ticket_date))}}</span>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        </div>
                    </div>
                @endif

                @if(count($trip->addons)>0&&$t==1)
                    <div class="card" style="border: 1px solid #ced4da;border-radius: 6px">
                        <div class="card-header">
                            <h3 class="texthead22">Choose any Additional Services</h3>
                            <p>Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus </p>
                        </div>
                        <div class="card-body">
                        <div class="row">
                            @foreach($trip->addons as $addon)
                                <div class="col-md-4">
                                    <div class="choosepaymemyrad">
                                        <input type="checkbox" id="addon_{{$addon->id}}" class="addons form-check-input" name="addon[{{$addon->id}}]" {{old('addon.'.$addon->id)&&old('addon.'.$addon->id)==$addon->id?'checked':''}} value="{{$addon->id}}" data-addonprice="{{$addon->addon_price}}">
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
                    </div>
                @endif
            @endfor
            <div class="card" style="border: 1px solid #ced4da;border-radius: 6px">
                <div class="card-header">
                    <h3 class="texthead22">Choose a payment option.</h3>
                </div>
                <div class="card-body">
                <div class="row">


                    <div class="col-md-6">
                        <div class="choosepaymemyrad">
                            <input type="radio" id="pay1" class="payment_type" name="payment_type form-check-input" {{old('paymentmethod')=='Installment'?'checked':''}} value="Installment">
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

                            <input type="radio" id="pay2" name="payment_type" class="payment_type form-check-input" {{old('paymentmethod')=='Full'?'checked':''}} value="Full">
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
            </div>

            <div class="card" style="border: 1px solid #ced4da;border-radius: 6px">
                <div class="card-header">
                <div class="row no-gutters">
                    <div class="col-md-12">
                        <h4 class="texthead22" style="margin: 20px 0;">Travel Details</h4>
                    </div>
                </div>
                </div>
                <div class="card-body">
                    <div class="row no-gutters">
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
                                                    <label for="first_name_{{$t}}" class="form-label">First name</label>
                                                    <input type="text" id="first_name_{{$t}}" class="form-control " required value="{{old('first_name.'.$t)}}" name="first_name[{{$t}}]" />
{{--                                                    <span class="floating-label">First name</span>--}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <!-- <label for="lastname" class="form-label">Last name</label>
                                                <input type="text" class="form-control" placeholder="Last name" id="lastname" required=""> -->
                                                <div class="prel">
                                                    <label for="last_name_{{$t}}" class="form-label">Last name</label>
                                                    <input type="text" class="form-control " id="last_name_{{$t}}" required value="{{old('last_name.'.$t)}}" name="last_name[{{$t}}]" />
                                                    <span class="floating-label"></span>
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
                                                  <input type="text" class="form-control " required />
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
                                                    <div class="form-check col-md-6 {{ $errors->has('gender') ? 'is-invalid' : '' }}">
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
                                                <textarea type="text" class="form-control " name="notes[{{$t}}]" style="height: auto" id="Notes{{$t}}" rows="4">{{old('notes.'.$t)}}</textarea>
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
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

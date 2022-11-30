@extends('layouts.front')

@section('styles')
    <style>
        /* Слайдер */
        .slider-custom-ab{
            max-width: 100%;
            position: relative;
            margin: auto;
            height: 212px;
        }
        /* Картинка масштабируется по отношению к родительскому элементу */
        .slider-custom-ab .item img {
            object-fit: cover;
            width: 100%;
            height: 212px;
        }
        /* Кнопки вперед и назад */
        .slider-custom-ab .previous, .slider-custom-ab .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            margin-top: -22px;
            padding: 16px;
            color: white;
            font-weight: bold;
            font-size: 16px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
        }
        .slider-custom-ab .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }
        /* При наведении на кнопки добавляем фон кнопок */
        .slider-custom-ab .previous:hover,
        .slider-custom-ab .next:hover {
            background-color: rgba(0, 0, 0, 0.2);
        }
        /* Анимация слайдов */
        .slider-custom-ab .item {
            animation-name: fade;
            animation-duration: 1.5s;
        }
        @keyframes fade {
            from {
                opacity: 0.4
            }
            to {
                opacity: 1
            }
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .show{
            display: block;
        }
		.modal-header {
    display: inline-block;
			text-align: center;
}
		.modal-body {
    position: relative;
    flex: 1 1 auto;
    padding: 1rem 4rem;
			text-align: center;
}
		.modal-body .follow_us img{
			filter: invert(75%) sepia(63%) saturate(6234%) hue-rotate(246deg) brightness(87%) contrast(156%);
			    margin: 12px;
    width: 25px;
		}
		.modal-body p{
			color: #545455;
    font-size: 18px;
			font-family: CircularStd, sans-serif !important;
		}
		.modal-title{
			color: black;
			font-family: CircularStd, sans-serif !important;
			font-weight: 600;
		}
		a.full-width.whitebtnmain.trip_page_reserve_btn{
    border-radius: 10px;

    font-size: 13px;
    font-weight: 500;
    padding: 10px 36px;
		}
		.overview_room_navbar {
    width: 100%;
    display: inline-block;
    margin-top: 100px;
}
		.this_dot{
			margin: 0px 5px;
    font-size: 20px;
		}
        .slick-list {
            max-width: 100%;
            margin: 0 auto;
            /*padding: 30px 0;*/
        }
        /*.slick-list .slick-slide {*/
        /*    font-size: 30px;*/
        /*    text-align: center;*/
        /*    padding: 40px 20px;*/
        /*    line-height: 2;*/
        /*    font-weight: 700;*/
        /*}*/
        .slick-list .slick-slide:nth-child(even) {
            /*background-color: #ddd;*/
        }
        .slick-list .slick-slide:nth-child(odd) {
            /*background-color: #ccc;*/
        }
        .slick-arrow {
            z-index: 1;
            width: 40px;
            height: 40px;
        }

        .slick-arrow:before {
            font-size: 30px;
        }
        .slick-next {
            right: 0;
        }
        .slick-prev {
            left: 0;
        }

        .btn-wrap {
            text-align: center;
            width: 100%;
        }

        /*slick End*/
        .slider-item {
            border: 1px solid #E1E1E1;
            border-radius: 5px;
            background: #FFF;
        }

        .slider-item .slider-image img {
            margin: 0 auto;
            width: 100%;
        }

        .slider-item .slider-main-detail {
            padding: 10px;
            border-radius: 0 0 5px 5px;
        }

        .slider-item:hover .slider-main-detail {
            background-color: #dbeeee !important;
        }

        .slider-item .price {
            float: left;
            margin-top: 5px;
        }

        .slider-item .price h5 {
            line-height: 20px;
            margin: 0;
        }

        .detail-price {
            color: #219FD1;
        }

        .slider-item .slider-main-detail .rating {
            color: #777;
        }

        .slider-item .rating {
            float: left;
            font-size: 17px;
            text-align: right;
            line-height: 52px;
            margin-bottom: 10px;
            height: 52px;
        }

        .slider-item .btn-add {
            width: 50%;
            float: left;
            border-right: 1px solid #E1E1E1;
        }

        .slider-item .btn-details {
            width: 50%;
            float: left;
        }

        .controls {
            margin-top: 20px;
        }

        .btn-info, .btn-info:visited, .btn-info:hover {
            background-color: #21BBD8;
            border-color: #21BBD8;
        }

        .btn-info {
            margin-left: 5px;
        }

        .slider-main-detail:hover {
            background-color: #dbeeee !important;
        }

        .AddCart {
            margin: 0px;
            padding: 5px;
            border-radius: 2px;
            margin-right: 10px;
        }

        .review {
            margin-bottom: 5px;
            padding-top: 5px;
        }
        .carousel-control-next, .carousel-control-prev {
            position: inherit;
            top: 0;
            bottom: 0;
            z-index: 1;
            display: inline-block;
            align-items: center;
            justify-content: center;
            width: 5%;
            padding: 0;
            color: #fff;
            text-align: center;
            background: 0 0;
            border: 0;
            opacity: .5;
            transition: opacity .15s ease;
        }
        .carousal_button_left_right {
            text-align: right;
            margin-bottom: 20px;
        }
        .carousel-dark .carousel-indicators [data-bs-target] {
            background-color: #000;
            border-radius: 50px;
            width: 15px;
            height: 10px;
            border: 0px;
            /* margin-top: 20px; */
        }

        .carousel-control-next-icon {
            background-image: url(assets/front/img/right_arrow.png);
        }
        .carousel-control-next-icon, .carousel-control-prev-icon {
            display: inline-block;
            width: 2rem;
            height: 2rem;
            background-repeat: no-repeat;
            background-position: 50%;
            background-size: auto;
        }
        .carousel-control-prev-icon{
            background-image: url(assets/front/img/left_arrow.png);
        }
        .carousel-dark .carousel-control-next-icon, .carousel-dark .carousel-control-prev-icon {
            filter: inherit;
        }
        .carousel-control-next, .carousel-control-prev {

            opacity: inherit;
            transition: inherit;
        }
        .carousel-dark .carousel-indicators [data-bs-target] {
            background-color: #700ede;
            border-radius: 50px;
            width: 15px;
            height: 10px;
            border: 0px;
            /* margin-top: 20px; */
        }
        .carousel h2{
            color: #000000;
            font-family: IBMPlexSans-SemiBold !important;
            /*    font-weight: 600;*/
        }
        .carousel h2 span{
            color: #A9A9AA;
        }
    </style>
@endsection
@section('content')
    <!--/hero_in-->
<div class="overview_room_navbar">
<div class="container">
	<div class="row">
	<div class="col-md-12">
                    <div class="flexbnjh">
                        <div class="titletourhead">
                            <h4>{{$trip->event_title}}</h4>

                        </div>

                    </div>

                </div>
	</div>
	<div class="row">
	<div class="col-md-8">
		<div class="starstriptitle">
                                @if(count($reviews)>0)
                                    @for($str=1;$str<=$avg_ratings;$str++)
                                        <img src="{{asset('assets/front/img/stars.svg')}}" />
                                    @endfor
                                        @else
                                            <img src="{{asset('assets/front/img/star-nfill.svg')}}" />
                                            <img src="{{asset('assets/front/img/star-nfill.svg')}}" />
                                            <img src="{{asset('assets/front/img/star-nfill.svg')}}" />
                                            <img src="{{asset('assets/front/img/star-nfill.svg')}}" />
                                            <img src="{{asset('assets/front/img/star-nfill.svg')}}" />

                                            @endif
                                <span><b class="this_dot">.</b>({{count($reviews)}} Review)<b class="this_dot">.</b></span>
								<div class="newseclocatimain mb-3" style="background: none; ">
                        <div class="inclusb">
<!--                            <img src="{{asset('assets/front/img/locationsp.svg')}}" />-->
                            <p>{{$trip->city->city_name}}, {{$trip->country->name}}</p>
                        </div>
                        <div class="inclusb">
<!--                            <img src="{{asset('assets/front/img/calendar.svg')}}" />-->
<!--                            <p>{{$trip->duration}} Days</p>-->
                        </div>
                        <div class="inclusb">
<!--                            <img src="{{asset('assets/front/img/age.svg')}}" />-->
<!--                            <p>Age {{$trip->age}}</p>-->
                        </div>
                    </div>
                            </div></div>
		<div class="col-md-4">
		<div class="btsgar">

								<button data-toggle="modal" data-target="#myModal"><img src="{{ asset('assets/front/img/share-06.svg')}}" />&nbsp;<span>Share</span></button>
								<button><img src="{{ asset('assets/front/img/hearts.svg')}}" />&nbsp;<span>Save</span></button>
<!--
							<div class="grid-sort-icon docfil">
                                <img src="{{asset('assets/front/img/heart2.svg')}}" class="favourite {{favorite_check($trip->id,auth()->id())?'favourite-filter':''}}" data-id="{{$trip->id}}">
                            </div>
-->
{{--                            <div class="grid-sort-icon docfil">--}}
{{--                                <img src="{{asset('assets/front/img/export.svg')}}">--}}
{{--                            </div>--}}
                        </div>

		</div>
	</div>
<div class="row">
	<div class="col-md-12">

		<nav class="secondary_nav sticky_horizontal">
                        <div class="container" style="padding: 0px">
                            <ul class="clearfix">
                                <li><a href="#overview" class="active">Overview</a></li>
                                <li><a href="#rooms">Room</a></li>
                                <li><a href="#Itinerary">Itinerary</a></li>
                                <li><a href="#information">information</a></li>
                                <li><a href="#faq">FAQ</a></li>
                                <li><a href="#reviews">Reviews</a></li>
                                <li><a href="#"></a></li>
                            </ul>
                        </div>
                    </nav>
		</div>
	</div>
</div>
</div>
<div class="container">
<div class="row">
	<div class="col-md-8">
	@if(isset($page_type)&&$page_type=='trip')
	<div class="trip_image_top">
        @if($trip->featured_image)
            <img src="{{ $trip->featured_image->getUrl() }}" class="tourdetailshead1">
        @else
            <img src="{{asset('assets/front/img/tourdetailsbg1.png')}}" class="tourdetailshead1" />
        @endif
	</div>
    @endif
	</div>
	<div class="col-md-4">
	<aside id="sidebar">
                    <div class="pricebox1">
                        <h6>
                            <small style="font-size: 12px">Price per person</small>
                        </h6>
                        <h2>{{display_currency($trip->daily_price*$trip->duration)}}</h2>
                        <p>
                           All prices are in USD.
                        </p>
                        <a href="{{route('frontend.custom_trip',['trip_title'=>str_replace(' ','-',$trip->event_title),'trip'=>$trip->id])}}" class="full-width whitebtnmain trip_page_reserve_btn">Reserve</a>
						<p style="margin-top: 30px;">
                          <img src="{{asset('assets/front/img/Icon.png')}}"  style="width:13px;margin-top: -5px;margin-right: 5px; ">&nbsp;All payments are NON-REFUNDABLE
                        </p>
                    </div>

                    <div class="pricebox2">
                        <h2>Customize your trip.</h2>
                        <p>
                            Create the trip of your dreams, your way. Plan and organize every detail of your trips from your accommodation to spa and makeup services.
                        </p>
<!--                        <a href="tel:{{AGENT_NUMBER}}" class="outlinebtn2">Speak to Carnival Utopia Agent</a>-->

                    </div>
                    <div class="pricebox2">
						<h2>Have a Question?</h2>
                        <p>Feel free to reach out and we're happy to answer any questions you may have.</p>


                        <div class="mt-4">
                            <p>
                                <a href="mailto:{{INFO_EMAIL}}">
<!--									<img src="{{asset('assets/front/img/sms.svg')}}" alt=""> -->

									Email
<!--									{{INFO_EMAIL}}-->
								</a>
                            </p>
                            <p>
                                <a href="tel:{{AGENT_NUMBER}}">
<!--									<img src="{{asset('assets/front/img/call-calling.svg')}}" alt="">-->
									Whatsapp</a>
                            </p>
							<p>
                                <a href="tel:{{AGENT_NUMBER}}">
<!--									<img src="{{asset('assets/front/img/call-calling.svg')}}" alt="">-->
									iMessage</a>
                            </p>
							<p>
                                <a href="tel:{{AGENT_NUMBER}}">
<!--									<img src="{{asset('assets/front/img/call-calling.svg')}}" alt="">-->
									Book a consultation</a>
                            </p>
                        </div>



                    </div>
<!--
                    <div class="pricebox2" id="why_choose_us">
                        <h2>Why Choose Us</h2>
                        <p>
                            <ul>
								<li>Value for money</li>
								<li>24/7 Personal Concierge</li>
								<li>Booking is easy as a few clicks.</li>
								<li>Worry free experience</li>

						</ul>
                        </p>


                    </div>
-->
                </aside>
	</div>
	</div>
</div>

    <div class="bg_colorfd">
        <div class="container">
            <div class="row tourrow1">

                <div class="col-lg-9">

<!--
                    <div class="newseclocatimain mb-3" style="background: none;padding: 12px 0px;">
                        <div class="inclusb">
                            <img src="{{asset('assets/front/img/locationsp.svg')}}" />
                            <p>{{$trip->city->city_name}}, {{$trip->country->name}}</p>
                        </div>
                        <div class="inclusb">
                            <img src="{{asset('assets/front/img/calendar.svg')}}" />
                            <p>{{$trip->duration}} Days</p>
                        </div>
                        <div class="inclusb">
                            <img src="{{asset('assets/front/img/age.svg')}}" />
                            <p>Age {{$trip->age}}</p>
                        </div>
                    </div>
-->


                    <section id="overview" class="nbfdj">

                        <div class="trip-overview" id="trip-overview">
                            {!! $trip->overview !!}
                        </div>

                        <div class="incljhhd2">
                            <h4>Included/Excluded</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    @foreach($trip->amenities_includeds as $amenities_included)
                                    <div class="inclusb">
                                        <img src="{{asset('assets/front/img/tick-circle.svg')}}" />
                                        <p>{{$amenities_included->title}}</p>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="col-md-6">
                                    @foreach($trip->amenities_excludeds as $amenities_excluded)
                                        <div class="inclusb">
                                            <img src="{{asset('assets/front/img/close-circle.svg')}}" />
                                            <p>{{$amenities_excluded->title}}</p>
                                        </div>
                                    @endforeach
                                </div>

{{--                                <div class="col-md-6">--}}
{{--                                    <div class="seemoretxt2">--}}
{{--                                        <p>See All</p>--}}
{{--                                        <img src="{{asset('assets/front/img/right-arrow-1.svg')}}" />--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>

                        </div>





                    </section>
                    <section id="rooms" class="nbfdj">
						<h4>Where you'll sleep</h4>
{{--                        <div class="priceflex1">--}}
{{--                            <div>--}}
{{--                                <h3 class="texthead22 marbot0 martop0">Choose a room</h3>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <h1 class="arwsqft marbot0">--}}
{{--                                    <a onclick="dropdown('myDropdown')"  style="color: #1C1C1C; border-bottom: 1px solid #1C1C1C;" ><b class="dropbtn" id="selected_room">1 room, 2 travelers </b></a><img onclick="dropdown('myDropdown')" class="dropbtn" src="{{asset('assets/front/img/arrow-square-down.svg')}}">--}}

{{--                                    <div class="dropdown">--}}
{{--                                        <div id="myDropdown" class="dropdown-content">--}}
{{--                                            <a href="Javascript:void('');" onclick="document.getElementById('selected_room').innerHTML=this.innerHTML;filter_room(this)" data-capacity="2">1 room, 2 travelers </a>--}}
{{--                                            <a href="Javascript:void('');" onclick="document.getElementById('selected_room').innerHTML=this.innerHTML;filter_room(this)" data-capacity="4">2 room, 4 travelers </a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </h1>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="roomsdetails">

                            @php $total_sliders=0; @endphp
                            @foreach($trip->hotels as $hotel)
                                @if($hotel->id==2) @continue @endif
                                    @foreach($hotel->rooms as $room)


                                    @if ($loop->last)
                                         @php $total_sliders+=$loop->count; @endphp
                                    @endif
                                        @if ($loop->first)
                                         @php $first_room=$room->id; @endphp
                                    @endif
                                    <div class="roomsdetailc1" data-capacity="{{$room->room_capacity}}">
                                        <div class="roomsdetailimg">

                                            @if(count($room->room_images)>0)
                                            <div class="slider-custom-ab">
                                                @foreach($room->room_images as $key => $media)
{{--                                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">--}}
{{--                                                        <img src="{{ $media->getUrl('thumb') }}">--}}
{{--                                                    </a>--}}
                                                    <div class="item slider-item-ab{{$loop->parent->index}}">
                                                        <img src="{{ $media->getUrl('slider_display') }}">
                                                    </div>
                                            @endforeach
                                                <!-- Первый слайд -->

                                                <!-- Кнопки-стрелочки -->
                                                <a class="previous" onclick="previousSlide({{$loop->index}})">&#10094;</a>
                                                <a class="next" onclick="nextSlide({{$loop->index}})">&#10095;</a>
                                            </div>
                                            @else
                                                <img src="{{asset('assets/front/img/room1.png')}}" />
                                            @endif
                                        </div>
                                        <div class="roomsdetailinfo">
<!--
                                            <div class="roomddetinfo1">
                                                <div>
                                                    <h2><span>{{$hotel->hotel_name}}</span> by Ocean Hotels</h2>
                                                </div>
                                                <div class="roomddetsbinfo1">
                                                    <img src="{{asset('assets/front/img/stars.svg')}}" />
                                                    <img src="{{asset('assets/front/img/stars.svg')}}" />
                                                    <img src="{{asset('assets/front/img/stars.svg')}}" />
                                                    <img src="{{asset('assets/front/img/stars.svg')}}" />
                                                    <img src="{{asset('assets/front/img/stars.svg')}}" />
                                                </div>
                                            </div>
-->
                                            <h3>{{$room->room_title}}</h3>
											<h2>{{$room->details}}</h2>
<!--                                            <h6> {{$room->details}}</h6>-->
<!--											<button>More details &nbsp;></button>-->
                                            <div class="cb1sbt5">
{{--                                                <h1 class="arwsqft"><a href="#">Price details</a> <img src="{{asset('assets/front/img/arrow-square-down.svg')}}">--}}
{{--                                                </h1>--}}
                                            </div>
                                        </div>
                                        <div class="roomsdetailprice" style="width: 30%">
{{--                                            @if($room->discount_price!=''&&$room->room_price>$room->discount_price)--}}
{{--                                                <h2> <span>{{display_currency($room->room_price)}}</span> {{display_currency($room->discount_price)}}</h2>--}}
{{--                                            @else--}}
{{--                                                <h2> {{display_currency($room->room_price)}}</h2>--}}
{{--                                            @endif--}}
{{--                                            <a href="{{route('frontend.checkout_review',['step'=>'review','trip'=>$trip->id,'room'=>$room->id])}}" class="btn_1  btngrad">Reserve</a>--}}
{{--                                        --}}
                                        </div>
                                    </div>
                                    @endforeach
                            @endforeach

                        </div>
                    </section>
                    @if(count($trip->itinerary)>0)
                    <section id="Itinerary" class="nbfdj">
                        <h4>Itinerary</h4>
                        <ul class="cbp_tmtimeline">
                            @foreach($trip->itinerary as $itinerary)
                                @if($itinerary->title!='')
                            <li>
<!--
                                <time class="cbp_tmtime" datetime="{{$itinerary->time}}"><span>{{$itinerary->duration}}</span><span>{{$itinerary->time}}</span>
                                </time>
-->
                                <div class="cbp_tmicon">
                                    <img src="{{asset('assets/front/img/clock.svg')}}" />
                                </div>
                                <div class="cbp_tmlabel">
                                    <div class="hidden-xs"></div>
                                    <h4>{{$itinerary->title}}</h4>
                                    <p>
                                        {{$itinerary->detail}}
                                    </p>
                                </div>
                            </li>
                                @endif
                            @endforeach

                        </ul>

                        <!-- /row -->
                    </section>
                    @endif
                    <section id="information" class="nbfdj">
                        <h3 class="texthead22">Information</h3>
                        <p class="hjfgeiau">
                            {!! $trip->information !!}
                        </p>

                    </section>
                    @if(count($trip->faqs)>0)
                        <section id="faq" class="nbfdj">
                            <h3 class="texthead22">FAQ</h3>
                            <div class="">
                                @foreach($trip->faqs as $faq)
                                    <details class="faq-card" onclick="faq_open_close(this)">
                                        <summary>{{$faq->question}} <span class="faq-open-icon"><img src="{{asset('assets/front/img/plus_sign.svg')}}" width="20" alt=""></span>
                                        </summary>
                                        <span class="faq-card-spoiler">{{$faq->answer}}</span>
                                    </details>
                                @endforeach
                            </div>

                        </section>
                    @endif

                    <section id="reviews" class="gduuuuu">
                        <h3 class="texthead22">Reviews</h3>
                        <br />
                        <div class="reviews-container">
                            <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <div id="review_summary">
                                        <strong>{{$avg_ratings}}</strong>
                                        <em></em>
                                        <small>Based on {{count($reviews)}} reviews</small>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-9">
                                    @foreach($ratings_percent as $ratings => $percent)
                                    <div class="row">
                                        <div class="col-lg-10 col-9">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: {{$percent['percent']}}%" aria-valuenow="{{$percent['percent']}}"
                                                     aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-3">
                                            <small><strong>{{$ratings}} stars</strong></small>
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                            <!-- /row -->
                        </div>



                        <div class="reviews-container">
                            @if(count($reviews)>0)
                                @foreach($reviews as $review)
                            <div class="review-box clearfix {{$loop->count>3&&$loop->index>2?'hidden-reviews':''}}" style="{{$loop->count>3&&$loop->index>2?'display:none':''}}">
                                <div class="rev-content">
                                    <div class="reviewflex">
                                        <div class="revflexsub">
                                            <div>
                                                <img src="{{isset($review->user->profileimage)?$review->user->profileimage->getUrl():asset('assets/front/img/avatar1.jpg')}}" />
                                            </div>
                                            <div>
                                                <h4>{{$review->user->name.' '.$review->user->lastname}}</h4>
{{--                                                <p>Co-founder</p>--}}
                                            </div>
                                        </div>
                                        <div>
                                            <div class="rating">
                                                @for($star=1;$star<=$review->ratings;$star++)
                                                <img src="{{asset('assets/front/img/stars.svg')}}" style="width: 14px; height: 14px" />

                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rev-text">
                                        <p>
                                            ”{{$review->review_text}}”
                                        </p>
                                    </div>
                                </div>
                            </div>

                                @endforeach
@if(count($reviews)>3)
                                    <h1 class="arwsqft" onclick="text_toggle();"><a id="hide_show_reviews">Show More {{count($reviews)-3}} reviews</a> <img src="{{asset('assets/front/img/arrow-square-down.svg')}}"></h1>
@endif
                            @endif


                        </div>
                        <!-- /review-container -->
                    </section>
                    <!-- /section -->

                </div>
                <!-- /col -->


            </div>
            <!-- /row -->
        </div>
			<div class="container">
  <!-- Trigger the modal with a button -->
<!--  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
<!--          <button type="button" class="close" data-dismiss="modal">&times;</button>-->
          <h4 class="modal-title">Share it with your friends</h4>
        </div>
        <div class="modal-body">
          <p>Id quis arcu eget urna nulla. Condimentum facilisis cras integer interdum faucibus iaculis. Nunc mauris </p>
			<div class="follow_us">
                            <ul>
{{--                                <li>--}}
{{--                                    <a href="#0">--}}
{{--                                        <img src="{{url('/')}}/assets/front/img/instagram.svg">--}}
{{--                                    </a>--}}
{{--                                </li>--}}
<li>
                                    <a href="http://twitter.com/share?text={{$trip->event_title.' at '.env('APP_NAME')}}&url={{request()->url()}}"> <img src="{{url('/')}}/assets/front/img/twitter.svg"></a>
                                </li>
                                <li>
                                    <a href="whatsapp://send?text={{$trip->event_title.' at '.env('APP_NAME')}} link:{{request()->url()}}" data-action="share/whatsapp/share"> <img src="{{url('/')}}/assets/front/img/whatsapp.svg"></a>
                                </li>
                                <li>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{request()->url()}}"> <img src="{{url('/')}}/assets/front/img/facebook.svg"></a>
                                </li>
                                <li>
                                    <a href="#"> <img src="{{url('/')}}/assets/front/img/telegram.svg"></a>
                                </li>
                                <li>
                                    <a href="#"> <img src="{{url('/')}}/assets/front/img/discord.svg"></a>
                                </li>

                            </ul>
                        </div>
			<div  class="newsletter-form" >
                        <input type="hidden" name="_token" value="jzlcZuv09RZHGLyjfgN2AB9WIzV9CHRTdXJb3T9O">
            <div class="input-field">
                <input class="input" type="text" name="text" id="trip_url" placeholder="{{request()->url()}}" aria-label="Enter an email address" value="{{urldecode(request()->url())}}"><button class="btn_1  btngrad" onclick="navigator.clipboard.writeText(document.getElementById('trip_url').value)" aria-label="Subscribe" readonly>
                                Copy
                            </button></div>
                    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

</div>
        <!-- /container -->
    </div>
    <!-- /bg_color_1 -->

    <div class="container container-custom ">
        <div class="row">
            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel" data-bs-interval="false">
                <div class="row">
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <h2>Carnival experiences. <span>Take a look at what’s new, right now.</span></h2>
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="carousal_button_left_right">
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <div class="row">
                            @foreach($featured_trips as $featured_trip)

                                <div class="col-xl-4 col-lg-4 col-md-4 ">
                                    <div class="box_grid">

                                        <figure>
                                            <a href="{{route('frontend.trip_view',['trip_title'=>$featured_trip->event_title,'event'=>$featured_trip->id])}}"><img src="{{ $featured_trip->featured_image?$featured_trip->featured_image->getUrl():asset('assets/front/img/tour_1.jpg')}}" class="img-fluid" alt="" width="800"
                                                                                                                                                                   height="533"></a>
                                            <div class="tourdivf1">
                                                {{--                                <div>--}}
                                                {{--                                    <small><img src="{{ asset('assets/front/img/clock.png')}}" /> 25:26:31</small>--}}
                                                {{--                                </div>--}}

                                                <div>
                                                    <img class="favoriteicoimg {{favorite_check($featured_trip->id,auth()->id())?'favourite-filter':''}} favourite" data-id="{{$featured_trip->id}}" src="{{ asset('assets/front/img/heart2.svg')}}" />
                                                </div>
                                            </div>
                                        </figure>

                                        <div class="">
                                            <a href="{{route('frontend.trip_view',['trip_title'=>$featured_trip->event_title,'event'=>$featured_trip->id])}}" class="titltxt">{{$featured_trip->event_title}}</a>
                                            <div class="one_star_home"><img src="{{ asset('assets/front/img/stars.svg')}}">&nbsp;&nbsp;{{number_format($avg_ratings_events[$featured_trip->id],1)}}</div>
                                            <div class="tourdivf2">
                                                <div>
                                                <!--                                    <img src="{{ asset('assets/front/img/location.svg')}}" />-->
                                                    <span>{{$featured_trip->city->city_name}}, {{$featured_trip->country->name}}</span>
                                                </div>
                                                <div>
                                                <!--                                    <img src="{{ asset('assets/front/img/calendar.svg')}}" />-->
                                                    <span>{{$ranges[$featured_trip->id]}} </span>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                </div>

                                @if($loop->remaining>0&&($loop->index+1)%3==0)
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="{{$slide=0}}" class="active" aria-current="true" aria-label="Slide 1"></button>
                    @foreach($featured_trips as $featured_trip)
                        @if($loop->remaining>0&&($loop->index+1)%3==0)
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="{{$slide++}}" aria-label="Slide {{$slide++}}"></button>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
{{--        <div class="main_title_2" style="text-align: left;  margin-bottom: 25px;">--}}
{{--            <!-- <span><em></em></span> -->--}}
{{--            <h2 style="font-size: 20px;">Upcoming carnival packages</h2>--}}
{{--            <!-- <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p> -->--}}
{{--        </div>--}}
{{--        <div class="wrapper-grid">--}}
{{--            <div class="row">--}}
{{--                @foreach($featured_trips as $featured_trip)--}}
{{--                    <div class="col-xl-4 col-lg-4 col-md-4">--}}
{{--                        <div class="box_grid">--}}

{{--                            <figure>--}}
{{--                                <a href="{{route('frontend.trip_view',['trip_title'=>$featured_trip->event_title,'event'=>$featured_trip->id])}}"><img src="{{ $featured_trip->featured_image?$featured_trip->featured_image->getUrl():asset('assets/front/img/tour_1.jpg')}}" class="img-fluid" alt="" width="800"--}}
{{--                                                                                                                                                       height="533"></a>--}}
{{--                                <div class="tourdivf1">--}}
{{--                                    --}}{{--                                <div>--}}
{{--                                    --}}{{--                                    <small><img src="{{ asset('assets/front/img/clock.png')}}" /> 25:26:31</small>--}}
{{--                                    --}}{{--                                </div>--}}

{{--                                    <div>--}}
{{--                                        <img class="favoriteicoimg {{favorite_check($featured_trip->id,auth()->id())?'favourite-filter':''}} favourite" data-id="{{$featured_trip->id}}" src="{{ asset('assets/front/img/heart2.svg')}}" />--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </figure>--}}

{{--                            <div class="">--}}
{{--                                <a href="{{route('frontend.trip_view',['trip_title'=>$featured_trip->event_title,'event'=>$featured_trip->id])}}" class="titltxt">{{$featured_trip->event_title}}</a>--}}
{{--                                <div class="tourdivf2">--}}
{{--                                    <div>--}}
{{--                                        <img src="{{ asset('assets/front/img/calendar.svg')}}" />--}}
{{--                                        <span>{{$featured_trip->duration}} Days</span>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <img src="{{ asset('assets/front/img/location.svg')}}" />--}}
{{--                                        <span>{{$featured_trip->city->city_name}}, {{$featured_trip->country->name}}</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--            <!-- /row -->--}}
{{--        </div>--}}
        <!-- /wrapper-grid -->
        <br>
        <br>
        <br>
    </div>
    <!-- /container -->

@endsection
@section('scripts')
    @parent
    <script>
        $(function (){
           $('#trip-overview').find('ul').addClass('bullets2 bbbhssgdu') ;

        });
        var show=false;
        function text_toggle(){
            $('.hidden-reviews').toggle();
            var link=$('#hide_show_reviews');
            // console.log(link);
            if(show===false){
                link.html('Hide More {{count($trip->reviews)-3}} reviews');
                show=true;
            }else{

                show=false; link.html('Show More {{count($trip->reviews)-3}} reviews');
            }

        }
        /* Устанавливаем индекс слайда по умолчанию */
        var slideIndex=[];
       // showSlides(slideIndex);
        var current_slider='',total_slider={{$total_sliders}};
        for(var i=0;i<total_slider;i++){
             slideIndex[i] = 1;
            showSlides(slideIndex[i],i);
        }
        /* Увеличиваем индекс на 1 — показываем следующий слайд*/
        function nextSlide(slider) {
            showSlides(slideIndex[slider] += 1,slider);
        }

        /* Уменьшает индекс на 1 — показываем предыдущий слайд*/
        function previousSlide(slider) {
            showSlides(slideIndex[slider] -= 1,slider);
        }

        // /* Устанавливаем текущий слайд */
        // function currentSlide(n) {
        //     showSlides(slideIndex = n);
        // }

        /* Функция перелистывания */
        function showSlides(n,slider) {

            let i;
            //let slides = document.getElementsByClassName("item");
            //if(slider!==''){
                let slides = document.getElementsByClassName("slider-item-ab"+slider);
            //}
            console.log("slider-item-ab"+slider,n);

            if (n > slides.length) {
                slideIndex[slider] = 1
            }
            if (n < 1) {
                slideIndex[slider] = slides.length
            }

            /* Проходим по каждому слайду в цикле for */
            for (let slide of slides) {
                slide.style.display = "none";
            }
            slides[slideIndex[slider] - 1].style.display = "block";
        }
        function dropdown(dropdown_id){
            var dropdown=$('#'+dropdown_id);
            if(dropdown.hasClass('show')){
                dropdown.removeClass('show');
            }else{
                dropdown.addClass('show');
            }
        }
        window.onclick = function(event) {
            // console.log(event.target);
            if (!event.target.matches('.dropbtn')) {

                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
        function filter_room(selected){
            var capacity=$(selected).data('capacity');
            $('div[class="roomsdetailc1"]').each(function(index,item){
                $(item).fadeOut('slow');
                console.log($(item).data('capacity'));
                console.log(capacity);
                if(parseInt($(item).data('capacity'))>=parseInt(capacity)){
                    $(item).fadeIn('slow');
                }
            });
        }
        function faq_open_close(faq){
         var img=$(faq).find('img');
         var src=img.attr('src');
             if(src=='{{asset('assets/front/img/plus_sign.svg')}}'){
                 img.attr('src','{{asset('assets/front/img/minus.svg')}}');
             }else{
                 img.attr('src','{{asset('assets/front/img/plus_sign.svg')}}');
             }

        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.js"></script>
    <script>
        $(document).ready(function () {
            $(".slick-list").slick({
                dots: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                arrows: false,
                infinite: false,
                autoplay: false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
            $(".prev-btn").click(function () {
                $(".slick-list").slick("slickPrev");
            });

            $(".next-btn").click(function () {
                $(".slick-list").slick("slickNext");
            });
            $(".prev-btn").addClass("slick-disabled");
            $(".slick-list").on("afterChange", function () {
                if ($(".slick-prev").hasClass("slick-disabled")) {
                    $(".prev-btn").addClass("slick-disabled");
                } else {
                    $(".prev-btn").removeClass("slick-disabled");
                }
                if ($(".slick-next").hasClass("slick-disabled")) {
                    $(".next-btn").addClass("slick-disabled");
                } else {
                    $(".next-btn").removeClass("slick-disabled");
                }
            });
        });

    </script>
@endsection

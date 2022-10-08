@extends('layouts.front')

@section('styles')
    <style>
        /* Слайдер */
        .slider-custom-ab{
            max-width: 100%;
            position: relative;
            margin: auto;
            height: 150px;
        }
        /* Картинка масштабируется по отношению к родительскому элементу */
        .slider-custom-ab .item img {
            object-fit: cover;
            width: 100%;
            height: 150px;
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
    </style>
@endsection
@section('content')
    <!--/hero_in-->

    <div class="bg_colorfd">
        <div class="container margin_60_35">
            <div class="row tourrow1">
                <div class="col-md-12">
                    <div class="flexbnjh">
                        <div class="titletourhead">
                            <div class="starstriptitle">
                                <img src="{{asset('assets/front/img/stars.svg')}}" />
                                <img src="{{asset('assets/front/img/stars.svg')}}" />
                                <img src="{{asset('assets/front/img/stars.svg')}}" />
                                <img src="{{asset('assets/front/img/stars.svg')}}" />
                                <img src="{{asset('assets/front/img/stars.svg')}}" />
                                <span>(24 Review)</span>
                            </div>
                            <h4>{{$trip->event_title}}</h4>
                        </div>
                        <div class="btsgar">
                            <div class="grid-sort-icon docfil">
                                <img src="{{asset('assets/front/img/heart2.svg')}}" class="favourite {{favorite_check($trip->id,auth()->id())?'favourite-filter':''}}" data-id="{{$trip->id}}">
                            </div>
                            <div class="grid-sort-icon docfil">
                                <img src="{{asset('assets/front/img/export.svg')}}">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-9">


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

                        <div class="newseclocatimain">
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



                    </section>
                    <section id="rooms" class="nbfdj">
                        <div class="priceflex1">
                            <div>
                                <h3 class="texthead22 marbot0 martop0">Choose a room</h3>
                            </div>
                            <div>
                                <h1 class="arwsqft marbot0">
                                    <a onclick="dropdown('myDropdown')"  style="color: #1C1C1C; border-bottom: 1px solid #1C1C1C;" ><b class="dropbtn" id="selected_room">1 room, 2 travelers </b></a><img onclick="dropdown('myDropdown')" class="dropbtn" src="{{asset('assets/front/img/arrow-square-down.svg')}}">

                                    <div class="dropdown">
                                        <div id="myDropdown" class="dropdown-content">
                                            <a href="Javascript:void('');" onclick="document.getElementById('selected_room').innerHTML=this.innerHTML;filter_room(this)" data-capacity="2">1 room, 2 travelers </a>
                                            <a href="Javascript:void('');" onclick="document.getElementById('selected_room').innerHTML=this.innerHTML;filter_room(this)" data-capacity="4">2 room, 4 travelers </a>
                                        </div>
                                    </div>
                                </h1>
                            </div>
                        </div>

                        <div class="roomsdetails">
                            @foreach($trip->hotels as $hotel)
                                    @foreach($hotel->rooms as $room)


                                    @if ($loop->last)
                                         @php $total_sliders=$loop->count; @endphp
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
                                            <div class="roomddetinfo1">
                                                <div>
                                                    <h2><span>{{$hotel->hotel_name}}</span> by Ocean Hotels</h2>
                                                </div>
                                                <div class="roomddetsbinfo1">
                                                    <img src="{{asset('assets/front/img/stars.svg')}}" />
                                                    <img src="{{asset('assets/front/img/stars.svg')}}" />
                                                    <img src="{{asset('assets/front/img/stars.svg')}}" />
                                                    <img src="{{asset('assets/front/img/stars.svg')}}" />
                                                    <img src="{{asset('assets/front/img/star-nfill.svg')}}" />
                                                </div>
                                            </div>
                                            <h3>{{$room->room_title}}</h3>
                                            <h6> {{$room->details}}</h6>
                                            <div class="cb1sbt5">
{{--                                                <h1 class="arwsqft"><a href="#">Price details</a> <img src="{{asset('assets/front/img/arrow-square-down.svg')}}">--}}
{{--                                                </h1>--}}
                                            </div>
                                        </div>
                                        <div class="roomsdetailprice">
                                            @if($room->discount_price!=''&&$room->room_price>$room->discount_price)
                                                <h2> <span>{{display_currency($room->room_price)}}</span> {{display_currency($room->discount_price)}}</h2>
                                            @else
                                                <h2> {{display_currency($room->room_price)}}</h2>
                                            @endif
{{--                                            <a href="{{route('frontend.checkout_review',['step'=>'review','trip'=>$trip->id,'room'=>$room->id])}}" class="btn_1  btngrad">Reserve</a>--}}
                                        </div>
                                    </div>
                                    @endforeach
                            @endforeach

                        </div>
                    </section>
                    <section id="Itinerary" class="nbfdj">
                        <h4>Itinerary</h4>
                        <ul class="cbp_tmtimeline">
                            @foreach($trip->itinerary as $itinerary)
                                @if($itinerary->title!='')
                            <li>
                                <time class="cbp_tmtime" datetime="{{$itinerary->time}}"><span>{{$itinerary->duration}}</span><span>{{$itinerary->time}}</span>
                                </time>
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
                    <section id="information" class="nbfdj">
                        <h3 class="texthead22">Information</h3>
                        <p class="hjfgeiau">
                            {!! $trip->information !!}
                        </p>

                    </section>
                    <section id="faq" class="nbfdj">
                        <h3 class="texthead22">FAQ</h3>
                        <div class="">
                            @foreach($trip->faqs as $faq)
                                <details class="faq-card">
                                    <summary>{{$faq->question}} <span class="faq-open-icon"><i class="fa fa-angle-up"></i></span>
                                    </summary>
                                    <span class="faq-card-spoiler">{{$faq->answer}}</span>
                                </details>
                            @endforeach
                        </div>

                    </section>


                    <section id="reviews" class="gduuuuu">
                        <h3 class="texthead22">Reviews</h3>
                        <br />
                        <div class="reviews-container">
                            <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <div id="review_summary">
                                        <strong>8.5</strong>
                                        <em>Superb</em>
                                        <small>Based on 5 reviews</small>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-9">
                                    <div class="row">
                                        <div class="col-lg-10 col-9">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90"
                                                     aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-3">
                                            <small><strong>5 stars</strong></small>
                                        </div>
                                    </div>
                                    <!-- /row -->
                                    <div class="row">
                                        <div class="col-lg-10 col-9">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 5%" aria-valuenow="95"
                                                     aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-3">
                                            <small><strong>4 stars</strong></small>
                                        </div>
                                    </div>
                                    <!-- /row -->
                                    <div class="row">
                                        <div class="col-lg-10 col-9">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 3%" aria-valuenow="60"
                                                     aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-3">
                                            <small><strong>3 stars</strong></small>
                                        </div>
                                    </div>
                                    <!-- /row -->
                                    <div class="row">
                                        <div class="col-lg-10 col-9">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 2%" aria-valuenow="20"
                                                     aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-3">
                                            <small><strong>2 stars</strong></small>
                                        </div>
                                    </div>
                                    <!-- /row -->
                                    <div class="row">
                                        <div class="col-lg-10 col-9">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 0" aria-valuenow="0"
                                                     aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-3">
                                            <small><strong>1 stars</strong></small>
                                        </div>
                                    </div>
                                    <!-- /row -->
                                </div>
                            </div>
                            <!-- /row -->
                        </div>



                        <div class="reviews-container">
                            <div class="review-box clearfix">
                                <div class="rev-content">
                                    <div class="reviewflex">
                                        <div class="revflexsub">
                                            <div>
                                                <img src="{{asset('assets/front/img/avatar1.jpg')}}" />
                                            </div>
                                            <div>
                                                <h4>Annette Black</h4>
                                                <p>Co-founder</p>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="rating">
                                                <img src="{{asset('assets/front/img/stars.svg')}}" style="width: 14px; height: 14px" /><img src="{{asset('assets/front/img/stars.svg')}}"
                                                                                                                    style="width: 14px; height: 14px" /><img src="{{asset('assets/front/img/stars.svg')}}"
                                                                                                                                                             style="width: 14px; height: 14px" /><img src="{{asset('assets/front/img/stars.svg')}}"
                                                                                                                                                                                                      style="width: 14px; height: 14px" /><img src="{{asset('assets/front/img/stars.svg')}}"
                                                                                                                                                                                                                                               style="width: 14px; height: 14px" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rev-text">
                                        <p>
                                            ”Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sollicitudin tincidunt etiam diam
                                            rhoncus, quis ut quam aliquam. Ultricies tempus laoreet at ipsum dui est. Eget nibh odio ac
                                            lacus duis elit arcu, vitae. Volutpat in accumsan quam ac ante nunc.”
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- /review-box -->
                            <div class="review-box clearfix">
                                <div class="rev-content">
                                    <div class="reviewflex">
                                        <div class="revflexsub">
                                            <div>
                                                <img src="{{asset('assets/front/img/avatar1.jpg')}}" />
                                            </div>
                                            <div>
                                                <h4>Annette Black</h4>
                                                <p>Co-founder</p>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="rating">
                                                <img src="{{asset('assets/front/img/stars.svg')}}" style="width: 14px; height: 14px" /><img src="{{asset('assets/front/img/stars.svg')}}"
                                                                                                                    style="width: 14px; height: 14px" /><img src="{{asset('assets/front/img/stars.svg')}}"
                                                                                                                                                             style="width: 14px; height: 14px" /><img src="{{asset('assets/front/img/stars.svg')}}"
                                                                                                                                                                                                      style="width: 14px; height: 14px" /><img src="{{asset('assets/front/img/stars.svg')}}"
                                                                                                                                                                                                                                               style="width: 14px; height: 14px" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rev-text">
                                        <p>
                                            ”Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sollicitudin tincidunt etiam diam
                                            rhoncus, quis ut quam aliquam. Ultricies tempus laoreet at ipsum dui est. Eget nibh odio ac
                                            lacus duis elit arcu, vitae. Volutpat in accumsan quam ac ante nunc.”
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- /review-box -->
                            <div class="review-box clearfix">
                                <div class="rev-content">
                                    <div class="reviewflex">
                                        <div class="revflexsub">
                                            <div>
                                                <img src="{{asset('assets/front/img/avatar1.jpg')}}" />
                                            </div>
                                            <div>
                                                <h4>Annette Black</h4>
                                                <p>Co-founder</p>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="rating">
                                                <img src="{{asset('assets/front/img/stars.svg')}}" style="width: 14px; height: 14px" /><img src="{{asset('assets/front/img/stars.svg')}}"
                                                                                                                    style="width: 14px; height: 14px" /><img src="{{asset('assets/front/img/stars.svg')}}"
                                                                                                                                                             style="width: 14px; height: 14px" /><img src="{{asset('assets/front/img/stars.svg')}}"
                                                                                                                                                                                                      style="width: 14px; height: 14px" /><img src="{{asset('assets/front/img/stars.svg')}}"
                                                                                                                                                                                                                                               style="width: 14px; height: 14px" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rev-text">
                                        <p>
                                            ”Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sollicitudin tincidunt etiam diam
                                            rhoncus, quis ut quam aliquam. Ultricies tempus laoreet at ipsum dui est. Eget nibh odio ac
                                            lacus duis elit arcu, vitae. Volutpat in accumsan quam ac ante nunc.”
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- /review-box -->
                            <h1 class="arwsqft"><a href="#">Show all 24 reviews</a> <img src="{{asset('assets/front/img/arrow-square-down.svg')}}"></h1>

                        </div>
                        <!-- /review-container -->
                    </section>
                    <!-- /section -->

                </div>
                <!-- /col -->

                <aside class="col-lg-3" id="sidebar">
                    <div class="pricebox1">
                        <h6>
                            <small style="font-size: 12px">Price per person</small>
                        </h6>
                        <h2>{{display_currency($trip->daily_price*$trip->duration)}}</h2>
                        <p>
                            Vero consequat cotidieque ad eam. Ea duis errem qui, impedit blandit sed eu. Ius diam vivendo ne. Vero
                            consequat cotidieque
                        </p>
                        <a href="{{route('frontend.custom_trip',['trip_title'=>$trip->event_title,'trip'=>$trip->id])}}" class="full-width whitebtnmain">Reserve</a>
                    </div>

                    <div class="pricebox2">
                        <h2>Customize your trip.</h2>
                        <p>
                            Vero consequat cotidieque ad eam. Ea duis errem qui, impedit blandit sed eu. Ius diam vivendo ne. Vero
                            consequat cotidieque ad eam.
                        </p>
                        <a href="{{route('frontend.custom_trip',['trip_title'=>$trip->event_title,'trip'=>$trip->id])}}" class="outlinebtn2">Customized Trip</a>

                    </div>
                </aside>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bg_color_1 -->

    <div class="container container-custom ">
        <div class="main_title_2" style="text-align: left;  margin-bottom: 25px;">
            <!-- <span><em></em></span> -->
            <h2 style="font-size: 20px;">Upcoming carnival packages</h2>
            <!-- <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p> -->
        </div>
        <div class="wrapper-grid">
            <div class="row">
                @foreach($featured_trips as $featured_trip)
                    <div class="col-xl-4 col-lg-4 col-md-4">
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
            <!-- /row -->
        </div>
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

    </script>
@endsection

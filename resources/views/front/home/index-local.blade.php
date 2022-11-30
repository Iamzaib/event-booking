@extends('layouts.front')

@section('styles')
    <link rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
    <link rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
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
    background-image: url({{asset('assets/front/img/right_arrow.png')}});

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
			background-image: url({{asset('assets/front/img/left_arrow.png')}});
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
		.one_star_home img{
			display: initial;
		}
		.faq_home_page{
			padding: 80px 0px;
		}
		.faq_content_home h2 {
    color: #000000;
   font-family: IBMPlexSans-SemiBold !important;
    font-weight: 600;
    margin-top: 30px;
		}
		.faq_content_home p {
			margin-bottom: 2px;
    font-size: 19px;
    line-height: 1.3;
		}
		.faq_content_home p a{
    text-decoration: underline !important;
    color: #4A00E0 !important;
}
		.others_faq_home h2 {
			color: #000000;
    font-family: CircularStd,sans-serif !important
    font-weight: 700;
			font-size: 20px;
		}
		.others_faq_home p {
    font-size: 16px;
			line-height: 20px;
		}
</style>
@endsection
@section('content')
    <section class="hero_single version_2">
        <div class="wrapper">
            <div class="container">
                <div class="homefirstdiv">
                    <h2 class="homeheadh2">Carnival <br> Made <b>Easy</b></h2>
                    <p>
                        Built by experts with the modern traveller in mind, nemo is a place to get inspired, plan ahead and book with confidence.
                    </p>
                    <div class="searchtour">
                        <form action="{{route('trips')}}">
                        <img src="{{ asset('assets/front/img/search2.svg')}}" />
                        <input type="text" class="" name="search" placeholder="where do you want to go?">
                        <button type="submit" class="btn_1  btngrad btngrad"
                                style="margin: auto; padding: 6px 13px !important;border-radius: 10px;">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@if(isset($featured_trips)&&count($featured_trips)>0)
  {{--  <div class="container container-custom margin_80_0">
        <div class="main_title_2" style="text-align: left;">
            <!-- <span><em></em></span> -->
            <h2>Upcoming carnival packages</h2>
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


                                <div>
                                    <img class="favoriteicoimg {{favorite_check($featured_trip->id,auth()->id())?'favourite-filter':''}} favourite" data-id="{{$featured_trip->id}}" src="{{ asset('assets/front/img/heart2.svg')}}" />
                                </div>
                            </div>
                        </figure>

                        <div class="">
                            <a href="{{route('frontend.trip_view',['trip_title'=>$featured_trip->event_title,'event'=>$featured_trip->id])}}" class="titltxt">{{$featured_trip->event_title}}</a>
							<div class="one_star_home"><img src="{{ asset('assets/front/img/stars.svg')}}">&nbsp;&nbsp;{{number_format($avg_ratings[$featured_trip->id],1)}}</div>
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
                @endforeach

            </div>
            <!-- /row -->
        </div>
        <!-- /wrapper-grid -->
        <br>
        <br>
        <br>
    </div>--}}
  @if(isset(request()->old_slider))
    <div class="container  container-custom margin_80_0">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <h2>Upcoming carnival packages</h2>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 hidden-xs">
                <div class="controls pull-right">
                    <a class="left  prev-btn" href="#carousel-example" ><i class="bi bi-arrow-left display-5"></i>&nbsp;&nbsp;</a>
                    <a class="right  next-btn" href="#carousel-example" >&nbsp;&nbsp;<i class="bi bi-arrow-right display-5"></i></a>
                </div>
            </div>
        </div>
        <div class="slick-list row">
            @foreach($featured_trips as $featured_trip)
                <div class="col-xl-4 col-lg-4 col-md-4" style="margin:0px 10px;">
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
                            <div class="one_star_home"><img src="{{ asset('assets/front/img/stars.svg')}}">&nbsp;&nbsp;{{number_format($avg_ratings[$featured_trip->id],1)}}</div>
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
            @endforeach
                @foreach($featured_trips as $featured_trip)
                <div class="col-xl-4 col-lg-4 col-md-4 " style="margin:0px 10px;">
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
                            <div class="one_star_home"><img src="{{ asset('assets/front/img/stars.svg')}}">&nbsp;&nbsp;{{number_format($avg_ratings[$featured_trip->id],1)}}</div>
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
            @endforeach
                @foreach($featured_trips as $featured_trip)
                <div class="col-xl-4 col-lg-4 col-md-4 " style="margin:0px 10px;">
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
                            <div class="one_star_home"><img src="{{ asset('assets/front/img/stars.svg')}}">&nbsp;&nbsp;{{number_format($avg_ratings[$featured_trip->id],1)}}</div>
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
            @endforeach
        </div>
    </div>
  @else
    <!-- /container -->
<div class="container">
        <div class="cardtripsmain">
<!--            <h1>Trips made easier for everyone, everywhere</h1>-->
            <div class="row">
                <div class="col-md-4">
                    <div class="cardtrips">
                        <a href="#">
                            <img src="{{ asset('assets/front/img/destination icon.svg')}}" />
                            <h2>Destinations</h2>
                            <p>Looking for the ultimate carnival destination? Then
Look no further. We have the greatest carnivals on
board for you to attend.
                            </p>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="cardtrips">
                        <a href="#">
                            <img src="{{ asset('assets/front/img/value for money icon.svg')}}" />
                            <h2>Value For Money</h2>
                            <p>There is not a better way to spend your money other
than spending money on travel. This is what we say,
others and science.
                            </p>

                        </a>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="cardtrips">
                        <a href="#">
                            <img src="{{ asset('assets/front/img/quick bookings icon.svg')}}" />
                            <h2>Quick Bookings</h2>
                            <p>Booking is quick as clicking a few clicks. Customize
every aspect of your trip from scratch, from
accomodation to events.</p>

                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="container container-custom margin_80_0">
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
                          <div class="one_star_home"><img src="{{ asset('assets/front/img/stars.svg')}}">&nbsp;&nbsp;{{number_format($avg_ratings[$featured_trip->id],1)}}</div>
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
      <div class="carousel-item" data-bs-interval="10000">
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
                          <div class="one_star_home"><img src="{{ asset('assets/front/img/stars.svg')}}">&nbsp;&nbsp;{{number_format($avg_ratings[$featured_trip->id],1)}}</div>
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
</div>

@endif

    @endif



    <div class="testimonaldiv">
        <div class="container">
            <h2 class="testimonaldivh2">Testimonials</h2>
            <p class="testimonaldivp">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ornare euismod lectus velit
                vitae venenatis nunc tristique morbi dui. Quis.</p>

            <div class="row">
                <div class="col-md-4">
                    <div class="testisub">
                        <div class="testistars">
                            <img src="{{ asset('assets/front/img/stars.svg')}}" />
                            <img src="{{ asset('assets/front/img/stars.svg')}}" />
                            <img src="{{ asset('assets/front/img/stars.svg')}}" />
                            <img src="{{ asset('assets/front/img/stars.svg')}}" />
                            <img src="{{ asset('assets/front/img/stars.svg')}}" />
                        </div>
                        <p class="testisubp">
                           "Booked with Carnival Utopia 2 vears
straight so that should tell you
something in itself! Had a blast both
times and looking to do it again soon!!!"
- Brittany
                        </p>
<!--
                        <div class="testibotdiv">
                            <div class="testibotdivsub">
                                <div>
                                    <img src="{{ asset('assets/front/img/testi1.png')}}" />
                                </div>
                                <div>
                                    <h2>Annette Black</h2>
                                    <p>Co-founder</p>
                                </div>

                            </div>
                            <div>
                                <img src="{{ asset('assets/front/img/cooma.png')}}" class="comaimg" />
                            </div>
                        </div>
-->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testisub">
                        <div class="testistars">
                            <img src="{{ asset('assets/front/img/stars.svg')}}" />
                            <img src="{{ asset('assets/front/img/stars.svg')}}" />
                            <img src="{{ asset('assets/front/img/stars.svg')}}" />
                            <img src="{{ asset('assets/front/img/stars.svg')}}" />
                            <img src="{{ asset('assets/front/img/stars.svg')}}" />
                        </div>
                        <p class="testisubp">
                            "had the most amazing experience for
cropover. Everything was taken care of
from the get go. I was very happy with
the services provided. From
transportation to all of the events we
attended. having all of our costumes
and event items dropped off to us made
the experience easy and care free.
had all of my questions answered
throughout the planning phase. hands
down best carnival concierge!!! I would
do it again in a heartbeat! thank you for
the incredible experience!" - Kayla
                        </p>
<!--
                        <div class="testibotdiv">
                            <div class="testibotdivsub">
                                <div>
                                    <img src="{{ asset('assets/front/img/testi2.png')}}" />
                                </div>
                                <div>
                                    <h2>Kristin Watson</h2>
                                    <p>Co-founder</p>
                                </div>

                            </div>
                            <div>
                                <img src="{{ asset('assets/front/img/cooma.png')}}" class="comaimg" />
                            </div>
                        </div>
-->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testisub">
                        <div class="testistars">
                            <img src="{{ asset('assets/front/img/stars.svg')}}" />
                            <img src="{{ asset('assets/front/img/stars.svg')}}" />
                            <img src="{{ asset('assets/front/img/stars.svg')}}" />
                            <img src="{{ asset('assets/front/img/stars.svg')}}" />
                            <img src="{{ asset('assets/front/img/stars.svg')}}" />
                        </div>
                        <p class="testisubp">
                            "From the time I got off my flight to the
time I flew back home there was
nothing but 5 star hospitality. From the
hotel to the events end down to the
transportation everything was excellent.
I WILL be using them again. I WILL
recommend them to any and everyone.
Excellent and superb all the way
around." - Arielle
                        </p>
<!--
                        <div class="testibotdiv">
                            <div class="testibotdivsub">
                                <div>
                                    <img src="{{ asset('assets/front/img/testi3.png')}}" />
                                </div>
                                <div>
                                    <h2>Jerome Bell</h2>
                                    <p>Co-founder</p>
                                </div>

                            </div>
                            <div>
                                <img src="{{ asset('assets/front/img/cooma.png')}}" class="comaimg" />
                            </div>
                        </div>
-->
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="faq_home_page">
<div class="container">
<div class="row">
	<div class="col-md-4">
		<div class="faq_content_home">
		<img src="{{ asset('assets/front/img/frequently asked questions icon.svg')}}" />
			<h2>Frequently asked questions</h2>
			<p>Everything you need to know about
the product and billing. Can’t find the
answer you’re looking for? Please
			<a>chat
to our friendly team.</a>
			</p>
		</div>
	</div>
	<div class="col-md-4">
		<div class="others_faq_home">
		<h2>Who books the flight?</h2>
			<p>You are responsible for booking your own flight.
We do not include the flights, but we can help you
to book the best fight based on your location. No
matter where you are flying from we will help you
pick the best connections to join the tour on time.</p>
			<br>
			<h2>Do you offer payment plans?</h2>
			<p>In the event you are unable to pay for your
experience in full, you can use our simple
payment plan. More information can be found
here <a href="#">https://carnivalutopia.com/frequently
asked-questions/#payment process.</a></p>
			<br>
			<h2>What is your cancellation policy?</h2>
			<p>We understand that things change. You can
cancel your plan at any time and we’ll refund
you the difference already paid.
</p>
		</div>

	</div>
	<div class="col-md-4">
		<div class="others_faq_home">
		<h2>Connect with customers</h2>
			<p>Solve a problem or close a sale in real time with
chat. If no one is available, customers are
seamlessly routed to email without confusion.</p>
			<br>
			<h2>Connect the tools you already use</h2>
			<p>Explore 100+ integrations that make your day to
day workflow more efficient and familiar. Plus, our
extensive developer tools.</p>
			<br>
			<h2>Our people make the difference
</h2>
			<p>We re an extension of your customer service team,
and all of our resources are free. Chat to our
friendly team 24/7 when you need help.
</p>
		</div>

	</div>

	</div>
</div>
</div>

    <div class="latestnlogdiv">
        <div class="container">
            <h2 class="testimonaldivh2">Latest Blogs</h2>
            <p class="testimonaldivp">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ornare euismod lectus velit
                vitae venenatis nunc tristique morbi dui. Quis.</p>
            <div class="row">
                <div class="col-md-4">
                    <div class="blogdivs">
                        <img class="blogimgimg1" src="{{ asset('assets/front/img/blog1.png')}}" />
                        <div class="btitleandl">
                            <div>
                                <h2>UX review presentations</h2>
                            </div>
                            <div>
                                <a href="#"><img src="{{ asset('assets/front/img/arrowright.svg')}}" /></a>
                            </div>
                        </div>
                        <p>
                            How do you create compelling presentations that wow your colleagues and impress your managers?
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blogdivs">
                        <img class="blogimgimg1" src="{{ asset('assets/front/img/blog2.png')}}" />
                        <div class="btitleandl">
                            <div>
                                <h2>Migrating to Linear 101</h2>
                            </div>
                            <div>
                                <a href="#"><img src="{{ asset('assets/front/img/arrowright.svg')}}" /></a>
                            </div>
                        </div>
                        <p>
                            Linear helps streamline software projects, sprints, tasks, and bug tracking. Here’s how to get
                            started.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blogdivs">
                        <img class="blogimgimg1" src="{{ asset('assets/front/img/blog3.png')}}" />
                        <div class="btitleandl">
                            <div>
                                <h2>Building your API Stack</h2>
                            </div>
                            <div>
                                <a href="#"><img src="{{ asset('assets/front/img/arrowright.svg')}}" /></a>
                            </div>
                        </div>
                        <p>
                            The rise of RESTful APIs has been met by a rise in tools for creating, testing, and managing them.
                        </p>
                    </div>
                </div>
            </div>
        </div>
		<div class="show_more" id="text">
		<div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="blogdivs">
                        <img class="blogimgimg1" src="{{ asset('assets/front/img/blog1.png')}}" />
                        <div class="btitleandl">
                            <div>
                                <h2>UX review presentations</h2>
                            </div>
                            <div>
                                <a href="#"><img src="{{ asset('assets/front/img/arrowright.svg')}}" /></a>
                            </div>
                        </div>
                        <p>
                            How do you create compelling presentations that wow your colleagues and impress your managers?
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blogdivs">
                        <img class="blogimgimg1" src="{{ asset('assets/front/img/blog2.png')}}" />
                        <div class="btitleandl">
                            <div>
                                <h2>Migrating to Linear 101</h2>
                            </div>
                            <div>
                                <a href="#"><img src="{{ asset('assets/front/img/arrowright.svg')}}" /></a>
                            </div>
                        </div>
                        <p>
                            Linear helps streamline software projects, sprints, tasks, and bug tracking. Here’s how to get
                            started.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blogdivs">
                        <img class="blogimgimg1" src="{{ asset('assets/front/img/blog3.png')}}" />
                        <div class="btitleandl">
                            <div>
                                <h2>Building your API Stack</h2>
                            </div>
                            <div>
                                <a href="#"><img src="{{ asset('assets/front/img/arrowright.svg')}}" /></a>
                            </div>
                        </div>
                        <p>
                            The rise of RESTful APIs has been met by a rise in tools for creating, testing, and managing them.
                        </p>
                    </div>
                </div>
            </div>
        </div>
			</div>
		<div class="container">
            <div class="row">
                <div class="col-md-4">
                    <button class="show_all_button" id="toggle">Show All</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    @parent
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

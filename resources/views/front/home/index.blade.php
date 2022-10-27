@extends('layouts.front')

@section('styles')
    <link rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
    <link rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css">
    <style>
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
        }</style>
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
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <h2>Upcoming carnival packages</h2>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 hidden-xs">
                <div class="controls pull-right">
                    <a class="left  " href="#carousel-example" data-slide="prev"><i class="bi bi-arrow-left display-5"></i>&nbsp;&nbsp;</a><a
                        class="right  " href="#carousel-example" data-slide="next">&nbsp;&nbsp;<i class="bi bi-arrow-right display-5"></i></a>
                </div>
            </div>
        </div>
        <div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel" data-type="multi">
            <div class="carousel-inner">
                <div class="item active">
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
                            @if($loop->remaining>0&&($loop->index+1)%4==0)
                    </div>
                </div>
                                <div class="item">
                                    <div class="row">
                                @endif
                @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- /container -->

    <div class="container">
        <div class="cardtripsmain">
            <h1>Trips made easier for everyone, everywhere</h1>
            <div class="row">
                <div class="col-md-4">
                    <div class="cardtrips">
                        <a href="#">
                            <img src="{{ asset('assets/front/img/flight.svg')}}" />
                            <h2>Book, then relax</h2>
                            <p>Flexible options let you spend more time making plans and less time worrying when things change.
                            </p>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="cardtrips">
                        <a href="#">
                            <img src="{{ asset('assets/front/img/trip.svg')}}" />
                            <h2>Travel smart checklist</h2>
                            <p>Ready for your next great vacation? Use this cheatsheet to ensure you’ve covered the essentials.
                            </p>

                        </a>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="cardtrips">
                        <a href="#">
                            <img src="{{ asset('assets/front/img/journey.svg')}}" />
                            <h2>Point hack your trip</h2>
                            <p>Earn Expedia Rewards points on top of any credit card or airline program points when you book.</p>

                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>


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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.js"></script>

@endsection

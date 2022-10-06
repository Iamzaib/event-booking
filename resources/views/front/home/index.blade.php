@extends('layouts.front')
@section('content')
    <section class="hero_single version_2">
        <div class="wrapper">
            <div class="container">
                <div class="homefirstdiv">
                    <h2 class="homeheadh2">Exceptional trips, every time</h2>
                    <p>
                        Built by experts with the modern traveller in mind, nemo is a place to get inspired, plan ahead and book
                        with confidence.
                    </p>
                    <div class="searchtour">
                        <img src="{{ asset('assets/front/img/search2.svg')}}" />
                        <input type="text" class="" placeholder="where do you want to go?">
                        <button class="btn_1  btngrad btngrad"
                                style="margin: auto; padding: 6px 13px !important;">Search</button>
                    </div>
                </div>

            </div>
        </div>
    </section>
@if(isset($featured_trips)&&count($featured_trips)>0)
    <div class="container container-custom margin_80_0">
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
                            <a href="{{route('frontend.trip_view',['trip_title'=>$featured_trip->event_title,'event'=>$featured_trip->id])}}"><img src="{{ $featured_trip->featured_image->getUrl()??asset('assets/front/img/tour_1.jpg')}}" class="img-fluid" alt="" width="800"
                                                            height="533"></a>
                            <div class="tourdivf1">
{{--                                <div>--}}
{{--                                    <small><img src="{{ asset('assets/front/img/clock.png')}}" /> 25:26:31</small>--}}
{{--                                </div>--}}

                                <div>
                                    <img class="favoriteicoimg" data-id="{{$featured_trip->id}}" src="{{ asset('assets/front/img/heart.svg')}}" />
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
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="box_grid">
                        <figure>
                            <a href="!#"><img src="{{ asset('assets/front/img/tour_2.jpg')}}" class="img-fluid" alt="" width="800"
                                                            height="533"></a>
                            <div class="tourdivf1">
                                <div>
                                    <small><img src="{{ asset('assets/front/img/clock.png')}}" /> 25:26:31</small>
                                </div>

                                <div>
                                    <img class="favoriteicoimg" src="{{ asset('assets/front/img/heart.svg')}}" />
                                </div>
                            </div>
                        </figure>
                        <div class="">
                            <a href="!#" class="titltxt">Cinnamon Dhonveli: The sunny side of life</a>
                            <div class="tourdivf2">
                                <div>
                                    <img src="{{ asset('assets/front/img/calendar.svg')}}" />
                                    <span>4 Days</span>
                                </div>
                                <div>
                                    <img src="{{ asset('assets/front/img/location.svg')}}" />
                                    <span>Maldives, Maldives</span>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="box_grid">
                        <figure>
                            <a href="!#"><img src="{{ asset('assets/front/img/tour_3.jpg')}}" class="img-fluid" alt="" width="800"
                                                            height="533"></a>
                            <div class="tourdivf1">
                                <div>
                                    <small><img src="{{ asset('assets/front/img/clock.png')}}" /> 25:26:31</small>
                                </div>

                                <div>
                                    <img class="favoriteicoimg" src="{{ asset('assets/front/img/heart.svg')}}" />
                                </div>
                            </div>
                        </figure>
                        <div class="">
                            <a href="!#" class="titltxt">Cinnamon Dhonveli: The sunny side of life</a>
                            <div class="tourdivf2">
                                <div>
                                    <img src="{{ asset('assets/front/img/calendar.svg')}}" />
                                    <span>4 Days</span>
                                </div>
                                <div>
                                    <img src="{{ asset('assets/front/img/location.svg')}}" />
                                    <span>Maldives, Maldives</span>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
            <!-- /row -->
        </div>
        <!-- /wrapper-grid -->
        <br>
        <br>
        <br>
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
                            ”Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sollicitudin tincidunt etiam diam rhoncus,
                            quis ut quam aliquam. Ultricies tempus laoreet at ipsum dui est. Eget nibh odio ac lacus duis elit
                            arcu, vitae. Volutpat in accumsan quam ac ante nunc.”
                        </p>
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
                            ”Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sollicitudin tincidunt etiam diam rhoncus,
                            quis ut quam aliquam. Ultricies tempus laoreet at ipsum dui est. Eget nibh odio ac lacus duis elit
                            arcu, vitae. Volutpat in accumsan quam ac ante nunc.”
                        </p>
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
                            ”Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sollicitudin tincidunt etiam diam rhoncus,
                            quis ut quam aliquam. Ultricies tempus laoreet at ipsum dui est. Eget nibh odio ac lacus duis elit
                            arcu, vitae. Volutpat in accumsan quam ac ante nunc.”
                        </p>
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
    </div>

@endsection
@section('scripts')
    @parent
@endsection

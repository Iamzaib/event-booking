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
/*    font-weight: 600;*/
		}
		.one_star_home img{
			display: initial;
		}
		.faq_home_page{
			padding: 80px 0px;
		}
		.faq_content_home h2 {
    color: #000000;
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
                    <h2 class="homeheadh2">Travel to Carnival <br> Made <b>Easy</b></h2>
                    <p class="hidemblherodis">
                        Built by experts with the modern traveller in mind, nemo is a place to get inspired, plan ahead and book with confidence.
                    </p>
                    <p class="showmblherodis">Whether you’re a carnival virgin or a carnivalista, we will ensure your escape to Carinval is an unforgettable experience.</p>
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
    <div class="container">
        <div class="cardtripsmain">
            <h2 class="testimonaldivh2">Why choose us</h2>
            <p class="testimonaldivp">Here are reasons why you should plan a trip with us</p>
            <div class="row">
                <div class="col-md-4">
                    <div class="cardtrips">
                        <a href="#">
                            <img src="{{ asset('assets/front/img/destination-icon.svg')}}" />
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
                            <img src="{{ asset('assets/front/img/value-for-money.svg')}}" />
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
                            <img src="{{ asset('assets/front/img/quick-bookings.svg')}}" />
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
@if(isset($featured_trips)&&count($featured_trips)>0)

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
                            <div class="one_star_home"><img src="{{ asset('assets/front/img/stars.svg')}}"> <span>{{number_format($avg_ratings[$featured_trip->id],1)}}</span></div>
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
                            <div class="one_star_home"><img src="{{ asset('assets/front/img/stars.svg')}}"> <span>{{number_format($avg_ratings[$featured_trip->id],1)}}</span></div>
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
                            <div class="one_star_home"><img src="{{ asset('assets/front/img/stars.svg')}}"> <span>{{number_format($avg_ratings[$featured_trip->id],1)}}</span></div>
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

<div class="container container-custom margin_80_0">
<div class="row">
	<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel" data-bs-interval="false">
        <div class="row">
            <div class="col-md-10 col-sm-10 col-xs-12">
                <h2>Carnival experiences. <b>Take a look at what’s new, right now.</b></h2>
            </div>
        </div>

  <div class="">
    <div class="newowlclass2">
      <div class="row owl-carousel2">
          @foreach($featured_trips as $featured_trip)

              <div class="col-md-12 item">
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
                          <div class="newsclasscarodiv1vb">
                              <div class="widthfirstimg1">  <a href="{{route('frontend.trip_view',['trip_title'=>$featured_trip->event_title,'event'=>$featured_trip->id])}}" class="titltxt">{{$featured_trip->event_title}}</a>
                        </div>
                          <div class="one_star_home"><img src="{{ asset('assets/front/img/stars.svg')}}"> <span>{{number_format($avg_ratings[$featured_trip->id],1)}}</span></div>

                          </div>
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
      <div class="">
          <div class="row">
              @endif
              @endforeach
          </div>
      </div>


  </div>

</div>
	</div>
</div>

@endif

    @endif



    <div class="testimonaldiv">
        <div class="container">
            <h2 class="testimonaldivh2">Testimonials</h2>
            <p class="testimonaldivp">Dont take our word for it, Trust our customers</p>

            <div class="row">
                @foreach($testimonials as $review)
                <div class="col-md-4">
                    <div class="testisub">
                        <div class="testistars">
                            @for($star=1;$star<=$review->ratings;$star++)
                                <img src="{{asset('assets/front/img/stars.svg')}}" style="width: 14px; height: 14px" />
                            @endfor
                        </div>
                        <p class="testisubp">
                           "{{$review->review_text}}"
- {{$review->user->name}}
                        </p>

                        <div class="testibotdiv">
                            <div class="testibotdivsub">
                                <div>
                                    <img src="{{isset($review->user->profileimage)?$review->user->profileimage->getUrl():asset('assets/front/img/profile-placeholder.png')}}" />
                                </div>
                                <div>
                                    <h2>{{$review->user->name.' '.$review->user->lastname}}</h2>
{{--                                    <p>Co-founder</p>--}}
                                </div>

                            </div>
                            <div>
                                <img src="{{ asset('assets/front/img/cooma.png')}}" class="comaimg" />
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
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
                @php $blog_displayed=[]; @endphp
                @foreach($blogs as $blog)
                    @php $blog_displayed[]=$blog->id; @endphp
                <div class="col-md-4">
                    <div class="blogdivs">
                        <img class="blogimgimg1" onclick="window.location='{{route('blog',['name'=>$blog->title,'id'=>$blog->id])}}'" src="{{isset($blog->featured_image)?$blog->featured_image->getUrl():asset('assets/front/img/blog1.png')}}" />
                        <div class="btitleandl">
                            <div>
                                <h2 onclick="window.location='{{route('blog',['name'=>$blog->title,'id'=>$blog->id])}}'">{{$blog->title}}</h2>
                            </div>
                            <div>
                                <a href="{{route('blog',['name'=>$blog->title,'id'=>$blog->id])}}"><img src="{{ asset('assets/front/img/arrowright.svg')}}" /></a>
                            </div>
                        </div>
                        <p>
                            {{$blog->excerpt}}
                        </p>
                    </div>
                </div>
                    @if($loop->index==2) @break @endif
                @endforeach
            </div>
        </div>
        @if(count($blogs)>3)
		<div class="show_more" id="text">
		<div class="container">
            <div class="row">
                @foreach($blogs as $blog)
                    @if(in_array($blog->id,$blog_displayed)) @continue @endif
                    <div class="col-md-4">
                        <div class="blogdivs">
                            <img class="blogimgimg1" onclick="window.location='{{route('blog',['name'=>$blog->title,'id'=>$blog->id])}}'" src="{{isset($blog->featured_image)?$blog->featured_image->getUrl():asset('assets/front/img/blog1.png')}}" />
                            <div class="btitleandl">
                                <div>
                                    <h2 onclick="window.location='{{route('blog',['name'=>$blog->title,'id'=>$blog->id])}}'">{{$blog->title}}</h2>
                                </div>
                                <div>
                                    <a href="{{route('blog',['name'=>$blog->title,'id'=>$blog->id])}}"><img src="{{ asset('assets/front/img/arrowright.svg')}}" /></a>
                                </div>
                            </div>
                            <p>
                                {{$blog->excerpt}}
                            </p>
                        </div>
                    </div>
                @endforeach
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
        @endif
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


        $(function() {
  // Owl Carousel
  var owl = $(".owl-carousel2");
  owl.owlCarousel({
    items: 3,
    margin: 10,
    loop: true,
    nav: true,
    dots: true
  });
});

    </script>
@endsection

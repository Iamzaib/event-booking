<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('assets/front/img/favicon.svg')}}" type="image/x-icon">
    <style>
        @font-face {
            font-family: CircularStd;
            src: url({{asset('assets/fonts/circular-std/CircularStd-Black.woff2')}});
        }
        body{
            font-family: CircularStd, sans-serif !important;
        }
    </style>

{{--    <link href="{{ asset('assets/front/css/bootstrap.min.css') }}" rel="stylesheet" />--}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="{{ asset('assets/front/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/front/css/vendors.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/front/css/signin.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/checkout.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />


    <style type="text/css">

        .favourite-filter{
            filter: invert(15%) sepia(76%) saturate(6401%) hue-rotate(357deg) brightness(100%) contrast(114%);
        }
        @if(isset($page_name)&&$page_name=='home')

                                   .tiny_bullet_slider .tp-bullet:before {
                                       content: " ";
                                       position: absolute;
                                       width: 100%;
                                       height: 25px;
                                       top: -12px;
                                       left: 0px;
                                       background: transparent
                                   }

        .bullet-bar.tp-bullets:before {
            content: " ";
            position: absolute;
            width: 100%;
            height: 100%;
            background: transparent;
            padding: 10px;
            margin-left: -10px;
            margin-top: -10px;
            box-sizing: content-box
        }

        .bullet-bar .tp-bullet {
            width: 60px;
            height: 3px;
            position: absolute;
            background: #aaa;
            background: rgba(204, 204, 204, 0.5);
            cursor: pointer;
            box-sizing: content-box
        }

        .bullet-bar .tp-bullet:hover,
        .bullet-bar .tp-bullet.selected {
            background: rgba(204, 204, 204, 1)
        }


        @media(min-width:600px) {
            header {
                background-color: transparent;
            }

            .hamburger-inner {
                background-color: #fff !important;
            }

            .hamburger-inner::before {
                background-color: #fff !important;
            }

            .hamburger-inner::after {
                background-color: #fff !important;
            }

            .btnhead {

                color: #fff;

            }
        }

        header.sticky .btnhead {
            color: #ff027c !important;
        }

          @else

                                      .tiny_bullet_slider .tp-bullet:before {
                                          content: " ";
                                          position: absolute;
                                          width: 100%;
                                          height: 25px;
                                          top: -12px;
                                          left: 0px;
                                          background: transparent
                                      }

        .bullet-bar.tp-bullets:before {
            content: " ";
            position: absolute;
            width: 100%;
            height: 100%;
            background: transparent;
            padding: 10px;
            margin-left: -10px;
            margin-top: -10px;
            box-sizing: content-box
        }

        .bullet-bar .tp-bullet {
            width: 60px;
            height: 3px;
            position: absolute;
            background: #aaa;
            background: rgba(204, 204, 204, 0.5);
            cursor: pointer;
            box-sizing: content-box
        }

        .bullet-bar .tp-bullet:hover,
        .bullet-bar .tp-bullet.selected {
            background: rgba(204, 204, 204, 1)
        }

        #logo {
            float: left;
            position: absolute;
        }

        .header {
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0px 8px 8px rgba(0, 0, 0, 0.06);
        }

        .main-menu>ul>li span>a {
            color: #383839 !important;
        }

        header.header.sticky .logo_sticky {
            display: inline-block;

        }

        header.header.sticky {
            background-color: #fff !important;
            border-bottom: 1px solid #fff !important;
        }

        @media(max-width:991px) {
            .btn_mobile {
                position: absolute;
                right: 15px;
                top: 16px;
            }
        }

        @media(min-width:600px) {
            header {
                background-color: transparent;
            }

            .hamburger-inner {
                background-color: #000 !important;
            }

            .hamburger-inner::before {
                background-color: #000 !important;
            }

            .hamburger-inner::after {
                background-color: #000 !important;
            }

            .btnhead {

                color: #fff;

            }
        }

        header.sticky .btnhead {
            color: #ff027c !important;
        }

        @endif

        .border-bottom-1{
            border-bottom: 1px solid #E3E3E3!important;
        }
        .input-col-custom-padding-05{
            padding: calc(var(--bs-gutter-x) * .5);
        }
        .input-col-custom-padding-02{
            padding: calc(var(--bs-gutter-x) * .2);
        }
        </style>
    @yield('styles')
</head>

<body>
<div id="page">
    <header class="header menu_fixed">
        <div id="preloader">
            <div data-loader="circle-side"></div>
        </div>
@if(isset($page_name)&&$page_name=='home')

        <!-- /Page Preload -->
        <div class="container">
            <div id="logo">
                <a href="{{route('home')}}}">
                    <img src="{{ asset('assets/front/img/home-page-logo.svg')}}" width="250" height="36" alt="" class="logo_normal imgindexdesk" />
                    <img src="{{ asset('assets/front/img/mbllogo.svg')}}" width="60" height="36" alt="" class="logo_normal imgindexmbl" />
                    <img src="{{ asset('assets/front/img/home-page-logo.svg')}}" width="250" height="36" alt="" class="logo_sticky" />
                </a>
            </div>

            <!-- /top_menu -->
            <a href="#menu" class="btn_mobile">
                <div class="hamburger hamburger--spin" id="hamburger">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>
            </a>
            <nav id="menu" class="main-menu">
                <ul>
                    <li>
                        <span><a href="tel:{{AGENT_NUMBER}}">Speak to Agent</a></span>
                    </li>
                    <li>
                        <span><a href="{{route('help_center')}}"> Help Center</a></span>
                    </li>
                    <li>
                        <span><a href="{{route('trips')}}">Trips </a></span>
                    </li>
                    @guest
                    <li>
                        <span><a href="{{route('login')}}" >Login</a></span>
                    </li>
                    @else
                    <li>
                        <span><a href="@if(auth()->check()&&auth()->user()->is_admin){{route('admin.home')}}@else{{route('frontend.account.index')}}@endif">Account</a></span>
                    </li>
                     <li>
                        <span><a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">Logout</a></span>
                    </li>
                    @endguest
                </ul>
            </nav>
            <div class="mblsdiv1">
                <a href="#"><img src="{{ asset('assets/front/img/search-normal.svg')}}" /></a>
                <a href="{{route('trips')}}"><img src="{{ asset('assets/front/img/briefcase.svg')}}" /></a>
                <a href="@if(auth()->check()&&auth()->user()->is_admin){{route('admin.home')}}@else{{route('frontend.account.index')}}@endif"><svg style="width: 24px; height: 23px;"><path fill-rule="evenodd" fill="#fff" d="M12 2a10 10 0 100 20 10 10 0 000-20zm0 3a3 3 0 110 6 3 3 0 010-6zM6 15.98a7.2 7.2 0 0012 0c-.03-1.99-4.01-3.08-6-3.08-2 0-5.97 1.09-6 3.08z" clip-rule="evenodd"></path></svg></a>
            </div>
        </div>

@else

            <!-- /Page Preload -->
            <div class="container">
                <div id="logo">
                    <a href="{{route('home')}}">
                        <img src="{{asset('assets/front/img/darklogo.svg')}}" width="250" height="36" alt="" class="logo_normal imgindexdesk" />
                        <img src="{{asset('assets/front/img/mbllogo.svg')}}" width="60" height="36" alt="" class="logo_normal imgindexmbl" />
                        <img src="{{asset('assets/front/img/darklogo.svg')}}" width="250" height="36" alt="" class="logo_sticky" />
                    </a>
                </div>
                <!-- /top_menu -->
                <a href="#menu" class="btn_mobile">
                    <div class="hamburger hamburger--spin" id="hamburger">
                        <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                        </div>
                    </div>
                </a>
                <nav id="menu" class="main-menu">
                    <ul>
                        <li>
                            <span><a href="tel:{{AGENT_NUMBER}}">Speak to Agent</a></span>
                        </li>
                        <li>
                            <span><a href="{{route('help_center')}}"> Help Center</a></span>
                        </li>
                        <li>
                            <span><a href="{{route('trips')}}">Trips </a></span>
                        </li>
                        @guest
                            <li>
                                <span><a href="{{route('login')}}">Login</a></span>
                            </li>
                        @else
                            <li>
                                <span><a href="@if(auth()->check()&&auth()->user()->is_admin){{route('admin.home')}}@else{{route('frontend.account.index')}}@endif"><img src="{{auth()->user()->profileimage?auth()->user()->profileimage->getUrl('thumb'):asset('assets/front/img/profile-placeholder.png')}}" class="userloginprofile" /></a></span>
                            </li>
                            <li>
                                <span><a href="{{route('log-out')}}" {{--onclick="event.preventDefault(); document.getElementById('logoutform').submit();"--}}>Logout</a></span>
                            </li>
                        @endguest
{{--                        <li>--}}
{{--                            <span><a href="#"><img src="./img/profile-placeholder.png" class="userloginprofile" /></a></span>--}}
{{--                        </li>--}}

                    </ul>
                </nav>
                <div class="mblsdiv1">
                    <a href="#"><img src="{{asset('assets/front/img/dar-search-normal.svg')}}" /></a>
                    <a href="{{route('trips')}}"><img src="{{asset('assets/front/img/darkbriefcase.svg')}}" /></a>
                    <a href="@if(auth()->check()&&auth()->user()->is_admin){{route('admin.home')}}@else{{route('frontend.account.index')}}@endif"><svg style="width: 24px; height: 23px;"><path fill-rule="evenodd" d="M12 2a10 10 0 100 20 10 10 0 000-20zm0 3a3 3 0 110 6 3 3 0 010-6zM6 15.98a7.2 7.2 0 0012 0c-.03-1.99-4.01-3.08-6-3.08-2 0-5.97 1.09-6 3.08z" clip-rule="evenodd"></path></svg></a>
                </div>
            </div>

@endif

        {{--            <div aria-live="polite" aria-atomic="true" class="position-relative">--}}
<!-- Position it: -->
    <!-- - `.toast-container` for spacing between toasts -->
    <!-- - `.position-absolute`, `top-0` & `end-0` to position the toasts in the upper right corner -->
    <!-- - `.p-3` to prevent the toasts from sticking to the edge of the container  -->
    <div class="toast-container position-absolute top-0 end-0 p-3 mt-5">
        @if(session('message'))
            <div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" data-bs-autohide="false" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {!! session('message') !!}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endif
        @if(is_string(session('error')))
            <div class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" data-bs-autohide="false" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {!! (string)session('error') !!}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endif
        @if(\Illuminate\Support\Facades\Session::has('error'))
            <div class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" data-bs-autohide="false" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {!! \Illuminate\Support\Facades\Session::get('error') !!}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endif
        @if($errors->count() > 0)
            @foreach($errors->all() as $error)
                <div class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" data-bs-autohide="false" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{$error}}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    {{--            </div>--}}
    </header>
    <!-- /header -->
    @if(isset($page_type)&&$page_type=='trip')
        @if($trip->featured_image)
            <img src="{{ $trip->featured_image->getUrl() }}" class="tourdetailshead1">
        @else
            <img src="{{asset('assets/front/img/tourdetailsbg1.png')}}" class="tourdetailshead1" />
        @endif
    @endif


        <main>

            @yield('content')

{{--            <button class=" btn_1 btngrad" id="toastbtn">Toast</button>--}}

        </main>
    <div class="newsletter1">
        <div class="nescy container">
            <div class="row d-flex">
                <div class="col-12 col-lg-6 justify-content-lg-start justify-content-center">
                    <h2 class="h2sss">
                        Get a proposal
                    </h2>
                    <p class="csdkontent">
                        If you want to learn more about how we can help grow your business, click below to schedule a free
                        discovery call and see how we can help your business scale!
                    </p>
                </div>
                <div class="col-12 col-lg-6">
                    <form action="{{route('frontend.newsletter')}}" class="newsletter-form" method="post">
                        @csrf
                        <div class="input-field"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="14">
                                <g fill="none" fill-rule="evenodd" stroke="#9CA9BA" stroke-linecap="round" stroke-linejoin="round"
                                   stroke-width="2">
                                    <path d="M3 1h11a2 2 0 012 2v8a2 2 0 01-2 2H3a2 2 0 01-2-2V3a2 2 0 012-2z">
                                    </path>
                                    <path d="M2 2l6.5 6L15 2"></path>
                                </g>
                            </svg><input class="input" type="email" name="email" placeholder="Enter an email address"
                                         aria-label="Enter an email address" value=""><button class="btn_1  btngrad" type="submit"
                                                                                              aria-label="Subscribe">
                                Subscribe
                            </button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="container margin_60_35">
            <div class="row">
                <div class="col-lg-6 col-md-8 p-r-5">
                    <div class="footerwidtho">
                        <p><img src="{{ asset('assets/front/img/home-page-logo.svg')}}" width="250" height="36" alt="" style="margin-left: -16px;" /></p>
                        <p>
                            Suspendisse ridiculus eu, morbi nibh odio duis. Imperdiet consectetur augue nam iaculis hendrerit nullam
                            purus facilisis et. Sit egestas vel massa nec, volutpat sit ac tortor neque.
                        </p>
                        <div class="follow_us">
                            <ul>
                                <li>
                                    <a href="#0">
                                        <img src="{{ asset('assets/front/img/instagram.svg')}}" />
                                    </a>
                                </li>
                                <li>
                                    <a href="#0"> <img src="{{ asset('assets/front/img/whatsapp.svg')}}" /></a>
                                </li>
                                <li>
                                    <a href="#0"> <img src="{{ asset('assets/front/img/facebook.svg')}}" /></a>
                                </li>
                                <li>
                                    <a href="#0"> <img src="{{ asset('assets/front/img/ph_twitter-logo.svg')}}" /></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6 ml-lg-auto">
                    <h5>About</h5>
                    <ul class="links">
                        <li><a href="{{route('page_view',['page_name'=>'About-Us','pID'=>1])}}">About us</a></li>
                        <li><a href="{{route('blogs')}}">Blog</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6 ml-lg-auto">
                    <h5>FAQ</h5>
                    <ul class="links">
                        @foreach($faq_cats as $c)
                        <li><a href="{{route('help_center',['name'=>str_replace(' ','-',$c->category),'category'=>$c->id])}}">{{$c->category}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6 flexsupport">
                    <h5>Support</h5>
                    <ul class="links">
                        <li><a href="{{route('contact')}}">Contact us</a></li>
                        <li><a href="#">Whatsapp</a></li>
                        <li><a href="#">Telegram</a></li>
                        <li><a href="#">imessage</a></li>
                    </ul>
                </div>
            </div>
            <!--/row-->

            <div class="row footerlastdiv">
                <div class="col-lg-6">
                    <ul id="footer-selector">
                        <li>
                            <span>© 2000-{{date('Y')}}, All Rights Reserved</span>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="footercardsimg">
                        <img src="{{ asset('assets/front/img/visa.png')}}" />
                        <img src="{{ asset('assets/front/img/master.png')}}" />
                        <img src="{{ asset('assets/front/img/amex.png')}}" />
                        <img src="{{ asset('assets/front/img/discover.png')}}" />
                    </div>
                </div>
            </div>
        </div>
    </footer>
    </div>

<!-- COMMON SCRIPTS -->
{{--<script src="{{ asset('assets/front/js/bootstrap.bundle.min.js')}}"></script>--}}
<!-- user modal -->
<div class="modal" id="modaluserico" tabindex="-1" aria-labelledby="modalusericoLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 450px;">
        <div class="modal-content">
            <div class="modal-body" style="padding: 25px;">
                <div class="">
                    <h4 style="margin-bottom: 8px;">
                        Members can access discounts and special features
                    </h4>
                    <p style="font-size: 15px; line-height: 1.4;">Save 10% or more on thousands of properties with member
                        prices.</p>

                    <button type="button" data-bs-toggle="modal" data-bs-target="#signinmodal" class="btn_1 btngrad signinbtnjs"
                            style="width: 100%;">
                        Sign in
                    </button>

                    <button class="notlikebutton signupbtnjs" type="button" data-bs-toggle="modal" data-bs-target="#signupmodal"
                            style="width: 100%; margin-top: 20px;">
                        Sign up, It's free
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>

<form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

{{--<script src="{{ asset('assets/front/js/bootstrap.bundle.min.js') }}"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="{{ asset('assets/front/js/common_scripts.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<script src="{{ asset('assets/front/js/main.js')}}"></script>
<script src="{{ asset('assets/front/js/script2.js')}}"></script>
@yield('scripts')
<script>
    $(".user-nav-arrow-icon").click(function () {
        $(".side-nav ul li .notactive").fadeToggle("fast");
        var element = document.getElementById("navsidebar");
        element.classList.toggle("side-nav--open");
    });
</script>
<script>
    var  options={
        // autohide:false,
        delay:5000
    }
    @if(session('message')||$errors->count() > 0)

    // document.getElementById("toastbtn").onclick = function() {
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        var toastList = toastElList.map(function(toastEl) {
            // Creates an array of toasts (it only initializes them)
            return new bootstrap.Toast(toastEl,options) // No need for options; use the default options
        });

        toastList.forEach(toast => toast.show()); // This show them

        console.log(toastList); // Testing to see if it works
    // };
    @endif
    // document.getElementById("toastbtn").onclick = function() {
    //     var toastElList = [].slice.call(document.querySelectorAll('.toast'))
    //     var toastList = toastElList.map(function(toastEl) {
    //         // Creates an array of toasts (it only initializes them)
    //         return new bootstrap.Toast(toastEl,options) // No need for options; use the default options
    //     });
    //     toastList.forEach(toast => toast.show()); // This show them
    //
    //     console.log(toastList); // Testing to see if it works
    // };
    $(function (){
        $('.date').datetimepicker({
            format: 'MM/DD/YYYY',
            locale: 'en',
            icons: {
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right'
            }
        })
    });

    var select_placeholder='<option>{{trans('global.pleaseSelect')}}</option>';
    $("select[name=country]").change(function (){
        console.log($(this).val());
        $.ajax({
            url: "{{ route('states.get_by_country') }}?country_id=" + $(this).val(),
            method: 'GET',
            success: function(data) {
                $('select[name=state]').html(data.html);
                $('select[name=city]').html(select_placeholder);
            }
        });
    });
    $("select[name=state]").change(function (){
        console.log($(this).val());
        $.ajax({
            url: "{{ route('cities.get_by_state') }}?state_id=" + $(this).val(),
            method: 'GET',
            success: function(data) {
                $('select[name=city]').html(data.html);
            }
        });
    });
    $("select[name=country_id]").change(function (){
        console.log($(this).val());
        $.ajax({
            url: "{{ route('states.get_by_country') }}?country_id=" + $(this).val(),
            method: 'GET',
            success: function(data) {
                $('select[name=state_id]').html(data.html);
                $('select[name=city_id]').html(select_placeholder);
            }
        });
    });
    $("select[name=state_id]").change(function (){
        console.log($(this).val());
        $.ajax({
            url: "{{ route('cities.get_by_state') }}?state_id=" + $(this).val(),
            method: 'GET',
            success: function(data) {
                $('select[name=city_id]').html(data.html);
            }
        });
    });
    $(".favourite").click(function (){
        @auth
        var id=$(this).data('id');
        var favimg=$(this);
        $.ajax({
            url: "{{ route('frontend.account.favourite') }}?trip_id=" + id,
            method: 'GET',
            success: function(data) {
                console.log(data.status);
                if(parseInt($.trim(data.status))===1){
                    // favimg.addClass('favourite-filter');
                    console.log(data);
                    favimg.toggleClass('favourite-filter');
                    favimg.css({'filter': 'invert(15%) sepia(76%) saturate(6401%) hue-rotate(357deg) brightness(100%) contrast(114%)'});
                }else{
                    favimg.removeClass('favourite-filter');
                }
            }
        });
        @elseauth
        window.location.href='{{route('login')}}';
        @endauth
    });
</script>
</body>

</html>

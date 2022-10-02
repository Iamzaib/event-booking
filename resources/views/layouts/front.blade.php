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


    <link href="{{ asset('assets/front/css/bootstrap.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/front/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/front/css/vendors.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/front/css/signin.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/checkout.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />



        @if(isset($page_name)&&$page_name=='home')
     <style type="text/css">
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
     </style>
          @else
        <style type="text/css">
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
    </style>
        @endif

{{--    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />--}}
    @yield('styles')
</head>

<body>
<div id="page">
@if(isset($page_name)&&$page_name=='home')
    <header class="header menu_fixed">
        <div id="preloader">
            <div data-loader="circle-side"></div>
        </div>
        <!-- /Page Preload -->
        <div class="container">
            <div id="logo">
                <a href="index.html">
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
                        <span><a><img src="{{ asset('assets/front/img/global.svg')}}" /> English</a></span>
                    </li>
                    <li>
                        <span><a href="{{route('help_center')}}"> Help Center</a></span>
                    </li>
                    <li>
                        <span><a href="!#">Trips </a></span>
                    </li>
                    @guest
                    <li>
                        <span><a href="{{route('login')}}">Login</a></span>
                    </li>
                    @else
                    <li>
                        <span><a href="{{route('admin.home')}}">Account</a></span>
                    </li>
                     <li>
                        <span><a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">Logout</a></span>
                    </li>
                    @endguest
                </ul>
            </nav>
            <div class="mblsdiv1">
                <a href="#"><img src="{{ asset('assets/front/img/search-normal.svg')}}" /></a>
                <a href="#"><img src="{{ asset('assets/front/img/briefcase.svg')}}" /></a>
                <a href="./my-account.html"><svg style="width: 24px; height: 23px;"><path fill-rule="evenodd" fill="#fff" d="M12 2a10 10 0 100 20 10 10 0 000-20zm0 3a3 3 0 110 6 3 3 0 010-6zM6 15.98a7.2 7.2 0 0012 0c-.03-1.99-4.01-3.08-6-3.08-2 0-5.97 1.09-6 3.08z" clip-rule="evenodd"></path></svg></a>
            </div>
        </div>
    </header>
@else
        <header class="header menu_fixed">
            <div id="preloader">
                <div data-loader="circle-side"></div>
            </div>
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
                            <span><a><img src="{{asset('assets/front/img/drakglobal.svg')}}" /> English</a></span>
                        </li>
                        <li>
                            <span><a href="{{route('help_center')}}"> Help Center</a></span>
                        </li>
                        <li>
                            <span><a href="./tour-detail.html">Trips </a></span>
                        </li>
                        @guest
                            <li>
                                <span><a href="{{route('login')}}">Login</a></span>
                            </li>
                        @else
                            <li>
                                <span><a href="{{route('admin.home')}}"><img src="{{asset('assets/front/img/userimg.png')}}" class="userloginprofile" /></a></span>
                            </li>
                            <li>
                                <span><a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">Logout</a></span>
                            </li>
                        @endguest
{{--                        <li>--}}
{{--                            <span><a href="#"><img src="./img/userimg.png" class="userloginprofile" /></a></span>--}}
{{--                        </li>--}}

                    </ul>
                </nav>
                <div class="mblsdiv1">
                    <a href="#"><img src="{{asset('assets/front/img/dar-search-normal.svg')}}" /></a>
                    <a href="#"><img src="{{asset('assets/front/img/darkbriefcase.svg')}}" /></a>
                    <a href="{{route('frontend.account.index')}}"><svg style="width: 24px; height: 23px;"><path fill-rule="evenodd" d="M12 2a10 10 0 100 20 10 10 0 000-20zm0 3a3 3 0 110 6 3 3 0 010-6zM6 15.98a7.2 7.2 0 0012 0c-.03-1.99-4.01-3.08-6-3.08-2 0-5.97 1.09-6 3.08z" clip-rule="evenodd"></path></svg></a>
                </div>
            </div>
        </header>
    @if(isset($page_type)&&$page_type=='trip')
            @if($trip->featured_image)
                    <img src="{{ $trip->featured_image->getUrl() }}" class="tourdetailshead1">
              @else
                <img src="{{asset('assets/front/img/tourdetailsbg1.png')}}" class="tourdetailshead1" />
            @endif
        @endif
    @endif
    <!-- /header -->
        <main>
            @yield('content')
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
                    <form action="" class="newsletter-form">
                        <div class="input-field"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="14">
                                <g fill="none" fill-rule="evenodd" stroke="#9CA9BA" stroke-linecap="round" stroke-linejoin="round"
                                   stroke-width="2">
                                    <path d="M3 1h11a2 2 0 012 2v8a2 2 0 01-2 2H3a2 2 0 01-2-2V3a2 2 0 012-2z">
                                    </path>
                                    <path d="M2 2l6.5 6L15 2"></path>
                                </g>
                            </svg><input class="input" type="text" placeholder="Enter an email address"
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
                        <li><a href="./about.html">About us</a></li>
                        <li><a href="./blog.html">Blog</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6 ml-lg-auto">
                    <h5>FAQ</h5>
                    <ul class="links">
                        <li><a href="#">Account</a></li>
                        <li><a href="#">Trips</a></li>
                        <li><a href="#">Payments</a></li>
                        <li><a href="#">Refund policy</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6 flexsupport">
                    <h5>Support</h5>
                    <ul class="links">
                        <li><a href="#">Contact us</a></li>
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
                            <span>© 2000-2021, All Rights Reserved</span>
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
<!-- Modal sign in -->
<div class="modal modalsign" id="signinmodal" tabindex="-1" aria-labelledby="signinmodalLabel" aria-hidden="true">
    <div class="modal-dialog dialogsign">
        <div class="modal-content">
            <div class="modal-header disnotsign">
                <button type="button" class="btnclosesign" data-bs-dismiss="modal" aria-label="Close">
                    <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.48514 7.00022L12.9723 2.51308L13.8976 1.58774C14.0341 1.45123 14.0341 1.22941 13.8976 1.09291L12.9075 0.102816C12.771 -0.0336885 12.5492 -0.0336885 12.4127 0.102816L7.00022 5.5153L1.58774 0.102378C1.45123 -0.0341261 1.22941 -0.0341261 1.09291 0.102378L0.102378 1.09247C-0.0341261 1.22898 -0.0341261 1.4508 0.102378 1.5873L5.5153 7.00022L0.102378 12.4127C-0.0341261 12.5492 -0.0341261 12.771 0.102378 12.9075L1.09247 13.8976C1.22898 14.0341 1.4508 14.0341 1.5873 13.8976L7.00022 8.48514L11.4874 12.9723L12.4127 13.8976C12.5492 14.0341 12.771 14.0341 12.9075 13.8976L13.8976 12.9075C14.0341 12.771 14.0341 12.5492 13.8976 12.4127L8.48514 7.00022Z">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="">
                    <div class="container2" style="padding: 0px">
                        <div class="justify-content-center">
                            <div class="signinpgpad">
                                <!-- Heading -->
                                <h1 class="display-4 text-center mb-3">Sign in</h1>

                                <!-- Subheading -->
                                <p class="text-muted text-center mb-22">
                                    Free access to our dashboard.
                                </p>
                                <div>
                                    <button type="button" class="social-signing-button google-signing-button">
                      <span class="_1AB8XqH provider-icon" style="width: 18px; height: 18px">
                        <svg width="18" height="19" viewBox="0 0 18 19" xmlns="http://www.w3.org/2000/svg">
                          <path
                              d="M9 7.84363V11.307H13.8438C13.6365 12.428 12.9994 13.373 12.0489 14.0064V16.2534H14.9562C16.6601 14.6951 17.641 12.4029 17.641 9.67839C17.641 9.04502 17.5854 8.43176 17.4792 7.84865H9V7.84363Z"
                              fill="#3E82F1"></path>
                          <path
                              d="M9.00001 14.861C6.65394 14.861 4.67192 13.2876 3.96406 11.1714H0.955627V13.4937C2.43709 16.4142 5.48091 18.4198 9.00001 18.4198C11.432 18.4198 13.4697 17.6206 14.9562 16.2533L12.0489 14.0064C11.245 14.5443 10.2135 14.861 9.00001 14.861Z"
                              fill="#32A753"></path>
                          <path
                              d="M3.96404 5.45605H0.955617C0.348876 6.66246 0 8.02972 0 9.47238C0 10.915 0.348876 12.2823 0.955617 13.4887L3.96404 11.1714C3.78202 10.6335 3.6809 10.0605 3.6809 9.47238C3.6809 8.88426 3.78202 8.31122 3.96404 7.77336V5.45605Z"
                              fill="#F9BB00"></path>
                          <path
                              d="M0.955627 5.45597L3.96406 7.77327C4.67192 5.65703 6.65394 4.08368 9.00001 4.08368C10.3197 4.08368 11.5079 4.53608 12.4382 5.42078L15.0219 2.85214C13.4646 1.40948 11.427 0.52478 9.00001 0.52478C5.48091 0.52478 2.43709 2.53043 0.955627 5.45597Z"
                              fill="#E74133"></path>
                        </svg>
                      </span>
                                        <p>Continue with Google</p>
                                    </button>
                                </div>
                                <div class="form-separator"><span>or</span></div>
                                <!-- Form -->
                                <form>
                                    <!-- Email address -->
                                    <div class="prel">
                                        <input type="text" class="inputText " required />
                                        <span class="floating-label">Email</span>
                                    </div>

                                    <!-- Password -->
                                    <div class="prel">
                                        <input type="password" class="inputText paddingright30" required />
                                        <span class="floating-label">Password</span>
                                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>


                                    <!-- Submit -->
                                    <button class="btn btn-lg w-100 btn_1  btngrad mb-3">
                                        Continue
                                    </button>

                                    <div class="remeberflex">
                                        <div class="" style="margin-bottom: 0px">
                                            <label class="chbox2q2">Remember me
                                                <input type="checkbox">
                                                <span class="checkmark"></span>

                                        </div>
                                        <div class="">
                                            <!-- Help text -->
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#resetpasswrd" class="
                              form-text
                              small
                              notlikebutton
                              text-muted
                              resetbtnjs
                            " style="font-size: 14px; margin-bottom: 0px">
                                                Forgot password?
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Link -->
                        <hr style="margin: 0px" />
                        <div class="text-center" style="padding: 12px 0">
                            <small class="text-muted text-center">
                                Don't have an account yet?
                                <button class="notlikebutton signupbtnjs" type="button" data-bs-toggle="modal"
                                        data-bs-target="#signupmodal">
                                    Sign up
                                </button>
                            </small>
                        </div>
                        <!-- / .row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal reset password -->
<div class="modal modalsign" id="resetpasswrd" tabindex="-1" aria-labelledby="resetpasswrdLabel" aria-hidden="true">
    <div class="modal-dialog dialogsign">
        <div class="modal-content">
            <div class="modal-header disnotsign">
                <button type="button" class="btnclosesign" data-bs-dismiss="modal" aria-label="Close">
                    <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.48514 7.00022L12.9723 2.51308L13.8976 1.58774C14.0341 1.45123 14.0341 1.22941 13.8976 1.09291L12.9075 0.102816C12.771 -0.0336885 12.5492 -0.0336885 12.4127 0.102816L7.00022 5.5153L1.58774 0.102378C1.45123 -0.0341261 1.22941 -0.0341261 1.09291 0.102378L0.102378 1.09247C-0.0341261 1.22898 -0.0341261 1.4508 0.102378 1.5873L5.5153 7.00022L0.102378 12.4127C-0.0341261 12.5492 -0.0341261 12.771 0.102378 12.9075L1.09247 13.8976C1.22898 14.0341 1.4508 14.0341 1.5873 13.8976L7.00022 8.48514L11.4874 12.9723L12.4127 13.8976C12.5492 14.0341 12.771 14.0341 12.9075 13.8976L13.8976 12.9075C14.0341 12.771 14.0341 12.5492 13.8976 12.4127L8.48514 7.00022Z">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="">
                    <div class="container2" style="padding: 0px">
                        <div class="justify-content-center">
                            <div class="">
                                <!-- Heading -->
                                <!-- Form -->
                                <form class="forgetpasspgpad2">
                                    <h1 class="display-4 text-center mb-3">Reset Password</h1>

                                    <!-- Subheading -->
                                    <p class="text-muted text-center linehei" style="margin-bottom: 12px !important">
                                        Please enter your email address and we'll send you a
                                        link to reset your password.
                                    </p>
                                    <!-- Email address -->
                                    <div class="prel">
                                        <input type="text" class="inputText " required />
                                        <span class="floating-label">Email</span>
                                    </div>


                                    <!-- Submit -->
                                    <button class="btn btn-lg w-100 btn_1  btngrad" style="margin-bottom: 0px !important">
                                        Submit
                                    </button>
                                </form>
                                <hr style="margin: 0px" />
                                <!-- Link -->
                                <div class="text-center" style="padding: 12px 0">
                                    <small class="text-muted text-center">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#resetpasswrd"
                                                class="notlikebutton signinbtnjs">
                                            Back to Sign In
                                        </button>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <!-- / .row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal sign up -->
<div class="modal modalsign" id="signupmodal" tabindex="-1" aria-labelledby="signupmodalLabel" aria-hidden="true">
    <div class="modal-dialog dialogsign">
        <div class="modal-content">
            <div class="modal-header disnotsign">
                <button type="button" class="btnclosesign" data-bs-dismiss="modal" aria-label="Close">
                    <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.48514 7.00022L12.9723 2.51308L13.8976 1.58774C14.0341 1.45123 14.0341 1.22941 13.8976 1.09291L12.9075 0.102816C12.771 -0.0336885 12.5492 -0.0336885 12.4127 0.102816L7.00022 5.5153L1.58774 0.102378C1.45123 -0.0341261 1.22941 -0.0341261 1.09291 0.102378L0.102378 1.09247C-0.0341261 1.22898 -0.0341261 1.4508 0.102378 1.5873L5.5153 7.00022L0.102378 12.4127C-0.0341261 12.5492 -0.0341261 12.771 0.102378 12.9075L1.09247 13.8976C1.22898 14.0341 1.4508 14.0341 1.5873 13.8976L7.00022 8.48514L11.4874 12.9723L12.4127 13.8976C12.5492 14.0341 12.771 14.0341 12.9075 13.8976L13.8976 12.9075C14.0341 12.771 14.0341 12.5492 13.8976 12.4127L8.48514 7.00022Z">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="">
                    <div class="container2" style="padding: 0px">
                        <div class="justify-content-center signuppart1">
                            <div class="signinpgpad">
                                <!-- Heading -->
                                <h3 class="display-4 text-center mb-3">Sign Up</h3>
                                <p class="text-muted text-center mb-22">
                                    Free access to our dashboard.
                                </p>

                                <div>
                                    <button type="button" class="social-signing-button google-signing-button">
                      <span class="_1AB8XqH provider-icon" style="width: 18px; height: 18px">
                        <svg width="18" height="19" viewBox="0 0 18 19" xmlns="http://www.w3.org/2000/svg">
                          <path
                              d="M9 7.84363V11.307H13.8438C13.6365 12.428 12.9994 13.373 12.0489 14.0064V16.2534H14.9562C16.6601 14.6951 17.641 12.4029 17.641 9.67839C17.641 9.04502 17.5854 8.43176 17.4792 7.84865H9V7.84363Z"
                              fill="#3E82F1"></path>
                          <path
                              d="M9.00001 14.861C6.65394 14.861 4.67192 13.2876 3.96406 11.1714H0.955627V13.4937C2.43709 16.4142 5.48091 18.4198 9.00001 18.4198C11.432 18.4198 13.4697 17.6206 14.9562 16.2533L12.0489 14.0064C11.245 14.5443 10.2135 14.861 9.00001 14.861Z"
                              fill="#32A753"></path>
                          <path
                              d="M3.96404 5.45605H0.955617C0.348876 6.66246 0 8.02972 0 9.47238C0 10.915 0.348876 12.2823 0.955617 13.4887L3.96404 11.1714C3.78202 10.6335 3.6809 10.0605 3.6809 9.47238C3.6809 8.88426 3.78202 8.31122 3.96404 7.77336V5.45605Z"
                              fill="#F9BB00"></path>
                          <path
                              d="M0.955627 5.45597L3.96406 7.77327C4.67192 5.65703 6.65394 4.08368 9.00001 4.08368C10.3197 4.08368 11.5079 4.53608 12.4382 5.42078L15.0219 2.85214C13.4646 1.40948 11.427 0.52478 9.00001 0.52478C5.48091 0.52478 2.43709 2.53043 0.955627 5.45597Z"
                              fill="#E74133"></path>
                        </svg>
                      </span>
                                        <p>Continue with Google</p>
                                    </button>
                                </div>
                                <div class="form-separator"><span>or</span></div>
                                <!-- Form -->
                                <form>
                                    <!-- Email address -->
                                    <div class="prel">
                                        <input type="text" id="form_email" class="inputText " required />
                                        <span class="floating-label">Email</span>
                                        <p class="emailmsg errortxtst2 colorred" style="display: none">
                                            Looks like this email is incomplete.
                                        </p>
                                    </div>

                                    <button type="submit" id="signupp1" class="buttonsub loadingsubmitbtn mb-3 btngrad">
                                        <span class="button__content">Continue</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="justify-content-center signuppart2">
                            <div class="signinpgpad">
                                <!-- Heading -->
                                <h3 class="display-4 text-center mb-3">Sign Up</h3>
                                <p class="text-muted text-center mb-22">
                                    Free access to our dashboard.
                                </p>
                                <!-- Form -->
                                <form>
                                    <div class="prel">
                                        <input type="password" id="mypass" class="inputText " required />
                                        <span class="floating-label">Password</span>
                                        <p class="passmsg errortxtst2 colorred">
                                            8 characters or longer. Combine upper and lowercase
                                            letters and numbers.
                                        </p>
                                    </div>


                                    <div class="">
                                        <!-- Input -->
                                        <div class="row">
                                            <div style="width: 50%">
                                                <div class="prel">
                                                    <input type="text" id="firstname" class="inputText " required />
                                                    <span class="floating-label">First Name</span>
                                                    <p class="fnamemsg errortxtst2 colorred" style="display: none">
                                                        First Name is required
                                                    </p>
                                                </div>

                                            </div>
                                            <div style="width: 50%">
                                                <div class="prel">
                                                    <input type="text" id="lastname" class="inputText " required />
                                                    <span class="floating-label">Last Name</span>
                                                    <p class="lnamemsg errortxtst2 colorred" style="display: none">
                                                        Last Name is required
                                                    </p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="">
                                        <div class="prel">
                                            <input type="text" id="phonenum" class="inputText" maxlength="10"
                                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                   required />
                                            <span class="floating-label">Phone</span>
                                            <p class="phonemsg errortxtst2 colorred" style="display: none">
                                                Phone is required
                                            </p>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <div class="gendercontainer">
                                            <input type="radio" id="male" checked="checked" name="radio" />
                                            <label for="male">Male</label>
                                            <input type="radio" id="female" name="radio" />
                                            <label for="female">Female</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="prel">
                                            <select class="form-select formsele" aria-label="Default select example">
                                                <option value="" selected="">Select your country</option>
                                                <option value="Afganistan">Afghanistan</option>
                                                <option value="Albania">Albania</option>
                                                <option value="Algeria">Algeria</option>
                                                <option value="American Samoa">American Samoa</option>
                                                <option value="Andorra">Andorra</option>
                                                <option value="Angola">Angola</option>
                                                <option value="Anguilla">Anguilla</option>
                                                <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                                                <option value="Argentina">Argentina</option>
                                                <option value="Armenia">Armenia</option>
                                                <option value="Aruba">Aruba</option>
                                                <option value="Australia">Australia</option>
                                                <option value="Austria">Austria</option>
                                                <option value="Azerbaijan">Azerbaijan</option>
                                                <option value="Bahamas">Bahamas</option>
                                                <option value="Bahrain">Bahrain</option>
                                                <option value="Bangladesh">Bangladesh</option>
                                                <option value="Barbados">Barbados</option>
                                                <option value="Belarus">Belarus</option>
                                                <option value="Belgium">Belgium</option>
                                                <option value="Belize">Belize</option>
                                                <option value="Benin">Benin</option>
                                                <option value="Bermuda">Bermuda</option>
                                                <option value="Bhutan">Bhutan</option>
                                                <option value="Bolivia">Bolivia</option>
                                                <option value="Bonaire">Bonaire</option>
                                                <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                                                <option value="Botswana">Botswana</option>
                                                <option value="Brazil">Brazil</option>
                                                <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                                                <option value="Brunei">Brunei</option>
                                                <option value="Bulgaria">Bulgaria</option>
                                                <option value="Burkina Faso">Burkina Faso</option>
                                                <option value="Burundi">Burundi</option>
                                                <option value="Cambodia">Cambodia</option>
                                                <option value="Cameroon">Cameroon</option>
                                                <option value="Canada">Canada</option>
                                                <option value="Canary Islands">Canary Islands</option>
                                                <option value="Cape Verde">Cape Verde</option>
                                                <option value="Cayman Islands">Cayman Islands</option>
                                                <option value="Central African Republic">Central African Republic</option>
                                                <option value="Chad">Chad</option>
                                                <option value="Channel Islands">Channel Islands</option>
                                                <option value="Chile">Chile</option>
                                                <option value="China">China</option>
                                                <option value="Christmas Island">Christmas Island</option>
                                                <option value="Cocos Island">Cocos Island</option>
                                                <option value="Colombia">Colombia</option>
                                                <option value="Comoros">Comoros</option>
                                                <option value="Congo">Congo</option>
                                                <option value="Cook Islands">Cook Islands</option>
                                                <option value="Costa Rica">Costa Rica</option>
                                                <option value="Cote DIvoire">Cote DIvoire</option>
                                                <option value="Croatia">Croatia</option>
                                                <option value="Cuba">Cuba</option>
                                                <option value="Curaco">Curacao</option>
                                                <option value="Cyprus">Cyprus</option>
                                                <option value="Czech Republic">Czech Republic</option>
                                                <option value="Denmark">Denmark</option>
                                                <option value="Djibouti">Djibouti</option>
                                                <option value="Dominica">Dominica</option>
                                                <option value="Dominican Republic">Dominican Republic</option>
                                                <option value="East Timor">East Timor</option>
                                                <option value="Ecuador">Ecuador</option>
                                                <option value="Egypt">Egypt</option>
                                                <option value="El Salvador">El Salvador</option>
                                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                <option value="Eritrea">Eritrea</option>
                                                <option value="Estonia">Estonia</option>
                                                <option value="Ethiopia">Ethiopia</option>
                                                <option value="Falkland Islands">Falkland Islands</option>
                                                <option value="Faroe Islands">Faroe Islands</option>
                                                <option value="Fiji">Fiji</option>
                                                <option value="Finland">Finland</option>
                                                <option value="France">France</option>
                                                <option value="French Guiana">French Guiana</option>
                                                <option value="French Polynesia">French Polynesia</option>
                                                <option value="French Southern Ter">French Southern Ter</option>
                                                <option value="Gabon">Gabon</option>
                                                <option value="Gambia">Gambia</option>
                                                <option value="Georgia">Georgia</option>
                                                <option value="Germany">Germany</option>
                                                <option value="Ghana">Ghana</option>
                                                <option value="Gibraltar">Gibraltar</option>
                                                <option value="Great Britain">Great Britain</option>
                                                <option value="Greece">Greece</option>
                                                <option value="Greenland">Greenland</option>
                                                <option value="Grenada">Grenada</option>
                                                <option value="Guadeloupe">Guadeloupe</option>
                                                <option value="Guam">Guam</option>
                                                <option value="Guatemala">Guatemala</option>
                                                <option value="Guinea">Guinea</option>
                                                <option value="Guyana">Guyana</option>
                                                <option value="Haiti">Haiti</option>
                                                <option value="Hawaii">Hawaii</option>
                                                <option value="Honduras">Honduras</option>
                                                <option value="Hong Kong">Hong Kong</option>
                                                <option value="Hungary">Hungary</option>
                                                <option value="Iceland">Iceland</option>
                                                <option value="Indonesia">Indonesia</option>
                                                <option value="India">India</option>
                                                <option value="Iran">Iran</option>
                                                <option value="Iraq">Iraq</option>
                                                <option value="Ireland">Ireland</option>
                                                <option value="Isle of Man">Isle of Man</option>
                                                <option value="Israel">Israel</option>
                                                <option value="Italy">Italy</option>
                                                <option value="Jamaica">Jamaica</option>
                                                <option value="Japan">Japan</option>
                                                <option value="Jordan">Jordan</option>
                                                <option value="Kazakhstan">Kazakhstan</option>
                                                <option value="Kenya">Kenya</option>
                                                <option value="Kiribati">Kiribati</option>
                                                <option value="Korea North">Korea North</option>
                                                <option value="Korea Sout">Korea South</option>
                                                <option value="Kuwait">Kuwait</option>
                                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                <option value="Laos">Laos</option>
                                                <option value="Latvia">Latvia</option>
                                                <option value="Lebanon">Lebanon</option>
                                                <option value="Lesotho">Lesotho</option>
                                                <option value="Liberia">Liberia</option>
                                                <option value="Libya">Libya</option>
                                                <option value="Liechtenstein">Liechtenstein</option>
                                                <option value="Lithuania">Lithuania</option>
                                                <option value="Luxembourg">Luxembourg</option>
                                                <option value="Macau">Macau</option>
                                                <option value="Macedonia">Macedonia</option>
                                                <option value="Madagascar">Madagascar</option>
                                                <option value="Malaysia">Malaysia</option>
                                                <option value="Malawi">Malawi</option>
                                                <option value="Maldives">Maldives</option>
                                                <option value="Mali">Mali</option>
                                                <option value="Malta">Malta</option>
                                                <option value="Marshall Islands">Marshall Islands</option>
                                                <option value="Martinique">Martinique</option>
                                                <option value="Mauritania">Mauritania</option>
                                                <option value="Mauritius">Mauritius</option>
                                                <option value="Mayotte">Mayotte</option>
                                                <option value="Mexico">Mexico</option>
                                                <option value="Midway Islands">Midway Islands</option>
                                                <option value="Moldova">Moldova</option>
                                                <option value="Monaco">Monaco</option>
                                                <option value="Mongolia">Mongolia</option>
                                                <option value="Montserrat">Montserrat</option>
                                                <option value="Morocco">Morocco</option>
                                                <option value="Mozambique">Mozambique</option>
                                                <option value="Myanmar">Myanmar</option>
                                                <option value="Nambia">Nambia</option>
                                                <option value="Nauru">Nauru</option>
                                                <option value="Nepal">Nepal</option>
                                                <option value="Netherland Antilles">Netherland Antilles</option>
                                                <option value="Netherlands">Netherlands (Holland, Europe)</option>
                                                <option value="Nevis">Nevis</option>
                                                <option value="New Caledonia">New Caledonia</option>
                                                <option value="New Zealand">New Zealand</option>
                                                <option value="Nicaragua">Nicaragua</option>
                                                <option value="Niger">Niger</option>
                                                <option value="Nigeria">Nigeria</option>
                                                <option value="Niue">Niue</option>
                                                <option value="Norfolk Island">Norfolk Island</option>
                                                <option value="Norway">Norway</option>
                                                <option value="Oman">Oman</option>
                                                <option value="Pakistan">Pakistan</option>
                                                <option value="Palau Island">Palau Island</option>
                                                <option value="Palestine">Palestine</option>
                                                <option value="Panama">Panama</option>
                                                <option value="Papua New Guinea">Papua New Guinea</option>
                                                <option value="Paraguay">Paraguay</option>
                                                <option value="Peru">Peru</option>
                                                <option value="Phillipines">Philippines</option>
                                                <option value="Pitcairn Island">Pitcairn Island</option>
                                                <option value="Poland">Poland</option>
                                                <option value="Portugal">Portugal</option>
                                                <option value="Puerto Rico">Puerto Rico</option>
                                                <option value="Qatar">Qatar</option>
                                                <option value="Republic of Montenegro">Republic of Montenegro</option>
                                                <option value="Republic of Serbia">Republic of Serbia</option>
                                                <option value="Reunion">Reunion</option>
                                                <option value="Romania">Romania</option>
                                                <option value="Russia">Russia</option>
                                                <option value="Rwanda">Rwanda</option>
                                                <option value="St Barthelemy">St Barthelemy</option>
                                                <option value="St Eustatius">St Eustatius</option>
                                                <option value="St Helena">St Helena</option>
                                                <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                                                <option value="St Lucia">St Lucia</option>
                                                <option value="St Maarten">St Maarten</option>
                                                <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                                                <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                                                <option value="Saipan">Saipan</option>
                                                <option value="Samoa">Samoa</option>
                                                <option value="Samoa American">Samoa American</option>
                                                <option value="San Marino">San Marino</option>
                                                <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                                                <option value="Saudi Arabia">Saudi Arabia</option>
                                                <option value="Senegal">Senegal</option>
                                                <option value="Seychelles">Seychelles</option>
                                                <option value="Sierra Leone">Sierra Leone</option>
                                                <option value="Singapore">Singapore</option>
                                                <option value="Slovakia">Slovakia</option>
                                                <option value="Slovenia">Slovenia</option>
                                                <option value="Solomon Islands">Solomon Islands</option>
                                                <option value="Somalia">Somalia</option>
                                                <option value="South Africa">South Africa</option>
                                                <option value="Spain">Spain</option>
                                                <option value="Sri Lanka">Sri Lanka</option>
                                                <option value="Sudan">Sudan</option>
                                                <option value="Suriname">Suriname</option>
                                                <option value="Swaziland">Swaziland</option>
                                                <option value="Sweden">Sweden</option>
                                                <option value="Switzerland">Switzerland</option>
                                                <option value="Syria">Syria</option>
                                                <option value="Tahiti">Tahiti</option>
                                                <option value="Taiwan">Taiwan</option>
                                                <option value="Tajikistan">Tajikistan</option>
                                                <option value="Tanzania">Tanzania</option>
                                                <option value="Thailand">Thailand</option>
                                                <option value="Togo">Togo</option>
                                                <option value="Tokelau">Tokelau</option>
                                                <option value="Tonga">Tonga</option>
                                                <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                                                <option value="Tunisia">Tunisia</option>
                                                <option value="Turkey">Turkey</option>
                                                <option value="Turkmenistan">Turkmenistan</option>
                                                <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                                                <option value="Tuvalu">Tuvalu</option>
                                                <option value="Uganda">Uganda</option>
                                                <option value="United Kingdom">United Kingdom</option>
                                                <option value="Ukraine">Ukraine</option>
                                                <option value="United Arab Erimates">United Arab Emirates</option>
                                                <option value="United States of America">United States of America</option>
                                                <option value="Uraguay">Uruguay</option>
                                                <option value="Uzbekistan">Uzbekistan</option>
                                                <option value="Vanuatu">Vanuatu</option>
                                                <option value="Vatican City State">Vatican City State</option>
                                                <option value="Venezuela">Venezuela</option>
                                                <option value="Vietnam">Vietnam</option>
                                                <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                                                <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                                                <option value="Wake Island">Wake Island</option>
                                                <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                                                <option value="Yemen">Yemen</option>
                                                <option value="Zaire">Zaire</option>
                                                <option value="Zambia">Zambia</option>
                                                <option value="Zimbabwe">Zimbabwe</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="">
                                            <label class="chbox2q">l consent to receive emails from Carnival Utopia.*
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>

                                        </div>
                                        <div class="">
                                            <label class="chbox2q">I agree to allow Carnival Utopia to store
                                                and
                                                process my personal data.*
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <p>
                                            By submitting this form you are agreeing to Carnival
                                            Utopia LLC's
                                            <a href="./terms-and-conditions.html" target="_blank">Terms and Privacy Policy</a>
                                        </p>
                                    </div>

                                    <!-- Submit -->
                                    <button type="submit" class="btn btn-lg w-100 btn_1  btngrad mb-3" id="signupp2">
                                        <span>Submit</span>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Link -->
                        <hr style="margin: 0px" />
                        <div class="text-center" style="padding: 12px 0">
                            <small class="text-muted text-center">
                                Already a member?
                                <button type="button" data-bs-toggle="modal" data-bs-target="#signinmodal"
                                        class="notlikebutton signinbtnjs">
                                    Sign In
                                </button>
                            </small>
                        </div>
                        <!-- / .row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- COMMON SCRIPTS -->
<script src="{{ asset('assets/front/js/bootstrap.bundle.min.js')}}"></script>
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
<script src="{{ asset('assets/front/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/front/js/common_scripts.js') }}"></script>
<script src="{{ asset('assets/front/js/main.js')}}"></script>
<script src="{{ asset('assets/front/js/script2.js')}}"></script>
@yield('scripts')
<script>
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
</script>
</body>

</html>

@extends('layouts.front')
@section('content')
<div class="">
    <div class="container margin_100_35">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 mblscroll">
                @include('partials.account_menu')
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                        <div class="generaltabmin">
                            <div class="usercover1">
{{--                                <img class="userblurimg" src="{{$user->profileimage??asset('assets/front/img/Ellipse 33.png')}}" />--}}

                            </div>
                            <div class="userimgchngr">
                                <img class="userblurimg" id="profileimage" src="{{$user->profileimage??asset('assets/front/img/Ellipse 33.png')}}" />
                                <input type="file" id="profileimage-upload" name="profileimage" onchange="readURL(this,'{{$user->profileimage??asset('assets/front/img/Ellipse 33.png')}}')" style="display: none">
                                <div class="editimgbar">
                                    <img src="{{asset('assets/front/img/edit-2.svg')}}" onclick="$('#profileimage-upload').trigger('click'); return false;" />
                                </div>
                            </div>

                            <div class="genrelform">
                                <h2 class="heading003">Personal Information</h2>
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">First name</label>
                                                <input type="text" class="form-control" value="{{$user->name}}" placeholder="First name"
                                                       id="firstname" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="lastname" class="form-label">Last name</label>
                                                <input type="text" class="form-control" value="{{$user->lastname}}" placeholder="Last name"
                                                       id="lastname" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                                <input type="email" class="form-control" value="{{$user->email}}" id="exampleInputEmail1"
                                                       placeholder="you@company.com" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="exampleInputphone" class="form-label">Phone</label>
                                                <input type="text" class="form-control" id="exampleInputphone" value="{{$user->phone}}"
                                                       placeholder="you@company.com" required>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Gender</label>
                                                <div class="form-check">
                                                    <input class="form-check-input form-check-input2" type="radio" name="flexRadioDefault"
                                                           id="flexRadioDefault1" value="male" {{$user->gender=='male'?'checked':''}}>
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Male
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input form-check-input2" type="radio" name="flexRadioDefault"
                                                           id="flexRadioDefault2" value="female" {{$user->gender=='female'?'checked':''}}>
                                                    <label class="form-check-label"  for="flexRadioDefault2">
                                                        Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="stad" class="form-label">Street Address</label>
                                                <input type="text" class="form-control" value="{{$user->address}}" placeholder="Street Address" id="stad" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="stad2" class="form-label">Apt, Suite, Building</label>
                                                <input type="text" class="form-control" value="{{$user->address2}}" placeholder="Apt, Suite, Building" id="stad2"
                                                       required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="country_id" class="form-label">Country/Region</label>
                                                <select class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country_id" id="country_id" required>
                                                    @foreach($countries as $id => $entry)
                                                        <option value="{{ $id }}" {{ (old('country_id') ? old('country_id') : $user->country->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="cityst" class="form-label">City, State</label>
{{--                                                <input type="text" class="form-control" placeholder="Chhagalnaiya, Feni" id="cityst"--}}
{{--                                                       required>--}}
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <select class="form-control select2 {{ $errors->has('state') ? 'is-invalid' : '' }}" name="state_id" id="state_id" required>
                                                            @foreach($states as $id => $entry)
                                                                <option value="{{ $id }}" {{ (old('state_id') ? old('state_id') : $user->state->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id" >
                                                            @foreach($cities as $id => $entry)
                                                                <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : $user->city->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                    </div>



                                    <button type="submit" class="btn_1 btngrad btnfull">Save Profile</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="mytrip" role="tabpanel" aria-labelledby="mytrip-tab">
                        <div class="tripsmaindiv">
                            <h2 class="heading003">My Trips </h2>
                            <div class="row ">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="card mb-3 tripsdiv modaltripdetails1show">
                                        <div>
                                            <img src="{{asset('assets/front/img/tour_1.jpg')}}" class="card-img-top" alt="Trip Image" />
                                        </div>
                                        <div class="card-body">
                                            <div class="tripsinfo1">
                                                <h5 class="card-title">Cinnamon Dhonveli: The sunny side of life</h5>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="card mb-3 tripsdiv modaltripdetails1show">
                                        <div>
                                            <img src="{{asset('assets/front/img/tour_2.jpg')}}" class="card-img-top" alt="Trip Image" />
                                        </div>
                                        <div class="card-body">
                                            <div class="tripsinfo1">
                                                <h5 class="card-title">Malesuada consequat hac quis commodo vel. Pellentesque.</h5>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                    <div class="tab-pane fade" id="paymentmethod" role="tabpanel" aria-labelledby="paymentmethod-tab">
                        <div>
                            <div class="alert alert-danger">
                                <i class="fe fe-info me-1"></i> You are near your API
                                limits.
                            </div>
                            <div class="card mt2form2">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <!-- Title -->
                                            <h4 class="card-header-title">Payment methods</h4>
                                        </div>
                                        <div class="col-auto">
                                            <!-- Button -->
                                            <button class="btn_1  btngrad btn-sm btnsm2" href="#" style="font-size: 13px" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                Add new
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- List group -->
                                    <div class="list-group list-group-flush my-n3">
                                        <div class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <!-- Image -->
                                                    <img class="img-fluid" src="{{asset('assets/front/img/visa.svg')}}" alt="..." style="max-width: 38px" />
                                                </div>
                                                <div class="col ms-n2">
                                                    <!-- Heading -->
                                                    <h5 class="headingtbg2">Visa ending in 1234</h5>

                                                    <!-- Text -->
                                                    <small class="text-muted">
                                                        Expires 3/2024
                                                    </small>
                                                </div>
                                                <div class="col-auto me-n3">
                                                    <!-- Badge -->
                                                    <span class="badge bglight2"> Default </span>
                                                </div>
                                                <div class="col-auto">
                                                    <!-- Dropdown -->
                                                    <div class="dropdown">
                                                        <a class="
                                      dropdown-ellipses dropdown-toggle
                                      colordrop
                                    " href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                           aria-expanded="false">
                                                            <img class="moreverti" src="{{asset('assets/front/img/more-vertical.svg')}}" />
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                                            <button class="dropdown-item">Edit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- / .row -->
                                        </div>
                                        <div class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <!-- Image -->
                                                    <img class="img-fluid" src="{{asset('assets/front/img/mastercard.svg')}}" alt="..." style="max-width: 38px" />
                                                </div>
                                                <div class="col ms-n2">
                                                    <!-- Heading -->
                                                    <h5 class="headingtbg2">
                                                        Mastercard ending in 1234
                                                    </h5>

                                                    <!-- Text -->
                                                    <small class="text-muted">
                                                        Expires 3/2024
                                                    </small>
                                                </div>
                                                <div class="col-auto">
                                                    <!-- Dropdown -->
                                                    <div class="dropdown">
                                                        <a class="
                                      dropdown-ellipses dropdown-toggle
                                      colordrop
                                    " href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                           aria-expanded="false">
                                                            <img class="moreverti" src="{{asset('assets/front/img/more-vertical.svg')}}" />
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <button class="dropdown-item">Edit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- / .row -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt2form2">
                                <div class="card-header">
                                    <!-- Title -->
                                    <h4 class="card-header-title">Invoices</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-sm table-nowrap card-table">
                                        <thead>
                                        <tr>
                                            <th>Invoice ID</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody class="fs-base">
                                        <tr>
                                            <td>
                                                <a href="invoice.html">Invoice #10395</a>
                                            </td>
                                            <td>
                                                <time datetime="2020-04-24">Apr. 24, 2020</time>
                                            </td>
                                            <td>$29.00</td>
                                            <td>
                                                <span class="badge bglight2">Outstanding</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="invoice.html">Invoice #10244</a>
                                            </td>
                                            <td>
                                                <time datetime="2020-03-24">Mar. 24, 2020</time>
                                            </td>
                                            <td>$29.00</td>
                                            <td>
                                                <span class="badge bglight2">Paid</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="invoice.html">Invoice #10119</a>
                                            </td>
                                            <td>
                                                <time datetime="2020-02-24">Feb. 24, 2020</time>
                                            </td>
                                            <td>$29.00</td>
                                            <td>
                                                <span class="badge bglight2">Paid</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="invoice.html">Invoice #10062</a>
                                            </td>
                                            <td>
                                                <time datetime="2020-01-24">Jan. 24, 2020</time>
                                            </td>
                                            <td>$29.00</td>
                                            <td>
                                                <span class="badge bglight2">Paid</span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show" id="Offers" role="tabpanel" aria-labelledby="Offers-tab">
                        <div>
                            <div class="row">
                                <!-- <div class="col-md-3">
                                <img class="imgoff" src="{{asset('assets/front/img/vistaprint_logo_13.png')}}" />
                              </div> -->
                                <div class="col-md-12">
                                    <div class="offersecdiv">
                                        <h2>Up to 30% Off Promo Code</h2>
                                        <p>Groupon Users! Don't miss out on this Vistaprint promo code exclusively to Groupon. Get 20%
                                            Off one item or 30% off two items.</p>
                                        <div class="announcement">
                                            <div class="coupon">
                                                <input type="text" value="CODEPEN50" id="couponCode" readonly />
                                                <div class="tooltip">
                                                    <button onclick="myFunction()" class="btnout" onmouseout="outFunc()">
                                                        <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>
                                                        Copy
                                                    </button>
                                                </div>


                                            </div>
                                            <a href="#" class="btn_1 btngrad btnshopoff"> Shop Now</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show" id="chpass" role="tabpanel" aria-labelledby="chpass-tab">
                        <div>
                            <div class="row justify-content-between align-items-center mb-5">
                                <div class="col-12 col-md-9 col-xl-7">

                                    <!-- Heading -->
                                    <h2 class="mb-2" style="font-size: 20px;     margin-bottom: .375rem!important;">
                                        Change your password
                                    </h2>

                                    <!-- Text -->
                                    <p class="text-muted mb-xl-0" style="font-size: 15px; line-height: 1.5;">
                                        We will email you a confirmation when changing your password, so please expect that email
                                        after
                                        submitting.
                                    </p>

                                </div>
                                <div class="col-12 col-xl-auto">

                                    <!-- Button -->
                                    <button class="btn_1 btngrad">
                                        Forgot your password?
                                    </button>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 order-md-2">

                                    <!-- Card -->
                                    <div class="card bg-light border ms-md-4 cardmbygu">
                                        <div class="card-body cardpad">

                                            <!-- Text -->
                                            <p class="mb-2">
                                                Password requirements
                                            </p>

                                            <!-- Text -->
                                            <p class="small text-muted mb-2">
                                                To create a new password, you have to meet all of the following requirements:
                                            </p>

                                            <!-- List group -->
                                            <ul class="small text-muted ps-4 mb-0">
                                                <li>
                                                    Minimum 8 character
                                                </li>
                                                <li>
                                                    At least one special character
                                                </li>
                                                <li>
                                                    At least one number
                                                </li>
                                                <li>
                                                    Can’t be the same as a previous password
                                                </li>
                                            </ul>

                                        </div>
                                    </div>

                                </div>
                                <div class="col-12 col-md-6">

                                    <!-- Form -->
                                    <form>

                                        <div class="prel">
                                            <input type="password" class="inputText" required />
                                            <span class="floating-label">Current password</span>
                                        </div>
                                        <div class="prel">
                                            <input type="password" class="inputText" required />
                                            <span class="floating-label">New password</span>
                                        </div>
                                        <div class="prel">
                                            <input type="password" class="inputText" required />
                                            <span class="floating-label">Confirm new password</span>
                                        </div>

                                        <!-- Submit -->
                                        <button class="btn_1 btngrad" type="submit">
                                            Update password
                                        </button>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
                        <div>
                            <section id="reviews" class="gduuuuu">

                                <div class="reviews-container">


                                    <div class="reviews-container">

                                        <!-- /review-box -->
                                        <div class="review-box clearfix" style="padding-left: 0px;">

                                            <div class="rev-content">
                                                <div class="rating">
                                                    <img src="{{asset('assets/front/img/star.svg')}}" style="width: 14px; height: 14px"><img src="{{asset('assets/front/img/star.svg')}}"
                                                                                                                     style="width: 14px; height: 14px"><img src="{{asset('assets/front/img/star.svg')}}"
                                                                                                                                                            style="width: 14px; height: 14px"><img src="{{asset('assets/front/img/star.svg')}}"
                                                                                                                                                                                                   style="width: 14px; height: 14px"><img src="{{asset('assets/front/img/star.svg')}}"
                                                                                                                                                                                                                                          style="width: 14px; height: 14px">
                                                </div>
                                                <div class="rev-info">Ahsan – April 01, 2016:</div>
                                                <div class="rev-text">
                                                    <p>
                                                        Sed eget turpis a pede tempor malesuada. Vivamus
                                                        quis mi at leo pulvinar hendrerit. Cum sociis
                                                        natoque penatibus et magnis dis
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /review-box -->
                                        <div class="review-box clearfix" style="padding-left: 0px;">
                                            <div class="rev-content">
                                                <div class="rating">
                                                    <img src="{{asset('assets/front/img/star.svg')}}" style="width: 14px; height: 14px"><img src="{{asset('assets/front/img/star.svg')}}"
                                                                                                                     style="width: 14px; height: 14px"><img src="{{asset('assets/front/img/star.svg')}}"
                                                                                                                                                            style="width: 14px; height: 14px"><img src="{{asset('assets/front/img/star.svg')}}"
                                                                                                                                                                                                   style="width: 14px; height: 14px"><img src="{{asset('assets/front/img/star.svg')}}"
                                                                                                                                                                                                                                          style="width: 14px; height: 14px">
                                                </div>
                                                <div class="rev-info">Sara – March 31, 2016:</div>
                                                <div class="rev-text">
                                                    <p>
                                                        Sed eget turpis a pede tempor malesuada. Vivamus
                                                        quis mi at leo pulvinar hendrerit. Cum sociis
                                                        natoque penatibus et magnis dis
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /review-box -->
                                    </div>
                                    <!-- /review-container -->
                            </section>
                            <div class="add-review">
                                <h5>Leave a Review</h5>
                                <form>
                                    <div class="row">
                                        <div class=" col-md-6">
                                            <div class="prel">
                                                <input type="text" class="inputText" required />
                                                <span class="floating-label">Full Name</span>
                                            </div>
                                        </div>
                                        <div class=" col-md-6">
                                            <div class="prel">
                                                <input type="text" class="inputText" required />
                                                <span class="floating-label">Email</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">

                                            <div class="custom-select-form">
                                                <select name="rating_review" id="rating_review" class="wide" style="display: none;">
                                                    <option value="1">1 (lowest)</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5" selected="">5 (medium)</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10 (highest)</option>
                                                </select>
                                                <div class="nice-select wide" tabindex="0"><span class="current">Ratting</span>
                                                    <ul class="list">
                                                        <li data-value="1" class="option">1 (lowest)</li>
                                                        <li data-value="2" class="option">2</li>
                                                        <li data-value="3" class="option">3</li>
                                                        <li data-value="4" class="option">4</li>
                                                        <li data-value="5" class="option selected">5 (medium)</li>
                                                        <li data-value="6" class="option">6</li>
                                                        <li data-value="7" class="option">7</li>
                                                        <li data-value="8" class="option">8</li>
                                                        <li data-value="9" class="option">9</li>
                                                        <li data-value="10" class="option">10 (highest)</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                              <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                        style="height: 100px"></textarea>
                                                <label for="floatingTextarea2">Your Review</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 add_top_20">
                                            <input type="submit" value="Submit" class="btn_1  btngrad btngrad" id="submit-review">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- /row -->
    </div>
    <!-- /container -->
</div>
@endsection
@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/card/1.3.1/js/card.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $(".modaltripdetails1show").click(function () {
                $("#modaltripdetails1").modal("show");
            });
        });
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#imagePreview").css(
                        "background-image",
                        "url(" + e.target.result + ")"
                    );
                    $("#imagePreview").hide();
                    $("#imagePreview").fadeIn(650);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function () {
            readURL(this);
        });
    </script>
    <script>
        new Card({
            form: "form",
            formSelectors: {
                numberInput: "input[name=number]",
                expiryInput: "input[name=expiry]",
                cvcInput: "input[name=cvv]",
                nameInput: "input[name=name]",
            },

            width: 390, // optional — default 350px
            formatting: true,

            placeholders: {
                number: "•••• •••• •••• ••••",
                name: "Full Name",
                expiry: "••/••",
                cvc: "•••",
            },
        });
        function readURL(input,profileimg='') {
            var url = input.value;
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#profileimage').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }else{
                $('#profileimage').attr('src', profileimg);
            }
        }
    </script>
@endsection

@extends('layouts.front')

@section('content')
    <div class="margin_80_0">

        <div class="latestnlogdiv">
            <div class="container">
                <div class="abouthead1">
                    <h2 class="testimonaldivh2">Contact us</h2>
                    <p class="testimonaldivp">Our friendly team would love to hear from you.
                    </p>
                </div>
                <div class="contactusform">
                    <form action="{{route('contact')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="firstname" class="form-label">First name</label>
                                    <input type="text" class="form-control" placeholder="First name" name="firstname" id="firstname" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="lastname" class="form-label">Last name</label>
                                    <input type="text" class="form-control" placeholder="Last name" name="lastname" id="lastname" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="you@company.com" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="message" rows="4" style="height: auto;"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                    <label class="form-check-label" for="exampleCheck1">You agree to our friendly <a
                                            href="{{route('page_view',['page_name'=>'Privacy-Policy','pID'=>2])}}" class="atagst2">privacy policy</a>.</label>
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn_1 btngrad btnfull">Send message</button>
                        @if($success!='')
                            <div class="alert alert-success" role="alert">
                                {{ $success}}
                            </div>
                        @endif
                    </form>
                </div>


            </div>
        </div>
    </div>

@endsection

@extends('layouts.front')
@section('content')
<div class="helpcenterbg">
<div class="container">
   <div class="helpcentertop">
   <div class="helpc1">
       <span>FAQs</span>
       <h2>Help Center</h2>
       <div class="buttnhc">
           <a href="#" class="chatsales">Chat to sales</a>
           <a href="#" class="chatsup">Chat to support</a>
       </div>
   </div>
   <div class="helpc2">
       <p>Have questions? We’re here to help.</p>
   </div>
   </div>
</div>
</div>

<div class="hcmain">
<div class="container hccontainer owl-carousel owl-theme">
    @if($faq_categories)
        @foreach($faq_categories as $faq_category)
  <a class="nav-itemhc {{$loop->first?'activehc':''}} item" href="#1{{$faq_category->id}}hc">
     <div class="hcmeadflex">
     <div class="imgmnhcd">
     <img src="{{$faq_category->featured_image?$faq_category->featured_image->getUrl():asset('assets/front/img/book-open.svg')}}" alt="">
     </div>
      <h2>{{$faq_category->category}}</h2>
     </div>
    </a>
        @endforeach
    @endif
{{--  <a class="nav-itemhc item" href="#2hc">--}}
{{--  <div class="hcmeadflex">--}}
{{--  <div class="imgmnhcd">--}}
{{--  <img src="{{asset('assets/front/img/briefcase.svg')}}" alt="">--}}
{{--  </div>--}}
{{--      <h2>Booking process</h2>--}}
{{--      </div>--}}
{{--  </a>--}}
{{--  <a class="nav-itemhc item" href="#3hc">--}}
{{--  <div class="hcmeadflex">--}}
{{--  <div class="imgmnhcd">--}}
{{--  <img src="{{asset('assets/front/img/bank-note.svg')}}" alt="">--}}
{{--  </div>--}}
{{--      <h2>Payments</h2>--}}
{{--      </div>--}}
{{--  </a>--}}
{{--  <a class="nav-itemhc item" href="#4hc">--}}
{{--  <div class="hcmeadflex">--}}
{{--  <div class="imgmnhcd">--}}
{{--  <img src="{{asset('assets/front/img/coins-hand.svg')}}" alt="">--}}
{{--  </div>--}}
{{--      <h2>Refund Policy</h2>--}}
{{--      </div>--}}
{{--  </a>--}}
</div>
</div>

<div class="container">
    @if($faq_categories)
        @foreach($faq_categories as $faq_category)
<div id="1{{$faq_category->id}}hc" class="hiddenhc {{$loop->first?'activehc':''}}">
  <div class="headactivhc">
  <h3>{{$faq_category->category}}</h3>
    <p>{!! $faq_category->details !!}</p>
  </div>
<div class="helpcenterpage">

            <div class="helpcentermaintxt">

                @if(isset($faq[$faq_category->id])&&count($faq[$faq_category->id])>0)
                @else
                    @php $faq[$faq_category->id]=\App\Models\FaqQuestion::where('category_id',$faq_category->id)->get(); @endphp
                @endif
{{--                @if(isset($faq[$faq_category->id])&&count($faq[$faq_category->id])>0)--}}
                    @foreach($faq[$faq_category->id] as $faq)
                        <details class="faq-card">
                            <summary>{{$faq->question}} <span class="faq-open-icon"><i class="fa fa-plus"></i></span></summary>
                            <span class="faq-card-spoiler">{{$faq->answer}}</span>
                        </details>
                    @endforeach
{{--                @endif--}}
            </div>

    </div>
</div>
        @endforeach
    @endif
    {{--
<div id="2hc" class="hiddenhc">
<div class="headactivhc">
    <h3>Booking process</h3>
    <p>Tour operator Carnival Utopia started its activities in 2013. Carnival Utopia was founded by sworn traveler Tadas  other necessary services; how to take care of all travel arrangements.</p>
    </div>
    <div class="helpcenterpage">
        @if($faq_categories)
        @foreach($faq_categories as $faq_category)
            <div class="helpcentermaintxt">
                @if(isset($faq[$faq_category->id])&&count($faq[$faq_category->id])>0)
                    @foreach($faq[$faq_category->id] as $faq)
                        <details class="faq-card">
                            <summary>{{$faq->question}} <span class="faq-open-icon"><i class="fa fa-plus"></i></span></summary>
                            <span class="faq-card-spoiler">{{$faq->answer}}</span>
                        </details>
                    @endforeach
                @endif
            </div>
        @endforeach
        @endif
    </div>
</div>

<div id="3hc" class="hiddenhc">
<div class="headactivhc">
    <h3>Payments</h3>
    <p>Tour operator Carnival Utopia started its activities in 2013. Carnival Utopia was founded by sworn traveler Tadas  other necessary services; how to take care of all travel arrangements.</p>
    </div>
    <div class="helpcenterpage">
        @if($faq_categories)
        @foreach($faq_categories as $faq_category)
            <div class="helpcentermaintxt">
                @if(isset($faq[$faq_category->id])&&count($faq[$faq_category->id])>0)
                    @foreach($faq[$faq_category->id] as $faq)
                        <details class="faq-card">
                            <summary>{{$faq->question}} <span class="faq-open-icon"><i class="fa fa-plus"></i></span></summary>
                            <span class="faq-card-spoiler">{{$faq->answer}}</span>
                        </details>
                    @endforeach
                @endif
            </div>
        @endforeach
        @endif
    </div>
</div>

<div id="4hc" class="hiddenhc">
<div class="headactivhc">
    <h3>Refund Policy</h3>
    <p>Tour operator Carnival Utopia started its activities in 2013. Carnival Utopia was founded by sworn traveler Tadas  other necessary services; how to take care of all travel arrangements.</p>
    </div>
    <div class="helpcenterpage">
        @if($faq_categories)
        @foreach($faq_categories as $faq_category)
            <div class="helpcentermaintxt">
                @if(isset($faq[$faq_category->id])&&count($faq[$faq_category->id])>0)
                    @foreach($faq[$faq_category->id] as $faq)
                        <details class="faq-card">
                            <summary>{{$faq->question}} <span class="faq-open-icon"><i class="fa fa-plus"></i></span></summary>
                            <span class="faq-card-spoiler">{{$faq->answer}}</span>
                        </details>
                    @endforeach
                @endif
            </div>
        @endforeach
        @endif
    </div>
</div>
--}}


</div>



@endsection
@section('scripts')
    @parent
@endsection



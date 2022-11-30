@extends('layouts.front')
@section('content')
<div class="margin_80_0">
    <div class="helpcenterpage">
        <h2>Help Center</h2>
        @if($faq_categories)
        @foreach($faq_categories as $faq_category)
            <div class="helpcentermaintxt">

                <h3>{{$faq_category->category}}</h3>
                @if(isset($faq[$faq_category->id])&&count($faq[$faq_category->id])>0)
                    @foreach($faq[$faq_category->id] as $faq)
                        <details class="faq-card">
                            <summary>{{$faq->question}} <span class="faq-open-icon"><i class="fa fa-angle-up"></i></span></summary>
                            <span class="faq-card-spoiler">{{$faq->answer}}</span>
                        </details>
                    @endforeach
                @endif
            </div>
        @endforeach
        @endif
    </div>

</div>

@endsection
@section('scripts')
    @parent
@endsection

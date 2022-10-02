@extends('layouts.front')
@section('content')
<div class="margin_80_0">
    <div class="helpcenterpage">
        <h2>Help Center</h2>
        @foreach($faq_categories as $faq_category)
            <div class="helpcentermaintxt">

                <h3>Authentication Issues</h3>
                @foreach($faq[$faq_category->id] as $faq)
                    <details class="faq-card">
                        <summary>{{$faq->question}} <span class="faq-open-icon"><i class="fa fa-angle-up"></i></span></summary>
                        <span class="faq-card-spoiler">{{$faq->answer}}</span>
                    </details>
                @endforeach
    {{--            <details class="faq-card">--}}
    {{--                <summary>How do I change my default payment option? <span class="faq-open-icon"><i class="fa fa-angle-up"></i></span></summary>--}}
    {{--                <span class="faq-card-spoiler">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ornare, sem at dictum faucibus, neque nunc pellentesque sem, nec pellentesque tellus ex vel lorem. Vestibulum magna odio, ornare in faucibus.</span>--}}
    {{--            </details>--}}
    {{--            <details class="faq-card">--}}
    {{--                <summary>Can I still pay with PayPal? <span class="faq-open-icon"><i class="fa fa-angle-up"></i></span></summary>--}}
    {{--                <span class="faq-card-spoiler">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ornare, sem at dictum faucibus, neque nunc pellentesque sem, nec pellentesque tellus ex vel lorem. Vestibulum magna odio, ornare in faucibus.</span>--}}
    {{--            </details>--}}

            </div>
        @endforeach
{{--        <div class="helpcentermaintxt">--}}

{{--            <h3>Billing</h3>--}}

{{--            <details class="faq-card">--}}
{{--                <summary>I was double charged last month. Why is that? <span class="faq-open-icon"><i class="fa fa-angle-up"></i></span></summary>--}}
{{--                <span class="faq-card-spoiler">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt rerum minima a possimus, amet perferendis, temporibus obcaecati pariatur. Reprehenderit magnam necessitatibus vel culpa provident quas nesciunt sunt aut cupiditate fugiat! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt rerum minima a possimus, amet perferendis, temporibus obcaecati pariatur. Reprehenderit magnam necessitatibus vel culpa provident quas nesciunt sunt aut cupiditate fugiat!</span>--}}
{{--            </details>--}}
{{--            <details class="faq-card">--}}
{{--                <summary>How do I change my default payment option? <span class="faq-open-icon"><i class="fa fa-angle-up"></i></span></summary>--}}
{{--                <span class="faq-card-spoiler">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ornare, sem at dictum faucibus, neque nunc pellentesque sem, nec pellentesque tellus ex vel lorem. Vestibulum magna odio, ornare in faucibus.</span>--}}
{{--            </details>--}}
{{--            <details class="faq-card">--}}
{{--                <summary>Can I still pay with PayPal? <span class="faq-open-icon"><i class="fa fa-angle-up"></i></span></summary>--}}
{{--                <span class="faq-card-spoiler">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ornare, sem at dictum faucibus, neque nunc pellentesque sem, nec pellentesque tellus ex vel lorem. Vestibulum magna odio, ornare in faucibus.</span>--}}
{{--            </details>--}}
{{--            <details class="faq-card">--}}
{{--                <summary>Can I use referral code to decrease my monthly fees? <span class="faq-open-icon"><i class="fa fa-angle-up"></i></span></summary>--}}
{{--                <span class="faq-card-spoiler">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ornare, sem at dictum faucibus, neque nunc pellentesque sem, nec pellentesque tellus ex vel lorem. Vestibulum magna odio, ornare in faucibus.</span>--}}
{{--            </details>--}}

{{--        </div>--}}
    </div>

</div>

@endsection
@section('scripts')
    @parent
@endsection

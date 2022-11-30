{{--@extends('errors::illustrated-layout')--}}

{{--@section('title', __('Unauthorized'))--}}
{{--@section('code', '401')--}}
{{--@section('message', __('Unauthorized'))--}}
@extends('layouts.front')

@section('content')
    <div class="flex-center position-ref full-height margin_80_0">
        <div class="content">
            <div class="title">
                401 : {{ __('Unauthorized')}}
            </div>
        </div>
    </div>
@endsection

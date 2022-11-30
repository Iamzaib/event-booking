@extends('layouts.front')

@section('content')
    <div class="flex-center position-ref full-height margin_80_0">
        <div class="content">
            <div class="title">
                @yield('code') :  @yield('message')
            </div>
        </div>
    </div>
@endsection

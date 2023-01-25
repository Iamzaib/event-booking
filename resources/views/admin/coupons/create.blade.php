@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.coupon.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.coupons.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.coupon.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
{{--                <span class="help-block">{{ trans('cruds.coupon.fields.title_helper') }}</span>--}}
            </div>

            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.coupon.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', '') }}" required>
                @if($errors->has('code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code') }}
                    </div>
                @endif
{{--                <span class="help-block">{{ trans('cruds.coupon.fields.title_helper') }}</span>--}}
            </div>

            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.coupon.fields.type') }}</label>
                @foreach(App\Models\Coupon::COUPONS_TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('type') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="type_{{ $key }}" name="type" value="{{ $key }}" {{ old('type_', 'CC') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
{{--                <span class="help-block">{{ trans('cruds.coupon.fields.title_helper') }}</span>--}}
            </div>
            <div class="form-group">
                <label class="required" for="value">{{ trans('cruds.coupon.fields.value') }}</label>
                <input class="form-control {{ $errors->has('amount_paid') ? 'is-invalid' : '' }}" type="number" name="value" id="value" value="{{ old('value', '') }}" step="0.01" required>
                @if($errors->has('value'))
                    <div class="invalid-feedback">
                        {{ $errors->first('value') }}
                    </div>
                @endif
{{--                <span class="help-block">{{ trans('cruds.coupon.fields.title_helper') }}</span>--}}
            </div>

            <div class="form-group">
                <label class="required" for="minimum_amount">{{ trans('cruds.coupon.fields.minimum_amount') }}</label>
                <input class="form-control {{ $errors->has('minimum_amount') ? 'is-invalid' : '' }}" type="number" name="minimum_amount" id="minimum_amount" value="{{ old('minimum_amount', '0') }}" step="0.01" required>
                @if($errors->has('minimum_amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('minimum_amount') }}
                    </div>
                @endif
{{--                <span class="help-block">{{ trans('cruds.coupon.fields.title_helper') }}</span>--}}
            </div>
            <div class="form-group">
                <label class="required" for="expiry">{{ trans('cruds.coupon.fields.expiry') }}</label>
                <input class="form-control date {{ $errors->has('expiry') ? 'is-invalid' : '' }}" type="text" name="expiry" id="expiry" value="{{ old('expiry', '') }}" required>
                @if($errors->has('expiry'))
                    <div class="invalid-feedback">
                        {{ $errors->first('expiry') }}
                    </div>
                @endif
{{--                <span class="help-block">{{ trans('cruds.coupon.fields.title_helper') }}</span>--}}
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

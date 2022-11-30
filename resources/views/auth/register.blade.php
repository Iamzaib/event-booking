@extends('layouts.front')
@section('content')

<div class="row justify-content-center margin_80_0">
    <div class="col-md-6">

        <div class="card mx-4">
            <div class="card-body p-4">

                <form method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <h1>Create an Account</h1>
                    <p class="text-muted">{{ trans('global.register') }}</p>
                    <div class="row">
    <div class="col-6">
        <div class="form-group">
            <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
            @if($errors->has('name'))
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="lastname">{{ trans('cruds.user.fields.lastname') }}</label>
            <input class="form-control {{ $errors->has('lastname') ? 'is-invalid' : '' }}" type="text" name="lastname" id="lastname" value="{{ old('lastname', '') }}">
            @if($errors->has('lastname'))
                <div class="invalid-feedback">
                    {{ $errors->first('lastname') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.user.fields.lastname_helper') }}</span>
        </div>
    </div>
</div>


                    <div class="form-group">
                        <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="phone">{{ trans('cruds.user.fields.phone') }}</label>
                        <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
                        @if($errors->has('phone'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="dob">Date of Birth</label>
                        <input class="form-control date {{ $errors->has('dob') ? 'is-invalid' : '' }}" type="text" name="dob" id="dob" value="{{ old('dob', '') }}" required>
                        @if($errors->has('dob'))
                            <div class="invalid-feedback">
                                {{ $errors->first('dob') }}
                            </div>
                        @endif
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="gender">{{ trans('cruds.user.fields.gender') }}</label>
                        <select name="gender" class="form-control form-select" id="gender">
                            @foreach(App\Models\User::GENDER_RADIO as $key => $label)
                                <option value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
{{--                        @foreach(App\Models\User::GENDER_RADIO as $key => $label)--}}
{{--                            <div class="form-check {{ $errors->has('gender') ? 'is-invalid' : '' }}">--}}
{{--                                <input class="form-check-input" type="radio" id="gender_{{ $key }}" name="gender" value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'checked' : '' }}>--}}
{{--                                <label class="form-check-label" for="gender_{{ $key }}">{{ $label }}</label>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
                        @if($errors->has('gender'))
                            <div class="invalid-feedback">
                                {{ $errors->first('gender') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.gender_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="address">{{ trans('cruds.user.fields.address') }}</label>
                        <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}" required>
                        @if($errors->has('address'))
                            <div class="invalid-feedback">
                                {{ $errors->first('address') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.address_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="address_2">{{ trans('cruds.user.fields.address_2') }}</label>
                        <input class="form-control {{ $errors->has('address_2') ? 'is-invalid' : '' }}" type="text" name="address_2" id="address_2" value="{{ old('address_2', '') }}">
                        @if($errors->has('address_2'))
                            <div class="invalid-feedback">
                                {{ $errors->first('address_2') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.address_2_helper') }}</span>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="required" for="country_id">{{ trans('cruds.user.fields.country') }}</label>
                                <select class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country_id" id="country_id" required>
                                    @foreach($countries as $id => $entry)
                                        <option value="{{ $id }}" {{ old('country_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('country'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('country') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.country_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-3">
                                <div class="form-group">
                                    <label class="required" for="state_id">{{ trans('cruds.user.fields.state') }}</label>
                                    <select class="form-control select2 {{ $errors->has('state') ? 'is-invalid' : '' }}" name="state_id" id="state_id" required>
                                        @foreach($states as $id => $entry)
                                            <option value="{{ $id }}" {{ old('state_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('state'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('state') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.state_helper') }}</span>
                                </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label class="required" for="city_id">{{ trans('cruds.user.fields.city') }}</label>
                                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required>
                                    @foreach($cities as $id => $entry)
                                        <option value="{{ $id }}" {{ old('city_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('city'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('city') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.city_helper') }}</span>
                            </div>
                        </div>
                    </div>

                     <div class="form-group mb-3">
{{--            <div class="input-group-prepend">--}}
{{--                            <span class="input-group-text">--}}
{{--                                <i class="fa fa-lock fa-fw"></i>--}}
{{--                            </span>--}}
{{--            </div>--}}
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">
            @if($errors->has('password'))
                <div class="invalid-feedback">
                    {{ $errors->first('password') }}
                </div>
            @endif
        </div>





                    <button class="btn_1  btngrad" style="width: 100%" type="submit" >
                        {{ trans('global.register') }}
                    </button>
                    <div class="form-group mb-3 mt-3">
                        <p class="arwsqft"> already have an account? <a href="{{route('login')}}">Login</a></p>
                    </div>
                </form>
        </div>
            </div>
        </div>

    </div>


@endsection

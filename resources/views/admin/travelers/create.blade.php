@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.traveler.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.travelers.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="booking_id">{{ trans('cruds.traveler.fields.booking') }}</label>
                <select class="form-control select2 {{ $errors->has('booking') ? 'is-invalid' : '' }}" name="booking_id" id="booking_id" required>
                    @foreach($bookings as $id => $entry)
                        <option value="{{ $id }}" {{ old('booking_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('booking'))
                    <div class="invalid-feedback">
                        {{ $errors->first('booking') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.traveler.fields.booking_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="first_name">{{ trans('cruds.traveler.fields.first_name') }}</label>
                <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', '') }}" required>
                @if($errors->has('first_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('first_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.traveler.fields.first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="last_name">{{ trans('cruds.traveler.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', '') }}" required>
                @if($errors->has('last_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.traveler.fields.last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.traveler.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', '') }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.traveler.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone">{{ trans('cruds.traveler.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.traveler.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.traveler.fields.gender') }}</label>
                @foreach(App\Models\Traveler::GENDER_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="gender_{{ $key }}" name="gender" value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="gender_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.traveler.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.traveler.fields.notes') }}</label>
                <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes">{{ old('notes') }}</textarea>
                @if($errors->has('notes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.traveler.fields.notes_helper') }}</span>
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
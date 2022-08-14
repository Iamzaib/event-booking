@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.eventBooking.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.event-bookings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="booking_details">{{ trans('cruds.eventBooking.fields.booking_details') }}</label>
                <input class="form-control {{ $errors->has('booking_details') ? 'is-invalid' : '' }}" type="text" name="booking_details" id="booking_details" value="{{ old('booking_details', '') }}">
                @if($errors->has('booking_details'))
                    <div class="invalid-feedback">
                        {{ $errors->first('booking_details') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.eventBooking.fields.booking_details_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="booking_event_id">{{ trans('cruds.eventBooking.fields.booking_event') }}</label>
                <select class="form-control select2 {{ $errors->has('booking_event') ? 'is-invalid' : '' }}" name="booking_event_id" id="booking_event_id" required>
                    @foreach($booking_events as $id => $entry)
                        <option value="{{ $id }}" {{ old('booking_event_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('booking_event'))
                    <div class="invalid-feedback">
                        {{ $errors->first('booking_event') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.eventBooking.fields.booking_event_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="booking_by_user_id">{{ trans('cruds.eventBooking.fields.booking_by_user') }}</label>
                <select class="form-control select2 {{ $errors->has('booking_by_user') ? 'is-invalid' : '' }}" name="booking_by_user_id" id="booking_by_user_id" required>
                    @foreach($booking_by_users as $id => $entry)
                        <option value="{{ $id }}" {{ old('booking_by_user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('booking_by_user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('booking_by_user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.eventBooking.fields.booking_by_user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="booking_total">{{ trans('cruds.eventBooking.fields.booking_total') }}</label>
                <input class="form-control {{ $errors->has('booking_total') ? 'is-invalid' : '' }}" type="number" name="booking_total" id="booking_total" value="{{ old('booking_total', '') }}" step="0.01">
                @if($errors->has('booking_total'))
                    <div class="invalid-feedback">
                        {{ $errors->first('booking_total') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.eventBooking.fields.booking_total_helper') }}</span>
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
@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.eventBooking.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.event-bookings.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="booking_event_id">{{ trans('cruds.eventBooking.fields.booking_event') }}</label>
                            <select class="form-control select2" name="booking_event_id" id="booking_event_id" required>
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
                            <select class="form-control select2" name="booking_by_user_id" id="booking_by_user_id" required>
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
                            <input class="form-control" type="number" name="booking_total" id="booking_total" value="{{ old('booking_total', '') }}" step="0.01">
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

        </div>
    </div>
</div>
@endsection
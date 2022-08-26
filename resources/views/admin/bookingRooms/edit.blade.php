@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.bookingRoom.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.booking-rooms.update", [$bookingRoom->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="room_id">{{ trans('cruds.bookingRoom.fields.room') }}</label>
                <select class="form-control select2 {{ $errors->has('room') ? 'is-invalid' : '' }}" name="room_id" id="room_id" required>
                    @foreach($rooms as $id => $entry)
                        <option value="{{ $id }}" {{ (old('room_id') ? old('room_id') : $bookingRoom->room->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('room'))
                    <div class="invalid-feedback">
                        {{ $errors->first('room') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bookingRoom.fields.room_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="booking_for_id">{{ trans('cruds.bookingRoom.fields.booking_for') }}</label>
                <select class="form-control select2 {{ $errors->has('booking_for') ? 'is-invalid' : '' }}" name="booking_for_id" id="booking_for_id" required>
                    @foreach($booking_fors as $id => $entry)
                        <option value="{{ $id }}" {{ (old('booking_for_id') ? old('booking_for_id') : $bookingRoom->booking_for->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('booking_for'))
                    <div class="invalid-feedback">
                        {{ $errors->first('booking_for') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bookingRoom.fields.booking_for_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="room_booking_rate">{{ trans('cruds.bookingRoom.fields.room_booking_rate') }}</label>
                <input class="form-control {{ $errors->has('room_booking_rate') ? 'is-invalid' : '' }}" type="number" name="room_booking_rate" id="room_booking_rate" value="{{ old('room_booking_rate', $bookingRoom->room_booking_rate) }}" step="0.01" required>
                @if($errors->has('room_booking_rate'))
                    <div class="invalid-feedback">
                        {{ $errors->first('room_booking_rate') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bookingRoom.fields.room_booking_rate_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="booking_from">{{ trans('cruds.bookingRoom.fields.booking_from') }}</label>
                <input class="form-control date {{ $errors->has('booking_from') ? 'is-invalid' : '' }}" type="text" name="booking_from" id="booking_from" value="{{ old('booking_from', $bookingRoom->booking_from) }}" required>
                @if($errors->has('booking_from'))
                    <div class="invalid-feedback">
                        {{ $errors->first('booking_from') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bookingRoom.fields.booking_from_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="booking_to">{{ trans('cruds.bookingRoom.fields.booking_to') }}</label>
                <input class="form-control date {{ $errors->has('booking_to') ? 'is-invalid' : '' }}" type="text" name="booking_to" id="booking_to" value="{{ old('booking_to', $bookingRoom->booking_to) }}" required>
                @if($errors->has('booking_to'))
                    <div class="invalid-feedback">
                        {{ $errors->first('booking_to') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bookingRoom.fields.booking_to_helper') }}</span>
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
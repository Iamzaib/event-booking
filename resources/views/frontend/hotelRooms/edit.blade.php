@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.hotelRoom.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.hotel-rooms.update", [$hotelRoom->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="hotel_id">{{ trans('cruds.hotelRoom.fields.hotel') }}</label>
                            <select class="form-control select2" name="hotel_id" id="hotel_id" required>
                                @foreach($hotels as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('hotel_id') ? old('hotel_id') : $hotelRoom->hotel->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('hotel'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('hotel') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hotelRoom.fields.hotel_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="room_title">{{ trans('cruds.hotelRoom.fields.room_title') }}</label>
                            <input class="form-control" type="text" name="room_title" id="room_title" value="{{ old('room_title', $hotelRoom->room_title) }}" required>
                            @if($errors->has('room_title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('room_title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hotelRoom.fields.room_title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="details">{{ trans('cruds.hotelRoom.fields.details') }}</label>
                            <textarea class="form-control" name="details" id="details">{{ old('details', $hotelRoom->details) }}</textarea>
                            @if($errors->has('details'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('details') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hotelRoom.fields.details_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="room_price">{{ trans('cruds.hotelRoom.fields.room_price') }}</label>
                            <input class="form-control" type="number" name="room_price" id="room_price" value="{{ old('room_price', $hotelRoom->room_price) }}" step="0.01" required>
                            @if($errors->has('room_price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('room_price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hotelRoom.fields.room_price_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="room_capacity">{{ trans('cruds.hotelRoom.fields.room_capacity') }}</label>
                            <input class="form-control" type="text" name="room_capacity" id="room_capacity" value="{{ old('room_capacity', $hotelRoom->room_capacity) }}" required>
                            @if($errors->has('room_capacity'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('room_capacity') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hotelRoom.fields.room_capacity_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="room_quantity">{{ trans('cruds.hotelRoom.fields.room_quantity') }}</label>
                            <input class="form-control" type="number" name="room_quantity" id="room_quantity" value="{{ old('room_quantity', $hotelRoom->room_quantity) }}" step="1" required>
                            @if($errors->has('room_quantity'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('room_quantity') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hotelRoom.fields.room_quantity_helper') }}</span>
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
@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.hotel.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.hotels.update", [$hotel->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="hotel_name">{{ trans('cruds.hotel.fields.hotel_name') }}</label>
                <input class="form-control {{ $errors->has('hotel_name') ? 'is-invalid' : '' }}" type="text" name="hotel_name" id="hotel_name" value="{{ old('hotel_name', $hotel->hotel_name) }}" required>
                @if($errors->has('hotel_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hotel_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hotel.fields.hotel_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="details">{{ trans('cruds.hotel.fields.details') }}</label>
                <textarea class="form-control {{ $errors->has('details') ? 'is-invalid' : '' }}" name="details" id="details">{{ old('details', $hotel->details) }}</textarea>
                @if($errors->has('details'))
                    <div class="invalid-feedback">
                        {{ $errors->first('details') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hotel.fields.details_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amenities">{{ trans('cruds.hotel.fields.amenities') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('amenities') ? 'is-invalid' : '' }}" name="amenities[]" id="amenities" multiple>
                    @foreach($amenities as $id => $amenity)
                        <option value="{{ $id }}" {{ (in_array($id, old('amenities', [])) || $hotel->amenities->contains($id)) ? 'selected' : '' }}>{{ $amenity }}</option>
                    @endforeach
                </select>
                @if($errors->has('amenities'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amenities') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hotel.fields.amenities_helper') }}</span>
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
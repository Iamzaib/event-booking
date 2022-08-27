@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.testimonial.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.testimonials.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="review_text">{{ trans('cruds.testimonial.fields.review_text') }}</label>
                <input class="form-control {{ $errors->has('review_text') ? 'is-invalid' : '' }}" type="text" name="review_text" id="review_text" value="{{ old('review_text', '') }}">
                @if($errors->has('review_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('review_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.testimonial.fields.review_text_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ratings">{{ trans('cruds.testimonial.fields.ratings') }}</label>
                <input class="form-control {{ $errors->has('ratings') ? 'is-invalid' : '' }}" type="text" name="ratings" id="ratings" value="{{ old('ratings', '') }}" required>
                @if($errors->has('ratings'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ratings') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.testimonial.fields.ratings_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.testimonial.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.testimonial.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="event_trip_booking_id">{{ trans('cruds.testimonial.fields.event_trip_booking') }}</label>
                <select class="form-control select2 {{ $errors->has('event_trip_booking') ? 'is-invalid' : '' }}" name="event_trip_booking_id" id="event_trip_booking_id" required>
                    @foreach($event_trip_bookings as $id => $entry)
                        <option value="{{ $id }}" {{ old('event_trip_booking_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('event_trip_booking'))
                    <div class="invalid-feedback">
                        {{ $errors->first('event_trip_booking') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.testimonial.fields.event_trip_booking_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="review_date">{{ trans('cruds.testimonial.fields.review_date') }}</label>
                <input class="form-control date {{ $errors->has('review_date') ? 'is-invalid' : '' }}" type="text" name="review_date" id="review_date" value="{{ old('review_date') }}" required>
                @if($errors->has('review_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('review_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.testimonial.fields.review_date_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('featured') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="featured" value="0">
                    <input class="form-check-input" type="checkbox" name="featured" id="featured" value="1" {{ old('featured', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="featured">{{ trans('cruds.testimonial.fields.featured') }}</label>
                </div>
                @if($errors->has('featured'))
                    <div class="invalid-feedback">
                        {{ $errors->first('featured') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.testimonial.fields.featured_helper') }}</span>
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
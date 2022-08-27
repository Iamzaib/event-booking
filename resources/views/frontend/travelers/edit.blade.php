@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.traveler.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.travelers.update", [$traveler->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="booking_id">{{ trans('cruds.traveler.fields.booking') }}</label>
                            <select class="form-control select2" name="booking_id" id="booking_id" required>
                                @foreach($bookings as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('booking_id') ? old('booking_id') : $traveler->booking->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                            <input class="form-control" type="text" name="first_name" id="first_name" value="{{ old('first_name', $traveler->first_name) }}" required>
                            @if($errors->has('first_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('first_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.traveler.fields.first_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="last_name">{{ trans('cruds.traveler.fields.last_name') }}</label>
                            <input class="form-control" type="text" name="last_name" id="last_name" value="{{ old('last_name', $traveler->last_name) }}" required>
                            @if($errors->has('last_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('last_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.traveler.fields.last_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="email">{{ trans('cruds.traveler.fields.email') }}</label>
                            <input class="form-control" type="text" name="email" id="email" value="{{ old('email', $traveler->email) }}" required>
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.traveler.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="phone">{{ trans('cruds.traveler.fields.phone') }}</label>
                            <input class="form-control" type="text" name="phone" id="phone" value="{{ old('phone', $traveler->phone) }}" required>
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
                                <div>
                                    <input type="radio" id="gender_{{ $key }}" name="gender" value="{{ $key }}" {{ old('gender', $traveler->gender) === (string) $key ? 'checked' : '' }} required>
                                    <label for="gender_{{ $key }}">{{ $label }}</label>
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
                            <textarea class="form-control" name="notes" id="notes">{{ old('notes', $traveler->notes) }}</textarea>
                            @if($errors->has('notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.traveler.fields.notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="costume_id">{{ trans('cruds.traveler.fields.costume') }}</label>
                            <select class="form-control select2" name="costume_id" id="costume_id">
                                @foreach($costumes as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('costume_id') ? old('costume_id') : $traveler->costume->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('costume'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('costume') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.traveler.fields.costume_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tickets">{{ trans('cruds.traveler.fields.tickets') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="tickets[]" id="tickets" multiple>
                                @foreach($tickets as $id => $ticket)
                                    <option value="{{ $id }}" {{ (in_array($id, old('tickets', [])) || $traveler->tickets->contains($id)) ? 'selected' : '' }}>{{ $ticket }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('tickets'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tickets') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.traveler.fields.tickets_helper') }}</span>
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
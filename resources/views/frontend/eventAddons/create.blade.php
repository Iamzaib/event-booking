@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.eventAddon.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.event-addons.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="addon_title">{{ trans('cruds.eventAddon.fields.addon_title') }}</label>
                            <input class="form-control" type="text" name="addon_title" id="addon_title" value="{{ old('addon_title', '') }}" required>
                            @if($errors->has('addon_title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('addon_title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventAddon.fields.addon_title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="addon_details">{{ trans('cruds.eventAddon.fields.addon_details') }}</label>
                            <input class="form-control" type="text" name="addon_details" id="addon_details" value="{{ old('addon_details', '') }}">
                            @if($errors->has('addon_details'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('addon_details') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventAddon.fields.addon_details_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="addon_price">{{ trans('cruds.eventAddon.fields.addon_price') }}</label>
                            <input class="form-control" type="number" name="addon_price" id="addon_price" value="{{ old('addon_price', '') }}" step="0.01" required>
                            @if($errors->has('addon_price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('addon_price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventAddon.fields.addon_price_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.eventAddon.fields.status') }}</label>
                            @foreach(App\Models\EventAddon::STATUS_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', '1') === (string) $key ? 'checked' : '' }}>
                                    <label for="status_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventAddon.fields.status_helper') }}</span>
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
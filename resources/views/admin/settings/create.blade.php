@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.setting.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.settings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.setting.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="setting_key">{{ trans('cruds.setting.fields.setting_key') }}</label>
                <input class="form-control {{ $errors->has('setting_key') ? 'is-invalid' : '' }}" type="text" name="setting_key" id="setting_key" value="{{ old('setting_key', '') }}" required>
                @if($errors->has('setting_key'))
                    <div class="invalid-feedback">
                        {{ $errors->first('setting_key') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.setting_key_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="setting_value">{{ trans('cruds.setting.fields.setting_value') }}</label>
                <input class="form-control {{ $errors->has('setting_value') ? 'is-invalid' : '' }}" type="text" name="setting_value" id="setting_value" value="{{ old('setting_value', '') }}" required>
                @if($errors->has('setting_value'))
                    <div class="invalid-feedback">
                        {{ $errors->first('setting_value') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.setting_value_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="details">{{ trans('cruds.setting.fields.details') }}</label>
                <input class="form-control {{ $errors->has('details') ? 'is-invalid' : '' }}" type="text" name="details" id="details" value="{{ old('details', '') }}">
                @if($errors->has('details'))
                    <div class="invalid-feedback">
                        {{ $errors->first('details') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.details_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.setting.fields.setting_type') }}</label>
                <select class="form-control {{ $errors->has('setting_type') ? 'is-invalid' : '' }}" name="setting_type" id="setting_type">
                    <option value disabled {{ old('setting_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Setting::SETTING_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('setting_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('setting_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('setting_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.setting_type_helper') }}</span>
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
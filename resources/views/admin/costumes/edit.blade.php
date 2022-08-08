@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.costume.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.costumes.update", [$costume->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="costume_title">{{ trans('cruds.costume.fields.costume_title') }}</label>
                <input class="form-control {{ $errors->has('costume_title') ? 'is-invalid' : '' }}" type="text" name="costume_title" id="costume_title" value="{{ old('costume_title', $costume->costume_title) }}" required>
                @if($errors->has('costume_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('costume_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.costume.fields.costume_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="costume_details">{{ trans('cruds.costume.fields.costume_details') }}</label>
                <input class="form-control {{ $errors->has('costume_details') ? 'is-invalid' : '' }}" type="text" name="costume_details" id="costume_details" value="{{ old('costume_details', $costume->costume_details) }}">
                @if($errors->has('costume_details'))
                    <div class="invalid-feedback">
                        {{ $errors->first('costume_details') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.costume.fields.costume_details_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="costume_price">{{ trans('cruds.costume.fields.costume_price') }}</label>
                <input class="form-control {{ $errors->has('costume_price') ? 'is-invalid' : '' }}" type="number" name="costume_price" id="costume_price" value="{{ old('costume_price', $costume->costume_price) }}" step="0.01" required>
                @if($errors->has('costume_price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('costume_price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.costume.fields.costume_price_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.costume.fields.status') }}</label>
                @foreach(App\Models\Costume::STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', $costume->status) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="status_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.costume.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="options">{{ trans('cruds.costume.fields.options') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('options') ? 'is-invalid' : '' }}" name="options[]" id="options" multiple>
                    @foreach($options as $id => $option)
                        <option value="{{ $id }}" {{ (in_array($id, old('options', [])) || $costume->options->contains($id)) ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
                @if($errors->has('options'))
                    <div class="invalid-feedback">
                        {{ $errors->first('options') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.costume.fields.options_helper') }}</span>
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
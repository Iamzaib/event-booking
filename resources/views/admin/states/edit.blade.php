@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.state.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.states.update", [$state->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="state_name">{{ trans('cruds.state.fields.state_name') }}</label>
                <input class="form-control {{ $errors->has('state_name') ? 'is-invalid' : '' }}" type="text" name="state_name" id="state_name" value="{{ old('state_name', $state->state_name) }}" required>
                @if($errors->has('state_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('state_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.state.fields.state_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="country_id">{{ trans('cruds.state.fields.country') }}</label>
                <select class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country_id" id="country_id" required>
                    @foreach($countries as $id => $entry)
                        <option value="{{ $id }}" {{ (old('country_id') ? old('country_id') : $state->country->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('country'))
                    <div class="invalid-feedback">
                        {{ $errors->first('country') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.state.fields.country_helper') }}</span>
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
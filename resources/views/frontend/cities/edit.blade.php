@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.city.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.cities.update", [$city->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="cite_name">{{ trans('cruds.city.fields.cite_name') }}</label>
                            <input class="form-control" type="text" name="cite_name" id="cite_name" value="{{ old('cite_name', $city->cite_name) }}" required>
                            @if($errors->has('cite_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cite_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.city.fields.cite_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="state_id">{{ trans('cruds.city.fields.state') }}</label>
                            <select class="form-control select2" name="state_id" id="state_id" required>
                                @foreach($states as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('state_id') ? old('state_id') : $city->state->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('state'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('state') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.city.fields.state_helper') }}</span>
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
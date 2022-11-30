@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.costumeAttribute.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.costume-attributes.update", [$costumeAttribute->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.costumeAttribute.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $costumeAttribute->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.costumeAttribute.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="values">{{ trans('cruds.costumeAttribute.fields.values') }}</label>
                <input class="form-control {{ $errors->has('values') ? 'is-invalid' : '' }}" type="text" name="values" id="values" value="{{ old('values', $costumeAttribute->values) }}">
                @if($errors->has('values'))
                    <div class="invalid-feedback">
                        {{ $errors->first('values') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.costumeAttribute.fields.values_helper') }}</span>
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

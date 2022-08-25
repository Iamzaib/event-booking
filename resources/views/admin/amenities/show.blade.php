@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.amenity.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.amenities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.amenity.fields.id') }}
                        </th>
                        <td>
                            {{ $amenity->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.amenity.fields.title') }}
                        </th>
                        <td>
                            {{ $amenity->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.amenity.fields.icon') }}
                        </th>
                        <td>
                            @if($amenity->icon)
                                <a href="{{ $amenity->icon->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $amenity->icon->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.amenities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
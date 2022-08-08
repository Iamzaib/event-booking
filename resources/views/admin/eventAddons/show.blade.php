@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.eventAddon.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.event-addons.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.eventAddon.fields.id') }}
                        </th>
                        <td>
                            {{ $eventAddon->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventAddon.fields.addon_title') }}
                        </th>
                        <td>
                            {{ $eventAddon->addon_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventAddon.fields.addon_details') }}
                        </th>
                        <td>
                            {{ $eventAddon->addon_details }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventAddon.fields.addon_price') }}
                        </th>
                        <td>
                            {{ $eventAddon->addon_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventAddon.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\EventAddon::STATUS_RADIO[$eventAddon->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.event-addons.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
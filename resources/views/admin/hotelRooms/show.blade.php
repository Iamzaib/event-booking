@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.hotelRoom.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hotel-rooms.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.hotelRoom.fields.id') }}
                        </th>
                        <td>
                            {{ $hotelRoom->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hotelRoom.fields.hotel') }}
                        </th>
                        <td>
                            {{ $hotelRoom->hotel->hotel_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hotelRoom.fields.room_title') }}
                        </th>
                        <td>
                            {{ $hotelRoom->room_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hotelRoom.fields.details') }}
                        </th>
                        <td>
                            {{ $hotelRoom->details }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hotelRoom.fields.room_price') }}
                        </th>
                        <td>
                            {{ $hotelRoom->room_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hotelRoom.fields.room_capacity') }}
                        </th>
                        <td>
                            {{ $hotelRoom->room_capacity }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hotel-rooms.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
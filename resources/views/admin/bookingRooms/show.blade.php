@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bookingRoom.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.booking-rooms.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bookingRoom.fields.id') }}
                        </th>
                        <td>
                            {{ $bookingRoom->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bookingRoom.fields.room') }}
                        </th>
                        <td>
                            {{ $bookingRoom->room->room_title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bookingRoom.fields.booking_for') }}
                        </th>
                        <td>
                            {{ $bookingRoom->booking_for->booking_details ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bookingRoom.fields.room_booking_rate') }}
                        </th>
                        <td>
                            {{ $bookingRoom->room_booking_rate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bookingRoom.fields.booking_from') }}
                        </th>
                        <td>
                            {{ $bookingRoom->booking_from }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bookingRoom.fields.booking_to') }}
                        </th>
                        <td>
                            {{ $bookingRoom->booking_to }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.booking-rooms.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
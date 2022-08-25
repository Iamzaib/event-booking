@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.event.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.events.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.id') }}
                        </th>
                        <td>
                            {{ $event->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.event_title') }}
                        </th>
                        <td>
                            {{ $event->event_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.overview') }}
                        </th>
                        <td>
                            {!! $event->overview !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.duration') }}
                        </th>
                        <td>
                            {{ $event->duration }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.daily_price') }}
                        </th>
                        <td>
                            {{ $event->daily_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.featured_image') }}
                        </th>
                        <td>
                            @if($event->featured_image)
                                <a href="{{ $event->featured_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $event->featured_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.information') }}
                        </th>
                        <td>
                            {!! $event->information !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.country') }}
                        </th>
                        <td>
                            {{ $event->country->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.state') }}
                        </th>
                        <td>
                            {{ $event->state->state_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.city') }}
                        </th>
                        <td>
                            {{ $event->city->city_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.event_start') }}
                        </th>
                        <td>
                            {{ $event->event_start }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.event_end') }}
                        </th>
                        <td>
                            {{ $event->event_end }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.hotels') }}
                        </th>
                        <td>
                            @foreach($event->hotels as $key => $hotels)
                                <span class="label label-info">{{ $hotels->hotel_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.events.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#booking_event_event_bookings" role="tab" data-toggle="tab">
                {{ trans('cruds.eventBooking.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="booking_event_event_bookings">
            @includeIf('admin.events.relationships.bookingEventEventBookings', ['eventBookings' => $event->bookingEventEventBookings])
        </div>
    </div>
</div>

@endsection

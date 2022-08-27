@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.event.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.events.index') }}">
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
                                        {{ trans('cruds.event.fields.age') }}
                                    </th>
                                    <td>
                                        {{ $event->age }}
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
                                <tr>
                                    <th>
                                        {{ trans('cruds.event.fields.addons') }}
                                    </th>
                                    <td>
                                        @foreach($event->addons as $key => $addons)
                                            <span class="label label-info">{{ $addons->addon_title }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.event.fields.amenities_included') }}
                                    </th>
                                    <td>
                                        @foreach($event->amenities_includeds as $key => $amenities_included)
                                            <span class="label label-info">{{ $amenities_included->title }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.events.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
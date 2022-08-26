@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.testimonial.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.testimonials.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.testimonial.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $testimonial->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.testimonial.fields.review_text') }}
                                    </th>
                                    <td>
                                        {{ $testimonial->review_text }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.testimonial.fields.ratings') }}
                                    </th>
                                    <td>
                                        {{ $testimonial->ratings }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.testimonial.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $testimonial->user->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.testimonial.fields.event_trip_booking') }}
                                    </th>
                                    <td>
                                        {{ $testimonial->event_trip_booking->booking_details ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.testimonial.fields.review_date') }}
                                    </th>
                                    <td>
                                        {{ $testimonial->review_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.testimonial.fields.featured') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $testimonial->featured ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.testimonials.index') }}">
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
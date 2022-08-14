@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.traveler.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.travelers.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.traveler.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $traveler->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.traveler.fields.booking') }}
                                    </th>
                                    <td>
                                        {{ $traveler->booking->booking_details ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.traveler.fields.first_name') }}
                                    </th>
                                    <td>
                                        {{ $traveler->first_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.traveler.fields.last_name') }}
                                    </th>
                                    <td>
                                        {{ $traveler->last_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.traveler.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $traveler->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.traveler.fields.phone') }}
                                    </th>
                                    <td>
                                        {{ $traveler->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.traveler.fields.gender') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Traveler::GENDER_RADIO[$traveler->gender] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.traveler.fields.notes') }}
                                    </th>
                                    <td>
                                        {{ $traveler->notes }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.travelers.index') }}">
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
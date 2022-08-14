@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.payment.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.payments.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payment.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $payment->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payment.fields.payment_event') }}
                                    </th>
                                    <td>
                                        {{ $payment->payment_event->event_title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payment.fields.payment_user') }}
                                    </th>
                                    <td>
                                        {{ $payment->payment_user->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payment.fields.payment_booking') }}
                                    </th>
                                    <td>
                                        {{ $payment->payment_booking->booking_total ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payment.fields.amount_total') }}
                                    </th>
                                    <td>
                                        {{ $payment->amount_total }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payment.fields.amount_paid') }}
                                    </th>
                                    <td>
                                        {{ $payment->amount_paid }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payment.fields.amount_balance') }}
                                    </th>
                                    <td>
                                        {{ $payment->amount_balance }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payment.fields.payment_method') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Payment::PAYMENT_METHOD_RADIO[$payment->payment_method] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payment.fields.payment_details') }}
                                    </th>
                                    <td>
                                        {{ $payment->payment_details }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.payments.index') }}">
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
@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.payment.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.payments.update", [$payment->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="payment_event_id">{{ trans('cruds.payment.fields.payment_event') }}</label>
                            <select class="form-control select2" name="payment_event_id" id="payment_event_id" required>
                                @foreach($payment_events as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('payment_event_id') ? old('payment_event_id') : $payment->payment_event->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('payment_event'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('payment_event') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.payment_event_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="payment_user_id">{{ trans('cruds.payment.fields.payment_user') }}</label>
                            <select class="form-control select2" name="payment_user_id" id="payment_user_id" required>
                                @foreach($payment_users as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('payment_user_id') ? old('payment_user_id') : $payment->payment_user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('payment_user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('payment_user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.payment_user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="payment_booking_id">{{ trans('cruds.payment.fields.payment_booking') }}</label>
                            <select class="form-control select2" name="payment_booking_id" id="payment_booking_id" required>
                                @foreach($payment_bookings as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('payment_booking_id') ? old('payment_booking_id') : $payment->payment_booking->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('payment_booking'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('payment_booking') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.payment_booking_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="amount_total">{{ trans('cruds.payment.fields.amount_total') }}</label>
                            <input class="form-control" type="number" name="amount_total" id="amount_total" value="{{ old('amount_total', $payment->amount_total) }}" step="0.01" required>
                            @if($errors->has('amount_total'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount_total') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.amount_total_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="amount_paid">{{ trans('cruds.payment.fields.amount_paid') }}</label>
                            <input class="form-control" type="number" name="amount_paid" id="amount_paid" value="{{ old('amount_paid', $payment->amount_paid) }}" step="0.01" required>
                            @if($errors->has('amount_paid'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount_paid') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.amount_paid_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="amount_balance">{{ trans('cruds.payment.fields.amount_balance') }}</label>
                            <input class="form-control" type="number" name="amount_balance" id="amount_balance" value="{{ old('amount_balance', $payment->amount_balance) }}" step="0.01">
                            @if($errors->has('amount_balance'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount_balance') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.amount_balance_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.payment.fields.payment_method') }}</label>
                            @foreach(App\Models\Payment::PAYMENT_METHOD_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="payment_method_{{ $key }}" name="payment_method" value="{{ $key }}" {{ old('payment_method', $payment->payment_method) === (string) $key ? 'checked' : '' }} required>
                                    <label for="payment_method_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('payment_method'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('payment_method') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.payment_method_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
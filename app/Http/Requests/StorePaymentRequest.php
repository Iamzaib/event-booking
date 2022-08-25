<?php

namespace App\Http\Requests;

use App\Models\Payment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePaymentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('payment_create');
    }

    public function rules()
    {
        return [
            'payment_event_id' => [
                'required',
                'integer',
            ],
            'payment_user_id' => [
                'required',
                'integer',
            ],
            'payment_booking_id' => [
                'required',
                'integer',
            ],
            'amount_total' => [
                'required',
            ],
            'amount_paid' => [
                'required',
            ],
            'payment_method' => [
                'required',
            ],
        ];
    }
}

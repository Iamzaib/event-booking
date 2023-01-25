<?php

namespace App\Http\Requests;

use App\Models\Coupon;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCouponRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'code' => [
                'string',
                'required',
            ],
            'type' => [
                'string',
                'required',
            ],
            'value' => [
                'required',
            ],
            'minimum_amount' => [
                'nullable',
            ],
            'expiry' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}

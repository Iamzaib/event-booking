<?php

namespace App\Http\Requests;

use App\Models\Testimonial;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTestimonialRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('testimonial_create');
    }

    public function rules()
    {
        return [
            'review_text' => [
                'string',
                'nullable',
            ],
            'ratings' => [
                'string',
                'required',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'event_trip_booking_id' => [
                'required',
                'integer',
            ],
            'review_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}

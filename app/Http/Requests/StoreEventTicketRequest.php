<?php

namespace App\Http\Requests;

use App\Models\EventTicket;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEventTicketRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_ticket_create');
    }

    public function rules()
    {
        return [
            'event_id' => [
                'required',
                'integer',
            ],
            'ticket_title' => [
                'string',
                'required',
            ],
            'ticket_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'ticket_price' => [
                'required',
            ],
        ];
    }
}

@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.eventBooking.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.event-bookings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.eventBooking.fields.id') }}
                        </th>
                        <td>
                            {{ $eventBooking->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventBooking.fields.booking_details') }}
                        </th>
                        <td>
                            {{ $eventBooking->booking_details }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventBooking.fields.booking_event') }}
                        </th>
                        <td>
                            {{ $eventBooking->booking_event->event_title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventBooking.fields.booking_by_user') }}
                        </th>
                        <td>
                            {{ $eventBooking->booking_by_user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventBooking.fields.booking_total') }}
                        </th>
                        <td>
                            {{ $eventBooking->booking_total }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventBooking.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\EventBooking::STATUS_SELECT[$eventBooking->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Travelers
                        </th>
                        <td>
                            <table cellpadding="2">
                                <tr>
                                    <th  class="p-3">
                                        Traveler Details
                                    </th>
                                    <th class="p-3">
                                        Traveler Tickets
                                    </th>
                                    <th class="p-3">
                                        Traveler Costumes
                                    </th>
                                </tr>
                                @foreach($eventBooking->travelers as $traveler)
                                <tr>
                                    <td class="p-3">
                                        {!!  'Name: '.$traveler->first_name.' '.$traveler->last_name.'<br>'.
                                            'Email: '.$traveler->email.'<br>'.
                                                    'Phone: '. $traveler->phone.'<br>'.
                                                    'Gender: '.$traveler->gender.'<br>'.
                                                    'Shirt size: '. $traveler->shirt_size.'<br>'.
                                                    'Notes: '.$traveler->notes
                                                !!}

                                    </td>
                                    <td class="p-3">
                                        @if(count($traveler->tickets)>0)
                                            @foreach($traveler->tickets as $tickets)
                                                {{$tickets->ticket_title}} {{$tickets->ticket_date}} {{display_currency($tickets->ticket_price)}} <br>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="p-3">
                                        @if(isset($traveler->costume->id))
                                            Costume: {{$traveler->costume->costume_title}} <br>
                                        @if(count($traveler->costume_attr)>0)
                                            @foreach($traveler->costume_attr as $costume_attr)
                                            {{$costume_attr->costumeAttribute->title}}:{{$costume_attr->values}}<br>
                                            @endforeach
                                        @endif

                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.event-bookings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection

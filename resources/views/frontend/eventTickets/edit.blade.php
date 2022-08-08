@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.eventTicket.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.event-tickets.update", [$eventTicket->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="event_id">{{ trans('cruds.eventTicket.fields.event') }}</label>
                            <select class="form-control select2" name="event_id" id="event_id" required>
                                @foreach($events as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('event_id') ? old('event_id') : $eventTicket->event->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('event'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('event') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventTicket.fields.event_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="ticket_title">{{ trans('cruds.eventTicket.fields.ticket_title') }}</label>
                            <input class="form-control" type="text" name="ticket_title" id="ticket_title" value="{{ old('ticket_title', $eventTicket->ticket_title) }}" required>
                            @if($errors->has('ticket_title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ticket_title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventTicket.fields.ticket_title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="ticket_date">{{ trans('cruds.eventTicket.fields.ticket_date') }}</label>
                            <input class="form-control date" type="text" name="ticket_date" id="ticket_date" value="{{ old('ticket_date', $eventTicket->ticket_date) }}" required>
                            @if($errors->has('ticket_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ticket_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventTicket.fields.ticket_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="ticket_price">{{ trans('cruds.eventTicket.fields.ticket_price') }}</label>
                            <input class="form-control" type="number" name="ticket_price" id="ticket_price" value="{{ old('ticket_price', $eventTicket->ticket_price) }}" step="0.01" required>
                            @if($errors->has('ticket_price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ticket_price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventTicket.fields.ticket_price_helper') }}</span>
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
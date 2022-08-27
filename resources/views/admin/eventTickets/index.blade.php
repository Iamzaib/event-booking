@extends('layouts.admin')
@section('content')
@can('event_ticket_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.event-tickets.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.eventTicket.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.eventTicket.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive overflow-visible print">
            <table class="table table-sm table-hover table-nowrap card-table" id="data-table">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.eventTicket.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.eventTicket.fields.event') }}
                        </th>
                        <th>
                            {{ trans('cruds.eventTicket.fields.ticket_title') }}
                        </th>
                        <th>
                            {{ trans('cruds.eventTicket.fields.ticket_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.eventTicket.fields.ticket_price') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($eventTickets as $key => $eventTicket)
                        <tr data-entry-id="{{ $eventTicket->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $eventTicket->id ?? '' }}
                            </td>
                            <td>
                                {{ $eventTicket->event->event_title ?? '' }}
                            </td>
                            <td>
                                {{ $eventTicket->ticket_title ?? '' }}
                            </td>
                            <td>
                                {{ $eventTicket->ticket_date ?? '' }}
                            </td>
                            <td>
                                {{ $eventTicket->ticket_price ?? '' }}
                            </td>
                            <td>
                                @can('event_ticket_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.event-tickets.show', $eventTicket->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('event_ticket_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.event-tickets.edit', $eventTicket->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('event_ticket_delete')
                                    <form action="{{ route('admin.event-tickets.destroy', $eventTicket->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('event_ticket_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.event-tickets.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-EventTicket:not(.ajaxTable)');


})

</script>
@endsection

@extends('layouts.admin')
@section('content')
@can('event_booking_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.event-bookings.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.eventBooking.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.eventBooking.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive overflow-visible print">
            <table class="table table-sm table-hover table-wrap card-table" id="data-table">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.eventBooking.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.eventBooking.fields.booking_event') }}
                        </th>
                        <th>
                            {{ trans('cruds.eventBooking.fields.booking_by_user') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.lastname') }}
                        </th>
                        <th>
                            {{ trans('cruds.eventBooking.fields.booking_total') }}
                        </th>
                        <th>
                            {{ trans('cruds.eventBooking.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($eventBookings as $key => $eventBooking)
                        <tr data-entry-id="{{ $eventBooking->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $eventBooking->id ?? '' }}
                            </td>
                            <td>
                                {{ $eventBooking->booking_event->event_title ?? '' }}
                            </td>
                            <td>
                                {{ $eventBooking->booking_by_user->name ?? '' }}
                            </td>
                            <td>
                                {{ $eventBooking->booking_by_user->lastname ?? '' }}
                            </td>
                            <td>
                                {{ $eventBooking->booking_total ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\EventBooking::STATUS_SELECT[$eventBooking->status] ?? '' }}
                            </td>
                            <td>
                                @can('event_booking_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.event-bookings.show', $eventBooking->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('event_booking_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.event-bookings.edit', $eventBooking->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('event_booking_delete')
                                    <form action="{{ route('admin.event-bookings.destroy', $eventBooking->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('event_booking_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.event-bookings.massDestroy') }}",
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
  let table = $('.datatable-EventBooking:not(.ajaxTable)');


})

</script>
@endsection

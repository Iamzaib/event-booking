@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('booking_room_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.booking-rooms.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.bookingRoom.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.bookingRoom.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-BookingRoom">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookingRoom.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bookingRoom.fields.room') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.hotelRoom.fields.room_capacity') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bookingRoom.fields.booking_for') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventBooking.fields.booking_total') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventBooking.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bookingRoom.fields.room_booking_rate') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bookingRoom.fields.booking_from') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bookingRoom.fields.booking_to') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookingRooms as $key => $bookingRoom)
                                    <tr data-entry-id="{{ $bookingRoom->id }}">
                                        <td>
                                            {{ $bookingRoom->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bookingRoom->room->room_title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bookingRoom->room->room_capacity ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bookingRoom->booking_for->booking_details ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bookingRoom->booking_for->booking_total ?? '' }}
                                        </td>
                                        <td>
                                            @if($bookingRoom->booking_for)
                                                {{ $bookingRoom->booking_for::STATUS_SELECT[$bookingRoom->booking_for->status] ?? '' }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $bookingRoom->room_booking_rate ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bookingRoom->booking_from ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bookingRoom->booking_to ?? '' }}
                                        </td>
                                        <td>
                                            @can('booking_room_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.booking-rooms.show', $bookingRoom->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('booking_room_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.booking-rooms.edit', $bookingRoom->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('booking_room_delete')
                                                <form action="{{ route('frontend.booking-rooms.destroy', $bookingRoom->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('booking_room_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.booking-rooms.massDestroy') }}",
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
    pageLength: 100,
  });
  let table = $('.datatable-BookingRoom:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
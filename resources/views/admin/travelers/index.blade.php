@extends('layouts.admin')
@section('content')
@can('traveler_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.travelers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.traveler.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.traveler.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive overflow-visible print">
            <table class="table table-sm table-hover table-nowrap card-table" id="data-table">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.traveler.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.traveler.fields.booking') }}
                        </th>
                        <th>
                            {{ trans('cruds.traveler.fields.first_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.traveler.fields.last_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.traveler.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.traveler.fields.phone') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($travelers as $key => $traveler)
                        <tr data-entry-id="{{ $traveler->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $traveler->id ?? '' }}
                            </td>
                            <td>
                                {{ $traveler->booking->booking_details ?? '' }}
                            </td>
                            <td>
                                {{ $traveler->first_name ?? '' }}
                            </td>
                            <td>
                                {{ $traveler->last_name ?? '' }}
                            </td>
                            <td>
                                {{ $traveler->email ?? '' }}
                            </td>
                            <td>
                                {{ $traveler->phone ?? '' }}
                            </td>
                            <td>
                                @can('traveler_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.travelers.show', $traveler->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('traveler_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.travelers.edit', $traveler->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('traveler_delete')
                                    <form action="{{ route('admin.travelers.destroy', $traveler->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('traveler_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.travelers.massDestroy') }}",
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
  let table = $('.datatable-Traveler:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection

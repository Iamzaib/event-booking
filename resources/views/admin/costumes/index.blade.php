@extends('layouts.admin')
@section('content')
@can('costume_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.costumes.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.costume.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.costume.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive overflow-visible print">
            <table class="table table-sm table-hover table-nowrap card-table" id="data-table">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.costume.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.costume.fields.costume_title') }}
                        </th>
                        <th>
                            {{ trans('cruds.costume.fields.costume_price') }}
                        </th>
                        <th>
                            {{ trans('cruds.costume.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($costumes as $key => $costume)
                        <tr data-entry-id="{{ $costume->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $costume->id ?? '' }}
                            </td>
                            <td>
                                {{ $costume->costume_title ?? '' }}
                            </td>
                            <td>
                                {{ $costume->costume_price ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Costume::STATUS_RADIO[$costume->status] ?? '' }}
                            </td>
                            <td>
                                @can('costume_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.costumes.show', $costume->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('costume_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.costumes.edit', $costume->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('costume_delete')
                                    <form action="{{ route('admin.costumes.destroy', $costume->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('costume_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.costumes.massDestroy') }}",
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
  let table = $('.datatable-Costume:not(.ajaxTable)');


})

</script>
@endsection

@extends('layouts.admin')
@section('content')
@can('package_amenity_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.package-amenities.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.packageAmenity.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.packageAmenity.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive overflow-visible print">
            <table class="table table-sm table-hover table-wrap card-table" id="data-table">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.packageAmenity.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.packageAmenity.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.packageAmenity.fields.icon') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($packageAmenities as $key => $packageAmenity)
                        <tr data-entry-id="{{ $packageAmenity->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $packageAmenity->id ?? '' }}
                            </td>
                            <td>
                                {{ $packageAmenity->title ?? '' }}
                            </td>
                            <td>
                                @if($packageAmenity->icon)
                                    <a href="{{ $packageAmenity->icon->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $packageAmenity->icon->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('package_amenity_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.package-amenities.show', $packageAmenity->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('package_amenity_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.package-amenities.edit', $packageAmenity->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('package_amenity_delete')
                                    <form action="{{ route('admin.package-amenities.destroy', $packageAmenity->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('package_amenity_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.package-amenities.massDestroy') }}",
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
  // let table = $('.datatable-PackageAmenity:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  // $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
  //     $($.fn.dataTable.tables(true)).DataTable()
  //         .columns.adjust();
  // });

})

</script>
@endsection

@extends('layouts.admin')
@section('content')
{{--  New Design  --}}
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">

            <!-- Header -->
            <div class="header">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">

                            <!-- Pretitle -->
                            <h6 class="header-pretitle">
                                {{ trans('cruds.user.title') }}
                            </h6>

                            <!-- Title -->
                            <h1 class="header-title text-truncate">
                                {{ trans('cruds.user.title_singular') }} {{ trans('global.list') }}
                            </h1>

                        </div>
                        <div class="col-auto">

                            <!-- Buttons -->
    @can('user_create')
                            <a class="btn btn-primary ms-2" href="{{ route('admin.users.create') }}">
                                {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
                            </a>
@endcan
                        </div>
                    </div> <!-- / .row -->
                    <div class="row align-items-center">
                        <div class="col">


                        </div>
                    </div>
                </div>
            </div>


            <div class="card">
{{--                <div class="card-header">--}}
{{--                    {{ trans('cruds.user.title_singular') }} {{ trans('global.list') }}--}}
{{--                </div>--}}

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-wrap card-table datatable-User" style="width:100%">
                            <thead>
                            <tr>
                                <th width="10">

                                </th>
                                <th>
                                    {{ trans('cruds.user.fields.id') }}
                                </th>
                                <th>
                                    {{ trans('cruds.user.fields.name') }}
                                </th>
                                <th>
                                    {{ trans('cruds.user.fields.email') }}
                                </th>
                                <th>
                                    {{ trans('cruds.user.fields.phone') }}
                                </th>
                                <th>
                                    {{ trans('cruds.user.fields.email_verified_at') }}
                                </th>
                                <th>
                                    {{ trans('cruds.user.fields.verified') }}
                                </th>
                                <th>
                                    {{ trans('cruds.user.fields.roles') }}
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key => $user)
                                <tr data-entry-id="{{ $user->id }}">
                                    <td width="10">

                                    </td>
                                    <td>
                                        {{ $user->id ?? '' }}
                                    </td>
                                    <td>
                                        {{ $user->name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $user->email ?? '' }}
                                    </td>
                                    <td>
                                        {{ $user->phone ?? '' }}
                                    </td>
                                    <td>
                                        {{ $user->email_verified_at ?? '' }}
                                    </td>
                                    <td>
                                        <span style="display:none">{{ $user->verified ?? '' }}</span>
                                        <input type="checkbox" disabled="disabled" {{ $user->verified ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        @foreach($user->roles as $key => $item)

                                            <span class="badge bg-info-soft">{{ $item->title }}</span>
                                        @endforeach
                                        {{--                                @dd($user->roles)--}}
                                    </td>
                                    <td class="text-end">

                                        <!-- Dropdown -->
                                        <div class="dropdown">
                                            <a class="dropdown-ellipses dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fe fe-more-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                @can('user_show')
                                                    <a class="dropdown-item" href="{{ route('admin.users.show', $user->id) }}">
                                                        {{ trans('global.view') }}
                                                    </a>
                                                @endcan

                                                @can('user_edit')
                                                    <a class="dropdown-item" href="{{ route('admin.users.edit', $user->id) }}">
                                                        {{ trans('global.edit') }}
                                                    </a>
                                                @endcan

                                                @can('user_delete')
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="submit" class="dropdown-item" value="{{ trans('global.delete') }}">
                                                    </form>
                                                @endcan
                                            </div>
                                        </div>


                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- / .row -->
</div>
{{--@can('user_create')--}}
{{--    <div style="margin-bottom: 10px;" class="row">--}}
{{--        <div class="col-lg-12">--}}
{{--            <a class="btn btn-success" href="{{ route('admin.users.create') }}">--}}
{{--                {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endcan--}}




@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
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
  let table = $('.datatable-User:not(.ajaxTable)');


})

</script>
@endsection

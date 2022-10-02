@extends('layouts.admin')
@section('content')
@can('setting_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.settings.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.setting.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.setting.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive overflow-visible print">
            <table class="table table-sm table-hover table-wrap card-table" id="data-table">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.name') }}
                        </th>
                        <th>
                            Details
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.setting_value') }}
                        </th>
{{--                        <th>--}}
{{--                            &nbsp;--}}
{{--                        </th>--}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($settings as $key => $setting)
                        <tr data-entry-id="{{ $setting->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $setting->id ?? '' }}
                            </td>
                            <td>
                                {{ $setting->name ?? '' }}
                            </td>
                            <td>
                                {{ $setting->details ?? '' }}
                            </td>
                            <td>
                                <form method="POST" action="{{ route("admin.settings.update", [$setting->id]) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
{{--                                {{ $setting->setting_value ?? '' }}--}}

                                    <div class="row">
                                        <div class="col-8">
{{--                                            <label class="required" for="setting_value_{{$setting->id}}">{{ trans('cruds.setting.fields.setting_value') }}</label>--}}
                                            @if($setting->setting_type=='text')
                                            <input class="form-control d-inline-flex {{ $errors->has('setting_value') ? 'is-invalid' : '' }}" type="text" name="setting_value" id="setting_value_{{$setting->id}}" value="{{ old('setting_value', $setting->setting_value) }}" required>
                                           @elseif($setting->setting_type=='true-false')
                                                <div class="form-check {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                                                    <input class="form-check-input" type="radio" id="setting_value_{{$setting->id}}-1" name="setting_value" value="1" {{ old('setting_value', $setting->setting_value) == '1' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="setting_value_{{$setting->id}}-1">True</label>
                                                </div>
                                                <div class="form-check {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                                                    <input class="form-check-input" type="radio" id="setting_value_{{$setting->id}}-0" name="setting_value" value="0" {{ old('setting_value', $setting->setting_value) == '0' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="setting_value_{{$setting->id}}-0">False</label>
                                                </div>
                                           @elseif($setting->setting_type=='select')
                                                <select class="form-control select2 {{ $errors->has('costumes') ? 'is-invalid' : '' }}" name="setting_value" id="setting_value_{{$setting->id}}" >
                                                    @foreach(explode(',',$setting->predefined_values) as $id => $value)
                                                        <option value="{{ $value }}" {{ $value==$setting->setting_value ? 'selected' : '' }}>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                            @if($errors->has('setting_value'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('setting_value') }}
                                                </div>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.setting.fields.setting_value_helper') }}</span>
                                        </div>
                                        <div class="col-4">


                                            <button class="btn btn-dark " id="setting_value_btn_{{$setting->id}}" onclick="submit_form('{{$setting->id}}','{{ route("admin.settings.update", [$setting->id]) }}',document.getElementById('setting_value_{{$setting->id}}').value)">Save</button>

                                        </div>
                                    </div>

                                </form>
                            </td>
{{--                            <td>--}}
{{--                                @can('setting_show')--}}
{{--                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.settings.show', $setting->id) }}">--}}
{{--                                        {{ trans('global.view') }}--}}
{{--                                    </a>--}}
{{--                                @endcan--}}

{{--                                @can('setting_edit')--}}
{{--                                    <a class="btn btn-xs btn-info" href="{{ route('admin.settings.edit', $setting->id) }}">--}}
{{--                                        {{ trans('global.edit') }}--}}
{{--                                    </a>--}}
{{--                                @endcan--}}

{{--                                @can('setting_delete')--}}
{{--                                    <form action="{{ route('admin.settings.destroy', $setting->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">--}}
{{--                                        <input type="hidden" name="_method" value="DELETE">--}}
{{--                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">--}}
{{--                                    </form>--}}
{{--                                @endcan--}}

{{--                            </td>--}}

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
{{--        <img src="..." class="rounded me-2" alt="...">--}}
        <strong class="me-auto">Bootstrap</strong>
        <small>11 mins ago</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        Hello, world! This is a toast message.
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('setting_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.settings.massDestroy') }}",
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
  let table = $('.datatable-Setting:not(.ajaxTable)');


})
$(function (){

});
    function submit_form(id,route,value){
        $.post(route, {setting_value: value,_token:'{{csrf_token()}}'}, function(result){
            $("span").html(result);
        });
    }
</script>
@endsection

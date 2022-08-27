@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">

                <!-- Header -->
                <div class="header no-print">
                    <div class="header-body">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Pretitle -->
                                <h6 class="header-pretitle">
                                    {{ trans('cruds.blogTag.title') }}
                                </h6>

                                <!-- Title -->
                                <h1 class="header-title text-truncate">
                                    {{ trans('cruds.blogTag.title_singular') }} {{ trans('global.list') }}
                                </h1>

                            </div>
                            <div class="col-auto">

                                <!-- Navigation (button group) -->
                                <div class="nav btn-group d-inline-flex" role="tablist">
                                </div> <!-- / .nav -->

                                @can('blog_tag_create')
                                    <a class="btn btn-primary ms-2" href="{{ route('admin.blog-tags.create') }}">
                                        {{ trans('global.add') }} {{ trans('cruds.blogTag.title_singular') }}
                                    </a>
                                @endcan

                            </div>
                        </div> <!-- / .row -->
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Nav -->
                                {{--                                <ul class="nav nav-tabs nav-overflow header-tabs">--}}
                                {{--                                    <li class="nav-item">--}}
                                {{--                                        <a href="#!" class="nav-link text-nowrap active">--}}
                                {{--                                            All contacts <span class="badge rounded-pill bg-secondary-soft">823</span>--}}
                                {{--                                        </a>--}}
                                {{--                                    </li>--}}
                                {{--                                    <li class="nav-item">--}}
                                {{--                                        <a href="#!" class="nav-link text-nowrap">--}}
                                {{--                                            Your contacts <span class="badge rounded-pill bg-secondary-soft">231</span>--}}
                                {{--                                        </a>--}}
                                {{--                                    </li>--}}
                                {{--                                    <li class="nav-item">--}}
                                {{--                                        <a href="#!" class="nav-link text-nowrap">--}}
                                {{--                                            Deleted <span class="badge rounded-pill bg-secondary-soft">22</span>--}}
                                {{--                                        </a>--}}
                                {{--                                    </li>--}}
                                {{--                                </ul>--}}

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab content -->
                <div class="tab-content">

                    <div class="tab-pane fade show active" id="contactsListPane" role="tabpanel" aria-labelledby="contactsListTab">

                        <!-- Card -->
                        <div class="card"  id="contactsList">
                            <div class="card-header no-print">
                                <div class="row align-items-center">
                                    <div class="col">

                                        <!-- Form -->
                                        <form action="{{ route('admin.blog-tags.index') }}">
                                            <div class="input-group input-group-flush input-group-merge input-group-reverse">
                                                <input class="form-control list-search" type="search" name="search" placeholder="Enter to Search">
                                                <span class="input-group-text">
                              <i class="fe fe-search"></i>
                            </span>
                                            </div>
                                        </form>

                                    </div>
                                    <div class="col-auto me-n3">

                                        <!-- Select -->
                                        <form action="{{route('admin.blog-tags.index')}}">
                                            <select class="form-select form-select-sm form-control-flush" name="per_page" data-choices='{"searchEnabled": false}' onchange="this.form.submit()">
                                                <option value="5" {{$per_page==5?'selected':''}}>5 per page</option>
                                                <option value="10" {{$per_page==10?'selected':''}}>10 per page</option>
                                                <option value="50" {{$per_page==50?'selected':''}}>50 per page</option>
                                            </select>
                                            <input type="hidden" name="sort" value="{{$sort}}">
                                        </form>

                                    </div>
                                    <div class="col-auto">
                                        @if(request('category')||request('search'))
                                            <div class="d-inline-block">
                                                <a type="button" class="btn btn-danger btn-sm w-100 " href="{{route('admin.blog-tags.index')}}">
                                                    <i class="bi-download me-2"></i> Reset Search & Filters
                                                </a>
                                            </div>
                                        @endif
                                        {{--                                        --}}
                                        {{--                                        <div class="dropdown d-inline-block">--}}
                                        {{--                                            <button type="button" class="btn btn-white btn-sm dropdown-toggle w-100" id="usersExportDropdown" data-bs-toggle="dropdown" aria-expanded="true">--}}
                                        {{--                                                <i class="bi-download me-2"></i> Export--}}
                                        {{--                                            </button>--}}

                                        {{--                                            <div class="dropdown-menu dropdown-menu-sm-end" aria-labelledby="usersExportDropdown" style="position: absolute; inset: auto 0px 0px auto; margin: 0px; transform: translate3d(-0.483337px, -39.2px, 0px);" data-popper-placement="top-end" data-popper-reference-hidden="">--}}
                                        {{--                                                <span class="dropdown-header">Options</span>--}}
                                        {{--                                                <a id="export-copy" class="dropdown-item" href="javascript:;">--}}
                                        {{--                                                    <img class="avatar avatar-xss avatar-4x3 me-2" src="https://htmlstream.com/preview/front-dashboard-v2.0/assets/svg/illustrations/copy-icon.svg" alt="Image Description">--}}
                                        {{--                                                    Copy--}}
                                        {{--                                                </a>--}}
                                        {{--                                                <a id="export-print" class="dropdown-item" href="javascript:;" onclick="window.print()">--}}
                                        {{--                                                    <img class="avatar avatar-xss avatar-4x3 me-2" src="https://htmlstream.com/preview/front-dashboard-v2.0/assets/svg/illustrations/print-icon.svg" alt="Image Description">--}}
                                        {{--                                                    Print--}}
                                        {{--                                                </a>--}}
                                        {{--                                                <div class="dropdown-divider"></div>--}}
                                        {{--                                                <span class="dropdown-header">Download options</span>--}}
                                        {{--                                                <a id="export-excel" class="dropdown-item" href="javascript:;" onclick="export_data_('xlsx')">--}}
                                        {{--                                                    <img class="avatar avatar-xss avatar-4x3 me-2" src="https://htmlstream.com/preview/front-dashboard-v2.0/assets/svg/brands/excel-icon.svg" alt="Image Description">--}}
                                        {{--                                                    Excel--}}
                                        {{--                                                </a>--}}
                                        {{--                                                <a id="export-csv" class="dropdown-item" href="javascript:;" onclick="export_data_('csv')">--}}
                                        {{--                                                    <img class="avatar avatar-xss avatar-4x3 me-2" src="https://htmlstream.com/preview/front-dashboard-v2.0/assets/svg/components/placeholder-csv-format.svg" alt="Image Description">--}}
                                        {{--                                                    .CSV--}}
                                        {{--                                                </a>--}}
                                        {{--                                                <a id="export-pdf" class="dropdown-item" href="javascript:;" onclick="export_data_('pdf')">--}}
                                        {{--                                                    <img class="avatar avatar-xss avatar-4x3 me-2" src="https://htmlstream.com/preview/front-dashboard-v2.0/assets/svg/brands/pdf-icon.svg" alt="Image Description">--}}
                                        {{--                                                    PDF--}}
                                        {{--                                                </a>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <!-- Dropdown -->--}}
                                        {{--                                        <div class="dropdown d-inline-block">--}}

                                        {{--                                            <!-- Toggle -->--}}
                                        {{--                                            <button class="btn btn-sm btn-white" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">--}}
                                        {{--                                                <i class="fe fe-sliders me-1"></i> Filter <span class="badge bg-primary ms-1 d-none">0</span>--}}
                                        {{--                                            </button>--}}

                                        {{--                                            <!-- Menu -->--}}
                                        {{--                                            <form class="dropdown-menu dropdown-menu-end dropdown-menu-card " style="min-width: 370px">--}}

                                        {{--                                                <div class="card-header">--}}

                                        {{--                                                    <!-- Title -->--}}
                                        {{--                                                    <h4 class="card-header-title">--}}
                                        {{--                                                        Filters--}}
                                        {{--                                                    </h4>--}}
                                        {{--                                                @if(request('category')||request('search'))--}}
                                        {{--                                                    <!-- Link -->--}}
                                        {{--                                                        <button class="btn btn-sm btn-link text-reset d-none" type="reset">--}}
                                        {{--                                                            <small>Clear filters</small>--}}
                                        {{--                                                        </button>--}}
                                        {{--                                                    @endif--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="card-body">--}}

                                        {{--                                                    <!-- List group -->--}}
                                        {{--                                                    <div class="list-group list-group-flush mt-n4 mb-4">--}}
                                        {{--                                                        <div class="list-group-item">--}}
                                        {{--                                                            <div class="row">--}}
                                        {{--                                                                <div class="col">--}}

                                        {{--                                                                    <!-- Text -->--}}
                                        {{--                                                                    <small>Category</small>--}}

                                        {{--                                                                </div>--}}
                                        {{--                                                                <div class="col-auto">--}}

                                        {{--                                                                    <!-- Select -->--}}
                                        {{--                                                                    <select class="form-select form-select-sm form-control" name="category" >--}}
                                        {{--                                                                        --}}{{--                                                                        <option value="*" selected>Any</option>--}}
                                        {{--                                                                        @foreach($filters['tags'] as $id => $val)--}}
                                        {{--                                                                            <option value="{{$id}}" {{request('category')&&request('category')==$id?'selected':''}}>{{$val}}</option>--}}
                                        {{--                                                                        @endforeach--}}

                                        {{--                                                                    </select>--}}

                                        {{--                                                                </div>--}}
                                        {{--                                                            </div> <!-- / .row -->--}}
                                        {{--                                                        </div>     <div class="list-group-item">--}}
                                        {{--                                                            <div class="row">--}}
                                        {{--                                                                <div class="col">--}}

                                        {{--                                                                    <!-- Text -->--}}
                                        {{--                                                                    <small>Tag</small>--}}

                                        {{--                                                                </div>--}}
                                        {{--                                                                <div class="col-auto">--}}

                                        {{--                                                                    <!-- Select -->--}}
                                        {{--                                                                    <select class="form-select form-select-sm" name="tag" >--}}
                                        {{--                                                                        --}}{{--                                                                        <option value="*" selected>Any</option>--}}
                                        {{--                                                                        @foreach($filters['tags'] as $id => $val)--}}
                                        {{--                                                                            <option value="{{$id}}"  {{request('tag')&&request('tag')==$id?'selected':''}}>{{$val}}</option>--}}
                                        {{--                                                                        @endforeach--}}

                                        {{--                                                                    </select>--}}

                                        {{--                                                                </div>--}}
                                        {{--                                                            </div> <!-- / .row -->--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                        <div class="list-group-item">--}}
                                        {{--                                                            <div class="row">--}}
                                        {{--                                                                <div class="col">--}}

                                        {{--                                                                    <!-- Text -->--}}
                                        {{--                                                                    <small>Author</small>--}}

                                        {{--                                                                </div>--}}
                                        {{--                                                                <div class="col-auto">--}}

                                        {{--                                                                    <!-- Select -->--}}
                                        {{--                                                                    <select class="form-select form-select-sm " name="author" >--}}

                                        {{--                                                                        @foreach($filters['users'] as $id => $val)--}}
                                        {{--                                                                            <option value="{{$id}}"  {{request('author')&&request('author')==$id?'selected':''}}>{{$val}}</option>--}}
                                        {{--                                                                        @endforeach--}}

                                        {{--                                                                    </select>--}}

                                        {{--                                                                </div>--}}
                                        {{--                                                            </div> <!-- / .row -->--}}
                                        {{--                                                        </div>--}}

                                        {{--                                                    </div>--}}

                                        {{--                                                    <!-- Button -->--}}
                                        {{--                                                    <button class="btn w-100 btn-primary" type="submit">--}}
                                        {{--                                                        Apply filter--}}
                                        {{--                                                    </button>--}}

                                        {{--                                                </div>--}}
                                        {{--                                            </form>--}}

                                        {{--                                        </div>--}}

                                    </div>

                                </div> <!-- / .row -->
                            </div>
                            <div class="table-responsive overflow-visible print">
                                <table class="table table-sm table-hover table-nowrap card-table" id="data-table">
                                    <thead>
                                    <tr>
                                        <th>

                                            <!-- Checkbox -->
                                            <div class="form-check mb-n2">
                                                <input class="form-check-input list-checkbox-all" onclick="checkAll(this)" id="listCheckboxAll" type="checkbox">
                                                <label class="form-check-label" for="listCheckboxAll"></label>
                                            </div>

                                        </th>

                                        <th>
                                            <a class="list-sort text-muted"  href="{{request()->fullUrlWithQuery(['sort' => 'name-'.$sort_type,'sorting'=>1])}}">
                                                {{ trans('cruds.blogTag.fields.name') }}</a>
                                        </th>
                                        <th>
                                            <a class="list-sort text-muted"  href="{{request()->fullUrlWithQuery(['sort' => 'slug-'.$sort_type,'sorting'=>1])}}">
                                                {{ trans('cruds.blogTag.fields.slug') }}</a>
                                        </th>
                                        <th >
                                            Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($blogTags as $key => $blogTag)
                                        <tr data-entry-id="{{ $blogTag->id }}">
                                            <td>

                                                <!-- Checkbox -->
                                                <div class="form-check">
                                                    <input class="form-check-input list-checkbox" onclick="total_checkboxes()" name="list-checkbox" id="listCheckbox-{{ $blogTag->id }}" value="{{ $blogTag->id }}" type="checkbox">
                                                    <label class="form-check-label" for="listCheckbox-{{ $blogTag->id }}"></label>
                                                </div>

                                            </td>
                                            <td>
                                                <a class=" text-reset" href="{{ route('admin.blog-tags.show', $blogTag->id) }}">
                                                    {{ $blogTag->name ?? '' }}</a>
                                            </td>
                                            <td>
                                                {{ $blogTag->slug ?? '' }}
                                            </td>
                                            <td class="text-end"> <div class="dropdown">
                                                    <a class="dropdown-ellipses dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fe fe-more-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        @can('blog_tag_show')
                                                            <a class="dropdown-item" href="{{ route('admin.blog-tags.show', $blogTag->id) }}">
                                                                {{ trans('global.view') }}
                                                            </a>
                                                        @endcan

                                                        @can('blog_tag_edit')
                                                            <a class="dropdown-item" href="{{ route('admin.blog-tags.edit', $blogTag->id) }}">
                                                                {{ trans('global.edit') }}
                                                            </a>
                                                        @endcan

                                                        @can('blog_tag_delete')
                                                            <form action="{{ route('admin.blog-tags.destroy', $blogTag->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
                            <div class="card-footer d-flex justify-content-between">
                            {{$blogTags->appends(request()->merge(['sort' => $sort,'per_page'=>$per_page])->all())->links()}}

                            <!-- Alert -->
                                <div class="list-alert alert alert-dark alert-dismissible border fade" id="list-alert" role="alert">

                                    <!-- Content -->
                                    <div class="row align-items-center">
                                        <div class="col">

                                            <!-- Checkbox -->
                                            <div class="form-check">
                                                <input class="form-check-input" id="listAlertCheckbox" type="checkbox" checked disabled>
                                                <label class="form-check-label text-white" for="listAlertCheckbox">
                                                    <span class="list-alert-count" id="list-alert-count">0</span>  Blog Post(s)
                                                </label>
                                            </div>

                                        </div>
                                        <div class="col-auto me-n3">

                                        {{--                                            <!-- Button -->--}}
                                        {{--                                            <button class="btn btn-sm btn-white-20" onclick="edit_selected()">--}}
                                        {{--                                                Edit--}}
                                        {{--                                            </button>--}}

                                        <!-- Button -->
                                            <button class="btn btn-sm btn-white-20" onclick="delete_selected()">
                                                Delete
                                            </button>

                                        </div>
                                    </div> <!-- / .row -->

                                    <!-- Close -->
                                    <button type="button" class="list-alert-close btn-close" aria-label="Close"></button>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div>



                    </div>
                </div>

            </div>
        </div> <!-- / .row -->
    </div>


@endsection
@section('scripts')
    <script>
        var route="{{ route('admin.blog-tags.massDestroy') }}",export_route='';{{--route('admin.blog-tags.export')--}}
    </script>
    @parent
@endsection


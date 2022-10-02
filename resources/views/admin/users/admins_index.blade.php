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
                                    Admin {{ trans('cruds.user.title') }}
                                </h6>

                                <!-- Title -->
                                <h1 class="header-title text-truncate">
                                   Admin {{ trans('cruds.user.title_singular') }} {{ trans('global.list') }}
                                </h1>

                            </div>
                            <div class="col-auto">

                                <!-- Navigation (button group) -->
                                <div class="nav btn-group d-inline-flex" role="tablist">
{{--                                    <button class="btn btn-white active" id="contactsListTab" data-bs-toggle="tab" data-bs-target="#contactsListPane" role="tab" aria-controls="contactsListPane" aria-selected="true">--}}
{{--                                        <span class="fe fe-list"></span>--}}
{{--                                    </button>--}}
{{--                                    <button class="btn btn-white" id="contactsCardsTab" data-bs-toggle="tab" data-bs-target="#contactsCardsPane" role="tab" aria-controls="contactsCardsPane" aria-selected="false">--}}
{{--                                        <span class="fe fe-grid"></span>--}}
{{--                                    </button>--}}
                                </div> <!-- / .nav -->

                                @can('user_create')
                                    <a class="btn btn-primary ms-2" href="{{ route('admin.users.create') }}">
                                        {{ trans('global.add') }} Admin {{ trans('cruds.user.title_singular') }}
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
                        <div class="card" data-list='{"valueNames": ["item-name", "item-title", "item-email", "item-phone", "item-roles", "item-company"]}' id="contactsList">
                            <div class="card-header no-print">
                                <div class="row align-items-center">
                                    <div class="col">

                                        <!-- Form -->
                                        <form action="{{ route('admin.admins.index') }}">
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
                                        <form action="{{route('admin.admins.index')}}">
                                            <select class="form-select form-select-sm form-control-flush" name="per_page" data-choices='{"searchEnabled": false}' onchange="this.form.submit()">
                                                <option value="5" {{$per_page==5?'selected':''}}>5 per page</option>
                                                <option value="10" {{$per_page==10?'selected':''}}>10 per page</option>
                                                <option value="50" {{$per_page==50?'selected':''}}>50 per page</option>
                                            </select>
                                            <input type="hidden" name="sort" value="{{$sort}}">
                                        </form>

                                    </div>
                                    <div class="col-auto">
                                        <div class="dropdown d-inline-block">
                                            <button type="button" class="btn btn-white btn-sm dropdown-toggle w-100" id="usersExportDropdown" data-bs-toggle="dropdown" aria-expanded="true">
                                                <i class="bi-download me-2"></i> Export
                                            </button>

                                            <div class="dropdown-menu dropdown-menu-sm-end" aria-labelledby="usersExportDropdown" style="position: absolute; inset: auto 0px 0px auto; margin: 0px; transform: translate3d(-0.483337px, -39.2px, 0px);" data-popper-placement="top-end" data-popper-reference-hidden="">
                                                <span class="dropdown-header">Options</span>
                                                <a id="export-copy" class="dropdown-item" href="javascript:;">
                                                    <img class="avatar avatar-xss avatar-4x3 me-2" src="https://htmlstream.com/preview/front-dashboard-v2.0/assets/svg/illustrations/copy-icon.svg" alt="Image Description">
                                                    Copy
                                                </a>
                                                <a id="export-print" class="dropdown-item" href="javascript:;" onclick="window.print()">
                                                    <img class="avatar avatar-xss avatar-4x3 me-2" src="https://htmlstream.com/preview/front-dashboard-v2.0/assets/svg/illustrations/print-icon.svg" alt="Image Description">
                                                    Print
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <span class="dropdown-header">Download options</span>
                                                <a id="export-excel" class="dropdown-item" href="javascript:;" onclick="export_data_('xlsx')">
                                                    <img class="avatar avatar-xss avatar-4x3 me-2" src="https://htmlstream.com/preview/front-dashboard-v2.0/assets/svg/brands/excel-icon.svg" alt="Image Description">
                                                    Excel
                                                </a>
                                                <a id="export-csv" class="dropdown-item" href="javascript:;" onclick="export_data_('csv')">
                                                    <img class="avatar avatar-xss avatar-4x3 me-2" src="https://htmlstream.com/preview/front-dashboard-v2.0/assets/svg/components/placeholder-csv-format.svg" alt="Image Description">
                                                    .CSV
                                                </a>
                                                <a id="export-pdf" class="dropdown-item" href="javascript:;" onclick="export_data_('pdf')">
                                                    <img class="avatar avatar-xss avatar-4x3 me-2" src="https://htmlstream.com/preview/front-dashboard-v2.0/assets/svg/brands/pdf-icon.svg" alt="Image Description">
                                                    PDF
                                                </a>
                                            </div>
                                        </div>
                                        <!-- Dropdown -->
                                        <div class="dropdown d-inline-block">

                                            <!-- Toggle -->
                                            <button class="btn btn-sm btn-white" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                                                <i class="fe fe-sliders me-1"></i> Filter <span class="badge bg-primary ms-1 d-none">0</span>
                                            </button>

                                            <!-- Menu -->
                                            <form class="dropdown-menu dropdown-menu-end dropdown-menu-card " style="min-width: 370px">

                                                <div class="card-header">

                                                    <!-- Title -->
                                                    <h4 class="card-header-title">
                                                        Filters
                                                    </h4>

                                                    <!-- Link -->
                                                    <button class="btn btn-sm btn-link text-reset d-none" type="reset">
                                                        <small>Clear filters</small>
                                                    </button>

                                                </div>
                                                <div class="card-body">

                                                    <!-- List group -->
                                                    <div class="list-group list-group-flush mt-n4 mb-4">
                                                        <div class="list-group-item">
                                                            <div class="row">
                                                                <div class="col">

                                                                    <!-- Text -->
                                                                    <small>Country</small>

                                                                </div>
                                                                <div class="col-auto">

                                                                    <!-- Select -->
                                                                    <select class="form-select form-select-sm form-control" name="country" >
{{--                                                                        <option value="*" selected>Any</option>--}}
                                                                        @foreach($filters['countries'] as $id => $val)
                                                                            <option value="{{$id}}">{{$val}}</option>
                                                                        @endforeach

                                                                    </select>

                                                                </div>
                                                            </div> <!-- / .row -->
                                                        </div>     <div class="list-group-item">
                                                            <div class="row">
                                                                <div class="col">

                                                                    <!-- Text -->
                                                                    <small>State</small>

                                                                </div>
                                                                <div class="col-auto">

                                                                    <!-- Select -->
                                                                    <select class="form-select form-select-sm" name="state" >
{{--                                                                        <option value="*" selected>Any</option>--}}
                                                                        @foreach($filters['states'] as $id => $val)
                                                                            <option value="{{$id}}">{{$val}}</option>
                                                                        @endforeach

                                                                    </select>

                                                                </div>
                                                            </div> <!-- / .row -->
                                                        </div>     <div class="list-group-item">
                                                            <div class="row">
                                                                <div class="col">

                                                                    <!-- Text -->
                                                                    <small>City</small>

                                                                </div>
                                                                <div class="col-auto">

                                                                    <!-- Select -->
                                                                    <select class="form-select form-select-sm " name="city" >
{{--                                                                        <option value="*" selected>Any</option>--}}
                                                                        @foreach($filters['cities'] as $id => $val)
                                                                            <option value="{{$id}}">{{$val}}</option>
                                                                        @endforeach

                                                                    </select>

                                                                </div>
                                                            </div> <!-- / .row -->
                                                        </div>

                                                    </div>

                                                    <!-- Button -->
                                                    <button class="btn w-100 btn-primary" type="submit">
                                                        Apply filter
                                                    </button>

                                                </div>
                                            </form>

                                        </div>

                                    </div>

                                </div> <!-- / .row -->
                            </div>
                            <div class="table-responsive overflow-visible print">
                                <table class="table table-sm table-hover table-wrap card-table" id="data-table">
                                    <thead>
                                    <tr>
                                        <th>

                                            <!-- Checkbox -->
                                            <div class="form-check mb-n2">
                                                <input class="form-check-input list-checkbox-all" id="listCheckboxAll" type="checkbox">
                                                <label class="form-check-label" for="listCheckboxAll"></label>
                                            </div>

                                        </th>
                                        <th>
                                            <a class="list-sort text-muted" data-sort="item-name" href="{{request()->fullUrlWithQuery(['sort' => 'name-'.$sort_type,'sorting'=>1])}}">Name</a>
                                        </th>
{{--                                        <th>--}}
{{--                                            <a class="list-sort text-muted" data-sort="item-title" href="#">Job title</a>--}}
{{--                                        </th>--}}
                                        <th>
                                            <a class="list-sort text-muted" data-sort="item-email" href="{{request()->fullUrlWithQuery(['sort' => 'email-'.$sort_type,'sorting'=>1])}}">Email</a>
                                        </th>
                                        <th>
                                            <a class="list-sort text-muted" data-sort="item-phone" href="{{request()->fullUrlWithQuery(['sort' => 'phone-'.$sort_type,'sorting'=>1])}}">Phone</a>
                                        </th>
{{--                                        <th>--}}
{{--                                            <a class="list-sort text-muted" data-sort="item-roles" href="{{request()->fullUrlWithQuery(['sort' => 'name'])}}">Roles</a>--}}
{{--                                        </th>--}}
                                        <th >
                                            Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="list fs-base">
                                    @foreach($users as $key => $user)
                                    <tr>
                                        <td>

                                            <!-- Checkbox -->
                                            <div class="form-check">
                                                <input class="form-check-input list-checkbox" name="list-checkbox" id="listCheckbox-{{ $user->id }}" value="{{ $user->id }}" type="checkbox">
                                                <label class="form-check-label" for="listCheckbox-{{ $user->id }}"></label>
                                            </div>

                                        </td>
                                        <td>

                                            <!-- Avatar -->
{{--                                            <div class="avatar avatar-xs align-middle me-2">--}}
{{--                                                <img class="avatar-img rounded-circle" src="assets/img/avatars/profiles/avatar-1.jpg" alt="...">--}}
{{--                                            </div>--}}
                                            <a class="item-name text-reset" href="{{ route('admin.admins.show', $user->id) }}">{{ $user->name ?$user->name.' '.$user->lastname: '' }}</a>

                                        </td>
{{--                                        <td>--}}

{{--                                            <!-- Text -->--}}
{{--                                            <span class="item-title">Designer</span>--}}

{{--                                        </td>--}}
                                        <td>

                                            <!-- Email -->
                                            <a class="item-email text-reset" href="mailto:{{ $user->email ?? '#' }}">{{ $user->email ?? '' }}</a>

                                        </td>
                                        <td>

                                            <!-- Phone -->
                                            <a class="item-phone text-reset" href="tel:{{ $user->phone ?? '' }}">{{ $user->phone ?? '' }}</a>

                                        </td>
{{--                                        <td>--}}
{{--                                            @foreach($user->roles as $key => $item)--}}

{{--                                                <span class="item-roles badge bg-info-soft">{{ $item->title }}</span>--}}
{{--                                        @endforeach--}}
                                            <!-- Badge -->
{{--                                            //<span class="item-roles badge bg-danger-soft">1/10</span>--}}

{{--                                        </td>--}}
{{--                                        <td>--}}

{{--                                            <!-- Link -->--}}
{{--                                            <a class="item-company text-reset" href="team-overview.html">Twitter</a>--}}

{{--                                        </td>--}}
                                        <td class="text-end">

                                            <!-- Dropdown -->
                                            <div class="dropdown">
                                                <a class="dropdown-ellipses dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fe fe-more-vertical"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    @can('user_show')
                                                        <a class="dropdown-item" href="{{ route('admin.admins.show', $user->id) }}">
                                                            {{ trans('global.view') }}
                                                        </a>
                                                    @endcan

                                                    @can('user_edit')
                                                        <a class="dropdown-item" href="{{ route('admin.admins.edit', $user->id) }}">
                                                            {{ trans('global.edit') }}
                                                        </a>
                                                    @endcan

                                                    @can('user_delete')
                                                        <form action="{{ route('admin.admins.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
                                    {{$users->appends(request()->merge(['sort' => $sort,'per_page'=>$per_page])->all())->links()}}
                                <!-- Pagination (prev) -->
{{--                                <ul class="list-pagination-prev pagination pagination-tabs card-pagination">--}}
{{--                                    <li class="page-item">--}}
{{--                                        <a class="page-link ps-0 pe-4 border-end" href="#">--}}
{{--                                            <i class="fe fe-arrow-left me-1"></i> Prev--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}

{{--                                <!-- Pagination -->--}}
{{--                                <ul class="list-pagination pagination pagination-tabs card-pagination"></ul>--}}

{{--                                <!-- Pagination (next) -->--}}
{{--                                <ul class="list-pagination-next pagination pagination-tabs card-pagination">--}}
{{--                                    <li class="page-item">--}}
{{--                                        <a class="page-link ps-4 pe-0 border-start" href="#">--}}
{{--                                            Next <i class="fe fe-arrow-right ms-1"></i>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}

                                <!-- Alert -->
                                <div class="list-alert alert alert-dark alert-dismissible border fade" role="alert">

                                    <!-- Content -->
                                    <div class="row align-items-center">
                                        <div class="col">

                                            <!-- Checkbox -->
                                            <div class="form-check">
                                                <input class="form-check-input" id="listAlertCheckbox" type="checkbox" checked disabled>
                                                <label class="form-check-label text-white" for="listAlertCheckbox">
                                                    <span class="list-alert-count">0</span> Admin User(s)
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


{{--                    <div class="tab-pane fade" id="contactsCardsPane" role="tabpanel" aria-labelledby="contactsCardsTab">--}}

{{--                        <!-- Cards -->--}}
{{--                        <div data-list='{"valueNames": ["item-name", "item-title", "item-email", "item-phone", "item-roles", "item-company"], "page": 9, "pagination": {"paginationClass": "list-pagination"}}' id="contactsCards">--}}

{{--                            <!-- Header -->--}}
{{--                            <div class="row align-items-center mb-4">--}}
{{--                                <div class="col">--}}

{{--                                    <!-- Form -->--}}
{{--                                    <form>--}}
{{--                                        <div class="input-group input-group-lg input-group-merge input-group-reverse">--}}
{{--                                            <input class="form-control list-search" type="search" placeholder="Search">--}}
{{--                                            <span class="input-group-text">--}}
{{--                            <i class="fe fe-search"></i>--}}
{{--                          </span>--}}
{{--                                        </div>--}}
{{--                                    </form>--}}

{{--                                </div>--}}
{{--                                <div class="col-auto me-n3">--}}

{{--                                    <!-- Select -->--}}
{{--                                    <form>--}}
{{--                                        <select class="form-select form-select-sm form-control-flush" data-choices='{"searchEnabled": false}'>--}}
{{--                                            <option selected>9 per page</option>--}}
{{--                                            <option>All</option>--}}
{{--                                        </select>--}}
{{--                                    </form>--}}

{{--                                </div>--}}
{{--                                <div class="col-auto">--}}

{{--                                    <!-- Dropdown -->--}}
{{--                                    <div class="dropdown">--}}

{{--                                        <!-- Toggle -->--}}
{{--                                        <button class="btn btn-sm btn-white" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                            <i class="fe fe-sliders me-1"></i> Filter <span class="badge bg-primary ms-1 d-none">0</span>--}}
{{--                                        </button>--}}

{{--                                        <!-- Menu -->--}}
{{--                                        <form class="dropdown-menu dropdown-menu-end dropdown-menu-card">--}}
{{--                                            <div class="card-header">--}}

{{--                                                <!-- Title -->--}}
{{--                                                <h4 class="card-header-title">--}}
{{--                                                    Filters--}}
{{--                                                </h4>--}}

{{--                                                <!-- Link -->--}}
{{--                                                <button class="btn btn-sm btn-link text-reset d-none" type="reset">--}}
{{--                                                    <small>Clear filters</small>--}}
{{--                                                </button>--}}

{{--                                            </div>--}}
{{--                                            <div class="card-body">--}}

{{--                                                <!-- List group -->--}}
{{--                                                <div class="list-group list-group-flush mt-n4 mb-4">--}}
{{--                                                    <div class="list-group-item">--}}
{{--                                                        <div class="row">--}}
{{--                                                            <div class="col">--}}

{{--                                                                <!-- Text -->--}}
{{--                                                                <small>Title</small>--}}

{{--                                                            </div>--}}
{{--                                                            <div class="col-auto">--}}

{{--                                                                <!-- Select -->--}}
{{--                                                                <select class="form-select form-select-sm" name="item-title" data-choices='{"searchEnabled": false}'>--}}
{{--                                                                    <option value="*" selected>Any</option>--}}
{{--                                                                    <option value="Designer">Designer</option>--}}
{{--                                                                    <option value="Developer">Developer</option>--}}
{{--                                                                    <option value="Owner">Owner</option>--}}
{{--                                                                    <option value="Founder">Founder</option>--}}
{{--                                                                </select>--}}

{{--                                                            </div>--}}
{{--                                                        </div> <!-- / .row -->--}}
{{--                                                    </div>--}}
{{--                                                    <div class="list-group-item">--}}
{{--                                                        <div class="row">--}}
{{--                                                            <div class="col">--}}

{{--                                                                <!-- Text -->--}}
{{--                                                                <small>Lead scrore</small>--}}

{{--                                                            </div>--}}
{{--                                                            <div class="col-auto">--}}

{{--                                                                <!-- Select -->--}}
{{--                                                                <select class="form-select form-select-sm" name="item-roles" data-choices='{"searchEnabled": false}'>--}}
{{--                                                                    <option value="*" selected>Any</option>--}}
{{--                                                                    <option value="1/10">1+</option>--}}
{{--                                                                    <option value="2/10">2+</option>--}}
{{--                                                                    <option value="3/10">3+</option>--}}
{{--                                                                    <option value="4/10">4+</option>--}}
{{--                                                                    <option value="5/10">5+</option>--}}
{{--                                                                    <option value="6/10">6+</option>--}}
{{--                                                                    <option value="7/10">7+</option>--}}
{{--                                                                    <option value="8/10">8+</option>--}}
{{--                                                                    <option value="9/10">9+</option>--}}
{{--                                                                    <option value="10/10">10</option>--}}
{{--                                                                </select>--}}

{{--                                                            </div>--}}
{{--                                                        </div> <!-- / .row -->--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                                <!-- Button -->--}}
{{--                                                <button class="btn w-100 btn-primary" type="submit">--}}
{{--                                                    Apply filter--}}
{{--                                                </button>--}}

{{--                                            </div>--}}
{{--                                        </form>--}}

{{--                                    </div>--}}

{{--                                </div>--}}
{{--                            </div> <!-- / .row -->--}}

{{--                            <!-- Body -->--}}
{{--                            <div class="list row">--}}
{{--                                @foreach($users as $key => $user)--}}
{{--                                <div class="col-12 col-md-6 col-xl-4">--}}

{{--                                    <!-- Card -->--}}
{{--                                    <div class="card">--}}
{{--                                        <div class="card-body">--}}

{{--                                            <!-- Header -->--}}
{{--                                            <div class="row align-items-center">--}}
{{--                                                <div class="col">--}}

{{--                                                    <!-- Checkbox -->--}}
{{--                                                    <div class="form-check form-check-circle">--}}
{{--                                                        <input class="form-check-input list-checkbox" type="checkbox" id="cardsCheckboxOne">--}}
{{--                                                        <label class="form-check-label" for="cardsCheckboxOne"></label>--}}
{{--                                                        <input class="form-check-input list-checkbox" name="list-checkbox" id="cardsCheckboxOne-{{ $user->id }}" value="{{ $user->id }}" type="checkbox" >--}}
{{--                                                        <label class="form-check-label" for="cardsCheckboxOne-{{ $user->id }}"></label>--}}
{{--                                                    </div>--}}

{{--                                                </div>--}}
{{--                                                <div class="col-auto">--}}

{{--                                                    <!-- Dropdown -->--}}
{{--                                                    <div class="dropdown">--}}
{{--                                                        <a href="#" class="dropdown-ellipses dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                                            <i class="fe fe-more-vertical"></i>--}}
{{--                                                        </a>--}}
{{--                                                        <div class="dropdown-menu dropdown-menu-end">--}}
{{--                                                            @can('user_show')--}}
{{--                                                                <a class="dropdown-item" href="{{ route('admin.admins.show', $user->id) }}">--}}
{{--                                                                    {{ trans('global.view') }}--}}
{{--                                                                </a>--}}
{{--                                                            @endcan--}}

{{--                                                            @can('user_edit')--}}
{{--                                                                <a class="dropdown-item" href="{{ route('admin.admins.edit', $user->id) }}">--}}
{{--                                                                    {{ trans('global.edit') }}--}}
{{--                                                                </a>--}}
{{--                                                            @endcan--}}

{{--                                                            @can('user_delete')--}}
{{--                                                                <form action="{{ route('admin.admins.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">--}}
{{--                                                                    <input type="hidden" name="_method" value="DELETE">--}}
{{--                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--                                                                    <input type="submit" class="dropdown-item" value="{{ trans('global.delete') }}">--}}
{{--                                                                </form>--}}
{{--                                                            @endcan--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                </div>--}}
{{--                                            </div> <!-- / .row -->--}}

{{--                                            <!-- Image -->--}}

{{--                                            @if($user->profileimage)--}}
{{--                                                <a href="{{ $user->profileimage->getUrl() }}" target="_blank" class="avatar avatar-xl card-avatar">--}}
{{--                                                    <img src="{{ $user->profileimage->getUrl('thumb') }}" class="avatar-img rounded-circle" alt="...">--}}
{{--                                                </a>--}}
{{--                                            @else--}}
{{--                                                <a href="{{ route('admin.users.show', $user->id) }}" class="avatar avatar-xl card-avatar">--}}
{{--                                                    <img src="{{asset('assets/img/avatars/profiles/'.($user->gender==='female'?'woman.png':'man.png'))}}" class="avatar-img rounded-circle" alt="...">--}}
{{--                                                </a>--}}
{{--                                            @endif--}}

{{--                                            <!-- Body -->--}}
{{--                                            <div class="text-center mb-5">--}}

{{--                                                <!-- Heading -->--}}
{{--                                                <h2 class="card-title">--}}
{{--                                                    <a class="item-name" href="profile-posts.html">Dianna Smiley</a>--}}
{{--                                                    <a class="item-name " href="{{ route('admin.users.show', $user->id) }}">{{ $user->name ?$user->name.' '.$user->lastname: '' }}</a>--}}

{{--                                                </h2>--}}

{{--                                                <!-- Text -->--}}
{{--                                                <p class="small text-muted mb-3">--}}
{{--                                                    <span class="item-title">Designer</span> at <span class="item-company">Twitter</span>--}}
{{--                                                </p>--}}

{{--                                                <!-- Buttons -->--}}
{{--                                                <a class="btn btn-sm btn-white" href="tel:{{$user->phone}}">--}}
{{--                                                    <i class="fe fe-phone me-1"></i> Call--}}
{{--                                                </a>--}}
{{--                                                <a class="btn btn-sm btn-white" href="mailto:{{$user->email}}">--}}
{{--                                                    <i class="fe fe-mail me-1"></i> Email--}}
{{--                                                </a>--}}

{{--                                            </div>--}}

{{--                                            <!-- Divider -->--}}
{{--                                            <hr class="card-divider mb-0">--}}

{{--                                            <!-- List group -->--}}
{{--                                            <div class="list-group list-group-flush mb-n3">--}}
{{--                                                <div class="list-group-item">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col">--}}

{{--                                                            <!-- Text -->--}}
{{--                                                            <small>Role</small>--}}

{{--                                                        </div>--}}
{{--                                                        <div class="col-auto">--}}

{{--                                                            <!-- Text -->--}}
{{--                                                            <small>Twitter</small>--}}

{{--                                                        </div>--}}
{{--                                                    </div> <!-- / .row -->--}}
{{--                                                </div>--}}
{{--                                                <div class="list-group-item">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col">--}}

{{--                                                            <!-- Text -->--}}
{{--                                                            <small>Role</small>--}}

{{--                                                        </div>--}}
{{--                                                        <div class="col-auto">--}}

{{--                                                            <!-- Badge -->--}}
{{--                                                            @foreach($user->roles as $key => $item)--}}

{{--                                                                <span class="item-roles badge bg-info-soft">{{ $item->title }}</span>--}}
{{--                                                            @endforeach--}}

{{--                                                        </div>--}}
{{--                                                    </div> <!-- / .row -->--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}

{{--                            <!-- Pagination -->--}}
{{--                            <div class="row g-0">--}}

{{--                                <!-- Pagination (prev) -->--}}
{{--                                <ul class="col list-pagination-prev pagination pagination-tabs justify-content-start">--}}
{{--                                    <li class="page-item">--}}
{{--                                        <a class="page-link" href="#">--}}
{{--                                            <i class="fe fe-arrow-left me-1"></i> Prev--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}

{{--                                <!-- Pagination -->--}}
{{--                                <ul class="col list-pagination pagination pagination-tabs justify-content-center"></ul>--}}

{{--                                <!-- Pagination (next) -->--}}
{{--                                <ul class="col list-pagination-next pagination pagination-tabs justify-content-end">--}}
{{--                                    <li class="page-item">--}}
{{--                                        <a class="page-link" href="#">--}}
{{--                                            Next <i class="fe fe-arrow-right ms-1"></i>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}

{{--                            </div>--}}

{{--                            <!-- Alert -->--}}
{{--                            <div class="list-alert alert alert-dark alert-dismissible border fade" role="alert">--}}

{{--                                <!-- Content -->--}}
{{--                                <div class="row align-items-center">--}}
{{--                                    <div class="col">--}}

{{--                                        <!-- Checkbox -->--}}
{{--                                        <div class="form-check">--}}
{{--                                            <input class="form-check-input" id="cardAlertCheckbox" type="checkbox" checked disabled>--}}
{{--                                            <label class="form-check-label text-white" for="cardAlertCheckbox">--}}
{{--                                                <span class="list-alert-count">0</span> Admin User(s)--}}
{{--                                            </label>--}}
{{--                                        </div>--}}

{{--                                    </div>--}}
{{--                                    <div class="col-auto me-n3">--}}

{{--                                        <!-- Button -->--}}
{{--                                        <button class="btn btn-sm btn-white-20">--}}
{{--                                            Edit--}}
{{--                                        </button>--}}

{{--                                        <!-- Button -->--}}
{{--                                        <button class="btn btn-sm btn-white-20"  onclick="delete_selected()">--}}
{{--                                            Delete--}}
{{--                                        </button>--}}

{{--                                    </div>--}}
{{--                                </div> <!-- / .row -->--}}

{{--                                <!-- Close -->--}}
{{--                                <button type="button" class="list-alert-close btn-close" aria-label="Close">--}}

{{--                                </button>--}}

{{--                            </div>--}}

{{--                        </div>--}}

{{--                    </div>--}}
                </div>
                </div>

            </div>
        </div> <!-- / .row -->
    </div>
@endsection
@section('scripts')
    <script>
        var route="{{ route('admin.users.massDestroy') }}";
    </script>
    @parent
    <script>
        function export_data_(type){
            var ids=[];
            $("input:checkbox[name=list-checkbox]:checked").each(function(){
                ids.push($(this).val());
            });
            {{--var downloadLink = document.createElement("a");--}}
            {{--downloadLink.attr--}}
            var url='{{route('admin.admins.export')}}?type='+type;

            if(ids.length>0){
               url+='&ids='+ids;
            }
            window.open(url, "_blank", "noopener,noreferrer");
        }
        function edit_selected(){
            var ids=[];
            $("input:checkbox[name=list-checkbox]:checked").each(function(){
                ids.push($(this).val());
            });
            console.debug(ids);
        }
        function delete_selected(){
            var ids=[];
            $("input:checkbox[name=list-checkbox]:checked").each(function(){
                ids.push($(this).val());
            });
            console.debug(ids);
            if(ids.length>0){
                if (confirm('{{ trans('global.areYouSure') }}')) {
                    $.ajax({
                        headers: {'x-csrf-token': _token},
                        method: 'POST',
                        url: route,
                        data: { ids: ids, _method: 'DELETE' }})
                        .done(function () { location.reload() })
                }
            }

        }
    </script>
@endsection

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('panel.site_title') }}</title>
{{--    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />--}}
<!-- Map CSS -->
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css" />

    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/libs.bundle.css') }}" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/theme.bundle.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
{{--    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />--}}
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
{{--     <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />--}}
{{--    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />--}}
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
{{--    <link href="https://unpkg.com/@coreui/coreui@3.2/dist/css/coreui.min.css" rel="stylesheet" />--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/favicon/favicon.ico') }}" type="image/x-icon"/>
    <script>
        window._token='{{csrf_token()}}';
    </script>
    <style>
        .table{
            width: 100%;
        }
        .w-10{
            width: 9%!important;
        }
        .white-spaces-normal{
            white-space: normal;
        }
        @media only print {
            .no-print {
                display:none;
            }
            .print{
            display: block;
             }
        }
    </style>
    @yield('styles')
</head>

<body class="c-app">
<!-- MODALS -->
<!-- Modal: Members -->
<div class="modal fade" id="modalMembers" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-card card" data-list='{"valueNames": ["name"]}'>
                <div class="card-header">

                    <!-- Title -->
                    <h4 class="card-header-title" id="exampleModalCenterTitle">
                        Add a member
                    </h4>

                    <!-- Close -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="card-header">

                    <!-- Form -->
                    <form>
                        <div class="input-group input-group-flush input-group-merge input-group-reverse">
                            <input class="form-control list-search" type="search" placeholder="Search">
                            <div class="input-group-text">
                                <span class="fe fe-search"></span>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="card-body">

                    <!-- List group -->
                    <ul class="list-group list-group-flush list my-n3">
                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-auto">

                                    <!-- Avatar -->
                                    <a href="./profile-posts.html" class="avatar">
                                        <img src="{{asset('assets/img/avatars/profiles/avatar-5.jpg')}}" alt="..." class="avatar-img rounded-circle">
                                    </a>

                                </div>
                                <div class="col ms-n2">

                                    <!-- Title -->
                                    <h4 class="mb-1 name">
                                        <a href="./profile-posts.html">Miyah Myles</a>
                                    </h4>

                                    <!-- Time -->
                                    <p class="small mb-0">
                                        <span class="text-success">●</span> Online
                                    </p>

                                </div>
                                <div class="col-auto">

                                    <!-- Button -->
                                    <a href="#!" class="btn btn-sm btn-white">
                                        Add
                                    </a>

                                </div>
                            </div> <!-- / .row -->
                        </li>
                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-auto">

                                    <!-- Avatar -->
                                    <a href="./profile-posts.html" class="avatar">
                                        <img src="{{asset('assets/img/avatars/profiles/avatar-6.jpg')}}" alt="..." class="avatar-img rounded-circle">
                                    </a>

                                </div>
                                <div class="col ms-n2">

                                    <!-- Title -->
                                    <h4 class="mb-1 name">
                                        <a href="./profile-posts.html">Ryu Duke</a>
                                    </h4>

                                    <!-- Time -->
                                    <p class="small mb-0">
                                        <span class="text-success">●</span> Online
                                    </p>

                                </div>
                                <div class="col-auto">

                                    <!-- Button -->
                                    <a href="#!" class="btn btn-sm btn-white">
                                        Add
                                    </a>

                                </div>
                            </div> <!-- / .row -->
                        </li>
                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-auto">

                                    <!-- Avatar -->
                                    <a href="./profile-posts.html" class="avatar">
                                        <img src="{{asset('assets/img/avatars/profiles/avatar-7.jpg')}}" alt="..." class="avatar-img rounded-circle">
                                    </a>

                                </div>
                                <div class="col ms-n2">

                                    <!-- Title -->
                                    <h4 class="mb-1 name">
                                        <a href="./profile-posts.html">Glen Rouse</a>
                                    </h4>

                                    <!-- Time -->
                                    <p class="small mb-0">
                                        <span class="text-warning">●</span> Busy
                                    </p>

                                </div>
                                <div class="col-auto">

                                    <!-- Button -->
                                    <a href="#!" class="btn btn-sm btn-white">
                                        Add
                                    </a>

                                </div>
                            </div> <!-- / .row -->
                        </li>
                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-auto">

                                    <!-- Avatar -->
                                    <a href="./profile-posts.html" class="avatar">
                                        <img src="{{asset('assets/img/avatars/profiles/avatar-8.jpg')}}" alt="..." class="avatar-img rounded-circle">
                                    </a>

                                </div>
                                <div class="col ms-n2">

                                    <!-- Title -->
                                    <h4 class="mb-1 name">
                                        <a href="./profile-posts.html">Grace Gross</a>
                                    </h4>

                                    <!-- Time -->
                                    <p class="small mb-0">
                                        <span class="text-danger">●</span> Offline
                                    </p>

                                </div>
                                <div class="col-auto">

                                    <!-- Button -->
                                    <a href="#!" class="btn btn-sm btn-white">
                                        Add
                                    </a>

                                </div>
                            </div> <!-- / .row -->
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Kanban task -->
<div class="modal fade" id="modalKanbanTask" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-lighter">
            <div class="modal-body">

                <!-- Header -->
                <div class="row">
                    <div class="col">

                        <!-- Prettitle -->
                        <h6 class="text-uppercase text-muted mb-3">
                            <a href="#!" class="text-reset">How to Use Kanban</a>
                        </h6>

                        <!-- Title -->
                        <h2 class="mb-2">
                            Update Dashkit to include new components!
                        </h2>

                        <!-- Subtitle -->
                        <p class="text-muted mb-0">
                            This is a description of this task. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum magna nisi, ultrices ut pharetra eget.
                        </p>

                    </div>
                    <div class="col-auto">

                        <!-- Close -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                </div> <!-- / .row -->

                <!-- Divider -->
                <hr class="my-4">

                <!-- Buttons -->
                <div class="mb-4">
                    <div class="row">
                        <div class="col">

                            <!-- Reaction -->
                            <a href="#!" class="btn btn-sm btn-white">
                                😬 1
                            </a>
                            <a href="#!" class="btn btn-sm btn-white">
                                👍 2
                            </a>
                            <a href="#!" class="btn btn-sm btn-white">
                                Add Reaction
                            </a>

                        </div>
                        <div class="col-auto me-n3">

                            <!-- Avatar group -->
                            <div class="avatar-group d-none d-sm-flex">
                                <a href="./profile-posts.html" class="avatar avatar-xs" data-bs-toggle="tooltip" title="Ab Hadley">
                                    <img src="{{asset('assets/img/avatars/profiles/avatar-2.jpg')}}" alt="..." class="avatar-img rounded-circle">
                                </a>
                                <a href="./profile-posts.html" class="avatar avatar-xs" data-bs-toggle="tooltip" title="Adolfo Hess">
                                    <img src="{{asset('assets/img/avatars/profiles/avatar-3.jpg')}}" alt="..." class="avatar-img rounded-circle">
                                </a>
                                <a href="./profile-posts.html" class="avatar avatar-xs" data-bs-toggle="tooltip" title="Daniela Dewitt">
                                    <img src="{{asset('assets/img/avatars/profiles/avatar-4.jpg')}}" alt="..." class="avatar-img rounded-circle">
                                </a>
                                <a href="./profile-posts.html" class="avatar avatar-xs" data-bs-toggle="tooltip" title="Miyah Myles">
                                    <img src="{{asset('assets/img/avatars/profiles/avatar-5.jpg')}}" alt="..." class="avatar-img rounded-circle">
                                </a>
                            </div>

                        </div>
                        <div class="col-auto">

                            <!-- Button -->
                            <a href="#!" class="btn btn-sm btn-white">
                                Share
                            </a>

                        </div>
                    </div> <!-- / .row -->
                </div>

                <!-- Card -->
                <div class="card">
                    <div class="card-header">

                        <!-- Title -->
                        <h4 class="card-header-title">
                            Files
                        </h4>

                        <!-- Button -->
                        <a href="#!" class="btn btn-sm btn-white">
                            Add files
                        </a>

                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush my-n3">
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">

                                        <!-- Avatar -->
                                        <a href="./project-overview.html" class="avatar">
                                            <img src="{{asset('assets/img/files/file-1.jpg')}}" alt="..." class="avatar-img rounded">
                                        </a>

                                    </div>
                                    <div class="col ms-n2">

                                        <!-- Title -->
                                        <h4 class="mb-1">
                                            <a href="./project-overview.html">Launchday logo</a>
                                        </h4>

                                        <!-- Time -->
                                        <p class="card-text small text-muted">
                                            1.5mb PNG Dave
                                        </p>

                                    </div>
                                    <div class="col-auto">

                                        <!-- Dropdown -->
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-ellipses dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fe fe-more-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#!" class="dropdown-item">
                                                    Action
                                                </a>
                                                <a href="#!" class="dropdown-item">
                                                    Another action
                                                </a>
                                                <a href="#!" class="dropdown-item">
                                                    Something else here
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div> <!-- / .row -->
                            </div>
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">

                                        <!-- Avatar -->
                                        <a href="./project-overview.html" class="avatar">
                                            <img src="{{asset('assets/img/files/file-1.jpg')}}" alt="..." class="avatar-img rounded">
                                        </a>

                                    </div>
                                    <div class="col ms-n2">

                                        <!-- Title -->
                                        <h4 class="mb-1">
                                            <a href="./project-overview.html">Launchday logo</a>
                                        </h4>

                                        <!-- Time -->
                                        <p class="card-text small text-muted">
                                            1.5mb PNG Dave
                                        </p>

                                    </div>
                                    <div class="col-auto">

                                        <!-- Dropdown -->
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-ellipses dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fe fe-more-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#!" class="dropdown-item">
                                                    Action
                                                </a>
                                                <a href="#!" class="dropdown-item">
                                                    Another action
                                                </a>
                                                <a href="#!" class="dropdown-item">
                                                    Something else here
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div> <!-- / .row -->
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Card -->
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm">
                                    <img class="avatar-img rounded-circle" src="{{asset('assets/img/avatars/profiles/avatar-1.jpg')}}" alt="...">
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Form -->
                                <form class="mt-1">
                                    <textarea class="form-control form-control-flush form-control" data-autosize rows="1" placeholder="Leave a comment"></textarea>
                                </form>

                            </div>
                            <div class="col-auto align-self-end">

                                <!-- Icons -->
                                <div class="text-muted mb-2">
                                    <a href="#!" class="text-reset me-3">
                                        <i class="fe fe-camera"></i>
                                    </a>
                                    <a href="#!" class="text-reset me-3">
                                        <i class="fe fe-paperclip"></i>
                                    </a>
                                    <a href="#!" class="text-reset">
                                        <i class="fe fe-mic"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <!-- Comments -->
                        <div class="comment mb-3">
                            <div class="row">
                                <div class="col-auto">

                                    <!-- Avatar -->
                                    <a class="avatar avatar-sm" href="./profile-posts.html">
                                        <img src="{{asset('assets/img/avatars/profiles/avatar-2.jpg')}}" alt="..." class="avatar-img rounded-circle">
                                    </a>

                                </div>
                                <div class="col ms-n2">

                                    <!-- Body -->
                                    <div class="comment-body">

                                        <div class="row">
                                            <div class="col">

                                                <!-- Title -->
                                                <h5 class="comment-title">
                                                    Ab Hadley
                                                </h5>

                                            </div>
                                            <div class="col-auto">

                                                <!-- Time -->
                                                <time class="comment-time">
                                                    11:12
                                                </time>

                                            </div>
                                        </div> <!-- / .row -->

                                        <!-- Text -->
                                        <p class="comment-text">
                                            Looking good Dianna! I like the image grid on the left, but it feels like a lot to process and doesn't really <em>show</em> me what the product does? I think using a short looping video or something similar demo'ing the product might be better?
                                        </p>

                                    </div>

                                </div>
                            </div> <!-- / .row -->
                        </div>
                        <div class="comment">
                            <div class="row">
                                <div class="col-auto">

                                    <!-- Avatar -->
                                    <a class="avatar avatar-sm" href="./profile-posts.html">
                                        <img src="{{asset('assets/img/avatars/profiles/avatar-3.jpg')}}" alt="..." class="avatar-img rounded-circle">
                                    </a>

                                </div>
                                <div class="col ms-n2">

                                    <!-- Body -->
                                    <div class="comment-body">

                                        <div class="row">
                                            <div class="col">

                                                <!-- Title -->
                                                <h5 class="comment-title">
                                                    Adolfo Hess
                                                </h5>

                                            </div>
                                            <div class="col-auto">

                                                <!-- Time -->
                                                <time class="comment-time">
                                                    11:12
                                                </time>

                                            </div>
                                        </div> <!-- / .row -->

                                        <!-- Text -->
                                        <p class="comment-text">
                                            Any chance you're going to link the grid up to a public gallery of sites built with Launchday?
                                        </p>

                                    </div>

                                </div>
                            </div> <!-- / .row -->
                        </div>

                    </div>
                </div>

                <!-- Card -->
                <div class="card mb-0">
                    <div class="card-header">

                        <!-- Title -->
                        <h4 class="card-header-title">
                            Activity
                        </h4>

                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush list-group-activity my-n3">
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-auto">

                                        <!-- Avatar -->
                                        <div class="avatar avatar-sm">
                                            <img class="avatar-img rounded-circle" src="{{asset('assets/img/avatars/profiles/avatar-1.jpg')}}" alt="...">
                                        </div>

                                    </div>
                                    <div class="col ms-n2">

                                        <!-- Heading -->
                                        <h5 class="mb-1">
                                            Johnathan Goldstein
                                        </h5>

                                        <!-- Text -->
                                        <p class="small text-gray-700 mb-0">
                                            Uploaded the files “Launchday Logo” and “Revisiting the Past”.
                                        </p>

                                        <!-- Time -->
                                        <small class="text-muted">
                                            2m ago
                                        </small>

                                    </div>
                                </div> <!-- / .row -->
                            </div>
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-auto">

                                        <!-- Avatar -->
                                        <div class="avatar avatar-sm">
                                            <img class="avatar-img rounded-circle" src="{{asset('assets/img/avatars/profiles/avatar-1.jpg')}}" alt="...">
                                        </div>

                                    </div>
                                    <div class="col ms-n2">

                                        <!-- Heading -->
                                        <h5 class="mb-1">
                                            Johnathan Goldstein
                                        </h5>

                                        <!-- Text -->
                                        <p class="small text-gray-700 mb-0">
                                            Uploaded the files “Launchday Logo” and “Revisiting the Past”.
                                        </p>

                                        <!-- Time -->
                                        <small class="text-muted">
                                            2m ago
                                        </small>

                                    </div>
                                </div> <!-- / .row -->
                            </div>
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-auto">

                                        <!-- Avatar -->
                                        <div class="avatar avatar-sm">
                                            <img class="avatar-img rounded-circle" src="{{asset('assets/img/avatars/profiles/avatar-1.jpg')}}" alt="...">
                                        </div>

                                    </div>
                                    <div class="col ms-n2">

                                        <!-- Heading -->
                                        <h5 class="mb-1">
                                            Johnathan Goldstein
                                        </h5>

                                        <!-- Text -->
                                        <p class="small text-gray-700 mb-0">
                                            Uploaded the files “Launchday Logo” and “Revisiting the Past”.
                                        </p>

                                        <!-- Time -->
                                        <small class="text-muted">
                                            2m ago
                                        </small>

                                    </div>
                                </div> <!-- / .row -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal: Kanban task empty -->
<div class="modal fade" id="modalKanbanTaskEmpty" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-lighter">
            <div class="modal-body">

                <!-- Header -->
                <div class="row">
                    <div class="col">

                        <!-- Prettitle -->
                        <h6 class="text-uppercase text-muted mb-3">
                            <a href="#!" class="text-reset">How to Use Kanban</a>
                        </h6>

                        <!-- Title -->
                        <h2 class="mb-2">
                            Update Dashkit to include new components!
                        </h2>

                        <!-- Subtitle -->
                        <textarea class="form-control form-control-flush form-control-auto" data-autosize rows="1" placeholder="Add a description..."></textarea>

                    </div>
                    <div class="col-auto">

                        <!-- Close -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                </div> <!-- / .row -->

                <!-- Divider -->
                <hr class="my-4">

                <!-- Buttons -->
                <div class="mb-4">
                    <div class="row">
                        <div class="col">

                            <!-- Button -->
                            <a href="#!" class="btn btn-sm btn-white">
                                Add Reaction
                            </a>

                        </div>
                        <div class="col-auto">

                            <!-- Button -->
                            <a href="#!" class="btn btn-sm btn-white">
                                Share
                            </a>

                        </div>
                    </div> <!-- / .row -->
                </div>

                <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="dropzone dropzone-multiple" data-dropzone='{"url": "https://"}'>

                            <!-- Fallback -->
                            <div class="fallback">
                                <div class="form-group">
                                    <label class="form-label" for="customFileUpload">Choose file</label>
                                    <input class="form-control" type="file" id="customFileUpload" multiple>
                                </div>
                            </div>

                            <!-- Preview -->
                            <ul class="dz-preview dz-preview-multiple list-group list-group-lg list-group-flush">
                                <li class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto">

                                            <!-- Image -->
                                            <div class="avatar">
                                                <img class="avatar-img rounded" src="data:image/svg+xml,%3csvg3c/svg%3e" alt="..." data-dz-thumbnail>
                                            </div>

                                        </div>
                                        <div class="col ms-n3">

                                            <!-- Heading -->
                                            <h4 class="mb-1" data-dz-name>...</h4>

                                            <!-- Text -->
                                            <small class="text-muted" data-dz-size></small>

                                        </div>
                                        <div class="col-auto">

                                            <!-- Dropdown -->
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-ellipses dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fe fe-more-vertical"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="#" class="dropdown-item" data-dz-remove>
                                                        Remove
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>

                <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm">
                                    <img class="avatar-img rounded-circle" src="{{asset('assets/img/avatars/profiles/avatar-1.jpg')}}" alt="...">
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Form -->
                                <form class="mt-1">
                                    <textarea class="form-control form-control-flush" data-autosize rows="1" placeholder="Leave a comment"></textarea>
                                </form>

                            </div>
                            <div class="col-auto align-self-end">

                                <!-- Icons -->
                                <div class="text-muted mb-2">
                                    <a href="#!" class="text-reset me-3">
                                        <i class="fe fe-camera"></i>
                                    </a>
                                    <a href="#!" class="text-reset me-3">
                                        <i class="fe fe-paperclip"></i>
                                    </a>
                                    <a href="#!" class="text-reset">
                                        <i class="fe fe-mic"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- OFFCANVAS -->

<!-- Offcanvas: Search -->
<div class="offcanvas offcanvas-start" id="sidebarOffcanvasSearch" tabindex="-1">
    <div class="offcanvas-body" data-list='{"valueNames": ["name"]}'>

        <!-- Form -->
        <form class="mb-4">
            <div class="input-group input-group-merge input-group-rounded input-group-reverse">
                <input class="form-control list-search" type="search" placeholder="Search">
                <div class="input-group-text">
                    <span class="fe fe-search"></span>
                </div>
            </div>
        </form>

        <!-- List group -->
        <div class="my-n3">
            <div class="list-group list-group-flush list-group-focus list">
                <a class="list-group-item" href="./team-overview.html">
                    <div class="row align-items-center">
                        <div class="col-auto">

                            <!-- Avatar -->
                            <div class="avatar">
                                <img src="{{asset('assets/img/avatars/teams/team-logo-1.jpg')}}" alt="..." class="avatar-img rounded">
                            </div>

                        </div>
                        <div class="col ms-n2">

                            <!-- Title -->
                            <h4 class="text-body text-focus mb-1 name">
                                Airbnb
                            </h4>

                            <!-- Time -->
                            <p class="small text-muted mb-0">
                                <span class="fe fe-clock"></span> <time datetime="2018-05-24">Updated 2hr ago</time>
                            </p>

                        </div>
                    </div> <!-- / .row -->
                </a>
                <a class="list-group-item" href="./team-overview.html">
                    <div class="row align-items-center">
                        <div class="col-auto">

                            <!-- Avatar -->
                            <div class="avatar">{{asset('')}}
                                <img src="{{asset('assets/img/avatars/teams/team-logo-2.jpg')}}" alt="..." class="avatar-img rounded">
                            </div>

                        </div>
                        <div class="col ms-n2">

                            <!-- Title -->
                            <h4 class="text-body text-focus mb-1 name">
                                Medium Corporation
                            </h4>

                            <!-- Time -->
                            <p class="small text-muted mb-0">
                                <span class="fe fe-clock"></span> <time datetime="2018-05-24">Updated 2hr ago</time>
                            </p>

                        </div>
                    </div> <!-- / .row -->
                </a>
                <a class="list-group-item" href="./project-overview.html">
                    <div class="row align-items-center">
                        <div class="col-auto">

                            <!-- Avatar -->
                            <div class="avatar avatar-4by3">
                                <img src="{{asset('assets/img/avatars/projects/project-1.jpg')}}" alt="..." class="avatar-img rounded">
                            </div>

                        </div>
                        <div class="col ms-n2">

                            <!-- Title -->
                            <h4 class="text-body text-focus mb-1 name">
                                Homepage Redesign
                            </h4>

                            <!-- Time -->
                            <p class="small text-muted mb-0">
                                <span class="fe fe-clock"></span> <time datetime="2018-05-24">Updated 4hr ago</time>
                            </p>

                        </div>
                    </div> <!-- / .row -->
                </a>
                <a class="list-group-item" href="./project-overview.html">
                    <div class="row align-items-center">
                        <div class="col-auto">

                            <!-- Avatar -->
                            <div class="avatar avatar-4by3">
                                <img src="{{asset('assets/img/avatars/projects/project-2.jpg')}}" alt="..." class="avatar-img rounded">
                            </div>

                        </div>
                        <div class="col ms-n2">

                            <!-- Title -->
                            <h4 class="text-body text-focus mb-1 name">
                                Travels & Time
                            </h4>

                            <!-- Time -->
                            <p class="small text-muted mb-0">
                                <span class="fe fe-clock"></span> <time datetime="2018-05-24">Updated 4hr ago</time>
                            </p>

                        </div>
                    </div> <!-- / .row -->
                </a>
                <a class="list-group-item" href="./project-overview.html">
                    <div class="row align-items-center">
                        <div class="col-auto">

                            <!-- Avatar -->
                            <div class="avatar avatar-4by3">
                                <img src="{{asset('assets/img/avatars/projects/project-3.jpg')}}" alt="..." class="avatar-img rounded">
                            </div>

                        </div>
                        <div class="col ms-n2">

                            <!-- Title -->
                            <h4 class="text-body text-focus mb-1 name">
                                Safari Exploration
                            </h4>

                            <!-- Time -->
                            <p class="small text-muted mb-0">
                                <span class="fe fe-clock"></span> <time datetime="2018-05-24">Updated 4hr ago</time>
                            </p>

                        </div>
                    </div> <!-- / .row -->
                </a>
                <a class="list-group-item" href="./profile-posts.html">
                    <div class="row align-items-center">
                        <div class="col-auto">

                            <!-- Avatar -->
                            <div class="avatar">
                                <img src="{{asset('assets/img/avatars/profiles/avatar-1.jpg')}}" alt="..." class="avatar-img rounded-circle">
                            </div>

                        </div>
                        <div class="col ms-n2">

                            <!-- Title -->
                            <h4 class="text-body text-focus mb-1 name">
                                Dianna Smiley
                            </h4>

                            <!-- Status -->
                            <p class="text-body small mb-0">
                                <span class="text-success">●</span> Online
                            </p>

                        </div>
                    </div> <!-- / .row -->
                </a>
                <a class="list-group-item" href="./profile-posts.html">
                    <div class="row align-items-center">
                        <div class="col-auto">

                            <!-- Avatar -->
                            <div class="avatar">
                                <img src="{{asset('assets/img/avatars/profiles/avatar-2.jpg')}}" alt="..." class="avatar-img rounded-circle">
                            </div>

                        </div>
                        <div class="col ms-n2">

                            <!-- Title -->
                            <h4 class="text-body text-focus mb-1 name">
                                Ab Hadley
                            </h4>

                            <!-- Status -->
                            <p class="text-body small mb-0">
                                <span class="text-danger">●</span> Offline
                            </p>

                        </div>
                    </div> <!-- / .row -->
                </a>
            </div>
        </div>

    </div>
</div>

<!-- Offcanvas: Activity -->
<div class="offcanvas offcanvas-start" id="sidebarOffcanvasActivity" tabindex="-1">
    <div class="offcanvas-header">

        <!-- Title -->
        <h4 class="offcanvas-title">
            Notifications
        </h4>

        <!-- Navs -->
        <ul class="nav nav-tabs nav-tabs-sm modal-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#modalActivityAction">Action</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#modalActivityUser">User</a>
            </li>
        </ul>

    </div>
    <div class="offcanvas-body">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="modalActivityAction">

                <!-- List group -->
                <div class="list-group list-group-flush list-group-activity my-n3">
                    <a class="list-group-item text-reset" href="#!">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm">
                                    <div class="avatar-title fs-lg bg-primary-soft rounded-circle text-primary">
                                        <i class="fe fe-mail"></i>
                                    </div>
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Heading -->
                                <h5 class="mb-1">
                                    Launchday 1.4.0 update email sent
                                </h5>

                                <!-- Text -->
                                <p class="small text-gray-700 mb-0">
                                    Sent to all 1,851 subscribers over a 24 hour period
                                </p>

                                <!-- Time -->
                                <small class="text-muted">
                                    2m ago
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </a>
                    <a class="list-group-item text-reset" href="#!">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm">
                                    <div class="avatar-title fs-lg bg-primary-soft rounded-circle text-primary">
                                        <i class="fe fe-archive"></i>
                                    </div>
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Heading -->
                                <h5 class="mb-1">
                                    New project "Goodkit" created
                                </h5>

                                <!-- Text -->
                                <p class="small text-gray-700 mb-0">
                                    Looks like there might be a new theme soon.
                                </p>

                                <!-- Time -->
                                <small class="text-muted">
                                    2h ago
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </a>
                    <a class="list-group-item text-reset" href="#!">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm">
                                    <div class="avatar-title fs-lg bg-primary-soft rounded-circle text-primary">
                                        <i class="fe fe-code"></i>
                                    </div>
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Heading -->
                                <h5 class="mb-1">
                                    Dashkit 1.5.0 was deployed.
                                </h5>

                                <!-- Text -->
                                <p class="small text-gray-700 mb-0">
                                    A successful to deploy to production was executed.
                                </p>

                                <!-- Time -->
                                <small class="text-muted">
                                    2m ago
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </a>
                    <a class="list-group-item text-reset" href="#!">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm">
                                    <div class="avatar-title fs-lg bg-primary-soft rounded-circle text-primary">
                                        <i class="fe fe-git-branch"></i>
                                    </div>
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Heading -->
                                <h5 class="mb-1">
                                    "Update Dependencies" branch was created.
                                </h5>

                                <!-- Text -->
                                <p class="small text-gray-700 mb-0">
                                    This branch was created off of the "master" branch.
                                </p>

                                <!-- Time -->
                                <small class="text-muted">
                                    2m ago
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </a>
                    <a class="list-group-item text-reset" href="#!">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm">
                                    <div class="avatar-title fs-lg bg-primary-soft rounded-circle text-primary">
                                        <i class="fe fe-mail"></i>
                                    </div>
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Heading -->
                                <h5 class="mb-1">
                                    Launchday 1.4.0 update email sent
                                </h5>

                                <!-- Text -->
                                <p class="small text-gray-700 mb-0">
                                    Sent to all 1,851 subscribers over a 24 hour period
                                </p>

                                <!-- Time -->
                                <small class="text-muted">
                                    2m ago
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </a>
                    <a class="list-group-item text-reset" href="#!">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm">
                                    <div class="avatar-title fs-lg bg-primary-soft rounded-circle text-primary">
                                        <i class="fe fe-archive"></i>
                                    </div>
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Heading -->
                                <h5 class="mb-1">
                                    New project "Goodkit" created
                                </h5>

                                <!-- Text -->
                                <p class="small text-gray-700 mb-0">
                                    Looks like there might be a new theme soon.
                                </p>

                                <!-- Time -->
                                <small class="text-muted">
                                    2h ago
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </a>
                    <a class="list-group-item text-reset" href="#!">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm">
                                    <div class="avatar-title fs-lg bg-primary-soft rounded-circle text-primary">
                                        <i class="fe fe-code"></i>
                                    </div>
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Heading -->
                                <h5 class="mb-1">
                                    Dashkit 1.5.0 was deployed.
                                </h5>

                                <!-- Text -->
                                <p class="small text-gray-700 mb-0">
                                    A successful to deploy to production was executed.
                                </p>

                                <!-- Time -->
                                <small class="text-muted">
                                    2m ago
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </a>
                    <a class="list-group-item text-reset" href="#!">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm">
                                    <div class="avatar-title fs-lg bg-primary-soft rounded-circle text-primary">
                                        <i class="fe fe-git-branch"></i>
                                    </div>
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Heading -->
                                <h5 class="mb-1">
                                    "Update Dependencies" branch was created.
                                </h5>

                                <!-- Text -->
                                <p class="small text-gray-700 mb-0">
                                    This branch was created off of the "master" branch.
                                </p>

                                <!-- Time -->
                                <small class="text-muted">
                                    2m ago
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </a>
                    <a class="list-group-item text-reset" href="#!">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm">
                                    <div class="avatar-title fs-lg bg-primary-soft rounded-circle text-primary">
                                        <i class="fe fe-mail"></i>
                                    </div>
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Heading -->
                                <h5 class="mb-1">
                                    Launchday 1.4.0 update email sent
                                </h5>

                                <!-- Text -->
                                <p class="small text-gray-700 mb-0">
                                    Sent to all 1,851 subscribers over a 24 hour period
                                </p>

                                <!-- Time -->
                                <small class="text-muted">
                                    2m ago
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </a>
                    <a class="list-group-item text-reset" href="#!">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm">
                                    <div class="avatar-title fs-lg bg-primary-soft rounded-circle text-primary">
                                        <i class="fe fe-archive"></i>
                                    </div>
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Heading -->
                                <h5 class="mb-1">
                                    New project "Goodkit" created
                                </h5>

                                <!-- Text -->
                                <p class="small text-gray-700 mb-0">
                                    Looks like there might be a new theme soon.
                                </p>

                                <!-- Time -->
                                <small class="text-muted">
                                    2h ago
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </a>
                    <a class="list-group-item text-reset" href="#!">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm">
                                    <div class="avatar-title fs-lg bg-primary-soft rounded-circle text-primary">
                                        <i class="fe fe-code"></i>
                                    </div>
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Heading -->
                                <h5 class="mb-1">
                                    Dashkit 1.5.0 was deployed.
                                </h5>

                                <!-- Text -->
                                <p class="small text-gray-700 mb-0">
                                    A successful to deploy to production was executed.
                                </p>

                                <!-- Time -->
                                <small class="text-muted">
                                    2m ago
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </a>
                    <a class="list-group-item text-reset" href="#!">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm">
                                    <div class="avatar-title fs-lg bg-primary-soft rounded-circle text-primary">
                                        <i class="fe fe-git-branch"></i>
                                    </div>
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Heading -->
                                <h5 class="mb-1">
                                    "Update Dependencies" branch was created.
                                </h5>

                                <!-- Text -->
                                <p class="small text-gray-700 mb-0">
                                    This branch was created off of the "master" branch.
                                </p>

                                <!-- Time -->
                                <small class="text-muted">
                                    2m ago
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </a>
                </div>

            </div>
            <div class="tab-pane fade" id="modalActivityUser">

                <!-- List group -->
                <div class="list-group list-group-flush list-group-activity my-n3">
                    <a class="list-group-item text-reset" href="#!">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm avatar-online">
                                    <img class="avatar-img rounded-circle" src="{{asset('assets/img/avatars/profiles/avatar-1.jpg')}}" alt="..." />
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Heading -->
                                <h5 class="mb-1">
                                    Dianna Smiley
                                </h5>

                                <!-- Text -->
                                <p class="small text-gray-700 mb-0">
                                    Uploaded the files "Launchday Logo" and "New Design".
                                </p>

                                <!-- Time -->
                                <small class="text-muted">
                                    2m ago
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </a>
                    <a class="list-group-item text-reset" href="#!">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm avatar-online">
                                    <img class="avatar-img rounded-circle" src="{{asset('assets/img/avatars/profiles/avatar-2.jpg')}}" alt="..." />
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Heading -->
                                <h5 class="mb-1">
                                    Ab Hadley
                                </h5>

                                <!-- Text -->
                                <p class="small text-gray-700 mb-0">
                                    Shared the "Why Dashkit?" post with 124 subscribers.
                                </p>

                                <!-- Time -->
                                <small class="text-muted">
                                    1h ago
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </a>
                    <a class="list-group-item text-reset" href="#!">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm avatar-offline">
                                    <img class="avatar-img rounded-circle" src="{{asset('assets/img/avatars/profiles/avatar-3.jpg')}}" alt="..." />
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Heading -->
                                <h5 class="mb-1">
                                    Adolfo Hess
                                </h5>

                                <!-- Text -->
                                <p class="small text-gray-700 mb-0">
                                    Exported sales data from Launchday's subscriber data.
                                </p>

                                <!-- Time -->
                                <small class="text-muted">
                                    3h ago
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </a>
                    <a class="list-group-item text-reset" href="#!">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm avatar-online">
                                    <img class="avatar-img rounded-circle" src="{{asset('assets/img/avatars/profiles/avatar-1.jpg')}}" alt="..." />
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Heading -->
                                <h5 class="mb-1">
                                    Dianna Smiley
                                </h5>

                                <!-- Text -->
                                <p class="small text-gray-700 mb-0">
                                    Uploaded the files "Launchday Logo" and "New Design".
                                </p>

                                <!-- Time -->
                                <small class="text-muted">
                                    2m ago
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </a>
                    <a class="list-group-item text-reset" href="#!">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm avatar-online">
                                    <img class="avatar-img rounded-circle" src="{{asset('assets/img/avatars/profiles/avatar-2.jpg')}}" alt="..." />
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Heading -->
                                <h5 class="mb-1">
                                    Ab Hadley
                                </h5>

                                <!-- Text -->
                                <p class="small text-gray-700 mb-0">
                                    Shared the "Why Dashkit?" post with 124 subscribers.
                                </p>

                                <!-- Time -->
                                <small class="text-muted">
                                    1h ago
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </a>
                    <a class="list-group-item text-reset" href="#!">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm avatar-offline">
                                    <img class="avatar-img rounded-circle" src="{{asset('assets/img/avatars/profiles/avatar-3.jpg')}}" alt="..." />
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Heading -->
                                <h5 class="mb-1">
                                    Adolfo Hess
                                </h5>

                                <!-- Text -->
                                <p class="small text-gray-700 mb-0">
                                    Exported sales data from Launchday's subscriber data.
                                </p>

                                <!-- Time -->
                                <small class="text-muted">
                                    3h ago
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </a>
                    <a class="list-group-item text-reset" href="#!">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm avatar-online">
                                    <img class="avatar-img rounded-circle" src="{{asset('assets/img/avatars/profiles/avatar-1.jpg')}}" alt="..." />
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Heading -->
                                <h5 class="mb-1">
                                    Dianna Smiley
                                </h5>

                                <!-- Text -->
                                <p class="small text-gray-700 mb-0">
                                    Uploaded the files "Launchday Logo" and "New Design".
                                </p>

                                <!-- Time -->
                                <small class="text-muted">
                                    2m ago
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </a>
                    <a class="list-group-item text-reset" href="#!">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm avatar-online">
                                    <img class="avatar-img rounded-circle" src="{{asset('assets/img/avatars/profiles/avatar-2.jpg')}}" alt="..." />
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Heading -->
                                <h5 class="mb-1">
                                    Ab Hadley
                                </h5>

                                <!-- Text -->
                                <p class="small text-gray-700 mb-0">
                                    Shared the "Why Dashkit?" post with 124 subscribers.
                                </p>

                                <!-- Time -->
                                <small class="text-muted">
                                    1h ago
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </a>
                    <a class="list-group-item text-reset" href="#!">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm avatar-offline">
                                    <img class="avatar-img rounded-circle" src="{{asset('assets/img/avatars/profiles/avatar-3.jpg')}}" alt="..." />
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Heading -->
                                <h5 class="mb-1">
                                    Adolfo Hess
                                </h5>

                                <!-- Text -->
                                <p class="small text-gray-700 mb-0">
                                    Exported sales data from Launchday's subscriber data.
                                </p>

                                <!-- Time -->
                                <small class="text-muted">
                                    3h ago
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </a>
                    <a class="list-group-item text-reset" href="#!">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm avatar-online">
                                    <img class="avatar-img rounded-circle" src="{{asset('assets/img/avatars/profiles/avatar-1.jpg')}}" alt="..." />
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Heading -->
                                <h5 class="mb-1">
                                    Dianna Smiley
                                </h5>

                                <!-- Text -->
                                <p class="small text-gray-700 mb-0">
                                    Uploaded the files "Launchday Logo" and "New Design".
                                </p>

                                <!-- Time -->
                                <small class="text-muted">
                                    2m ago
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </a>
                    <a class="list-group-item text-reset" href="#!">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm avatar-online">
                                    <img class="avatar-img rounded-circle" src="{{asset('assets/img/avatars/profiles/avatar-2.jpg')}}" alt="..." />
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Heading -->
                                <h5 class="mb-1">
                                    Ab Hadley
                                </h5>

                                <!-- Text -->
                                <p class="small text-gray-700 mb-0">
                                    Shared the "Why Dashkit?" post with 124 subscribers.
                                </p>

                                <!-- Time -->
                                <small class="text-muted">
                                    1h ago
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </a>
                    <a class="list-group-item text-reset" href="#!">
                        <div class="row">
                            <div class="col-auto">

                                <!-- Avatar -->
                                <div class="avatar avatar-sm avatar-offline">
                                    <img class="avatar-img rounded-circle" src="{{asset('assets/img/avatars/profiles/avatar-3.jpg')}}" alt="..." />
                                </div>

                            </div>
                            <div class="col ms-n2">

                                <!-- Heading -->
                                <h5 class="mb-1">
                                    Adolfo Hess
                                </h5>

                                <!-- Text -->
                                <p class="small text-gray-700 mb-0">
                                    Exported sales data from Launchday's subscriber data.
                                </p>

                                <!-- Time -->
                                <small class="text-muted">
                                    3h ago
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

    @include('partials.menu')
{{--    <div class="c-wrapper">--}}
<div class="main-content">
{{--        <header class="c-header c-header-fixed px-3">--}}
{{--            <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">--}}
{{--                <i class="fas fa-fw fa-bars"></i>--}}
{{--            </button>--}}

{{--            <a class="c-header-brand d-lg-none" href="#">{{ trans('panel.site_title') }}</a>--}}

{{--            <button class="c-header-toggler mfs-3 d-md-down-none" type="button" responsive="true">--}}
{{--                <i class="fas fa-fw fa-bars"></i>--}}
{{--            </button>--}}

{{--            <ul class="c-header-nav ml-auto">--}}
{{--                @if(count(config('panel.available_languages', [])) > 1)--}}
{{--                    <li class="c-header-nav-item dropdown d-md-down-none">--}}
{{--                        <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">--}}
{{--                            {{ strtoupper(app()->getLocale()) }}--}}
{{--                        </a>--}}
{{--                        <div class="dropdown-menu dropdown-menu-right">--}}
{{--                            @foreach(config('panel.available_languages') as $langLocale => $langName)--}}
{{--                                <a class="dropdown-item" href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }} ({{ $langName }})</a>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                @endif--}}


{{--            </ul>--}}
{{--        </header>--}}

{{--        <div class="c-body">--}}
            <main class="c-main">


                <div class="container-fluid">
                    @if(session('message'))
                        <div class="row mb-2">
                            <div class="col-lg-12">
                                <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                            </div>
                        </div>
                    @endif
                    @if($errors->count() > 0)
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 mt-3">
                                    @yield('content')
                                </div>
                            </div>
                        </div>


                </div>


            </main>
            <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
{{--        </div>--}}
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>
    <script src="https://unpkg.com/@coreui/coreui@3.2/dist/js/coreui.min.js"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
{{--<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>--}}
    <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
{{--    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>--}}
<script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/super-build/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <!-- JAVASCRIPT -->
    <!-- Map JS -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>

    <!-- Vendor JS -->
    <script src="{{ asset('assets/js/vendor.bundle.js') }}"></script>

    <!-- Theme JS -->
    <script src="{{ asset('assets/js/theme.bundle.js') }}"></script>
    <script>
        var select_placeholder='<option>{{trans('global.pleaseSelect')}}</option>';
        $("select[name=country]").change(function (){
           console.log($(this).val());
            $.ajax({
                url: "{{ route('admin.states.get_by_country') }}?country_id=" + $(this).val(),
                method: 'GET',
                success: function(data) {
                    $('select[name=state]').html(data.html);
                    $('select[name=city]').html(select_placeholder);
                }
            });
        });
        $("select[name=state]").change(function (){
           console.log($(this).val());
            $.ajax({
                url: "{{ route('admin.cities.get_by_state') }}?state_id=" + $(this).val(),
                method: 'GET',
                success: function(data) {
                    $('select[name=city]').html(data.html);
                }
            });
        });
        $("select[name=country_id]").change(function (){
           console.log($(this).val());
            $.ajax({
                url: "{{ route('admin.states.get_by_country') }}?country_id=" + $(this).val(),
                method: 'GET',
                success: function(data) {
                    $('select[name=state_id]').html(data.html);
                    $('select[name=city_id]').html(select_placeholder);
                }
            });
        });
        $("select[name=state_id]").change(function (){
           console.log($(this).val());
            $.ajax({
                url: "{{ route('admin.cities.get_by_state') }}?state_id=" + $(this).val(),
                method: 'GET',
                success: function(data) {
                    $('select[name=city_id]').html(data.html);
                }
            });
        });
        $(function() {
  let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
  let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
  let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
  let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
  let printButtonTrans = '{{ trans('global.datatables.print') }}'
  let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'
  let selectAllButtonTrans = '{{ trans('global.select_all') }}'
  let selectNoneButtonTrans = '{{ trans('global.deselect_all') }}'

  let languages = {
    'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
  };

  $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
  $.extend(true, $.fn.dataTable.defaults, {
    language: {
      url: languages['{{ app()->getLocale() }}']
    },
    columnDefs: [{
        orderable: false,
        className: 'select-checkbox',
        targets: 0
    }, {
        orderable: false,
        searchable: false,
        targets: -1
    }],
    select: {
      style:    'multi+shift',
      selector: 'td:first-child'
    },
    order: [],
    scrollX: true,
    pageLength: 100,
    dom: 'lBfrtip<"actions">',
    buttons: [
      {
        extend: 'selectAll',
        className: 'btn-primary',
        text: selectAllButtonTrans,
        exportOptions: {
          columns: ':visible'
        },
        action: function(e, dt) {
          e.preventDefault()
          dt.rows().deselect();
          dt.rows({ search: 'applied' }).select();
        }
      },
      {
        extend: 'selectNone',
        className: 'btn-primary',
        text: selectNoneButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      // {
      //   extend: 'copy',
      //   className: 'btn-default',
      //   text: copyButtonTrans,
      //   exportOptions: {
      //     columns: ':visible'
      //   }
      // },
      {
        extend: 'csv',
        className: 'btn-default',
        text: csvButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'excel',
        className: 'btn-default',
        text: excelButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'pdf',
        className: 'btn-default',
        text: pdfButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'print',
        className: 'btn-default',
        text: printButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      // {
      //   extend: 'colvis',
      //   className: 'btn-default',
      //   text: colvisButtonTrans,
      //   exportOptions: {
      //     columns: ':visible'
      //   }
      // }
    ]
  });

  $.fn.dataTable.ext.classes.sPageButton = '';
});

    </script>
    @yield('scripts')
<script>
    function printHtml(id) {
        window.frames["print_frame"].document.body.innerHTML = document.getElementById(id).innerHTML;
        window.frames["print_frame"].window.focus();
        window.frames["print_frame"].window.print();
    }
    $(document).ready(function () {
        function SimpleUploadAdapter(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
                return {
                    upload: function() {
                        return loader.file
                            .then(function (file) {
                                return new Promise(function(resolve, reject) {
                                    // Init request
                                    var xhr = new XMLHttpRequest();
                                    xhr.open('POST', storeCKEditorImages_url, true);
                                    xhr.setRequestHeader('x-csrf-token', window._token);
                                    xhr.setRequestHeader('Accept', 'application/json');
                                    xhr.responseType = 'json';

                                    // Init listeners
                                    var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                                    xhr.addEventListener('error', function() { reject(genericErrorText) });
                                    xhr.addEventListener('abort', function() { reject() });
                                    xhr.addEventListener('load', function() {
                                        var response = xhr.response;

                                        if (!response || xhr.status !== 201) {
                                            return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                                        }

                                        $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                                        resolve({ default: response.url });
                                    });

                                    if (xhr.upload) {
                                        xhr.upload.addEventListener('progress', function(e) {
                                            if (e.lengthComputable) {
                                                loader.uploadTotal = e.total;
                                                loader.uploaded = e.loaded;
                                            }
                                        });
                                    }

                                    // Send request
                                    var data = new FormData();
                                    data.append('upload', file);
                                    data.append('crud_id', crud_id);
                                    xhr.send(data);
                                });
                            })
                    }
                };
            }
        }
        var allEditors = document.querySelectorAll('.ckeditor');
        if(allEditors.length>0){
            for (var i = 0; i < allEditors.length; ++i) {
                CKEDITOR.ClassicEditor.create(allEditors[i], {
                    // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                    toolbar: {
                        items: [
                            'findAndReplace', 'selectAll', '|',
                            'heading', '|',
                            'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                            'bulletedList', 'numberedList', 'todoList', '|',
                            'outdent', 'indent', '|',
                            'undo', 'redo',
                            '-',
                            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                            'alignment', '|',
                            'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                            'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                            'sourceEditing'
                        ],
                        shouldNotGroupWhenFull: true
                    },
                    // Changing the language of the interface requires loading the language file using the <script> tag.
                    // language: 'es',
                    list: {
                        properties: {
                            styles: true,
                            startIndex: true,
                            reversed: true
                        }
                    },
                    // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                    heading: {
                        options: [
                            {model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph'},
                            {model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1'},
                            {model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2'},
                            {model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3'},
                            {model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4'},
                            {model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5'},
                            {model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6'}
                        ]
                    },
                    // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                    placeholder: 'Content goes here',
                    // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
                    fontFamily: {
                        options: [
                            'default',
                            'Arial, Helvetica, sans-serif',
                            'Courier New, Courier, monospace',
                            'Georgia, serif',
                            'Lucida Sans Unicode, Lucida Grande, sans-serif',
                            'Tahoma, Geneva, sans-serif',
                            'Times New Roman, Times, serif',
                            'Trebuchet MS, Helvetica, sans-serif',
                            'Verdana, Geneva, sans-serif'
                        ],
                        supportAllValues: true
                    },
                    // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                    fontSize: {
                        options: [10, 12, 14, 'default', 18, 20, 22],
                        supportAllValues: true
                    },
                    // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
                    htmlSupport: {
                        allow: [
                            {
                                name: /.*/,
                                attributes: true,
                                classes: true,
                                styles: true
                            }
                        ]
                    },
                    // Be careful with enabling previews
                    // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
                    // htmlEmbed: {
                    //     showPreviews: true
                    // },
                    // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                    link: {
                        decorators: {
                            addTargetToExternalLinks: true,
                            defaultProtocol: 'https://',
                            toggleDownloadable: {
                                mode: 'manual',
                                label: 'Downloadable',
                                attributes: {
                                    download: 'file'
                                }
                            }
                        }
                    },
                    // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
                    mention: {
                        feeds: [
                            {
                                marker: '@',
                                feed: [
                                    '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                                    '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                                    '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                                    '@sugar', '@sweet', '@topping', '@wafer'
                                ],
                                minimumCharacters: 1
                            }
                        ]
                    },
                    // The "super-build" contains more premium features that require additional configuration, disable them below.
                    // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                    removePlugins: [
                        // These two are commercial, but you can try them out without registering to a trial.
                        'ExportPdf',
                        'ExportWord',
                        'CKBox',
                        'CKFinder',
                        'EasyImage',
                        'Base64UploadAdapter',
                        // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                        // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                        // Storing images as Base64 is usually a very bad idea.
                        // Replace it on production website with other solutions:
                        // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                        // 'Base64UploadAdapter',
                        'RealTimeCollaborativeComments',
                        'RealTimeCollaborativeTrackChanges',
                        'RealTimeCollaborativeRevisionHistory',
                        'PresenceList',
                        'Comments',
                        'TrackChanges',
                        'TrackChangesData',
                        'RevisionHistory',
                        'Pagination',
                        'WProofreader',
                        // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                        // from a local file system (file://) - load this site via HTTP server if you enable MathType
                        'MathType'
                    ],
                    extraPlugins: [SimpleUploadAdapter]
                });
            }
        }

    });
    if(typeof dropzone !== 'undefined'&&dropzone==true) {
        $("#" + dropzone_field).dropzone({
            url: photo_upload_route,
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: Maxfiles,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function (file, response) {
                $('form').find('input[name="' + field_name + '"]').remove()
                $('form').append('<input type="hidden" name="' + field_name + '" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="' + field_name + '"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {
                if (typeof image_src !== 'undefined') {
                    var file = image_src
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="' + field_name + '" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                }
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        });
    }
    function export_data_(type){
        var ids=[];
        $("input:checkbox[name=list-checkbox]:checked").each(function(){
            ids.push($(this).val());
        });
        {{--var downloadLink = document.createElement("a");--}}
        {{--downloadLink.attr--}}
        var url=export_route+'?type='+type;

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
    function checkAll(all){
        // alert(all.checked);
        checkboxes=document.getElementsByName('list-checkbox');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = all.checked;
        }
        total_checkboxes();
    }
    function total_checkboxes(){
        var total=0;
        var checkboxes=document.getElementsByName('list-checkbox');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            if(checkboxes[i].checked){
                total+=1;
            }
        }
        if(total>0){
            document.getElementById('list-alert-count').innerHTML=total;
            document.getElementById('list-alert').classList.add("show");
        }else{
            document.getElementById('list-alert-count').innerHTML=0;
            document.getElementById('list-alert').classList.remove("show");
        }
    }
    document.querySelector('.list-alert-close').addEventListener('click',close_list_alert,false);
        function close_list_alert(){
            document.getElementById('list-alert').classList.remove("show");
        }
</script>
</body>

</html>

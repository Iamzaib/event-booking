@extends('layouts.front')
@section('content')
    <div class="receiptmain">
        <div class="container">
            <div class="receiptcard">
                <div class="card card-body p-5">
                    <div class="row">
                        <div class="col text-end">

                            <!-- Badge -->
                            <div class="badge bg-success">
                                Paid
                            </div>

                        </div>
                    </div> <!-- / .row -->
                    <div class="row">
                        <div class="col text-center firsco">

                            <!-- Logo -->
                            <img src="{{asset('assets/front/img/darklogo.svg')}}" alt="..." class="img-fluid mb-4" style="width: 200px;">

                            <!-- Title -->
                            <h2 class="mb-2">
                                Invoice from {{config('app.name')}}
                            </h2>

                            <!-- Text -->
                            <p class="text-muted mb-6">
                                Invoice #{{$booking->payment->id}}
                            </p>

                        </div>
                    </div> <!-- / .row -->
                    <div class="row">
                        <div class="col-12 col-md-6">

                            <!-- Heading -->
                            <h6 class="text-uppercase text-muted">
                                Invoiced from
                            </h6>

                            <!-- Text -->
                            <p class="text-muted mb-4">
                                <strong class="text-body">{{config('app.owner')}}</strong> <br>
                                CEO of {{config('app.name')}} <br>
                                123 Happy Walk Way <br>
                                San Francisco, CA
                            </p>

                            <!-- Heading -->
                            <h6 class="text-uppercase text-muted">
                                Invoiced ID
                            </h6>

                            <!-- Text -->
                            <p class="mb-4">
                                #{{$booking->payment->id}}
                            </p>

                        </div>
                        <div class="col-12 col-md-6 text-md-end">

                            <!-- Heading -->
                            <h6 class="text-uppercase text-muted">
                                Invoiced to
                            </h6>

                            <!-- Text -->
                            <p class="text-muted mb-4">
                                <strong class="text-body">{{$booking->billing_name.' '.$booking->billing_lastname}}</strong> <br>
                                {{$booking->billing_address}} <br>
                                {{$booking->billing_address_2}}<br>
                                {{city_name($booking->billing_city_id)}}, {{state_name($booking->billing_state_id)}}
                            </p>

                            <!-- Heading -->
                            <h6 class="text-uppercase text-muted">
                                &nbsp;
                            </h6>

                            <!-- Text -->
                            <p class="mb-4">
                                <time datetime="2018-04-23">&nbsp;</time>
                            </p>

                        </div>
                    </div> <!-- / .row -->
                    <div class="row">
                        <div class="col-12">

                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table my-4">
                                    <thead>
                                    <tr>
                                        <th class="px-0 bg-transparent border-top-0">
                                            <span class="h6">Description</span>
                                        </th>
                                        <th class="px-0 bg-transparent border-top-0">
                                            <span class="h6">Hours</span>
                                        </th>
                                        <th class="px-0 bg-transparent border-top-0 text-end">
                                            <span class="h6">Cost</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="px-0">
                                            Custom theme development
                                        </td>
                                        <td class="px-0">
                                            125
                                        </td>
                                        <td class="px-0 text-end">
                                            $6,250
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-0">
                                            Logo design
                                        </td>
                                        <td class="px-0">
                                            15
                                        </td>
                                        <td class="px-0 text-end">
                                            $750
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-0 border-top border-top-2">
                                            <strong>Total amount due</strong>
                                        </td>
                                        <td colspan="2" class="px-0 text-end border-top border-top-2">
                            <span class="h3">
                              $7,000
                            </span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <hr class="my-5">

                            <!-- Title -->
                            <h6 class="text-uppercase">
                                Notes
                            </h6>

                            <!-- Text -->
                            <p class="text-muted mb-0">
                                We really appreciate your business and if there’s anything else we can do, please let us know! Also, should you need us to add VAT or anything else to this order, it’s super easy since this is a template, so just ask!
                            </p>

                        </div>
                    </div> <!-- / .row -->
                </div>
            </div>
        </div>
    </div>
@endsection

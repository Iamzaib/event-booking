@extends('layouts.front')
@section('content')
    <div class="receiptmain">
        <div class="container">
            <div class="receiptcard">
                <div class="card card-body p-5">
                    <div class="row">
                        <div class="col text-end">

                            <!-- Badge -->
{{--                            @if($payment->amount_balance>0)--}}
{{--                                <div class="badge bg-danger">--}}
{{--                                    Payment Pending--}}
{{--                                </div>--}}
{{--                            @else--}}
                                <div class="badge bg-success">
                                    Paid
                                </div>
{{--                            @endif--}}
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
                                Invoice #{{invoice_number($payment->id,$invoice->id)}}
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
                                #{{invoice_number($payment->id,$invoice->id)}}
                            </p>

                        </div>
                        <div class="col-12 col-md-6 text-md-end">

                            <!-- Heading -->
                            <h6 class="text-uppercase text-muted">
                                Invoiced to
                            </h6>

                            <!-- Text -->
                            <p class="text-muted mb-4">
                                <strong class="text-body">{{$payment->payment_booking->billing_name.' '.$payment->payment_booking->billing_lastname}}</strong> <br>
                                {{$payment->payment_booking->billing_address}} <br>
                                {{$payment->payment_booking->billing_address_2}}<br>
                                {{city_name($payment->payment_booking->billing_city_id)}}, {{state_name($payment->payment_booking->billing_state_id)}}
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
                                            <span class="h6">Booking</span>
                                        </th>
                                        <th class="px-0 bg-transparent border-top-0">
                                            <span class="h6">Travelers</span>
                                        </th>
                                        <th class="px-0 bg-transparent border-top-0 text-end">
                                            <span class="h6">Total</span>
                                        </th>
                                        <th class="px-0 bg-transparent border-top-0 text-end">
                                            <span class="h6">Total Paid</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="px-0">
                                            {{$payment->payment_booking->booking_details}}
                                        </td>
                                        <td class="px-0">
                                            {{count($payment->payment_booking->travelers)}}
                                        </td>
                                        <td class="px-0 text-end">
                                            {{display_currency($payment->amount_total)}}
                                        </td>
                                        <td class="px-0 text-end">
                                            {{display_currency($payment->amount_paid)}}
                                        </td>
                                    </tr>
{{--                                    <tr>--}}
{{--                                        <td class="px-0 border-top border-top-2">--}}

{{--                                        </td>--}}
{{--                                        <td class="px-0 border-top border-top-2">--}}
{{--                                            <strong>Processing:</strong>--}}
{{--                                        </td>--}}
{{--                                        <td  class="px-0 text-end border-top border-top-2">--}}
{{--                                            <span class="h3">--}}
{{--                                              {{display_currency($payment->processing_fee)}}--}}
{{--                                            </span>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td class="px-0 border-top border-top-2">--}}

{{--                                        </td>--}}
{{--                                        <td class="px-0 border-top border-top-2">--}}
{{--                                            <strong>Total amount:</strong>--}}
{{--                                        </td>--}}
{{--                                        <td  class="px-0 text-end border-top border-top-2">--}}
{{--                                            <span class="h3">--}}
{{--                                              {{display_currency($payment->amount_total)}}--}}
{{--                                            </span>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td class="px-0 border-top border-top-2">--}}

{{--                                        </td>--}}
{{--                                        <td class="px-0 border-top border-top-2">--}}
{{--                                            <strong>Total Amount Paid:</strong>--}}
{{--                                        </td>--}}
{{--                                        <td  class="px-0 text-end border-top border-top-2">--}}
{{--                                            <span class="h3">--}}
{{--                                              {{display_currency($payment->amount_paid)}}--}}
{{--                                            </span>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
                                    <tr>
                                        <td class="px-0 border-top border-top-2">

                                        </td>
                                        <td class="px-0 border-top border-top-2">

                                        </td>
                                        <td class="px-0 border-top border-top-2">
                                            <strong>Invoice Payment:</strong>
                                        </td>
                                        <td  class="px-0 text-end border-top border-top-2">
                                            <span class="h3">
                                              {{display_currency($invoice->payment_done)}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-0 border-top border-top-2">

                                        </td>
                                        <td class="px-0 border-top border-top-2">

                                        </td>
                                        <td class="px-0 border-top border-top-2">
                                            <strong>Total Amount Due:</strong>
                                        </td>
                                        <td  class="px-0 text-end border-top border-top-2">
                                            <span class="h3">
                                              {{display_currency($payment->amount_balance)}}
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

@extends('layouts.deshboard')

@section('content')
    <style>
        .datepicker {
            background-color: #fff;
            border-radius: 0 !important;
            align-content: center !important;
            padding: 0 !important;
        }

        #reservationdatestart .datepicker-dropdown {
            top: 22% !important;
            left: calc(50% - 1.5%) !important;
            border-right: #1976D2;
            border-left: #1976D2;
        }

        .datepicker-dropdown.datepicker-orient-left:before {
            left: calc(50% - 6px) !important;
        }

        .datepicker-dropdown.datepicker-orient-left:after {
            left: calc(50% - 5px) !important;
            border-bottom-color: #fdfdfd;
        }

        .datepicker-dropdown.datepicker-orient-right:after {
            border-bottom-color: #fdfdfd;
        }

        .datepicker table tr td.today,
        span.focused {
            border-radius: 50% !important;
            background-image: linear-gradient(#FFF3E0, #FFE0B2);
        }

        thead tr:nth-child(2) {
            background-color: #185e4b;
        }

        /*Weekday title*/
        thead tr:nth-child(3) th {
            font-weight: bold !important;
            padding: 20px 10px !important;
            color: #BDBDBD !important;
        }

        tbody tr td {
            padding: 10px !important;
        }

        tfoot tr:nth-child(2) th {
            padding: 10px !important;
            border-top: 1px solid #CFD8DC !important;
        }

        .cw {
            font-size: 14px !important;
            background-color: #E8EAF6 !important;
            border-radius: 0px !important;
            padding: 0px 20px !important;
            margin-right: 10px solid #fff !important;
        }

        .old,
        .day,
        .new {
            width: 40px !important;
            height: 40px !important;
            border-radius: 0px !important;
        }

        .day.old,
        .day.new {
            color: #E0E0E0 !important;
        }

        .day.old:hover,
        .day.new:hover {
            border-radius: 50% !important;
        }

        .old-day:hover,
        .day:hover,
        .new-day:hover,
        .month:hover,
        .year:hover,
        .decade:hover,
        .century:hover {
            border-radius: 50% !important;
            background-color: #eee;
        }

        /* .active {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        border-radius: 50% !important;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        background-image: linear-gradient(#1976D2, #1976D2) !important;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        color: #fff !important;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } */

        .range-start,
        .range-end {
            border-radius: 50% !important;
            background-image: linear-gradient(#fdfdfd, #fdfdfd) !important;
        }

        .range {
            background-color: #E3F2FD !important;
        }

        .prev,
        .next,
        .datepicker-switch {
            border-radius: 0 !important;
            padding: 10px 10px 10px 10px !important;
            font-size: 18px;
            opacity: 0.7;
            color: #fff;
        }

        .prev:hover,
        .next:hover,
        .datepicker-switch:hover {
            background-color: inherit !important;
            opacity: 1;
        }

        @media screen and (max-width: 726px) {
            .datepicker-dropdown.datepicker-orient-right:before {
                right: calc(50% - 6px);
            }

            .datepicker-dropdown.datepicker-orient-right:after {
                right: calc(50% - 5px);
            }
        }

        #datetime-panel {
            margin-top: 3%;
        }

        input {
            caret-color: #fdfdfd;
        }

        table.innter-table tr td {
            width: 4%;
            text-align: center
        }
    </style>
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Report List</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form method="get" action="{{ route('activation.report') }}">
                    @csrf
                    <div class=" form-group">
                        <div class="col-md-3 col-sm-3 ">
                            <div class="input-group date" id="reservationdatestart" data-target-input="nearest">
                                <input type="text" name="startdate" class="form-control datetimepicker-input"
                                    data-target="#reservationdate" value="{{ $startdate }}" placeholder="Start date" />
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 col-sm-3 ">
                            <div class="input-group date" id="reservationdateend" data-target-input="nearest">
                                <input type="text" name="enddate" class="form-control datetimepicker-input"
                                    data-target="#reservationdate" value="{{ $enddate }}" placeholder="To date" />
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-2 col-sm-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
                <div class="clearfix"></div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th colspan="9" class="text-center">Date : {{ date('d/m/Y', strtotime($startdate)) }} To
                                {{ date('d/m/Y', strtotime($enddate)) }}</th>
                        </tr>
                        <tr class="text-center" style="background-color: #fff !important">
                            <th scope="col" rowspan="2">Service</th>
                            <th scope="col" colspan="2">GP</th>
                            <th scope="col" colspan="2">Bangla link</th>
                            <th scope="col" colspan="2">Robi</th>
                            <th scope="col" colspan="2">Teletalk</th>
                        </tr>
                        <tr>
                            <th>Activation</th>
                            <th>Deactivation</th>
                            <th>Activation</th>
                            <th>Deactivation</th>
                            <th>Activation</th>
                            <th>Deactivation</th>
                            <th>Activation</th>
                            <th>Deactivation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $services = DB::table('services')->get();
                        @endphp

                        @foreach ($services as $service)
                            <tr>
                                <td scope="col" class="text-center">
                                    {{ $service->service_name }}
                                </td>
                                <td scope="col">
                                    @php
                                        $gp = App\Http\Controllers\ActivationController::activation_data('GP', $service->id, $startdate, $enddate);
                                        //dd($gp);
                                    @endphp
                                    {{ $gp->total_active }}
                                </td>
                                <td scope="col">
                                    {{ $gp->total_deactive }}
                                </td>
                                <td scope="col">
                                    @php
                                        $banglink = App\Http\Controllers\ActivationController::activation_data('Bangla_link', $service->id, $startdate, $enddate);
                                    @endphp
                                    {{ $banglink->total_active }}
                                </td>
                                <td scope="col">
                                    {{ $banglink->total_deactive }}
                                </td>
                                <td scope="col">
                                    @php
                                        $robi = App\Http\Controllers\ActivationController::activation_data('Robi', $service->id, $startdate, $enddate);
                                    @endphp
                                    {{ $robi->total_active }}
                                </td>
                                <td scope="col">
                                    {{ $robi->total_deactive }}
                                </td>
                                <td scope="col">
                                    @php
                                        $ttalk = App\Http\Controllers\ActivationController::activation_data('Teletalk', $service->id, $startdate, $enddate);
                                    @endphp
                                    {{ $ttalk->total_active }}
                                </td>
                                <td scope="col">
                                    {{ $ttalk->total_deactive }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td><strong>Total</strong></td>
                            <td>
                                @php
                                    $gp = App\Http\Controllers\ActivationController::activation_data_total('GP', $startdate, $enddate);
                                @endphp
                                <strong> {{ number_format($gp->total_active) }}</strong>
                            </td>
                            <td>
                                <strong> {{ number_format($gp->total_deactive) }}</strong>
                            </td>
                            <td>
                                @php
                                    $banglink = App\Http\Controllers\ActivationController::activation_data_total('Bangla_link', $startdate, $enddate);
                                @endphp
                                <strong> {{ number_format($banglink->total_active) }}</strong>
                            </td>
                            <td>
                                <strong> {{ number_format($banglink->total_deactive) }}</strong>
                            </td>
                            <td>
                                @php
                                    $robi = App\Http\Controllers\ActivationController::activation_data_total('Robi', $startdate, $enddate);
                                @endphp
                                <strong> {{ number_format($robi->total_active) }}</strong>
                            </td>
                            <td>
                                <strong> {{ number_format($robi->total_deactive) }}</strong>
                            </td>
                            <td>
                                @php
                                    $ttalk = App\Http\Controllers\ActivationController::activation_data_total('Teletalk', $startdate, $enddate);
                                @endphp
                                <strong> {{ number_format($ttalk->total_active) }}</strong>
                            </td>
                            <td>
                                <strong> {{ number_format($ttalk->total_deactive) }}</strong>
                            </td>


                        </tr>
                    </tbody>

                </table>

            </div>

        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $('#reservationdatestart').datepicker({
            format: 'yyyy-mm-dd',
            clearBtn: true,
            autoclose: true,
            todayHighlight: true,
        });
        $('#reservationdateend').datepicker({
            format: 'yyyy-mm-dd',
            clearBtn: true,
            autoclose: true,
            todayHighlight: true,
        });

        // $('.input-daterange').datepicker({
        //     format: 'yyyy-mm-dd',
        //     clearBtn: true,
        //     autoclose: true,
        //     todayHighlight: true,
        // });
        $('#datepicker').datepicker("setDate", new Date());
    </script>
@endsection

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
            border-bottom-color: #1976D2;
        }

        .datepicker-dropdown.datepicker-orient-right:after {
            border-bottom-color: #1976D2;
        }

        .datepicker table tr td.today,
        span.focused {
            border-radius: 50% !important;
            background-image: linear-gradient(#FFF3E0, #FFE0B2);
        }

        thead tr:nth-child(2) {
            background-color: #1976D2 !important;
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
            background-image: linear-gradient(#1976D2, #1976D2) !important;
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
            caret-color: #007bff;
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
            @php
                // $money = App\Http\Controllers\ActivationController::activationsearch(1);
                // $money = App\Http\Controllers\ActivationController::activationFormat(1);
            @endphp
            {{-- {{ $money }} --}}
            @php
                // if (!empty($startdate)) {
                //     echo "<span class='report'> From : " . $startdate . ' To : ' . $enddate . ' </span>';
                // }
            @endphp
            @if (!empty($avns))
                <div class="x_content">
                    <form method="POST" action="{{ route('activation.search') }}">
                        @csrf
                        <div class=" form-group">
                            <div class="col-md-3 col-sm-3 ">
                                <div class="input-group date" id="reservationdatestart" data-target-input="nearest">
                                    <input type="text" name="start_date" class="form-control datetimepicker-input"
                                        data-target="#reservationdate" value="@php echo $startdate; @endphp"
                                        placeholder="Start date" />
                                    <div class="input-group-append" data-target="#reservationdate"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3 col-sm-3 ">
                                <div class="input-group date" id="reservationdateend" data-target-input="nearest">
                                    <input type="text" name="to_date" class="form-control datetimepicker-input"
                                        data-target="#reservationdate" value="@php echo $enddate; @endphp"
                                        placeholder="To date" />
                                    <div class="input-group-append" data-target="#reservationdate"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" form-group">
                            <div class="col-md-2 col-sm-2">
                                <select name="operator" class="form-control">
                                    <option value="GP"> GP</option>
                                    <option value="Bangla_link"> Blink</option>
                                    <option value="Robi"> Robi</option>
                                    <option value="Teletalk"> Teletalk</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2 col-sm-2 ">
                                @php
                                    $services = DB::table('services')->get();
                                @endphp
                                <select name="service_id" class="form-control">
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}"> {{ $service->service_name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2 col-sm-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">Service</th>
                                <th scope="col">GP</th>
                                <th scope="col">Bangla link</th>
                                <th scope="col">Robi</th>
                                <th scope="col">Teletalk</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($avns as $rvn)
                                <tr>
                                    <td scope="col" class="text-center">
                                        @php
                                            $services = DB::table('services')
                                                ->where('id', $rvn->service_id)
                                                ->get();
                                        @endphp
                                        {{ $services[0]->service_name }}
                                    </td>
                                    <td scope="col">
                                        @if ($rvn->operator == 'GP')
                                            <table class="table table-responsive innter-table"
                                                style="margin-bottom:0px !important; width:100% !important">
                                                <tr>
                                                    <td>Activation</td>
                                                    <td>Deactivation</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ $rvn->activation }}</td>
                                                    <td>{{ $rvn->deactivation }}</td>
                                                </tr>
                                            </table>
                                        @endif
                                    </td>
                                    <td scope="col">
                                        @if ($rvn->operator == 'Bangla_link')
                                            <table class="table table-responsive innter-table"
                                                style="margin-bottom:0px !important; width:100% !important">
                                                <tr>
                                                    <td>Activation</td>
                                                    <td>Deactivation</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ $rvn->activation }}</td>
                                                    <td>{{ $rvn->deactivation }}</td>
                                                </tr>
                                            </table>
                                        @endif
                                    </td>
                                    <td scope="col">
                                        @if ($rvn->operator == 'Robi')
                                            <table class="table table-responsive innter-table"
                                                style="margin-bottom:0px !important; width:100% !important">
                                                <tr>
                                                    <td>Activation</td>
                                                    <td>Deactivation</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ $rvn->activation }}</td>
                                                    <td>{{ $rvn->deactivation }}</td>
                                                </tr>
                                            </table>
                                        @endif
                                    </td>
                                    <td scope="col">
                                        @if ($rvn->operator == 'Teletalk')
                                            <table class="table table-responsive innter-table"
                                                style="margin-bottom:0px !important; width:100% !important">
                                                <tr>
                                                    <td>Activation</td>
                                                    <td>Deactivation</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ $rvn->activation }}</td>
                                                    <td>{{ $rvn->deactivation }}</td>
                                                </tr>
                                            </table>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
            @else
                <div class="x_content">
                    <form method="POST" action="{{ route('activation.search') }}">
                        @csrf
                        <div class=" form-group">
                            <div class="col-md-3 col-sm-3 ">
                                <div class="input-group date" id="reservationdatestart" data-target-input="nearest">
                                    <input type="text" name="start_date" class="form-control datetimepicker-input"
                                        data-target="#reservationdate" placeholder="Start date" />
                                    <div class="input-group-append" data-target="#reservationdate"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3 col-sm-3 ">
                                <div class="input-group date" id="reservationdateend" data-target-input="nearest">
                                    <input type="text" name="to_date" class="form-control datetimepicker-input"
                                        data-target="#reservationdate" placeholder="To date" />
                                    <div class="input-group-append" data-target="#reservationdate"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" form-group">
                            <div class="col-md-2 col-sm-2">
                                <select name="operator" class="form-control">
                                    <option value="GP"> GP</option>
                                    <option value="Bangla_link"> Blink</option>
                                    <option value="Robi"> Robi</option>
                                    <option value="Teletalk"> Teletalk</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2 col-sm-2 ">
                                @php
                                    $services = DB::table('services')->get();
                                    
                                @endphp
                                {{-- {{ $services }} --}}
                                <select name="service_id" class="form-control">
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}"> {{ $service->service_name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2 col-sm-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Service</th>
                                <th scope="col">Robi</th>
                                <th scope="col">GP</th>
                                <th scope="col">Teletalk</th>
                                <th scope="col">Blink</th>
                            </tr>
                        </thead>
                        <tbody>


                            <tr>
                                <td scope="col"></td>
                                <td scope="col">
                                </td>
                                <td scope="col">
                                </td>
                                <td scope="col">
                                </td>
                                <td scope="col">
                                </td>
                            </tr>

                        </tbody>

                    </table>

                </div>
            @endif
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

@extends('layouts.deshboard')

@section('content')
    <style>
        .datepicker {
            background-color: #fff;
            border-radius: 0 !important;
            align-content: center !important;
            padding: 0 !important;
        }

        .datepicker-dropdown {
            top: 44% !important;
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

        .active {
            border-radius: 50% !important;
            background-image: linear-gradient(#1976D2, #1976D2) !important;
            color: #fff !important;
        }

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
    </style>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Service</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <form method="POST" action="{{ route('revenew.store') }}">
                        @csrf
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Operator Name
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" name="operator" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Service Name
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <select name="service_id" class="form-control">
                                    <option selected disabled value=""> -- Select service --</option>
                                    @foreach ($revenews as $service)
                                        <option value="{{ $service->id }}">{{ $service->service_name }} </option>
                                    @endforeach
                                </select>


                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Revenew Name
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="number" name="revenew" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Date
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" name="entry_date" class="form-control datetimepicker-input"
                                        data-target="#reservationdate" />
                                    <div class="input-group-append" data-target="#reservationdate"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-5 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $('#reservationdate').datepicker({
            format: 'yyyy-mm-dd',
            clearBtn: true,
            autoclose: true,
            todayHighlight: true,
        });

        $('.input-daterange').datepicker({
            format: 'yyyy-mm-dd',
            clearBtn: true,
            autoclose: true,
            todayHighlight: true,
        });
        $('#datepicker').datepicker("setDate", new Date());
    </script>
@endsection

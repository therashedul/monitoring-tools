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
                    <h2>Revenue</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <form method="POST" action="{{ route('csv.store') }}" accept=".csv">
                        @csrf
                        <div class="container my-5">
                            <h1 class="fs-5 fw-bold text-center">Import & Export CSV File</h1>
                            <div class="row">
                                <div class="d-flex my-2">
                                    <a href="{{ route('csv.export') }}" class="btn btn-primary me-1">Export Data</a>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        Import Data
                                    </button>
                                </div>
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import CSV</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('csv.store') }}" accept=".csv" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="input-group mb-3">
                                                <input type="file" name="file" class="form-control">
                                                <button class="btn btn-primary" type="submit">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
                        </script>
                    </form>
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

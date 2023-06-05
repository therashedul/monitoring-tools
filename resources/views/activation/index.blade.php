@extends('layouts.deshboard')

@section('content')
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Activation List</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="clearfix"></div>
                <a class="btn btn-primary mb-2 ml-2 pull-right d-block" href="{{ route('activation.create') }}"><i
                        class="fas fa-plus"></i> Add
                    Activation</a>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Operator Name</th>
                            <th scope="col">Service Name</th>
                            <th scope="col">Activation</th>
                            <th scope="col">Deactivation</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sl = 1;
                        @endphp
                        {{-- {{ $activation }} --}}
                        @foreach ($activation as $value)
                            <tr>
                                <th scope="row">{{ $sl++ }}</th>
                                <td>{{ $value->operator }}</td>
                                <td> {{ $value->service_name }}</td>
                                <td>{{ $value->activation }}</td>
                                <td>{{ $value->deactivation }}</td>
                                <td>{{ $value->create_date }}</td>
                                <td>
                                    <a href="{{ route('activation.edit', $value->id) }}" class="btn btn btn-primary"> <i
                                            class="fas fa-edit"></i></a>
                                    <a href="{{ route('activation.destroy', $value->id) }}"
                                        class="btn btn btn-info  btn-danger"><i class="fa fa-trash"
                                            aria-hidden="true"></i></a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
                <div class="d-block pull-right">
                    {!! $activation->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

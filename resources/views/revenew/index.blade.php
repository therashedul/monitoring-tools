@extends('layouts.deshboard')

@section('content')
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Revenue List</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="clearfix"></div>
                <a class="btn btn-primary mb-2 ml-2 pull-right d-block" href="{{ route('revenew.create') }}"><i
                        class="fas fa-plus"></i> Add
                    Revenue</a>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Operator Name</th>
                            <th scope="col">Service Name</th>
                            <th scope="col">Revenue</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sl = 1;
                        @endphp

                        @foreach ($revenew as $value)
                            <tr>
                                <th scope="row">{{ $sl++ }}</th>
                                <td>{{ $value->operator }}</td>
                                <td> {{ $value->service_name }}</td>
                                <td>{{ $value->revenew }}</td>
                                <td>{{ $value->entry_date }}</td>
                                {{-- <td>
                                    <a href="{{ route('revenew.edit', $value->id) }}" class="btn btn btn-primary"> <i
                                            class="fas fa-edit"></i></a>
                                    <a href="{{ route('revenew.destroy', $value->id) }}"
                                        class="btn btn btn-info  btn-danger"><i class="fa fa-trash"
                                            aria-hidden="true"></i></a>
                                </td> --}}

                            </tr>
                        @endforeach
                    </tbody>

                </table>
                <div class="d-block pull-right">
                    {!! $revenew->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.deshboard')
@section('content')
    <div class="container">
        <div class="justify-content-center">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div>
            @endif
            <div class="card">
                <div class="card-header">Users
                    <span class="float-right">
                        <a class="btn btn-primary" href="{{ route('users.create') }}">New User</a>
                    </span>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th width="200px" valign="center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $user)
                                <tr>
                                    <td>{{ $user->id }}</td>

                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->role_id == 1)
                                            Admin
                                        @elseif($user->role_id == 2)
                                            User
                                        @endif
                                    </td>

                                    <td>

                                        <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}"><i
                                                class="fas fa-edit" aria-hidden="true"></i></a>

                                        @if ($user->status_id == 1)
                                            <a href="{{ route('users.publish', $user->id) }}" class="btn btn-info "><i
                                                    class="fa fa-arrow-circle-up" aria-hidden="true"></i></a>
                                        @else
                                            <a href="{{ route('users.unpublish', $user->id) }}"
                                                class="btn btn-info btn-warning ">
                                                <i class="fa fa-arrow-circle-down " aria-hidden="true"></i></a>
                                        @endif
                                        <a class="btn btn-danger" href="{{ route('users.destroy', $user->id) }}"><i
                                                class="fa fa-trash"></i></i></a>






                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->render() }}
                </div>
            </div>
        </div>
    </div>
@endsection

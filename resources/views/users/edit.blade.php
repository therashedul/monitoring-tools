@extends('layouts.deshboard')
@section('content')
    <style>
        /* ======================= Redio button design */
        .containered {
            display: inline-block;
            position: relative;
            padding-left: 26px;
            margin-top: 0px;
            cursor: pointer;
            font-size: 15px;
            padding-top: 6px;
            margin-right: 15px
        }

        /* Hide the default radio button */
        .containered input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* custom radio button */
        .check {
            position: absolute;
            top: 6px;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: lightgray;
            border-radius: 50%;
        }

        .containered:hover input~.check {
            background-color: gray;
        }

        .containered input:checked~.check {
            background-color: #3aaf38;
        }

        .check:after {
            content: "";
            position: absolute;
            display: none;
        }

        .containered input:checked~.check:after {
            display: block;
        }

        .container .check:after {
            top: 3px;
            left: 3px;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background: white;
        }
    </style>
    @php
        // $imageUpload = DB::table('image_uploads')->get();
    @endphp
    <div class="container">

        <div class="justify-content-center">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-header">Edit User
                    <span class="float-right">
                        <a class="btn btn-primary" href="{{ route('users.update') }}">User</a>
                    </span>
                </div>
                <form method="POST" action="{{ route('users.update') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="form-group">
                        <strong>User Name:</strong>
                        <input id="name" placeholder="Username" type="text" class="form-control" name="name"
                            value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <strong>User Email</strong>
                        <input id="email" type="email" name="email" class="form-control"
                            value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                        <strong>Password</strong>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password">
                    </div>
                    <div class="form-group">
                        <strong>Confirm Password</strong>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                    </div>

                    <div class="form-group">
                        <strong>Active:</strong>
                        <input type="hidden" value="0" class="js-switch" name="status_id"
                            {{ $user->status_id == 0 ? 'checked' : '' }}>
                        <input type="checkbox" value="1" class="js-switch" name="status_id"
                            {{ $user->status_id == 1 ? 'checked' : '' }}>
                    </div>

                    <div class="form-group">
                        <strong>User Role:</strong>

                        <label class="containered">Admin
                            <input type="radio" name="role_id" {{ $user->role_id == 1 ? 'checked' : '' }} name="role_id"
                                value="1">
                            <span class="check"></span>
                        </label>
                        <label class="containered">User
                            <input type="radio" {{ $user->role_id == 2 ? 'checked' : '' }} name="role_id" value="2">
                            <span class="check"></span>
                        </label>
                    </div>

                    <div>
                        <div class="form-group row mb-0 mt-3">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

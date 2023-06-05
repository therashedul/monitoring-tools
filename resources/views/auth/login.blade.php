@extends('layouts.appLogin')

@section('content')
    <div class="login_wrapper ">
        <div class="animate form login_form ">
            <section class="login_content">
                <form method="POST" action="{{ route('login.custom') }}">
                    @csrf
                    <h1>Login</h1>
                    <div class="form-group row">
                        <input id="email" type="email" placeholder="Email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <input id="password" type="password" placeholder="Password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    <div class="form-group row">

                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>

                    </div>
                </form>
            </section>
        </div>
    </div>
@endsection

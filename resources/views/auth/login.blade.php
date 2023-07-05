@extends('layouts.app')

@section('content')
    <div class="container_form">
        <div class="form-title text-center mb-2">
            <h4 style="font-weight: 700; color: var(--color1)">SquaHR</h4>
            <p style="font-size: .8em; margin-top: -.5rem;text-align: center;width: 50ch">Lorem ipsum dolor sit amet
                consectetur
                adipisicing elit. Cumque, provident!</p>

        </div>
        <form class="squahr_form" method="POST" action="{{ route('login') }}">

            @csrf

            <div class="mb-3">
                <label for="email" class="">{{ __('Email Address') }}</label>

                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="enter the email"
                    autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class=" mb-3">
                <label for="password" class="">{{ __('Password') }}</label>

                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password" placeholder="enter the password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="row mb-0">
                <button type="submit" class="squahr_btn" style="width: 95%; margin: auto">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif

            </div>
        </form>


    </div>
@endsection

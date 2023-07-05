@extends('layouts.app')

@section('content')
    <div class="container_form">

        <div class="form-title text-center mb-2">
            <h4 style="font-weight: 700; color: var(--color1)">SquaHR</h4>
            <p style="font-size: .8em; margin-top: -.5rem;text-align: center;width: 50ch">Lorem ipsum dolor sit amet
                consectetur
                adipisicing elit. Cumque, provident!</p>

        </div>
        <form method="POST" class="squahr_form mb-2" action="{{ route('register') }}">
            @csrf

            <div class=" mb-3">
                <label for="name">{{ __('Name') }}</label>

                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="enter your name">

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class=" mb-3">
                <label for="email">{{ __('Email Address') }}</label>

                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="enter your email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class=" mb-3">
                <label for="password">{{ __('Password') }}</label>

                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password" placeholder="enter a password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class=" mb-3">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>

                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password" placeholder="">
            </div>

            <div class="row mb-0">
                <button type="submit" class="squahr_btn" style="width: 95%; margin: auto">
                    {{ __('Register') }}
                </button>
            </div>


        </form>
    </div>
@endsection

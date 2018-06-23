@extends('layouts.default')

@section('content')
    <div class="container">
        <h3>{{ __('Reset Password') }}</h3>
        <div class="card grey lighten-4">
            <div class="card-content">
                <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="input-field">
                        <input id="email" type="email" class="validate{{ $errors->has('email') ? ' invalid' : '' }}"
                               name="email" value="{{ $email ?? old('email') }}" required autofocus>
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="input-field">
                        <input id="password" type="password"
                               class="validate{{ $errors->has('password') ? ' invalid' : '' }}"
                               name="password" required>
                        <label for="password">{{ __('Password') }}</label>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="input-field">
                        <input id="password-confirm" type="password" class="validate"
                               name="password_confirmation" required>
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ __('Reset Password') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.default')

@section('content')
    <div class="container">
        <h3>{{ __('Login') }}</h3>
        <div class="card grey lighten-4">
            <div class="card-content">
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf

                    <div class="input-field">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email"
                               class="validate{{ $errors->has('email') ? ' invalid' : '' }}" name="email"
                               value="{{ old('email') }}" required autofocus>
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

                    <p>
                        <label for="remember">
                            <input type="checkbox"
                                   id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} />
                            <span>{{ __('Remember Me') }}</span>
                        </label>
                    </p>

                    <button type="submit" class="btn red accent-2">
                        {{ __('Login') }}
                    </button>

                    <a class="btn" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>

                    <a class="btn blue" href="{{ route('login.social', 'facebook') }}">
                        {{ __('Sign Up With Facebook') }}
                    </a>
                </form>

            </div>
        </div>
    </div>
@endsection

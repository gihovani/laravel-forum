@extends('layouts.default')

@section('content')
    <div class="container">
        <h3>{{ __('Register') }}</h3>
        <div class="card grey lighten-4">
            <div class="card-content">
                <form method="POST" action="{{ route('profile.update') }}" aria-label="{{ __('Register') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="input-field">
                        <input id="name" type="text" class="validate{{ $errors->has('name') ? ' invalid' : '' }}"
                               name="name" value="{{ old('name', $user->name) }}" required autofocus>
                        <label for="name">{{ __('Name') }}</label>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="file-field input-field">
                        <div class="btn">
                            <span>{{ __('Photo') }}</span>
                            <input id="photo" type="file"
                                   name="photo">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                        @if ($errors->has('photo'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('photo') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="input-field">
                        <input id="email" type="email"
                               class="validate{{ $errors->has('email') ? ' invalid' : '' }}" name="email"
                               value="{{ old('email', $user->email) }}" required>
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
                               name="password">
                        <label for="password">{{ __('Password') }}</label>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="input-field">

                        <input id="password-confirm" type="password" class="validate"
                               name="password_confirmation">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

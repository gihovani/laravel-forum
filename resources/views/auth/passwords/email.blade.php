@extends('layouts.default')

@section('content')
    <div class="container">
        <h3>{{ __('Reset Password') }}</h3>
        <div class="card grey lighten-4">
            <div class="card-content">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                    @csrf

                    <div class="input-field">
                        <input id="email" type="email"
                               class="validate{{ $errors->has('email') ? ' invalid' : '' }}" name="email"
                               value="{{ old('email') }}" required>
                        <label for="email">{{ __('E-Mail Address') }}</label>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>


                    <button type="submit" class="btn btn-primary">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

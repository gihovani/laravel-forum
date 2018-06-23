@extends('layouts.default')

@section('content')
    <div class="container">
        <h3>{{ $thread->title }}</h3>
        <div class="card grey lighten-4">
            <div class="card-content">
                {{ $thread->body }}
            </div>
            <div class="card-action">
                @if(\Auth::user() && \Auth::user()->can('update', $thread))
                    <a href="{{ route('threads.edit', $thread->id) }}">{{ __('Edit') }}</a>
                @endif
                <a href="{{ route('home') }}">{{ __('Back') }}</a>
            </div>
        </div>

        <replies replied="{{ __('replied') }}"
                 reply="{{ __('Reply') }}"
                 your-answer="{{ __('Your Answer') }}"
                 send="{{ __('Send') }}"
                 thread-id="{{$thread->id}}"
                 highlight="{{ __('Highlight') }}"
                 is-open="{{!$thread->closed}}">
            @include('layouts.default.preloader')
        </replies>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/replies.js') }}"></script>
@endsection

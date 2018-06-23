@extends('layouts.default')

@section('content')
    <div class="container">
        <h3>{{ __('Most recent threads') }}</h3>
        <threads
            title="{{ __('Threads') }}"
            threads="{{ __('Threads') }}"
            replies="{{ __('Replies') }}"
            open="{{ __('Open') }}"
            pin="{{ __('Pin') }}"
            new-thread="{{ __('New Thread') }}"
            thread-title="{{ __('Title') }}"
            thread-body="{{ __('Body') }}"
            send="{{ __('Send') }}"
            close="{{ __('Close') }}">
            @include('layouts.default.preloader')
        </threads>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/threads.js') }}"></script>
@endsection

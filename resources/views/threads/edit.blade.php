@extends('layouts.default')

@section('content')
    <div class="container">
        <h3>{{ $thread->title }}</h3>
        <div class="card grey lighten-4">
            <div class="card-content">
                <form action="{{ route('threads.update', $thread->id) }}" method="post">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    <div class="input-field">
                        <input type="text" placeholder="{{ __('Title')}}" value="{{$thread->title}}" name="title">
                    </div>
                    <div class="input-field">
                        <textarea class="materialize-textarea" rows="10" placeholder="{{ __('Body') }}"
                                  name="body">{{$thread->body}}</textarea>
                    </div>
                    <button type="submit" class="btn red accent-2">{{ __('Send') }}</button>
                </form>
            </div>
            <div class="card-action">
                <a href="{{ route('threads.show', $thread->id) }}">{{ __('Back') }}</a>
            </div>
        </div>
    </div>
@endsection

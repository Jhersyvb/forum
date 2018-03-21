@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="border-bottom mb-5">
                    {{ $profileUser->name }}
                    <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
                </h1>

                @foreach ($threads as $thread)
                    <div class="card mb-3">
                        <div class="card-header bg-transparent">
                            <div class="row">
                                <span class="col">
                                    <a href="{{ route('profile', $thread->creator) }}">
                                        {{ $thread->creator->name }}
                                    </a> posted: <a href="{{ $thread->path() }}">
                                        {{ $thread->title }}
                                    </a>
                                </span>
                                <span class="col-auto">
                                    {{ $thread->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>

                        <div class="card-body">
                            {{ $thread->body }}
                        </div>
                    </div>
                @endforeach

                {{ $threads->links() }}
            </div>
        </div>
    </div>
@endsection
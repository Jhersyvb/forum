@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('profile', $thread->creator->name) }}">
                                {{ $thread->creator->name }}
                            </a> posted: {{ $thread->title }}
                        </div>

                        @can('update', $thread)
                            <div class="col-auto">
                                <form action="{{ $thread->path() }}" method="POST">
                                    {{ csrf_field() }}

                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-link">Delete Thread</button>
                                </form>
                            </div>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    {{ $thread->body }}
                </div>
            </div>

            @foreach ($replies as $reply)
                @include ('threads.reply')
            @endforeach

            {{ $replies->links() }}

            @guest
                <p class="text-center my-5">
                    Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion.
                </p>
            @else
                <form method="POST" action="{{ $thread->path() }}/replies" class="my-5">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <textarea name="body" id="body" class="form-control"
                                  placeholder="Have something to say?" rows="5">
                        </textarea>
                    </div>

                    <button type="submit" class="btn btn-default">Post</button>
                </form>
            @endguest
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <p>
                        This thread was published {{ $thread->created_at->diffForHumans() }} by
                        <a href="#">{{ $thread->creator->name }}</a>, and currently
                        has {{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }}.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

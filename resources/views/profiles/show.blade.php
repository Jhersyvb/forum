@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="border-bottom mb-5">
                    {{ $profileUser->name }}
                    <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
                </h1>

                @foreach ($activities as $date => $activity)
                    <h3 class="border-bottom mb-3">{{ $date }}</h3>

                    @foreach ($activity as $record)
                        @if (view()->exists("profiles.activities.{$record->type}"))
                            @include("profiles.activities.{$record->type}", ['activity' => $record])
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
@endsection
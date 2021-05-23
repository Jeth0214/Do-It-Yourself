@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
        @if ($ideas->count() > 0)
        @foreach ($ideas as $idea)
        <div class="col-md-6 offset-md-3 my-3">
            <div class="card ">
                <video class="w-100" controls>
                    <source src="{{$idea->video}}" type="video/mp4">
                </video>

                <div class="card-body">
                    <h5 class="card-title text-primary mb-1">{{ $idea->caption}}</h5>
                    <small class="text-muted">
                        <span>Posted: </span>
                        @php
                        $date=date_create("$idea->created_at");
                        echo date_format($date,"m/d/Y H:i:a");
                        @endphp
                    </small>
                    <div>
                        <small class="text-muted">
                            Created By:
                            <span class="text-primary">{{$idea->user->username}}</span>
                        </small>
                    </div>

                    <p class="mt-3">
                        @php
                        echo substr($idea->instructions,0,40)
                        @endphp
                        ...
                    </p>

                    <a href="/ideas/{{$idea->id}}" class="card-link">More Details</a>
                </div>
            </div>
        </div>

        @endforeach
        @else
        <div class="text-center">
            <h4><em class="text-muted">No ideas created yet....</em></h4>
        </div>
        @endif
    </div>
</div>
@endsection






<!-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div> -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <div class="d-flex justify-content-between ">
                <div class="text-center w-100 border-bottom border-primary p-2">
                    <a href="/home/ideas" class="text-decoration-none h5 ">All Ideas</a>
                </div>
                <div class="text-center w-100 p-2 border-bottom">
                    <a href="/home/saved-ideas" class="text-decoration-none h5 text-muted">Saved Ideas</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row ">
        @if ($ideas->count() > 0)
        @foreach ($ideas as $idea)
        <div class="col-6 offset-md-3 my-3">
            <div class="card ">
                <video class="w-100" controls>
                    <source src="{{$idea->video}}" type="video/mp4">
                </video>

                <div class="card-body">
                    <div class="d-flex align-items-baseline justify-content-between">
                        <h5 class="card-title text-primary mb-1 text-yellow">{{ $idea->caption}}</h5>
                        <save-button idea-id="{{$idea->id}}" saves="{{$idea->saves}}"></save-button>
                    </div>
                    <div>
                        <a href="/profile/{{$idea->user->id}}">
                            <img src=" {{ $idea->user->profileImage()}}" width="30" height="30" alt="profile image" class="rounded-circle mr-1">
                            <span class="text-primary">{{ $idea->user->username }}</span>
                        </a>
                    </div>
                    <small class="text-muted">
                        <span>Posted: </span>
                        @php
                        $date=date_create("$idea->created_at");
                        echo date_format($date,"m/d/Y H:i:a");
                        @endphp
                    </small>


                    <p class="mt-3">
                        @php
                        echo substr($idea->instructions,0,40)
                        @endphp
                        ...
                    </p>

                    <a href="/ideas/{{$idea->id}}" class="btn btn-primary text-yellow btn-sm">More Details</a>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="col-md-6 offset-md-3 mt-5 text-center">
            <h4><em class="text-muted">No ideas created yet....</em></h4>
        </div>
        @endif
    </div>

    <div class="row">
        <div class="col d-flex justify-content-center">
            {{$ideas->links()}}
        </div>
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

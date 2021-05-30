@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <div class="d-flex justify-content-between">
                <div class="text-center w-100 p-2 border-bottom">
                    <a href="/home/ideas" class="text-decoration-none h5 text-muted test">All Ideas</a>
                </div>
                <div class="text-center w-100 border-bottom border-primary p-2">
                    <a href="/home/saved-ideas" class="text-decoration-none h5">Saved Ideas</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row ">

        <div class="col-md-6 offset-md-3 my-3">
            @if ($saves->count() > 0)
            @foreach ($saves as $save)
            <div class="card ">
                <video class="w-100" controls>
                    <source src="{{$save->video}}" type="video/mp4">
                </video>

                <div class="card-body">
                    <div class="d-flex align-items-baseline justify-content-between">
                        <h5 class="card-title text-primary mb-1">{{ $save->caption}}</h5>
                        <save-button idea-id="{{$save->id}}" saves="{{$save->saves}}"></save-button>
                    </div>
                    <small class="text-muted">
                        <span>Posted: </span>
                        @php
                        $date=date_create("$save->created_at");
                        echo date_format($date,"m/d/Y H:i:a");
                        @endphp
                    </small>
                    <div>
                        <small class="text-muted">
                            Created By:
                            <span class="text-primary">{{$save->user->username}}</span>
                        </small>
                    </div>

                    <p class="mt-3">
                        @php
                        echo substr($save->instructions,0,40)
                        @endphp
                        ...
                    </p>

                    <a href="/ideas/{{$save->id}}" class="card-link">More Details</a>
                </div>
            </div>
            @endforeach
            @else
            .
            <div class="text-center">
                <h4><em class="text-muted">You don't have any saved idea....</em></h4>
            </div>
            @endif
        </div>


    </div>
</div>
@endsection

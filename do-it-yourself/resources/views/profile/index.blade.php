@extends('layouts.app')

@section('content')

<div class="container ">
    <div class="text-right">
        <a href=" /home/ideas" class="btn btn-primary">
            <span class="text-yellow">Back Home</span>
        </a>
    </div>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="profile-image-container">
                <img src="{{ $user->profileImage()}}" alt="No Image Logo" class="profile-image img-thumbnail">
            </div>

            <div class="card mt-3 border border-primary">
                <div class="card-content pt-5 text-center">
                    <h3>{{$user->name}}</h3>
                    <p class="mb-0">{{$user->username}}</p>
                    <p class="mb-0">{{$user->email}}</p>
                    @if ($user->profile)
                    <small>
                        <a href="{{$user->profile->url}}">{{$user->profile->url}}</a>
                    </small>
                    @endif

                    <div class="row mt-4">
                        <div class="col-6 text-right">
                            <p> {{$user->savingIdeas->count()}} ideas saved</p>
                        </div>
                        <div class="col-6 text-left">
                            <p> {{$user->ideas->count()}} ideas created</p>
                        </div>
                    </div>

                    @can('update', $user->profile)
                    <div class="d-flex justify-content-around pb-4">
                        <a href="/profile/{{$user->id}}/edit" class="btn btn-primary">
                            <span class="text-yellow">
                                Edit Profile
                            </span>
                        </a>
                        <a href="/ideas/create" class="btn btn-primary">
                            <span class="text-yellow">
                                Add Ideas
                            </span>
                        </a>
                    </div>
                    @endcan

                </div>

            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
        <strong>Success</strong> {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row">
        @if ($user->ideas->count() > 0)
        @foreach ($ideas as $idea)
        <div class="col-md-4 my-3">
            <div class="card ideas">
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

        <div class="mx-auto mt-5">
            <h4><em class="text-muted">No ideas created yet....</em></h4>
        </div>

        @endif
    </div>



    <div class="row">
        <div class="col d-flex justify-content-end">
            {{$ideas->links()}}
        </div>
    </div>
</div>

@endsection

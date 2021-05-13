@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <!-- <img src="/img/no-profile-image.png" alt="No Image Logo" class="profile-image rounded-circle img-thumbnail"> -->
            <div class="profile-image-container">
                <img src="{{ $user->profileImage()}}" alt="No Image Logo" class="profile-image img-thumbnail">
            </div>

            <div class="card border border-primary">
                <div class="card-content pt-5 text-center">
                    <h3>{{$user->name}}</h3>
                    <p class="mb-0">{{$user->profile->username}}</p>
                    <p class="mb-0">{{$user->email}}</p>
                    <small>
                        <a href="{{$user->profile->url}}">{{$user->profile->url}}</a>
                    </small>
                    <div class="row mt-4">
                        <div class="col-6 text-right">
                            <p> 3 ideas saved</p>
                        </div>
                        <div class="col-6 text-left">
                            <p> 4 ideas created</p>
                        </div>
                    </div>

                    @can('update', $user->profile)
                    <div class="d-flex justify-content-around pb-4">
                        <a href="/profile/{{$user->id}}/edit" class="btn btn-primary">
                            <span class="text-yellow">
                                Edit Profile
                            </span>
                        </a>
                        <a href="#" class="btn btn-primary">
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
</div>

@endsection

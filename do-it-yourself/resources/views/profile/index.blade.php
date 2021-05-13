@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <img src="/img/no-image-available.png" alt="No Image Logo" class="profile-image">
            <div class="card border border-primary">
                <div class="card-content pt-5 text-center">
                    <h3>{{$user->username}}</h3>
                    <p>{{$user->profile->title}}</p>

                    <div class="row">
                        <div class="col-6 text-right">
                            <p> 3 ideas saved</p>
                        </div>
                        <div class="col-6 text-left">
                            <p> 4 ideas created</p>
                        </div>
                    </div>

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
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

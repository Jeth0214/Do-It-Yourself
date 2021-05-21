@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@section('content')
<div class="container">
    <div class="spinner-container">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-text text-primary">
            Updating...
        </div>
    </div>
    <div class="row">


        <div class="col-md-8 offset-md-2">
            <div class="card border border-primary">
                <div class="card-header text-center">
                    <h4 class="text-primary">Edit Profile</h4>
                </div>
                <div class="card-body px-5">
                    <form id="profile-form" action="/profile/{{$user->id}}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group ">
                            <label for="name" class="col-form-label text-primary">Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name}}" autocomplete="name">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <div class="form-group ">
                            <label for="username" class="col-form-label text-primary">Username</label>
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') ?? $user->username}}" autocomplete="username">

                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <div class="form-group ">
                            <label for="email" class="col-form-label text-primary">Email</label>
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email}}" autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="form-group ">
                            <label for="title" class="col-form-label text-primary">Title</label>
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $user->profile->title}}" autocomplete="title">

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>


                        <div class="form-group ">
                            <label for="description" class="col-form-label text-primary">Description</label>
                            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') ?? $user->profile->description}}" autocomplete="description">

                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="form-group ">
                            <label for="url" class="col-form-label text-primary">Url</label>
                            <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url') ?? $user->profile->url }}" autocomplete="url">

                            @error('url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="profile_img" class="text-primary">Select Profile Image</label>
                            <input id="profile_img" type="file" class="form-control-file @error('profile_img') is-invalid @enderror" name="profile_img" value="{{ old('profile_img') ?? $user->profileImage() }}">

                            @error('profile_img')
                            <strong class="invalid-feedback">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <label for="password" class="col-form-label text-primary">Enter or Create New Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password')}}" autocomplete="password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <div class="d-flex justify-content-between pt-5">
                            <div class="">
                                <button class="btn btn-primary text-yellow" id="save">Save Profile</button>
                            </div>
                            <div class="">
                                <a class="btn btn-primary text-yellow" href="/profile/{{$user}}">Back to Profile</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
    // wait for the DOM to be loaded
    $(document).ready(function() {

        var spinner = $('.spinner-container');

        spinner.hide();
        $("#save").click(function() {
            if ($("input[type='password']").val() != "") {
                spinner.show();
            } else {
                spinner.hide()
            }

        })

    });
</script>

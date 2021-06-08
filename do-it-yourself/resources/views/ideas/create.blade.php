@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@section('content')
<div class="container">
    <div class="spinner-container">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-text text-primary mt-3">
            Creating...
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card border border-primary">
                <div class="card-header text-center">
                    <h4 class="text-primary">Create Idea</h4>
                </div>
                <div class="card-body px-5">
                    <form id="form" action="/ideas" enctype="multipart/form-data" method="post">
                        @csrf

                        <!-- caption  -->
                        <div class="form-group ">
                            <label for="caption" class="col-form-label text-primary">Caption</label>
                            <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}" autocomplete="caption">

                            @error('caption')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Materials  -->
                        <div class="form-group ">
                            <label for="materials" class="col-form-label text-primary">Materials ( comma "," seperated )</label>
                            <textarea id="materials" class="form-control @error('materials') is-invalid @enderror" name="materials" autocomplete="materials">{{ old('materials') }}</textarea>

                            @error('materials')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Instruction  -->
                        <div class="form-group ">
                            <label for="instructions" class="col-form-label text-primary">Instructions</label>
                            <textarea id="instructions" class="form-control @error('instructions') is-invalid @enderror" name="instructions">{{trim(old('instructions'))}}</textarea>

                            @error('materials')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Video   -->
                        <div class="form-group">
                            <label for="video" class="text-primary">Upload video</label>
                            <input id="video" type="file" class="form-control-file @error('video') is-invalid @enderror" name="video" value="{{ old('video')}}">

                            @error('video')
                            <strong class="invalid-feedback">{{ $message }}</strong>
                            @enderror
                        </div>


                        <div class="d-flex justify-content-between pt-5">
                            <div class="">
                                <!-- <button class="btn btn-primary text-yellow">Add</button> -->
                                <input type="submit" value="Submit" id="submit" class="btn btn-primary text-yellow">
                            </div>
                            <div class="">
                                <a class="btn btn-primary text-yellow" href="/profile/{{$user->id}}">Back to Profile</a>
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
        $("#submit").click(function() {
            spinner.show();
        })

    });
</script>

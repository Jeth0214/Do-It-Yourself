@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card border border-primary">
                <div class="card-header text-center">
                    <h4 class="text-primary">Add Idea</h4>
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
                            <textarea id="materials" class="form-control @error('materials') is-invalid @enderror" name="materials" value="{{ old('materials') }}" autocomplete="materials">

                            </textarea>

                            @error('materials')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Instruction  -->
                        <div class="form-group ">
                            <label for="instructions" class="col-form-label text-primary">Instructions</label>
                            <textarea id="instructions" cols="30" class="form-control @error('instructions') is-invalid @enderror" name="instructions" value="{{ old('instructions') }}" autocomplete="instructions">

                            </textarea>

                            @error('materials')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!-- <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                        </div> -->
                        <div class="progress">
                            <div class="bar"></div>
                            <div class="percent">0%</div>
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
                                <input type="submit" value="Submit" class="btn btn-primary text-yellow">
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

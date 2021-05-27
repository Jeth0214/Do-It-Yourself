@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-3 border border-primary">
        <div class="row no-gutters">
            <div class="col-md-4">
                <video class="w-100" controls>
                    <source src="{{$idea->video}}" type="video/mp4">
                </video>
                <div class="d-none d-sm-block mt-3">
                    <div class="d-flex justify-content-around align-items-baseline">
                        @can('update', $idea)
                        <a href="/ideas/{{$idea->id}}/edit" class="btn btn-success btn-sm">
                            <span class="text-yellow"> Edit</span>
                        </a>
                        @endcan

                        @can('delete', $idea)
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">
                            Delete
                        </button>
                        @endcan
                    </div>
                </div>

            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                        <h3 class="card-title text-primary">{{$idea->caption}}</h3>

                        <div>
                            <a href=" /profile/{{$idea->user->id}}" class="btn btn-primary btn-sm">
                                <span class="text-yellow">View Creator's Profile</span>
                            </a>
                            <a href=" /home" class="btn btn-primary btn-sm">
                                <span class="text-yellow">Back Home</span>
                            </a>
                        </div>

                    </div>

                    <p class="card-text mb-0 pb-0">
                        Created By:
                        <a href="/profile/{{$idea->user->id}}">
                            <span class="text-primary">{{$idea->user->username}}</span>
                        </a>
                    </p>

                    <p class="card-text mt-0">
                        Posted:
                        <small class="text-muted">
                            @php
                            $date=date_create("$idea->created_at");
                            echo date_format($date,"m/d/Y H:i:a");
                            @endphp
                        </small>
                    </p>

                    <h5 class="text-primary">Instructions :</h5>
                    <p>{{$idea->instructions}}</p>

                    <div class="p-2">
                        <h5 class="text-primary">Materials :</h5>
                        <ul class="list-group">
                            @php
                            $materials = explode("," , $idea->materials);
                            @endphp

                            @foreach ($materials as $material)
                            <li class="list-group-item d-flex p-1">
                                <i class="material-icons mr-2">play_arrow</i>
                                <span>{{$material}}</span>
                            </li>
                            @endforeach

                        </ul>
                    </div>

                    <div class="d-md-none">
                        <div class="d-flex justify-content-between">
                            @can('update', $user->idea)
                            <a href="/ideas/{{$idea->id}}/edit" class="btn btn-success btn-sm">
                                <span class="text-yellow"> Edit</span>
                            </a>
                            @endcan


                            <!-- Button trigger modal -->
                            @can('delete', $user->idea)
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">
                                Delete
                            </button>
                            @endcan
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this idea?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <form action="/ideas/{{$idea->id}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Yes, delete it!" class="btn btn-danger">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

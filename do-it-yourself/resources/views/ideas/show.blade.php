@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-md-2">
            <div class="mb-2">
                <a href=" /home/ideas" class="btn btn-primary">
                    <span class="text-yellow">Back Home</span>
                </a>
            </div>
            <div class="card mb-3 border border-primary">
                <div class="row no-gutters">
                    <video class="w-100" controls>
                        <source src="{{$idea->video}}" type="video/mp4">
                    </video>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h3 class="card-title text-primary">{{$idea->caption}}</h3>
                            <div>
                                <save-button idea-id="{{$idea->id}}" saves="{{$idea->saves}}"></save-button>

                            </div>
                        </div>

                        <div>
                            <a href="/profile/{{$idea->user->id}}">
                                <img src=" {{ $idea->user->profileImage()}}" width="30" height="30" alt="profile image" class="rounded-circle mr-1">
                                <span class="text-primary">{{ $idea->user->username }}</span>
                            </a>
                        </div>

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
                                    <i class="far fa-hand-point-right mt-1 mr-2 text-primary"></i>
                                    <span>{{$material}}</span>
                                </li>
                                @endforeach

                            </ul>
                        </div>

                        <div class="mt-3">
                            <div class="d-flex justify-content-around align-items-baseline">
                                @can('update', $idea)
                                <a href="/ideas/{{$idea->id}}/edit" class="btn btn-success">
                                    <span class="text-yellow"> Edit</span>
                                </a>
                                @endcan

                                @can('delete', $idea)
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger text-yellow" data-toggle="modal" data-target="#deleteModal">
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

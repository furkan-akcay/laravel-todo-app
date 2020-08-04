@extends('layouts.layout')

@section('title', 'Projects')

@section('breadcrumb')
{{ Breadcrumbs::render('projects') }}
@endsection

@section('content')
<div class="row my-2">
    <div class="col-10">
        <h3 class="mb-4">To Do List</h3>
    </div>
    <div class="col-2 d-inline-flex justify-content-end align-content-center">
        <a href="{{route('projects.create')}}">Create List</a>
    </div>
</div>

@foreach ($projects as $project)
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <h4 class="card-title">
                    <a href="{{route('projects.show', $project->id)}}">{{$project->title}}</a>
                </h4>
            </div>
            <div class="col-6 d-inline-flex justify-content-end align-content-center">
                <small class="mt-2 mr-2">{{$project->updated_at}}</small>
                <a href="{{route('projects.edit', $project->id)}}">
                    <button type="button" class="btn btn-link mx-1"><i class="fa fa-pencil-square-o"
                            aria-hidden="true"></i>
                        Update</button>
                </a>
                <form action="{{route('projects.destroy', $project->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link mx-1"><i class="fa fa-trash-o" aria-hidden="true"></i>
                        Delete</button>
                </form>
            </div>
        </div>
        <p class="card-text" style="width:100ch; overflow:hidden; white-space:nowrap; text-overflow:ellipsis">
            {{$project->description}}</p>
    </div>
</div>
@endforeach

@endsection
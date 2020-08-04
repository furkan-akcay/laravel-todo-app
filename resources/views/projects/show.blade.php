@extends('layouts.layout')

@section('title', 'Project')
@section('breadcrumb')
{{ Breadcrumbs::render('project', $project) }}
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <h2 class="col-8 card-title">{{$project->title}}</h2>
            <div class="col-4 d-inline-flex justify-content-end align-content-center">
                <small class="mt-2">{{$project->updated_at}}</small>
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
        <hr>
        <p class="card-text">{{$project->description}}</p>
        <hr>
        <form action="{{route('tasks.store', $project->id)}}" method="post">
            @csrf
            <div class="form-row">
                <div class="col-auto">
                    <input type="text" name="task" id="task"
                        class="form-control @error('task') {{'is-invalid'}} @enderror" placeholder="Task"
                        aria-describedby="helpId">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-link">Add</button>
                </div>

                @error('task')
                <div class="col-auto mt-1">
                    <small class="text-danger">{{$message}}</small>
                </div>
                @enderror
            </div>
        </form>
        <hr>
        <h4 class="card-title mt-5">Tasks</h4>
        <ul class="list-group list-group-flush">
            @foreach ($project->tasks as $task)
            <li class="list-group-item">
                <form action="{{route('tasks.completed', $task->id)}}" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="checkbox" autocomplete="off" name="completed" onchange="this.form.submit()"
                        {{$task->completed ? 'checked' : ''}}>
                    <span class="glyphicon glyphicon-ok"></span>
                    <label style="{{$task->completed ? 'text-decoration: line-through' : ''}}">{{$task->title}}</label>
                    @if ($task->completed)
                    <small class=" text-success">Completed!</small>
                    @endif
                </form>
            </li>
            @endforeach
        </ul>

    </div>
</div>
@endsection
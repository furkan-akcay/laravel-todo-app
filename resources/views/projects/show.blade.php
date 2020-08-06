@extends('layouts.app')

@section('title', 'Project')
@section('breadcrumb')
{{ Breadcrumbs::render('project', $project) }}
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">

            <h2 class="col card-title">{{$project->title}}</h2>

            <div class="col d-inline-flex justify-content-end align-content-center">
                <small class="mt-2">{{$updated_at}}</small>

                <a href="{{route('projects.edit', $project->id)}}">
                    <button type="button" class="btn btn-link mr-1 ml-3"><i class="fa fa-pencil-square-o"
                            aria-hidden="true"></i>
                        Update</button>
                </a>

                <form action="{{route('projects.destroy', $project->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link"><i class="fa fa-trash-o" aria-hidden="true"></i>
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
                <div class="col-10">
                    <input type="text" name="task" id="task"
                        class="form-control w-100 @error('task') {{'is-invalid'}} @enderror" placeholder="Add a Task..."
                        aria-describedby="helpId" required>
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-link">Add</button>
                </div>

                @error('task')
                <div class="col-auto mt-1">
                    <small class="text-danger">{{$message}}</small>
                </div>
                @enderror
            </div>
        </form>

        @if (isset($project->tasks) && count($project->tasks) > 0)
        <hr>

        <h4 class="card-title mt-2">Tasks</h4>

        <ul class="list-group list-group-flush">
            @foreach ($project->tasks as $task)
            <li class="list-group-item align-content-center">
                <form action="{{route('tasks.completed', $task->id)}}" method="post">
                    @csrf
                    @method('PATCH')

                    <input type="checkbox" autocomplete="off" name="completed" onchange="this.form.submit()"
                        {{$task->completed ? 'checked' : ''}}>
                    <span class="glyphicon glyphicon-ok"></span>

                    <label>
                        {{$task->title}}
                    </label>

                    @if ($task->completed)
                    <span class="badge badge-success badge-pill" data-toggle="tooltip" data-placement="right"
                        title="{{$updated_at}}">Completed!</span>
                    @endif
                </form>
            </li>
            @endforeach
        </ul>

        @endif
    </div>
</div>
@endsection
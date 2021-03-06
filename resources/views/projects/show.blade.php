@extends('layouts.app')

@section('title', 'Project')

@section('breadcrumb')
{{ Breadcrumbs::render('project', $project) }}
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">

            <h2 class="col card-title">{{ $project->title }}</h2>

            <div class="col d-inline-flex justify-content-end align-content-center">
                <small class="mt-2">{{ $project->updatedAt() }}</small>

                <!--Update project page link-->
                <a href="{{ route('projects.edit', $project->id) }}">
                    <button type="button" class="ml-3 mr-1 btn btn-link"><i class="fa fa-pencil-square-o"
                            aria-hidden="true"></i>
                        Update</button>
                </a>

                <!--Delete project-->
                <form action="{{ route('projects.destroy', $project->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link delete"><i class="fa fa-trash-o" aria-hidden="true"></i>
                        Delete</button>
                </form>

            </div>
        </div>

        <hr>

        <p class="card-text">{{ $project->description }}</p>

        <hr>

        <!--Create task form-->
        <form action="{{ route('tasks.store', $project->id) }}" method="post">
            @csrf
            <div class="form-row">
                <div class="col-10">
                    <input type="text" name="createTask" id="createTask"
                        class="form-control w-100 @error('createTask') {{ 'is-invalid' }} @enderror"
                        placeholder="Add a Task..." aria-describedby="helpId" required>
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-link w-100">Add</button>
                </div>

                @error('createTask')
                    <div class="col-auto mt-1">
                        <small class="text-danger">{{ $message }}</small>
                    </div>
                @enderror
            </div>
        </form>

        <!--List tasks-->
        @if(isset($project->tasks) && count($project->tasks) > 0)
            <hr>
            <h4 class="mt-2 card-title">Tasks</h4>

            <ul class="list-group list-group-flush">
                @foreach($project->tasks as $task)
                    <li class="list-group-item">
                        <div class="row">

                            <!--Complete task form-->
                            <div class="col-auto">
                                <form action="{{ route('tasks.complete', $task->id) }}"
                                    method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="checkbox" autocomplete="off" name="completed"
                                        onchange="this.form.submit()"
                                        {{ $task->completed ? 'checked' : '' }}>
                                    <span class="glyphicon glyphicon-ok"></span>
                                </form>
                            </div>

                            <div class="col">
                                <label>
                                    {{ $task->title }}
                                </label>
                            </div>

                            <div class="col-auto">
                                @if($task->completed)
                                    <small class="text-success">Completed at
                                        {{ $task->updatedAt() }}</small>
                                @endif
                            </div>

                            <!--Update task collapse button-->
                            <div class="col-auto">
                                <button class="p-0 mx-2 btn btn-link" data-toggle="collapse"
                                    data-target="#collapseUpdateTask{{ $task->id }}" aria-expanded="false"
                                    aria-controls="collapseExample">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </button>
                            </div>

                            <!--Delete task form-->
                            <div class="col-auto">
                                <form action="{{ route('tasks.destroy', $task->id) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-0 ml-2 btn btn-link trash"><i class="fa fa-trash-o"
                                            aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </div>

                        <!--Update task collapse form-->
                        <div class="collapse @error('updateTask') {{ 'show' }} @enderror"
                            id="collapseUpdateTask{{ $task->id }}">
                            <form action="{{ route('tasks.update', $task->id) }}"
                                method="post">
                                @csrf
                                @method('PATCH')
                                <div class="form-row">
                                    <div class="col-10">
                                        <input type="text" name="updateTask" id="updateTask"
                                            class="form-control w-100 @error('updateTask') {{ 'is-invalid' }} @enderror"
                                            value="{{ $task->title }}" aria-describedby="helpId" required>
                                    </div>
                                    <div class="col-2">
                                        <button type="submit" class="btn btn-link">Update</button>
                                    </div>

                                    @error('updateTask')
                                        <div class="col-auto mt-1">
                                            <small class="text-danger">{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>
                            </form>
                        </div>

                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection

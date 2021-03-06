@extends('layouts.app')

@section('title', 'Update Project')

@section('breadcrumb')
{{ Breadcrumbs::render('edit', $project) }}
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h3 class="card-title">Update Project</h3>
        <hr>
        <form action="{{route('projects.update', $project->id)}}" method="post" novalidate>
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text"
                    class="form-control @error('title') {{'is-invalid'}} @enderror {{old('title') ? 'is-valid' : ''}}"
                    name="title" id="title" aria-describedby="helpId" placeholder="Title" value="{{$project->title}}"
                    required>

                @if (old('title'))
                <small class="text-success">Valid!</small>
                @endif

                @error('title')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea
                    class="form-control @error('description') {{'is-invalid'}} @enderror {{old('description') ? 'is-valid' : ''}}"
                    name="description" id="description" rows="3" required>{{$project->description}}</textarea>

                @if (old('description'))
                <small class="text-success">Valid!</small>
                @endif

                @error('description')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection
@extends('layouts.layout')

@section('title', 'Create Project')

@section('breadcrumb')
{{ Breadcrumbs::render('create') }}
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h3 class="card-title">Create List</h3>
        <hr>
        <form action="{{route('projects.store')}}" method="post" novalidate>
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text"
                    class="form-control @error('title') {{'is-invalid'}} @enderror {{old('title') ? 'is-valid' : ''}}"
                    name="title" id="title" aria-describedby="helpId" placeholder="Title" value="{{old('title')}}"
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
                    name="description" id="description" rows="3" required>{{old('description')}}</textarea>

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
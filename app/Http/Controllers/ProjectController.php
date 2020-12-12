<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('projects.index', [
            'projects' => auth()->user()->projects()->latest('updated_at')->get(),
        ]);
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request, Project $project)
    {
        $project->createProject($this->validation($request));
        return redirect(route('projects.index'));
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $project->update($this->validation($request));
        return redirect(route('projects.show', $project->id));
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect(route('projects.index'));
    }

    public function validation($request)
    {
        return $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required'
        ]);
    }
}

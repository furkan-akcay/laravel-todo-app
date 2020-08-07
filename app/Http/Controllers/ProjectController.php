<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        Project::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description
        ]);
        return redirect(route('projects.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.show', [
            'project' => $project,
            'updated_at' => date('H:i d.m.Y', strtotime($project->updated_at))
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('projects.edit', [
            'project' => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        $project->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return redirect(route('projects.show', $project->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect(route('projects.index'));
    }

    public function storeTask(Request $request, Project $project)
    {
        $request->validate([
            'title' => $request->task,
        ]);
        $project->tasks()->create([
            'title' => $request->task,
        ]);
        return redirect(route('projects.show', $project->id));
    }

    public function completedTask(Request $request, Task $task)
    {
        $task->update([
            'completed' => $request->has('completed'),
        ]);
        return redirect()->back();
    }

    public function destroyTask(Task $task)
    {
        $task->delete();
        return redirect()->back();
    }
}

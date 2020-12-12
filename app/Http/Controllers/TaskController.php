<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'createTask' => 'required|min:3|max:255',
        ]);
        $project->tasks()->create([
            'title' => $request->createTask,
        ]);
        return redirect(route('projects.show', $project->id));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'updateTask' => 'required|min:3|max:255',
        ]);
        $task->update([
            'title' => $request->updateTask,
        ]);
        return redirect()->back();
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back();
    }

    public function complete(Request $request, Task $task)
    {
        $task->complete($request);
        return redirect()->back();
    }
}

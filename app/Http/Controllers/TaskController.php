<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return view('tasks.index', ['tasks' => Task::latest()->get()]);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        Task::create($request->only('title', 'description'));

        return redirect()->route('tasks.index')->with('success', 'Tâche créée !');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'required|in:à faire,en cours,terminée',
        ]);

        $task->update($validated);
        return redirect()->route('tasks.show', $task)->with('success', 'Tâche mise à jour !');
    }

    public function complete(Task $task)
    {
        $task->update(['status' => 'terminée']);
        return redirect()->route('tasks.index')->with('success', 'Tâche terminée !');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Tâche supprimée !');
    }
}

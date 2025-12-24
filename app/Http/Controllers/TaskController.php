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

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        Task::create($request->only('title', 'description'));

        return redirect('/')->with('success', 'Tâche créée !');
    }

    public function update(Task $task)
    {
        $task->update(['status' => 'terminée']);
        return redirect('/')->with('success', 'Tâche terminée !');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('/')->with('success', 'Tâche supprimée !');
    }
}

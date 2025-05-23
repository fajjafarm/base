<?php
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'user_ids' => 'nullable|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        $task = $event->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        if ($request->user_ids) {
            $task->users()->sync($request->user_ids);
        }

        return response()->json(['success' => true, 'task' => $task->load('users')]);
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task->event);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'user_ids' => 'nullable|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        $task->update($request->only(['title', 'description', 'due_date']));
        $task->users()->sync($request->user_ids ?? []);

        return response()->json(['success' => true]);
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task->event);
        $task->delete();

        return response()->json(['success' => true]);
    }
}
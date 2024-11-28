<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use App\Models\User;
use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request): Application|View|Factory
    {
        $tasks = Task::orderBy('id')->paginate();
        $taskStatuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');

        return view('tasks.index', compact('tasks', 'taskStatuses', 'users'));
    }

    public function create(): Application|View|Factory
    {
        $taskStatuses = TaskStatus::all();
        $users = User::all();

        return view('tasks.create', compact('taskStatuses', 'users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $this->getValidatedData($request);
        $validatedData['created_by_id'] = Auth::id();
        Task::create($validatedData);

        return redirect()->route('tasks.index')->with('success', 'Задача успешно создана');
    }

    public function edit(Task $task): Application|View|Factory
    {
        $taskStatuses = TaskStatus::all();
        $users = User::all();

        return view('tasks.edit', compact('task', 'taskStatuses', 'users'));
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $validatedData = $this->getValidatedData($request);
        $task->update($validatedData);

        return redirect()->route('tasks.index')->with('success', 'Задача успешно изменена');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Задача успешно удалена');
    }

    public function show(string $id): Application|View|Factory
    {
        $task = Task::findOrFail((int)$id);

        return view('tasks.show', compact('task'));
    }

    protected function getValidatedData(Request $request): array
    {
        return $request->validate([
                                                'name' => 'required|string|max:255',
                                                'description' => 'nullable|string|max:1000',
                                                'status_id' => 'required|exists:task_statuses,id',
                                                'assigned_to_id' => 'nullable|exists:users,id',
                                                'labels' => 'array',
                                                'labels.*' => 'exists:labels,id',
                                            ], [
                                                'name.required' => 'Это обязательное поле',
                                                'name.max' => 'Имя задачи не должно превышать 255 символов.',
                                                'description.max' => 'Описание не должно превышать 1000 символов.',
                                            ]);
    }
}

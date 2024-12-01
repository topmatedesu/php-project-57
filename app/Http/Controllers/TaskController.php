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
use App\Models\Label;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class TaskController extends Controller
{
    public function index(Request $request): Application|View|Factory
    {
        $tasks = QueryBuilder::for(Task::class)
                             ->allowedFilters([
                                                  AllowedFilter::exact('status_id'),
                                                  AllowedFilter::exact('created_by_id'),
                                                  AllowedFilter::exact('assigned_to_id'),
                                                  AllowedFilter::scope('label'),
                                              ])
                             ->with(['labels', 'status', 'creator', 'assignee'])
                             ->paginate();

        $taskStatuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');

        return view('tasks.index', compact('tasks', 'taskStatuses', 'users'));
    }

    public function create(): Application|View|Factory
    {
        $taskStatuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();

        return view('tasks.create', compact('taskStatuses', 'users', 'labels'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $this->getValidatedData($request);
        $validatedData['created_by_id'] = Auth::id();
        $task = Task::create($validatedData);

        if ($request->has('labels')) {
            $task->labels()->sync($request->labels);
        }

        return redirect()->route('tasks.index')->with('success', 'Задача успешно создана');
    }

    public function edit(Task $task): Application|View|Factory
    {
        $taskStatuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();

        return view('tasks.edit', compact('task', 'taskStatuses', 'users', 'labels'));
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $validatedData = $this->getValidatedData($request);
        $task->update($validatedData);

        if ($request->has('labels')) {
            $task->labels()->sync($request->labels);
        }

        return redirect()->route('tasks.index')->with('success', 'Задача успешно изменена');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Задача успешно удалена');
    }

    public function show(string $id): Application|View|Factory
    {
        $task = Task::with('labels')->findOrFail($id);

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

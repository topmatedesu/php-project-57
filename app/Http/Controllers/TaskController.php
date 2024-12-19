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
        $task = new Task();
        $taskStatuses = TaskStatus::select('name', 'id')->pluck('name', 'id');
        $users = User::select('name', 'id')->pluck('name', 'id');
        $labels = Label::select('name', 'id')->pluck('name', 'id');

        return view('tasks.create', compact('task', 'taskStatuses', 'users', 'labels'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $this->getValidatedData($request);
        /** @var User $user */
        $user = Auth::user();
        $task = $user->createdTasks()->create($validatedData);

        if ($request->has('labels')) {
            $task->labels()->sync($validatedData['labels'] ?? []);
        }

        flash()->success(__('views.task.created'));

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task): Application|View|Factory
    {
        $taskStatuses = TaskStatus::all();
        $users = User::select('name', 'id')->pluck('name', 'id');
        $labels = Label::select('name', 'id')->pluck('name', 'id');
        $taskLabels = $task->labels;

        return view('tasks.edit', compact('task', 'taskStatuses', 'users', 'labels', 'taskLabels'));
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $validatedData = $this->getValidatedData($request);
        $task->update($validatedData);

        if ($request->has('labels')) {
            $task->labels()->sync($validatedData['labels'] ?? []);
        }

        flash()->success(__('views.task.updated'));

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();
        flash()->success(__('views.task.deleted'));

        return redirect()->route('tasks.index');
    }

    public function show(Task $task, string $id): Application|View|Factory
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
                                                'name.required' => __('views.task.name_required'),
                                                'name.max' => __('views.task.name_max'),
                                                'description.max' => __('views.task.description_max'),
                                                'status_id.required' => __('views.task.status_required'),
                                            ]);
    }
}

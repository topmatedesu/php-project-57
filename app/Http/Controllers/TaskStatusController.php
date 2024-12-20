<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use App\Models\TaskStatus;

class TaskStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(): Application|View|Factory
    {
        $taskStatuses = TaskStatus::orderBy('id')->paginate();

        return view('task_statuses.index', compact('taskStatuses'));
    }

    public function create(): Application|View|Factory
    {
        $taskStatus = new TaskStatus();

        return view('task_statuses.create', compact('taskStatus'));
    }

    public function store(Request $request): RedirectResponse
    {
        $taskStatus = new TaskStatus();
        $this->saveTaskStatus($taskStatus, $request);
        flash()->success(__('views.task-status.created'));

        return redirect()->route('task_statuses.index');
    }

    public function edit(TaskStatus $taskStatus): Application|View|Factory
    {
        return view('task_statuses.edit', compact('taskStatus'));
    }

    public function update(Request $request, TaskStatus $taskStatus): RedirectResponse
    {
        $this->saveTaskStatus($taskStatus, $request);
        flash()->success(__('views.task-status.updated'));

        return redirect()->route('task_statuses.index');
    }

    public function destroy(TaskStatus $taskStatus): RedirectResponse
    {
        try {
            if ($taskStatus->tasks()->exists()) {
                flash()->error(__('views.task-status.unable_to_delete'));

                return redirect()->route('task_statuses.index');
            }
            $taskStatus->delete();
            flash()->success(__('views.task-status.deleted'));
        } catch (\Exception $e) {
            flash()->error(__('views.task-status.cannot_delete'));

            return redirect()->route('task_statuses.index');
        }

        return redirect()->route('task_statuses.index');
    }

    private function saveTaskStatus(TaskStatus $taskStatus, Request $request): void
    {
        $validated = $request->validate([
                                            'name' => 'required|min:1|max:255|unique:task_statuses',
                                        ], [
                                            'name.required' => __('views.task-status.name_required'),
                                            'name.min' => __('views.task-status.name_min'),
                                            'name.max' => __('views.task-status.name_max'),
                                            'name.unique' => __('views.task-status.name_unique'),
                                        ]);
        $taskStatus->fill($validated);
        $taskStatus->save();
    }
}

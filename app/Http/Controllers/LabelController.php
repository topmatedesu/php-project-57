<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use App\Models\Label;

class LabelController extends Controller
{
    public function index()
    {
        $labels = Label::paginate(15);

        return view('labels.index', compact('labels'));
    }

    public function create(): Factory|View|Application
    {
        $label = new Label();

        return view('labels.create', compact('label'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
                                            'name' => 'required|string|max:255|unique:labels',
                                            'description' => 'nullable|string|max:1000',
                                        ], [
                                            'name.required' => __('views.label.name_required'),
                                            'name.min' => __('views.label.name_min'),
                                            'name.max' => __('views.label.name_max'),
                                            'name.unique' => __('views.label.name_unique'),
                                            'description.max' => __('views.label.description_max'),
                                        ]);

        Label::create($validated);
        flash()->success(__('views.label.created'));

        return redirect()->route('labels.index');
    }

    public function edit(Label $label): Application|View|Factory
    {
        return view('labels.edit', compact('label'));
    }

    public function update(Request $request, Label $label): RedirectResponse
    {
        $validated = $request->validate([
                                            'name' => 'required|string|max:255|unique:labels,name,' . $label->id,
                                            'description' => 'nullable|string|max:1000',
                                        ], [
                                            'name.required' => __('views.label.name_required'),
                                            'name.min' => __('views.label.name_min'),
                                            'name.max' => __('views.label.name_max'),
                                            'name.unique' => __('views.label.name_unique'),
                                            'description.max' => __('views.label.description_max'),
                                        ]);

        $label->update($validated);
        flash()->success(__('views.label.updated'));

        return redirect()->route('labels.index');
    }

    public function destroy(Label $label): RedirectResponse
    {
        if ($label->tasks()->exists()) {
            flash()->error(__('views.label.cannot_delete'));

            return redirect()->route('labels.index');
        }

        $label->delete();
        flash()->success(__('views.label.deleted'));

        return redirect()->route('labels.index');
    }
}

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
        return view('labels.create');
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

        return redirect()->route('labels.index')->with('success', 'Метка успешно создана');
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

        return redirect()->route('labels.index')->with('success', 'Метка успешно изменена');
    }

    public function destroy(Label $label): RedirectResponse
    {
        if ($label->tasks()->count() > 0) {
            return redirect()->route('labels.index')
                             ->with('error', 'Не удалось удалить метку');
        }

        $label->delete();

        return redirect()->route('labels.index')->with('success', 'Метка успешно удалена');
    }
}

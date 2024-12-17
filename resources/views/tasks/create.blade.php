@extends('layouts.app')

@section('content')
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5">{{ __('views.task.create') }}</h1>

            <div>
                {{ html()->modelForm($task, 'POST', route('tasks.store'))->open() }}
                <div>
                    {{ html()->label(__('models.task.name'))->for('name') }}
                </div>
                <div class="mt-2">
                    {{ html()->input('text', 'name', old('name'))->value(old('name'))->class('rounded border border-gray-300 w-1/3 p-2') }}
                </div>
                @error('name')
                <div class="text-rose-600">
                    {{ $message }}
                </div>
                @enderror

                <div class="mt-2">
                    {{ html()->label(__('models.task.description'))->for('description') }}
                </div>
                <div class="mt-2">
                    {{ html()->textarea('description', old('description'))->value(old('description'))->rows(10)->cols(50)->class('rounded border border-gray-300 w-1/3 h-32 p-2') }}
                </div>
                @error('description')
                <div class="text-rose-600">
                    {{ $message }}
                </div>
                @enderror

                <div class="mt-2">
                    {!! html()->label(__('models.task.status'))->for('status_id') !!}
                </div>
                <div class="mt-2">
                    {{ html()->select('status_id', $taskStatuses)->placeholder('')->class('rounded border border-gray-300 w-1/3 p-2 bg-white') }}
                </div>
                @error('status_id')
                <div class="text-rose-600">
                    {{ $message }}
                </div>
                @enderror

                <div class="mt-2">
                    {!! html()->label(__('models.task.assigned_to'))->for('assigned_to_id') !!}
                </div>
                <div class="mt-2">
                    {{ html()->select('assigned_to_id', $users)->placeholder('')->class('rounded border border-gray-300 w-1/3 p-2 bg-white') }}
                </div>
                @error('assigned_to_id')
                <div class="text-rose-600">
                    {{ $message }}
                </div>
                @enderror

                <div class="mt-2">
                    {!! html()->label(__('models.task.labels'))->for('labels[]') !!}
                </div>
                <div class="mt-2">
                    {{ html()->select('labels[]', $labels)->multiple()->class('rounded border border-gray-300 w-1/3 p-2 bg-white') }}
                </div>

                <div class="mt-2">
                    {{ html()->submit(__('Save'))->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded') }}
                </div>
                {{ html()->closeModelForm() }}
            </div>
        </div>
    </div>
@endsection
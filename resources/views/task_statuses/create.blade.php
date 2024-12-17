@extends('layouts.app')

@section('content')
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5">{{ __('views.task-status.create') }}</h1>

            <div>
                {{ html()->modelForm($taskStatus, 'POST', route('task_statuses.store'))->open() }}
                <div>
                    {{ html()->label(__('models.task_status.name'))->for('name') }}
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
                    {{ html()->submit(__('Save'))->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded') }}
                </div>
                {{ html()->closeModelForm() }}
            </div>
        </div>
    </div>
@endsection
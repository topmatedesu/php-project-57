@extends('layouts.app')

@section('content')
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h2 class="mb-5">{{ __('views.task.edit') }}</h2>

            <form class="w-50"  action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="flex flex-col">
                    <div>
                        <label for="name">{{ __('models.task.name') }}</label>
                    </div>
                    <div class="mt-2">
                        <input class="rounded border-gray-300 w-1/3" type="text" name="name" id="name" value="{{ $task->name }}">
                    </div>
                    @error('name')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror

                    <div class="mt-2">
                        <label for="description">{{ __('models.task.description') }}</label>
                    </div>
                    <div>
                        <textarea class="rounded border-gray-300 w-1/3 h-32" name="description" id="description">{{ $task->description }}</textarea>
                    </div>
                    @error('description')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror

                    <div class="mt-2">
                        <label for="status_id">{{ __('models.task.status') }}</label>
                    </div>
                    <div>
                        <select class="rounded border-gray-300 w-1/3" name="status_id" id="status_id">
                            @foreach ($taskStatuses as $status)
                                <option value="{{ $status->id }}" @if($task->status_id == $status->id) selected @endif >
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('status_id')
                    <div class="text-rose-600">{{ $message }}</div>
                    @enderror

                    <div class="mt-2">
                        <label for="assigned_to_id">{{ __('models.task.assigned_to') }}</label>
                    </div>
                    <div>
                        <select class="rounded border-gray-300 w-1/3" name="assigned_to_id" id="assigned_to_id">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @if($task->assigned_to_id == $user->id) selected @endif>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('assigned_to_id')
                    <div class="text-rose-600">{{ $message }}</div>
                    @enderror

                    <div class="mt-2">
                        <label for="status_id">{{ __('models.task.labels') }}</label>
                    </div>
                    <div>
                        <select class="rounded border-gray-300 w-1/3 h-32" name="labels[]" id="labels[]" multiple>
                            @foreach ($labels as $label)
                                <option value="{{ $label->id }}" @if($task->labels->contains($label->id)) selected @endif>
                                    {{ $label->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-2">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">{{ __('Update') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
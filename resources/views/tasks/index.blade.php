@extends('layouts.app')

@section('content')
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5">{{ __('Tasks') }}</h1>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="w-full flex items-center">
                <div>
                    <form method="GET" action="{{ route('tasks.index') }}">
                        <div class="flex">
                            <select class="rounded border-gray-300"
                                    name="filter[status_id]"
                                    id="filter[status_id]">
                                <option value selected="">{{ __('models.task.status') }}</option>
                                @foreach($taskStatuses as $id => $name)
                                    <option value="{{ $id }}" {{ request('filter.status_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            <select class="rounded border-gray-300"
                                    name="filter[created_by_id]"
                                    id="filter[created_by_id]">
                                <option value selected="selected">{{ __('models.task.created_by') }}</option>
                                @foreach($users as $id => $name)
                                    <option value="{{ $id }}" {{ request('filter.created_by_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            <select class="rounded border-gray-300" name="filter[assigned_to_id]" id="filter[assigned_to_id]">
                                <option value selected="">{{ __('models.task.assigned_to') }}</option>
                                @foreach($users as $id => $name)
                                    <option value="{{ $id }}" {{ request('filter.assigned_to_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2" type="submit">{{ __('Apply') }}</button>
                        </div>
                    </form>
                </div>


                @auth
                    <div class="ml-auto">
                        <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                            {{ __('views.task.create') }}
                        </a>
                    </div>
                @endauth
        </div>


        <table class="mt-4">
            <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th scope="col">@lang('models.task.id')</th>
                <th scope="col">@lang('models.task.status')</th>
                <th scope="col">@lang('models.task.name')</th>
                <th scope="col">@lang('models.task.created_by')</th>
                <th scope="col">@lang('models.task.assigned_to')</th>
                <th scope="col">@lang('models.task.created_at')</th>
                @auth
                    <th scope="col">{{ __('Actions') }}</th>
                @endauth
            </tr>
            </thead>
            @foreach($tasks as $task)
            <tr class="border-b border-dashed text-left">
                <td>{{ $task->id }}</td>
                <td>{{$task->status ? $task->status->name : '' }}</td>
                <td>
                    <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.show', $task->id) }}">
                        {{ $task->name }}
                    </a>
                </td>
                <td>{{ $task->creator ? $task->creator->name : '' }}</td>
                <td>{{ $task->assignee ? $task->assignee->name : '' }}</td>
                <td>{{ $task->created_at->format('d.m.Y') }}</td>
                @auth
                    <td>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-600 hover:text-blue-900">
                            {{ __('Edit') }}
                        </a>
                        @if($task->created_by_id == auth()->id())
                            <a href="#" class="text-red-500 hover:text-red-700 ml-2" onclick="event.preventDefault(); if(confirm('Вы уверены, что хотите удалить эту задачу?')) { document.getElementById('delete-task-form-{{ $task->id }}').submit(); }">{{ __('Delete') }}</a>
                            <form id="delete-task-form-{{ $task->id }}" action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endif
                    </td>
                @endauth
            </tr>
            @endforeach
        </table>


        <div class="mt-4">
            {{ $tasks->links() }}
        </div>
    </div>
@endsection
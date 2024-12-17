@extends('layouts.app')

@section('content')
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5">{{ __('Tasks') }}</h1>

            <div class="w-full flex items-center">
                <div>
                    {{ html()->modelForm($tasks, 'GET', route('tasks.index'))->open() }}
                    <div class="flex">
                        <div>
                            {{ html()->select('filter[status_id]', $taskStatuses, $filter['status_id'] ?? null)->placeholder(__('models.task.status'))->class('rounded border-gray-300') }}
                        </div>
                        <div>
                            {{ html()->select('filter[created_by_id]', $users, $filter['created_by_id'] ?? null)->placeholder(__('models.task.created_by'))->class('ml-2 rounded border-gray-300') }}
                        </div>
                        <div>
                            {{ html()->select('filter[assigned_to_id]', $users, $filter['assigned_to_id'] ?? null)->placeholder(__('models.task.assigned_to'))->class('ml-2 rounded border-gray-300') }}
                        </div>
                        <div>
                            {{ html()->submit(__('Apply'))->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2') }}
                        </div>    
                    </div>
                    {{ html()->closeModelForm() }}
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
                        @can('delete', $task)
                            <a class="text-red-600 hover:text-red-900" href="{{route('tasks.destroy', $task->id)}}" data-confirm="{{ __('Are you sure?') }}" data-method="delete">
                                {{ __('Delete') }}
                            </a>
                        @endcan
                        @can('update', $task)
                            <a class="text-blue-600 hover:text-blue-900" href="{{route('tasks.edit', $task->id)}}">
                                {{ __('Edit') }}
                            </a>
                        @endcan
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
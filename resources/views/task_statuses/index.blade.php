@extends('layouts.app')

@section('content')
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5">{{ __('Statuses') }}</h1>

            <div>
                @auth
                    <div>
                        <a href="{{ route('task_statuses.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('views.task-status.create') }}
                        </a>
                    </div>
                @endauth
            </div>

            <table class="mt-4">
                <thead class="border-b-2 border-solid border-black text-left">
                <tr>
                    <th scope="col">@lang('models.task_status.id')</th>
                    <th scope="col">@lang('models.task_status.name')</th>
                    <th scope="col">@lang('models.task_status.created_at')</th>
                    @auth
                        <th scope="col">{{ __('Actions') }}</th>
                    @endauth
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($taskStatuses as $status)
                        <tr class="border-b border-dashed text-left">
                            <td>{{ $status->id }}</td>
                            <td>{{ $status->name }}</td>
                            <td>{{ $status->created_at->format('d.m.Y') }}</td>
                            <td>
                                @can('delete', $status)
                                    <a class="text-red-600 hover:text-red-900" href="{{route('task_statuses.destroy', $status->id)}}" data-confirm="{{ __('Are you sure?') }}" data-method="delete">
                                        {{ __('Delete') }}
                                    </a>
                                @endcan
                                @can('update', $status)
                                    <a class="text-blue-600 hover:text-blue-900" href="{{route('task_statuses.edit', $status->id)}}">
                                        {{ __('Edit') }}
                                    </a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $taskStatuses->links() }}
            </div>
        </div>
    </div>
@endsection
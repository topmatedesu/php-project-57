@extends('layouts.app')

@section('content')
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
            <div class="grid col-span-full">
                <h1 class="mb-5">{{ __('Labels') }}</h1>

            @auth
                <div>
                    <a href="{{ route('labels.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('views.label.create') }}
                    </a>
                </div>
            @endauth

                <table class="mt-4">
                    <thead class="border-b-2 border-solid border-black text-left">
                    <tr>
                        <th scope="col">@lang('models.label.id')</th>
                        <th scope="col">@lang('models.label.name')</th>
                        <th scope="col">@lang('models.label.description')</th>
                        <th scope="col">@lang('models.label.created_at')</th>
                        @auth
                            <th scope="col">{{ __('Actions') }}</th>
                        @endauth
                    </tr>
                    </thead>
                    @foreach ($labels as $label)
                        <tr class="border-b border-dashed text-left">
                            <td>{{ $label->id }}</td>
                            <td>{{ $label->name }}</td>
                            <td>{{ $label->description ?? __('No Description') }}</td>
                            <td>{{ $label->created_at->format('d.m.Y') }}</td>
                            <td>
                                @can('delete', $label)
                                    <a class="text-red-600 hover:text-red-900" href="{{route('labels.destroy', $label->id)}}" data-confirm="{{ __('Are you sure?') }}" data-method="delete">
                                        {{ __('Delete') }}
                                    </a>
                                @endcan
                                @can('update', $label)
                                    <a class="text-blue-600 hover:text-blue-900" href="{{route('labels.edit', $label->id)}}">
                                        {{ __('Edit') }}
                                    </a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
@endsection
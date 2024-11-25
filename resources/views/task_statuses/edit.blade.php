@extends('layouts.app')

@section('content')
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5">Изменение статуса</h1>

            <form class="w-50"  action="{{ route('task_statuses.update', $taskStatus->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="flex flex-col">
                    <div>
                        <label for="name">Имя</label>
                    </div>
                    <div class="mt-2">
                        <input class="rounded border-gray-300 w-1/3" type="text" name="name" id="name" value="{{ $taskStatus->name }}">
                    </div>
                    @error('name')
                    <div class="text-rose-600">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-2">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Обновить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
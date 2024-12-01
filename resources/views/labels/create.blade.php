@extends('layouts.app')

@section('content')
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5">Создать метку</h1>

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

            <form class="w-50" method="POST" action="{{ route('labels.store') }}">
                @csrf
                <div class="flex flex-col">
                    <div>
                        <label for="name">Имя</label>
                    </div>
                    <div class="mt-2">
                        <input class="rounded border-gray-300 w-1/3" type="text" name="name" id="name" value="{{ old('name') }}">
                    </div>
                    @error('name')
                    <div class="text-rose-600">{{ $message }}</div>
                    @enderror

                    <div class="mt-2">
                        <label for="description">Описание</label>
                    </div>
                    <div class="mt-2">
                        <textarea class="rounded border-gray-300 w-1/3 h-32" name="description" id="description">{{ old('description') }}</textarea>
                    </div>
                    @error('description')
                    <div class="text-rose-600">{{ $message }}</div>
                    @enderror

                    <div class="mt-2">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Создать</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
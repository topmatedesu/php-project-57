@extends('layouts.app')

@section('content')
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5">{{ __('views.label.create') }}</h1>

            <div>
                {{ html()->modelForm($label, 'POST', route('labels.store'))->open() }}
                <div>
                    {{ html()->label(__('models.label.name'))->for('name') }}
                </div>
                <div class="mt-2">
                    {{ html()->input('text', 'name')->value(old('name'))->class('rounded border border-gray-300 w-1/3 p-2')->value(old('name')) }}
                </div>
                @error('name')
                <div class="text-rose-600">
                    {{ $message }}
                </div>
                @enderror

                <div class="mt-2">
                    {{ html()->label(__('models.label.description'))->for('description') }}`
                </div>
                <div class="mt-2">
                    {{ html()->textarea('description')->value(old('description'))->rows(10)->cols(50)->class('rounded border border-gray-300 w-1/3 h-32 p-2')->value(old('description')) }}
                </div>
                @error('description')
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
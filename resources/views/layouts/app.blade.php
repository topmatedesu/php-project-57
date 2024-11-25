<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Менеджер задач</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div id="app">
            <header class="fixed w-full">
                <nav class="bg-white border-gray-200 py-2.5 dark:bg-gray-900 shadow-md">
                    @include('layouts.navigation')
                    @include('flash::message')
                </nav>
            </header>
        </div>

        <main>
            <section class="bg-white dark:bg-gray-900">
                @yield('content')
            </section>
        </main>
    </body>
</html>

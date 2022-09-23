<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-page-head :title='$title ?? null' />

<body>

    <head>
        <x-navbar />
    </head>
    <main>
        @yield('content')
    </main>

    @yield('page-scripts')
</body>

</html>

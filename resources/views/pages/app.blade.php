<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-page-head :title='$title ?? null' />

<body>
    <main>
        @yield('content')
    </main>

    @yield('page-scripts')
</body>

</html>

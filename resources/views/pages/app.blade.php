<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('components.page-head')

<body>
    <main>
        @yield('content')
    </main>
</body>
</html>

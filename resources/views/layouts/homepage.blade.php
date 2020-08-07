<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.head')

<body>
    @include('layouts.nav')

    <main class="mx-3">

        @yield('content')

    </main>
</body>

</html>

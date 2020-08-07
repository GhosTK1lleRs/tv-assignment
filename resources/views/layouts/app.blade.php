<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.head')

<body>
    @include('layouts.nav')

    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center mb-3">
                <div class="col-md-12">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @elseif (session('warning'))
                    <div class="alert alert-warning" role="alert">
                        {{ session('warning') }}
                    </div>
                    @elseif (session('danger'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('danger') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center">

                @yield('content')
            </div>
        </div>
    </main>
</body>

</html>

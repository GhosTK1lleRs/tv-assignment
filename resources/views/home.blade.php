@extends('layouts.homepage')
@section('content')
<div class="flex-center position-ref full-height">

    <div class="content">
        <div id="carouselSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{url('/storage/app/main-cover.jpg')}}" class="d-block w-100 dim"
                        alt="homepage cover" style="max-height: 900px;">
                    <div class="carousel-caption d-none d-md-block mb-5">
                        <h1 class="text-uppercase font-weight-bolder">{{__('CATALOG')}}</h1>
                        <p class="">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                        @if (Route::has('login'))
                            @auth
                                <div class="container my-2">
                                <a class="btn btn-light rounded-pill" type="button" href="{{ url('/home') }}">Catalog</a>
                            </div>
                            @else
                            <div class="container">
                                <a class="btn btn-light rounded-pill" type="button" href="{{ route('login') }}">Login</a>
                            </div>
                                @if (Route::has('register'))
                                <div class="container my-2">
                                    <a class="btn btn-dark rounded-pill" type="button" href="{{ route('register') }}">Register</a>
                                </div>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.carousel_scripts')
@endsection

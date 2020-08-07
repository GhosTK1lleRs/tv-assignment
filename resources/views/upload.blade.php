@extends('layouts.app')
@section('content')
@include('layouts.sidebar')

<div class="col-md-9">
    <div class="card">
        <div class='content'>
            <!-- Dropzone -->
            <form action="{{route('upload.store')}}" class='dropzone'>
                @csrf
            </form>
        </div>
    </div>
</div>

@include('layouts.upload_scripts')

@endsection

@extends('layouts.app')
@section('content')
@include('layouts.sidebar')

<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <a href="{{ route('catalog.index') }}"> Catalog </a> > {{ $catalog->name }}
                </div>

                <button type="button" class="close mx-3" aria-label="Edit" data-toggle="modal"
                    data-target="#updateImageModal">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </button>

                <form action="{{ route('catalog.destroy',$catalog->id) }}" class="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="close" aria-label="Delete"
                        onclick="return confirm('Are you sure you want to delete this item? This action can not be undone.')">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="card-body">
            <div class="row row-cols-md-3">
                @if (!count($catalog->uploads))
                    <div class="container">
                        <label class="text-center">
                            {{ __('Look like you don\'t have any image in this catalog.') }}
                        </label>
                    </div>
                @endif
                @foreach ($catalog->uploads as $upload)
                <div class="col-md-4">
                    <div class="card my-2">
                        <div class="img-wrapper">
                            <img class="img-responsive" src="{{ url('storage/userupload/' . $upload->fileurl) }}"
                                style="width: 100%; max-height: 250px; min-height: 250px; object-fit: cover;">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@include('layouts.mordals.update_catalog_mordal')
{{-- @include('layouts.update_catalog_name_mordal') --}}
{{-- @include('layouts.update_catalog_image_mordal') --}}
@endsection

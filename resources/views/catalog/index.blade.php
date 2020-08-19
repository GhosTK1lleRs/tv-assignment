@extends('layouts.app')
@section('content')
@include('layouts.sidebar')

<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    {{ __('Catalogs') }}
                </div>
                <div class="col d-flex justify-content-end">
                    <button type="button" class="close" aria-label="Edit" data-toggle="modal"
                        data-target="#addCatalogModal">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if(!count($catalogs))
            <div class="container">
                <label class="text-center">
                    {{ __('Look like you don\'t have any catalog. Create some!') }}
                </label>
            </div>
            @elseif(count($catalogs))
            <div class="row row-cols-md-3">
                @foreach ($catalogs as $catalog)
                <div class="col-md-4">
                    <a href="{{ route('catalog.show',$catalog->id) }}">
                        <div class="card my-2">
                            <div class="img-wrapper">
                                @if ($catalog->uploads->isEmpty())
                                    <img class="img-responsive"
                                         src="{{ url('storage/app/no-image.png') }}"
                                         style="width: 100%; max-height: 250px; min-height: 250px; object-fit: cover;">
                                @else
                                <img class="img-responsive"
                                    src="{{ url('storage/userupload/'.$catalog->uploads->first()->fileurl) }}"
                                    style="width: 100%; max-height: 250px; min-height: 250px; object-fit: cover;">
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="text-left text-truncate mx-2">
                                        <p class="card-title text-dark">{{ $catalog->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            @endif

        </div>
    </div>
</div>
@include('layouts.mordals.store_catalog_mordal')
@endsection

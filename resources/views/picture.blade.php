@extends('layouts.app')
@section('content')
@include('layouts.sidebar')

<div class="col-md-9">
    @if(!count($uploads))
        <div class="card">
            <div class="card-header">
                {{ __('Picture') }}
            </div>
            <div class="card-body">
                <div class="container">
                    <label class="text-center">
                        {{ __('Look like you don\'t have any image!') }}
                        <a href="{{ route('upload.create') }}">Upload</a>
                    </label>
                </div>
            </div>
        </div>
    @elseif(count($uploads))
        @php
            $gifSize = $jpegSize = $jpgSize = $pngSize = 0;
        @endphp
        @foreach ($uploads as $upload)
        @php
            if ($upload->extension == "gif"){
                $gifSize += $upload->size;
            }
            elseif ($upload->extension == "jpeg"){
                $jpegSize += $upload->size;
            }
            elseif ($upload->extension == "jpg"){
                $jpgSize += $upload->size;
            }
            elseif ($upload->extension == "png"){
                $pngSize += $upload->size;
            }
        @endphp
        @endforeach
        @php
            $byPercentage = 1048576;
            $gifBar = $gifSize/$byPercentage;
            $jpegBar = $jpegSize/$byPercentage;
            $jpgBar = $jpgSize/$byPercentage;
            $pngBar = $pngSize/$byPercentage;
        @endphp
    <div class="progress">
        <div class="progress-bar" id="gifBar" role="progressbar" style="width: {{$gifBar ?? '0'}}%" aria-valuenow="{{$gifBar ?? '0'}}" aria-valuemin="0" aria-valuemax="100">GIF {{number_format($gifBar ?? '0',2)}}%</div>
        <div class="progress-bar bg-success" id="jpegBar" role="progressbar" style="width: {{$jpegBar ?? '0'}}%" aria-valuenow="{{$jpegBar ?? '0'}}" aria-valuemin="0" aria-valuemax="100">JPEG {{number_format($jpegBar ?? '0',2)}}%</div>
        <div class="progress-bar bg-info" id="jpgBar" role="progressbar" style="width: {{$jpgBar ?? '0'}}%" aria-valuenow="{{$jpgBar ?? '0'}}" aria-valuemin="0" aria-valuemax="100">JPG {{number_format($jpgBar ?? '0',2)}}%</div>
        <div class="progress-bar bg-warning" id="pngBar" role="progressbar" style="width: {{$pngBar ?? '0'}}%" aria-valuenow="{{$pngBar ?? '0'}}" aria-valuemin="0" aria-valuemax="100">PNG {{number_format($pngBar ?? '0',2)}}%</div>
    </div>
    {{-- <div class="card"> --}}
        <table class="table table-bordered table-hover" cellspacing="0" width="100%">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Size</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th width="150px">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($uploads as $upload)
            <tr class="data-row">
                <td class="font-weight-bold">{{ ++$i }}</td>
                <td>
                    <img src="{{ url('storage/userupload/' . $upload->fileurl) }}"
                        style="width: 100px; height: 100px; object-fit: cover;">
                </td>
                <td class="text-truncate text-shortername name" style="max-width: 150px;">{{ $upload->name }}</td>
                <td class="extension">{{ $upload->extension }}</td>
                <td class="size">{{ GlobalClass::bytesToHuman($upload->size) }}</td>
                <td class="created-at">{{ $upload->created_at }}</td>
                <td class="updated-at">{{ $upload->updated_at }}</td>
                <td class="align-middle">

                    <form action="{{ route('upload.destroy',$upload->id) }}" method="POST">
                    <button type="button" class="btn btn-warning" data-toggle="modal" id="editItem" data-item-id="{{ $upload->id }}">{{ __('Edit') }}</button>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this item? This action can not be undone.')">
                            {{ __('Delete') }}
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {!! $uploads->links() !!}
        <div id="__refStorageSize">
            <p>{{GlobalClass::bytesToHuman($gifSize)}} is {{number_format($gifBar,2)}}%</p>
            <p>{{GlobalClass::bytesToHuman($jpegSize)}} is {{number_format($jpegBar,2)}}%</p>
            <p>{{GlobalClass::bytesToHuman($jpgSize)}} is {{number_format($jpgBar,2)}}%</p>
            <p>{{GlobalClass::bytesToHuman($pngSize)}} is {{number_format($pngBar,2)}}%</p>
        </div>
    @endif
</div>
@include('layouts.mordals.edit_upload_mordal')
@endsection

<div class="col-md-3">
    <div class="card">
        <div class="card-header">{{ __('Manage') }}</div>
        <div class="card-body">
            <a type="button" href="{{ route('upload.create') }}" class="btn btn-primary btn-block">{{ __('Upload') }}</a>
            <div class="border-bottom my-3"></div>
            <a type="button" href="{{ route('catalog.index') }}"
                class="btn btn-outline-primary btn-block">{{ __('Catalog') }}</a>
            <a type="button" href="{{ route('upload.index') }}"
                class="btn btn-outline-primary btn-block">{{ __('All upload') }}</a>
        </div>

    </div>
</div>

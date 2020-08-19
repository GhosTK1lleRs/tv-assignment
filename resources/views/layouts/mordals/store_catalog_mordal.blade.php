<!-- Modal -->
<div class="modal fade" id="addCatalogModal" tabindex="-1" aria-labelledby="addCatalogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCatalogModalLabel">Add new catalog</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-form" class="form-horizontal" method="POST" action="{{ route('catalog.store') }}">
                    @csrf
                    <div class="modal-body" id="attachment-body-content">
                        <div class="form-group">
                            <label class="col-form-label" for="name">Catalog name</label>
                            <input type="text" name="name" class="form-control" id="name" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        @if(!count($uploads))
                            <div class="card-body">
                                <div class="container">
                                    <label class="text-center">
                                        {{ __('Look like you don\'t have any image! Please add some new image before create a new catalog.') }}
                                    </label>
                                </div>
                            </div>
                        @elseif(count($uploads))
                        @foreach($uploads as $upload)
                        <div class="custom-control custom-checkbox">
                            {!! Form::checkbox('upload_id[]', $upload->id,null, array('class' =>'custom-control-input','id' => 'customUploadCheckbox'.$upload->id)) !!}
                            <label class="custom-control-label" for="customUploadCheckbox{{ $upload->id }}" style="width: 200px; white-space: nowrap; text-overflow: ellipsis;">
                                <img src="{{ url('storage/userupload/' . $upload->fileurl) }}" alt="upload picture"
                                    style="width: 30px; height: 30px;">
                                {{ $upload->name }}
                            </label>
                        </div>
                        <br />
                        @endforeach
                        @endif
                    </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

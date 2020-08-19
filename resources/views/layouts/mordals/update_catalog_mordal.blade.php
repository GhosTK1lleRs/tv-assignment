<!-- Modal -->
<div class="modal fade" id="updateImageModal" tabindex="-1" aria-labelledby="updateImageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateImageModalLabel">Add new image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-form" class="form-horizontal" method="POST"
                    action="{{ route('catalog.update', $catalog->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="col-form-label" for="name">Catalog name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $catalog->name }}"
                            required autofocus>
                    </div>

                    @php
                    $existsItems = [];
                    foreach ($catalog->uploads->toArray() as $key => $value) {
                    $existsItems[] = $value['pivot']['upload_id'];

                    }
                    // dd($existsItems);

                    @endphp
                    <div class="form-group">
                        @foreach($uploads as $upload)
                        <div class="custom-control custom-checkbox">
                            {!! Form::checkbox('upload_id[]', $upload->id, in_array($upload->id, $existsItems),
                            array('class' =>'custom-control-input','id' => 'customUploadCheckbox'.$upload->id)) !!}
                            <label class="custom-control-label" for="customUploadCheckbox{{ $upload->id }}"
                                style="width: 100px; white-space: nowrap; text-overflow: ellipsis;">
                                <img src="{{ url('storage/userupload/' . $upload->fileurl) }}" alt="upload picture"
                                    style="width: 30px; height: 30px;">
                                {{ $upload->name }}
                            </label>
                        </div>
                        <br />
                        @endforeach
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

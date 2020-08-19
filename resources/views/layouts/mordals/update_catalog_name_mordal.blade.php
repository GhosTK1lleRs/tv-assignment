<!-- Modal -->
<div class="modal fade" id="catalogNameModal" tabindex="-1" aria-labelledby="catalogNameLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="catalogNameLabel">Rename catalog</h5>
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

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

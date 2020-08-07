<!-- Modal -->
<div class="modal fade" id="editMordal" tabindex="-1" role="dialog" aria-labelledby="editMordalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMordalLabel">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit-form" class="form-horizontal" method="POST"
                action="{{ route('upload.update', $upload->id ?? '') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body" id="attachment-body-content">
                    <div class="form-group">
                        <input type="hidden" name="id" class="form-control" id="id" required
                            autofocus>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" required
                            autofocus>
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
<script>
    $(document).ready(function () {
        /**
         * for showing edit item popup
         */

        $(document).on('click', "#editItem", function () {
            $(this).addClass(
                'edit-item-trigger-clicked'
            ); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

            var options = {
                'backdrop': 'static'
            };
            $('#editMordal').modal(options)
        })

        // on modal show
        $('#editMordal').on('show.bs.modal', function () {
            var el = $(".edit-item-trigger-clicked"); // See how its usefull right here?
            var row = el.closest(".data-row");

            // get the data
            var id = el.data('item-id');

            var name = row.children(".name").text();
            var size = row.children(".size").text();

            // fill the data in the input fields
            $("#id").val(id);
            $("#name").val(name);

        })

        // on modal hide
        $('#editMordal').on('hide.bs.modal', function () {
            $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
            $("#edit-form").trigger("reset");
        })
    })

</script>

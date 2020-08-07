<!-- Script -->
<script>
    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone(".dropzone",{
        maxFilesize: 8,  // mb
        acceptedFiles: ".gif,.jpeg,.jpg,.png,.pdf",
    });
    myDropzone.on("sending", function(file, xhr, formData) {
       formData.append("_token", CSRF_TOKEN);
    });
    </script>

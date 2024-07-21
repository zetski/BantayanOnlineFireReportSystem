$(function(){
    $('#request-form').submit(function(e){
        e.preventDefault();
        var _this = $(this);
        $('.err-msg').remove();
        start_loader();
        
        // Debug: Log form data
        console.log("Submitting form data...");

        $.ajax({
            url: _base_url_+"classes/Master.php?f=save_request",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            error: function(err) {
                console.log(err);
                alert_toast("An error occurred", 'error');
                end_loader();
            },
            success: function(resp) {
                if (typeof resp === 'object' && resp.status === 'success') {
                    location.reload();
                } else if (resp.status === 'failed' && !!resp.msg) {
                    var el = $('<div>');
                    el.addClass("alert alert-danger err-msg").text(resp.msg);
                    _this.prepend(el);
                    el.show('slow');
                    $("html, body").animate({ scrollTop: _this.closest('.card').offset().top }, "fast");
                    end_loader();
                } else {
                    alert_toast("An error occurred", 'error');
                    end_loader();
                    console.log(resp);
                }
            }
        });
    });

    // WebCam Integration
    const cameraIcon = document.getElementById('camera-icon');
    const cameraContainer = document.getElementById('camera-container');
    const video = document.getElementById('camera');
    const takePhotoButton = document.getElementById('take-photo');
    const imagePreviewContainer = document.getElementById('image-preview-container');
    const imagePreview = document.getElementById('image-preview');
    const imageDataInput = document.getElementById('image-data');
    const removeImageButton = document.getElementById('remove-image');

    cameraIcon.addEventListener('click', async () => {
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ video: true });
                video.srcObject = stream;
                cameraContainer.classList.remove('d-none');
            } catch (error) {
                console.error('Error accessing the camera', error);
            }
        } else {
            alert('Camera access not supported');
        }
    });

    takePhotoButton.addEventListener('click', () => {
        const canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        const context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        const dataURL = canvas.toDataURL('image/png');
        imagePreview.src = dataURL;
        imageDataInput.value = dataURL;
        imagePreviewContainer.classList.remove('d-none');
        cameraContainer.classList.add('d-none');
        video.srcObject.getTracks().forEach(track => track.stop());
    });

    removeImageButton.addEventListener('click', () => {
        imagePreviewContainer.classList.add('d-none');
        imagePreview.src = '';
        imageDataInput.value = '';
    });

    $('#image-upload').change(function(){
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-preview').attr('src', e.target.result);
                $('#modal-image').attr('src', e.target.result);
                $('#image-preview-container').removeClass('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    });

    $(document).on('click', '#image-preview', function() {
        $('#imageModal').modal('show');
    });

    $(document).on('click', '#remove-image', function() {
        $('#image-upload').val('');
        $('#image-preview').attr('src', '#');
        $('#image-preview-container').addClass('d-none');
        $('#modal-image').attr('src', '#');
    });
});

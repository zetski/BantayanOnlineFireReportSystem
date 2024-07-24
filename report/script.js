$(function() {
    $('#request-form').submit(function(e) {
        e.preventDefault();
        var _this = $(this);
        $('.err-msg').remove();
        start_loader();
        
        // Capture image from webcam
        var imageCapture = document.getElementById('image-preview');
        if (imageCapture.srcObject) {
            var canvas = document.createElement('canvas');
            var ctx = canvas.getContext('2d');
            canvas.width = imageCapture.videoWidth;
            canvas.height = imageCapture.videoHeight;
            ctx.drawImage(imageCapture, 0, 0, canvas.width, canvas.height);
            canvas.toBlob(function(blob) {
                var formData = new FormData(_this[0]);
                formData.set('image', blob, 'webcam_image.jpg');
                submitForm(formData);
            }, 'image/jpeg');
        } else {
            submitForm(new FormData(this));
        }
    });

    $('#capture-image').click(function() {
        setupWebcam();
    });

    $('#remove-image').click(function() {
        var video = document.getElementById('image-preview');
        var stream = video.srcObject;
        var tracks = stream.getTracks();

        tracks.forEach(track => track.stop());

        video.srcObject = null;
        $('#image-preview-container').addClass('d-none');
    });

    $(document).on('click', '#image-preview', function() {
        $('#imageModal').modal('show');
    });

    // Function to handle webcam setup
    function setupWebcam() {
        const video = document.getElementById('image-preview');
        const constraints = {
            video: true
        };

        navigator.mediaDevices.getUserMedia(constraints)
            .then((stream) => {
                video.srcObject = stream;
                video.onloadedmetadata = (e) => {
                    video.play();
                    $('#image-preview-container').removeClass('d-none');
                };
            })
            .catch((err) => {
                console.error('Error accessing webcam:', err);
                alert('Failed to access webcam. Please try again.');
            });
    }

    // Function to submit form data via AJAX
    function submitForm(formData) {
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=save_request",
            data: formData,
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
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.reload();
                } else if (resp.status == 'failed' && !!resp.msg) {
                    var el = $('<div>');
                    el.addClass("alert alert-danger err-msg").text(resp.msg);
                    _this.prepend(el);
                    el.show('slow');
                    $("html, body").animate({
                        scrollTop: _this.closest('.card').offset().top
                    }, "fast");
                    end_loader();
                } else {
                    alert_toast("An error occurred", 'error');
                    end_loader();
                    console.log(resp);
                }
            }
        });
    }
});

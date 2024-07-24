<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fire Reporting</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<section class="py-3">
    <div class="container">
        <div class="content py-3 px-3" style="background-color: #2980B9">
            <h2 style="color: #fff">Fire Reporting</h2>
        </div>
        <div class="row justify-content-center mt-n3">
            <div class="col-lg-8 col-md-10 col-sm-12 col-sm-12">
                <div class="card card-outline rounded-0">
                    <div class="card-body">
                        <div class="container-fluid">
                            <?php if($_settings->chk_flashdata('request_sent')): ?>
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    html: 'Your report has been sent successfully. Your request code id: <b><?= $_settings->flashdata('request_sent') ?></b>',
                                    showConfirmButton: true,
                                });
                            </script>
                            <?php endif;?>
                            <form action="" id="request-form" enctype="multipart/form-data">
                                <input type="hidden" name="id">
                                <input type="hidden" name="image" id="image-data">
                                <div class="form-group col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                    <label for="fullname" class="control-label">Fullname <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="fullname" id="fullname" required="required">
                                </div>
                                <div class="form-group col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                    <label for="contact" class="control-label">Contact # <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="contact" id="contact" required="required" maxlength="11" pattern="\d{11}" title="Please enter 11 digits">
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="message" class="control-label">Message <small class="text-danger">*</small></label>
                                    <div class="position-relative">
                                        <textarea rows="3" class="form-control form-control-sm rounded-0" name="message" id="message" required="required" style="padding-right: 40px;"></textarea>
                                        <button type="button" class="btn btn-primary" id="camera-btn">Take Picture</button>
                                        <video id="video" width="320" height="240" autoplay class="d-none"></video>
                                        <canvas id="canvas" width="320" height="240" class="d-none"></canvas>
                                        <div id="image-preview-container" class="d-none">
                                            <img id="image-preview" src="#" alt="Image Preview" class="img-thumbnail">
                                            <span id="remove-image" class="remove-image"><i class="fa fa-times"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="location" class="control-label">Location <small class="text-danger">*</small></label>
                                    <select class="form-control form-control-sm rounded-0" name="location" id="location" required="required">
                                        <option value="">Select Barangay</option>
                                        <!-- Add barangay options here -->
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer py-1 text-center">
                        <button class="btn btn-flat btn-sm btn-primary bg-gradient-primary" form="request-form"><i class="fa fa-paper-plane"></i> Submit</button>
                        <button class="btn btn-flat btn-sm btn-light bg-gradient-light border" type="reset" form="request-form"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img id="modal-image" src="#" alt="Full-size Image" class="img-fluid">
      </div>
    </div>
  </div>
</div>

<style>
    .position-relative {
        position: relative;
    }
    .upload-icon {
        position: absolute;
        right: 10px;
        bottom: 10px;
        cursor: pointer;
        font-size: 1.2rem;
        color: #6c757d;
    }
    #image-preview-container {
        position: absolute;
        bottom: 10px;
        right: 50px;
        width: 50px;
        height: 50px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #image-preview {
        max-width: 100%;
        max-height: 100%;
        cursor: pointer;
    }
    .remove-image {
        position: absolute;
        top: 0;
        right: 0;
        background-color: rgba(255, 255, 255, 0.7);
        border-radius: 50%;
        cursor: pointer;
        padding: 2px;
    }
</style>

<script>
    document.getElementById('contact').addEventListener('input', function (e) {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);
    });

    document.getElementById('camera-btn').addEventListener('click', function () {
        var video = document.getElementById('video');
        var canvas = document.getElementById('canvas');
        var context = canvas.getContext('2d');

        video.classList.remove('d-none');
        canvas.classList.add('d-none');

        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function (stream) {
                video.srcObject = stream;
                video.play();
            })
            .catch(function (err) {
                console.error("Error: " + err);
            });

        video.addEventListener('click', function () {
            context.drawImage(video, 0, 0, 320, 240);
            canvas.classList.remove('d-none');
            video.classList.add('d-none');
            video.srcObject.getTracks().forEach(track => track.stop());

            var dataURL = canvas.toDataURL('image/png');
            document.getElementById('image-data').value = dataURL;
            document.getElementById('image-preview').src = dataURL;
            document.getElementById('modal-image').src = dataURL;
            document.getElementById('image-preview-container').classList.remove('d-none');
        });
    });

    document.getElementById('remove-image').addEventListener('click', function () {
        document.getElementById('image-data').value = '';
        document.getElementById('image-preview').src = '#';
        document.getElementById('modal-image').src = '#';
        document.getElementById('image-preview-container').classList.add('d-none');
    });

    document.getElementById('image-preview').addEventListener('click', function () {
        $('#imageModal').modal('show');
    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

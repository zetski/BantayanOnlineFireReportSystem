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
                                    <textarea rows="3" class="form-control form-control-sm rounded-0" name="message" id="message" required="required" style="padding-right: 40px;"></textarea>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="location" class="control-label">Location <small class="text-danger">*</small></label>
                                    <div class="position-relative">
                                        <select class="form-control form-control-sm rounded-0" name="location" id="location" required="required">
                                            <option value="">Select Barangay</option>
                                            <option value="Atop-Atop">Atop-Atop</option>
                                            <option value="Baigad">Baigad</option>
                                            <option value="Bantigue">Bantigue</option>
                                            <option value="Baod">Baod</option>
                                            <option value="Binaobao">Binaobao</option>
                                            <option value="Botigues">Botigues</option>
                                            <option value="Doong">Doong</option>
                                            <option value="Guiwanon">Guiwanon</option>
                                            <option value="Hilotongan">Hilotongan</option>
                                            <option value="Kabac">Kabac</option>
                                            <option value="Kabangbang">Kabangbang</option>
                                            <option value="Kampinganon">Kampinganon</option>
                                            <option value="Kangkaibe">Kangkaibe</option>
                                            <option value="Lipayran">Lipayran</option>
                                            <option value="Luyongbay-bay">Luyongbay-bay</option>
                                            <option value="Mojon">Mojon</option>
                                            <option value="Oboob">Oboob</option>
                                            <option value="Patao">Patao</option>
                                            <option value="Putian">Putian</option>
                                            <option value="Sillon">Sillon</option>
                                            <option value="Suba">Suba</option>
                                            <option value="Sulangan">Sulangan</option>
                                            <option value="Sungko">Sungko</option>
                                            <option value="Tamiao">Tamiao</option>
                                            <option value="Ticad">Ticad</option>
                                        </select>
                                        <label class="upload-icon" id="take-picture" for="camera-input">
                                            <i class="fa fa-camera"></i>
                                        </label>
                                    </div>
                                    <div id="camera-container" class="d-none">
                                        <video id="camera-stream" width="100%" height="100%" autoplay></video>
                                        <button type="button" id="capture-btn" class="btn btn-primary btn-sm">Capture</button>
                                        <canvas id="snapshot" class="d-none"></canvas>
                                    </div>
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
    body {
        padding-top: 10px;
        margin-top: 40px;
    }
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
    #camera-container {
        position: relative;
        margin-top: 10px;
    }
    video, canvas {
        width: 100%;
        height: auto;
    }
    #capture-btn {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
    }
</style>

<script>
    document.getElementById('contact').addEventListener('input', function (e) {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);
    });

    document.getElementById('take-picture').addEventListener('click', function () {
        const cameraContainer = document.getElementById('camera-container');
        cameraContainer.classList.remove('d-none');
        const video = document.getElementById('camera-stream');
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                video.srcObject = stream;
                video.play();
            })
            .catch(err => {
                console.error('Error accessing the camera', err);
            });
    });

    document.getElementById('capture-btn').addEventListener('click', function () {
        const canvas = document.getElementById('snapshot');
        const video = document.getElementById('camera-stream');
        const context = canvas.getContext('2d');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        const dataUrl = canvas.toDataURL('image/png');
        // Optionally, you can display the captured image
        document.getElementById('modal-image').src = dataUrl;
        $('#imageModal').modal('show');
        // Stop the video stream after capturing
        const stream = video.srcObject;
        const tracks = stream.getTracks();
        tracks.forEach(track => track.stop());
        video.srcObject = null;
        document.getElementById('camera-container').classList.add('d-none');
    });
</script>

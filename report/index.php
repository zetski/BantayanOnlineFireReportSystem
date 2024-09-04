<section class="py-3">
    <div class="container">
        <div class="content py-3 px-3" style="background-color: #FF4600">
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
                            <form action="" id="request-form">
                                <input type="hidden" name="id">
                                <div class="form-group col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                    <label for="lastname" class="control-label">Lastname <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="lastname" id="lastname" required="required">
                                </div>
                                <div class="form-group col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                    <label for="firstname" class="control-label">Firstname <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="firstname" id="firstname" required="required">
                                </div>
                                <div class="form-group col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                    <label for="middlename" class="control-label">Middlename <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="middlename" id="middlename" required="required">
                                </div>
                                <div class="form-group col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                    <label for="contact" class="control-label">Contact # <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="contact" id="contact" required="required" maxlength="11">
                                </div>
                                <div class="form-group col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                    <label for="subject" class="control-label">Subject <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="subject" id="subject" required="required">
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="message" class="control-label">Message <small class="text-danger">*</small></label>
                                    <textarea rows="3" class="form-control form-control-sm rounded-0" name="message" id="message" required="required"></textarea>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="image" class="control-label">Choose Photo</label>
                                    <input type="file" class="form-control form-control-sm rounded-0" name="image" id="image">
                                </div>
                                <div class="form-group col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                    <label for="municipality" class="control-label">Municipality</label>
                                    <select class="form-control form-control-sm rounded-0" name="municipality" id="municipality">
                                        <option value="">Select Municipality</option>
                                        <option value="bantayan">Bantayan</option>
                                        <option value="santa_fe">Santa Fe</option>
                                        <option value="madridejos">Madridejos</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                    <label for="barangay" class="control-label">Barangay</label>
                                    <select class="form-control form-control-sm rounded-0" name="barangay" id="barangay">
                                        <option value="">Select Barangay</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                    <label for="sitio_street" class="control-label">Sitio/Street</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="sitio_street" id="sitio_street">
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
    <style>
        body {
            padding-top: 10px;
            margin-top: 40px;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Validation for Lastname, Firstname, Middlename
            document.getElementById('lastname').addEventListener('input', function(e) {
                e.target.value = e.target.value.replace(/[^a-zA-Z\s]/g, '').replace(/\b\w/g, function(char) {
                    return char.toUpperCase();
                });
            });

            document.getElementById('firstname').addEventListener('input', function(e) {
                e.target.value = e.target.value.replace(/[^a-zA-Z\s]/g, '').replace(/\b\w/g, function(char) {
                    return char.toUpperCase();
                });
            });

            document.getElementById('middlename').addEventListener('input', function(e) {
                e.target.value = e.target.value.replace(/[^a-zA-Z\s]/g, '').replace(/\b\w/g, function(char) {
                    return char.toUpperCase();
                });
            });

            // Validation for Contact Number (numbers only, max 11 digits)
            document.getElementById('contact').addEventListener('input', function(e) {
                e.target.value = e.target.value.replace(/[^0-9]/g, '').slice(0, 11);
            });
        });
    </script>
</section>

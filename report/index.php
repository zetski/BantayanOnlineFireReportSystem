<section class="py-3">
    <div class="container">
        <div class="content py-3 px-3" style="background-color: #ff4600">
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
                                    <div class="position-relative">
                                        <textarea rows="3" class="form-control form-control-sm rounded-0" name="message" id="message" required="required" style="padding-right: 40px;"></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="location" class="control-label">Location <small class="text-danger">*</small></label>
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

<style>
    body {
        padding-top: 10px;
        margin-top: 40px;
    }
    .position-relative {
        position: relative;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('fullname').addEventListener('input', function (e) {
        this.value = this.value.replace(/[^a-zA-Z\s.]/g, '').replace(/\s+/g, ' '); // Allow alphabetic characters, spaces, and periods
    });

    document.getElementById('fullname').addEventListener('blur', function (e) {
        const parts = this.value.trim().split(' ');
        if (parts.length < 3) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Fullname',
                text: 'Please enter your first name, middle initial, and last name.',
                confirmButtonText: 'Okay'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('fullname').focus(); // Focus back to the fullname field
                }
            });
            return;
        }
        this.value = parts.map(part => part.charAt(0).toUpperCase() + part.slice(1).toLowerCase()).join(' ');
    });

    document.getElementById('contact').addEventListener('input', function (e) {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);
    });

    // document.getElementById('request-form').addEventListener('submit', function (e) {
    //     const fullname = document.getElementById('fullname').value.trim();
    //     const parts = fullname.split(' ');

    //     if (parts.length < 3) {
    //         Swal.fire({
    //             icon: 'error',
    //             title: 'Invalid Fullname',
    //             text: 'Please enter your first name, middle initial, and last name.',
    //             confirmButtonText: 'Okay'
    //         }).then((result) => {
    //             if (result.isConfirmed) {
    //                 document.getElementById('fullname').focus(); // Focus back to the fullname field
    //             }
    //         });
    //         e.preventDefault();
    //     }
    // });
</script>

<script src="report/script.js"></script>

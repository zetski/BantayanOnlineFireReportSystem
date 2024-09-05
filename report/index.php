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
                                    <input type="text" class="form-control form-control-sm rounded-0" name="contact" id="contact" required="required">
                                </div>
                                <div class="form-group col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                    <label for="subject" class="control-label">Subject <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="subject" id="subject" required="required">
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="message" class="control-label">Message <small class="text-danger">*</small></label>
                                    <textarea rows="3" class="form-control form-control-sm rounded-0" name="message" id="message" required="required"></textarea>
                                </div>
                                <!-- Add file upload field if needed -->
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="photo" class="control-label">Choose Photo</label>
                                    <input type="file" class="form-control form-control-sm rounded-0" name="photo" id="photo">
                                </div>
                                <!-- Add dropdowns for municipality and barangay -->
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
                                    <label for="purok_street" class="control-label">Purok/Street</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="purok_street" id="purok_street">
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

            document.getElementById('subject').addEventListener('input', function(e) {
                e.target.value = e.target.value.replace(/[^a-zA-Z\s]/g, '').replace(/\b\w/g, function(char) {
                    return char.toUpperCase();
                });
            });

            // Validation for Contact Number (numbers only, max 11 digits)
            document.getElementById('contact').addEventListener('input', function(e) {
                e.target.value = e.target.value.replace(/[^0-9]/g, '').slice(0, 11);
            });
        });

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

            document.getElementById('subject').addEventListener('input', function(e) {
                e.target.value = e.target.value.replace(/[^a-zA-Z\s]/g, '').replace(/\b\w/g, function(char) {
                    return char.toUpperCase();
                });
            });

            // Validation for Contact Number (numbers only, max 11 digits)
            document.getElementById('contact').addEventListener('input', function(e) {
                e.target.value = e.target.value.replace(/[^0-9]/g, '').slice(0, 11);
            });
        });

    document.addEventListener('DOMContentLoaded', function() {
    const municipalityBarangays = {
        'bantayan': [
            { value: 'Atop-Atop', text: 'Atop-Atop' },
            { value: 'Baigad', text: 'Baigad' },
            { value: 'Bantigue', text: 'Bantigue' },
            { value: 'Baod', text: 'Baod' },
            { value: 'Binaobao', text: 'Binaobao' },
            { value: 'Botigues', text: 'Botigues' },
            { value: 'Doong', text: 'Doong' },
            { value: 'Guiwanon', text: 'Guiwanon' },
            { value: 'Hilotongan', text: 'Hilotongan' },
            { value: 'Kabac', text: 'Kabac' },
            { value: 'Kabangbang', text: 'Kabangbang' },
            { value: 'Kampinganon', text: 'Kampinganon' },
            { value: 'Kangkaibe', text: 'Kangkaibe' },
            { value: 'Lipayran', text: 'Lipayran' },
            { value: 'Luyongbay-bay', text: 'Luyongbay-bay' },
            { value: 'Mojon', text: 'Mojon' },
            { value: 'Oboob', text: 'Oboob' },
            { value: 'Patao', text: 'Patao' },
            { value: 'Putian', text: 'Putian' },
            { value: 'Sillon', text: 'Sillon' },
            { value: 'Suba', text: 'Suba' },
            { value: 'Sulangan', text: 'Sulangan' },
            { value: 'Sungko', text: 'Sungko' },
            { value: 'Tamiao', text: 'Tamiao' },
            { value: 'Ticad', text: 'Ticad' }
        ],
        'santa_fe': [
            // Example barangays for Santa Fe
            { value: 'Balidbid', text: 'Balidbid' },
            { value: 'Hagdan', text: 'Hagdan' },
            { value: 'Hilantagaan', text: 'Hilantagaan' },
            { value: 'Kinatarkan', text: 'Kinatarkan' },
            { value: 'Langub', text: 'Langub' },
            { value: 'Maricaban', text: 'Maricaban' },
            { value: 'Okoy', text: 'Okoy' },
            { value: 'Poblacion', text: 'Poblacion' },
            { value: 'Pooc', text: 'Pooc' },
            { value: 'Talisay', text: 'Talisay' }
        ],
        'madridejos': [
            // Example barangays for Madridejos
            { value: 'Bunakan', text: 'Bunakan' },
            { value: 'Kangwayan', text: 'Kangwayan' },
            { value: 'Kaongkod', text: 'Kaongkod' },
            { value: 'Kodia', text: 'Kodia' },
            { value: 'Maalat', text: 'Maalat' },
            { value: 'Malbago', text: 'Malbago' },
            { value: 'Mancilang', text: 'Mancilang' },
            { value: 'Pili', text: 'Pili' },
            { value: 'Poblacion', text: 'Poblacion' },
            { value: 'San Agustin', text: 'San Agustin' },
            { value: 'Tabagak', text: 'Tabagak' },
            { value: 'Talangnan', text: 'Talangnan' },
            { value: 'Tarong', text: 'Tarong' },
            { value: 'Tugas', text: 'Tugas' }
        ]
    };

    const municipalitySelect = document.getElementById('municipality');
    const barangaySelect = document.getElementById('barangay');

    municipalitySelect.addEventListener('change', function() {
        const selectedMunicipality = this.value;
        const barangays = municipalityBarangays[selectedMunicipality] || [];

        // Clear existing options
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

        // Populate barangay options
        barangays.forEach(barangay => {
            const option = document.createElement('option');
            option.value = barangay.value;
            option.textContent = barangay.text;
            barangaySelect.appendChild(option);
        });
    });
});
</script>
</section>
<script src="report/script.js"></script>

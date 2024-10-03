<?php if($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
    </script>
<?php endif; ?>

<style>
    <style>
    img#cimg {
        height: 300px; /* Adjust the height */
        width: 100%;   /* Make the image responsive */
        object-fit: cover; /* Ensure the image fills the container */
        border-radius: 0;  /* Remove rounded corners */
    }
</style>
<div class="col-lg-12">
    <div class="card card-outline rounded-0 card-danger">
        <div class="card-header">
            <h5 class="card-title">Manage Event</h5>
        </div>
        <div class="card-body">
        <form action="<?php echo base_url ?>admin/?page=system_info/event_process" id="event-frm" method="POST" enctype="multipart/form-data">
                <div id="msg" class="form-group"></div>

                <div class="form-group">
                    <label for="event_name" class="control-label">Event Name</label>
                    <input type="text" class="form-control form-control-sm" name="event_name" id="event_name" required>
                </div>

                <div class="form-group">
                    <label for="event_description" class="control-label">Event Description</label>
                    <textarea name="event_description" id="event_description" cols="30" rows="4" class="form-control form-control-sm" required></textarea>
                </div>

                <div class="form-group">
                    <label for="event_date" class="control-label">Event Date</label>
                    <input type="date" class="form-control form-control-sm" name="event_date" id="event_date" required>
                </div>

                <!-- Add Location Field -->
                <div class="form-group">
                    <label for="municipality" class="control-label">Municipality</label>
                    <select name="municipality" id="municipality" class="form-control form-control-sm" required>
                        <option value="" disabled selected>Select Municipality</option>
                        <option value="Santa Fe">Santa Fe</option>
                        <option value="Bantayan">Bantayan</option>
                        <option value="Madridejos">Madridejos</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="barangay" class="control-label">Barangay</label>
                    <select name="barangay" id="barangay" class="form-control form-control-sm" required>
                        <option value="" disabled selected>Select Barangay</option>
                        <!-- Barangay options will be dynamically populated based on selected municipality -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="sitio" class="control-label">Sitio/Specific Location</label>
                    <input type="text" class="form-control form-control-sm" name="sitio" id="sitio" required>
                </div>

                <div class="form-group">
                    <label for="event_image" class="control-label">Event Image</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="event_image" name="event_image" accept="image/*" onchange="displayImg(this,$(this))">
                        <label class="custom-file-label" for="event_image">Choose file</label>
                    </div>
                </div>

                <div class="form-group d-flex justify-content-center">
                    <img src="" alt="" id="cimg" class="img-fluid img-thumbnail">
                </div>

                <button class="btn btn-sm btn-primary" type="submit">Save Event</button>
            </form>
        </div>
    </div>
</div>

<script>
    function displayImg(input, _this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#cimg').attr('src', e.target.result); // Show the image
                _this.siblings('.custom-file-label').html(input.files[0].name); // Update file label
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Dynamically update barangays based on selected municipality
    document.getElementById('municipality').addEventListener('change', function() {
        var municipality = this.value;
        var barangayDropdown = document.getElementById('barangay');

        // Reset barangay dropdown
        barangayDropdown.innerHTML = '<option value="" disabled selected>Select Barangay</option>';

        if (municipality === 'Santa Fe') {
            barangayDropdown.innerHTML += '<option value="Balidbid">Balidbid</option><option value="Hagdan">Hagdan</option><option value="Hilantagaan">Hilantagaan</option><option value="Kinatarkan">Kinatarkan</option><option value="Langub">Langub</option><option value="Maricaban">Maricaban</option><option value="Okoy">Okoy</option><option value="Poblacion">Poblacion</option><option value="Pooc">Pooc</option><option value="Talisay">Talisay</option>';
        } else if (municipality === 'Bantayan') {
            barangayDropdown.innerHTML += '<option value="Atop-Atop">Atop-Atop</option><option value="Baigad">Baigad</option><option value="Bantigue">Bantigue</option><option value="Baod">Baod</option><option value="Binaobao">Binaobao</option><option value="Botigues">Botigues</option><option value="Doong">Doong</option><option value="Guiwanon">Guiwanon</option><option value="Hilotongan">Hilotongan</option><option value="Kabac">Kabac</option><option value="Kampinganon">Kampinganon</option><option value="Kabangbang">Kabangbang</option><option value="Kangkaibe">Kangkaibe</option><option value="Lipayran">Lipayran</option><option value="Luyong Baybay">Luyong Baybay</option><option value="Mojon">Mojon</option><option value="Oboob">Oboob</option><option value="Patao">Patao</option><option value="Putian">Putian</option><option value="Sillon">Sillon</option><option value="Suba">Suba</option><option value="Sulangan">Sulangan</option><option value="Sungko">Sungko</option><option value="Tamiao">Tamiao</option><option value="Ticad">Ticad</option>';
        } else if (municipality === 'Madridejos') {
            barangayDropdown.innerHTML += '<option value="Bunakan">Bunakan</option><option value="Kangwayan">Kangwayan</option><option value="Kaongkod">Kaongkod</option><option value="Kodia">Kodia</option><option value="Maalat">Maalat</option><option value="Malbago">Malbago</option><option value="Mancilang">Mancilang</option><option value="Pili">Pili</option><option value="Poblacion">Poblacion</option><option value="San Agustin">San Agustin</option><option value="Tabagak">Tabagak</option><option value="Talangnan">Talangnan</option><option value="Tarong">Tarong</option><option value="Tugas">Tugas</option>';
        }
    });
</script>

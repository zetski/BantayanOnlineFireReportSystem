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
            <form action="" id="event-frm" method="POST" enctype="multipart/form-data">
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
            barangayDropdown.innerHTML += '<option value="Barangay 1">Barangay 1</option><option value="Barangay 2">Barangay 2</option>';
        } else if (municipality === 'Bantayan') {
            barangayDropdown.innerHTML += '<option value="Barangay A">Barangay A</option><option value="Barangay B">Barangay B</option>';
        } else if (municipality === 'Madridejos') {
            barangayDropdown.innerHTML += '<option value="Barangay X">Barangay X</option><option value="Barangay Y">Barangay Y</option>';
        }
    });
</script>

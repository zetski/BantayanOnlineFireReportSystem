<style>
    .contact-icon {
        font-size: 1.2em;
        color: #007bff; /* Change the color to suit your theme */
        margin-right: 10px;
    }

    .content {
        color: #fff;
        background-color: #ff4600;
    }

    .form-group {
        position: relative;
    }

    .form-group .control-label {
        margin-bottom: 0.5em;
    }

    .carousel-item>img {
        object-fit: cover;
        width: 100%;
        height: 100%;
    }

    .upload-photo-section {
        text-align: center;
        margin-bottom: 20px;
    }

    .upload-photo-section label {
        display: block;
        margin-bottom: 0.5em;
        font-weight: bold;
    }

    .upload-photo-section input {
        display: block;
        margin: 0 auto;
    }
</style>

<?php if($_settings->chk_flashdata('success')): ?>
<script>
    alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success');
</script>
<?php endif; ?>

<div class="content py-3 px-3">
    <h2><b>Contact Information</b></h2>
</div>
<div class="row mt-lg-n4 mt-md-n4 justify-content-center">
    <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
        <div class="card rounded-0 shadow">
            <div class="card-body">
                <div class="row">
                    <!-- Left Side: Form -->
                    <div class="col-md-6">
                        <form action="" id="system-frm">
                            <div id="msg" class="form-group"></div>
                            <div class="form-group">
                                <label for="phone" class="control-label">
                                    <i class="fas fa-phone contact-icon"></i> Telephone #
                                </label>
                                <input type="text" class="form-control form-control-sm rounded-0" name="phone" id="phone" value="<?php echo $_settings->info('phone') ?>" maxlength="15" pattern="[\d\(\)\-]+" title="Please enter a valid phone number">
                            </div>
                            <div class="form-group">
                                <label for="mobile" class="control-label">
                                    <i class="fas fa-mobile-alt contact-icon"></i> Mobile #
                                </label>
                                <input type="text" class="form-control form-control-sm rounded-0" name="mobile" id="mobile" value="<?php echo $_settings->info('mobile') ?>" maxlength="11" pattern="\d{11}" title="Please enter exactly 11 digits">
                            </div>
                            <div class="form-group">
                                <label for="email" class="control-label">
                                    <i class="fas fa-envelope contact-icon"></i> Email
                                </label>
                                <input type="email" class="form-control form-control-sm rounded-0" name="email" id="email" value="<?php echo $_settings->info('email') ?>">
                            </div>
                            <div class="form-group">
                                <label for="address" class="control-label">
                                    <i class="fas fa-map-marker-alt contact-icon"></i> Address
                                </label>
                                <textarea rows="3" class="form-control form-control-sm rounded-0" name="address" id="address"><?php echo $_settings->info('address') ?></textarea>
                            </div>
                        </form>
                    </div>

                    <!-- Right Side: Image Upload and Carousel -->
                    <div class="col-md-6">
                        <div class="upload-photo-section">
                            <label for="upload-photo">Upload Photo</label>
                            <input type="file" id="upload-photo" name="upload-photo" accept="image/*">
                        </div>

                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php 
                                    $upload_path = "uploads/photos";
                                    if(is_dir(base_app.$upload_path)): 
                                    $file= scandir(base_app.$upload_path);
                                    $_i = 0;
                                        foreach($file as $img):
                                            if(in_array($img,array('.','..')))
                                                continue;
                                    $_i++;
                                        
                                ?>
                                <div class="carousel-item <?php echo $_i == 1 ? "active" : '' ?>">
                                    <img src="<?php echo validate_image($upload_path.'/'.$img) ?>" class="d-block w-100" alt="<?php echo $img ?>">
                                </div>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="col-md-12">
                    <div class="row">
                        <button class="btn btn-sm btn-primary" form="system-frm">Update Info</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script>
    $(document).ready(function() {
        $('#system-frm').submit(function(e) {
            e.preventDefault();
            var _this = $(this);
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=update_settings",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                dataType: 'json',
                error: function(err) {
                    console.log(err);
                    alert_toast("An error occurred", 'error');
                    end_loader();
                },
                // success: function(resp){
                //     if(typeof resp === 'object' && resp.status === 'success'){
                //         Swal.fire({
                //             icon: 'success',
                //             title: 'Success',
                //             text: 'Information updated successfully!',
                //             showConfirmButton: false,
                //             timer: 1500
                //         }).then(() => {
                //             location.replace('./?page=system_settings');
                //         });
                //     } else if(resp.status === 'failed' && resp.msg){
                //         var el = $('<div>');
                //         el.addClass("alert alert-danger err-msg").text(resp.msg);
                //         _this.prepend(el);
                //         el.show('slow');
                //         $("html, body").animate({ scrollTop: _this.closest('.card').offset().top }, "fast");
                //         end_loader();
                //     } else {
                //         alert_toast("An error occurred", 'error');
                //         end_loader();
                //         console.log(resp);
                //     }
                // }
            });
        });

        // Restrict phone input to numbers, dashes, and parentheses
        $('#phone').on('input', function() {
            this.value = this.value.replace(/[^0-9\(\)\-]/g, '');
        });

        // Restrict mobile input to numbers only
        $('#mobile').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    });
</script>

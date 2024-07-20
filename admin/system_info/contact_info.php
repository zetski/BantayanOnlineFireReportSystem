<?php if($_settings->chk_flashdata('success')): ?>
<!-- Remove the alert_toast here -->
<?php endif; ?>
<div class="content py-3 px-3" style="color: #fff; background-color: #2980B9">
    <h2><b>Contact information</b></h2>
</div>
<div class="row mt-lg-n4 mt-md-n4 justify-content-center">
    <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
        <div class="card rounded-0 shadow">
            <div class="card-body">
                <form action="" id="system-frm">
                    <div id="msg" class="form-group"></div>
                    <div class="form-group">
                        <label for="phone" class="control-label">Telephone #</label>
                        <input type="text" class="form-control form-control-sm rounded-0" name="phone" id="phone" value="<?php echo $_settings->info('phone') ?>">
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="control-label">Mobile #</label>
                        <input type="text" class="form-control form-control-sm rounded-0" name="mobile" id="mobile" value="<?php echo $_settings->info('mobile') ?>" maxlength="11" pattern="\d{11}" title="Please enter exactly 11 digits">
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">Email</label>
                        <input type="email" class="form-control form-control-sm rounded-0" name="email" id="email" value="<?php echo $_settings->info('email') ?>">
                    </div>
                    <div class="form-group">
                        <label for="address" class="control-label">Address</label>
                        <textarea rows="3" class="form-control form-control-sm rounded-0" name="address" id="address"><?php echo $_settings->info('address') ?></textarea>
                    </div>
                </form>
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
<script>
    $(document).ready(function(){
        $('#system-frm').submit(function(e){
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
                error: function(err){
                    console.log(err);
                    alert_toast("An error occurred", 'error');
                    end_loader();
                },
                success: function(resp){
                    if(typeof resp === 'object' && resp.status === 'success'){
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Information updated successfully!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.replace('./?page=system_settings');
                        });
                    } else if(resp.status === 'failed' && resp.msg){
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

        // Restrict mobile input to numbers only
        $('#mobile').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    });
</script>

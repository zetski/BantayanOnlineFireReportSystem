$(function(){
    $('#request-form').submit(function(e){
        e.preventDefault();
        var _this = $(this);
        $('.err-msg').remove();
        start_loader();
        $.ajax({
            url: "classes/Master.php?f=save_request",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            error: function(err) {
                console.log(err);
                alert_toast("An error occurred",'error');
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
                    $("html, body").animate({ scrollTop: _this.closest('.card').offset().top }, "fast");
                    end_loader();
                } else {
                    alert_toast("An error occurred",'error');
                    end_loader();
                    console.log(resp);
                }
            }
        });
    });

    $('#image-upload').change(function(){
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-preview').attr('src', e.target.result);
                $('#modal-image').attr('src', e.target.result);
                $('#image-preview-container').removeClass('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    });

    $(document).on('click', '#image-preview', function() {
        $('#imageModal').modal('show');
    });

    $(document).on('click', '#remove-image', function() {
        $('#image-upload').val('');
        $('#image-preview').attr('src', '#');
        $('#image-preview-container').addClass('d-none');
        $('#modal-image').attr('src', '#');
    });
});

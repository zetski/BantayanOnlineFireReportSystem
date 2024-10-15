<?php 
require_once('../../config.php');

// Get the current logged-in admin's district
$admin_id = $_settings->userdata('id'); // Assuming the logged-in user data is stored in $_settings
$admin_qry = $conn->query("SELECT district FROM `team_list` WHERE id = '{$admin_id}'");
if($admin_qry->num_rows > 0){
    $admin = $admin_qry->fetch_assoc();
    $admin_district = $admin['district']; // Admin's district
}

if(isset($_GET['id']) && $_GET['id'] > 0){
    // Fetch the request details
    $qry = $conn->query("SELECT * FROM `request_list` WHERE id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k = $v;
        }
    }
}
?>
<div class="container-fluid">
    <form action="" id="assign-form">
        <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
        <div class="form-group">
            <label for="team_id" class="control-label">Assigned To Team<small class="text-danger">*</small></label>
            <select class="form-control form-control-sm rounded-0" name="team_id" id="team_id" required="required">
                <option value="" disabled <?= !isset($team_id) ? 'selected' : '' ?>></option>
                <?php 
                // Query to get available teams where team district matches the admin's district and the municipality of the request
                $teams = $conn->query("SELECT * FROM `team_list` 
                    WHERE delete_flag = 0 
                    AND district = '{$admin_district}' 
                    AND district = '{$municipality}' 
                    AND COALESCE((SELECT `status` FROM `request_list` WHERE `team_id` = team_list.id), 0) NOT IN (1, 2, 3) "
                    . (isset($team_id) && $team_id > 0 ? " OR id = '{$team_id}' " : "") . 
                    " ORDER BY `code` ASC");
                
                while($row = $teams->fetch_assoc()):
                ?>
                <option value="<?= $row['id'] ?>" <?= isset($team_id) && $team_id == $row['id'] ? 'selected' : '' ?>><?= $row['code'] ?> [TL: <?= $row['leader_name'] ?>]</option>
                <?php endwhile; ?>
            </select>
        </div>
    </form>
</div>
<script>
    $(function(){
        $('#uni_modal').on('shown.bs.modal', function(){
            $('#team_id').select2({
                placeholder:"Please Select Team Here",
                width:"100%",
                dropdownParent:$('#uni_modal'),
                containerCssClass:'form-control form-control-sm rounded-0'
            })
        })
        $('#assign-form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=assign_team",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: err => {
                    console.log(err)
                    alert_toast("An error occured",'error');
                    end_loader();
                },
                success: function(resp){
                    if (typeof resp == 'object' && resp.status == 'success') {
                        location.reload()
                    } else if (resp.status == 'failed' && !!resp.msg) {
                        var el = $('<div>')
                        el.addClass("alert alert-danger err-msg").text(resp.msg)
                        _this.prepend(el)
                        el.show('slow')
                        $("html, body, .modal").scrollTop(0);
                        end_loader()
                    } else {
                        alert_toast("An error occured",'error');
                        end_loader();
                        console.log(resp)
                    }
                }
            })
        })
    })
</script>

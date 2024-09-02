<?php if($_settings->chk_flashdata('success')): ?>
<script>
    alert_toast("<?php echo $_settings->flashdata('success') ?>",'success');
</script>
<?php endif; ?>

<?php 
$status = isset($_GET['status']) ? $_GET['status'] : '';
$stat_arr = ['Pending Requests', 'Assigned to a Team', 'Request where a Team is on their Way', 'Requests where Fire Relief is on Progress', 'Requests where Fire Relief Completed'];
?>
<div class="card card-outline rounded-0 card-danger">
    <div class="card-header">
        <h3 class="card-title">List of <?= isset($stat_arr[$status]) ? $stat_arr[$status] : 'All Requests' ?></h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-hover table-striped table-bordered" id="list">
                <colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="15%">
                    <col width="20%">
                    <col width="15%">
                    <col width="15%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date Created</th>
                        <th>Code</th>
                        <th>Reported By</th>
                        <th>Message</th>
                        <th>Address</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    $where = "";
                    switch($status){
                        case 0:
                            $where = " where `status` = 0 ";
                            break;
                        case 1:
                            $where = " where `status` = 1 ";
                            break;
                        case 2:
                            $where = " where `status` = 2 ";
                            break;
                        case 3:
                            $where = " where `status` = 3 ";
                            break;
                        case 4:
                            $where = " where `status` = 4 ";
                            break;
                    }
                    $qry = $conn->query("SELECT * from `request_list` {$where} order by abs(unix_timestamp(date_created)) desc ");
                    while($row = $qry->fetch_assoc()):
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td><?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
                            <td><?php echo $row['code']; ?></td>
                            <td>
                                <?php echo $row['lastname'] . ', ' . $row['firstname'] . ' ' . $row['middlename']; ?><br>
                                <small><?php echo $row['contact']; ?></small>
                            </td>
                            <td>
                                <span>Subject: <?php echo $row['subject']; ?></span><br>
                                <span><?php echo $row['message']; ?></span>
                            </td>
                            <td>
                                <?php 
                                    echo $row['purok_street'] . ', ' . $row['barangay'] . ', ' . ucwords(str_replace('_', ' ', $row['municipality']));
                                ?>
                            </td>
                            <td>
                            <?php
                            // Define the base directory where images are stored
                            $baseDir = '../uploads/';

                            // Check if the photo field is not empty and if the file exists
                            $imagePath = !empty($row['photo']) && file_exists($baseDir . $row['photo']) 
                                        ? $baseDir . $row['photo'] 
                                        : $baseDir . 'default-image.jpg';
                            ?>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#imageModal<?php echo $i; ?>">
                                <img src="<?php echo htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8'); ?>" alt="Image" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                            </a>

                            <!-- Modal -->
                            <div class="modal fade" id="imageModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel<?php echo $i; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="imageModalLabel<?php echo $i; ?>">Image Preview</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="<?php echo htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8'); ?>" alt="Image" class="img-fluid">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </td>
                            <td align="center">
                                <button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="./?page=requests/view_request&id=<?php echo $row['id']; ?>"><span class="fa fa-eye text-dark"></span> View</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="./?page=requests/manage_request&id=<?php echo $row['id']; ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.delete_data').click(function(){
            _conf("Are you sure to delete this request permanently?", "delete_request", [$(this).attr('data-id')]);
        });
        $('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: [7] }
            ],
            order: [0, 'asc']
        });
        $('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle');
    });

    function delete_request($id){
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_request",
            method: "POST",
            data: {id: $id},
            dataType: "json",
            error: err => {
                console.log(err);
                alert_toast("An error occurred.", 'error');
                end_loader();
            },
            success: function(resp){
                if (typeof resp === 'object' && resp.status === 'success'){
                    location.reload();
                } else {
                    alert_toast("An error occurred.", 'error');
                    end_loader();
                }
            }
        });
    }
</script>

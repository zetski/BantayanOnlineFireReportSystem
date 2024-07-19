<?php if($_settings->chk_flashdata('success')): ?>
<script>
    alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
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
                    <col width="10%">
                    <col width="15%">
                    <col width="20%">
                    <col width="20%">
                    <col width="15%">
                </colgroup>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date Created</th>
                        <th>Code</th>
                        <th>Reported By</th>
                        <th>Message</th>
                        <th>Image</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    $where = "";
                    switch ($status) {
                        case 0:
                            $where = " WHERE `status` = 0 ";
                            break;
                        case 1:
                            $where = " WHERE `status` = 1 ";
                            break;
                        case 2:
                            $where = " WHERE `status` = 2 ";
                            break;
                        case 3:
                            $where = " WHERE `status` = 3 ";
                            break;
                        case 4:
                            $where = " WHERE `status` = 4 ";
                            break;
                    }
                    $qry = $conn->query("SELECT * FROM `request_list` {$where} ORDER BY abs(unix_timestamp(date_created)) DESC");
                    while ($row = $qry->fetch_assoc()):
                        $image_src = !empty($row['image']) && file_exists($row['image']) ? $row['image'] : '../uploads/def.jpg';
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td><?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
                            <td><?php echo $row['code'] ?></td>
                            <td><?php echo $row['fullname'] ?></td>
                            <td><?php echo $row['message'] ?></td>
                            <td><img src="<?php echo $image_src; ?>" alt="Image" style="width: 40px; height: 40px; cursor: pointer;" data-toggle="modal" data-target="#imageModal" data-src="<?php echo $image_src; ?>"></td>
                            <td><?php echo $row['location'] ?></td>
                            <td align="center">
                                <button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="./?page=requests/view_request&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="./?page=requests/manage_request&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal HTML -->
<div id="imageModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Image Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="modalImage" src="" class="img-fluid" alt="Image">
            </div>
        </div>
    </div>
</div>

<script>
   $(document).ready(function() {
    // Deletion confirmation and request handling
    $('.delete_data').click(function() {
        _conf("Are you sure to delete this request permanently?", "delete_request", [$(this).attr('data-id')]);
    });

    // Data table initialization
    $('.table').dataTable({
        columnDefs: [
            { orderable: false, targets: [5] } // Disable ordering for the 6th column
        ],
        order: [0, 'asc'] // Set initial order to ascending on the first column
    });
    $('.dataTable td, .dataTable th').addClass('py-1 px-2 align-middle'); // Add padding and alignment

    // Image modal handling
    $('#imageModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var src = button.data('src'); // Extract image source from data-* attribute
        var modal = $(this);
        modal.find('#modalImage').attr('src', src); // Update modal image source
    });
});

// Function to handle request deletion
function delete_request($id) {
    start_loader();
    $.ajax({
        url: _base_url_ + "classes/Master.php?f=delete_request",
        method: "POST",
        data: { id: $id },
        dataType: "json",
        error: err => {
            console.log(err);
            alert_toast("An error occurred.", 'error');
            end_loader();
        },
        success: function(resp) {
            if (typeof resp == 'object' && resp.status == 'success') {
                location.reload();
            } else {
                alert_toast("An error occurred.", 'error');
                end_loader();
            }
        }
    });
}

</script>

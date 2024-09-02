<?php if($_settings->chk_flashdata('success')): ?>
<script>
    alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success');
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
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td><?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
                            <td><?php echo $row['code'] ?></td>
                            <td><?php echo $row['fullname'] ?></td>
                            <td><?php echo $row['message'] ?></td>
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

<script>
    $(document).ready(function() {
        $('.delete_data').click(function() {
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    delete_request(id);
                }
            });
        });
        $('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: [6] }
            ],
            order: [0, 'asc']
        });
        $('.dataTable td, .dataTable th').addClass('py-1 px-2 align-middle');
    });

    function delete_request(id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_request",
            method: "POST",
            data: { id: id },
            dataType: "json",
            error: err => {
                console.log(err);
                alert_toast("An error occured.", 'error');
                end_loader();
            },
            success: function(resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.reload();
                } else {
                    alert_toast("An error occured.", 'error');
                    end_loader();
                }
            }
        });
    }
</script>

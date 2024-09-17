<?php
// archive.php
include_once '../classes/DBConnection.php'; // include your DB connection

// Fetch archived reports where deleted_reports = 1 (mark as deleted)
$qry = $conn->query("SELECT * FROM request_list WHERE deleted_reports = 1");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Archived Reports</title>
    <!-- Include necessary CSS and JS -->
    <link rel="stylesheet" href="path/to/datatables.min.css">
    <script src="path/to/jquery.min.js"></script>
    <script src="path/to/datatables.min.js"></script>
    <script src="path/to/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="path/to/sweetalert2.min.css">
</head>
<body>
    <h1>Archived Reports</h1>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Date Created</th>
                <th>Code</th>
                <th>Reported By</th>
                <th>Message</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            while ($row = $qry->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $i++ . '</td>';
                echo '<td>' . $row['date_created'] . '</td>';
                echo '<td>' . $row['code'] . '</td>';

                // Display full name (Lastname, Firstname Middlename)
                echo '<td>' . $row['lastname'] . ', ' . $row['firstname'] . ' ' . $row['middlename'] . '<br>';
                echo '<small>' . $row['contact'] . '</small></td>';

                // Display the message (Subject only)
                echo '<td><span>Subject: ' . $row['subject'] . '</span></td>';

                // Display the address
                echo '<td>' . $row['sitio_street'] . ', ' . $row['barangay'] . ', ' . ucwords($row['municipality']) . '</td>';

                // Restore action
                echo '<td>
                    <a class="dropdown-item restore_data" href="javascript:void(0)" data-id="' . $row['id'] . '">
                        <span class="fa fa-undo text-success"></span> Restore
                    </a>
                </td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    <script>
    $(document).ready(function(){
        $('.restore_data').click(function(){
            var id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to restore this request?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, restore it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    restore_request(id);
                }
            });
        });

        $('.table').DataTable({
            columnDefs: [
                { orderable: false, targets: [6] } // Adjust index for action column
            ],
            order:[0,'asc']
        });

        $('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle');
    });

    function restore_request(id){
        $.ajax({
            url: 'classes/Master.php?f=restore_request',
            method: 'POST',
            data: { id: id },
            dataType: 'json',
            beforeSend: function() {
                // You can show a loader here
            },
            success: function(resp){
                if (resp.status === 'success') {
                    Swal.fire('Restored!', 'The request has been restored.', 'success').then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire('Failed!', 'An error occurred.', 'error');
                }
            },
            error: function(){
                Swal.fire('Failed!', 'An error occurred.', 'error');
            }
        });
    }
    </script>
</body>
</html>

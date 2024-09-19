<?php
// archive.php
include_once '../classes/DBConnection.php'; // Include your DB connection

// Fetch archived reports with status = 5 (Assumed 5 is the archived status)
$qry = $conn->query("SELECT * FROM request_list WHERE status = 5"); 
?>
<!DOCTYPE html>
<html lang="en">   
<style>
  .dataTables_length select {
    width: auto; /* Makes the dropdown width proper */
    padding: 5px; /* Ensures proper spacing */
    padding-right: 15px;
    font-size: 14px; /* Adjust font size to match the rest */
  }

  .dataTables_wrapper .dataTables_length label {
    display: flex;
    align-items: center;
  }
  
  /* Fix sorting arrows for better visibility */
  th.sorting::after, th.sorting_asc::after, th.sorting_desc::after {
    font-family: FontAwesome;
    content: "\f0dc"; /* Default sorting icon */
    padding-left: 8px;
    opacity: 0.6;
  }

  th.sorting_asc::after {
    content: "\f0de"; /* Ascending arrow */
  }

  th.sorting_desc::after {
    content: "\f0dd"; /* Descending arrow */
  }
</style>
<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- DataTables Bootstrap Integration -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
    <h1>Archived Reports</h1>
    <table class="table display">
        <thead>
            <tr>
                <th>#</th>
                <th>Date Created</th>
                <th>Code</th>
                <th>Reported By</th>
                <th>Message</th>
                <th>Location</th>
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
                echo '<td>' . $row['fullname'] . '</td>';
                echo '<td>' . $row['message'] . '</td>';
                echo '<td>' . $row['location'] . '</td>';
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
        // Initialize DataTable
        $('.table').DataTable({
            columnDefs: [
                { orderable: false, targets: [6] } // Disable ordering on the 'Action' column
            ],
            order: [0, 'asc'] // Default ordering
        });

        // Add styling to table cells
        $('.dataTable td, .dataTable th').addClass('py-1 px-2 align-middle');

        // Restore data handler
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
    });

    // Function to handle the restoration of requests
    function restore_request(id){
        $.ajax({
            url: 'classes/Master.php?f=restore_request',
            method: 'POST',
            data: { id: id },
            dataType: 'json',
            beforeSend: function() {
                // Optional: Show loader while request is being processed
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

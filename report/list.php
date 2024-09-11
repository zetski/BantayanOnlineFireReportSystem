<style>
    body {
        padding-top: 10px;
        margin-top: 40px;
    }
</style>
<section class="py-3">
    <div class="container">
        <div class="content py-3 px-3" style="background-color: #ff4600; color: #fff">
            <h2>Search Result against '<?= $_GET['search'] ?>'</h2>
        </div>
        <div class="row mt-lg-n4 mt-md-n3 mt-sm-n2 justify-content-center">
            <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
                <div class="card rounded-0 shadow">
                    <div class="card-body">
                        <div class="container-fluid">
                            <table class="table table-hover table-striped table-bordered" id="list">
                                <colgroup>
                                    <col width="5%">
                                    <col width="20%">
                                    <col width="15%">
                                    <col width="20%">
                                    <col width="25%">
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(isset($_GET['search'])):
                                    $i = 1;
                                    $qry = $conn->query("SELECT *, CONCAT(lastname, ', ', firstname, ' ', middlename, ' ',contact) as reported_by, 
                                    CONCAT(sitio_street, ', ', barangay, ', ', municipality) as address 
                                    from `request_list` 
                                    where (lastname LIKE '%{$_GET['search']}%' or firstname LIKE '%{$_GET['search']}%' or middlename LIKE '%{$_GET['search']}%' or contact LIKE '%{$_GET['search']}%' or code LIKE '%{$_GET['search']}%') 
                                    order by abs(unix_timestamp(date_created)) desc ");
                                        while($row = $qry->fetch_assoc()):
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $i++; ?></td>
                                            <td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
                                            <td><?php echo $row['code'] ?></td>
                                            <td><?php echo $row['reported_by'] ?></td>
                                            <td>
                                                <text>Subject:</text> <?php echo $row['subject'] ?><br>
                                                <?php echo $row['message'] ?>
                                            </td>
                                            <td><?php echo $row['address'] ?></td>
                                            <td align="center">
                                                <a href="./?p=report/view_report&id=<?= $row['id'] ?>" class="btn btn-flat btn-sm btn-light bg-gradient-light border">
                                                        <i class="fa fa-eye text-dark"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(function(){
        $('#list').find('th, td').addClass('py-1 px-2 align-middle')
    })
</script>

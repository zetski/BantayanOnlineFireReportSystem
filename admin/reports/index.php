<?php 
$from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '2021-01-01';
$to_date = isset($_GET['to_date']) ? $_GET['to_date'] : date("Y-m-d");
?>
<div class="content py-3 px-3" style="color: #fff; background-color: #2980B9">
    <h2>Daily Report</h2>
</div>
<div class="row flex-column mt-4 justify-content-center align-items-center mt-lg-n4 mt-md-3 mt-sm-0">
    <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
        <div class="card rounded-0 mb-2 shadow">
            <div class="card-body">
                <fieldset>
                    <legend>Filter</legend>
                    <form action="" id="filter-form">
                        <div class="row align-items-end">
                            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="from_date" class="control-label">From Date</label>
                                    <input type="date" class="form-control form-control-sm rounded-0" name="from_date" id="from_date" value="<?= isset($_GET['from_date']) ? $_GET['from_date'] : '' ?>" required="required">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="to_date" class="control-label">To Date</label>
                                    <input type="date" class="form-control form-control-sm rounded-0" name="to_date" id="to_date" value="<?= isset($_GET['to_date']) ? $_GET['to_date'] : '' ?>" required="required">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <button class="btn btn-sm btn-flat btn-primary bg-gradient-primary"><i class="fa fa-filter"></i> Filter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
        <div class="card rounded-0 mb-2 shadow">
            <div class="card-header py-1">
                <div class="card-tools">
                    <button class="btn btn-flat btn-sm btn-light bg-gradient-light border" type="button" id="print"><i class="fa fa-print"></i> Print</button>
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid" id="printout">
                    <table class="table table-bordered">
                        <colgroup>
                            <col width="5%">
                            <col width="20%">
                            <col width="15%">
                            <col width="30%">
                            <col width="30%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="px-1 py-1 text-center">#</th>
                                <th class="px-1 py-1 text-center">Request Code</th>
                                <th class="px-1 py-1 text-center">Reported By</th>
                                <th class="px-1 py-1 text-center">Message</th>
                                <th class="px-1 py-1 text-center">Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $g_total = 0;
                            $i = 1;
                            $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : null;
                            $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : null;

                            if ($from_date && $to_date) {
                                $requests = $conn->query("SELECT * FROM `request_list` WHERE date(date_created) BETWEEN '{$from_date}' AND '{$to_date}' ORDER BY abs(unix_timestamp(date_created)) asc ");
                            } else {
                                $requests = $conn->query("SELECT * FROM `request_list` ORDER BY abs(unix_timestamp(date_created)) asc ");
                            }

                            while($row = $requests->fetch_assoc()):
                            ?>
                            <tr>
                                <td class="px-1 py-1 align-middle text-center"><?= $i++ ?></td>
                                <td class="px-1 py-1 align-middle"><?= $row['code'] ?></td>
                                <td class="px-1 py-1 align-middle">
                                    <div line-height="1em">
                                        <div class="font-weight-bold"><?= $row['fullname'] ?></div>
                                        <div class="font-weight-light"><?= $row['contact'] ?></div>
                                    </div>
                                </td>
                                <td class="px-1 py-1 align-middle"><?= str_replace(["\r\n", "\r", "\n"] , "<br>", $row['message']) ?></td>
                                <td class="px-1 py-1 align-middle"><?= str_replace(["\r\n", "\r", "\n"] , "<br>", $row['location']) ?></td>
                            </tr>
                            <?php endwhile; ?>
                            <?php if($requests->num_rows <= 0): ?>
                                <tr>
                                    <td class="py-1 text-center" colspan="5">No records found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<noscript id="print-header">
    <div>
        <style>
            html{
                min-height:unset !important;
            }
        </style>
        <div class="d-flex w-100 align-items-center">
            <div class="col-2 text-center">
                <img src="<?= validate_image($_settings->info('logo')) ?>" alt="" class="rounded-circle border" style="width: 5em;height: 5em;object-fit:cover;object-position:center center">
            </div>
            <div class="col-8">
                <div style="line-height:1em">
                    <div class="text-center font-weight-bold h5 mb-0"><large><?= $_settings->info('name') ?></large></div>
                    <div class="text-center font-weight-bold h5 mb-0"><large>Daily Requests Report</large></div>
                    <div class="text-center font-weight-bold h5 mb-0">From <?= date("F d, Y", strtotime($from_date)) ?> to <?= date("F d, Y", strtotime($to_date)) ?></div>
                </div>
            </div>
        </div>
        <hr>
    </div>
</noscript>
<script>
    function print_r(){
        var h = $('head').clone()
        var el = $('#printout').clone()
        var ph = $($('noscript#print-header').html()).clone()
        h.find('title').text("Daily Report - Print View")
        var nw = window.open("", "_blank", "width="+($(window).width() * .8)+",left="+($(window).width() * .1)+",height="+($(window).height() * .8)+",top="+($(window).height() * .1))
            nw.document.querySelector('head').innerHTML = h.html()
            nw.document.querySelector('body').innerHTML = ph[0].outerHTML
            nw.document.querySelector('body').innerHTML += el[0].outerHTML
            nw.document.close()
            start_loader()
            setTimeout(() => {
                nw.print()
                setTimeout(() => {
                    nw.close()
                    end_loader()
                }, 200);
            }, 300);
    }
    $(function(){
        $('#filter-form').submit(function(e){
            e.preventDefault()
            location.href = './?page=reports&'+$(this).serialize()
        })
        $('#print').click(function(){
            print_r()
        })
        
        // Set min and max dates for the date inputs
        var today = new Date().toISOString().split('T')[0];
        var from_date_input = document.getElementById('from_date');
        var to_date_input = document.getElementById('to_date');
        
        from_date_input.max = today;
        to_date_input.min = today;
    })
</script>

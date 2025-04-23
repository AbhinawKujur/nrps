<style>
    #example {
        font-size: 14px;
    }

    table,
    td,
    th {
        font-size: 14px;
    }
</style>
<div class='row'>
    <div class='col-md-12 col-xl-12 col-sm-12'>
        <form action="<?php echo base_url('Reconcilation/downloadpdf_dues'); ?>" method="post">
            <input type="hidden" name='feehead' value="<?php echo $feehead; ?>">
            <input type="hidden" name='month' value="<?php echo $month; ?>">
            <center>
                <button class='btn btn-success text-center'>DOWNLOAD</button>
            </center>
        </form>
    </div>
    <br>
    <div class='col-md-12 col-xl-12 col-sm-12'>
        <div style='overflow:auto;'>
            <table id='example' class="table-bordered table-striped">
                <thead>
                    <tr>
                        <th style='color:white!important;'>SL. NO.</th>
                        <th style='color:white!important;'>ADM. NO.</th>
                        <th style='color:white!important;'>STUDENT NAME</th>
                        <th style='color:white!important;'>CLASS</th>
                        <th style='color:white!important;'>UNPAID MONTH</th>
                        <th style='color:white!important;'>NO. OF MONTHS UNPAID</th>
                        <th style='color:white!important;'>RATE</th>
                        <th style='color:white!important;'>DUES AMT.</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($classes as $key => $val) {
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $val['ADM_NO']; ?></td>
                            <td><?php echo $val['STU_NAME']; ?></td>
                            <td><?php echo $val['class_nm']; ?></td>
                            <td><?php echo $val['UNPAID_MONTH']; ?></td>
                            <td><?php echo $val['NO_UNPAID_MONTH']; ?></td>
                            <td><?php echo $val['RATE']; ?></td>
                            <td><?php echo $val['TOT_DUES']; ?></td>
                        </tr>
                    <?php
                        $i++;
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7" style="text-align: right;font-weight:700;">TOTAL</td>
                        <td style="color: red;font-weight:700;"><?php echo $GRAND_TOT_DUES; ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            ordering: false,
            sorting: false,
            paging: true,
            pageLength: 20,
            dom: 'Bfrtip',
            buttons: [
                /* {
                extend: 'copyHtml5',
				title: 'Daily Collection Reports',
               
            }, */
                {
                    extend: 'excelHtml5',
                    title: 'Reconcilation Dues Report',

                },
                /* {
                extend: 'csvHtml5',
				title: 'Daily Collection Reports',
                
            }, */
                /* {
                extend: 'pdfHtml5',
				title: 'Daily Collection Reports',
                
            }, */
            ]
        });
    });
</script>
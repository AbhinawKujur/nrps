<style>
    #example{
        font-size: 12px;
    }
    table,td,th{
        font-size: 12px;
    }
</style>
<div class='row'>
    <div class='col-md-12 col-xl-12 col-sm-12'>
        <form action="<?php echo base_url('Reconcilation/downloadpdf_prev'); ?>" method="post" target='_blank'>
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
                        <th style='color:white!important;'>RECT. NO.</th>
                        <th style='color:white!important;'>RECT. DATE</th>
                        <th style='color:white!important;'>ADM. NO.</th>
                        <th style='color:white!important;'>PERIOD</th>
                        <th style='color:white!important;'>PAID</th>
                        <th style='color:white!important;'>RATE</th>
                        <th style='color:white!important;'> AMT. COLLECTED IN PREV. MONTHS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($adv_daycoll as $value) {
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $value['RECT_NO']; ?></td>
                            <td><?php echo date('d-M-Y',strtotime($value['RECT_DATE'])); ?></td>
                            <td><?php echo $value['ADM_NO']; ?></td>
                            <td><?php echo $value['PERIOD']; ?></td>
                            <td><?php echo $value['AMT']; ?></td>
                            <td><?php echo $value['RATE']; ?></td>
                            <td><?php echo $value['PREV_AMT']; ?></td>
                        </tr>
                    <?php
                        $i++;
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7" style="text-align: right;font-weight:700;">TOTAL</td>
                        <td style="color: red;font-weight:700;"><?php echo $GRAND_TOT_PREV; ?></td>
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
            dom: 'Bfrtip',
            buttons: [
                /* {
                extend: 'copyHtml5',
				title: 'Daily Collection Reports',
               
            }, */
                {
                    extend: 'excelHtml5',
                    title: 'Reconcilation Previous  Report',

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
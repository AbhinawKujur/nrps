<div class='row'>
    <div class='col-md-12 col-xl-12 col-sm-12'>
        <form action="<?php echo base_url('Reconcilation/download'); ?>" method="post">
            <input type="hidden" name='class' value="<?php echo $clssss; ?>">
            <input type="hidden" name='feehead' value="<?php echo $feehead; ?>">
            <input type="hidden" name='ward' value="<?php echo $ward; ?>">
            <input type="hidden" name='month' value="<?php echo $month; ?>">
            <center>
                <button class='btn btn-success text-center'>DOWNLOAD</button>
            </center>
        </form>
    </div>
    <div class='col-md-12 col-xl-12 col-sm-12'>
        <div style='overflow:auto;'>
            <table id='example' class="table-bordered table-striped">
                <thead>
                    <tr>
                        <th style='color:white!important;'>CLASS</th>
                        <th style='color:white!important;'>MONTH</th>
                        <th style='color:white!important;'>TOTAL STUDENT</th>
                        <th style='color:white!important;'>RATE</th>
                        <th style='color:white!important;'>TOTAL RECEIVABLE</th>
                        <!-- <th style='color:white!important;'>TOTAL FEES PAID</th>
                        <th style='color:white!important;'>TOTAL DUES</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($classes as $value) {
                    ?>
                        <tr>
                            <td><?php echo $value['class_nm']; ?></td>
                            <td><?php echo $value['month']; ?></td>
                            <td><?php echo $value['GEN_COUNT']; ?></td>
                            <td><?php echo $value['GEN_RATE']; ?></td>
                            <td><?php echo $value['TOT_GEN_RCV']; ?></td>
                            <!-- <td><?php //echo $value['TOT_GEN_PYD']; ?></td>
                            <td><?php //echo $value['TOT_GEN_DUES']; ?></td> -->
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" style="text-align: right;font-weight:700;">TOTAL</td>
                        <td style="color: red;font-weight:700;"><?php echo $GRAND_TOT_RCV; ?></td>
                        <!-- <td style="color: red;font-weight:700;"><?php //echo $GRAND_TOT_PYD; ?></td> -->
                        <!-- <td style="color: red;font-weight:700;"><?php //echo $GRAND_TOT_DUES; ?></td> -->
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
            paging: false,
            dom: 'Bfrtip',
            buttons: [
                /* {
                extend: 'copyHtml5',
				title: 'Daily Collection Reports',
               
            }, */
                {
                    extend: 'excelHtml5',
                    title: 'Reconcilation Report',

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
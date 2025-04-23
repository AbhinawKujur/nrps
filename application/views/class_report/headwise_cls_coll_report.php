<form method="post" action="<?php echo base_url('Headwise_class_coll/headwise_fee_coll_pdf'); ?>" target="_blank">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <input type="hidden" value="<?php echo $class; ?>" name="class_name">
            <input type="hidden" value="<?php echo $sec; ?>" name="sec_name">
            <input type="hidden" value="<?php echo $fee_type; ?>" name="fee_type">
            <input type="hidden" value="<?php echo $sort_by; ?>" name="sort_by">
            <button class="btn pull-right"><i class="fa fa-file-pdf-o"></i> Download</button>
        </div>
    </div>

</form><br />
<div class='row'>
    <div class='col-md-12 col-xl-12 col-sm-12'>
        <div style='overflow:auto;'>
            <table id='example'>
                <thead>
                    <tr>
                        <th style='color:white!important;'>Sl. No.</th>
                        <th style='color:white!important;'>Adm. No.</th>
                        <th style='color:white!important;'>Student Name</th>
                        <th style='color:white!important;'>Roll No.</th>
                        <th style='color:white!important;'>Amount Paid</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $grand_tot = 0;
                    foreach ($data as $key => $value) {
                        //if ($value->TOTAL > 0) {
                            $vl = $key + 1;
                    ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $value->ADM_NO; ?></td>
                                <td><?php echo $value->STU_NAME; ?></td>
                                <td><?php echo $value->ROLL_NO; ?></td>
                                <td><?php echo $value->TOTAL; ?></td>
                            </tr>
                        <?php
                            $grand_tot = $grand_tot + $value->TOTAL;
                        //} 
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b style="font-size:16px;color:red;font-weight: 900;">GRAND TOTAL</b></td>
                        <td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot; ?></b></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                /* {
                extend: 'copyHtml5',
				title: 'Daily Collection Reports',
               
            }, */
                {
                    extend: 'excelHtml5',
                    title: 'HeadWise Fee Collection Report',

                },

            ]
        });
    });
</script>
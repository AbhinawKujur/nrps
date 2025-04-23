
<style>
    .table thead tr th {
        background: #337ab7;
        color: #fff !important;
    }
</style>
<div class='row'>
    <div class='col-md-12 col-xl-12 col-sm-12'>
        <div style='overflow:auto;'>
            <table border="1" id='example' style="width: 100%;">
                <thead>
                    <tr>
                        <th style='color:white!important;'>S.NO</th>
                        <th style='color:white!important;'>Head Name</th>
                        <th style='color:white!important;'>Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($feehead as $k => $v) {  ?>
                        <tr>
                            <td style="text-align: left;"><?php echo $v[0]->ACT_CODE; ?></td>
                            <td style="text-align: left;"><?php echo $v[0]->FEE_HEAD; ?></td>
                            <td style="text-align: left;"><?php echo $v[1][0]->Fee; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            'pageLength': 25,
            dom: 'Bfrtip',
            buttons: {
                dom: {
                    button: {
                        tag: 'button',
                        className: ''
                    }
                },
                buttons: [{
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> EXCEL',
                        title: 'Head Wise Summary Report',
                        className: 'btn btn-success',
                        extension: '.xlsx'
                    },
                    {
                        extend: 'pdf',
                        title: 'Head Wise Summary Report',
                        text: '<i class="fa fa-file-pdf-o"></i> PDF',
                        className: 'btn btn-primary',
                        action: function(e, dt, button, config) {
                            var query = dt.search();
                            window.open("<?php echo base_url('Report/headwise_data_PDF'); ?>");
                        }
                    }
                ]
            }
        });
    });
</script>
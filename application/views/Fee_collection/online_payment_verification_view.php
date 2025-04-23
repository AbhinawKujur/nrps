<style type="text/css">
    tr.rowhighlight td,
    tr.rowhighlight th {
        background-color: #f0f8ff;
    }

    .datepicker td,
    .datepicker th {
        width: 1.5em;
        height: 1.5em;
    }
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Online Payment Bank Verification</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
    <?php if ($this->session->flashdata('success')) { ?>

        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong><?php echo $this->session->flashdata('success'); ?></strong>
        </div>

    <?php } ?>

    <?php if ($this->session->flashdata('error')) { ?>

        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong><?php echo $this->session->flashdata('error'); ?></strong>
        </div>

    <?php } ?>

    <div class="container">
        <form id="disponline" method="post" action="<?php echo base_url('Fees_collection/online_payment_verification'); ?>">
            <div class="row">
                <div class='col-md-3'>
                    <div class="form-group">
                        <div class="row" style="padding-top: 50px">
                            Select Date
                        </div>
                    </div>
                </div>
                <div class='col-md-3'>
                    <div class="form-group">
                        <div class="row" style="padding-top: 50px">
                            <div class="col">
                                <input type="date" data-date-format="dd-mm-yyyy" id="datepicker" name="datepicker" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class='col-md-3'>
                    <div class="form-group">
                        <div class="row" style="padding-top: 50px">
                            <div class="col">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" name="display" id="display" value="DISPLAY" class="btn btn-success">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <br><br>

    <?php if (!empty($online_data)) { ?>
        <!-- <table id="myTable" class="table table-bordered" >  -->
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr style="color: #E9F079; background: skyblue;">
                        <th>Sl. No.</th>
                        <th>Adm.<br>No.</th>
                        <th>Class/Sec</th>
                        <th>Order ID</th>
                        <th>Order Status</th>
                        <th>Receipt No</th>
                        <th>Receipt Date</th>
                        <th>Total Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($online_data as $p) {
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo strtoupper($p->ADM_NO); ?></td>
                            <td><?php echo strtoupper($p->CLASS . '/' . $p->SEC); ?></td>
                            <td><?php echo strtoupper($p->order_id); ?></td>
                            <td><?php echo strtoupper($p->order_status); ?></td>
                            <td><?php echo strtoupper($p->RECT_NO); ?></td>
                            <td><?php echo strtoupper($p->RECT_DATE); ?></td>
                            <td><?php echo strtoupper($p->TOTAL); ?></td>
                            <?php if (strtolower($p->order_status) == "success") { ?>
                                <td>
                                    <button type="button" class="btn btn-success">SUCCESS</button>
                                </td>
                            <?php } else { ?>
                                <td>
                                    <form role="form" method="post" action="<?= base_url('Fees_collection/update_online') ?>">
                                        <input type="hidden" name="rect_no" id="rect_no" value="<?php echo $p->ADM_NO; ?>">
                                        <input type="hidden" name="order_id" id="order_id" value="<?php echo $p->order_id; ?>">
                                        <input type="hidden" name="disp_class" id="disp_class" value="<?php echo $p->CLASS; ?>">
                                        <button type="submit" class="btn btn-primary">APPROVE</button>
                                    </form>

                                </td>

                            <?php } ?>

                        </tr>
                    <?php $i++;
                    } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>

</div>

<br>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" />

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('#datepicker').datepicker({
            format: 'dd-mm-yyyy'
        });
    });
</script>
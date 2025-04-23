<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Cancel Receipt Report</a> <i class="fa fa-angle-right"></i></li>
</ol>
<style>
    .ui-datepicker-month,
    .ui-datepicker-year {
        padding: 0px;
    }

    .table,
    #thead,
    tr,
    td,
    th {
        text-align: center;
        color: #000 !important;
    }
</style>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">

    <div class='row'>
        <div class="col-md-3 form-group">
            <label id='ct'>Collection Type</label>
            <select name='collectiontype' id='collectiontype' class='form-control'>
                <option value=''>Select</option>
                <option value='1'>School</option>
                <option value='3'>Bank</option>
            </select>
        </div>

        <div class='col-md-3 form-group'>
            <label id='cc'>Collected By</label>
            <select class='form-control' name='collected_by' id='collected_by'>
                <option value=''>Select</option>
                <?php
                if ($ROLE_ID == 10) {
                ?>
                    <option value='%'>All Counter</option>
                <?PHP
                }
                ?>
                <?php
                if ($user_id) {
                    foreach ($user_id as $data) {
                ?>
                        <option value='<?php echo $data->User_Id; ?>'><?php echo $data->User_Id; ?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>

        <div class="col-md-3 form-group">
            <label id='ct'>Start Date</label>
            <input type="date" name="strt_date" id="strt_date" class="form-control">
        </div>

        <div class="col-md-3 form-group">
            <label id='ct'>End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control">
        </div>

    </div>
    <div class='row'>


    </div>
    <div class="row">
        <center>
            <button class="btn btn-success" onclick="headwise(this.value)">Display</button>
        </center>
    </div><br /><br />

    <form style="display:none;" id='dreport' action='<?php echo base_url('Report/daily_report'); ?>' method='post'>
        <input type='hidden' name='ct1' id='ct1'>
        <input type='hidden' name='fct1' id='fct1'>
        <input type='hidden' name='cc1' id='cc1'>
        <input type='hidden' name='vt1' id='vt1'>
        <input type='hidden' name='sd1' id='sd1'>
        <center>
            <button class='btn btn-success'><i class="fa fa-file-pdf-o"></i> Download Daily Report</button>
        </center>
    </form>
    <form style="display:none;" id='dmreport' action='<?php echo base_url('Report/monthly_report'); ?>' method='post'>
        <input type='hidden' name='ct2' id='ct2'>
        <input type='hidden' name='fct2' id='fct2'>
        <input type='hidden' name='cc2' id='cc2'>
        <input type='hidden' name='vt2' id='vt2'>
        <input type='hidden' name='sd2' id='sd2'>
        <input type='hidden' name='sdf2' id='sdf2'>
        <center>
            <button class='btn btn-success'><i class="fa fa-file-pdf-o"></i> Download Monthly Report</button>
        </center>
    </form>
    <div id='load_page'>

    </div>
</div><br />
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
    function headwise() {
        var collectiontype = $('#collectiontype').val();
        var collected_by = $('#collected_by').val();
        var strt_date = $('#strt_date').val();
        var end_date = $('#end_date').val();

        $.ajax({
            url: "<?php echo base_url('Cancel_receipt/cancel_receipt_data'); ?>",
            type: "POST",
            data: {
                collectiontype: collectiontype,
                collected_by: collected_by,
                strt_date: strt_date,
                end_date: end_date
            },
            success: function(data) {
                $('#load_page').html(data);

            }
        });
    }
</script>
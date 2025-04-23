
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Fee Reconcilation Headwise</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
    <form id='form'>
        <div class="row">
            <div class="col-md-3 form-group">
                <label>Class</label>
                <select name="classes" id="classes" class='form-control'>
                    <option value="all">All Class</option>
                    <?php
                    foreach ($classes as $cls) { ?>
                        <option value="<?php echo $cls->Class_No; ?>"><?php echo $cls->CLASS_NM; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-3 form-group">
                <label>Ward</label>
                <select name="ward" id="ward" class='form-control'>
                    <?php
                    foreach ($ward as $wrd) { ?>
                        <option value="<?php echo $wrd->HOUSENO; ?>"><?php echo $wrd->HOUSENAME; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-3 form-group">
                <label>Month</label>
                <select name="month" id="month" class='form-control'>
                    <option value="4">APR</option>
                    <option value="5">MAY</option>
                    <option value="6">JUNE</option>
                    <option value="7">JULY</option>
                    <option value="8">AUG</option>
                    <option value="9">SEP</option>
                    <option value="10">OCT</option>
                    <option value="11">NOV</option>
                    <option value="12">DEC</option>
                    <option value="1">JAN</option>
                    <option value="2">FEB</option>
                    <option value="3">MAR</option>
                </select>
            </div>

            <div class="col-md-3 form-group">
                <label>Feehead</label>
                <select name="feehead" id="feehead" class='form-control'>
                    <?php
                    foreach ($feehead as $fh) { ?>
                        <option value="<?php echo $fh->act_code; ?>"><?php echo $fh->fee_head; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12 form-group">
                <center>
                    <button class="btn btn-success">Display</button>
                </center>
            </div>
        </div>
    </form>
    <div id='loader' class='loader' style='display:none'>
        <center>
			<img src="<?php echo base_url() ?>assets/log_image/tenor.gif" width="180px" height="100px">
        </center>
		</div>
    <div id='load_page'>

    </div><br>
</div>
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
    $("#form").on("submit", function(event) {
        event.preventDefault();
        var classes = $('#classes').val();
        var ward = $('#ward').val();
        var month = $('#month').val();
        var feehead = $('#feehead').val();
        $.ajax({
            url: "<?php echo base_url('Reconcilation/calculate'); ?>",
            type: "POST",
            data: {
                classes: classes,
                ward: ward,
                month: month,
                feehead: feehead,
            },
            beforeSend: function() {
                $('.loader').show();
            },
            success: function(data) {
                $('.loader').hide();
                $('#load_page').html(data);
                $('#load_page').show(1000);
            }
        });
    });
</script>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Fee Reconcilation Dues Headwise</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
    <form id='form'>
        <div class="row">

            <div class="col-md-4 form-group">
                <label>Month</label>
                <input type="text" name="month" class="form-control datepicker" autocomplete="off" required="" id="month">
            </div>

            <div class="col-md-4 form-group">
                <label>Feehead</label>
                <select name="feehead" id="feehead" class='form-control'>
                    <?php
                    foreach ($feehead as $fh) { ?>
                        <option value="<?php echo $fh->act_code; ?>"><?php echo $fh->fee_head; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-4 form-group">
                <br>
                <button class="btn btn-success">Display</button>
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
<script src="<?php echo base_url('assets/dash_js/bootstrap-datepicker.min.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/dash_css/bootstrap-datepicker.min.css'); ?>">
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" />
<script>
    var st_date = '<?php echo $current_year . '-03-01'; ?>';
    var end_dt = '<?php echo $next_year . '-03-31'; ?>';
    var startDate = new Date(st_date);
    var endDate = new Date(end_dt);

    $(".datepicker").datepicker({
        format: 'm-yyyy',
        autoclose: true,
        startView: "months",
        minViewMode: "months",
        startDate: startDate,
        endDate: endDate,
    });

    $("#form").on("submit", function(event) {
        event.preventDefault();
        var month = $('#month').val();
        var feehead = $('#feehead').val();
        $.ajax({
            url: "<?php echo base_url('Reconcilation/dues_calculate'); ?>",
            type: "POST",
            data: {
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
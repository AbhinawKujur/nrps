<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Deleted Student</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">

    <form id="form" method="post" action='<?php echo base_url('student_report/deleted_list'); ?>'>
        <div class="row">
            <div class="col-md-4 form-group">
                <label>Select Type</label>
                <select class="form-control" name="type" id="type" required>
                    <option value="">Select</option>
                    <option value="delete">Delete</option>
                    <option value="recall">Recall</option>
                </select>
            </div>

            <div class="col-md-4 form-group">
                <label id='sdm'>Start Date:</label>
                <input type="date" name="strt_date" id="strt_date" class="form-control" required>
            </div>
            <div class="col-md-4 form-group">
                <label id='edm'>End Date:</label>
                <input type="date" name="end_date" id="end_date" class="form-control" required>
            </div>

        </div>
        <br />

        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                <center>
                    <button type="submit" onclick="get_details()" class="btn btn-success">DISPLAY</button>
                </center>
            </div>
        </div>
    </form>
    <br />

    <div id="load_data" style="overflow:auto;"></div>

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
    function get_details() {
        event.preventDefault();
        var type = $('#type').val;
        var start_date = $('#strt_date').val;
        var end_date = $('#end_date').val;
        $.ajax({
            url: "<?php echo base_url('student_report/deleted_list') ?>",
            type: "POST",
            data: $('#form').serialize(),
            success: function(data) {
                $('body').css('opacity', '1.0');
                $('#load_data').html(data);
            },
        });
    }
</script>
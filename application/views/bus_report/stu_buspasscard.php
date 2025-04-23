<style>
    .loader {
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        margin: 0px auto;
        z-index: 999;
        -webkit-animation: spin 2s linear infinite;
        /* Safari */
        animation: spin 2s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Student Bus Pass</a> <i class="fa fa-angle-right"></i></li>
</ol>
<div class="loader" style="display:none;"></div>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
    <form id="form" method="post" action='<?php echo base_url('Bus_report/stu_bus_pass_list');?>'>
        <input type="radio" id="busID" name="bus_pass" value="1" onclick="show(this.value)">
        <label for="busID">Bus No. Wise</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" id="cls-sec" name="bus_pass" value="2" onclick="show(this.value)">
        <label for="cls-sec">Class/Section Wise</label><br>
        <div class="row">
            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group busNoWise" style="display: none;">
                <label>Select Bus Number</label>
                <select class="form-control" id="bus_number" name="bus_number">
                    <option value="">Select Bus No</option>
                    <?php if ($bus) {
                        foreach ($bus as $bus_data) { ?>
                            <option value="<?php echo $bus_data->BusNo; ?>"><?php echo $bus_data->BusNo; ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group classSecWise" style="display: none;">
                <label>Select Class</label>
                <select class="form-control" id="class_name" name="class_name" onchange="selectsec(this.value)">
                    <option value="">Select Class</option>
                    <?php
                    if ($class) {
                        foreach ($class as $class_data) {
                    ?>
                            <option value="<?php echo $class_data->Class_No; ?>"><?php echo $class_data->CLASS_NM; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group classSecWise" style="display: none;">
                <label>Select Section</label>
                <select class="form-control" name="sec_name" id="sec">
                </select>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group disp" style="display: none;">
                <center><br>
                    <button type="submit" class="btn btn-success">DISPLAY</button>
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
    function show(val) {

        if (val == 1) {
            $('#bus_number').attr('required', true); 
            $('.busNoWise,.disp').show(1000);
            $('#class_name').attr('required', false); 
            $('#sec').attr('required', false); 
        } else {
            $('.busNoWise').hide(1000);
            $('#bus_number').attr('required', false); 
        }
        if (val == 2) {
            $('#class_name').attr('required', true); 
            $('#sec').attr('required', true); 
            $('.classSecWise,.disp').show(1000);
            $('#bus_number').attr('required', false); 
        } else {
            $('#bus_number').attr('required', true); 
            $('.classSecWise').hide(1000);
        }
    }

    function selectsec(val) {
        $.ajax({
            url: "<?php echo base_url('Student_report/find_sec'); ?>",
            type: "POST",
            data: {
                val: val
            },
            beforeSend: function() {
                $('.loader').show();
                $('body').css('opacity', '0.5');
            },
            success: function(data) {
                $('.loader').hide();
                $('body').css('opacity', '1.0');
                $("#sec").html(data);
            },
        });
    }
    $("#form").on("submit", function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url('Bus_report/stu_bus_pass_list'); ?>",
            type: "POST",
            data: $('#form').serialize(),
            beforeSend: function() {
                $('.loader').show();
                $('body').css('opacity', '0.5');
            },
            success: function(data) {
                $('.loader').hide();
                $('body').css('opacity', '1.0');
                $("#load_data").html(data);
            },
        });
    });
</script>
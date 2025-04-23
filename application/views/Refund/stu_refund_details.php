<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Refund Security</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
<div style="padding: 10px; background-color: white">

    <div class="row">
        <div class="col-md-12">
            <?php
            if ($this->session->flashdata('msg')) {
            ?>
                <div class="alert alert-success" role="alert" id="msg" style="padding: 6px 0px;">
                    <center><strong><?php echo $this->session->flashdata('msg'); ?></strong></center>
                </div>
            <?php
            }
            ?>
        </div>
    </div>


    <form action="<?php echo htmlspecialchars(base_url('Refund/save_refundable')); ?>" method="post" onsubmit="return validation()">
        <div class='row'>
        <div class="form-group col-md-4">
                <label>Admission No.</label>
                <input type="text" name="adm_no" id="adm_no" class="form-control" oninput="dataswap(this.value)" autocomplete="off">
            </div>
            <div class="form-group col-md-4">
                <label>Name</label>
                <input type="text" name="name" id="name" class="form-control" readonly="true">
            </div>
            <div class="form-group col-md-4">
                <label>Ref. Cert No.</label>
                <input type="text" name="admission" id="admission" class="form-control" readonly="true">
            </div>
            
        </div>


        <div class='row'>
        <div class="form-group col-md-4">
                <label>Father Name.</label>
                <input type="text" name="fname" id="fname" class="form-control" readonly="true">
            </div>
            <div class="form-group col-md-4">
                <label>Class/Sec</label>
                <input type="text" name="clssec" id="clssec" class="form-control" readonly="true">
            </div>
            <div class="form-group col-md-4">
                <label>Adm date No.</label>
                <input type="text" name="adm_date" id="adm_date" class="form-control" required readonly="true">
            </div>
        </div>

        <div class='row'>
           
        </div>



        <hr style="border: .5px solid black;">

        <div class="row">
           	 <div class="col-md-12">
           	 	Refundable Security Details
           	 </div>
           </div><br />

           <div class='row'>
            <div class="form-group col-md-4">
                <label>Recipt No.</label>
                <input type="text" name="rect_no" id="rect_no" class="form-control" readonly="true">
            </div>
            <div class="form-group col-md-4">
                <label>Recipt Date</label>
                <input type="text" name="rect_date" id="rect_date" class="form-control" required readonly="true">
            </div>
            <div class="form-group col-md-4">
                <label>Total Amount</label>
                <input type="text" name="total" id="total" class="form-control" required readonly="true">
            </div>
            
        </div>

        <div class="row">

        <div class="form-group col-md-4">
            <center><input type="submit" name="submit" id="submit" value="submit" class="btn btn-success" disabled></center>
        </div>

       
        
        </div>
        <input type="hidden" name="class_code" id='class_code'>
    </form>
    <div class="row">
        <form action="<?php echo base_url('Refund/print_refundable'); ?>" method="post">
            <div class="form-group col-md-12">
            <center><input type="submit" name="print" id="print" value="Print" class="btn btn-success"></center>
            <input type="hidden" name="ad_d" id="ad_d" class="form-control" readonly="true">
        </div>
        </form>

        <!-- <a href="<?php //echo base_url('Refund/print_refundable/' . $adm_no); ?>" target="_blank" class="btn btn-primary" id="generate_pdf" style='display:non'><i class="fa fa-file-pdf-o"></i>&nbsp;GENERATE & DOWNLOAD PDF</a>&nbsp; -->
    </div>
</div><br /><br />

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p id="first"></p>
                <p id="second"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<div class="clearfix"></div><br />
<!-- script-for sticky-nav -->
<script>

    function Checkamount(val) {
        var spldata = val.split('_');
        var act_code = spldata[1];
        var amount = $("#feehead_" + act_code).val();
        var class_code = $("#class_code").val();
        var admission = $("#admission").val();
        if (amount != 0) {
            $.ajax({
                url: "<?php echo base_url(); ?>Checkfeeheadamount/feeheadamountcheck",
                type: "POST",
                data: {
                    act_code: act_code,
                    class_code: class_code,
                    admission: admission
                },
                success: function(response) {

                },
            });
        } else {
            $("#feehead_" + act_code).val(0);
        }
    }

    function dataswap(val) {
        $.ajax({
            url: "<?php echo base_url(); ?>Refund/stu_data",
            type: "POST",
            data: {
                value: val
            },
            success: function(data) {
                var user = JSON.parse(data);
                var class_code = user[6];
                $("#class_code").val(class_code);
                
                    $("#admission").val(user[0]);
                    $("#name").val(user[2]);
                    $("#clssec").val(user[3]);
                    $("#fname").val(user[7]);
                    $("#adm_date").val(user[8]);
                    $("#rect_no").val(user[9]);
                    $("#rect_date").val(user[10]);
                    $("#total").val(user[11]);
                    $("#ad_d").val(user[12]);
                    $("#saf").prop('disabled', false);
                    $("#sgb").prop('disabled', false);
                    $("#submit").prop('disabled', false);
                    $("#print").prop('disabled', false);
                
            }
        });
    }

    function validation() {
        var saf = document.getElementById('saf').selectedIndex;
        var sgb = document.getElementById('sgb').selectedIndex;
        if (saf != "" && sgb != "") {
            return true;
        } else {
            $('#myModal').modal();
            $('#myModal').find('.modal-header').css({
                "color": "red",
                "text-align": "center",
                "font-size": "30px"
            });
            $('#myModal').find('.modal-header').html("Warning !");
            $('#myModal').find('.modal-body').html("Please Select Scholarship Apply From And Scholarship Given By");
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
            return false;
        }

    }

</script>
<div class="inner-block">

</div>
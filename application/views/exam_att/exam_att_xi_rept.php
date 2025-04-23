<style type="text/css">

</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Attendance</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;font-size: 12px;">

    <form action="" id="form">
        <div class="row">
            <div class="col-sm-3">
                <label>Class</label>
                <select class="form-control" id="classs" name="class" onchange='getSec(this.value)'>
                    <option value=''>Select</option>
                    <option value='13'>XI</option>
                    <option value='14'>XII</option>
                </select>
            </div>

            <div class="col-sm-3">
                <label>Sec</label>
                <select class="form-control" name="sec" id="sec">
                    <option value=''>Select</option>
                </select>
            </div>

           

            <div class="col-sm-3">
                <br>
                <button class='btn btn-success' id='setBtn'>DISPLAY</button>
            </div>

        </div>
    </form>


    <div class='row'><br /><br />
        <div class='col-sm-12'>
            <div id='load'></div>
        </div>
    </div>

</div><br />

<script type="text/javascript">
    function sess(val) {
        $("#load").html('');
        $("#classs").val('');
        $("#sec").val('');
        $("#sheet").val('');

        $.ajax({
            url: "<?php echo base_url('ExamAtt_XI/getClass'); ?>",
            type: "POST",
            data: {
                val: val
            },
            success: function(ret) {
                $("#classs").html(ret);
            }
        });
    }

    function getSec(val) {
        $("#load").html('');
        var session = $("#session").val();
        $.ajax({
            url: "<?php echo base_url('ExamAtt_XI/getSection'); ?>",
            type: "POST",
            data: {
                session: session,
                val: val
            },
            success: function(ret) {
                $("#sec").html(ret);
            }
        });
    }

    $("#form").on("submit", function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url('ExamAtt_XI/getStu_report'); ?>",
            type: "POST",
            data: $('#form').serialize(),
            success: function(data) {
                $("#load").html(data);
            },
        });
    });
</script>
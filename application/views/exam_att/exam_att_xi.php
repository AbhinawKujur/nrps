<style type="text/css">

</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Attendance</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;font-size: 12px;">

    <div class="row">
        <div class="col-sm-3">
            <label>Class</label>
            <select class="form-control" id="classs" onchange='getSec(this.value)'>
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
            <label>Sheet No.</label>
            <select class="form-control" onchange="sheetno(this.value)" id="sheet" name="sheet">
                <option value=''>Select</option>
                <option value='Sheet-1'>Sheet-1</option>
                <option value='Sheet-2'>Sheet-2</option>
                <option value='Sheet-3'>Sheet-3</option>
                <option value='Sheet-4'>Sheet-4</option>
                <option value='Sheet-5'>Sheet-5</option>
                <option value='Sheet-6'>Sheet-6</option>
                <option value='Sheet-7'>Sheet-7</option>
                <option value='Sheet-8'>Sheet-8</option>
                <option value='Sheet-9'>Sheet-9</option>
                <option value='Sheet-10'>Sheet-10</option>
                <option value='Sheet-11'>Sheet-11</option>
                <option value='Sheet-12'>Sheet-12</option>
            </select>
        </div>

        <div class="col-sm-3" style='display:none' id='totWorkDays'>
            <label>Set Total Working Days</label>
            <input type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' name='setTotWorkDays' id='setTotWorkDays' class='form-control'>
            <button class='btn btn-success btn-sm' onclick='totWorkDay()' id='setBtn'>SET</button>
        </div>
    </div>

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
        $("#term").val('');

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

    function sheetno(val) {
        var session = $("#session").val();
        var classs = $("#classs").val();
        var sec = $("#sec").val();
        $("body").css('opacity', '0.5');
        if (session != '') {
            $.ajax({
                url: "<?php echo base_url('ExamAtt_XI/getStu'); ?>",
                type: "POST",
                data: {
                    val: val,
                    session: session,
                    classs: classs,
                    sec: sec
                },
                success: function(ret) {
                    $("#totWorkDays").show();
                    $("#load").html(ret);
                    $("body").css('opacity', '');
                }
            });
        } else {
            alert('Select Session First');
            $("body").css('opacity', '');
        }
    }

    function totPresentByStu(val, admno, session, term, types) {
        $.ajax({
            url: "<?php echo base_url('ExamAtt_XI/totPresentDays'); ?>",
            type: "POST",
            data: {
                val: val,
                admno: admno,
                session: session,
                term: term,
                types: types
            },
            success: function(ret) {
                //alert(ret);
            }
        });
    }

    function totWorkDay() {
        var setTotWorkDays = $("#setTotWorkDays").val();
        var session = $("#session").val();
        var classs = $("#classs").val();
        var sec = $("#sec").val();
        var sheet = $("#sheet").val();
        $("#setBtn").prop('disabled', true);
        $.ajax({
            url: "<?php echo base_url('ExamAtt_XI/totWorkingDays'); ?>",
            type: "POST",
            data: {
                session: session,
                classs: classs,
                sec: sec,
                val: setTotWorkDays,
                sheet: sheet
            },
            success: function(ret) {
                $(".workingDays").val(setTotWorkDays);
                $("#setBtn").prop('disabled', false);
                //alert(ret);
            }
        });
    }

    $("#form").on("submit", function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url('ExamAtt_XI/getStu'); ?>",
            type: "POST",
            data: $('#form').serialize(),
            success: function(data) {
                $("#load").html(data);
            },
        });
    });
</script>
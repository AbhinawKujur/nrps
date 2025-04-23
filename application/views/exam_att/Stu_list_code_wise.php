<style type="text/css">

</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">CODE WISE STUDENT XI-XII</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;font-size: 12px;">
    <div class="row">

        <div class="col-sm-3">
            <label>Class</label>
            <select class="form-control" id="classs" onchange='getSec(this.value)'>
                <option value=''>Select</option>
                <option value='13'>XI</option>
            </select>
        </div>

        <div class="col-sm-3">
            <label>Sec</label>
            <select class="form-control" name="sec" id="sec" onchange='getSub(this.value)'>
                <option value=''>Select</option>
            </select>
        </div>

        <div class="col-sm-3">
            <label>Subject</label>
            <select class="form-control" onchange="getStu(this.value)" id="subj">
                <option value=''>Select</option>
            </select>
        </div>

    </div>

    <div class='row'><br /><br />
        <div class='col-sm-12'>
            <div id='load'></div>
        </div>
    </div>
    
</div><br />
<!-- DataTables Buttons CSS and JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.print.min.js"></script>
<script type="text/javascript">

    function getSec(val) {
        $("#load").html('');
        $.ajax({
            url: "<?php echo base_url('Stu_list_code/getSection'); ?>",
            type: "POST",
            data: {
                val: val
            },
            success: function(ret) {
                $("#sec").html(ret);
            }
        });
    }

    function getStu(val) {
        var classs = $("#classs").val();
        var sec = $("#sec").val();

        $.ajax({
            url: "<?php echo base_url('Stu_list_code/getStu'); ?>",
            type: "POST",
            data: {
                val: val,
                classs: classs,
                sec: sec
            },
            success: function(ret) {
                $("#load").html(ret);
                $("body").css('opacity', '');
            }
        });

    }

    function getSub(val) {
        var classs = $("#classs").val();
        // alert(val);
        $("#load").html('');
        $.ajax({
            url: "<?php echo base_url('Stu_list_code/getSubject'); ?>",
            type: "POST",
            data: {
                val: val,
                classs: classs
            },
            success: function(ret) {
                $("#subj").html(ret);
            }
        });
    }

</script>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo site_url('payroll/dashboard/emp_dashboard'); ?>">Home</a></li>
      <li class="breadcrumb-item"><a href="<?php echo site_url('payroll/dashboard/emp_dashboard/studentattendance'); ?>">student attendance</a></li>
      <li class="breadcrumb-item active" aria-current="page">student attendance delete</li>
    </ol>
  </nav>

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
<?php
$date = date('d-M-Y');
?>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">

    <form id='form'>
        <div class="row">
            <div class="col-md-3 form-group">
                <label for="">Date</label>
                <input type='text' value="<?php echo $date; ?>" name='dt' id='dt' class='form-control dt' onchange='dtt()' data-date-end-date="0d" readonly>
            </div>
            <div class="col-md-3 form-group">
                <label id='cls1'>Class</label>
                <select class="form-control" onchange='clses(this.value)' name='classs' id="classs">
                    <option value=''>Select</option>
                    <?php
                    if (isset($classData)) {
                        foreach ($classData as $data) {
                    ?>
                            <option value="<?php echo $data['Class_no']; ?>"><?php echo $data['classnm']; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-3 form-group">
                <label id='sec1'>Sec</label>
                <select class="form-control" name="sec" id="sec">
                    <option value=''>Select</option>
                </select>
            </div>

            <div class="col-md-3 form-group">
                <br>
                <button class="btn btn-success">Display</button>
            </div>

        </div>

    </form>

   


    <div id='load_page'></div>

</div>

<br>

<script type="text/javascript">
    $('.dt').datepicker({
        format: 'dd-M-yyyy',
        autoclose: true
    });


    function dtt() {
        $("#classs option[value='']").prop('selected', true);
        $("#sec option[value='']").prop('selected', true);
        $("#load_data").html('');
    }

    function clses(val) {
        // alert(val);
        $("#load_data").html('');
        $.post("<?php echo base_url('student/StudentAttDelete/find_sec'); ?>", {
            class_id: val
        }, function(data) {
            var fill = $.parseJSON(data);
            $("#sec").html(fill[0]);
            $("#att_type").val(fill[1]);
            $("#subj").html(fill[2]);

            var att_type = $("#att_type").val();
            if (att_type != 3) {
                $("#subjHide").hide();
            } else {
                $("#subjHide").show();
            }
        });
    }

    $("#form").on("submit", function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url('student/StudentAttDelete/show_details'); ?>",
            type: "POST",
            data: $('#form').serialize(),
            success: function(data) {
                $("#load_page").html(data);
            },
        });
    });
</script>
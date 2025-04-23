<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Upload Image</a> <i class="fa fa-angle-right"></i></li>
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

    <form id='form'>

        <div class="row">

            <div class="col-md-3 form-group">
                <label id='cls1'>Class</label>
                <select name='cls' id='cls' class='form-control' onchange="selectSec(this.value)">
                    <option value=''>Select</option>
                    <?php foreach ($class as $cls) { ?>
                        <option value="<?php echo $cls->Class_No ?>"><?php echo $cls->CLASS_NM; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-3 form-group">
                <label id='sec1'>Sec</label>
                <select name='sec' id='sec' class='form-control'>
                    <option value=''>Select</option>
                </select>
            </div>

            <div class="col-md-4 form-group">
                <br>
                <button class="btn btn-success">Display</button>
            </div>

        </div>

    </form>

    <div id='load_page'></div>

</div>

<br>

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
    function selectSec(val) {
        // alert(val);
        $.ajax({
            url: "<?php echo base_url('Student_img/find_sec'); ?>",
            type: "POST",
            data: {
                val: val
            },
            success: function(data) {
                $("#sec").html(data);
            },
        });
    }

    $("#form").on("submit", function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url('Student_img/show_details'); ?>",
            type: "POST",
            data: $('#form').serialize(),
            success: function(data) {
                $("#load_page").html(data);
            },
        });
    });
</script>
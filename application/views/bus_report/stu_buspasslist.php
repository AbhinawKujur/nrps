<style>
    .table>thead>tr>th,
    .table>tbody>tr>th,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>tbody>tr>td,
    .table>tfoot>tr>td {
        white-space: nowrap !important;
    }
</style>
<form method="post" action="<?php echo base_url('bus_report/download_bus_stulistreport'); ?>" target="_blank">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <input type="hidden" value="<?php echo $class; ?>" name="classs">
            <input type="hidden" value="<?php echo $sec; ?>" name="secc">
            <button class="btn pull-right"><i class="fa fa-file-pdf-o"></i> Download</button>
        </div>
    </div>
</form><br />
<form id="bus_pass_form" method="POST" action="<?php echo base_url('Bus_report/generate_bus_pass'); ?>" onsubmit="return myFunction();">
    <div>
        <center>
            <input type="submit" formtarget="_blank" value="Generate Bus Paas" class='btn btn-success'>
        </center>
    </div>
    <table class="table" id="example">
        <thead>
            <tr>
                <th><label><b><input type='checkbox' onchange="checkAll()" name='chkAll' id='chkAll'>All</b></label></th>
                <th>Sl. No.</th>
                <th>Adm. No.</th>
                <th>Student Name</th>
                <th>Roll No.</th>
                <th>Contact No.</th>
                <th>Stoppage Name</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($data as $key => $value) {
            ?>
                <tr>
                    <td><input type="checkbox" name="chekedstudent[]" id="chekedstudent" class='checkdata' value="<?php echo $value->ADM_NO; ?>"></td>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $value->ADM_NO; ?></td>
                    <td><?php echo $value->FIRST_NM; ?></td>
                    <td><?php echo $value->ROLL_NO; ?></td>
                    <td><?php echo $value->C_MOBILE; ?></td>
                    <td><?php echo $value->stopname; ?></td>
                </tr>
            <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
    <br>
</form>
<!-- <td><a href="<?php echo base_url('parent_dashboard/BusPass'); ?>" class="btn btn-success">Generate Bus Pass</a></td> -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#msg").fadeOut(8000);
        $('#example').DataTable({
           // dom: 'Bfrtip',
            paging: false,
           buttons: [{
             extend: 'excelHtml5',
                title: 'Student List Avail(Bus Facility) Report',
            }, ]
        });
    });

    function myFunction() {
        if ($('input[type=checkbox]:checked').length == 0) {
            alert("ERROR! Please select at least one checkbox");
            return false;
        } else {
            return true;
        }
    }
    // $("#bus_pass_form").on("submit", function(event) {
    //     event.preventDefault();

    //     if ($('input[type=checkbox]:checked').length == 0) {
    //         alert("ERROR! Please select at least one checkbox");
    //         return false;
    //     } else {
    //         $("#loading").click();
    //         $.ajax({
    //             url: "<?php echo base_url('Bus_report/generate_bus_pass'); ?>",
    //             type: "POST",
    //             data: $("#bus_pass_form").serialize(),
    //             success: function(data) {
    //                 // alert(data);
    //                 if (data) {
    //                     $('#loading').click();
    //                     alert('Bus Pass Generated Successfully');
    //                     window.location = "parents_dashboard/bus_pass/bus_pass" +  data ;
    //                 } else {
    //                     $('#loading').click();
    //                     alert('Something went wrong');
    //                     // window.location = "";
    //                 }
    //             }
    //         });
    //     }

    // });

    function checkAll() {
        if ($("#chkAll").prop('checked') == true) {
            $('.checkdata').prop('checked', true);
        } else {
            $('.checkdata').prop('checked', false);
            $('#chkAll').prop('checked', false);
        }
    }
</script>
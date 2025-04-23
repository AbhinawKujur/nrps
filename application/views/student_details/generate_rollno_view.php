<form id="form1" method="post">
    <div class="row">
        <input type="hidden" name='class_nm' value="<?php echo $class_name; ?>">
        <input type="hidden" name='sec_nm' value="<?php echo $sec_name; ?>">
        <input type="hidden" name='order_by' value="<?php echo $orderby; ?>">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <center>
                <button type="submit" class="btn"><i class="fa fa-file-pdf-o"></i> SAVE</button>
            </center>
        </div>
    </div>

    <table class="table" id="example">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>Adm No.</th>
                <th>Student Name</th>
                <th>Roll No.</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($student_data as $key) {

            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><input type="hidden" name="adm_no[<?php echo $key['new_rollno']; ?>]" value="<?php echo $key['adm_no']; ?>"><?php echo $key['adm_no']; ?></td>
                    <td><?php echo $key['stu_nm']; ?></td>
                    <td><?php echo $key['new_rollno']; ?></td>
                <tr>
                <?php
                $i++;
            }
                ?>
        </tbody>
    </table>
</form>

<script>
    $("#form1").on("submit", function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url('student_details/save_generaterollno'); ?>",
            type: "POST",
            data: $('#form1').serialize(),
            success: function(data) {
                $.toast({
                    heading: 'Success',
                    text: 'Data Saved Successfully..!',
                    showHideTransition: 'slide',
                    icon: 'success',
                    position: 'top-right',
                });
            },
        });
    });
</script>
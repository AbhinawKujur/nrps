<!-- Include necessary CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

<!-- Include your form -->
<form method="post" action="<?php echo base_url('Ward_report/download_ward_wise_pdf'); ?>">
    <div class="row">
        
        <div class="col-md-12 col-sm-12 col-lg-12">
            <center>
            <input type="hidden" name="ward" id="ward" value="<?php echo $ward; ?>">
            <input type="hidden" name="class" id="class" value="<?php echo $class; ?>">

                <button class="btn"><i class="fa fa-file-pdf-o"></i> Download</button>
            </center>
        </div>
    </div>
</form>

<!-- Include the table -->
<table class="table" id="example">
    <thead>
        <tr>
            <th>Sl No.</th>
            <th>Adm No.</th>
            <th>Student Name</th>
            <th>Class/Sec</th>
            <th>Roll No.</th>
            <th>Father Name</th>
            <th>Mother Name</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($data as $key) {
        ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $key->ADM_NO; ?></td>
                <td><?php echo $key->FIRST_NM; ?></td>
                <td><?php echo $key->DISP_CLASS . '/' . $key->DISP_SEC; ?></td>
                <td><?php echo $key->ROLL_NO; ?></td>
                <td><?php echo $key->FATHER_NM; ?></td>
                <td><?php echo $key->MOTHER_NM; ?></td>
            </tr>
        <?php
            $i++;
        }
        ?>
    </tbody>
</table>


<script>
$(document).ready(function() {
    $('#example').DataTable({
       'paging' : true,
            'page_length' : 10,
            'ordering' : false,
            'searching' : false,
            dom: 'Bfrtip',
            buttons: [
                /* {
                extend: 'copyHtml5',
				title: 'Daily Collection Reports',
               
            }, */
                {
                    extend: 'excelHtml5',
                    title: 'Ward Category Report For Class -  <?php if ($class == 99 ){ echo 'ALL CLASS'; } else { echo $data[0]->DISP_CLASS;} ?> [ <?php echo $ward_name['HOUSENAME']; ?> ]',

                },
                /* {
                extend: 'csvHtml5',
				title: 'Daily Collection Reports',
                
            }, */
                /* {
                extend: 'pdfHtml5',
				title: 'Daily Collection Reports',
                
            }, */
            ]
    });
});
</script>

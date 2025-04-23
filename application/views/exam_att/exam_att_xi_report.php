<?php 
   if($sec=='1')
   {
    $sec_NM='A';
   }
   elseif($sec=='2')
   {
    $sec_NM='B';
   }
   elseif($sec=='3')
   {
    $sec_NM='C';
   }
   elseif($sec=='4')
   {
    $sec_NM='D';
   }
   elseif($sec=='5')
   {
    $sec_NM='E';
   }
   elseif($sec=='6')
   {
    $sec_NM='F';
   }
   elseif($sec=='7')
   {
    $sec_NM='G';
   }
   elseif($sec=='8')
   {
    $sec_NM='H';
   }
   elseif($sec=='9')
   {
    $sec_NM='I';
   }
   elseif($sec=='10')
   {
    $sec_NM='J';
   }
   elseif($sec=='11')
   {
    $sec_NM='K';
   }
   elseif($sec=='12')
   {
    $sec_NM='M';
   }
   elseif($sec=='13')
   {
    $sec_NM='N';
   }
   elseif($sec=='14')
   {
    $sec_NM='P';
   }
   else{
    $sec_NM=$sec;
   }


   if($class=='13')
   {
    $clsnm='XI';
   }
   else{
    $clsnm='XII';
   }
   ?>
<br>
<form action="<?php echo base_url('ExamAtt_XI/getStu_report_pdf') ?>" method="POST">
    <input type="hidden" name="class" id="class" value="<?php echo $class; ?>">
    <input type="hidden" name="sec" id="sec" value="<?php echo $sec; ?>">
    <input type="hidden" name="sheet" id="sheet" value="<?php echo $sheet; ?>">
    <button class="btn btn-success">PDF</button>
</form>
<br><br>

<table class="display nowrap" id="example">

    <thead>
        <tr>
            <th style='background:#5785c3; color:#fff!important;'>Roll No.</th>
			<th style='background:#5785c3; color:#fff!important;'>Adm. No.</th>
            <th style='background:#5785c3; color:#fff!important;'>Name</th>

            <th style='background:#5785c3; color:#fff!important;'>CLASS</th>
            <th style='background:#5785c3; color:#fff!important;'>SEC</th>

            <th style='background:#5785c3; color:#fff!important;'>Sheet 1 wd</th>
            <th style='background:#5785c3; color:#fff!important;'>Sheet 1 pd</th>

            <th style='background:#5785c3; color:#fff!important;'>Sheet 2 wd</th>
            <th style='background:#5785c3; color:#fff!important;'>Sheet 2 pd</th>

            <th style='background:#5785c3; color:#fff!important;'>Sheet 3 wd</th>
            <th style='background:#5785c3; color:#fff!important;'>Sheet 3 pd</th>

            <th style='background:#5785c3; color:#fff!important;'>Sheet 4 wd</th>
            <th style='background:#5785c3; color:#fff!important;'>Sheet 4 pd</th>

            <th style='background:#5785c3; color:#fff!important;'>Sheet 5 wd</th>
            <th style='background:#5785c3; color:#fff!important;'>Sheet 5 pd</th>

            <th style='background:#5785c3; color:#fff!important;'>Sheet 6 wd</th>
            <th style='background:#5785c3; color:#fff!important;'>Sheet 6 pd</th>

            <th style='background:#5785c3; color:#fff!important;'>Sheet 7 wd</th>
            <th style='background:#5785c3; color:#fff!important;'>Sheet 7 pd</th>

            <th style='background:#5785c3; color:#fff!important;'>Sheet 8 wd</th>
            <th style='background:#5785c3; color:#fff!important;'>Sheet 8 pd</th>

            <th style='background:#5785c3; color:#fff!important;'>Sheet 9 wd</th>
            <th style='background:#5785c3; color:#fff!important;'>Sheet 9 pd</th>

            <th style='background:#5785c3; color:#fff!important;'>Sheet 10 wd</th>
            <th style='background:#5785c3; color:#fff!important;'>Sheet 10 pd</th>

            <th style='background:#5785c3; color:#fff!important;'>Sheet 11 wd</th>
            <th style='background:#5785c3; color:#fff!important;'>Sheet 11 pd</th>

            <th style='background:#5785c3; color:#fff!important;'>Sheet 12 wd</th>
            <th style='background:#5785c3; color:#fff!important;'>Sheet 12 pd</th>
			
			<th style='background:#5785c3; color:#fff!important;'>TOTAL WD</th>
           <th style='background:#5785c3; color:#fff!important;'>TOTAL PD</th>
           <th style='background:#5785c3; color:#fff!important;'>PERCENTAGE</th>

        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($get as $key => $val) {
        ?>

            <tr>
                <td><?php echo $val['ROLL_NO']; ?></td>
				
				<td><?php echo $val['adm_no']; ?></td>

                <td><?php echo $val['FIRST_NM']; ?></td>

                <td><?php echo $val['disp_class']; ?></td>

                <td><?php echo $val['disp_sec']; ?></td>

                <td><?php echo $val['sheet_1_wd']; ?></td>
                <td><?php echo $val['sheet_1_pd']; ?></td>

                <td><?php echo $val['sheet_2_wd']; ?></td>
                <td><?php echo $val['sheet_2_pd']; ?></td>

                <td><?php echo $val['sheet_3_wd']; ?></td>
                <td><?php echo $val['sheet_3_pd']; ?></td>

                <td><?php echo $val['sheet_4_wd']; ?></td>
                <td><?php echo $val['sheet_4_pd']; ?></td>

                <td><?php echo $val['sheet_5_wd']; ?></td>
                <td><?php echo $val['sheet_5_pd']; ?></td>

                <td><?php echo $val['sheet_6_wd']; ?></td>
                <td><?php echo $val['sheet_6_pd']; ?></td>

                <td><?php echo $val['sheet_7_wd']; ?></td>
                <td><?php echo $val['sheet_7_pd']; ?></td>

                <td><?php echo $val['sheet_8_wd']; ?></td>
                <td><?php echo $val['sheet_8_pd']; ?></td>

                <td><?php echo $val['sheet_9_wd']; ?></td>
                <td><?php echo $val['sheet_9_pd']; ?></td>

                <td><?php echo $val['sheet_10_wd']; ?></td>
                <td><?php echo $val['sheet_10_pd']; ?></td>

                <td><?php echo $val['sheet_11_wd']; ?></td>
                <td><?php echo $val['sheet_11_pd']; ?></td>

                <td><?php echo $val['sheet_12_wd']; ?></td>
                <td><?php echo $val['sheet_12_pd']; ?></td>
				
				<td><?php echo $val['toa_wd']; ?></td>
                <td><?php echo $val['toa_pd']; ?></td>
               	<td><?php echo round(($val['toa_pd']/$val['toa_wd'] * 100),2); ?></td>

            </tr>

        <?php
        }
        ?>
    </tbody>
</table>


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
    $(document).ready(function() {
        $('#example').DataTable({
            scrollX: true,
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excelHtml5',
                title: 'Student Attendence ' + "<?php echo $clsnm." - "; ?>" + "<?php echo $sec_NM; ?>"
            }]
        });
    });
</script>
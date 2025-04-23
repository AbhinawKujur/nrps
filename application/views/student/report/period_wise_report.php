<style>
  button.dt-button, div.dt-button, a.dt-button {
	  padding:2px;
  }
  .dataTables_paginate .paginate_button.current {
	 padding:2px;  
  }
  .table > thead > tr > th,
  .table > tbody > tr > th,
  .table > tfoot > tr > th,
  .table > thead > tr > td,
  .table > tbody > tr > td,
  .table > tfoot > tr > td {
    white-space: nowrap !important;
  }
</style>
<table class='table' id='example'>
<thead>
  <tr>
	<th style="background:#5785c3; color:#fff">Adm No.</th>
	<th style="background:#5785c3; color:#fff">Stu Name</th>
	<th style="background:#5785c3; color:#fff">Roll</th>
	<!--<th style="background:#5785c3; color:#fff">Class</th>
	<th style="background:#5785c3; color:#fff">Sec</th>-->
	<th style="background:#5785c3; color:#fff">P1</th>
	<th style="background:#5785c3; color:#fff">P2</th>
	<th style="background:#5785c3; color:#fff">P3</th>
	<th style="background:#5785c3; color:#fff">P4</th>
	<th style="background:#5785c3; color:#fff">P5</th>
	<th style="background:#5785c3; color:#fff">P6</th>
	<th style="background:#5785c3; color:#fff">P7</th>
	<th style="background:#5785c3; color:#fff">P8</th>
	<!--<th style="background:#5785c3; color:#fff">Mobile</th>-->
  </tr>
</thead>  
<tbody>
   <?php
     if(isset($fetch_data)){
		 foreach($fetch_data as $data){ 
			 ?>
			   <tr>
			     <td><?php echo $data['admno']; ?></td>
			     <td><?php echo $data['FIRST_NM']; ?></td>
			     <td><?php echo $data['ROLL_NO']; ?></td>
			     <!--<td><?php //echo $data['DISP_CLASS']; ?></td>
			     <td><?php //echo $data['DISP_SEC']; ?></td>-->
			     <?php for($i=1;$i<=8;$i++){ ?>

			     	<?php $color = "red";
			     		$period  = "P".$i;
			     	 if($data[$period] == 'P'){
			     	 	
			     		$color = "green";			     		
			     	} ?>

			     	<td style="color:<?php echo $color; ?>">
			     		<strong><?php echo $data[$period]; ?></strong>
			     	</td>
			     <?php } ?>
				   
			    
			     <!--<td><b><?php //echo $data['C_MOBILE']; ?></b></td>-->
			   </tr>
			 <?php
		 }
	 }
   ?>
</tbody>  
</table>

<script>
   $('[data-toggle="tooltip"]').tooltip();   
   $('#example').DataTable({
		dom: 'Bfrtip',
		ordering :false,
		buttons: [
			// {
				// extend: 'copyHtml5',
				// title: 'Student Details',
				// exportOptions: {
					// columns: [ 0, 1, 2, 3, 4, 5 , 6, 7]
				// }
			// },
			{
				extend: 'excelHtml5',
				title: 'Student Details',
			},
			// {
				// extend: 'csvHtml5',
				// title: 'Student Details',
				// exportOptions: {
					// columns: [ 0, 1, 2, 3, 4, 5 , 6, 7]
				// }
			// },
			{
				extend: 'pdfHtml5',
				title: 'Student Details',
			},
		]
	});
</script>
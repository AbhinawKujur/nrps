<style>
  button.dt-button, div.dt-button, a.dt-button {
	  padding:2px;
  }
  .dataTables_paginate .paginate_button.current {
	 padding:2px;  
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
	<th style="background:#5785c3; color:#fff">Attendance</th>
	<!--<th style="background:#5785c3; color:#fff">Mobile</th>-->
  </tr>
</thead>  
<tbody>
  <?php
	if($fetch_data){
		foreach($fetch_data as $data){
			?>
			  <tr>
				<td><?php echo $data['admno']; ?></td>
				<td><?php echo $data['FIRST_NM']; ?></td>
				<td><?php echo $data['ROLL_NO']; ?></td>
				<!--<td><?php //echo $data['DISP_CLASS']; ?></td>
				<td><?php //echo $data['DISP_SEC']; ?></td>-->
				<?php
				  if($data['att_status'] == 'P'){
				?>
				    <td style="color:green;"><b><?php echo $data['att_status']; ?></b></td>
				<?php
				  }else if($data['att_status'] == 'A'){
					?>
					<td style="color:red;"><b><?php echo $data['att_status']; ?></b></td>
					<?php
				  }else{
					?>
					<td style="color:orange; cursor:pointer"><b data-toggle="tooltip" data-placement="bottom" title='<?php echo $data->remarks; ?>'><?php echo $data['att_status']; ?></b></td>
					<?php
				  }
				?>
				<!--<td><?php //echo $data['C_MOBILE']; ?></td>-->
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
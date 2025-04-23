

<table class='table' id="tbl1">
	<thead>
		<tr>
			<th style='background:#337ab7; color:#fff !important;'>Sl.NO.</th>
			<th style='background:#337ab7; color:#fff !important;'>Adm No.</th>
			<th style='background:#337ab7; color:#fff !important;'>Student Name</th>
			<th style='background:#337ab7; color:#fff !important;'>Roll No.</th>
			<th style='background:#337ab7; color:#fff !important;'>Contact No.</th>
			<th style='background:#337ab7; color:#fff !important;'>Password</th>
			<th style='background:#337ab7; color:#fff !important;'>Send Password</th>
			<th style='background:#337ab7; color:#fff !important;'>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
			if(!empty($student_data)){
				$i=1;
				foreach($student_data as $key => $val){
					
					?>
						<tr>
							<td style='text-align: center; color:black !important;'><?php echo $i; ?></td>
						    <td style='text-align: center; color:black !important;'><?php echo $val->ADM_NO; ?></td>
							<td style='text-align: center; color:black !important;'><?php echo $val->FIRST_NM; ?></td>
							<td style='text-align: center; color:black !important;'><?php echo $val->ROLL_NO; ?></td>
							<td style='text-align: center; color:black !important;'><?php echo $val->C_MOBILE; ?></td>
							<td style='text-align: center; color:black !important;'><?php echo $val->Parent_password; ?></td>
							<td style='text-align: center; color:black !important;'></td>
							<td><i title="Change Password" style='cursor: pointer; color:black;' onclick="recall('<?php echo $val->STUDENTID; ?>','<?php echo $val->ADM_NO; ?>')" class="fa fa-bars" aria-hidden="true"></i></td>
						</tr>
					<?php
					$i++;
				}
			}
		?>
	</tbody>
</table>
<script>
	  $(function () {
		$('#tbl1').DataTable({	
		  'paging'      : true,
		  'lengthChange': false,
		  'searching'   : true,
		  'ordering'    : false,
		  'info'        : true,
		  'autoWidth'   : true,
		  aaSorting: [[0, 'asc']]
		})
	  });	
	 
</script>
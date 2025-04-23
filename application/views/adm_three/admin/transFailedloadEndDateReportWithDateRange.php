<table id="example4" class="table table-bordered table-striped">
<thead>
<tr>
  <th>Name</th>
  <th>DOB</th>
  <th>Father's Name</th>
  <th>Registration No.</th>
  <th>Mobile</th>
  <th>Transaction Id</th>
  <th>DESC</th>
</tr>
</thead>
<tbody>
<?php
foreach($ReportData as $key => $val){
	?>
		<tr>
			<td><?php echo $val['stu_nm']; ?></td>
			<td><?php echo date('d-M-y',strtotime($val['dob'])); ?></td>
			<td><?php echo $val['f_name']; ?></td>
			<td><?php echo $val['id'].'/2020'; ?></td>
			<td><?php echo $val['mobile']; ?></td>
			<td><?php echo $val['transaction_id']; ?></td>
			<td><?php echo $val['desc']; ?></td>
		</tr>
	<?php
}
?>
</tbody>
</table>


<script>
$(document).ready(function() {
	$('#example4').DataTable( {
		dom: 'Bfrtip',
		buttons: 
		[
			{
				extend: 'excel',
				text: 'EXCEL',
				title: 'from <?php //echo $valdate; ?>',
				className: 'btn btn-default',
				exportOptions: {
					columns: [0, 1, 2, 3, 4, 5, 6]
				}
			},
			{
				extend: 'pdf',
				text: 'PDF',
				title: 'from <?php //echo $valdate; ?>',
				className: 'btn btn-default',
				exportOptions: {
					columns: [0, 1, 2, 3, 4, 5, 6]
				}
			}
		]
	} );
} );
</script>
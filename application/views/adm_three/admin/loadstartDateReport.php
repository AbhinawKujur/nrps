<table id="example3" class="table table-bordered table-striped">
<thead>
<tr>
  <th>Name</th>
  <th>DOB</th>
  <th>Father's Name</th>
  <th>Registration No.</th>
  <th>Mobile</th>
  <th>Verified Status</th>
  <th>Action</th>
</tr>
</thead>
<tbody>
<?php
foreach($ReportData as $key => $val){
	?>
		<tr>
			<td><?php echo $val['stu_nm']; ?></td>
			<td><?php echo $val['dob']; ?></td>
			<td><?php echo $val['f_name']; ?></td>
			<td><?php echo $val['id']."/2020"; ?></td>
			<td><?php echo $val['mobile']; ?></td>
			<td>
				<?php
					if($val['verified_status'] == 2){
				?>
				<button class='btn btn-danger btn-xs'>REJECTED</button>
				<?php } elseif($val['verified_status'] == 1) { ?>
				<button class='btn btn-success btn-xs'>VERIFIED</button>
				<?php }else{
				?>
				<button class='btn btn-default btn-xs'>PENDING</button>
				<?php	
				} ?>
			</td>
			<td>
			<?php
				if($nur_reg_user[0]['updpermission_status'] == 1){
			?>
				<a href="<?php echo base_url('adm_three/Stu_list/edit/'.$val['id']); ?>" class='btn btn-info btn-xs' title='EDIT'>
				  <i class="fas fa-external-link-alt"></i>
				</a>
			<?php } ?>	
				<a href="<?php echo base_url('adm_three/Stu_list/downloadPDF/'.$val['id']); ?>" class='btn btn-danger btn-xs' title='DOWNLOAD'>
				  <i class="fas fa-download"></i>
				</a>
			</td>
		</tr>
	<?php
}
?>
</tbody>
</table>


<script>
$(document).ready(function() {
	$('#example3').DataTable( {
		dom: 'Bfrtip',
		buttons: 
		[
			{
				extend: 'excel',
				text: 'EXCEL',
				title: 'from <?php echo $valdate; ?>',
				className: 'btn btn-default',
				exportOptions: {
					columns: [0, 1, 2, 3, 4, 5]
				}
			},
			{
				extend: 'pdf',
				text: 'PDF',
				title: 'from <?php echo $valdate; ?>',
				className: 'btn btn-default',
				exportOptions: {
					columns: [0, 1, 2, 3, 4, 5]
				}
			}
		]
	} );
} );
</script>
 <br />
 <table class="table table-bordered" id="example">
	<thead>
		<tr>
			<th>Sl No.</th>
			<th>Certificate No.</th>
			<th>Admission No.</th>
			<th>Student Name</th>
			<th>Father Name</th>
			<th>Mother Name</th>
			<th>Current Class</th>
			<th>Issue Date</th>
			<th>No of Copy Issue</th>
		</tr>
	</thead>
	<tbody>
	<?php
		if($data){
			$i = 1;
			foreach($data as $data_key){
				?>
					<tr>
						<td><a href="<?php echo base_url('Bonafide_certificate/issue_duplicate/'.str_replace('/','_',$data_key->ADM_NO)); ?>"><?php echo $i; ?></a></td>
						<td><a href="<?php echo base_url('Bonafide_certificate/issue_duplicate/'.str_replace('/','_',$data_key->ADM_NO)); ?>"><?php echo $data_key->CERT_NO; ?></a></td>
						<td><a href="<?php echo base_url('Bonafide_certificate/issue_duplicate/'.str_replace('/','_',$data_key->ADM_NO)); ?>"><?php echo $data_key->ADM_NO; ?></a></td>
						<td><a href="<?php echo base_url('Bonafide_certificate/issue_duplicate/'.str_replace('/','_',$data_key->ADM_NO)); ?>"><?php echo $data_key->S_NAME; ?></a></td>
						<td><a href="<?php echo base_url('Bonafide_certificate/issue_duplicate/'.str_replace('/','_',$data_key->ADM_NO)); ?>"><?php echo $data_key->F_NAME; ?></a></td>
						<td><a href="<?php echo base_url('Bonafide_certificate/issue_duplicate/'.str_replace('/','_',$data_key->ADM_NO)); ?>"><?php echo $data_key->M_Name; ?></a></td>
						<td><a href="<?php echo base_url('Bonafide_certificate/issue_duplicate/'.str_replace('/','_',$data_key->ADM_NO)); ?>"><?php echo $data_key->class_name; ?></a></td>
						<td><a href="<?php echo base_url('Bonafide_certificate/issue_duplicate/'.str_replace('/','_',$data_key->ADM_NO)); ?>"><?php echo date('d-M-Y',strtotime($data_key->Issued_Date)); ?></a></td>
						<td><a href="<?php echo base_url('Bonafide_certificate/issue_duplicate/'.str_replace('/','_',$data_key->ADM_NO)); ?>"><?php echo $data_key->duplcate_Issue; ?></a></td>
					</tr>
				<?php
				$i++;
			}
		}
	?>
	</tbody>
 </table>
</div>
<div class="inner-block"></div>
<script type="text/javascript">
$(document).ready(function() {
$("#msg").fadeOut(8000);
$('#example').DataTable({
	dom: 'Bfrtip',
	buttons: [
		{
			extend: 'excelHtml5',
			title: 'Bonafide Certificate',
			exportOptions: {
				columns: [ 0, 1, 2, 3, 4, 5 , 6, 7, 8]
			}
		},
		{
			extend: 'csvHtml5',
			title: 'Bonafide Certificate',
			exportOptions: {
				columns: [ 0, 1, 2, 3, 4, 5 , 6, 7, 8]
			}
		},
		{
			extend: 'pdfHtml5',
			title: 'Bonafide Certificate',
			orientation: 'landscape',
			exportOptions: {
				columns: [ 0, 1, 2, 3, 4, 5 , 6, 7, 8]
			}
		},
	]
});
});

</script>
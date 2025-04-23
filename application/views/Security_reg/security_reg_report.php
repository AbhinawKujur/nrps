<style>
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
  }
</style>
<form method="post" action="<?php echo base_url('Admission_registar/download_security_registar'); ?>">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12">
				<input type="hidden" value="<?php echo  $s_date; ?>" name="s_date">
				<input type="hidden" value="<?php echo  $e_date; ?>" name="e_date">
				<button class="btn pull-right"><i class="fa fa-file-pdf-o"></i> Download</button>
		</div>
	</div>
</form><br />
<table class="table" id="example">
	<thead>
		<tr>
			<th>Sl. No.</th>
			<th>Receipt No</th>
			<th>Receipt Date</th>
			<th>Adm. No</th>
			<th>Student Name</th>
			<th>Roll No</th>
			<th>Class/Sec</th>
			<th>Amount</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$i=1;
			foreach($data as $key=>$value){
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $value->RECT_NO; ?></td>
					<td><?php echo $value->RECT_DATE; ?></td>
					<td><?php echo $value->adm_no; ?></td>
					<td><?php echo $value->STU_NAME; ?></td>
					<td><?php echo $value->ROLL_NO; ?></td>
					<td><?php echo $value->CLASS.'/'.$value->SEC; ?></td>
					<td><?php echo $value->Fee16; ?></td>
				</tr>
				<?php
				$i++;
			}
		?>
	</tbody>
</table>
<script type="text/javascript">
$(document).ready(function() {
$("#msg").fadeOut(8000);
$('#example').DataTable({
	dom: 'Bfrtip',
	buttons: [
		{
			extend: 'excelHtml5',
			title: 'Security Registar',
		},
	]
});
});

</script>
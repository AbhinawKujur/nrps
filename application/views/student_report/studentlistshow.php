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
<form method="post" action="<?php echo base_url('Student_report/download_studentlist'); ?>">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12">
				<input type="hidden" value="<?php echo  $class; ?>" name="class">
				<input type="hidden" value="<?php echo $sec; ?>" name="sec">
				<input type="hidden" value="<?php echo $short_by; ?>" name="short_by">
				<button class="btn pull-right"><i class="fa fa-file-pdf-o"></i> Download</button>
		</div>
	</div>
</form><br />
<table class="table" id="example">
	<thead>
		<tr>
			<th>Sl. No.</th>
			<th>Admission No.</th>
			<th>Student Name</th>
			<th>Subject-1</th>
			<th>Subject-2</th>
			<th>Subject-3</th>
			<th>Subject-4</th>
			<th>Subject-5</th>
			<th>Subject-6</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$i=1;
			foreach($data as $key=>$value){
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $value->ADM_NO; ?></td>
					<td><?php echo $value->FIRST_NM; ?></td>
					<td><?php echo $value->SUBJECT1; ?></td>
					<td><?php echo $value->SUBJECT2; ?></td>
					<td><?php echo $value->SUBJECT3; ?></td>
					<td><?php echo $value->SUBJECT4; ?></td>
					<td><?php echo $value->SUBJECT5; ?></td>
					<td><?php echo $value->SUBJECT6; ?></td>
					
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
			title: 'Student Information',
		},
	]
});
});

</script>
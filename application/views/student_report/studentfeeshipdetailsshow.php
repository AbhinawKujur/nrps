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
<!--<center>
				<input type="hidden" name="class_name" value="<?php //echo $class_name; ?>">
				<input type="hidden" name="sec_name" value="<?php //echo $sec_name; ?>">
				<button formtarget="_blank" class="btn"><i class="fa fa-file-pdf-o"></i> DOWNLOAD</button>
			</center>
<div class="col-md-12 col-sm-12 col-lg-12">
				<input type="hidden" value="<?php //echo implode(', ', $class); ?>" name="class">
				<input type="hidden" value="<?php //echo implode(', ', $sec); ?>" name="sec">
				<input type="hidden" value="<?php //echo $short_by; ?>" name="short_by">
				<button class="btn pull-right"><i class="fa fa-file-pdf-o"></i> Download</button>
		</div>-->
<form method="post" action="<?php echo base_url('Freeship_studentlist/download_studentinformation'); ?>">
	
	<div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12">
				<input type="hidden" value="<?php echo $class; ?>" name="class">
				<input type="hidden" value="<?php echo $sec; ?>" name="sec">
				<input type="hidden" value="<?php echo $short_by; ?>" name="short_by">
				<button class="btn pull-right"><i class="fa fa-file-pdf-o"></i> Download</button>
		</div>
	</div>
</form><br />
<table class="table" id="example">
	<thead>
		<tr>
			<th>Sl No.</th>
			<th>Admission No.</th>
			<th>Student Name</th>
			<th>Roll No.</th>
			<th>Class/Sec</th>
			<th>Apply From</th>
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
					<td><?php echo $value->ROLL_NO; ?></td>
					<td><?php echo $value->DISP_CLASS."/".$value->DISP_SEC; ?></td>
					<td><?php echo $value->LETTERNO; ?></td>
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
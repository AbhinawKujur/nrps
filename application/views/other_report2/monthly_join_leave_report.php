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
<form method="post" action="<?php echo base_url('Other_report/download_monthly_join'); ?>">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12">
				<input type="hidden" value="<?php echo  $s_date; ?>" name="s_date">
				<input type="hidden" value="<?php echo  $e_date; ?>" name="e_date">
				<input type="hidden" value="<?php echo  $choice; ?>" name="choice">
				<button class="btn pull-right"><i class="fa fa-file-pdf-o"></i> Download</button>
		</div>
	</div>
</form><br />
<table class="table" id="example">
	<thead>
		<tr>
			<th>Sl. No.</th>
			<th>ADM. NO</th>
			<th>STU NAME</th>
			<th>CLASS/SEC</th>
			<th>Roll No</th>
			<th>CONTACT</th>
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
					<td><?php echo $value->DISP_CLASS.'/'.$value->DISP_SEC; ?></td>
					<td><?php echo $value->Roll_no; ?></td>
					<td><?php echo $value->C_MOBILE; ?></td>
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
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
<form method="post" action="<?php echo base_url('bus_report/download_bus_stulistreport'); ?>" target="_blank">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12">
				<input type="hidden" value="<?php echo $class; ?>" name="classs">
				<input type="hidden" value="<?php echo $sec; ?>" name="secc">
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
			<th>Contact No.</th>
			<th>Stoppage Name</th>
			<th>Bus Amount</th>
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
					<td><?php echo $value->C_MOBILE; ?></td>
					<td><?php echo $value->stopname; ?></td>
					<td><?php echo $value->stp_amt; ?></td>
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
			title: 'Student List Avail(Bus Facility) Report',
		},
	]
});
});

</script>
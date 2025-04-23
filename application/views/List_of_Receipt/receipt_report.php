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
<form method="post" action="<?php echo base_url('List_of_Receipt/download_receipt_list'); ?>">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12">
				<input type="hidden" value="<?php echo  $s_date; ?>" name="s_date">
				<button class="btn pull-right"><i class="fa fa-file-pdf-o"></i> Download</button>
		</div>
	</div>
</form><br />
<table class="table" id="example">
	<thead>
		<tr>
			<th>Sl. No.</th>
			<th>RECT_NO</th>
			<th>Student Name</th>
			<th>Adm. No.</th>
			<th>Class/Sec</th>
			<th>Roll No</th>
			<th>Period</th>
			<th>Ammount</th>
			<th>Logi Id</th>
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
					<td><?php echo $value->STU_NAME; ?></td>
					<td><?php echo $value->ADM_NO; ?></td>
					<td><?php echo $value->CLASS.'/'.$value->SEC; ?></td>
					<td><?php echo $value->ROLL_NO; ?></td>
					<td><?php echo $value->period; ?></td>
					<td><?php echo $value->TOTAL; ?></td>
					<td><?php echo $value->User_Id; ?></td>
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
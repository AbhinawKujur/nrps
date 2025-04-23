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
<form method="post" action="<?php echo base_url('Scholarshipownedby/download_studentinformation'); ?>">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12">
				<input type="hidden" value="<?php echo $class; ?>" name="class">
				<input type="hidden" value="<?php echo $owned; ?>" name="owned">
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
			<th>Class</th>
			<th>Apply From</th>
			<th>Recommanded By</th>
			<th>Application No.</th>
			<?php
				foreach($feehead as $key=>$value){
					if($value->FEE_HEAD =="" || $value->FEE_HEAD =="-"){
						
					}else{
						?>
							<th><?php echo $value->FEE_HEAD; ?></th>
						<?php
					}
				}
			?>
		</tr>
	</thead>
	<tbody>
		<?php
			$i=1;
			foreach($data as $key1=>$value1){
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $value1->ADM_NO; ?></td>
					<td><?php echo $value1->STU_NAME; ?></td>
					<td><?php echo $value1->ROLL_NO; ?></td>
					<td><?php echo $value1->CLASS; ?></td>
					<td><?php echo $value1->Apply_From; ?></td>
					<td><?php echo $value1->recomm; ?></td>
					<td><?php echo $value1->app_no; ?></td>
					<?php
					foreach($feehead as $key2=>$value2){
						$v = $key2+1;
						$v1 = "S".$v;
						
						if($value2->FEE_HEAD =="" || $value2->FEE_HEAD =="-"){
							
						}else{
							?>
								<td><?php echo $value1->$v1; ?></td>
							<?php
						}
					}
				?>
				   
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
			title: 'Scholarship Owned By',
		},
	]
});
});

</script>
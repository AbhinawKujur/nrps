<style>
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    font-size: 12px !important;
	 white-space: nowrap !important;
    color: #080808;
    border-top: none !important;
    padding-top: 5px !important;
	
}
.table{
	border : 1px solid #a5a5a5 !important;
}
.table > thead > tr > th{
	background-color:#a5a5a5 !important;
}
</style>
<form method="post" action="<?php echo base_url('Reconcilation_ledger/download_studentinformation'); ?>">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12">
				<input type="hidden" value="<?php echo $class; ?>" name="class">
				<input type="hidden" value="<?php echo $sec; ?>" name="sec">
				<input type="hidden" value="<?php echo $short_by; ?>" name="short_by">
				<button class="btn pull-right"><i class="fa fa-file-pdf-o"></i> Download</button>
		</div>
	</div>
</form><br />
<table class="table table-border" >
	<thead>
		<tr>
			<th>Sl No.</th>
			<th>Adm No. /<br>Adm Date</th>
			<th>Student Name</th>
			<th>Roll No.</th>
			<th>Status</th>
			<?php
				foreach($feehead as $key=>$value){
					if($value->FEE_HEAD=="" || $value->FEE_HEAD=="-"){
						
					}else{
						?>
							<th><?php echo $value->SHNAME; ?></th>
						<?php
					}
				}
			?>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$i=1;
			foreach($cal_data as $key=>$value){
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $value['ADM_NO']; ?></td>
					<td><?php echo $value['FIRST_NM']; ?></td>
					<td><?php echo $value['ROLL_NO']; ?></td>
					<td>Dr</td>
					<?php
						for($j=1;$j<=26;$j++){
							?>
							<td><?php echo $value['FEEGEN_'.$j]; ?></td>
							<?php
						}
					?>
				</tr>
				<tr>
					<td></td>
					<td><?php echo date('d-M-Y',strtotime($value['ADM_DATE'])); ?></td>
					<td></td>
					<td></td>
					<td>Cr</td>
					<?php
						for($jk=1;$jk<=26;$jk++){
							?>
							<td><?php echo $value['COLL_FEE'.$jk]; ?></td>
							<?php
						}
					?>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<?php
						for($jkk=1;$jkk<=26;$jkk++){
							?>
							<td><?php echo $value['fees_'.$jkk].$value['s'.$jkk]; ?></td>
							<?php
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
			title: 'Student Information',
		},
	]
});
});

</script>
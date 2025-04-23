
<form method="post" action="<?php echo base_url('Student_report/download_deleted_studentlist'); ?> " target="_blank">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12">
				<input type="hidden" value="<?php echo  $strt_dat; ?>" name="strt_dat">
				<input type="hidden" value="<?php echo $end_dat; ?>" name="end_dat">
				<input type="hidden" value="<?php echo $type; ?>" name="type">
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
			<th>Class</th>
			<th>Sec</th>
			<th>Delete Date</th>
			<th>Recall Date</th>
			<th>Login Id</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$i=1;
            // echo "<pre>";
            // print_r($stu_list);die;
			foreach($stu_list as $key=>$value){
                // echo "<pre>";
                // print_r($value);die;
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $value->Adm_no; ?></td>
					<td><?php echo $value->Stu_name; ?></td>
					<td><?php echo $value->cl; ?></td>
					<td><?php echo $value->sec; ?></td>
					<td><?php echo $value->del_date; ?></td>
					<td><?php if($value->recall_date!="0000-00-00"){echo $value->recall_date;} ?></td>
					<td><?php echo $value->operator_id; ?></td>
					
				</tr>
				<?php
				$i++;
			}
		?>
	</tbody>
</table>

<script type="text/javascript">
$(document).ready(function() {
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
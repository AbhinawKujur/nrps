 <br />
 <table class="table table-bordered" id="example">
	<thead>
		<tr>
			<th>Sl No</th>
			<th>Admission No</th>
			<th>Roll</th>
			<th>Student Name</th>
			<th>Mark</th>
			<?php if($mobile == 'with_mobile'){ ?>
				<th>Mobile</th>
			<?php } ?>
		</tr>
	</thead>
	<tbody>
	<?php
		if($student){
			$i = 1;
			foreach($student as $data_key){
				?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $data_key->ADM_NO; ?></td>
						<td><?php echo $data_key->ROLL_NO; ?></td>
						<td><?php echo $data_key->FIRST_NM; ?></td>
						<td></td>
						<?php if($mobile == 'with_mobile'){ ?>
								<td><?php echo $data_key->C_MOBILE; ?></td>
						<?php }  ?>
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
			title: 'Award List',
		},
		{
			extend: 'csvHtml5',
			title: 'Award List',
		},
	]
});
});

</script>
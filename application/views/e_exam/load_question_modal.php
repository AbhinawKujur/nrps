<table class='table' id='dataTable' border='1'>
	<thead>
	<tr>
		<th style='background:#5785c3; color:#fff;'>Question Type</th>
		<th style='background:#5785c3; color:#fff;'>Question</th>
		<th style='background:#5785c3; color:#fff;'>File</th>
		<th style='background:#5785c3; color:#fff;'>Max Marks</th>
	</tr>
	</thead>
	<tbody>
	<?php
		foreach($getData as $key => $val){
			?>
				<tr>
					<td>
						<?php 
							echo ($val['question_type'] == 1)?"Subjective":"Objective"; 
						?>
					</td>
					<td><?php echo $val['question']; ?></td>
					<td>
						<?php 
							if($val['que_img'] != ''){
								?>
									<img src='<?php echo base_url($val['que_img']); ?>' style='width:100px'>
								<?php
							}										
						?>
					</td>
					<td><?php echo $val['max_marks']; ?></td>
				</tr>
			<?php
		}
	?>
	</tbody>
</table>
<script>
	$('#dataTable').DataTable({
	  'paging'      : true,
	  'lengthChange': false,
	  'searching'   : true,
	  'ordering'    : false,
	  'info'        : true,
	  'autoWidth'   : true,
	  aaSorting: [[0, 'asc']]
	})
</script>
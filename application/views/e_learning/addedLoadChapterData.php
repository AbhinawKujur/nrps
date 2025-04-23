<table class='table dataTable'>
<thead>
	<tr>
		<th style='color:#fff !important; background:#5785c3;'>Date of Upload</th>
		<th style='color:#fff !important; background:#5785c3;'>Class</th>
		<th style='color:#fff !important; background:#5785c3;'>Sec</th>
		<th style='color:#fff !important; background:#5785c3;'>Subject</th>
		<th style='color:#fff !important; background:#5785c3;'>Chapter</th>
		<th style='color:#fff !important; background:#5785c3;'>Topic</th>
		<th style='color:#fff !important; background:#5785c3;'>Remarks</th>
		<th style='color:#fff !important; background:#5785c3;'>Files</th>
	</tr>
</thead>	
<tbody>
	<?php
		foreach($eLearningData as $key => $val){
			if($val['emp_id'] == $login_id){
			?>
				<tr>
					<td><?php echo date(('d-M'),strtotime($val['date'])) ?></td>
					<td><?php echo $val['disp_class']; ?></td>
					<td><?php echo $val['disp_sec']; ?></td>
					<td><?php echo $val['subjectnm']; ?></td>
					<td><?php echo $val['chapternm']; ?></td>
					<td><?php echo $val['topic']; ?></td>
					<td><?php echo $val['remarks']; ?></td>
					<td>
						<?php 
							$imgData = unserialize($val['img']); 
							foreach($imgData as $key => $val){
								?>
									<br /><span style='font-size:10px;'>FILE</span> <?php echo $key + 1; ?>
						<a download href='<?php echo base_url($val); ?>' onclick='downloadStatus(<?php echo $val["id"]; ?>,<?php echo $admno; ?>)'>
								<i class="fa fa-download" style='color:red'></i></a>
								<?php
							}
						?>
					</td>
				</tr>
			<?php
			}
		}
	?>
</tbody>	
</table>

<script>
	$(function () {
    $('.dataTable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
      aaSorting: [[0, 'asc']]
    })
  });
</script>
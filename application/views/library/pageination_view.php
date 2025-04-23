	
			
				<?php
					foreach($ReportData as $key => $val){
						?>
							<tr>
								<td><?php echo $val['accno']; ?></td>
								<td><?php echo $val['BNAME']; ?></td>
								<td><?php echo $val['AUTHOR']; ?></td>
								<td><?php echo $val['PUBLISHER']; ?></td>
								<td><?php echo $val['EDITION']; ?></td>
								<td><?php echo $val['Med']; ?></td>
								<td><a href='<?php echo base_url('library/BookMaster/editBookMaster/'.$val['id']); ?>'><i class="fa fa-pencil-square" style=' font-size:20px; color:green'></i></a></td>
							</tr>
						<?php
					}
				?>
			
		


<script>
$(document).ready(function() {
		$('#example5').DataTable( {
			dom: 'Bfrtip',
			buttons: 
			[
				{
					extend: 'excel',
					text: 'EXCEL',
					title: 'from '+'<?php echo $start_date; ?> to <?php echo $end_date; ?>',
					className: 'btn btn-default',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5]
					}
				},
				{
					extend: 'pdf',
					text: 'PDF',
					title: 'from '+'<?php echo $start_date; ?> to <?php echo $end_date; ?>',
					className: 'btn btn-default',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5]
					}
				}
			]
		} );
	} );
</script>
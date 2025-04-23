<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<script src='https://code.jquery.com/jquery-3.5.1.js'></script>
<script src='https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js'></script>
<script src='https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js'></script>

<table border='1' cellspacing='0' id='example'>
	<thead>
		<tr>
			<th>SL NO.</th>
			<th>Adm No.</th>
			<th>Student Name</th>
			<th>Father's Name</th>
			<th>Class</th>
			<th>Section</th>
			<th>Roll No.</th>
			<th>Contact No.</th>
			<th>Arrival Bus No.</th>
			<th>Departure Bus No.</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($data as $key => $val){
				?>
					<tr>
						<td><?php echo $key+1; ?></td>
						<td><?php echo $val['ADM_NO'] ?></td>
						<td><?php echo $val['FIRST_NM'] ?></td>
						<td><?php echo $val['C_MOBILE'] ?></td>
						<td><?php echo $val['DISP_CLASS'] ?></td>
						<td><?php echo $val['DISP_SEC'] ?></td>
						<td><?php echo $val['ROLL_NO'] ?></td>
						<td><?php echo $val['C_MOBILE'] ?></td>
						<td><?php echo $val['arrival'] ?></td>
						<td><?php echo $val['departure'] ?></td>
					</tr>
				<?php
			}
		?>
	</tbody>
</table>

<script>
	$(document).ready(function() {
		$('#example').DataTable( {
			dom: 'Bfrtip',
			buttons: [
				'excelHtml5',
				//'pdfHtml5'
			]
		} );
	} );
</script>
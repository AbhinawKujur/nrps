<style>
	.table tbody{
		font-size: 13px !important;
	}
</style>

<div class='table-responsive'>
<table class='table' id='datatable'>
	<thead>
		<tr>
			<th>Adm. No.</th>
			<th>Name</th>
			<th>Class</th>
			<th>Sec</th>
			<th>Percent</th>
			<th>Rank</th>
			<th>Pro. Class</th>
			<th>Pro. Sec</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
		foreach($topperRank as $key => $val){
			?>
				<tr>
					<td><?php echo $val['admno']; ?></td>
					<td><?php echo $val['first_nm']; ?></td>
					<td><?php echo $val['classnm']; ?></td>
					<td><?php echo $val['secnm']; ?></td>
					<td><?php echo $val['percent']."%"; ?></td>
					<td><?php echo $val['rank']; ?></td>
					<td>
						<select class='form-control' id='promotedClass_<?php echo $key; ?>'>
							<option value=''>Select</option>
							<?php
								foreach($classes as $key1 => $val1){
							?>
							<option value='<?php echo $val1['Class_No']; ?>' <?php if($selectSec == $val1['Class_No']){ echo "selected"; } ?>><?php echo $val1['CLASS_NM']; ?></option>
							<?php
								}
							?>
						</select>
					</td>
					<td>
						<select class='form-control' id='promotedSection_<?php echo $key; ?>' onchange="sec(this.value)">
							<?php
								foreach($sections as $key => $val){
							?>
							<option value='<?php echo $val['section_no']; ?>'><?php echo $val['SECTION_NAME']; ?></option>
							<?php
								}
							?>
						</select>
					</td>
					<td>
						<select class='form-control' id='status_<?php echo $key; ?>'>
							<option value='Promoted'>Promoted</option>
							<option value='Detained'>Detained</option>
						</select>
					</td>
				</tr>	
			<?php
		}
	?>
</tbody>	
</table>
</div>

<script>
	$('#datatable').dataTable( {
	"ordering": false,
	"bDestroy": true,
	"searching":true,
	"paging":false,
	dom: 'Bfrtip',
		  buttons: [
			  {
				extend: 'excelHtml5',
				title: 'Student Attendance Percentage',
							  
			  },
			  {
				extend: 'pdfHtml5',
				title: 'Student Attendance Percentage',
							  
			  },
		  ],
	});
</script>
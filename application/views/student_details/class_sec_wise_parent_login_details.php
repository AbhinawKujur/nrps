<table class="table table-bordered" id="example">
	<thead>
	  <tr>
		<th>Sl no.</th>
		<th>Student Id</th>
		<th>Admission No</th>
		<th>Student Name</th>
		<th>Class</th>
		<th>Sec</th>
		<th>Father Name</th>
		<th>Mother Name</th>
		<th>Password</th>
		<th>Action</th>
	  </tr>
	</thead>
	<tbody>
	 <?php
		if($student){
			$i = 1;
			foreach($student as $student_data){
				?>
				  <tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $student_data->STUDENTID; ?></td>
					<td><?php echo $student_data->ADM_NO; ?></td>
					<td><?php echo $student_data->FIRST_NM; ?></td>
					<td><?php echo $student_data->DISP_CLASS; ?></td>
					<td><?php echo $student_data->DISP_SEC; ?></td>
					<td><?php echo $student_data->FATHER_NM; ?></td>
					<td><?php echo $student_data->MOTHER_NM; ?></td>
					<td><?php echo $student_data->Parent_password; ?></td>
					<td><i title="Recall Student" style='cursor: pointer; color:black;' onclick="recall('<?php echo $student_data->STUDENTID; ?>','<?php echo $student_data->ADM_NO; ?>')" class="fa fa-bars" aria-hidden="true"></i></td>
				  </tr>
				<?php
				$i++;
			}
		}
	  ?>
	</tbody>
</table>
 <br />
 <table class="table table-bordered" id="example">
 	<thead>
 		<tr>
 			<th>Sl No</th>
 			<th>Admission No</th>
 			<th>Roll</th>
 			<th>Student Name</th>
 			<th>Date of Birth</th>
 			<th>Father Name</th>
 			<th>Mother Name</th>
 			<th>Admission Date</th>
 			<th>Admission Class</th>
 			<th>Stoppage</th>
 		</tr>
 	</thead>
 	<tbody>
 		<?php 
			if ($student) {
				$i = 1;
				foreach ($student as $data_key) {
			?>
 				<tr>
 					<td><?php echo $i; ?></td>
 					<td><?php echo $data_key->ADM_NO; ?></td>
 					<td><?php echo $data_key->ROLL_NO; ?></td>
 					<td><?php echo $data_key->FIRST_NM; ?></td>
 					<td><?php echo date('d-M-Y', strtotime($data_key->BIRTH_DT)); ?></td>
 					<td><?php echo $data_key->FATHER_NM; ?></td>
 					<td><?php echo $data_key->MOTHER_NM; ?></td>
 					<td><?php echo date('d-M-Y', strtotime($data_key->ADM_DATE)); ?></td>
 					<td><?php echo $data_key->ADM_CLASS_id; ?></td>
 					<td><?php echo $data_key->other_stop; ?></td>
 				</tr>
 		<?php
					$i++;
				}
			}  
			?>
 	</tbody>
 </table>
 </div>
 <?php 
 $classs = $class;
 $secc = $sec;
 $date1 = $date1;
 $date2 = $date2;
 ?>
 <div class="inner-block"></div>
 <script type="text/javascript">
 	$(document).ready(function() {
 		$("#msg").fadeOut(8000);
 		$('#example').DataTable({
 			'paging': true,
 			'lengthChange': true,
 			'searching': true,
 			'ordering': true,
 			'info': true,
 			'autoWidth': true,
 			'pageLength': 10,
 			dom: 'Bfrtip',
 			buttons: {
 				dom: {
 					button: {
 						tag: 'button',
 						className: ''
 					}
 				},
 				buttons: [{
 						extend: 'excel',
 						text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> EXCEL',
 						title: 'ADMISSION REGISTER',
 						className: 'btn btn-success',
 						extension: '.xlsx'
 					},
 					{
 						extend: 'pdf',
 						title: 'ADMISSION REGISTER',
 						text: '<i class="fa fa-file-pdf-o"></i> PDF',
 						className: 'btn btn-primary',
 						action: function(e, dt, button, config) {
 							var query = dt.search();
 							window.open("<?php if (!empty($classs && $secc)) {
												echo base_url('Admission_registar/student_register_class/' . $classs . '/' . $secc);
											} else {
												echo base_url('Admission_registar/student_details_date_wise/'.$date1.'/'.$date2);
											} ?>");
 						}
 					}
 				]
 			}
 		});
 	});
 </script>
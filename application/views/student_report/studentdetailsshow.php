<style>
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
  }
</style>
<form method="post" action="<?php echo base_url('Student_report/download_studentinformation'); ?>">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12">
				<input type="hidden" value="<?php echo implode(', ', $class); ?>" name="class">
				<input type="hidden" value="<?php echo implode(', ', $sec); ?>" name="sec">
				<input type="hidden" value="<?php echo $short_by; ?>" name="short_by">
				<button class="btn pull-right"><i class="fa fa-file-pdf-o"></i> Download</button>
		</div>
	</div>
</form><br />
<table class="table" id="example">
	<thead>
		<tr>
			<th>Sl. No.</th>
			<th>Admission Date</th>
			<th>Admission No.</th>
			<th>Student Name</th>
			<th>Father Name</th>
			<th>Mother Name</th>
			<th>Mobile No.</th>
			<th>Aadhaar No.</th>
			<th>Date of Birth</th>
			<th>Admission Class-sec</th>
			<th>Current Class-sec</th>
			<th>Roll No.</th>
			<th>Gender</th>
			<th>Category</th>
			<th>Ward Type</th>
			<th>Address</th>
			<th>Computer Facility</th>
			<th>Hostel Facility</th>
			<th>BUSSTOPAGE</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$i=1;
			foreach($data as $key=>$value){
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo date('d-M-Y',strtotime($value->ADMISSION_DATE)); ?></td>
					<td><?php echo $value->ADMISSION_NO; ?></td>
					<td><?php echo $value->STUDENT_NAME; ?></td>
					<td><?php echo $value->FATHERNAME; ?></td>
					<td><?php echo $value->MOTHERNAME; ?></td>
					<td><?php echo $value->CROSSMOBILE." , ".$value->CROSSPHONE1; ?></td>
					<td><?php echo $value->AADHAR_NUMBER; ?></td>
					<td><?php echo date('d-M-Y',strtotime($value->DATE_OF_BIRTH)); ?></td>
					<td><?php echo $value->CLASS_NAME."-".$value->SECTION_NAME; ?></td>
					<td><?php echo $value->CURRENT_CLASS."-".$value->CURRENT_SECTION; ?></td>
					<td><?php echo $value->ROLL_NO; ?></td>
					<td><?php
						if($value->GENDER == "1"){
							echo "Male";
						}else{
							echo "Female";
						}
					?></td>
					<td><?php echo $value->CATEGORY; ?></td>
					<td><?php echo $value->EMPLOYEE_WARD; ?></td>
					<td><?php echo $value->CROSSADD." ".($value->CROSSCITY).$value->CROSSSTATE."-".$value->CROSSPIN; ?></td>
					<td><?php if($value->COUMPUTER_STATUS == 1){
						echo "Yes";
					}else{
						echo "No";
					} 
					?></td>
					<td>
					<?php if($value->HOSTEL_STATUS == 1){
						echo "Yes";
					}else{
						echo "No";
					} 
					?>
					</td>
					<td><?php echo $value->BUSSTOPAGE; ?></td>
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
<style>
	#table2 {
		border-collapse: collapse;
	}
	#table3 {
		border-collapse: collapse;
	}
	#img{
		float:left;
		height:120px;
		width:120px;
		margin-left: 150px !important;
	}
	#tp-header{
		font-size:30px;
	}
	#mid-header{
		font-size:26px;
	}
	#last-header{
		font-size:22px;
	}
	.th{
		background-color: #5785c3 !important;
		color : #fff !important;
		font-size:12px;
	}
	.tt{
		font-size:10px;
	}
	.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
  }
	
</style>
<img src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>" id="img">
<table width="100%" style="float:right;">
	<tr>
		<td id="tp-header"><center><?php echo $school_setting[0]->School_Name; ?><center></td>
	</tr>
	<tr>
		<td id="mid-header"><center><?php echo $school_setting[0]->School_Address; ?><center></td>
	</tr>
	<tr>
		<td id="last-header"><center>SESSION (<?php echo $school_setting[0]->School_Session; ?>)<center></td>
	</tr>
	<tr>
		<td><center><span style="font-size:22px !important;">Student Information</span></center></td>
	</tr>
</table><br /><br /><br /><br /><br /><br /><br />
<hr>
<br />
<table width="100%" border="1" id="table2">
	<thead>
		<tr>
			<th class="th">Sl No.</th>
			<th class="th">Admission Date</th>
			<th class="th">Admission No.</th>
			<th class="th">Student Name</th>
			<th class="th">Father Name</th>
			<th class="th">Mother Name</th>
			<th class="th">Mobile No.</th>
			<th class="th">Aadhaar No.</th>
			<th class="th">Date of Birth</th>
			<th class="th">Admission Class-Sec</th>
			<th class="th">Current Class-Sec</th>
			<th class="th">Roll No.</th>
			<th class="th">Gender</th>
			<th class="th">Category</th>
			<th class="th">Ward Type</th>
			<th class="th">Address</th>
			<th class="th">Computer Facility</th>
			<th class="th">Hostel Facility</th>
			<th class="th">Bus Stoppage</th>
		</tr>
		
	</thead>
	<tbody>
		<?php
			$i=1;
			foreach($data as $key=>$value){
				?>
				<tr>
					<td class="tt"><?php echo $i; ?></td>
					<td class="tt"><?php echo date('d-M-Y',strtotime($value->ADMISSION_DATE)); ?></td>
					<td class="tt"><?php echo $value->ADMISSION_NO; ?></td>
					<td class="tt"><?php echo $value->STUDENT_NAME; ?></td>
					<td class="tt"><?php echo $value->FATHERNAME; ?></td>
					<td class="tt"><?php echo $value->MOTHERNAME; ?></td>
					<td class="tt"><?php echo $value->CROSSMOBILE." , ".$value->CROSSPHONE1; ?></td>
					<td class="tt"><?php echo $value->AADHAR_NUMBER; ?></td>
					<td class="tt"><?php echo date('d-M-Y',strtotime($value->DATE_OF_BIRTH)); ?></td>
					<td class="tt"><?php echo $value->CLASS_NAME."-".$value->SECTION_NAME; ?></td>
					<td class="tt"><?php echo $value->CURRENT_CLASS."-".$value->CURRENT_SECTION; ?></td>
					<td class="tt"><?php echo $value->ROLL_NO; ?></td>
					<td class="tt"><?php
						if($value->GENDER == "1"){
							echo "Male";
						}else{
							echo "Female";
						}
					?></td>
					<td class="tt"><?php echo $value->CATEGORY; ?></td>
					<td class="tt"><?php echo $value->EMPLOYEE_WARD; ?></td>
					<td class="tt"><?php echo $value->CROSSADD." ".($value->CROSSCITY).$value->CROSSSTATE."-".$value->CROSSPIN; ?></td>
					<td class="tt"><?php if($value->COUMPUTER_STATUS == 1){
						echo "Yes";
					}else{
						echo "No";
					} 
					?></td>
					<td class="tt">
					<?php if($value->HOSTEL_STATUS == 1){
						echo "Yes";
					}else{
						echo "No";
					} 
					?>
					</td>
					<td class="tt"><?php echo $value->BUSSTOPAGE; ?></td>
				</tr>
				<?php
				$i++;
			}
		?>
	</tbody>
</table>
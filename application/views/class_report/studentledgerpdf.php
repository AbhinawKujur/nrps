<style>
	#table2 {
		border-collapse: collapse;
	}
	#table3 {
		border-collapse: collapse;
	}
	#img{
		float:left;
		height:130px;
		width:130px;
		margin-left: 150px !important;
	}
	#tp-header{
		font-size:20px;
	}
	#mid-header{
		font-size:18px;
	}
	#last-header{
		font-size:16px;
	}
	.th{
		background-color: #5785c3 !important;
		color : #fff !important;
	}
	.tt{
		font-size:13px;
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
</table><br /><br /><br /><br /><br /><br /><br /><br />
<center><span style="font-size:22px !important;">Fee Paid Details</span></center>
<hr>
<br />
<table width="100%" id="table3">
			<tr>
				<td>Admission No.</td>
				<td>: <?php echo $Adm_no; ?></td>
				<td>Student Name</td>
				<td>: <?php echo $student_name; ?></td>
				<td>Roll No.</td>
				<td>: <?php echo $ROLL_NO; ?></td>
			</tr>
			<tr>
				<td>Father Name</td>
				<td colspan='5'>: <?php echo $FATHER_NM; ?></td>
			</tr>
			<tr>
				<td>Class</td>
				<td>: <?php echo $class; ?></td>
				<td>Sec</td>
				<td>: <?php echo $sec; ?></td>
				<td>Ward</td>
				<td>: <?php echo $eward; ?></td>
			</tr>
			
</table><br />
<table width="100%" border="1" id="table2">
	<thead>
		<tr>
			<th class="th">Reciept No.</th>
			<th class="th">Reciept Date</th>
			<th class="th">Particular</th>
			<th class="th">Total Amount</th>
		</tr>
		
	</thead>
	<tbody>
		
	</tbody>
</table>
<?php
$school_details = $this->alam->selectA('school_setting',"*");
// echo "<pre>";
// print_r($school_details);

// echo $school_details[0]['School_Name'];
?>
<style type="text/css">
		/*.table td th {
			border: 1px solid black;
			border-collapse: collapse;
		}*/
		table.timecard  {
    border-collapse: collapse; 
    border:1px solid #000000;
} 
table.timecard  td{
    border:1px solid; #000000;
    padding:5px;
}
table.timecard  td:first-child{
    border-left:0px solid #000000;
}
table.timecard  th{
   border:2px solid #000000;
   padding:5px;
}

body{
  padding: 20px;
}

	</style>
		<div class="row">
			<div class='col-sm-12'>
				<div class="table-responsive">
					<table style="width:100%" >
						<tr>
							<td><center><img src="<?php echo $school_details[0]['SCHOOL_LOGO'];
								?>" style="margin-left:5%; width:83px;"></center></td>
							<td><center><h2><span style="color:#02933e"><?php echo $school_details[0]['School_Name'];
								?></span></h2><?php echo $school_details[0]['School_Address'];
								?><br></center></td>
							<td style='visibility:hidden'><center><img src="assets/school_logo/logo.jpg" style="margin-left:5%; width:83px;"></center></td>
							
						</tr>
					</table><br /><br /><br />	
					<table class="timecard" style="width:100%">
						<thead>
							<tr>
								<th colspan="9" style="background: #337ab7;color: white;"><center>Class Section Wise Attendance Status On Date (<?php echo date("d-M-Y"); ?>)</center></th>
							</tr>
						   <tr>
						     <th style="background: #bac9e2;"><center>Class</center></th>
						     <th style="background: #bac9e2;"><center> Section</center></th> 
						     <th style="background: #bac9e2;"><center>Attendance Status</center></th> 
						     <th style="background: #bac9e2;"><center>Total Student</center></th> 
						     <th style="background: #bac9e2;"><center>Total Present</center></th> 
						     <th style="background: #bac9e2;"><center>Total Absent</center></th> 
						     <th style="background: #bac9e2;"><center>RollNo</center></th> 
						     <th style="background: #bac9e2;"><center>Class Teacher</center></th> 
						     <th style="background: #bac9e2;"><center>Teacher Sign</center></th> 
						   </tr>
						</thead>
						<tbody>
							<?php 
							foreach ($classSec as $key => $value){
								$class = $value['CLASS'];
								$sec   = $value['SEC'];
								$roll   = $value['ROLL_NO'];
								$date  = $Cdate;
								$attData  = $this->alam->selectA('stu_attendance_entry_periodwise',"count(*)cnt,(SELECT count(att_status) FROM stu_attendance_entry_periodwise WHERE att_status='P' AND class_code='$class' AND sec_code = '$sec' AND date(att_date)='$date' AND subject_id = '16' AND att_type = '3')P,(SELECT count(att_status) FROM stu_attendance_entry_periodwise WHERE att_status='A' AND class_code='$class' AND sec_code = '$sec' AND date(att_date)='$date' AND subject_id = '16' AND att_type = '3')A,(SELECT emp_name FROM login_details WHERE Class_No='$class' AND Section_No='$sec' AND Class_tech_sts='1')empnm,(SELECT username FROM login_details WHERE Class_No='$class' AND Section_No='$sec' AND Class_tech_sts='1')usrnm","class_code='$class' AND sec_code = '$sec' AND date(att_date) = '$date' AND subject_id = '16' AND att_type = '3'");
								$countStudent = $this->alam->selectA('student',"(SELECT COUNT(CLASS) FROM student WHERE CLASS='$class' AND SEC='$sec')cntstd");
								//$str = $this->db->last_query();
      							//echo "<pre>";
								//print_r($str);
								//die;
								$cnt   = $attData[0]['cnt'];
								$p     = $attData[0]['P'];
								$a     = $attData[0]['A'];
								$empnm = $attData[0]['empnm'];
								$usrnm = $attData[0]['usrnm'];
								$cntstd = $countStudent[0]['cntstd'];

								if($cnt != 0){
							?>
								<tr>
									<td><center><?php echo $value['DISP_CLASS']; ?></center></td>
									<td><center><?php echo $value['DISP_SEC']; ?></center></td>
									<td><center><i style='font-size:25px; color:green' class="fa fa-check" ></i></center></td>
									<td><center><?php echo $cntstd; ?></center></td>
									<td><center><?php echo $p; ?></center></td>
									<td><center><?php echo $a; ?></center></td>
									<td><center><?php echo $value['ROLL_NO']; ?></center></td>
									<td><center><?php echo $empnm; ?></center></td>
									<td><center><textarea rows="10"></textarea></center></td>
								</tr>
								<?php } else{ ?>
								<tr>
									<td><center><?php echo $value['DISP_CLASS']; ?></center></td>
									<td><center><?php echo $value['DISP_SEC']; ?></center></td>
									<td><center><i style='font-size:25px; color:red' class="fa fa-times" ></i></center></td>
									<td><center><?php echo $cntstd; ?></center></td>
									<td><center><?php echo $p; ?></center></td>
									<td><center><?php echo $a; ?></center></td>
									<td><center><?php echo $value['ROLL_NO']; ?></center></td>
									<td><center><?php echo $empnm; ?></center></td>
									<td><center><textarea rows="3"></textarea></center></td>
								</tr>
								<?php } ?>
							<?php } ?>
						</tbody>
				 	</table>
				</div>
			</div>
		</div>
    <br><br><br><br><br><br>
    <table style="width:100%">
		<tr>   		
			<td colspan="2"><textarea></textarea></td>
			<td style="padding-right: 3rem; padding-left: 6rem"><textarea></textarea></td>
    	</tr>
    	<tr>
			<td><center>Principal Signature</center></td>
			<td>&nbsp;</td>
			<td style="padding-left: 2rem;"><center>Vice Principal Signature</center></td>
		</tr>
	</table>
<br>

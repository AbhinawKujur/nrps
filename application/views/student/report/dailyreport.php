

<div class="text-center">
	<form method="post" action="<?php echo base_url('student/report/DailyReport/printDailyAttRprt'); ?>">		
		<input type="hidden" id="Cdate" value="<?php echo $Cdate; ?>">
		<input type="submit" formtarget="_blank" name="" class="btn btn-success" id="getTabelData" value="Download">
	</form>
</div>
<br>
	<div class="employee-dashboard">
		<div class="row">
			<div class='col-sm-12'>
				<div class="table-responsive">
					<table class='table table-bordered table-striped dataTable' id="dataTable">
						<caption style="text-align: center;background: #337ab7;color: white;">Class Section Wise Attendance Status On Date (<?php echo date("d-M-Y"); ?>)</caption>
						<thead>
						   <tr>
						     <th style="background: #bac9e2;" class="text-center">Class</th>
						     <th style="background: #bac9e2;" class="text-center"> Section</th> 
						     <th style="background: #bac9e2;" class="text-center">Attendance Status</th> 
						     <th style="background: #bac9e2;" class="text-center">Total Student</th> 
						     <th style="background: #bac9e2;" class="text-center">Total Present</th> 
						     <th style="background: #bac9e2;" class="text-center">Total Absent</th> 
						     <th style="background: #bac9e2;" class="text-center">RollNo</th> 
						     <th style="background: #bac9e2;" class="text-center">Class Teacher</th> 
						     <th style="background: #bac9e2;" class="text-center">Teacher Sign</th> 
						   </tr>
						</thead>
						<tbody>
							<?php 
							foreach ($classSec as $key => $value){
								$class = $value['CLASS'];
								$sec   = $value['SEC'];
								$roll   = $value['ROLL_NO'];
								$date  = $Cdate;
								$attData  = $this->alam->selectA('stu_attendance_entry',"count(*)cnt,(SELECT count(att_status) FROM stu_attendance_entry WHERE att_status='P' AND class_code='$class' AND sec_code = '$sec' AND date(att_date)='$date')P,(SELECT count(att_status) FROM stu_attendance_entry WHERE att_status='A' AND class_code='$class' AND sec_code = '$sec' AND date(att_date)='$date')A,(SELECT emp_name FROM login_details WHERE Class_No='$class' AND Section_No='$sec' AND Class_tech_sts='1')empnm,(SELECT username FROM login_details WHERE Class_No='$class' AND Section_No='$sec' AND Class_tech_sts='1')usrnm","class_code='$class' AND sec_code = '$sec' AND date(att_date) = '$date'");
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
								<tr style='background:#c1eac1;'>
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
								<tr style='background:#f1d9d9;'>
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
    </div>
<br>

<script>
	$(".dataTable").dataTable({
		'ordering':false,
		footer: true,
		
        buttons: [
			 
			{
                extend: 'excelHtml5',
				title: 'Class-Sec wise Attendance Report',
                
            },
			 {
                extend: 'csvHtml5',
				title: 'Class-Sec wise Attendance Report',
                
            }, 
			{
                extend: 'pdfHtml5',
				title: 'Class-Sec wise Attendance Report',
                
            },
			
        ]
     });



</script>

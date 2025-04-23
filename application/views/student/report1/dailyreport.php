<br>
	<div class="employee-dashboard">
		<div class="row">
			<div class='col-sm-12'>
				<div class="table-responsive">
					<table class='table table-bordered table-striped dataTable'>
						<caption style="text-align: center;background: #337ab7;color: white;">Class Section Wise Attendance Status On Date (<?php echo date("d-M-Y"); ?>)</caption>
						<thead>
						   <tr>
						     <th style="background: #bac9e2;" class="text-center">Class</th>
						     <th style="background: #bac9e2;" class="text-center"> Section</th> 
						     <th style="background: #bac9e2;" class="text-center">Attendance Status</th> 
						     <th style="background: #bac9e2;" class="text-center">Total Present</th> 
						     <th style="background: #bac9e2;" class="text-center">Total Absent</th> 
						     <th style="background: #bac9e2;" class="text-center">Class Teacher</th> 
						   </tr>
						</thead>
						<tbody>
							<?php 
							foreach ($classSec as $key => $value){
								$class = $value['CLASS'];
								$sec   = $value['SEC'];
								$date  = $Cdate;
								$attData  = $this->alam->selectA('stu_attendance_entry_periodwise',"count(*)cnt,(SELECT count(att_status) FROM stu_attendance_entry_periodwise WHERE att_status='P' AND class_code='$class' AND sec_code = '$sec' AND date(att_date)='$date')P,(SELECT count(att_status) FROM stu_attendance_entry_periodwise WHERE att_status='A' AND class_code='$class' AND sec_code = '$sec' AND date(att_date)='$date')A,(SELECT emp_name FROM login_details WHERE Class_No='$class' AND Section_No='$sec')empnm","class_code='$class' AND sec_code = '$sec' AND date(att_date) = '$date'");
								$cnt   = $attData[0]['cnt'];
								$p     = $attData[0]['P'];
								$a     = $attData[0]['A'];
								$empnm = $attData[0]['empnm'];
								if($cnt != 0){
							?>
								<tr style='background:#c1eac1;'>
									<td><center><?php echo $value['DISP_CLASS']; ?></center></td>
									<td><center><?php echo $value['DISP_SEC']; ?></center></td>
									<td><center><i style='font-size:25px; color:green' class="fa fa-check" ></i></center></td>
									<td><center><?php echo $p; ?></center></td>
									<td><center><?php echo $a; ?></center></td>
									<td><center><?php echo $empnm; ?></center></td>
								</tr>
								<?php } else{ ?>
								<tr style='background:#f1d9d9;'>
									<td><center><?php echo $value['DISP_CLASS']; ?></center></td>
									<td><center><?php echo $value['DISP_SEC']; ?></center></td>
									<td><center><i style='font-size:25px; color:red' class="fa fa-times" ></i></center></td>
									<td><center><?php echo $p; ?></center></td>
									<td><center><?php echo $a; ?></center></td>
									<td><center><?php echo $empnm; ?></center></td>
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
		'ordering':false
	});
</script>
<br>
	<div class="employee-dashboard">
		<div class="row">
			<div class='col-sm-12'>
				<div class="table-responsive">
					<table class='table table-bordered table-striped'>
						<caption style="text-align: center;background: #337ab7;color: white;">Student Absentee Details</caption>
						<thead>
						   <tr>
						     <th style="background: #bac9e2;" class="text-center">Class - Section</th>
						     <th style="background: #bac9e2;" class="text-center">Total Student</th> 
						     <th style="background: #bac9e2;" class="text-center">Total</th> 
						     <th style="background: #bac9e2;" class="text-center">Boys</th>
						     <th style="background: #bac9e2;" class="text-center">Girls</th>
						   </tr>
						</thead>
						<tbody>
							<?php 
							$total_student = 0;$total_absent_att=0; $total_male = 0; $total_female = 0;
							foreach ($final_stu_att_data as $key => $value) { ?>
								<tr>
									<td class="text-center"><a href="<?php echo base_url('payroll/dashboard/principal_dashboard/totalStuAttendanceData/'.$value['CLASS'].'/'.$value['SEC'].'/'.$value['att_type'].'/'.$value['class_name'].'/'.$value['sec_name']); ?>"><?php echo $value['class_name'].' - '.$value['sec_name'];  ?></a></td>
									<td class="text-center"><?php echo $value['total_stu']; $total_student+=$value['total_stu']; ?></td>
									<td class="text-center"><?php echo $value['total_attendance'];  $total_absent_att+=$value['total_attendance']; ?></td>
									<td class="text-center"><?php echo $value['total_male_attendance'];  $total_male+=$value['total_male_attendance']; ?></td>
									<td class="text-center"><?php echo $value['total_female_attendance'];  $total_female+=$value['total_female_attendance']; ?></td>
								</tr>
							<?php } ?>
						</tbody>
						<tfoot>
							<tr>
								<th  style="background: #bac9e2;" class="text-center">GRAND TOTAL</th>
								<th  style="background: #bac9e2;" class="text-center"><?php echo $total_student; ?></th>
								<th  style="background: #bac9e2;" class="text-center"><?php echo $total_absent_att; ?></th>
								<th  style="background: #bac9e2;" class="text-center"><?php echo $total_male; ?></th>
								<th  style="background: #bac9e2;" class="text-center"><?php echo $total_female; ?></th>
							</tr>
						</tfoot>
				 	</table>
				</div>
			</div>
		</div>
    </div>
<br>
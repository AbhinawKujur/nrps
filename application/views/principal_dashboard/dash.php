 <?php
   $tot_employee = $employee[0]->tot_emp;
   $tot_present = count($emp_attendance);
   $tot_absent = $tot_employee - $tot_present;
 ?>
<div style="padding: 10px; background-color: white; border-top:3px solid #337ab7;">
<div class='row'>
	<div class="col-sm-12">
		<!--four-grids here-->
		<div class="four-grids">
			<a href="<?php echo base_url('payroll/dashboard/principal_dashboard/presentEmployee'); ?>">
				<div class="col-md-3 four-grid">
					<div class="four-agileits">
						<div class="icon">
							<i class="fa fa-users" aria-hidden="true"></i>
						</div><br>
						<div class="four-text" style="font-weight: bold;">
							<p>Total Employee : <?php echo $tot_employee; ?> </p>
							<p>Present Employee : <?php echo $tot_present; ?> </p>
							<p>Absent Employee : <?php echo $tot_absent; ?> </p>

						</div>
						
					</div>
				</div>
			</a>
			<a href="<?php echo base_url('payroll/dashboard/principal_dashboard/presentStudent'); ?>">
				<div class="col-md-3 four-grid">
					<div class="four-w3ls">
						<div class="icon">
							<i class="fa fa-male" aria-hidden="true"></i>
							<i class="fa fa-female" aria-hidden="true"></i>
						</div><br>
						<div class="four-text" style="font-weight: bold;">
							<p>Total Students : <?php echo count($student); ?> </p>
							<p>Present Students : <?php echo $tot_present_stu =  $totalStudentPresent['total_present_period_table']+$totalStudentPresent['total_present_daily_table']; ?> </p>
							<p>Absent Students : <?php echo count($student) - $tot_present_stu; ?> </p>
						</div>
					</div>
				</div>
			</a>
			<div class="clearfix"></div>
		</div>
		<!--//four-grids here-->
	</div>
</div>
<br><br>

</div><br /><br />

<style>
#menu ul li a.active{
    color: #ffffff !important;
    background-color: #5785c3 !important;
    border-left: 4px solid #4A4A4A !important;
}
/*.header-main {
    padding: 0;
    background: #5785c3;
}
.profile_details {
    float: left;
    width: 24.25%;
    background: #5785c3;
    text-align: center;
    padding: 0.3em 1em;
}*/
</style>
<!--/sidebar-menu-->

<noscript><h1>Your browser does not support JavaScript!</h1></noscript>
<script>
    document.addEventListener('keydown', function(event) {
		//For Monthly Calculation
        if (event.altKey && event.key === 'F1') {
			 <?php if(in_array('viewFeeHeadMaster', permission_data)){ ?>
			window.location.href="<?php echo site_url("Cmonthly_collection/month_collection")?>";
			<?php } ?>
        }
		//For Miscellaneous Calculation
        if (event.altKey && event.key === 'F2') {
			<?php if(in_array('viewFeeHeadMaster', permission_data)){ ?>
			window.location.href="<?php echo site_url("Fees_collection/misc_collection")?>";
			<?php } ?>
        }
		//For Collection without Adm. No.
        if (event.altKey && event.key === 'F3') {
			<?php if(in_array('viewFeeHeadMaster', permission_data)){ ?>
			window.location.href="<?php echo site_url("Fees_collection/collection_without_adm")?>";
			<?php } ?>
        }
		//For Student Information
        if (event.altKey && event.key === 's') {
			<?php if(in_array('viewFeeHeadMaster', permission_data)){ ?>
			window.location.href="<?php echo site_url("Student_details/student_master")?>";
			<?php } ?>
		}
    });
</script>

				<div class="sidebar-menu">
					<header class="logo1">
						<a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> 
					</header>
						<div style="border-top:1px ridge rgba(255, 255, 255, 0.15)"></div>
                           <div class="menu">
							<ul id="menu" >
							<!-- <?php if(in_array('viewPrincipalDashboard', permission_data) || in_array('viewEmpDashboard', permission_data)): ?>
								<li id="menu-academico" ><a href="#"><i class="fa fa-dashboard" aria-hidden="true"></i><span> Dashboard</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
								   <ul id="menu-academico-sub" >
								 <?php if(in_array('viewPrincipalDashboard', permission_data)){ ?>
								     <li><a class='' href="<?php echo base_url('payroll/dashboard/principal_dashboard'); ?>">Principal Dashboard</a></li>
								 <?php } ?>
								 <?php if(in_array('viewEmpDashboard', permission_data)){ ?>
								     <li><a class='' href="<?php echo base_url('payroll/dashboard/emp_dashboard'); ?>">Employee Dashboard</a></li>
								  <?php } ?>
								  </ul>
								</li>
							<?php endif; ?> -->

							<?php if(in_array('viewApplyLeave', permission_data) || in_array('viewLeaveApproval', permission_data)): ?>
								<li id="menu-academico" ><a href="#"><i class="fa fa-dashboard" aria-hidden="true"></i><span> My Desk</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
								   <ul id="menu-academico-sub" >
								 	<?php if(in_array('viewApplyLeave', permission_data)){ ?>
									     <li><a class='' href="<?php echo base_url('leave/applyleave'); ?>"> Apply Leave</a></li>
									<?php } ?>
								 	<?php if(in_array('viewLeaveApproval', permission_data)){ ?>
										 <li><a class='' href="<?php echo base_url('leave/Leaveapproval'); ?>"> Leave Approval</a></li>
									<?php } ?>
									<li><a class='' href="<?php echo base_url('payroll/dashboard/myattendance'); ?>"> My Attendance</a></li>
									  
										<li><a class='' href="<?php echo base_url('payroll/dashboard/dashboard/profile'); ?>"> Profile</a></li>
										<li><a class='' href="#" onclick="changePassword('<?php echo $this->session->userdata('user_id'); ?>')"> Change Password</a></li>
								  </ul>
								</li>
							<?php endif; ?>

								
								<?php //if(in_array('working', permission_data)): ?>
							<li id="menu-academico" ><a href="#"><i class="fa fa-clock-o" ></i><span>Reception </span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
								   <ul id="menu-academico-sub" >
									 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('reception/Visitortype_master') ?>">Visitor Type Master</a></li>
									 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('reception/Visitorpurpose_master') ?>">Visitor Purpose Master</a></li>
									<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('reception/Department_master') ?>"> Department Master</a></li>
									<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('reception/Visit_master') ?>"> Visit Master</a></li>
									<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('reception/Sysmode_master') ?>">Entry Mode Master</a></li>
									<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('reception/Visitreg_form') ?>">Visitor Form</a></li>
								  </ul>
								</li> 
						    <?php //endif; ?>
								
								
								
								
							<?php if(in_array('viewSchoolSetting', permission_data) || in_array('viewSession', permission_data)|| in_array('viewShift', permission_data)|| in_array('viewHoliday', permission_data)|| in_array('viewRole', permission_data)|| in_array('viewActiveMonth', permission_data)): ?>
								<li id="menu-academico" ><a href="#"><i class="fa fa-cogs" aria-hidden="true"></i><span> General Setting </span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
								   <ul id="menu-academico-sub" >
								   	<?php if(in_array('viewSchoolSetting', permission_data)){ ?>
									     <li><a class='' href="<?php echo base_url('school_master/setting'); ?>">School Setting</a></li>
									<?php } ?>
								 	<?php if(in_array('viewSession', permission_data)){ ?>
									     <li><a class='' href="<?php echo base_url('school_master/setting/sessionView'); ?>">Session Setting</a></li>
									<?php } ?>
								 	<?php if(in_array('viewHoliday', permission_data)){ ?>
									     <li><a class='' href="<?php echo base_url('holiday'); ?>">Holiday Master</a></li>
									<?php } ?>
								 	<?php if(in_array('viewRole', permission_data)){ ?>
									    <li><a href="<?php echo base_url('role_master/role'); ?>"> Role Setting</a></li> 
									<?php } ?>
								 	<?php if(in_array('viewActiveMonth', permission_data)){ ?>
									    <li><a class='' href="<?php echo base_url('school_master/setting/currentMonth'); ?>">Active Month For Payroll</a></li>
									<?php } ?>
								  </ul>
								</li> 
							<?php endif; ?>
							
							<?php if(in_array('viewEmployee', permission_data) || in_array('viewEmpAttendance', permission_data)|| in_array('viewDesignation', permission_data)|| in_array('viewQual', permission_data)|| in_array('viewLeaveType', permission_data)|| in_array('viewDisabledEmpList', permission_data)): ?>
								<li id="menu-academico" ><a href="#"><i class="fa fa-user" aria-hidden="true"></i><span> Human Resource </span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
								   <ul id="menu-academico-sub" >
								   	<?php if(in_array('viewDesignation', permission_data)){ ?>
										 <li><a class='' href="<?php echo base_url('payroll/master/designation'); ?>">Designation</a></li>					
									<?php } ?>
								 	<?php if(in_array('viewQual', permission_data)){ ?>				 
										 <li id="menu-academico-avaliacoes" ><a class='' href="<?php echo base_url('payroll/master/qualification'); ?>">Qualification</a></li>
									<?php } ?>
								 	<?php if(in_array('viewLeaveType', permission_data)){ ?>
										 <!-- <li id="menu-academico-avaliacoes" ><a class='' href="<?php echo base_url('payroll/master/leavetype'); ?>">Leave Type</a></li> -->
									<?php } ?>
									<?php if(in_array('viewShift', permission_data)){ ?>
									     <li><a class='' href="<?php echo base_url('shift_master/shiftgroup'); ?>">Shift Master</a></li>
									<?php } ?>
								 	<?php if(in_array('viewEmployee', permission_data)){ ?>
									     <li><a class='' href="<?php echo base_url('employee/employee'); ?>"> Employee List</a></li>
									<?php } ?>
								 	<?php if(in_array('viewEmpAttendance', permission_data)){ ?>
										 <li><a class='' href="<?php echo base_url('punching/manualpunch'); ?>">Daily Employee Attendance</a></li>
									<?php } ?>
								 	
								 	<?php if(in_array('viewDisabledEmpList', permission_data)){ ?>
										 <li><a class='' href="<?php echo base_url('employee/employee/disabledEmployeeList'); ?>"> Separated Employee List</a></li>
									<?php } ?>
								  </ul>
								</li>
							<?php endif; ?>	

							<?php if(in_array('viewSection', permission_data) || in_array('viewClass', permission_data)|| in_array('viewAssignSubjectTeacher', permission_data)|| in_array('viewAssignClassTeacher', permission_data)): ?>

								<li id="menu-academico" ><a href="#"><i class="fa fa-graduation-cap" aria-hidden="true"></i><span>Academics </span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
								  <ul id="menu-academico-sub" >
								  	<?php if(in_array('viewClass', permission_data)){ ?>
								    	<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Fees_master/class_master'); ?>">Class Master</a></li>
								    <?php } ?>
								 	<?php if(in_array('viewSection', permission_data)){ ?>
										<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Fees_master/section_master'); ?>">Section Master</a></li>
									  <li id="menu-academico-avaliacoes" >
									<a href="<?php echo base_url('timetable/assignclasswisesubject'); ?>">Class Wise Subject Allocation</a>
								</li>
									<?php } ?>
								 	<?php if(in_array('viewAssignClassTeacher', permission_data)){ ?>
								  		<li><a class='' href="<?php echo base_url('teacher/assign_class_teacher'); ?>">Assign Class Teacher</span><div class="clearfix"></div></a></li>
								
								  	<?php } ?>
								
									<?php if(in_array('viewAssignSubjectTeacher', permission_data)){ ?>
								  		<!--<li><a class='' href="<?php //echo base_url('teacher/Assign_subject_teacher'); ?>">Assign Subject Teacher</span><div class="clearfix"></div></a></li> -->
<li id="menu-academico-avaliacoes" >
									<a href="<?php echo base_url('timetable/subjectAllocation'); ?>">Allocate Subject Teacher for Class</a>
								</li>
								  	<?php } ?>
								 	
								  </ul>
								</li>								
							<?php endif; ?>

							<?php if(in_array('viewStudentMaster', permission_data) || in_array('viewScholarship', permission_data)|| in_array('viewHouseMaster', permission_data)|| in_array('viewCategoryMaster', permission_data)|| in_array('viewWardType', permission_data)|| in_array('viewReligion', permission_data)|| in_array('viewStudentRecordKeeping', permission_data)): ?>
								<li id="menu-academico" ><a href="#"><i class="fa fa-user" aria-hidden="true"></i><span> Student Information</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
								   <ul id="menu-academico-sub" >
								 	<?php if(in_array('viewHouseMaster', permission_data)){ ?>
									 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Fees_master/house_master') ?>">House Master</a></li>
									<?php } ?>
								 	<?php if(in_array('viewCategoryMaster', permission_data)){ ?>
									 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Fees_master/Category_master'); ?>">Category Master</a></li>
									<?php } ?>
								 	<?php if(in_array('viewWardType', permission_data)){ ?>
									 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Fees_master/ward_master') ?>">Ward Type Master</a></li>
									<?php } ?>
								 	<?php if(in_array('viewReligion', permission_data)){ ?>
									 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Fees_master/religion_master') ?>">Religion Master</a></li>
									<?php } ?>
								 	<?php if(in_array('viewStudentMaster', permission_data)){ ?>
									 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Student_details/student_master'); ?>">Student Master</a></li>
									   <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Disabledstudent/index'); ?>">Disabled Student</a></li>
									<?php } ?>
									
									<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Parentslogincredential/index'); ?>">Parents Login Credential</a></li>
								 	<?php if(in_array('viewScholarship', permission_data)){ ?>
									 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Student_details/Scholarship'); ?>">Scholarship</a></li>
									<?php } ?>
								 	<?php if(in_array('viewStudentRecordKeeping', permission_data)){ ?>
									 <li id="menu-academico-avaliacoes" ><a class='<?php if($first_part == 'stu_recored_keeping'){ echo "active"; } ?>' href="<?php echo base_url('Teacher_master/stu_recored_keeping'); ?>">Student Record Keeping</a></li>
									<?php } ?>
								  </ul>
								</li>
							<?php endif; ?>

							<?php if(in_array('viewDailyAttendance', permission_data) || in_array('viewDailyAttenReport', permission_data)|| in_array('viewMonthlyAttenReport', permission_data)|| in_array('viewStuAttenType', permission_data)|| in_array('viewStuAttenType', permission_data)|| in_array('viewStuAttenType', permission_data)): ?>
								<li id="menu-academico" ><a href="#"><i class="fa fa-calendar-check-o" aria-hidden="true"></i><span>Student Attendance</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
								  <ul id="menu-academico-sub" >
								  	<?php if(in_array('viewStuAttenType', permission_data)){ ?>

									 <li id="menu-academico-avaliacoes" ><a class='' href="<?php echo base_url('student/master/Student_attendance_type'); ?>">Student Attendance Type</a></li>
									<?php } ?>
								 	<?php if(in_array('viewDailyAttendance', permission_data)){ ?>
								     <li><a class='' href="<?php echo base_url('student/Student_attendance'); ?>">Daily Attendance</a></li>
								    <?php } ?>
								 	<?php if(in_array('viewDailyAttenReport', permission_data)){ ?>

								     <li><a class='' href="<?php echo base_url('student/report/Report/daily_wise'); ?>">Daily Attendance Report</a></li>
								    <?php } ?>
								 	<?php if(in_array('viewMonthlyAttenReport', permission_data)){ ?>
									 <li><a class='' href="<?php echo base_url('student/report/Report/monthly_wise'); ?>">Monthly Attendance Report</a></li>
									<?php } ?>
								 	<?php if(in_array('viewDailyAttendance', permission_data)){ ?>

									<li><a class='' href="<?php echo base_url('student/report/DailyReport'); ?>">Class Wise Attendance Sheet</a></li>		
									
									 		 <?php } ?>

								 	<?php if(in_array('viewDailyAttendance', permission_data)){ ?>
									 <!-- <li><a class='' href="<?php echo base_url('student/sms/Sms/sms_period_wise'); ?>">Absent Student Period Wise SMS</a></li> -->
									<?php } ?>
									<?php if(in_array('viewDailyAttenReport', permission_data)){ ?>

								     <li><a class='' href="<?php echo base_url('student/report/attendancepercentagereport'); ?>">Attendance Percentage Report</a></li>
								    <?php } ?>
								  </ul>
								</li>
							<?php endif; ?>

							<?php if(in_array('viewSchoolCollection', permission_data) || in_array('viewCanceReprintFeeReceipt', permission_data)|| in_array('cancelReprintBookReceipts', permission_data)|| in_array('transferCardSwipe', permission_data)|| in_array('viewFeeHeadMaster', permission_data)|| in_array('viewFeeGeneration', permission_data)|| in_array('viewLateFineMaster', permission_data)): ?>
								<li id="menu-academico" ><a href="#" title="Click For Fee Collection"><i class="fa fa-inr" aria-hidden="true"></i><span> Fees Collection</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
								   <ul id="menu-academico-sub" >
								   <?php if(in_array('viewFeeHeadMaster', permission_data)){ ?>
									 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Fees_master/fee_head_master'); ?>">Fee Head Master</a></li>
									<?php } ?>
									   <?php if (in_array('viewFeeHeadMaster', permission_data)) { ?>
							<li id="menu-academico-avaliacoes"><a href="<?php echo base_url('Cmonthly_collection/month_collection'); ?>">Monthly Fee Collection</a></li>
						<?php } ?>
									<?php if (in_array('viewFeeHeadMaster', permission_data)) { ?>
							<li id="menu-academico-avaliacoes"><a href="<?php echo base_url('Bank_collection/bank_collection'); ?>">Bank Collection</a></li>
						<?php } ?>

						<?php if (in_array('viewFeeHeadMaster', permission_data)) { ?>
							<li id="menu-academico-avaliacoes"><a href="<?php echo base_url('Fees_collection/misc_collection'); ?>">Miscellaneous Collection </a></li>
						<?php } ?>

						<?php if (in_array('viewFeeHeadMaster', permission_data)) { ?>
							<li id="menu-academico-avaliacoes"><a href="<?php echo base_url('Fees_collection/collection_without_adm'); ?>">Collection Without Admission </a></li>
						<?php } ?>
									<?php if(in_array('viewLateFineMaster', permission_data)){ ?>
									 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Late_finemaster/late_fine'); ?>">Late Fine Master</a></li>
									<?php } ?>
									<?php if(in_array('viewFeeGeneration', permission_data)){ ?>
									 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Feegeneration/fee_generation_gui'); ?>">Fee Generation</a></li>
									 <?php } ?>
								   
								 	<?php if(in_array('viewCanceReprintFeeReceipt', permission_data)){ ?>
									 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Cancel_reprint/cancel_reprintt'); ?>">Cancel/Re-Print Fee Receipts </a></li>
									<?php } ?>
								 	<?php if(in_array('cancelReprintBookReceipts', permission_data)){ ?>
									 <li id="menu-academico-avaliacoes" ><a href="icons.html">Cancel/Re-Print Book Receipts</a></li>
									<?php } ?>
								 	<?php if(in_array('transferCardSwipe', permission_data)){ ?>
									 <li id="menu-academico-avaliacoes" ><a href="icons.html">Transfer Cash Payment to Card Swipe</a></li>
									<?php } ?>
								 	
								 	
									 
								  </ul>
								</li>
							<?php endif; ?>
					
					

							<?php if(in_array('viewClassSubAllocation', permission_data) || in_array('viewStuSubAllocation', permission_data)|| in_array('viewMainSubject', permission_data)|| in_array('viewCoScholGrade', permission_data)|| in_array('viewDisciplineGrade', permission_data)||in_array('viewDisciGradeSkill', permission_data)|| in_array('viewRemarksAlloc', permission_data)|| in_array('viewMaxMarks', permission_data)): ?>
								<li id="menu-academico" ><a href="#"><i class="fa fa-pencil-square" aria-hidden="true"></i><span> Examination</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
								   <ul id="menu-academico-sub" >
								   
								   <li id="menu-academico-avaliacoes" ><a class='' href="<?php echo base_url('permission/PermissionMaxMarks'); ?>">Lock Exam</a></li>
								   
								   	<?php if(in_array('viewClassSubAllocation', permission_data)){ ?>
								  		<li><a class='<?php //if($first_part == 'clswise_subj_allco'){ echo "active"; } ?>' href="<?php echo base_url('Teacher_master/clswise_subj_allco'); ?>">Class-Wise Subject Allocation</span><div class="clearfix"></div></a></li>
									<?php } ?>

									<?php if(in_array('viewStuSubAllocation', permission_data)){ ?>
									 	<li id="menu-academico-avaliacoes" ><a class='<?php //if($first_part == 'stuwise_subj_allco'){ echo "active"; } ?>' href="<?php echo base_url('Teacher_master/stuwise_subj_allco'); ?>">Student-Wise Subject Allocation</a></li>
									<?php } ?>
									<?php if(in_array('viewMaxMarks', permission_data)){ ?>
										 <li id="menu-academico-avaliacoes" ><a class='<?php //if($first_part == 'max_marks_allco'){ echo "active"; } ?>' href="<?php echo base_url('Teacher_master/max_marks_allco'); ?>">Maximum Marks Allocation</a></li>
									<?php } ?>
									<?php if(in_array('viewMaxMarks', permission_data)){ ?>
										 <!--<li id="menu-academico-avaliacoes" ><a class='<?php //if($first_part == 'max_marks_allco'){ echo "active"; } ?>' href="<?php echo base_url('maxmarks/MaxmarksClasses'); ?>">Maximum Marks Allocation Junior</a></li>-->
									<?php } ?>
								 	<?php if(in_array('viewMainSubject', permission_data)){ ?>
								     	<li><a class='<?php //if($first_part == 'index'){ echo "active"; } ?>' href="<?php echo base_url('Marks_entry/index'); ?>">Main Subject</span><div class="clearfix"></div></a></li>
									<?php } ?>
									<?php if(in_array('viewMainSubject', permission_data)){ ?>
								     	<!--<li><a class='<?php //if($first_part == 'index'){ echo "active"; } ?>' href="<?php echo base_url('marksentry/MarksClasses'); ?>">Main Subject Junior</span><div class="clearfix"></div></a></li>-->
									<?php } ?>
								 	<?php if(in_array('viewCoScholGrade', permission_data)){ ?>
									 	<li id="menu-academico-avaliacoes" ><a class='' href="<?php echo base_url('Grade/index'); ?>">Co-Scholastic Grade Entry</a></li>
										<li id="menu-academico-avaliacoes" ><a class='' href="<?php echo base_url('Grade/co_scholastic_report_entry'); ?>">Co-Scholastic Grade Entry Report</a></li>
									<?php } ?>
									<?php if(in_array('viewCoScholGrade', permission_data)){ ?>
									 	<!--<li id="menu-academico-avaliacoes" ><a class='' href="<?php echo base_url('gradejunior/CoscholasticClasses'); ?>">Co-Scholastic Grade Entry Junior</a></li>-->
									<?php } ?>
								 	<?php if(in_array('viewDisciplineGrade', permission_data)){ ?>
										 <li id="menu-academico-avaliacoes" ><a class='' href="<?php echo base_url('Grade/discipline_term'); ?>">Discipline Grade</a></li>
									<?php } ?>
								 	<?php if(in_array('viewDisciGradeSkill', permission_data)){ ?>
										 <!--<li id="menu-academico-avaliacoes" ><a class='' href="<?php echo base_url('Grade/discipline_grade_skill_wise_term'); ?>">Discipline Grade Skill Wise</a></li>-->
									<?php } ?>
								 	<?php if(in_array('viewRemarksAlloc', permission_data)){ ?> 
										 <li id="menu-academico-avaliacoes" ><a class='' href="<?php echo base_url('Remarks/index'); ?>">Remarks Allocation</a></li>
									<?php } ?>
									<?php //if(in_array('viewRemarksAlloc', permission_data)){ ?> 
										 <!--<li id="menu-academico-avaliacoes" ><a class='' href="<?php echo base_url('promotion/Promotion'); ?>">Promotion List</a></li>-->
									<?php //} ?>
								  </ul>
								</li>		
							<?php endif; ?>						

							

							<?php if(in_array('viewPayControl', permission_data) || in_array('viewSecondShiftAttendance', permission_data)|| in_array('viewMonthlyEmpAtten', permission_data)|| in_array('viewPayslipGen', permission_data)|| in_array('viewPFESI', permission_data)|| in_array('addPFESI', permission_data)): ?>
								<li id="menu-academico" ><a href="#"><i class="fa fa-money" aria-hidden="true"></i><span> Payroll </span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
								   <ul id="menu-academico-sub" >
								   	<?php if(in_array('addPFESI', permission_data)){ ?>
									   	 <li id="menu-academico-avaliacoes" ><a class='' href="<?php echo base_url('payroll/master/pfesi/create'); ?>">Create PF ESI</a></li>
									<?php } ?>
								 	<?php if(in_array('viewPFESI', permission_data)){ ?>
										 <li id="menu-academico-avaliacoes" ><a class='' href="<?php echo base_url('payroll/master/pfesi'); ?>">View PF ESI</a></li>
									<?php } ?>

								 	<?php if(in_array('viewPayControl', permission_data)){ ?>
									     <li><a class='' href="<?php echo base_url('pay_control/paycontrol'); ?>"> Pay Control</a></li>
									<?php } ?>
								 	<?php if(in_array('viewSecondShiftAttendance', permission_data)){ ?>
									     <li><a class='' href="<?php echo base_url('payroll/salary/second_shift'); ?>"> Shift Attendance</a></li>
									<?php } ?>
									    <?php if(in_array('editAllowanceBulk', permission_data)){ ?>
									     <li><a class='' href="<?php echo base_url('bulk_updation/employeeallowance'); ?>"> Allowance Bulk</a></li>
									<?php } ?>
									<?php if(in_array('editDeductionBulk', permission_data)){ ?>
									     <li><a class='' href="<?php echo base_url('bulk_updation/employeededuction'); ?>"> Deduction Bulk</a></li>
									<?php } ?>
									   <?php if(in_array('editApprovalofArrearSalary', permission_data)){ ?>
									     <li><a class='' href="<?php echo base_url('payroll/salary/salincrement'); ?>"> Approval of Arrear Salary</a></li>
									<?php } ?>
									  
								 	<?php if(in_array('viewMonthlyEmpAtten', permission_data)){ ?>
									     <li><a class='' href="<?php echo base_url('payroll/salary/Attendance_gen'); ?>"> Monthly Attendance Generation</a></li>
									<?php } ?>
								 	<?php if(in_array('viewPayslipGen', permission_data)){ ?>
										 <li><a class='' href="<?php echo base_url('payroll/salary/payslip_gen'); ?>"> Payslip Generation</a></li>
									<?php } ?>
								 	
								  </ul>
								</li> 
							<?php endif; ?>


<?php if(in_array('viewHomework', permission_data) || in_array('viewUploadedHomeworkDetails', permission_data)): ?>		
							<li id="menu-academico" ><a href="#"><i class="fa fa-clipboard"></i><span> Class Assessment</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
			 <ul id="menu-academico-sub" >
          <?php if(in_array('viewHomework', permission_data)): ?>
          <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('onlineexam/teacher/exam_master/ExamMaster') ?>">Exam Master</a></li>
          <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('onlineexam/teacher/exam_schedule/ExamSchedule') ?>">Exam Schedule</a></li>
          <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('onlineexam/teacher/addquestion/AddExamQuestion') ?>">Add Question</a></li>
          <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('onlineexam/copy_correction/CopyCorrection/') ?>">Copy Correction</a></li>
<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('onlineexam/reports/Conso_correctionsheet') ?>">Copy Correction Status Summary Sheet</a></li>
 <li id='menu-academico-avaliacoes'><a href="<?php  echo base_url('onlineexam/reports/Schedule_report/schedulelist'); ?>">Exam Student Attendance Summary</a></li>
		  <li id='menu-academico-avaliacoes'><a href="<?php  echo base_url('onlineexam/reports/MarksReportstudent'); ?>">Objective Marksheet</a></li>
				 <li id='menu-academico-avaliacoes'><a href="<?php  echo base_url('onlineexam/reports/MarksReportstudentsubjectiv'); ?>">Subjective Marksheet</a></li>
				 <li id='menu-academico-avaliacoes'><a href="<?php  echo base_url('onlineexam/reports/MarksReportstudentsubj_obj'); ?>">(Subjective+Objective) Marksheet</a></li>
				  <li id='menu-academico-avaliacoes'><a href="<?php  echo base_url('onlineexam/reports/MarksReportstudentanskey'); ?>">Objective Tabulation Sheet</a></li>
				 <li id='menu-academico-avaliacoes'><a href="<?php  echo base_url('onlineexam/student_master/Student_details/stulist'); ?>">Exam Wise Student List</a></li>
				 
          <?php endif; ?>
        </ul>
								</li>  
						<?php endif; ?>
<!-- homework -->						
						
					<?php if(in_array('viewHomework', permission_data) || in_array('viewUploadedHomeworkDetails', permission_data)): ?>		
						<li id="menu-academico" ><a href="#"><i class="fa fa-book" ></i><span>E-Homework</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
							    <ul id="menu-academico-sub" >
									<?php if(in_array('viewHomework', permission_data)): ?>
									<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('e_exam/homework/AddHomework') ?>">Add Homework</a></li><?php endif; ?>
									<?php if(in_array('viewHomework', permission_data)): ?>
									<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('e_exam/homework/CopyCorrection') ?>">Homework Copy Correction</a></li><?php endif; ?>
									
									<?php if(in_array('viewHomework', permission_data)): ?>
									<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('e_exam/homework/HomeworkReport') ?>">Corrected Homework Copy</a></li><?php endif; ?>
						
									<?php if(in_array('viewHomework', permission_data)): ?>
									<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('e_exam/homework/HomeworkReport1') ?>"> Homework Summary Status</a></li><?php endif; ?>
							
									<?php if(in_array('viewHomework', permission_data)): ?>
									<!--<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('e_exam/homework/LateHomeworkSubmission') ?>"> Homework Late  Submission</a></li>--><?php endif; ?>
									
									
							    </ul>
							</li>  
					<?php endif; ?>

<!-- add homework -->

							<!--<?php //if(in_array('working', permission_data)): ?>
								<li id="menu-academico" ><a href="#"><i class="fa fa-truck" aria-hidden="true"></i><span> Transport Management </span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
								   <ul id="menu-academico-sub" >
									 <li id="menu-academico-avaliacoes" ><a href="<?php //echo base_url('Bus_master_add/bus_details') ?>">Vehicle Master</a></li>
									 <li id="menu-academico-avaliacoes" ><a href="<?php //echo base_url('Bus_incharge_entry/bus_incharge') ?>">Vehicle Incharge</a></li>
									 <li id="menu-academico-avaliacoes" ><a href="<?php //echo base_url('Fees_master/Bus_Stoppage_Master') ?>">Bus Stoppage Master</a></li>
									 <li id="menu-academico-avaliacoes" ><a href="<?php //echo base_url('Bus_trip_master/index') ?>">Add Bus Trip</a></li>
									 <li id="menu-academico-avaliacoes" ><a href="<?php //echo base_url('Driver_master/index') ?>">Driver Master</a></li>
								  </ul>
								</li> 
							<?php //endif; ?>-->	
							
							<?php if(in_array('viewVehicleMaster', permission_data) || in_array('viewVehicleIncharge', permission_data) || in_array('viewBusStoppageMaster', permission_data) || in_array('viewAddBusTrip', permission_data) || in_array('viewDriverMaster', permission_data) || in_array('viewAddBusRoute', permission_data)): ?>
								<li id="menu-academico" ><a href="#"><i class="fa fa-truck" aria-hidden="true"></i><span> Transport Management </span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
								   <ul id="menu-academico-sub" >
								   <?php if(in_array('viewVehicleMaster', permission_data)){ ?>
									 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Bus_master_add/bus_details') ?>">Vehicle Master</a></li>
									 <?php } ?>
									 <?php if(in_array('viewVehicleIncharge', permission_data)){ ?>
									 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Bus_incharge_entry/bus_incharge') ?>">Vehicle Incharge</a></li>
									 <?php } ?>
									 <?php if(in_array('viewBusStoppageMaster', permission_data)){ ?>
									 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Fees_master/Bus_Stoppage_Master') ?>">Bus Stoppage Master</a></li>
									 <?php } ?>
									  <?php if(in_array('viewAddBusTrip', permission_data)){ ?>
									  <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Bus_trip_master/index') ?>">Add Bus Trip</a></li>
									  <?php } ?>
									  <?php if(in_array('viewDriverMaster', permission_data)){ ?>
									  <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Driver_master/index') ?>">Driver Master</a></li>
									   <?php } ?>
									   <?php if(in_array('viewAddBusRoute', permission_data)){ ?>
									  <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Add_bus_route/index') ?>">Add Bus Route</a></li>
									  <?php } ?>
									   
									   <li id="menu-academico-avaliacoes"><a href="<?php echo base_url('Bus_report/show_report') ?>">Bus Reports</a></li>
									   
									  <!--<li id="menu-academico-avaliacoes"><a href="<?php //echo base_url('Studentrouteallocation/index') ?>">Student Route Allocation</a></li>-->
								  </ul>
								</li> 
							<?php endif; ?>	
							
							
							<?php if(in_array('viewBankSalaryLetter', permission_data) || in_array('viewSalaryBill', permission_data)|| in_array('viewMonthlyPFReport', permission_data)|| in_array('viewPfEsiStatement', permission_data)|| in_array('viewMonthlySalarySlip', permission_data)|| in_array('viewEMployeeReport', permission_data) || in_array('viewMonthlyLeaveReport', permission_data)|| in_array('viewMonthlyAttenReports', permission_data)|| in_array('viewAllowanceReport', permission_data)|| in_array('viewYearlySalaryReport', permission_data)|| in_array('viewDeductionReport', permission_data)): ?>
								<li id="menu-academico" ><a href="#" title="Reports"><i class="fa fa-money" aria-hidden="true"></i><span> Salary Reports</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
								   <ul id="menu-academico-sub" >
								   	<?php if(in_array('viewEMployeeReport', permission_data)){ ?>
										 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('payroll_other_report/designationreport'); ?>">Employee List</a></li>
									<?php } ?>
								   	<?php if(in_array('viewMonthlyAttenReports', permission_data)){ ?>
										 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('payroll_other_report/attendance_report'); ?>">Attendance Register</a></li>
									<?php } ?>
									<?php if(in_array('viewMonthlyLeaveReport', permission_data)){ ?>
										 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('payroll_other_report/leavereport/monthWiseLeaveReport'); ?>">Monthly Leave</a></li>
									<?php } ?>
								   	<?php if(in_array('viewSalaryBill', permission_data)){ ?>
										<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('salary_report/salary_bill'); ?>">Salary Bill</a></li>
									<?php } ?>
									
								 	<?php if(in_array('viewBankSalaryLetter', permission_data)){ ?>
										<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('salary_report/bank_letter'); ?>">Bank Salary Letter</a></li>
									<?php } ?>
									
									<?php if(in_array('viewBankSalaryLetter', permission_data)){ ?>
										<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('salary_report/groupinsreport'); ?>">Group Insurance Report</a></li>
									<?php } ?>

									<?php if(in_array('viewBankSalaryLetter', permission_data)){ ?>
										<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('salary_report/licreport'); ?>">LIC Report</a></li>
									<?php } ?>
									
									<?php if(in_array('viewMonthlyPFReport', permission_data)){ ?>
										<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('salary_report/monthlypf_report'); ?>">Monthly PF</a></li>
									<?php } ?>
									<?php if(in_array('viewPfEsiStatement', permission_data)){ ?>
										<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('salary_report/pfstatement'); ?>"> Monthly PF &amp; ESI Statement Employee Wise</a></li>
									<?php } ?>
									<?php if(in_array('viewAllowanceReport', permission_data)){ ?>
										 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('payroll_other_report/allowance_report'); ?>">Monthly Allowance</a></li>
									<?php } ?>
									<?php if(in_array('viewDeductionReport', permission_data)){ ?>
										 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('payroll_other_report/deduction_report'); ?>">Monthly Deduction</a></li>
									<?php } ?>
									<?php if(in_array('viewMonthlySalarySlip', permission_data)){ ?>
										<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('salary_report/monthly_salary_slip'); ?>">Monthly Salary Slip</a></li>
									<?php } ?>
									<?php if(in_array('viewYearlySalaryReport', permission_data)){ ?>
										 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('payroll_other_report/yearly_salary_report'); ?>">Annual Salary Statement</a></li>
									<?php } ?>
									<?php if(in_array('viewYearlySalaryReport', permission_data)){ ?>
										 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('salary_report/form16'); ?>">Form 16</a></li>
									<?php } ?>
									
								  </ul>
								</li>
							<?php endif; ?>	
						<?php //if(in_array('working', permission_data)): ?>
							<li id="menu-academico" ><a href="#"><i class="fa fa-book" ></i><span> Library Master </span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
								   <ul id="menu-academico-sub" >
									 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('library/RackMaster') ?>">Almirah Master</a></li>
									 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('library/BookTypeMaster') ?>">Book Type Master</a></li>
									 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('library/BookMaster') ?>"> Book Master</a></li>
									 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('library/NewsMagazineMaster') ?>"> News Paper/Magazine Master</a></li>
									    <li><a class='' href="<?php echo base_url('library/TeacherBookIssue/teacher_adv_book_issue'); ?>">Employee Advance Book Issue</a></li>
										
									 
									  <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('library/NewsMagazineMaster/Journal_Entry') ?>"> News Paper Journal Entry</a></li>
									  
								  </ul>
								</li> 
						<?php //endif; ?>
						<?php //if(in_array('working', permission_data)): ?>
							<li id="menu-academico" ><a href="#"><i class="fa fa-book" ></i><span> Book Issue </span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
								   <ul id="menu-academico-sub" >
									 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('library/StudentBookIssue') ?>">Student Book Issue</a></li>
									 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('library/StudentBookReturn') ?>">Student Book Return</a></li>
									 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('library/TeacherBookIssue') ?>"> Teacher Book Issue</a></li>
									 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('library/TeacherBookReturn') ?>"> Teacher Book Return</a></li>
								  </ul>
								</li> 
						<?php //endif; ?>
						<?php //if(in_array('working', permission_data)): ?>
							<li id="menu-academico" ><a href="#"><i class="fa fa-book" ></i><span> Library Report </span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
								     <ul id="menu-academico-sub" >
									 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('library/LibraryReport') ?>"> Book Issue Report Student</a></li>
									  <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('library/LibraryReport/book_report_emp') ?>"> Book Issue Report Employee</a></li>
										 					<li id="menu-academico-avaliacoes"><a href="<?php echo base_url('library/LibraryReport/book_report_sts') ?>"> Book Issue Status Report</a></li>
									 <li id="menu-academico-avaliacoes"><a href="<?php echo base_url('library/LibraryReport/BookReturnRpt') ?>">Book Returned Report</a></li>
									  <li id="menu-academico-avaliacoes"><a href="<?php echo base_url('library/LibraryReport/BookReturnRpt') ?>">Book Returned Report Employee</a></li>
									 	<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('library/LibraryReport/BookStockReg') ?>"> Book Stock Register</a></li>
									<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('library/LibraryReport/BookStockReg_bw_lost') ?>"> Book Lost & Damage</a></li>
										<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('library/NewsMagazineMaster/newspaper_report') ?>"> News Paper Report</a></li>
										<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('library/LibraryReport/BookStockReg_bw') ?>"> Book Wise Stock Register</a></li>
									<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('library/Barcode') ?>"> Book Barcode</a></li>
										 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('library/RackMaster/newAlmirahMaster') ?>">Almirah Wise Report</a></li>
								  </ul>
								</li> 
						<?php // endif; ?>
						
						<?php if(in_array('viewNotice', permission_data) || in_array('viewSentNoticeDetails', permission_data) || in_array('viewNoticeP', permission_data) || in_array('viewNoticeReportP', permission_data)): ?>
								<li id="menu-academico" ><a href="#"><i class="fa fa-bell-o" ></i><span> Notice</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
								 <ul id="menu-academico-sub" >
								   	<?php if(in_array('viewNotice', permission_data)): ?>
									 	<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('notice/AddNotice') ?>">Add/View Notice/</a></li>
									<?php endif; ?>
									<?php if(in_array('viewNoticeP', permission_data)): ?>
										<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('notice/AddNoticePrincipal') ?>">Add/View Notice </a></li>
									<?php endif; ?>
									<?php if(in_array('viewSentNoticeDetails', permission_data)): ?>
										<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('notice/NoticeReport') ?>">Notice Report Details</a></li>
									<?php endif; ?>
								  </ul>
								</li> 
						<?php endif; ?>
						
				<?php if(in_array('viewHomework', permission_data) || in_array('viewUploadedHomeworkDetails', permission_data)): ?>		

								<li id="menu-academico" ><a href="#"><i class="fa fa-envelope-open"></i><span> Leave</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
								  <ul id="menu-academico-sub" >
									 <li id="menu-academico-avaliacoes" ><a href="<?php //echo base_url('stu_leave/StuLeave') ?>">Student Leave</a></li>
								  </ul>
								</li>
						<?php endif; ?>



					<?php if(in_array('viewHomework', permission_data) || in_array('viewUploadedHomeworkDetails', permission_data)): ?>		
								<li id="menu-academico" ><a href="#"><i class="fa fa-clipboard"></i><span> e-Learning</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
								   <ul id="menu-academico-sub" >
								   	<?php if(in_array('viewHomework', permission_data)): ?>
									<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('e_learning/TopicChapterMaster') ?>">Chapter/Topic Master</a></li>
									
									<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('e_learning/Elearning') ?>">Upload/View e-Content</a></li>
									 
									<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('e_learning/Elearning/studentQueries') ?>">Discussion Room</a></li>
									<?php endif; ?>
								  </ul>
								</li> 
						<?php endif; ?>


							<?php if(in_array('viewFeeReports', permission_data) || in_array('viewFeeDefaulterList', permission_data)|| in_array('viewFeeHeadWiseDefaulter', permission_data)|| in_array('viewClassReport', permission_data)|| in_array('viewOtherReport', permission_data)|| in_array('viewAdmitCard', permission_data)|| in_array('viewTermWiseReportCard', permission_data) || in_array('viewStudentReport', permission_data)): ?>
								<li id="menu-academico" ><a href="#" title="Reports"><i class="fa fa-file" aria-hidden="true"></i><span> Reports</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
								   <ul id="menu-academico-sub" >
								 	<?php if(in_array('viewFeeReports', permission_data)){ ?>
										 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Report/typeofreports'); ?>" title="Click For Reports">Fee Reports</a></li>
									<?php } ?>
								 	<?php if(in_array('viewFeeDefaulterList', permission_data)){ ?>
										<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Report/Fee_Defaulter_List'); ?>">Fee Defaulter List</a></li>
									<?php } ?>
									   
									   <!-- new 30/05/2023 -->
									<?php if(in_array('viewFeeDefaulterList', permission_data)){ ?>
										<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Report/Fee_Paid_List'); ?>">Fee Paid List</a></li>	
									<?php } ?>
									   
								 	<?php if(in_array('viewFeeHeadWiseDefaulter', permission_data)){ ?>
										<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Report/Fee_head_Defaulter_List'); ?>">Fee Head Wise Defaulter List</a></li>
									<?php } ?>
									   <?php if (in_array('viewFeeHeadWiseDefaulter', permission_data)) { ?>
							<li id="menu-academico-avaliacoes"><a href="<?php echo base_url('Adm_form_sale/adm_form_sale'); ?>">Admission Form Sales Report</a></li>
						<?php } ?>

						<?php if (in_array('viewFeeHeadWiseDefaulter', permission_data)) { ?>
							<li id="menu-academico-avaliacoes"><a href="<?php echo base_url('List_of_Receipt/list_of_rct'); ?>">List Of Receipt Report</a></li>
						<?php } ?>
								 	<?php if(in_array('viewClassReport', permission_data)){ ?>
										<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Class_report/show_class'); ?>">Class Report</a></li>
									<?php } ?>
									   <?php if (in_array('viewClassReport', permission_data)) { ?>
							<li id="menu-academico-avaliacoes"><a href="<?php echo base_url('Ward_report/ward_report'); ?>">Ward Category Report</a></li>
						<?php } ?>
									<?php if(in_array('viewStudentReport', permission_data)){ ?>
									<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Student_report/show_studentpanel'); ?>">Student Report</a></li>
									<?php } ?>
								 	<?php if(in_array('viewOtherReport', permission_data)){ ?>
										<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Other_report/show_other_report'); ?>">Other Report</a></li>
									<?php } ?>
								 	<?php if(in_array('viewAdmitCard', permission_data)){ ?>
										<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Card/show_other_report'); ?>">Card (Admit Id)</a></li>
									<?php } ?>
									   
									   <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Report/pre_Fee_Defaulter_List_reman'); ?>">Previous Year Remaining Defaulter</a></li>
									   
									   
									    <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Student_strength/show_strenght_religion'); ?>">Religion Strength Report</a></li>
									   
								 	<?php if(in_array('viewTermWiseReportCard', permission_data)){ ?>
										<li><a class='' href="<?php echo base_url('report_card/Report_card/index'); ?>">Term Wise Report Card</span><div class="clearfix"></div></a></li>
										<li><a class='' href="<?php echo base_url('report_card/Annual_report_card'); ?>">Annual Report Card</span><div class="clearfix"></div></a></li>
										<!--<li><a class='' href="<?php echo base_url('report_card/Annual_report_card_classes'); ?>">Annual Report Card Junior</span><div class="clearfix"></div></a></li>-->
									<?php } ?>
								  </ul>
								</li>
							<?php endif; ?>	


						<?php if(in_array('viewTransferCertificate', permission_data) || in_array('viewCancelReprintTC', permission_data)|| in_array('viewCharacterCertificate', permission_data)|| in_array('viewBonafideCertificate', permission_data)|| in_array('viewDOBCertificate', permission_data)|| in_array('viewTutionFeeCertificate', permission_data)|| in_array('viewFeePaidCertificate', permission_data)): ?>

							<li id="menu-academico" ><a href="#" title="Certificate"><i class="fa fa-address-card" aria-hidden="true"></i><span> Certificate</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
								   <ul id="menu-academico-sub" >
								   	<?php if(in_array('viewTransferCertificate', permission_data)){ ?>
										 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Certificate/transfer_certificate'); ?>" title="Click For Tc">Transfer Certificate (TC)</a></li>
									<?php } ?>
								 	<?php if(in_array('viewCancelReprintTC', permission_data)){ ?>
										<li id="menu-academico-avaliacoes" ><a title="Click For Reprint Cancel TC" href="<?php echo base_url('Certificate/cancel_reprint_tc'); ?>">Cancel Reprint TC</a></li>
									<?php } ?>
								 	<?php if(in_array('viewCharacterCertificate', permission_data)){ ?>
										<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Certificate/char_show'); ?>">Character Certificate</a></li>
									<?php } ?>
								 	<?php if(in_array('viewBonafideCertificate', permission_data)){ ?>
										<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Bonafide_certificate/show_bonafide'); ?>">Bonafide Certificate</a></li>
									<?php } ?>
								 	<?php if(in_array('viewDOBCertificate', permission_data)){ ?>
										<li><a class='' href="<?php echo base_url('Date_of_birth_certificate/show_dob'); ?>">Date of Birth Certificate</span><div class="clearfix"></div></a></li>
									<?php } ?>
								 	<?php if(in_array('viewTutionFeeCertificate', permission_data)){ ?>
										<li><a class='' href="<?php echo base_url('Tution_fee_certificate/show_tution'); ?>">Tution Fee Certificate</span><div class="clearfix"></div></a></li>
									<?php } ?>
								 	<?php if(in_array('viewFeePaidCertificate', permission_data)){ ?>
										<li><a class='' href="<?php echo base_url('Fee_paid_all_certificate/show_tution'); ?>">Fee Paid(All) Certificate</span><div class="clearfix"></div></a></li>
									<?php } ?>
								  </ul>
								</li>
						<?php endif; ?>

						<?php 
						if(in_array('viewNarration', permission_data) || in_array('viewAccountGroup', permission_data) ||in_array('viewLedgerMaster', permission_data)||in_array('viewSchoolGroup', permission_data)):
						 ?>
							<li id="menu-academico" ><a href="#"><i class="fa fa-address-card" aria-hidden="true"></i><span> Account Master</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
							   <ul id="menu-academico-sub" >
							   	<?php if(in_array('viewNarration', permission_data)){ ?>
									<li id="menu-academico-avaliacoes" >
										<a href="<?php echo base_url('account_master/narration'); ?>">Narration</a>
									</li>
								<?php } ?>
								<?php if(in_array('viewAccountGroup', permission_data)){ ?>
									<li id="menu-academico-avaliacoes" >
										<a href="<?php echo base_url('account_master/accountgroup'); ?>">Account Group</a>
									</li>
								<?php } ?>
								<?php if(in_array('viewSchoolGroup', permission_data)){ ?>
									<li id="menu-academico-avaliacoes" >
										<a href="<?php echo base_url('account_master/schoolgroup'); ?>">School Group</a>
									</li>
								<?php } ?>
								<?php if(in_array('viewLedgerMaster', permission_data)){ ?>
									<li id="menu-academico-avaliacoes" >
										<a href="<?php echo base_url('account_master/ledgermaster'); ?>">Ledger Master</a>
									</li>
								<?php } ?>
							  </ul>
							</li>
						<?php endif; ?>

						<?php 
						if(in_array('viewReceiptVoucherCounterCollection', permission_data) || in_array('viewReceiptVoucherOnlineCollection', permission_data) ||in_array('viewGeneralEntry', permission_data) || in_array('viewUpdateVoucher', permission_data) || in_array('viewPrintVoucher', permission_data) ||in_array('viewCancelVoucher', permission_data)):
						 ?>
							<li id="menu-academico" ><a href="#"><i class="fa fa-file" aria-hidden="true"></i><span> Voucher Entry</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
							   <ul id="menu-academico-sub" >
							   	<?php if(in_array('viewReceiptVoucherCounterCollection', permission_data)){ ?>
									<li id="menu-academico-avaliacoes" >
										<a href="<?php echo base_url('account_master/voucherentryfee'); ?>">Receipt Voucher (Counter Collection)</a>
									</li>
								<?php } ?>
								<?php if(in_array('viewReceiptVoucherOnlineCollection', permission_data)){ ?>
									<li id="menu-academico-avaliacoes" style="border-bottom: 2px solid #997774;" >
										<a href="<?php echo base_url('account_master/voucherentryonlinefee'); ?>">Receipt Voucher (Online Collection)</a></li>
								<?php } ?>
								<?php if(in_array('viewGeneralEntry', permission_data)){ ?>
									<li id="menu-academico-avaliacoes" >
										<a href="<?php echo base_url('account_master/voucherentry'); ?>">General Entry</a>
									</li>
								<?php } ?>
								<?php if(in_array('viewUpdateVoucher', permission_data)){ ?>
									<li id="menu-academico-avaliacoes" >
										<a href="<?php echo base_url('account_master/voucherentry/voucherView'); ?>">Update Voucher</a>
									</li>
								<?php } ?>
								<?php if(in_array('viewPrintVoucher', permission_data)){ ?>
									<li id="menu-academico-avaliacoes" >
										<a href="<?php echo base_url('account_master/printvoucher'); ?>">Print Voucher</a>
									</li>
								<?php } ?>
								<?php if(in_array('viewCancelVoucher', permission_data)){ ?>
									<li id="menu-academico-avaliacoes" >
										<a href="<?php echo base_url('account_master/cancelvoucher'); ?>">Cancel Voucher</a>
									</li>
								<?php } ?>
							  </ul>
							</li>
						<?php endif; ?>

						<?php 
						if(in_array('viewCashBook', permission_data) || in_array('viewLedger', permission_data) ||in_array('viewTrialBalance', permission_data) || in_array('viewTrialBalanceinSeparateColumn', permission_data) || in_array('viewTrialBalanceMonthly', permission_data) ||in_array('viewLedgerWiseEntryPassed', permission_data)):
						 ?>
							<li id="menu-academico" ><a href="#"><i class="fa fa-file-pdf-o" aria-hidden="true"></i><span> Accounts Report</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
							   <ul id="menu-academico-sub" >
								<?php if(in_array('viewCashBook', permission_data)){ ?>
							   		<li id="menu-academico-avaliacoes" >
										<a href="<?php echo base_url('accounts_report/cashbookreport'); ?>">Cash Book</a>
									</li>
								<?php } ?>
								<?php if(in_array('viewLedger', permission_data)){ ?>
									<li id="menu-academico-avaliacoes" >
										<a href="<?php echo base_url('accounts_report/ledgerreport'); ?>">Ledger</a>
									</li>
								<?php } ?>
								<?php if(in_array('viewTrialBalance', permission_data)){ ?>
									<li id="menu-academico-avaliacoes" >
										<a href="<?php echo base_url('accounts_report/trialbalancereport'); ?>">Trial Balance</a>
									</li>
								<?php } ?>
								<?php if(in_array('viewTrialBalanceinSeparateColumn', permission_data)){ ?>
									<li id="menu-academico-avaliacoes" >
										<a href="<?php echo base_url('accounts_report/trialbalancereport/separateColumn'); ?>">Trial Balance (OB) in Separate Column</a>
									</li>
								<?php } ?>
								<?php if(in_array('viewTrialBalanceMonthly', permission_data)){ ?>
									<li id="menu-academico-avaliacoes" >
										<a href="<?php echo base_url('accounts_report/trialbalancereport/monthlyReport'); ?>">Trial Balance (Monthly)</a>
									</li>
								<?php } ?>
								<?php if(in_array('viewLedgerWiseEntryPassed', permission_data)){ ?>
									<li id="menu-academico-avaliacoes" >
										<a href="<?php echo base_url('accounts_report/ledgerreport/ledgerPassedReport'); ?>">Ledger Wise Entry Passed</a>
									</li>
								<?php } ?>									
							  </ul>
							</li>
						<?php endif; ?>

						<?php 
						if(in_array('viewDepartment', permission_data) || in_array('viewSupplier', permission_data) ||in_array('viewItemGroup', permission_data) || in_array('viewItemMaster', permission_data)):
						 ?>
							<li id="menu-academico" ><a href="#"><i class="fa fa-address-card" aria-hidden="true"></i><span> Inventory Master</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
							   <ul id="menu-academico-sub" >
								<?php if(in_array('viewDepartment', permission_data)){ ?>
									<li id="menu-academico-avaliacoes" >
										<a href="<?php echo base_url('inventory_master/department'); ?>">Department</a>
									</li>
								<?php } ?>
								<?php if(in_array('viewSupplier', permission_data)){ ?>
									<li id="menu-academico-avaliacoes" >
										<a href="<?php echo base_url('inventory_master/supplier'); ?>">Supplier</a>
									</li>
								<?php } ?>
								<?php if(in_array('viewItemGroup', permission_data)){ ?>
									<li id="menu-academico-avaliacoes" >
										<a href="<?php echo base_url('inventory_master/itemgroup'); ?>">Item Group</a>
									</li>
								<?php } ?>
								<?php if(in_array('viewItemMaster', permission_data)){ ?>
									<li id="menu-academico-avaliacoes" >
										<a href="<?php echo base_url('inventory_master/itemmaster'); ?>">Item Master</a>
									</li>
								<?php } ?>
							  </ul>
							</li>
						 <?php
						 endif;
						  ?> 
						
						<?php 
						if(in_array('viewEmployeeLeave', permission_data) || in_array('viewStudentDetails', permission_data)):
						 ?>
						<li id="menu-academico" ><a href="#"><i class="fa fa-globe"></i><span> Bulk Updation</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
						   <ul id="menu-academico-sub" >
							<?php if(in_array('viewEmployeeLeave', permission_data)){ ?>
								<li id="menu-academico-avaliacoes" >
									<a href="<?php echo base_url('bulk_updation/employeeleave'); ?>">Employee Leave</a>
								</li>
							<?php } ?>
							<?php if(in_array('viewStudentDetails', permission_data)){ ?>
								<li id="menu-academico-avaliacoes" >
									<a href="<?php echo base_url('bulk_updation/Studentdetails'); ?>">Student Details</a>
								</li>
							<?php } ?>
							   <?php if(in_array('viewStudentDetails', permission_data)){ ?>
								<li id="menu-academico-avaliacoes" >
									<a href="<?php echo base_url('bulk_updation/Classsecwise'); ?>">Class Sec Wise</a>
								</li>
							<?php } ?>
						  </ul>
						</li>
					<?php endif; ?> 
					<?php //if(in_array('working', permission_data)): ?>
						<li id="menu-academico" ><a href="#"><i class="fa fa-envelope-o"></i><span> SMS</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
						   <ul id="menu-academico-sub" >
								<li id="menu-academico-avaliacoes" >
									<a href="<?php echo base_url('sms/Compose_msg'); ?>">Compose Message</a>
								</li>
								<li id="menu-academico-avaliacoes" >
									<a href="<?php echo base_url('sms/Inbox'); ?>">Inbox</a>
								</li>
								<li id="menu-academico-avaliacoes" >
									<a href="#">Sent Message</a>
								</li>
						  </ul>
						</li>
					<?php //endif; ?> 
					
					<!--<?php //if(in_array('working', permission_data)): ?>
						<li id="menu-academico" ><a href="#"><i class="fa fa-clock-o"></i><span> Timetable</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
						   <ul id="menu-academico-sub" >
								<li id="menu-academico-avaliacoes" >
									<a href="<?php echo base_url('timetable/assignclasswisesubject'); ?>">Class Wise Subject Allocation</a>
								</li>
								<li id="menu-academico-avaliacoes" >
									<a href="<?php echo base_url('timetable/campusmaster'); ?>">Campus Master</a>
								</li>
								<li id="menu-academico-avaliacoes" >
									<a href="<?php echo base_url('timetable/buildingmaster'); ?>">Building Master</a>
								</li>
								<li id="menu-academico-avaliacoes" >
									<a href="<?php echo base_url('timetable/floormaster'); ?>">Floor Master</a>
								</li>
								<li id="menu-academico-avaliacoes" >
									<a href="<?php echo base_url('timetable/floorclassdistribution'); ?>">Floor Class Distribution</a>
								</li>
								<li id="menu-academico-avaliacoes" >
									<a href="<?php echo base_url('timetable/subjectAllocation'); ?>">Allocate Subject Teacher for Class</a>
								</li>
						  </ul>
						</li>
					<?php //endif; ?> 

					<?php //if(in_array('working', permission_data)): ?>
						<li id="menu-academico" ><a href="#"><i class="fa fa-clock-o"></i><span> Timetable Report</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
						   <ul id="menu-academico-sub" >
								<li id="menu-academico-avaliacoes" >
									<a href="<?php echo base_url('timetable_report/timetablereport/teacherDetailsAllotedPeriod'); ?>">Teacher Details With Alloted Period</a>
								</li>
								<li id="menu-academico-avaliacoes" >
									<a href="<?php echo base_url('timetable_report/timetablereport/teacherWiseSubjectAllocation'); ?>">Teacher Wise Class and Section Subject Alloted Details</a>
								</li>
								<li id="menu-academico-avaliacoes" >
									<a href="<?php echo base_url('timetable_report/timetablereport/subjectWiseAllocatedTeacher'); ?>">Subject Wise Teacher</a>
								</li>
						  </ul>
						</li>
					<?php //endif; ?>
					
					
					<?php if(in_array('working', permission_data)): ?>
						<li id="menu-academico" ><a href="#"><i class="fa fa-clock-o"></i><span> Time Table</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
						   <ul id="menu-academico-sub" >
								<li id="menu-academico-avaliacoes" >
									<a href="<?php echo base_url('timetable/assignclasswisesubject'); ?>">Class Wise Subject Allocation</a>
								</li>
								<li id="menu-academico-avaliacoes" >
									<a href="<?php echo base_url('timetable/campusmaster'); ?>">Campus Master</a>
								</li>
								<li id="menu-academico-avaliacoes" >
									<a href="<?php echo base_url('timetable/buildingmaster'); ?>">Building Master</a>
								</li>
								<li id="menu-academico-avaliacoes" >
									<a href="<?php echo base_url('timetable/floormaster'); ?>">Floor Master</a>
								</li>
								<li id="menu-academico-avaliacoes" >
									<a href="<?php echo base_url('timetable/floorclassdistribution'); ?>">Floor Class Distribution</a>
								</li>
								<li id="menu-academico-avaliacoes" >
									<a href="<?php echo base_url('timetable/subjectAllocation'); ?>">Subject Allocation</a>
								</li>
						  </ul>
						</li>
					<?php endif; ?> -->
							
							</ul>
							</div>
						  </div>
						  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>
<!--js -->
<script src="<?php echo base_url(); ?>assets/dash_js/jquery.nicescroll.js"></script>
<!-- <script src="js/scripts.js"></script> -->
<!-- Bootstrap Core JavaScript -->
   <script src="<?php echo base_url(); ?>assets/dash_js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   
<!-- morris JavaScript -->	
<script src="<?php echo base_url(); ?>assets/dash_js/raphael-min.js"></script>
<script src="<?php echo base_url(); ?>assets/dash_js/morris.js"></script>
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2014 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2014 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2014 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2014 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2015 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2015 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2015 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2015 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2016 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
				{period: '2016 Q2', iphone: 8442, ipad: 5723, itouch: 1801}
			],
			lineColors:['#ff4a43','#a2d200','#22beef'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
</body>
</html>
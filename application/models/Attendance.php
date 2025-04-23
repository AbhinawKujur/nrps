<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_model{

	public function getAttendanceData($id,$date_from = null,$date_to = null)
	{
		$query = $this->db->query("SELECT * FROM emp_attendance WHERE EMPLOYEE_ID=$id AND date(IN_TIME) >= '$date_from' and date(IN_TIME) <= '$date_to'");
		return $query->result_array();
	}

	public function getTodayPresentEmpData($today)
	{
		$query = $this->db->query("SELECT *,(SELECT COUNT(WING_MASTER_ID) FROM employee WHERE WING_MASTER_ID=wm.id)as total_emp, (SELECT COUNT(DISTINCT(employee.EMPID)) FROM employee  INNER JOIN emp_attendance ON employee.id=emp_attendance.EMPLOYEE_ID WHERE employee.WING_MASTER_ID=wm.id AND employee.SEX='1' AND date(emp_attendance.IN_TIME)='$today')as total_male_pre,(SELECT COUNT(DISTINCT(employee.EMPID)) FROM employee  INNER JOIN emp_attendance ON employee.id=emp_attendance.EMPLOYEE_ID WHERE employee.WING_MASTER_ID=wm.id AND employee.SEX='2' AND date(emp_attendance.IN_TIME)='$today' )as total_female_pre,(SELECT COUNT(DISTINCT(employee.EMPID)) FROM employee  INNER JOIN emp_attendance ON employee.id=emp_attendance.EMPLOYEE_ID WHERE employee.WING_MASTER_ID=wm.id AND employee.STAFF_TYPE='1' AND date(emp_attendance.IN_TIME)='$today' )as total_teaching_pre,(SELECT COUNT(DISTINCT(employee.EMPID)) FROM employee  INNER JOIN emp_attendance ON employee.id=emp_attendance.EMPLOYEE_ID WHERE employee.WING_MASTER_ID=wm.id AND employee.STAFF_TYPE='2' AND date(emp_attendance.IN_TIME)='$today')as total_nonteaching_pre FROM `wing_master` as wm");
		return $query->result_array();
	}

	public function getTotalStudentPresentForDash()
	{
		$query = $this->db->query("SELECT DISTINCT CLASS,(SELECT CLASS_NM FROM classes WHERE Class_No=stu.CLASS)class_name,(SELECT SECTION_NAME FROM sections WHERE section_no=stu.SEC)sec_name,SEC, (SELECT COUNT(STUDENTID) FROM student WHERE CLASS = stu.CLASS AND SEC=stu.SEC AND Student_Status='ACTIVE')as total_stu,(SELECT COUNT(STUDENTID) FROM student WHERE CLASS = stu.CLASS AND SEC=stu.SEC AND SEX='1' AND Student_Status='ACTIVE')as total_male,(SELECT COUNT(STUDENTID) FROM student WHERE CLASS = stu.CLASS AND SEC=stu.SEC AND SEX='2' AND Student_Status='ACTIVE')as total_female,(SELECT attendance_type FROM student_attendance_type WHERE class_code=stu.CLASS)as att_type FROM student stu WHERE Student_Status='ACTIVE' ORDER BY CLASS");
		return $query->result_array();
	}

	public function getEmployeeDataForPayslip($month,$year)
	{
		$query = $this->db->query('SELECT e.id,e.EMPID,IFNULL(e.EMP_FNAME,"")EMP_FNAME,IFNULL(e.EMP_MNAME,"")EMP_MNAME,IFNULL(e.EMP_LNAME,"")EMP_LNAME,IFNULL(e.BASIC,0)BASIC,HRA_APP,TA_ALLOWANCE_APP,LEVEL_NO,SECOND_SHIFT_ALLOW,PF_APP,bus_deduction,ESI_APP,GROUP_INS_POLI,INS_POLNO,(SELECT DESIG FROM desig WHERE Sno=e.DESIG)designation,e.is_salary_increase,e.salary_increase_month,e.salary_increase_year,e.old_level_year,e.old_level_no,e.new_level_year,e.new_level_no,e.sal_increase_status,IFNULL((SELECT count(empid) FROM monthly_emp_atten WHERE att_year='.$year.' AND att_month='.$month.' AND att_status IN ("AB","LWP") AND empid=e.EMPID),0)total_absent,IFNULL((SELECT count(empid) FROM monthly_emp_atten WHERE att_year='.$year.' AND att_month='.$month.' AND att_status IN ("HD","HPL") AND empid=e.EMPID),0)total_half_day FROM employee e WHERE e.STATUS=1 ORDER BY e.EMPID');
		return $query->result_array();
	}

	public function getPayslipDBOData($month,$year)
	{
		$query = $this->db->query('SELECT e.id as emp_tbl_id,e.EMPID,IFNULL(e.EMP_FNAME,"")EMP_FNAME,IFNULL(e.EMP_MNAME,"")EMP_MNAME,IFNULL(e.EMP_LNAME,"")EMP_LNAME,(SELECT DESIG FROM desig WHERE Sno=e.DESIG)designation,p.* FROM employee e INNER JOIN payslip_dbo p ON p.emp_id=e.id WHERE payslip_month='.$month.' AND payslip_year='.$year.' ORDER BY e.EMPID');
		return $query->result_array();
	}

	public function getSecondShiftAttendanceData($year,$month)
	{
		$query = $this->db->query("SELECT emp.id,emp.EMPID,emp.EMP_FNAME,emp.EMP_MNAME,emp.EMP_LNAME,(SELECT DESIG FROM desig WHERE Sno=emp.DESIG) AS DESIG, IFNULL((SELECT shift_allowance FROM second_shift_attendance WHERE emp_id=emp.id AND year='$year' AND month='$month'),0) AS shift_allowance,IFNULL((SELECT SHIFT_ALLOW FROM pay_control WHERE EMPLOYEE_ID=emp.id),0) AS shift_allowance_pay_control,IFNULL((SELECT shift_amount FROM second_shift_attendance WHERE emp_id=emp.id AND year='$year' AND month='$month'),0) AS shift_amount FROM employee emp WHERE emp.SECOND_SHIFT_ALLOW=1");
		return $query->result_array();
	}

	public function getMonthWiseAttendance($year,$month)
	{
		$query = $this->db->query("SELECT *,(SELECT EMP_FNAME FROM employee WHERE EMPID=ma.empid)EMP_FNAME,(SELECT EMP_MNAME FROM employee WHERE EMPID=ma.empid)EMP_MNAME,(SELECT EMP_LNAME FROM employee WHERE EMPID=ma.empid)EMP_LNAME,(SELECT C_MOBILE FROM employee WHERE EMPID=ma.empid)MOBILE,(SELECT C_EMAIL FROM employee WHERE EMPID=ma.empid)EMAIL,(SELECT SEX FROM employee WHERE EMPID=ma.empid)SEX,(SELECT DESIG FROM desig WHERE Sno=(SELECT DESIG FROM employee WHERE EMPID=ma.empid))DESIGNATION_NAME FROM `monthly_emp_atten` ma WHERE att_month='$month' AND att_year='$year' ORDER BY empid");
		return $query->result_array();
	}

	public function totalPresentStudent($where_daily,$where)
	{
		$today = date('Y-m-d');
		$query = $this->db->query("SELECT COUNT(DISTINCT admno)total_present_period_table,(SELECT COUNT(admno) FROM stu_attendance_entry WHERE $where_daily)total_present_daily_table FROM stu_attendance_entry_periodwise WHERE $where");
		return $query->row_array();
	}

	public function totalAbsentStudent($where_daily,$where)
	{
		$today = date('Y-m-d');
		$query = $this->db->query("SELECT COUNT(DISTINCT admno)total_absent_period_table,(SELECT COUNT(admno) FROM stu_attendance_entry WHERE $where_daily)total_absent_daily_table FROM stu_attendance_entry_periodwise WHERE $where");
		return $query->row_array();
	}


	public function classnPeriodWiseAttendance($class_code,$sec_code)
	{
		$today = date('Y-m-d');
		$query = $this->db->query("SELECT att_date,admno,(SELECT FIRST_NM FROM student WHERE ADM_NO=sae.admno)FIRST_NM,(SELECT MIDDLE_NM FROM student WHERE ADM_NO=sae.admno)MIDDLE_NM,(SELECT SEX FROM student WHERE ADM_NO=sae.admno)SEX,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE period=1 AND admno=sae.admno AND date(att_date)=sae.att_date)period1,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE period=2 AND admno=sae.admno AND date(att_date)=sae.att_date)period2,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE period=3 AND admno=sae.admno AND date(att_date)=sae.att_date)period3,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE period=4 AND admno=sae.admno AND date(att_date)=sae.att_date)period4,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE period=5 AND admno=sae.admno AND date(att_date)=sae.att_date)period5,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE period=6 AND admno=sae.admno AND date(att_date)=sae.att_date)period6,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE period=7 AND admno=sae.admno AND date(att_date)=sae.att_date)period7,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE period=8 AND admno=sae.admno AND date(att_date)=sae.att_date)period8 FROM stu_attendance_entry_periodwise sae WHERE date(att_date)='$today' AND class_code='$class_code' AND sec_code='$sec_code'");
		return $query->result_array();
	}

	public function getLeaveCount()
	{
		$query = $this->db->query("SELECT count(*), (SELECT count(*) FROM emp_leave_attendance WHERE STATUS=0)total_pending,(SELECT count(*) FROM emp_leave_attendance WHERE STATUS=1)total_approved,(SELECT count(*) FROM emp_leave_attendance WHERE STATUS=2)total_disapproved FROM `emp_leave_attendance`");
		return $query->row_array();
	}

	public function getMyAttendance($date,$emp_id)
	{
		$query = $this->db->query("SELECT min(IN_TIME)in_time,(SELECT IN_CHECK_DIFFER FROM emp_attendance WHERE ID=(SELECT min(ID) FROM emp_attendance WHERE date(IN_TIME)='$date' AND EMPLOYEE_ID='$emp_id'))IN_CHECK_DIFFER, max(OUT_TIME)out_time,(SELECT OUT_CHECK_DIFFER FROM emp_attendance WHERE ID=(SELECT max(ID) FROM emp_attendance WHERE date(OUT_TIME)='$date' AND EMPLOYEE_ID='$emp_id'))OUT_CHECK_DIFFER,SEC_TO_TIME(SUM(TIME_TO_SEC(TOTAL_DURATION))) AS total_work_duration,MAX(SHIFT_DURATION)SHIFT_DURATION,TIMEDIFF(SEC_TO_TIME(SUM(TIME_TO_SEC(TOTAL_DURATION))), MAX(SHIFT_DURATION))work_duration_diff,MAX(MIN_HRS_FULL)MIN_HRS_FULL, MAX(MIN_HRS_HALF)MIN_HRS_HALF, MIN(REMARKS)REMARKS, MIN(IN_TIME_REMARKS)IN_TIME_REMARKS, MIN(OUT_TIME_REMARKS)OUT_TIME_REMARKS FROM `emp_attendance` WHERE date(IN_TIME)='$date' AND EMPLOYEE_ID='$emp_id'");
		return $query->row_array();
	}

	public function getStudentPeriodWiseAttendance($date,$admno)
	{
		$query = $this->db->query("SELECT IFNULL((SELECT att_status FROM stu_attendance_entry_periodwise WHERE period=1 AND date(att_date)='$date' AND admno='$admno'),'-')P1,IFNULL((SELECT att_status FROM stu_attendance_entry_periodwise WHERE period=2 AND date(att_date)='$date' AND admno='$admno'),'-')P2,IFNULL((SELECT att_status FROM stu_attendance_entry_periodwise WHERE period=3 AND date(att_date)='$date' AND admno='$admno'),'-')P3,IFNULL((SELECT att_status FROM stu_attendance_entry_periodwise WHERE period=4 AND date(att_date)='$date' AND admno='$admno'),'-')P4,IFNULL((SELECT att_status FROM stu_attendance_entry_periodwise WHERE period=5 AND date(att_date)='$date' AND admno='$admno'),'-')P5,IFNULL((SELECT att_status FROM stu_attendance_entry_periodwise WHERE period=6 AND date(att_date)='$date' AND admno='$admno'),'-')P6,IFNULL((SELECT att_status FROM stu_attendance_entry_periodwise WHERE period=7 AND date(att_date)='$date' AND admno='$admno'),'-')P7,IFNULL((SELECT att_status FROM stu_attendance_entry_periodwise WHERE period=8 AND date(att_date)='$date' AND admno='$admno'),'-')P8 FROM `stu_attendance_entry_periodwise` WHERE date(att_date)='$date' AND admno='$admno'");
		return $query->row_array();
	}

	public function getStudentPeriodWiseAttendanceReport($date,$admno)
	{
		$query = $this->db->query("SELECT IFNULL((SELECT att_status FROM stu_attendance_entry_periodwise WHERE date(att_date)='$date' AND period=1 AND admno='$admno'),'-')p1,IFNULL((SELECT att_status FROM stu_attendance_entry_periodwise WHERE date(att_date)='$date' AND period=2 AND admno='$admno'),'-')p2,IFNULL((SELECT att_status FROM stu_attendance_entry_periodwise WHERE date(att_date)='$date' AND period=3 AND admno='$admno'),'-')p3,IFNULL((SELECT att_status FROM stu_attendance_entry_periodwise WHERE date(att_date)='$date' AND period=4 AND admno='$admno'),'-')p4,IFNULL((SELECT att_status FROM stu_attendance_entry_periodwise WHERE date(att_date)='$date' AND period=5 AND admno='$admno'),'-')p5,IFNULL((SELECT att_status FROM stu_attendance_entry_periodwise WHERE date(att_date)='$date' AND period=6 AND admno='$admno'),'-')p6,IFNULL((SELECT att_status FROM stu_attendance_entry_periodwise WHERE date(att_date)='$date' AND period=7 AND admno='$admno'),'-')p7,IFNULL((SELECT att_status FROM stu_attendance_entry_periodwise WHERE date(att_date)='$date' AND period=8 AND admno='$admno'),'-')p8 FROM `stu_attendance_entry_periodwise` WHERE date(att_date)='$date' AND admno='$admno'");
		return $query->row_array();
	}

	public function getAbsentDays($att_year, $att_month)
	{
		$query = $this->db->query("SELECT empid,(Select count(empid) from `monthly_emp_atten` where empid=mea.empid and att_year='$att_year' AND att_month='$att_month' AND att_status='AB')absent_days,(Select count(empid) from `monthly_emp_atten` where empid=mea.empid and att_year='$att_year' AND att_month='$att_month' AND att_status in ('HD','HPL'))half_days FROM `monthly_emp_atten` as mea WHERE att_year='$att_year' AND att_month='$att_month' GROUP BY empid");
		return $query->result_array();
	}

	public function generateMonthlyAttendanceProcedure($start_cycle,$end_cycle,$weekend_date,$current_month_total_days,$current_month,$current_month_year,$prev_month_total_days,$prev_month,$prev_month_year,$created_by)
	{
		  	$sql = "CALL generateMonthlyAttendance(?,?,?,?,?,?,?,?,?,?)";
		    $query = $this->db->query($sql,array($start_cycle,$end_cycle,$weekend_date,$current_month_total_days,$current_month,$current_month_year,$prev_month_total_days,$prev_month,$prev_month_year,$created_by));
		    return $query;
	}

	public function getEmployeeDataForDeductionBulkUpdation()
	{
		$sql = $this->db->query("SELECT id,EMPID,EMP_FNAME,EMP_MNAME,EMP_LNAME,(SELECT DESIG FROM desig WHERE Sno=employee.DESIG)designation,(SELECT print_position FROM desig WHERE Sno=employee.DESIG)print_position,IFNULL((SELECT VPF FROM pay_control WHERE EMPLOYEE_ID=employee.id),0)VPF,IFNULL((SELECT PROF_TAX FROM pay_control WHERE EMPLOYEE_ID=employee.id),0)PROF_TAX,IFNULL((SELECT TDS FROM pay_control WHERE EMPLOYEE_ID=employee.id),0)tds,IFNULL((SELECT MEDICAL_DEDUCT FROM pay_control WHERE EMPLOYEE_ID=employee.id),0)MEDICAL_DEDUCT,IFNULL((SELECT HRA_RENT FROM pay_control WHERE EMPLOYEE_ID=employee.id),0)HRA_RENT,IFNULL((SELECT HRA_ELECT FROM pay_control WHERE EMPLOYEE_ID=employee.id),0)HRA_ELECT,IFNULL((SELECT HRA_SECURITY FROM pay_control WHERE EMPLOYEE_ID=employee.id),0)HRA_SECURITY,IFNULL((SELECT HRA_GARAGE FROM pay_control WHERE EMPLOYEE_ID=employee.id),0)HRA_GARAGE FROM `employee` WHERE STATUS=1 ORDER BY EMPID");
		return $sql->result_array();
	}

	public function getEmployeeDataForAllowanceBulk()
	{
		$sql = $this->db->query("SELECT id,EMPID,EMP_FNAME,EMP_MNAME,EMP_LNAME,(SELECT DESIG FROM desig WHERE Sno=employee.DESIG)designation,(SELECT print_position FROM desig WHERE Sno=employee.DESIG)print_position,IFNULL((SELECT FIXED_ALLOW FROM pay_control WHERE EMPLOYEE_ID=employee.id),0)FIXED_ALLOW,IFNULL((SELECT SHIFT_ALLOW FROM pay_control WHERE EMPLOYEE_ID=employee.id),0)SHIFT_ALLOW,IFNULL((SELECT SH_RENT FROM pay_control WHERE EMPLOYEE_ID=employee.id),0)SH_RENT,IFNULL((SELECT ARREAR_BASIC FROM pay_control WHERE EMPLOYEE_ID=employee.id),0)ARREAR_BASIC,IFNULL((SELECT ARREAR_DA FROM pay_control WHERE EMPLOYEE_ID=employee.id),0)ARREAR_DA,IFNULL((SELECT ARREAR_HRA FROM pay_control WHERE EMPLOYEE_ID=employee.id),0)ARREAR_HRA,IFNULL((SELECT ARREAR_TA FROM pay_control WHERE EMPLOYEE_ID=employee.id),0)ARREAR_TA,IFNULL((SELECT ARREAR_FIXED_ALLOW FROM pay_control WHERE EMPLOYEE_ID=employee.id),0)ARREAR_FIXED_ALLOW,IFNULL((SELECT ARREAR_SHIFT_ALLOW FROM pay_control WHERE EMPLOYEE_ID=employee.id),0)ARREAR_SHIFT_ALLOW,IFNULL((SELECT MEDICAL_REIMBURSEMENT FROM pay_control WHERE EMPLOYEE_ID=employee.id),0)MEDICAL_REIMBURSEMENT FROM `employee` WHERE STATUS=1 ORDER BY EMPID");
		return $sql->result_array();
	}

	public function getPreviousApprovedLeave($start_date,$empid)
	{
		$query = $this->db->query("SELECT * FROM `emp_leave_attendance` WHERE date(DATE_FROM)<'$start_date' AND SALARY_STATUS='0' AND STATUS='1' AND EMPLOYEE_ID='$empid'");
		return $query->result_array();
	}

	public function getEmployeeDataForSalaryIncrement($current_year)
	{
		$query = $this->db->query("SELECT emp.*,m.month_name as salary_increase_month_name,(SELECT pay FROM seventh_pay WHERE LEVEL_NO=emp.old_level_no AND LEVEL_YEAR=emp.old_level_year)old_basic,(SELECT pay FROM seventh_pay WHERE LEVEL_NO=emp.new_level_no AND LEVEL_YEAR=emp.new_level_year)new_basic FROM employee emp INNER JOIN month_master m ON m.month_code=emp.salary_increase_month WHERE emp.STATUS=1 AND emp.sal_increase_status=1 AND sal_increase_status<='$current_year' ORDER BY emp.EMPID");
		return $query->result_array();
	}

  }
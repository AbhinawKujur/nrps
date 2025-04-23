<?php

class Salary_Model extends CI_Model
{
	public function getBankSalaryReport($payslip_month,$payslip_year)
	{
		$query = $this->db->query("SELECT emp.EMPID,emp.EMP_FNAME,emp.EMP_MNAME,emp.EMP_LNAME,emp.SEX,emp.DESIG,emp.BANK_AC_NO,pd.actual_basic,pd.payable_amt,desig.DESIG FROM payslip_dbo pd INNER JOIN employee emp ON pd.emp_id=emp.id INNER JOIN desig ON emp.DESIG=desig.Sno WHERE pd.payslip_month='$payslip_month' AND pd.payslip_year='$payslip_year' AND emp.BANK_AC_NO<>'' AND pd.payable_amt<>0 ORDER BY emp.EMPID ASC");
		return $query->result_array();
	}
	
	public function getAllowanceReport($payslip_month,$payslip_year)
	{
		$query = $this->db->query("SELECT emp.EMPID,emp.EMP_FNAME,emp.EMP_MNAME,emp.EMP_LNAME,emp.SEX,emp.C_MOBILE,(SELECT DESIG FROM desig WHERE Sno=emp.DESIG) AS DESIG,emp.BANK_AC_NO,pd.actual_basic,pd.basic_salary,pd.da_pay,pd.hra_pay,pd.ta_pay,pd.fixed_allowance,pd.shift_allowance,pd.sh_rent,pd.arrear_basic,pd.arrear_da,pd.arrear_hra,pd.arrear_ta,pd.arrear_fixed_allow,pd.arrear_shift_allow,pd.second_shift_amount,pd.medical_reimbursement,pd.gross_salary,pd.payable_amt,desig.DESIG FROM payslip_dbo pd INNER JOIN employee emp ON pd.emp_id=emp.id INNER JOIN desig ON emp.DESIG=desig.Sno WHERE pd.payslip_month='$payslip_month' AND pd.payslip_year='$payslip_year' ORDER BY emp.EMPID ASC");
		return $query->result_array();
	}

	public function getDeductionReport($payslip_month,$payslip_year)
	{
		$query = $this->db->query("SELECT emp.EMPID,emp.EMP_FNAME,emp.EMP_MNAME,emp.EMP_LNAME,emp.SEX,emp.C_MOBILE,(SELECT DESIG FROM desig WHERE Sno=emp.DESIG) AS DESIG,emp.BANK_AC_NO,pd.actual_basic,pd.basic_salary,pd.pf_own_deduct,pd.fpf_deduct,pd.vpf_deduct,pd.esi_deduct,pd.prof_tax,pd.lic,pd.hra_rent_deduct,pd.hra_security_deduct,pd.hra_garage_deduct,pd.hra_elect_deduct,pd.group_insurance_amt,pd.staff_welfare_fund,pd.tds_deduct,pd.medical_deduct,pd.advance_salary_deduct,pd.payable_amt,desig.DESIG,pd.bus_deduction FROM payslip_dbo pd INNER JOIN employee emp ON pd.emp_id=emp.id INNER JOIN desig ON emp.DESIG=desig.Sno WHERE pd.payslip_month='$payslip_month' AND pd.payslip_year='$payslip_year' ORDER BY emp.EMPID ASC");
		return $query->result_array();
	}

	public function getYearlySalaryReport($emp_id)
	{
		$query = $this->db->query("SELECT *,(SELECT month_name FROM month_master WHERE month_code=pd.payslip_month) AS month_name FROM payslip_dbo pd WHERE emp_id='$emp_id'");
		return $query->result_array();
	}

	public function getSalaryBill($year,$month)
	{
		$query = $this->db->query("SELECT *,(SELECT EMPID FROM employee WHERE id=pd.emp_id)EMPID,(SELECT EMP_FNAME FROM employee WHERE id=pd.emp_id)EMP_FNAME,(SELECT EMP_MNAME FROM employee WHERE id=pd.emp_id)EMP_MNAME,(SELECT EMP_LNAME FROM employee WHERE id=pd.emp_id)EMP_LNAME,(SELECT SEX FROM employee WHERE id=pd.emp_id)SEX,(SELECT LEVEL_NO FROM employee WHERE id=pd.emp_id)LEVEL_NO,(SELECT EMPID FROM employee WHERE id=pd.emp_id)EMPID,(SELECT PF_JOIN_DT FROM employee WHERE id=pd.emp_id)PF_JOIN_DT,(SELECT DESIG FROM employee WHERE id=pd.emp_id)desig_id,(SELECT DESIG FROM desig WHERE Sno=desig_id)DESIG,(SELECT print_position FROM desig WHERE Sno=desig_id)print_position FROM `payslip_dbo` pd WHERE payslip_year='$year' AND payslip_month='$month' ORDER BY EMPID");
		return $query->result_array();
	}

	public function getMonthlyPFStatement($year,$month)
	{
		$query = $this->db->query("SELECT *,(SELECT EMP_FNAME FROM employee WHERE id=pd.emp_id)EMP_FNAME,(SELECT EMP_MNAME FROM employee WHERE id=pd.emp_id)EMP_MNAME,(SELECT EMP_LNAME FROM employee WHERE id=pd.emp_id)EMP_LNAME,IFNULL((SELECT UANNO FROM employee WHERE id=pd.emp_id),0)UANNO,(SELECT SEX FROM employee WHERE id=pd.emp_id)SEX,(SELECT D_O_J FROM employee WHERE id=pd.emp_id)D_O_J,(SELECT PF_JOIN_DT FROM employee WHERE id=pd.emp_id)PF_JOIN_DT,(SELECT DESIG FROM employee WHERE id=pd.emp_id)desig_id,(SELECT DESIG FROM desig WHERE Sno=desig_id)DESIG,(SELECT print_position FROM desig WHERE Sno=desig_id)print_position FROM payslip_dbo pd WHERE payslip_month='$month' AND payslip_year='$year' AND pf_app=1 ORDER BY print_position");
		return $query->result_array();
	}

	public function getSalarySlipEmpList($year,$month)
	{
		$query = $this->db->query("SELECT *,(SELECT EMPID FROM employee WHERE id=pd.emp_id)EMPID,(SELECT EMP_FNAME FROM employee WHERE id=pd.emp_id)EMP_FNAME,(SELECT EMP_MNAME FROM employee WHERE id=pd.emp_id)EMP_MNAME,(SELECT EMP_LNAME FROM employee WHERE id=pd.emp_id)EMP_LNAME,IFNULL((SELECT UANNO FROM employee WHERE id=pd.emp_id),0)UANNO,(SELECT SEX FROM employee WHERE id=pd.emp_id)SEX,(SELECT D_O_J FROM employee WHERE id=pd.emp_id)D_O_J,(SELECT PF_JOIN_DT FROM employee WHERE id=pd.emp_id)PF_JOIN_DT,(SELECT PF_AC_NO FROM employee WHERE id=pd.emp_id)PF_AC_NO,(SELECT BASIC FROM employee WHERE id=pd.emp_id)BASIC,(SELECT DESIG FROM employee WHERE id=pd.emp_id)desig_id,(SELECT DESIG FROM desig WHERE Sno=desig_id)DESIG,(SELECT print_position FROM desig WHERE Sno=desig_id)print_position FROM payslip_dbo pd WHERE payslip_month='$month' AND payslip_year='$year' ORDER BY EMPID");
		return $query->result_array();
	}

	public function getGroupInsuranceReport($year,$month)
	{
		$query = $this->db->query("SELECT *,(SELECT EMPID FROM employee WHERE id=pd.emp_id)EMPID,(SELECT EMP_FNAME FROM employee WHERE id=pd.emp_id)EMP_FNAME,(SELECT EMP_MNAME FROM employee WHERE id=pd.emp_id)EMP_MNAME,(SELECT EMP_LNAME FROM employee WHERE id=pd.emp_id)EMP_LNAME,(SELECT INS_POLNO FROM employee WHERE id=pd.emp_id)INSURANCE_AMT FROM payslip_dbo pd WHERE payslip_month='$month' AND payslip_year='$year' AND group_ins_app='1' ORDER BY EMPID");
		return $query->result_array();
	}

	public function getLICReport($year,$month)
	{
		$query = $this->db->query("SELECT el.*,e.EMPID,e.EMP_FNAME,e.EMP_MNAME,e.EMP_LNAME FROM `employee_lic` el INNER JOIN employee e ON e.id=el.employee_id INNER JOIN payslip_dbo p ON p.emp_id=el.employee_id WHERE payslip_year='$year' AND payslip_month='$month'");
		return $query->result_array();
	}

	public function getMonthlyPercentage($year,$month)
	{
		$query = $this->db->query("SELECT DISTINCT da_percent,hra_rate_percent,pf_own_rate,esi_own_rate,esi_limit,esi_emp_rate,pf_emp_rate,pension_rate,pension_pay_limit FROM payslip_dbo WHERE payslip_month='$month' AND payslip_year='$year'");
		return $query->row_array();
	}

	public function getSalarySlipForSingleEmp($emp_id,$year,$month)
	{
		$query = $this->db->query("SELECT *,(SELECT EMPID FROM employee WHERE id=pd.emp_id)EMPID,(SELECT EMP_FNAME FROM employee WHERE id=pd.emp_id)EMP_FNAME,(SELECT EMP_MNAME FROM employee WHERE id=pd.emp_id)EMP_MNAME,(SELECT EMP_LNAME FROM employee WHERE id=pd.emp_id)EMP_LNAME,(SELECT FATHERS_NAME FROM employee WHERE id=pd.emp_id)FATHERS_NAME,(SELECT G_NAME FROM employee WHERE id=pd.emp_id)G_NAME,IFNULL((SELECT UANNO FROM employee WHERE id=pd.emp_id),0)UANNO,(SELECT SEX FROM employee WHERE id=pd.emp_id)SEX,(SELECT D_O_J FROM employee WHERE id=pd.emp_id)D_O_J,(SELECT PF_JOIN_DT FROM employee WHERE id=pd.emp_id)PF_JOIN_DT,(SELECT PF_AC_NO FROM employee WHERE id=pd.emp_id)PF_AC_NO,(SELECT BANK_AC_NO FROM employee WHERE id=pd.emp_id)BANK_AC_NO,(SELECT PAN_NUMBER FROM employee WHERE id=pd.emp_id)PAN_NUMBER,(SELECT BASIC FROM employee WHERE id=pd.emp_id)BASIC,(SELECT DESIG FROM employee WHERE id=pd.emp_id)desig_id,(SELECT DESIG FROM desig WHERE Sno=desig_id)DESIG,(SELECT print_position FROM desig WHERE Sno=desig_id)print_position FROM payslip_dbo pd WHERE payslip_month='$month' AND payslip_year='$year' AND emp_id='$emp_id' ORDER BY print_position");
		return $query->row_array();
	}

	public function form16DataByEmployee($emp_id)
	{
		$query = $this->db->query("SELECT IFNULL(SUM(gross_salary),0)total_gross_salary,IFNULL(SUM(prof_tax),0)total_prof_tax,IFNULL(SUM(pf_own_deduct),0)total_pf_own_deduct FROM `payslip_dbo` WHERE emp_id='$emp_id'");
		return $query->row_array();
	}
}
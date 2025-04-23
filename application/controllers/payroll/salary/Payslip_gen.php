<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payslip_gen extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	}
	
	public function index()
	{
		if(!in_array('viewPayslipGen', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		$current_session =$this->sumit->fetchSingleData('Session_Nm','session_master',array('Active_Status'=>1));
		$active_month = $this->sumit->fetchSingleData('*','month_master',array('active_month'=>1));
		$session_year = explode('-', $current_session['Session_Nm']);
		$current_year = $session_year[0];

		if($active_month['month_code'] < 4)
		{
			$current_year = $session_year[1];
		}
		
		$total_days = cal_days_in_month(CAL_GREGORIAN, $active_month['month_code'], $current_year);

		$prev_month_year = $current_year;
		$prev_month = $active_month['month_code']-1;
		if($active_month['month_code']==1)
		{
			$prev_month_year= $current_year -1;
			$prev_month = 12;
		}
		$prev_month_total_days = cal_days_in_month(CAL_GREGORIAN, $prev_month, $prev_month_year);
		if(isset($_POST['display']))
		{
			$checkAttendanceGen = $this->sumit->checkData('*','monthly_emp_atten',"att_year='$current_year' AND att_month='".$active_month['month_code']."'");
			if($checkAttendanceGen==true)
			{
				$result = array();
				$check_payslip_data = $this->sumit->checkData('*','payslip_dbo',array('payslip_month'=>$active_month['month_code'],'payslip_year'=>$current_year,'update_lock'=>1));
				if($check_payslip_data)
				{
					$employeeData = $this->attendance->getPayslipDBOData($active_month['month_code'],$current_year);

					foreach ($employeeData as $key => $value) {

						$result[$value['EMPID']] = array(
							'id'			=> $value['emp_tbl_id'],
							'EMPID'			=> $value['EMPID'],
							'EMP_NAME' 		=> $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME'],
							'payslip_year' 	=> $value['payslip_year'],
							'payslip_month' => $value['payslip_month'],
							'working_days' 	=> $value['total_working_days'],
							'present_days' 	=> $value['total_present'],
							'absent_days'  	=> $value['total_working_days'] - $value['total_present'],
							'basic_sal'	   	=> $value['actual_basic'],
							'payable_basic'	=> $value['basic_salary'],
							'da'			=> $value['da_pay'],
							'hra_amt_allowance'	=> $value['hra_pay'],
							'hra_amt_deduction'	=> round($value['hra_rent_deduct']+$value['hra_security_deduct']+$value['hra_garage_deduct']+$value['hra_elect_deduct']),
							'hra_rent'		=> $value['hra_rent_deduct'],
							'hra_elect'		=> $value['hra_elect_deduct'],
							'hra_security'	=> $value['hra_security_deduct'],
							'hra_garage'	=> $value['hra_garage_deduct'],
							'ta_amount'		=> $value['ta_pay'],
							'fixed_allowance'=> $value['fixed_allowance'],
							'shift_allowance'=> $value['shift_allowance'],
							'second_shift_amt'=> $value['second_shift_amount'],
							'sh_rent'		=> $value['sh_rent'],
							'arrear_basic'	=> $value['arrear_basic'],
							'arrear_da'		=> $value['arrear_da'],
							'arrear_hra'			=> $value['arrear_hra'],
							'arrear_ta'				=> $value['arrear_ta'],
							'arrear_fixed_allow'	=> $value['arrear_fixed_allow'],
							'arrear_shift_allow'	=> $value['arrear_shift_allow'],
							'medical_reimbursment'	=> $value['medical_reimbursement'],
							'gross_payable'			=> $value['gross_salary'],
							'employee_pf'			=> $value['pf_own_deduct'],
							'fpf'					=> $value['fpf_deduct'],
							'vpf'					=> $value['vpf_deduct'],
							'lic'					=> $value['lic'],
							'medical_deduction'		=> $value['medical_deduct'],
							'tds'					=> $value['tds_deduct'],
							'prof_tax'				=> $value['prof_tax'],
							'staff_welfare_fund'	=> $value['staff_welfare_fund'],
							'bus_deduct'			=> $value['bus_deduction'],
							'esi_amt'				=> $value['esi_deduct'],
							'group_insurance_amt'	=> $value['group_insurance_amt'],
							'salary_advance_deduction_amt'	=> $value['advance_salary_deduct'],
							'total_deduction'		=> $value['total_deduction'],
							'payable_sal'			=> $value['payable_amt'],
							
						);
					}
				}
				else
				{
					$start_date = date('Y-m-d',strtotime($prev_month_year.'-'.$prev_month.'-26'));
					$employeeData = $this->attendance->getEmployeeDataForPayslip($active_month['month_code'],$current_year);
					$pf_master_details = $this->sumit->fetchLastData('*','masterpf',array(),'id');
					foreach ($employeeData as $key => $value) 
					{	

						/*******************************************************
								Update LIC Amount if maturity date expire
						******************************************************/
						$getLICData = $this->sumit->fetchSingleData('*','employee_lic',"employee_id='".$value['id']."'");
						if(!empty($getLICData))
						{
							$licAmt = 0;
							$back_month_date = date('Y-m-d',strtotime($start_date."-1 Months"));
							for($k=1;$k<=5;$k++)
							{
								if($getLICData['maturity_date'.$k]!='')
								{
									if((strtotime($getLICData['maturity_date'.$k])>strtotime($start_date)) || ((strtotime($getLICData['maturity_date'.$k])<strtotime($start_date)) && (strtotime($getLICData['maturity_date'.$k])>strtotime($back_month_date))))
									{
										$licAmt += $getLICData['premium_amt_'.$k];
									}
								}
							}
							$this->sumit->update('pay_control',array('LIC'=>$licAmt),"EMPLOYEE_ID='".$value['id']."'");
						}
						/*******************************************************
								Update LIC Amount if maturity date expire end
						******************************************************/

						/*******************************************************
								Arrear Salary calculation for previous leave approval
						******************************************************/

						$getPreviousLeaveApproval = $this->attendance->getPreviousApprovedLeave($start_date,$value['EMPID']);
						$previousDays = 0;$prevActualBasic = 0; $prevDApercentage =0;$prevTotalDays = 0;
						$prevArrearBasicAmt =0;$prevArrearDAAmt=0;
						if(!empty($getPreviousLeaveApproval))
						{
							foreach ($getPreviousLeaveApproval as $keyin => $valuein) {

								$leave_month = date('m',strtotime($valuein['DATE_FROM']));
								$leave_year = date('Y',strtotime($valuein['DATE_FROM']));
								$prevPayslip = $this->sumit->fetchSingleData('*','payslip_dbo',"emp_id='".$value['id']."' AND payslip_year='$leave_year' AND payslip_month='$leave_month'");
								if(!empty($prevPayslip))
								{
									$prevActualBasic = $prevPayslip['actual_basic'];
									$prevDApercentage = $prevPayslip['da_percent'];
									$prevTotalDays = $prevPayslip['total_working_days'];
								} 
								else
								{
									$prevActualBasic = round($value['BASIC']);;
									$prevDApercentage = $pf_master_details['da_rate'];
									$prevTotalDays = $total_days;
								}


								if($valuein['LEAVE_TYPE']==1 || $valuein['LEAVE_TYPE']==2 || $valuein['LEAVE_TYPE']==3 || $valuein['LEAVE_TYPE']==5)
								{
									$previousDays = 1;
								}
								elseif($valuein['LEAVE_TYPE']==6)
								{
									$previousDays = 0.5;
								}

								$firstPoint = round(($prevActualBasic/$prevTotalDays)*$previousDays);
								$secondPoint = round(($firstPoint*$prevDApercentage)/100);
								$prevArrearBasicAmt += $firstPoint;
								$prevArrearDAAmt += $secondPoint;
							}
						}
						/*******************************************************
								Arrear Salary calculation end  for previous leave approval
						******************************************************/
						/*******************************************************
								Arrear Salary calculation for salary increment
						******************************************************/
						
						
						/*******************************************************
								Arrear Salary calculation for salary increment end
						******************************************************/
						$pay_control = $this->sumit->fetchSingleData('*','pay_control',array('EMPLOYEE_ID'=>$value['id']));
						$basic_salary = round($value['BASIC']);
						$absent_days = $value['total_absent'] + ($value['total_half_day']/2);
						$present_days = $this->custom_lib->checkNoofPresentDays($total_days,$absent_days,$prev_month_total_days);
						$payable_basic = round(($basic_salary / $total_days) * $present_days);
						$da = round(($payable_basic * $pf_master_details['da_rate'])/100);
						$hra_amt_allowance = 0;
						$hra_amt_deduction = 0;
						$ta_amount = 0;
						if($present_days > 0)
						{
							if($value['HRA_APP'] == 2)
							{
								$hra_amt_allowance = round(($basic_salary * $pf_master_details['HRA_Rate'])/100);
								$hra_amt_allowance = ($hra_amt_allowance < 3600)?3600:$hra_amt_allowance;
							}
							elseif($value['HRA_APP'] == 1)
							{
								$hra_amt_deduction = round($pay_control['HRA_RENT']+$pay_control['HRA_ELECT']+$pay_control['HRA_SECURITY']+$pay_control['HRA_GARAGE']);
							}

							if($value['TA_ALLOWANCE_APP'] == 1)
							{
								if($value['LEVEL_NO'] == 1 || $value['LEVEL_NO'] == 2)
								{
									$ta_amount = round($pf_master_details['ta_rate_slab1']);
									$ta_amount = ($payable_basic >=24200)?1800:$ta_amount;
								}
								elseif($value['LEVEL_NO'] >= 3 && $value['LEVEL_NO'] <= 8)
								{
									$ta_amount = round($pf_master_details['ta_rate_slab2']);
								}
								else
								{
									$ta_amount = round($pf_master_details['ta_rate_slab3']);
								}						
							}

						}
						$fixed_allowance = ($pay_control['FIXED_ALLOW']!='')?round($pay_control['FIXED_ALLOW']):0;
						$shift_allowance = 0;
						$second_shift_amt = 0;
						if($value['SECOND_SHIFT_ALLOW'] == 1)
						{
							$shift_allowance = round(($pay_control['SHIFT_ALLOW']=='')?0:$pay_control['SHIFT_ALLOW']);
							$second_shift_amt = $this->sumit->fetchSingleData('*','second_shift_attendance',array('emp_id'=>$value['id'],'year'=>$current_year,'month'=>$active_month['month_code']));
							if(!empty($second_shift_amt))
							{
								$second_shift_amt = round($second_shift_amt['shift_amount']);
							}
						}
						$sh_rent = isset($pay_control['SH_RENT'])?$pay_control['SH_RENT']:0;
						$arrear_salary = round($pay_control['ARREAR_BASIC'] + $pay_control['ARREAR_DA'] + $pay_control['ARREAR_HRA'] + $pay_control['ARREAR_TA'] + $pay_control['ARREAR_FIXED_ALLOW'] + $pay_control['ARREAR_SHIFT_ALLOW']) + $prevArrearBasicAmt + $prevArrearDAAmt;

						$medical_reimbursment = ($pay_control['MEDICAL_REIMBURSEMENT']!='')?$pay_control['MEDICAL_REIMBURSEMENT']:0;

						$gross_payable = $payable_basic + $da + $hra_amt_allowance + $ta_amount + $fixed_allowance + $shift_allowance + $second_shift_amt + $arrear_salary+$medical_reimbursment + $sh_rent;
						/**==============================================================
								Deduction part Calculation
						==============================================================**/
						$employee_pf = 0;
						if($value['PF_APP'] == 1)
						{
							$employee_pf = round((($payable_basic + $da + $pay_control['ARREAR_BASIC'] + $pay_control['ARREAR_DA']) * $pf_master_details['OWN_RATE']) / 100);
						}
						$fpf = ($pay_control['FPF']!='')?round($pay_control['FPF']):0;
						$vpf = ($pay_control['VPF']!='')?round($pay_control['VPF']):0;
						$lic = ($pay_control['LIC']!='')?round($pay_control['LIC']):0;
						$medical_deduction = ($pay_control['MEDICAL_DEDUCT']!='')?round($pay_control['MEDICAL_DEDUCT']):0;
						$tds = ($pay_control['TDS']!='')?round($pay_control['TDS']):0;
						$prof_tax = ($pay_control['PROF_TAX']!='')?round($pay_control['PROF_TAX']):0;
						$staff_welfare_fund = ($pf_master_details['staff_welfare_fund']!='')?round($pf_master_details['staff_welfare_fund']):0;

						$bus_deduct = 0;
						if($value['bus_deduction']==1)
						{
							$bus_deduct = $pf_master_details['bus_deduction'];
						}
						/**================================================
								ESI Calculation
						=================================================**/
						$esi_limit = $pf_master_details['ESI_LIMIT'];
						$employee_esi_rate = $pf_master_details['ESI_OWN_RATE'];
						$employer_esi_rate = $pf_master_details['ESI_EMP_RATE'];
						$esi_amt = 0;
						if($value['ESI_APP'] == 1)
						{
							$esi_amt = ($gross_payable * $employee_esi_rate) / 100;
							//esi amount changed just like 148.12 = 149 , 142.56 = 143
							$esi_amt_int = (int)$esi_amt;
							if($esi_amt > $esi_amt_int)
							{
								$esi_amt = $esi_amt_int + 1;
							}
						}

						$group_insurance_amt = 0;
						if($value['GROUP_INS_POLI'] == 1)
						{
							$group_insurance_amt = number_format(($value['INS_POLNO'] / 813.008),2);
							$group_insurance_amt = ($group_insurance_amt < $gross_payable)?$group_insurance_amt:0;
						}

						$adv_salary_total_amt = $pay_control['TOTAL_DUE_AMT'];
						$no_of_installment =  $pay_control['NO_OF_INSTALLMENT'];
						$salary_advance_deduction_amt = 0;
						if($no_of_installment != 0 || $adv_salary_total_amt != 0)
						{
							$salary_advance_deduction_amt = round($adv_salary_total_amt / $no_of_installment);
							if($salary_advance_deduction_amt > $gross_payable)
							{
								$salary_advance_deduction_amt = 0;
							}
						}

						$total_deduction = $employee_pf + $fpf + $vpf + $prof_tax + $lic + $hra_amt_deduction + $group_insurance_amt + $staff_welfare_fund + $tds + $medical_deduction + $salary_advance_deduction_amt + $esi_amt + $bus_deduct;

						$payable_sal = $gross_payable - $total_deduction; 
						
						$result[$value['EMPID']] = array(
							'id'		=> $value['id'],
							'EMPID'		=> $value['EMPID'],
							'EMP_NAME' 	=> $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME'],
							'payslip_year' => $current_year,
							'payslip_month' => $active_month['month_code'],
							'working_days' => $total_days,
							'present_days' => $present_days,
							'absent_days'  => $absent_days,
							'basic_sal'	   => $basic_salary,
							'payable_basic'=> $payable_basic,
							'da'			=> $da,
							'hra_amt_allowance'	=> $hra_amt_allowance,
							'hra_amt_deduction'	=> $hra_amt_deduction,
							'hra_rent'		=> $pay_control['HRA_RENT'],
							'hra_elect'		=> $pay_control['HRA_ELECT'],
							'hra_security'		=> $pay_control['HRA_SECURITY'],
							'hra_garage'		=> $pay_control['HRA_GARAGE'],
							'ta_amount'		=> $ta_amount,
							'fixed_allowance'	=> $fixed_allowance,
							'shift_allowance'	=> $shift_allowance,
							'second_shift_amt'	=> $second_shift_amt,
							'sh_rent'			=> $sh_rent,
							'arrear_basic'		=> $pay_control['ARREAR_BASIC'] + $prevArrearBasicAmt,
							'arrear_da'		=> $pay_control['ARREAR_DA'] + $prevArrearDAAmt,
							'arrear_hra'		=> $pay_control['ARREAR_HRA'],
							'arrear_ta'		=> $pay_control['ARREAR_TA'],
							'arrear_fixed_allow'	=> $pay_control['ARREAR_FIXED_ALLOW'],
							'arrear_shift_allow'	=> $pay_control['ARREAR_SHIFT_ALLOW'],
							'medical_reimbursment'	=> $medical_reimbursment,
							'gross_payable'			=> $gross_payable,
							'employee_pf'			=> $employee_pf,
							'fpf'					=> $fpf,
							'vpf'					=> $vpf,
							'lic'					=> $lic,
							'medical_deduction'		=> $medical_deduction,
							'tds'					=> $tds,
							'prof_tax'				=> $prof_tax,
							'staff_welfare_fund'	=> $staff_welfare_fund,
							'bus_deduct'			=> $bus_deduct,
							'esi_amt'				=> $esi_amt,
							'group_insurance_amt'	=> $group_insurance_amt,
							'salary_advance_deduction_amt'	=> $salary_advance_deduction_amt,
							'total_deduction'		=> $total_deduction,
							'payable_sal'			=> $payable_sal,
							
						);			
						$this->sumit->update('emp_leave_attendance',array('SALARY_STATUS'=>2,'UPDATE_LOCK'=>1),"date(DATE_FROM)<'$start_date' AND SALARY_STATUS='0' AND STATUS='1' AND EMPLOYEE_ID='".$value['EMPID']."'");
					}
				}
				$data['resultList'] = $result;
				$this->session->set_userdata('payslipGenerationSession',$result);
				$data['checkUpdationLock'] = $this->sumit->checkData('*','payslip_dbo',"payslip_year='$current_year' AND payslip_month='".$active_month['month_code']."' AND update_lock=1");
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-info">Attendance not generated for this month. Please generate attendance first.</div>');
			}
		}
		$data['current_year'] = $current_year;
		$data['current_month'] = $active_month['month_code'];
		$data['schoolSetting'] = $this->sumit->fetchSingleData('*','school_setting',array('S_No'=>1));
		$data['total_days'] = $total_days;
		$this->render_template('salary/payslipGeneration',$data);
	}

	public function getSingleEmployeeData()
	{
		$emp_id = $this->input->post('emp_id');
		$emloyeeData = $this->sumit->fetchSingleData('*','employee',array('id'=>$emp_id));
		echo json_encode($emloyeeData);
	}

	public function updateSinglePayControlData()
	{
		$response = array();
		
		$column_name = $this->input->post('column_name');
		$val = $this->input->post('input_val');
		$emp_id = $this->input->post('emp_id');

		$data = array(
			'EMPLOYEE_ID'=> $emp_id,
			$column_name => $val);

		$check_data = $this->sumit->checkData('*','pay_control',array('EMPLOYEE_ID'=>$emp_id));
		if($check_data)
		{
			$process = $this->sumit->update('pay_control',$data,array('EMPLOYEE_ID'=>$emp_id));
		}
		else
		{
			$process = $this->sumit->createData('pay_control',$data);
		}
		if($process)
		{
			$response['msg'] = 1;
		}
		else
		{
			$response['msg'] = 2;
		}
		echo json_encode($response);
	}

	public function generateMonthlyPayslip()
	{
		$process = 0;
		$response = array();
		$emp_id = $this->input->post('emp_id');
		$empData = implode("','", $emp_id);
		$employeeList = $this->sumit->fetchAllData('*','employee',"id IN ('$empData')");
		$pf_master_details = $this->sumit->fetchLastData('*','masterpf',array(),'id');
		$payslipGenData = $this->session->userdata('payslipGenerationSession');

		foreach ($employeeList as $key => $value) {

			$pay_control = $this->sumit->fetchSingleData('*','pay_control',array('EMPLOYEE_ID'=>$value['id']));
			$data = array(
				'emp_id'				=> $value['id'],
				'total_working_days'	=> $payslipGenData[$value['EMPID']]['working_days'],
				'total_present'			=> $payslipGenData[$value['EMPID']]['present_days'],
				'payslip_year'			=> $payslipGenData[$value['EMPID']]['payslip_year'],
				'payslip_month'			=> $payslipGenData[$value['EMPID']]['payslip_month'],
				'actual_basic'			=> $payslipGenData[$value['EMPID']]['basic_sal'],
				'basic_salary'			=> $payslipGenData[$value['EMPID']]['payable_basic'],
				'da_percent'			=> $pf_master_details['da_rate'],
				'da_pay'				=> $payslipGenData[$value['EMPID']]['da'],
				'pension_rate'			=> $pf_master_details['PEN_RATE'],
				'hra_app'				=> $value['HRA_APP'],
				'hra_rate_percent'		=> $pf_master_details['HRA_Rate'],
				'hra_pay'				=> $payslipGenData[$value['EMPID']]['hra_amt_allowance'],
				'ta_allowance_applied'	=> $value['TA_ALLOWANCE_APP'],
				'ta_level'				=> ($value['TA_SLAB']=='')?0:$value['TA_SLAB'],
				'ta_pay'				=> $payslipGenData[$value['EMPID']]['ta_amount'],
				'fixed_allowance'		=> $payslipGenData[$value['EMPID']]['fixed_allowance'],
				'shift_allowance'		=> $payslipGenData[$value['EMPID']]['shift_allowance'],
				'second_shift_applied'	=> $value['SECOND_SHIFT_ALLOW'],
				'second_shift_amount'	=> $payslipGenData[$value['EMPID']]['second_shift_amt'],
				'sh_rent'				=> $payslipGenData[$value['EMPID']]['sh_rent'],
				'medical_reimbursement'	=> $payslipGenData[$value['EMPID']]['medical_reimbursment'],
				'gross_salary'			=> $payslipGenData[$value['EMPID']]['gross_payable'],
				'pf_app'				=> $value['PF_APP'],
				'pf_own_rate'			=> $pf_master_details['OWN_RATE'],
				'pf_emp_rate'			=> $pf_master_details['EMP_RATE'],
				'pf_own_deduct'			=> $payslipGenData[$value['EMPID']]['employee_pf'],
				'fpf_deduct'			=> $payslipGenData[$value['EMPID']]['fpf'],
				'vpf_deduct'			=> $payslipGenData[$value['EMPID']]['vpf'],
				'esi_app'				=> $value['ESI_APP'],
				'esi_own_rate'			=> $pf_master_details['ESI_OWN_RATE'],
				'esi_emp_rate'			=> $pf_master_details['ESI_EMP_RATE'],
				'esi_limit'				=> $pf_master_details['ESI_LIMIT'],
				'esi_deduct'			=> $payslipGenData[$value['EMPID']]['esi_amt'],
				'prof_tax'				=> $payslipGenData[$value['EMPID']]['prof_tax'],
				'lic'					=> $payslipGenData[$value['EMPID']]['lic'],
				'hra_rent_deduct'		=> round($pay_control['HRA_RENT']),
				'hra_security_deduct'	=> round($pay_control['HRA_SECURITY']),
				'hra_garage_deduct'		=> round($pay_control['HRA_GARAGE']),
				'hra_elect_deduct'		=> round($pay_control['HRA_ELECT']),
				'group_ins_app'			=> $value['GROUP_INS_POLI'],
				'group_insurance_amt'	=> $payslipGenData[$value['EMPID']]['group_insurance_amt'],
				'staff_welfare_fund'	=> $payslipGenData[$value['EMPID']]['staff_welfare_fund'],
				'tds_deduct'			=> $payslipGenData[$value['EMPID']]['tds'],
				'medical_deduct'		=> $payslipGenData[$value['EMPID']]['medical_deduction'],
				'advance_salary_deduct'	=> $payslipGenData[$value['EMPID']]['salary_advance_deduction_amt'],
				'bus_deduction'			=> $payslipGenData[$value['EMPID']]['bus_deduct'],
				'total_deduction'		=> $payslipGenData[$value['EMPID']]['total_deduction'],
				'arrear_basic'			=> $payslipGenData[$value['EMPID']]['arrear_basic'],
				'arrear_da'				=> $payslipGenData[$value['EMPID']]['arrear_da'],
				'arrear_hra'			=> $payslipGenData[$value['EMPID']]['arrear_hra'],
				'arrear_ta'				=> $payslipGenData[$value['EMPID']]['arrear_ta'],
				'arrear_fixed_allow'	=> $payslipGenData[$value['EMPID']]['arrear_fixed_allow'],
				'arrear_shift_allow'	=> $payslipGenData[$value['EMPID']]['arrear_shift_allow'],
				'payable_amt'			=> $payslipGenData[$value['EMPID']]['payable_sal'],
			);

			$check_prev_data = $this->sumit->checkData('emp_id','payslip_dbo',array('emp_id'=>$value['id'],'payslip_month'=>$payslipGenData[$value['EMPID']]['payslip_month'],'payslip_year'=>$payslipGenData[$value['EMPID']]['payslip_year']));
			if($check_prev_data)
			{
				$process = $this->sumit->update('payslip_dbo',$data,array('emp_id'=>$value['id'],'payslip_month'=>$payslipGenData[$value['EMPID']]['payslip_month'],'payslip_year'=>$payslipGenData[$value['EMPID']]['payslip_year'],'update_lock'=>0));
			}
			else
			{
				$process = $this->sumit->createData('payslip_dbo',$data);
				if($process)
				{
					$salary_advance_deduction_amt = $payslipGenData[$value['EMPID']]['salary_advance_deduction_amt'];

					$advance_sal_data = array(
						'EMPLOYEE_ID'		=>	$value['id'],
						'AMOUNT'			=>	round($salary_advance_deduction_amt),
						'DATE'				=>	date('Y-m-d'),
						'NO_OF_INSTALLMENT'	=>	1,
						'STATUS'			=>	2,
					);
					if($salary_advance_deduction_amt > 0)
					{
						$create = $this->sumit->createData('advance_salary_history',$advance_sal_data);
						$total_due_amt = $pay_control['TOTAL_DUE_AMT'] - round($salary_advance_deduction_amt);
						$final_no_of_installment = $pay_control['NO_OF_INSTALLMENT'] - 1;
						$this->sumit->update('pay_control',array('TOTAL_DUE_AMT'=>$total_due_amt,'NO_OF_INSTALLMENT'=>$final_no_of_installment),array('EMPLOYEE_ID'=>$value['id']));
					}
				}
			}
		}
		if($process)
		{
			$response['msg'] = 1;
		}
		else
		{
			$response['msg'] = 2;
		}
		echo json_encode($response);
	}


	public function updationLock()
	{
		$response = array();
		$emp_id = $this->input->post('emp_id');
		$month = $this->input->post('month');
		$year = $this->input->post('year');

		foreach ($emp_id as $key => $value) {
			
			$update = $this->sumit->update('payslip_dbo',array('update_lock'=>1),array('emp_id'=>$value,'payslip_month'=>$month,'payslip_year'=>$year));
			if($update)
			{
				$response['msg'] = 1;
			}
			else
			{
				$response['msg'] = 2;
			}
		}
		echo json_encode($response);
	}

	public function checkPayslipGenerated()
	{
		$response = array();
		$month = $this->input->post('current_month');
		$year = $this->input->post('current_year');
		$checkData = $this->sumit->checkData('*','payslip_dbo',array('payslip_month'=>$month,'payslip_year'=>$year));
		if($checkData)
		{
			$response['msg'] = 1;
		}else
		{
			$response['msg'] = 2;
		}
		echo json_encode($response);
	}

	public function sendSMS()
	{
		$mobile = $this->input->post('mobile');
		$otp = rand(100000,999999);
		$message = "OTP For Payslip Unlock is ".$otp;
		$this->session->set_userdata('msgpayslip',$otp);
		$this->sms_lib->sendSMS($mobile,$message);
	}

	public function verifyOTP()
	{
		$response = array();
		$otp = $this->input->post('otptext');
		$session_otp = $this->session->userdata('msgpayslip');
		if($otp == $session_otp)
		{
			$this->session->set_userdata('unlocksuccess','1');
			$response['msg'] = 1;
		}
		else
		{
			$response['msg'] = 2;
		}
		echo json_encode($response);
	}
}

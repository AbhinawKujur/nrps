<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paycontrol extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}
	public function index()
	{
		if(!in_array('viewPayControl', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$data['paycontrol'] = $this->sumit->fetchTwoJoin('employee.EMPID as EMP_ID,employee.EMP_FNAME,employee.EMP_MNAME,employee.EMP_LNAME,pay_control.*','employee','pay_control','pay_control.EMPLOYEE_ID=employee.id',array('STATUS'=>1));
		$this->render_template('paycontrol/viewPayControl',$data);
	}

	public function update()
	{
		if(!in_array('editPayControl', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$data['employeeDetails'] = $this->sumit->fetchTwoJoin('employee.*,desig.DESIG','employee','desig','employee.DESIG=desig.Sno');
		$data['designation'] = $this->sumit->fetchAllData('*','desig',array());
		$this->render_template('paycontrol/editPayControl',$data);		
	}

	public function updateDeduction()
	{
		if(!in_array('editPayControl', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		$id = $this->input->post('id');
		if($id == null)
		{
			redirect('pay_control/paycontrol');
		}
		$response = array();
		$data = array(
				'EMPLOYEE_ID'		=> $id,
				'FPF'				=> $this->input->post('fpf'),
				'VPF'				=> $this->input->post('vpf'),
				'PROF_TAX'			=> $this->input->post('prof_tax'),
				'LIC'				=> $this->input->post('lic'),
				'TDS'				=> $this->input->post('tds'),
				'MEDICAL_DEDUCT'	=> $this->input->post('medical_deduction'),
				'SH_RENT'			=> $this->input->post('sh_rent'),
				'HRA_RENT'			=> $this->input->post('rent'),
				'HRA_ELECT'			=> $this->input->post('electricity'),
				'HRA_SECURITY'		=> $this->input->post('security'),
				'HRA_GARAGE'		=> $this->input->post('garage'),
				'FIXED_ALLOW'		=> $this->input->post('fixed_allow'),
				'SHIFT_ALLOW'		=> $this->input->post('shift_allow'),
				'MEDICAL_REIMBURSEMENT'	=> $this->input->post('medical_reimbursement'),
				'ARREAR_BASIC'		=> $this->input->post('arrear_basic'),
				'ARREAR_DA'			=> $this->input->post('arrear_da'),
				'ARREAR_HRA'		=> $this->input->post('arrear_hra'),
				'ARREAR_TA'			=> $this->input->post('arrear_ta'),
				'ARREAR_FIXED_ALLOW'=> $this->input->post('arrear_fixed_allowance'),
				'ARREAR_SHIFT_ALLOW'=> $this->input->post('arrear_shift_allowance'),
			);

			$check_data = $this->sumit->checkData('*','pay_control',array('EMPLOYEE_ID'=>$id));
			if($check_data)
			{
				$process = $this->sumit->update('pay_control',$data,array('EMPLOYEE_ID'=>$id));
			}
			else
			{
				$process = $this->sumit->createData('pay_control',$data);
			}

			if($this->input->post('advance_salary_amount') > '0')
			{
				$amount = $this->input->post('advance_salary_amount');
				$no_of_installment = $this->input->post('no_of_installment');
				$advance_salary_date = $this->input->post('advance_salary_date');
				$result = array(
					'EMPLOYEE_ID'		=>  $id,
					'AMOUNT'			=>  $amount,
					'NO_OF_INSTALLMENT'	=>  $no_of_installment,
					'DATE'				=>  date('Y-m-d',strtotime($advance_salary_date)),
					'STATUS'			=>  1
				);
				$this->sumit->createData('advance_salary_history',$result);
				$process = $this->sumit->update('pay_control',array('TOTAL_ADV_SAL_AMT'=>$amount,'TOTAL_DUE_AMT'=>$amount,'NO_OF_INSTALLMENT'=>$no_of_installment),array('EMPLOYEE_ID'=>$id));
			}
			
			if($process)
			{
				$response['message'] = 1;
			}
			else
			{
				$response['message'] = 2;
			}
			echo json_encode($response);
	}



	public function getEmpDetails()
	{
		$id = $this->input->post('id');
		$data = $this->sumit->getSingleEmployee($id);
		$data['D_O_B'] = date('d-M-Y',strtotime($data['D_O_B']));
		$data['D_O_J'] = date('d-M-Y',strtotime($data['D_O_J']));
		echo json_encode($data);
	}

	public function getPayControlDetails()
	{
		$emp_id = $this->input->post('emp_id');
		$data = $this->sumit->fetchSingleData('*','pay_control',array('EMPLOYEE_ID'=>$emp_id));
		echo json_encode($data);
	}

	public function getAdvanceSalaryDetails($emp_id = null)
	{
		$result = array();
		$data = $this->sumit->fetchAllDataWithOrder('*','advance_salary_history',array('EMPLOYEE_ID'=>$emp_id),'ID','ASC');

		$result = array('data' => array());
		$balance = 0;

		foreach ($data as $key => $value) {

			if($value['STATUS'] == 1)
			{
				$status = "Advance Salary";
				$balance = $balance + $value['AMOUNT'];
			}
			elseif($value['STATUS'] == 2)
			{
				$status = "Deduction Amount";
				$balance = $balance - $value['AMOUNT'];
			}
			
			$result['data'][] = array(
				$value['DATE'],
				$value['AMOUNT'],
				$value['NO_OF_INSTALLMENT'],
				$balance,
				$status,
			);
		}
		echo json_encode($result);
	}

	public function createNewAdvanceSalary()
	{
		$response = array();
		$emp_id = $this->input->post('emp_id');
		$new_sal_amt = $this->input->post('new_sal_amt');
		$no_of_inst = $this->input->post('no_of_inst');
		$new_sal_date = $this->input->post('new_sal_date');

		$data = array(
			'EMPLOYEE_ID'		=>  $emp_id,
			'AMOUNT'			=>  $new_sal_amt,
			'NO_OF_INSTALLMENT'	=>  $no_of_inst,
			'DATE'				=>  $new_sal_date
		);

		$insert_id = $this->sumit->createDataReturnID('advance_salary_history',$data);
		if($insert_id)
		{
			$prevAmt = $this->sumit->fetchSingleData('TOTAL_ADV_SAL_AMT,TOTAL_DUE_AMT,NO_OF_INSTALLMENT','pay_control',array('EMPLOYEE_ID'=>$emp_id));
			$total_amt = $new_sal_amt + $prevAmt['TOTAL_ADV_SAL_AMT'];
			$resultData = array(
				'TOTAL_ADV_SAL_AMT'	=> $total_amt,
				'TOTAL_DUE_AMT'	=> $new_sal_amt + $prevAmt['TOTAL_DUE_AMT'],
				'NO_OF_INSTALLMENT' => $no_of_inst,
			);
			$this->sumit->update('pay_control',$resultData,array('EMPLOYEE_ID'=>$emp_id));
			$response['message'] = 1;
		}
		else
		{
			$response['message'] = 2;
		}
		echo json_encode($response);
	}

	public function updateAdvanceSalary()
	{
		$response = array();
		$emp_id = $this->input->post('emp_id');
		$adv_sal_amt = $this->input->post('adv_sal_amt');
		$no_of_install = $this->input->post('no_of_install');
		$install_amt = $this->input->post('install_amt');
		$date = $this->input->post('date');

		$data = array(
			'EMPLOYEE_ID'		=>  $emp_id,
			'AMOUNT'			=>  $adv_sal_amt,
			'NO_OF_INSTALLMENT'	=>  $no_of_install,
			'INSTALL_AMT'		=>  $install_amt,
			'DATE'				=>  $date
		);

		$update = $this->sumit->update('advance_salary_history',$data,array('EMPLOYEE_ID'=>$emp_id));
		if($update)
		{
			$response['message'] = 1;
		}
		else
		{
			$response['message'] = 2;
		}
		echo json_encode($response);
	}

	public function checkAdvanceSalaryHistory()
	{
		$response = array();
		$emp_id = $this->input->post('emp_id');

		$check = $this->sumit->checkData('*','advance_salary_history',array('EMPLOYEE_ID'=>$emp_id));
		if($check)
		{
			$response['message'] = 1;
		}
		else
		{
			$response['message'] = 2;
		}
		echo json_encode($response);
	}


	public function showTotalAmtBox()
	{
		$emp_id = $this->input->post('emp_ids');
		$new_sal_amt = $this->input->post('new_sal_amt');
		$prevAmt = $this->sumit->fetchSingleData('TOTAL_ADV_SAL_AMT,TOTAL_DUE_AMT,NO_OF_INSTALLMENT','pay_control',array('EMPLOYEE_ID'=>$emp_id));
		$result = $new_sal_amt + $prevAmt['TOTAL_ADV_SAL_AMT'];
		echo json_encode($result);
	}
}

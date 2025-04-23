<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salincrement extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	}
	
	public function index()
	{
		if(!in_array('editApprovalofArrearSalary', permission_data))
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
		$data['total_days'] = cal_days_in_month(CAL_GREGORIAN, $active_month['month_code'], $current_year);
		$data['current_year'] = $current_year;
		$data['current_month'] = $active_month['month_code'];
		$data['empData'] = $this->attendance->getEmployeeDataForSalaryIncrement($current_year);
		$this->render_template('salary/salaryIncrement',$data);
	}

	public function approveArrearSalary()
	{
		$emp_id = $this->input->post('emp_id');
		$updateData =  array(
			'sal_increase_status'	=> 2
		);
		$getEmpDetails = $this->sumit->fetchTwoJoin('emp.*,s.pay','employee emp','seventh_pay s',"s.level_no=emp.new_level_no AND s.level_year=emp.new_level_year","emp.id='$emp_id'");

		$update  = $this->sumit->update('employee',$updateData,array('id'=>$emp_id));
		if($update)
		{
			$updateNewBasic = array(
				'LEVEL_NO'		=> $getEmpDetails[0]['new_level_no'],
				'LEVEL_YEAR'	=> $getEmpDetails[0]['new_level_year'],
				'BASIC'			=> $getEmpDetails[0]['pay'],
			);
			$update  = $this->sumit->update('employee',$updateNewBasic,array('id'=>$emp_id));
			echo 1;
		}
		else
		{
			echo 2;
		}
	}

}
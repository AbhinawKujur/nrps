<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Second_shift extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	}
	
	public function index(){

		if(!in_array('viewSecondShiftAttendance', permission_data))
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
		$data['empData'] = $this->attendance->getSecondShiftAttendanceData($data['current_year'],$data['current_month']);
		$this->render_template('salary/secondShiftAttendGen',$data);
	}

	public function attendanceGen()
	{
		if(!in_array('editSecondShiftAttendance', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		$output = 0;
		$current_year = $this->input->post('current_year');
		$current_month = $this->input->post('current_month');
		$empData =  $this->attendance->getSecondShiftAttendanceData($current_year,$current_month);

		foreach ($empData as $key => $value) {
			
			$shift_amount = $this->input->post('shift_amount_'.$key);
			$shift_allowance = $this->input->post('shift_allowance_'.$key);

			$data = array(
				'emp_id'		=> $value['id'],
				'month'			=> $current_month,
				'year'			=> $current_year,
				'shift_amount'	=> $shift_amount,
				'shift_allowance'	=> $shift_allowance,
			);
			
			$check_data = $this->sumit->checkData('*','second_shift_attendance',array('emp_id'=>$value['id'],'month'=>$current_month,'year'=>$current_year));
			if($check_data)
			{
				$output = $this->sumit->update('second_shift_attendance',$data,array('emp_id'=>$value['id'],'month'=>$current_month,'year'=>$current_year,'update_lock'=>0));
			}
			else
			{
				$output = $this->sumit->createData('second_shift_attendance',$data);
			}
		}
		if($output)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">Data Saved Successfully.</div>');
		}
		redirect('payroll/salary/second_shift');
	}
}

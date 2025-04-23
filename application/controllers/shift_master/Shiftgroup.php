<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shiftgroup extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}
	public function index()
	{
		if(!in_array('viewShift', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$data['shiftMaster'] =$this->sumit->fetchAllData('*','shift_master',array());
		$this->render_template('shift_master/shiftGroup',$data);
	}

	public function create()
	{
		if(!in_array('addShift', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$response = array();
		$data = array(
			'SHIFT_NAME'	=> strtoupper($this->input->post('name')),
			'SHORT_NAME'	=> strtoupper($this->input->post('short_name')),
			'START_TIME'	=> $this->input->post('start_time'),
			'STOP_TIME'		=> $this->input->post('end_time'),
			'SHIFT_DURATION'=> $this->input->post('shift_duration'),
			'RECESS_DURATION'=> $this->input->post('recess_duration'),
			'MIN_HRS_HALF'	=> $this->input->post('half_day_min_hrs'),
			'MIN_HRS_FULL'	=> $this->input->post('full_day_min_hrs'),
		);
		$create = $this->sumit->createData('shift_master',$data);
		if($create)
		{
			$response['msg'] = 1;
		}
		else
		{
			$response['msg'] = 2;
		}
		echo json_encode($response);
	}

	public function update()
	{
		if(!in_array('editShift', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		$id = $this->input->post('id');
		$response = array();
		$data = array(
			'SHIFT_NAME'	=> strtoupper($this->input->post('name')),
			'SHORT_NAME'	=> strtoupper($this->input->post('short_name')),
			'START_TIME'	=> $this->input->post('start_time'),
			'STOP_TIME'		=> $this->input->post('end_time'),
			'SHIFT_DURATION'=> $this->input->post('shift_duration'),
			'RECESS_DURATION'=> $this->input->post('recess_duration'),
			'MIN_HRS_HALF'	=> $this->input->post('half_day_min_hrs'),
			'MIN_HRS_FULL'	=> $this->input->post('full_day_min_hrs'),
		);
		$update = $this->sumit->update('shift_master',$data,array('ID'=>$id));
		if($update)
		{
			$response['msg'] = 1;
		}
		else
		{
			$response['msg'] = 2;
		}
		echo json_encode($response);
	}

	public function getSingleShift()
	{
		$id = $this->input->post('id');
		$data = $this->sumit->fetchSingleData('*','shift_master',array('ID'=>$id));
		echo json_encode($data);
	}

}

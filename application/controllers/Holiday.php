<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Holiday extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	}
	
	public function index(){
		$data['holidayList'] = $this->sumit->fetchAllData('*,(SELECT CLASS_NM FROM classes WHERE Class_No=hm.CLASS_ID) as class_name','holiday_master hm',array());
		$data['classList'] = $this->sumit->fetchAllData('*','classes',array());
		$this->render_template('holiday/holidayList',$data);
	}

	public function create()
	{
		$response = array();
		if($this->input->post('day_type') == 1)
		{
			$date = $this->input->post('date');
			$date = date('Y-m-d',strtotime($date));
			$to_date = $this->input->post('date');
			$to_date = date('Y-m-d',strtotime($to_date));
		}
		else
		{
			$date = $this->input->post('from_date');
			$date = date('Y-m-d',strtotime($date));
			$to_date = $this->input->post('to_date');
			$to_date = date('Y-m-d',strtotime($to_date));
		}
		$applied_for = $this->input->post('applied_for');
		$class = $this->input->post('class');
		if($applied_for == 1 || $applied_for == 0)
		{
			$class = 0;
		}
		$data = array(
			'NAME'		=> strtoupper($this->input->post('name')),
			'DAY_TYPE'	=> $this->input->post('day_type'),
			'FROM_DATE'	=> $date,
			'TO_DATE'	=> $to_date,
			'APPLIED_FOR'=> $applied_for,
			'CLASS_ID'	=> $class,
		);

		$create = $this->sumit->createData('holiday_master',$data);
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
		$id = $this->input->post('id');
		$response = array();
		if($this->input->post('day_type') == 1)
		{
			$date = $this->input->post('date');
			$date = date('Y-m-d',strtotime($date));
			$to_date = $this->input->post('date');
			$to_date = date('Y-m-d',strtotime($to_date));
		}
		else
		{
			$date = $this->input->post('from_date');
			$date = date('Y-m-d',strtotime($date));
			$to_date = $this->input->post('to_date');
			$to_date = date('Y-m-d',strtotime($to_date));
		}
		$applied_for = $this->input->post('applied_for');
		$class = $this->input->post('class');
		if($applied_for == 1 || $applied_for == 0)
		{
			$class = 0;
		}
		$data = array(
			'NAME'		=> strtoupper($this->input->post('name')),
			'DAY_TYPE'	=> $this->input->post('day_type'),
			'FROM_DATE'	=> $date,
			'TO_DATE'	=> $to_date,
			'APPLIED_FOR'=> $applied_for,
			'CLASS_ID'	=> $class,
		);

		$update = $this->sumit->update('holiday_master',$data,array('ID'=>$id,'UPDATE_LOCK'=>0));
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

	public function getSingeHoliday()
	{
		$id = $this->input->post('id');
		$data = $this->sumit->fetchSingleData('*','holiday_master',array('ID'=>$id));
		echo json_encode($data);
	}
}

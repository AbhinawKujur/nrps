<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campusmaster extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}
	public function index()
	{
		// if(!in_array('viewDesignation', permission_data))
		// {
		// 	redirect('payroll/dashboard/dashboard');
		// }
		
		$data['campusList'] =$this->sumit->fetchAllData('*','campus_master',array());
		$this->render_template('timetable/campusMaster',$data);
	}

	public function create()
	{
		$this->form_validation->set_rules('name','Name','trim|required|is_unique[campus_master.Campus_Name]');
		if($this->form_validation->run()==TRUE)
		{
			$data = array(
				'Campus_Name'		=> strtoupper($this->input->post('name')),
			);

			$insert = $this->sumit->createData('campus_master',$data);
			if($insert)
			{
				$this->session->set_flashdata('msg','<div class="alert alert-success">Record Added Successfully</div>');
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-warning">Creation Failed!</div>');
			}
		}
		redirect('timetable/campusmaster');
	}

	public function update()
	{
		$id = $this->input->post('id');
		$data = array(
			'Campus_Name'		=> strtoupper($this->input->post('name')),
		);

		$updated = $this->sumit->update('campus_master',$data,array('Campus_ID'=>$id));
		if($updated)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">Record Updated Successfully</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Updation Failed!</div>');
		}
		redirect('timetable/campusmaster');
	}

	public function checkName()
	{
		$name = $this->input->post('name');
		$check = $this->sumit->checkData('*','campus_master',array('Campus_Name'=>$name));
		if($check)
		{
			echo json_encode('Name already exist');
		}
		else
		{
			echo json_encode('true');
		}
	}

	public function checkNameatEdit()
	{
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$check = $this->sumit->checkData('*','campus_master',array('Campus_Name'=>$name,'Campus_ID !='=>$id));
		if($check)
		{
			echo json_encode('Name already exist');
		}
		else
		{
			echo json_encode('true');
		}
	}

	public function getSingleData()
	{
		$id = $this->input->post('id');
		$data = $this->sumit->fetchSingleData('*','campus_master',array('Campus_ID'=>$id));
		echo json_encode($data);
	}
}

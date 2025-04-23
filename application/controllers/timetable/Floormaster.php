<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Floormaster extends MY_Controller {

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
		
		$data['wingList'] =$this->sumit->fetchAllData('*','wing_master',array());
		$data['floorList'] = $this->timetable_model->getFloorList();
		$this->render_template('timetable/floorMaster',$data);
	}

	public function create()
	{
		$this->form_validation->set_rules('floor_name','Name','trim|required');
		if($this->form_validation->run()==TRUE)
		{
			$wing = $this->input->post('wing_name');
			$wingDetails = $this->sumit->fetchSingleData('*','wing_master',"ID='$wing'");
			$data = array(
				'Floor_Name'	=> strtoupper($this->input->post('floor_name')),
				'Campus_ID'		=> $wingDetails['CAMPUS_MASTER_ID'],
				'Building_ID'	=> $wing,
			);

			$insert = $this->sumit->createData('floor_master',$data);
			if($insert)
			{
				$this->session->set_flashdata('msg','<div class="alert alert-success">Record Added Successfully</div>');
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-warning">Creation Failed!</div>');
			}
		}
		redirect('timetable/floormaster');
	}

	public function update()
	{
		$id = $this->input->post('id');
		$wing = $this->input->post('wing_name');
		$wingDetails = $this->sumit->fetchSingleData('*','wing_master',"ID='$wing'");
		$data = array(
			'Floor_Name'	=> strtoupper($this->input->post('floor_name')),
			'Campus_ID'		=> $wingDetails['CAMPUS_MASTER_ID'],
			'Building_ID'	=> $wing,
		);

		$updated = $this->sumit->update('floor_master',$data,array('Floor_ID'=>$id));
		if($updated)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">Record Updated Successfully</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Updation Failed!</div>');
		}
		redirect('timetable/floormaster');
	}

	public function checkName()
	{
		$wing = $this->input->post('wing_name');
		$name = $this->input->post('floor_name');
		$check = $this->sumit->checkData('*','floor_master',array('Floor_Name'=>$name,'Building_ID'=>$wing));
		if($check)
		{
			echo json_encode('Name already exist in this wing');
		}
		else
		{
			echo json_encode('true');
		}
	}

	public function checkNameatEdit()
	{
		$id = $this->input->post('id');
		$wing = $this->input->post('wing_name');
		$name = $this->input->post('floor_name');
		$check = $this->sumit->checkData('*','floor_master',array('Floor_Name'=>$name,'Building_ID'=>$wing,'Floor_ID !='=>$id));
		if($check)
		{
			echo json_encode('Name already exist in this wing');
		}
		else
		{
			echo json_encode('true');
		}
	}

	public function getSingleData()
	{
		$id = $this->input->post('id');
		$data = $this->sumit->fetchSingleData('*','floor_master',array('Floor_ID'=>$id));
		echo json_encode($data);
	}
}

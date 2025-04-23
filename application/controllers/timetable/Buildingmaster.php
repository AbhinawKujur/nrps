<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buildingmaster extends MY_Controller {

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
		$data['wingList'] =$this->sumit->fetchAllData('*','wing_master',array());
		$data['buildingList'] = $this->sumit->fetchAllData('*,(SELECT Campus_Name FROM campus_master WHERE Campus_ID=w.CAMPUS_MASTER_ID)CAMPUS_NAME','wing_master w',array());
		$this->render_template('timetable/buildingMaster',$data);
	}
	public function update()
	{
		$id = $this->input->post('wing');
		$data = array(
			'CAMPUS_MASTER_ID'	=> $this->input->post('campus'),
		);

		$updated = $this->sumit->update('wing_master',$data,array('ID'=>$id));
		if($updated)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">Record Updated Successfully</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Updation Failed!</div>');
		}
		redirect('timetable/buildingmaster');
	}

	public function getSingleData()
	{
		$id = $this->input->post('id');
		$data = $this->sumit->fetchSingleData('*','wing_master',array('ID'=>$id));
		echo json_encode($data);
	}
}

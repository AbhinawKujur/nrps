<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Narration extends MY_Controller {

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
		
		$data['narrationList'] =$this->sumit->fetchAllData('*','acnar',array());
		$this->render_template('account_master/narrationMaster',$data);
	}

	public function create()
	{
		$data = array(
			'Act'		=> strtoupper($this->input->post('name')),
		);

		$insert = $this->sumit->createData('acnar',$data);
		if($insert)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">Record Added Successfully</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Creation Failed!</div>');
		}
		redirect('account_master/narration');
	}

	public function update()
	{
		$id = $this->input->post('id');
		$data = array(
			'Act'		=> strtoupper($this->input->post('name')),
		);

		$updated = $this->sumit->update('acnar',$data,array('Id'=>$id));
		if($updated)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">Record Updated Successfully</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Updation Failed!</div>');
		}
		redirect('account_master/narration');
	}

	public function checkNarrationName()
	{
		$name = $this->input->post('name');
		$check = $this->sumit->checkData('*','acnar',array('Act'=>$name));
		if($check)
		{
			echo json_encode('Record already exist');
		}
		else
		{
			echo json_encode('true');
		}
	}

	public function checkNarrationNameatEdit()
	{
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$check = $this->sumit->checkData('*','acnar',array('Act'=>$name,'Id !='=>$id));
		if($check)
		{
			echo json_encode('Record already exist');
		}
		else
		{
			echo json_encode('true');
		}
	}

	public function getSingleData()
	{
		$id = $this->input->post('id');
		$data = $this->sumit->fetchSingleData('*','acnar',array('Id'=>$id));
		echo json_encode($data);
	}
}

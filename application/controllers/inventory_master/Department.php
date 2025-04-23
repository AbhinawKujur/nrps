<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends MY_Controller {

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
		
		$data['departmentList'] =$this->sumit->fetchAllData('*','department_master',array());
		$this->render_template('inventory_master/department',$data);
	}

	public function create()
	{
		$data = array(
			'Department_Name'	=> strtoupper($this->input->post('name')),
			'Concerned_Person'	=> strtoupper($this->input->post('person_name')),
			'Concerned_Person_Mob_No'=> $this->input->post('mobile'),
		);

		$insert = $this->sumit->createData('department_master',$data);
		if($insert)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">Record Added Successfully</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Creation Failed!</div>');
		}
		redirect('inventory_master/department');
	}

	public function update()
	{
		$id = $this->input->post('id');
		$data = array(
			'Department_Name'	=> strtoupper($this->input->post('name')),
			'Concerned_Person'	=> strtoupper($this->input->post('person_name')),
			'Concerned_Person_Mob_No'=> $this->input->post('mobile'),
		);

		$updated = $this->sumit->update('department_master',$data,array('Department_ID'=>$id));
		if($updated)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">Record Updated Successfully</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Updation Failed!</div>');
		}
		redirect('inventory_master/department');
	}

	public function checkName()
	{
		$name = $this->input->post('name');
		$check = $this->sumit->checkData('*','department_master',array('Department_Name'=>$name));
		if($check)
		{
			echo json_encode('Record already exist');
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
		$check = $this->sumit->checkData('*','department_master',array('Department_Name'=>$name,'Department_ID !='=>$id));
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
		$data = $this->sumit->fetchSingleData('*','department_master',array('Department_ID'=>$id));
		echo json_encode($data);
	}
}

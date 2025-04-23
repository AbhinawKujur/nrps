<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schoolgroup extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}
	public function index()
	{
		if(!in_array('viewSchoolGroup', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		$data['schoolGroupList'] =$this->sumit->fetchAllData('*','accscg',array());
		$this->render_template('account_master/schoolGroupMaster',$data);
	}

	public function create()
	{
		if(!in_array('addSchoolGroup', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$data = array(
			'CAT_ABBR'		=> strtoupper($this->input->post('name')),
			'CAT_DESC'		=> strtoupper($this->input->post('details')),
			'CAT_Amt'		=> $this->input->post('budget_amount'),
		);

		$insert = $this->sumit->createData('accscg',$data);
		if($insert)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">School Group Created Successfully</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Creation Failed!</div>');
		}
		redirect('account_master/schoolgroup');
	}

	public function update()
	{
		if(!in_array('editSchoolGroup', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$cat_code = $this->input->post('group_no');
		$data = array(
			'cat_code'		=> $cat_code,
			'CAT_ABBR'		=> strtoupper($this->input->post('name')),
			'CAT_DESC'		=> strtoupper($this->input->post('details')),
			'CAT_Amt'		=> $this->input->post('budget_amount'),
		);

		$updated = $this->sumit->update('accscg',$data,array('cat_code'=>$cat_code));
		if($updated)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">School Group Updated Successfully</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Updation Failed!</div>');
		}
		redirect('account_master/schoolgroup');
	}

	public function checkGroupName()
	{
		$name = $this->input->post('name');
		$check = $this->sumit->checkData('*','accscg',array('CAT_ABBR'=>$name));
		if($check)
		{
			echo json_encode('Group Name already exist');
		}
		else
		{
			echo json_encode('true');
		}
	}

	public function checkGroupNameAtEdit()
	{
		$group_no = $this->input->post('group_no');
		$name = $this->input->post('name');
		$check = $this->sumit->checkData('*','accscg',array('CAT_ABBR'=>$name,'cat_code !='=>$group_no));
		if($check)
		{
			echo json_encode('Group Name already exist');
		}
		else
		{
			echo json_encode('true');
		}
	}

	public function getSingleData()
	{
		$group_no = $this->input->post('group_no');
		$data = $this->sumit->fetchSingleData('*','accscg',array('cat_code'=>$group_no));
		echo json_encode($data);
	}
}

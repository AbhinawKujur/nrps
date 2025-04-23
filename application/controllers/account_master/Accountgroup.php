<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accountgroup extends MY_Controller {

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
		
		$data['accountGroupList'] =$this->sumit->fetchAllData('*','acgroup',"1 ORDER BY AcName");
		$this->render_template('account_master/accountGroup',$data);
	}

	public function create()
	{
		$getLastGroupNo = $this->sumit->fetchSingleData('max(id)id','acgroup',array());
		$group_no = 'G'.($getLastGroupNo['id']+1);

		$data = array(
			'GName'		=> $group_no,
			'AcName'	=> strtoupper($this->input->post('name')),
			'AcType'	=> strtoupper($this->input->post('group_type')),
			'YesNo'		=> 'NO',
		);

		$insert = $this->sumit->createData('acgroup',$data);
		if($insert)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">Account Group Created Successfully</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Creation Failed!</div>');
		}
		redirect('account_master/accountgroup');
	}

	public function update()
	{
		$id = $this->input->post('id');
		$data = array(
			'AcName'	=> strtoupper($this->input->post('name')),
			'AcType'	=> strtoupper($this->input->post('group_type')),
		);

		$updated = $this->sumit->update('acgroup',$data,array('id'=>$id));
		if($updated)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">Account Group Updated Successfully</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Updation Failed!</div>');
		}
		redirect('account_master/accountgroup');
	}

	public function checkGroupName()
	{
		$name = $this->input->post('name');
		$check = $this->sumit->checkData('*','acgroup',array('AcName'=>$name));
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
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$check = $this->sumit->checkData('*','acgroup',array('AcName'=>$name,'id !='=>$id));
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
		$id = $this->input->post('id');
		$data = $this->sumit->fetchSingleData('*','acgroup',array('id'=>$id));
		echo json_encode($data);
	}
}

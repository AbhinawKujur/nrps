<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Itemgroup extends MY_Controller {

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
		
		$data['itemGroupList'] =$this->sumit->fetchAllData('*','item_group_master',array());
		$this->render_template('inventory_master/itemGroup',$data);
	}

	public function create()
	{
		$data = array(
			'item_group_name'	=> strtoupper($this->input->post('name')),
		);

		$insert = $this->sumit->createData('item_group_master',$data);
		if($insert)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">Record Added Successfully</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Creation Failed!</div>');
		}
		redirect('inventory_master/itemgroup');
	}

	public function update()
	{
		$id = $this->input->post('id');
		$data = array(
			'item_group_name'	=> strtoupper($this->input->post('name')),
		);

		$updated = $this->sumit->update('item_group_master',$data,array('item_group_id'=>$id,'is_system'=>0));
		if($updated)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">Record Updated Successfully</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Updation Failed!</div>');
		}
		redirect('inventory_master/itemgroup');
	}

	public function checkName()
	{
		$name = $this->input->post('name');
		$check = $this->sumit->checkData('*','item_group_master',array('item_group_name'=>$name));
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
		$check = $this->sumit->checkData('*','item_group_master',array('item_group_name'=>$name,'item_group_id !='=>$id));
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
		$data = $this->sumit->fetchSingleData('*','item_group_master',array('item_group_id'=>$id));
		echo json_encode($data);
	}
}

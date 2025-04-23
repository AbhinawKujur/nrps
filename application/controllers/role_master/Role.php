<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	}
	
	public function index(){

		// if(!in_array('viewRole', permission_data))
		// {
		// 	redirect('payroll/dashboard/dashboard');
		// }

		$data['roleList'] = $this->sumit->fetchAllData('*','role_master',array());
		$this->render_template('role_master/role',$data);
	}

	public function create()
	{
		// if(!in_array('viewRole', permission_data))
		// {
		// 	redirect('payroll/dashboard/dashboard');
		// }

		$response = array();
		$data = array(
			'NAME'			=> strtoupper($this->input->post('name')),
			'DESCRIPTION'	=> $this->input->post('description'),
		);

		$create = $this->sumit->createData('role_master',$data);
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
		// if(!in_array('viewRole', permission_data))
		// {
		// 	redirect('payroll/dashboard/dashboard');
		// }
		
		$id = $this->input->post('id');
		$response = array();
		$data = array(
			'NAME'			=> strtoupper($this->input->post('name')),
			'DESCRIPTION'	=> $this->input->post('description'),
		);

		$update = $this->sumit->update('role_master',$data,array('ID'=>$id));
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



	public function getSingeRole()
	{
		$id = $this->input->post('id');
		$data = $this->sumit->fetchSingleData('*','role_master',array('ID'=>$id));
		echo json_encode($data);
	}

	public function checkRoleName()
	{
		$msg = '';
		$name = $this->input->post('name');
		$check = $this->sumit->checkData('*','role_master',array('NAME'=>$name));
		if($check == true)
		{
			$msg = "Role Name Already Exist";
		}
		else
		{
			$msg = true;
		}
		echo json_encode($msg);
	}
}

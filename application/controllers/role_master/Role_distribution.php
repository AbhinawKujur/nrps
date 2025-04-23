<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_distribution extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	}
	
	public function update($id = null){

		// if(!in_array('viewRole', permission_data))
		// {
		// 	redirect('payroll/dashboard/dashboard');
		// }

		if($id == null)
		{
			redirect('role_master/role');
		}
		$data['id'] = $id;
		$permissionData = $this->sumit->fetchSingleData('*','permission_data',array('ROLE_ID'=>$id));
		if(empty($permissionData))
		{
			$permissionData['PERMISSION_DATA'] = serialize(array('1'=>'add'));
		}
		$data['permissionData'] = unserialize($permissionData['PERMISSION_DATA']);
		$data['menuData'] = $this->sumit->fetchAllDataWithOrder('*','menu_data_role',array(),'S_NO','ASC');
		$this->render_template('role_master/role_distribution',$data);
	}

	public function updateProcess($id = null)
	{
		if($id == null)
		{
			redirect('role_master/role');
		}
		$permission = serialize($this->input->post('permission_data[]'));
		$data = array(
			'ROLE_ID'			=> $id,
			'PERMISSION_DATA'	=> $permission,
		);

		$check_avl = $this->sumit->checkData('*','permission_data',array('ROLE_ID'=>$id));
		if($check_avl)
		{
			$update = $this->sumit->update('permission_data',$data,array('ROLE_ID'=>$id));
		}
		else
		{
			$update = $this->sumit->createData('permission_data',$data);
		}

		if($update)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">Saved Successfully.</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-danger">Failed!</div>');
		}
		redirect('role_master/role_distribution/update/'.$id);
	}

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employeeallowance extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}
	public function index(){

		if(!in_array('editAllowanceBulk', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$data['employeeList'] = $this->attendance->getEmployeeDataForAllowanceBulk();
		$this->render_template('bulk_updation/employeeAllowance',$data);
	}

	public function updateDatas()
	{
		$column_name = $this->input->post('column_name');
		$emp_id = $this->input->post('emp_id');
		$cell_value = $this->input->post('cell_value');

		$checkExist = $this->sumit->checkData('*','pay_control',"EMPLOYEE_ID='$emp_id'");

		$data = array(
			'EMPLOYEE_ID'=> $emp_id,
			$column_name => $cell_value,
		);
		if($checkExist == true)
		{
			$this->sumit->update('pay_control',$data,"EMPLOYEE_ID='$emp_id'");
		}
		else
		{
			$this->sumit->createData('pay_control',$data);
		}
		echo json_encode(1);
	}
}
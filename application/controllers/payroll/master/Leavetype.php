<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leavetype extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}
	public function index()
	{
		if(!in_array('viewLeaveType', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$data['leavetype'] =$this->sumit->fetchAllData('*','leave_master',array());
		$data['applicablefor'] =$this->custom_lib->getApplicableFor();
		$data['leaveTypes'] =$this->custom_lib->leaveType();

		if($this->form_validation->run('create_leavetype_rules') == FALSE)
		{
			$this->render_template('payroll_master/createLeaveType',$data);
		}
		else
		{
			$data = array(
				'name'		=> $this->input->post('name'),
				'applicable_for'=> $this->input->post('applicable_for'),
				'no_days'		=> $this->input->post('no_of_days'),
			);

			$insert = $this->sumit->createData('leave_master',$data);
			if($insert)
			{
				$this->session->set_flashdata('msg','<div class="alert alert-success">Leave Type Added Successfully</div>');
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-warning">Creation Failed!</div>');
			}
			redirect('payroll/master/leavetype');
		}
	}

	public function update($id = null)
	{
		if(!in_array('editLeaveType', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		if($id == null)
		{
			redirect('payroll/master/leavetype');
		}
		$data['leavetype'] =$this->sumit->fetchAllData('*','leave_master',array());
		$data['applicablefor'] =$this->custom_lib->getApplicableFor();
		$data['leaveTypes'] =$this->custom_lib->leaveType();
		$singleData =$this->sumit->fetchSingleData('*','leave_master',array('id'=>$id));
		$data['singleData'] = $singleData;
		$name = $this->input->post('name');
		$this->form_validation->set_rules('name', 'Name', 'required|trim|xss_clean');
		$this->form_validation->set_rules('applicable_for', 'Applicable For', 'required|trim|xss_clean');
		$this->form_validation->set_rules('no_of_days', 'No of Days', 'required|trim|xss_clean');
		if($this->form_validation->run() == FALSE)
		{
			$this->render_template('payroll_master/editLeaveType',$data);
		}
		else
		{
			$data = array(
				'name'		=> $this->input->post('name'),
				'applicable_for'=> $this->input->post('applicable_for'),
				'no_days'		=> $this->input->post('no_of_days'),
			);

			$update = $this->sumit->update('leave_master',$data,array('id'=>$id));
			if($update)
			{
				$this->session->set_flashdata('msg','<div class="alert alert-success">Leave type Updated Successfully</div>');
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-warning">Updation Failed!</div>');
			}
			redirect('payroll/master/leavetype');
		}
	}
	public function delete($id=null)
	{
		if(!in_array('deleteLeaveType', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		if($id == null)
		{
			redirect('payroll/master/leavetype');
		}
		$delete = $this->sumit->delete('leave_master',array('id'=>$id));
		if($delete)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">Leave Type Deleted Successfully</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Deletion Failed!</div>');
		}
		redirect('payroll/master/leavetype');
	}
}

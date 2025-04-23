<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qualification extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}
	public function index()
	{
		if(!in_array('viewQual', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$data['qualification'] =$this->sumit->fetchAllData('*','qualification',array());
		$this->form_validation->set_rules('qualification', 'Qualification', 'required|trim|is_unique[qualification.qualification]');

		if($this->form_validation->run() == FALSE)
		{
			$this->render_template('payroll_master/createQualification',$data);
		}
		else
		{
			$data = array(
				'qualification'		=> strtoupper($this->input->post('qualification')),
			);

			$insert = $this->sumit->createData('qualification',$data);
			if($insert)
			{
				$this->session->set_flashdata('msg','<div class="alert alert-success">Qualification Added Successfully</div>');
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-warning">Creation Failed!</div>');
			}
			redirect('payroll/master/qualification');
		}
	}

	public function update($sno = null)
	{
		if(!in_array('editQual', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		if($sno == null)
		{
			redirect('payroll/master/qualification');
		}
		$data['qualification'] =$this->sumit->fetchAllData('*','qualification',array());
		$singleData =$this->sumit->fetchSingleData('*','qualification',array('Sno'=>$sno));
		$data['singleData'] = $singleData;
		$qualification = strtoupper($this->input->post('qualification'));
		if($qualification == $singleData['qualification'])
		{
			$this->form_validation->set_rules('qualification', 'Qualification', 'required|trim|xss_clean');
		}
		else
		{
			$this->form_validation->set_rules('qualification', 'Qualification', 'required|trim|is_unique[qualification.qualification]');
		}

		if($this->form_validation->run() == FALSE)
		{
			$this->render_template('payroll_master/editQualification',$data);
		}
		else
		{
			$data = array(
				'qualification'		=> strtoupper($this->input->post('qualification')),
			);

			$update = $this->sumit->update('qualification',$data,array('Sno'=>$sno));
			if($update)
			{
				$this->session->set_flashdata('msg','<div class="alert alert-success">Qualification Updated Successfully</div>');
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-warning">Qualification Failed!</div>');
			}
			redirect('payroll/master/qualification');
		}
	}
	public function delete($sno=null)
	{
		if(!in_array('deleteQual', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		if($sno == null)
		{
			redirect('payroll/master/qualification');
		}
		$delete = $this->sumit->delete('qualification',array('Sno'=>$sno));
		if($delete)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">Qualification Deleted Successfully</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Deletion Failed!</div>');
		}
		redirect('payroll/master/qualification');
	}
}

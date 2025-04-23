<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Designation extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}
	public function index()
	{
		if(!in_array('viewDesignation', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		$data['designation'] =$this->sumit->fetchAllDataWithOrder('*','desig',array(),'print_position','ASC');
		if($this->form_validation->run('create_designation_rules') == FALSE)
		{
			$this->render_template('payroll_master/createDesignation',$data);
		}
		else
		{
			$data = array(
				'DESIG'		=> strtoupper($this->input->post('designation')),
				'print_position'	=> $this->input->post('print_position'),
			);

			$insert = $this->sumit->createData('desig',$data);
			if($insert)
			{
				$this->session->set_flashdata('msg','<div class="alert alert-success">Designation Added Successfully</div>');
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-warning">Creation Failed!</div>');
			}
			redirect('payroll/master/designation');
		}
	}

	public function update($sno = null)
	{
		if(!in_array('editDesignation', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		if($sno == null)
		{
			redirect('payroll/master/designation');
		}
		$data['designation'] =$this->sumit->fetchAllData('*','desig',array());
		$singleData =$this->sumit->fetchSingleData('*','desig',array('Sno'=>$sno));
		$data['singleData'] = $singleData;
		$designation = $this->input->post('designation');
		$print_position = $this->input->post('print_position');

		if($designation == $singleData['DESIG'])
		{
			$this->form_validation->set_rules('designation', 'Designation', 'required|trim|xss_clean');
		}
		else
		{
			$this->form_validation->set_rules('designation', 'Designation', 'required|trim|xss_clean|is_unique[desig.DESIG]');
		}

		if($print_position == $singleData['print_position'])
		{
			$this->form_validation->set_rules('print_position', 'Print Position', 'required|trim|xss_clean');
		}
		else
		{
			$this->form_validation->set_rules('print_position', 'Print Position', 'required|trim|xss_clean|is_unique[desig.print_position]');
		}

		if($this->form_validation->run() == FALSE)
		{
			$this->render_template('payroll_master/editDesignation',$data);
		}
		else
		{
			$data = array(
				'DESIG'		=> strtoupper($this->input->post('designation')),
				'print_position'	=> $this->input->post('print_position'),
			);

			$update = $this->sumit->update('desig',$data,array('Sno'=>$sno));
			if($update)
			{
				$this->session->set_flashdata('msg','<div class="alert alert-success">Designation Updated Successfully</div>');
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-warning">Updation Failed!</div>');
			}
			redirect('payroll/master/designation');
		}
	}

	public function delete($sno=null)
	{
		if(!in_array('deleteDesignation', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		if($sno == null)
		{
			redirect('payroll/master/designation');
		}
		$delete = $this->sumit->delete('desig',array('Sno'=>$sno));
		if($delete)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">Designation Deleted Successfully</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Deletion Failed!</div>');
		}
		redirect('payroll/master/designation');
	}
}

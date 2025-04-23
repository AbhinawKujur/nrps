<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pfesi extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}
	public function index()
	{
		if(!in_array('viewPFESI', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$data['pfesi_details'] = $this->sumit->fetchAllData('*','masterpf',array());
		$this->render_template('payroll_master/viewPFESI',$data);
	}

	public function create()
	{
		if(!in_array('addPFESI', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$data['lastData'] = $this->sumit->fetchLastData('*','masterpf',array(),'id');
		if($this->form_validation->run('create_pfesi_rules') == FALSE)
		{
			$this->render_template('payroll_master/createPFESIMaster',$data);
		}
		else
		{
			$effective_date = $this->input->post('effective_date');
			$effective_date = date("Y-m-d", strtotime($effective_date));
			$data = array(
				'ST_DATE'			=> $effective_date,
				'OWN_RATE'			=> $this->input->post('employee_pf_rate'),
				'EMP_RATE'			=> $this->input->post('employer_pf_rate'),
				'ESI_Applied'		=> $this->input->post('esi_applied'),
				'ESI_LIMIT'			=> $this->input->post('esi_limit'),
				'ESI_OWN_RATE'		=> $this->input->post('esi_own_rate'),
				'ESI_EMP_RATE'		=> $this->input->post('esi_emp_rate'),
				'PEN_RATE'			=> $this->input->post('pension_rate'),
				'da_rate'			=> $this->input->post('da_rate'),
				'ta_rate_slab1'		=> $this->input->post('ta_rate_slab1'),
				'ta_rate_slab2'		=> $this->input->post('ta_rate_slab2'),
				'ta_rate_slab3'		=> $this->input->post('ta_rate_slab3'),
				'special_allowance'	=> $this->input->post('spcial_allowance'),
				'staff_welfare_fund'=> $this->input->post('staff_welfare_fund'),
				'HRA_Rate'			=> $this->input->post('hra_allowance'),
				'bus_deduction'		=> $this->input->post('bus_deduction'),
			);

			$insert = $this->sumit->createData('masterpf',$data);
			if($insert)
			{
				$this->session->set_flashdata('msg','<div class="alert alert-success">Record Created Successfully</div>');
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-warning">Creation Failed!</div>');
			}
			redirect('payroll/master/pfesi/create');
		}
	}

	public function update($id = null)
	{
		if(!in_array('editPFESI', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		if($id == null)
		{
			redirect('payroll/master/pfesi');
		}
		$data['singleData'] = $this->sumit->fetchSingleData('*','masterpf',array('id'=>$id));
		if($this->form_validation->run('create_pfesi_rules') == FALSE)
		{
			$this->render_template('payroll_master/editPFESIMaster',$data);
		}
		else
		{
			$effective_date = $this->input->post('effective_date');
			$effective_date = date("Y-m-d", strtotime($effective_date));
			$data = array(
				'ST_DATE'			=> $effective_date,
				'OWN_RATE'			=> $this->input->post('employee_pf_rate'),
				'EMP_RATE'			=> $this->input->post('employer_pf_rate'),
				'ESI_LIMIT'			=> $this->input->post('esi_limit'),
				'ESI_Applied'		=> $this->input->post('esi_applied'),
				'PEN_RATE'			=> $this->input->post('pension_rate'),
				'ESI_OWN_RATE'		=> $this->input->post('esi_own_rate'),
				'ESI_EMP_RATE'		=> $this->input->post('esi_emp_rate'),
				'da_rate'			=> $this->input->post('da_rate'),
				'ta_rate_slab1'		=> $this->input->post('ta_rate_slab1'),
				'ta_rate_slab2'		=> $this->input->post('ta_rate_slab2'),
				'ta_rate_slab3'		=> $this->input->post('ta_rate_slab3'),
				'special_allowance'	=> $this->input->post('spcial_allowance'),
				'staff_welfare_fund'=> $this->input->post('staff_welfare_fund'),
				'HRA_Rate'			=> $this->input->post('hra_allowance'),
				'bus_deduction'		=> $this->input->post('bus_deduction'),
			);

			$update = $this->sumit->update('masterpf',$data,array('id'=>$id));
			if($update)
			{
				$this->session->set_flashdata('msg','<div class="alert alert-success">Record Updated Successfully</div>');
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-warning">Updation Failed!</div>');
			}
			redirect('payroll/master/pfesi');
		}
	}

	public function getSingleData()
	{
		$id = $this->input->post('id');
		$data = $this->sumit->fetchSingleData('*','masterpf',array('id'=>$id));
		$data['ST_DATE'] = date("d-M-Y", strtotime($data['ST_DATE']));
		echo json_encode($data);
	}
}

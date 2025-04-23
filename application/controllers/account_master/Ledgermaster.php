<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LedgerMaster extends MY_Controller {

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
		
		$data['ledgerList'] =$this->account_model->getLedgerList();
		$this->render_template('account_master/ledgerMaster',$data);
	}

	public function create()
	{
		$data['accountGroupList'] =$this->sumit->fetchAllData('*','acgroup',array());
		$data['accountSchoolGroupList'] =$this->sumit->fetchAllData('*','accscg',array());
		$data['accountTypeList'] =$this->sumit->fetchAllData('*','accg',array());
		$this->render_template('account_master/createLedger',$data);
	}
	public function createProcess()
	{
		$data = array(
			// 'AcNo'		=> $this->input->post('ac_no'),
			'LedgerNo'	=> $this->input->post('ledger_no'),
			'CCode'		=> strtoupper($this->input->post('ledger')),
			'CBO'		=> $this->input->post('accountgroup'),
			'SG'		=> $this->input->post('schoolgroup'),
			'ANSWER'	=> $this->input->post('account_type'),
			'OBal'		=> $this->input->post('opening_balance'),
			'DC'		=> strtoupper($this->input->post('drcr')),
			'BAmount'	=> $this->input->post('budget_amount'),
		);

		$insert = $this->sumit->createData('mledger',$data);
		if($insert)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">Record Added Successfully</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Creation Failed!</div>');
		}
		redirect('account_master/ledgermaster/create');
	}

	public function update($id = null)
	{
		if($id==null)
		{
			redirect('account_master/ledgermaster');
		}
		$data['accountGroupList'] =$this->sumit->fetchAllData('*','acgroup',array());
		$data['accountSchoolGroupList'] =$this->sumit->fetchAllData('*','accscg',array());
		$data['accountTypeList'] =$this->sumit->fetchAllData('*','accg',array());
		if(isset($_POST['save']))
		{
			$dataRes = array(
				// 'AcNo'		=> $this->input->post('ac_no'),
				'LedgerNo'	=> $this->input->post('ledger_no'),
				'CCode'		=> strtoupper($this->input->post('ledger')),
				'CBO'		=> $this->input->post('accountgroup'),
				'SG'		=> $this->input->post('schoolgroup'),
				'ANSWER'	=> $this->input->post('account_type'),
				'OBal'		=> $this->input->post('opening_balance'),
				'DC'		=> strtoupper($this->input->post('drcr')),
				'BAmount'	=> $this->input->post('budget_amount'),
			);

			$update = $this->sumit->update('mledger',$dataRes,array('AcNo'=>$id));
			if($update)
			{
				$this->session->set_flashdata('msg','<div class="alert alert-success">Record Updated Successfully</div>');
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-warning">Updation Failed!</div>');
			}
		}
		$data['singleData'] =$this->sumit->fetchSingleData('*','mledger',array('AcNo'=>$id));
		$data['id'] = $id;
		$this->render_template('account_master/editLedger',$data);
	}

	public function checkLedgerNo()
	{
		$ledger_no = $this->input->post('ledger_no');
		$check = $this->sumit->checkData('*','mledger',array('LedgerNo'=>$ledger_no));
		if($check)
		{
			echo json_encode('Ledger No already exist');
		}
		else
		{
			echo json_encode('true');
		}
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends MY_Controller {

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
		
		$data['supplierList'] =$this->sumit->fetchAllData('*','supplier_master',array());
		$this->render_template('inventory_master/supplierList',$data);
	}

	public function addNewSupplier()
	{
		$finalLedgerNo = '';
		$getLedgerNo = $this->sumit->fetchSingleData('*','mledger',"AcNo = (SELECT max(AcNo) FROM mledger WHERE LedgerNo LIKE 'S%')");
		if(!empty($getLedgerNo))
		{
			$numberpart= preg_replace('/[^0-9]/', '', $getLedgerNo['LedgerNo']);
			$stringpart=  preg_replace('/[^A-Z]/', '', $getLedgerNo['LedgerNo']);
			$numberpart = $numberpart + 1;
			$finalLedgerNo = $stringpart.$numberpart;
		}
		else
		{
			$finalLedgerNo = 'S1';
		}

		if(isset($_POST['save']))
		{
			$suppliername = strtoupper($this->input->post('supplier_name'));
			$address = $this->input->post('address');
			$obal = $this->input->post('opening_balance');
			$drcr = strtoupper($this->input->post('drcr'));
			$data = array(
				'Supplier_Name'		=> $suppliername,
				'Supplier_Address'	=> $address,
				'City'				=> strtoupper($this->input->post('city')),
				'State'				=> strtoupper($this->input->post('state')),
				'Country'			=> strtoupper($this->input->post('country')),
				'Pin_Code'			=> strtoupper($this->input->post('pin_code')),
				'Contact_Person_Name'=> strtoupper($this->input->post('contact_person_name')),
				'Contact_Person_Mobile_No'=> $this->input->post('contact_person_mobile'),
				'PAN_No'			=> strtoupper($this->input->post('pan_no')),
				'GST_No'			=> strtoupper($this->input->post('gst_no')),
				'Opening_Balance'	=> $obal,
				'Debit_Credit'		=> $drcr,
				'LedgerNo'			=> $finalLedgerNo,
			);

			$insert = $this->sumit->createData('supplier_master',$data);
			if($insert)
			{
				$ledgerData = array(
					'CCode'		=> $suppliername.' '.$address.' A/c',
					'OBal'		=> $obal,
					'CBO'		=> 'G28',
					'DC'		=> $drcr,
					'SG'		=> 32,
					'ANSWER'	=> 1,
					'LedgerNo'	=> $finalLedgerNo,
					'BAmount'	=> 0,
				);
				$this->sumit->createData('mledger',$ledgerData);
				$this->session->set_flashdata('msg','<div class="alert alert-success">Record Added Successfully</div>');
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-warning">Creation Failed!</div>');
			}
		}
		$this->render_template('inventory_master/supplierCreate');
	}

	public function updateSupplier($id = null)
	{
		if($id==null)
		{
			redirect('inventory_master/supplier');
		}
		$supplierDetails = $this->sumit->fetchSingleData('*','supplier_master',"Supplier_ID='$id'");
		if(isset($_POST['save']))
		{
			$suppliername = strtoupper($this->input->post('supplier_name'));
			$address = $this->input->post('address');
			$obal = $this->input->post('opening_balance');
			$drcr = strtoupper($this->input->post('drcr'));
			$data = array(
				'Supplier_Name'		=> $suppliername,
				'Supplier_Address'	=> $address,
				'City'				=> strtoupper($this->input->post('city')),
				'State'				=> strtoupper($this->input->post('state')),
				'Country'			=> strtoupper($this->input->post('country')),
				'Pin_Code'			=> strtoupper($this->input->post('pin_code')),
				'Contact_Person_Name'=> strtoupper($this->input->post('contact_person_name')),
				'Contact_Person_Mobile_No'=> $this->input->post('contact_person_mobile'),
				'PAN_No'			=> strtoupper($this->input->post('pan_no')),
				'GST_No'			=> strtoupper($this->input->post('gst_no')),
				'Opening_Balance'	=> $obal,
				'Debit_Credit'		=> $drcr,
			);

			$update = $this->sumit->update('supplier_master',$data,"Supplier_ID='$id'");
			if($update)
			{
				$ledgerData = array(
					'CCode'		=> $suppliername.' '.$address.' A/c',
					'OBal'		=> $obal,
					'CBO'		=> 'G28',
					'DC'		=> $drcr,
					'SG'		=> 32,
					'ANSWER'	=> 1,
					'BAmount'	=> 0,
				);
				$this->sumit->update('mledger',$ledgerData,"LedgerNo='".$supplierDetails['LedgerNo']."'");
				$this->session->set_flashdata('msg','<div class="alert alert-success">Record Updated Successfully</div>');
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-warning">Creation Failed!</div>');
			}
		}
		$data['id'] = $id;
		$data['supplierDetails'] = $supplierDetails;
		$this->render_template('inventory_master/supplierEdit',$data);
	}
}


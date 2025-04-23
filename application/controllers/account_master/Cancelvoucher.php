<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cancelvoucher extends MY_Controller {

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
		$this->render_template('account_master/cancelVoucher');
	}

	public function cancelVoucher()
	{
		$voucher_no = $this->input->post('voucher_no');
		$tcashdata = $this->sumit->fetchAllData('*','tcash',array('VNo'=>$voucher_no));
		$create = $this->sumit->createMultiple('cancelled_voucher',$tcashdata);
		if($create)
		{
			$this->sumit->delete('tcash',array('VNo'=>$voucher_no));
			$this->session->set_flashdata('cancelmsg','<div class="alert alert-success">Voucher Cancelled Successfully.</div>');
		}
		return redirect('account_master/cancelvoucher');
	}

	public function unlock()
	{
		$password = $this->input->post('password');
		$checkData = $this->sumit->checkData('*','misc_password',array('password'=>$password,'id'=>3));
		if($checkData)
		{
			$this->session->set_userdata('unlockcancelvoucher','Success');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-danger">Password is incorrect!</div>');
		}
		return redirect('account_master/cancelvoucher');
	}
}

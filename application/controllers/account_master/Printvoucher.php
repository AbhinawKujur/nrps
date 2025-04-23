<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Printvoucher extends MY_Controller {

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
		$this->render_template('account_master/printVoucher');
	}

	public function getVoucherNo()
	{
		$voucher_type = $this->input->post('voucher_type');

		if($voucher_type == 2)
		{
			$voucher_type = '2,5,6';
		}

		$voucherNoList = $this->sumit->fetchAllData('DISTINCT(VNo)','tcash',"VType IN ($voucher_type)");
		echo json_encode($voucherNoList);
	}
	public function printVoucher($voucher_no=null)
	{
		if($voucher_no==null)
		{
			$voucher_no = $this->input->post('voucher_no');
			if($voucher_no==null)
			{
				redirect('account_master/printvoucher');
			}
		}
		ini_set('memory_limit', '-1');
		$data['school_setting'] = $this->sumit->fetchSingleData('*','school_setting',array('S_No'=>1));

		$voucherList = $this->sumit->fetchTwoJoin('tcash.*,m.CCode as head_name','tcash','mledger m','m.AcNo=tcash.CCode',"VNo='$voucher_no'");
		$data['voucherList'] = $voucherList;
		$data['voucher_type'] = $voucherList[0]['VType'];
		$this->load->view('account_master/printFeeCollectionVoucher',$data);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->set_option("isPhpEnabled", true);
		$this->dompdf->stream("voucherreceipt.pdf", array("Attachment"=>0));
	}
}

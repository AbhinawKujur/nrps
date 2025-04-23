<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cashbookreport extends MY_Controller {

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
		$data['accountTypeList'] =$this->sumit->fetchAllData('*','accg',array());
		$this->render_template('accounts_report/cashBookReport',$data);
	}

	public function printCashBookReport()
	{
		$account_type = $this->input->post('account_type');
		$date_from = date('Y-m-d',strtotime($this->input->post('date_from')));
		$date_to = date('Y-m-d',strtotime($this->input->post('date_to')));

		$result = array();
		$data['accountType'] =$this->sumit->fetchSingleData('CAT_ABBR','accg',array('CAT_CODE'=>$account_type));
		$voucherNoList = $this->sumit->fetchAllData('DISTINCT(VNo)','tcash',"AcT='$account_type' AND date(TDate) >= '$date_from' AND date(TDate) <= '$date_to'");

		foreach ($voucherNoList as $key => $value) {

			$tcashdata = $this->account_model->getTcashdataByVno($value['VNo']);
			$result[$value['VNo']] = $tcashdata;
		}
		
		ini_set('memory_limit', '-1');
		$data['date_from'] = $date_from;
		$data['date_to'] = $date_to;
		$data['voucherNoList'] = $voucherNoList;
		$data['result'] = $result;
		$this->load->view('accounts_report/printCashBookReport',$data);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'landscape');
		$this->dompdf->render();
		$this->dompdf->set_option("isPhpEnabled", true);
		$this->dompdf->stream("cashbook.pdf", array("Attachment"=>0));
	}
	
}

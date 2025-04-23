<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trialbalancereport extends MY_Controller {

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
		$this->render_template('accounts_report/trialBalanceReport',$data);
	}

	public function printTrialBalanceReport()
	{
		$account_type = $this->input->post('account_type');
		$date_from = date('Y-m-d',strtotime($this->input->post('date_from')));
		$date_to = date('Y-m-d',strtotime($this->input->post('date_to')));

		$data['account_type'] = $this->sumit->fetchSingleData('*','accg',array('CAT_CODE'=>$account_type));
		$data['openingBalanceList'] = $this->sumit->fetchAllData('*','mledger',"OBal > 0");
		$schoolGroupList = $this->sumit->fetchAllData('*','accscg',array());
		$result = array();
		$schoolGroups = array();
		$calculatedResult = array();
		foreach ($schoolGroupList as $key => $value) {
			$ledgerList = $this->sumit->fetchAllData('*','mledger',array('SG'=>$value['cat_code']));

			foreach ($ledgerList as $keys => $val) {

				$tcashData = $this->sumit->fetchAllData('*','tcash',"SG='".$value['cat_code']."' AND CCode='".$val['AcNo']."' AND date(TDate) >= '$date_from' AND date(TDate) <= '$date_to' AND AcT='$account_type'");
				$cramt = 0; $dramt = 0;
				foreach ($tcashData as $key2 => $value2) {

					if($value2['PR']=='C')
					{
						$cramt += $value2['Amt'];
					}
					elseif($value2['PR']=='D')
					{
						$dramt += $value2['Amt'];
					}
				}

                $final_bal = $dramt - $cramt;
				$opening = ($val['DC'] == 'C')?(-1*$val['OBal']):$val['OBal'];
				$calculatedResult['ob'][$val['AcNo']] = $opening;
				$calculatedResult['bal'][$val['AcNo']] = $opening + $final_bal;
			}
			if(!empty($ledgerList))
			{
				$result[$value['cat_code']] = $ledgerList;
				$schoolGroups[] = $value;
			}
		}
		$data['schoolGroupList'] = $schoolGroups;
		$data['reportList'] = $result;
		$data['calculatedResult'] = $calculatedResult;
		ini_set('memory_limit', '-1');
		$data['date_from'] = $date_from;
		$data['date_to'] = $date_to;

		$this->load->view('accounts_report/printTrialBalanceReport',$data);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->set_option("isPhpEnabled", true);
		$this->dompdf->stream("voucherreceipt.pdf", array("Attachment"=>0));
	}

	public function separateColumn()
	{
		$data['accountTypeList'] =$this->sumit->fetchAllData('*','accg',array());
		$this->render_template('accounts_report/trialBalanceReportSeparateColumn',$data);
	}
	public function printTrialBalanceReportSeparateColumn()
	{
		$account_type = $this->input->post('account_type');
		$date_from = date('Y-m-d',strtotime($this->input->post('date_from')));
		$date_to = date('Y-m-d',strtotime($this->input->post('date_to')));

		$data['account_type'] = $this->sumit->fetchSingleData('*','accg',array('CAT_CODE'=>$account_type));
		$schoolGroupList = $this->sumit->fetchAllData('*','accscg',array());
		$result = array();
		$schoolGroups = array();
		$calculatedResult = array();
		foreach ($schoolGroupList as $key => $value) {
			$ledgerList = $this->sumit->fetchAllData('*','mledger',array('SG'=>$value['cat_code']));

			foreach ($ledgerList as $keys => $val) {

				$tcashData = $this->sumit->fetchAllData('*','tcash',"SG='".$value['cat_code']."' AND CCode='".$val['AcNo']."' AND date(TDate) >= '$date_from' AND date(TDate) <= '$date_to' AND AcT='$account_type'");
				$cramt = 0; $dramt = 0;
				foreach ($tcashData as $key2 => $value2) {

					if($value2['PR']=='C')
					{
						$cramt += $value2['Amt'];
					}
					elseif($value2['PR']=='D')
					{
						$dramt += $value2['Amt'];
					}
				}
				$final_bal = $dramt - $cramt;
				$opening = ($val['DC'] == 'C')?(-1*$val['OBal']):$val['OBal'];
				$calculatedResult['ob'][$val['AcNo']] = $opening;
				$calculatedResult['bal'][$val['AcNo']] =  $final_bal;
			}
			if(!empty($ledgerList))
			{
				$result[$value['cat_code']] = $ledgerList;
				$schoolGroups[] = $value;
			}
		}
		$data['schoolGroupList'] = $schoolGroups;
		$data['reportList'] = $result;
		$data['calculatedResult'] = $calculatedResult;
		ini_set('memory_limit', '-1');
		$data['date_from'] = $date_from;
		$data['date_to'] = $date_to;
		$this->load->view('accounts_report/printTrialBalanceReportSeparateColumn',$data);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->set_option("isPhpEnabled", true);
		$this->dompdf->stream("voucherreceipt.pdf", array("Attachment"=>0));
	}

	public function monthlyReport()
	{
		$data['accountTypeList'] =$this->sumit->fetchAllData('*','accg',array());
		$this->render_template('accounts_report/monthlyTrialBalanceReport',$data);
	}
	public function printTrialBalanceMonthlyReport()
	{
		$account_type = $this->input->post('account_type');
		$date_from = date('Y-m-d',strtotime($this->input->post('date_from')));
		$date_to = date('Y-m-d',strtotime($this->input->post('date_to')));

		$session_year = schoolData['School_Session']; 
		$year = explode('-', $session_year);
		$start_year = $year[0];
		$end_year = $year[1];
		$session_start_date = $start_year.'04-01';

		$data['account_type'] = $this->sumit->fetchSingleData('*','accg',array('CAT_CODE'=>$account_type));
		$schoolGroupList = $this->sumit->fetchAllData('*','accscg',array());
		$result = array();
		$calculatedResult = array();
		foreach ($schoolGroupList as $key => $value) {
			$ledgerList = $this->sumit->fetchAllData('*','mledger',array('SG'=>$value['cat_code']));

			foreach ($ledgerList as $keys => $val) {

				$tcashDataForopeningbal = $this->sumit->fetchAllData('*','tcash',"SG='".$value['cat_code']."' AND CCode='".$val['AcNo']."' AND date(TDate) >= '$session_start_date' AND date(TDate) < '$date_from'");
				
				$obdr = 0; $obcr = 0;
				foreach ($tcashDataForopeningbal as $key2 => $value2) {

					if($value2['PR']=='C')
					{
						$obcr += $value2['Amt'];
					}
					elseif($value2['PR']=='D')
					{
						$obdr += $value2['Amt'];
					}
				}

				$final_calc = $obdr-$obcr;

				$opening = ($val['DC'] == 'C')?(-1*$val['OBal']):$val['OBal'];
				$calculatedResult['ob'][$val['AcNo']] = $opening + $final_calc;

				$tcashData = $this->sumit->fetchAllData('*','tcash',"SG='".$value['cat_code']."' AND CCode='".$val['AcNo']."' AND date(TDate) >= '$date_from' AND date(TDate) <= '$date_to' AND AcT='$account_type'");
				$cramt = 0; $dramt = 0;
				foreach ($tcashData as $key2 => $value2) {

					if($value2['PR']=='C')
					{
						$cramt += $value2['Amt'];
					}
					elseif($value2['PR']=='D')
					{
						$dramt += $value2['Amt'];
					}
				}
                $final_bal = $dramt - $cramt;
				$calculatedResult['bal'][$val['AcNo']] = $final_bal;
			}
			if(!empty($ledgerList))
			{
				$result[$value['cat_code']] = $ledgerList;
			}
		}
		$data['schoolGroupList'] = $schoolGroupList;
		$data['reportList'] = $result;
		$data['calculatedResult'] = $calculatedResult;
		ini_set('memory_limit', '-1');
		$data['date_from'] = $date_from;
		$data['date_to'] = $date_to;
		$this->load->view('accounts_report/printMonthlyTrialBalanceReport',$data);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'landscape');
		$this->dompdf->render();
		$this->dompdf->set_option("isPhpEnabled", true);
		$this->dompdf->stream("voucherreceipt.pdf", array("Attachment"=>0));
	}

	
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ledgerreport extends MY_Controller {

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
		$data['ledgerHeadList'] =$this->sumit->fetchAllData('*','mledger',array());
		$this->render_template('accounts_report/ledgerReport',$data);
	}

	public function printLedgerReport()
	{
		$ledger_head = $this->input->post('ledger_head');
		$date_from = date('Y-m-d',strtotime($this->input->post('date_from')));
		$date_to = date('Y-m-d',strtotime($this->input->post('date_to')));

		$session_year = schoolData['School_Session']; 
		$year = explode('-', $session_year);
		$start_year = $year[0];
		$end_year = $year[1];
		$session_start_date = $start_year.'04-01';

		$ledgerDetails = $this->sumit->fetchSingleData('*','mledger',array('AcNo'=>$ledger_head));

		$result = array();
		$calculatedResult = array();

		$tcashDataForopeningbal = $this->sumit->fetchAllData('*','tcash',"CCode='$ledger_head' AND date(TDate) >= '$session_start_date' AND date(TDate) < '$date_from'");
		
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

		$opening = ($ledgerDetails['DC'] == 'C')?(-1*$ledgerDetails['OBal']):$ledgerDetails['OBal'];
		$calculatedResult['ob'] = $opening + $final_calc;

		$data['tcashData'] = $this->sumit->fetchAllData('*','tcash',"CCode='$ledger_head' AND date(TDate) >= '$date_from' AND date(TDate) <= '$date_to'");
        
		$data['ledgerDetails'] = $ledgerDetails;
		$data['calculatedResult'] = $calculatedResult;
		ini_set('memory_limit', '-1');
		$data['date_from'] = $date_from;
		$data['date_to'] = $date_to;
		$this->load->view('accounts_report/printLedgerReport',$data);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->set_option("isPhpEnabled", true);
		$this->dompdf->stream("Ledgerreport.pdf", array("Attachment"=>0));
	}

	public function ledgerPassedReport()
	{
		$data['ledgerHeadList'] =$this->account_model->getTotalLedgerPassed();
		$this->render_template('accounts_report/ledgerPassedReport',$data);
	}
	
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voucherentryfee extends MY_Controller {

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
		$data['ledgerList'] =$this->sumit->fetchAllData('*','mledger',"CBO IN ('G4','G5','G7')");
		$data['narrationList'] =$this->sumit->fetchAllData('*','acnar',array());
		$data['accountGroupList'] =$this->sumit->fetchAllData('*','accscg',array());
		$data['maxvocherno'] = $this->sumit->fetchSingleData('max(VNo)max_vno','tcash',array());
		$this->sumit->delete('temp_voucher_db',array('login_id'=>login_details['user_id']));
		$this->render_template('account_master/voucherEntryFeeCollection',$data);
	}

	public function getTodaysFeeCollection()
	{
		$date = $this->input->post('date');
		$voucher_no = $this->input->post('voucher_no');
		$payment_mode = $this->input->post('collection_mode');
		$payment_mode = join("', '", $payment_mode);

		if($voucher_no == '')
		{
			$getLastVoucher = $this->sumit->fetchSingleData('max(VNo)maxvno','tcash',array());
			$voucher_no = $getLastVoucher['maxvno']+1;
		}
		$date = date('Y-m-d',strtotime($date));
		$receiptNo = $this->sumit->fetchSingleData('min(RECT_NO) min_rect_no,max(RECT_NO)max_rect_no','daycoll',"date(RECT_DATE)='$date' AND Collection_Mode=1 AND Payment_Mode IN ('$payment_mode') AND voucher_created=0");
		$feeHeadList = $this->sumit->fetchTwoJoin('fh.ACT_CODE,fh.FEE_HEAD,fh.LEDGER_NO,ml.AcNo','feehead fh','mledger ml','fh.LEDGER_NO=ml.LedgerNo',array());
		$todayCollection = array();
		$data = array();

		foreach ($feeHeadList as $key => $value) {
			$feekeys = $value['ACT_CODE'];
			$total_fee = $this->sumit->fetchSingleData("sum(Fee".$feekeys.")total_fee".$feekeys,'daycoll',"date(RECT_DATE)='$date' AND Collection_Mode=1 AND Payment_Mode IN ('$payment_mode') AND voucher_created=0");
			if($total_fee['total_fee'.$feekeys] > 0)
			{
				$todayCollection[$feekeys]['total_fee'.$feekeys] = $total_fee['total_fee'.$feekeys];
				$todayCollection[$feekeys]['fee_head'] = $value['FEE_HEAD'];
				$todayCollection[$feekeys]['ledger_no'] = $value['AcNo'];

				$data[] = array(
					'voucher_no'	=>	$voucher_no,
					'date'			=>	$date,
					'ac_type'		=>	2,
					'dc'			=>	'C',
					'ac_head'		=>	$value['AcNo'],
					'amount'		=>	$total_fee['total_fee'.$feekeys],
					'narration'		=>	'Receipt No '.$receiptNo['min_rect_no'].' to '.$receiptNo['max_rect_no'],
					'login_id'		=>	login_details['user_id'],
				);
			}
		}
		$this->sumit->delete('temp_voucher_db',array('login_id'=>login_details['user_id']));
		if(!empty($data))
		{
			$this->sumit->createMultiple('temp_voucher_db',$data);
		}
		echo 1;
	}

	public function getCollectionMode()
	{
		$date = $this->input->post('date');
		
		$date = date('Y-m-d',strtotime($date));
		$collectionMode = $this->sumit->fetchAllData('DISTINCT(Payment_Mode)','daycoll',"date(RECT_DATE)='$date' AND Collection_Mode=1 AND voucher_created=0");
		echo json_encode($collectionMode);
	}

	public function createtempvoucher()
	{
		$res = array();
		$voucher_no = $this->input->post('voucher_no');
		$date = $this->input->post('date');
		$account_type = 2;
		$drcr = 'D';
		$account_head = $this->input->post('account_head');
		$amount = $this->input->post('amount');
		$narration = $this->input->post('narration');

		$data = array(
			'voucher_no'	=>	$voucher_no,
			'date'			=>	date('Y-m-d',strtotime($date)),
			'ac_type'		=>	$account_type,
			'dc'			=>	$drcr,
			'ac_head'		=>	$account_head,
			'amount'		=>	$amount,
			'narration'		=>	$narration,
			'login_id'		=>	login_details['user_id'],
		);

		$create = $this->sumit->createDataReturnID('temp_voucher_db',$data);
		if($create)
		{
			$res['msg'] = 1;
		}
		else
		{
			$res['msg'] = 2;
		}
		echo json_encode($res);
	}

	public function saveVoucher($collectionMode= null)
	{
		$collectionMode = str_replace('-', "','", $collectionMode);
		$tempVoucherData = $this->account_model->getTemporarryVoucher(login_details['user_id']);
		if(!empty($tempVoucherData))
		{
			$date = '';
			$voucher_no = '';
			
			$result = array();
			foreach ($tempVoucherData as $key => $value) {
				$date = $value['date'];
				$voucher_no = $value['voucher_no'];

				$result[] = array(
					'VNo' => $value['voucher_no'],
					'TDate' => $value['date'],
					'Nar' => $value['narration'],
					'PR' => $value['dc'],
					'CCode' => $value['ac_head'],
					'Amt' => $value['amount'],
					'SG' => $value['SG'],
					'AG' => $value['ag'],
					'AcT' => $value['ac_type'],
					'VType' => 5,
				);
				
				$checkNarAvl = $this->sumit->checkData('*','acnar',"Act='".$value['narration']."'");
				if($checkNarAvl == false)
				{
					$this->sumit->createData('acnar',array('Act'=>$value['narration']));
				}
			}
			$create = $this->sumit->createMultiple('tcash',$result);
			if($create)
			{
				$this->sumit->createData('daily_collection_voucher',array('date'=>$date));
				$this->sumit->update('daycoll',array('voucher_created'=>1),"date(RECT_DATE)='$date' AND Payment_Mode IN ('$collectionMode')");
				$this->session->set_flashdata('msg','<div class="alert alert-success">Voucher created successfully.</div>');
				 $this->sumit->delete('temp_voucher_db',array('login_id'=>login_details['user_id']));
				 $this->session->set_userdata('voucher_no',$voucher_no);
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-danger">Creation Failed.</div>');
			}
		}
		redirect('account_master/voucherentryfee');
	}

	public function checkVoucherCreated()
	{
		$date = date('Y-m-d',strtotime($this->input->post('date')));
		$check = $this->sumit->checkData('*','daily_collection_voucher',array('date'=>$date));
		if($check)
		{
			echo 1;
		}
		else
		{
			echo 2;
		}
	}

	public function printVoucher($voucher_no = null)
	{
		if($voucher_no == null)
		{
			redirect('account_master/voucherentryfee');
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
		$this->dompdf->stream("printFeeCollectionVoucher.pdf", array("Attachment"=>0));
	}
}

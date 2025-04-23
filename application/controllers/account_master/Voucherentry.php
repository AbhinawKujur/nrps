<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voucherentry extends MY_Controller {

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
		$data['ledgerList'] =$this->sumit->fetchAllData('*','mledger',array());
		$data['narrationList'] =$this->sumit->fetchAllData('*','acnar',array());
		$data['accountGroupList'] =$this->sumit->fetchAllData('*','accscg',array());
		$data['maxvocherno'] = $this->sumit->fetchSingleData('max(VNo)max_vno','tcash',array());
		$this->sumit->delete('temp_voucher_db',array('login_id'=>login_details['user_id']));
		$this->render_template('account_master/voucherEntry',$data);
	}

	public function voucherView()
	{
		// if(!in_array('viewDesignation', permission_data))
		// {
		// 	redirect('payroll/dashboard/dashboard');
		// }
		$data['accountTypeList'] =$this->sumit->fetchAllData('*','accg',array());
		$data['ledgerList'] =$this->sumit->fetchAllData('*','mledger',array());
		$data['narrationList'] =$this->sumit->fetchAllData('*','acnar',array());
		$data['accountGroupList'] =$this->sumit->fetchAllData('*','accscg',array());
		$data['voucherList'] = $this->sumit->fetchAllData('DISTINCT(VNo)','tcash',"VType IN (1,2,3,4)");
		if(isset($_POST['search']))
		{
			$this->sumit->delete('temp_voucher_db',array('login_id'=>login_details['user_id']));
			$voucher_no = $this->input->post('voucher_no');
			$singleVoucher = $this->sumit->fetchAllData('*','tcash',array('VNo'=>$voucher_no));
			$insertData = array();
			$log_voucher = array();
			$date = '';
			

			foreach ($singleVoucher as $key => $value) {

				$date = date('Y-m-d',strtotime($value['TDate']));
				$insertData[] = array(
					'voucher_no'	=>	$voucher_no,
					'date'			=>	date('Y-m-d',strtotime($value['TDate'])),
					'ac_type'		=>	$value['AcT'],
					'dc'			=>	$value['PR'],
					'ac_head'		=>	$value['CCode'],
					'amount'		=>	$value['Amt'],
					'narration'		=>	$value['Nar'],
					'vtype'			=>	$value['VType'],
					'login_id'		=>	login_details['user_id'],
				);
				unset($value['SNo']);
				$log_voucher[$key] = $value;
				$log_voucher[$key]['created_by'] = login_details['user_id'];
			}
			$this->sumit->createMultiple('temp_voucher_db',$insertData);
			$this->sumit->createMultiple('tcash_log',$log_voucher);
			$data['resultList'] = 'yes';
			$data['date'] = $date;
			$data['voucher_no'] = $voucher_no;
		}
		$this->render_template('account_master/generalVoucherEntryView',$data);
	}
	public function createtempvoucher()
	{
		$res = array();
		$voucher_no = $this->input->post('voucher_no');
		$date = $this->input->post('date');
		$account_type = $this->input->post('account_type');
		$drcr = $this->input->post('drcr');
		$account_head = $this->input->post('account_head');
		$amount = $this->input->post('amount');
		$narration = $this->input->post('narration');
		$voucher_type = $this->input->post('voucher_type');

		$data = array(
			'voucher_no'	=>	$voucher_no,
			'date'			=>	date('Y-m-d',strtotime($date)),
			'ac_type'		=>	$account_type,
			'dc'			=>	$drcr,
			'ac_head'		=>	$account_head,
			'amount'		=>	$amount,
			'narration'		=>	$narration,
			'vtype'			=>	$voucher_type,
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

	public function getTempVoucher()
	{
		$result = array();
		$data = $this->account_model->getTemporarryVoucher(login_details['user_id']);

		$result = array();
		$balance = 0;

		foreach ($data as $key => $value) {

			if($value['dc'] == 'D')
			{
				$result['data'][] = array(
					$value['ledger_name'],
					'<div class="text-right">'.$value['amount'].'</div>',
					'',
					$value['narration'],
				);
			}
			else
			{
				$result['data'][] = array(
					$value['ledger_name'],
					'',
					'<div class="text-right">'.$value['amount'].'</div>',
					$value['narration'],
				);
			}
		}
		if(empty($result))
		{
			$result['data'] = array();
		}
		echo json_encode($result);
	}

	public function getTempVoucheratEdit()
	{
		$result = array();
		$data = $this->account_model->getTemporarryVoucher(login_details['user_id']);

		$result = array();
		$balance = 0;

		foreach ($data as $key => $value) {

			if($value['dc'] == 'D')
			{
				$result['data'][] = array(
					$value['ledger_name'],
					'<div class="text-right">'.$value['amount'].'</div>',
					'',
					$value['narration'],
					'<button class="btn-xs btn-danger" type="button" onclick="deleteRecord('.$value['id'].')"><i class="fa fa-trash"></i></button>'
				);
			}
			else
			{
				$result['data'][] = array(
					$value['ledger_name'],
					'',
					'<div class="text-right">'.$value['amount'].'</div>',
					$value['narration'],
					'<button class="btn-xs btn-danger" type="button" onclick="deleteRecord('.$value['id'].')"><i class="fa fa-trash"></i></button>'
				);
			}
		}
		echo json_encode($result);
	}

	public function checkCRequalsDR()
	{
		$result = array();
		$data = $this->account_model->getTemporarryVoucher(login_details['user_id']);
		$dr = 0;
		$cr = 0;
		$result = array();

		foreach ($data as $key => $value) {

			if($value['dc'] == 'D')
			{
				$dr += $value['amount'];
			}
			else
			{
				$cr += $value['amount'];
			}			
		}
		$result['dr'] = $dr;
		$result['cr'] = $cr;
		if($dr==$cr)
		{
			$result['msg'] = 1;
		}
		else
		{
			$result['msg'] = 0;
		}
		echo json_encode($result);
	}

	public function saveVoucher()
	{
		$tempVoucherData = $this->account_model->getTemporarryVoucher(login_details['user_id']);
		if(!empty($tempVoucherData))
		{
			$result = array();
			$voucher_no = '';
			foreach ($tempVoucherData as $key => $value) {

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
					'VType' => $value['vtype'],
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
				$this->session->set_flashdata('msg','<div class="alert alert-success">Voucher created successfully.</div>');
				 $this->sumit->delete('temp_voucher_db',array('login_id'=>login_details['user_id']));
				 $this->session->set_userdata('voucher_no',$voucher_no);
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-danger">Creation Failed.</div>');
			}
		}
		redirect('account_master/voucherentry');
	}

	public function updateVoucher($voucher_no)
	{
		$tempVoucherData = $this->account_model->getTemporarryVoucher(login_details['user_id']);
		if(!empty($tempVoucherData))
		{
			$this->sumit->delete('tcash',array('VNo'=>$voucher_no));
			$result = array();
			$voucher_no = '';
			foreach ($tempVoucherData as $key => $value) {

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
					'VType' => $value['vtype'],
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
				$this->session->set_flashdata('msg','<div class="alert alert-success">Voucher Updated successfully.</div>');
				 $this->sumit->delete('temp_voucher_db',array('login_id'=>login_details['user_id']));
				 $this->session->set_userdata('voucher_no',$voucher_no);
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-danger">Creation Failed.</div>');
			}
		}
		redirect('account_master/voucherentry/voucherView');
	}

	public function checkVoucherNo()
	{
		$voucher_no = $this->input->post('voucher_no');
		$check = $this->sumit->checkData('*','tcash',array('VNo'=>$voucher_no));
		if($check)
		{
			echo json_encode('Voucher No already exist');
		}
		else
		{
			echo json_encode('true');
		}
	}

	public function printVoucher($voucher_no = null)
	{
		if($voucher_no == null)
		{
			redirect('account_master/voucherentry');
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

	public function deleteTempVoucher()
	{
		$id = $this->input->post('id');
		$this->sumit->delete('temp_voucher_db',array('id'=>$id));
		echo 1;
	}

	public function unlock()
	{
		$password = $this->input->post('password');
		$checkData = $this->sumit->checkData('*','misc_password',array('password'=>$password,'id'=>4));
		if($checkData)
		{
			$this->session->set_userdata('unlockvoucherupdate','Success');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-danger">Password is incorrect!</div>');
		}
		return redirect('account_master/voucherentry/voucherView');
	}
}

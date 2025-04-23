<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends My_controller{
	public function __construct(){
		parent ::__construct();
		$this->load->model('Alam','alam');
		$this->load->library('Alam_custom','alam_custom');
		require_once 'Atompay.php';
		$this->testObject = new Atompay();
	}
	
	public function index(){
		$regid         = (int)generate_session['id'];
		$amt           = generate_session['set_amt'];
		
		$transId = strtotime('now').rand(0,1000);
		
		$updTrans = array(
			'transaction_id' => $transId
		);
		$this->alam->update("nursery_adm_data",$updTrans,"id='".generate_session['id']."'");
		
		$mobData = $this->alam->selectA('nursery_adm_data','mobile',"id='".generate_session['id']."'");
		
		$mobile = $mobData[0]['mobile'];
		
		$env = "live";
		$login = "58016";
		$pwd = "VIDYA@123";
		$product = "REGISTRATION";
		$curr = "INR";
		$name = "Nursery";
		$email = "jvmfee@gmail.com";
		//$mobile = "8789264410";
		$address = "ranchi";
		$acc = "639827";
		$reqHashKey = "816e2e1f6ec25d7e7c";
		
		$redirect_url = base_url('adm_three/payment/Payment/redirect_payment');
		$this->testObject->atom_request($transId, $env, $login, $pwd, $product, $amt, $curr, $redirect_url, $regid, $name, $email, $mobile, $address, $acc, $reqHashKey);
		
	}
	
	public function redirect_payment(){
		//response hash key which is changed from user dashboard code
		$responseHashKey = "dae00acc31be39d9b5";
		$paymentResponse = $this->testObject->atomResponse($responseHashKey);
		if(is_array($paymentResponse)){
			if(strtolower($paymentResponse['f_code']) == 'ok'){
				
				$updData = array(
					'mmp_txn'     			 => $paymentResponse['mmp_txn'],
					//'transaction_id'         => $paymentResponse['mer_txn'],
					'amt'         			 => $paymentResponse['amt'],
					'bank_txn'    			 => $paymentResponse['bank_txn'],
					'f_code'      			 => $paymentResponse['f_code'],
					'bank_name'   			 => $paymentResponse['bank_name'],
					'auth_code'   			 => $paymentResponse['auth_code'],
					'ipg_txn_id'  			 => $paymentResponse['ipg_txn_id'],
					'merchant_id' 			 => $paymentResponse['merchant_id'],
					'desc'        			 => $paymentResponse['desc'],
					'CardNumber'  			 => $paymentResponse['CardNumber'],
					'response_received_time' => date('Y-m-d H:i:s')
				);
				
				$this->alam->update("nursery_adm_data",$updData,"id='".generate_session['id']."'");
				
				$message = "Dear Parent, Your transaction of Rs. ".$paymentResponse['amt']." is successful. Your registration no. is ".generate_session['id']."/2020";
		        $this->sms_lib->sendSms(generate_session['mobile'],$message);
				
				$data['stu_classes'] = $this->alam->selectA('student','CLASS,DISP_CLASS',"Student_Status = 'ACTIVE' GROUP BY CLASS,DISP_CLASS");
				$data['school_setting'] = $this->alam->select('school_setting','*');
				$data['school_photo'] = $this->alam->select('school_photo','*');
				$data['religion'] = $this->alam->selectA('religion','*',"status='Y' order by sorting_no");
				$data['category'] = $this->alam->selectA('category','*');
				
				$data['motherTounge'] = $this->alam_custom->motherTounge();
				$data['bloodGroup'] = $this->alam_custom->bloodGroup();
				$data['parent_qualification'] = $this->alam_custom->parent_qualification();
				$data['parent_accupation'] = $this->alam_custom->parent_accupation();
				$data['grand_parent'] = $this->alam_custom->grand_parent();
				
				$data['allData'] = $this->alam->selectA('nursery_adm_data','*,(select CAT_DESC from category where CAT_CODE=nursery_adm_data.category)category,(select Rname from religion where RNo=nursery_adm_data.religion)religion,(select CLASS_NM from classes where Class_No=nursery_adm_data.class_0)class_0,(select CLASS_NM from classes where Class_No=nursery_adm_data.class_1)class_1,(select SECTION_NAME from sections where section_no=nursery_adm_data.sec_0)sec_0,(select SECTION_NAME from sections where section_no=nursery_adm_data.sec_1)sec_1',"id='".generate_session['id']."'");
				
				$this->load->view('adm_three/generate_reg_pdf',$data);
				
				$html = $this->output->get_output();
				$this->load->library('pdf');
				$this->dompdf->loadHtml($html);
				$this->dompdf->setPaper('A4', 'portrait');
				$this->dompdf->render();
				$this->dompdf->stream($id.".pdf", array("Attachment"=>0));
			}else{
				$data['school_setting'] = $this->alam->select('school_setting','*');
		        $data['school_photo'] = $this->alam->select('school_photo','*');
				
				
				$updData = array(
					'mmp_txn'     			 => $paymentResponse['mmp_txn'],
					//'transaction_id'         => $paymentResponse['mer_txn'],
					'amt'         			 => $paymentResponse['amt'],
					'bank_txn'    			 => $paymentResponse['bank_txn'],
					'f_code'      			 => $paymentResponse['f_code'],
					'bank_name'   			 => $paymentResponse['bank_name'],
					//'auth_code'   			 => $paymentResponse['auth_code'],
					//'ipg_txn_id'  			 => $paymentResponse['ipg_txn_id'],
					'merchant_id' 			 => $paymentResponse['merchant_id'],
					'desc'        			 => $paymentResponse['desc'],
					//'CardNumber'  			 => $paymentResponse['CardNumber'],
					'response_received_time' => date('Y-m-d H:i:s')
				);
				
				$this->alam->update("nursery_adm_data",$updData,"id='".generate_session['id']."'");
				
				$data['allData'] = $this->alam->selectA('nursery_adm_data','*',"id='".generate_session['id']."'");
				
				$transaction_id = $data['allData'][0]['transaction_id'];
				$set_amt        = $data['allData'][0]['set_amt'];
				
				$message = "Dear Parent, Your transaction of Rs. ".$set_amt." is failed.Your transaction Id is ".$transaction_id." Kindly repay.";
		        $this->sms_lib->sendSms(generate_session['mobile'],$message);
				
				$this->load->view('adm_three/payment_failed',$data);
			}
		}
	}
}
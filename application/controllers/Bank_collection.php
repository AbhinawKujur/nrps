<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_collection extends MY_controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	   // $this->load->model('Mymodel','farheen');
		$this->load->model('Farheen','farheen');
		$this->load->model('Mymodel','dbcon');
	}

	public function reports()
	{
		$this->fee_template('Bank_collection/reports');
	}
	public function bank_collection()
	{
		$this->fee_template('Bank_collection/bank_collection');
	}

	public function monthly_adm_data()
	{
		$User_Id = $this->session->userdata('user_id');
		$adm_no = $this->input->post('val');
		$stu_data = $this->farheen->select('student','*',"ADM_NO='$adm_no'");
		$status_counter = 0;
		$login_id = $stu_data[0]->Login_Id;
		if(!empty($stu_data)){
			$stu_id = $stu_data[0]->STUDENTID;
			$pay_status = $stu_data[0]->Counter_payment_status;
			if($pay_status == 0){
				
				//$this->farheen->update('student',array('Counter_payment_status' =>1,'Login_Id' => $User_Id),"ADM_NO='$adm_no'");
				$status_counter = 1;
			}
		}else{
			$stu_id = "n/a";
		}
		$pre_dues = $this->farheen->select('previous_year_feegeneration','sum(TOTAL)TOTAL',"ADM_NO='$adm_no'");
		$pre_dues_amt = $pre_dues[0]->TOTAL;
		if($pre_dues_amt == null){
			$pre_dues1 = 0;
		}else{
			$pre_dues1 = $pre_dues_amt;
		}
		
		$cnt=count($stu_data);
		$ar_data = array($cnt,$pre_dues1,$stu_id,$status_counter,$login_id);
		echo json_encode($ar_data);
	}

	public function show_student()
	{
		$details = $this->farheen->select('student','ADM_NO,FIRST_NM,DISP_CLASS,DISP_SEC,FATHER_NM,MOTHER_NM',"Student_Status='ACTIVE'");
		echo json_encode($details);
	}

	public function stu_data()
	{
		
		$adm_no = $this->input->post('val');
		$User_Id = $this->session->userdata('user_id');
		$stu_data = $this->farheen->monthly_collection($adm_no);
		
		$month_data = $this->db->query("select * from month_master")->result();

		$array = array(
			'student_data' => $stu_data,
			'month_data' => $month_data,
			//'master' => $master
		);
		
		// $this->load->view('Fee_collection/cmonth_collection_data',$array);	
		$this->load->view('Bank_collection/bank_collection_data',$array);	
	}

	public function showledger_monthly_collection()
	{
		$adm = $this->input->post('adm_no');
		$std_ldgr = $this->farheen->select('daycoll','*',"ADM_NO='$adm'");
		echo json_encode($std_ldgr);
	}
	
	public function cancel_payment(){
		$adm = $this->input->post('adm');
		$checkdata = $this->farheen->checkData('*','student',"ADM_NO='$adm' AND Student_Status='ACTIVE'");
		if($checkdata){
			$stu_data = $this->farheen->select('student','*',"ADM_NO='$adm' AND Student_Status='ACTIVE'");
			$pay_status = $stu_data[0]->Counter_payment_status;
			if($pay_status == 0){
				echo "Alredy Cancel";
			}else{
				//$this->farheen->update('student',array('Counter_payment_status' => 0,'Login_Id' => "N/A"),"ADM_NO='$adm' AND Student_Status='ACTIVE'");
				echo "Cancel Success";
			}
			
		}else{
			echo "No Student Details Exist";
		}
	}
	public function collection_without_adm()
	{
		$class = $this->dbcon->select('classes','*');
		$feehead1 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='1'");
		$feehead2 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='2'");
		$feehead3 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='3'");
		$feehead4 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='4'");
		$feehead5 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='5'");
		$feehead6 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='6'");
		$feehead7 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='7'");
		$feehead8 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='8'");
		$feehead9 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='9'");
		$feehead10 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='10'");
		$feehead11 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='11'");
		$feehead12 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='12'");
		$feehead13 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='13'");
		$feehead14 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='14'");
		$feehead15 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='15'");
		$feehead16 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='16'");
		$feehead17 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='17'");
		$feehead18 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='18'");
		$feehead19 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='19'");
		$feehead20 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='20'");
		$feehead21 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='21'");
		$feehead22 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='22'");
		$feehead23 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='23'");
		$feehead24 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='24'");
		$feehead25 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='25'");
		$payment_mode = $this->dbcon->select('payment_mode','*');
		$bank = $this->dbcon->select('bank_master','*');

		$array = array(
			'class'  => $class,
			'feehead1' => $feehead1,
			'feehead2' => $feehead2,
			'feehead3' => $feehead3,
			'feehead4' => $feehead4,
			'feehead5' => $feehead5,
			'feehead6' => $feehead6,
			'feehead7' => $feehead7,
			'feehead8' => $feehead8,
			'feehead9' => $feehead9,
			'feehead10' => $feehead10,
			'feehead11' => $feehead11,
			'feehead12' => $feehead12,
			'feehead13' => $feehead13,
			'feehead14' => $feehead14,
			'feehead15' => $feehead15,
			'feehead16' => $feehead16,
			'feehead17' => $feehead17,
			'feehead18' => $feehead18,
			'feehead19' => $feehead19,
			'feehead20' => $feehead20,
			'feehead21' => $feehead21,
			'feehead22' => $feehead22,
			'feehead23' => $feehead23,
			'feehead24' => $feehead24,
			'feehead25' => $feehead25,
			'payment_mode' => $payment_mode,
			'bank' => $bank

			);
		// $this->fee_template('Fee_collection/collection_with_adm',$array);

		$this->fee_template('Bank_collection/collection_with_adm',$array);
	}
	public function month_detail()
	{
		$month = $this->input->post('chkboxx');
		$dat = array();
		foreach($month as $key => $value)
			{
				$dat[]=$value;
			    $mnt = implode("','",$dat);
		
		}
		
		$mnth_det = $this->db->query("select month_name from month_master where id IN('$mnt')")->result();
		
		$mntt = array();
		foreach($mnth_det as $key => $val)
			{
				
				$mntt[].=$val->month_name;
				
		    }
			
		$json = array('mntt'=>$mntt);
		echo json_encode($json);
	}
		public function collection_without_adm_save()
	{
		$session_year = $this->dbcon->select('session_master','Session_Year',"Active_Status='1'");
		$current_year = $session_year[0]->Session_Year;
		$pay_mod = $this->input->post('pay_mod');
		// echo '<pre>';
		// print_r($_POST);
		// die;
		 if($pay_mod=='CASH')
		 {
		 	$chqcard = "N/A";
		 	$bank_details = "N/A";
		 }
		 elseif($pay_mod=='CARD SWAP' || $pay_mod=='BQR' || $pay_mod=='NEFT')
		 {
		 	$chqcard = $this->input->post('card_name');
		 	$bank_details = $this->input->post('bank_name');
		 }
		 elseif($pay_mod=='CHEQUE')
		 {
		 	$chqcard = $this->input->post('chque_name');
		 	$bank_details = $this->input->post('bank_name');
		 }
		 else
		 {

		 }
		//  $User_Id = $this->session->userdata('user_id');
		 $User_Id = 'EMP0113';
		 $master = $this->dbcon->select('master','*',"User_ID='$User_Id' AND Collection_Type='1'");
		 $CounterNo = $master[0]->CounterNo;
		 $recptNumeric = $this->dbcon->recpt_numeric_Details($CounterNo);
		 $increase_part = isset($recptNumeric[0]->MAX_NUMBER)?$recptNumeric[0]->MAX_NUMBER:1;
		 $increase_part = sprintf("%06d", $increase_part);
		 $recpt_no = $CounterNo.$increase_part;
		 $data = array(
			'RECT_NO' => $recpt_no,
			'RECT_DATE' => $this->input->post('recpitdate'),
			'STU_NAME' => strtoupper($this->input->post('stdname')),
			'ADM_NO' => "NONE",
			'CLASS' => $this->input->post('class'),
			'SEC' => "-",
			'ROLL_NO' => 0,
			'PERIOD' => strtoupper($this->input->post('collection_type')),
			'TOTAL' => $this->input->post('totalamount'),
			'GROSS_AMOUNT' =>  $this->input->post('totalamount'),
			'PAID_AMOUNT' => $this->input->post('totalamount'),
			'SHORT_AMOUNT' => 0,
			'Recovered_Short_Amt' => 0,
			'Fee1' => $this->input->post('feehead1'),
			'Fee2' => $this->input->post('feehead2'),
			'Fee3' => $this->input->post('feehead3'),
			'Fee4' => $this->input->post('feehead4'),
			'Fee5' => $this->input->post('feehead5'),
			'Fee6' => $this->input->post('feehead6'),
			'Fee7' => $this->input->post('feehead7'),
			'Fee8' => $this->input->post('feehead8'),
			'Fee9' => $this->input->post('feehead9'),
			'Fee10' => $this->input->post('feehead10'),
			'Fee11' => $this->input->post('feehead11'),
			'Fee12' => $this->input->post('feehead12'),
			'Fee13' => $this->input->post('feehead13'),
			'Fee14' => $this->input->post('feehead14'),
			'Fee15' => $this->input->post('feehead15'),
			'Fee16' => $this->input->post('feehead16'),
			'Fee17' => $this->input->post('feehead17'),
			'Fee18' => $this->input->post('feehead18'),
			'Fee19' => $this->input->post('feehead19'),
			'Fee20' => $this->input->post('feehead20'),
			'Fee21' => $this->input->post('feehead21'),
			'Fee22' => $this->input->post('feehead22'),
			'Fee23' => $this->input->post('feehead23'),
			'Fee24' => $this->input->post('feehead24'),
			'Fee25' => $this->input->post('feehead25'),
			'APR_FEE' => "N/A",
			'MAY_FEE' => "N/A",
			'JUNE_FEE' => "N/A",
			'JULY_FEE' => "N/A",
			'AUG_FEE' => "N/A",
			'SEP_FEE' => "N/A",
			'OCT_FEE' => "N/A",
			'NOV_FEE' => "N/A",
			'DEC_FEE' => "N/A",
			'JAN_FEE' => "N/A",
			'FEB_FEE' => "N/A",
			'MAR_FEE' => "N/A",
			'CHQ_NO' => $chqcard,
			'Narr' => "N/A",
			'TAmt' => 0,
			'Fee_Book_No' => "N/A",
			'Collection_Mode' => 1,
			'User_Id' => $User_Id,
			'Payment_Mode' => $pay_mod,
			'Bank_Name' => $bank_details,
			'Pay_Date' => date("Y-m-d"),
			'Session_Year' => $current_year,
			'FORM_NO' => $this->input->post('formno')
		);

    	if($this->dbcon->insert('daycoll',$data))
		 {
		 	$master = $this->dbcon->select('master','*',"User_ID='$User_Id' AND Collection_Type='1'");

		 	$recipt_no = $master[0]->ReceiptNo;

		 	$recipt_increment = $recipt_no+1;

		 	$inc_array = array('ReceiptNo' =>$recipt_increment);

		 	$this->dbcon->update('master',$inc_array,"User_ID='$User_Id' AND Collection_Type='1'");

		 	$fetch_data = $this->dbcon->select('daycoll','*',"RECT_NO='$recpt_no'");
		 	$school_details = $this->dbcon->select('school_setting','*');
		 	$receipt_details = $this->dbcon->select('daycoll','*',"RECT_NO='$recpt_no'");
		 	$feehead1 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='1'");
			$feehead2 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='2'");
			$feehead3 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='3'");
			$feehead4 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='4'");
			$feehead5 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='5'");
			$feehead6 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='6'");
			$feehead7 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='7'");
			$feehead8 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='8'");
			$feehead9 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='9'");
			$feehead10 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='10'");
			$feehead11 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='11'");
			$feehead12 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='12'");
			$feehead13 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='13'");
			$feehead14 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='14'");
			$feehead15 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='15'");
			$feehead16 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='16'");
			$feehead17 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='17'");
			$feehead18 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='18'");
			$feehead19 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='19'");
			$feehead20 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='20'");
			$feehead21 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='21'");
			$feehead22 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='22'");
			$feehead23 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='23'");
			$feehead24 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='24'");
			$feehead25 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='25'");

		 	$report_data = array(
		 		'school_setting' => $school_details,
		 		'receipt_details' =>$receipt_details,
		 		'feehead1' => $feehead1,
				'feehead2' => $feehead2,
				'feehead3' => $feehead3,
				'feehead4' => $feehead4,
				'feehead5' => $feehead5,
				'feehead6' => $feehead6,
				'feehead7' => $feehead7,
				'feehead8' => $feehead8,
				'feehead9' => $feehead9,
				'feehead10' => $feehead10,
				'feehead11' => $feehead11,
				'feehead12' => $feehead12,
				'feehead13' => $feehead13,
				'feehead14' => $feehead14,
				'feehead15' => $feehead15,
				'feehead16' => $feehead16,
				'feehead17' => $feehead17,
				'feehead18' => $feehead18,
				'feehead19' => $feehead19,
				'feehead20' => $feehead20,
				'feehead21' => $feehead21,
				'feehead22' => $feehead22,
				'feehead23' => $feehead23,
				'feehead24' => $feehead24,
				'feehead25' => $feehead25
		 	);
		 	$this->load->view('Bank_collection/feecollection_withoutadm_onlinereport',$report_data);
		 /*$this->load->view('Fee_collection/collection_without_adm_report',$report_data);
		    $html = $this->output->get_output();
			$this->load->library('pdf');
			$this->dompdf->loadHtml($html);
			$this->dompdf->setPaper('A4', 'portrait');
			$this->dompdf->render();
			$this->dompdf->stream("$recpt_no.pdf", array("Attachment"=>0));*/
		 }
	}
	
	public function bank_collection_misl(){

		$feehead1 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='1'");
		$feehead2 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='2'");
		$feehead3 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='3'");
		$feehead4 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='4'");
		$feehead5 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='5'");
		$feehead6 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='6'");
		$feehead7 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='7'");
		$feehead8 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='8'");
		$feehead9 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='9'");
		$feehead10 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='10'");
		$feehead11 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='11'");
		$feehead12 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='12'");
		$feehead13 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='13'");
		$feehead14 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='14'");
		$feehead15 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='15'");
		$feehead16 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='16'");
		$feehead17 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='17'");
		$feehead18 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='18'");
		$feehead19 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='19'");
		$feehead20 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='20'");
		$feehead21 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='21'");
		$feehead22 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='22'");
		$feehead23 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='23'");
		$feehead24 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='24'");
		$feehead25 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='25'");
		$adm = $this->dbcon->select('student','ADM_NO');
		$bank = $this->dbcon->select('bank_master','*');
		$payment_mode = $this->dbcon->select('payment_mode','*');
		$array = array(
			    'feehead1' => $feehead1,
				'feehead2' => $feehead2,
				'feehead3' => $feehead3,
				'feehead4' => $feehead4,
				'feehead5' => $feehead5,
				'feehead6' => $feehead6,
				'feehead7' => $feehead7,
				'feehead8' => $feehead8,
				'feehead9' => $feehead9,
				'feehead10' => $feehead10,
				'feehead11' => $feehead11,
				'feehead12' => $feehead12,
				'feehead13' => $feehead13,
				'feehead14' => $feehead14,
				'feehead15' => $feehead15,
				'feehead16' => $feehead16,
				'feehead17' => $feehead17,
				'feehead18' => $feehead18,
				'feehead19' => $feehead19,
				'feehead20' => $feehead20,
				'feehead21' => $feehead21,
				'feehead22' => $feehead22,
				'feehead23' => $feehead23,
				'feehead24' => $feehead24,
				'feehead25' => $feehead25,
				'bank' => $bank,
				'payment_mode' => $payment_mode,
				'adm' => $adm
		);

		$this->fee_template('Bank_collection/bank_collection_misl',$array);
	}

	public function bank_misc_collection_data(){
		$User_Id = 'EMP0113';
		$master = $this->dbcon->select('master','*',"User_ID='$User_Id' AND Collection_Type='1'");
		$CounterNo = $master[0]->CounterNo;
		$recptNumeric = $this->dbcon->recpt_numeric_Details($CounterNo);
		$increase_part = isset($recptNumeric[0]->MAX_NUMBER)?$recptNumeric[0]->MAX_NUMBER:1;
		$increase_part = sprintf("%06d", $increase_part);
		$recpt_no = $CounterNo.$increase_part;
		$recpt_date = $this->input->post('rcpt_date');
		$adm_no = $this->input->post('adm_no');
		$adm_date = $this->input->post('adm_date');
		$std_name = $this->input->post('std_name');
		$std_id = $this->input->post('std_id');
		$father_name = $this->input->post('father_name');
		$ward_type = $this->input->post('ward_type');
		// class/sec type data explode sec and class //
		$cs_type =$this->input->post('cs_type');
		$clsec = explode("-",$cs_type);
		$class = $clsec[0];
		$sec = $clsec[1];
		$roll = $this->input->post('roll');
		$bus_stopage = $this->input->post('bus_stopage');
		$bus_amt = $this->input->post('bus_amt');
		$collection_type = $this->input->post('collection_type');
		$apr = $this->input->post('apr');
		$may = $this->input->post('may');
		$jun = $this->input->post('jun');
		$jul = $this->input->post('jul');
		$aug = $this->input->post('aug');
		$sep = $this->input->post('sep');
		$oct = $this->input->post('oct');
		$nov = $this->input->post('nov');
		$dec = $this->input->post('dec');
		$jan = $this->input->post('jan');
		$feb = $this->input->post('feb');
		$mar = $this->input->post('mar');

		if($apr=='APR')
		{
			$aprfee = $recpt_no;
		}
		else
		{
			$aprfee ='N/A';
		}

		if($may=='MAY')
		{
		    $mayfee = $recpt_no;
		}
		else
		{
			$mayfee ='N/A';
		}

		if($jun=='JUN')
		{
			$junfee = $recpt_no;
		}
		else
		{
			$junfee ='N/A';
		}

		if($jul=='JUL')
		{
		     $julfee = $recpt_no;
		}
		else
		{
			$julfee ='N/A';
		}

		if($aug=='AUG')
		{
			$augfee = $recpt_no;
		}
		else
		{
			$augfee ='N/A';
		}

		if($sep=='SEP')
		{
			$sepfee = $recpt_no;
		}
		else
		{
			$sepfee ='N/A';
		}

		if($oct=='OCT')
		{
			$octfee = $recpt_no;
		}
		else
		{
			$octfee ='N/A';
		}

		if($nov=='NOV')
		{
			$novfee = $recpt_no;
		}
		else
		{
			$novfee ='N/A';
		}

		if($dec=='DEC')
		{
			$decfee = $recpt_no;
		}
		else
		{
			$decfee ='N/A';
		}

		if($jan=='JAN')
		{
			$janfee = $recpt_no;
		}
		else
		{
			$janfee ='N/A';
		}

		if($feb=='FEB')
		{
			$febfee = $recpt_no;
		}
		else
		{
			$febfee ='N/A';
		}

		if($mar=='MAR')
		{
			$marfee = $recpt_no;
		}
		else
		{
			$marfee ='N/A';
		}

		$feehead1 = $this->input->post('feehead1');
		$feehead2 = $this->input->post('feehead2');
		$feehead3 = $this->input->post('feehead3');
		$feehead4 = $this->input->post('feehead4');
		$feehead5 = $this->input->post('feehead5');
		$feehead6 = $this->input->post('feehead6');
		$feehead7 = $this->input->post('feehead7');
		$feehead8 = $this->input->post('feehead8');
		$feehead9 = $this->input->post('feehead9');
		$feehead10 = $this->input->post('feehead10');
		$feehead11 = $this->input->post('feehead11');
		$feehead12 = $this->input->post('feehead12');
		$feehead13 = $this->input->post('feehead13');
		$feehead14 = $this->input->post('feehead14');
		$feehead15 = $this->input->post('feehead15');
		$feehead16 = $this->input->post('feehead16');
		$feehead17 = $this->input->post('feehead17');
		$feehead18 = $this->input->post('feehead18');
		$feehead19 = $this->input->post('feehead19');
		$feehead20 = $this->input->post('feehead20');
		$feehead21 = $this->input->post('feehead21');
		$feehead22 = $this->input->post('feehead22');
		$feehead23 = $this->input->post('feehead23');
		$feehead24 = $this->input->post('feehead24');
		$feehead25 = $this->input->post('feehead25');
		$totalamount = $this->input->post('totalamount');
		$pay_mod = $this->input->post('pay_mod');
		$session_year = $this->dbcon->select('session_master','Session_Year',"Active_Status='1'");
		$current_year = $session_year[0]->Session_Year;
		 if($pay_mod=='CASH')
		 {
		 	$chqcard = "N/A";
		 	$bank_details = "N/A";
		 }
		 elseif($pay_mod=='CARD SWAP')
		 {
		 	$chqcard = $this->input->post('card_name');
		 	$bank_details = $this->input->post('bank_name');
		 }
		 elseif($pay_mod=='CHEQUE')
		 {
		 	$chqcard = $this->input->post('chque_name');
		 	$bank_details = $this->input->post('bank_name');
		 }
		 else
		 {

		 }
		 $User_Id = $this->session->userdata('user_id');

		$data = array(
			'RECT_NO' =>$recpt_no,
			'RECT_DATE' => $recpt_date,
			'STU_NAME' => $std_name,
			'STUDENTID' => $std_id,
			'ADM_NO' => $adm_no,
			'CLASS' => $class,
			'SEC' => $sec,
			'ROLL_NO' => $roll,
			'PERIOD' => 'MISL.-'.strtoupper($collection_type),
			'TOTAL' => $totalamount,
			'GROSS_AMOUNT' => $totalamount,
			'PAID_AMOUNT' => $totalamount,
			'SHORT_AMOUNT' => 0,
			'Recovered_Short_Amt' => 0,
			'Fee1' => $feehead1,
			'Fee2' => $feehead2,
			'Fee3' => $feehead3,
			'Fee4' => $feehead4,
			'Fee5' => $feehead5,
			'Fee6' => $feehead6,
			'Fee7' => $feehead7,
			'Fee8' => $feehead8,
			'Fee9' => $feehead9,
			'Fee10'=> $feehead10,
			'Fee11'=> $feehead11,
			'Fee12'=> $feehead12,
			'Fee13'=> $feehead13,
			'Fee14'=> $feehead14,
			'Fee15'=> $feehead15,
			'Fee16'=> $feehead16,
			'Fee17'=> $feehead17,
			'Fee18'=> $feehead18,
			'Fee19'=> $feehead19,
			'Fee20'=> $feehead20,
			'Fee21'=> $feehead21,
			'Fee22'=> $feehead22,
			'Fee23'=> $feehead23,
			'Fee24'=> $feehead24,
			'Fee25'=> $feehead25,
			'APR_FEE' => $aprfee,
			'MAY_FEE' => $mayfee,
			'JUNE_FEE' => $junfee,
			'JULY_FEE' => $julfee,
			'AUG_FEE' => $augfee,
			'SEP_FEE' => $sepfee,
			'OCT_FEE' => $octfee,
			'NOV_FEE' => $novfee,
			'DEC_FEE' => $decfee,
			'JAN_FEE' => $janfee,
			'FEB_FEE' => $febfee,
			'MAR_FEE' => $marfee,
			'CHQ_NO' => $chqcard,
			'Narr' =>  "N/A",
			'TAmt' => 0,
			'Fee_Book_No' => "N/A" ,
			'Collection_Mode' => 1,
			'User_Id' => $this->session->userdata('user_id'),
			'Payment_Mode' => $pay_mod,
			'Bank_Name' => $bank_details,
			'Pay_Date' => $recpt_date,
			'Session_Year' => $current_year,
			'FORM_NO' => "N/A",
		);

		if($this->dbcon->insert('daycoll',$data))
		{

		 	$fetch_data = $this->dbcon->select('daycoll','*',"RECT_NO='$recpt_no'");
		 	$school_details = $this->dbcon->select('school_setting','*');
		 	$receipt_details = $this->dbcon->select('daycoll','*',"RECT_NO='$recpt_no'");
		 	$feehead1 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='1'");
			$feehead2 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='2'");
			$feehead3 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='3'");
			$feehead4 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='4'");
			$feehead5 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='5'");
			$feehead6 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='6'");
			$feehead7 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='7'");
			$feehead8 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='8'");
			$feehead9 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='9'");
			$feehead10 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='10'");
			$feehead11 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='11'");
			$feehead12 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='12'");
			$feehead13 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='13'");
			$feehead14 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='14'");
			$feehead15 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='15'");
			$feehead16 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='16'");
			$feehead17 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='17'");
			$feehead18 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='18'");
			$feehead19 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='19'");
			$feehead20 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='20'");
			$feehead21 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='21'");
			$feehead22 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='22'");
			$feehead23 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='23'");
			$feehead24 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='24'");
			$feehead25 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='25'");

		 	$report_data = array(
		 		'school_setting' => $school_details,
		 		'receipt_details' =>$receipt_details,
		 		'feehead1' => $feehead1,
				'feehead2' => $feehead2,
				'feehead3' => $feehead3,
				'feehead4' => $feehead4,
				'feehead5' => $feehead5,
				'feehead6' => $feehead6,
				'feehead7' => $feehead7,
				'feehead8' => $feehead8,
				'feehead9' => $feehead9,
				'feehead10' => $feehead10,
				'feehead11' => $feehead11,
				'feehead12' => $feehead12,
				'feehead13' => $feehead13,
				'feehead14' => $feehead14,
				'feehead15' => $feehead15,
				'feehead16' => $feehead16,
				'feehead17' => $feehead17,
				'feehead18' => $feehead18,
				'feehead19' => $feehead19,
				'feehead20' => $feehead20,
				'feehead21' => $feehead21,
				'feehead22' => $feehead22,
				'feehead23' => $feehead23,
				'feehead24' => $feehead24,
				'feehead25' => $feehead25
		 	);
		 	$this->load->view('Bank_collection/bank_misc_collection_online_report',$report_data);
		}
	}

	public function miss_dataajax()
	{
		$stu_adm = $this->input->post('val');
		
		$stu_data = $this->dbcon->misc_collection($stu_adm);

		echo json_encode($stu_data);
		
	}

}
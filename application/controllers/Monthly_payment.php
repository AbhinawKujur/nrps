<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Monthly_payment extends MY_controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function monthly_pay_details()
	{
		$adm_no    		= $this->input->post('adm_no');
		//$curr_date = date('d-m-y');
		
		//$rect_date = date('Y-m-d',strtotime('$curr_date');
		//$rect_date = date('Y-m-D');
		//$rect_date = date('Y-m-d',strtotime($this->input->post('rect_date')));
		$curr_date = date('Y-m-d');
		$rect_date = $curr_date;
		$this->session->set_userdata('adm_session',$adm_no);
		$ward_type 		= $this->input->post('ward_type');
		$bsn       		= $this->input->post('bsn');
		$this->session->set_userdata('bsn',$bsn);
		$bsa       		= $this->input->post('bsa');
		$ffm	   		= $this->input->post('ffm');
		$totalamount 	= $this->input->post('totalamount'); //paid amount
		$shortamount 	= $this->input->post('shortamount'); //short amount
		$grossamount 	= $this->input->post('grossamount'); //grossamount
		$rsa 	= $this->input->post('rsa'); //collected short amount
		$grossamount_new 	= $this->input->post('grossamount_new'); //collected short amount
		$feehead1   	= $this->input->post('feehead1');
		$feehead2       = $this->input->post('feehead2');
		$feehead3		= $this->input->post('feehead3');
		$feehead4       = $this->input->post('feehead4');
		$feehead5		= $this->input->post('feehead5');
		$feehead6		= $this->input->post('feehead6');
		$feehead7		= $this->input->post('feehead7');
		$feehead8		= $this->input->post('feehead8');
		$feehead9		= $this->input->post('feehead9');
		$feehead10		= $this->input->post('feehead10');
		$feehead11		= $this->input->post('feehead11');
		$feehead12		= $this->input->post('feehead12');
		$feehead13		= $this->input->post('feehead13');
		$feehead14		= $this->input->post('feehead14');
		$feehead15		= $this->input->post('feehead15');
		$feehead16		= $this->input->post('feehead16');
		$feehead17		= $this->input->post('feehead17');
		$feehead18		= $this->input->post('feehead18');
		$feehead19		= $this->input->post('feehead19');
		$feehead20		= $this->input->post('feehead20');
		$feehead21		= $this->input->post('feehead21');
		$feehead22		= $this->input->post('feehead22');
		$feehead23		= $this->input->post('feehead23');
		$feehead24		= $this->input->post('feehead24');
		$feehead25		= $this->input->post('feehead25');
		$pay_mod		= $this->input->post('pay_mod');
		
		// student details //
		$student_details = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
		@$stu_name  = $student_details[0]->FIRST_NM;
		@$STUDENTID = $student_details[0]->STUDENTID;
		@$stu_class = $student_details[0]->DISP_CLASS;
		@$stu_sec   = $student_details[0]->DISP_SEC;
		@$ROLL_NO   = $student_details[0]->ROLL_NO;
		@$MON_FEE[0]   = $student_details[0]->APR_FEE;
		@$MON_FEE[1]   = $student_details[0]->MAY_FEE;
		@$MON_FEE[2]   = $student_details[0]->JUNE_FEE;
		@$MON_FEE[3]   = $student_details[0]->JULY_FEE;
		@$MON_FEE[4]   = $student_details[0]->AUG_FEE;
		@$MON_FEE[5]   = $student_details[0]->SEP_FEE;
		@$MON_FEE[6]   = $student_details[0]->OCT_FEE;
		@$MON_FEE[7]   = $student_details[0]->NOV_FEE;
		@$MON_FEE[8]   = $student_details[0]->DEC_FEE;
		@$MON_FEE[9]   = $student_details[0]->JAN_FEE;
		@$MON_FEE[10]   = $student_details[0]->FEB_FEE;
		@$MON_FEE[11]   = $student_details[0]->MAR_FEE;
		// student details fetching done //
		
		// getting current session year details //
		 $session_master = $this->dbcon->select('session_master','*',"Active_Status='1'");
		 $Session_Year = $session_master[0]->Session_Year;
		// end of fetching current session year //
		
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
		elseif($pay_mod=='BQR')
		{
			$chqcard = $this->input->post('card_name');
		 	$bank_details = $this->input->post('bank_name');
		}
		elseif($pay_mod=='NEFT')
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
			$chqcard = 'N/A';
			$bank_details='N/A';
		 }
		 $User_Id = $this->session->userdata('user_id');
		 $master = $this->dbcon->select('master','*',"User_ID='$User_Id' AND Collection_Type='1'");
		 $CounterNo = $master[0]->CounterNo;
		 $recptNumeric = $this->dbcon->recpt_numeric_Details($CounterNo);
		 $increase_part = isset($recptNumeric[0]->MAX_NUMBER)?$recptNumeric[0]->MAX_NUMBER:1;
		 $increase_part = sprintf("%06d", $increase_part);
		 $rcpt_no = $CounterNo.$increase_part;
		
		 $this->session->set_userdata('sessionRecepitData',$rcpt_no);
		
		//$get_daycoll_rcpt_details = $this->db->query("select PERIOD from daycoll where RECT_NO='$rcpt_no'")->result();
		//$month_nm_period = $get_daycoll_rcpt_details[0]->PERIOD;
		$mon = explode(",",$ffm);
		
		foreach($mon as $key => $val){
			  if($val == 'JUN'){
				  $val = 'JUNE';
				}
			  if($val == 'JUL'){
				  $val = 'JULY';
				}
		
		  $daycall = array(
			'RECT_NO'         => $rcpt_no,
			'RECT_DATE'       => $rect_date,
			'STU_NAME'        => $stu_name,
			'STUDENTID'       => $STUDENTID,
			'ADM_NO'          => $adm_no,
			'CLASS'           => $stu_class,
			'SEC'		      => $stu_sec,
			'ROLL_NO'         => $ROLL_NO,
			'PERIOD'          => $ffm,
			'TOTAL'           => $totalamount,
			'PAID_AMOUNT'           => $totalamount,
			'SHORT_AMOUNT'           => $shortamount,
			'Recovered_Short_Amt'    => $rsa,
			'GROSS_AMOUNT'    => $grossamount_new, 
			'Fee1'            => $feehead1,
			'Fee2'            => $feehead2,
			'Fee3'            => $feehead3,
			'Fee4'		      => $feehead4,
			'Fee5'            => $feehead5,
			'Fee6'            => $feehead6,
			'Fee7'            => $feehead7,
			'Fee8'            => $feehead8,
			'Fee9'            => $feehead9,
			'Fee10'           => $feehead10,
			'Fee11'           => $feehead11,
			'Fee12'           => $feehead12,
			'Fee13'           => $feehead13,
			'Fee14'           => $feehead14,
			'Fee15'           => $feehead15,
			'Fee16'           => $feehead16,
			'Fee17'           => $feehead17,
			'Fee18'           => $feehead18,
			'Fee19'           => $feehead19,
			'Fee20'           => $feehead20,
			'Fee21'           => $feehead21,
			'Fee22'           => $feehead22,
			'Fee23'           => $feehead23,
			'Fee24'           => $feehead24,
			'Fee25'           => $feehead25,
			$val.'_FEE' => $rcpt_no,
			'CHQ_NO'          => $chqcard,
			'Narr'            => "N/A",
			'TAmt'            => 0,
			'Fee_Book_No' 	  => "N/A",
			'Collection_Mode' => 1,
			'User_Id'         => $User_Id,
			'Payment_Mode'    => $pay_mod,
			'Bank_Name'       => $bank_details,
			//'Pay_Date'        => date("Y-m-d"),
			'Session_Year'    => $Session_Year,
			'FORM_NO'    => 'N/A'
		);
			$dayycol = $this->db->query("select * from daycoll where RECT_NO='$rcpt_no'")->result();
				$dy_cnt = count($dayycol);
				if($dy_cnt == 0)
				{
		  $this->dbcon->insert('daycoll',$daycall);
				}
				else{
			 $upd_dyy = array(
				
				$val.'_FEE' => $rcpt_no,
				
			);
					
					
				
			$this->dbcon->update('daycoll',$upd_dyy,"RECT_NO='$rcpt_no'");
				}
			
				$upd_stu = array(
				
				$val.'_FEE' => $rcpt_no,
				
			);
				
			$this->dbcon->update('student',$upd_stu,"ADM_NO='$adm_no'");
				
			}
		
		if ($shortamount <= 0) {
				
			$short_recoverd_payment = array(
				'RECT_NO'         => $rcpt_no,
				'RECT_DATE'       => $rect_date,
				'STU_NAME'        => $stu_name,
				'STUDENTID'       => $STUDENTID,
				'ADM_NO'          => $adm_no,
				'CLASS'           => $stu_class,
				'SEC'		      => $stu_sec,
				'TOTAL'           => $totalamount,
				'User_Id'         => $User_Id,
				'PAID_AMOUNT'           => $totalamount,
				'SHORT_AMOUNT'           => $shortamount,
				'Recovered_Short_Amt'    => $rsa,
				'GROSS_AMOUNT'    => $grossamount_new,
				'Recovered_Short_Amt' => $rsa,
				'updated_by' => $User_Id,
				'updated_on' => $rect_date
			);

			$this->dbcon->insert('short_recoverd_payment', $short_recoverd_payment);
		}
	}
	
	public function payment_rec_gen(){
			$student_details = $this->dbcon->select('student','*',"ADM_NO='".$this->session->userdata('adm_session')."'");
			@$stu_name  = $student_details[0]->FIRST_NM;
			@$STUDENTID = $student_details[0]->STUDENTID;
			@$stu_class = $student_details[0]->DISP_CLASS;
			@$stu_sec   = $student_details[0]->DISP_SEC;
			@$ROLL_NO   = $student_details[0]->ROLL_NO;
			@$MON_FEE[0]   = $student_details[0]->APR_FEE;
			@$MON_FEE[1]   = $student_details[0]->MAY_FEE;
			@$MON_FEE[2]   = $student_details[0]->JUNE_FEE;
			@$MON_FEE[3]   = $student_details[0]->JULY_FEE;
			@$MON_FEE[4]   = $student_details[0]->AUG_FEE;
			@$MON_FEE[5]   = $student_details[0]->SEP_FEE;
			@$MON_FEE[6]   = $student_details[0]->OCT_FEE;
			@$MON_FEE[7]   = $student_details[0]->NOV_FEE;
			@$MON_FEE[8]   = $student_details[0]->DEC_FEE;
			@$MON_FEE[9]   = $student_details[0]->JAN_FEE;
			@$MON_FEE[10]   = $student_details[0]->FEB_FEE;
			@$MON_FEE[11]   = $student_details[0]->MAR_FEE;
		
		
		    $ses = $this->session->userdata('sessionRecepitData');
			$school_details = $this->dbcon->select('school_setting','*');
		 	$receipt_details = $this->dbcon->select('daycoll','*',"RECT_NO='$ses'");
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
				'feehead25' => $feehead25,
				'student_details' => $student_details,
				'bsn'	    => $this->session->userdata('bsn')
		 	);
		 	$this->load->view('Fee_collection/monthly_collection_online_report',$report_data);	
	}
}
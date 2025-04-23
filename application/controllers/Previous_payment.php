<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Previous_payment extends MY_controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function monthly_pay_details()
	{
		$rcpt_no   		= $this->input->post('rcpt_no');
		$adm_no    		= $this->input->post('adm_no');
		$ward_type 		= $this->input->post('ward_type');
		$bsn       		= $this->input->post('bsn');
		$bsa       		= $this->input->post('bsa');
		$ffm	   		= $this->input->post('ffm');
		$totalamount 	= $this->input->post('totalamount');
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
		$month_sep = explode("-",$ffm);
		$mn_cnt = count($month_sep);
		$apr_recpt_daycoll = 'N/A';
		$may_recpt_daycoll = 'N/A';
		$jun_recpt_daycoll = 'N/A';
		$jul_recpt_daycoll = 'N/A';
		$aug_recpt_daycoll = 'N/A';
		$sep_recpt_daycoll = 'N/A';
		$oct_recpt_daycoll = 'N/A';
		$nov_recpt_daycoll = 'N/A';
		$dec_recpt_daycoll = 'N/A';
		$jan_recpt_daycoll = 'N/A';
		$feb_recpt_daycoll = 'N/A';
		$mar_recpt_daycoll = 'N/A';
		for($i=0;$i<$mn_cnt;$i++){
			if($month_sep[$i]=='APR')
			{
				$apr_recpt_daycoll = $rcpt_no;
			}
			elseif($month_sep[$i]=='MAY')
			{
				$may_recpt_daycoll = $rcpt_no;
			}
			elseif($month_sep[$i]=='JUN')
			{
				$jun_recpt_daycoll = $rcpt_no;
			}
			elseif($month_sep[$i]=='JUL')
			{
				$jul_recpt_daycoll = $rcpt_no;
			}
			elseif($month_sep[$i]=='AUG')
			{
				$aug_recpt_daycoll = $rcpt_no;
			}
			elseif($month_sep[$i]=='SEP')
			{
				$sep_recpt_daycoll = $rcpt_no;
			}
			elseif($month_sep[$i]=='OCT')
			{
				$oct_recpt_daycoll = $rcpt_no;
			}
			elseif($month_sep[$i]=='NOV')
			{
				$nov_recpt_daycoll = $rcpt_no;
			}
			elseif($month_sep[$i]=='DEC')
			{
				$dec_recpt_daycoll = $rcpt_no;
			}
			elseif($month_sep[$i]=='JAN')
			{
				$jan_recpt_daycoll = $rcpt_no;
			}
			elseif($month_sep[$i]=='FEB')
			{
				$feb_recpt_daycoll = $rcpt_no;
			}
			elseif($month_sep[$i]=='MAR')
			{
				$mar_recpt_daycoll = $rcpt_no;
			}
		}
		
			
		
		// student details //
		$student_details = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
		@$stu_name  = $student_details[0]->FIRST_NM;
		@$STUDENTID = $student_details[0]->STUDENTID;
		@$stu_class = $student_details[0]->DISP_CLASS;
		@$stu_sec   = $student_details[0]->DISP_SEC;
		@$ROLL_NO   = $student_details[0]->ROLL_NO;
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
		 elseif($pay_mod=='CHEQUE')
		 {
		 	$chqcard = $this->input->post('chque_name');
		 	$bank_details = $this->input->post('bank_name');
		 }
		elseif ($pay_mod == 'BQR') 
		{
			$chqcard = $this->input->post('card_name');
			$bank_details = $this->input->post('bank_name');
		} 
		elseif ($pay_mod == 'NEFT') 
		{
			$chqcard = $this->input->post('card_name');
			$bank_details = $this->input->post('bank_name');
		}
		else
		{
			$chqcard = "N/A";
		 	$bank_details = "N/A";
		}
		 $User_Id = $this->session->userdata('user_id');
		
		$daycall = array(
			'RECT_NO'         => $rcpt_no,
			'RECT_DATE'       => date("Y-m-d"),
			'STU_NAME'        => $stu_name,
			'STUDENTID'       => $STUDENTID,
			'ADM_NO'          => $adm_no,
			'CLASS'           => $stu_class,
			'SEC'		      => $stu_sec,
			'ROLL_NO'         => $ROLL_NO,
			'PERIOD'          => "PRE.DUES-".$ffm,
			'TOTAL'           => $totalamount,
			'Fee1'            => 0,
			'Fee2'            => 0,
			'Fee3'            => 0,
			'Fee4'		      => 0,
			'Fee5'            => 0,
			'Fee6'            => 0,
			'Fee7'            => 0,
			'Fee8'            => 0,
			'Fee9'            => 0,
			'Fee10'           => 0,
			'Fee11'           => 0,
			'Fee12'           => 0,
			'Fee13'           => 0,
			'Fee14'           => 0,
			'Fee15'           => 0,
			'Fee16'           => 0,
			'Fee17'           => 0,
			'Fee18'           => 0,
			'Fee19'           => 0,
			'Fee20'           => 0,
			'Fee21'           => 0,
			'Fee22'           => 0,
			'Fee23'           => 0,
			'Fee24'           => 0,
			'Fee25'           => $totalamount,
			'APR_FEE'	      => "N/A",
			'MAY_FEE'	      => "N/A",
			'JUNE_FEE'	      => "N/A",
			'JULY_FEE'	      => "N/A",
			'AUG_FEE'	      => "N/A",
			'SEP_FEE'         => "N/A",
			'OCT_FEE'         => "N/A",
			'NOV_FEE'         => "N/A",
			'DEC_FEE'         => "N/A",
			'JAN_FEE'         => "N/A",
			'FEB_FEE'         => "N/A",
			'MAR_FEE'         => "N/A",
			'CHQ_NO'          => $chqcard,
			'Narr'            => "N/A",
			'TAmt'            => 0,
			'Fee_Book_No' 	  => "N/A",
			'Collection_Mode' => 1,
			'User_Id'         => $User_Id,
			'Payment_Mode'    => $pay_mod,
			'Bank_Name'       => $bank_details,
			'Pay_Date'        => date("Y-m-d"),
			'Session_Year'    => $Session_Year,
			'FORM_NO'    => 'N/A',
			'GROSS_AMOUNT' => $totalamount,
			'PAID_AMOUNT' => $totalamount,
			'SHORT_AMOUNT' => 0,
			'RECOVERED_SHORT_AMT' => 0
		);
		$PRE_COLLECTION = array(
			'RECT_NO'         => $rcpt_no,
			'RECT_DATE'       => date("Y-m-d"),
			'STU_NAME'        => $stu_name,
			'STUDENTID'       => $STUDENTID,
			'ADM_NO'          => $adm_no,
			'CLASS'           => $stu_class,
			'SEC'		      => $stu_sec,
			'ROLL_NO'         => $ROLL_NO,
			'PERIOD'          => "PRE.DUES-".$ffm,
			'TOTAL'           => $totalamount,
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
			'APR_FEE'	      => $apr_recpt_daycoll,
			'MAY_FEE'	      => $may_recpt_daycoll,
			'JUNE_FEE'	      => $jun_recpt_daycoll,
			'JULY_FEE'	      => $jul_recpt_daycoll,
			'AUG_FEE'	      => $aug_recpt_daycoll,
			'SEP_FEE'         => $sep_recpt_daycoll,
			'OCT_FEE'         => $oct_recpt_daycoll,
			'NOV_FEE'         => $nov_recpt_daycoll,
			'DEC_FEE'         => $dec_recpt_daycoll,
			'JAN_FEE'         => $jan_recpt_daycoll,
			'FEB_FEE'         => $feb_recpt_daycoll,
			'MAR_FEE'         => $mar_recpt_daycoll,
			'CHQ_NO'          => $chqcard,
			'Narr'            => "N/A",
			'TAmt'            => 0,
			'Fee_Book_No' 	  => "N/A",
			'Collection_Mode' => 1,
			'User_Id'         => $User_Id,
			'Payment_Mode'    => $pay_mod,
			'Bank_Name'       => $bank_details,
			'Pay_Date'        => date("Y-m-d"),
			'Session_Year'    => $Session_Year,
			'FORM_NO'    => 'N/A'
		);
		$check_rect = $this->dbcon->checkData('*','daycoll',"RECT_NO='$rcpt_no'");
		if($check_rect){
			
				$school_details = $this->dbcon->select('school_setting','*');
				$receipt_details = $this->dbcon->select('daycoll','*',"RECT_NO='$rcpt_no'");
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
					'bsn'	    => $bsn
				);
				$this->load->view('previous_collection/monthly_collection_online_report',$report_data);
		}else{
			if($this->dbcon->insert('daycoll',$daycall) && $this->dbcon->insert('previous_year_collection',$PRE_COLLECTION))
			{
				$master = $this->dbcon->select('master','*',"User_ID='$User_Id' AND Collection_Type='1'");

				$recipt_no = $master[0]->ReceiptNo;

				$recipt_increment = $recipt_no+1;

				$inc_array = array('ReceiptNo' =>$recipt_increment);

				$this->dbcon->update('master',$inc_array,"User_ID='$User_Id' AND Collection_Type='1'");
				
				$school_details = $this->dbcon->select('school_setting','*');
				$receipt_details = $this->dbcon->select('daycoll','*',"RECT_NO='$rcpt_no'");
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
					'bsn'	    => $bsn
				);
				for($i=0;$i<$mn_cnt;$i++){
					$this->dbcon->del_pre_fee_generation($month_sep[$i],$adm_no);
				}
				$this->load->view('previous_collection/monthly_collection_online_report',$report_data);
			}
		}
		
	}
}
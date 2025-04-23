<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Cancel_reprint extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function cancel_reprintt(){
		$DATA = date('Y-m-d');
		$ROLE_ID = $this->session->userdata('ROLE_ID');
		$User_Id = $this->session->userdata('user_id');
		
		if($ROLE_ID == 10){ // setting role id for fee admin where role id is 10
			$rect_details = $this->dbcon->select('daycoll','RECT_NO',"PERIOD!='CANCELLED'");
		}
		else{ // setting role id for bank collection where role id is 14
			$rect_details = $this->dbcon->select('daycoll','RECT_NO',"User_Id='$User_Id' AND PERIOD!='CANCELLED' AND RECT_DATE = '$DATA'");
		}
		$array = array(
			'rect_details' => $rect_details
		);
		$this->fee_template('cancelreprint/cancel_reprint',$array);
	}
	public function match_password(){
		$pass = $this->input->post('pass');
		$pass_details = $this->dbcon->select('misc_password','password',"id='2' AND username='cancel-or-re-print-recipet' AND password='$pass'");
		echo $cnt = count($pass_details);
	}
	public function show_rect_details(){
		$rect_no = $this->input->post('rect_no');
		$details = $this->dbcon->select('daycoll','*',"RECT_NO='$rect_no'");
		$adm_no = $details[0]->ADM_NO;
		$period = substr($details[0]->PERIOD,0,4);
		if($period == "PRE.DUES"){
			$details = $this->dbcon->select('previous_year_collection','*',"RECT_NO='$rect_no'");
		}
		$student = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
		$feehead = $this->dbcon->select('feehead','*');
		if(!empty($student)){
			$ward_code = $student[0]->EMP_WARD;
			$emp_ward1 = $this->dbcon->select('eward','HOUSENAME',"HOUSENO='$ward_code'");
			$emp_ward = $emp_ward1[0]->HOUSENAME;
			$adm_date = $student[0]->ADM_DATE;
			$father_name = $student[0]->FATHER_NM;
			$adm_data = date("d-M-Y",strtotime($adm_date));
		}
		else{
			$emp_ward = "N/A";
			$adm_date = "N/A";
			$father_name = 'N/A';
			$adm_data = "N/A";
			
		}
		
		$feehead = $this->dbcon->select('feehead','FEE_HEAD');
		$array = array(
			'details' => $details,
			'feehead' => $feehead,
			'emp_ward' => $emp_ward,
			'adm_date' => $adm_date,
			'father_name' => $father_name,
			'adm_data' => $adm_data,
			'feehead'  => $feehead
		);
		$this->load->view('cancelreprint/cancel_reprint_studentdata',$array);
	}
	public function duplicate_copy(){
		$rect_no = $this->input->post("rect_no");
		$school_setting = $this->dbcon->select('school_setting','*');
		$details = $this->dbcon->select('daycoll','*',"RECT_NO='$rect_no'");
		$adm_no = $details[0]->ADM_NO;
		//$period = substr($details[0]->PERIOD,0,8);
		$len=strlen($details[0]->PERIOD);
		if($len==3)
		{
		$period=substr($details[0]->PERIOD,0,8);
		}
		else
		{
		$first=substr($details[0]->PERIOD,0,3);
		$last=substr($details[0]->PERIOD,-3);
		$period=$first . '-' . $last;
		}
		
		//$period=substr($details[0]->PERIOD,0,8);
		$tableName = 'daycoll';
		if($period == "PRE.DUES"){
			$tableName = 'previous_year_collection';
		}
		$student_details = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
		$receipt_details = $this->dbcon->select($tableName,'*',"RECT_NO='$rect_no'");
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
		@$bus_code = $student_details[0]->STOPNO;
		if($bus_code != null){
			$bus_name = $this->dbcon->select('stoppage','STOPPAGE',"STOPNO='$bus_code'");
			$bsn = $bus_name[0]->STOPPAGE;
		}
		else{
			$bsn = "N/A";
		}
		
		$report_data = array(
			'school_setting' => $school_setting,
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
		$TAmt = $receipt_details[0]->TAmt;
		$dp_cp = array('TAmt' => $TAmt+1);
		$period = $receipt_details[0]->PERIOD;
		$period_day = substr($period,0,4);
		if($period_day=="MISL")
		{ // MISC COLLECTION REPORT
			
			$this->dbcon->update($tableName,$dp_cp,"RECT_NO='$rect_no'");
			$this->load->view('cancelreprint/misc_collection_online_report',$report_data);
			
		}else if($period_day == "APR-"|| $period_day == "APR," || $period_day == "APR" || $period_day == "MAY-" || $period_day == "MAY," || $period_day == "MAY" || $period_day=="JUN-" || $period_day=="JUN," || $period_day=="JUN" || $period_day == "JUL-" || $period_day == "JUL," || $period_day == "JUL" || $period_day == "AUG-" || $period_day == "AUG,"|| $period_day == "AUG" || $period_day == "SEP-" || $period_day == "SEP," ||$period_day == "SEP" || $period_day == "OCT-" || $period_day == "OCT," || $period_day == "OCT" || $period_day == "NOV-" || $period_day == "NOV," || $period_day == "NOV" || $period_day == "DEC-" || $period_day == "DEC," || $period_day == "DEC" || $period_day == "JAN-" || $period_day == "JAN," || $period_day == "JAN" || $period_day == "FEB-" || $period_day == "FEB," || $period_day == "FEB" || $period_day == "MAR-" || $period_day == "MAR,"|| $period_day == "MAR-" || $period_day == "PRE."){
			// MONTHLY COLLECTION REPORT
			
			$this->dbcon->update($tableName,$dp_cp,"RECT_NO='$rect_no'");
			$this->load->view('cancelreprint/monthly_collection_online_report',$report_data);
		}
		ELSE{ // RECEIPT GENERATION OF THE COLLECTION WITHOUT ADMISSION
			
			$this->dbcon->update($tableName,$dp_cp,"RECT_NO='$rect_no'");
			$this->load->view('cancelreprint/feecollection_withoutadm_onlinereport',$report_data);
		}
	}
	public function canelled(){
		$rect_no = $this->input->post("rect_no");
		$t1_data = $this->dbcon->select('daycoll','*',"RECT_NO='$rect_no'");
		$adm_no = $t1_data[0]->ADM_NO;
		$period = substr($t1_data[0]->PERIOD,0,8);
		$tableName = 'daycoll';
		if($period == "PRE.DUES"){
			$tableName = 'previous_year_collection';
			$t1_data = $this->dbcon->select('previous_year_collection','*',"RECT_NO='$rect_no'");
		}
		$student = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
		$mon[0] = $student[0]->APR_FEE;
		$mon[1] = $student[0]->MAY_FEE;
		$mon[2] = $student[0]->JUNE_FEE;
		$mon[3] = $student[0]->JULY_FEE;
		$mon[4] = $student[0]->AUG_FEE;
		$mon[5] = $student[0]->SEP_FEE;
		$mon[6] = $student[0]->OCT_FEE;
		$mon[7] = $student[0]->NOV_FEE;
		$mon[8] = $student[0]->DEC_FEE;
		$mon[9] = $student[0]->JAN_FEE;
		$mon[10] = $student[0]->JAN_FEE;
		$mon[11] = $student[0]->FEB_FEE;
		$mon[12] = $student[0]->MAR_FEE;
		$month = array();
		
		for($i=0;$i<12;$i++){
			if($mon[$i] == $rect_no){
				$month[$i] = "N/A";
			}
			else{
				$month[$i] = $mon[$i];
			}
		}
		$month_update = array(
			'APR_FEE' => $month[0],
			'MAY_FEE' => $month[1],
			'JUNE_FEE'=> $month[2],
			'JULY_FEE'=> $month[3],
			'AUG_FEE' => $month[4],
			'SEP_FEE' => $month[5],
			'OCT_FEE' => $month[6],
			'NOV_FEE' => $month[7],
			'DEC_FEE' => $month[8],
			'JAN_FEE' => $month[9],
			'FEB_FEE' => $month[10],
			'MAR_FEE' => $month[11],
		);
		
		$array = array(
			'RECT_NO' => $t1_data[0]->RECT_NO,
			'RECT_DATE' => $t1_data[0]->RECT_DATE,
			'STU_NAME' => $t1_data[0]->STU_NAME,
			'STUDENTID' => $t1_data[0]->STUDENTID,
			'ADM_NO' => $t1_data[0]->ADM_NO,
			'CLASS' => $t1_data[0]->CLASS,
			'SEC' => $t1_data[0]->SEC,
			'ROLL_NO' => $t1_data[0]->ROLL_NO,
			'PERIOD' => $t1_data[0]->PERIOD,
			'TOTAL' => $t1_data[0]->TOTAL,
			'Fee1' => $t1_data[0]->Fee1,
			'Fee2' => $t1_data[0]->Fee2,
			'Fee3' => $t1_data[0]->Fee3,
			'Fee4' => $t1_data[0]->Fee4,
			'Fee5' => $t1_data[0]->Fee5,
			'Fee6' => $t1_data[0]->Fee6,
			'Fee7' => $t1_data[0]->Fee7,
			'Fee8' => $t1_data[0]->Fee8,
			'Fee9' => $t1_data[0]->Fee9,
			'Fee10' => $t1_data[0]->Fee10,
			'Fee11' => $t1_data[0]->Fee11,
			'Fee12' => $t1_data[0]->Fee12,
			'Fee13' => $t1_data[0]->Fee13,
			'Fee14' => $t1_data[0]->Fee14,
			'Fee15' => $t1_data[0]->Fee15,
			'Fee16' => $t1_data[0]->Fee16,
			'Fee17' => $t1_data[0]->Fee17,
			'Fee18' => $t1_data[0]->Fee18,
			'Fee19' => $t1_data[0]->Fee19,
			'Fee20' => $t1_data[0]->Fee20,
			'Fee21' => $t1_data[0]->Fee21,
			'Fee22' => $t1_data[0]->Fee22,
			'Fee23' => $t1_data[0]->Fee23,
			'Fee24' => $t1_data[0]->Fee24,
			'Fee25' => $t1_data[0]->Fee25,
			'APR_FEE' => $t1_data[0]->APR_FEE,
			'MAY_FEE' => $t1_data[0]->MAY_FEE,
			'JUNE_FEE' => $t1_data[0]->JUNE_FEE,
			'JULY_FEE' => $t1_data[0]->JULY_FEE,
			'AUG_FEE' => $t1_data[0]->AUG_FEE,
			'SEP_FEE' => $t1_data[0]->SEP_FEE,
			'OCT_FEE' => $t1_data[0]->OCT_FEE,
			'NOV_FEE' => $t1_data[0]->NOV_FEE,
			'DEC_FEE' => $t1_data[0]->DEC_FEE,
			'JAN_FEE' => $t1_data[0]->JAN_FEE,
			'FEB_FEE' => $t1_data[0]->FEB_FEE,
			'MAR_FEE' => $t1_data[0]->MAR_FEE,
			'CHQ_NO' => $t1_data[0]->CHQ_NO,
			'Narr' => $t1_data[0]->Narr,
			'TAmt' => $t1_data[0]->TAmt,
			'Fee_Book_No' => $t1_data[0]->Fee_Book_No,
			'Collection_Mode' => $t1_data[0]->Collection_Mode,
			'User_Id' => $t1_data[0]->User_Id,
			'Payment_Mode' => $t1_data[0]->Payment_Mode,
			'Bank_Name' => $t1_data[0]->Bank_Name,
			'Pay_Date' => $t1_data[0]->Pay_Date,
			'Session_Year' => $t1_data[0]->Session_Year,
		);
		$update_array = array(
			'STU_NAME' => "CANCELLED",
			'STUDENTID' => "CANCELLED",
			'PERIOD' => "CANCELLED",
			'TOTAL' => 0,
			'Fee1' => 0,
			'Fee2' => 0,
			'Fee3' => 0,
			'Fee4' => 0,
			'Fee5' => 0,
			'Fee6' => 0,
			'Fee7' => 0,
			'Fee8' => 0,
			'Fee9' => 0,
			'Fee10' => 0,
			'Fee11' => 0,
			'Fee12' => 0,
			'Fee13' => 0,
			'Fee14' => 0,
			'Fee15' => 0,
			'Fee16' => 0,
			'Fee17' => 0,
			'Fee18' => 0,
			'Fee19' => 0,
			'Fee20' => 0,
			'Fee21' => 0,
			'Fee22' => 0,
			'Fee23' => 0,
			'Fee24' => 0,
			'Fee25' => 0,
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
			'Narr' => $t1_data[0]->User_Id." ON-".date('y-m-d'),
			'GROSS_AMOUNT' => 0,
			'PAID_AMOUNT' => 0,
			
		);
		if($this->dbcon->insert('t1',$array) AND $this->dbcon->update($tableName,$update_array,"RECT_NO='$rect_no'") AND $this->dbcon->update('student',$month_update,"ADM_NO='$adm_no'")){
			echo 1;
		}
		else{
			echo 2;
		}
		/* $this->dbcon->insert('t',$t1_data); */
	}
}
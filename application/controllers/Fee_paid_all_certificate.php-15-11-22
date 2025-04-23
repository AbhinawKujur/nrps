<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Fee_paid_all_certificate extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function show_tution(){
		$this->fee_template('certificate/tution_all_status');
	}
	public function birth_fetch_details(){
		$adm_no = $this->input->post('adm_no');
		
		$stu_details = $this->dbcon->select('daycoll','count(*)cnt',"ADM_NO='$adm_no'");
		$cnt = $stu_details[0]->cnt;
		$array = array("$cnt");
		echo json_encode($array);
	}
	public function re_dob_data(){
		$adm_no = $this->input->post('adm_no');
		//====================================//
		$student = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
		$ward_type = $student[0]->EMP_WARD;
		$science	  = $student[0]->BUS_NO;
		$stop_amt_code= $student[0]->STOPNO;
		$hostel       = $student[0]->HOSTEL;
		$COMPUTER     = $student[0]->COMPUTER;
		$class = $student[0]->CLASS;
		$MON[0] = $student[0]->APR_FEE;
		$MON[1] = $student[0]->MAY_FEE;
		$MON[2] = $student[0]->JUNE_FEE;
		$MON[3] = $student[0]->JULY_FEE;
		$MON[4] = $student[0]->AUG_FEE;
		$MON[5] = $student[0]->SEP_FEE;
		$MON[6] = $student[0]->OCT_FEE;
		$MON[7] = $student[0]->NOV_FEE;
		$MON[8] = $student[0]->DEC_FEE;
		$MON[9] = $student[0]->JAN_FEE;
		$MON[10] = $student[0]->FEB_FEE;
		$MON[11] = $student[0]->MAR_FEE;
		$cnt_month = count($MON);
		$j = 0;
		IF(isset($stop_amt_code))
		{
			$stop_amt = $this->dbcon->select('stop_amt','*',"STOP_NO='$stop_amt_code'");
			$stoppage_amounts = $stop_amt[0]->AMT;
		}
		//=============================//
		for($i=0;$i<$cnt_month;$i++){
			if($MON[$i] == "FREESHIP" || $MON[$i]== "TC_ISSUE" || $MON[$i] == "FEE_PAID" || $MON[$i] == "N/A" || $MON[$i] == null){
			}
			else{
				$j += 1;
			}
		}
		//-------------------------------//
		$month = array("APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC","JAN","FEB","MAR");
		$final_month = $month[$j-1];
		//-------------------------------//
		$session = $this->dbcon->select('session_master','*',"Active_Status=1");
		$year = $session[0]->Session_Year;
		//===============================//
		//-------------------------------//
		$daycoll = $this->dbcon->select('daycoll','sum(Fee1)Fee0,sum(Fee2)Fee1,sum(Fee3)Fee2,sum(Fee4)Fee3,sum(Fee5)Fee4,sum(Fee6)Fee5,sum(Fee7)Fee6,sum(Fee8)Fee7,sum(Fee9)Fee8,sum(Fee10)Fee9,sum(Fee11)Fee10,sum(Fee12)Fee11,sum(Fee13)Fee12,sum(Fee14)Fee13,sum(Fee15)Fee14,sum(Fee16)Fee15,sum(Fee17)Fee16,sum(Fee18)Fee17,sum(Fee19)Fee18,sum(Fee20)Fee19,sum(Fee21)Fee20,sum(Fee22)Fee21,sum(Fee23)Fee22,sum(Fee24)Fee23,sum(Fee25)Fee24,sum(TOTAL)TOTAL',"ADM_NO='$adm_no'");
		//===============================//
		//-------------------------------//
		$feehead = $this->dbcon->select('feehead','*');
		$fee_details = array();
		//===============================//
			foreach($feehead as $key => $value){
				$i = $key+1;
				if($value->CL_BASED==1){
					$fee_clw = $this->dbcon->select('fee_clw','*',"FH='$i' AND CL='$class'");
					if($ward_type == 1){
						$fee_detai = $fee_clw[0]->AMOUNT;
					}
					elseif($ward_type == 2){
						$fee_detai = $fee_clw[0]->EMP;
					}
					elseif($ward_type == 3){
						$fee_detai = $fee_clw[0]->CCL;
					}
					elseif($ward_type == 4){
						$fee_detai = $fee_clw[0]->SPL;
					}
					elseif($ward_type == 5){
						$fee_detai = $fee_clw[0]->EXT;
					}
					elseif($ward_type == 6){
						$fee_detai  = $fee_clw[0]->INTERNAL;
					}
					
					if($value->HType=='No')
					{
						$fee_details[] = $fee_detai;
					}
					elseif($value->HType=='COMPUTER')
					{
						if($COMPUTER==1)
						{
							$fee_details[] = $fee_detai;
						}
						else
						{
							$fee_details[] = 0;
						}
					}
					elseif($value->HType=='SCIENCE')
					{
						$fee_details[] = $fee_detai*$science;
					}
					elseif($value->HType=='BUS')
					{
						$fee_details[] = $stoppage_amounts;
					}
					ELSEIF($value->HType=='HOSTEL')
					{
						IF($hostel==1)
						{
							$fee_details[] = $fee_detai;
						}
						ELSE
						{
							$fee_details[] = 0;
						}
					}
					ELSEIF($value->HType=='BOOK')
					{
						$fee_details[] = $fee_detai;
					}
					ELSE
					{
						$fee_details[] = 0;
					}
				}
				else{
					if($ward_type == 1){
						$fee_detai = $value->AMOUNT;
					}
					elseif($ward_type == 2){
						$fee_detai = $value->EMP;
					}
					elseif($ward_type == 3){
						$fee_detai = $value->CCL;
					}
					elseif($ward_type == 4){
						$fee_detai = $value->SPL;
					}
					elseif($ward_type == 5){
						$fee_detai = $value->EXT;
					}
					elseif($ward_type == 6){
						$fee_detai  = $value->INTERNAL;
					}
					
					if($value->HType=='No')
					{
						$fee_details[] = $fee_detai;
					}
					elseif($value->HType=='COMPUTER')
					{
						if($COMPUTER==1)
						{
							$fee_details[] = $fee_detai;
						}
						else
						{
							$fee_details[] = 0;
						}
					}
					elseif($value->HType=='SCIENCE')
					{
						$fee_details[] = $fee_detai*$science;
					}
					elseif($value->HType=='BUS')
					{
						$fee_details[] = $stoppage_amounts;
					}
					ELSEIF($value->HType=='HOSTEL')
					{
						IF($hostel==1)
						{
							$fee_details[] = $fee_detai;
						}
						ELSE
						{
							$fee_details[] = 0;
						}
					}
					ELSEIF($value->HType=='BOOK')
					{
						$fee_details[] = $fee_detai;
					}
					ELSE
					{
						$fee_details[] = 0;
					}
				}
			}
		//===============================//
		$array = array(
			'student' => $student,
			'year' => $year,
			'final_month' => $final_month,
			'daycoll' => $daycoll,
			'feehead' => $feehead,
			'fee_details' => $fee_details
		);
		//==============================//
		$this->load->view('certificate/feeall_stu_data',$array);
		//==============================//
	}
	public function save_fee_details(){
		$adm_no  = $this->input->post('adm_no');
		if(isset($adm_no))
		{
			
		}
		else{
			redirect('Fee_paid_all_certificate/show_tution');
		}
		$school_setting = $this->dbcon->select('school_setting','*');
		$session_master = $this->dbcon->select('session_master','*',"Active_Status=1");
		$session_year = $session_master[0]->Session_Nm;
		//==========================================//
		$student = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
		$ward_type = $student[0]->EMP_WARD;
		$science	  = $student[0]->BUS_NO;
		$stop_amt_code= $student[0]->STOPNO;
		$hostel       = $student[0]->HOSTEL;
		$COMPUTER     = $student[0]->COMPUTER;
		$class = $student[0]->CLASS;
		//==========================================//
		IF(isset($stop_amt_code))
		{
			$stop_amt = $this->dbcon->select('stop_amt','*',"STOP_NO='$stop_amt_code'");
			$stoppage_amounts = $stop_amt[0]->AMT;
		}
		//==========================================//
		$daycoll = $this->dbcon->select('daycoll','sum(Fee1)Fee0,sum(Fee2)Fee1,sum(Fee3)Fee2,sum(Fee4)Fee3,sum(Fee5)Fee4,sum(Fee6)Fee5,sum(Fee7)Fee6,sum(Fee8)Fee7,sum(Fee9)Fee8,sum(Fee10)Fee9,sum(Fee11)Fee10,sum(Fee12)Fee11,sum(Fee13)Fee12,sum(Fee14)Fee13,sum(Fee15)Fee14,sum(Fee16)Fee15,sum(Fee17)Fee16,sum(Fee18)Fee17,sum(Fee19)Fee18,sum(Fee20)Fee19,sum(Fee21)Fee20,sum(Fee22)Fee21,sum(Fee23)Fee22,sum(Fee24)Fee23,sum(Fee25)Fee24,sum(TOTAL)TOTAL',"ADM_NO='$adm_no'");
		//=========================================//
		//----------------------------------------//
		$feehead = $this->dbcon->select('feehead','*');
		$fee_details = array();
		//========================================//
			foreach($feehead as $key => $value){
				$i = $key+1;
				if($value->CL_BASED==1){
					$fee_clw = $this->dbcon->select('fee_clw','*',"FH='$i' AND CL='$class'");
					if($ward_type == 1){
						$fee_detai = $fee_clw[0]->AMOUNT;
					}
					elseif($ward_type == 2){
						$fee_detai = $fee_clw[0]->EMP;
					}
					elseif($ward_type == 3){
						$fee_detai = $fee_clw[0]->CCL;
					}
					elseif($ward_type == 4){
						$fee_detai = $fee_clw[0]->SPL;
					}
					elseif($ward_type == 5){
						$fee_detai = $fee_clw[0]->EXT;
					}
					elseif($ward_type == 6){
						$fee_detai  = $fee_clw[0]->INTERNAL;
					}
					
					if($value->HType=='No')
					{
						$fee_details[] = $fee_detai;
					}
					elseif($value->HType=='COMPUTER')
					{
						if($COMPUTER==1)
						{
							$fee_details[] = $fee_detai;
						}
						else
						{
							$fee_details[] = 0;
						}
					}
					elseif($value->HType=='SCIENCE')
					{
						$fee_details[] = $fee_detai*$science;
					}
					elseif($value->HType=='BUS')
					{
						$fee_details[] = $stoppage_amounts;
					}
					ELSEIF($value->HType=='HOSTEL')
					{
						IF($hostel==1)
						{
							$fee_details[] = $fee_detai;
						}
						ELSE
						{
							$fee_details[] = 0;
						}
					}
					ELSEIF($value->HType=='BOOK')
					{
						$fee_details[] = $fee_detai;
					}
					ELSE
					{
						$fee_details[] = 0;
					}
				}
				else{
					if($ward_type == 1){
						$fee_detai = $value->AMOUNT;
					}
					elseif($ward_type == 2){
						$fee_detai = $value->EMP;
					}
					elseif($ward_type == 3){
						$fee_detai = $value->CCL;
					}
					elseif($ward_type == 4){
						$fee_detai = $value->SPL;
					}
					elseif($ward_type == 5){
						$fee_detai = $value->EXT;
					}
					elseif($ward_type == 6){
						$fee_detai  = $value->INTERNAL;
					}
					
					if($value->HType=='No')
					{
						$fee_details[] = $fee_detai;
					}
					elseif($value->HType=='COMPUTER')
					{
						if($COMPUTER==1)
						{
							$fee_details[] = $fee_detai;
						}
						else
						{
							$fee_details[] = 0;
						}
					}
					elseif($value->HType=='SCIENCE')
					{
						$fee_details[] = $fee_detai*$science;
					}
					elseif($value->HType=='BUS')
					{
						$fee_details[] = $stoppage_amounts;
					}
					ELSEIF($value->HType=='HOSTEL')
					{
						IF($hostel==1)
						{
							$fee_details[] = $fee_detai;
						}
						ELSE
						{
							$fee_details[] = 0;
						}
					}
					ELSEIF($value->HType=='BOOK')
					{
						$fee_details[] = $fee_detai;
					}
					ELSE
					{
						$fee_details[] = 0;
					}
				}
			}
		//----------------------------------------//
		$details_array = array(
			'ADM_NO'		 => $adm_no,
			'S_NAME'		 => $this->input->post('stu_name'),
			'F_NAME'		 => $this->input->post('f_name'),
			'M_Name' 		 => $this->input->post('m_name'),
			'Birth_Date' 	 => $this->input->post('date'),
			'class_name' 	 => $this->input->post('classes'),
			'sec' 	 		 => $this->input->post('sec'),
			'fee_paid_from'  => $this->input->post('fpf'),
			'session_year'  => $session_year,
			'upto'           => $this->input->post('paid_upto'),
			'total_paid' 	 => $this->input->post('total_paid'),
			'school_setting' => $school_setting,
			'daycoll' => $daycoll,
			'feehead' => $feehead,
			'fee_details' => $fee_details
		);
		
		$this->load->view('certificate/all_fee_report',$details_array);
	}
	
	
}
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Tution_fee_certificate extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function show_tution(){
		$this->fee_template('certificate/tution_status');
	}
	public function birth_fetch_details(){
		$adm_no = $this->input->post('adm_no');
		
		$stu_details = $this->dbcon->select('student','count(*)cnt',"ADM_NO='$adm_no'");
		$cnt = $stu_details[0]->cnt;
		$array = array("$cnt");
		echo json_encode($array);
	}
	public function re_dob_data(){
		$adm_no = $this->input->post('adm_no');
		$student = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
		$ward_type = $student[0]->EMP_WARD;
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
		for($i=0;$i<$cnt_month;$i++){
			if($MON[$i] == "FREESHIP" || $MON[$i]== "TC_ISSUE" || $MON[$i] == "FEE_PAID" || $MON[$i] == "N/A" || $MON[$i] == null){
			}
			else{
				$j += 1;
			}
		}
		$month = array("APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC","JAN","FEB","MAR");
		$final_month = $month[$j-1];
		//-------------------------------//
		$fee_type = $this->dbcon->select('adm_no','*');
		$fee_head = $fee_type[0]->Tution_fee_Head;
		$feess = "fee".$fee_head;
		//===============================//
		$daycoll = $this->dbcon->select('daycoll','sum('.$feess.')total',"ADM_NO='$adm_no'");
		$total_fee = $daycoll[0]->total;
		if($total_fee == null)
		{
			$t_f = 0;
		}
		else{
			$t_f = $total_fee;
		}
		//-------------------------------//
		$session = $this->dbcon->select('session_master','*',"Active_Status=1");
		$year = $session[0]->Session_Year;
		//===============================//
		$fee_tution = $this->dbcon->select('fee_clw','*',"CL='$class' AND FH='$fee_head'");
		if($ward_type == 1){
			$tution_fee = $fee_tution[0]->AMOUNT;
		}
		elseif($ward_type == 2){
			$tution_fee = $fee_tution[0]->EMP;
		}
		elseif($ward_type == 3){
			$tution_fee = $fee_tution[0]->CCL;
		}
		elseif($ward_type == 4){
			$tution_fee = $fee_tution[0]->SPL;
		}
		elseif($ward_type == 5){
			$tution_fee = $fee_tution[0]->EXT;
		}
		elseif($ward_type == 6){
			$tution_fee  = $fee_tution[0]->INTERNAL;
		}
		else{
			$tution_fee = 0;
		}
		$array = array(
			'student' => $student,
			'year' => $year,
			'tution_fee' => $tution_fee,
			'final_month' => $final_month,
			't_f' => $t_f
		);
		$this->load->view('certificate/fee_stu_data',$array);
	}
	public function save_fee_details(){
		$adm_no  = $this->input->post('adm_no');
		if(isset($adm_no))
		{
			
		}
		else{
			redirect('Tution_fee_certificate/show_tution');
		}
		$school_setting = $this->dbcon->select('school_setting','*');
		$session_master = $this->dbcon->select('session_master','*',"Active_Status=1");
		$session_year = $session_master[0]->Session_Nm;
		$session_year1 = $session_master[0]->Session_Year;
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
			'session_year1'  => $session_year1+1,
			'upto'           => $this->input->post('paid_upto'),
			'rate_of_tution' => $this->input->post('rtf'),
			'total_paid' 	 => $this->input->post('total_paid'),
			'school_setting' => $school_setting
		);
		$this->load->view('certificate/tution_fee_report',$details_array);
	}
	
	
}
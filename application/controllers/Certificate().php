<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Certificate extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function tc(){
		$this->fee_template('certificate/tc_view');
	}
	public function transfer_certificate(){
		$session_data = $this->dbcon->select('session_master','*');
		$array = array(
			'session_data' => $session_data
			);
		$this->fee_template('certificate/transfer_certificate',$array);
		
	}
	public function tc_details(){
		$session_year = $this->input->post('session_year');
		$this->session->set_userdata('session_year',$session_year);
		$tc_generation = $this->dbcon->select('adm_no','*');
		$tc_head = $tc_generation[0]->tchead;
		$tc_no = $tc_generation[0]->tcno;
		$tc_no_generation = $tc_head."/".$tc_no;
		$array = array(
			'tc_number' => $tc_no_generation
			);
			$this->session->set_userdata('tc_number',$tc_no_generation);
		$this->fee_template('certificate/tc_student_panel',$array);
	}
	public function details_show(){
		$adm_no = $this->input->post('adm_no');
		$year = $this->session->userdata('session_year');
		$ses_year = $this->dbcon->select('session_master','*',"Active_Status=1");
		$session_year1 = $ses_year[0]->Session_Nm;
		if($year == $session_year1){
			$previous_year_feegeneration = $this->dbcon->select('previous_year_feegeneration','sum(TOTAL)TOTAL',"ADM_NO='$adm_no'");
			$student_details = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
			$tc_isu = $student_details[0]->TC_ISSUED;
			if($tc_isu == null || $tc_isu == "N/A" || $tc_isu == "n/a")
			{
				$tc_isu = 0;
			}
			$cnt = count($student_details);
		}else{
			$back_data = $this->dbcon->select('session_master','*',"Session_Nm='$year'");
			$data_baseName = $back_data[0]->database_name;
			$previous_year_feegeneration = $this->dbcon->select($data_baseName.'.previous_year_feegeneration','sum(TOTAL)TOTAL',"ADM_NO='$adm_no'");
			$student_details = $this->dbcon->select($data_baseName.'.student','*',"ADM_NO='$adm_no'");
			$tc_isu = $student_details[0]->TC_ISSUED;
			
			if($tc_isu == null || $tc_isu == "N/A" || $tc_isu == "n/a")
			{
				$tc_isu = 0;
			}
			$cnt = count($student_details);
		}
		IF(!empty($previous_year_feegeneration))
		{
			$defatulter = $previous_year_feegeneration[0]->TOTAL;
		}
		ELSE{
			$defatulter = 0;
		}
		$array_data = array("$cnt","$defatulter","$tc_isu");
		echo json_encode($array_data);
	}
	public function student_details(){
		$adm_no = $this->input->post('adm_no');
		
		$year = $this->session->userdata('session_year');
		$ses_year = $this->dbcon->select('session_master','*',"Active_Status='1'");
		$session_year1 = $ses_year[0]->Session_Nm;
		
		$class = $this->dbcon->select('classes','*');
		$category = $this->dbcon->select('category','*');
		$subjects = $this->dbcon->select('subjects','*');
		$TC_REMARKS = $this->dbcon->select('TC_REMARKS','*');
		$school_setting = $this->dbcon->select('school_setting','*');
		
		if($year == $session_year1){
			$student = $this->dbcon->tc_issue($adm_no);
		}else{
			$back_data = $this->dbcon->select('session_master','*',"Session_Nm='$year'");
			$data_baseName = $back_data[0]->database_name;
			$student = $this->dbcon->tc_issue_back($adm_no,$data_baseName);
		} 
		
		$array = array(
			'class' => $class,
			'category' => $category,
			'subjects' => $subjects,
			'student' => $student,
			'school_setting' => $school_setting,
			'TC_REMARKS' => $TC_REMARKS,
			);
		$this->load->view('certificate/tc_stu_details',$array);
		
	}
	public function tc_datafetch(){
		$adm_no = $this->input->post('adm_no');
		if(isset($adm_no)){
			
		}else{
			redirect('Certificate/transfer_certificate');
		}
		$array = array(
			'TCNO' => $this->session->userdata('tc_number'),
			'adm_no' => $adm_no,
			'RegistrationNo' => $this->input->post('reg_no'),
			'BoardRollNo' => $this->input->post('cbse_roll'),
			'Name' => $this->input->post('nop'),
			'Mother_NM' => $this->input->post('m_name'),
			'Father_NM' => $this->input->post('f_name'),
			'Nation' => $this->input->post('nation'),
			'Category' => $this->input->post('wscst'),
			'ADM_DATE' => $this->input->post('adm_date'),
			'ADM_CLASS' => $this->input->post('aic'),
			'BIRTH_DT' => $this->input->post('BIRTH_DT'),
			'current_Class' => $this->input->post('cps'),
			'TEXT08a' => strtoupper($this->input->post('st1')),
			'text08b' => strtoupper($this->input->post('school_name')),
			'combo09' => $this->input->post('same_class_status'),
			'textsub1' => $this->input->post('sb1'),
			'textsub2' => $this->input->post('sb2'),
			'textsub3' => $this->input->post('sb3'),
			'textsub4' => $this->input->post('sb4'),
			'textsub5' => $this->input->post('sb5'),
			'textsub6' => $this->input->post('sb6'),
			'textsub7' => $this->input->post('opsub'),
			'combo011' => $this->input->post('wqfhc'),
			'datacombo011' => $this->input->post('iswc'),
			'txtClsW' => strtoupper($this->input->post('inword')),
			'combo12a' => strtoupper($this->input->post('muwtphpsf')),
			'combo012b' => strtoupper($this->input->post('extcur')),
			'combo013' => strtoupper($this->input->post('wncc')),
			'text014' => $this->input->post('total_day'),
			'text015' => $this->input->post('total_p_day'),
			'combo016' => $this->input->post('afcon'),
			'text017' => $this->input->post('usual_type'),
			'combo018' => $this->input->post('general_conduct'),
			'text019' => $this->input->post('applied_date'),
			'text020' => $this->input->post('issue_date'),
			'text021' => $this->input->post('rfl'),
			'text022' => "ACTIVE",
			'dob_inwords' => $this->input->post('month_alpha_cnt'),
			'Tc_Status' => "TC_ISSUE",
			'duplicate_issue' => 0,
			'session_year' => $this->session->userdata('session_year')
		);
		
		$year = $this->session->userdata('session_year');
		$ses_year = $this->dbcon->select('session_master','*',"Active_Status=1");
		$session_year1 = $ses_year[0]->Session_Nm;
		
		if($year == $session_year1){
			$student_details = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
			$mon[0] = $student_details[0]->APR_FEE;
			$mon[1] = $student_details[0]->MAY_FEE;
			$mon[2] = $student_details[0]->JUNE_FEE;
			$mon[3] = $student_details[0]->JULY_FEE;
			$mon[4] = $student_details[0]->AUG_FEE;
			$mon[5] = $student_details[0]->SEP_FEE;
			$mon[6] = $student_details[0]->OCT_FEE;
			$mon[7] = $student_details[0]->NOV_FEE;
			$mon[8] = $student_details[0]->DEC_FEE;
			$mon[9] = $student_details[0]->JAN_FEE;
			$mon[10] = $student_details[0]->FEB_FEE;
			$mon[11] = $student_details[0]->MAR_FEE;
			$month = array();
			$cnt = count($mon);
			for($i=0; $i<$cnt;$i++){
				if($mon[$i] == null || $mon[$i]=="N/A" || $mon[$i]== "n/a"){
					$month[$i] = "TC_ISSUE";
				}
				else{
					$month[$i] = $mon[$i];
				}
			}
			$mont_update = array(
				'APR_FEE' => $month[0],
				'MAY_FEE' => $month[1],
				'JUNE_FEE' => $month[2],
				'JULY_FEE' => $month[3],
				'AUG_FEE' => $month[4],
				'SEP_FEE' => $month[5],
				'OCT_FEE' => $month[6],
				'NOV_FEE' => $month[7],
				'DEC_FEE' => $month[8],
				'JAN_FEE' => $month[9],
				'FEB_FEE' => $month[10],
				'MAR_FEE' => $month[11],
				'TC_ISSUED' => 1,
				'Student_Status' => "UNACTIVE"
			);
			$this->dbcon->update('student',$mont_update,"adm_no='$adm_no'");
		}else{
			$back_data = $this->dbcon->select('session_master','*',"Session_Nm='$year'");
			$data_baseName = $back_data[0]->database_name;
			
			$student_details = $this->dbcon->select($data_baseName.'.student','*',"ADM_NO='$adm_no'");
			$mon[0] = $student_details[0]->APR_FEE;
			$mon[1] = $student_details[0]->MAY_FEE;
			$mon[2] = $student_details[0]->JUNE_FEE;
			$mon[3] = $student_details[0]->JULY_FEE;
			$mon[4] = $student_details[0]->AUG_FEE;
			$mon[5] = $student_details[0]->SEP_FEE;
			$mon[6] = $student_details[0]->OCT_FEE;
			$mon[7] = $student_details[0]->NOV_FEE;
			$mon[8] = $student_details[0]->DEC_FEE;
			$mon[9] = $student_details[0]->JAN_FEE;
			$mon[10] = $student_details[0]->FEB_FEE;
			$mon[11] = $student_details[0]->MAR_FEE;
			$month = array();
			$cnt = count($mon);
			for($i=0; $i<$cnt;$i++){
				if($mon[$i] == null || $mon[$i]=="N/A" || $mon[$i]== "n/a"){
					$month[$i] = "TC_ISSUE";
				}
				else{
					$month[$i] = $mon[$i];
				}
			}
			$mont_update = array(
				'APR_FEE' => $month[0],
				'MAY_FEE' => $month[1],
				'JUNE_FEE' => $month[2],
				'JULY_FEE' => $month[3],
				'AUG_FEE' => $month[4],
				'SEP_FEE' => $month[5],
				'OCT_FEE' => $month[6],
				'NOV_FEE' => $month[7],
				'DEC_FEE' => $month[8],
				'JAN_FEE' => $month[9],
				'FEB_FEE' => $month[10],
				'MAR_FEE' => $month[11],
				'TC_ISSUED' => 1,
				'Student_Status' => "UNACTIVE"
			);
			$this->dbcon->update($data_baseName.'.student',$mont_update,"adm_no='$adm_no'");
			
		}
			$tc_data = $this->dbcon->select('tc','count(*)cnt',"adm_no='$adm_no'");
			$cnt = $tc_data[0]->cnt;
			if($cnt == 0)
			{
				$this->dbcon->insert('tc',$array);
				$tc_number = $this->dbcon->select('adm_no','tcno');
				$tcno = $tc_number[0]->tcno+1;
				$array_up = array('tcno' => $tcno);
				$this->dbcon->update('adm_no',$array_up,"ID='1'");
				$tc_details = $this->dbcon->select('tc','*',"adm_no='$adm_no'");
				$school_setting = $this->dbcon->select('school_setting','*');
				$details_array = array(
					'tc_details' => $tc_details,
					'school_setting' => $school_setting
				);
				$this->load->view('certificate/tc_report',$details_array);
				
			}
			else{
				$this->dbcon->update('tc',$array,"adm_no='$adm_no'");
				$up_details = $this->dbcon->select('tc','count(*)cnt',"adm_no='$adm_no' AND Tc_Status='CANCELLED'");
				$cnt = count($up_details);
				if($cnt == 1){
					$tc_number = $this->dbcon->select('adm_no','tcno');
					$tcno = $tc_number[0]->tcno+1;
					$array_up = array('tcno' => $tcno);
					$this->dbcon->update('adm_no',$array_up,"ID='1'");
				}
				$tc_details = $this->dbcon->select('tc','*',"adm_no='$adm_no'");
				$school_setting = $this->dbcon->select('school_setting','*');
				$details_array = array(
					'tc_details' => $tc_details,
					'school_setting' => $school_setting
				);
				$this->load->view('certificate/tc_report',$details_array);
			}
	}
	public function pdf_creation($id){
		$tc_details = $this->dbcon->select('tc','*',"adm_no='$id'");
		$school_setting = $this->dbcon->select('school_setting','*');
		$details_array = array(
			'tc_details' => $tc_details,
			'school_setting' => $school_setting
		);
		$this->load->view('certificate/tc_report_pdf',$details_array);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream($id."-TC.pdf", array("Attachment"=>1));
	}
	public function cancel_reprint_tc(){
		$data = $this->dbcon->select('tc','*');
		$array =array(
			'data' => $data
		);
		$this->fee_template('certificate/show_tcissue',$array);
	}
	public function show_cancel_reprint_tc($adm){
		$tc_details = $this->dbcon->select('tc','*',"adm_no='$adm'");
		$school_setting = $this->dbcon->select('school_setting','*');
		$session_data = $this->dbcon->select('session_master','*');
		
		$tc_issue = $tc_details[0]->Tc_Status;
		
		$details_array = array(
			'tc_details' => $tc_details,
			'school_setting' => $school_setting,
			'session_data' => $session_data
		);
		
		if($tc_issue == "CANCELLED"){
			$this->session->set_flashdata('msg',"This Tc Is Already Cancelled");
			redirect('Certificate/cancel_reprint_tc');
		}
		else{
			$this->load->view('certificate/cancel_repritnt_report',$details_array);
		}
	}
	public function printl(){
		$adm_no = $this->input->post('adm');
		
		$tc_issue = $this->dbcon->select('tc','duplicate_issue',"adm_no='$adm_no'");
		$tc_count = $tc_issue[0]->duplicate_issue+1;
		$array = array('duplicate_issue' => $tc_count);
		if($this->dbcon->update('tc',$array,"adm_no='$adm_no'")){
			echo 1;
		}
	}
	public function re_printpdf($adm_no){
		
		$tc_issue = $this->dbcon->select('tc','duplicate_issue',"adm_no='$adm_no'");
		$tc_count = $tc_issue[0]->duplicate_issue+1;
		$array = array('duplicate_issue' => $tc_count);
		if($this->dbcon->update('tc',$array,"adm_no='$adm_no'")){
			
			$tc_details = $this->dbcon->select('tc','*',"adm_no='$adm_no'");
			$school_setting = $this->dbcon->select('school_setting','*');
			$details_array = array(
				'tc_details' => $tc_details,
				'school_setting' => $school_setting
			);
			$this->load->view('certificate/cancel_reprint_tc_pdf',$details_array);
			
			$html = $this->output->get_output();
			$this->load->library('pdf');
			$this->dompdf->loadHtml($html);
			$this->dompdf->setPaper('A4', 'portrait');
			$this->dompdf->render();
			$this->dompdf->stream($adm_no."-TC-duplicate.pdf", array("Attachment"=>1));
		}
	}
	public function cancel_financial_year(){
		$adm_no  = $this->input->post('adm_no');
		$tc_fy = $this->dbcon->select('tc','session_year',"adm_no='$adm_no'");
		$session_year = $tc_fy[0]->session_year;
		
		$ses_year = $this->dbcon->select('session_master','*',"Active_Status=1");
		$session_year1 = $ses_year[0]->Session_Nm;
		
		$tc_details_update = array('Tc_Status' => "CANCELLED");
		
		if($session_year == $session_year1){
			$student_details = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
			$mon[0] = $student_details[0]->APR_FEE;
			$mon[1] = $student_details[0]->MAY_FEE;
			$mon[2] = $student_details[0]->JUNE_FEE;
			$mon[3] = $student_details[0]->JULY_FEE;
			$mon[4] = $student_details[0]->AUG_FEE;
			$mon[5] = $student_details[0]->SEP_FEE;
			$mon[6] = $student_details[0]->OCT_FEE;
			$mon[7] = $student_details[0]->NOV_FEE;
			$mon[8] = $student_details[0]->DEC_FEE;
			$mon[9] = $student_details[0]->JAN_FEE;
			$mon[10] = $student_details[0]->FEB_FEE;
			$mon[11] = $student_details[0]->MAR_FEE;
			$month = array();
			$cnt = count($mon);
			for($i=0; $i<$cnt;$i++){
				if($mon[$i] == "TC_ISSUE"){
					$month[$i] = "N/A";
				}
				else{
					$month[$i] = $mon[$i];
				}
			}
			$mont_update = array(
				'APR_FEE' => $month[0],
				'MAY_FEE' => $month[1],
				'JUNE_FEE' => $month[2],
				'JULY_FEE' => $month[3],
				'AUG_FEE' => $month[4],
				'SEP_FEE' => $month[5],
				'OCT_FEE' => $month[6],
				'NOV_FEE' => $month[7],
				'DEC_FEE' => $month[8],
				'JAN_FEE' => $month[9],
				'FEB_FEE' => $month[10],
				'MAR_FEE' => $month[11],
				'TC_ISSUED' => 0,
				'Student_Status' => "ACTIVE"
			);
			if($this->dbcon->update('student',$mont_update,"adm_no='$adm_no'") && $this->dbcon->update('tc',$tc_details_update,"adm_no='$adm_no'")){
				$this->session->set_flashdata('msg',"Successfully Tc Cancelled");
				redirect('Certificate/cancel_reprint_tc');
			}
			else{
				$this->session->set_flashdata('msg',"Failed Tc Cancelled");
				redirect('Certificate/cancel_reprint_tc');
			}
			
		}else{
			$back_data = $this->dbcon->select('session_master','*',"Session_Nm='$session_year'");
			$data_baseName = $back_data[0]->database_name;
			
			$student_details = $this->dbcon->select($data_baseName.'.student','*',"ADM_NO='$adm_no'");
			$mon[0] = $student_details[0]->APR_FEE;
			$mon[1] = $student_details[0]->MAY_FEE;
			$mon[2] = $student_details[0]->JUNE_FEE;
			$mon[3] = $student_details[0]->JULY_FEE;
			$mon[4] = $student_details[0]->AUG_FEE;
			$mon[5] = $student_details[0]->SEP_FEE;
			$mon[6] = $student_details[0]->OCT_FEE;
			$mon[7] = $student_details[0]->NOV_FEE;
			$mon[8] = $student_details[0]->DEC_FEE;
			$mon[9] = $student_details[0]->JAN_FEE;
			$mon[10] = $student_details[0]->FEB_FEE;
			$mon[11] = $student_details[0]->MAR_FEE;
			$month = array();
			$cnt = count($mon);
			for($i=0; $i<$cnt;$i++){
				if($mon[$i] == "TC_ISSUE"){
					$month[$i] = "N/A";
				}
				else{
					$month[$i] = $mon[$i];
				}
			}
			$mont_update = array(
				'APR_FEE' => $month[0],
				'MAY_FEE' => $month[1],
				'JUNE_FEE' => $month[2],
				'JULY_FEE' => $month[3],
				'AUG_FEE' => $month[4],
				'SEP_FEE' => $month[5],
				'OCT_FEE' => $month[6],
				'NOV_FEE' => $month[7],
				'DEC_FEE' => $month[8],
				'JAN_FEE' => $month[9],
				'FEB_FEE' => $month[10],
				'MAR_FEE' => $month[11],
				'TC_ISSUED' => 0,
				'Student_Status' => "ACTIVE"
			);
			if($this->dbcon->update($data_baseName.'.student',$mont_update,"adm_no='$adm_no'") && $this->dbcon->update('tc',$tc_details_update,"adm_no='$adm_no'")){
				$this->session->set_flashdata('msg',"Successfully Tc Cancelled");
				redirect('Certificate/cancel_reprint_tc');
			}
			else{
				$this->session->set_flashdata('msg',"Failed Tc Cancelled");
				redirect('Certificate/cancel_reprint_tc');
			}
			
		}
	}
	public function char_show(){
		$session_data = $this->dbcon->select('session_master','*');
		$array = array(
			'session_data' => $session_data
			);
		$this->fee_template('certificate/char_show',$array);
	}
	public function char_show_details(){
		$char_session_year = $this->input->post('session_year');
		if( isset($char_session_year)){
			
		}
		else{
			redirect("Certificate/char_show");
		}
		$this->session->set_userdata('char_session_year',$char_session_year);
		$tc_generation = $this->dbcon->select('adm_no','*');
		$tc_head = $tc_generation[0]->tchead;
		$tc_no = $tc_generation[0]->chartno;
		$tc_no_generation = $tc_head."/".$tc_no;
		$array = array(
			'tc_number' => $tc_no_generation
			);
		$this->session->set_userdata('character_no',$tc_no_generation);
		$this->fee_template('certificate/char_show_details',$array);
	}
	public function char_details_show(){
		$adm_no  = $this->input->post('adm_no');
		$char_sess_yr = $this->session->userdata('char_session_year');
		
		$ses_year = $this->dbcon->select('session_master','*',"Active_Status=1");
		$session_year1 = $ses_year[0]->Session_Nm;
		
		if($char_sess_yr == $session_year1){
			$student = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
			$cnt = count($student);
		}
		else{
			$back_data = $this->dbcon->select('session_master','*',"Session_Nm='$char_sess_yr'");
			$data_baseName = $back_data[0]->database_name;
			$student = $this->dbcon->select($data_baseName.'.student','*',"ADM_NO='$adm_no'");
			$cnt = count($student);
		}
		$charset = $this->dbcon->select('charcert','*',"ADM_NO='$adm_no'");
		$chr_cnt = count($charset);
		$array = array("$cnt","$chr_cnt","$adm_no");
		echo json_encode($array);
		
	}
	public function re_char_data(){
		$adm_no  = $this->input->post('adm_no');
		$char_sess_yr = $this->session->userdata('char_session_year');
		
		$ses_year = $this->dbcon->select('session_master','*',"Active_Status=1");
		$session_year1 = $ses_year[0]->Session_Nm;
		
		if($char_sess_yr == $session_year1){
			$student = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
		}
		else{
			$back_data = $this->dbcon->select('session_master','*',"Session_Nm='$char_sess_yr'");
			$data_baseName = $back_data[0]->database_name;
			$student = $this->dbcon->select($data_baseName.'.student','*',"ADM_NO='$adm_no'");
		}
		$array = array(
			'student' => $student
		);
		$this->load->view('certificate/char_stu_data',$array);
	}
	public function save_char_details(){
		$adm_no  = $this->input->post('adm_no');
		$array = array(
			'CERT_NO' => $this->session->userdata('character_no'),
			'ADM_NO' => $adm_no,
			'S_NAME' => $this->input->post('stu_name'),
			'F_NAME' => $this->input->post('f_name'),
			'M_Name' => $this->input->post('m_name'),
			'Adm_Date' => $this->input->post('adm_date'),
			'End_DATE' => date('Y-m-d'),
			'class_name' => $this->input->post('class'),
			'Issued_Date' => date('Y-m-d'),
			'duplcate_Issue' => 0
		);
		
		$o_details = $this->dbcon->select('adm_no','*',"ID=1");
		$chartno = $o_details[0]->chartno+1;
		$update_array = array('chartno' => $chartno);
		
		$school_setting = $this->dbcon->select('school_setting','*');
		
		$c_cnt = $this->dbcon->select('charcert','count(*)cnt',"ADM_NO='$adm_no'");
		
		$cnt_data = $c_cnt[0]->cnt;
		if($cnt_data == 1){
			$details_fetch = $this->dbcon->select('charcert','*',"ADM_NO='$adm_no'");
		}
		else{
			if($this->dbcon->insert('charcert',$array) && $this->dbcon->update('adm_no',$update_array,"ID=1")){
			$details_fetch = $this->dbcon->select('charcert','*',"ADM_NO='$adm_no'");
			
			}
		}
		$details_array = array(
				'details_fetch' => $details_fetch,
				'school_setting' => $school_setting
			);
		$this->load->view('certificate/char_report',$details_array);
	}
	public function re_print_char($adm_no){
		$details_fetch = $this->dbcon->select('charcert','*',"ADM_NO='$adm_no'");
		$school_setting = $this->dbcon->select('school_setting','*');
		$details_array = array(
			'details_fetch' => $details_fetch,
			'school_setting' => $school_setting
		);
		$this->load->view('certificate/reprint_char_report',$details_array);
	}
	public function reprint_report_status(){
		$adm = $this->input->post('adm_no');
		$details = $this->dbcon->select('charcert','*',"ADM_NO='$adm'");
		$duplcate_Issue = $details[0]->duplcate_Issue+1;
		$array = array('duplcate_Issue' => $duplcate_Issue);
		if($this->dbcon->update('charcert',$array,"ADM_NO='$adm'")){
			echo 1;
		}
		else{
			echo 0;
		}
	}
	public function show_all_char_details(){
		$char = $this->dbcon->select('charcert','*');
		$array = array('data' => $char);
		$this->load->view('certificate/show_char_data',$array);
	}
	public function issue_duplicate($adm_no){
		$details_fetch = $this->dbcon->select('charcert','*',"ADM_NO='$adm_no'");
		$school_setting = $this->dbcon->select('school_setting','*');
		$details_array = array(
			'details_fetch' => $details_fetch,
			'school_setting' => $school_setting
		);
		$this->load->view('certificate/reprint_char_report',$details_array);
	}
}
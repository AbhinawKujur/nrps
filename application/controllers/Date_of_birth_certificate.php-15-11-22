<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Date_of_birth_certificate extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function show_dob(){
		$tc_generation = $this->dbcon->select('adm_no','*');
		$tc_head = $tc_generation[0]->tchead;
		$tc_no = $tc_generation[0]->dobno;
		$dbo = $tc_head."/".$tc_no;
		$array = array(
				'dbo' => $dbo
			);
		$this->fee_template('certificate/birth_status',$array);
	}
	public function birth_fetch_details(){
		$adm_no = $this->input->post('adm_no');
		
		$stu_details = $this->dbcon->select('student','count(*)cnt',"ADM_NO='$adm_no'");
		$cnt = $stu_details[0]->cnt;
		$dob = $this->dbcon->select('dob_certificate','*',"ADM_NO='$adm_no'");
		$chr_cnt = count($dob);
		$array = array("$cnt","$chr_cnt","$adm_no");
		echo json_encode($array);
	}
	public function re_dob_data(){
		$adm_no = $this->input->post('adm_no');
		$bfno = $this->input->post('tcn');
		$student = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
		$array = array(
			'student' => $student,
			'bonafide' => $bfno
		);
		$this->load->view('certificate/dob_stu_data',$array);
	}
	public function save_bob_details(){
		$adm_no  = $this->input->post('adm_no');
		$array = array(
			'CERT_NO' => $this->input->post('bon_details'),
			'ADM_NO' => $adm_no,
			'S_NAME' => $this->input->post('stu_name'),
			'F_NAME' => $this->input->post('f_name'),
			'M_Name' => $this->input->post('m_name'),
			'Birth_Date' => $this->input->post('date'),
			'class_name' => $this->input->post('class'),
			'Issued_Date' => date('Y-m-d'),
			'duplcate_Issue' => 0
		);
		$o_details = $this->dbcon->select('adm_no','*',"ID=1");
		$dobno = $o_details[0]->dobno+1;
		$update_array = array('dobno' => $dobno);
		
		$school_setting = $this->dbcon->select('school_setting','*');
		
		$c_cnt = $this->dbcon->select('dob_certificate','count(*)cnt',"ADM_NO='$adm_no'");
		
		$cnt_data = $c_cnt[0]->cnt;
		if($cnt_data == 1){
			$details_fetch = $this->dbcon->select('dob_certificate','*',"ADM_NO='$adm_no'");
		}
		else{
			if($this->dbcon->insert('dob_certificate',$array) && $this->dbcon->update('adm_no',$update_array,"ID=1")){
				
			$details_fetch = $this->dbcon->select('dob_certificate','*',"ADM_NO='$adm_no'");
			
			}
		}
		$details_array = array(
				'details_fetch' => $details_fetch,
				'school_setting' => $school_setting
			);
		$this->load->view('certificate/dob_report',$details_array);
	}
	public function re_print_dob($adm_no){
		$details_fetch = $this->dbcon->select('dob_certificate','*',"ADM_NO='$adm_no'");
		$school_setting = $this->dbcon->select('school_setting','*');
		$details_array = array(
			'details_fetch' => $details_fetch,
			'school_setting' => $school_setting
		);
		$this->load->view('certificate/reprint_dob_report',$details_array);
	}
	public function reprint_report_status(){
		$adm = $this->input->post('adm_no');
		$details = $this->dbcon->select('dob_certificate','*',"ADM_NO='$adm'");
		$duplcate_Issue = $details[0]->duplcate_Issue+1;
		$array = array('duplcate_Issue' => $duplcate_Issue);
		if($this->dbcon->update('dob_certificate',$array,"ADM_NO='$adm'")){
			echo 1;
		}
		else{
			echo 0;
		}
	}
	public function show_all_bona_details(){
		$bona = $this->dbcon->select('dob_certificate','*');
		$array = array('data' => $bona);
		$this->load->view('certificate/show_dob_data',$array);
	}
	public function issue_duplicate($adm_no){
		$details_fetch = $this->dbcon->select('dob_certificate','*',"ADM_NO='$adm_no'");
		$school_setting = $this->dbcon->select('school_setting','*');
		$details_array = array(
			'details_fetch' => $details_fetch,
			'school_setting' => $school_setting
		);
		$this->load->view('certificate/reprint_dob_report',$details_array);
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InternalReportForCbse extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
	  $classs = $this->input->post('classs');
	  $sec    = $this->input->post('sec');
	  $data['round'] = $this->input->post('round');
	  $data['subjectData'] = $this->alam->selectA('class_section_wise_subject_allocation','subject_code,subj_nm,applicable_exam',"Class_No='".$classs."' AND section_no='".$sec."' AND applicable_exam='1'");
	  $data['stuData'] = $this->alam->selectA('student','ADM_NO,TITLE_NM,FIRST_NM,MIDDLE_NM,FATHER_NM,CLASS,SEC,ROLL_NO,Student_Status',"CLASS='$classs' AND SEC='$sec' AND Student_Status='ACTIVE' order by ROLL_NO");
	  $this->load->view('report_card/load_internal_report_cbse',$data);
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NotAttempted extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Alam','alam');
		$this->load->library('Alam_custom','alam_custom');
		$this->loggedOutNurAdmForm();
	}
	
	public function index(){
		$user_session_id = generate_session['id'];
		$val = date('Y-m-d',strtotime($this->input->post('value')));
		$data['valdate'] = date('Y-m-d',strtotime($this->input->post('value')));
		$data['notAttemptedReportData'] = $this->alam->selectA('nursery_adm_data','*',"transaction_id is null");
		$this->nurseryAdmissionAdminTemplate('adm_three/admin/notAttemptedReportData',$data);
	}
	
	public function ReportStuData(){
		$user_session_id = generate_session['id'];
		$val = date('Y-m-d',strtotime($this->input->post('value')));
		$data['valdate'] = date('Y-m-d',strtotime($this->input->post('value')));
		$data['ReportData'] = $this->alam->selectA('nursery_adm_data','*',"date(created_at)='$val' AND transaction_id is null");
		$this->load->view('adm_three/admin/notAttemptedloadstartDateReport',$data);
	}
	
	public function ReportStuDateRange(){
		$user_session_id = generate_session['id'];
		$start_date = date('Y-m-d',strtotime($this->input->post('start_date')));
		$data['start_date'] = date('Y-m-d',strtotime($this->input->post('start_date')));
		$end_date   = date('Y-m-d',strtotime($this->input->post('end_date')));
		$data['end_date']   = date('Y-m-d',strtotime($this->input->post('end_date')));
		$data['ReportData'] = $this->alam->selectA('nursery_adm_data','*',"date(created_at) BETWEEN '$start_date' AND '$end_date' AND transaction_id is null");
		$data['nur_reg_user'] = $this->alam->selectA('nur_reg_user','*',"id='$user_session_id'");
		$this->load->view('adm_three/admin/notAttemptedloadEndDateReportWithDateRange',$data);
	}
	
	public function ReportStuDateRangeStatus(){
		$user_session_id = generate_session['id'];
		$start_date      = date('Y-m-d',strtotime($this->input->post('start_date')));
		$data['start_date']      = date('Y-m-d',strtotime($this->input->post('start_date')));
		$end_date        = date('Y-m-d',strtotime($this->input->post('end_date')));
		$data['end_date']        = date('Y-m-d',strtotime($this->input->post('end_date')));
		$verified_status = $this->input->post('verified_status');
		$chkverified_status = $verified_status;
		if($chkverified_status == 0){
			$data['verify'] = 'NOT VERIFIED';
		}else{
			$data['verify'] = 'VERIFIED';
		}
		$data['ReportData'] = $this->alam->selectA('nursery_adm_data','*',"date(created_at) BETWEEN '$start_date' AND '$end_date' AND verified_status='$verified_status' AND f_code='f'");
		$data['nur_reg_user'] = $this->alam->selectA('nur_reg_user','*',"id='$user_session_id'");
		$this->load->view('adm_three/admin/loadReportWithStatus',$data);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Annual_tabulation_report_card extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
	  $data['class'] = $this->input->post('classs');	
	  $data['sec']   = $this->input->post('sec');	
	  $data['date']  = $this->input->post('date');
	  $data['round'] = $this->input->post('round');
	  
	  $classs = $this->input->post('classs');
	  $sec    = $this->input->post('sec');
	  $date   = $this->input->post('date');
	  $dt     = date('Y-m-d',strtotime($date));
	  $data['dt']    = date('Y-m-d',strtotime($date));
	  
	  $examModeData = $this->alam->selectA('classes','ExamMode',"class_No='$classs'");
	  $examMode = $examModeData[0]['ExamMode'];
	  
     //for attendance //
		$stu_att_type = $this->alam->select('student_attendance_type','*',"class_code='$classs'");
		$att_type     = $stu_att_type[0]->attendance_type;
		
		if($att_type == 1){
			$att_data = $this->alam->select('stu_attendance_entry','count(DISTINCT att_date)cnt',"class_code='$classs' AND sec_code='$sec' AND att_date <= '$dt'");
			$data['tot_working_day'] = $att_data[0]->cnt;
		}else{
			$att_data = $this->alam->select('stu_attendance_entry_periodwise','count(DISTINCT att_date)cnt',"class_code='$classs' AND sec_code='$sec' AND att_date <= '$dt'");
			$data['tot_working_day'] = $att_data[0]->cnt;
		}
	 //end attendance //
	   $countOptData = $this->alam->selectA('class_section_wise_subject_allocation','count(subject_code)cnt',"Class_No='$classs' AND opt_code in (0,2) AND section_no='$sec'");
	   $data['cnt_opt'] = $countOptData[0]['cnt'];
	  if($examMode == 1){
		$this->load->view('report_card/load_annual_tabulation_report_card',$data);
	  }else{
		$this->load->view('report_card/load_cmc_annual_tabulation_report_card',$data);  
	  }
	}
}
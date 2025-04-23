<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DailyReport extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$this->render_template('student/report/attendanceDailyReport');
	}
	
	public function dailyAttendanceReport(){
		$role_id       = login_details['ROLE_ID'];
		$user_id       = login_details['user_id'];
		$data['Cdate'] = date('Y-m-d',strtotime($this->input->post('Cdate')));
		$userData = $this->alam->selectA('employee','WING_MASTER_ID',"EMPID='$user_id'");
		$wing = $userData[0]['WING_MASTER_ID']; 
		if($role_id == 4){
			$data['classSec'] = $this->alam->selectA('student',"CLASS,SEC,DISP_CLASS,DISP_SEC","Student_Status = 'ACTIVE' GROUP BY CLASS,SEC,DISP_CLASS,DISP_SEC order by CLASS,SEC");
			
		}else{
			$data['classSec'] = $this->alam->selectA('student',"CLASS,SEC,DISP_CLASS,DISP_SEC","Student_Status = 'ACTIVE' AND (SELECT wing_id FROM classes WHERE Class_No=student.CLASS)='$wing' GROUP BY CLASS,SEC,DISP_CLASS,DISP_SEC order by CLASS,SEC");
		}
		
		$this->load->view('student/report/dailyreport',$data);
	}
}

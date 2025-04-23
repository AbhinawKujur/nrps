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
		// echo print_r($userData);
		$wing = $userData[0]['WING_MASTER_ID']; 
		if($role_id == 4){
			$data['classSec'] = $this->alam->selectA('student',"CLASS,SEC,DISP_CLASS,DISP_SEC,ROLL_NO","Student_Status = 'ACTIVE' GROUP BY CLASS,SEC,DISP_CLASS,DISP_SEC order by CLASS,SEC");
			
		}else{
			$data['classSec'] = $this->alam->selectA('student',"CLASS,SEC,DISP_CLASS,DISP_SEC,ROLL_NO","Student_Status = 'ACTIVE' AND (SELECT wing_id FROM classes WHERE Class_No=student.CLASS)='$wing' GROUP BY CLASS,SEC,DISP_CLASS,DISP_SEC order by CLASS,SEC");
		}

		echo "<pre>";
		print_r($data);die;
		
		$this->load->view('student/report/dailyreport',$data);
	}


	public function printDailyAttRprt(){

		$role_id       = login_details['ROLE_ID'];
		$user_id       = login_details['user_id'];
		$data['Cdate'] = date('Y-m-d',strtotime($this->input->post('Cdate')));
		$userData = $this->alam->selectA('employee','WING_MASTER_ID',"EMPID='$user_id'");
		// echo print_r($userData);
		$wing = $userData[0]['WING_MASTER_ID']; 
		if($role_id == 4){
			$data['classSec'] = $this->alam->selectA('student',"CLASS,SEC,DISP_CLASS,DISP_SEC,ROLL_NO","Student_Status = 'ACTIVE' GROUP BY CLASS,SEC,DISP_CLASS,DISP_SEC order by CLASS,SEC");
			
		}else{
			$data['classSec'] = $this->alam->selectA('student',"CLASS,SEC,DISP_CLASS,DISP_SEC,ROLL_NO","Student_Status = 'ACTIVE' AND (SELECT wing_id FROM classes WHERE Class_No=student.CLASS)='$wing' GROUP BY CLASS,SEC,DISP_CLASS,DISP_SEC order by CLASS,SEC");
		}

		// echo "<pre>";
		// print_r($data);
		// die();
		$this->load->view('student/report/print_daily_report',$data);

		$html = $this->output->get_output();
		$this->load->library('pdf'); 
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("student_ledger.pdf", array("Attachment"=>0));
	}
}

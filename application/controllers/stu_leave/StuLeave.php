<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StuLeave extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$role_id    = login_details['ROLE_ID'];
		$Class_No   = login_details['Class_No'];
		$Section_No = login_details['Section_No'];
		if($role_id == 2){
			$data['stuLeaveData'] = $this->alam->selectA('stu_leave','*,(select CLASS_NM from
			 classes where Class_No=stu_leave.classes)classnm,(select SECTION_NAME from
			 sections where Section_No=stu_leave.sec)secnm',"classes='$Class_No' AND sec='$Section_No'");
		}elseif($role_id == 4){
			$data['stuLeaveData'] = $this->alam->selectA('stu_leave','*,(select CLASS_NM from
			 classes where Class_No=stu_leave.classes)classnm,(select SECTION_NAME from
			 sections where Section_No=stu_leave.sec)secnm');
		}
		$this->render_template('stu_leave/stuLeaveList',$data);
	}
	
	public function updateLeave(){
		$user_id = login_details['user_id'];
		$id  = $this->input->post('id');
		$act = $this->input->post('act');
		
		$updData = array(
			'leave_status_by_teacher' => $act,
			'action_by' => $user_id
		);
		echo "<pre>";
		print_r($updData);
		//$this->alam->update('stu_leave',$updData,"id='$id'");
	}
}

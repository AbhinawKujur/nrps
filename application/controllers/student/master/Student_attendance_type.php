<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_attendance_type extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){

		if(!in_array('viewStuAttenType', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		$data['student_attendance_type'] = $this->alam->select('student_attendance_type','class_code,class_nm,attendance_type');
		$this->render_template('student/master/student_attendance_type',$data);
	}
	
	public function upd_att_type(){
		$student_attendance_type = $this->alam->select('student_attendance_type','class_code,class_nm,attendance_type');
		foreach($student_attendance_type as $key => $data){
			$upd_data = array(
			'attendance_type' => $this->input->post('attendanceType_'.$key)
			);
			$upd_id = $data->class_code;
			$this->alam->update('student_attendance_type',$upd_data,"class_code='$upd_id'");
		}
		$this->session->set_flashdata('message', 'Attendance Type Successfully Updated');
		redirect('student/master/Student_attendance_type');
	}
}

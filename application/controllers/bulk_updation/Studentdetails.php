<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Studentdetails extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$this->load->model('Mymodel','dbcon');
	}
	public function index(){
		$class_teacher_status = $this->session->userdata('Class_tech_sts');
		$class_no = $this->session->userdata('Class_No');
		$sec_no = $this->session->userdata('Section_No');
		$studentdetails = $this->dbcon->select('student','*',"CLASS='$class_no' AND SEC='$sec_no' AND Student_Status='ACTIVE' ORDER BY ROLL_NO");
		$array = array(
			'class_teacher_status' => $class_teacher_status,
			'studentdetails' => $studentdetails
		);
		$this->render_template('bulk_updation/studentdetails',$array);
	}
	public function update_data(){
		$stdid = $this->input->post('adm');
		$value = strtoupper($this->input->post('value'));
		$data = array($this->input->post('table_column') => $value );
		$this->dbcon->update('student',$data,"STUDENTID='$stdid'");
	}
}
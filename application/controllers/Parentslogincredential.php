<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parentslogincredential extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Mymodel','dbcon');
	}
	public function index(){
		$data['class'] = $this->dbcon->select('classes','*');
		$data['student'] = $this->dbcon->select('student','*',"Student_Status='ACTIVE'");
		$this->render_template('student_details/parentlogincredential',$data);
	}
	
	public function getdata(){
		$class = $this->input->post('class');
		$sec = $this->input->post('sec');
		$data['student'] = $this->dbcon->select('student','*',"Student_Status='ACTIVE' AND CLASS='$class' AND SEC='$sec'");
		if(empty($data['student'])){
			echo "<center><h1>Sorry No Student Found in This Class And Sec.</h1></center>";
		}
		else{
			$this->load->view('student_details/class_sec_wise_parent_login_details',$data);
		}
	}
	
	public function active_student(){
		$id = $this->input->post('val');
		$adm = $this->input->post('adm');
		$data = $this->dbcon->select('student','*',"STUDENTID='$id' AND ADM_NO='$adm' AND Student_Status='ACTIVE'");
		
		echo json_encode($data);
	}
	public function change_password(){
		$adm = $this->input->post('adm');
		$id = $this->input->post('id');
		$pss = $this->input->post('pss');
		$array = array(
			'Parent_password' => $pss
		);
		if($this->dbcon->update('student',$array,"STUDENTID='$id'")){
			echo 1;
		}
		else{
			echo 0;
		}
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parentpassword_change extends MY_controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Mymodel','dbcon');
	}
	public function oldpassverify(){
		$oldpass = $this->input->post('oldpassword');
		$studentid = $this->input->post('studentid');
		$match = $this->dbcon->select('student','Parent_password',"STUDENTID='$studentid'");
		if(!empty($match)){
			$datapass = $match[0]->Parent_password;
		}else{
			$datapass = "N/A";
		}
		if($datapass == $oldpass){
			echo 1;
		}else{
			echo 0;
		}
	}
	public function changepassword(){
		$studentid = $this->input->post('studentid');
		$password = $this->input->post('password');
		$confirm_password = $this->input->post('confirm_password');
		$array = array('Parent_password' => $confirm_password);
		if($this->dbcon->update('student',$array,"STUDENTID='$studentid'")){
			echo 1;
		}else{
			echo 0;
		}
	}
}
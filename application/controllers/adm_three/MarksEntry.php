<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MarksEntry extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Alam','alam');
		$this->load->library('Alam_custom','alam_custom');
		$this->loggedOutThreeAdmForm();
	}
	
	public function index(){
		$data['stuData'] = $this->alam->selectA('three_adm_data','id,stu_nm,f_name,(select marks from three_adm_data_marks where reg_no=three_adm_data.id)marks',"f_code='Ok' AND verified_status='1'");
		$data['maxmarks'] = $this->alam->selectA('three_adm_data_maxmarks','maxmarks');
		$this->threeAdmissionAdminTemplate('adm_three/marks/marks_entry',$data);
	}
	
	function saveNdUpdMarks(){
		$user_id = generate_session['id']; 
		$stu_reg_no = $this->input->post('stu_reg_no');
		$marksValue = $this->input->post('marksValue');
		$chkMarks = $this->alam->selectA('three_adm_data_marks','count(*)cnt',"reg_no='$stu_reg_no'");
		$cnt = $chkMarks[0]['cnt'];
		
		$data = array(
			'reg_no' => $stu_reg_no,
			'marks' => $marksValue,
			'marks_entry_by' => $user_id,
		);
		
		if($cnt == 0){
			$this->alam->insert('three_adm_data_marks',$data);
		}else{
			$this->alam->update('three_adm_data_marks',$data,"reg_no='$stu_reg_no'");
			$this->alam->insert('three_marks_log',$data);
		}
	}
	
	function verifyMarks(){
		$id=generate_session['id'];
		$userData = $this->alam->selectA('nur_reg_user','mobile',"id='$id'");
		$data['mobileFull'] = $userData[0]['mobile'];
		$mobile = $userData[0]['mobile'];
		$mobFirstTwoChar = substr($mobile,0,2);
		$mobLastTwoChar = substr($mobile,-2);
		$data['mob'] = $mobFirstTwoChar.'XXXXXX'.$mobLastTwoChar;
		$data['stuData'] = $this->alam->selectA('three_adm_data','id,stu_nm,f_name,(select marks from three_adm_data_marks where reg_no=three_adm_data.id)marks,(select marks_status from three_adm_data_marks where reg_no=three_adm_data.id)marks_status',"f_code='Ok' AND verified_status='1'");
		$data['maxmarks'] = $this->alam->selectA('three_adm_data_maxmarks','maxmarks');
		$this->threeAdmissionAdminTemplate('adm_three/marks/vefify_marks',$data);
	}
	
	function sentOtp(){
		$mob = $this->input->post('mob');
		$rand = mt_rand(100000,999999);
		$this->session->set_userdata('marksrand',$rand);
		$message = "Your OTP is: ".$rand;
		$this->sms_lib->sendSms($mob,$message);
	}
	
	function chkOtpsession(){
		$otp = $this->input->post('otp');
		$set_otp = $this->session->userdata('marksrand');
		if($otp == $set_otp){
			echo 1;
		}else{
			echo 2;
		}
	}
	
	function saveVerified(){
		$stu_reg_id = $this->input->post('stu_reg_id');
		$chkboxValue = $this->input->post('chkbox');
		$data = array(
			'marks_status' => $chkboxValue
		);
		
		$this->alam->update('three_adm_data_marks',$data,"reg_no='$stu_reg_id'");
	}
}

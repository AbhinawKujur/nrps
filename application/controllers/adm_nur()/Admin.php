<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$this->load->view('nur_adm/login');
	}
	
	public function login(){
		$username = $this->input->post('username');
		
		if($username == 'admin' || $username == 'admin1' || $username == 'admin2'){
			$password = md5($this->input->post('password'));
			
			$regData = $this->alam->selectA('nur_reg_user','*',"username='$username' AND password='$password'");
			echo $id = isset($regData[0]['id'])?$regData[0]['id']:0;
			if($id != 0){
				$session = array(
					'id'       => $id,
					'name'     => $regData[0]['name'],
					'username' => $regData[0]['username'],
					'role'     => 'ADMIN'
				);
				
				$this->session->set_userdata('generate_session',$session);
			}
		}else{ //login for applicant
			$pwd      = explode("/",$this->input->post('password'));
			$password = $pwd[0];
			$otp      = $this->input->post('otp');

			$regData = $this->alam->selectA('nursery_adm_data','id,dob,stu_nm,mobile,img,set_amt,verified_status,f_code',"id='$username' AND mobile='$password' and verified_status in(0,1)");
			if($otp == $this->session->userdata('rand')){
				$session = array(
					'id'              => $regData[0]['id'],
					'name'            => $regData[0]['stu_nm'],
					'img'             => $regData[0]['img'],
					'set_amt'         => $regData[0]['set_amt'],
					'verified_status' => $regData[0]['verified_status'],
					'mobile'          => $regData[0]['mobile'],
					'f_code'          => $regData[0]['f_code'],
					'role'            => 'APPLICANT'
				);
				
				$this->session->set_userdata('generate_session',$session);
				echo $id = $regData[0]['id'];
			}else{
				echo $id = 0;
			}
		}
	}
	
	public function dashboard(){
		$this->loggedOutNurAdmForm();
		$data['nursery_adm_data'] = $this->alam->selectA('nursery_adm_data','count(*)tot_reg_stu',"f_code='Ok'");
		
		$data['verified_stu'] = $this->alam->selectA('nursery_adm_data','count(*)tot_verified_stu',"verified_status='1' AND f_code='Ok'");
		
		$data['rejected_list'] = $this->alam->selectA('nursery_adm_data','count(*)tot_rejected_stu',"verified_status='2' AND f_code='Ok'");
		
		$data['success_trns'] = $this->alam->selectA('nursery_adm_data','count(*)tot_success_trans',"f_code='Ok'");
		
		$data['trns_faield'] = $this->alam->selectA('nursery_adm_data','count(*)tot_trns_faield',"f_code <> 'Ok' and transaction_id is not null");
		
		$data['not_attempted'] = $this->alam->selectA('nursery_adm_data','count(*)not_attemp',"transaction_id is null");
		
		$id = generate_session['id'];
		$data['stuData'] = $this->alam->selectA('nursery_adm_data','*',"id='$id'");
		$this->nurseryAdmissionAdminTemplate('adm_three/admin/index',$data);
	}
	
	public function logout(){
		session_destroy();
		redirect('adm_nur/Admin');
	}
	
	public function chkThenOtp(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		$regData = $this->alam->selectA('nursery_adm_data','count(*)cnt',"id='$username' AND mobile='$password'");
		$rand = mt_rand(100000,999999);
		$this->session->set_userdata('rand',$rand);
		$message = "Your OTP is: ".$rand;
		
		$this->sms_lib->sendSms($password,$message);
		
		echo $cnt = $regData[0]['cnt'];
	}
}

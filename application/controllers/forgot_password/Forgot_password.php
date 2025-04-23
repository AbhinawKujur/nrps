<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot_password extends CI_controller{
	public function __construct(){
		parent ::__construct();
		$this->load->model('Alam','alam');
	}
	public function index(){
		$this->load->view('forgot_password/forgot_password');
	}
	
	public function fetch_username(){
		$uname    = $this->input->post('uname');
		$userdata = $this->alam->select('login_details','user_id',"username='$uname'");
		$user_id  = isset($userdata[0]->user_id)?$userdata[0]->user_id:'';
		if($user_id == ''){
			$this->session->set_flashdata('error',"Invalid Username, Please Contact your Administrator");
			redirect('forgot_password/Forgot_password');
		}else{
			$emp_data = $this->alam->select('employee','EMPID,C_MOBILE,C_EMAIL',"EMPID='$user_id'");
			if(!empty($emp_data)){
			 $data['EMPID']            = $emp_data[0]->EMPID;
			 $splt_mobile              = $emp_data[0]->C_MOBILE;
			 $data['mobile']           = $emp_data[0]->C_MOBILE;
			 $data['mail']             = $emp_data[0]->C_EMAIL;
			 $data['fistTwo_mobile']   = substr($splt_mobile, 0, 2);
			 $data['lastTwo_mobile']   = substr($splt_mobile, -2);
			 $splt_email               = $emp_data[0]->C_EMAIL;
			 $data['fistFour_email']   = substr($splt_email, 0, 4);
			 $data['lastTwelve_email'] = substr($splt_email, -12);
			}
			$this->load->view('forgot_password/forgot_password_nxt',$data);
		}
	}
	
	public function send_otp(){
		$empid               = $this->input->post('empid');
		$data['emplyid']     = $this->input->post('empid');
		$value               = $this->input->post('value');
		$cnt_value           = strlen($this->input->post('value'));
		$six_digitOtp_number = mt_rand(100000, 999999);
		$this->session->set_userdata('generate_otp',$six_digitOtp_number);
		
		$emp_data = $this->alam->select('employee','EMPID,EMP_FNAME',"EMPID='$empid'");
		@$empnm    = $emp_data[0]->EMP_FNAME;
		
		if($cnt_value == 10){//otp for mobile
		//----------send sms--------------//
		//Your authentication key
			$authKey = "1179AUO6WzMSj5cbaa62a";

			//Multiple mobiles numbers separated by comma
			$mobileNumber = $value;

			//Sender ID,While using route4 sender id should be 6 characters long.
			$senderId = "JVMSHM";
			
			$msg = 'Dear ('. $empnm .') '.$six_digitOtp_number.' is your ERP login OTP. OTP is confidentail, DO NOT share this One time password(OTP) with anyone "JVM SHYMALI"';
			$message = urlencode($msg);

			//Define route 
			$route = "default";
			//Prepare you post parameters
			$postData = array(
				'authkey' => $authKey,
				'mobiles' => $mobileNumber,
				'message' => $message,
				'sender' => $senderId,
				'route' => $route
			);

			//API URL
			$url="http://www.smsmica.com/api/sendhttp.php?authkey=".$authKey."&mobiles=".$mobileNumber."&message=".$message."&sender=".$senderId."&route=4&country=91";

			// init the resource
			$ch = curl_init();
			curl_setopt_array($ch, array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => $postData
				//,CURLOPT_FOLLOWLOCATION => true
			));


			//Ignore SSL certificate verification
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


			//get response
			$output = curl_exec($ch);

			//Print error if any
			if(curl_errno($ch))
			{
				echo 'error:' . curl_error($ch);
			}

			curl_close($ch);
		//-----------end sms send-------------//
		}else{//opt for email
		  echo "<h1>Work in progress plz back</h1>";
		  // $config = Array(
		  // 'protocol' => 'smtp',
		  // 'smtp_host' => 'ssl://smtp.googlemail.com',
		  // 'smtp_port' => 465,
		  // 'smtp_user' => 'jvmshyamali620@gmail.com', 
		  // 'smtp_pass' => 'jvmshyamali', 
		  // 'mailtype' => 'html',
		  // 'charset' => 'iso-8859-1',
		  // 'wordwrap' => TRUE
		// );
		  // $message = 'hello world';
		  // $this->load->library('email', $config);
		  // $this->email->set_newline("\r\n");
		  // $this->email->from('jvmshyamali620@gmail.com'); 
		  // $this->email->to('alamsayeed42@gmail.com');
		  // $this->email->subject('Resume from JobsBuddy for your Job posting');
		  // $this->email->message($message);
		  // if($this->email->send()){
		   // echo 'Email sent.';
		  // }else{
		   // show_error($this->email->print_debugger());
		  // }
		}
		$this->load->view('forgot_password/enter_otp',$data);
	}
	
	public function enter_otp(){
		$generate_otp    = $this->input->post('generate_otp');
		$otp             = $this->input->post('otp');
		$empid           = $this->input->post('empid');
		$data['emplyid'] = $this->input->post('empid');
		if($generate_otp  == $otp){
			$this->load->view('forgot_password/change_password',$data);
		}else{
			$this->session->set_flashdata('otp_error',"Enter Correct OTP");
			$this->load->view('forgot_password/enter_otp',$data);
		}
	}
	
	public function upd_pwd(){
		$empid           = $this->input->post('empid');
		$data['emplyid'] = $this->input->post('empid');
		$password        = $this->input->post('password');
	    $c_password      = $this->input->post('c_password');
		if($password == $c_password){
			$upd_data = array(
			 'pass_word' => md5($c_password),
			);
			$this->alam->update('login_details',$upd_data,"user_id='$empid'");
			$this->session->unset_userdata('generate_otp');
			$this->session->set_flashdata('msg','<div class="msg animated heartBeat delay-2s" style="background:green; color:#fff">Password reset successfully</div>');
			redirect('login');
		}else{
			$this->session->set_flashdata('same_pass_error',"Password or Confirm Password Do not matched");
			$this->load->view('forgot_password/change_password',$data);
		}
	}
}
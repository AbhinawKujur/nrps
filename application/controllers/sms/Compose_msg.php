<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compose_msg extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$role_id         = login_details['ROLE_ID'];
		$data['user_id'] = login_details['user_id'];		
		$user_id         = login_details['user_id'];		
		$Class_No        = login_details['Class_No'];		
		$Section_No      = login_details['Section_No'];
		
		if($role_id == 2){
			$data['stuData'] = $this->alam->selectA('student','ADM_NO,FIRST_NM',"CLASS='$Class_No' AND SEC='$Section_No' AND Student_Status = 'ACTIVE'");
		}else if($role_id == 6){
			$data['stuData'] = $this->alam->selectA('student','ADM_NO,FIRST_NM',"CLASS='$Class_No' AND Student_Status = 'ACTIVE'");
		}
		
		$data['smsData'] = $this->alam->selectA('chat_msg','*',"receiver_id='$user_id' AND read_status='N' order by sender_date");
		
		$this->render_template('sms/composemsg',$data);
	}
	
	public function composeMsgSave(){
		$sender_id    = $this->session->userdata('user_id');
		$Class_No     = login_details['Class_No'];
		$Section_No   = login_details['Section_No'];
		$text_msg     = $this->input->post('text_msg');
		$receiver_id  = $this->input->post('send_to[]');
		
		foreach($receiver_id as $key => $val){
			
			$saveData = array(
				'sender_id' => $sender_id,
				'sender_user' => 'E',
				'receiver_user' => 'P',
				'class' => $Class_No,
				'sec' => $Section_No,
				'sms_text' => $text_msg,
				'receiver_role_id' => 0,
				'receiver_id' => $val
			);
			$this->alam->insert('chat_msg',$saveData);
		}
		$this->session->set_flashdata('msg',"Send Successfully");
		redirect('sms/Compose_msg');
	}
}

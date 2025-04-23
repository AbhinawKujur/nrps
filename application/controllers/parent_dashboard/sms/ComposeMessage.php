<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ComposeMessage extends MY_Controller{
	
	public function __construct(){
		parent ::__construct();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$adm_no     = $this->session->userdata('adm');
		$Class_No   = $this->session->userdata('class_code');
		$Section_No = $this->session->userdata('sec_code');
	
		$data = array();
		$teacherData = $this->alam->selectA('login_details','emp_name,user_id',"Class_No='$Class_No' AND Section_No = '$Section_No'");
		
		if(!empty($teacherData)){
			$data['emp_name'] = $teacherData[0]['emp_name'];
			$data['user_id']  = $teacherData[0]['user_id'];
		}
		
		$sectionInchargeDate    = $this->alam->selectA('employee','concat(IFNULL(`EMP_FNAME`,"")," ",IFNULL(`EMP_MNAME`,"")," ",IFNULL(`EMP_LNAME`,""))secInchagreNm,EMPID',"WING_MASTER_ID=(select wing_id from classes where Class_No='$Class_No') AND ROLE_id = '6'");

		if(!empty($sectionInchargeDate)){
			$data['secInchagreNm'] = $sectionInchargeDate[0]['secInchagreNm'];
			$data['SEC_EMPID']     = $sectionInchargeDate[0]['EMPID'];
		}
		
		$vicePrincipalData    = $this->alam->selectA('employee','concat(IFNULL(`EMP_FNAME`,"")," ",IFNULL(`EMP_MNAME`,"")," ",IFNULL(`EMP_LNAME`,""))vicePrincipalNm,EMPID',"WING_MASTER_ID=(select wing_id from classes where Class_No='$Class_No') AND ROLE_id = '5'");
		
		if(!empty($vicePrincipalData)){
			$data['vicePrincipalNm'] = $vicePrincipalData[0]['vicePrincipalNm'];
			$data['VICE_PRI_EMPID']  = $vicePrincipalData[0]['EMPID'];
		}
		
		$pricipalData = $this->alam->selectA('employee','concat(IFNULL(`EMP_FNAME`,"")," ",IFNULL(`EMP_MNAME`,"")," ",IFNULL(`EMP_LNAME`,""))PrincipalNm,EMPID',"ROLE_id = '4'");
		if(!empty($pricipalData)){
			$data['PrincipalNm'] = $pricipalData[0]['PrincipalNm'];
			$data['PRI_EMPID']   = $pricipalData[0]['EMPID'];
		}
		
		$this->Parent_templete('parents_dashboard/sms/composeMessage',$data);
	}
	
	public function composeMsgSave(){
		$sender_id    = $this->session->userdata('adm');
		$Class_No     = login_details['Class_No'];
		$Section_No   = login_details['Section_No'];
		$text_msg     = $this->input->post('text_msg');
		$receiver_id  = $this->input->post('send_to[]');
		
		foreach($receiver_id as $key => $val){
			$roleData = $this->alam->selectA('employee','ROLE_ID',"EMPID='$val'");
			$role_id = $roleData[0]['ROLE_ID'];
			
			$saveData = array(
				'sender_id' => $sender_id,
				'sender_user' => 'P',
				'receiver_user' => 'E',
				'class' => $Class_No,
				'sec' => $Section_No,
				'sms_text' => $text_msg,
				'receiver_role_id' => $role_id,
				'receiver_id' => $val
			);
			$this->alam->insert('chat_msg',$saveData);
		}
		$this->session->set_flashdata('msg',"Send Successfully");
		redirect('parent_dashboard/sms/ComposeMessage');
	}
}
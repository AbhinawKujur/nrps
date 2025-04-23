<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApplyLeave extends MY_controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Alam','alam');
	}

	public function index(){
		$admno = $this->session->userdata('adm');
		$data['stuLeaveData'] = $this->alam->selectA('stu_leave','*',"admno='$admno'");
		$this->Parent_templete('parents_dashboard/leave/applyleave',$data);
	}
	
	public function applyLeaveSave(){
		$formDate = date('Y-m-d',strtotime($this->input->post('formDate')));
		$toDate   = date('Y-m-d',strtotime($this->input->post('toDate')));
		$reason   = $this->input->post('reason');
		
		$imgList = array();
		for($i=0; $i<count($_FILES['img']['name']); $i++){
			if(!empty($_FILES['img']['name'][$i])){
			$image              = $_FILES['img']['name'][$i]; 
			$expimage           = explode('.',$image);
			$count              = count($expimage);
			$image_ext          = $expimage[$count-1];
			$image_name         = strtotime('now'). rand() .'.'.$image_ext;
			$imagepath          = "uploads/leave_files/".$image_name;
			
			move_uploaded_file($_FILES["img"]["tmp_name"][$i],$imagepath);
			$imgList[] = $imagepath;
			}else{
				$imagepath  = '';
			}
		}
		
		$saveLeave = array(
			'admno'		 => $this->session->userdata('adm'),
			'classes'    => $this->session->userdata('class_code'),
			'sec'        => $this->session->userdata('sec_code'),
			'from_date'  => $formDate,
			'to_date'    => $toDate,
			'reason'     => $reason,
			'img'        => $imgList[0],
		);
		$this->alam->insert('stu_leave',$saveLeave);
	}
}
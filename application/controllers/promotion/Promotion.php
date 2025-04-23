<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promotion extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Mymodel','dbcon');
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$data['topperRank'] = $this->alam->selectA('topper_rank','*',"1='1' ORDER by rank");
		$this->render_template('promotion/promotion_list',$data);
	}
	
	public function classPromote(){
		$data['classes'] = $this->alam->selectA('classes','*',"Class_No in (8,9,10,11)");
		$data['sections'] = $this->alam->selectA('sections','*',"section_no in (1,2,3,4,5,6,7)");
		$this->render_template('promotion/classPromote',$data);
	}
	
	public function LoadSelectedClass(){
		$text     = $this->input->post('text');
		$class_id = $this->input->post('class_id');
		$sec_id   = $this->input->post('sec_id');
		
		$data['selectSec'] = $class_id + 1;
		
		if($text == 'class'){
			$data['topperRank'] = $this->alam->selectA('topper_rank','*,(select CLASS_NM from classes where Class_No=topper_rank.class_id)classnm,(select SECTION_NAME from sections where section_no=topper_rank.sec_id)secnm',"class_id='$class_id' ORDER by rank");
			$this->alam->promotedStuSave($class_id);
		}else{
			$data['topperRank'] = $this->alam->selectA('topper_rank','*,(select CLASS_NM from classes where Class_No=topper_rank.class_id)classnm,(select SECTION_NAME from sections where section_no=topper_rank.sec_id)secnm',"class_id='$class_id' AND sec_id='$sec_id' ORDER by rank");
		}
		
		$data['classes'] = $this->alam->selectA('classes','*',"Class_No in (8,9,10,11)");
		$data['sections']   = $this->alam->selectA('sections','*',"section_no in (1,2,3,4,5,6,7)");
		$this->load->view('promotion/loadClassPromote',$data);
	}
	
	public function SavePromotionData(){
		$admno = $this->input->post('admno');
		$curr_class_id = $this->input->post('curr_class_id');
		$curr_sec_id = $this->input->post('curr_sec_id');
		$value = $this->input->post('value');
		$promoted_section = $this->input->post('promoted_section');
		$promotedClass = $this->input->post('promotedClass');
		$status = $this->input->post('status');
		
		$saveUpdData = array(
			'admno'             => $admno,
			'status'            => $status,
			'class_id'          => $curr_class_id,
			'sec_id'            => $curr_sec_id,
			'promoted_class_id' => $promotedClass,
			'promoted_sec_id'   => $promoted_section,
			'created_by'        => login_details['user_id']
		);
		
		$countData = $this->alam->selectA('promoted_stu','count(*)cnt',"admno='$admno' AND class_id='$curr_class_id' AND sec_id='$curr_sec_id'");
		$cnt = $countData[0]['cnt'];
		if($cnt == 0){
			$this->alam->insert('promoted_stu',$saveUpdData);
		}else{
			$this->alam->update('promoted_stu',$saveUpdData,"admno='$admno' AND class_id='$curr_class_id' AND sec_id='$curr_sec_id'");
		}
		
		$data['topperRank'] = $this->alam->selectA('topper_rank','*,(select CLASS_NM from classes where Class_No=topper_rank.class_id)classnm,(select SECTION_NAME from sections where section_no=topper_rank.sec_id)secnm',"class_id='$curr_class_id' ORDER by rank");
		$data['classes'] = $this->alam->selectA('classes','*',"Class_No in (8,9,10,11)");
		$data['sections']   = $this->alam->selectA('sections','*',"section_no in (1,2,3,4,5,6,7)");
		$this->load->view('promotion/loadClassPromote',$data);
	}
}
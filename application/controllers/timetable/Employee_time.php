<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_time extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Pawan','pawan');
	}
	
	public function index(){	
		$data['teacher_list']   = $this->pawan->unassign_teacher_time_tbl();			
		$this->render_template('timetable/unasign_teach_time_tbl_list',$data);
	}
	
	public function generateteachertime(){
		 $count			=$this->input->post('count'); 
		for($i=1; $i<=$count; $i++){
		 $teacher_id	=$this->input->post('emp_id'.$i);
		/********Teacher Time Table DataInsert*************/
			for($j=1; $j<=6; $j++){
				$teach_class_time=array(
					'teacher_code'		=>	$teacher_id, 
					'days'				=>	$j,
					'period_1'			=>	'FREE',
					'period_2'			=>	'FREE',
					'period_3'			=>	'FREE',
					'period_4'			=>	'FREE',
					'period_5'			=>	'FREE',
					'period_6'			=>	'FREE',
					'period_7'			=>	'FREE',
					'period_8'			=>	'FREE',
				);
				$this->sumit->createData('teacher_time_table',$teach_class_time);
			}
		//*****************End******************/
		} 
		redirect('timetable/Employee_time');
	}
	
 
}
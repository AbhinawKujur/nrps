<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Class_time extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Pawan','pawan');
	}
	
	public function index(){	
		$data['class_list']   = $this->pawan->unassign_class_time_tbl();			
		$this->render_template('timetable/unasign_class_time_tbl_list',$data);
	}
	
	public function generateclasstime(){
		 $count				=$this->input->post('count'); 
		for($i=1; $i<=$count; $i++){
		echo  $class_sec_code	=$this->input->post('class_sec_code'.$i); 
		/********Teacher Time Table DataInsert*************/
			for($j=1; $j<=6; $j++){
				$class_sec_code1=array(
					'Class_Sec_Code'	=>	$class_sec_code, 
					'days'				=>	$j,
					'period_1'			=>	'UNASSIGN',
					'period_2'			=>	'UNASSIGN',
					'period_3'			=>	'UNASSIGN',
					'period_4'			=>	'UNASSIGN',
					'period_5'			=>	'UNASSIGN',
					'period_6'			=>	'UNASSIGN',
					'period_7'			=>	'UNASSIGN',
					'period_8'			=>	'UNASSIGN',
				);
				$this->sumit->createData('class_time_table',$class_sec_code1);
			}
		//*****************End******************/
		} 
		redirect('timetable/Class_time');
	}
	
 
}
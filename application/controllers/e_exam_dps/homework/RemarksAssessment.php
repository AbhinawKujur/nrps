<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RemarksAssessment extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Pawan','pawan');		
	}
	
	public function index(){	
		$array['class_no']   	= $this->pawan->selectA('classes','*');				
        $this->render_template('e_exam/remarks_assessment',$array);		
	}
	
	
	public function student_exam_details(){		
		 $data['class_no']			= $this->input->post('classess1');
		 $data['section_no']		= $this->input->post('section_id');
		 $data['subject_nam']		= $this->input->post('subject_nam');
		 $data['selected_stu']		= $this->input->post('adm_no');
		 $data['submition_dt']		= $this->input->post('submition_dt');
		 $data['created_at']		= $this->input->post('created_at');
		  $data['homwrkid']		= $this->input->post('homwrkid');
		 
		 
		$this->render_template('e_exam/homework/remarks_assessment',$data);	
		 			
	}
	

	
	public function remarks_entry(){		
		 $ids				= $this->input->post('qid');		 				
		 $remarks			= $this->input->post('remarks');		 		 
		 $answe	=	$this->pawan->selectA('e_exam_answers_hw','*',"id='$ids'");
		 $admn		=	$answe[0]['admno'];
		 $subj_id	=	$answe[0]['subj_id'];
		 $user_id            = login_details['user_id'];
		 $role_id            = login_details['ROLE_ID'];	
		 $cdate		=date('Y-m-d H:i:s');	 
		 $arr=array(
		 'updated_by'	=> $user_id,
		 'remarks'		=> $remarks,
		 'updated_on'	=> $cdate,
		 'teacher_final_copy_correction'=>'1'
		 );		 
		 $this->pawan->update('e_exam_answers_hw',$arr,"id='$ids'");	 
	}
	
	
}

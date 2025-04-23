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
		 $data['section_no']		= $this->input->post('section_no');
		 $data['subject_nam']		= $this->input->post('subject_nam');
		 $data['class_ids']			= $this->input->post('class_ids');
		 $data['section_id']		= $this->input->post('section_id');
		 $data['subject_ids']		= $this->input->post('subject_ids');
		 $data['selected_stu']		= $this->input->post('adm_no');
		 $data['exam_datee']		= $this->input->post('exam_datee');
		 $data['exam_schedule_id']	= $this->input->post('exam_schedule_id');
		 $data['remark']			= $this->pawan->selectA('online_exam_remarks','*');
		$this->render_template('onlineexam/copy_correction/remarks_assessment',$data);	
		 			
	}
	
	public function student_exam_details2(){		
		 $data['class_no']			= $this->input->post('classess1');
		 $data['section_no']		= $this->input->post('section_no');
		 $data['subject_nam']		= $this->input->post('subject_nam');
		 $data['class_ids']			= $this->input->post('class_ids');
		 $data['section_id']		= $this->input->post('section_id');
		 $data['subject_ids']		= $this->input->post('subject_ids');
		 $data['selected_stu']		= $this->input->post('adm_no');
		 $data['exam_datee']		= $this->input->post('exam_datee');
		 $data['exam_schedule_id']	= $this->input->post('exam_schedule_id');
		 $data['remark']			= $this->pawan->selectA('online_exam_remarks','*');
		$this->render_template('onlineexam/copy_correction/remarks_assessment2',$data);	
		 			
	}
	

	
	public function remarks_entry(){		
		 $ids				= $this->input->post('qid');		 				
		 $remarks			= $this->input->post('remarks');		 		 
		
		 $user_id   = login_details['user_id'];
		 $role_id   = login_details['ROLE_ID'];	
		 $cdate		=date('Y-m-d H:i:s');	 
		 $arr=array(
		 'updated_by'	=> $user_id,
		 'remarks_id'	=> $remarks,
		 'updated_on'	=> $cdate,
		 'teacher_final_copy_correction'=>'1'
		 );		 
		 $this->pawan->update('online_exam_answers',$arr,"id='$ids'");	 
		
		
	}
	
	public function comment_entry(){		
		 $ids				= $this->input->post('qid');		 				
		 $comment			= $this->input->post('comment');		 		 
		
		 $user_id   = login_details['user_id'];
		 $role_id   = login_details['ROLE_ID'];	
		 $cdate		=date('Y-m-d H:i:s');	 
		 $arr=array(
		 'updated_by'	=> $user_id,
		 'comment'		=> $comment,
		 'updated_on'	=> $cdate,
		 'teacher_final_copy_correction'=>'1'
		 );		 
		 $this->pawan->update('online_exam_answers',$arr,"id='$ids'");	 
		
		
	}
	
	
	public function marks_entry(){		
		 $ids		= $this->input->post('qid');
		 $marks		= $this->input->post('marks');
		$user_id    = login_details['user_id'];
		 $answe	=	$this->pawan->selectA('online_exam_answers','*',"que_id='$ids'");
		
		 $arr=array(
		 'stu_marks'	=>	$marks,
		'updated_on'	=>date('Y-m-d H:i:s'),
		'updated_by'	=>$user_id,
		'teacher_final_copy_correction'=>1,
		 );
		 
		 $this->pawan->update('online_exam_answers',$arr,"id='$ids'");
		 
		 
		 
	}
	
	
}

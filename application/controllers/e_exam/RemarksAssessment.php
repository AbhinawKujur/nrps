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
		 $data['exam_date']			= $this->input->post('exam_date');
		 
		 
		$this->render_template('e_exam/remarks_assessment',$data);	
		 			
	}
	
	public function marks_entry(){		
		 $ids				= $this->input->post('qid');
		$marks	= $this->input->post('marks');
		 
		 $answe	=	$this->pawan->selectA('e_exam_answers','*',"id='$ids'");
		 $admn		=	$answe[0]['admno'];
		 $subj_id	=	$answe[0]['subj_id'];
		 $e_dat		=	date('Y-m-d',strtotime($answe[0]['created_at']));
		 $e_dat1	=	$answe[0]['created_at'];
		 
		 $con 	=	$this->pawan->selectA('tbl_corrected_report','count(id) as cont',"admno='$admn' and date(exam_date)='$e_dat' and subject_id='$subj_id'");
		//echo  $this->db->last_query();
		$num	=  $con[0]['cont'];
		
		if($num==0){
				$ins=array(
				 'admno'		=>	$admn,	
				 'exam_date'	=>	$e_dat1,
				 'subject_id'	=>	$subj_id
				 );
				 
		$this->pawan->insert('tbl_corrected_report',$ins);
		}
		 
		 $arr=array(
		 'ob_marks'	=>	$marks,	
		 );
		 
		 $this->pawan->update('e_exam_answers',$arr,"id='$ids'");
		 
		 
		 
	}
	
	public function remarks_entry(){		
		 $ids				= $this->input->post('qid');		 				
		 $remarks			= $this->input->post('remarks');
		
		 
		 $answe	=	$this->pawan->selectA('e_exam_answers','*',"id='$ids'");
		 $admn		=	$answe[0]['admno'];
		 $subj_id	=	$answe[0]['subj_id'];
		 $e_dat		=	date('Y-m-d',strtotime($answe[0]['created_at']));
		 $e_dat1	=	$answe[0]['created_at'];
		 $con 	=	$this->pawan->selectA('tbl_corrected_report','count(id) as cont',"admno='$admn' and date(exam_date)='$e_dat' and subject_id='$subj_id'");
		//echo  $this->db->last_query();die;
		$num	=  $con[0]['cont'];	
		if($num==0){
				$ins=array(
				 'admno'		=>	$admn,	
				 'exam_date'	=>	$e_dat1,
				 'subject_id'	=>	$subj_id
				 );				 
		$this->pawan->insert('tbl_corrected_report',$ins);
		}
		 
		 $arr=array(	
		 'remarks'	=>	$remarks
		 );		 
		 $this->pawan->update('e_exam_answers',$arr,"id='$ids'");	 
	}
	
	public function sum_mark(){
		$ids				= $this->input->post('qid');
		$answe	=	$this->pawan->selectA('e_exam_answers','*',"id='$ids'");
		 $admn		=	$answe[0]['admno'];
		 $subj_id	=	$answe[0]['subj_id'];
		 $e_dat		=	date('Y-m-d',strtotime($answe[0]['created_at']));
		 
		 $sum=$this->pawan->selectA('e_exam_answers','sum(ob_marks)as marks',"admno='$admn' and subj_id='$subj_id' and date(created_at)='$e_dat'");
		 //echo $this->db->last_query();
		echo $sum[0]['marks'];
	}
}

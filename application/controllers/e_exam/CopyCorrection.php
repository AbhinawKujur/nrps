<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CopyCorrection extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Pawan','pawan');		
	}
	
	public function index(){	
		$array['class_no']   	= $this->pawan->selectA('classes','*');				
						
        $this->render_template('e_exam/stulist',$array);		
	}
	
	public function Class_sec(){
		 $class_no	=$this->input->post('class_code');
		 $data = $this->pawan->section_name_cwisw($class_no);
		 ?>


		<select id="section_id" name='section_id' style="padding:2px; width:174px;">
			    <option value=''>Select</option>
				<?php
				  if(isset($data)){
					  foreach($data as $dt){
						?>
						<option value="<?php echo $dt->section_no; ?>"><?php echo $dt->section_nm; ?></option>
						<?php
					  }
				  }
				?>
		</select>
			  <?php 
	}
	
	public function subject_nam(){
		 $class_no	=$this->input->post('class_code');
		 $sec_no	=$this->input->post('sec_no');
		 $data1 = $this->pawan->subject_name_cwisw($class_no);
		 print_r($data1);
		 ?>


		<select id="subject_nam" name='subject_nam' style="padding:2px; width:174px;" onchange="subject_ids(this.value)">
			    <option value=''>Select</option>
				<?php
				  if(isset($data1)){
					  
					  foreach($data1 as $dt1){
						  
						?>
						<option value="<?php echo $dt1->subject; ?>"><?php echo $dt1->sub_name; ?></option>
						<?php
					  }
				  }
				?>
		</select>
			  <?php 
	}
	
	public function examDate(){		
		  $class_no			= $this->input->post('class_code');
		  $section_no		= $this->input->post('sec_no');
		  $subject_nam		= $this->input->post('subject_ids');
		  $exmdat			= $this->pawan->selectA('e_exam_questions','examDate',"classes='$class_no' and sec='$section_no' and subject='$subject_nam' group by examDate");
		  //echo $this->db->last_query();die;
		  ?>
		  <select id="exam_date" name='exam_date' style="padding:2px; width:174px;" >
			    <option value=''>Select</option>
				<?php
				  if(!empty($exmdat)){
					  
					  foreach($exmdat as $key => $vals){
						  
						?>
						<option value="<?php echo $vals['examDate']; ?>"><?php echo $vals['examDate']; ?></option>
						<?php
					  }
				  }
				?>
		</select>
			  <?php
		 
	}
	
	public function stulist(){		
		 $class_no			= $this->input->post('classess1');
		 $section_no		= $this->input->post('section_id');
		 $subject_nam		= $this->input->post('subject_nam');
		 $exam_date			= date('Y-m-d',strtotime($this->input->post('exam_date')));
		// $data['Student_list']			= $this->pawan->student_List($class_no,$section_no,$subject_nam,$exam_date); 
		$data['Student_list']			= $this->pawan->selectA('student',"`ADM_NO`, `FIRST_NM`, `ROLL_NO`,
(SELECT DISTINCT(admno) as adm FROM e_exam_answers WHERE e_exam_answers.admno=student.ADM_NO AND e_exam_answers.subj_id='$subject_nam' AND date(e_exam_answers.created_at)='$exam_date')appl,
(SELECT admno FROM tbl_corrected_report WHERE tbl_corrected_report.admno=student.ADM_NO and subject_id='$subject_nam'  AND date(tbl_corrected_report.exam_date)='$exam_date')correct","`CLASS` = '$class_no' and `SEC` = '$section_no' ORDER BY ROLL_NO,FIRST_NM");
		//echo $this->db->last_query();die;
		 $data['class_no']		=$class_no;
		 $data['section_no']	=$section_no;
		 $data['subject_nam']	=$subject_nam;
		 $data['exam_date']		=$exam_date;
		 $this->render_template('e_exam/stulist2',$data);
		
		 			
	}
	
	public function marks_entry(){		
		 $ids				= $this->input->post('qid');
		 $marks				= $this->input->post('marks');
		 $remarks			= $this->input->post('remarks');
		
		 
		 $arr=array(
		 'ob_marks'	=>	$marks,	
		 'remarks'	=>	$remarks
		 );
		 
		 $this->pawan->update('e_exam_answers',$arr,"id='$ids'");
		 
	}
}

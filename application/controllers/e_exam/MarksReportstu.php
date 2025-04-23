<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MarksReportstu extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Pawan','pawan');		
		$this->load->model('Alam','alam');		
	}
	
	public function index(){	
		$array['class_no']   	= $this->pawan->selectA('classes','*');						
        $this->render_template('e_exam/marks_report_stu',$array);		
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


		<select id="subject_nam" name='subject' style="padding:2px; width:174px;" onchange='section_sec(this.value)'>
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
	
	public function generateMarksReport(){
		 $classes	  = $this->input->post('classes');
		 $section_id  = $this->input->post('section_id');
		 $subject	  = $this->input->post('subject');
		 $exam_date			= date('Y-m-d',strtotime($this->input->post('exam_date')));
		 $data['exam_date']	= $exam_date;
		 $cls	=$this->pawan->selectA('classes','CLASS_NM',"Class_No='$classes'");
		 $data['classes']	=	$cls[0]['CLASS_NM'];
		 $sec	=$this->pawan->selectA('sections','SECTION_NAME',"section_no='$section_id'");
		  $data['section']	=	$sec[0]['SECTION_NAME'];
		 $sub	=$this->pawan->selectA('subjects','SubName',"SubCode='$subject'");
		 $data['Sujects']	=	$sub[0]['SubName'];
		 $data['stuList'] = $this->alam->selectA('student',"ADM_NO,FIRST_NM,ROLL_NO,(SELECT sum(ob_marks)as marks_obt FROM e_exam_answers WHERE e_exam_answers.admno=student.ADM_NO AND e_exam_answers.subj_id='$subject')obt_marks","CLASS='$classes' and SEC='$section_id' ORDER BY ROLL_NO,FIRST_NM");
		 //echo $this->db->last_query();die;
		 
		 $this->render_template('e_exam/marks_report_stu',$data);
		 
		 /* $html = $this->output->get_output();
		 $this->load->library('pdf');
		 $this->dompdf->loadHtml($html);
		 $this->dompdf->setPaper('A4', 'potrait');
		 $this->dompdf->render();
		 $this->dompdf->stream("Percentage_report.pdf", array("Attachment"=>0)); */
	}
}

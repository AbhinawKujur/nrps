<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeworkReport1 extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Pawan','pawan');		
		$this->load->model('Alam','alam');		
	}
	
	public function index(){	
		$class              = login_details['Class_No'];
		$sec                = login_details['Section_No'];
		$user_id            = login_details['user_id'];
		$role_id            = login_details['ROLE_ID'];
		if($role_id==1 || $role_id==4 || $role_id==5 || $role_id==6){
		$array['class_no']   	= $this->pawan->selectA('classes','*');				
		}else{
			$array['class_no']   	= $this->pawan->selectA('classes','*',"Class_No='$class'");
			
		}			
		$array['subjet']   	= $this->pawan->selectA('subjects','*');				
											
        $this->render_template('e_exam/homework/homework_report1',$array);		
	}
	
	public function Class_creat(){
		 $class_no		= $this->input->post('class_code');
		 $subject_nam	= $this->input->post('subject_ids');
	
		
		 $data = $this->pawan->selectA('e_exam_questions_hw','*',"subject='$subject_nam' and classes='$class_no'");
		 	 
		 ?>


		<select id="cre_date" name='cre_date' style="padding:2px; width:174px;">
			    <option value=''>Select</option>
				<?php
				  if(isset($data)){
					  foreach($data as $dt=>$vals){
					
						?>
						<option value="<?php echo date('Y-m-d',strtotime($vals['created_at'])); ?>"><?php echo  date('d-m-Y',strtotime($vals['created_at'])); ?></option>
						<?php
					  }
				  }
				?>
		</select>
			  <?php 
	}
	
	public function target_dt(){
		 $class_no		=$this->input->post('class_code');
		 $subject_nam	=$this->input->post('subject_nam');
		 $cr_dat		=$this->input->post('cr_dat');
		 $data1 = $this->pawan->selectA('e_exam_questions_hw','*',"subject='$subject_nam' and classes='$class_no' and date(created_at)='$cr_dat'");
		 
		 ?>


		<select id="subject_nam" name='subject' style="padding:2px; width:174px;" onchange='section_sec(this.value)'>
			    <option value=''>Select</option>
				<?php
				  if(isset($data1)){
					  
					  foreach($data1 as $dt1=>$vals){
						  
						?>
						<option value="<?php echo $vals['submitDate']; ?>"><?php echo date('d-m-Y',strtotime($vals['submitDate'])); ?></option>
						<?php
					  }
				  }
				?>
		</select>
			  <?php 
	}
	
	public function target_dt1(){		
		  $class_no		=$this->input->post('class_code');
		 $subject_nam	=$this->input->post('subject_nam');
		 $cr_dat		=$this->input->post('cr_dat');
		 $t_date		=$this->input->post('t_date');
		 $hwid	=$this->pawan->selectA('e_exam_questions_hw','*',"classes='$class_no' AND  subject='$subject_nam' and submitDate='$t_date' and date(created_at)='$cr_dat'");
		
		$homwrkid	=$hwid[0]['id'];
	
	
	$report	=$this->pawan->selectA('`e_exam_questions_hw` ',"classes,sec,subject,(SELECT CLASS_NM from classes WHERE classes.Class_No=e_exam_questions_hw.classes)cls,(SELECT SECTION_NAME from sections WHERE sections.section_no=e_exam_questions_hw.sec)sectio,(SELECT SubName from subjects WHERE subjects.SubCode=e_exam_questions_hw.subject)sub,(SELECT COUNT(ADM_NO) from student WHERE student.CLASS=e_exam_questions_hw.classes AND student.SEC=e_exam_questions_hw.sec )no_stu,(SELECT COUNT(DISTINCT(admno)) FROM e_exam_answers_hw WHERE e_exam_answers_hw.class_no=e_exam_questions_hw.classes and e_exam_answers_hw.sec_no=e_exam_questions_hw.sec and e_exam_answers_hw.subj_id=e_exam_questions_hw.subject AND final_submit_status=1)constusubmit,(SELECT COUNT(DISTINCT(admno)) FROM e_exam_answers_hw WHERE e_exam_answers_hw.class_no=e_exam_questions_hw.classes and e_exam_answers_hw.sec_no=e_exam_questions_hw.sec and e_exam_answers_hw.subj_id=e_exam_questions_hw.subject AND teacher_final_copy_correction=2)conteacsubmit","`classes` = '$class_no' AND `subject` = '$subject_nam' and `submitDate` = '$t_date' and date(created_at) = '$cr_dat'");
	
		    ?>
<div class="panel panel-primary">
  <div class="panel-heading">Copy Correction Report</div>
  <div class="panel-body" style="background-color:white;">
    <div class="row">
      <div class="table-responsive">
        <table class='table'>
          <tr>            
            <td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Class</strong></td>
            <td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Section</strong></td>
            <td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Total no of Students in the Class</strong></td>
            <td style='background:#5785c3; color:#fff!important;border: 1px solid;border-right: 1px solid #d6cece;text-align:center'><strong>No. of Students seen or completing the Homework
</strong></td>
<td style='background:#5785c3; color:#fff!important;border: 1px solid;border-right: 1px solid #d6cece;text-align:center'><strong>No. of Student that submitted the HW</strong></td>
<td style='background:#5785c3; color:#fff!important;border: 1px solid;border-right: 1px solid #d6cece;text-align:center;'><strong>No. of HW Copies corrected by Teacher</strong></td>
          </tr>
		  <?php
		foreach($report as $keys=>$valss){  
		  
		  ?>
		  <tr>
		  <td style="border: 1px solid #d6cece;"><?=$valss['cls']?></td>
		  <td style="border: 1px solid #d6cece;"><?=$valss['sectio']?></td>
		  <td style="border: 1px solid #d6cece;"><?=$valss['sub']?></td>
		  <td style="border: 1px solid #d6cece;"><?=$valss['no_stu']?></td>
		  <td style="border: 1px solid #d6cece;"><?=$valss['constusubmit']?></td>
		  <td style="border: 1px solid #d6cece;"><?=$valss['conteacsubmit']?></td>
         </tr>
		 <?php  }?>
        </table>
      </div>
    </div>
  </div>
</div>
		 
<?php	}
	
	
	
	public function generateMarksReport(){
		 $classes	  = $this->input->post('classess1');
		 $section_id  = $this->input->post('section_id');		
		 $subject_nam  = $this->input->post('subject_nam');
		 $submitDate  = date('Y-m-d',strtotime($this->input->post('submition_dt')));
		 $created_at  = date('Y-m-d',strtotime($this->input->post('created_at')));
		 
		 
		
		$hwid	=$this->pawan->selectA('e_exam_questions_hw','*',"classes='$classes' AND sec='$section_id' AND subject='$subject_nam' and submitDate='$submitDate' and date(created_at)='$created_at'");
		$homwrkid	=$hwid[0]['id'];	
		 
		 
		 $data['stuList'] = $this->alam->selectA('e_exam_answers_hw','`admno`, `subj_id`, `class_no`, `sec_no`,target_date,homework_id,
(select FIRST_NM from student where ADM_NO=e_exam_answers_hw.admno)firstnm,
(select CLASS_NM from Classes where Class_No=e_exam_answers_hw.class_no)classnm,
(select SECTION_NAME from sections where section_no=e_exam_answers_hw.sec_no)secnm,
(select SubName from subjects where SubCode=e_exam_answers_hw.subj_id)subjnm,',"class_no='$classes' AND sec_no='$section_id' AND subj_id='$subject_nam' and homework_id='$homwrkid' and teacher_final_copy_correction='2' group by admno,subj_id,class_no,sec_no,firstnm,classnm,secnm,subjnm,target_date,homework_id");
		
		//echo $this->db->last_query();die;
		$this->load->view('e_exam/homework/loadMarksReport',$data);
		 
		$html = $this->output->get_output();
		 $this->load->library('pdf');
		 $this->dompdf->loadHtml($html);
		 $this->dompdf->setPaper('A4', 'potrait');
		 $this->dompdf->render();
		 $this->dompdf->stream("Homework_Copy.pdf", array("Attachment"=>0));
	}
}

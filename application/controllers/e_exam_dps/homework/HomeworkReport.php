<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeworkReport extends MY_controller{
	
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
			$array['class_no'] = $this->pawan->selectA('class_section_wise_subject_allocation','distinct(Class_no) as Class_No,(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)CLASS_NM',"Main_Teacher_Code='$user_id'");
			
		}									
        $this->render_template('e_exam/homework/homework_report',$array);		
	}
	
	public function Class_sec(){
		 $class_no	=$this->input->post('class_code');
		 $sec       = login_details['Section_No'];
		  $user_id   = login_details['user_id'];
		 $role_id            = login_details['ROLE_ID'];
		 if($role_id==1 || $role_id==4 || $role_id==5 || $role_id==6){
		  $data = $this->pawan->section_name_cwisw($class_no);
		 }else{
		 $data  = $this->pawan->selectA('class_section_wise_subject_allocation','distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm',"Main_Teacher_Code='$user_id' AND Class_No = '$class_no'");
			 
		 }		 
		 ?>


		<select id="section_id" name='section_id' style="padding:2px; width:174px;">
			    <option value=''>Select</option>
				 <?php
				  if(isset($data)){
					
		foreach($data as $key => $val){
			?>
				<option value='<?php echo $val['section_no']; ?>'><?php echo $val['secnm']; ?></option>
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
		  $user_id  = login_details['user_id'];
		 $role_id  = login_details['ROLE_ID'];
		 
		 if($role_id==1 || $role_id==4 || $role_id==5 || $role_id==6){
		$data1  = $this->pawan->selectA('class_section_wise_subject_allocation','distinct(subject_code),(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm'," Class_No = '$class_no' AND section_no = '$sec_no'");	
		}else{
		$data1  = $this->pawan->selectA('class_section_wise_subject_allocation','distinct(subject_code),(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm',"Main_Teacher_Code='$user_id' AND Class_No = '$class_no' AND section_no = '$sec_no'");
		} 
		 ?>


		<select id="subject_nam" name='subject' style="padding:2px; width:174px;" onchange='section_sec(this.value)'>
			    <option value=''>Select</option>
				<?php
				  if(isset($data1)){
					  
					    foreach($data1 as $key => $val){
			?>
				<option value='<?php echo $val['subject_code']; ?>'><?php echo $val['subjnm']; ?></option>
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
		   $homwok	=$this->pawan->selectA('e_exam_questions_hw','`classes`, `sec`, `subject`, `submitDate`, `created_at`, 
(select CLASS_NM from Classes where Class_No=e_exam_questions_hw.classes)classnm, (select SECTION_NAME from sections where section_no=e_exam_questions_hw.sec)secnm, (select SubName from subjects where SubCode=e_exam_questions_hw.subject)subjnm
 ',"classes='$class_no' and sec='$section_no' and subject='$subject_nam' order by submitDate asc");
		  ?>
<div class="panel panel-primary">
  <div class="panel-heading">Homework  List</div>
  <div class="panel-body" style="background-color:white;">
    <div class="row">
      <div class="table-responsive">
        <table class='table'>
          <tr>
            
            <td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Sl. No.</strong></td>
            <td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Homework Date</strong></td>
            <td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Submission date</strong></td>
            <td style='background:#5785c3; color:#fff!important;border: 1px solid;border-right: 1px solid #d6cece;text-align:center'><strong>Action</strong></td>
          </tr>
          <?php
		  $t=0;
				foreach($homwok as $qus=>$vals){
				?>
          <tr>
            
           
            <td style="border: 1px solid #d6cece;"><?=++$t;?></td>
            <td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;"><?=date('d-m-Y',strtotime($vals['created_at']));?></td>
			<td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;"><?=date('d-m-Y',strtotime($vals['submitDate']));?></td>
            <td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;text-align:center;" >
			<form method="post" action="<?=base_url('e_exam/homework/HomeworkReport/generateMarksReport');?>">
                <input type="hidden" name="classess1" value="<?=$vals['classes'];?>">
                <input type="hidden" name="section_id" value="<?=$vals['sec'];?>">
                <input type="hidden" name="subject_nam" value="<?=$vals['subject'];?>">
                <input type="hidden" name="created_at" value="<?=$vals['created_at'];?>">
				 <input type="hidden" name="submition_dt" value="<?=$vals['submitDate'];?>">
              <button type="submit" name="submit" class="btn btn-success">OPEN</button>
              </form></td>
          </tr>
          <?php } ?>
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

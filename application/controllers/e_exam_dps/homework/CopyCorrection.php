<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CopyCorrection extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Pawan','pawan');		
	}
	
	public function index(){
		
		$class              = login_details['Class_No'];
		$sec                = login_details['Section_No'];
		$user_id            = login_details['user_id'];
		$role_id            = login_details['ROLE_ID'];
		if($role_id==1 || $role_id==4 || $role_id==5 || $role_id==6){
		$array['class_no']   	= $this->pawan->selectA('classes','*');				
		}else{
			$array['class_no'] = $this->pawan->selectA('class_section_wise_subject_allocation','distinct(Class_no) as Class_No,(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)CLASS_NM',"Main_Teacher_Code='$user_id' and Class_No in (11,12)");
		}				
        $this->render_template('e_exam/homework/stulist',$array);
		
	}
	
	public function Class_sec(){
		 $user_id   = login_details['user_id'];
		 $class_no	= $this->input->post('class_code');
		 $sec       = login_details['Section_No'];
		 $role_id            = login_details['ROLE_ID'];
		 if($role_id==1 || $role_id==4 || $role_id==5 || $role_id==6){
		  $data  = $this->pawan->selectA('class_section_wise_subject_allocation','distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm'," Class_No = '$class_no'");
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
<select id="subject_nam" name='subject_nam' style="padding:2px; width:174px;" onchange="subject_ids(this.value)">
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
		
		  $homwok	=$this->pawan->selectA('e_exam_questions_hw',"`classes`, `sec`, `subject`, `submitDate`, `created_at`, 
(select CLASS_NM from Classes where Class_No=e_exam_questions_hw.classes)classnm, (select SECTION_NAME from sections where section_no=e_exam_questions_hw.sec)secnm, (select SubName from subjects where SubCode=e_exam_questions_hw.subject)subjnm,

(SELECT COUNT(ADM_NO) from student WHERE student.CLASS=e_exam_questions_hw.classes AND student.SEC=e_exam_questions_hw.sec AND student.Student_Status='ACTIVE' )no_stu,

(SELECT COUNT(DISTINCT(admno)) FROM e_exam_answers_hw WHERE e_exam_answers_hw.class_no=e_exam_questions_hw.classes and e_exam_answers_hw.sec_no=e_exam_questions_hw.sec and e_exam_answers_hw.subj_id=e_exam_questions_hw.subject AND final_submit_status=1)constusubmit,

(SELECT COUNT(DISTINCT(admno)) FROM e_exam_answers_hw WHERE e_exam_answers_hw.class_no=e_exam_questions_hw.classes and e_exam_answers_hw.sec_no=e_exam_questions_hw.sec and e_exam_answers_hw.subj_id=e_exam_questions_hw.subject AND teacher_final_copy_correction=2)conteacsubmit,
	
(SELECT COUNT(DISTINCT(admno)) FROM e_exam_answers_hw WHERE e_exam_answers_hw.class_no=e_exam_questions_hw.classes and e_exam_answers_hw.sec_no=e_exam_questions_hw.sec and e_exam_answers_hw.subj_id=e_exam_questions_hw.subject AND teacher_final_copy_correction<>2 and  final_submit_status=1)teachnotsubmit



 ","classes='$class_no' and sec='$section_no' and subject='$subject_nam' order by submitDate asc");
 
 $tr_teach_date	=	$this->pawan->selectA('misc_table','*');
 
		  ?>
<div class="panel panel-primary">
  <div class="panel-heading">Homework  List</div>
  <div class="panel-body" style="background-color:white;font-size:12px;">
    <div class="row">
      <div class="table-responsive">
        <table class='table'>
          <tr>
            
            <td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Sl. No.</strong></td>
            <td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Homework Date</strong></td>
            <td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Submission date</strong></td>
			<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>No. of Students in the Class</strong></td>
			 <td style='background:#5785c3; color:#fff!important;border: 1px solid;border-right: 1px solid #d6cece;text-align:center'><strong>No. of Students not submitted the Homework
</strong></td>
<td style='background:#5785c3; color:#fff!important;border: 1px solid;border-right: 1px solid #d6cece;text-align:center'><strong>No. of Student that submitted the Homework</strong></td>
<td style='background:#5785c3; color:#fff!important;border: 1px solid;border-right: 1px solid #d6cece;text-align:center;'><strong>No. of Homework Copies corrected by Teacher</strong></td>

<td style='background:#5785c3; color:#fff!important;border: 1px solid;border-right: 1px solid #d6cece;text-align:center;'><strong>No. of Homework Copies not corrected by Teacher</strong></td>
<td style='background:#5785c3; color:#fff!important;border: 1px solid;border-right: 1px solid #d6cece;text-align:center;'><strong>Copy Correction Last Date</strong></td>
            <td style='background:#5785c3; color:#fff!important;border: 1px solid;border-right: 1px solid #d6cece;text-align:center'><strong>Action</strong></td>
          </tr>
          <?php
		  $t=0;
				foreach($homwok as $qus=>$vals){
				$dts	= $vals['submitDate'];
				$days	=$tr_teach_date[0]['submission_target_date'];
				 $trdt	= date('Y-m-d', strtotime($dts. ' + '.$days.' days')); 
				 $fts	= date('Y-m-d');
				?>
          <tr>
            
           
            <td style="border: 1px solid #d6cece;"><?=++$t;?></td>
            <td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;"><?=date('d-m-Y',strtotime($vals['created_at']));?></td>
			<td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;"><?=date('d-m-Y',strtotime($vals['submitDate']));?></td>
			<td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;"> <?=$vals['no_stu'];?></td>
			<td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;"><?=$vals['no_stu']-$vals['constusubmit'];?></td>
			<td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;"><?=$vals['constusubmit'];?></td>
			<td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;"><?=$vals['conteacsubmit'];?></td>
			<td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;"><?=$vals['constusubmit']-$vals['conteacsubmit'];?></td>
			<td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;"><?=date('d-m-Y',strtotime($trdt));?></td>
            <td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;text-align:center;" >
			<form method="post" action="<?=base_url('e_exam/homework/CopyCorrection/stulist');?>">
                <input type="hidden" name="classess1" value="<?=$vals['classes'];?>">
                <input type="hidden" name="section_id" value="<?=$vals['sec'];?>">
                <input type="hidden" name="subject_nam" value="<?=$vals['subject'];?>">
                <input type="hidden" name="created_at" value="<?=$vals['created_at'];?>">
				<input type="hidden" name="submition_dt" value="<?=$vals['submitDate'];?>">
				<?php
								 
				 if($trdt<=$fts){
				echo	"<button type='submit'   name='submit' class='btn btn-danger btn-sm' disabled >Locked</button>";
				 }else{
				?>
               <button type="submit"  name="submit" class="btn btn-success btn-sm" >Display</button>
				 <?php } ?>
              </form></td>
          </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
</div>
<?php
		 
	}
	
	public function stulist(){		
		  $class_no			= $this->input->post('classess1');
		  $section_no		= $this->input->post('section_id');
		  $created_at		= date('Y-m-d',strtotime($this->input->post('created_at')));
		  $subject_nam		= $this->input->post('subject_nam');	
		  $submition_dt		= date('Y-m-d',strtotime($this->input->post('submition_dt')));
		// $data['Student_list']			= $this->pawan->student_List($class_no,$section_no,$subject_nam,$exam_date); 
		/*$data['Student_list']		= $this->pawan->selectA('student',"`ADM_NO`, `FIRST_NM`, `ROLL_NO`,(SELECT DISTINCT(admno) as adm FROM e_exam_answers_hw WHERE e_exam_answers_hw.admno=student.ADM_NO AND e_exam_answers_hw.subj_id='$subject_nam' AND date(e_exam_answers_hw.target_date)='$submition_dt' and final_submit_status=1)final_submit,(SELECT DISTINCT(admno) as adm FROM e_exam_answers_hw WHERE e_exam_answers_hw.admno=student.ADM_NO AND e_exam_answers_hw.subj_id='$subject_nam' AND date(e_exam_answers_hw.target_date)='$submition_dt' and updated_by!='')teche_remarks","`CLASS` = '$class_no' and `SEC` = '$section_no' ORDER BY ROLL_NO,FIRST_NM");*/
		$data['Student_list']	=$this->pawan->selectA('student','`ADM_NO`, `FIRST_NM`, `ROLL_NO`',"CLASS='$class_no' and SEC='$section_no' and student_status='ACTIVE' order by ROLL_NO");		
		$hwid	=$this->pawan->selectA('e_exam_questions_hw','*',"classes='$class_no' AND sec='$section_no' AND subject='$subject_nam' and submitDate='$submition_dt' and date(created_at)='$created_at'");
		$data['homwrkid']	=$hwid[0]['id'];	

		//echo $this->db->last_query();die;
		 $data['class_no']			= $class_no;
		 $data['section_no']		= $section_no;
		 $data['subject_nam']		= $subject_nam;
		 $data['submition_dt']		= $submition_dt;
		 $data['created_at']		= $created_at;
		 $this->render_template('e_exam/homework/stulist2',$data);
		
		 			
	}
	
	
	
	public function stulist1(){		
		  $class_no			= $this->input->post('classess1');
		  $section_no		= $this->input->post('section_id');
		  $created_at		= date('Y-m-d',strtotime($this->input->post('created_at')));
		  $subject_nam		= $this->input->post('subject_nam');
		  $submition_dt		= date('Y-m-d',strtotime($this->input->post('submition_dt')));
		  $selected_stu		= $this->input->post('selected_stu');
		  $h_id				= $this->input->post('homwrkid');
		  $cdatetime		= date('Y-m-d H:i:s');
		  $arr	=array(
		  'teacher_final_copy_correction'	=>'2',
		  'final_date_copy_correction'		=>$cdatetime,
		  );
		  $this->pawan->update('e_exam_answers_hw',$arr,"homework_id='$h_id' and admno='$selected_stu'");
		  
		
		$data['Student_list']	=$this->pawan->selectA('student','`ADM_NO`, `FIRST_NM`, `ROLL_NO`',"CLASS='$class_no' and SEC='$section_no' and student_status='ACTIVE' order by ROLL_NO");
		
		$hwid	=$this->pawan->selectA('e_exam_questions_hw','*',"classes='$class_no' AND sec='$section_no' AND subject='$subject_nam' and submitDate='$submition_dt' and date(created_at)='$created_at'");
		$data['homwrkid']	=$hwid[0]['id'];	

		//echo $this->db->last_query();die;
		 $data['class_no']			= $class_no;
		 $data['section_no']		= $section_no;
		 $data['subject_nam']		= $subject_nam;
		 $data['submition_dt']		= $submition_dt;
		 $data['created_at']		= $created_at;
		 $this->render_template('e_exam/homework/stulist2',$data);
		
		 			
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
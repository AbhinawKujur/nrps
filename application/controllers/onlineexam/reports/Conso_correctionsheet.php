<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conso_correctionsheet extends MY_controller{
	
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
			$array['class_no'] = $this->pawan->selectA('class_section_wise_subject_allocation','distinct(Class_no) as Class_No,(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)CLASS_NM',"Main_Teacher_Code='$user_id'");
		}				
        $this->render_template('onlineexam/reports/stulist',$array);		
	}
	
	public function Class_sec(){
		 $user_id   = login_details['user_id'];
		 $class_no	= $this->input->post('class_code');
		 $sec       = login_details['Section_No'];
		 $role_id   = login_details['ROLE_ID'];
		 if($role_id==1 || $role_id==4 || $role_id==5 || $role_id==6){
		  $data = $this->pawan->section_name_cwisw($class_no);
			
		 }else{			 
$data  = $this->db->query("select distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm from class_section_wise_subject_allocation where Main_Teacher_Code='$user_id' AND Class_No = '$class_no'")->result();
		 }		 
		
		 ?>

<select id="section_id" name='section_id' style="padding:2px; width:174px;">
  <option value=''>Select</option>
  <?php
				  if(isset($data)){
			foreach($data as $key => $val){
			?>
				<option value='<?php echo $val->section_no; ?>'><?php echo $val->secnm; ?></option>
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
		  $str_date			= $this->input->post('str_date');
		  $end_date		= $this->input->post('end_date');
		  
		
		  $copy_crrct	=$this->db->query("SELECT exam_date,onexm.id as schedul_id,onexm.class_id,onexm.sec_id,onexm.subject_id,(Select class_nm from classes where class_no=onexm.class_ID) as CLsnme,(Select SECTION_NAME from Sections where section_no=onexm.sec_id) as sectionm,(Select SubName from subjects where SubCode=onexm.subject_id) as subj_name,
		  (Select count(admno) from online_student_exam_list where class_id=onexm.class_ID and sec_id=onexm.sec_id and subj_id=onexm.subject_id and exam_schedule_id=onexm.id) as totstu,
		 
		 (Select count(distinct(admno)) from online_exam_answers where class_no=onexm.class_ID and sec_no=onexm.sec_id and subj_id=onexm.subject_id and exam_schedule_id=onexm.id and date(answered_date)=onexm.exam_date) as aprstu,
		  concat(onexm.start_time,'-',onexm.end_time)as exmtime,concat(onexm.exam_date,' ',onexm.end_time)as dttime,
		 
		 (SELECT COUNT(distinct(admno)) FROM `online_exam_answers` where teacher_final_copy_correction=2 AND exam_pattern=1 and exam_schedule_id=onexm.id and date(answered_date)=onexm.exam_date) tot_teacher_coprcrrn,
		 
		 (SELECT COUNT(distinct(admno)) FROM `online_exam_answers` where teacher_final_copy_correction in(0,1) AND exam_pattern=1  and exam_schedule_id=onexm.id) tot_teacher_not_coprcrrn  
		  
		  FROM `online_exam_schedule` as onexm where exam_date>='$str_date' AND exam_date<='$end_date' and onexm.display_status=1 order by exam_date asc,CLsnme asc, sectionm asc")->result();
//echo $this->db->last_query();die;
 $tr_teach_date	=	$this->db->query("select * from misc_table")->result();
 $schoolset	=$this->pawan->selectA('school_setting','*');
		  ?>

  <div class="panel-body" style="background-color:white;font-size:12px;">
	 <input type="button" value="Print" class="btn btn-success btn-sm" onclick="printDiv()"><br><br>
	  <div id="GFG">
    <div class="row">
      <div class="table-responsive">
		  
        <table class='table'>
			<tr>					
					<td style="background:#5785c3; color:#fff!important;border-left: 1px solid;border-bottom:1px solid"></td><td style="background:#5785c3; color:#fff!important;border-right: 1px solid;border-bottom:1px solid" colspan="9"><center style="font-size:17px"><strong><?=$schoolset[0]['School_Name'];?><br /><?=$schoolset[0]['School_Address'];?></strong><center></td>
					</tr>
				
				<tr>
					<td style="background:#5785c3; color:#fff!important;font-size:15px;border-left: 1px solid;border-bottom:1px solid" colspan="10">Exam Date : From <?php  echo date("d-m-Y", strtotime($str_date));  ?> To <?php  echo date("d-m-Y", strtotime($end_date));  ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Consolidated Copy Correction Sheet</b></td>
					
					</tr>
          <tr>            
            <td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Sl. No.</strong></td>
            <td style='background:#5785c3; color:#fff!important;border: 1px solid;width: 100px;'><strong>Exam Date</strong></td>
            <td style='background:#5785c3; color:#fff!important;border: 1px solid;width: 100px;'><strong>Exam Time</strong></td>
			  <td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Class</strong></td>
			  <td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Section</strong></td>
			  <td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Subject</strong></td>
			<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Total Students in the Class</strong></td>
			 <!--<td style='background:#5785c3; color:#fff!important;border: 1px solid;border-right: 1px solid #d6cece;text-align:center'><strong>No. of Students not appeared in the Exam
</strong></td>-->
<td style='background:#5785c3; color:#fff!important;border: 1px solid;border-right: 1px solid #d6cece;text-align:center'><strong>Total Students appeared</strong></td>
<!--<td style='background:#5785c3; color:#fff!important;border: 1px solid;border-right: 1px solid #d6cece;text-align:center;'><strong>No. of Exam Copies corrected by Teacher</strong></td>-->

<td style='background:#5785c3; color:#fff!important;border: 1px solid;border-right: 1px solid #d6cece;text-align:center;'><strong>Total Exam Copies Pending for Correction</strong></td>
<td style='background:#5785c3; color:#fff!important;border: 1px solid;border-right: 1px solid #d6cece;text-align:center;'><strong>Copy Correction Last Date</strong></td>
            
          </tr>
          <?php
		  $t=0;
				foreach($copy_crrct as $qus=>$vals){
				$dts	= $vals->exam_date;
					
					$timestamp = strtotime($dts);
 
//Convert it to DD-MM-YYYY
$dmy = date("d-m-Y", $timestamp);
				$tot = 	$vals->totstu;
				$app = 	$vals->aprstu;
					
				$nt_app = ($tot - $app);
				$days	=$tr_teach_date[0]->exam_copy_correction_targetdate;
				 $trdt	= date('Y-m-d', strtotime($dts. ' + '.$days.' days')); 
				 $fts	= date('Y-m-d');
				?>
          <tr>
            
           
            <td style="border: 1px solid #d6cece;"><?=++$t;?></td>
            <td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;"><?=$dmy?></td>			
			<td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;width: 100px;"> <?=$vals->exmtime;?></td>
			  <td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;"> <?=$vals->CLsnme;?></td>
			  <td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;text-align:center;"> <?=$vals->sectionm;?></td>
			  <td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;"> <?=$vals->subj_name;?></td>
			<td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;text-align:center;"><?=$vals->totstu;?></td>
			<!--<td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;"><?=$nt_app;?></td>-->
			<td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;text-align:center;"><?=$vals->aprstu;?></td>
			<!--<td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;"><?=$vals->aprstu-$vals->tot_teacher_coprcrrn;?></td>-->
			<td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;text-align:center;"><?=$vals->aprstu-$vals->tot_teacher_coprcrrn;?></td>
            <td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;text-align:center;" ><?=date('d-m-Y',strtotime($trdt));?>
			
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
		  $exam_datee		= $this->input->post('exam_datee');
		  $subject_nam		= $this->input->post('subject_nam');
		  $exam_schedule_id	= $this->input->post('exam_schedule_id');
		  $class_id			= $this->input->post('class_id');
		  $section_id		= $this->input->post('sec_id');
		  $subject_id		= $this->input->post('subject_id');
		  $arr['Student_list']	=$this->db->query("SELECT ADM_NO,FIRST_NM,ROLL_NO FROM student AS st INNER JOIN online_student_exam_list AS ose ON st.ADM_NO=ose.admno WHERE ose.class_id='$class_id' AND ose.sec_id='$section_id' AND exam_schedule_id='$exam_schedule_id' order by ROLL_NO asc")->result();

		 $arr['test']	=array(
		  'exam_datee'		=>$exam_datee,
		  'class_no'		=>$class_no,
		  'section_no'		=>$section_no,
		  'subject_nam'		=>$subject_nam,
		  'exam_schedule_id'=>$exam_schedule_id,
		  'class_id'		=>$class_id,
		  'section_id'		=>$section_id,
		  'subject_id'		=>$subject_id,
		  );
		
		 $this->render_template('onlineexam/exam_copy_correction/stulist2',$arr);
					
	}
	
	
	
	public function stulist1(){		
		  $class_no			= $this->input->post('classess1');
		  $section_no		= $this->input->post('section_id');
		  $exam_datee		= $this->input->post('exam_datee');
		  $subject_nam		= $this->input->post('subject_nam');
		  $exam_schedule_id	= $this->input->post('exam_schedule_id');
		  $class_id			= $this->input->post('class_id');
		  $section_id		= $this->input->post('sec_id');
		  $subject_id		= $this->input->post('subject_id');
		  $selected_stu		= $this->input->post('selected_stu');
		  $remarks			= $this->input->post('remarks');
		  $rem_com			= $this->input->post('rem_com');
		  $cdatetime		=date('Y-m-d H:i:s');
		
		  $user_id   = login_details['user_id'];
		  $arr_up	=array(
		   'comment'	=>$rem_com,
		   'remarks_id'	=>$remarks,
		  'teacher_final_copy_correction'	=>'2',
		  'final_date_copy_correction'		=>$cdatetime,
			 'updated_by'   => $user_id,
		  );
		 $this->pawan->update('online_exam_answers',$arr_up,"exam_schedule_id='$exam_schedule_id' and admno='$selected_stu'");
		
		$arr['Student_list']	=$this->db->query("SELECT ADM_NO,FIRST_NM,ROLL_NO FROM student AS st INNER JOIN online_student_exam_list AS ose ON st.ADM_NO=ose.admno WHERE ose.class_id='$class_id' AND ose.sec_id='$section_id' AND exam_schedule_id='$exam_schedule_id' order by ROLL_NO asc")->result();	

		//echo $this->db->last_query();die;
		 $arr['test']	=array(
		  'exam_datee'		=>$exam_datee,
		  'class_no'		=>$class_no,
		  'section_no'		=>$section_no,
		  'subject_nam'		=>$subject_nam,
		  'exam_schedule_id'=>$exam_schedule_id,
		  'class_id'		=>$class_id,
		  'section_id'		=>$section_id,
		  'subject_id'		=>$subject_id,
		  );
		
		 $this->render_template('onlineexam/exam_copy_correction/stulist2',$arr);
					
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
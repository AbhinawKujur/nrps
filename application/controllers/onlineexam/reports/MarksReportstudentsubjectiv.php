<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MarksReportstudentsubjectiv extends MY_controller{
	
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
										
        $this->render_template('onlineexam/reports/marks_report_student_subjectiv',$array);		
	}

/******************Class Section Dropdown----------------*/	
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
/********************Subject Name Class Wise ************/	
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
	
	/********************Subject Name Class Wise ************/	
	public function examDate(){		
		  $class_no			= $this->input->post('class_code');
		  $section_no		= $this->input->post('sec_no');
		  $subject_nam		= $this->input->post('subject_ids');
		  $exmdat			= $this->pawan->selectA('online_exam_schedule','distinct(exam_date)',"class_id='$class_no' and sec_id='$section_no' and subject_id='$subject_nam' ");

		  ?>
		  <select id="exam_date" name='exam_date' style="padding:2px; width:174px;" >
			    <option value=''>Select</option>
				<?php
				  if(!empty($exmdat)){
					  
					  foreach($exmdat as $key => $vals){
						  
						?>
						<option value="<?php echo $vals['exam_date']; ?>"><?php echo $vals['exam_date']; ?></option>
						<?php
					  }
				  }
				?>
		</select>
			  <?php
		 
	}
	
	public function generateMarksReport(){
		 $classes	  	= $this->input->post('classes');
		 $section_id  	= $this->input->post('section_id');
		 $subject	  	= $this->input->post('subject');
		 $sort_by	  	= $this->input->post('sort_by');
		 $exam_date		= date('Y-m-d',strtotime($this->input->post('exam_date')));
		
		if($sort_by==1){
		$sr	='ROLL_NO';
		}else{
		$sr	='FIRST_NM';
		}
		//echo $sr;die;
		 $exam_date	= $exam_date;
		 $cls	=$this->pawan->selectA('classes','CLASS_NM',"Class_No='$classes'");
		 $classess	=	$cls[0]['CLASS_NM'];
		 $sec	=$this->pawan->selectA('sections','SECTION_NAME',"section_no='$section_id'");
		  $section	=	$sec[0]['SECTION_NAME'];
		 $sub	=$this->pawan->selectA('subjects','SubName',"SubCode='$subject'");
		 $Sujects	=	$sub[0]['SubName'];
		 $exam_shedule	=	$this->pawan->selectA('online_exam_schedule','id',"class_id='$classes' and sec_id='$section_id' and subject_id='$subject' and exam_date='$exam_date'");
		//echo $this->db->last_query();
		 $exam_schedule_id= $exam_shedule[0]['id'];
		 $marks_max	=	$this->pawan->selectA('online_exam_question','sum(marks) as mark',"schedule_id='$exam_schedule_id' and exam_ptern_id=1");
		 $stuList	= $this->db->query("SELECT ADM_NO,FIRST_NM,ROLL_NO,(SELECT COUNT(id) FROM online_exam_question WHERE schedule_id=ose.exam_schedule_id) AS totalquestion, 
		 (SELECT COUNT(id) FROM online_exam_question WHERE schedule_id=ose.exam_schedule_id and exam_ptern_id=1) AS totalsubjective, 
(SELECT COUNT(id) FROM online_exam_answers WHERE exam_schedule_id=ose.exam_schedule_id AND admno=st.ADM_NO and exam_pattern=1) AS totalattampt,
(SELECT sum(stu_marks) FROM online_exam_answers WHERE exam_schedule_id=ose.exam_schedule_id AND admno=st.ADM_NO and  exam_pattern=1 and teacher_final_copy_correction='2') AS student_marks FROM student AS st INNER JOIN online_student_exam_list AS ose ON st.ADM_NO=ose.admno WHERE ose.class_id='$classes' AND ose.sec_id='$section_id' AND exam_schedule_id='$exam_schedule_id'  order by $sr")->result();		 
	//echo $this->db->last_query();
		
   $schoolset	=$this->pawan->selectA('school_setting','*');
	?>
		<input type="button" value="Print" class="btn btn-success btn-sm" onclick="printDiv()">&nbsp;&nbsp;<button id="myButton" class="btn btn-success btn-sm" >Excel</button><br><br>
		<div id="GFG">
			<span style='color:red'>NOTE</span>:<span style='background-color:#e8c4c4'>&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;Shows Student Not Appeared.<br>
		<table class='table table2excel' width="100%" cellspacing="0" style='font-family: verdana;'>
			<tr>					
					<td style="background:#5785c3; color:#fff!important;border-left: 1px solid;border-bottom:1px solid"></td><td style="background:#5785c3; color:#fff!important;border-right: 1px solid;border-bottom:1px solid" colspan="8"><center style="font-size:17px"><strong><?=$schoolset[0]['School_Name'];?><br /><?=$schoolset[0]['School_Address'];?></strong><center></td>
					</tr>
					<tr>					
					<td style="background:#5785c3; color:#fff!important;border-left: 1px solid;border-bottom:1px solid" colspan="3">Class : <?=$classess;?>-<?=$section;?>&nbsp;&nbsp;</td>
					<td style="background:#5785c3; color:#fff!important;border-bottom:1px solid;text-align:center" colspan='2'>
					<?=$Sujects;?></td>
					<td style="background:#5785c3; color:#fff!important;border-right: 1px solid;border-bottom:1px solid;"  colspan='4'><span style="float: right;">Exam Date:&nbsp;<?=date('d-M-Y',strtotime($exam_date));?></span>
					</td>
					</tr>
				<tr style="font-size: 12px;">					
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;width: 80px;'><strong>Sl. No.</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;width: 80px;'><strong>Roll No.</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;width: 80px;'><strong>Reg. No.</strong></td>				
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Name of Student</strong></td>
					<!--<td style='background:#5785c3; color:#fff!important;border: 1px solid;width:100px;'><strong>Total Question</strong></td>--><td style='background:#5785c3; color:#fff!important;border: 1px solid;width:100px;'><strong>Total Question</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;width:100px;'><strong>Total Attempt</strong></td>
					<!--<td style='background:#5785c3; color:#fff!important;border: 1px solid;width:100px;'><strong>Total Correct</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Total Incorrect</strong></td>-->
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;width:150px;'><strong>Marks Obtained <span style='color:#9c0707d6'>(Max-Marks:<?=$marks_max[0]['mark']?>)</span></strong></td>
					
				</tr>
				<?php
				$c=0;
		
				foreach($stuList as $key=>$val){
				?>
				<tr <?php if($val->totalattampt==0){?> style='background:#e8c4c4' <?php }else{}?>>				
				<td style="border: 1px solid ;"><?=++$c;?></td>
				<td style="border: 1px solid ;"><?=$val->ROLL_NO;?></td>
				<td style="border: 1px solid ;"><?=$val->ADM_NO;?></td>				
				<td style="border: 1px solid ;"><?=$val->FIRST_NM;?></td>
				<!--<td style="border: 1px solid ;text-align: center;"><?=$val->totalquestion;?></td>-->
				<td style="border: 1px solid ;text-align: center;"><?=$val->totalsubjective;?></td>
				<td style="border: 1px solid ;text-align: center;"><?=$val->totalattampt;?></td>
				<!--<td style="border: 1px solid ;text-align: center;"><?=$val->totalcorrect;?></td>
				<td style="border: 1px solid ;text-align: center;"><?=$val->totalincorrect;?></td>-->
				<td style="border: 1px solid ;text-align: center;"><?=$val->student_marks;?></td>
				</tr>
	<?php	}?>
</table>
<script>
	
	$(document).ready(function(e) {				
				$("#myButton").click(function(e){
					$(".table2excel").table2excel({
						exclude: ".noExl",
						name: "Excel Document Name",
						filename: "marksobjective",
						fileext: ".xls",
						exclude_img: true,
						exclude_links: true,
						exclude_inputs: true
					});
				});
			});
			
    </script> 
  
</div> 
		
<?php		
		
		
	}
}

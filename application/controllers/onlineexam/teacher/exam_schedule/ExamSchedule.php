<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExamSchedule extends MY_controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Alam','alam');
	}
	public function index(){
		$ROLE_ID = login_details['ROLE_ID'];
		$user_id = login_details['user_id'];
		
		if($ROLE_ID == 2){
			$data['classData'] = $this->alam->selectA('class_section_wise_subject_allocation','distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm',"Main_Teacher_Code='$user_id' order by Class_no");
		}else{
			$data['classData'] = $this->alam->selectA('class_section_wise_subject_allocation','distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm',"1='1' order by Class_no");
		}
		$data['examMaster'] = $this->alam->selectA('online_exam_master','*');
		$data['exam_pattern'] = $this->alam_custom->online_exam_pattern();
		
		$this->render_template('onlineexam/teacher/exam_schedule/examSchedule',$data);
	}
	
	public function loadSec(){
		$class_id = $this->input->post('class_id');
		$secData  = $this->alam->selectA('class_section_wise_subject_allocation','distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm',"Class_No='$class_id'");
		?>
			<option value=''>Select</option>
		<?php
		foreach($secData as $key => $val){
			?>
				<option value='<?php echo $val['section_no']; ?>'><?php echo $val['secnm']; ?></option>
			<?php
		}
	}
	
	public function loadSubj(){
		$cls = $this->input->post('cls');
		$sec = $this->input->post('sec');
		
		$secData  = $this->alam->selectA('class_section_wise_subject_allocation','distinct(subject_code),(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm',"Class_No = '$cls' AND section_no = '$sec'");
		
		?>
			<option value=''>Select</option>
		<?php
		foreach($secData as $key => $val){
			?>
				<option value='<?php echo $val['subject_code']; ?>'><?php echo $val['subjnm']; ?></option>
			<?php
		}
	}
	
	public function viewStuList(){
		$cls = $this->input->post('cls');
		$sec = $this->input->post('section');
		
		$data['stuData'] = $this->alam->selectA('student','ADM_NO,FIRST_NM,DISP_CLASS,DISP_SEC,ROLL_NO',"Student_Status = 'ACTIVE' AND CLASS = '$cls' AND SEC = '$sec' ORDER BY ROLL_NO");
		$this->load->view('onlineexam/teacher/exam_schedule/examScheduleStuListModal',$data);
	}
	
	public function examScheduleSave(){
		$exam          = $this->input->post('exam');
		$class         = $this->input->post('class');
		$section       = $this->input->post('section');
		$subject       = $this->input->post('subject');
		$exam_pattern  = $this->input->post('exam_pattern');
		$exam_date     = date('Y-m-d',strtotime($this->input->post('exam_date')));
		$start_time    = date('H:i:s',strtotime($this->input->post('start_time')));
		$end_time      = date('H:i:s',strtotime($this->input->post('end_time')));
		$exam_duration = $this->input->post('exam_duration');
		$max_marks     = $this->input->post('max_marks');
		$max_questions = $this->input->post('max_questions');
		$conduct_all   = $this->input->post('conduct_all');
		$user_id       = login_details['user_id'];
		
		$chkExstData = $this->alam->selectA('online_exam_schedule','count(*)cnt',"class_id='$class' AND sec_id='$section' AND exam_date='$exam_date' and end_time BETWEEN convert('$start_time',time) and convert('$end_time',time)");
		
		$cnt = $chkExstData[0]['cnt'];
		
		$saveSchedule = array(
			'exam_id'            => $exam,
			'class_id'           => $class,
			'sec_id'             => $section,
			'subject_id' 		 => $subject,
			'exam_pattern' 		 => $exam_pattern,
			'exam_date'			 => $exam_date,
			'start_time' 		 => $start_time,
			'end_time' 			 => $end_time,
			'duration'           => $exam_duration,
			'max_marks'          => $max_marks,
			'max_question'       => $max_questions,
			'conduct_stu_status' => $conduct_all,
			'created_by'         => $user_id
		);
		
		if($cnt == 0){
			$this->alam->insert('online_exam_schedule',$saveSchedule);
			echo 1; //insert data
		}else{
			echo 2; //exist data
			die;
		}
		$last_id = $this->db->insert_id();
		
		if($conduct_all == 0){ //save all students 
			$stuData = $this->alam->selectA('student','ADM_NO,FIRST_NM,C_MOBILE,DISP_CLASS,DISP_SEC,Student_Status',"Student_Status='ACTIVE' AND CLASS='$class' AND SEC='$section'");
			foreach($stuData as $key => $val){
				$saveStudent = array(
					'exam_master_id'   => $exam,
					'exam_schedule_id' => $last_id,
					'class_id'         => $class,
					'sec_id' 		   => $section,
					'subj_id' 		   => $subject,
					'admno'			   => $val['ADM_NO']
				);
				$this->alam->insert('online_student_exam_list',$saveStudent);	
			}
		}else{ //save particular students
			$admno = $this->input->post('admno[]');
			foreach($admno as $key => $val){
				$saveStudent = array(
					'exam_master_id'   => $exam,
					'exam_schedule_id' => $last_id,
					'class_id'         => $class,
					'sec_id' 		   => $section,
					'subj_id' 		   => $subject,
					'admno'			   => $val
				);
				$this->alam->insert('online_student_exam_list',$saveStudent);	
			}
		}
	}
	
	public function getScheduleData(){
		$class         = $this->input->post('cls');
		$section       = $this->input->post('sec');
		$subject       = $this->input->post('subj');
		
		$data['getData'] = $this->alam->selectA('online_exam_schedule','*,(select SubName from subjects where SubCode=online_exam_schedule.subject_id)subjnm',"class_id='$class' AND sec_id='$section' AND subject_id='$subject' order by date(exam_date)");
		$data['exam_pattern'] = $this->alam_custom->online_exam_pattern();
		$this->load->view('onlineexam/teacher/exam_schedule/examScheduleList',$data);
	}
	
	public function displayStatus(){
		$id       = $this->input->post('id');
		$chkbox   = $this->input->post('chkbox');
		
		$save = array(
			'display_status' => $chkbox
		);
		
		$this->alam->update('online_exam_schedule',$save,"id='$id'");
		if($chkbox == 1){
			echo "Exam Enabled Successfully..!";
		}else{
			echo "Exam Disabled Successfully..!";
		}
	}
	
	public function viewScheduledStuList(){
		$id = $this->input->post('id');
		$stuData = $this->alam->selectA('online_student_exam_list','admno,(select FIRST_NM from student where ADM_NO=online_student_exam_list.admno)FIRST_NM,(select ROLL_NO from student where ADM_NO=online_student_exam_list.admno)ROLL_NO,',"exam_schedule_id='$id' order by ROLL_NO");
		?>
			<table class='table' id='tbl2'>
				<thead>
					<tr>
						<th style='background:#337ab7; color:#fff !important;'>Adm. No.</th>
						<th style='background:#337ab7; color:#fff !important;'>Student Name</th>
						<th style='background:#337ab7; color:#fff !important;'>Roll No.</th>
					</tr>
				</thead>
				<tbody>
						<?php
							if(!empty($stuData)){
								foreach($stuData as $key => $val){
									?>
										<tr>
											<td><?php echo $val['admno']; ?></td>
											<td><?php echo $val['FIRST_NM']; ?></td>
											<td><?php echo $val['ROLL_NO']; ?></td>
										</tr>
									<?php
								}
							}
						?>
				</tbody>
			</table>
			<script>
				$('#tbl2').DataTable({	
				  'paging'      : false,
				  'lengthChange': false,
				  'searching'   : true,
				  'ordering'    : false,
				  'info'        : true,
				  'autoWidth'   : true,
				  aaSorting: [[0, 'asc']]
				})
			</script>
		<?php
	}
	
	/*****************Open Model**********************/	
	public function viewModal(){
		 $ids			=$this->input->post('id');
		 $question_list	=$this->alam->selectA('online_exam_question','*',"schedule_id='$ids'");
		 ?>
		 <div class="row">
			<div class="table-responsive">
			<table class='table'>
			<thead>
				<tr>
					<th style='background:#337ab7; color:#fff !important; width:50px;'>Sl.No.</th>
					<th style='background:#337ab7; color:#fff !important;'>Question</th>
					<th style='background:#337ab7; color:#fff !important;width:100px;'>Answer Key</th>
					<th style='background:#337ab7; color:#fff !important;width:100px;'>Marks</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$c=0;
			foreach($question_list as $key=>$vals){
			
			?>
				<tr>
				<td style="border: 1px solid #bbb0b0;"><?=++$c;?></td>
				<td style="border: 1px solid #bbb0b0;"><strong><?=$vals['question'];?></strong>
				<?php
				if($vals['obj_no_option']>0){
				if($vals['obj_no_option']==2){
				echo '<p>A.&nbsp;'.$vals['option_1'].'</p>';
				echo '<p>B.&nbsp;'.$vals['option_2'].'</p>';
				}elseif($vals['obj_no_option']==4){
				echo '<p>A.&nbsp;'.$vals['option_1'].'</p>';
				echo '<p>B.&nbsp;'.$vals['option_2'].'</p>';
				echo '<p>C.&nbsp;'.$vals['option_3'].'</p>';
				echo '<p>D.&nbsp;'.$vals['option_4'].'</p>';
				
				}else{
				echo '<p>A.&nbsp;'.$vals['option_1'].'</p>';
				echo '<p>B.&nbsp;'.$vals['option_2'].'</p>';
				echo '<p>C.&nbsp;'.$vals['option_3'].'</p>';
				echo '<p>D.&nbsp;'.$vals['option_4'].'</p>';
				echo '<p>E.&nbsp;'.$vals['option_5'].'</p>';
				}
				}
				?>
				</td>
				<td style="border: 1px solid #bbb0b0;"><?=$vals['ans_key'];?></td>
				<td style="border: 1px solid #bbb0b0;"><?=$vals['marks'];?></td>
				
				</tr>
				<?php }?>
			</tbody>
			</table>
			</div>
			</div>
			<?php
	}
	
	
/***************************End*****************/	
}
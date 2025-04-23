<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CopyQuestions extends MY_controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Alam','alam');
	}
	public function index($schedule_id){
		$ROLE_ID = login_details['ROLE_ID'];
		$user_id = login_details['user_id'];
		
		$data['schedule']=$this->db->query("SELECT online_exam_schedule.*,cls.CLASS_NM,sec.SECTION_NAME,sub.SubName,oem.exam_name FROM online_exam_schedule INNER JOIN classes cls ON online_exam_schedule.class_id=cls.Class_No INNER JOIN sections sec ON online_exam_schedule.sec_id=sec.section_no INNER JOIN subjects sub ON online_exam_schedule.subject_id=sub.SubCode INNER JOIN online_exam_master oem on online_exam_schedule.exam_id=oem.id WHERE online_exam_schedule.id='$schedule_id'")->result_array();				
		$clsid   =	$data['schedule'][0]['class_id'];
		$secid	 =	$data['schedule'][0]['sec_id'];
		$sched_id=	$data['schedule'][0]['id'];	
		
		$data['section']=$this->db->query("select distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm from class_section_wise_subject_allocation where  Class_No = '$clsid' and section_no not in ('$secid')")->result_array();
		//echo $this->db->last_query();
		$data['question_data']=$this->db->query("select * from online_exam_question where schedule_id='sched_id'")->result_array();	
			
		$this->render_template('onlineexam/teacher/addquestion/copyQuestions',$data);
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
		 $section       = $this->input->post('section[]');
		 $subject       = $this->input->post('subject');
		 $exam_pattern  = $this->input->post('exam_pattern');
		 $exam_date     = date('Y-m-d',strtotime($this->input->post('exam_date')));
		 $start_time    = date('H:i:s',strtotime($this->input->post('start_time')));
		 $end_time      = date('H:i:s',strtotime($this->input->post('end_time')));
		 $exam_duration = $this->input->post('exam_duration');
		 $max_marks     = $this->input->post('max_marks');
		 $max_questions = $this->input->post('max_questions');
		 $conduct_all   = $this->input->post('conduct_all');
		 $schedulid		= $this->input->post('schedulid');
		 $user_id       = login_details['user_id'];
		 
		 foreach($section as $key=>$vals){
		 /*************Save Schedule***********************/
		 	$chkExstData = $this->alam->selectA('online_exam_schedule','count(*)cnt',"class_id='$class' AND sec_id='$vals' AND exam_date='$exam_date' and end_time BETWEEN convert('$start_time',time) and convert('$end_time',time)");
		
			$cnt = $chkExstData[0]['cnt'];
			
			$saveSchedule = array(
				'exam_id'            => $exam,
				'class_id'           => $class,
				'sec_id'             => $vals,
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
				$this->alam->insert('online_exam_schedule',$saveSchedule);
				
				$last_id = $this->db->insert_id();
				/*************Save STUDENT ID***********************/
				if($conduct_all == 0){ //save all students 
			$stuData = $this->alam->selectA('student','ADM_NO,FIRST_NM,C_MOBILE,DISP_CLASS,DISP_SEC,Student_Status',"Student_Status='ACTIVE' AND CLASS='$class' AND SEC='$vals'");
			foreach($stuData as $key => $val){
				$saveStudent = array(
					'exam_master_id'   => $exam,
					'exam_schedule_id' => $last_id,
					'class_id'         => $class,
					'sec_id' 		   => $vals,
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
					'sec_id' 		   => $vals,
					'subj_id' 		   => $subject,
					'admno'			   => $val
				);
				$this->alam->insert('online_student_exam_list',$saveStudent);	
			}
		}
		/*************Save QUESTION***********************/
			$stuquestion = $this->alam->selectA('online_exam_question','exam_ptern_id,qus_no,question,marks,obj_no_option,option_1,option_2,option_3,option_4,option_5,option_img_1,option_img_2,option_img_3,option_img_4,option_img_5,ans_key',"schedule_id='$schedulid'");
			foreach($stuquestion as $key => $val){
			$schedule	= $last_id;
			$qustion	= $val['question'];
			$marks		= $val['marks'];
			$exam_pt	= (!empty($val['exam_ptern_id']))?$val['exam_ptern_id']:'';
			$no_option	= (!empty($val['obj_no_option']))?$val['obj_no_option']:'';
			$opt1		= (!empty($val['option_1']))?$val['option_1']:'';
			$opt2		= (!empty($val['option_2']))?$val['option_2']:'';
			$opt3		= (!empty($val['option_3']))?$val['option_3']:'';
			$opt4		= (!empty($val['option_4']))?$val['option_4']:'';
			$opt5		= (!empty($val['option_5']))?$val['option_5']:'';
			$option_img_1		= (!empty($val['option_img_1']))?$val['option_img_1']:'';
			$option_img_2		= (!empty($val['option_img_2']))?$val['option_img_2']:'';
			$option_img_3		= (!empty($val['option_img_3']))?$val['option_img_3']:'';
			$option_img_4		= (!empty($val['option_img_4']))?$val['option_img_4']:'';
			$option_img_5		= (!empty($val['option_img_5']))?$val['option_img_5']:'';
			$ans_key	= (!empty($val['ans_key']))?$val['ans_key']:'';
			
			$savequs	=array(
					'schedule_id'	=> $schedule,
					'exam_ptern_id'	=> $exam_pt,
					'qus_no'		=> $key+1,
					'question'		=> $qustion,
					'marks'			=> $marks,
					'obj_no_option'	=> $no_option,
					'option_1'		=> $opt1,
					'option_2'		=> $opt2,
					'option_3'		=> $opt3,
					'option_4'		=> $opt4,
					'option_5'		=> $opt5,
					'option_img_1'	=> $option_img_1,
					'option_img_2'	=> $option_img_2,
					'option_img_3'	=> $option_img_3,
					'option_img_4'	=> $option_img_4,
					'option_img_5'	=> $option_img_5,
					'ans_key'		=> $ans_key,
					'created_by'	=> $user_id,
					'created_on'	=> date('Y-m-d H:i:s'),
				);
				
			$this->alam->insert('online_exam_question',$savequs);
			
			$filepath2='online_exam/'.$schedule.'/question';
			$filepath='online_exam/'.$schedule;
			if(!is_dir($filepath)){
			 mkdir($filepath, 0755);
			 mkdir($filepath2, 0755);
			}
		//echo	$this->db->last_query();
			}
				
		 }
		$t=1;
	}
	
	
}
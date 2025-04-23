<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddQuestions extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){

		if(!in_array('viewHomework', permission_data)){
			redirect('payroll/dashboard/dashboard');
		}
        
		$class              = login_details['Class_No'];
		$sec                = login_details['Section_No'];
		$user_id            = login_details['user_id'];
		
		$data['e_exam_questions'] = $this->alam->selectA('e_exam_questions','classes,sec,subject,exam_display_status,(select CLASS_NM from classes where Class_No=e_exam_questions.classes)classnm, (select SECTION_NAME from sections where section_no=e_exam_questions.sec)secnm, (select SubName from subjects where SubCode=e_exam_questions.subject)subjnm,examDate,examTime,examTimeDuration',"1='1' AND empid='$user_id' GROUP BY classes,sec,subject,classnm,secnm,subjnm,examDate,examTime,examTimeDuration,exam_display_status");
		
		$data['classData'] = $this->alam->selectA('class_section_wise_subject_allocation','distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm',"Main_Teacher_Code='$user_id'");
		$this->render_template('e_exam/addQuestions',$data);
	}
	
	public function loadSec(){
		$user_id  = login_details['user_id'];
		$class_id = $this->input->post('class_id');
		$secData  = $this->alam->selectA('class_section_wise_subject_allocation','distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm',"Main_Teacher_Code='$user_id' AND Class_No = '$class_id'");
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
		$user_id  = login_details['user_id'];
		$cls      = $this->input->post('cls');
		$sec_id   = $this->input->post('sec_id');
		
		$secData  = $this->alam->selectA('class_section_wise_subject_allocation','distinct(subject_code),(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm',"Main_Teacher_Code='$user_id' AND Class_No = '$cls' AND section_no = '$sec_id'");
		?>
			<option value=''>Select</option>
		<?php
		foreach($secData as $key => $val){
			?>
				<option value='<?php echo $val['subject_code']; ?>'><?php echo $val['subjnm']; ?></option>
			<?php
		}
	}
	
	public function saveQuestion(){
		$que = $this->input->post('question[]');
		foreach($que as $key => $val){
			$que_no = $key+1;
			if(!empty($_FILES['img']['name'][$key])){
				$image              = $_FILES['img']['name'][$key]; 
				$expimage           = explode('.',$image);
				$count              = count($expimage);
				$image_ext          = $expimage[$count-1];
				$image_name         = strtotime('now'). mt_rand() .'.'.$image_ext;
				$imagepath          = "uploads/e_exam_img/".$image_name;
					
			move_uploaded_file($_FILES["img"]["tmp_name"][$key],$imagepath);
			}else{
				$imagepath  = '';
			}
			
			$saveData = array(
				'classes'          => $this->input->post('class'),
				'sec'              => $this->input->post('sec'),
				'subject'          => $this->input->post('subject'),
				'question_type'    => $this->input->post('question_type')[$key],
				'que_no'           => $que_no,
				'question'         => $val,
				'que_img'          => $imagepath,
				'max_marks'        => $this->input->post('max_marks')[$key],
				'examDate'         => $this->input->post('examDate'),
				'examTime'         => $this->input->post('examTime'),
				'examTimeDuration' => $this->input->post('examTimeDuration'),
				'empid'            => login_details['user_id']
			);
			
			$this->alam->insert('e_exam_questions',$saveData);
		}
	}
	
	public function edit(){
		$id = $this->input->post('id');
		$data['masterTopicData'] = $this->alam->selectA('e_exam_questions','*,(select CLASS_NM from classes where Class_No=e_exam_questions.classes)classnm,(select SECTION_NAME from sections where section_no=e_exam_questions.sec)secnm,(select SubName from subjects where SubCode=e_exam_questions.subject)subjnm',"id='$id'");
		$this->load->view('e_exam/loadAddQuestionsEdit',$data);
	}
	
	public function updMaster(){
		$id = $this->input->post('id');
		$saveData = array(
			'chapter' => $this->input->post('chapter'),
			'topic'   => serialize($this->input->post('topic'))
		);
		$this->alam->update('e_exam_questions',$saveData,"id='$id'");
		$this->load->view('e_exam/loadAddQuestions');
	}
	
	public function insertValidation(){
		$cls      = $this->input->post('cls');
		$section  = $this->input->post('section');
		//$subj     = $this->input->post('subj');
		$examDate = date('d-M-Y',strtotime($this->input->post('examDate')));
		
		$chkData = $this->alam->selectA('e_exam_questions','count(*)cnt',"classes='$cls' AND sec='$section' AND examDate='$examDate'");
		$cnt = $chkData[0]['cnt'];
		
		if($cnt == 0){
			echo 1;
		}else{
			echo 0;
		}
	}
	
	public function viewModal(){
		$cls      = $this->input->post('cls');
		$sec      = $this->input->post('sec');
		$subject  = $this->input->post('subject');
		$examDate = $this->input->post('examDate');
		$examTime = $this->input->post('examTime');
		
		$data['getData'] = $this->alam->selectA('e_exam_questions','*',"classes='$cls' AND sec='$sec' AND subject='$subject' AND examDate='$examDate' AND examTime='$examTime'");
		
		$this->load->view('e_exam/load_question_modal',$data);
	}
	
	public function viewExamStatus(){
		$cls      = $this->input->post('cls');
		$sec      = $this->input->post('sec');
		$subject  = $this->input->post('subject');
		$examDate = $this->input->post('examDate');
		$chkbox   = $this->input->post('chkbox');
		
		$save = array(
			'exam_display_status' => $chkbox
		);
		
		$this->alam->update('e_exam_questions',$save,"classes='$cls' AND sec='$sec' AND subject='$subject' AND examDate='$examDate'");
		if($chkbox == 1){
			echo "Exam Enabled Successfully..!";
		}else{
			echo "Exam Disabled Successfully..!";
		}
	}
}

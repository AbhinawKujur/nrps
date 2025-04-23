<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TopicChapterMaster extends MY_Controller {
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
		
		$data['chapterTopicMaster'] = $this->alam->selectA('chaptertopicmaster','*,(select CLASS_NM from classes where Class_No=chaptertopicmaster.classes)classnm,(select SECTION_NAME from sections where section_no=chaptertopicmaster.sec)secnm,(select SubName from subjects where SubCode=chaptertopicmaster.subject)subjnm',"status='1' order by id desc");
		$data['classData'] = $this->alam->selectA('class_section_wise_subject_allocation','distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm',"Main_Teacher_Code='$user_id'");
		$this->render_template('e_learning/topicChapterMaster',$data);
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
			<option select=''>Select</option>
		<?php
		foreach($secData as $key => $val){
			?>
				<option value='<?php echo $val['subject_code']; ?>'><?php echo $val['subjnm']; ?></option>
			<?php
		}
	}
	
	public function saveMaster(){
		$saveData = array(
			'classes' => $this->input->post('class'),
			'sec'     => $this->input->post('sec'),
			'subject' => $this->input->post('subject'),
			'chapter' => $this->input->post('chapter'),
			'topic'   => serialize($this->input->post('topic[]'))
		);
		$this->alam->insert('chaptertopicmaster',$saveData);
		$this->load->view('e_learning/loadChapterTopicMaster');
	}
	
	public function edit(){
		$id = $this->input->post('id');
		$data['masterTopicData'] = $this->alam->selectA('chaptertopicmaster','*,(select CLASS_NM from classes where Class_No=chaptertopicmaster.classes)classnm,(select SECTION_NAME from sections where section_no=chaptertopicmaster.sec)secnm,(select SubName from subjects where SubCode=chaptertopicmaster.subject)subjnm',"id='$id'");
		$this->load->view('e_learning/loadChapterTopicMasterEdit',$data);
	}
	
	public function updMaster(){
		$id = $this->input->post('id');
		$saveData = array(
			'chapter' => $this->input->post('chapter'),
			'topic'   => serialize($this->input->post('topic'))
		);
		$this->alam->update('chaptertopicmaster',$saveData,"id='$id'");
		$this->load->view('e_learning/loadChapterTopicMaster');
	}
}

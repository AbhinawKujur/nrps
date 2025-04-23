<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeworkStatus extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
		$this->load->model('Notice_Model','nm');
	}
	
	public function index(){

		if(!in_array('viewHomework', permission_data)){
			redirect('payroll/dashboard/dashboard');
		}
        
		$class              = login_details['Class_No'];
		$sec                = login_details['Section_No'];
		$user_id            = login_details['user_id'];
		$data['clasa_no']   = login_details['Class_No'];
		$data['sec_no']     = login_details['Section_No'];
		$data['login_id']   = login_details['user_id'];
		$data['date']       = date('Y-m-d');
		$data['stuData']    = $this->alam->selectA('student','STUDENTID,ADM_NO,FIRST_NM',"CLASS='$class' AND SEC='$sec'");
		
		$data['subjData']    = $this->alam->selectA('class_section_wise_subject_allocation','Class_No,section_no,subject_code,(SELECT SubName FROM subjects WHERE SubCode=class_section_wise_subject_allocation.subject_code)subject',"Class_No='$class' AND section_no='$sec' and applicable_exam = '1' AND Main_Teacher_Code = '$user_id' order by sorting_no");
		
		$data['homeworkData'] = $this->alam->selectA('homework','*,(select distinct(DISP_CLASS) from student where CLASS=homework.class)disp_class,(select distinct(DISP_SEC) from student where SEC=homework.sec)disp_sec,(SELECT SubName FROM subjects WHERE SubCode=homework.subject)subject',"CLASS='$class' AND SEC='$sec'");
		//echo "<pre>";
		//print_r($data['homeworkData']);die;
		$this->render_template('homework/homeworkStatus',$data);
	}
	
	public function loadCat(){
		$user_id = login_details['user_id'];
		$SubDate = date('Y-m-d',strtotime($this->input->post('SubDate')));
		$data    = $this->alam->selectA('homework','distinct(homework_category),(select category from homework_cat_master where id=homework.homework_category)catnm',"emp_id='$user_id' AND submission_date='$SubDate'");
		if(!empty($data)){
			?>
				<option value=''>Select</option>
			<?php
			foreach($data as $key => $val){
				?>
					<option value='<?php echo $val['homework_category']; ?>'><?php echo $val['catnm']; ?></option>
				<?php
			}
		}
	}
	
	public function loadClass(){
		$user_id = login_details['user_id'];
		$SubDate = date('Y-m-d',strtotime($this->input->post('SubDate')));
		$cat     = $this->input->post('cat');
		$data    = $this->alam->selectA('homework','distinct(class),(select CLASS_NM from classes where Class_No=homework.class)classnm',"emp_id='$user_id' AND submission_date='$SubDate' AND homework_category='$cat'");
		?>
			<option value=''>Select</option>
		<?php
		if(!empty($data)){
			foreach($data as $key => $val){
				?>
					<option value='<?php echo $val['class']; ?>'><?php echo $val['classnm']; ?></option>
				<?php
			}
		}
	}
	
	public function loadSec(){
		$user_id = login_details['user_id'];
		$SubDate = date('Y-m-d',strtotime($this->input->post('SubDate')));
		$cat     = $this->input->post('cat');
		$cls     = $this->input->post('cls');
		
		$data    = $this->alam->selectA('homework','distinct(sec),(select SECTION_NAME from sections where section_No=homework.sec)secnm',"emp_id='$user_id' AND submission_date='$SubDate' AND homework_category='$cat' AND class='$cls'");
		?>
			<option value=''>Select</option>
		<?php
		if(!empty($data)){
			foreach($data as $key => $val){
				?>
					<option value='<?php echo $val['sec']; ?>'><?php echo $val['secnm']; ?></option>
				<?php
			}
		}
	}
	
	public function loadSubj(){
		$user_id = login_details['user_id'];
		$SubDate = date('Y-m-d',strtotime($this->input->post('SubDate')));
		$cat     = $this->input->post('cat');
		$cls     = $this->input->post('cls');
		$sec     = $this->input->post('sec');
		
		$data    = $this->alam->selectA('homework','distinct(subject),(select SubName from subjects where SubCode=homework.subject)subjnm',"emp_id='$user_id' AND submission_date='$SubDate' AND homework_category='$cat' AND class='$cls' AND sec='$sec'");
		?>
			<option value=''>Select</option>
		<?php
		if(!empty($data)){
			foreach($data as $key => $val){
				?>
					<option value='<?php echo $val['subject']; ?>'><?php echo $val['subjnm']; ?></option>
				<?php
			}
		}
	}
	
	public function fetchData(){
		$user_id       = login_details['user_id'];
		$submission_dt = date('Y-m-d',strtotime($this->input->post('submission_dt')));
		$category      = $this->input->post('category');
		$class         = $this->input->post('class');
		$section       = $this->input->post('section');
		$subject       = $this->input->post('subject');
		$hw_status     = $this->input->post('hw_status');
		$data['sts']   = $this->input->post('hw_status');
		$data['homeworkData'] = $this->nm->getHomeworkData($submission_dt,$category,$class,$section,$subject,$hw_status,$user_id);
		$this->load->view('homework/loadHomeworkStatusSave',$data);
	}
	
	public function saveStatus(){
		$updid = $this->input->post('updid');
		$status = $this->input->post('swtch[]');
		foreach($status as $key => $val){
			$updData = array(
				'homework_status' => 'Y',
				'teacher_remarks' => $this->input->post('txtfld')[$key]
			);
			
			$this->alam->update('homework_adm_wise',$updData,"admno='$val' AND homework_tbl_id='$updid'");
		}
		$this->session->set_flashdata('msg',"Homework Completed Successfully");
		redirect('homework/HomeworkStatus');
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assign_subject_teacher extends My_controller {
	public function __construct(){
		parent :: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$data['class_data'] = $this->alam->getclass();
		$data['emp_data'] = $this->alam->selectA('employee','EMPID,EMP_FNAME,EMP_MNAME,EMP_LNAME',"STAFF_TYPE = '1'");
		$data['teacherData'] = $this->alam->selectA('class_section_wise_subject_allocation','Class_No,(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm,section_no,(SELECT SECTION_NAME from sections WHERE section_no=class_section_wise_subject_allocation.section_no)secnm,subject_code,(select SubName from subjects where SubCode = class_section_wise_subject_allocation.subject_code)subjnm,Main_Teacher_Code,(select concat(IFNULL(EMP_FNAME,"")," ",IFNULL(EMP_MNAME,"")," ",IFNULL(EMP_LNAME,""))empname from employee where EMPID=class_section_wise_subject_allocation.Main_Teacher_Code)teachernm',"Main_Teacher_Code != ''");
		
		$this->render_template('teacher/assign_subject_teacher',$data);
	}
	
	public function getsection(){
		$class_id = $this->input->post('class_id');
		
		$sectiondata = $this->alam->selectA('class_section_wise_subject_allocation','DISTINCT(section_no),(SELECT SECTION_NAME from sections WHERE section_no=class_section_wise_subject_allocation.section_no)secnm',"Class_No = '$class_id' order by section_no");
		?>
		<option value=''>Select</option>
		<?php
		foreach($sectiondata as $key => $val){
			?>
				<option value='<?php echo $val['section_no']; ?>'><?php echo $val['secnm']; ?></option>
			<?php
		}
	}
	
	public function getsubject(){
		$class_id = $this->input->post('class_id');
		$sec_id = $this->input->post('sec_id');
		
		$subjData = $this->alam->selectA('class_section_wise_subject_allocation','subject_code,(SELECT SubName FROM subjects WHERE SubCode=class_section_wise_subject_allocation.subject_code)subjnm',"Class_No = '$class_id' AND section_no = '$sec_id'");
		?>
		<option value=''>Select</option>
		<?php
		foreach($subjData as $key => $val){
			?>
				<option value='<?php echo $val['subject_code']; ?>'><?php echo $val['subjnm']; ?></option>
			<?php
		}
		
	}
	
	public function updateSubjectTeacher(){
		$classes = $this->input->post('classes');
		$sec     = $this->input->post('sec');
		$subject = $this->input->post('subject');
		$teacher = $this->input->post('teacher');
		
		$saveData = array(
			'Main_Teacher_Code' => $teacher
		);
		
		$this->alam->update('class_section_wise_subject_allocation',$saveData,"Class_No = '$classes' AND section_no = '$sec' AND subject_code = '$subject' AND applicable_exam = '1'");
		
		$this->session->set_flashdata('sms','Allocate subject teacher Successfully...!');
		redirect('teacher/Assign_subject_teacher');
	}
}
  

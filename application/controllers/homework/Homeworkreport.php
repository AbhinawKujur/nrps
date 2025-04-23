<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homeworkreport extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){

		if(!in_array('viewHomework', permission_data)){
			redirect('payroll/dashboard/dashboard');
		}

		$user_id = login_details['user_id'];
        
        if(isset($_POST['search']))
		{
			$from_date = date('Y-m-d',strtotime($this->input->post('from_date')));
			$to_date = date('Y-m-d',strtotime($this->input->post('to_date')));
			$class_id = $this->input->post('class_id');
			$section_id = $this->input->post('section_id');
			$subject = $this->input->post('subject');
			$homework_category = $this->input->post('homework_category');
			$where = "1";
			if($homework_category != '')
			{
				$where = "homework_category='$homework_category' AND homework_date >='$from_date' AND homework_date<='$to_date'";
			}
			if($class_id != '' && $section_id != '')
			{
				$where = "class='$class_id' AND sec='$section_id' AND 	homework_date >='$from_date' AND homework_date<='$to_date'";
			}
			if($class_id != '' && $section_id != '' && $subject != '')
			{
				$where = "class='$class_id' AND sec='$section_id' AND subject='$subject' AND homework_date >='$from_date' AND homework_date<='$to_date'";
			}
			if($class_id != '' && $section_id != '' && $subject != '' && $homework_category != '')
			{
				$where = "class='$class_id' AND sec='$section_id' AND subject='$subject' AND homework_category='$homework_category' AND homework_date >='$from_date' AND homework_date<='$to_date'";
			}

			if(login_details['ROLE_ID'] != 4){
				$where .= " AND emp_id='$user_id'";
			}else{
				$where .= " AND emp_id='$user_id'";
			}
			$homeworkDetails = $this->homework_model->getHomeworkReport($where,login_details['ROLE_ID']);
			$data['homeworkDetails'] = $homeworkDetails;
		}
		
		if(login_details['ROLE_ID'] != 4)
		{
			$data['classList'] = $this->alam->selectA('class_section_wise_subject_allocation cswa','distinct(Class_no),(select CLASS_NM from classes where Class_No=cswa.Class_No)classnm',"Main_Teacher_Code='$user_id'");
		}else{
			$data['classList'] = $this->alam->selectA('class_section_wise_subject_allocation cswa','distinct(Class_no),(select CLASS_NM from classes where Class_No=cswa.Class_No)classnm');
		}

		$data['homeworkCategory'] = $this->sumit->fetchAllData('*','homework_cat_master',array());
		$this->render_template('homework/homeworkReport',$data);
	}
	
	public function getSectionByClassId(){
		$user_id  = login_details['user_id'];
		$class_id = $this->input->post('class_id');
		
		if(login_details['ROLE_ID'] != 4)
		{
			$secData  = $this->alam->selectA('class_section_wise_subject_allocation','distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm',"Main_Teacher_Code='$user_id' AND Class_No = '$class_id'");
		}else{
			$secData  = $this->alam->selectA('class_section_wise_subject_allocation','distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm');
		}
		echo json_encode($secData);
	}

	public function getSubject(){
		$user_id  = login_details['user_id'];
		$cls      = $this->input->post('cls');
		$sec_id   = $this->input->post('sec_id');
		
		if(login_details['ROLE_ID'] != 4)
		{
			$subjectData  = $this->alam->selectA('class_section_wise_subject_allocation','distinct(subject_code),(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm',"Main_Teacher_Code='$user_id' AND Class_No = '$cls' AND section_no = '$sec_id'");
		}else{
			$subjectData  = $this->alam->selectA('class_section_wise_subject_allocation','distinct(subject_code),(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm');
		}
		echo json_encode($subjectData);
	}

	public function getHomeworkDetails()
	{
		$id = $this->input->post('id');
		$data['homeworkDetails'] = $this->homework_model->getHomeworkReport("id='$id'");
		$data['studentList'] = $this->sumit->fetchAllData('admno,homework_status,teacher_remarks,updated_at,(SELECT FIRST_NM FROM student WHERE ADM_NO=haw.admno)FIRST_NM,(SELECT MIDDLE_NM FROM student WHERE ADM_NO=haw.admno)MIDDLE_NM','homework_adm_wise haw',"homework_tbl_id='$id'");
		$this->load->view('homework/homeworkDetailsinModal',$data);
	}
	
	/*----------------Date Wise Report Function-------------------*/	
	public function homeworkreportdatewise(){
		$date	=	date('Y-m-d');
		$data['hwdetails']	= $this->alam->selectA('homework','*',"date='$date'");	
		$this->render_template('homework/homeworkreportdatewise',$data);
	}
	
	public function homeworkreportlist(){
		
		$date	= date('Y-m-d',strtotime($this->input->post('hwdate')));
		$data['hwdetails']	= $this->alam->selectA('homework','*',"date='$date'");
		//print_r($data['hwdetails']);die;
		$this->render_template('homework/homeworkreportdatewise',$data);
	}


}

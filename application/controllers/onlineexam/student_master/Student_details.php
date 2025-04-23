<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_details extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','farheen');
	}
	public function stulist(){
		$this->fee_template('onlineexam/student_master/student_list');
	}
	public function online_subject(){
		
		$ret = '';
		$exam_date = $this->input->post('val');
		$sec_data = $this->db->query("select distinct subject_id,(select SubName from subjects where subject_id=SubCode) subj from online_exam_schedule where exam_date='$exam_date'")->result();
		
		$ret .="<option value=''>Select</option>";
		if(isset($sec_data)){
			foreach($sec_data as $data){
				
				 $ret .="<option value=". $data->subject_id .">" . $data->subj ."</option>";
				
			}
		}
		
		$array = array($ret);
		echo json_encode($array);
	}
	
	public function online_class(){
		
		$ret = '';
		$subject = $this->input->post('val');
		$exam_date = $this->input->post('exam_date');
		$class_data = $this->db->query("SELECT distinct class_id,(select CLASS_NM from classes where class_id=Class_No) class FROM `online_exam_schedule` where exam_date='$exam_date' and subject_id='$subject'")->result();
		
		$ret .="<option value=''>Select</option>";
		if(isset($class_data)){
			foreach($class_data as $data){
				
				 $ret .="<option value=". $data->class_id .">" . $data->class ."</option>";
				
			}
		}
		
		$array = array($ret);
		echo json_encode($array);
	}
	
	public function online_sec(){
		
		$ret = '';
		$class = $this->input->post('val');
		$exam_date = $this->input->post('exam_date');
		$subject = $this->input->post('subject');
		$section_data = $this->db->query("SELECT distinct sec_id,(select SECTION_NAME from sections where sec_id=section_no) sec FROM `online_exam_schedule` where exam_date='$exam_date' and subject_id='$subject' and class_id='$class'")->result();
		
		$ret .="<option value=''>Select</option>";
		if(isset($section_data)){
			foreach($section_data as $data){
				
				 $ret .="<option value=". $data->sec_id .">" . $data->sec ."</option>";
				
			}
		}
		
		$array = array($ret);
		echo json_encode($array);
	}
	
	public function online_time(){
		
		$ret = '';
		$sec = $this->input->post('val');
		$exam_date = $this->input->post('exam_date');
		$subject = $this->input->post('subject');
		$class = $this->input->post('classd');
		$time_data = $this->db->query("SELECT distinct start_time FROM `online_exam_schedule` where exam_date='$exam_date' and subject_id='$subject' and class_id='$class' and sec_id='$sec'")->result();
		
		$ret .="<option value=''>Select</option>";
		if(isset($time_data)){
			foreach($time_data as $data){
				
				 $ret .="<option value=". $data->start_time .">" . $data->start_time ."</option>";
				
			}
		}
		
		$array = array($ret);
		echo json_encode($array);
	}
	
	public function student_data()
	{
		$exam_date    = $this->input->post('exam_date');
		$subject = $this->input->post('subject');
		$class = $this->input->post('classd');
		$section = $this->input->post('section');
		
		$exam_schedule = $this->db->query("select id from online_exam_schedule where exam_date='$exam_date' and subject_id='$subject' and class_id='$class' and sec_id='$section'")->result();
		$exam_schedule_id = $exam_schedule[0]->id;
		
		$student_data = $this->db->query("SELECT STUDENTID,ADM_NO,FIRST_NM,ROLL_NO,C_MOBILE,Parent_password FROM `student` as st INNER JOIN online_student_exam_list as ost ON st.ADM_NO=ost.admno where ost.subj_id='$subject' and st.class='$class' and st.sec='$section' and st.Student_status='ACTIVE' AND ost.exam_schedule_id='$exam_schedule_id' order by st.roll_no,st.first_nm")->result();
		
		$array = array(
				
			    'student_data'  => $student_data,
			);
		$this->load->view('onlineexam/student_master/student_list_report',$array);
	}
	
	public function active_student(){
		$id = $this->input->post('val');
		$adm = $this->input->post('adm');
		$data = $this->farheen->select('student','*',"STUDENTID='$id' AND ADM_NO='$adm' AND Student_Status='ACTIVE'");
		
		echo json_encode($data);
	}
	
	public function change_password(){
		$adm = $this->input->post('adm');
		$id = $this->input->post('id');
		$rn = $this->input->post('rn');
		$fn = $this->input->post('fn');
		$pss = $this->input->post('pss');
		$array = array(
			'ROLL_NO' => $rn,
			'C_MOBILE' => $fn,
			'Parent_password' => $pss
		);
		if($this->farheen->update('student',$array,"STUDENTID='$id'")){
			echo 1;
		}
		else{
			echo 0;
		}
	}
}
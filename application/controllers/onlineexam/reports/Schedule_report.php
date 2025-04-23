<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule_report extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','farheen');
	}
	public function schedulelist(){
		$this->fee_template('onlineexam/reports/schedule_list');
	}
	
	public function online_subject(){
		
		$ret = '';
		$exam_date = $this->input->post('val');
		$sec_data = $this->db->query("select distinct subject_id,(select SubName from subjects where subject_id=SubCode) subj from online_exam_schedule where exam_date='$exam_date'")->result();
		
		$ret .="<option value=''>Select</option>";
		$ret .="<option value='All'>All Subject</option>";
		if(isset($sec_data)){
			foreach($sec_data as $data){
				
				 $ret .="<option value=". $data->subject_id .">" . $data->subj ."</option>";
				
			}
		}
		
		$array = array($ret);
		echo json_encode($array);
	}
	
	public function schedule_data()
	{
		$exam_date    = $this->input->post('exam_date');
		$subject = $this->input->post('subject');
		if($subject == 'All')
		{
				$exam_scheduledata = $this->db->query("SELECT exam_date,(Select class_nm from classes where class_no=onexm.class_ID) as CLsnme,(Select SECTION_NAME from Sections where section_no=onexm.sec_id) as sectionm,(Select SubName from subjects where SubCode=onexm.subject_id) as subj_name,(Select count(admno) from online_student_exam_list where class_id=onexm.class_ID and sec_id=onexm.sec_id and subj_id=onexm.subject_id and exam_schedule_id=onexm.id) as totstu,(Select count(distinct(admno)) from online_exam_answers where class_no=onexm.class_ID and sec_no=onexm.sec_id and subj_id=onexm.subject_id and exam_schedule_id=onexm.id and date(answered_date)=onexm.exam_date) as aprstu,concat(onexm.start_time,'-',onexm.end_time)as exmtime,concat(onexm.exam_date,' ',onexm.end_time)as dttime    FROM `online_exam_schedule` as onexm where exam_date='$exam_date' order by onexm.class_ID,onexm.sec_id,subj_name asc")->result();
		}
		else
		{
		$exam_scheduledata = $this->db->query("SELECT exam_date,(Select class_nm from classes where class_no=onexm.class_ID) as CLsnme,(Select SECTION_NAME from Sections where section_no=onexm.sec_id) as sectionm,(Select SubName from subjects where SubCode=onexm.subject_id) as subj_name,(Select count(admno) from online_student_exam_list where class_id=onexm.class_ID and sec_id=onexm.sec_id and subj_id=onexm.subject_id and exam_schedule_id=onexm.id) as totstu,(Select count(distinct(admno)) from online_exam_answers where class_no=onexm.class_ID and sec_no=onexm.sec_id and subj_id=onexm.subject_id and exam_schedule_id=onexm.id and date(answered_date)=onexm.exam_date) as aprstu,concat(onexm.start_time,'-',onexm.end_time)as exmtime,concat(onexm.exam_date,' ',onexm.end_time)as dttime    FROM `online_exam_schedule` as onexm where exam_date='$exam_date' and subject_id='$subject' order by onexm.class_ID,onexm.sec_id asc")->result();
		}
		
		
		$array = array(
				'exam_date'     => $exam_date,
				'subject'  => $subject,
			    'exam_scheduledata'  => $exam_scheduledata,
			);
		$this->load->view('onlineexam/reports/schedule_list_report',$array);
	}
	
	public function pdf(){
		
		$exam_date    = $this->input->post('ct1');
		$subject = $this->input->post('ct2');
		if($subject == 'All')
		{
			$subj_name = '';
		}
		else
		{
			$subjectss = $this->db->query("select SubName from subjects where SubCode=$subject")->result();
            $subj_name = $subjectss[0]->SubName;
		}
		
		if($subject == 'All')
		{
				$exam_scheduledata = $this->db->query("SELECT exam_date,(Select class_nm from classes where class_no=onexm.class_ID) as CLsnme,(Select SECTION_NAME from Sections where section_no=onexm.sec_id) as sectionm,(Select SubName from subjects where SubCode=onexm.subject_id) as subj_name,(Select count(admno) from online_student_exam_list where class_id=onexm.class_ID and sec_id=onexm.sec_id and subj_id=onexm.subject_id and exam_schedule_id=onexm.id) as totstu,(Select count(distinct(admno)) from online_exam_answers where class_no=onexm.class_ID and sec_no=onexm.sec_id and subj_id=onexm.subject_id and exam_schedule_id=onexm.id and date(answered_date)=onexm.exam_date) as aprstu,concat(onexm.start_time,'-',onexm.end_time)as exmtime,concat(onexm.exam_date,' ',onexm.end_time)as dttime    FROM `online_exam_schedule` as onexm where exam_date='$exam_date'")->result();
		}
		else
		{
		$exam_scheduledata = $this->db->query("SELECT exam_date,(Select class_nm from classes where class_no=onexm.class_ID) as CLsnme,(Select SECTION_NAME from Sections where section_no=onexm.sec_id) as sectionm,(Select SubName from subjects where SubCode=onexm.subject_id) as subj_name,(Select count(admno) from online_student_exam_list where class_id=onexm.class_ID and sec_id=onexm.sec_id and subj_id=onexm.subject_id and exam_schedule_id=onexm.id) as totstu,(Select count(distinct(admno)) from online_exam_answers where class_no=onexm.class_ID and sec_no=onexm.sec_id and subj_id=onexm.subject_id and exam_schedule_id=onexm.id and date(answered_date)=onexm.exam_date) as aprstu,concat(onexm.start_time,'-',onexm.end_time)as exmtime,concat(onexm.exam_date,' ',onexm.end_time)as dttime    FROM `online_exam_schedule` as onexm where exam_date='$exam_date' and subject_id='$subject'")->result();
		}
		
		$school_setting = $this->farheen->select('school_setting','*');
		$array = array(
			'exam_date'     => $exam_date,
			'subject'  => $subject,
			'subj_name'  => $subj_name,
			'school_setting' => $school_setting,
			'exam_scheduledata'  => $exam_scheduledata,
		);
		$this->load->view('onlineexam/reports/schedule_list_report_pdf',$array);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream("schedule_list_report.pdf", array("Attachment"=>0));



	}
	
}
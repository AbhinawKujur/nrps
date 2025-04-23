<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_card_nur extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$this->render_template('report_card_nur/report_card_nur_term');
	}
	
	public function report_card_stu_list(){
		$this->render_template('report_card_nur/report_card_nur');
	}
	
	public function getSec(){
		$ret = '';
		
		$class = $this->input->post('val');
		$sec_data = $this->alam->selectA('class_section_wise_subject_allocation','distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm',"Class_No = '$class'");
		
		$ret .="<option value=''>Select</option>";
		if(isset($sec_data)){
			foreach($sec_data as $data){
				 $ret .="<option value=". $data['section_no'] .">" . $data['secnm'] ."</option>";
			}
		}
		
		$array = array($ret);
		echo json_encode($array);
	}
	
	public function make_report_card(){
		$class = $this->input->post('classs');
		$sec   = $this->input->post('sec');
		$data['sec'] = $sec;
		$data['stuData'] = $this->alam->selectA('student','ADM_NO,FIRST_NM,ROLL_NO',"CLASS='$class' AND SEC='$sec' AND Student_Status = 'ACTIVE'");
		$this->load->view('report_card_nur/loadNurStuList',$data);
	}
	
	public function nurReportCardPDF(){
		$Class_No = 1;
		$data['Class_No'] = $Class_No;
		$data['sec']  = $this->input->post('sec');
		$data['admno'] = $this->input->post('stu_adm_no[]');
		$data['signature'] = $this->alam->selectA('signature','*');
		$data['school_setting'] = $this->alam->select('school_setting','*');
		$data['school_photo'] = $this->alam->select('school_photo','*');
		$data['subSkill'] = $this->alam->selectA('subject_skill_master','subject_code,sorting_no,(SELECT SubName FROM subjects WHERE SubCode=subject_skill_master.subject_code)subjnm',"class_code = '$Class_No' GROUP BY subject_code,subjnm,sorting_no order BY sorting_no");
		$data['color'] = $this->custom_lib->reportCardGardeColorOneTofive();
		$this->load->view('report_card_nur/reportCardNurPDF',$data);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'potrait');
		$this->dompdf->render();
		$this->dompdf->stream("report_card.pdf", array("Attachment"=>0));
	}
}
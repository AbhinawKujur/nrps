<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportCard_XII extends MY_controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Alam','alam');
		if(empty($this->session->userdata('adm'))){
			redirect('parentlogin');
		}
	}

	public function index(){
		
		$admno                  = $this->session->userdata('adm'); 
		$class                  = $this->session->userdata('class_code');
		$sec                    = $this->session->userdata('sec_code');
		
		//$getPrevClass =$this->alam->selectA('student','prev_temp_class',"ADM_NO='$admno'");
		//$table = $getPrevClass[0]['prev_temp_class'];
					
		$data['signature']      = $this->alam->selectA('signature','*');
		$data['school_setting'] = $this->alam->select('school_setting','*');
		$data['school_photo']   = $this->alam->select('school_photo','*');
		$data['color']          = $this->custom_lib->reportCardGardeColorOneTofive();
		$data['stuData']        = $this->alam->selectA('tabulation_senior_xii','*,(select FATHER_NM from student where  ADM_NO=tabulation_senior_xii.AdmNo)FATHER_NM,(select MOTHER_NM from student where  ADM_NO=tabulation_senior_xii.AdmNo)MOTHER_NM,(select BLOOD_GRP from student where  ADM_NO=tabulation_senior_xii.AdmNo)BLOOD_GRP,(select BIRTH_DT from student where  ADM_NO=tabulation_senior_xii.AdmNo)BIRTH_DT',"AdmNo='$admno'");
		// echo $this->db->last_query();
		// echo "<pre>";
		// print_r($data['stuData']);die;
		
		if($class == '14' || $class == '15' || $class == '18'){
			$this->load->view('parents_dashboard/report_card/report_card_xi',$data);
		}else{
			$this->load->view('parents_dashboard/report_card/report_card_xii',$data);	
		}
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'potrait');
		$this->dompdf->render();
		$this->dompdf->stream("report_card.pdf", array("Attachment"=>0));
	}
}
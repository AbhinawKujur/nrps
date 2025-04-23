<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Percentage_report extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
		error_reporting(0);
	}
	
	public function index(){
		ini_set('memory_limit', '-1');
		
		$data['school_setting'] = $this->alam->selectA('school_setting','*');
		$data['school_photo'] = $this->alam->selectA('school_photo','*');
		$data['topper_list'] = $this->alam->topper_list();
		$data['subj_head'] = $this->alam->selectA('temp_report_card','distinct (subj1_nm),subj2_nm,subj3_nm,subj4_nm,subj5_nm,subj6_nm,subj1_nm,subj7_nm,subj8_nm,subj9_nm,subj10_nm,subj11_nm,subj12_nm,subj13_nm,subj14_nm,subj15_nm');
		
		$data['all_stu_per_report'] = $this->alam->selectA('temp_report_card as trc','trc.adm_no,trc.roll_no,trc.first_nm,trc.subj1_mo,trc.subj2_mo,trc.subj3_mo,trc.subj4_mo,trc.subj5_mo,trc.subj6_mo,trc.subj7_mo,trc.subj8_mo,trc.subj9_mo,trc.subj10_mo,trc.subj11_mo,trc.subj12_mo,trc.subj13_mo,trc.subj14_mo,trc.subj15_mo,trc.tot_wet_mrk,trc.tot_per,trc.tot_grd,trc.attendance');
		$this->load->view('report_card/percentage_report_pdf',$data);
		
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("Percentage_report.pdf", array("Attachment"=>0));
	}
}
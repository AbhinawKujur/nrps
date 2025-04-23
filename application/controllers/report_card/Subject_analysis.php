<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject_analysis extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
		error_reporting(0);
	}
	
	public function index(){
		$data['school_photo'] = $this->alam->selectA('school_photo','*');
		$data['school_setting'] = $this->alam->selectA('school_setting','*');
		$data['subj_head'] = $this->alam->selectA('temp_report_card','distinct (subj1_nm),subj2_nm,subj3_nm,subj4_nm,subj5_nm,subj6_nm,subj1_nm,subj7_nm,subj8_nm,subj9_nm,subj10_nm,subj11_nm,subj12_nm,subj13_nm,subj14_nm,subj15_nm');
		$data['highest_obt'] = $this->alam->selectA('temp_report_card','max(subj1_mo)subj1_mo,max(subj2_mo)subj2_mo,max(subj3_mo)subj3_mo,max(subj4_mo)subj4_mo,max(subj5_mo)subj5_mo,max(subj6_mo)subj6_mo,max(subj7_mo)subj7_mo,max(subj8_mo)subj8_mo,max(subj9_mo)subj9_mo,max(subj10_mo)subj10_mo,max(subj11_mo)subj11_mo,max(subj12_mo)subj12_mo,max(subj13_mo)subj13_mo,max(subj14_mo)subj14_mo,max(subj15_mo)subj15_mo');
		
		$data['no_of_per'] = $this->alam->selectA('temp_report_card','count(adm_no)adm_no,(Select count(subj1_per) from temp_report_card where subj1_per>=90)subj1_per,(Select count(subj2_per) from temp_report_card where subj2_per>=90)subj2_per,(Select count(subj3_per) from temp_report_card where subj3_per>=90)subj3_per,(Select count(subj4_per) from temp_report_card where subj4_per>=90)subj4_per,(Select count(subj5_per) from temp_report_card where subj5_per>=90)subj5_per,(Select count(subj6_per) from temp_report_card where subj6_per>=90)subj6_per,(Select count(subj7_per) from temp_report_card where subj7_per>=90)subj7_per,(Select count(subj8_per) from temp_report_card where subj8_per>=90)subj8_per,(Select count(subj9_per) from temp_report_card where subj9_per>=90)subj9_per,(Select count(subj10_per) from temp_report_card where subj10_per>=90)subj10_per,(Select count(subj11_per) from temp_report_card where subj11_per>=90)subj11_per,(Select count(subj12_per) from temp_report_card where subj12_per>=90)subj12_per,(Select count(subj13_per) from temp_report_card where subj13_per>=90)subj13_per,(Select count(subj14_per) from temp_report_card where subj14_per>=90)subj14_per,(Select count(subj15_per) from temp_report_card where subj15_per>=90)subj15_per');
		
		$data['subj_avg'] = $this->alam->selectA('temp_report_card','format(avg(subj1_per),2)subj1_avg,format(avg(subj2_per),2)subj2_avg,format(avg(subj3_per),2)subj3_avg,format(avg(subj4_per),2)subj4_avg,format(avg(subj5_per),2)subj5_avg,format(avg(subj6_per),2)subj6_avg,format(avg(subj7_per),2)subj7_avg,format(avg(subj8_per),2)subj8_avg,format(avg(subj9_per),2)subj9_avg,format(avg(subj10_per),2)subj10_avg,format(avg(subj11_per),2)subj11_avg,format(avg(subj12_per),2)subj12_avg,format(avg(subj13_per),2)subj13_avg,format(avg(subj14_per),2)subj14_avg,format(avg(subj15_per),2)subj15_avg');
		
		$data['fail'] = $this->alam->selectA('temp_report_card','count(adm_no)adm_no,(Select count(subj1_per) from temp_report_card where subj1_per<=33)subj1_fl,(Select count(subj2_per) from temp_report_card where subj2_per<=33)subj2_fl,(Select count(subj3_per) from temp_report_card where subj1_per<=33)subj3_fl,(Select count(subj4_per) from temp_report_card where subj1_per<=33)subj4_fl,(Select count(subj5_per) from temp_report_card where subj5_per<=33)subj5_fl,(Select count(subj6_per) from temp_report_card where subj6_per<=33)subj6_fl,(Select count(subj7_per) from temp_report_card where subj7_per<=33)subj7_fl,(Select count(subj8_per) from temp_report_card where subj8_per<=33)subj8_fl,(Select count(subj9_per) from temp_report_card where subj9_per<=33)subj9_fl,(Select count(subj10_per) from temp_report_card where subj10_per<=33)subj10_fl,(Select count(subj11_per) from temp_report_card where subj11_per<=33)subj11_fl,(Select count(subj12_per) from temp_report_card where subj12_per<=33)subj12_fl,(Select count(subj13_per) from temp_report_card where subj13_per<=33)subj13_fl,(Select count(subj14_per) from temp_report_card where subj14_per<=33)subj14_fl,(Select count(subj15_per) from temp_report_card where subj15_per<=33)subj15_fl');
		
		$data['topper_list'] = $this->alam->topper_list();
		$this->load->view('report_card/subject_analysis_pdf',$data);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("Subject_analysis.pdf", array("Attachment"=>0));
	}
}
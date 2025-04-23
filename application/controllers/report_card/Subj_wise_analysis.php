<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subj_wise_analysis extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
		error_reporting(0);
	}
	
	public function index($type){
		$data['school_photo'] = $this->alam->selectA('school_photo','*');
		$data['school_setting'] = $this->alam->selectA('school_setting','*');
		
		$data['subj_head'] = $this->alam->selectA('temp_report_card','distinct (subj1_nm),subj2_nm,subj3_nm,subj4_nm,subj5_nm,subj6_nm,subj1_nm,subj7_nm,subj8_nm,subj9_nm,subj10_nm,subj11_nm,subj12_nm,subj13_nm,subj14_nm,subj15_nm');
		
		$subj_wise_mrks = array();
		for($i=1; $i<=9; $i++){
		 $subj_wise_mrks[$i] = $this->alam->selectA('temp_report_card as trc','DISTINCT(trc.subj'.$i.'_nm),(SELECT COUNT(adm_no)cnt from temp_report_card WHERE subj'.$i.'_mo <= 100 AND subj'.$i.'_mo >= 91)subj'.$i.'_abv90,(SELECT COUNT(adm_no)cnt from temp_report_card WHERE subj'.$i.'_mo <= 90.99 AND subj'.$i.'_mo >= 81)subj'.$i.'_abv80,(SELECT COUNT(adm_no)cnt from temp_report_card WHERE subj'.$i.'_mo <= 80.99 AND subj'.$i.'_mo >= 71)subj'.$i.'_abv70,(SELECT COUNT(adm_no)cnt from temp_report_card WHERE subj'.$i.'_mo <= 70.99 AND subj'.$i.'_mo >= 61)subj'.$i.'_abv60,(SELECT COUNT(adm_no)cnt from temp_report_card WHERE subj'.$i.'_mo <= 60.99 AND subj'.$i.'_mo >= 51)subj'.$i.'_abv50,(SELECT COUNT(adm_no)cnt from temp_report_card WHERE subj'.$i.'_mo <= 50.99 AND subj'.$i.'_mo >= 41)subj'.$i.'_abv40,(SELECT COUNT(adm_no)cnt from temp_report_card WHERE subj'.$i.'_mo <= 40.99 AND subj'.$i.'_mo >= 32)subj'.$i.'_abv32,(SELECT COUNT(adm_no)cnt from temp_report_card WHERE subj'.$i.'_mo < 31.99)subj'.$i.'_lss32');
		}
		
		$data['subj_wise_mrks'] = $subj_wise_mrks; 
		
		$data['topper_list'] = $this->alam->topper_list();
		if($type == 'pdf'){
			$this->load->view('report_card/subj_wise_analysis_pdf',$data);
		}else{
			$this->render_template('report_card/subj_wise_analysis_excel',$data);
		}
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Higest_sub_graph extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
		error_reporting(0);
	}
	
	public function index(){
		$data['school_photo'] = $this->alam->selectA('school_photo','*');
		$data['school_setting'] = $this->alam->selectA('school_setting','*');
		$data['topper_list'] = $this->alam->topper_list();
	
		$this->load->view('report_card/higest_sub_graph',$data);
	}
	
	public function fetch_data(){
		
	 $subj_head = $this->alam->selectA('temp_report_card','distinct (subj1_nm),subj2_nm,subj3_nm,subj4_nm,subj5_nm,subj6_nm,subj1_nm,subj7_nm,subj8_nm,subj9_nm,subj10_nm,subj11_nm,subj12_nm,subj13_nm,subj14_nm,subj15_nm');
		
	 $highest_obt = $this->alam->selectA('temp_report_card','max(subj1_mo)subj1_mo,max(subj2_mo)subj2_mo,max(subj3_mo)subj3_mo,max(subj4_mo)subj4_mo,max(subj5_mo)subj5_mo,max(subj6_mo)subj6_mo,max(subj7_mo)subj7_mo,max(subj8_mo)subj8_mo,max(subj9_mo)subj9_mo,max(subj10_mo)subj10_mo,max(subj11_mo)subj11_mo,max(subj12_mo)subj12_mo,max(subj13_mo)subj13_mo,max(subj14_mo)subj14_mo,max(subj15_mo)subj15_mo');
	
	 $result = array();
	  for ($i=1; $i <= 15; $i++) { 
	  	if($subj_head[0]['subj'.$i.'_nm'] != ''){
		  	$result[$i] = array(
		  		'subj_nm'	=> $subj_head[0]['subj'.$i.'_nm'],
		  		'higest_marks'	=> $highest_obt[0]['subj'.$i.'_mo'],
		  	);
		}
	  }
	  print json_encode($result); 
	} 
}
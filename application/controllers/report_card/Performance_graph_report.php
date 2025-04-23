<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Performance_graph_report extends MY_controller{
	
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
	
		$this->load->view('report_card/performance_graph_pdf',$data);
	}
	
	public function fetch_data(){
		
	 $subj_head = $this->alam->selectA('temp_report_card','distinct (subj1_nm),subj2_nm,subj3_nm,subj4_nm,subj5_nm,subj6_nm,subj1_nm,subj7_nm,subj8_nm,subj9_nm,subj10_nm,subj11_nm,subj12_nm,subj13_nm,subj14_nm,subj15_nm');
	 
	 $subj_avg = $this->alam->selectA('temp_report_card','format(avg(subj1_per),2)subj1_avg,format(avg(subj2_per),2)subj2_avg,format(avg(subj3_per),2)subj3_avg,format(avg(subj4_per),2)subj4_avg,format(avg(subj5_per),2)subj5_avg,format(avg(subj6_per),2)subj6_avg,format(avg(subj7_per),2)subj7_avg,format(avg(subj8_per),2)subj8_avg,format(avg(subj9_per),2)subj9_avg,format(avg(subj10_per),2)subj10_avg,format(avg(subj11_per),2)subj11_avg,format(avg(subj12_per),2)subj12_avg,format(avg(subj13_per),2)subj13_avg,format(avg(subj14_per),2)subj14_avg,format(avg(subj15_per),2)subj15_avg');
	 
	
	 $result = array();
	  for ($i=1; $i <= 15; $i++) { 
	  	if($subj_head[0]['subj'.$i.'_nm'] != ''){
		  	$result[$i] = array(
		  		'subj_nm'	=> $subj_head[0]['subj'.$i.'_nm'],
		  		'marks_avg'	=> $subj_avg[0]['subj'.$i.'_avg'],
		  	);
		}
	  }
	  print json_encode($result); 
	} 
}
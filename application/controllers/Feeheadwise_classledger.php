<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feeheadwise_classledger extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function feehead_class_wise_ledger(){
		$class = $this->dbcon->select('classes','*');
		$sec = $this->dbcon->select('sections','*');
		$feehead = $this->dbcon->select('feehead','*');
		$array = array(
			'class' => $class,
			'sec' => $sec,
			'feehead' => $feehead
		);
		$this->fee_template('class_report/feeheadwise_classledger',$array);
	}
	public function find_details(){
		$class_name = $this->input->post('class_name');
		$sec_name = $this->input->post('sec_name');
		$fee_head = $this->input->post('fee_head');
		$short_by = $this->input->post('short_by');
		$this->session->set_userdata('classname',$class_name);
		$this->session->set_userdata('secname',$sec_name);
		$this->session->set_userdata('fee_head',$fee_head);
		$this->session->set_userdata('short_by',$short_by);
		$fee = "Fee".$fee_head;
		$this->session->set_userdata('fee',$fee);
		$student_data = $this->dbcon->bus_wise_ledger($class_name,$sec_name,$short_by,$fee);
		$data['student_data'] = $student_data;
		if(!empty($data['student_data'])){
				$this->load->view('class_report/find_details_feeheadwiseledger',$data);
			}else{
				echo "<center><h1>Sorry No Data Found</h1></center>";
			}
		
	}
	public function download_feehead_wiseledger_pdf(){
		$class_name = $this->session->userdata('classname');
		$sec_name =  $this->session->userdata('secname');
		$fee_head =  $this->session->userdata('fee_head');
		$short_by =  $this->session->userdata('short_by');
		$fee =  $this->session->userdata('fee');
		$student_data = $this->dbcon->bus_wise_ledger($class_name,$sec_name,$short_by,$fee);
		$school_setting = $this->dbcon->select('school_setting','*');
		$classec = $this->dbcon->select('student','DISP_CLASS,DISP_SEC',"CLASS=$class_name AND SEC=$sec_name");
		$feehead_name = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='$fee_head'");
		$NAME = $feehead_name[0]->FEE_HEAD;
		$data = array(
			'student_data' => $student_data,
			'school_setting' => $school_setting,
			'classec' => $classec,
			'feehead_name' => $feehead_name
		);
		$this->load->view('class_report/feeheadwiseledger_pdf',$data);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream($NAME."-"."REPORT".".pdf", array("Attachment"=>1));
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Class_report extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function show_class(){
		$this->fee_template('class_report/show_report');
	}
	public function class_wise_ledger(){
		$class = $this->dbcon->select('classes','*');
		$sec = $this->dbcon->select('sections','*');
		$array = array(
			'class' => $class,
			'sec' => $sec
		);
		$this->fee_template('class_report/class_wise_ledger',$array);
	}
	public function find_details(){
		$class_name = $this->input->post('class_name');
		$sec_name = $this->input->post('sec_name');
		$fee_type = $this->input->post('fee_type');
		$short_by = $this->input->post('short_by');
		$this->session->set_userdata('classname',$class_name);
		$this->session->set_userdata('secname',$sec_name);
		$this->session->set_userdata('fee_type',$fee_type);
		$this->session->set_userdata('short_by',$short_by);
		if($fee_type == 'month_fee'){
			$student_data = $this->dbcon->class_wise_ledger($class_name,$sec_name,$short_by);
			$data['student_data'] = $student_data;
			if(!empty($data['student_data'])){
				$this->load->view('class_report/find_details',$data);
			}else{
				echo "<center><h1>Sorry No Data Found</h1></center>";
			}
			
		}elseif($fee_type == 'bus_fee'){
			$feehead = $this->dbcon->select('feehead','*');
			foreach($feehead as $value){
				if($value->HType == "BUS"){
					$fee_code = $value->ACT_CODE;
				}
			}
			$fee = "Fee".$fee_code;
			$this->session->set_userdata('fee',$fee);
			$student_data = $this->dbcon->bus_wise_ledger($class_name,$sec_name,$short_by,$fee);
			 $data['student_data'] = $student_data;
			 $this->load->view('class_report/find_details_bus',$data);
		}
	}
	public function download_class_wise_pdf(){
		ini_set('memory_limit', '-1');
		$class_name = $this->session->userdata('classname');
		$sec_name =  $this->session->userdata('secname');
		$fee_type =  $this->session->userdata('fee_type');
		$short_by =  $this->session->userdata('short_by');
		$student_data = $this->dbcon->class_wise_ledger($class_name,$sec_name,$short_by);
		$school_setting = $this->dbcon->select('school_setting','*');
		$classec = $this->dbcon->select('student','DISP_CLASS,DISP_SEC',"CLASS=$class_name AND SEC=$sec_name");
		$data = array(
			'student_data' => $student_data,
			'school_setting' => $school_setting,
			'classec' => $classec
		);
		$this->load->view('class_report/class_wise_month_pdf',$data);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("class_wise_report.pdf", array("Attachment"=>1));
	}
	public function download_bus_wise_pdf(){
		$class_name = $this->session->userdata('classname');
		$sec_name =  $this->session->userdata('secname');
		$fee_type =  $this->session->userdata('fee_type');
		$short_by =  $this->session->userdata('short_by');
		$fee =  $this->session->userdata('fee');
		$student_data = $this->dbcon->bus_wise_ledger($class_name,$sec_name,$short_by,$fee);
		$school_setting = $this->dbcon->select('school_setting','*');
		$classec = $this->dbcon->select('student','DISP_CLASS,DISP_SEC',"CLASS=$class_name AND SEC=$sec_name");
		$data = array(
			'student_data' => $student_data,
			'school_setting' => $school_setting,
			'classec' => $classec
		);
		$this->load->view('class_report/bus_wise_month_pdf',$data);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("bus_wise_report.pdf", array("Attachment"=>1));



	}
}
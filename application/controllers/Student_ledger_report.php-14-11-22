<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_ledger_report extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function show_student_ledger(){
		$stu_adm = $this->dbcon->select('student','ADM_NO',"Student_Status='ACTIVE'");
		$array = array(
			'stu_adm' => $stu_adm
		);
		$this->fee_template('class_report/student_ledger_details',$array);
	}
	public function checkdata(){
		$adm_no = $this->input->post('browser');
		$data = $this->dbcon->select('student','*',"ADM_NO='$adm_no' AND Student_Status='ACTIVE'");
		echo $cnt = count($data);
	}
	public function find_details(){
		$adm_no = $this->input->post('browser');
		$stu_data = $this->dbcon->monthly_collection($adm_no);
		
		$temp_daycoll = $this->dbcon->select('temp_daycoll','*',"ADM_NO='$adm_no' AND SEC='Z' ORDER BY RECT_DATE");
		$daycoll = $this->dbcon->select('daycoll','*',"ADM_NO='$adm_no' ORDER BY RECT_DATE");
		$feehead = $this->dbcon->select('feehead','*');
		$feegeneration = $this->dbcon->select('feegeneration','*',"ADM_NO='$adm_no'");
		$arr_mrg = array_merge($temp_daycoll,$daycoll);
		
		$stu_dataarray = array(
			'eward' 		=> $stu_data[0]->HOUSENAME, 
			'student_name'  => $stu_data[0]->FIRST_NM,
			'class'			=> $stu_data[0]->DISP_CLASS,
			'sec'			=> $stu_data[0]->DISP_SEC,
			'ROLL_NO'		=> $stu_data[0]->ROLL_NO,
			'Adm_no'		=> $stu_data[0]->ADM_NO,
			'FATHER_NM'		=> $stu_data[0]->FATHER_NM,
			'arr_mrg' 		=> $arr_mrg,
			'feehead' 		=> $feehead,
			'feegeneration' => $feegeneration
		);
		echo "<pre>";
		print_r($stu_dataarray);
		exit;
		if(!empty($stu_dataarray['arr_mrg'])){
				$this->load->view('class_report/feepaid_ledgerdetails',$stu_dataarray);
			}else{
				echo "<center><h1>Sorry No Data Found Not Paid Any Month Fee</h1></center>";
			}
		
	}
	public function gen_pdf(){
		ini_set('memory_limit', '-1');
		$adm_no = $this->input->post('adm');
		$stuname = $this->input->post('stuname');
		$roll = $this->input->post('roll');
		$class = $this->input->post('class');
		$sec = $this->input->post('sec');
		$ward = $this->input->post('ward');
		$father = $this->input->post('father');
		$school_setting = $this->dbcon->select('school_setting','*');
		$temp_daycoll = $this->dbcon->select('temp_daycoll','*',"ADM_NO='$adm_no' AND SEC='Z' ORDER BY RECT_DATE");
		$daycoll = $this->dbcon->select('daycoll','*',"ADM_NO='$adm_no' ORDER BY RECT_DATE");
		$feehead = $this->dbcon->select('feehead','*');
		$arr_mrg = array_merge($temp_daycoll,$daycoll);
		$stu_dataarray = array(
			'eward' 		=> $ward, 
			'student_name'  => $stuname,
			'class'			=> $class,
			'sec'			=> $sec,
			'ROLL_NO'		=> $roll,
			'Adm_no'		=> $adm_no,
			'FATHER_NM'		=> $father,
			'arr_mrg' 		=> $arr_mrg,
			'school_setting' => $school_setting,
			'feehead' 		=> $feehead
		);
		$this->load->view('class_report/feepaid_ledgerpdf',$stu_dataarray);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream("feepaid_details.pdf", array("Attachment"=>0));
	}
}
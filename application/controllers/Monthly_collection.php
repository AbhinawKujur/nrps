<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Monthly_collection extends MY_controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}

	public function month_collection()
	{
		$this->fee_template('Fee_collection/monthly_collection');
	}

	public function monthly_adm_data()
	{
		$adm_no = $this->input->post('val');
		$stu_data = $this->dbcon->select('student','*',"ADM_NO='$adm_no' AND Student_Status='ACTIVE'");
		if(!empty($stu_data)){
			$stu_id = $stu_data[0]->STUDENTID;
		}else{
			$stu_id = "n/a";
		}
		$pre_dues = $this->dbcon->select('previous_year_feegeneration','sum(TOTAL)TOTAL',"ADM_NO='$adm_no'");
		$pre_dues_amt = $pre_dues[0]->TOTAL;
		if($pre_dues_amt == null){
			$pre_dues1 = 0;
		}else{
			$pre_dues1 = $pre_dues_amt;
		}
		
		$cnt=count($stu_data);
		$ar_data = array($cnt,$pre_dues1,$stu_id);
		echo json_encode($ar_data);
	}

	public function show_student()
	{
		$details = $this->dbcon->select('student','ADM_NO,FIRST_NM,DISP_CLASS,DISP_SEC,FATHER_NM,MOTHER_NM',"Student_Status='ACTIVE'");
		echo json_encode($details);
	}

	public function stu_data()
	{
		$adm_no = $this->input->post('val');
		$User_Id = $this->session->userdata('user_id');
		$stu_data = $this->dbcon->monthly_collection($adm_no);

		$array = array(
			'student_data' => $stu_data,
			//'master' => $master
		);
		
		$this->load->view('Fee_collection/month_collection_data',$array);	
	}

	public function showledger_monthly_collection()
	{
		$adm = $this->input->post('adm_no');
		$std_ldgr = $this->dbcon->select('daycoll','*',"ADM_NO='$adm'");
		echo json_encode($std_ldgr);
	}

}
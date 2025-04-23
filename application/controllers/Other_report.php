<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Other_report extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function show_other_report(){
		$this->fee_template('other_report2/show_report');
	}
	public function show_other_report2(){
		$class = $this->dbcon->select('classes','*');
		$sec = $this->dbcon->select('sections','*');
		$array = array(
			'class' => $class,
			'sec' => $sec
		);
		$this->fee_template('other_report2/other_report_view',$array);
	}
	public function find_details(){
		
		$class_name = $this->input->post('class_name');
		$sec_name = $this->input->post('sec_name');
		$short_by = $this->input->post('short_by');
		$mobile = $this->input->post('mobile');
		$student = $this->dbcon->select('student','ADM_NO,FIRST_NM,ROLL_NO,C_MOBILE',"CLASS='$class_name' AND SEC='$sec_name' AND Student_Status='ACTIVE' ORDER BY $short_by");
		$array = array(
			'student' => $student,
			'mobile'  => $mobile
		);
		$this->load->view('other_report2/show_awad_data_table',$array);
		
	}
	//new

	public function monthly_join_leave()
	{
		// $this->load->view('other_report2/monthly_join_leave',$array);
		$this->fee_template('other_report2/monthly_join_leave', $array);
	}

	public function monthlty_join_report()
	{
		$s_date = $this->input->post('s_date');
		$e_date = $this->input->post('e_date');
		$choice = $this->input->post('choice');

		if ($choice == '1') {
			$data['data']=$this->db->query("SELECT ADM_NO , FIRST_NM , DISP_CLASS , DISP_SEC ,Roll_no,P_MOBILE  FROM student WHERE ADM_DATE BETWEEN '$s_date' AND '$e_date' ")->result();
			// echo $this->db->last_query();
		}
		else
		{
			$data['data']=$this->db->query("SELECT adm_no as ADM_NO , name as FIRST_NM ,current_Class as DISP_CLASS,
			(SELECT DISP_SEC from student WHERE student.ADM_NO=tc.adm_no)DISP_SEC,
			(SELECT Roll_no from student WHERE student.ADM_NO=tc.adm_no)Roll_no,
			(SELECT c_mobile from student WHERE student.ADM_NO=tc.adm_no)P_MOBILE
			FROM `tc` WHERE ADM_DATE BETWEEN '$s_date' AND '$e_date' ")->result();
			// echo $this->db->last_query();
		}
		$data['s_date']=$s_date;
		$data['e_date']=$e_date;
		$data['choice']=$choice;

		if (!empty($data['data'])) {
		   $this->load->view('other_report2/monthly_join_leave_report', $data);
	   } else {
		   echo "<center><h1>Sorry No Student</h1></center>";
	   }
	}
	public function download_monthly_join()
	{
		$s_date = $this->input->post('s_date');
		$e_date = $this->input->post('e_date');
		$choice = $this->input->post('choice');

		$school_setting = $this->dbcon->select('school_setting', '*');

		if ($choice == '1') {
			$data['data']=$this->db->query("SELECT ADM_NO , FIRST_NM , DISP_CLASS , DISP_SEC ,Roll_no,P_MOBILE  FROM student WHERE ADM_DATE BETWEEN '$s_date' AND '$e_date' ")->result();
			// echo $this->db->last_query();
		}
		else
		{
			$data['data']=$this->db->query("SELECT adm_no as ADM_NO , name as FIRST_NM ,current_Class as DISP_CLASS,(SELECT DISP_SEC from student WHERE student.ADM_NO=tc.adm_no)DISP_SEC,(SELECT Roll_no from student WHERE student.ADM_NO=tc.adm_no)Roll_no,(SELECT c_mobile from student WHERE student.ADM_NO=tc.adm_no)P_MOBILE	FROM `tc` WHERE ADM_DATE BETWEEN '$s_date' AND '$e_date' ")->result();
			// echo $this->db->last_query();
		}

		$data['school_setting']=$school_setting;
		$data['s_date']=$s_date;
		$data['e_date']=$e_date;
		$data['choice']=$choice;

		$this->load->view('other_report2/download_monthly_join', $data);


        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A3', 'landscape');
        $this->dompdf->render();
        $this->dompdf->stream("download_monthly_join/leave.pdf", array("Attachment" => 0));
	}
	public function pdf($class_name,$sec_name,$short_by,$mobile){
		$student = $this->dbcon->select('student','ADM_NO,FIRST_NM,ROLL_NO,DISP_CLASS,DISP_SEC,C_MOBILE',"CLASS='$class_name' AND SEC='$sec_name' AND Student_Status='ACTIVE' ORDER BY $short_by");
		$school_setting = $this->dbcon->select('school_setting','*');
		$array = array(
			'student' => $student,
			'school_setting' => $school_setting,
			'class_no' => $class_name,
			'sec_name' => $sec_name,
			'mobile'	=> $mobile
		);
		$this->load->view('other_report2/show_awad_data_table_pdf',$array);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream("Award List.pdf", array("Attachment"=>0));



	}
}
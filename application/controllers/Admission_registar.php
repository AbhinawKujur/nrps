<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admission_registar extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$this->load->model('Mymodel', 'dbcon');
	}
	public function show_registar_student()
	{
		$class = $this->dbcon->select('classes', '*');
		$sec = $this->dbcon->select('sections', '*');
		$array = array(
			'class' => $class,
			'sec' => $sec
		);
		$this->fee_template('admission_registar/student_registar', $array);
	}
	public function student_register_class($clss = '', $secc = '')
	{
		// echo "jj ".$clss;die;
		if (!empty($clss && $secc)) {
			$classs = $clss;
			$sec = $secc;
		} else {
			$classs = $this->input->post('classs');
			$sec = $this->input->post('sec');
		}
		$session_master = $this->dbcon->select('session_master', '*', "Active_Status=1");
		$year = $session_master[0]->Session_Year;
		$student = $this->dbcon->select('student st', 'ADM_NO,ROLL_NO,FIRST_NM,BIRTH_DT,FATHER_NM,MOTHER_NM,ADM_DATE,(SELECT CLASS_NM FROM classes WHERE classes.Class_No=st.ADM_CLASS)ADM_CLASS_id,(SELECT stoppage FROM stoppage WHERE stoppage.STOPNO=st.STOPNO)other_stop', "DISP_CLASS='$classs' AND DISP_SEC='$sec' AND Student_Status='ACTIVE' ORDER BY ADM_DATE, LEFT(ADM_NO,3)");
		$school_setting = $this->dbcon->select('school_setting', '*');

		$array = array(
			'school_setting' => $school_setting,
			'class' => $classs,
			'sec' => $sec,
			'student' => $student
		);
		if (!empty($clss && $sec)) {
			// echo "<pre>";print_r($array);die;
			$this->load->view('admission_registar/show_data_class_wise_PDF', $array);
			$html = $this->output->get_output();
			$this->load->library('pdf');
			$this->dompdf->loadHtml($html);
			$this->dompdf->setPaper('A3', 'portrait');
			$this->dompdf->render();
			$this->dompdf->stream("ADMISSION REGISTER.pdf", array("Attachment" => 0));
		} else {
			if (!empty($array['student'])) {
				$this->load->view('admission_registar/show_data_class_wise', $array);
			} else {
				echo "<center><h1>Sorry No Data Found</h1></center>";
			}
		}
	}
	//security_registar
	public function security_registar()
	{
		 // $this->load->view('Security_reg/security_reg',$array);
		 $this->fee_template('Security_reg/security_reg', $array);
	}
	
	public function security_registar_details()
	{
		 $s_date        = $this->input->post('s_date');

         $e_date        = $this->input->post('e_date');
	
		$data = $this->db->query("SELECT adm_no,STU_NAME , RECT_NO , CLASS ,SEC,ROLL_NO,Fee16, RECT_DATE FROM `daycoll` WHERE Fee16 >0 AND RECT_DATE BETWEEN '$s_date' AND '$e_date'")->result();
		
        $data['data'] = $data;
        $data['s_date'] = $s_date;
        $data['e_date'] = $e_date;

        if (!empty($data['data'])) {
			 // $this->load->view('Security_reg/security_reg_report',$array);
            $this->load->view('Security_reg/security_reg_report', $data);
        } else {
            echo "<center><h1>Sorry No Student</h1></center>";
        }

	}

	public function download_security_registar()
    {
        $s_date        = $this->input->post('s_date');

        $e_date        = $this->input->post('e_date');

		$school_setting = $this->dbcon->select('school_setting', '*');
		
		$data = $this->db->query("SELECT adm_no,STU_NAME , RECT_NO , CLASS ,SEC,ROLL_NO,Fee16, RECT_DATE FROM `daycoll` WHERE Fee16 >0 AND RECT_DATE BETWEEN '$s_date' AND '$e_date'")->result();
	
        $data['data'] = $data;
        $data['school_setting'] = $school_setting;
		
      

        $this->load->view('Security_reg/download_security_reg', $data);


        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A3', 'landscape');
        $this->dompdf->render();
        $this->dompdf->stream("ADMISSION REGISTER.pdf", array("Attachment" => 0));
    }
	public function student_details_date_wise($day1 = '', $day2 = '')
	{
		if (empty($day1 && $day2)) {
			$date1 = $this->input->post('date1');
			$date2 = $this->input->post('date2');
		} else {
			$date1 = $day1;
			$date2 = $day2;
		}
		$session_master = $this->dbcon->select('session_master', '*', "Active_Status=1");
		$year = $session_master[0]->Session_Year;
		$student = $this->dbcon->select('student st', 'ADM_NO,ROLL_NO,FIRST_NM,BIRTH_DT,FATHER_NM,MOTHER_NM,ADM_DATE,(SELECT CLASS_NM FROM classes WHERE classes.Class_No=st.ADM_CLASS)ADM_CLASS_id,(SELECT stoppage FROM stoppage WHERE stoppage.STOPNO=st.STOPNO)other_stop', "ADM_DATE BETWEEN '$date1' AND '$date2' AND Student_Status='ACTIVE' ORDER BY ADM_DATE, LEFT(ADM_NO,3)");
		$school_setting = $this->dbcon->select('school_setting', '*');

		$array = array(
			'school_setting' => $school_setting,
			'date1' => $date1,
			'date2' => $date2,
			'student' => $student
		);
		if (empty($day1 && $day2)) {
			if (!empty($array['student'])) {
				$this->load->view('admission_registar/show_data_class_wise', $array);
			} else {
				echo "<center><h1>Sorry No Data Found</h1></center>";
			}
		} else {
			// echo "<pre>";
			// print_r($array);
			// die;
			$this->load->view('admission_registar/show_data_class_wise_PDF', $array);
			$html = $this->output->get_output();
			$this->load->library('pdf');
			$this->dompdf->loadHtml($html);
			$this->dompdf->setPaper('A3', 'portrait');
			$this->dompdf->render();
			$this->dompdf->stream("ADMISSION REGISTER.pdf", array("Attachment" => 0));
		}
	}
}

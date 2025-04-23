<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ward_report extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->loggedOut();
        $this->load->model('Mymodel', 'dbcon');
    }

    public function show_class()
    {
        $this->fee_template('class_report/show_report');
    }

    public function ward_report()
    {
        $ward = $this->dbcon->select('eward', '*');
        $class = $this->dbcon->select('classes', '*');

        $array = array(
            'ward' => $ward,
            'class' => $class
        );
        // $this->fee_template('class_report/class_wise_ledger', $array);

        $this->fee_template('ward_category/ward_category_report', $array);
    }

    public function find_details()
    {
        $sql['ward'] = $ward = $this->input->post('ward_name');
        $sql['class'] = $classs = $this->input->post('class_name');

        if ($classs == 99) {
            $sql['data'] = $this->db->query("SELECT ADM_NO , FIRST_NM , DISP_CLASS , DISP_SEC , ROLL_NO , FATHER_NM , MOTHER_NM, EMP_WARD FROM `student` WHERE EMP_WARD=$ward AND STUDENT_STATUS='ACTIVE' AND DISP_SEC NOT IN ('TC','Z') ORDER BY CLASS,ROLL_NO")->result();
        } else {
            $sql['data'] = $this->db->query("SELECT ADM_NO , FIRST_NM , DISP_CLASS , DISP_SEC , ROLL_NO , FATHER_NM , MOTHER_NM, EMP_WARD FROM `student` WHERE CLASS=$classs AND EMP_WARD='$ward' AND STUDENT_STATUS='ACTIVE' AND DISP_SEC NOT IN ('TC','Z') ORDER BY SEC,ROLL_NO")->result();
        }
		
		$sql['ward_name'] = $this->db->query("SELECT HOUSENAME FROM `EWARD` WHERE HOUSENO=$ward;")->row_array();


        $this->load->view('ward_category/find_details_ward', $sql);
    }

    public function download_ward_wise_pdf()
    {
        $ward = $this->input->post('ward');
        $class = $this->input->post('class');

        $school_setting = $this->dbcon->select('school_setting', '*');
         
        if ($class == 99) {
            $sql = $this->db->query("SELECT ADM_NO , FIRST_NM , DISP_CLASS , DISP_SEC , ROLL_NO , FATHER_NM , MOTHER_NM, EMP_WARD FROM `student` WHERE EMP_WARD=$ward AND STUDENT_STATUS='ACTIVE' AND DISP_SEC NOT IN ('TC','Z') ORDER BY CLASS,ROLL_NO")->result_array();
        } else {
            $sql = $this->db->query("SELECT ADM_NO , FIRST_NM , DISP_CLASS , DISP_SEC , ROLL_NO , FATHER_NM , MOTHER_NM, EMP_WARD FROM `student` WHERE CLASS=$class AND EMP_WARD='$ward' AND STUDENT_STATUS='ACTIVE' AND DISP_SEC NOT IN ('TC','Z') ORDER BY SEC,ROLL_NO")->result_array();
        }

        $sql1 = $this->db->query("SELECT HOUSENAME FROM `EWARD` WHERE HOUSENO=$ward;")->row_array();

        $data = array(
            'student_data' => $sql,
            'school_setting' => $school_setting,
            'ward' => $sql1,
            'class' => $class
        );
        // echo '<pre>';print_r($data);die;
        $this->load->view('ward_category/find_details_ward_pdf', $data);
        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'potrait');
        $this->dompdf->render();
        $this->dompdf->stream("Ward_Category_Report.pdf", array("Attachment" => 0));
    }

    public function download_bus_wise_pdf()
    {
        $class_name = $this->session->userdata('classname');
        $sec_name =  $this->session->userdata('secname');
        $fee_type =  $this->session->userdata('fee_type');
        $short_by =  $this->session->userdata('short_by');
        $fee =  $this->session->userdata('fee');
        $student_data = $this->dbcon->bus_wise_ledger($class_name, $sec_name, $short_by, $fee);
        $school_setting = $this->dbcon->select('school_setting', '*');
        $classec = $this->dbcon->select('student', 'DISP_CLASS,DISP_SEC', "CLASS=$class_name AND SEC=$sec_name AND STUDENT_STATUS='ACTIVE'");
        $data = array(
            'student_data' => $student_data,
            'school_setting' => $school_setting,
            'classec' => $classec
        );
        $this->load->view('class_report/bus_wise_month_pdf', $data);

        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A3', 'landscape');
        $this->dompdf->render();
        $this->dompdf->stream("bus_wise_report.pdf", array("Attachment" => 1));
    }
}

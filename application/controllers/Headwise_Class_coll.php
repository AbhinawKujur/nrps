<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Headwise_Class_coll extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->loggedOut();
        $this->load->model('Mymodel', 'dbcon');
    }

    public function headwise_class()
    {
        $class = $this->db->query("SELECT * FROM CLASSES")->result();
        $sec = $this->db->query("SELECT * FROM SECTIONS")->result();
        $feehead = $this->db->query("select ACT_CODE,FEE_HEAD from feehead order by ACT_CODE")->result();


        $array = array(
            'class' => $class,
            'sec' => $sec,
            'feehead' => $feehead
        );

        $this->fee_template('class_report/headwise_cls_coll', $array);
    }

    public function get_details()
    {
        $class = $this->input->post('class_name');
        $sec = $this->input->post('sec_name');
        $fee_type = $this->input->post('fee_type');
        $sort_by = $this->input->post('sort_by');

         if ($sec==99){
            $sql = $this->db->query("SELECT ADM_NO,CONCAT_WS(' ',FIRST_NM,MIDDLE_NM,TITLE_NM) AS STU_NAME,ROLL_NO,DISP_CLASS,(SELECT SUM(FEE$fee_type) FROM DAYCOLL WHERE ADM_NO = STUDENT.ADM_NO)AS TOTAL from STUDENT where CLASS=$class AND STUDENT_STATUS='ACTIVE' GROUP BY ADM_NO order by $sort_by")->result();
        }
        else{
            $sql = $this->db->query("SELECT ADM_NO,CONCAT_WS(' ',FIRST_NM,MIDDLE_NM,TITLE_NM) AS STU_NAME,ROLL_NO,DISP_CLASS,DISP_SEC,(SELECT SUM(FEE$fee_type) FROM DAYCOLL WHERE ADM_NO = STUDENT.ADM_NO)AS TOTAL from STUDENT where CLASS=$class and SEC=$sec AND STUDENT_STATUS='ACTIVE' GROUP BY ADM_NO order by $sort_by")->result();
        }
        
        $array = array(
            'class' => $class,
            'sec' => $sec,
            'fee_type' => $fee_type,
            'sort_by' => $sort_by,
            'data' => $sql
        );

        $this->load->view('class_report/headwise_cls_coll_report', $array);
    }
    public function headwise_fee_coll_pdf()
    {
        $class = $this->input->post('class_name');
        $sec = $this->input->post('sec_name');
        $fee_type = $this->input->post('fee_type');
        $sort_by = $this->input->post('sort_by');

         if ($sec==99){
            $sql = $this->db->query("SELECT ADM_NO,CONCAT_WS(' ',FIRST_NM,MIDDLE_NM,TITLE_NM) AS STU_NAME,ROLL_NO,DISP_CLASS,(SELECT SUM(FEE$fee_type) FROM DAYCOLL WHERE ADM_NO = STUDENT.ADM_NO)AS TOTAL from STUDENT where CLASS=$class AND STUDENT_STATUS='ACTIVE' GROUP BY ADM_NO order by $sort_by")->result();
        }
        else{
            $sql = $this->db->query("SELECT ADM_NO,CONCAT_WS(' ',FIRST_NM,MIDDLE_NM,TITLE_NM) AS STU_NAME,ROLL_NO,DISP_CLASS,DISP_SEC,(SELECT SUM(FEE$fee_type) FROM DAYCOLL WHERE ADM_NO = STUDENT.ADM_NO)AS TOTAL from STUDENT where CLASS=$class and SEC=$sec AND STUDENT_STATUS='ACTIVE' GROUP BY ADM_NO order by $sort_by")->result();
        }
        
        $school_setting = $this->dbcon->select('school_setting','*');

        $array = array(
            'class' => $class,
            'sec' => $sec,
            'feehead' => $fee_type,
            'sort_by' => $sort_by,
            'data' => $sql,
            'school_setting' =>$school_setting,
        );

        $this->load->view('class_report/headwise_fee_coll_pdf', $array);

        $html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'Portrait');
		$this->dompdf->render();
		$this->dompdf->stream("Headwise Fee Collection Class Report ".$class." ".$sec.".pdf", array("Attachment" => 0));
    }
}

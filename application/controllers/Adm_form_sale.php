<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Adm_form_sale extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->loggedOut();
        $this->load->model('Mymodel', 'dbcon');
    }

    public function adm_form_sale()
    {
        $class = $this->dbcon->select('classes', '*');
        $sec = $this->dbcon->select('sections', '*');
        $array = array(
            'class' => $class,
            'sec' => $sec
        );

        // $this->load->view('Adm_Sale_report/adm_form_sale',$array);
        $this->fee_template('Adm_Sale_report/adm_form_sale', $array);
    }

    public function adm_form_details()
    {
        $class        = $this->input->post('class_name');

        $s_date        = $this->input->post('s_date');

        $e_date        = $this->input->post('e_date');

        if ($class == 'all') {
            $data = $this->db->query("SELECT STU_NAME , FORM_NO , CLASS , RECT_DATE FROM `daycoll` WHERE period LIKE '%ADM%' AND RECT_DATE BETWEEN '$s_date' AND '$e_date'")->result();
        } else {
            $data = $this->db->query("SELECT STU_NAME , FORM_NO , CLASS , RECT_DATE FROM `daycoll` WHERE CLASS='$class' AND  period LIKE '%ADM%' AND RECT_DATE BETWEEN '$s_date' AND '$e_date'")->result();

            // echo $this->db->last_query();

        }

        $data['data'] = $data;
        $data['class'] = $class;
        $data['s_date'] = $s_date;
        $data['e_date'] = $e_date;

        if (!empty($data['data'])) {
            $this->load->view('Adm_Sale_report/adm_form_report', $data);
        } else {
            echo "<center><h1>Sorry No Student</h1></center>";
        }
    }

    public function download_adm_sale_form()
    {
        $class        = $this->input->post('class');

        $s_date        = $this->input->post('s_date');

        $e_date        = $this->input->post('e_date');

        $data['school_setting'] = $this->dbcon->select('school_setting', '*');

        if ($class == 'all') {
            $data = $this->db->query("SELECT STU_NAME , FORM_NO , CLASS , RECT_DATE FROM `daycoll` WHERE period LIKE '%ADM%' AND RECT_DATE BETWEEN '$s_date' AND '$e_date'")->result();
        } else {
            $data = $this->db->query("SELECT STU_NAME , FORM_NO , CLASS , RECT_DATE FROM `daycoll` WHERE CLASS='$class' AND  period LIKE '%ADM%' AND RECT_DATE BETWEEN '$s_date' AND '$e_date'")->result();

            // echo $this->db->last_query();

        }

        $data['data'] = $data;
        $data['class'] = $class;
        $data['s_date'] = $s_date;
        $data['e_date'] = $e_date;

        // $this->load->view('student_report/studentlistPdf', $data);
        $this->load->view('Adm_Sale_report/download_adm_sale_form', $data);


        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A3', 'landscape');
        $this->dompdf->render();
        $this->dompdf->stream("Student_Information.pdf", array("Attachment" => 0));
    }
}

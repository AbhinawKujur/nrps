<?php
defined('BASEPATH') or exit('No direct script access allowed');

class List_of_Receipt extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->loggedOut();
        $this->load->model('Mymodel', 'dbcon');
    }

    public function list_of_rct()
    {
        // $this->load->view('List_of_Receipt/recp_list',$array);
        $this->fee_template('List_of_Receipt/recp_list');
    }

    public function list_recpt_details()
    {
        $s_date        = $this->input->post('s_date');

        $data['data'] = $this->db->query("SELECT RECT_NO , STU_NAME , ADM_NO , CLASS , SEC , ROLL_NO, period , TOTAL ,User_Id  FROM `daycoll` WHERE RECT_DATE='$s_date'")->result();
        
        
        $data['s_date'] = $s_date;
        if (!empty($data['data'])) {
            $this->load->view('List_of_Receipt/receipt_report', $data);
        } else {
            echo "<center><h1>Sorry No Student</h1></center>";
        }
    }

    public function download_receipt_list()
    {
        $s_date        = $this->input->post('s_date');

        $data['school_setting'] = $this->dbcon->select('school_setting', '*');

        $data['data'] = $this->db->query("SELECT RECT_NO , STU_NAME , ADM_NO , CLASS , SEC , ROLL_NO, period , TOTAL ,User_Id  FROM `daycoll` WHERE RECT_DATE='$s_date'")->result();
        $data['s_date'] = $s_date;
           
        // $this->load->view('student_report/studentlistPdf', $data);
        $this->load->view('List_of_Receipt/download_receipt_list', $data);


        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A3', 'landscape');
        $this->dompdf->render();
        $this->dompdf->stream("Student_Information.pdf", array("Attachment" => 0));
    }
}

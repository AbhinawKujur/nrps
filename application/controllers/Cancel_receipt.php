<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cancel_receipt extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$this->load->model('Mymodel', 'dbcon');
	}

	public function cancel_receipt()
	{
		$ROLE_ID = $this->session->userdata('ROLE_ID');
		$User_Id = $this->session->userdata('user_id');
		if ($ROLE_ID == 10) { // setting role id for fee admin where role id is 10
			$user_id = $this->dbcon->select('daycoll', 'DISTINCT(User_Id)');
		} else { // setting role id for bank collection where role id is 14
			$user_id = $this->dbcon->select('daycoll', 'DISTINCT(User_Id)', "User_Id='$User_Id'");
		}

		$data = array(
			'user_id' => $user_id,
			'ROLE_ID'  => $ROLE_ID
		);

		// $this->fee_template('Reports/headwise_summary', $data);
		$this->fee_template('Cancel_reciepts/cancel_receipt', $data);
		// $this->load->view('Cancel_reciepts/cancel_receipt', $data);
	}

	public function cancel_receipt_data()
	{
		$collectiontype    = $this->input->post('collectiontype');
		$collectioncounter = $this->input->post('collected_by');
		$single			   = $this->input->post('strt_date');
		$double			   = $this->input->post('end_date');
		$feehead = array();
		//echo '$collectiontype: '.'$collectiontype';
		//die;
		$feehead = $this->db->query("select FEE_HEAD from feehead order by ACT_CODE")->result();

		if ($collectioncounter == '%') {
			$data = $this->db->query("select ADM_NO , RECT_NO, RECT_DATE,CLASS,SEC,User_Id from daycoll where period LIKE '%CANCELLED%' AND RECT_DATE>='$single' AND RECT_DATE<='$double'")->result_array();

            // echo $this->db->last_query();
            // die;

		} else {

			$data = $this->db->query("select ADM_NO , RECT_NO, RECT_DATE,CLASS,SEC,User_Id from daycoll where period LIKE '%CANCELLED%'AND  User_Id LIKE '$collectioncounter' AND RECT_DATE>='$single' AND RECT_DATE<='$double'")->result_array();

            // echo $this->db->last_query();
            // die;

            
		}

		$array = array(
			'data'     => $data,

			'feehead' => $feehead,
			'collectiontype' => $collectiontype,
			'collectioncounter' => $collectioncounter,
			'single' => $single,
			'double' => $double,

		);
		// $this->load->view('Reports/headwise_summary_report', $array);
        $this->load->view('Cancel_reciepts/cancel_receipt_report', $array);
	}

	public function headwise_pdf()
	{
		$collectiontype    = $this->input->post('collectiontype');
		$collectioncounter = $this->input->post('collectioncounter');
		$single			   = $this->input->post('single');
		$double			   = $this->input->post('double');

		$school_setting = $this->dbcon->select('school_setting', '*');
		$feehead = $this->db->query("select FEE_HEAD from feehead order by ACT_CODE")->result();
		if ($collectioncounter == '%') {
			$data = $this->db->query("select sum(TOTAL)tot,sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25 from daycoll where Collection_Mode=$collectiontype AND RECT_DATE>='$single' AND RECT_DATE<='$double'")->result_array();
		} else {

			$data = $this->db->query("select sum(TOTAL)tot,sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25 from daycoll where User_Id LIKE '$collectioncounter' AND Collection_Mode=$collectiontype AND RECT_DATE>='$single' AND RECT_DATE<='$double'")->result_array();
		}

		$array = array(
			'school_setting' => $school_setting,
			'data' => $data,
			'feehead' => $feehead,
			'single' => $single,
			'double' => $double,
			'collectioncounter' => $collectioncounter,
			'collectiontype' => $collectiontype,
		);

		$this->load->view('Reports/headwise_summary_pdf', $array);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'Portrait');
		$this->dompdf->render();
		$this->dompdf->stream("Head wise Summary Report.pdf", array("Attachment" => 0));
	}
	
	public function headwise_data_PDF()
	{
		$collectiontype    = $this->input->post('collectiontype');
		$collectioncounter = $this->input->post('collectioncounter');
		$single			   = $this->input->post('single');
		$double			   = $this->input->post('double');

		$school_setting = $this->dbcon->select('school_setting', '*');
		$feehead = $this->db->query("select FEE_HEAD from feehead order by ACT_CODE")->result();

		if ($collectioncounter == '%') {
			$data = $this->db->query("select ADM_NO , RECT_NO, RECT_DATE,CLASS,SEC,User_Id from daycoll where period LIKE '%CANCELLED%' AND RECT_DATE>='$single' AND RECT_DATE<='$double'")->result_array();

            // echo $this->db->last_query();
            // die;

		} else {

			$data = $this->db->query("select ADM_NO , RECT_NO, RECT_DATE,CLASS,SEC,User_Id from daycoll where period LIKE '%CANCELLED%'AND  User_Id LIKE '$collectioncounter' AND RECT_DATE>='$single' AND RECT_DATE<='$double'")->result_array();
            
            // echo $this->db->last_query();
            // die;

            
		}

		$array = array(
			'school_setting' => $school_setting,
			'data' => $data,
			'feehead' => $feehead,
			'single' => $single,
			'double' => $double,
			'collectioncounter' => $collectioncounter,
			'collectiontype' => $collectiontype,
		);

		// $this->load->view('Reports/headwise_summary_pdf', $array);

        $this->load->view('Cancel_reciepts/cancel_receipt_report_pdf', $array);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'Portrait');
		$this->dompdf->render();
		$this->dompdf->stream("Head_Wise_Summary_Report.pdf", array("Attachment" => 0));
	}
}
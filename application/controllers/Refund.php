<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Refund extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
    public function refund_details()
    {

        $this->fee_template('Refund/stu_refund_details');
        // $this->load->view('Refund/stu_refund_details');
    }

    public function stu_data()
	{
		$data = $this->input->post('value');
		$student_data = $this->dbcon->select('student', '*', "ADM_NO='$data'");
		$refund_daycoll = $this->dbcon->select('daycoll', '*', "ADM_NO='$data'");
		$name = $student_data[0]->FIRST_NM;
		$fname = $student_data[0]->FATHER_NM;
		$class = $student_data[0]->DISP_CLASS;
		$adm_date = $student_data[0]->ADM_DATE;
		$sec = $student_data[0]->DISP_SEC;
		$classcode = $student_data[0]->CLASS;
        $rect_no= $refund_daycoll[0]->RECT_NO;
        $rect_date= $refund_daycoll[0]->RECT_DATE;
        $total= $refund_daycoll[0]->Fee16 ;
        $adm_no_d= $refund_daycoll[0]->ADM_NO ;
		$clssec = $class . "-" . $sec;
		$cnt = count($adm);
		$array = array($data, $cnt, $name, $clssec, $roll, $adm, $classcode,$fname,$adm_date,$rect_no,$rect_date,$total,$adm_no_d);
		echo json_encode($array);
	}

    public function save_refundable()
	{
		$admission = $this->input->post('admission');
		$fee16 = $this->input->post('total');
        
		$student = $this->dbcon->select('student', '*', "ADM_NO='$admission'");
		$std_id = $student[0]->STUDENTID;
		$classec = $this->input->post('clssec');
		$septrater = explode("-", $classec);
		$class = $septrater[0]; //XII ARTS
		$sec = $septrater[1]; //A

		

		$array = array(
			'ADM_NO' => $admission,
			'STU_NAME' => strtoupper($this->input->post('name')),
			'STUDENTID' => $std_id,
			'CLASS' => $class,
			'SEC' => $sec,
            'RECT_NO'=>$this->input->post('rect_no'),
            'RECT_DATE'=>$this->input->post('rect_date'),
            'Fee16'=> $fee16
		);
		
		if ($fee16 > 0) {
			$this->dbcon->insert_select($admission);
			// echo $this->db->last_query();die;
			$this->session->set_flashdata('msg', "Saved Successfully");
			redirect('Refund/refund_details');
		} else {
			$this->session->set_flashdata('msg', "Not Applicable");
			redirect('Refund/refund_details');
		}
		if(isset($_POST['print'])){
			
		}
	}

	public function print_refundable()
	{
		$adm_no = $this->input->post('ad_d');
		$stu_data = $this->dbcon->select('student', '*', "ADM_NO='$adm_no'");
		$school_setting = $this->dbcon->select('school_setting', '*');
		$daycoll_data= $this->dbcon->select('daycoll', '*', "ADM_NO='$adm_no'");
		// echo'<pre>';print_r($data);die;
		$data = array(
			'stu_data' => $stu_data,
			'daycoll_data' => $daycoll_data,
			'school_setting' => $school_setting
		);
		// $this->load->view('certificate/dob_report_pdf', $details_array);
		$this->load->view('Refund/stu_refund_pdf',$data);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream($adm_no . "-ref.pdf", array("Attachment" => 0));
	}
	
}
?>
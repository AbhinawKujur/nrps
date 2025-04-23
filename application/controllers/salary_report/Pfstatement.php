<?php 

class pfstatement extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}

	public function index()
	{
		if(!in_array('viewPfEsiStatement', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		$data['title'] = "PF Statement Employee wise";
		$resultList = array();
		$resultList = $this->sumit->fetchAllData('*','employee',array('STATUS'=>1,'PF_APP'=>1));
		$data['resultList'] = $resultList;
		$this->render_template('salary_report/pfStatementEmployeeWise',$data);
	}

	public function generatePDF($id)
	{
		if(!in_array('viewPfEsiStatement', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		ini_set('memory_limit', '-1');
		$data['school_setting'] = $this->sumit->fetchSingleData('*','school_setting',array('S_No'=>1));
		$data['employeeData'] = $this->sumit->fetchSingleData('*','employee',array('id'=>$id));
		$payslipData = $this->sumit->fetchAllData('*','payslip_dbo',array('emp_id'=>$id));
		$data['payslipData'] = $payslipData;
		$this->load->view('salary_report/pfStatementEmployeeWisePDF',$data);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->set_option("isPhpEnabled", true);
		$this->dompdf->stream("pfstatement".$id.".pdf", array("Attachment"=>0));
	}
}

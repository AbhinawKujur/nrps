<?php 

class Salary_bill extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}

	public function index()
	{
		if(!in_array('viewSalaryBill', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		$data['title'] = "Salary Bill";
		if(isset($_POST['search']))
		{
			$resultList = array();
			$date = $this->input->post('date');
			$month = date('m',strtotime($date));
			$year = date('Y',strtotime($date));
			$data['month'] = $month;
			$data['year'] = $year;
			$check_data = $this->sumit->checkData('id','payslip_dbo',array('payslip_month'=>$month,'payslip_year'=>$year));
			if($check_data)
			{
				$resultList = $this->Salary_Model->getSalaryBill($year,$month);
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-info">Payslip not generated for this month.</div>');
			}
			$data['resultList'] = $resultList;
		}
		$this->render_template('salary_report/salaryBillReport',$data);
	}

	public function generateSalaryPDFReport($year,$month)
	{
		if(!in_array('viewSalaryBill', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		ini_set('memory_limit', '-1');
		$data['school_setting'] = $this->sumit->fetchSingleData('*','school_setting',array('S_No'=>1));

		$current_session =$this->sumit->fetchSingleData('Session_Nm','session_master',array('Active_Status'=>1));
		$data['current_session'] = $current_session;
		$resultList = $this->Salary_Model->getSalaryBill($year,$month);
		$data['resultList'] = $resultList;
		$data['month'] = $month;
		$data['year'] = $year;
		$this->load->view('salary_report/salaryBillReportPDF',$data);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A2', 'landscape');
		$this->dompdf->render();
		$this->dompdf->set_option("isPhpEnabled", true);
		$this->dompdf->stream("salaryBillReport.pdf", array("Attachment"=>0));
	}

	public function generateSalaryRegisterPDFReport($year,$month)
	{
		if(!in_array('viewSalaryBill', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		ini_set('memory_limit', '-1');
		$data['school_setting'] = $this->sumit->fetchSingleData('*','school_setting',array('S_No'=>1));

		$current_session =$this->sumit->fetchSingleData('Session_Nm','session_master',array('Active_Status'=>1));
		$data['current_session'] = $current_session;
		$resultList = $this->Salary_Model->getSalaryBill($year,$month);
		$data['resultList'] = $resultList;
		$data['month'] = $month;
		$data['year'] = $year;
		$this->load->view('salary_report/salaryRegisterPDF',$data);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A2', 'landscape');
		$this->dompdf->render();
		$this->dompdf->set_option("isPhpEnabled", true);
		$this->dompdf->stream("salaryRegister.pdf", array("Attachment"=>0));
	}
}
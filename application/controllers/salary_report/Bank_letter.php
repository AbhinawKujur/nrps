<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_letter extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	}
	
	public function index()
	{
		if(!in_array('viewBankSalaryLetter', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		ini_set('memory_limit', '-1');
		$data['school_setting'] = $this->sumit->fetchSingleData('*','school_setting',array('S_No'=>1));

		$current_session =$this->sumit->fetchSingleData('Session_Nm','session_master',array('Active_Status'=>1));
		$active_month = $this->sumit->fetchSingleData('*','month_master',array('active_month'=>1));
		$session_year = explode('-', $current_session['Session_Nm']);
		$current_year = $session_year[0];
		$data['current_session'] = $current_session;
		if($active_month['month_code'] < 4)
		{
			$current_year = $session_year[1];
		}

		$payslipData = $this->Salary_Model->getBankSalaryReport($active_month['month_code'],$current_year);
		$data['payslipData'] = $payslipData;
		$data['current_year'] = $current_year;
		$data['current_month'] = $active_month['month_code'];
		$this->render_template('salary_report/bankSalaryLetter',$data);
	}

	public function generatePDF()
	{
		if(!in_array('viewBankSalaryLetter', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		ini_set('memory_limit', '-1');
		$data['school_setting'] = $this->sumit->fetchSingleData('*','school_setting',array('S_No'=>1));

		$current_session =$this->sumit->fetchSingleData('Session_Nm','session_master',array('Active_Status'=>1));
		$active_month = $this->sumit->fetchSingleData('*','month_master',array('active_month'=>1));
		$session_year = explode('-', $current_session['Session_Nm']);
		$current_year = $session_year[0];
		$data['current_session'] = $current_session;
		if($active_month['month_code'] < 4)
		{
			$current_year = $session_year[1];
		}

		$payslipData = $this->Salary_Model->getBankSalaryReport($active_month['month_code'],$current_year);
		$data['payslipData'] = $payslipData;
		$data['current_year'] = $current_year;
		$data['current_month'] = $active_month['month_code'];
		$this->load->view('salary_report/bank_salary_letter',$data);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->set_option("isPhpEnabled", true);
		$this->dompdf->stream("bank_letter.pdf", array("Attachment"=>0));
	}
}

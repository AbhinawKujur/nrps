<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form16 extends MY_Controller {
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
		$data['employeeList'] = $this->sumit->getEmployeeList("STATUS=1");
		$this->render_template('salary_report/form16EmployeeList',$data);
	}

	public function generatePDF()
	{
		// if(!in_array('viewBankSalaryLetter', permission_data))
		// {
		// 	redirect('payroll/dashboard/dashboard');
		// }
		$emp_id = $this->input->post('emp_id[]');
		$empIDImplode = implode("','", $emp_id);
		$employeeList = $this->sumit->getEmployeeList("employee.id IN ('$empIDImplode')");
		$payslip = array();
		foreach ($employeeList as $key => $value) {
			
			$payslip[$value['id']] = $this->Salary_Model->form16DataByEmployee($value['id']);
		}
		$data['principalDetails'] = $this->sumit->fetchSingleData('*','employee','DESIG=2');
		$data['payslip'] = $payslip;
		$data['employeeList'] = $employeeList;
		ini_set('memory_limit', '-1');
		$data['school_setting'] = $this->sumit->fetchSingleData('*','school_setting',array('S_No'=>1));

		$data['current_session'] =$this->sumit->fetchSingleData('Session_Nm','session_master',array('Active_Status'=>1));
		$this->load->view('salary_report/form_16_letter',$data);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->set_option("isPhpEnabled", true);
		$this->dompdf->stream("bank_letter.pdf", array("Attachment"=>0));
	}
}

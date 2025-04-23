<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Licreport extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	}
	
	public function index()
	{
		// if(!in_array('viewBankSalaryLetter', permission_data))
		// {
		// 	redirect('payroll/dashboard/dashboard');
		// }
		$data['title'] = 'LIC Report';
		if(isset($_POST['search']))
		{
			$month_year = $this->input->post('month_year');
			$data['month'] = date('m',strtotime($month_year));
			$data['year'] = date('Y',strtotime($month_year));
		}
		$this->render_template('salary_report/licReport',$data);
	}

	public function generatePDF()
	{
		// if(!in_array('viewBankSalaryLetter', permission_data))
		// {
		// 	redirect('payroll/dashboard/dashboard');
		// }
		$data['title'] = 'LIC Report';
		$month_year = $this->input->post('month_year');
		$month = date('m',strtotime($month_year));
		$year = date('Y',strtotime($month_year));

		$data['month'] = $month;
		$data['year'] = $year;
		$licList = $this->Salary_Model->getLICReport($year,$month);
		$resultList = array();
		$total_premium_amt = 0;

		foreach ($licList as $key => $value) 
		{
			for ($i=1; $i <= 5; $i++) 
			{ 
				if($value['premium_amt_'.$i] != '' && $value['premium_amt_'.$i] > 0)
				{
					$resultList[] = array(
						'EMP_NAME'	=> $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME'],
						'policy_number'	=> $value['policyno'.$i],
						'premium_amt'	=> $value['premium_amt_'.$i],
					);

					$total_premium_amt += $value['premium_amt_'.$i];
				}
			}
		}
		$data['total_premium_amt'] = $total_premium_amt;
		$data['resultList']= $resultList;
		$data['pfesiMaster'] = $this->Salary_Model->getMonthlyPercentage($year,$month);
		ini_set('memory_limit', '-1');
		$data['school_setting'] = $this->sumit->fetchSingleData('*','school_setting',array('S_No'=>1));
		$data['month'] = date('F', mktime(0, 0, 0, $month, 10)); 
		$data['year'] = $year;
		$data['current_session'] =$this->sumit->fetchSingleData('Session_Nm','session_master',array('Active_Status'=>1));
		$this->load->view('salary_report/licReportPDF',$data);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->set_option("isPhpEnabled", true);
		$this->dompdf->stream("licreport.pdf", array("Attachment"=>0));
	}
}

<?php 

class Groupinsreport extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}

	public function index()
	{
		// if(!in_array('viewMonthlySalarySlip', permission_data))
		// {
		// 	redirect('payroll/dashboard/dashboard');
		// }
		
		$data['title'] = "Group Insurance Report";
		if(isset($_POST['search']))
		{
			$resultList = array();
			$date = $this->input->post('date');
			$month = date('m',strtotime($date));
			$fullmonthname = date('m',strtotime($date));
			$year = date('Y',strtotime($date));
			$data['month'] = $fullmonthname;
			$data['year'] = $year;
			$check_data = $this->sumit->checkData('id','payslip_dbo',array('payslip_month'=>$month,'payslip_year'=>$year));
			if($check_data)
			{
				$resultList = $this->Salary_Model->getGroupInsuranceReport($year,$month);
				$sessionData = array(
					'resultList'	=> $resultList,
					'month'			=> $month,
					'year'			=> $year,
					'month_name'	=> $fullmonthname,
				);
				$this->session->set_userdata('groupInsuranceReportpdf',$sessionData);
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-info">Payslip not generated for this month.</div>');
			}
			$data['resultList'] = $resultList;
		}
		$this->render_template('salary_report/groupInsuranceReport',$data);
	}

	public function generatePDFReport()
	{
		// if(!in_array('viewMonthlySalarySlip', permission_data))
		// {
		// 	redirect('payroll/dashboard/dashboard');
		// }
		ini_set('memory_limit', '-1');
		$data['school_setting'] = $this->sumit->fetchSingleData('*','school_setting',array('S_No'=>1));
		
		$current_session =$this->sumit->fetchSingleData('Session_Nm','session_master',array('Active_Status'=>1));
		$data['current_session'] = $current_session;
		
		$data['resultData'] = $this->session->userdata('groupInsuranceReportpdf');
		$this->load->view('salary_report/groupInsuranceReportpdffile',$data);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->set_option("isPhpEnabled", true);
		$this->dompdf->stream("groupinsurancepdf.pdf", array("Attachment"=>1));
	}

}
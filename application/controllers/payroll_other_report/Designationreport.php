<?php 

class Designationreport extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}

	public function index()
	{
		if(!in_array('viewEMployeeReport', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		ini_set('memory_limit', '-1');
		$empData = $this->sumit->getEmployeeData();
		$data['empData'] = $empData;
		$staffType = $this->custom_lib->getStaffType();
		$data['staffType'] = $staffType;
		$this->render_template('other_report/reportByDesignation',$data);
	}

	public function generateEmpReportPDF()
	{
		if(!in_array('viewEMployeeReport', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
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
		$empData = $this->sumit->getEmployeeData();
		$data['empData'] = $empData;
		$staffType = $this->custom_lib->getStaffType();
		$data['staffType'] = $staffType;
		$data['current_year'] = $current_year;
		$data['current_month'] = $active_month['month_code'];
		$this->load->view('other_report/reportByDesignationPDF',$data);

		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'landscape');
		$this->dompdf->render();
		$this->dompdf->set_option("isPhpEnabled", true);
		$this->dompdf->stream("emp_report.pdf", array("Attachment"=>0));
	}
}
<?php 

class Yearly_salary_report extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}

	public function index()
	{
		if(!in_array('viewYearlySalaryReport', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		$data['employeeList'] = $this->sumit->fetchThreeJoin('employee.*,desig.DESIG,role_master.NAME as Role_name','employee','desig','role_master','employee.DESIG=desig.Sno','employee.ROLE_ID=role_master.ID',array('STATUS'=>1));
		$this->render_template('other_report/yearlySalaryReportEmployeeWise',$data);
	}

	public function generateSalaryPDFReport($emp_id=null)
	{
		if(!in_array('viewYearlySalaryReport', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		ini_set('memory_limit', '-1');
		$data['school_setting'] = $this->sumit->fetchSingleData('*','school_setting',array('S_No'=>1));

		$current_session =$this->sumit->fetchSingleData('Session_Nm','session_master',array('Active_Status'=>1));
		$data['current_session'] = $current_session;
		$resultData = $this->Salary_Model->getYearlySalaryReport($emp_id);
		$data['resultData'] = $resultData;
		$data['employeeDetails'] = $this->sumit->fetchSingleData('*','employee',array('id'=>$emp_id));
		$this->load->view('other_report/yearlySalaryReportEmployeeWisePDF',$data);

		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'landscape');
		$this->dompdf->render();
		$this->dompdf->set_option("isPhpEnabled", true);
		$this->dompdf->stream("yearlySalaryReportEmployeeWise.pdf", array("Attachment"=>0));
	}
}
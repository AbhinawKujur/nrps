<?php 

class Monthlypf_report extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}

	public function index()
	{
		if(!in_array('viewMonthlyPFReport', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		$data['title'] = "PF Statement";
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
				$resultList = $this->Salary_Model->getMonthlyPFStatement($year,$month);
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-info">Payslip not generated for this month.</div>');
			}
			$data['resultList'] = $resultList;
		}
		$this->render_template('salary_report/monthlyPFReport',$data);
	}
}
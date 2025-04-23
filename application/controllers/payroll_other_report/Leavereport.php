<?php 

class Leavereport extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}

	public function monthWiseLeaveReport()
	{
		if(!in_array('viewMonthlyLeaveReport', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		ini_set('memory_limit', '-1');
		
		if(isset($_POST['search']))
		{
			$date = $this->input->post('date');
			$month = date('m',strtotime($date));
			$year = date('Y',strtotime($date));
			$total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
			$data['total_days'] = $total_days;
			$data['month'] = $month;
			$data['year'] = $year;
			$check_atten_data = $this->sumit->checkData('att_month','monthly_emp_atten',array('att_month'=>$month,'att_year'=>$year));
			if($check_atten_data)
			{
				$dynamic_query =  ' ep.EMPID,ep.EMP_FNAME,ep.EMP_MNAME,ep.EMP_LNAME,(SELECT DESIG FROM desig WHERE Sno=ep.DESIG)designation';
				for($i=1;$i<=$total_days;$i++)
				{
					$custom_date = date('Y-m-d',strtotime($year.'-'.$month.'-'.$i));
					$dynamic_query .= ",(SELECT att_status FROM monthly_emp_atten WHERE empid=ep.EMPID AND date(att_date)='$custom_date')as'$i'";
				}
				$attendaceData = $this->sumit->fetchAllData($dynamic_query,'employee as ep',"ep.STATUS='1' order by ep.EMPID");
				$data['attendaceData'] = $attendaceData;
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-info">Attendance Not Generated</div>');
			}
		}
		$staffType = $this->custom_lib->getStaffType();
		$data['staffType'] = $staffType;
		$this->render_template('other_report/monthWiseLeaveReport',$data);
	}

	public function generateMonthlyLeaveReportPDF($year,$month)
	{
		if(!in_array('viewMonthlyLeaveReport', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		ini_set('memory_limit', '-1');
		$data['school_setting'] = $this->sumit->fetchSingleData('*','school_setting',array('S_No'=>1));

		$current_session =$this->sumit->fetchSingleData('Session_Nm','session_master',array('Active_Status'=>1));

		$total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		$data['total_days'] = $total_days;
		$data['month'] = $month;
		$data['year'] = $year;
		$dynamic_query =  ' ep.EMPID,ep.EMP_FNAME,ep.EMP_MNAME,ep.EMP_LNAME,(SELECT DESIG FROM desig WHERE Sno=ep.DESIG)designation';
		for($i=1;$i<=$total_days;$i++)
		{
			$custom_date = date('Y-m-d',strtotime($year.'-'.$month.'-'.$i));
			$dynamic_query .= ",(SELECT att_status FROM monthly_emp_atten WHERE empid=ep.EMPID AND date(att_date)='$custom_date')as'$i'";
		}
		$attendaceData = $this->sumit->fetchAllData($dynamic_query,'employee as ep',"ep.STATUS='1' order by ep.EMPID");
		$data['attendaceData'] = $attendaceData;
		$this->load->view('other_report/monthWiseLeaveReportPDF',$data);

		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'landscape');
		$this->dompdf->render();
		$this->dompdf->set_option("isPhpEnabled", true);
		$this->dompdf->stream("monthly_leave_report.pdf", array("Attachment"=>0));
	}
}
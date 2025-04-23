<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Applyleave extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}
	public function index()
	{
		if(!in_array('viewApplyLeave', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$session_data = $this->session->userdata('login_details');
		$data['leaveRequestList'] = $this->sumit->fetchAllData('*','emp_leave_attendance',array('EMPLOYEE_ID'=>$session_data['user_id']));
		$data['designation'] = $this->sumit->fetchAllData('*','desig',array());
		$data['leaveTypeList'] = $this->custom_lib->leaveRequestLiveType();
		$data['leaveReasonList'] = $this->custom_lib->getLeaveReason();
		$this->render_template('leave/applyLeave',$data);
	}

	public function manualLeave()
	{
		if(!in_array('viewApplyManualLeave', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$session_data = $this->session->userdata('login_details');
		if($session_data['ROLE_ID'] == 4 || $session_data['ROLE_ID'] == 1)
		{
			$data['employeeDetails'] = $this->sumit->fetchAllData('*','employee',array('STATUS'=>1));
		}
		elseif($session_data['ROLE_ID'] == 5)
		{
			$emp = $this->sumit->fetchSingleData('WING_MASTER_ID','employee',array('EMPID'=>$session_data['user_id']));
			$data['employeeDetails'] = $this->sumit->fetchAllData('*','employee',array('WING_MASTER_ID'=>$emp['WING_MASTER_ID'],'STATUS'=>1));
		}
		else
		{
			$emp = $this->sumit->fetchSingleData('WING_MASTER_ID','employee',array('EMPID'=>$session_data['user_id']));
			$data['employeeDetails'] = $this->sumit->fetchAllData('*','employee',array('WING_MASTER_ID'=>$emp['WING_MASTER_ID'],'ROLE_ID !='=>5,'STATUS'=>1));
		}
		$data['leaveRequestList'] = $this->sumit->fetchAllData('*','emp_leave_attendance',array('MANUAL_ADMIN_ID'=>$session_data['user_id']));
		$data['designation'] = $this->sumit->fetchAllData('*','desig',array());
		$data['leaveTypeList'] = $this->custom_lib->leaveRequestLiveType();
		$data['leaveReasonList'] = $this->custom_lib->getLeaveReason();
		$this->render_template('leave/applyManualLeave',$data);
	}

	public function create()
	{
		if(!(in_array('addApplyLeave', permission_data) || in_array('addApplyManualLeave', permission_data)))
		{
			redirect('payroll/dashboard/dashboard');
		}
		$response = array();
		$session_data = $this->session->userdata('login_details');

		$day_type = $this->input->post('day_type');
		$leave_reason = $this->input->post('leave_reason');
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$reason_details = $this->input->post('reason_details');

		$emp_id = $this->input->post('emp_id');
		$manual_admin_id = $session_data['user_id'];
		$redirect_status = 1; 
		if($emp_id == '')
		{
			$redirect_status = 0;
			$emp_id = $session_data['user_id'];
			$manual_admin_id = 0;
		}

		$date_from = date('Y-m-d',strtotime($from_date));
		$date_to = date('Y-m-d',strtotime($to_date));

		if($day_type == 2)
		{
			$no_of_days = 0.5;
		}
		else
		{
			$no_of_days = 1 + (strtotime($date_to) - strtotime($date_from))  / (60 * 60 * 24);
		}
		$data = array(
			'EMPLOYEE_ID'	=> $emp_id,
			'DATE_FROM'		=> $date_from,
			'DATE_TO'		=> $date_to,
			'TOTAL_DAYS'	=> $no_of_days,
			'REASON'		=> $leave_reason,
			'REASON_DETAILS'=> html_escape($reason_details),
			'DOCUMENT'		=> '',
			'STATUS'		=> 0,
			'ADMIN_ID'		=> 0,
			'MANUAL_ADMIN_ID'=> $manual_admin_id,
		);

		if(isset($_FILES['document']['name']) && !empty($_FILES['document']['name']))
		{
			if (!file_exists('assets/emp_leave_document')) {
			   mkdir('assets/emp_leave_document', 0777, true);
			 }
			$image_name=$_FILES['document']['name'];
			$temp = explode(".", $image_name);
			$newfilename = round(microtime(true)) . '.' . end($temp);
			$imagepath="assets/emp_leave_document/".$newfilename;
			move_uploaded_file($_FILES["document"]["tmp_name"],$imagepath);
			$data['DOCUMENT'] = $imagepath;
		}
		$create = $this->sumit->createData('emp_leave_attendance',$data);
		if($create)
		{
			echo json_encode(1); // leave applied successfully
		}
		else
		{
			echo json_encode(2); //leave failed
		}

		if($redirect_status == 0)
		{
			// redirect('leave/applyleave');
		}
		else
		{
			// redirect('leave/applyleave/manualLeave');
		}
	}

	public function getTotalLeave()
	{
		$session_data = $this->session->userdata('login_details');
		$emp_id = $this->input->post('emp_id');

		if($emp_id == '')
		{
			$emp_id = $session_data['user_id'];
		}

		$leave_type = $this->input->post('leave_type');
		$consumedLeave = $this->sumit->fetchSingleData('sum(TOTAL_DAYS) as total_days','emp_leave_attendance',array('EMPLOYEE_ID'=>$emp_id, 'LEAVE_TYPE'=>$leave_type,'status'=>'IN (0,1)'));
		$total_days = 0;
		if($leave_type == 1)
		{
			$leaveTotal = $this->sumit->fetchSingleData('CAS_LEAVE','employee',array('EMPID'=>$emp_id));
			$total_leave = $leaveTotal['CAS_LEAVE'] - $consumedLeave['total_days'];
		}
		elseif($leave_type == 2)
		{
			$leaveTotal = $this->sumit->fetchSingleData('ML','employee',array('EMPID'=>$emp_id));
			$total_leave = $leaveTotal['ML'] - $consumedLeave['total_days'];
		}
		else
		{
			$leaveTotal = $this->sumit->fetchSingleData('EL','employee',array('EMPID'=>$emp_id));
			$total_leave = $leaveTotal['EL'] - $consumedLeave['total_days'];
		}
		echo json_encode($total_leave);
	}


	public function getTotalLeaveAtApproval()
	{
		$emp_id = $this->input->post('emp_id');
		$leave_type = $this->input->post('leave_type');
		$consumedLeave = $this->sumit->fetchSingleData('sum(TOTAL_DAYS) as total_days','emp_leave_attendance',array('EMPLOYEE_ID'=>$emp_id, 'LEAVE_TYPE'=>$leave_type,'status'=>1));
		$total_days = 0;
		if($leave_type == 1)
		{
			$leaveTotal = $this->sumit->fetchSingleData('CAS_LEAVE','employee',array('EMPID'=>$emp_id));
			$total_leave = $leaveTotal['CAS_LEAVE'] - $consumedLeave['total_days'];
		}
		elseif($leave_type == 2)
		{
			$leaveTotal = $this->sumit->fetchSingleData('ML','employee',array('EMPID'=>$emp_id));
			$total_leave = $leaveTotal['ML'] - $consumedLeave['total_days'];
		}
		else
		{
			$leaveTotal = $this->sumit->fetchSingleData('EL','employee',array('EMPID'=>$emp_id));
			$total_leave = $leaveTotal['EL'] - $consumedLeave['total_days'];
		}
		echo json_encode($total_leave);
	}

	function checkEligibleForLeave()
	{
		$send_date = date('Y-m-d',strtotime($this->input->post('send_date')));
		$emp_id = login_details['user_id'];
		$checkData = $this->sumit->checkData('*','emp_leave_attendance',"date(DATE_FROM)<='$send_date' AND date(DATE_TO)>='$send_date' AND EMPLOYEE_ID='$emp_id'");
		if($checkData==true)
		{
			echo json_encode('Leave already applied for this date');
		}
		else
		{
			echo json_encode('true');
		}
	}

	function checkEligibleForLeaveFormSubmit()
	{
		$from_date = date('Y-m-d',strtotime($this->input->post('from_date')));
		$to_date = date('Y-m-d',strtotime($this->input->post('to_date')));
		$emp_id = login_details['user_id'];

		$checkFromDate = $this->sumit->checkData('*','emp_leave_attendance',"(date(DATE_FROM)>='$from_date' AND date(DATE_FROM)<='$to_date') OR (date(DATE_TO)>='$from_date' AND date(DATE_TO)<='$to_date') AND EMPLOYEE_ID='$emp_id'");
		// print_r($this->db->last_query());exit();
		if($checkFromDate==false)
		{
			$checkAttendanceGenerated = $this->sumit->fetchAllData('*','monthly_emp_atten',"empid='$emp_id' AND date(att_date)>='$from_date' AND date(att_date)<='$to_date'");
			if(!empty($checkAttendanceGenerated))
			{

				$checkAttendanceisAbsent = $this->sumit->fetchAllData('*','monthly_emp_atten',"empid='$emp_id' AND att_status IN ('AB','LWP') AND date(att_date)>='$from_date' AND date(att_date)<='$to_date'");
				$total_applied_days = ($this->custom_lib->dateDiffInDays($from_date,$to_date)) + 1;

				if(!empty($checkAttendanceisAbsent) && count($checkAttendanceisAbsent)==$total_applied_days)
				{
					echo json_encode(2); //Ready to applied
				}
				else
				{
					echo json_encode(3); //Attendance generated as present or holiday
				}
			}
			else
			{
				echo json_encode(2); //Ready to applied
			}
		}
		else
		{
			echo json_encode(1); //Leave already applied for this date
		}
	}

	function checkEndDateisValid()
	{
		$endDate = date('Y-m-d',strtotime($this->input->post('endDate')));
		$appliedEndDate = date('Y-m-d',strtotime($this->input->post('appliedEndDate')));
		if(strtotime($endDate) > strtotime($appliedEndDate))
		{
			echo 2; // Not valid
		}
		else
		{
			echo 1; // valid
		}
	}
}

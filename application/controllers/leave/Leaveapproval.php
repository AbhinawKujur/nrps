<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leaveapproval extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){

		if(!in_array('viewLeaveApproval', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$data_id = $this->session->userdata('login_details');
        $log_id = $data_id['user_id'];
		$wing_data = $this->alam->select('employee','WING_MASTER_ID',"EMPID='$log_id'");
		@$data['log_wing_id'] = $wing_data[0]->WING_MASTER_ID;
		$data['leaveTypeList'] = $this->custom_lib->leaveRequestLiveType();
		
		$data['empLeave'] = $this->alam->select('emp_leave_attendance','*,(SELECT WING_MASTER_ID FROM employee where EMPID=EMPLOYEE_ID)wing_id,(SELECT EMP_FNAME from employee where EMPID=emp_leave_attendance.EMPLOYEE_ID)empfnm,(SELECT EMP_MNAME from employee where EMPID=emp_leave_attendance.EMPLOYEE_ID)empmnm,(SELECT EMP_LNAME from employee where EMPID=emp_leave_attendance.EMPLOYEE_ID)emplnm,(select DESIG from employee where EMPID=emp_leave_attendance.EMPLOYEE_ID)desig,(select dg.DESIG from desig as dg where Sno=(select DESIG from employee where EMPID=emp_leave_attendance.EMPLOYEE_ID))designm',"STATUS='0' order by ID desc");
		
		$data['empApporoved'] = $this->alam->leave_approved();
		$data['empDisapporoved'] = $this->alam->leave_disapproved();

		$data['leaveTypeList'] = $this->custom_lib->leaveRequestLiveType();
		$data['leaveReasonList'] = $this->custom_lib->getLeaveReason();
		$this->render_template('leave/leaveapproval',$data);
	}
	
	public function approveNewLeave()
	{
		if(!in_array('viewLeaveApproval', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		$emp_leave_attendance_id = $this->input->post('emp_leave_attendance_id');
		$employee_id = $this->input->post('employee_id');
		$leave_status = $this->input->post('leave');
		$cl_total = $this->input->post('cl_total');
		$el_total = $this->input->post('el_total');
		$ml_total = $this->input->post('ml_total');
		$lwp_total = $this->input->post('lwp_total');
		$ddl_total = $this->input->post('ddl_total');
		$hpl_total = $this->input->post('hpl_total');
		$remarks = $this->input->post('remarks');

		$leaveDetails = $this->sumit->fetchSingleData('*','emp_leave_attendance',"ID='$emp_leave_attendance_id'");

		$data = array();

		if($cl_total > 0)
		{
			$from_date = date('Y-m-d',strtotime($this->input->post('cl_from_date')));
			$to_date = date('Y-m-d',strtotime($this->input->post('cl_to_date')));

			$data[] = array(
				'EMPLOYEE_ID'	=> $leaveDetails['EMPLOYEE_ID'],
				'APPLY_DATE'	=> $leaveDetails['APPLY_DATE'],
				'DAY_TYPE'		=> $leaveDetails['DAY_TYPE'],
				'LEAVE_TYPE'	=> 1,
				'DATE_FROM'		=> $from_date,
				'DATE_TO'		=> $to_date,
				'TOTAL_DAYS'	=> $cl_total,
				'REASON'		=> $leaveDetails['REASON'],
				'REASON_DETAILS'=> $leaveDetails['REASON_DETAILS'],
				'DOCUMENT'		=> $leaveDetails['DOCUMENT'],
				'STATUS'		=> $leave_status,
				'ADMIN_ID'		=> login_details['user_id'],
				'REMARKS'		=> $remarks,
			);
		}

		if($el_total > 0)
		{
			$from_date = date('Y-m-d',strtotime($this->input->post('el_from_date')));
			$to_date = date('Y-m-d',strtotime($this->input->post('el_to_date')));

			$data[] = array(
				'EMPLOYEE_ID'	=> $leaveDetails['EMPLOYEE_ID'],
				'APPLY_DATE'	=> $leaveDetails['APPLY_DATE'],
				'DAY_TYPE'		=> $leaveDetails['DAY_TYPE'],
				'LEAVE_TYPE'	=> 3,
				'DATE_FROM'		=> $from_date,
				'DATE_TO'		=> $to_date,
				'TOTAL_DAYS'	=> $el_total,
				'REASON'		=> $leaveDetails['REASON'],
				'REASON_DETAILS'=> $leaveDetails['REASON_DETAILS'],
				'DOCUMENT'		=> $leaveDetails['DOCUMENT'],
				'STATUS'		=> $leave_status,
				'ADMIN_ID'		=> login_details['user_id'],
				'REMARKS'		=> $remarks,
			);
		}

		if($ml_total > 0)
		{
			$from_date = date('Y-m-d',strtotime($this->input->post('ml_from_date')));
			$to_date = date('Y-m-d',strtotime($this->input->post('ml_to_date')));

			$data[] = array(
				'EMPLOYEE_ID'	=> $leaveDetails['EMPLOYEE_ID'],
				'APPLY_DATE'	=> $leaveDetails['APPLY_DATE'],
				'DAY_TYPE'		=> $leaveDetails['DAY_TYPE'],
				'LEAVE_TYPE'	=> 2,
				'DATE_FROM'		=> $from_date,
				'DATE_TO'		=> $to_date,
				'TOTAL_DAYS'	=> $ml_total,
				'REASON'		=> $leaveDetails['REASON'],
				'REASON_DETAILS'=> $leaveDetails['REASON_DETAILS'],
				'DOCUMENT'		=> $leaveDetails['DOCUMENT'],
				'STATUS'		=> $leave_status,
				'ADMIN_ID'		=> login_details['user_id'],
				'REMARKS'		=> $remarks,
			);
		}

		if($lwp_total > 0)
		{
			$from_date = date('Y-m-d',strtotime($this->input->post('lwp_from_date')));
			$to_date = date('Y-m-d',strtotime($this->input->post('lwp_to_date')));

			$data[] = array(
				'EMPLOYEE_ID'	=> $leaveDetails['EMPLOYEE_ID'],
				'APPLY_DATE'	=> $leaveDetails['APPLY_DATE'],
				'DAY_TYPE'		=> $leaveDetails['DAY_TYPE'],
				'LEAVE_TYPE'	=> 4,
				'DATE_FROM'		=> $from_date,
				'DATE_TO'		=> $to_date,
				'TOTAL_DAYS'	=> $lwp_total,
				'REASON'		=> $leaveDetails['REASON'],
				'REASON_DETAILS'=> $leaveDetails['REASON_DETAILS'],
				'DOCUMENT'		=> $leaveDetails['DOCUMENT'],
				'STATUS'		=> $leave_status,
				'ADMIN_ID'		=> login_details['user_id'],
				'REMARKS'		=> $remarks,
			);
		}

		if($ddl_total > 0)
		{
			$from_date = date('Y-m-d',strtotime($this->input->post('ddl_from_date')));
			$to_date = date('Y-m-d',strtotime($this->input->post('ddl_to_date')));
			$against_date_from = date('Y-m-d',strtotime($this->input->post('against_date_from')));
			$against_date_to = date('Y-m-d',strtotime($this->input->post('against_date_to')));

			$data[] = array(
				'EMPLOYEE_ID'	=> $leaveDetails['EMPLOYEE_ID'],
				'APPLY_DATE'	=> $leaveDetails['APPLY_DATE'],
				'DAY_TYPE'		=> $leaveDetails['DAY_TYPE'],
				'LEAVE_TYPE'	=> 5,
				'DATE_FROM'		=> $from_date,
				'DATE_TO'		=> $to_date,
				'AGAINST_DATE_FROM'	=> $against_date_from,
				// 'AGAINST_DATE_TO'	=> $against_date_to,
				'TOTAL_DAYS'	=> $ddl_total,
				'REASON'		=> $leaveDetails['REASON'],
				'REASON_DETAILS'=> $leaveDetails['REASON_DETAILS'],
				'DOCUMENT'		=> $leaveDetails['DOCUMENT'],
				'STATUS'		=> $leave_status,
				'ADMIN_ID'		=> login_details['user_id'],
				'REMARKS'		=> $remarks,
			);
		}

		if($hpl_total > 0)
		{
			$from_date = date('Y-m-d',strtotime($this->input->post('hpl_from_date')));
			$to_date = date('Y-m-d',strtotime($this->input->post('hpl_to_date')));

			$data[] = array(
				'EMPLOYEE_ID'	=> $leaveDetails['EMPLOYEE_ID'],
				'APPLY_DATE'	=> $leaveDetails['APPLY_DATE'],
				'DAY_TYPE'		=> $leaveDetails['DAY_TYPE'],
				'LEAVE_TYPE'	=> 6,
				'DATE_FROM'		=> $from_date,
				'DATE_TO'		=> $to_date,
				'TOTAL_DAYS'	=> $hpl_total,
				'REASON'		=> $leaveDetails['REASON'],
				'REASON_DETAILS'=> $leaveDetails['REASON_DETAILS'],
				'DOCUMENT'		=> $leaveDetails['DOCUMENT'],
				'STATUS'		=> $leave_status,
				'ADMIN_ID'		=> login_details['user_id'],
				'REMARKS'		=> $remarks,
			);
		}

		if(!empty($data))
		{
			$this->sumit->createMultiple('emp_leave_attendance',$data);
			unset($leaveDetails['SALARY_STATUS']);
			unset($leaveDetails['UPDATE_LOCK']);
			$this->sumit->createData('emp_applied_leave_history',$leaveDetails);
			$this->sumit->delete('emp_leave_attendance',"ID='$emp_leave_attendance_id'");
		}
		else
		{
			$this->sumit->update('emp_leave_attendance',array('STATUS'=>2,'ADMIN_ID'=>login_details['user_id']),"ID='$emp_leave_attendance_id'");
		}
		$this->session->set_flashdata('msg','<div class="alert alert-success">Status updated successfully.</div>');
		redirect('leave/leaveapproval');

	}
	public function leave_approval_sv_upd(){

		if(!in_array('viewLeaveApproval', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$updid    = $this->input->post('updid');
		$login_id = $this->input->post('login_id');
		$leave    = $this->input->post('leave');
		$lv_type  = $this->input->post('lv_type');
		$remarks  = $this->input->post('remarks');
		
		$upd_data = array(
		 'STATUS'     => $leave,
		 'ADMIN_ID'   => $login_id,
		 'LEAVE_TYPE' => $lv_type,
		 'REMARKS'    =>  $remarks
		);
		$this->alam->update('emp_leave_attendance',$upd_data,"ID='$updid'");
		
		$ins_data = array(
		'EMP_LEAVE_ATTENDANCE_ID' => $updid,
		'STATUS'     => $leave,
		'LEAVE_TYPE' => $lv_type,
		'REMARKS'    => $remarks,
		'ADMIN_ID'   => $login_id
		);
		
		$this->alam->insert('emp_leave_history',$ins_data);
	}
	
	public function leave_disapproval_sv_upd(){

		if(!in_array('viewLeaveApproval', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$lv_apro_updid    = $this->input->post('lv_apro_updid');
		$lv_apro_login_id = $this->input->post('lv_apro_login_id');
		$leave            = $this->input->post('leave');
		$lv_apro_remarks  = $this->input->post('remarks');
		
		$upd_data = array(
		 'STATUS'   => $leave,
		 'ADMIN_ID' => $lv_apro_login_id,
		 'REMARKS' =>  $lv_apro_remarks
		);
		$this->alam->update('emp_leave_attendance',$upd_data,"ID='$lv_apro_updid'");
		
		$ins_data = array(
		'EMP_LEAVE_ATTENDANCE_ID' => $lv_apro_updid,
		'STATUS'   => $leave,
		'REMARKS'  => $lv_apro_remarks,
		'ADMIN_ID' => $lv_apro_login_id
		);
		
		$this->alam->insert('emp_leave_history',$ins_data);
		$this->session->set_flashdata('msg','<div class="alert alert-success">Status updated successfully.</div>');
		redirect('leave/leaveapproval');
	}
	
	public function leave_reapproval_sv_upd(){
		
		if(!in_array('viewLeaveApproval', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$lv_disapro_updid    = $this->input->post('lv_disapro_updid');
		$lv_disapro_login_id = $this->input->post('lv_disapro_login_id');
		$leave               = $this->input->post('leave');
		$lv_disapro_remarks  = $this->input->post('lv_disapro_remarks');
		
		$upd_data = array(
		 'STATUS'   => $leave,
		 'ADMIN_ID' => $lv_disapro_login_id,
		 'REMARKS'  => $lv_disapro_remarks
		);
		$this->alam->update('emp_leave_attendance',$upd_data,"ID='$lv_disapro_updid'");
		
		$ins_data = array(
		'EMP_LEAVE_ATTENDANCE_ID' => $lv_disapro_updid,
		'STATUS'   => $leave,
		'REMARKS'  => $lv_disapro_remarks,
		'ADMIN_ID' => $lv_disapro_login_id
		);
		
		$this->alam->insert('emp_leave_history',$ins_data);
	}

	public function getTotalLeaveBalance()
	{
		$id = $this->input->post('id');
		$employee_id = $this->input->post('emp_id');
		$data['employeeDetails'] = $this->sumit->fetchSingleData('*,IFNULL(EMP_FNAME,"")EMP_F_NAME,IFNULL(EMP_MNAME,"")EMP_M_NAME,IFNULL(EMP_LNAME,"")EMP_L_NAME','employee',array('EMPID'=>$employee_id));
		$cas_leave_balance = $this->sumit->fetchSingleDataGroupBy('LEAVE_TYPE,IFNULL(SUM(TOTAL_DAYS),0)leave_bal','emp_leave_attendance',"EMPLOYEE_ID='$employee_id' AND STATUS IN (0,1) AND LEAVE_TYPE=1",'LEAVE_TYPE');
		$ml_balance = $this->sumit->fetchSingleDataGroupBy('LEAVE_TYPE,IFNULL(SUM(TOTAL_DAYS),0)leave_bal','emp_leave_attendance',"EMPLOYEE_ID='$employee_id' AND STATUS IN (0,1) AND LEAVE_TYPE=2",'LEAVE_TYPE');
		$el_balance = $this->sumit->fetchSingleDataGroupBy('LEAVE_TYPE,IFNULL(SUM(TOTAL_DAYS),0)leave_bal','emp_leave_attendance',"EMPLOYEE_ID='$employee_id' AND STATUS IN (0,1) AND LEAVE_TYPE=3",'LEAVE_TYPE');
		$hpl_balance = $this->sumit->fetchSingleDataGroupBy('LEAVE_TYPE,IFNULL(SUM(TOTAL_DAYS),0)leave_bal','emp_leave_attendance',"EMPLOYEE_ID='$employee_id' AND STATUS IN (0,1) AND LEAVE_TYPE=4",'LEAVE_TYPE');
		$leaveDetails = $this->sumit->fetchSingleData('*','emp_leave_attendance',"ID='$id'");

		$data['applied_date'] = date('d-M-Y',strtotime($leaveDetails['DATE_FROM'])).' - '.date('d-M-Y',strtotime($leaveDetails['DATE_TO']));
		$data['from_date'] = date('d-M-Y',strtotime($leaveDetails['DATE_FROM']));
		$data['to_date'] = date('d-M-Y',strtotime($leaveDetails['DATE_TO']));
		if(empty($cas_leave_balance))
		{
			$cas_leave_balance = array(
				'LEAVE_TYPE'	=> 0,
				'leave_bal'	=> 0,
			);
		}
		if(empty($ml_balance))
		{
			$ml_balance = array(
				'LEAVE_TYPE'	=> 0,
				'leave_bal'	=> 0,
			);
		}
		if(empty($el_balance))
		{
			$el_balance = array(
				'LEAVE_TYPE'	=> 0,
				'leave_bal'	=> 0,
			);
		}
		if(empty($hpl_balance))
		{
			$hpl_balance = array(
				'LEAVE_TYPE'=> 0,
				'leave_bal'	=> 0,
			);
		}
		$data['cas_leave_balance'] = $cas_leave_balance;
		$data['ml_balance'] =$ml_balance;
		$data['el_balance'] = $el_balance;
		$data['hpl_balance'] = $hpl_balance;
		$data['leaveDetails'] = $leaveDetails;
		echo json_encode($data);
	}

	public function getEmployeeDetails()
	{
		$emp_id = $this->input->post('emp_id');
		$employeeDetails = $this->sumit->fetchSingleData('*','employee',array('EMPID'=>$emp_id));
		echo json_encode($employeeDetails);
	}
}

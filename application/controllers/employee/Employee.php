<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}
	public function index()
	{
		if(!in_array('viewEmployee', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$session_data = $this->session->userdata('login_details');
		if($session_data['ROLE_ID'] == 4 || $session_data['ROLE_ID'] == 1|| $session_data['ROLE_ID'] == 3)
		{
			$data['employeeDetails'] = $this->sumit->getEmployeeList("STATUS=1");
		}
		elseif($session_data['ROLE_ID'] == 5)
		{
			$emp = $this->sumit->fetchSingleData('WING_MASTER_ID','employee',array('EMPID'=>$session_data['user_id']));
			$data['employeeDetails'] = $this->sumit->getEmployeeList("WING_MASTER_ID='".$emp['WING_MASTER_ID']."'");
		}
		else
		{
			$emp = $this->sumit->fetchSingleData('WING_MASTER_ID','employee',array('EMPID'=>$session_data['user_id']));
			$data['employeeDetails'] = $this->sumit->getEmployeeList();
		}
		$data['designation'] = $this->sumit->fetchAllData('*','desig',array());
		$data['qualification'] = $this->sumit->fetchAllData('*','qualification',array());
		$data['roleList'] = $this->sumit->fetchAllData('*','role_master',array());
		$data['gender'] = $this->custom_lib->getGender();
		$data['employeeType'] = $this->custom_lib->getEmployeeType();
		$data['staffType'] = $this->custom_lib->getStaffType();
		$data['taslab'] = $this->custom_lib->getTASlab();
		$data['level_no'] = $this->sumit->fetchDataGroupByWithOrder('level_no','level_no',array(),'seventh_pay',('level_no'));
		
		$this->render_template('employee/viewEmployeeList',$data);
	}

	public function create()
	{
		if(!in_array('addEmployee', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$data['designation'] = $this->sumit->fetchAllData('*','desig',array());
		$data['qualification'] = $this->sumit->fetchAllData('*','qualification',array());
		$data['gender'] = $this->custom_lib->getGender();
		$data['employeeType'] = $this->custom_lib->getEmployeeType();
		$data['empLevel'] = $this->custom_lib->getEmpLevel();
		$data['staffType'] = $this->custom_lib->getStaffType();
		$data['taslab'] = $this->custom_lib->getTASlab();
		$data['teacherType'] = $this->custom_lib->getTeacherType();
		$data['relationType'] = $this->custom_lib->getRelationType();
		$data['level_no'] = $this->sumit->fetchDataGroupByWithOrder('level_no','level_no',array(),'seventh_pay',('level_no'));
		$data['shiftList'] =$this->sumit->fetchAllData('*','shift_master',array());
		$data['roleList'] =$this->sumit->fetchAllData('*','role_master',array('IS_SUPERADMIN !='=>1));
		$data['wingList'] =$this->sumit->fetchAllData('*','wing_master',array());
		$this->render_template('employee/createEmployee',$data);	
	}

	public function createProcess()
	{

		if(!in_array('addEmployee', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}


		$emp_id = $this->input->post('emp_id');
		if($emp_id == '')
		{
			$employee = $this->sumit->fetchSingleData('MAX(CAST(SUBSTRING(EMPID, 4) AS UNSIGNED)) as empid','employee',array());
			$last_emp_id_part = preg_replace('/[^0-9]/', '', $employee['empid']);
			$increase_part = $last_emp_id_part + 1;
			$increase_part = sprintf("%04d", $increase_part);
			$emp_id ='EMP'.$increase_part;
		}
		$SHIFT	= $this->input->post('shift');

		$dob = $this->input->post('dob');
		$dob = date('Y-m-d',strtotime($dob));

		$doj = $this->input->post('doj');
		$doj = date('Y-m-d',strtotime($doj));

		$date_of_retirement = $this->custom_lib->retirementDate($dob);

		$data = array(
				'EMPID'				=> $emp_id,
				'INITIALS'			=> $this->input->post('initials'),
				'EMP_FNAME'			=> strtoupper($this->input->post('first_name')),
				'EMP_MNAME'			=> strtoupper($this->input->post('middle_name')),
				'EMP_LNAME'			=> strtoupper($this->input->post('title_name')),
				'FATHERS_NAME'		=> strtoupper($this->input->post('fathers_name')),
				'G_NAME'			=> strtoupper($this->input->post('guardian_name')),
				'DESIG'				=> $this->input->post('designation'),
				'ROLE_ID'			=> $this->input->post('role'),
				'D_O_J'				=> $doj,
				'D_O_RETIER'		=> $date_of_retirement,
				'D_O_B'				=> $dob,
				'SEX'				=> $this->input->post('gender'),
				'CATEGORY'			=> $this->input->post('category'),
				'EMP_TYPE'			=> $this->input->post('employee_type'),
				'STAFF_TYPE'		=> $this->input->post('staff_type'),
				'TEACHER_TYPE'		=> $this->input->post('teacher_type'),
				'AADHAARNO'			=> $this->input->post('aadhaar_no'),
				'PAN_NUMBER'		=> $this->input->post('pan_no'),
				'C_ADD'				=> $this->input->post('correspondence_address'),
				'P_ADD'				=> $this->input->post('permanent_address'),
				'C_MOBILE'			=> $this->input->post('mobile'),
				'C_EMAIL'			=> $this->input->post('email'),
				'QUAL'				=> $this->input->post('basic_qualification'),
				'MASTERQUAL'		=> $this->input->post('master_qualification'),
				'PROFQUAL'			=> $this->input->post('professional_qualification'),
				'CAS_LEAVE'			=> $this->input->post('casual_leave'),
				'EL'				=> $this->input->post('earned_leave'),
				'ML'				=> $this->input->post('medical_leave'),
				'hpl'				=> $this->input->post('half_paid_leave'),
				'WING_MASTER_ID'	=> $this->input->post('wing'),
				'EMP_LEVEL'			=> $this->input->post('emp_level'),
				'VPF'				=> $this->input->post('vpf'),
				'SHIFT'				=> $SHIFT,
				'CONTRACT_TYPE'		=> $this->input->post('contract_type'),
			);
			$data = html_escape($data);
			$insert_id = $this->sumit->createDataReturnID('employee',$data);
			if($insert_id)
			{
				$data = array(
					'username'	=> $emp_id,
					'user_id'	=> $emp_id,
					'pass_word'	=> md5('1234'),
					'emp_name'	=> $this->input->post('first_name').' '. $this->input->post('middle_name').' '.$this->input->post('title_name'),
					'ROLE_ID'	=> $this->input->post('role'),
				);
				$this->sumit->createData('login_details',$data);

				$separation_log_data = array(
					'emp_id'	=> $emp_id,
					'joining_date'	=> $doj,
				);
				$this->sumit->createData('emp_separation_log',$separation_log_data);
				$this->session->set_flashdata('msg','<div class="alert alert-success">Record Created Successfully</div>');
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-warning">Creation Failed!</div>');
			}
			redirect('employee/employee/create');
	}

	public function update($id = null)
	{

		if(!in_array('editEmployee', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}


		if($id == null)
		{
			redirect('employee/employee');
		}

		//start checking both wing_master_id is same or not
		$session_data = $this->session->userdata('login_details');

		if($session_data['ROLE_ID'] == 4 || $session_data['ROLE_ID'] == 1)
		{
			
		}
		else
		{
			$login_emp = $this->sumit->fetchSingleData('WING_MASTER_ID','employee',array('EMPID'=>$session_data['user_id']));
			$view_emp = $this->sumit->fetchSingleData('WING_MASTER_ID','employee',array('id'=>$id));
		}
		//end checking both wing_master_id is same or not
		
		$singleData = $this->sumit->getSingleEmployee($id);
		$data['singleData'] = $singleData;
		$data['designation'] = $this->sumit->fetchAllData('*','desig',array());
		$data['qualification'] = $this->sumit->fetchAllData('*','qualification',array());
		$data['gender'] = $this->custom_lib->getGender();
		$data['employeeType'] = $this->custom_lib->getEmployeeType();
		$data['statusList'] = $this->custom_lib->getEmployeeSeparatedStatus();
		$data['staffType'] = $this->custom_lib->getStaffType();
		$data['taslab'] = $this->custom_lib->getTASlab();
		$data['empLevel'] = $this->custom_lib->getEmpLevel();
		$data['teacherType'] = $this->custom_lib->getTeacherType();
		$data['relationType'] = $this->custom_lib->getRelationType();
		$data['level_no'] = $this->sumit->fetchDataGroupByWithOrder('level_no','level_no',array(),'seventh_pay',('level_no'));
		$data['shiftList'] =$this->sumit->fetchAllData('*','shift_master',array());
		$data['roleList'] =$this->sumit->fetchAllData('*','role_master',array('IS_SUPERADMIN !='=>1));
		$data['wingList'] =$this->sumit->fetchAllData('*','wing_master',array());
		$this->render_template('employee/editEmployee',$data);
	}

	public function updateProcess($id=null)
	{
		if(!in_array('editEmployee', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		if($id == null)
		{
			redirect('employee/employee');
		}
		$emp_id = $this->input->post('emp_id');
		$SHIFT	= $this->input->post('shift');

		$dob = $this->input->post('dob');
		$dob = date('Y-m-d',strtotime($dob));

		$doj = $this->input->post('doj');
		$doj = date('Y-m-d',strtotime($doj));

		$dob_month = date('m',strtotime($dob));

		$date_of_retirement = $this->custom_lib->retirementDate($dob);

		$status = $this->input->post('status');
		if($status == 1)
		{
			$seperationDate = '';
		}
		else
		{
			$seperationDate = date('Y-m-d',strtotime($this->input->post('seperation_date')));
		}

		$first_name = strtoupper($this->input->post('first_name'));
		$middle_name = strtoupper($this->input->post('middle_name'));
		$last_name = strtoupper($this->input->post('title_name'));
		$data = array(
				'INITIALS'			=> $this->input->post('initials'),
				'EMP_FNAME'			=> $first_name,
				'EMP_MNAME'			=> $middle_name,
				'EMP_LNAME'			=> $last_name,
				'FATHERS_NAME'		=> strtoupper($this->input->post('fathers_name')),
				'G_NAME'			=> strtoupper($this->input->post('guardian_name')),
				'DESIG'				=> $this->input->post('designation'),
				'ROLE_ID'			=> $this->input->post('role'),
				'D_O_J'				=> $doj,
				'D_O_B'				=> $dob,
				'D_O_RETIER'		=> $date_of_retirement,
				'SEX'				=> $this->input->post('gender'),
				'EMP_TYPE'			=> $this->input->post('employee_type'),
				'STAFF_TYPE'		=> $this->input->post('staff_type'),
				'TEACHER_TYPE'		=> $this->input->post('teacher_type'),
				'AADHAARNO'			=> $this->input->post('aadhaar_no'),
				'PAN_NUMBER'		=> $this->input->post('pan_no'),
				'C_ADD'				=> $this->input->post('correspondence_address'),
				'P_ADD'				=> $this->input->post('permanent_address'),
				'C_MOBILE'			=> $this->input->post('mobile'),
				'C_EMAIL'			=> $this->input->post('email'),
				'QUAL'				=> $this->input->post('basic_qualification'),
				'MASTERQUAL'		=> $this->input->post('master_qualification'),
				'PROFQUAL'			=> $this->input->post('professional_qualification'),
				// 'CAS_LEAVE'			=> $this->input->post('casual_leave'),
				// 'EL'				=> $this->input->post('earned_leave'),
				// 'ML'				=> $this->input->post('medical_leave'),
				// 'hpl'				=> $this->input->post('half_paid_leave'),
				'WING_MASTER_ID'	=> $this->input->post('wing'),
				'EMP_LEVEL'			=> $this->input->post('emp_level'),
				'VPF'				=> $this->input->post('vpf'),
				'SHIFT'				=> $SHIFT,
				'CONTRACT_TYPE'		=> $this->input->post('contract_type'),
				'STATUS'			=> $status,
				'DATE_OF_SEPARATION'=> $seperationDate,
			);
			$data = html_escape($data);
			$update = $this->sumit->update('employee',$data,array('id'=>$id));
			if($update)
			{
				$data = array(
					'emp_name'	=> $first_name.' '.$middle_name.' '.$last_name,
					'ROLE_ID'	=> $this->input->post('role'),
				);
				$this->sumit->update('login_details',$data,array('user_id'=>$emp_id));

				$separation_log_data = array(
					'emp_id'	=> $emp_id,
					'joining_date'	=> $doj,
					'separation_date'	=> $seperationDate,
				);
				$this->sumit->createData('emp_separation_log',$separation_log_data);

				$this->session->set_flashdata('msg','<div class="alert alert-success">Record Updated Successfully</div>');
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-warning">Updation Failed!</div>');
			}
			redirect('employee/employee');
	}


	public function view($id = null)
	{
		if(!in_array('viewEmployee', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		if($id == null)
		{
			redirect('employee/employee');
		}
		//start checking both wing_master_id is same or not
		$session_data = $this->session->userdata('login_details');

		if($session_data['ROLE_ID'] == 4 || $session_data['ROLE_ID'] == 1)
		{
			
		}
		else
		{
			$login_emp = $this->sumit->fetchSingleData('WING_MASTER_ID','employee',array('EMPID'=>$session_data['user_id']));
			$view_emp = $this->sumit->fetchSingleData('WING_MASTER_ID','employee',array('id'=>$id));
		}
		//end checking both wing_master_id is same or not
		$data['relationType'] = $this->custom_lib->getRelationType();
		$employeeData = $this->sumit->getSingleEmployee($id);
		$username = $this->sumit->fetchSingleData('username','login_details',array('user_id'=>$employeeData['EMPID']));
		$data['username'] = $username['username'];
		$data['shiftDetails'] = $this->sumit->fetchSingleData('*','shift_master',"ID='".$employeeData['SHIFT']."'");
		$data['employeeData'] = $employeeData;
		$data['gender'] = $this->custom_lib->getGender();
		$data['employeeType'] = $this->custom_lib->getEmployeeType();
		$data['staffType'] = $this->custom_lib->getStaffType();
		$data['statusList'] = $this->custom_lib->getEmployeeSeparatedStatus();
		$data['taslab'] = $this->custom_lib->getTASlab();
		$data['empLevel'] = $this->custom_lib->getEmpLevel();
		$data['teacherType'] = $this->custom_lib->getTeacherType();
		$data['id'] = $id;
		$this->render_template('employee/singleEmployee',$data);
	}

	public function checkEmpID()
	{
		$emp_id = $this->input->post('emp_id');
		$check = $this->sumit->checkData('*','employee',array('EMPID'=>$emp_id));
		if($check)
		{
			echo json_encode('Employee ID already exist');
		}
		else
		{
			echo json_encode('true');
		}
	}

	public function getLevelYear()
	{
		$level_no = $this->input->post('level_no');
		$level_year_data = $this->sumit->fetchAllData('level_year','seventh_pay',array('level_no'=>$level_no));
		echo json_encode($level_year_data);
	}

	public function getPay()
	{
		$level_no = $this->input->post('level_no');
		$level_year = $this->input->post('level_year');
		$data = $this->sumit->fetchSingleData('pay','seventh_pay',array('level_no'=>$level_no,'level_year'=>$level_year));
		echo json_encode($data);
	}

	public function getLeaveDays()
	{
		$emp_type = $this->input->post('emp_type');
		$data['casual'] = $this->sumit->fetchSingleData('no_days','leave_master',array('name'=>1,'applicable_for'=>3));
		$data['medical'] = $this->sumit->fetchSingleData('no_days','leave_master',array('name'=>2,'applicable_for'=>3));
		$data['earned'] = $this->sumit->fetchSingleData('no_days','leave_master',array('name'=>3,'applicable_for'=>$emp_type));
		$data['hpl'] = $this->sumit->fetchSingleData('no_days','leave_master',array('name'=>4,'applicable_for'=>$emp_type));
		echo json_encode($data);
	}

	public function disabledEmployeeList()
	{
		if(!in_array('viewEmployee', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		$session_data = $this->session->userdata('login_details');
		if($session_data['ROLE_ID'] == 4 || $session_data['ROLE_ID'] == 1)
		{
			$data['employeeDetails'] = $this->sumit->fetchThreeJoin('employee.*,desig.DESIG,role_master.NAME as Role_name','employee','desig','role_master','employee.DESIG=desig.Sno','employee.ROLE_ID=role_master.ID',array('STATUS !='=>1));
		}
		elseif($session_data['ROLE_ID'] == 5)
		{
			$emp = $this->sumit->fetchSingleData('WING_MASTER_ID','employee',array('EMPID'=>$session_data['user_id']));
			$data['employeeDetails'] = $this->sumit->fetchThreeJoin('employee.*,desig.DESIG,role_master.NAME as Role_name','employee','desig','role_master','employee.DESIG=desig.Sno','employee.ROLE_ID=role_master.ID',array('WING_MASTER_ID'=>$emp['WING_MASTER_ID'],'STATUS !='=>1));
		}
		else
		{
			$emp = $this->sumit->fetchSingleData('WING_MASTER_ID','employee',array('EMPID'=>$session_data['user_id']));
			$data['employeeDetails'] = $this->sumit->fetchThreeJoin('employee.*,desig.DESIG,role_master.NAME as Role_name','employee','desig','role_master','employee.DESIG=desig.Sno','employee.ROLE_ID=role_master.ID',array('WING_MASTER_ID'=>$emp['WING_MASTER_ID'],'ROLE_ID !='=>5,'STATUS !='=>1));
		}
		$data['designation'] = $this->sumit->fetchAllData('*','desig',array());
		$data['qualification'] = $this->sumit->fetchAllData('*','qualification',array());
		$data['roleList'] = $this->sumit->fetchAllData('*','role_master',array());
		$data['gender'] = $this->custom_lib->getGender();
		$data['employeeType'] = $this->custom_lib->getEmployeeType();
		$data['staffType'] = $this->custom_lib->getStaffType();
		$data['taslab'] = $this->custom_lib->getTASlab();
		$data['level_no'] = $this->sumit->fetchDataGroupByWithOrder('level_no','level_no',array(),'seventh_pay',('level_no'));
		
		$this->render_template('employee/disabledEmployeeList',$data);
	}
}

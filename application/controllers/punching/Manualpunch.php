<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manualpunch extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		error_reporting(0);
	}
	
	public function index(){

		if(!in_array('viewEmpAttendance', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		//all sql server data processing start
		// $sql_data = $this->SQL_Model->sqlServerData();
		// foreach ($sql_data as $key => $value) {
			
		// 	$data_ins = array(
		// 		'CARDNO'		=> $value['CARDNO'],
		// 		'OFFICEPUNCH'	=> $value['OFFICEPUNCH'],
		// 		'REASONCODE'	=> $value['REASONCODE'],
		// 		'PROCESS'		=> $value['PROCESS'],
		// 		'PUNCHFLAG'		=> $value['PUNCHFLAG'],
		// 		'MACHINEID'		=> $value['MACHINEID'],
		// 		'MACHINENO'		=> $value['MACHINENO'],
		// 		'PUNCHTYPE'		=> $value['PUNCHTYPE'],
		// 	);
		// 	$this->sumit->createData('punching_raw_data',$data_ins);
		// 	$this->SQL_Model->update('STARDC_RAWDATA',array('PROCESS'=>'Y'),array('CARDNO'=>$value['CARDNO'],'OFFICEPUNCH'=>$value['OFFICEPUNCH']));
		// }
		$this->createPunchingByMachine();

		//all sql server data processing end 

		date_default_timezone_set('UTC');
		$start_time = array();
		$stop_time = array();
		$time_sum = 0;
		$empAttendList = array();

		$data['designation'] = $this->sumit->fetchAllData('*','desig',array());
		$time_from = date("Y-m-d");
		$time_to = date("Y-m-d");

		$data['total_emp'] = $this->sumit->totalRecord('*','employee',"STATUS=1");

		if(isset($_POST['search']))
		{
			$time_from = $this->input->post('time_from');
			$time_from = date('Y-m-d',strtotime($time_from));
			$time_to = $this->input->post('time_from');
			$time_to = date('Y-m-d',strtotime($time_to));
			$data['date'] = $time_from;
		}

		$data['date'] = $time_from;
		$attendanceList = $this->sumit->getEmpDAta($time_from,$time_to);
		$data['total_pre'] = count($attendanceList);

		foreach ($attendanceList as $key => $value) {
			$check = $this->sumit->getShiftDuration($value['shift']);
			$time_sum = "00:00:00";
			foreach ($check as $keys => $val) {					
				$time_sum = $this->custom_lib->CalculateTime($val['SHIFT_DURATION'],$time_sum);
			}

			$empAttendList[] = $this->sumit->getEmpAttendanceData($value['shift'],$value['id'],$time_from,$time_to);
			$empAttendList[$key][0]['total_shift_duration'] = $time_sum; 
		}
		$data['attendanceList'] = $empAttendList;
		$this->render_template('punching/manualPunch',$data);
	}

	public function create()
	{
		$user_id = $this->session->userdata('user_id');
		$response = array();
		$active_shift_id = 0;
		$st = 0;
		$date = $this->input->post('date');
		$date = date('Y-m-d',strtotime($date));
		$time = $this->input->post('time');
		$employee = $this->input->post('employee');
		$punch_time = $date.' '.$time;
		$shift_id = $this->sumit->fetchSingleData('SHIFT','employee',array('id'=>$employee));
		$shift_details = $this->sumit->fetchSingleData('*','shift_master',array('ID'=>$shift_id['SHIFT']));

		$start_shift_timing = $shift_details['START_TIME'];
		$ends_shift_timing = $shift_details['STOP_TIME'];

		$start_shift_date_time = $date.' '.$start_shift_timing;
		$end_shift_date_time = $date.' '.$ends_shift_timing;
		//checking previous out attendance if not out on previous day then out from here start
		$get_prev_out_status = $this->sumit->fetchSingleData('*','emp_attendance',"EMPLOYEE_ID = '$employee' AND date(IN_TIME) < '$date' AND STATUS = 1");

		if(!empty($get_prev_out_status))
		{
			$in_date_prev = date('Y-m-d',strtotime($get_prev_out_status['IN_TIME']));
			$out_time_stop = $in_date_prev.' '.$shift_details['STOP_TIME'];

			if(strtotime($get_prev_out_status['IN_TIME']) > strtotime($out_time_stop))
			{
				$out_time_stop = $get_prev_out_status['IN_TIME'];
			}
			$total_duration_second_prev = $this->sumit->getDateTimeDiff($get_prev_out_status['IN_TIME'],$out_time_stop);
			$total_duration_prev = gmdate("H:i:s", $total_duration_second_prev['time_diff']);

			$data_out_time = array(
					'OUT_TIME'			=> $out_time_stop,
					'OUT_CHECK_DIFFER'	=> "00:00:00",
					'TOTAL_DURATION'	=>$total_duration_prev,
					'PUNCH_TYPE'		=> 0,
					'STATUS'			=> 2,
				);
			$this->sumit->update('emp_attendance',$data_out_time,array('ID'=>$get_prev_out_status['ID']));
		}

		if(!empty($shift_id))
		{
			$time_compare = array();
			$time_diff = '';
			$get_last_data = array();

			$chk_prev_atten= $this->sumit->checkData('*','emp_attendance',"EMPLOYEE_ID = '$employee' AND date(IN_TIME) = '$date'");
			if($chk_prev_atten == true)
			{
				$get_last_data = $this->sumit->fetchSingleData('*','emp_attendance',"IN_TIME = (SELECT max(IN_TIME) FROM emp_attendance WHERE EMPLOYEE_ID = '$employee' AND date(IN_TIME) = '$date') ORDER BY ID DESC");
			}

			if(($chk_prev_atten == false) || ($chk_prev_atten == true && $get_last_data['STATUS'] == '2'))
			{					
				$minutes_to_add = 10;
				$addedTime = new DateTime($start_shift_timing);
				$addedTime->add(new DateInterval('PT' . $minutes_to_add . 'M'));
				$shift_start_time_after_adding_min = $addedTime->format('H:i:s');
				
				$time_diff = $this->sumit->getTimeDiff($time.':00',$shift_start_time_after_adding_min);

				$data = array(
					'EMPLOYEE_ID'		=> $employee,
					'IN_TIME'			=> $punch_time,
					'IN_CHECK_DIFFER'	=> $time_diff['time_diff'],
					'SHIFT_MASTER_ID'	=> $shift_id['SHIFT'],
					'SHIFT_IN_TIME'		=> $start_shift_timing,
					'SHIFT_OUT_TIME'	=> $ends_shift_timing,
					'SHIFT_DURATION'	=> $shift_details['SHIFT_DURATION'],
					'MIN_HRS_HALF'		=> $shift_details['MIN_HRS_HALF'],
					'MIN_HRS_FULL'		=> $shift_details['MIN_HRS_FULL'],
					'STATUS'			=> 1,
					'PUNCH_TYPE'		=> 1,
					'ADMIN_ID'			=> $user_id,
				);

				$create = $this->sumit->createData('emp_attendance',$data);
				if($create)
				{
					$response['msg'] = 1;
				}
				else
				{
					$response['msg'] = 2;
				}
			}
			else
			{
				$time_diff = $this->sumit->getOutTimeDiff($time.':00',$ends_shift_timing);

				$data = array(
					'OUT_TIME'			=> $punch_time,
					'OUT_CHECK_DIFFER'	=> $time_diff['time_diff'],
					'PUNCH_TYPE'		=> 1,
					'STATUS'			=> 2,
				);
				$update = $this->sumit->update('emp_attendance',$data,array('ID'=>$get_last_data['ID']));
				if($update)
				{
					$get_last_updated_data = $this->sumit->fetchSingleData('*','emp_attendance',array('ID'=>$get_last_data['ID']));
					$total_duration_second = $this->sumit->getDateTimeDiff($get_last_updated_data['IN_TIME'],$get_last_updated_data['OUT_TIME']);
					$total_duration = gmdate("H:i:s", $total_duration_second['time_diff']);
					$this->sumit->update('emp_attendance',array('TOTAL_DURATION'=>$total_duration),array('ID'=>$get_last_data['ID']));

					$response['msg'] = 3;
				}
				else
				{
					$response['msg'] = 4;
				}
			}
		}		
		echo json_encode($response);
	}

	public function getEmployee()
	{
		$designation = $this->input->post('designation');
		$session_data = $this->session->userdata('login_details');

		if($session_data['ROLE_ID'] == 4 || $session_data['ROLE_ID'] == 1)
		{
			$data = $this->sumit->fetchAllData('id,EMPID,IFNULL(EMP_FNAME,"")EMP_FNAME,IFNULL(EMP_MNAME,"")EMP_MNAME,IFNULL(EMP_LNAME,"")EMP_LNAME','employee',array('DESIG'=>$designation,'STATUS'=>1));
		}
		elseif($session_data['ROLE_ID'] == 5)
		{
			$emp = $this->sumit->fetchSingleData('WING_MASTER_ID','employee',array('EMPID'=>$session_data['user_id']));
			$data = $this->sumit->fetchAllData('id,EMPID,IFNULL(EMP_FNAME,"")EMP_FNAME,IFNULL(EMP_MNAME,"")EMP_MNAME,IFNULL(EMP_LNAME,"")EMP_LNAME','employee',array('DESIG'=>$designation,'WING_MASTER_ID'=>$emp['WING_MASTER_ID'],'STATUS'=>1));
		}
		else
		{
			$emp = $this->sumit->fetchSingleData('WING_MASTER_ID','employee',array('EMPID'=>$session_data['user_id']));
			$data = $this->sumit->fetchAllData('id,EMPID,IFNULL(EMP_FNAME,"")EMP_FNAME,IFNULL(EMP_MNAME,"")EMP_MNAME,IFNULL(EMP_LNAME,"")EMP_LNAME','employee',array('DESIG'=>$designation,'WING_MASTER_ID'=>$emp['WING_MASTER_ID'],'ROLE_ID !='=>5,'STATUS'=>1));
		}
		echo json_encode($data);
	}

	public function checkHolidayDate()
	{
		$response = array();
		$in_date = $this->input->post('in_date');
		$check = $this->sumit->checkHoliday($in_date);
		if($check)
		{
			$response['message'] = 1;
		}
		else
		{
			$response['message'] = 2;
		}
		echo json_encode($response);
	}

	public function checkLeaveApplied()
	{
		$response = array();
		$date = date('Y-m-d',strtotime($this->input->post('in_date')));
		$emp_id = $this->input->post('emp_id');
		$employee_id = $this->sumit->fetchSingleData('EMPID','employee',array('id'=>$emp_id));
		$check = $this->sumit->checkData('*','emp_leave_attendance',array('EMPLOYEE_ID'=>$employee_id['EMPID'],'date(DATE_FROM) <='=>$date,'date(DATE_TO) >='=>$date));
		if($check)
		{
			$response['message'] = 1;
		}
		else
		{
			$response['message'] = 2;
		}
		echo json_encode($response);
	}

	public function checkMonthlyAttendanceGenerated()
	{
		$response = array();
		$month = date('m',strtotime($this->input->post('in_date')));
		$year = date('Y',strtotime($this->input->post('in_date')));
		$emp_id = $this->input->post('emp_id');
		$check = $this->sumit->checkData('*','monthly_emp_attend_gen',array('emp_id'=>$emp_id,'month'=>$month,'year'=>$year));
		if($check)
		{
			$response['message'] = 1;
		}
		else
		{
			$response['message'] = 2;
		}
		echo json_encode($response);
	}


	public function createPunchingByMachine()
	{
		$punchtimedata = $this->sumit->fetchAllData('*','punching_raw_data',array('PROCESS'=>'N'));
		foreach ($punchtimedata as $keys => $val) {
		
			$response = array();
			$date = date('Y-m-d',strtotime($val['OFFICEPUNCH']));
			$time = date('h:i:s A',strtotime($val['OFFICEPUNCH']));
			$time = date("H:i:s", strtotime($time));
			$emp_data = $this->sumit->fetchSingleData('id,EMPID','employee',array('EMPID'=>$val['CARDNO']));
			$employee = $emp_data['id'];
			$punch_time = date('Y-m-d H:i:s',strtotime($val['OFFICEPUNCH']));

			$shift_id = $this->sumit->fetchSingleData('SHIFT','employee',array('id'=>$employee));
			$shift_details = $this->sumit->fetchSingleData('*','shift_master',array('ID'=>$shift_id['SHIFT']));
			$start_shift_timing = $shift_details['START_TIME'];
			$ends_shift_timing = $shift_details['STOP_TIME'];

			$start_shift_date_time = $date.' '.$start_shift_timing;
			$end_shift_date_time = $date.' '.$ends_shift_timing;

			//checking previous out attendance if not out on previous day then out from here start
			$get_prev_out_status = $this->sumit->fetchSingleData('*','emp_attendance',"EMPLOYEE_ID = '$employee' AND date(IN_TIME) < '$date' AND STATUS = 1");
			if(!empty($get_prev_out_status))
			{
				$in_date_prev = date('Y-m-d',strtotime($get_prev_out_status['IN_TIME']));
				$out_time_stop = $in_date_prev.' '.$shift_details['STOP_TIME'];

				$total_duration_second_prev = $this->sumit->getDateTimeDiff($get_prev_out_status['IN_TIME'],$out_time_stop);
				$total_duration_prev = gmdate("H:i:s", $total_duration_second_prev['time_diff']);

				$data_out_time = array(
						'OUT_TIME'			=> $out_time_stop,
						'OUT_CHECK_DIFFER'	=> "00:00:00",
						'TOTAL_DURATION'	=>$total_duration_prev,
						'PUNCH_TYPE'		=> 0,
						'STATUS'			=> 2,
					);
				$this->sumit->update('emp_attendance',$data_out_time,array('ID'=>$get_prev_out_status['ID']));
			}
			//checking previous out attendance if not out on previous day then out from here end
		
			if(!empty($shift_id))
			{
				$chk_prev_atten= $this->sumit->checkData('*','emp_attendance',"EMPLOYEE_ID = '$employee' AND date(IN_TIME) = '$date'");
				if($chk_prev_atten == true)
				{
					$get_last_data = $this->sumit->fetchSingleData('*','emp_attendance',"IN_TIME = (SELECT max(IN_TIME) FROM emp_attendance WHERE EMPLOYEE_ID = '$employee' AND date(IN_TIME) = '$date') ORDER BY ID DESC");
				}

				if(($chk_prev_atten == false) || ($chk_prev_atten == true && $get_last_data['STATUS'] == '2'))
				{	
					$minutes_to_add = 10;
					$addedTime = new DateTime($start_shift_timing);
					$addedTime->add(new DateInterval('PT' . $minutes_to_add . 'M'));
					$shift_start_time_after_adding_min = $addedTime->format('H:i:s');						
					$time_diff = $this->sumit->getTimeDiff($time,$shift_start_time_after_adding_min);
					$data = array(
						'EMPLOYEE_ID'		=> $employee,
						'IN_TIME'			=> $punch_time,
						'IN_CHECK_DIFFER'	=> $time_diff['time_diff'],
						'SHIFT_MASTER_ID'	=> $shift_id['SHIFT'],
						'SHIFT_IN_TIME'		=> $start_shift_timing,
						'SHIFT_OUT_TIME'	=> $ends_shift_timing,
						'SHIFT_DURATION'	=> $shift_details['SHIFT_DURATION'],
						'MIN_HRS_HALF'		=> $shift_details['MIN_HRS_HALF'],
						'MIN_HRS_FULL'		=> $shift_details['MIN_HRS_FULL'],
						'STATUS'			=> 1,
						'PUNCH_TYPE'		=> 0,
						'ADMIN_ID'			=> 0,
					);
					$create = $this->sumit->createData('emp_attendance',$data);
					$this->sumit->update('punching_raw_data',array('PROCESS'=>'Y'),array('ID'=>$val['ID']));
				}
				else
				{		
					$time_diff = $this->sumit->getOutTimeDiff($time,$ends_shift_timing);

					$data = array(
						'OUT_TIME'			=> $punch_time,
						'OUT_CHECK_DIFFER'	=> $time_diff['time_diff'],
						'PUNCH_TYPE'		=> 0,
						'STATUS'			=> 2,
					);
					$update = $this->sumit->update('emp_attendance',$data,array('ID'=>$get_last_data['ID']));
					if($update)
					{
						$this->sumit->update('punching_raw_data',array('PROCESS'=>'Y'),array('ID'=>$val['ID']));
						$get_last_updated_data = $this->sumit->fetchSingleData('*','emp_attendance',array('ID'=>$get_last_data['ID']));
						$total_duration_second = $this->sumit->getDateTimeDiff($get_last_updated_data['IN_TIME'],$get_last_updated_data['OUT_TIME']);
						$total_duration = gmdate("H:i:s", $total_duration_second['time_diff']);
						$this->sumit->update('emp_attendance',array('TOTAL_DURATION'=>$total_duration),array('ID'=>$get_last_data['ID']));
					}
				}
				
			}		
		}
	}


	public function pdfReport($date){

		if(!in_array('viewEmpAttendance', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		ini_set('memory_limit', '-1');
		$data['school_setting'] = $this->sumit->fetchSingleData('*','school_setting',array('S_No'=>1));
		$data['date'] = $date;

		date_default_timezone_set('UTC');
		$start_time = array();
		$stop_time = array();
		$time_sum = 0;
		$empAttendList = array();

		$data['designation'] = $this->sumit->fetchAllData('*','desig',array());

		$data['total_emp'] = $this->sumit->totalRecord('*','employee',array());

		$attendanceList = $this->sumit->getEmpDAta($date,$date);
		$data['total_pre'] = count($attendanceList);

		foreach ($attendanceList as $key => $value) {
			$check = $this->sumit->getShiftDuration($value['shift']);
			$time_sum = "00:00:00";
			foreach ($check as $keys => $val) {					
				$time_sum = $this->custom_lib->CalculateTime($val['SHIFT_DURATION'],$time_sum);
			}

			$empAttendList[] = $this->sumit->getEmpAttendanceData($value['shift'],$value['id'],$date,$date);
			$empAttendList[$key][0]['total_shift_duration'] = $time_sum; 
		}
		$data['attendanceList'] = $empAttendList;
		$this->load->view('punching/punchingPDFReport',$data);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'landscape');
		$this->dompdf->render();
		$this->dompdf->set_option("isPhpEnabled", true);
		$this->dompdf->stream("dailypunchingreport.pdf", array("Attachment"=>0));
	}
}

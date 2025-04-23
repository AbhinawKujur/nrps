<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AutoSms extends CI_Controller{
	
	public function index(){
		$this->load->library('Sms_lib');
		$date = date('Y-m-d');
		$employeeList = $this->sumit->fetchAllData('*','employee',array('STATUS'=>1));
		$todayPresentEmp = $this->sumit->fetchAllData('distinct(EMPLOYEE_ID)','emp_attendance',array('date(IN_TIME)'=>$date));
		
		$totEmpAbsent = count($employeeList) - count($todayPresentEmp);
		
		$totalStudent = $this->sumit->fetchAllData('STUDENTID','student',array('Student_Status'=>'ACTIVE'));
		
		$totalStudentPresent = $this->attendance->totalPresentStudent("att_date='$date' AND att_status IN ('P','HD')","att_date='$date' AND att_status='P'");
		$tot = $totalStudentPresent['total_present_period_table'] + $totalStudentPresent['total_present_daily_table'];
		
		$totAbsentStu = count($totalStudent) - $tot;
		
		$mob1 = 6200046130;
		$mob2 = 8294071928;
		$mob3 = 9431118452;
		$mob4 = 7631240330;
		
		$msg  = "Daily Attendance Alert..!!!\n\n";
		$msg .= "Total staffs: ".count($employeeList);
		$msg .= "\nPresent - ".count($todayPresentEmp);
		$msg .= "\nAbsent - ".$totEmpAbsent;
		
		$msg .= "\n\nTotal Students: ".count($totalStudent);
		$msg .= "\nPresent-".$tot;
		$msg .= "\nAbsent-".$totAbsentStu;
		
		$holiday_check = $this->sumit->fetchSingleData('count(*)cnt','holiday_master',"date(FROM_DATE) <= '$date' AND date(TO_DATE) >='$date'");
		$cnt = $holiday_check['cnt'];

		$checkSunday = date('N',strtotime($date));

		if($cnt != 1 && $checkSunday != 7){
			//$this->sms_lib->sendSMS($mob1,$msg);
			//$this->sms_lib->sendSMS($mob2,$msg);
			//$this->sms_lib->sendSMS($mob3,$msg);
			//$this->sms_lib->sendSMS($mob4,$msg);
			
		}
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

}
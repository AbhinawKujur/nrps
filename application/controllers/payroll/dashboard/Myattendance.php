<?php 
class Myattendance extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}

	public function index()
	{
		$month = date('m');
		$year = date('Y');
		if(isset($_POST['search']))
		{
			$month_year = $this->input->post('month');
			$month = date('m',strtotime($month_year));
			$year = date('Y',strtotime($month_year));
		}
		$user_id = login_details['user_id'];
		$employee_details = $this->sumit->fetchSingleData('*','employee',array('EMPID'=>$user_id));
		$total_days_in_month = cal_days_in_month(CAL_GREGORIAN,$month,$year);

		$result = array();
		for ($i=1; $i <=$total_days_in_month; $i++) { 
			
			$date = date('Y-m-d',strtotime($year.'-'.$month.'-'.$i));
			if(strtotime(date('Y-m-d')) >= strtotime($date))
			{
				$getAttendance = $this->attendance->getMyAttendance($date,$employee_details['id']);
				
				$result[$i] = $getAttendance;	
				$result[$i]['status'] = 'AB';	
				if($getAttendance['in_time']!='')
				{
					$result[$i]['status'] = 'P';				
				}
				else
				{
					$holiday_check = $this->sumit->fetchSingleData('ID,NAME','holiday_master',"date(FROM_DATE) <= '$date' AND date(TO_DATE) >='$date' AND APPLIED_FOR IN (0,1)");
					$checkSunday = date('N',strtotime($date));
				
					if(!empty($holiday_check) || $checkSunday == 7)
					{
						$result[$i]['status'] = 'H';
					}
					else
					{
						$leave_check = $this->sumit->fetchSingleData('*','emp_leave_attendance',"EMPLOYEE_ID='$user_id' AND date(DATE_FROM) <='$date' AND date(DATE_TO) >='$date' AND STATUS IN (0,1)");
						if(!empty($leave_check))
						{
							$status = ($leave_check['STATUS']==0)?'Leave Pending':(($leave_check['STATUS']==1)?$leave_check['LEAVE_TYPE']:'Leave Disapproved');
							$result[$i]['status'] = $status;
						}
					}
				}
				$result[$i]['date'] = $date;
			}
		}

		foreach ($result as $key => $value) 
		{
			$result[$key]['status'] = $value['status'];

			if($value['status'] != 'P' && $value['status'] =='H' && $key >1)
			{
				for ($prev_index=$key-1; $prev_index >=1; $prev_index--) 
				{ 
					if($result[$prev_index]['status'] == 'P')
					{
						$result[$key]['status'] = $value['status'];
						break;
					}
					elseif($result[$prev_index]['status'] != 'H')
					{
						$result[$key]['status'] = 'AB';
						break;
					}
					elseif($prev_index == 1 && $result[$prev_index]['status']=='H')
					{
						break;
					}
				}

				if($prev_index > 1 && $result[$key]['status']=='AB')
				{
					for ($next_index=$key+1; $next_index <= $total_days_in_month; $next_index++) 
					{ 
						if($result[$next_index]['status'] == 'P')
						{
							$result[$key]['status'] = $value['status'];
							break;
						}
						elseif($result[$next_index]['status'] != 'H')
						{
							$result[$key]['status'] = 'AB';
							break;
						}
					}
				}
			}
		}
		$data['shortLeaveTypeList'] = $this->custom_lib->shortLeaveRequestType();
		$data['result'] = $result;
		$data['leaveReasonList'] = $this->custom_lib->getLeaveReason();
		$data['employee_details'] = $employee_details;
		$this->render_template('principal_dashboard/myAttendance',$data);
	}
}
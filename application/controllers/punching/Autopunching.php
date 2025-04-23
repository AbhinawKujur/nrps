<?php 

class Autopunching extends MY_Controller
{	
	function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}

	public function index()
	{

		$data['month'] = $this->sumit->fetchAllData('*','month_master',array());
		$this->render_template('punching/autoPunching',$data);
	}

	public function createPunching()
	{
		$response = array();
		$month = $this->input->post('month');
		$current_session =$this->sumit->fetchSingleData('Session_Nm','session_master',array('Active_Status'=>1));
		$session_year = explode('-', $current_session['Session_Nm']);
		$current_year = $session_year[0];

		if($month < 4)
		{
			$current_year = $session_year[1];
		}
		$create = false;
		$time_compare = array();
		$time_diff = '';

		$total_days = cal_days_in_month(CAL_GREGORIAN,$month,$current_year);

		$checkAlreadyExist = $this->sumit->checkData('*','emp_attendance',"month(IN_TIME)='$month' AND year(IN_TIME)='$current_year'");
		if($checkAlreadyExist == false)
		{
			$empdata = $this->sumit->fetchAllData('*','employee',array('STATUS'=>1));

			foreach ($empdata as $key => $value) {
				$data = array();
				$shift_details = $this->sumit->fetchSingleData('*','shift_master',array('ID'=>$value['SHIFT']));
				for ($i=1; $i <= $total_days; $i++) { 

					$date = date('Y-m-d',strtotime($current_year.'-'.$month.'-'.$i));

					$in_time = $date.' '.$shift_details['START_TIME'];
					$out_time =$date.' '.$shift_details['STOP_TIME'];

					$data[] = array(
						'EMPLOYEE_ID'		=> $value['id'],
						'IN_TIME'			=> $in_time,
						'IN_CHECK_DIFFER'	=> "00:00:00",
						'OUT_TIME'			=> $out_time,
						'OUT_CHECK_DIFFER'	=> "00:00:00",
						'SHIFT_MASTER_ID'	=> $value['SHIFT'],
						'SHIFT_IN_TIME'		=> $shift_details['START_TIME'],
						'SHIFT_OUT_TIME'	=> $shift_details['STOP_TIME'],
						'SHIFT_DURATION'	=> $shift_details['SHIFT_DURATION'],
						'MIN_HRS_HALF'		=> $shift_details['MIN_HRS_HALF'],
						'MIN_HRS_FULL'		=> $shift_details['MIN_HRS_FULL'],
						'TOTAL_DURATION'	=> $shift_details['SHIFT_DURATION'],
						'STATUS'			=> 2,
						'PUNCH_TYPE'		=> 1,
						'ADMIN_ID'			=> login_details['user_id'],
					);
				}
				if(!empty($data))
				{
					$create = $this->sumit->createMultiple('emp_attendance',$data);
				}
			}
			if($create)
			{
				$response['msg'] = '1';
			}
			else
			{
				$response['msg'] = '2';
			}
		}
		else
		{
			$response['msg'] = '3'; //already generated
		}
	echo json_encode($response);
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function daily_wise(){

		if(!in_array('viewDailyAttenReport', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
        $data['ROLE_ID']    = login_details['ROLE_ID'];
        $data['log_cls_no'] = login_details['Class_No'];
		$data['class_data'] = $this->alam->select('student_attendance_type','*');
		
		$this->render_template('student/report/daily_wise',$data);
	}
	
	public function classes(){

		$ret      = '';
		$rett      = '';
		$class_nm = $this->input->post('val');
		$att_type_data = $this->alam->select('student_attendance_type','attendance_type',"class_code='$class_nm'");
		$att_type = $att_type_data[0]->attendance_type;
		
		$sec_data = $this->alam->select_order_by('student','distinct(DISP_SEC),SEC','DISP_SEC',"CLASS='$class_nm' AND Student_Status='ACTIVE'");
		
		$ROLE_ID    = login_details['ROLE_ID'];
		$log_sec_no = login_details['Section_No'];
		
		$ret .="<option value=''>Select</option>";
		if($ROLE_ID != 4){
		if(isset($sec_data)){
			foreach($sec_data as $data){
				if($log_sec_no == $data->SEC){
				 $ret .="<option value=". $data->SEC .">" . $data->DISP_SEC ."</option>";
				}
			}
		}
		}else{
		if(isset($sec_data)){ //for principal
			foreach($sec_data as $data){
				 $ret .="<option value=". $data->SEC .">" . $data->DISP_SEC ."</option>";
			}
		}	
		}
		if($att_type == 2){
			$rett .="<option value=''>Select</option>";
			$rett .="<option value='all'>All</option>";
		}else{
			$rett .="<option value=''>Select</option>";
			$rett .="<option value='P'>Present</option>";
			$rett .="<option value='A'>Absent</option>";
			$rett .="<option value='HD'>Half Day</option>";
			$rett .="<option value='all'>All</option>";
		}
		$array = array($ret,$rett);
		echo json_encode($array);
	}
	
	public function fetch_daily_wise(){

		$dt = $this->input->post('dt');
		$date = date('Y-m-d',strtotime($dt));
		$att_type = $this->input->post('att_type');
		$classs = $this->input->post('classs');
		$att_data = $this->alam->select('student_attendance_type','attendance_type',"class_code='$classs'");
		$att_typee = $att_data[0]->attendance_type;
		$sec = $this->input->post('sec');
		$rpt_typ = $this->input->post('rpt_typ');
		
		if($att_typee == 1){
			if($rpt_typ == 'all')
			{
				$data['fetch_data'] = $this->student_model->getDayWiseSingleDate("date(sae.att_date)='$date' AND sae.class_code='$classs' AND sae.sec_code='$sec'");

				$this->load->view('student/report/day_wise_report',$data);	
			}
			else
			{

				$data['fetch_data'] = $this->student_model->getDayWiseSingleDate("date(sae.att_date)='$date' AND sae.class_code='$classs' AND sae.sec_code='$sec' AND  sae.att_status = '$rpt_typ'");

				$this->load->view('student/report/day_wise_report',$data);
			}
		}else{
			$data['fetch_data'] = $this->student_model->getPeriodWiseSingleDate($date,$classs,$sec);
			$this->load->view('student/report/period_wise_report',$data);
		}
	}
	//Monthly Wise
	public function monthly_wise(){

		if(!in_array('viewMonthlyAttenReport', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		if(isset($_POST['search']))
		{
			$class_id = $this->input->post('class_id');
			$section_id = $this->input->post('section_id');
			$month = $this->input->post('month_id');

			$current_session =$this->sumit->fetchSingleData('Session_Nm','session_master',array('Active_Status'=>1));
			$session_year = explode('-', $current_session['Session_Nm']);
			$current_year = ($month < 4)?$session_year[1]:$session_year[0];
			$att_type_data = $this->alam->select('student_attendance_type','attendance_type',"class_code='$class_id'");
			$att_type = $att_type_data[0]->attendance_type;
			$total_days = cal_days_in_month(CAL_GREGORIAN,$month,$current_year);
			$data['total_days'] = $total_days;
			$data['att_type'] = $att_type;
			$att_data_array = array();

			$studentList = $this->sumit->fetchAllData('*','student',"CLASS='$class_id' AND SEC='$section_id' AND Student_Status='ACTIVE' ORDER BY ROLL_NO");
			if($att_type==1)
			{
				foreach ($studentList as $key => $value) {

					$att_data_array[$value['ADM_NO']]['admno'] = $value['ADM_NO'];
					$att_data_array[$value['ADM_NO']]['name'] = $value['FIRST_NM'];
					$att_data_array[$value['ADM_NO']]['roll'] = $value['ROLL_NO'];
					$att_data_array[$value['ADM_NO']]['class'] = $value['DISP_CLASS'];
					$att_data_array[$value['ADM_NO']]['sec'] = $value['DISP_SEC'];
					$att_data_array[$value['ADM_NO']]['mobile'] = $value['C_MOBILE'];

					for ($i=1; $i <= $total_days; $i++) { 

						$custom_date = date('Y-m-d',strtotime($current_year.'-'.$month.'-'.$i));
						$checkSunday = date('N',strtotime($custom_date));
						$checkHoliday = false;

						if($checkSunday != 7)
						{
							$checkHoliday = $this->sumit->checkData('*','holiday_master',"date('FROM_DATE')<='$custom_date' AND date('TO_DATE')>='$custom_date' AND CLASS_ID IN (0,'$class_id')");
						}
							
						if($checkSunday  == 7 || $checkHoliday == true)
						{
							$att_data_array[$value['ADM_NO']][$i]['status'] = 'H';
						}
						else
						{
							$checkAttenStatus = $this->sumit->fetchSingleData('*','stu_attendance_entry',"admno='".$value['ADM_NO']."' AND date(att_date)='$custom_date'");
							if(empty($checkAttenStatus))
							{
								$att_data_array[$value['ADM_NO']][$i]['status'] = '-';
							}
							else
							{
								$att_data_array[$value['ADM_NO']][$i]['status'] = $checkAttenStatus['att_status'];
							}
						}
					}
				}
			}
			else
			{
				for ($i=1; $i <= $total_days; $i++) { 

					$custom_date = date('Y-m-d',strtotime($current_year.'-'.$month.'-'.$i));
					$checkSunday = date('N',strtotime($custom_date));
					$checkHoliday = false;

					if($checkSunday != 7)
					{
						$checkHoliday = $this->sumit->checkData('*','holiday_master',"date('FROM_DATE')<='$custom_date' AND date('TO_DATE')>='$custom_date' AND CLASS_ID IN (0,'$class_id')");
					}

					if($checkSunday != 7 && $checkHoliday == false)
					{

						foreach ($studentList as $key => $value) 
						{
							$att_data_array[$value['ADM_NO']]['admno'] = $value['ADM_NO'];
							$att_data_array[$value['ADM_NO']]['name'] = $value['FIRST_NM'];
							$att_data_array[$value['ADM_NO']]['roll'] = $value['ROLL_NO'];
							$att_data_array[$value['ADM_NO']]['class'] = $value['DISP_CLASS'];
							$att_data_array[$value['ADM_NO']]['sec'] = $value['DISP_SEC'];
							$att_data_array[$value['ADM_NO']]['mobile'] = $value['C_MOBILE'];

							$attendance = $this->attendance->getStudentPeriodWiseAttendanceReport($custom_date,$value['ADM_NO']);
							if(!empty($attendance))
							{
								$att_data_array[$value['ADM_NO']][$i] = $attendance;
							}
							else
							{
								$att_data_array[$value['ADM_NO']][$i]['p1'] = '-';
								$att_data_array[$value['ADM_NO']][$i]['p2'] = '-';
								$att_data_array[$value['ADM_NO']][$i]['p3'] = '-';
								$att_data_array[$value['ADM_NO']][$i]['p4'] = '-';
								$att_data_array[$value['ADM_NO']][$i]['p5'] = '-';
								$att_data_array[$value['ADM_NO']][$i]['p6'] = '-';
								$att_data_array[$value['ADM_NO']][$i]['p7'] = '-';
								$att_data_array[$value['ADM_NO']][$i]['p8'] = '-';
							}
						}
					}
					else
					{
						foreach ($studentList as $key => $value) 
						{
							$att_data_array[$value['ADM_NO']]['admno'] = $value['ADM_NO'];
							$att_data_array[$value['ADM_NO']]['name'] = $value['FIRST_NM'];
							$att_data_array[$value['ADM_NO']]['roll'] = $value['ROLL_NO'];
							$att_data_array[$value['ADM_NO']]['class'] = $value['DISP_CLASS'];
							$att_data_array[$value['ADM_NO']]['sec'] = $value['DISP_SEC'];
							$att_data_array[$value['ADM_NO']]['mobile'] = $value['C_MOBILE'];

							$att_data_array[$value['ADM_NO']][$i]['p1'] = 'H';
							$att_data_array[$value['ADM_NO']][$i]['p2'] = 'H';
							$att_data_array[$value['ADM_NO']][$i]['p3'] = 'H';
							$att_data_array[$value['ADM_NO']][$i]['p4'] = 'H';
							$att_data_array[$value['ADM_NO']][$i]['p5'] = 'H';
							$att_data_array[$value['ADM_NO']][$i]['p6'] = 'H';
							$att_data_array[$value['ADM_NO']][$i]['p7'] = 'H';
							$att_data_array[$value['ADM_NO']][$i]['p8'] = 'H';
						}
					}
				}

			}
			$data['resultList'] = $att_data_array;
			$data['month'] = $month;
			$data['current_year'] = $current_year;
			// print_r("<pre>");
			// print_r($att_data_array);exit();
		}
		$data['ROLE_ID']    = login_details['ROLE_ID'];
        $log_cls_no = login_details['Class_No'];
		$data['monthList'] = $this->sumit->fetchAllData('*','month_master',array());
		if(login_details['ROLE_ID']==4)
		{
			$data['classList'] = $this->sumit->fetchAllData('*','classes',array());
		}
		else
		{
			$data['classList'] = $this->sumit->fetchAllData('*','classes',"Class_No='$log_cls_no'");
		}
		$this->render_template('student/report/monthly_wise',$data);
	}
	
	public function monthly_classes(){
		$ret      = '';
		$class_nm = $this->input->post('val');
		$att_type_data = $this->alam->select('student_attendance_type','attendance_type',"class_code='$class_nm'");
		$att_type = $att_type_data[0]->attendance_type;
		
		$sec_data = $this->alam->select_order_by('student','distinct(DISP_SEC),SEC','DISP_SEC',"CLASS='$class_nm' AND Student_Status='ACTIVE'");
		
		$ROLE_ID    = login_details['ROLE_ID'];
		$log_sec_no = login_details['Section_No'];
		
		$ret .="<option value=''>Select</option>";
		if($ROLE_ID != 4){
		if(isset($sec_data)){
			foreach($sec_data as $data){
				if($log_sec_no == $data->SEC){
				 $ret .="<option value=". $data->SEC .">" . $data->DISP_SEC ."</option>";
				}
			}
		}
		}else{
		if(isset($sec_data)){ //for principal
			foreach($sec_data as $data){
				 $ret .="<option value=". $data->SEC .">" . $data->DISP_SEC ."</option>";
			}
		}	
		}
		$array = array($ret);
		echo json_encode($array);
	}

	public function getSectionByClassID()
	{
		$class_id = $this->input->post('class_id');
		$section_id = login_details['Section_No'];
		$sectionList = array();
		if(login_details['ROLE_ID']==4)
		{
			$sectionList = $this->sumit->fetchAllData('DISP_SEC,SEC','student',"CLASS='$class_id' GROUP BY DISP_SEC,SEC ORDER BY DISP_SEC");
		}
		else
		{
			$sectionList = $this->sumit->fetchAllData('DISP_SEC,SEC','student',"CLASS='$class_id'  AND SEC='$section_id' GROUP BY DISP_SEC,SEC ORDER BY DISP_SEC");
		}
		echo json_encode($sectionList);
	}
	
	// public function month_wise_report(){
	// 	$month  = $this->input->post('month');
	// 	$classs = $this->input->post('classs');
	// 	$sec    = $this->input->post('sec');
	// 	$att_data_array = array();
	// 	$current_session =$this->sumit->fetchSingleData('Session_Nm','session_master',array('Active_Status'=>1));
	// 	$session_year = explode('-', $current_session['Session_Nm']);
	// 	$current_year = ($month < 4)?$session_year[1]:$session_year[0];

	// 	$data['current_year'] = $current_year;
	// 	$data['mnth'] = $month;
	// 	$att_type_data = $this->alam->select('student_attendance_type','attendance_type',"class_code='$classs'");
	// 	$att_type = $att_type_data[0]->attendance_type;
	// 	$total_days = cal_days_in_month(CAL_GREGORIAN,$month,$current_year);
	// 	$data['total_days'] = $total_days;

	// 	if($att_type == 1){//for day wise
	// 		$att_data_array = array();
	// 		$studentList = $this->sumit->fetchAllData('*','student',"CLASS='$classs' AND SEC='$sec' AND Student_Status='ACTIVE'");

	// 		foreach ($studentList as $key => $value) {

	// 			$att_data_array[$value['ADM_NO']]['admno'] = $value['ADM_NO'];
	// 			$att_data_array[$value['ADM_NO']]['name'] = $value['FIRST_NM'];
	// 			$att_data_array[$value['ADM_NO']]['roll'] = $value['ROLL_NO'];
	// 			$att_data_array[$value['ADM_NO']]['class'] = $value['DISP_CLASS'];
	// 			$att_data_array[$value['ADM_NO']]['sec'] = $value['DISP_SEC'];
	// 			$att_data_array[$value['ADM_NO']]['mobile'] = $value['C_MOBILE'];

	// 			for ($i=1; $i <= $total_days; $i++) { 

	// 				$custom_date = date('Y-m-d',strtotime($current_year.'-'.$month.'-'.$i));
	// 				$checkSunday = date('N',strtotime($custom_date));
	// 				$checkHoliday = false;

	// 				if($checkSunday != 7)
	// 				{
	// 					$checkHoliday = $this->sumit->checkData('*','holiday_master',"date('FROM_DATE')<='$custom_date' AND date('TO_DATE')>='$custom_date' AND CLASS_ID IN (0,'$classs')");
	// 				}
						
	// 				if($checkSunday  == 7 || $checkHoliday == true)
	// 				{
	// 					$att_data_array[$value['ADM_NO']][$i]['status'] = 'H';
	// 				}
	// 				else
	// 				{
	// 					$checkAttenStatus = $this->sumit->fetchSingleData('*','stu_attendance_entry',"admno='".$value['ADM_NO']."' AND date(att_date)='$custom_date'");
	// 					if(empty($checkAttenStatus))
	// 					{
	// 						$att_data_array[$value['ADM_NO']][$i]['status'] = '-';
	// 					}
	// 					else
	// 					{
	// 						$att_data_array[$value['ADM_NO']][$i]['status'] = $checkAttenStatus['att_status'];
	// 					}
	// 				}
	// 			}
	// 		}
	// 		$data['resultList'] = $att_data_array;
			
	// 		$this->load->view('student/report/monthly_day_wise_report',$data);
	// 	}else{//for period wise
	// 		$att_data_array = array();
	// 		$studentList = $this->sumit->fetchAllData('*','student',"CLASS='$classs' AND SEC='$sec' AND Student_Status='ACTIVE'");

	// 			for ($i=1; $i <= $total_days; $i++) { 

	// 				$custom_date = date('Y-m-d',strtotime($current_year.'-'.$month.'-'.$i));
	// 				$checkSunday = date('N',strtotime($custom_date));
	// 				$checkHoliday = false;

	// 				if($checkSunday != 7)
	// 				{
	// 					$checkHoliday = $this->sumit->checkData('*','holiday_master',"date('FROM_DATE')<='$custom_date' AND date('TO_DATE')>='$custom_date' AND CLASS_ID IN (0,'$classs')");
	// 				}

	// 				if($checkSunday != 7 && $checkHoliday == false)
	// 				{

	// 					foreach ($studentList as $key => $value) 
	// 					{
	// 						$att_data_array[$value['ADM_NO']]['admno'] = $value['ADM_NO'];
	// 						$att_data_array[$value['ADM_NO']]['name'] = $value['FIRST_NM'];
	// 						$att_data_array[$value['ADM_NO']]['roll'] = $value['ROLL_NO'];
	// 						$att_data_array[$value['ADM_NO']]['class'] = $value['DISP_CLASS'];
	// 						$att_data_array[$value['ADM_NO']]['sec'] = $value['DISP_SEC'];
	// 						$att_data_array[$value['ADM_NO']]['mobile'] = $value['C_MOBILE'];

	// 						$attendance = $this->attendance->getStudentPeriodWiseAttendanceReport($custom_date,$value['ADM_NO']);
	// 						if(!empty($attendance))
	// 						{
	// 							$att_data_array[$value['ADM_NO']][$i] = $attendance;
	// 						}
	// 						else
	// 						{
	// 							$att_data_array[$value['ADM_NO']][$i]['p1'] = '-';
	// 							$att_data_array[$value['ADM_NO']][$i]['p2'] = '-';
	// 							$att_data_array[$value['ADM_NO']][$i]['p3'] = '-';
	// 							$att_data_array[$value['ADM_NO']][$i]['p4'] = '-';
	// 							$att_data_array[$value['ADM_NO']][$i]['p5'] = '-';
	// 							$att_data_array[$value['ADM_NO']][$i]['p6'] = '-';
	// 							$att_data_array[$value['ADM_NO']][$i]['p7'] = '-';
	// 							$att_data_array[$value['ADM_NO']][$i]['p8'] = '-';
	// 						}
	// 					}
	// 				}
	// 				else
	// 				{
	// 					foreach ($studentList as $key => $value) 
	// 					{
	// 						$att_data_array[$value['ADM_NO']]['admno'] = $value['ADM_NO'];
	// 						$att_data_array[$value['ADM_NO']]['name'] = $value['FIRST_NM'];
	// 						$att_data_array[$value['ADM_NO']]['roll'] = $value['ROLL_NO'];
	// 						$att_data_array[$value['ADM_NO']]['class'] = $value['DISP_CLASS'];
	// 						$att_data_array[$value['ADM_NO']]['sec'] = $value['DISP_SEC'];
	// 						$att_data_array[$value['ADM_NO']]['mobile'] = $value['C_MOBILE'];

	// 						$att_data_array[$value['ADM_NO']][$i]['p1'] = 'H';
	// 						$att_data_array[$value['ADM_NO']][$i]['p2'] = 'H';
	// 						$att_data_array[$value['ADM_NO']][$i]['p3'] = 'H';
	// 						$att_data_array[$value['ADM_NO']][$i]['p4'] = 'H';
	// 						$att_data_array[$value['ADM_NO']][$i]['p5'] = 'H';
	// 						$att_data_array[$value['ADM_NO']][$i]['p6'] = 'H';
	// 						$att_data_array[$value['ADM_NO']][$i]['p7'] = 'H';
	// 						$att_data_array[$value['ADM_NO']][$i]['p8'] = 'H';
	// 					}
	// 				}
	// 			}

	// 		$data['resultList'] = $att_data_array;
	// 		$this->load->view('student/report/monthly_period_wise_report',$data);
	// 	}
	// }
}

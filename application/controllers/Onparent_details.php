<?php

/*
* @param1 : Plain String
* @param2 : Working key provided by CCAvenue
* @return : Decrypted String
*/
function encrypt($plainText,$key)
{
	$key = hextobin(md5($key));
	$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
	$openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
	$encryptedText = bin2hex($openMode);
	return $encryptedText;
}

/*
* @param1 : Encrypted String
* @param2 : Working key provided by CCAvenue
* @return : Plain String
*/
function decrypt($encryptedText,$key)
{
	$key = hextobin(md5($key));
	$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
	$encryptedText = hextobin($encryptedText);
	$decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
	return $decryptedText;
}

function hextobin($hexString) 
 { 
	$length = strlen($hexString); 
	$binString="";   
	$count=0; 
	while($count<$length) 
	{       
	    $subString =substr($hexString,$count,2);           
	    $packedString = pack("H*",$subString); 
	    if ($count==0)
	    {
			$binString=$packedString;
	    } 
	    
	    else 
	    {
			$binString.=$packedString;
	    } 
	    
	    $count+=2; 
	} 
        return $binString; 
  } 
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Onparent_details extends MY_controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Mymodel','dbcon');
		$this->load->model('FARHEEN','farheen');
	}
	public function student_profile(){
		$adm_no = $this->session->userdata('adm');
		$student_id = $this->session->userdata("std_id");
		$student_details = $this->dbcon->show_student($student_id);
		$father_details = $this->dbcon->selectSingleData('parents','*',array('STDID'=>$student_id,'PTYPE'=>'F'));
		$mother_details = $this->dbcon->selectSingleData('parents','*',array('STDID'=>$student_id,'PTYPE'=>'M'));
		$sibling_details = $this->dbcon->select('childhist','*',"StId='$student_id' AND AdmNo='$adm_no'");
		
		$array = array(
			'father_details' => $father_details,
			'student'	=> $student_details,
			'mother_details' => $mother_details,
			'sibling_details' => $sibling_details
		);
		$this->Parent_templete('parents_dashboard/student_profile',$array); 
	}

	public function stu_attendance(){
		$adm_no = $this->session->userdata('adm');
		$session_master = $this->sumit->fetchSingleData('*','session_master',"Active_Status=1");
		$session_year = explode('-', $session_master['Session_Nm']);

		$monthList = $this->sumit->fetchAllData('*','month_master',array());
		$studentDetails = $this->sumit->fetchSingleData('*','student',"ADM_NO='$adm_no'");

		$getAttendanceType = $this->sumit->fetchSingleData('attendance_type','student_attendance_type',array('class_code'=>$studentDetails['CLASS']));

		$table = ($getAttendanceType['attendance_type'] == 1)?'stu_attendance_entry':'stu_attendance_entry_periodwise';

		foreach ($monthList as $key => $value) {

			$current_year = ($value['month_code'] < 4)?$session_year[1]:$session_year[0];

			$present_days = $this->sumit->fetchSingleData('COUNT(DISTINCT(att_date))total_present',$table,"att_status IN ('P','HD') AND month(att_date)='".$value['month_code']."' AND admno = '$adm_no'");

			$absent_days = $this->sumit->fetchSingleData('COUNT(DISTINCT(att_date))absent_days',$table,"att_status ='A' AND month(att_date)='".$value['month_code']."' AND admno = '$adm_no'");

			$result[$key] = $value;
			$result[$key]['total_working_days'] = $present_days['total_present'] + $absent_days['absent_days'];
			$result[$key]['present_days'] = $present_days['total_present'];
			$result[$key]['absent_days'] = $absent_days['absent_days'];

		}

		$data['attendanceList'] = $result;
		$this->Parent_templete('parents_dashboard/attendance',$data); 
	}

	public function monthlyAttendanceDetails($month_code=null){
		if($month_code == null)
		{
			redirect('Parent_details/stu_attendance');
		}
		$adm_no = $this->session->userdata('adm');
		$session_master = $this->sumit->fetchSingleData('*','session_master',"Active_Status=1");
		$session_year = explode('-', $session_master['Session_Nm']);

		$studentDetails = $this->sumit->fetchSingleData('*','student',"ADM_NO='$adm_no'");

		$getAttendanceType = $this->sumit->fetchSingleData('attendance_type','student_attendance_type',array('class_code'=>$studentDetails['CLASS']));

		$table = ($getAttendanceType['attendance_type'] == 1)?'stu_attendance_entry':'stu_attendance_entry_periodwise';

		$current_year = ($month_code < 4)?$session_year[1]:$session_year[0];

		$total_days = cal_days_in_month(CAL_GREGORIAN,$month_code,$current_year);
		$result = array();
		for ($i=1; $i <= $total_days ; $i++) { 
			
			$custom_date = date('Y-m-d',strtotime($current_year.'-'.$month_code.'-'.$i));
			$weekend = date('N',strtotime($custom_date));
			$result[$i]['date'] = $custom_date;
			$result[$i]['status'] = '-';
			if($weekend == 7)
			{
				$result[$i]['status'] = 'H';
				$result[$i]['p1'] = 'H';
				$result[$i]['p2'] = 'H';
				$result[$i]['p3'] = 'H';
				$result[$i]['p4'] = 'H';
				$result[$i]['p5'] = 'H';
				$result[$i]['p6'] = 'H';
				$result[$i]['p7'] = 'H';
				$result[$i]['p8'] = 'H';
			}
			else
			{
				$holidayCheck = $this->sumit->fetchSingleData('*','holiday_master',"(APPLIED_FOR=0 AND date(FROM_DATE)<='$custom_date' AND date(TO_DATE)>='$custom_date') OR (APPLIED_FOR=2 AND CLASS_ID='".$studentDetails['CLASS']."' AND date(FROM_DATE)<='$custom_date' AND date(TO_DATE)>='$custom_date')");
				if(!empty($holidayCheck))
				{
					$result[$i]['status'] = 'H';
					$result[$i]['p1'] = 'H';
					$result[$i]['p2'] = 'H';
					$result[$i]['p3'] = 'H';
					$result[$i]['p4'] = 'H';
					$result[$i]['p5'] = 'H';
					$result[$i]['p6'] = 'H';
					$result[$i]['p7'] = 'H';
					$result[$i]['p8'] = 'H';
				}
				else
				{
					if($getAttendanceType['attendance_type'] == 1)
					{
						$getAttendance = $this->sumit->fetchSingleData('*','stu_attendance_entry',"admno='$adm_no' AND date(att_date)='$custom_date'");

						if(!empty($getAttendance))
						{
							$result[$i]['status'] = isset($getAttendance['att_status'])?$getAttendance['att_status']:'-';
						}
					}else
					{
						$getAttendances = $this->attendance->getStudentPeriodWiseAttendance($custom_date,$adm_no);
						if(!empty($getAttendances))
						{
							$result[$i]['p1'] = isset($getAttendances['P1'])?$getAttendances['P1']:'-';
							$result[$i]['p2'] = isset($getAttendances['P2'])?$getAttendances['P2']:'-';
							$result[$i]['p3'] = isset($getAttendances['P3'])?$getAttendances['P3']:'-';
							$result[$i]['p4'] = isset($getAttendances['P4'])?$getAttendances['P4']:'-';
							$result[$i]['p5'] = isset($getAttendances['P5'])?$getAttendances['P5']:'-';
							$result[$i]['p6'] = isset($getAttendances['P6'])?$getAttendances['P6']:'-';
							$result[$i]['p7'] = isset($getAttendances['P7'])?$getAttendances['P7']:'-';
							$result[$i]['p8'] = isset($getAttendances['P8'])?$getAttendances['P8']:'-';
						}
						else
						{
							$result[$i]['p1'] = '-';
							$result[$i]['p2'] = '-';
							$result[$i]['p3'] = '-';
							$result[$i]['p4'] = '-';
							$result[$i]['p5'] = '-';
							$result[$i]['p6'] = '-';
							$result[$i]['p7'] = '-';
							$result[$i]['p8'] = '-';
						}
					}
				}
			}
		}
		$data['attendanceList'] = $result;
		$data['attendance_type'] = $getAttendanceType['attendance_type'];
		$this->Parent_templete('parents_dashboard/monthlyAttendanceDetails',$data); 
	}

	public function attendance(){
		$year = $_REQUEST['year'];
		$month = $_REQUEST['month'];
		$adm_no = $this->session->userdata('adm');
		$total_days = cal_days_in_month(CAL_GREGORIAN,$month,$year);
		$endDate = $year.'-'.$month.'-'.$total_days;
		$startDate = $year.'-'.$month.'-1';
		$atten_arr = array();
		$attendance_data = $this->dbcon->select('stu_attendance_entry','*',"admno='$adm_no'");
		$att_count = count($attendance_data);
		for($i=0;$i<$att_count;$i++){
			if($attendance_data[$i]->att_status == 'P')
			{
					$atten_arr[] = array(
						"date" => date("Y-m-d", strtotime($attendance_data[$i]->att_date)),
						"badge"	=> false,
						"classname" => "present",
						"title"		=> "Present",
					);
			}
			elseif ($attendance_data[$i]->att_status == 'A') {
				$atten_arr[] = array(
						"date" => date("Y-m-d", strtotime($attendance_data[$i]->att_date)),
						"badge"	=> false,
						"classname" => "absent",
						"title"		=> "Absent",
					);
			}
			elseif ($attendance_data[$i]->att_status == 'HD') {
				$atten_arr[] = array(
						"date" => date("Y-m-d", strtotime($attendance_data[$i]->att_date)),
						"badge"	=> false,
						"classname" => "halfday",
						"title"		=> $attendance_data[$i]->remarks,
					);
			}
		}
		echo json_encode(json_decode(json_encode($atten_arr)));
	}
	
	public function pay_details(){
		$adm_no = $this->session->userdata('adm');
		$student_details = $this->dbcon->selectSingleData('student','*',"ADM_NO='$adm_no'");
		$apr_fee = $this->dbcon->selectSingleData('feegeneration','TOTAL',"ADM_NO='$adm_no' AND Month_NM='APR'");
		$may_fee = $this->dbcon->selectSingleData('feegeneration','TOTAL',"ADM_NO='$adm_no' AND Month_NM='MAY'");
		$jun_fee = $this->dbcon->selectSingleData('feegeneration','TOTAL',"ADM_NO='$adm_no' AND Month_NM='JUN'");
		$jul_fee = $this->dbcon->selectSingleData('feegeneration','TOTAL',"ADM_NO='$adm_no' AND Month_NM='JUL'");
		$aug_fee = $this->dbcon->selectSingleData('feegeneration','TOTAL',"ADM_NO='$adm_no' AND Month_NM='AUG'");
		$sep_fee = $this->dbcon->selectSingleData('feegeneration','TOTAL',"ADM_NO='$adm_no' AND Month_NM='SEP'");
		$oct_fee = $this->dbcon->selectSingleData('feegeneration','TOTAL',"ADM_NO='$adm_no' AND Month_NM='OCT'");
		$nov_fee = $this->dbcon->selectSingleData('feegeneration','TOTAL',"ADM_NO='$adm_no' AND Month_NM='NOV'");
		$dec_fee = $this->dbcon->selectSingleData('feegeneration','TOTAL',"ADM_NO='$adm_no' AND Month_NM='DEC'");
		$jan_fee = $this->dbcon->selectSingleData('feegeneration','TOTAL',"ADM_NO='$adm_no' AND Month_NM='JAN'");
		$feb_fee = $this->dbcon->selectSingleData('feegeneration','TOTAL',"ADM_NO='$adm_no' AND Month_NM='FEB'");
		$mar_fee = $this->dbcon->selectSingleData('feegeneration','TOTAL',"ADM_NO='$adm_no' AND Month_NM='MAR'");
		$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','JAN','FEB','MAR');
		//=========================================================//
		$pre_details = $this->dbcon->select('previous_year_feegeneration','sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25',"ADM_NO='$adm_no'");
		
		if(!empty($pre_details))
		{
			$fee1_predues = $pre_details[0]->Fee1;
			$fee2_predues = $pre_details[0]->Fee2;
			$fee3_predues = $pre_details[0]->Fee3;
			$fee4_predues = $pre_details[0]->Fee4;
			$fee5_predues = $pre_details[0]->Fee5;
			$fee6_predues = $pre_details[0]->Fee6;
			$fee7_predues = $pre_details[0]->Fee7;
			$fee8_predues = $pre_details[0]->Fee8;
			$fee9_predues = $pre_details[0]->Fee9;
			$fee10_predues = $pre_details[0]->Fee10;
			$fee11_predues = $pre_details[0]->Fee11;
			$fee12_predues = $pre_details[0]->Fee12;
			$fee13_predues = $pre_details[0]->Fee13;
			$fee14_predues = $pre_details[0]->Fee14;
			$fee15_predues = $pre_details[0]->Fee15;
			$fee16_predues = $pre_details[0]->Fee16;
			$fee17_predues = $pre_details[0]->Fee17;
			$fee18_predues = $pre_details[0]->Fee18;
			$fee19_predues = $pre_details[0]->Fee19;
			$fee20_predues = $pre_details[0]->Fee20;
			$fee21_predues = $pre_details[0]->Fee21;
			$fee22_predues = $pre_details[0]->Fee22;
			$fee23_predues = $pre_details[0]->Fee23;
			$fee24_predues = $pre_details[0]->Fee24;
			$fee25_predues = $pre_details[0]->Fee25;
		}
		else
		{
			$fee1_predues = 0;
			$fee2_predues = 0;
			$fee3_predues = 0;
			$fee4_predues = 0;
			$fee5_predues = 0;
			$fee6_predues = 0;
			$fee7_predues = 0;
			$fee8_predues = 0;
			$fee9_predues = 0;
			$fee10_predues = 0;
			$fee11_predues = 0;
			$fee12_predues = 0;
			$fee13_predues = 0;
			$fee14_predues = 0;
			$fee15_predues = 0;
			$fee16_predues = 0;
			$fee17_predues = 0;
			$fee18_predues = 0;
			$fee19_predues = 0;
			$fee20_predues = 0;
			$fee21_predues = 0;
			$fee22_predues = 0;
			$fee23_predues = 0;
			$fee24_predues = 0;
			$fee25_predues = 0;
		}
		
		$total_previous_dues = $fee1_predues+$fee2_predues+$fee3_predues+$fee4_predues+$fee5_predues+$fee6_predues+$fee7_predues+$fee8_predues+$fee9_predues+$fee10_predues+$fee11_predues+$fee12_predues+$fee13_predues+$fee14_predues+$fee15_predues+$fee16_predues+$fee17_predues+$fee18_predues+$fee19_predues+$fee20_predues+$fee21_predues+$fee22_predues+$fee23_predues+$fee24_predues+$fee25_predues;
		//=========================================================//
		
				// startn chekcking the month fee from the student table of perticular student //
				$MON_FEE[0] = $student_details->APR_FEE;
				$MON_FEE[1] = $student_details->MAY_FEE;
				$MON_FEE[2] = $student_details->JUNE_FEE;
				$MON_FEE[3] = $student_details->JULY_FEE;
				$MON_FEE[4] = $student_details->AUG_FEE;
				$MON_FEE[5] = $student_details->SEP_FEE;
				$MON_FEE[6] = $student_details->OCT_FEE;
				$MON_FEE[7] = $student_details->NOV_FEE;
				$MON_FEE[8] = $student_details->DEC_FEE;
				$MON_FEE[9] = $student_details->JAN_FEE;
				$MON_FEE[10] = $student_details->FEB_FEE;
				$MON_FEE[11] = $student_details->MAR_FEE;
				//checking end recpt_no from student no //
				//-getting feedetails from the daycoll and tem_daycoll //
					foreach($MON_FEE as $key=>$value){
						$mn = $value;
						$mn_nm = (explode("P",$mn));
						@$rct = $mn_nm[1];
						$temp_data = $this->dbcon->selectSingleData('temp_daycoll','TOTAL',"RECT_NO='$rct' AND SEC='Z' AND ADM_NO='$adm_no'");
						
						if(empty($temp_data)){
							$daycoll_data = $this->dbcon->selectSingleData('daycoll','TOTAL',"RECT_NO='$value' AND ADM_NO='$adm_no'");
							IF(!empty($daycoll_data)){
								$fee_paid[] = $daycoll_data->TOTAL;
								
							}ELSE{
								$fee_paid[] = 0;
							}
						}else{
							$fee_paid[] = $temp_data->TOTAL;
						}
					}
					// ECHO "<PRE>";
					// print_r($MON_FEE);
					// exit;
				//=====================================================//
				$current_year = 0;
				$current_year_total = 0;
				$temp_daycoll_amount = 0;
				$fee1_feegeneration = 0;
				$fee2_feegeneration = 0;
				$fee3_feegeneration = 0;
				$fee4_feegeneration = 0;
				$fee5_feegeneration = 0;
				$fee6_feegeneration = 0;
				$fee7_feegeneration = 0;
				$fee8_feegeneration = 0;
				$fee9_feegeneration = 0;
				$fee10_feegeneration = 0;
				$fee11_feegeneration = 0;
				$fee12_feegeneration = 0;
				$fee13_feegeneration = 0;
				$fee14_feegeneration = 0;
				$fee15_feegeneration = 0;
				$fee16_feegeneration = 0;
				$fee17_feegeneration = 0;
				$fee18_feegeneration = 0;
				$fee19_feegeneration = 0;
				$fee20_feegeneration = 0;
				$fee21_feegeneration = 0;
				$fee22_feegeneration = 0;
				$fee23_feegeneration = 0;
				$fee24_feegeneration = 0;
				$fee25_feegeneration = 0;
				
				$fee1_paid_month = 0;
				$fee2_paid_month = 0;
				$fee3_paid_month = 0;
				$fee4_paid_month = 0;
				$fee5_paid_month = 0;
				$fee6_paid_month = 0;
				$fee7_paid_month = 0;
				$fee8_paid_month = 0;
				$fee9_paid_month = 0;
				$fee10_paid_month = 0;
				$fee11_paid_month = 0;
				$fee12_paid_month = 0;
				$fee13_paid_month = 0;
				$fee14_paid_month = 0;
				$fee15_paid_month = 0;
				$fee16_paid_month = 0;
				$fee17_paid_month = 0;
				$fee18_paid_month = 0;
				$fee19_paid_month = 0;
				$fee20_paid_month = 0;
				$fee21_paid_month = 0;
				$fee22_paid_month = 0;
				$fee23_paid_month = 0;
				$fee24_paid_month = 0;
				$fee25_paid_month = 0;
				
				$fee1_unpaid_month = 0;
				$fee2_unpaid_month = 0;
				$fee3_unpaid_month = 0;
				$fee4_unpaid_month = 0;
				$fee5_unpaid_month = 0;
				$fee6_unpaid_month = 0;
				$fee7_unpaid_month = 0;
				$fee8_unpaid_month = 0;
				$fee9_unpaid_month = 0;
				$fee10_unpaid_month = 0;
				$fee11_unpaid_month = 0;
				$fee12_unpaid_month = 0;
				$fee13_unpaid_month = 0;
				$fee14_unpaid_month = 0;
				$fee15_unpaid_month = 0;
				$fee16_unpaid_month = 0;
				$fee17_unpaid_month = 0;
				$fee18_unpaid_month = 0;
				$fee19_unpaid_month = 0;
				$fee20_unpaid_month = 0;
				$fee21_unpaid_month = 0;
				$fee22_unpaid_month = 0;
				$fee23_unpaid_month = 0;
				$fee24_unpaid_month = 0;
				$fee25_unpaid_month = 0;
				
				$parcial_dues_total = 0;
				// starting the fethching the data from table //
				$daycolll = $this->dbcon->select('daycoll','sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25',"ADM_NO='$adm_no'");
				if(!empty($daycolll)){
					$fee1_daycolll = $daycolll[0]->Fee1;
					$fee2_daycolll = $daycolll[0]->Fee2;
					$fee3_daycolll = $daycolll[0]->Fee3;
					$fee4_daycolll = $daycolll[0]->Fee4;
					$fee5_daycolll = $daycolll[0]->Fee5;
					$fee6_daycolll = $daycolll[0]->Fee6;
					$fee7_daycolll = $daycolll[0]->Fee7;
					$fee8_daycolll = $daycolll[0]->Fee8;
					$fee9_daycolll = $daycolll[0]->Fee9;
					$fee10_daycolll = $daycolll[0]->Fee10;
					$fee11_daycolll = $daycolll[0]->Fee11;
					$fee12_daycolll = $daycolll[0]->Fee12;
					$fee13_daycolll = $daycolll[0]->Fee13;
					$fee14_daycolll = $daycolll[0]->Fee14;
					$fee15_daycolll = $daycolll[0]->Fee15;
					$fee16_daycolll = $daycolll[0]->Fee16;
					$fee17_daycolll = $daycolll[0]->Fee17;
					$fee18_daycolll = $daycolll[0]->Fee18;
					$fee19_daycolll = $daycolll[0]->Fee19;
					$fee20_daycolll = $daycolll[0]->Fee20;
					$fee21_daycolll = $daycolll[0]->Fee21;
					$fee22_daycolll = $daycolll[0]->Fee22;
					$fee23_daycolll = $daycolll[0]->Fee23;
					$fee24_daycolll = $daycolll[0]->Fee24;
					$fee25_daycolll = $daycolll[0]->Fee25;
				}
				else{
					$fee1_daycolll = 0;
					$fee2_daycolll = 0;
					$fee3_daycolll = 0;
					$fee4_daycolll = 0;
					$fee5_daycolll = 0;
					$fee6_daycolll = 0;
					$fee7_daycolll = 0;
					$fee8_daycolll = 0;
					$fee9_daycolll = 0;
					$fee10_daycolll = 0;
					$fee11_daycolll = 0;
					$fee12_daycolll = 0;
					$fee13_daycolll = 0;
					$fee14_daycolll = 0;
					$fee15_daycolll = 0;
					$fee16_daycolll = 0;
					$fee17_daycolll = 0;
					$fee18_daycolll = 0;
					$fee19_daycolll = 0;
					$fee20_daycolll = 0;
					$fee21_daycolll = 0;
					$fee22_daycolll = 0;
					$fee23_daycolll = 0;
					$fee24_daycolll = 0;
					$fee25_daycolll = 0;
					$AMOUNT_DAYCOLL = 0;
				}
				$temp_daycoll = $this->dbcon->select('temp_daycoll','sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25',"ADM_NO='$adm_no' AND SEC='Z'");
				if(!empty($temp_daycoll))
				{
					$fee1_temp_daycoll = $fee1_daycolll+$temp_daycoll[0]->Fee1;
					$fee2_temp_daycoll = $fee2_daycolll+$temp_daycoll[0]->Fee2;
					$fee3_temp_daycoll = $fee3_daycolll+$temp_daycoll[0]->Fee3;
					$fee4_temp_daycoll = $fee4_daycolll+$temp_daycoll[0]->Fee4;
					$fee5_temp_daycoll = $fee5_daycolll+$temp_daycoll[0]->Fee5;
					$fee6_temp_daycoll = $fee6_daycolll+$temp_daycoll[0]->Fee6;
					$fee7_temp_daycoll = $fee7_daycolll+$temp_daycoll[0]->Fee7;
					$fee8_temp_daycoll = $fee8_daycolll+$temp_daycoll[0]->Fee8;
					$fee9_temp_daycoll = $fee9_daycolll+$temp_daycoll[0]->Fee9;
					$fee10_temp_daycoll = $fee10_daycolll+$temp_daycoll[0]->Fee10;
					$fee11_temp_daycoll = $fee11_daycolll+$temp_daycoll[0]->Fee11;
					$fee12_temp_daycoll = $fee12_daycolll+$temp_daycoll[0]->Fee12;
					$fee13_temp_daycoll = $fee13_daycolll+$temp_daycoll[0]->Fee13;
					$fee14_temp_daycoll = $fee14_daycolll+$temp_daycoll[0]->Fee14;
					$fee15_temp_daycoll = $fee15_daycolll+$temp_daycoll[0]->Fee15;
					$fee16_temp_daycoll = $fee16_daycolll+$temp_daycoll[0]->Fee16;
					$fee17_temp_daycoll = $fee17_daycolll+$temp_daycoll[0]->Fee17;
					$fee18_temp_daycoll = $fee18_daycolll+$temp_daycoll[0]->Fee18;
					$fee19_temp_daycoll = $fee19_daycolll+$temp_daycoll[0]->Fee19;
					$fee20_temp_daycoll = $fee20_daycolll+$temp_daycoll[0]->Fee20;
					$fee21_temp_daycoll = $fee21_daycolll+$temp_daycoll[0]->Fee21;
					$fee22_temp_daycoll = $fee22_daycolll+$temp_daycoll[0]->Fee22;
					$fee23_temp_daycoll = $fee23_daycolll+$temp_daycoll[0]->Fee23;
					$fee24_temp_daycoll = $fee24_daycolll+$temp_daycoll[0]->Fee24;
					$fee25_temp_daycoll = $fee25_daycolll+$temp_daycoll[0]->Fee25;
				}
				else{
					$fee1_temp_daycoll = $fee1_daycolll+0;
					$fee2_temp_daycoll = $fee2_daycolll+0;
					$fee3_temp_daycoll = $fee3_daycolll+0;
					$fee4_temp_daycoll = $fee4_daycolll+0;
					$fee5_temp_daycoll = $fee5_daycolll+0;
					$fee6_temp_daycoll = $fee6_daycolll+0;
					$fee7_temp_daycoll = $fee7_daycolll+0;
					$fee8_temp_daycoll = $fee8_daycolll+0;
					$fee9_temp_daycoll = $fee9_daycolll+0;
					$fee10_temp_daycoll = $fee10_daycolll+0;
					$fee11_temp_daycoll = $fee11_daycolll+0;
					$fee12_temp_daycoll = $fee12_daycolll+0;
					$fee13_temp_daycoll = $fee13_daycolll+0;
					$fee14_temp_daycoll = $fee14_daycolll+0;
					$fee15_temp_daycoll = $fee15_daycolll+0;
					$fee16_temp_daycoll = $fee16_daycolll+0;
					$fee17_temp_daycoll = $fee17_daycolll+0;
					$fee18_temp_daycoll = $fee18_daycolll+0;
					$fee19_temp_daycoll = $fee19_daycolll+0;
					$fee20_temp_daycoll = $fee20_daycolll+0;
					$fee21_temp_daycoll = $fee21_daycolll+0;
					$fee22_temp_daycoll = $fee22_daycolll+0;
					$fee23_temp_daycoll = $fee23_daycolll+0;
					$fee24_temp_daycoll = $fee24_daycolll+0;
					$fee25_temp_daycoll = $fee25_daycolll+0;
					$temp_daycoll_amount = 0;
				}
				// end of fetching data from the table //
				for($l=0;$l<12;$l++)
				{
					if($MON_FEE[$l]!='N/A' AND $MON_FEE[$l]!='' AND $MON_FEE[$l]!='n/a')
					{
					}
					else
					{
						$unpaid_month = $this->dbcon->select('feegeneration','sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25',"ADM_NO='$adm_no' AND Month_NM='$monthin[$l]'");
						if(!empty($unpaid_month)){
							$fee1_unpaid_month += $unpaid_month[0]->Fee1;
							$fee2_unpaid_month += $unpaid_month[0]->Fee2;
							$fee3_unpaid_month += $unpaid_month[0]->Fee3;
							$fee4_unpaid_month += $unpaid_month[0]->Fee4;
							$fee5_unpaid_month += $unpaid_month[0]->Fee5;
							$fee6_unpaid_month += $unpaid_month[0]->Fee6;
							$fee7_unpaid_month += $unpaid_month[0]->Fee7;
							$fee8_unpaid_month += $unpaid_month[0]->Fee8;
							$fee9_unpaid_month += $unpaid_month[0]->Fee9;
							$fee10_unpaid_month += $unpaid_month[0]->Fee10;
							$fee11_unpaid_month += $unpaid_month[0]->Fee11;
							$fee12_unpaid_month += $unpaid_month[0]->Fee12;
							$fee13_unpaid_month += $unpaid_month[0]->Fee13;
							$fee14_unpaid_month += $unpaid_month[0]->Fee14;
							$fee15_unpaid_month += $unpaid_month[0]->Fee15;
							$fee16_unpaid_month += $unpaid_month[0]->Fee16;
							$fee17_unpaid_month += $unpaid_month[0]->Fee17;
							$fee18_unpaid_month += $unpaid_month[0]->Fee18;
							$fee19_unpaid_month += $unpaid_month[0]->Fee19;
							$fee20_unpaid_month += $unpaid_month[0]->Fee20;
							$fee21_unpaid_month += $unpaid_month[0]->Fee21;
							$fee22_unpaid_month += $unpaid_month[0]->Fee22;
							$fee23_unpaid_month += $unpaid_month[0]->Fee23;
							$fee24_unpaid_month += $unpaid_month[0]->Fee24;
							$fee25_unpaid_month += $unpaid_month[0]->Fee25;
						}
					}
					if($MON_FEE[$l] == 'FREESHIP' ||  $MON_FEE[$l]=="TC_ISSUE" || $MON_FEE[$l]=="PAID" )
					{
						
					}
					else{
						$feegeneration = $this->dbcon->select('feegeneration','sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25',"ADM_NO='$adm_no' AND Month_NM='$monthin[$l]'");
						if(!empty($feegeneration)){
							$fee1_feegeneration += $feegeneration[0]->Fee1;
							$fee2_feegeneration += $feegeneration[0]->Fee2;
							$fee3_feegeneration += $feegeneration[0]->Fee3;
							$fee4_feegeneration += $feegeneration[0]->Fee4;
							$fee5_feegeneration += $feegeneration[0]->Fee5;
							$fee6_feegeneration += $feegeneration[0]->Fee6;
							$fee7_feegeneration += $feegeneration[0]->Fee7;
							$fee8_feegeneration += $feegeneration[0]->Fee8;
							$fee9_feegeneration += $feegeneration[0]->Fee9;
							$fee10_feegeneration += $feegeneration[0]->Fee10;
							$fee11_feegeneration += $feegeneration[0]->Fee11;
							$fee12_feegeneration += $feegeneration[0]->Fee12;
							$fee13_feegeneration += $feegeneration[0]->Fee13;
							$fee14_feegeneration += $feegeneration[0]->Fee14;
							$fee15_feegeneration += $feegeneration[0]->Fee15;
							$fee16_feegeneration += $feegeneration[0]->Fee16;
							$fee17_feegeneration += $feegeneration[0]->Fee17;
							$fee18_feegeneration += $feegeneration[0]->Fee18;
							$fee19_feegeneration += $feegeneration[0]->Fee19;
							$fee20_feegeneration += $feegeneration[0]->Fee20;
							$fee21_feegeneration += $feegeneration[0]->Fee21;
							$fee22_feegeneration += $feegeneration[0]->Fee22;
							$fee23_feegeneration += $feegeneration[0]->Fee23;
							$fee24_feegeneration += $feegeneration[0]->Fee24;
							$fee25_feegeneration += $feegeneration[0]->Fee25;
						}
					}	
				}
				$fee1_paid_month = ($fee1_feegeneration-$fee1_unpaid_month);
				$fee2_paid_month = ($fee2_feegeneration-$fee2_unpaid_month);
				$fee3_paid_month = ($fee3_feegeneration-$fee3_unpaid_month);
				$fee4_paid_month = ($fee4_feegeneration-$fee4_unpaid_month);
				$fee5_paid_month = ($fee5_feegeneration-$fee5_unpaid_month);
				$fee6_paid_month = ($fee6_feegeneration-$fee6_unpaid_month);
				$fee7_paid_month = ($fee7_feegeneration-$fee7_unpaid_month);
				$fee8_paid_month = ($fee8_feegeneration-$fee8_unpaid_month);
				$fee9_paid_month = ($fee9_feegeneration-$fee9_unpaid_month);
				$fee10_paid_month = ($fee10_feegeneration-$fee10_unpaid_month);
				$fee11_paid_month = ($fee11_feegeneration-$fee11_unpaid_month);
				$fee12_paid_month = ($fee12_feegeneration-$fee12_unpaid_month);
				$fee13_paid_month = ($fee13_feegeneration-$fee13_unpaid_month);
				$fee14_paid_month = ($fee14_feegeneration-$fee14_unpaid_month);
				$fee15_paid_month = ($fee15_feegeneration-$fee15_unpaid_month);
				$fee16_paid_month = ($fee16_feegeneration-$fee16_unpaid_month);
				$fee17_paid_month = ($fee17_feegeneration-$fee17_unpaid_month);
				$fee18_paid_month = ($fee18_feegeneration-$fee18_unpaid_month);
				$fee19_paid_month = ($fee19_feegeneration-$fee19_unpaid_month);
				$fee20_paid_month = ($fee20_feegeneration-$fee20_unpaid_month);
				$fee21_paid_month = ($fee21_feegeneration-$fee21_unpaid_month);
				$fee22_paid_month = ($fee22_feegeneration-$fee22_unpaid_month);
				$fee23_paid_month = ($fee23_feegeneration-$fee23_unpaid_month);
				$fee24_paid_month = ($fee24_feegeneration-$fee24_unpaid_month);
				$fee25_paid_month = ($fee25_feegeneration-$fee25_unpaid_month);
				
				$parcial_fee1 = ($fee1_paid_month-$fee1_temp_daycoll);
				$parcial_fee2 = ($fee2_paid_month-$fee2_temp_daycoll);
				$parcial_fee3 = ($fee3_paid_month-$fee3_temp_daycoll);
				$parcial_fee4 = ($fee4_paid_month-$fee4_temp_daycoll);
				$parcial_fee5 = ($fee5_paid_month-$fee5_temp_daycoll);
				$parcial_fee6 = ($fee6_paid_month-$fee6_temp_daycoll);
				$parcial_fee7 = ($fee7_paid_month-$fee7_temp_daycoll);
				$parcial_fee8 = ($fee8_paid_month-$fee8_temp_daycoll);
				$parcial_fee9 = ($fee9_paid_month-$fee9_temp_daycoll);
				$parcial_fee10 = ($fee10_paid_month-$fee10_temp_daycoll);
				$parcial_fee11 = ($fee11_paid_month-$fee11_temp_daycoll);
				$parcial_fee12 = ($fee12_paid_month-$fee12_temp_daycoll);
				$parcial_fee13 = ($fee13_paid_month-$fee13_temp_daycoll);
				$parcial_fee14 = ($fee14_paid_month-$fee14_temp_daycoll);
				$parcial_fee15 = ($fee15_paid_month-$fee15_temp_daycoll);
				$parcial_fee16 = ($fee16_paid_month-$fee16_temp_daycoll);
				$parcial_fee17 = ($fee17_paid_month-$fee17_temp_daycoll);
				$parcial_fee18 = ($fee18_paid_month-$fee18_temp_daycoll);
				$parcial_fee19 = ($fee19_paid_month-$fee19_temp_daycoll);
				$parcial_fee20 = ($fee20_paid_month-$fee20_temp_daycoll);
				$parcial_fee21 = ($fee21_paid_month-$fee21_temp_daycoll);
				$parcial_fee22 = ($fee22_paid_month-$fee22_temp_daycoll);
				$parcial_fee23 = ($fee23_paid_month-$fee23_temp_daycoll);
				$parcial_fee24 = ($fee24_paid_month-$fee24_temp_daycoll);
				$parcial_fee25 = ($fee25_paid_month-$fee25_temp_daycoll);
				
				if($parcial_fee1 > 0)
				{
					$parcial_dues_total += $parcial_fee1;
				}else{
					$parcial_dues_total += 0;
				}
				if($parcial_fee2 > 0)
				{
					$parcial_dues_total += $parcial_fee2;
				}else{
					$parcial_dues_total += 0;
				}
				if($parcial_fee3 > 0)
				{
					$parcial_dues_total += $parcial_fee3;
				}else{
					$parcial_dues_total += 0;
				}
				if($parcial_fee4 > 0)
				{
					$parcial_dues_total += $parcial_fee4;
				}else{
					$parcial_dues_total += 0;
				}
				if($parcial_fee5 > 0)
				{
					$parcial_dues_total += $parcial_fee5;
				}else{
					$parcial_dues_total += 0;
				}
				if($parcial_fee6 > 0)
				{
					$parcial_dues_total += $parcial_fee6;
				}else{
					$parcial_dues_total += 0;
				}
				if($parcial_fee7 > 0)
				{
					$parcial_dues_total += $parcial_fee7;
				}else{
					$parcial_dues_total += 0;
				}
				if($parcial_fee8 > 0)
				{
					$parcial_dues_total += $parcial_fee8;
				}else{
					$parcial_dues_total += 0;
				}
				if($parcial_fee9 > 0)
				{
					$parcial_dues_total += $parcial_fee9;
				}else{
					$parcial_dues_total += 0;
				}
				if($parcial_fee10 > 0)
				{
					$parcial_dues_total += $parcial_fee10;
				}else{
					$parcial_dues_total += 0;
				}
				if($parcial_fee11 > 0)
				{
					$parcial_dues_total += $parcial_fee11;
				}else{
					$parcial_dues_total += 0;
				}
				if($parcial_fee12 > 0)
				{
					$parcial_dues_total += $parcial_fee12;
				}else{
					$parcial_dues_total += 0;
				}
				if($parcial_fee13 > 0)
				{
					$parcial_dues_total += $parcial_fee13;
				}else{
					$parcial_dues_total += 0;
				}
				if($parcial_fee14 > 0)
				{
					$parcial_dues_total += $parcial_fee14;
				}else{
					$parcial_dues_total += 0;
				}
				if($parcial_fee15 > 0)
				{
					$parcial_dues_total += $parcial_fee15;
				}else{
					$parcial_dues_total += 0;
				}
				if($parcial_fee16 > 0)
				{
					$parcial_dues_total += $parcial_fee16;
				}else{
					$parcial_dues_total += 0;
				}
				if($parcial_fee17 > 0)
				{
					$parcial_dues_total += $parcial_fee17;
				}else{
					$parcial_dues_total += 0;
				}
				if($parcial_fee18 > 0)
				{
					$parcial_dues_total += $parcial_fee18;
				}else{
					$parcial_dues_total += 0;
				}
				if($parcial_fee19 > 0)
				{
					$parcial_dues_total += $parcial_fee19;
				}else{
					$parcial_dues_total += 0;
				}
				if($parcial_fee20 > 0)
				{
					$parcial_dues_total += $parcial_fee20;
				}else{
					$parcial_dues_total += 0;
				}
				if($parcial_fee21 > 0)
				{
					$parcial_dues_total += $parcial_fee21;
				}else{
					$parcial_dues_total += 0;
				}
				if($parcial_fee22 > 0)
				{
					$parcial_dues_total += $parcial_fee22;
				}else{
					$parcial_dues_total += 0;
				}
				if($parcial_fee23 > 0)
				{
					$parcial_dues_total += $parcial_fee23;
				}else{
					$parcial_dues_total += 0;
				}
				if($parcial_fee24 > 0)
				{
					$parcial_dues_total += $parcial_fee24;
				}else{
					$parcial_dues_total += 0;
				}
				if($parcial_fee25 > 0)
				{
					$parcial_dues_total += $parcial_fee25;
				}else{
					$parcial_dues_total += 0;
				}
				
		$array = array(
			'student_details' => $student_details,
			'previous_dues' => $total_previous_dues,
			'fee_paid_details' => $fee_paid,
			'parcial_dues_total' => 0
			);
			// echo "<pre>";
			// print_r($array);
			// exit;
		$this->Parent_templete('parents_dashboard/onfeedetails',$array);
	}
	public function rect_download(){
		$rect_no = $this->input->post('rect_no');
		if(!empty($rect_no))
		{
			echo 1;
			$this->session->set_userdata('stu_rect_no',$rect_no);
		}
		else{
			echo 0;
		}
	}
	public function report_data(){
		$stu_rect = $this->session->userdata('stu_rect_no');
		$adm_no = $this->session->userdata('adm');
		
		$school_details = $this->dbcon->select('school_setting','*');
		$receipt_details = $this->dbcon->select('daycoll','*',"RECT_NO='$stu_rect'");
		$student_details = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
		$feehead1 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='1'");
		$feehead2 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='2'");
		$feehead3 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='3'");
		$feehead4 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='4'");
		$feehead5 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='5'");
		$feehead6 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='6'");
		$feehead7 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='7'");
		$feehead8 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='8'");
		$feehead9 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='9'");
		$feehead10 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='10'");
		$feehead11 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='11'");
		$feehead12 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='12'");
		$feehead13 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='13'");
		$feehead14 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='14'");
		$feehead15 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='15'");
		$feehead16 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='16'");
		$feehead17 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='17'");
		$feehead18 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='18'");
		$feehead19 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='19'");
		$feehead20 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='20'");
		$feehead21 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='21'");
		$feehead22 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='22'");
		$feehead23 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='23'");
		$feehead24 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='24'");
		$feehead25 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='25'");

		 	$report_data = array(
		 		'school_setting' => $school_details,
		 		'receipt_details' =>$receipt_details,
		 		'feehead1' => $feehead1,
				'feehead2' => $feehead2,
				'feehead3' => $feehead3,
				'feehead4' => $feehead4,
				'feehead5' => $feehead5,
				'feehead6' => $feehead6,
				'feehead7' => $feehead7,
				'feehead8' => $feehead8,
				'feehead9' => $feehead9,
				'feehead10' => $feehead10,
				'feehead11' => $feehead11,
				'feehead12' => $feehead12,
				'feehead13' => $feehead13,
				'feehead14' => $feehead14,
				'feehead15' => $feehead15,
				'feehead16' => $feehead16,
				'feehead17' => $feehead17,
				'feehead18' => $feehead18,
				'feehead19' => $feehead19,
				'feehead20' => $feehead20,
				'feehead21' => $feehead21,
				'feehead22' => $feehead22,
				'feehead23' => $feehead23,
				'feehead24' => $feehead24,
				'feehead25' => $feehead25,
				'student_details' => $student_details
		 	);
		
		$this->load->view('parents_dashboard/online_recpt_report',$report_data);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream($stu_rect.".pdf", array("Attachment"=>1));
	}
	
	public function pre_details($stu_id){
		$student_details = $this->dbcon->select('student','ADM_NO',"STUDENTID='$stu_id'");
		$adm_no = $student_details[0]->ADM_NO;
		$User_Id = $this->session->userdata('user_id');
		$master = $this->dbcon->select('master','*',"User_ID='$User_Id' AND Collection_Type='1'");
		$stu_data = $this->dbcon->monthly_collection($adm_no);
		$pre_year_month = $this->dbcon->Previous_year_duesmonth($adm_no);
		$array = array(
			'student_data' => $stu_data,
			'master' => $master,
			'pre_month' => $pre_year_month
		);
		$this->Parent_templete('parents_dashboard/previous_collection/month_collection_data',$array);
	}
	
	public function get_pay_details()
	{
		$adm_no  	= $this->input->post('adm_no');
		$rcpt_no 	= $this->input->post('rcpt_no');
		$ward_type  = $this->input->post('ward_type');
		$bsn		= $this->input->post('bsn');
		$bsa		= $this->input->post('bsa');
		$ffm		= $this->input->post('ffm');
		$month = $this->input->post('month[]');
		//fetching data from the data base//
		$student_data = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
		$session 	  = $this->dbcon->select('session_master','*',"Active_Status='1'");
		$payment_mode = $this->dbcon->select('payment_mode','*');
		$bank		  = $this->dbcon->select('bank_master','*');
		//end of fetching of data/
		$tot = 0;
		$amt_feehead1 = 0;
		$amt_feehead2 = 0;
		$amt_feehead3 = 0;
		$amt_feehead4 = 0;
		$amt_feehead5 = 0;
		$amt_feehead6 = 0;
		$amt_feehead7 = 0;
		$amt_feehead8 = 0;
		$amt_feehead9 = 0;
		$amt_feehead10 = 0;
		$amt_feehead11 = 0;
		$amt_feehead12 = 0;
		$amt_feehead13 = 0;
		$amt_feehead14 = 0;
		$amt_feehead15 = 0;
		$amt_feehead16 = 0;
		$amt_feehead17 = 0;
		$amt_feehead18 = 0;
		$amt_feehead19 = 0;
		$amt_feehead20 = 0;
		$amt_feehead21 = 0;
		$amt_feehead22 = 0;
		$amt_feehead23 = 0;
		$amt_feehead24 = 0;
		$amt_feehead25 = 0;
		$total_amount = 0;
		foreach($month as $key => $month_key){
			$data = $this->dbcon->select('previous_year_feegeneration','Fee1,Fee2,Fee3,Fee4,Fee5,Fee6,Fee7,Fee8,Fee9,Fee10,Fee11,Fee12,Fee13,Fee14,Fee15,Fee16,Fee17,Fee18,Fee19,Fee20,Fee21,Fee22,Fee23,Fee24,Fee25,TOTAL',"ADM_NO='$adm_no' AND Month_NM='$month_key'");
			
			$prev_month = $this->dbcon->select('month_master', 'month_code', "month_name='$month_key'");
			$pre_month = $prev_month[0]->month_code;
			
			$late_fine = $this->farheen->selectSingleData('latefine_master', '*', "ID='1'");
			$l_status = $late_fine->status; //1
			$l_collection_mode = $late_fine->collection_mode; //1
			$l_month_applied = $late_fine->month_applied; //1
			$l_date_applied = $late_fine->date_applied; //28
			$l_late_amount = $late_fine->late_amount; //30 

			
			$current_month = date('m');
			$current_day = date('d');

			
			$date1 = new DateTime("2023-$current_month");
			$date2 = new DateTime("2022-$pre_month");

			$interval = $date1->diff($date2);

			$m = $interval->m;
			if ($current_day < 28) {
				$m = $m - 0;
			}

			if ($stu_aprfee == 'N/A' && $adm_substr == '23') {
				$late_fee = 0;
			} elseif ($l_status == 1) {

				if ($m > 0) {

					$late_fee = $l_late_amount * $m;
				} elseif ($m == 0) {

					if ($l_date_applied <= $sys_date) {
						$late_fee = $l_late_amount;
					} else {
						$late_fee = 0;
					}
				} else {

					$late_fee = 0;
				}

				$h_fee = $h_fee + $late_fee;
			} else {
				$h_fee = 0;
			}
			
			$amt_feehead1 += $data[0]->Fee1;
			$amt_feehead2 += $data[0]->Fee2;
			$amt_feehead3 += $data[0]->Fee3;
			$amt_feehead4 += $data[0]->Fee4;
			$amt_feehead5 += 0;
			$amt_feehead6 += $h_fee;
			$amt_feehead7 += $data[0]->Fee7;
			$amt_feehead8 += $data[0]->Fee8;
			$amt_feehead9 += $data[0]->Fee9;
			$amt_feehead10 += $data[0]->Fee10;
			$amt_feehead11 += $data[0]->Fee11;
			$amt_feehead12 += $data[0]->Fee12;
			$amt_feehead13 += $data[0]->Fee13;
			$amt_feehead14 += $data[0]->Fee14;
			$amt_feehead15 += $data[0]->Fee15;
			$amt_feehead16 += $data[0]->Fee16;
			$amt_feehead17 += $data[0]->Fee17;
			$amt_feehead18 += $data[0]->Fee18;
			$amt_feehead19 += $data[0]->Fee19;
			$amt_feehead20 += $data[0]->Fee20;
			$amt_feehead21 += $data[0]->Fee21;
			$amt_feehead22 += $data[0]->Fee22;
			$amt_feehead23 += $data[0]->Fee23;
			$amt_feehead24 += $data[0]->Fee24;
			$amt_feehead25 += $data[0]->Fee25;
			$tot += $data[0]->TOTAL;
			$total_amount = $tot + $amt_feehead5;
			$total_amount = $tot + $amt_feehead5 + $h_fee;
		}
		for($i=1;$i<=25;$i++)
		{
			$feehead[$i] 	= $this->dbcon->select('feehead','*',"ACT_CODE='$i'");
			$AccG[$i]		= $feehead[$i][0]->AccG;
			$fee_head[$i] 	= $feehead[$i][0]->FEE_HEAD;
		}
		$array = array(
				'adm_no' 	=> $adm_no,
				'feehead1'  => $fee_head[1],
				'feehead2'  => $fee_head[2],
				'feehead3'  => $fee_head[3],
				'feehead4'  => $fee_head[4],
				'feehead5'  => $fee_head[5],
				'feehead6'  => $fee_head[6],
				'feehead7'  => $fee_head[7],
				'feehead8'  => $fee_head[8],
				'feehead9'  => $fee_head[9],
				'feehead10' => $fee_head[10],
				'feehead11' => $fee_head[11],
				'feehead12' => $fee_head[12],
				'feehead13' => $fee_head[13],
				'feehead14' => $fee_head[14],
				'feehead15' => $fee_head[15],
				'feehead16' => $fee_head[16],
				'feehead17' => $fee_head[17],
				'feehead18' => $fee_head[18],
				'feehead19' => $fee_head[19],
				'feehead20' => $fee_head[20],
				'feehead21' => $fee_head[21],
				'feehead22' => $fee_head[22],
				'feehead23' => $fee_head[23],
				'feehead24' => $fee_head[24],
				'feehead25' => $fee_head[25],
				'AccG1'   => $AccG[1],
				'AccG2'   => $AccG[2],
				'AccG3'   => $AccG[3],
				'AccG4'   => $AccG[4],
				'AccG5'   => $AccG[5],
				'AccG6'   => $AccG[6],
				'AccG7'   => $AccG[7],
				'AccG8'   => $AccG[8],
				'AccG9'   => $AccG[9],
				'AccG10'   => $AccG[10],
				'AccG11'   => $AccG[11],
				'AccG12'   => $AccG[12],
				'AccG13'   => $AccG[13],
				'AccG14'   => $AccG[14],
				'AccG15'   => $AccG[15],
				'AccG16'   => $AccG[16],
				'AccG17'   => $AccG[17],
				'AccG18'   => $AccG[18],
				'AccG19'   => $AccG[19],
				'AccG20'   => $AccG[20],
				'AccG21'   => $AccG[21],
				'AccG22'   => $AccG[22],
				'AccG23'   => $AccG[23],
				'AccG24'   => $AccG[24],
				'AccG25'   => $AccG[25],
				'amt_feehead1' => $amt_feehead1,
				'amt_feehead2' => $amt_feehead2,
				'amt_feehead3' => $amt_feehead3,
				'amt_feehead4' => $amt_feehead4,
				'amt_feehead5' => 0,
				'amt_feehead6' => $h_fee,
				'amt_feehead7' => $amt_feehead7,
				'amt_feehead8' => $amt_feehead8,
				'amt_feehead9' => $amt_feehead9,
				'amt_feehead10' => $amt_feehead10,
				'amt_feehead11' => $amt_feehead11,
				'amt_feehead12' => $amt_feehead12,
				'amt_feehead13' => $amt_feehead13,
				'amt_feehead14' => $amt_feehead14,
				'amt_feehead15' => $amt_feehead15,
				'amt_feehead16' => $amt_feehead16,
				'amt_feehead17' => $amt_feehead17,
				'amt_feehead18' => $amt_feehead18,
				'amt_feehead19' => $amt_feehead19,
				'amt_feehead20' => $amt_feehead20,
				'amt_feehead21' => $amt_feehead21,
				'amt_feehead22' => $amt_feehead22,
				'amt_feehead23' => $amt_feehead23,
				'amt_feehead24' => $amt_feehead24,
				'amt_feehead25' => $amt_feehead25,
				'total_amount'  => $total_amount,
				'payment_mode'  => $payment_mode,
				'bank'			=> $bank,
				'rcpt_no'		=> $rcpt_no,
				'student_data'	=> $student_data,
				'ward_type'     => $ward_type,
				'bsn'           => $bsn,
				'bsa'			=> $bsa,
				'ffm'			=> $ffm,
				'month'         => $month
			);
		$this->session->set_userdata('total_amountt',$total_amount);
			$this->load->view('parents_dashboard/previous_collection/feehaead_calculation_monthwise',$array);
	}
	
	public function respon()
	{
		
	error_reporting(0);
	
	$workingKey='7F0876900816421A9BAC221F7FACE121';		//Working Key should be provided here.
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
		
		
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.

    $order_id="";
	$tracking_id="";
	$bank_ref_no="";
	$order_status="";
	$failure_message="";
	$payment_mode="";
	$card_name="";
	$status_code="";
	$status_message="";
	$amount="";
		
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
		//echo "<pre>";
		//print_r($decryptValues);
		//die;
	echo "<center>";

	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==0) $order_id=$information[1];
		if($i==1) $tracking_id=$information[1];
		if($i==2)	$bank_ref_no=$information[1];
		if($i==3)	$order_status=$information[1];
		if($i==4)	$failure_message=$information[1];
		if($i==5)	$payment_mode=$information[1];
		if($i==6)	$card_name=$information[1];
		//if($i==7)	//$status_code=$information[1];
		if($i==8)	$status_message=$information[1];
		if($i==10)	$amount=$information[1];
		if($i==11)	$billing_name=$information[1];
		
	}
		
		$online_trans = $this->db->query("select * from online_transaction where order_id='$order_id'")->result();
		$admm = $online_trans[0]->ADM_NO;
        $stuu_name = $online_trans[0]->STU_NAME; 		
        $on_orderid = $online_trans[0]->order_id;
		$on_amt = $online_trans[0]->pay_amount;
		$on_period = $online_trans[0]->PERIOD;
		$str_arr = explode ("-", $on_period);
		$trans_month = implode("",$str_arr);
		$stuu_dett = $this->db->query("select C_MOBILE from student where ADM_NO='$admm'")->result();
		$mobile = $stuu_dett[0]->C_MOBILE;
		//$order_id = $this->session->userdata('tid');
		//$track_id =  $this->session->userdata('track_id');
		$school_setting = $this->dbcon->select('school_setting','*');
		$school_logo = $school_setting[0]->SCHOOL_LOGO;
		$school_name = $school_setting[0]->School_Name;
		$school_add = $school_setting[0]->School_Address;
		$school_phone = $school_setting[0]->School_PhoneNo;
		$school_aff = $school_setting[0]->School_AfftNo;
		$school_web = $school_setting[0]->School_Webaddress;
		$school_email = $school_setting[0]->School_Email;
		$recpt_val = $this->db->query("select max(RECT_NO) as rec_no from daycoll where Mid(RECT_NO,1,2)='ON'")->result();
		$rcpt_cnt =  count($recpt_val);
		if($rcpt_cnt == 0)
		{
		    $rcpt = 'ON00000';
		}
		else{
		     $rcpt = $recpt_val[0]->rec_no;
         }
		
		$data = explode('ON',$rcpt);
        @$number = $data[1];
		$number++;
        $rcpt_dig = str_pad($number, 5, "0", STR_PAD_LEFT);
		 $rcpt_no = 'ON'.$rcpt_dig;
		
		$this->session->set_userdata('sessionRecepitData',$rcpt_no);
		 $ses = $this->session->userdata('sessionRecepitData');
	
		$upt_data = array(
			
			'tracking_id' => $tracking_id,
			'bank_ref_no' => $bank_ref_no,
			'order_status' => $order_status,
			'failure_msg' => $failure_msg,
			'pay_mode' => $payment_mode,
			'card_name' => $card_name,
			//'status_code' => $status_code,
			'status_msg' => $status_msg,
			'rcv_amt' => $amount,
			'payment_status' =>  'response_rcpt'
		);
		
		$this->dbcon->update('online_transaction',$upt_data,"order_id='$order_id'");
		//$rec_no = $online_trans[0]->RECT_NO;
		$pre_fee = $this->db->query("select * from previous_year_feegeneration where ADM_NO='$admm'")->result();
		$pre_due = count($pre_fee);
		$today_date = date('Y-m-d H:i:s');
		//echo "if(($on_orderid == $order_id) AND ($on_amt == $amount)  AND ($order_status == 'Success') AND ($billing_name == $trans_month))";
		//die;
		if(($on_orderid == $order_id) AND ($on_amt == $amount)  AND ($order_status == 'Success') AND ($billing_name == $trans_month))
		{   
	        if($pre_due > 0)
			{
			 $dycl_chk = $this->db->query("select * from daycoll where CHQ_NO='$order_id'")->result();
			 $dychk_cnt = count($dycl_chk);
			 if($dychk_cnt == 0)
		     {	
			$month = $online_trans[0]->PERIOD;
		    $mon = explode("-",$month);
			$mn_cnt = count($mon);
			
			foreach($mon as $key => $val){
			  if($val == 'JUN'){
				  $val = 'JUNE';
				}
			  if($val == 'JUL'){
				  $val = 'JULY';
				}
		
		      $dayycol = $this->db->query("select * from daycoll where RECT_NO='$ses'")->result();
				$dy_cnt = count($dayycol);
				if($dy_cnt == 0)
				{
					$daycall = array(
			'RECT_NO'  => $ses,
			'RECT_DATE' => $online_trans[0]->trans_date,
			'STU_NAME' => $online_trans[0]->STU_NAME,
			'STUDENTID' => $online_trans[0]->STUDENTID,
			'ADM_NO' => $online_trans[0]->ADM_NO,
			'CLASS' => $online_trans[0]->CLASS,
			'SEC' => $online_trans[0]->SEC,
			'ROLL_NO' => $online_trans[0]->ROLL_NO,
			'PERIOD' => 'PRE'.$online_trans[0]->PERIOD,
			'TOTAL' => $online_trans[0]->TOTAL,
			'fee1' => '0',
			'fee2' => '0',
			'fee3' => '0',
			'fee4' =>'0',
			'fee5' => '0',
			'fee6' => '0',
			'fee7' => '0',
			'fee8' => '0',
			'fee9' => '0',
			'fee10' =>'0',
			'fee11' => $online_trans[0]->TOTAL,
			'fee12' =>'0',
			'fee13' => '0',
			'fee14' => '0',
			'fee15' => '0',
			'fee16' => '0',
			'fee17' => '0',
			'fee18' => '0',
			'fee19' => '0',
			'fee20' => '0',
			'fee21' => '0',
			'fee22' => '0',
			'fee23' => '0',
			'fee24' => '0',
			'fee25' => '0',
			 $val.'_FEE' => $ses,
            'Collection_Mode' => 3,
			'Payment_Mode' => 'ONLINE',
			'Bank_Name' => 'CC Avenue',
            'User_Id'         => $User_Id,
             'CHQ_NO' => $order_id,
             'Narr' => 'N/A',
             'TAmt' => 0,
             'Fee_Book_No' => 0,
						'GROSS_AMOUNT' => $online_trans[0]->TOTAL,
								'PAID_AMOUNT' => $online_trans[0]->TOTAL,
								'SHORT_AMOUNT' => 0,
								'RECOVERED_SHORT_AMT' => 0,
			);
					
		      $this->dbcon->insert('daycoll',$daycall);
				}
				else{
			 $upd_dyy = array(
				
				$val.'_FEE' => $ses,
				
			);
				
			$this->dbcon->update('daycoll',$upd_dyy,"RECT_NO='$ses'");
				}
				
				
				
				$precol = $this->db->query("select * from previous_year_collection where RECT_NO='$ses'")->result();
				$pre_cnt = count($precol);
				
				if($pre_cnt == 0)
				{
					$pree_yr = array(
			'RECT_NO'  => $ses,
			'RECT_DATE' => $online_trans[0]->trans_date,
			'STU_NAME' => $online_trans[0]->STU_NAME,
			'STUDENTID' => $online_trans[0]->STUDENTID,
			'ADM_NO' => $online_trans[0]->ADM_NO,
			'CLASS' => $online_trans[0]->CLASS,
			'SEC' => $online_trans[0]->SEC,
			'ROLL_NO' => $online_trans[0]->ROLL_NO,
			'PERIOD' => 'PRE'.$online_trans[0]->PERIOD,
			'TOTAL' => $online_trans[0]->TOTAL,
			'fee1' => $online_trans[0]->Fee1,
			'fee2' => $online_trans[0]->Fee2,
			'fee3' => $online_trans[0]->Fee3,
			'fee4' => $online_trans[0]->Fee4,
			'fee5' => $online_trans[0]->Fee5,
			'fee6' => $online_trans[0]->Fee6,
			'fee7' => $online_trans[0]->Fee7,
			'fee8' => $online_trans[0]->Fee8,
			'fee9' => $online_trans[0]->Fee9,
			'fee10' => $online_trans[0]->Fee10,
			'fee11' => $online_trans[0]->Fee11,
			'fee12' => $online_trans[0]->Fee12,
			'fee13' => $online_trans[0]->Fee13,
			'fee14' => $online_trans[0]->Fee14,
			'fee15' => $online_trans[0]->Fee15,
			'fee16' => $online_trans[0]->Fee16,
			'fee17' => $online_trans[0]->Fee17,
			'fee18' => $online_trans[0]->Fee18,
			'fee19' => $online_trans[0]->Fee19,
			'fee20' => $online_trans[0]->Fee20,
			'fee21' => $online_trans[0]->Fee21,
			'fee22' => $online_trans[0]->Fee22,
			'fee23' => $online_trans[0]->Fee23,
			'fee24' => $online_trans[0]->Fee24,
			'fee25' => $online_trans[0]->Fee25,
			 $val.'_FEE' => $ses,
            'Collection_Mode' => 3,
			'Payment_Mode' => 'ONLINE',
			'Bank_Name' => 'CC Avenue',
            'User_Id'         => $User_Id,
             'CHQ_NO' => $order_id,
             'Narr' => 'N/A',
             'TAmt' => 0,
             'Fee_Book_No' => 0,
						
			);
		  $this->dbcon->insert('previous_year_collection',$pree_yr);
				}
				else{
			 $upd_pre = array(
				
				$val.'_FEE' => $ses,
				
			);
				
			$this->dbcon->update('previous_year_collection',$upd_pre,"RECT_NO='$ses'");
				}
			  
			$online_trans = array(
				'Pay_Date' => $today_date,
				'RECT_DATE'  => $today_date,
				'RECT_NO'  => $ses,
				$val.'_FEE' => $ses,
				
			);
				
			$this->dbcon->update('online_transaction',$online_trans,"order_id='$order_id'");
				
				$upd_stu = array(
				
				$val.'_FEE' => $ses,
				
			);
				
			}
			
			for($i=0;$i<$mn_cnt;$i++){
					$this->dbcon->del_pre_fee_generation($mon[$i],$admm);
				}
				
				//$message = "Dear Parents,\r\nYou have paid the fees for the month of 'PRE'.$on_period , amount $on_amt for $stuu_name .\r\n ACHARYAKULAM";
				//$this->sms_lib->sendSMS($mobile,$message);
				}
		   else
		   {
			   echo "<h2 style='text-align:center;color:red;'>Thank you for making a payment !!!!!</h2>";
    
			   die();
		   }
			}
			else
			{
			$dycl_chk = $this->db->query("select * from daycoll where CHQ_NO='$order_id'")->result();
			 $dychk_cnt = count($dycl_chk);
			 if($dychk_cnt == 0)
			{	
			$month = $online_trans[0]->PERIOD;
		    $mon = explode("-",$month);
			
			foreach($mon as $key => $val){
			  if($val == 'JUN'){
				  $val = 'JUNE';
				}
			  if($val == 'JUL'){
				  $val = 'JULY';
				}
		
		   $daycall = array(
			'RECT_NO'  => $ses,
			'RECT_DATE' => $online_trans[0]->trans_date,
			'STU_NAME' => $online_trans[0]->STU_NAME,
			'STUDENTID' => $online_trans[0]->STUDENTID,
			'ADM_NO' => $online_trans[0]->ADM_NO,
			'CLASS' => $online_trans[0]->CLASS,
			'SEC' => $online_trans[0]->SEC,
			'ROLL_NO' => $online_trans[0]->ROLL_NO,
			'PERIOD' => $online_trans[0]->PERIOD,
			'TOTAL' => $online_trans[0]->TOTAL,
			'fee1' => $online_trans[0]->Fee1,
			'fee2' => $online_trans[0]->Fee2,
			'fee3' => $online_trans[0]->Fee3,
			'fee4' => $online_trans[0]->Fee4,
			'fee5' => $online_trans[0]->Fee5,
			'fee6' => $online_trans[0]->Fee6,
			'fee7' => $online_trans[0]->Fee7,
			'fee8' => $online_trans[0]->Fee8,
			'fee9' => $online_trans[0]->Fee9,
			'fee10' => $online_trans[0]->Fee10,
			'fee11' => $online_trans[0]->Fee11,
			'fee12' => $online_trans[0]->Fee12,
			'fee13' => $online_trans[0]->Fee13,
			'fee14' => $online_trans[0]->Fee14,
			'fee15' => $online_trans[0]->Fee15,
			'fee16' => $online_trans[0]->Fee16,
			'fee17' => $online_trans[0]->Fee17,
			'fee18' => $online_trans[0]->Fee18,
			'fee19' => $online_trans[0]->Fee19,
			'fee20' => $online_trans[0]->Fee20,
			'fee21' => $online_trans[0]->Fee21,
			'fee22' => $online_trans[0]->Fee22,
			'fee23' => $online_trans[0]->Fee23,
			'fee24' => $online_trans[0]->Fee24,
			'fee25' => $online_trans[0]->Fee25,
			 $val.'_FEE' => $ses,
            'Collection_Mode' => 3,
			'Payment_Mode' => 'ONLINE',
			'Bank_Name' => 'CC Avenue',
            'User_Id'         => $User_Id,
             'CHQ_NO' => $order_id,
             'Narr' => 'N/A',
             'TAmt' => 0,
			   'GROSS_AMOUNT' => $online_trans[0]->TOTAL,
								'PAID_AMOUNT' => $online_trans[0]->TOTAL,
								'SHORT_AMOUNT' => 0,
								'RECOVERED_SHORT_AMT' => 0,
             'Fee_Book_No' => 0,
			);
			
		  $dayycol = $this->db->query("select * from daycoll where RECT_NO='$ses'")->result();
				$dy_cnt = count($dayycol);
				if($dy_cnt == 0)
				{
		  $this->dbcon->insert('daycoll',$daycall);
				}
				else{
			 $upd_dyy = array(
				
				$val.'_FEE' => $ses,
				
			);
				
			$this->dbcon->update('daycoll',$upd_dyy,"RECT_NO='$ses'");
				}
			$online_trans = array(
				'Pay_Date' => $today_date,
				'RECT_DATE'  => $today_date,
				'RECT_NO'  => $ses,
				$val.'_FEE' => $ses,
				
			);
				
			$this->dbcon->update('online_transaction',$online_trans,"order_id='$order_id'");
				
				$upd_stu = array(
				
				$val.'_FEE' => $ses,
				
			);
				
			$this->dbcon->update('student',$upd_stu,"ADM_NO='$admm'");
				
			}
		//	$message = "Dear Parents,\r\nYou have paid the fees for the month of $on_period , amount $on_amt for $stuu_name .\r\n ACHARYAKULAM";
			//$this->sms_lib->sendSMS($mobile,$message);
			}
           else{
			   
			   echo "<h2 style='text-align:center;color:red;'>Thank you for making a payment !!!!!</h2>";
    
			   die();
		   }		
			}
				
			}
		else{
		
				$uptt_data = array(
			
			'tracking_id' => $tracking_id,
			'bank_ref_no' => $bank_ref_no,
			'order_status' => $order_status,
			'failure_msg' => $failure_msg,
			'pay_mode' => 'ONLINE',
			'card_name' => $card_name,
			'status_code' => $auth_code,
			'status_msg' => $status_msg,
			//'rcv_amt' => $amount,
			'payment_status' =>  'response_rcpt',
		     //'RECT_DATE'  => $today_date,
		     //'RECT_NO'  => $rcpt_no,
		);
		
			$this->dbcon->update('online_transaction',$uptt_data,"order_id='$order_id'");
		}
		        $this->session->unset_userdata('total_amountt');
                $this->session->unset_userdata('ffms');
		        //$this->session->sess_destroy();
		$array =     array('school_logo'=>$school_logo,'school_name'=>$school_name,'school_add'=>$school_add,'school_phone'=>$school_phone,'school_aff'=>$school_aff,'school_web'=>$school_web,'school_email'=>$school_email,'orderr_id'=>$orderr_id,'pay_amt'=>$pay_amt,'order_status'=>$order_status,'adm_no'=>$admm,'rect_no'=>$ses);
		
	  $this->load->view('parents_dashboard/response',$array);
	}
}
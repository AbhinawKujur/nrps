<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Defaulter_headwise_list extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$this->load->model('Mymodel', 'dbcon');
		 $this->load->model('Farheen','farheen');
	}
	public function defaulter_classwise()
	{
		ini_set('memory_limit','-1');
		$viewupto = $this->input->post('viewupto');
		$classs = $this->input->post('classs');
		$sec = $this->input->post('sec');
		$text = $this->input->post('text');

		$result = array('data' => array());
		$feehead = $this->dbcon->select('feehead', 'SHNAME');
		$result['feehead'] = $feehead;
		$result['text'] = $text;
		$student = $this->dbcon->select('student', 'ADM_NO,FIRST_NM,ROLL_NO,APR_FEE,MAY_FEE,JUNE_FEE,JULY_FEE,AUG_FEE,SEP_FEE,OCT_FEE,NOV_FEE,DEC_FEE,JAN_FEE,FEB_FEE,MAR_FEE,DISP_CLASS,DISP_SEC', "Student_Status='ACTIVE' AND CLASS='$classs' AND SEC='$sec'");
		// echo "<pre>";print_r($student);die;
		$session_master = $this->dbcon->select('session_master', '*', "Active_Status='1'");
		$year = $session_master[0]->Session_Year;
		$sess_year = $year . '-' . '04' . '-' . '01';
		if ($viewupto == 'APR') {
			$sess_year_end = $year . '-' . '04' . '-' . '31';
			$monthin = array('APR');
			$loop_cnt = 1;
		} elseif ($viewupto == 'MAY') {
			$sess_year_end = $year . '-' . '05' . '-' . '31';
			$monthin = array('APR', 'MAY');
			$loop_cnt = 2;
		} elseif ($viewupto == 'JUN') {
			$sess_year_end = $year . '-' . '06' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN');
			$loop_cnt = 3;
		} elseif ($viewupto == 'JUL') {
			$sess_year_end = $year . '-' . '07' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL');
			$loop_cnt = 4;
		} elseif ($viewupto == 'AUG') {
			$sess_year_end = $year . '-' . '08' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG');
			$loop_cnt = 5;
		} elseif ($viewupto == 'SEP') {
			$sess_year_end = $year . '-' . '09' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP');
			$loop_cnt = 6;
		} elseif ($viewupto == 'OCT') {
			$sess_year_end = $year . '-' . '10' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT');
			$loop_cnt = 7;
		} elseif ($viewupto == 'NOV') {
			$sess_year_end = $year . '-' . '11' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV');
			$loop_cnt = 8;
		} elseif ($viewupto == 'DEC') {
			$sess_year_end = $year . '-' . '12' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC');
			$loop_cnt = 9;
		} elseif ($viewupto == 'JAN') {
			$year += 1;
			$sess_year_end = $year . '-' . '01' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN');
			$loop_cnt = 10;
		} elseif ($viewupto == 'FEB') {
			$year += 1;
			$sess_year_end = $year . '-' . '02' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN', 'FEB');
			$loop_cnt = 11;
		} elseif ($viewupto == 'MAR') {
			$year += 1;
			$sess_year_end = $year . '-' . '03' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN', 'FEB', 'MAR');
			$loop_cnt = 12;
		} else {
		}
		$student_cnt = count($student);
		$c = 1;
		for ($i = 0; $i < $student_cnt; $i++) {
			$adm_no = $student[$i]->ADM_NO;
			$class_sec = $student[$i]->DISP_CLASS . "-" . $student[$i]->DISP_SEC;
			// startn chekcking the month fee from the student table of perticular student //
			$MON_FEE[0] = $student[$i]->APR_FEE;
			$MON_FEE[1] = $student[$i]->MAY_FEE;
			$MON_FEE[2] = $student[$i]->JUNE_FEE;
			$MON_FEE[3] = $student[$i]->JULY_FEE;
			$MON_FEE[4] = $student[$i]->AUG_FEE;
			$MON_FEE[5] = $student[$i]->SEP_FEE;
			$MON_FEE[6] = $student[$i]->OCT_FEE;
			$MON_FEE[7] = $student[$i]->NOV_FEE;
			$MON_FEE[8] = $student[$i]->DEC_FEE;
			$MON_FEE[9] = $student[$i]->JAN_FEE;
			$MON_FEE[10] = $student[$i]->FEB_FEE;
			$MON_FEE[11] = $student[$i]->MAR_FEE;
			//checking end recpt_no from student no //
			$month_print = '';
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

			$total_amt_fee1 = 0;
			$total_amt_fee2 = 0;
			$total_amt_fee3 = 0;
			$total_amt_fee4 = 0;
			$total_amt_fee5 = 0;
			$total_amt_fee6 = 0;
			$total_amt_fee7 = 0;
			$total_amt_fee8 = 0;
			$total_amt_fee9 = 0;
			$total_amt_fee10 = 0;
			$total_amt_fee11 = 0;
			$total_amt_fee12 = 0;
			$total_amt_fee13 = 0;
			$total_amt_fee14 = 0;
			$total_amt_fee15 = 0;
			$total_amt_fee16 = 0;
			$total_amt_fee17 = 0;
			$total_amt_fee18 = 0;
			$total_amt_fee19 = 0;
			$total_amt_fee20 = 0;
			$total_amt_fee21 = 0;
			$total_amt_fee22 = 0;
			$total_amt_fee23 = 0;
			$total_amt_fee24 = 0;
			$total_amt_fee25 = 0;

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
			$pre_data = $this->dbcon->select('previous_year_feegeneration', 'SUM(TOTAL)TOTAL', "ADM_NO='$adm_no'");
			if (!empty($pre_data)) {
				$pre_data1 = $pre_data[0]->TOTAL;
			} else {
				$pre_data1 = 0;
			}
			$daycolll = $this->dbcon->select('daycoll', 'sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25', "ADM_NO='$adm_no'");
			if (!empty($daycolll)) {
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
			} else {
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
			$temp_daycoll = $this->dbcon->select('temp_daycoll', 'sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25', "ADM_NO='adm_no' AND SEC='Z'");
			if (!empty($temp_daycoll)) {
				$fee1_temp_daycoll = $fee1_daycolll + $temp_daycoll[0]->Fee1;
				$fee2_temp_daycoll = $fee2_daycolll + $temp_daycoll[0]->Fee2;
				$fee3_temp_daycoll = $fee3_daycolll + $temp_daycoll[0]->Fee3;
				$fee4_temp_daycoll = $fee4_daycolll + $temp_daycoll[0]->Fee4;
				$fee5_temp_daycoll = $fee5_daycolll + $temp_daycoll[0]->Fee5;
				$fee6_temp_daycoll = $fee6_daycolll + $temp_daycoll[0]->Fee6;
				$fee7_temp_daycoll = $fee7_daycolll + $temp_daycoll[0]->Fee7;
				$fee8_temp_daycoll = $fee8_daycolll + $temp_daycoll[0]->Fee8;
				$fee9_temp_daycoll = $fee9_daycolll + $temp_daycoll[0]->Fee9;
				$fee10_temp_daycoll = $fee10_daycolll + $temp_daycoll[0]->Fee10;
				$fee11_temp_daycoll = $fee11_daycolll + $temp_daycoll[0]->Fee11;
				$fee12_temp_daycoll = $fee12_daycolll + $temp_daycoll[0]->Fee12;
				$fee13_temp_daycoll = $fee13_daycolll + $temp_daycoll[0]->Fee13;
				$fee14_temp_daycoll = $fee14_daycolll + $temp_daycoll[0]->Fee14;
				$fee15_temp_daycoll = $fee15_daycolll + $temp_daycoll[0]->Fee15;
				$fee16_temp_daycoll = $fee16_daycolll + $temp_daycoll[0]->Fee16;
				$fee17_temp_daycoll = $fee17_daycolll + $temp_daycoll[0]->Fee17;
				$fee18_temp_daycoll = $fee18_daycolll + $temp_daycoll[0]->Fee18;
				$fee19_temp_daycoll = $fee19_daycolll + $temp_daycoll[0]->Fee19;
				$fee20_temp_daycoll = $fee20_daycolll + $temp_daycoll[0]->Fee20;
				$fee21_temp_daycoll = $fee21_daycolll + $temp_daycoll[0]->Fee21;
				$fee22_temp_daycoll = $fee22_daycolll + $temp_daycoll[0]->Fee22;
				$fee23_temp_daycoll = $fee23_daycolll + $temp_daycoll[0]->Fee23;
				$fee24_temp_daycoll = $fee24_daycolll + $temp_daycoll[0]->Fee24;
				$fee25_temp_daycoll = $fee25_daycolll + $temp_daycoll[0]->Fee25;
			} else {
				$fee1_temp_daycoll = $fee1_daycolll + 0;
				$fee2_temp_daycoll = $fee2_daycolll + 0;
				$fee3_temp_daycoll = $fee3_daycolll + 0;
				$fee4_temp_daycoll = $fee4_daycolll + 0;
				$fee5_temp_daycoll = $fee5_daycolll + 0;
				$fee6_temp_daycoll = $fee6_daycolll + 0;
				$fee7_temp_daycoll = $fee7_daycolll + 0;
				$fee8_temp_daycoll = $fee8_daycolll + 0;
				$fee9_temp_daycoll = $fee9_daycolll + 0;
				$fee10_temp_daycoll = $fee10_daycolll + 0;
				$fee11_temp_daycoll = $fee11_daycolll + 0;
				$fee12_temp_daycoll = $fee12_daycolll + 0;
				$fee13_temp_daycoll = $fee13_daycolll + 0;
				$fee14_temp_daycoll = $fee14_daycolll + 0;
				$fee15_temp_daycoll = $fee15_daycolll + 0;
				$fee16_temp_daycoll = $fee16_daycolll + 0;
				$fee17_temp_daycoll = $fee17_daycolll + 0;
				$fee18_temp_daycoll = $fee18_daycolll + 0;
				$fee19_temp_daycoll = $fee19_daycolll + 0;
				$fee20_temp_daycoll = $fee20_daycolll + 0;
				$fee21_temp_daycoll = $fee21_daycolll + 0;
				$fee22_temp_daycoll = $fee22_daycolll + 0;
				$fee23_temp_daycoll = $fee23_daycolll + 0;
				$fee24_temp_daycoll = $fee24_daycolll + 0;
				$fee25_temp_daycoll = $fee25_daycolll + 0;
				$temp_daycoll_amount = 0;
			}
			// end of fetching data from the table //
			for ($l = 0; $l < $loop_cnt; $l++) {
				if ($MON_FEE[$l] != 'N/A' and $MON_FEE[$l] != '') {
				} else {
					$month_print .= $monthin[$l] . ',';
					$unpaid_month = $this->dbcon->select('feegeneration', 'sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25', "ADM_NO='$adm_no' AND Month_NM='$monthin[$l]'");
					if (!empty($unpaid_month)) {
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
				if ($MON_FEE[$l] == 'FREESHIP') {
				} else {
					$feegeneration = $this->dbcon->select('feegeneration', 'sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25', "ADM_NO='$adm_no' AND Month_NM='$monthin[$l]'");
					if (!empty($feegeneration)) {
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
			$fee1_paid_month = ($fee1_feegeneration - $fee1_unpaid_month);
			$fee2_paid_month = ($fee2_feegeneration - $fee2_unpaid_month);
			$fee3_paid_month = ($fee3_feegeneration - $fee3_unpaid_month);
			$fee4_paid_month = ($fee4_feegeneration - $fee4_unpaid_month);
			$fee5_paid_month = ($fee5_feegeneration - $fee5_unpaid_month);
			$fee6_paid_month = ($fee6_feegeneration - $fee6_unpaid_month);
			$fee7_paid_month = ($fee7_feegeneration - $fee7_unpaid_month);
			$fee8_paid_month = ($fee8_feegeneration - $fee8_unpaid_month);
			$fee9_paid_month = ($fee9_feegeneration - $fee9_unpaid_month);
			$fee10_paid_month = ($fee10_feegeneration - $fee10_unpaid_month);
			$fee11_paid_month = ($fee11_feegeneration - $fee11_unpaid_month);
			$fee12_paid_month = ($fee12_feegeneration - $fee12_unpaid_month);
			$fee13_paid_month = ($fee13_feegeneration - $fee13_unpaid_month);
			$fee14_paid_month = ($fee14_feegeneration - $fee14_unpaid_month);
			$fee15_paid_month = ($fee15_feegeneration - $fee15_unpaid_month);
			$fee16_paid_month = ($fee16_feegeneration - $fee16_unpaid_month);
			$fee17_paid_month = ($fee17_feegeneration - $fee17_unpaid_month);
			$fee18_paid_month = ($fee18_feegeneration - $fee18_unpaid_month);
			$fee19_paid_month = ($fee19_feegeneration - $fee19_unpaid_month);
			$fee20_paid_month = ($fee20_feegeneration - $fee20_unpaid_month);
			$fee21_paid_month = ($fee21_feegeneration - $fee21_unpaid_month);
			$fee22_paid_month = ($fee22_feegeneration - $fee22_unpaid_month);
			$fee23_paid_month = ($fee23_feegeneration - $fee23_unpaid_month);
			$fee24_paid_month = ($fee24_feegeneration - $fee24_unpaid_month);
			$fee25_paid_month = ($fee25_feegeneration - $fee25_unpaid_month);

			$total_amt_fee1 = ($fee1_feegeneration - $fee1_temp_daycoll);
			$total_amt_fee2 = ($fee2_feegeneration - $fee2_temp_daycoll);
			$total_amt_fee3 = ($fee3_feegeneration - $fee3_temp_daycoll);
			$total_amt_fee4 = ($fee4_feegeneration - $fee4_temp_daycoll);
			$total_amt_fee5 = ($fee5_feegeneration - $fee5_temp_daycoll);
			$total_amt_fee6 = ($fee6_feegeneration - $fee6_temp_daycoll);
			$total_amt_fee7 = ($fee7_feegeneration - $fee7_temp_daycoll);
			$total_amt_fee8 = ($fee8_feegeneration - $fee8_temp_daycoll);
			$total_amt_fee9 = ($fee9_feegeneration - $fee9_temp_daycoll);
			$total_amt_fee10 = ($fee10_feegeneration - $fee10_temp_daycoll);
			$total_amt_fee11 = ($fee11_feegeneration - $fee11_temp_daycoll);
			$total_amt_fee12 = ($fee12_feegeneration - $fee12_temp_daycoll);
			$total_amt_fee13 = ($fee13_feegeneration - $fee13_temp_daycoll);
			$total_amt_fee14 = ($fee14_feegeneration - $fee14_temp_daycoll);
			$total_amt_fee15 = ($fee15_feegeneration - $fee15_temp_daycoll);
			$total_amt_fee16 = ($fee16_feegeneration - $fee16_temp_daycoll);
			$total_amt_fee17 = ($fee17_feegeneration - $fee17_temp_daycoll);
			$total_amt_fee18 = ($fee18_feegeneration - $fee18_temp_daycoll);
			$total_amt_fee19 = ($fee19_feegeneration - $fee19_temp_daycoll);
			$total_amt_fee20 = ($fee20_feegeneration - $fee20_temp_daycoll);
			$total_amt_fee21 = ($fee21_feegeneration - $fee21_temp_daycoll);
			$total_amt_fee22 = ($fee22_feegeneration - $fee22_temp_daycoll);
			$total_amt_fee23 = ($fee23_feegeneration - $fee23_temp_daycoll);
			$total_amt_fee24 = ($fee24_feegeneration - $fee24_temp_daycoll);
			$total_amt_fee25 = ($fee25_feegeneration - $fee25_temp_daycoll);

			$parcial_fee1 = ($fee1_paid_month - $fee1_temp_daycoll);
			$parcial_fee2 = ($fee2_paid_month - $fee2_temp_daycoll);
			$parcial_fee3 = ($fee3_paid_month - $fee3_temp_daycoll);
			$parcial_fee4 = ($fee4_paid_month - $fee4_temp_daycoll);
			$parcial_fee5 = ($fee5_paid_month - $fee5_temp_daycoll);
			$parcial_fee6 = ($fee6_paid_month - $fee6_temp_daycoll);
			$parcial_fee7 = ($fee7_paid_month - $fee7_temp_daycoll);
			$parcial_fee8 = ($fee8_paid_month - $fee8_temp_daycoll);
			$parcial_fee9 = ($fee9_paid_month - $fee9_temp_daycoll);
			$parcial_fee10 = ($fee10_paid_month - $fee10_temp_daycoll);
			$parcial_fee11 = ($fee11_paid_month - $fee11_temp_daycoll);
			$parcial_fee12 = ($fee12_paid_month - $fee12_temp_daycoll);
			$parcial_fee13 = ($fee13_paid_month - $fee13_temp_daycoll);
			$parcial_fee14 = ($fee14_paid_month - $fee14_temp_daycoll);
			$parcial_fee15 = ($fee15_paid_month - $fee15_temp_daycoll);
			$parcial_fee16 = ($fee16_paid_month - $fee16_temp_daycoll);
			$parcial_fee17 = ($fee17_paid_month - $fee17_temp_daycoll);
			$parcial_fee18 = ($fee18_paid_month - $fee18_temp_daycoll);
			$parcial_fee19 = ($fee19_paid_month - $fee19_temp_daycoll);
			$parcial_fee20 = ($fee20_paid_month - $fee20_temp_daycoll);
			$parcial_fee21 = ($fee21_paid_month - $fee21_temp_daycoll);
			$parcial_fee22 = ($fee22_paid_month - $fee22_temp_daycoll);
			$parcial_fee23 = ($fee23_paid_month - $fee23_temp_daycoll);
			$parcial_fee24 = ($fee24_paid_month - $fee24_temp_daycoll);
			$parcial_fee25 = ($fee25_paid_month - $fee25_temp_daycoll);

			if ($parcial_fee1 > 0) {
				$parcial_dues_total += $parcial_fee1;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee2 > 0) {
				$parcial_dues_total += $parcial_fee2;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee3 > 0) {
				$parcial_dues_total += $parcial_fee3;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee4 > 0) {
				$parcial_dues_total += $parcial_fee4;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee5 > 0) {
				$parcial_dues_total += $parcial_fee5;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee6 > 0) {
				$parcial_dues_total += $parcial_fee6;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee7 > 0) {
				$parcial_dues_total += $parcial_fee7;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee8 > 0) {
				$parcial_dues_total += $parcial_fee8;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee9 > 0) {
				$parcial_dues_total += $parcial_fee9;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee10 > 0) {
				$parcial_dues_total += $parcial_fee10;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee11 > 0) {
				$parcial_dues_total += $parcial_fee11;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee12 > 0) {
				$parcial_dues_total += $parcial_fee12;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee13 > 0) {
				$parcial_dues_total += $parcial_fee13;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee14 > 0) {
				$parcial_dues_total += $parcial_fee14;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee15 > 0) {
				$parcial_dues_total += $parcial_fee15;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee16 > 0) {
				$parcial_dues_total += $parcial_fee16;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee17 > 0) {
				$parcial_dues_total += $parcial_fee17;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee18 > 0) {
				$parcial_dues_total += $parcial_fee18;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee19 > 0) {
				$parcial_dues_total += $parcial_fee19;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee20 > 0) {
				$parcial_dues_total += $parcial_fee20;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee21 > 0) {
				$parcial_dues_total += $parcial_fee21;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee22 > 0) {
				$parcial_dues_total += $parcial_fee22;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee23 > 0) {
				$parcial_dues_total += $parcial_fee23;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee24 > 0) {
				$parcial_dues_total += $parcial_fee24;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee25 > 0) {
				$parcial_dues_total += $parcial_fee25;
			} else {
				$parcial_dues_total += 0;
			}

			if ($total_amt_fee1 > 0) {
				$current_year += $total_amt_fee1;
				$fee_headwise1 = $total_amt_fee1;
			} else {
				$current_year += 0;
				$fee_headwise1 = 0;
			}
			if ($total_amt_fee2 > 0) {
				$current_year += $total_amt_fee2;
				$fee_headwise2 = $total_amt_fee2;
			} else {
				$current_year += 0;
				$fee_headwise2 = 0;
			}
			if ($total_amt_fee3 > 0) {
				$current_year += $total_amt_fee3;
				$fee_headwise3 = $total_amt_fee3;
			} else {
				$current_year += 0;
				$fee_headwise3 = 0;
			}
			if ($total_amt_fee4 > 0) {
				$current_year += $total_amt_fee4;
				$fee_headwise4 = $total_amt_fee4;
			} else {
				$current_year += 0;
				$fee_headwise4 = 0;
			}
			if ($total_amt_fee5 > 0) {
				$current_year += $total_amt_fee5;
				$fee_headwise5 = $total_amt_fee5;
			} else {
				$current_year += 0;
				$fee_headwise5 = 0;
			}
			if ($total_amt_fee6 > 0) {
				$current_year += $total_amt_fee6;
				$fee_headwise6 = $total_amt_fee6;
			} else {
				$current_year += 0;
				$fee_headwise6 = 0;
			}
			if ($total_amt_fee7 > 0) {
				$current_year += $total_amt_fee7;
				$fee_headwise7 = $total_amt_fee7;
			} else {
				$current_year += 0;
				$fee_headwise7 = 0;
			}
			if ($total_amt_fee8 > 0) {
				$current_year += $total_amt_fee8;
				$fee_headwise8 = $total_amt_fee8;
			} else {
				$current_year += 0;
				$fee_headwise8 = 0;
			}
			if ($total_amt_fee9 > 0) {
				$current_year += $total_amt_fee9;
				$fee_headwise9 = $total_amt_fee9;
			} else {
				$current_year += 0;
				$fee_headwise9 = 0;
			}
			if ($total_amt_fee10 > 0) {
				$current_year += $total_amt_fee10;
				$fee_headwise10 = $total_amt_fee10;
			} else {
				$current_year += 0;
				$fee_headwise10 = 0;
			}
			if ($total_amt_fee11 > 0) {
				$current_year += $total_amt_fee11;
				$fee_headwise11 = $total_amt_fee11;
			} else {
				$current_year += 0;
				$fee_headwise11 = 0;
			}
			if ($total_amt_fee12 > 0) {
				$current_year += $total_amt_fee12;
				$fee_headwise12 = $total_amt_fee12;
			} else {
				$current_year += 0;
				$fee_headwise12 = 0;
			}
			if ($total_amt_fee13 > 0) {
				$current_year += $total_amt_fee13;
				$fee_headwise13 = $total_amt_fee13;
			} else {
				$current_year += 0;
				$fee_headwise13 = 0;
			}
			if ($total_amt_fee14 > 0) {
				$current_year += $total_amt_fee14;
				$fee_headwise14 = $total_amt_fee14;
			} else {
				$current_year += 0;
				$fee_headwise14 = 0;
			}
			if ($total_amt_fee15 > 0) {
				$current_year += $total_amt_fee15;
				$fee_headwise15 = $total_amt_fee15;
			} else {
				$current_year += 0;
				$fee_headwise15 = 0;
			}
			if ($total_amt_fee16 > 0) {
				$current_year += $total_amt_fee16;
				$fee_headwise16 = $total_amt_fee16;
			} else {
				$current_year += 0;
				$fee_headwise16 = 0;
			}
			if ($total_amt_fee17 > 0) {
				$current_year += $total_amt_fee17;
				$fee_headwise17 = $total_amt_fee17;
			} else {
				$current_year += 0;
				$fee_headwise17 = 0;
			}
			if ($total_amt_fee18 > 0) {
				$current_year += $total_amt_fee18;
				$fee_headwise18 = $total_amt_fee18;
			} else {
				$current_year += 0;
				$fee_headwise18 = 0;
			}
			if ($total_amt_fee19 > 0) {
				$current_year += $total_amt_fee19;
				$fee_headwise19 = $total_amt_fee19;
			} else {
				$current_year += 0;
				$fee_headwise19 = 0;
			}
			if ($total_amt_fee20 > 0) {
				$current_year += $total_amt_fee20;
				$fee_headwise20 = $total_amt_fee20;
			} else {
				$current_year += 0;
				$fee_headwise20 = 0;
			}
			if ($total_amt_fee21 > 0) {
				$current_year += $total_amt_fee21;
				$fee_headwise21 = $total_amt_fee21;
			} else {
				$current_year += 0;
				$fee_headwise21 = 0;
			}
			if ($total_amt_fee22 > 0) {
				$current_year += $total_amt_fee22;
				$fee_headwise22 = $total_amt_fee22;
			} else {
				$current_year += 0;
				$fee_headwise22 = 0;
			}
			if ($total_amt_fee23 > 0) {
				$current_year += $total_amt_fee23;
				$fee_headwise23 = $total_amt_fee23;
			} else {
				$current_year += 0;
				$fee_headwise23 = 0;
			}
			if ($total_amt_fee24 > 0) {
				$current_year += $total_amt_fee24;
				$fee_headwise24 = $total_amt_fee24;
			} else {
				$current_year += 0;
				$fee_headwise24 = 0;
			}
			if ($total_amt_fee25 > 0) {
				$current_year += $total_amt_fee25;
				$fee_headwise25 = $total_amt_fee25;
			} else {
				$current_year += 0;
				$fee_headwise25 = 0;
			}
			$total_defaulter = ($current_year + $pre_data1);
			if ($pre_data1 > 0 || $current_year > 0 || $parcial_dues_total > 0) {
				if ($pre_data1 > 0) {
					$PRE_DUES = 'PRE,';
					if ($current_year > 0) {
						$mon = $month_print;
						if ($parcial_dues_total > 0) {
							$par = "PAR";
							$month_upto = $PRE_DUES . $mon . $par;
							$result['data'][] = array(
								$c,
								$student[$i]->FIRST_NM,
								$student[$i]->ADM_NO,
								$student[$i]->ROLL_NO,
								$class_sec,
								$month_upto,
								$pre_data1,
								$current_year,
								$fee_headwise1,
								$fee_headwise2,
								$fee_headwise3,
								$fee_headwise4,
								$fee_headwise5,
								$fee_headwise6,
								$fee_headwise7,
								$fee_headwise8,
								$fee_headwise9,
								$fee_headwise10,
								$fee_headwise11,
								$fee_headwise12,
								$fee_headwise13,
								$fee_headwise14,
								$fee_headwise15,
								$fee_headwise16,
								$fee_headwise17,
								$fee_headwise18,
								$fee_headwise19,
								$fee_headwise20,
								$fee_headwise21,
								$fee_headwise22,
								$fee_headwise23,
								$fee_headwise24,
								$fee_headwise25,
								$total_defaulter
							);
						} else {
							$par = "";
							$month_upto = $PRE_DUES . $mon . $par;
							$result['data'][] = array(
								$c,
								$student[$i]->FIRST_NM,
								$student[$i]->ADM_NO,
								$student[$i]->ROLL_NO,
								$class_sec,
								$month_upto,
								$pre_data1,
								$current_year,
								$fee_headwise1,
								$fee_headwise2,
								$fee_headwise3,
								$fee_headwise4,
								$fee_headwise5,
								$fee_headwise6,
								$fee_headwise7,
								$fee_headwise8,
								$fee_headwise9,
								$fee_headwise10,
								$fee_headwise11,
								$fee_headwise12,
								$fee_headwise13,
								$fee_headwise14,
								$fee_headwise15,
								$fee_headwise16,
								$fee_headwise17,
								$fee_headwise18,
								$fee_headwise19,
								$fee_headwise20,
								$fee_headwise21,
								$fee_headwise22,
								$fee_headwise23,
								$fee_headwise24,
								$fee_headwise25,
								$total_defaulter
							);
						}
					} else {
						$mon = "";
						if ($parcial_dues_total > 0) {
							$par = "PAR";
							$month_upto = $PRE_DUES . $mon . $par;
							$result['data'][] = array(
								$c,
								$student[$i]->FIRST_NM,
								$student[$i]->ADM_NO,
								$student[$i]->ROLL_NO,
								$class_sec,
								$month_upto,
								$pre_data1,
								$current_year,
								$fee_headwise1,
								$fee_headwise2,
								$fee_headwise3,
								$fee_headwise4,
								$fee_headwise5,
								$fee_headwise6,
								$fee_headwise7,
								$fee_headwise8,
								$fee_headwise9,
								$fee_headwise10,
								$fee_headwise11,
								$fee_headwise12,
								$fee_headwise13,
								$fee_headwise14,
								$fee_headwise15,
								$fee_headwise16,
								$fee_headwise17,
								$fee_headwise18,
								$fee_headwise19,
								$fee_headwise20,
								$fee_headwise21,
								$fee_headwise22,
								$fee_headwise23,
								$fee_headwise24,
								$fee_headwise25,
								$total_defaulter
							);
						} else {
							$par = "";
							$month_upto = $PRE_DUES . $mon . $par;
							$result['data'][] = array(
								$c,
								$student[$i]->FIRST_NM,
								$student[$i]->ADM_NO,
								$student[$i]->ROLL_NO,
								$class_sec,
								$month_upto,
								$pre_data1,
								$current_year,
								$fee_headwise1,
								$fee_headwise2,
								$fee_headwise3,
								$fee_headwise4,
								$fee_headwise5,
								$fee_headwise6,
								$fee_headwise7,
								$fee_headwise8,
								$fee_headwise9,
								$fee_headwise10,
								$fee_headwise11,
								$fee_headwise12,
								$fee_headwise13,
								$fee_headwise14,
								$fee_headwise15,
								$fee_headwise16,
								$fee_headwise17,
								$fee_headwise18,
								$fee_headwise19,
								$fee_headwise20,
								$fee_headwise21,
								$fee_headwise22,
								$fee_headwise23,
								$fee_headwise24,
								$fee_headwise25,
								$total_defaulter
							);
						}
					}
				} else {
					$PRE_DUES = "";
					if ($current_year > 0) {
						$mon = $month_print;
						if ($parcial_dues_total > 0) {
							$par = "PAR";
							$month_upto = $PRE_DUES . $mon . $par;
							$result['data'][] = array(
								$c,
								$student[$i]->FIRST_NM,
								$student[$i]->ADM_NO,
								$student[$i]->ROLL_NO,
								$class_sec,
								$month_upto,
								$pre_data1,
								$current_year,
								$fee_headwise1,
								$fee_headwise2,
								$fee_headwise3,
								$fee_headwise4,
								$fee_headwise5,
								$fee_headwise6,
								$fee_headwise7,
								$fee_headwise8,
								$fee_headwise9,
								$fee_headwise10,
								$fee_headwise11,
								$fee_headwise12,
								$fee_headwise13,
								$fee_headwise14,
								$fee_headwise15,
								$fee_headwise16,
								$fee_headwise17,
								$fee_headwise18,
								$fee_headwise19,
								$fee_headwise20,
								$fee_headwise21,
								$fee_headwise22,
								$fee_headwise23,
								$fee_headwise24,
								$fee_headwise25,
								$total_defaulter
							);
						} else {
							$par = "";
							$month_upto = $PRE_DUES . $mon . $par;
							$result['data'][] = array(
								$c,
								$student[$i]->FIRST_NM,
								$student[$i]->ADM_NO,
								$student[$i]->ROLL_NO,
								$class_sec,
								$month_upto,
								$pre_data1,
								$current_year,
								$fee_headwise1,
								$fee_headwise2,
								$fee_headwise3,
								$fee_headwise4,
								$fee_headwise5,
								$fee_headwise6,
								$fee_headwise7,
								$fee_headwise8,
								$fee_headwise9,
								$fee_headwise10,
								$fee_headwise11,
								$fee_headwise12,
								$fee_headwise13,
								$fee_headwise14,
								$fee_headwise15,
								$fee_headwise16,
								$fee_headwise17,
								$fee_headwise18,
								$fee_headwise19,
								$fee_headwise20,
								$fee_headwise21,
								$fee_headwise22,
								$fee_headwise23,
								$fee_headwise24,
								$fee_headwise25,
								$total_defaulter
							);
						}
					} else {
						$mon = "";
						if ($parcial_dues_total > 0) {
							$par = "PAR";
							$month_upto = $PRE_DUES . $mon . $par;
							$result['data'][] = array(
								$c,
								$student[$i]->FIRST_NM,
								$student[$i]->ADM_NO,
								$student[$i]->ROLL_NO,
								$class_sec,
								$month_upto,
								$pre_data1,
								$current_year,
								$fee_headwise1,
								$fee_headwise2,
								$fee_headwise3,
								$fee_headwise4,
								$fee_headwise5,
								$fee_headwise6,
								$fee_headwise7,
								$fee_headwise8,
								$fee_headwise9,
								$fee_headwise10,
								$fee_headwise11,
								$fee_headwise12,
								$fee_headwise13,
								$fee_headwise14,
								$fee_headwise15,
								$fee_headwise16,
								$fee_headwise17,
								$fee_headwise18,
								$fee_headwise19,
								$fee_headwise20,
								$fee_headwise21,
								$fee_headwise22,
								$fee_headwise23,
								$fee_headwise24,
								$fee_headwise25,
								$total_defaulter
							);
						} else {
							$par = "";
							$month_upto = $PRE_DUES . $mon . $par;
							$result['data'][] = array(
								$c,
								$student[$i]->FIRST_NM,
								$student[$i]->ADM_NO,
								$student[$i]->ROLL_NO,
								$class_sec,
								$month_upto,
								$pre_data1,
								$current_year,
								$fee_headwise1,
								$fee_headwise2,
								$fee_headwise3,
								$fee_headwise4,
								$fee_headwise5,
								$fee_headwise6,
								$fee_headwise7,
								$fee_headwise8,
								$fee_headwise9,
								$fee_headwise10,
								$fee_headwise11,
								$fee_headwise12,
								$fee_headwise13,
								$fee_headwise14,
								$fee_headwise15,
								$fee_headwise16,
								$fee_headwise17,
								$fee_headwise18,
								$fee_headwise19,
								$fee_headwise20,
								$fee_headwise21,
								$fee_headwise22,
								$fee_headwise23,
								$fee_headwise24,
								$fee_headwise25,
								$total_defaulter
							);
						}
					}
				}
				$c++;
			}
			// end of the showing student data //

		}
		$data1 = array('view' => $viewupto, 'clss' => $classs, 'secc' => $sec);
		$result['postData'] = $data1;
		// echo "<pre>";
		// print_r($result);
		// die;
		$this->load->view("Reports/defaulter_headwise_stud_list", $result);
		// echo json_encode($result);
	}
	public function defaulter_allclasswise()
	{
		ini_set('memory_limit','-1');
		ini_set('max_execution_time','0');
		$viewupto = $this->input->post('viewupto');
		$classs = $this->input->post('classs');
		$sec = $this->input->post('sec');
		$text = $this->input->post('text');
		$result = array('data' => array());
		$feehead = $this->dbcon->select('feehead', 'SHNAME');
		$result['feehead'] = $feehead;
		$result['text'] = $text;
		$student = $this->db->query("Select ADM_NO,FIRST_NM,ROLL_NO,APR_FEE,MAY_FEE,JUNE_FEE,JULY_FEE,AUG_FEE,SEP_FEE,OCT_FEE,NOV_FEE,DEC_FEE,JAN_FEE,FEB_FEE,MAR_FEE,DISP_CLASS,DISP_SEC from student where student_status='ACTIVE' and disp_Sec not in ('K','DT','RT','TC','Z')  order by class,sec,first_Nm asc")->result();
		// $student = $this->dbcon->select('student', 'ADM_NO,FIRST_NM,ROLL_NO,APR_FEE,MAY_FEE,JUNE_FEE,JULY_FEE,AUG_FEE,SEP_FEE,OCT_FEE,NOV_FEE,DEC_FEE,JAN_FEE,FEB_FEE,MAR_FEE,DISP_CLASS,DISP_SEC', "student_status='ACTIVE' and disp_Sec<>'Z' and emp_ward not in('5') order by class,sec,first_Nm asc");
		// echo "<pre>";print_r($student);die;
		$session_master = $this->dbcon->select('session_master', '*', "Active_Status='1'");
		$year = $session_master[0]->Session_Year;
		$sess_year = $year . '-' . '04' . '-' . '01';
		if ($viewupto == 'APR') {
			$sess_year_end = $year . '-' . '04' . '-' . '31';
			$monthin = array('APR');
			$loop_cnt = 1;
		} elseif ($viewupto == 'MAY') {
			$sess_year_end = $year . '-' . '05' . '-' . '31';
			$monthin = array('APR', 'MAY');
			$loop_cnt = 2;
		} elseif ($viewupto == 'JUN') {
			$sess_year_end = $year . '-' . '06' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN');
			$loop_cnt = 3;
		} elseif ($viewupto == 'JUL') {
			$sess_year_end = $year . '-' . '07' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL');
			$loop_cnt = 4;
		} elseif ($viewupto == 'AUG') {
			$sess_year_end = $year . '-' . '08' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG');
			$loop_cnt = 5;
		} elseif ($viewupto == 'SEP') {
			$sess_year_end = $year . '-' . '09' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP');
			$loop_cnt = 6;
		} elseif ($viewupto == 'OCT') {
			$sess_year_end = $year . '-' . '10' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT');
			$loop_cnt = 7;
		} elseif ($viewupto == 'NOV') {
			$sess_year_end = $year . '-' . '11' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV');
			$loop_cnt = 8;
		} elseif ($viewupto == 'DEC') {
			$sess_year_end = $year . '-' . '12' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC');
			$loop_cnt = 9;
		} elseif ($viewupto == 'JAN') {
			$year += 1;
			$sess_year_end = $year . '-' . '01' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN');
			$loop_cnt = 10;
		} elseif ($viewupto == 'FEB') {
			$year += 1;
			$sess_year_end = $year . '-' . '02' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN', 'FEB');
			$loop_cnt = 11;
		} elseif ($viewupto == 'MAR') {
			$year += 1;
			$sess_year_end = $year . '-' . '03' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN', 'FEB', 'MAR');
			$loop_cnt = 12;
		} else {
		}
		$student_cnt = count($student);
		$c = 1;
		for ($i = 0; $i < $student_cnt; $i++) {
			$adm_no = $student[$i]->ADM_NO;
			$class_sec = $student[$i]->DISP_CLASS . "-" . $student[$i]->DISP_SEC;
			// startn chekcking the month fee from the student table of perticular student //
			$MON_FEE[0] = $student[$i]->APR_FEE;
			$MON_FEE[1] = $student[$i]->MAY_FEE;
			$MON_FEE[2] = $student[$i]->JUNE_FEE;
			$MON_FEE[3] = $student[$i]->JULY_FEE;
			$MON_FEE[4] = $student[$i]->AUG_FEE;
			$MON_FEE[5] = $student[$i]->SEP_FEE;
			$MON_FEE[6] = $student[$i]->OCT_FEE;
			$MON_FEE[7] = $student[$i]->NOV_FEE;
			$MON_FEE[8] = $student[$i]->DEC_FEE;
			$MON_FEE[9] = $student[$i]->JAN_FEE;
			$MON_FEE[10] = $student[$i]->FEB_FEE;
			$MON_FEE[11] = $student[$i]->MAR_FEE;
			//checking end recpt_no from student no //
			$month_print = '';
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

			$total_amt_fee1 = 0;
			$total_amt_fee2 = 0;
			$total_amt_fee3 = 0;
			$total_amt_fee4 = 0;
			$total_amt_fee5 = 0;
			$total_amt_fee6 = 0;
			$total_amt_fee7 = 0;
			$total_amt_fee8 = 0;
			$total_amt_fee9 = 0;
			$total_amt_fee10 = 0;
			$total_amt_fee11 = 0;
			$total_amt_fee12 = 0;
			$total_amt_fee13 = 0;
			$total_amt_fee14 = 0;
			$total_amt_fee15 = 0;
			$total_amt_fee16 = 0;
			$total_amt_fee17 = 0;
			$total_amt_fee18 = 0;
			$total_amt_fee19 = 0;
			$total_amt_fee20 = 0;
			$total_amt_fee21 = 0;
			$total_amt_fee22 = 0;
			$total_amt_fee23 = 0;
			$total_amt_fee24 = 0;
			$total_amt_fee25 = 0;

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
			$pre_data = $this->dbcon->select('previous_year_feegeneration', 'SUM(TOTAL)TOTAL', "ADM_NO='$adm_no'");
			if (!empty($pre_data)) {
				$pre_data1 = $pre_data[0]->TOTAL;
			} else {
				$pre_data1 = 0;
			}
			$daycolll = $this->dbcon->select('daycoll', 'sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25', "ADM_NO='$adm_no'");
			if (!empty($daycolll)) {
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
			} else {
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
			$temp_daycoll = $this->dbcon->select('temp_daycoll', 'sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25', "ADM_NO='$adm_no' AND SEC='Z'");
			if (!empty($temp_daycoll)) {
				$fee1_temp_daycoll = $fee1_daycolll + $temp_daycoll[0]->Fee1;
				$fee2_temp_daycoll = $fee2_daycolll + $temp_daycoll[0]->Fee2;
				$fee3_temp_daycoll = $fee3_daycolll + $temp_daycoll[0]->Fee3;
				$fee4_temp_daycoll = $fee4_daycolll + $temp_daycoll[0]->Fee4;
				$fee5_temp_daycoll = $fee5_daycolll + $temp_daycoll[0]->Fee5;
				$fee6_temp_daycoll = $fee6_daycolll + $temp_daycoll[0]->Fee6;
				$fee7_temp_daycoll = $fee7_daycolll + $temp_daycoll[0]->Fee7;
				$fee8_temp_daycoll = $fee8_daycolll + $temp_daycoll[0]->Fee8;
				$fee9_temp_daycoll = $fee9_daycolll + $temp_daycoll[0]->Fee9;
				$fee10_temp_daycoll = $fee10_daycolll + $temp_daycoll[0]->Fee10;
				$fee11_temp_daycoll = $fee11_daycolll + $temp_daycoll[0]->Fee11;
				$fee12_temp_daycoll = $fee12_daycolll + $temp_daycoll[0]->Fee12;
				$fee13_temp_daycoll = $fee13_daycolll + $temp_daycoll[0]->Fee13;
				$fee14_temp_daycoll = $fee14_daycolll + $temp_daycoll[0]->Fee14;
				$fee15_temp_daycoll = $fee15_daycolll + $temp_daycoll[0]->Fee15;
				$fee16_temp_daycoll = $fee16_daycolll + $temp_daycoll[0]->Fee16;
				$fee17_temp_daycoll = $fee17_daycolll + $temp_daycoll[0]->Fee17;
				$fee18_temp_daycoll = $fee18_daycolll + $temp_daycoll[0]->Fee18;
				$fee19_temp_daycoll = $fee19_daycolll + $temp_daycoll[0]->Fee19;
				$fee20_temp_daycoll = $fee20_daycolll + $temp_daycoll[0]->Fee20;
				$fee21_temp_daycoll = $fee21_daycolll + $temp_daycoll[0]->Fee21;
				$fee22_temp_daycoll = $fee22_daycolll + $temp_daycoll[0]->Fee22;
				$fee23_temp_daycoll = $fee23_daycolll + $temp_daycoll[0]->Fee23;
				$fee24_temp_daycoll = $fee24_daycolll + $temp_daycoll[0]->Fee24;
				$fee25_temp_daycoll = $fee25_daycolll + $temp_daycoll[0]->Fee25;
			} else {
				$fee1_temp_daycoll = $fee1_daycolll + 0;
				$fee2_temp_daycoll = $fee2_daycolll + 0;
				$fee3_temp_daycoll = $fee3_daycolll + 0;
				$fee4_temp_daycoll = $fee4_daycolll + 0;
				$fee5_temp_daycoll = $fee5_daycolll + 0;
				$fee6_temp_daycoll = $fee6_daycolll + 0;
				$fee7_temp_daycoll = $fee7_daycolll + 0;
				$fee8_temp_daycoll = $fee8_daycolll + 0;
				$fee9_temp_daycoll = $fee9_daycolll + 0;
				$fee10_temp_daycoll = $fee10_daycolll + 0;
				$fee11_temp_daycoll = $fee11_daycolll + 0;
				$fee12_temp_daycoll = $fee12_daycolll + 0;
				$fee13_temp_daycoll = $fee13_daycolll + 0;
				$fee14_temp_daycoll = $fee14_daycolll + 0;
				$fee15_temp_daycoll = $fee15_daycolll + 0;
				$fee16_temp_daycoll = $fee16_daycolll + 0;
				$fee17_temp_daycoll = $fee17_daycolll + 0;
				$fee18_temp_daycoll = $fee18_daycolll + 0;
				$fee19_temp_daycoll = $fee19_daycolll + 0;
				$fee20_temp_daycoll = $fee20_daycolll + 0;
				$fee21_temp_daycoll = $fee21_daycolll + 0;
				$fee22_temp_daycoll = $fee22_daycolll + 0;
				$fee23_temp_daycoll = $fee23_daycolll + 0;
				$fee24_temp_daycoll = $fee24_daycolll + 0;
				$fee25_temp_daycoll = $fee25_daycolll + 0;
				$temp_daycoll_amount = 0;
			}
			// end of fetching data from the table //
			for ($l = 0; $l < $loop_cnt; $l++) {
				if ($MON_FEE[$l] != 'N/A' and $MON_FEE[$l] != '') {
				} else {
					$month_print .= $monthin[$l] . ',';
					$unpaid_month = $this->dbcon->select('feegeneration', 'sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25', "ADM_NO='$adm_no' AND Month_NM='$monthin[$l]'");
					if (!empty($unpaid_month)) {
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
				if ($MON_FEE[$l] == 'FREESHIP') {
				} else {
					$feegeneration = $this->dbcon->select('feegeneration', 'sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25', "ADM_NO='$adm_no' AND Month_NM='$monthin[$l]'");
					if (!empty($feegeneration)) {
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
			$fee1_paid_month = ($fee1_feegeneration - $fee1_unpaid_month);
			$fee2_paid_month = ($fee2_feegeneration - $fee2_unpaid_month);
			$fee3_paid_month = ($fee3_feegeneration - $fee3_unpaid_month);
			$fee4_paid_month = ($fee4_feegeneration - $fee4_unpaid_month);
			$fee5_paid_month = ($fee5_feegeneration - $fee5_unpaid_month);
			$fee6_paid_month = ($fee6_feegeneration - $fee6_unpaid_month);
			$fee7_paid_month = ($fee7_feegeneration - $fee7_unpaid_month);
			$fee8_paid_month = ($fee8_feegeneration - $fee8_unpaid_month);
			$fee9_paid_month = ($fee9_feegeneration - $fee9_unpaid_month);
			$fee10_paid_month = ($fee10_feegeneration - $fee10_unpaid_month);
			$fee11_paid_month = ($fee11_feegeneration - $fee11_unpaid_month);
			$fee12_paid_month = ($fee12_feegeneration - $fee12_unpaid_month);
			$fee13_paid_month = ($fee13_feegeneration - $fee13_unpaid_month);
			$fee14_paid_month = ($fee14_feegeneration - $fee14_unpaid_month);
			$fee15_paid_month = ($fee15_feegeneration - $fee15_unpaid_month);
			$fee16_paid_month = ($fee16_feegeneration - $fee16_unpaid_month);
			$fee17_paid_month = ($fee17_feegeneration - $fee17_unpaid_month);
			$fee18_paid_month = ($fee18_feegeneration - $fee18_unpaid_month);
			$fee19_paid_month = ($fee19_feegeneration - $fee19_unpaid_month);
			$fee20_paid_month = ($fee20_feegeneration - $fee20_unpaid_month);
			$fee21_paid_month = ($fee21_feegeneration - $fee21_unpaid_month);
			$fee22_paid_month = ($fee22_feegeneration - $fee22_unpaid_month);
			$fee23_paid_month = ($fee23_feegeneration - $fee23_unpaid_month);
			$fee24_paid_month = ($fee24_feegeneration - $fee24_unpaid_month);
			$fee25_paid_month = ($fee25_feegeneration - $fee25_unpaid_month);

			$total_amt_fee1 = ($fee1_feegeneration - $fee1_temp_daycoll);
			$total_amt_fee2 = ($fee2_feegeneration - $fee2_temp_daycoll);
			$total_amt_fee3 = ($fee3_feegeneration - $fee3_temp_daycoll);
			$total_amt_fee4 = ($fee4_feegeneration - $fee4_temp_daycoll);
			$total_amt_fee5 = ($fee5_feegeneration - $fee5_temp_daycoll);
			$total_amt_fee6 = ($fee6_feegeneration - $fee6_temp_daycoll);
			$total_amt_fee7 = ($fee7_feegeneration - $fee7_temp_daycoll);
			$total_amt_fee8 = ($fee8_feegeneration - $fee8_temp_daycoll);
			$total_amt_fee9 = ($fee9_feegeneration - $fee9_temp_daycoll);
			$total_amt_fee10 = ($fee10_feegeneration - $fee10_temp_daycoll);
			$total_amt_fee11 = ($fee11_feegeneration - $fee11_temp_daycoll);
			$total_amt_fee12 = ($fee12_feegeneration - $fee12_temp_daycoll);
			$total_amt_fee13 = ($fee13_feegeneration - $fee13_temp_daycoll);
			$total_amt_fee14 = ($fee14_feegeneration - $fee14_temp_daycoll);
			$total_amt_fee15 = ($fee15_feegeneration - $fee15_temp_daycoll);
			$total_amt_fee16 = ($fee16_feegeneration - $fee16_temp_daycoll);
			$total_amt_fee17 = ($fee17_feegeneration - $fee17_temp_daycoll);
			$total_amt_fee18 = ($fee18_feegeneration - $fee18_temp_daycoll);
			$total_amt_fee19 = ($fee19_feegeneration - $fee19_temp_daycoll);
			$total_amt_fee20 = ($fee20_feegeneration - $fee20_temp_daycoll);
			$total_amt_fee21 = ($fee21_feegeneration - $fee21_temp_daycoll);
			$total_amt_fee22 = ($fee22_feegeneration - $fee22_temp_daycoll);
			$total_amt_fee23 = ($fee23_feegeneration - $fee23_temp_daycoll);
			$total_amt_fee24 = ($fee24_feegeneration - $fee24_temp_daycoll);
			$total_amt_fee25 = ($fee25_feegeneration - $fee25_temp_daycoll);

			$parcial_fee1 = ($fee1_paid_month - $fee1_temp_daycoll);
			$parcial_fee2 = ($fee2_paid_month - $fee2_temp_daycoll);
			$parcial_fee3 = ($fee3_paid_month - $fee3_temp_daycoll);
			$parcial_fee4 = ($fee4_paid_month - $fee4_temp_daycoll);
			$parcial_fee5 = ($fee5_paid_month - $fee5_temp_daycoll);
			$parcial_fee6 = ($fee6_paid_month - $fee6_temp_daycoll);
			$parcial_fee7 = ($fee7_paid_month - $fee7_temp_daycoll);
			$parcial_fee8 = ($fee8_paid_month - $fee8_temp_daycoll);
			$parcial_fee9 = ($fee9_paid_month - $fee9_temp_daycoll);
			$parcial_fee10 = ($fee10_paid_month - $fee10_temp_daycoll);
			$parcial_fee11 = ($fee11_paid_month - $fee11_temp_daycoll);
			$parcial_fee12 = ($fee12_paid_month - $fee12_temp_daycoll);
			$parcial_fee13 = ($fee13_paid_month - $fee13_temp_daycoll);
			$parcial_fee14 = ($fee14_paid_month - $fee14_temp_daycoll);
			$parcial_fee15 = ($fee15_paid_month - $fee15_temp_daycoll);
			$parcial_fee16 = ($fee16_paid_month - $fee16_temp_daycoll);
			$parcial_fee17 = ($fee17_paid_month - $fee17_temp_daycoll);
			$parcial_fee18 = ($fee18_paid_month - $fee18_temp_daycoll);
			$parcial_fee19 = ($fee19_paid_month - $fee19_temp_daycoll);
			$parcial_fee20 = ($fee20_paid_month - $fee20_temp_daycoll);
			$parcial_fee21 = ($fee21_paid_month - $fee21_temp_daycoll);
			$parcial_fee22 = ($fee22_paid_month - $fee22_temp_daycoll);
			$parcial_fee23 = ($fee23_paid_month - $fee23_temp_daycoll);
			$parcial_fee24 = ($fee24_paid_month - $fee24_temp_daycoll);
			$parcial_fee25 = ($fee25_paid_month - $fee25_temp_daycoll);

			if ($parcial_fee1 > 0) {
				$parcial_dues_total += $parcial_fee1;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee2 > 0) {
				$parcial_dues_total += $parcial_fee2;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee3 > 0) {
				$parcial_dues_total += $parcial_fee3;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee4 > 0) {
				$parcial_dues_total += $parcial_fee4;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee5 > 0) {
				$parcial_dues_total += $parcial_fee5;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee6 > 0) {
				$parcial_dues_total += $parcial_fee6;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee7 > 0) {
				$parcial_dues_total += $parcial_fee7;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee8 > 0) {
				$parcial_dues_total += $parcial_fee8;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee9 > 0) {
				$parcial_dues_total += $parcial_fee9;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee10 > 0) {
				$parcial_dues_total += $parcial_fee10;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee11 > 0) {
				$parcial_dues_total += $parcial_fee11;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee12 > 0) {
				$parcial_dues_total += $parcial_fee12;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee13 > 0) {
				$parcial_dues_total += $parcial_fee13;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee14 > 0) {
				$parcial_dues_total += $parcial_fee14;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee15 > 0) {
				$parcial_dues_total += $parcial_fee15;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee16 > 0) {
				$parcial_dues_total += $parcial_fee16;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee17 > 0) {
				$parcial_dues_total += $parcial_fee17;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee18 > 0) {
				$parcial_dues_total += $parcial_fee18;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee19 > 0) {
				$parcial_dues_total += $parcial_fee19;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee20 > 0) {
				$parcial_dues_total += $parcial_fee20;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee21 > 0) {
				$parcial_dues_total += $parcial_fee21;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee22 > 0) {
				$parcial_dues_total += $parcial_fee22;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee23 > 0) {
				$parcial_dues_total += $parcial_fee23;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee24 > 0) {
				$parcial_dues_total += $parcial_fee24;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee25 > 0) {
				$parcial_dues_total += $parcial_fee25;
			} else {
				$parcial_dues_total += 0;
			}

			if ($total_amt_fee1 > 0) {
				$current_year += $total_amt_fee1;
				$fee_headwise1 = $total_amt_fee1;
			} else {
				$current_year += 0;
				$fee_headwise1 = 0;
			}
			if ($total_amt_fee2 > 0) {
				$current_year += $total_amt_fee2;
				$fee_headwise2 = $total_amt_fee2;
			} else {
				$current_year += 0;
				$fee_headwise2 = 0;
			}
			if ($total_amt_fee3 > 0) {
				$current_year += $total_amt_fee3;
				$fee_headwise3 = $total_amt_fee3;
			} else {
				$current_year += 0;
				$fee_headwise3 = 0;
			}
			if ($total_amt_fee4 > 0) {
				$current_year += $total_amt_fee4;
				$fee_headwise4 = $total_amt_fee4;
			} else {
				$current_year += 0;
				$fee_headwise4 = 0;
			}
			if ($total_amt_fee5 > 0) {
				$current_year += $total_amt_fee5;
				$fee_headwise5 = $total_amt_fee5;
			} else {
				$current_year += 0;
				$fee_headwise5 = 0;
			}
			if ($total_amt_fee6 > 0) {
				$current_year += $total_amt_fee6;
				$fee_headwise6 = $total_amt_fee6;
			} else {
				$current_year += 0;
				$fee_headwise6 = 0;
			}
			if ($total_amt_fee7 > 0) {
				$current_year += $total_amt_fee7;
				$fee_headwise7 = $total_amt_fee7;
			} else {
				$current_year += 0;
				$fee_headwise7 = 0;
			}
			if ($total_amt_fee8 > 0) {
				$current_year += $total_amt_fee8;
				$fee_headwise8 = $total_amt_fee8;
			} else {
				$current_year += 0;
				$fee_headwise8 = 0;
			}
			if ($total_amt_fee9 > 0) {
				$current_year += $total_amt_fee9;
				$fee_headwise9 = $total_amt_fee9;
			} else {
				$current_year += 0;
				$fee_headwise9 = 0;
			}
			if ($total_amt_fee10 > 0) {
				$current_year += $total_amt_fee10;
				$fee_headwise10 = $total_amt_fee10;
			} else {
				$current_year += 0;
				$fee_headwise10 = 0;
			}
			if ($total_amt_fee11 > 0) {
				$current_year += $total_amt_fee11;
				$fee_headwise11 = $total_amt_fee11;
			} else {
				$current_year += 0;
				$fee_headwise11 = 0;
			}
			if ($total_amt_fee12 > 0) {
				$current_year += $total_amt_fee12;
				$fee_headwise12 = $total_amt_fee12;
			} else {
				$current_year += 0;
				$fee_headwise12 = 0;
			}
			if ($total_amt_fee13 > 0) {
				$current_year += $total_amt_fee13;
				$fee_headwise13 = $total_amt_fee13;
			} else {
				$current_year += 0;
				$fee_headwise13 = 0;
			}
			if ($total_amt_fee14 > 0) {
				$current_year += $total_amt_fee14;
				$fee_headwise14 = $total_amt_fee14;
			} else {
				$current_year += 0;
				$fee_headwise14 = 0;
			}
			if ($total_amt_fee15 > 0) {
				$current_year += $total_amt_fee15;
				$fee_headwise15 = $total_amt_fee15;
			} else {
				$current_year += 0;
				$fee_headwise15 = 0;
			}
			if ($total_amt_fee16 > 0) {
				$current_year += $total_amt_fee16;
				$fee_headwise16 = $total_amt_fee16;
			} else {
				$current_year += 0;
				$fee_headwise16 = 0;
			}
			if ($total_amt_fee17 > 0) {
				$current_year += $total_amt_fee17;
				$fee_headwise17 = $total_amt_fee17;
			} else {
				$current_year += 0;
				$fee_headwise17 = 0;
			}
			if ($total_amt_fee18 > 0) {
				$current_year += $total_amt_fee18;
				$fee_headwise18 = $total_amt_fee18;
			} else {
				$current_year += 0;
				$fee_headwise18 = 0;
			}
			if ($total_amt_fee19 > 0) {
				$current_year += $total_amt_fee19;
				$fee_headwise19 = $total_amt_fee19;
			} else {
				$current_year += 0;
				$fee_headwise19 = 0;
			}
			if ($total_amt_fee20 > 0) {
				$current_year += $total_amt_fee20;
				$fee_headwise20 = $total_amt_fee20;
			} else {
				$current_year += 0;
				$fee_headwise20 = 0;
			}
			if ($total_amt_fee21 > 0) {
				$current_year += $total_amt_fee21;
				$fee_headwise21 = $total_amt_fee21;
			} else {
				$current_year += 0;
				$fee_headwise21 = 0;
			}
			if ($total_amt_fee22 > 0) {
				$current_year += $total_amt_fee22;
				$fee_headwise22 = $total_amt_fee22;
			} else {
				$current_year += 0;
				$fee_headwise22 = 0;
			}
			if ($total_amt_fee23 > 0) {
				$current_year += $total_amt_fee23;
				$fee_headwise23 = $total_amt_fee23;
			} else {
				$current_year += 0;
				$fee_headwise23 = 0;
			}
			if ($total_amt_fee24 > 0) {
				$current_year += $total_amt_fee24;
				$fee_headwise24 = $total_amt_fee24;
			} else {
				$current_year += 0;
				$fee_headwise24 = 0;
			}
			if ($total_amt_fee25 > 0) {
				$current_year += $total_amt_fee25;
				$fee_headwise25 = $total_amt_fee25;
			} else {
				$current_year += 0;
				$fee_headwise25 = 0;
			}
			$total_defaulter = ($current_year + $pre_data1);
			if ($pre_data1 > 0 || $current_year > 0 || $parcial_dues_total > 0) {
				if ($pre_data1 > 0) {
					$PRE_DUES = 'PRE,';
					if ($current_year > 0) {
						$mon = $month_print;
						if ($parcial_dues_total > 0) {
							$par = "PAR";
							$month_upto = $PRE_DUES . $mon . $par;
							$result['data'][] = array(
								$c,
								$student[$i]->FIRST_NM,
								$student[$i]->ADM_NO,
								$student[$i]->ROLL_NO,
								$class_sec,
								$month_upto,
								$pre_data1,
								$current_year,
								$fee_headwise1,
								$fee_headwise2,
								$fee_headwise3,
								$fee_headwise4,
								$fee_headwise5,
								$fee_headwise6,
								$fee_headwise7,
								$fee_headwise8,
								$fee_headwise9,
								$fee_headwise10,
								$fee_headwise11,
								$fee_headwise12,
								$fee_headwise13,
								$fee_headwise14,
								$fee_headwise15,
								$fee_headwise16,
								$fee_headwise17,
								$fee_headwise18,
								$fee_headwise19,
								$fee_headwise20,
								$fee_headwise21,
								$fee_headwise22,
								$fee_headwise23,
								$fee_headwise24,
								$fee_headwise25,
								$total_defaulter
							);
						} else {
							$par = "";
							$month_upto = $PRE_DUES . $mon . $par;
							$result['data'][] = array(
								$c,
								$student[$i]->FIRST_NM,
								$student[$i]->ADM_NO,
								$student[$i]->ROLL_NO,
								$class_sec,
								$month_upto,
								$pre_data1,
								$current_year,
								$fee_headwise1,
								$fee_headwise2,
								$fee_headwise3,
								$fee_headwise4,
								$fee_headwise5,
								$fee_headwise6,
								$fee_headwise7,
								$fee_headwise8,
								$fee_headwise9,
								$fee_headwise10,
								$fee_headwise11,
								$fee_headwise12,
								$fee_headwise13,
								$fee_headwise14,
								$fee_headwise15,
								$fee_headwise16,
								$fee_headwise17,
								$fee_headwise18,
								$fee_headwise19,
								$fee_headwise20,
								$fee_headwise21,
								$fee_headwise22,
								$fee_headwise23,
								$fee_headwise24,
								$fee_headwise25,
								$total_defaulter
							);
						}
					} else {
						$mon = "";
						if ($parcial_dues_total > 0) {
							$par = "PAR";
							$month_upto = $PRE_DUES . $mon . $par;
							$result['data'][] = array(
								$c,
								$student[$i]->FIRST_NM,
								$student[$i]->ADM_NO,
								$student[$i]->ROLL_NO,
								$class_sec,
								$month_upto,
								$pre_data1,
								$current_year,
								$fee_headwise1,
								$fee_headwise2,
								$fee_headwise3,
								$fee_headwise4,
								$fee_headwise5,
								$fee_headwise6,
								$fee_headwise7,
								$fee_headwise8,
								$fee_headwise9,
								$fee_headwise10,
								$fee_headwise11,
								$fee_headwise12,
								$fee_headwise13,
								$fee_headwise14,
								$fee_headwise15,
								$fee_headwise16,
								$fee_headwise17,
								$fee_headwise18,
								$fee_headwise19,
								$fee_headwise20,
								$fee_headwise21,
								$fee_headwise22,
								$fee_headwise23,
								$fee_headwise24,
								$fee_headwise25,
								$total_defaulter
							);
						} else {
							$par = "";
							$month_upto = $PRE_DUES . $mon . $par;
							$result['data'][] = array(
								$c,
								$student[$i]->FIRST_NM,
								$student[$i]->ADM_NO,
								$student[$i]->ROLL_NO,
								$class_sec,
								$month_upto,
								$pre_data1,
								$current_year,
								$fee_headwise1,
								$fee_headwise2,
								$fee_headwise3,
								$fee_headwise4,
								$fee_headwise5,
								$fee_headwise6,
								$fee_headwise7,
								$fee_headwise8,
								$fee_headwise9,
								$fee_headwise10,
								$fee_headwise11,
								$fee_headwise12,
								$fee_headwise13,
								$fee_headwise14,
								$fee_headwise15,
								$fee_headwise16,
								$fee_headwise17,
								$fee_headwise18,
								$fee_headwise19,
								$fee_headwise20,
								$fee_headwise21,
								$fee_headwise22,
								$fee_headwise23,
								$fee_headwise24,
								$fee_headwise25,
								$total_defaulter
							);
						}
					}
				} else {
					$PRE_DUES = "";
					if ($current_year > 0) {
						$mon = $month_print;
						if ($parcial_dues_total > 0) {
							$par = "PAR";
							$month_upto = $PRE_DUES . $mon . $par;
							$result['data'][] = array(
								$c,
								$student[$i]->FIRST_NM,
								$student[$i]->ADM_NO,
								$student[$i]->ROLL_NO,
								$class_sec,
								$month_upto,
								$pre_data1,
								$current_year,
								$fee_headwise1,
								$fee_headwise2,
								$fee_headwise3,
								$fee_headwise4,
								$fee_headwise5,
								$fee_headwise6,
								$fee_headwise7,
								$fee_headwise8,
								$fee_headwise9,
								$fee_headwise10,
								$fee_headwise11,
								$fee_headwise12,
								$fee_headwise13,
								$fee_headwise14,
								$fee_headwise15,
								$fee_headwise16,
								$fee_headwise17,
								$fee_headwise18,
								$fee_headwise19,
								$fee_headwise20,
								$fee_headwise21,
								$fee_headwise22,
								$fee_headwise23,
								$fee_headwise24,
								$fee_headwise25,
								$total_defaulter
							);
						} else {
							$par = "";
							$month_upto = $PRE_DUES . $mon . $par;
							$result['data'][] = array(
								$c,
								$student[$i]->FIRST_NM,
								$student[$i]->ADM_NO,
								$student[$i]->ROLL_NO,
								$class_sec,
								$month_upto,
								$pre_data1,
								$current_year,
								$fee_headwise1,
								$fee_headwise2,
								$fee_headwise3,
								$fee_headwise4,
								$fee_headwise5,
								$fee_headwise6,
								$fee_headwise7,
								$fee_headwise8,
								$fee_headwise9,
								$fee_headwise10,
								$fee_headwise11,
								$fee_headwise12,
								$fee_headwise13,
								$fee_headwise14,
								$fee_headwise15,
								$fee_headwise16,
								$fee_headwise17,
								$fee_headwise18,
								$fee_headwise19,
								$fee_headwise20,
								$fee_headwise21,
								$fee_headwise22,
								$fee_headwise23,
								$fee_headwise24,
								$fee_headwise25,
								$total_defaulter
							);
						}
					} else {
						$mon = "";
						if ($parcial_dues_total > 0) {
							$par = "PAR";
							$month_upto = $PRE_DUES . $mon . $par;
							$result['data'][] = array(
								$c,
								$student[$i]->FIRST_NM,
								$student[$i]->ADM_NO,
								$student[$i]->ROLL_NO,
								$class_sec,
								$month_upto,
								$pre_data1,
								$current_year,
								$fee_headwise1,
								$fee_headwise2,
								$fee_headwise3,
								$fee_headwise4,
								$fee_headwise5,
								$fee_headwise6,
								$fee_headwise7,
								$fee_headwise8,
								$fee_headwise9,
								$fee_headwise10,
								$fee_headwise11,
								$fee_headwise12,
								$fee_headwise13,
								$fee_headwise14,
								$fee_headwise15,
								$fee_headwise16,
								$fee_headwise17,
								$fee_headwise18,
								$fee_headwise19,
								$fee_headwise20,
								$fee_headwise21,
								$fee_headwise22,
								$fee_headwise23,
								$fee_headwise24,
								$fee_headwise25,
								$total_defaulter
							);
						} else {
							$par = "";
							$month_upto = $PRE_DUES . $mon . $par;
							$result['data'][] = array(
								$c,
								$student[$i]->FIRST_NM,
								$student[$i]->ADM_NO,
								$student[$i]->ROLL_NO,
								$class_sec,
								$month_upto,
								$pre_data1,
								$current_year,
								$fee_headwise1,
								$fee_headwise2,
								$fee_headwise3,
								$fee_headwise4,
								$fee_headwise5,
								$fee_headwise6,
								$fee_headwise7,
								$fee_headwise8,
								$fee_headwise9,
								$fee_headwise10,
								$fee_headwise11,
								$fee_headwise12,
								$fee_headwise13,
								$fee_headwise14,
								$fee_headwise15,
								$fee_headwise16,
								$fee_headwise17,
								$fee_headwise18,
								$fee_headwise19,
								$fee_headwise20,
								$fee_headwise21,
								$fee_headwise22,
								$fee_headwise23,
								$fee_headwise24,
								$fee_headwise25,
								$total_defaulter
							);
						}
					}
				}
				$c++;
			}
			// end of the showing student data //

		}
		// echo"<pre>";print_r($result);die;
		$this->load->view("Reports/defaulter_headwise_stud_list", $result);
		// echo json_encode($result);
	}
	public function defaulter_classHeadWisePDF($view = '', $clss = '', $secc = '')
	{
		if (!empty($view && $clss && $secc)) {
			$viewupto = $view;
			$classs = $clss;
			$sec = $secc;
			$student = $this->dbcon->select('student', 'ADM_NO,FIRST_NM,ROLL_NO,APR_FEE,MAY_FEE,JUNE_FEE,JULY_FEE,AUG_FEE,SEP_FEE,OCT_FEE,NOV_FEE,DEC_FEE,JAN_FEE,FEB_FEE,MAR_FEE,DISP_CLASS,DISP_SEC', "Student_Status='ACTIVE' AND CLASS='$classs' AND SEC='$sec'");
		} else {
			$student = $this->db->query("Select ADM_NO,FIRST_NM,ROLL_NO,APR_FEE,MAY_FEE,JUNE_FEE,JULY_FEE,AUG_FEE,SEP_FEE,OCT_FEE,NOV_FEE,DEC_FEE,JAN_FEE,FEB_FEE,MAR_FEE,DISP_CLASS,DISP_SEC from student where student_status='ACTIVE' and disp_Sec<>'Z' and emp_ward not in('5') order by class,sec,first_Nm asc")->result();
		}
		$result = array('data' => array());
		$feehead = $this->dbcon->select('feehead', 'SHNAME');
		$result['feehead'] = $feehead;
		// echo "<pre>";print_r($student);die;
		$session_master = $this->dbcon->select('session_master', '*', "Active_Status='1'");
		$year = $session_master[0]->Session_Year;
		$sess_year = $year . '-' . '04' . '-' . '01';
		if ($viewupto == 'APR') {
			$sess_year_end = $year . '-' . '04' . '-' . '31';
			$monthin = array('APR');
			$loop_cnt = 1;
		} elseif ($viewupto == 'MAY') {
			$sess_year_end = $year . '-' . '05' . '-' . '31';
			$monthin = array('APR', 'MAY');
			$loop_cnt = 2;
		} elseif ($viewupto == 'JUN') {
			$sess_year_end = $year . '-' . '06' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN');
			$loop_cnt = 3;
		} elseif ($viewupto == 'JUL') {
			$sess_year_end = $year . '-' . '07' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL');
			$loop_cnt = 4;
		} elseif ($viewupto == 'AUG') {
			$sess_year_end = $year . '-' . '08' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG');
			$loop_cnt = 5;
		} elseif ($viewupto == 'SEP') {
			$sess_year_end = $year . '-' . '09' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP');
			$loop_cnt = 6;
		} elseif ($viewupto == 'OCT') {
			$sess_year_end = $year . '-' . '10' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT');
			$loop_cnt = 7;
		} elseif ($viewupto == 'NOV') {
			$sess_year_end = $year . '-' . '11' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV');
			$loop_cnt = 8;
		} elseif ($viewupto == 'DEC') {
			$sess_year_end = $year . '-' . '12' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC');
			$loop_cnt = 9;
		} elseif ($viewupto == 'JAN') {
			$year += 1;
			$sess_year_end = $year . '-' . '01' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN');
			$loop_cnt = 10;
		} elseif ($viewupto == 'FEB') {
			$year += 1;
			$sess_year_end = $year . '-' . '02' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN', 'FEB');
			$loop_cnt = 11;
		} elseif ($viewupto == 'MAR') {
			$year += 1;
			$sess_year_end = $year . '-' . '03' . '-' . '31';
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN', 'FEB', 'MAR');
			$loop_cnt = 12;
		} else {
		}
		$student_cnt = count($student);
		$c = 1;
		for ($i = 0; $i < $student_cnt; $i++) {
			$adm_no = $student[$i]->ADM_NO;
			$class_sec = $student[$i]->DISP_CLASS . "-" . $student[$i]->DISP_SEC;
			// startn chekcking the month fee from the student table of perticular student //
			$MON_FEE[0] = $student[$i]->APR_FEE;
			$MON_FEE[1] = $student[$i]->MAY_FEE;
			$MON_FEE[2] = $student[$i]->JUNE_FEE;
			$MON_FEE[3] = $student[$i]->JULY_FEE;
			$MON_FEE[4] = $student[$i]->AUG_FEE;
			$MON_FEE[5] = $student[$i]->SEP_FEE;
			$MON_FEE[6] = $student[$i]->OCT_FEE;
			$MON_FEE[7] = $student[$i]->NOV_FEE;
			$MON_FEE[8] = $student[$i]->DEC_FEE;
			$MON_FEE[9] = $student[$i]->JAN_FEE;
			$MON_FEE[10] = $student[$i]->FEB_FEE;
			$MON_FEE[11] = $student[$i]->MAR_FEE;
			//checking end recpt_no from student no //
			$month_print = '';
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

			$total_amt_fee1 = 0;
			$total_amt_fee2 = 0;
			$total_amt_fee3 = 0;
			$total_amt_fee4 = 0;
			$total_amt_fee5 = 0;
			$total_amt_fee6 = 0;
			$total_amt_fee7 = 0;
			$total_amt_fee8 = 0;
			$total_amt_fee9 = 0;
			$total_amt_fee10 = 0;
			$total_amt_fee11 = 0;
			$total_amt_fee12 = 0;
			$total_amt_fee13 = 0;
			$total_amt_fee14 = 0;
			$total_amt_fee15 = 0;
			$total_amt_fee16 = 0;
			$total_amt_fee17 = 0;
			$total_amt_fee18 = 0;
			$total_amt_fee19 = 0;
			$total_amt_fee20 = 0;
			$total_amt_fee21 = 0;
			$total_amt_fee22 = 0;
			$total_amt_fee23 = 0;
			$total_amt_fee24 = 0;
			$total_amt_fee25 = 0;

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
			$pre_data = $this->dbcon->select('previous_year_feegeneration', 'SUM(TOTAL)TOTAL', "ADM_NO='$adm_no'");
			if (!empty($pre_data)) {
				$pre_data1 = $pre_data[0]->TOTAL;
			} else {
				$pre_data1 = 0;
			}
			$daycolll = $this->dbcon->select('daycoll', 'sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25', "ADM_NO='$adm_no'");
			if (!empty($daycolll)) {
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
			} else {
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
			$temp_daycoll = $this->dbcon->select('temp_daycoll', 'sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25', "ADM_NO='$adm_no' AND SEC='Z'");
			if (!empty($temp_daycoll)) {
				$fee1_temp_daycoll = $fee1_daycolll + $temp_daycoll[0]->Fee1;
				$fee2_temp_daycoll = $fee2_daycolll + $temp_daycoll[0]->Fee2;
				$fee3_temp_daycoll = $fee3_daycolll + $temp_daycoll[0]->Fee3;
				$fee4_temp_daycoll = $fee4_daycolll + $temp_daycoll[0]->Fee4;
				$fee5_temp_daycoll = $fee5_daycolll + $temp_daycoll[0]->Fee5;
				$fee6_temp_daycoll = $fee6_daycolll + $temp_daycoll[0]->Fee6;
				$fee7_temp_daycoll = $fee7_daycolll + $temp_daycoll[0]->Fee7;
				$fee8_temp_daycoll = $fee8_daycolll + $temp_daycoll[0]->Fee8;
				$fee9_temp_daycoll = $fee9_daycolll + $temp_daycoll[0]->Fee9;
				$fee10_temp_daycoll = $fee10_daycolll + $temp_daycoll[0]->Fee10;
				$fee11_temp_daycoll = $fee11_daycolll + $temp_daycoll[0]->Fee11;
				$fee12_temp_daycoll = $fee12_daycolll + $temp_daycoll[0]->Fee12;
				$fee13_temp_daycoll = $fee13_daycolll + $temp_daycoll[0]->Fee13;
				$fee14_temp_daycoll = $fee14_daycolll + $temp_daycoll[0]->Fee14;
				$fee15_temp_daycoll = $fee15_daycolll + $temp_daycoll[0]->Fee15;
				$fee16_temp_daycoll = $fee16_daycolll + $temp_daycoll[0]->Fee16;
				$fee17_temp_daycoll = $fee17_daycolll + $temp_daycoll[0]->Fee17;
				$fee18_temp_daycoll = $fee18_daycolll + $temp_daycoll[0]->Fee18;
				$fee19_temp_daycoll = $fee19_daycolll + $temp_daycoll[0]->Fee19;
				$fee20_temp_daycoll = $fee20_daycolll + $temp_daycoll[0]->Fee20;
				$fee21_temp_daycoll = $fee21_daycolll + $temp_daycoll[0]->Fee21;
				$fee22_temp_daycoll = $fee22_daycolll + $temp_daycoll[0]->Fee22;
				$fee23_temp_daycoll = $fee23_daycolll + $temp_daycoll[0]->Fee23;
				$fee24_temp_daycoll = $fee24_daycolll + $temp_daycoll[0]->Fee24;
				$fee25_temp_daycoll = $fee25_daycolll + $temp_daycoll[0]->Fee25;
			} else {
				$fee1_temp_daycoll = $fee1_daycolll + 0;
				$fee2_temp_daycoll = $fee2_daycolll + 0;
				$fee3_temp_daycoll = $fee3_daycolll + 0;
				$fee4_temp_daycoll = $fee4_daycolll + 0;
				$fee5_temp_daycoll = $fee5_daycolll + 0;
				$fee6_temp_daycoll = $fee6_daycolll + 0;
				$fee7_temp_daycoll = $fee7_daycolll + 0;
				$fee8_temp_daycoll = $fee8_daycolll + 0;
				$fee9_temp_daycoll = $fee9_daycolll + 0;
				$fee10_temp_daycoll = $fee10_daycolll + 0;
				$fee11_temp_daycoll = $fee11_daycolll + 0;
				$fee12_temp_daycoll = $fee12_daycolll + 0;
				$fee13_temp_daycoll = $fee13_daycolll + 0;
				$fee14_temp_daycoll = $fee14_daycolll + 0;
				$fee15_temp_daycoll = $fee15_daycolll + 0;
				$fee16_temp_daycoll = $fee16_daycolll + 0;
				$fee17_temp_daycoll = $fee17_daycolll + 0;
				$fee18_temp_daycoll = $fee18_daycolll + 0;
				$fee19_temp_daycoll = $fee19_daycolll + 0;
				$fee20_temp_daycoll = $fee20_daycolll + 0;
				$fee21_temp_daycoll = $fee21_daycolll + 0;
				$fee22_temp_daycoll = $fee22_daycolll + 0;
				$fee23_temp_daycoll = $fee23_daycolll + 0;
				$fee24_temp_daycoll = $fee24_daycolll + 0;
				$fee25_temp_daycoll = $fee25_daycolll + 0;
				$temp_daycoll_amount = 0;
			}
			// end of fetching data from the table //
			for ($l = 0; $l < $loop_cnt; $l++) {
				if ($MON_FEE[$l] != 'N/A' and $MON_FEE[$l] != '') {
				} else {
					$month_print .= $monthin[$l] . ',';
					$unpaid_month = $this->dbcon->select('feegeneration', 'sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25', "ADM_NO='$adm_no' AND Month_NM='$monthin[$l]'");
					if (!empty($unpaid_month)) {
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
				if ($MON_FEE[$l] == 'FREESHIP') {
				} else {
					$feegeneration = $this->dbcon->select('feegeneration', 'sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25', "ADM_NO='$adm_no' AND Month_NM='$monthin[$l]'");
					if (!empty($feegeneration)) {
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
			$fee1_paid_month = ($fee1_feegeneration - $fee1_unpaid_month);
			$fee2_paid_month = ($fee2_feegeneration - $fee2_unpaid_month);
			$fee3_paid_month = ($fee3_feegeneration - $fee3_unpaid_month);
			$fee4_paid_month = ($fee4_feegeneration - $fee4_unpaid_month);
			$fee5_paid_month = ($fee5_feegeneration - $fee5_unpaid_month);
			$fee6_paid_month = ($fee6_feegeneration - $fee6_unpaid_month);
			$fee7_paid_month = ($fee7_feegeneration - $fee7_unpaid_month);
			$fee8_paid_month = ($fee8_feegeneration - $fee8_unpaid_month);
			$fee9_paid_month = ($fee9_feegeneration - $fee9_unpaid_month);
			$fee10_paid_month = ($fee10_feegeneration - $fee10_unpaid_month);
			$fee11_paid_month = ($fee11_feegeneration - $fee11_unpaid_month);
			$fee12_paid_month = ($fee12_feegeneration - $fee12_unpaid_month);
			$fee13_paid_month = ($fee13_feegeneration - $fee13_unpaid_month);
			$fee14_paid_month = ($fee14_feegeneration - $fee14_unpaid_month);
			$fee15_paid_month = ($fee15_feegeneration - $fee15_unpaid_month);
			$fee16_paid_month = ($fee16_feegeneration - $fee16_unpaid_month);
			$fee17_paid_month = ($fee17_feegeneration - $fee17_unpaid_month);
			$fee18_paid_month = ($fee18_feegeneration - $fee18_unpaid_month);
			$fee19_paid_month = ($fee19_feegeneration - $fee19_unpaid_month);
			$fee20_paid_month = ($fee20_feegeneration - $fee20_unpaid_month);
			$fee21_paid_month = ($fee21_feegeneration - $fee21_unpaid_month);
			$fee22_paid_month = ($fee22_feegeneration - $fee22_unpaid_month);
			$fee23_paid_month = ($fee23_feegeneration - $fee23_unpaid_month);
			$fee24_paid_month = ($fee24_feegeneration - $fee24_unpaid_month);
			$fee25_paid_month = ($fee25_feegeneration - $fee25_unpaid_month);

			$total_amt_fee1 = ($fee1_feegeneration - $fee1_temp_daycoll);
			$total_amt_fee2 = ($fee2_feegeneration - $fee2_temp_daycoll);
			$total_amt_fee3 = ($fee3_feegeneration - $fee3_temp_daycoll);
			$total_amt_fee4 = ($fee4_feegeneration - $fee4_temp_daycoll);
			$total_amt_fee5 = ($fee5_feegeneration - $fee5_temp_daycoll);
			$total_amt_fee6 = ($fee6_feegeneration - $fee6_temp_daycoll);
			$total_amt_fee7 = ($fee7_feegeneration - $fee7_temp_daycoll);
			$total_amt_fee8 = ($fee8_feegeneration - $fee8_temp_daycoll);
			$total_amt_fee9 = ($fee9_feegeneration - $fee9_temp_daycoll);
			$total_amt_fee10 = ($fee10_feegeneration - $fee10_temp_daycoll);
			$total_amt_fee11 = ($fee11_feegeneration - $fee11_temp_daycoll);
			$total_amt_fee12 = ($fee12_feegeneration - $fee12_temp_daycoll);
			$total_amt_fee13 = ($fee13_feegeneration - $fee13_temp_daycoll);
			$total_amt_fee14 = ($fee14_feegeneration - $fee14_temp_daycoll);
			$total_amt_fee15 = ($fee15_feegeneration - $fee15_temp_daycoll);
			$total_amt_fee16 = ($fee16_feegeneration - $fee16_temp_daycoll);
			$total_amt_fee17 = ($fee17_feegeneration - $fee17_temp_daycoll);
			$total_amt_fee18 = ($fee18_feegeneration - $fee18_temp_daycoll);
			$total_amt_fee19 = ($fee19_feegeneration - $fee19_temp_daycoll);
			$total_amt_fee20 = ($fee20_feegeneration - $fee20_temp_daycoll);
			$total_amt_fee21 = ($fee21_feegeneration - $fee21_temp_daycoll);
			$total_amt_fee22 = ($fee22_feegeneration - $fee22_temp_daycoll);
			$total_amt_fee23 = ($fee23_feegeneration - $fee23_temp_daycoll);
			$total_amt_fee24 = ($fee24_feegeneration - $fee24_temp_daycoll);
			$total_amt_fee25 = ($fee25_feegeneration - $fee25_temp_daycoll);

			$parcial_fee1 = ($fee1_paid_month - $fee1_temp_daycoll);
			$parcial_fee2 = ($fee2_paid_month - $fee2_temp_daycoll);
			$parcial_fee3 = ($fee3_paid_month - $fee3_temp_daycoll);
			$parcial_fee4 = ($fee4_paid_month - $fee4_temp_daycoll);
			$parcial_fee5 = ($fee5_paid_month - $fee5_temp_daycoll);
			$parcial_fee6 = ($fee6_paid_month - $fee6_temp_daycoll);
			$parcial_fee7 = ($fee7_paid_month - $fee7_temp_daycoll);
			$parcial_fee8 = ($fee8_paid_month - $fee8_temp_daycoll);
			$parcial_fee9 = ($fee9_paid_month - $fee9_temp_daycoll);
			$parcial_fee10 = ($fee10_paid_month - $fee10_temp_daycoll);
			$parcial_fee11 = ($fee11_paid_month - $fee11_temp_daycoll);
			$parcial_fee12 = ($fee12_paid_month - $fee12_temp_daycoll);
			$parcial_fee13 = ($fee13_paid_month - $fee13_temp_daycoll);
			$parcial_fee14 = ($fee14_paid_month - $fee14_temp_daycoll);
			$parcial_fee15 = ($fee15_paid_month - $fee15_temp_daycoll);
			$parcial_fee16 = ($fee16_paid_month - $fee16_temp_daycoll);
			$parcial_fee17 = ($fee17_paid_month - $fee17_temp_daycoll);
			$parcial_fee18 = ($fee18_paid_month - $fee18_temp_daycoll);
			$parcial_fee19 = ($fee19_paid_month - $fee19_temp_daycoll);
			$parcial_fee20 = ($fee20_paid_month - $fee20_temp_daycoll);
			$parcial_fee21 = ($fee21_paid_month - $fee21_temp_daycoll);
			$parcial_fee22 = ($fee22_paid_month - $fee22_temp_daycoll);
			$parcial_fee23 = ($fee23_paid_month - $fee23_temp_daycoll);
			$parcial_fee24 = ($fee24_paid_month - $fee24_temp_daycoll);
			$parcial_fee25 = ($fee25_paid_month - $fee25_temp_daycoll);

			if ($parcial_fee1 > 0) {
				$parcial_dues_total += $parcial_fee1;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee2 > 0) {
				$parcial_dues_total += $parcial_fee2;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee3 > 0) {
				$parcial_dues_total += $parcial_fee3;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee4 > 0) {
				$parcial_dues_total += $parcial_fee4;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee5 > 0) {
				$parcial_dues_total += $parcial_fee5;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee6 > 0) {
				$parcial_dues_total += $parcial_fee6;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee7 > 0) {
				$parcial_dues_total += $parcial_fee7;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee8 > 0) {
				$parcial_dues_total += $parcial_fee8;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee9 > 0) {
				$parcial_dues_total += $parcial_fee9;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee10 > 0) {
				$parcial_dues_total += $parcial_fee10;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee11 > 0) {
				$parcial_dues_total += $parcial_fee11;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee12 > 0) {
				$parcial_dues_total += $parcial_fee12;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee13 > 0) {
				$parcial_dues_total += $parcial_fee13;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee14 > 0) {
				$parcial_dues_total += $parcial_fee14;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee15 > 0) {
				$parcial_dues_total += $parcial_fee15;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee16 > 0) {
				$parcial_dues_total += $parcial_fee16;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee17 > 0) {
				$parcial_dues_total += $parcial_fee17;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee18 > 0) {
				$parcial_dues_total += $parcial_fee18;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee19 > 0) {
				$parcial_dues_total += $parcial_fee19;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee20 > 0) {
				$parcial_dues_total += $parcial_fee20;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee21 > 0) {
				$parcial_dues_total += $parcial_fee21;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee22 > 0) {
				$parcial_dues_total += $parcial_fee22;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee23 > 0) {
				$parcial_dues_total += $parcial_fee23;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee24 > 0) {
				$parcial_dues_total += $parcial_fee24;
			} else {
				$parcial_dues_total += 0;
			}
			if ($parcial_fee25 > 0) {
				$parcial_dues_total += $parcial_fee25;
			} else {
				$parcial_dues_total += 0;
			}

			if ($total_amt_fee1 > 0) {
				$current_year += $total_amt_fee1;
				$fee_headwise1 = $total_amt_fee1;
			} else {
				$current_year += 0;
				$fee_headwise1 = 0;
			}
			if ($total_amt_fee2 > 0) {
				$current_year += $total_amt_fee2;
				$fee_headwise2 = $total_amt_fee2;
			} else {
				$current_year += 0;
				$fee_headwise2 = 0;
			}
			if ($total_amt_fee3 > 0) {
				$current_year += $total_amt_fee3;
				$fee_headwise3 = $total_amt_fee3;
			} else {
				$current_year += 0;
				$fee_headwise3 = 0;
			}
			if ($total_amt_fee4 > 0) {
				$current_year += $total_amt_fee4;
				$fee_headwise4 = $total_amt_fee4;
			} else {
				$current_year += 0;
				$fee_headwise4 = 0;
			}
			if ($total_amt_fee5 > 0) {
				$current_year += $total_amt_fee5;
				$fee_headwise5 = $total_amt_fee5;
			} else {
				$current_year += 0;
				$fee_headwise5 = 0;
			}
			if ($total_amt_fee6 > 0) {
				$current_year += $total_amt_fee6;
				$fee_headwise6 = $total_amt_fee6;
			} else {
				$current_year += 0;
				$fee_headwise6 = 0;
			}
			if ($total_amt_fee7 > 0) {
				$current_year += $total_amt_fee7;
				$fee_headwise7 = $total_amt_fee7;
			} else {
				$current_year += 0;
				$fee_headwise7 = 0;
			}
			if ($total_amt_fee8 > 0) {
				$current_year += $total_amt_fee8;
				$fee_headwise8 = $total_amt_fee8;
			} else {
				$current_year += 0;
				$fee_headwise8 = 0;
			}
			if ($total_amt_fee9 > 0) {
				$current_year += $total_amt_fee9;
				$fee_headwise9 = $total_amt_fee9;
			} else {
				$current_year += 0;
				$fee_headwise9 = 0;
			}
			if ($total_amt_fee10 > 0) {
				$current_year += $total_amt_fee10;
				$fee_headwise10 = $total_amt_fee10;
			} else {
				$current_year += 0;
				$fee_headwise10 = 0;
			}
			if ($total_amt_fee11 > 0) {
				$current_year += $total_amt_fee11;
				$fee_headwise11 = $total_amt_fee11;
			} else {
				$current_year += 0;
				$fee_headwise11 = 0;
			}
			if ($total_amt_fee12 > 0) {
				$current_year += $total_amt_fee12;
				$fee_headwise12 = $total_amt_fee12;
			} else {
				$current_year += 0;
				$fee_headwise12 = 0;
			}
			if ($total_amt_fee13 > 0) {
				$current_year += $total_amt_fee13;
				$fee_headwise13 = $total_amt_fee13;
			} else {
				$current_year += 0;
				$fee_headwise13 = 0;
			}
			if ($total_amt_fee14 > 0) {
				$current_year += $total_amt_fee14;
				$fee_headwise14 = $total_amt_fee14;
			} else {
				$current_year += 0;
				$fee_headwise14 = 0;
			}
			if ($total_amt_fee15 > 0) {
				$current_year += $total_amt_fee15;
				$fee_headwise15 = $total_amt_fee15;
			} else {
				$current_year += 0;
				$fee_headwise15 = 0;
			}
			if ($total_amt_fee16 > 0) {
				$current_year += $total_amt_fee16;
				$fee_headwise16 = $total_amt_fee16;
			} else {
				$current_year += 0;
				$fee_headwise16 = 0;
			}
			if ($total_amt_fee17 > 0) {
				$current_year += $total_amt_fee17;
				$fee_headwise17 = $total_amt_fee17;
			} else {
				$current_year += 0;
				$fee_headwise17 = 0;
			}
			if ($total_amt_fee18 > 0) {
				$current_year += $total_amt_fee18;
				$fee_headwise18 = $total_amt_fee18;
			} else {
				$current_year += 0;
				$fee_headwise18 = 0;
			}
			if ($total_amt_fee19 > 0) {
				$current_year += $total_amt_fee19;
				$fee_headwise19 = $total_amt_fee19;
			} else {
				$current_year += 0;
				$fee_headwise19 = 0;
			}
			if ($total_amt_fee20 > 0) {
				$current_year += $total_amt_fee20;
				$fee_headwise20 = $total_amt_fee20;
			} else {
				$current_year += 0;
				$fee_headwise20 = 0;
			}
			if ($total_amt_fee21 > 0) {
				$current_year += $total_amt_fee21;
				$fee_headwise21 = $total_amt_fee21;
			} else {
				$current_year += 0;
				$fee_headwise21 = 0;
			}
			if ($total_amt_fee22 > 0) {
				$current_year += $total_amt_fee22;
				$fee_headwise22 = $total_amt_fee22;
			} else {
				$current_year += 0;
				$fee_headwise22 = 0;
			}
			if ($total_amt_fee23 > 0) {
				$current_year += $total_amt_fee23;
				$fee_headwise23 = $total_amt_fee23;
			} else {
				$current_year += 0;
				$fee_headwise23 = 0;
			}
			if ($total_amt_fee24 > 0) {
				$current_year += $total_amt_fee24;
				$fee_headwise24 = $total_amt_fee24;
			} else {
				$current_year += 0;
				$fee_headwise24 = 0;
			}
			if ($total_amt_fee25 > 0) {
				$current_year += $total_amt_fee25;
				$fee_headwise25 = $total_amt_fee25;
			} else {
				$current_year += 0;
				$fee_headwise25 = 0;
			}
			$total_defaulter = ($current_year + $pre_data1);
			if ($pre_data1 > 0 || $current_year > 0 || $parcial_dues_total > 0) {
				if ($pre_data1 > 0) {
					$PRE_DUES = 'PRE,';
					if ($current_year > 0) {
						$mon = $month_print;
						if ($parcial_dues_total > 0) {
							$par = "PAR";
							$month_upto = $PRE_DUES . $mon . $par;
							$result['data'][] = array(
								$c,
								$student[$i]->FIRST_NM,
								$student[$i]->ADM_NO,
								$student[$i]->ROLL_NO,
								$class_sec,
								$month_upto,
								$pre_data1,
								$current_year,
								$fee_headwise1,
								$fee_headwise2,
								$fee_headwise3,
								$fee_headwise4,
								$fee_headwise5,
								$fee_headwise6,
								$fee_headwise7,
								$fee_headwise8,
								$fee_headwise9,
								$fee_headwise10,
								$fee_headwise11,
								$fee_headwise12,
								$fee_headwise13,
								$fee_headwise14,
								$fee_headwise15,
								$fee_headwise16,
								$fee_headwise17,
								$fee_headwise18,
								$fee_headwise19,
								$fee_headwise20,
								$fee_headwise21,
								$fee_headwise22,
								$fee_headwise23,
								$fee_headwise24,
								$fee_headwise25,
								$total_defaulter
							);
						} else {
							$par = "";
							$month_upto = $PRE_DUES . $mon . $par;
							$result['data'][] = array(
								$c,
								$student[$i]->FIRST_NM,
								$student[$i]->ADM_NO,
								$student[$i]->ROLL_NO,
								$class_sec,
								$month_upto,
								$pre_data1,
								$current_year,
								$fee_headwise1,
								$fee_headwise2,
								$fee_headwise3,
								$fee_headwise4,
								$fee_headwise5,
								$fee_headwise6,
								$fee_headwise7,
								$fee_headwise8,
								$fee_headwise9,
								$fee_headwise10,
								$fee_headwise11,
								$fee_headwise12,
								$fee_headwise13,
								$fee_headwise14,
								$fee_headwise15,
								$fee_headwise16,
								$fee_headwise17,
								$fee_headwise18,
								$fee_headwise19,
								$fee_headwise20,
								$fee_headwise21,
								$fee_headwise22,
								$fee_headwise23,
								$fee_headwise24,
								$fee_headwise25,
								$total_defaulter
							);
						}
					} else {
						$mon = "";
						if ($parcial_dues_total > 0) {
							$par = "PAR";
							$month_upto = $PRE_DUES . $mon . $par;
							$result['data'][] = array(
								$c,
								$student[$i]->FIRST_NM,
								$student[$i]->ADM_NO,
								$student[$i]->ROLL_NO,
								$class_sec,
								$month_upto,
								$pre_data1,
								$current_year,
								$fee_headwise1,
								$fee_headwise2,
								$fee_headwise3,
								$fee_headwise4,
								$fee_headwise5,
								$fee_headwise6,
								$fee_headwise7,
								$fee_headwise8,
								$fee_headwise9,
								$fee_headwise10,
								$fee_headwise11,
								$fee_headwise12,
								$fee_headwise13,
								$fee_headwise14,
								$fee_headwise15,
								$fee_headwise16,
								$fee_headwise17,
								$fee_headwise18,
								$fee_headwise19,
								$fee_headwise20,
								$fee_headwise21,
								$fee_headwise22,
								$fee_headwise23,
								$fee_headwise24,
								$fee_headwise25,
								$total_defaulter
							);
						} else {
							$par = "";
							$month_upto = $PRE_DUES . $mon . $par;
							$result['data'][] = array(
								$c,
								$student[$i]->FIRST_NM,
								$student[$i]->ADM_NO,
								$student[$i]->ROLL_NO,
								$class_sec,
								$month_upto,
								$pre_data1,
								$current_year,
								$fee_headwise1,
								$fee_headwise2,
								$fee_headwise3,
								$fee_headwise4,
								$fee_headwise5,
								$fee_headwise6,
								$fee_headwise7,
								$fee_headwise8,
								$fee_headwise9,
								$fee_headwise10,
								$fee_headwise11,
								$fee_headwise12,
								$fee_headwise13,
								$fee_headwise14,
								$fee_headwise15,
								$fee_headwise16,
								$fee_headwise17,
								$fee_headwise18,
								$fee_headwise19,
								$fee_headwise20,
								$fee_headwise21,
								$fee_headwise22,
								$fee_headwise23,
								$fee_headwise24,
								$fee_headwise25,
								$total_defaulter
							);
						}
					}
				} else {
					$PRE_DUES = "";
					if ($current_year > 0) {
						$mon = $month_print;
						if ($parcial_dues_total > 0) {
							$par = "PAR";
							$month_upto = $PRE_DUES . $mon . $par;
							$result['data'][] = array(
								$c,
								$student[$i]->FIRST_NM,
								$student[$i]->ADM_NO,
								$student[$i]->ROLL_NO,
								$class_sec,
								$month_upto,
								$pre_data1,
								$current_year,
								$fee_headwise1,
								$fee_headwise2,
								$fee_headwise3,
								$fee_headwise4,
								$fee_headwise5,
								$fee_headwise6,
								$fee_headwise7,
								$fee_headwise8,
								$fee_headwise9,
								$fee_headwise10,
								$fee_headwise11,
								$fee_headwise12,
								$fee_headwise13,
								$fee_headwise14,
								$fee_headwise15,
								$fee_headwise16,
								$fee_headwise17,
								$fee_headwise18,
								$fee_headwise19,
								$fee_headwise20,
								$fee_headwise21,
								$fee_headwise22,
								$fee_headwise23,
								$fee_headwise24,
								$fee_headwise25,
								$total_defaulter
							);
						} else {
							$par = "";
							$month_upto = $PRE_DUES . $mon . $par;
							$result['data'][] = array(
								$c,
								$student[$i]->FIRST_NM,
								$student[$i]->ADM_NO,
								$student[$i]->ROLL_NO,
								$class_sec,
								$month_upto,
								$pre_data1,
								$current_year,
								$fee_headwise1,
								$fee_headwise2,
								$fee_headwise3,
								$fee_headwise4,
								$fee_headwise5,
								$fee_headwise6,
								$fee_headwise7,
								$fee_headwise8,
								$fee_headwise9,
								$fee_headwise10,
								$fee_headwise11,
								$fee_headwise12,
								$fee_headwise13,
								$fee_headwise14,
								$fee_headwise15,
								$fee_headwise16,
								$fee_headwise17,
								$fee_headwise18,
								$fee_headwise19,
								$fee_headwise20,
								$fee_headwise21,
								$fee_headwise22,
								$fee_headwise23,
								$fee_headwise24,
								$fee_headwise25,
								$total_defaulter
							);
						}
					} else {
						$mon = "";
						if ($parcial_dues_total > 0) {
							$par = "PAR";
							$month_upto = $PRE_DUES . $mon . $par;
							$result['data'][] = array(
								$c,
								$student[$i]->FIRST_NM,
								$student[$i]->ADM_NO,
								$student[$i]->ROLL_NO,
								$class_sec,
								$month_upto,
								$pre_data1,
								$current_year,
								$fee_headwise1,
								$fee_headwise2,
								$fee_headwise3,
								$fee_headwise4,
								$fee_headwise5,
								$fee_headwise6,
								$fee_headwise7,
								$fee_headwise8,
								$fee_headwise9,
								$fee_headwise10,
								$fee_headwise11,
								$fee_headwise12,
								$fee_headwise13,
								$fee_headwise14,
								$fee_headwise15,
								$fee_headwise16,
								$fee_headwise17,
								$fee_headwise18,
								$fee_headwise19,
								$fee_headwise20,
								$fee_headwise21,
								$fee_headwise22,
								$fee_headwise23,
								$fee_headwise24,
								$fee_headwise25,
								$total_defaulter
							);
						} else {
							$par = "";
							$month_upto = $PRE_DUES . $mon . $par;
							$result['data'][] = array(
								$c,
								$student[$i]->FIRST_NM,
								$student[$i]->ADM_NO,
								$student[$i]->ROLL_NO,
								$class_sec,
								$month_upto,
								$pre_data1,
								$current_year,
								$fee_headwise1,
								$fee_headwise2,
								$fee_headwise3,
								$fee_headwise4,
								$fee_headwise5,
								$fee_headwise6,
								$fee_headwise7,
								$fee_headwise8,
								$fee_headwise9,
								$fee_headwise10,
								$fee_headwise11,
								$fee_headwise12,
								$fee_headwise13,
								$fee_headwise14,
								$fee_headwise15,
								$fee_headwise16,
								$fee_headwise17,
								$fee_headwise18,
								$fee_headwise19,
								$fee_headwise20,
								$fee_headwise21,
								$fee_headwise22,
								$fee_headwise23,
								$fee_headwise24,
								$fee_headwise25,
								$total_defaulter
							);
						}
					}
				}
				$c++;
			}
			// end of the showing student data //

		}
		$School_setting = $this->dbcon->select('school_setting', '*');
		$result['School_setting'] = $School_setting;
		// echo "<pre>";
		// print_r($result);
		// die;
		$this->load->view("Reports/defaulter_classHeadWisePDF", $result);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("Head_Wise_Summary_Report.pdf", array("Attachment" => 0));
	}
	public function defaulter_allclasswise_()
	{
		$viewupto = $this->input->post('viewupto');
		//echo $viewupto;die;
		$classs = $this->input->post('classs');
		$sec = $this->input->post('sec');
			if($viewupto=='JUN'){
			$viewupto_n ="JUNE_FEE";
			
			}else if($viewupto=='JUL'){
				$viewupto_n="JULY_FEE";
			}else{
			$viewupto_n=$viewupto."_FEE";
			}
		$student = $this->db->query("select ADM_NO,FIRST_NM,ROLL_NO,APR_FEE,MAY_FEE,JUNE_FEE,JULY_FEE,AUG_FEE,SEP_FEE,OCT_FEE,NOV_FEE,DEC_FEE,JAN_FEE,FEB_FEE,MAR_FEE,DISP_CLASS,DISP_SEC,ifnull((Select sum(total) from previous_year_feegeneration where adm_no=st.ADM_NO),0) as previous_dues from student as st where student_status='ACTIVE' AND $viewupto_n IN ('N/A','NULL','') order by class,sec,first_Nm asc")->result();
		
		//$student = $this->db->query("Select ADM_NO,FIRST_NM,ROLL_NO,APR_FEE,MAY_FEE,JUNE_FEE,JULY_FEE,AUG_FEE,SEP_FEE,OCT_FEE,NOV_FEE,DEC_FEE,JAN_FEE,FEB_FEE,MAR_FEE,DISP_CLASS,DISP_SEC from student where student_status='ACTIVE' and disp_Sec not in ('K','DT','RT','TC','Z')  order by class,sec,first_Nm asc")->result();
		
		$feehead = $this->db->query("select FEE_HEAD from feehead order by ACT_CODE asc")->result();
		
		$student_cnt = count($student);
		
		if($viewupto=='APR')
		{
			$monthin_n ="'APR'";
			$monthin =array('APR');
			$loop_cnt = 1;
		}
		elseif($viewupto=='MAY')
		{
			$monthin_n = "'APR','MAY'";
			$monthin = array('APR','MAY');
			$loop_cnt = 2;
		}
		elseif($viewupto=='JUN')
		{
			$monthin_n = "'APR','MAY','JUN'";
			$monthin = array('APR','MAY','JUN');
			$loop_cnt = 3;
		}
		elseif($viewupto=='JUL')
		{
			$monthin_n ="'APR','MAY','JUN','JUL'";
			$monthin =array('APR','MAY','JUN','JUL');
			$loop_cnt = 4;
		}
		elseif($viewupto=='AUG')
		{
			$monthin_n = "'APR','MAY','JUN','JUL','AUG'";
			$monthin = array('APR','MAY','JUN','JUL','AUG');
			$loop_cnt = 5;
		}
		elseif($viewupto=='SEP')
		{
			$monthin_n = "'APR','MAY','JUN','JUL','AUG','SEP'";
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP');
			$loop_cnt = 6;
		}
		elseif($viewupto=='OCT')
		{
			$monthin_n = "'APR','MAY','JUN','JUL','AUG','SEP','OCT'";
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT');
			$loop_cnt = 7;
		}
		elseif($viewupto=='NOV')
		{
			$monthin_n = "'APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV'";
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV');
			$loop_cnt = 8;
		}
		elseif($viewupto=='DEC')
		{
			$monthin_n = "'APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'";
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC');
			$loop_cnt = 9;
		}
		elseif($viewupto=='JAN')
		{
			$monthin_n = "'APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','JAN'";
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','JAN');
			$loop_cnt = 10;
		}
		elseif($viewupto=='FEB')
		{
			$monthin_n = "'APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','JAN','FEB'";
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','JAN','FEB');
			$loop_cnt = 11;
		}
		elseif($viewupto=='MAR')
		{
			$monthin_n ="'APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','JAN','FEB','MAR'";
			$monthin =array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','JAN','FEB','MAR');
			$loop_cnt = 12;
		}
		else{
			
		}
		
		 ?>
		
		<table class='table table-bordered' id='example'>
		  <thead>
			  <tr>
	          <th style="background: #337ab7; color: white !important;font-size:14px !important">Sl. No.</th>
	          <th style="background: #337ab7; color: white !important;font-size:14px !important">NAME</th>
	          <th style="background: #337ab7; color: white !important;font-size:14px !important">ADM. No.</th>
	          <th style="background: #337ab7; color: white !important;font-size:14px !important">ROLL No.</th>
			  <th style="background: #337ab7; color: white !important;font-size:14px !important">Class/Sec</th>
			  <th style="background: #337ab7; color: white !important;font-size:14px !important">MONTH UPTO</th>
	          <th style="background: #337ab7; color: white !important;font-size:14px !important">PREVIOUS YEAR DUES</th>
	         <th style="background: #337ab7; color: white !important;font-size:14px !important">CURRENT YEAR DUES</th>
			 <?php
			    foreach($feehead as $key => $value)
				{
					$fee_heads = $value->FEE_HEAD;
					?>
					<th style="background: #337ab7; color: white !important;font-size:14px !important"><?php echo $fee_heads; ?></th>
					<?php
				}
			 ?>
			 
	         <th style="background: #337ab7; color: white !important;">TOTAL AMOUNT</th>
			 
	        </tr>
		  </thead>
	  <tbody>
	 
	  <?php
	   $month_print = '';
	   $str_month = '';
	   $mon = '';
	   $total_amount = 0;
	   $unpaid_mnth = 0;
	   $previous_duess = 0;
	   $grand_tot=0;
	   $grand_tot_prev=0;
	   $grand_tot_currnt=0;
	   $grand_tot_currnt_f=0;
	   $grand_tot_fee1 =0;
	   $grand_tot_fee2 =0;
	   $grand_tot_fee3 =0;
	   $grand_tot_fee4 =0;
	   $grand_tot_fee5 =0;
	   $grand_tot_fee6 =0;
	   $grand_tot_fee7 =0;
	   $grand_tot_fee8 =0;
	   $grand_tot_fee9 =0;
	   $grand_tot_fee10 =0;
	   $grand_tot_fee11 =0;
	   $grand_tot_fee12 =0;
	   $grand_tot_fee13 =0;
	   $grand_tot_fee14 =0;
	   $grand_tot_fee15 =0;
	   $grand_tot_fee16 =0;
	   $grand_tot_fee17 =0;
	   $grand_tot_fee18 =0;
	   $grand_tot_fee19 =0;
	   $grand_tot_fee20 =0;
	   $grand_tot_fee21 =0;
	   $grand_tot_fee22 =0;
	   $grand_tot_fee23 =0;
	   $grand_tot_fee24 =0;
	   $grand_tot_fee25 =0;
	   
	   $c=1;
	   $pre=0;
		//echo $student_cnt;die;
	    for($i=0;$i<$student_cnt;$i++)
		{
			$str_month = '';
			$month_print = '';
			$adm_no = $student[$i]->ADM_NO;
				$apr_chk=$student[$i]->APR_FEE;
		
		$p=substr($apr_chk,0,1);
			 
		if($p =='P'){
		$daycollsum = $this->farheen->select('daycoll','sum(TOTAL)total,sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25',"ADM_NO='$adm_no'");
		$Temp_daycollsum = $this->farheen->select('temp_daycoll','sum(TOTAL)total,sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25',"ADM_NO='$adm_no'");
					
			 $DAYCOfee1=(int)$daycollsum[0]->Fee1+(int)$Temp_daycollsum[0]->Fee1;
			 $DAYCOfee2=(int)$daycollsum[0]->Fee2+(int)$Temp_daycollsum[0]->Fee2;
			 $DAYCOfee3=(int)$daycollsum[0]->Fee3+(int)$Temp_daycollsum[0]->Fee3;
			 $DAYCOfee4=(int)$daycollsum[0]->Fee4+(int)$Temp_daycollsum[0]->Fee4;
			 $DAYCOfee5=(int)$daycollsum[0]->Fee5+(int)$Temp_daycollsum[0]->Fee5;
			 $DAYCOfee6=(int)$daycollsum[0]->Fee6+(int)$Temp_daycollsum[0]->Fee6;
			 $DAYCOfee7=(int)$daycollsum[0]->Fee7+(int)$Temp_daycollsum[0]->Fee7;
			 $DAYCOfee8=(int)$daycollsum[0]->Fee8+(int)$Temp_daycollsum[0]->Fee8;
			 $DAYCOfee9=(int)$daycollsum[0]->Fee9+(int)$Temp_daycollsum[0]->Fee9;
			 $DAYCOfee10=(int)$daycollsum[0]->Fee10+(int)$Temp_daycollsum[0]->Fee10;
			 $DAYCOfee11=(int)$daycollsum[0]->Fee11+(int)$Temp_daycollsum[0]->Fee11;
			 $DAYCOfee12=(int)$daycollsum[0]->Fee12+(int)$Temp_daycollsum[0]->Fee12;
			 $DAYCOfee13=(int)$daycollsum[0]->Fee13+(int)$Temp_daycollsum[0]->Fee13;
			 $DAYCOfee14=(int)$daycollsum[0]->Fee14+(int)$Temp_daycollsum[0]->Fee14;
			 $DAYCOfee15=(int)$daycollsum[0]->Fee15+(int)$Temp_daycollsum[0]->Fee15;
			 $DAYCOfee16=(int)$daycollsum[0]->Fee16+(int)$Temp_daycollsum[0]->Fee16;
			 $DAYCOfee17=(int)$daycollsum[0]->Fee17+(int)$Temp_daycollsum[0]->Fee17;
			 $DAYCOfee18=(int)$daycollsum[0]->Fee18+(int)$Temp_daycollsum[0]->Fee18;
			 $DAYCOfee19=(int)$daycollsum[0]->Fee19+(int)$Temp_daycollsum[0]->Fee19;
			 $DAYCOfee20=(int)$daycollsum[0]->Fee20+(int)$Temp_daycollsum[0]->Fee20;
			 $DAYCOfee21=(int)$daycollsum[0]->Fee21+(int)$Temp_daycollsum[0]->Fee21;
			 $DAYCOfee22=(int)$daycollsum[0]->Fee22+(int)$Temp_daycollsum[0]->Fee22;
			 $DAYCOfee23=(int)$daycollsum[0]->Fee23+(int)$Temp_daycollsum[0]->Fee23;
			 $DAYCOfee24=(int)$daycollsum[0]->Fee24+(int)$Temp_daycollsum[0]->Fee24;
			 $DAYCOfee25=(int)$daycollsum[0]->Fee25+(int)$Temp_daycollsum[0]->Fee25;
			
		}else{
			
			 $daycollsum = $this->farheen->select('daycoll','sum(TOTAL)total,sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25',"ADM_NO='$adm_no'");
		     $pre_total=$daycollsum[0]->total;
			 $DAYCOfee1=$daycollsum[0]->Fee1;
			 $DAYCOfee2=$daycollsum[0]->Fee2;
			 $DAYCOfee3=$daycollsum[0]->Fee3;
			 $DAYCOfee4=$daycollsum[0]->Fee4;
			 $DAYCOfee5=$daycollsum[0]->Fee5;
			 $DAYCOfee6=$daycollsum[0]->Fee6;
			 $DAYCOfee7=$daycollsum[0]->Fee7;
			 $DAYCOfee8=$daycollsum[0]->Fee8;
			 $DAYCOfee9=$daycollsum[0]->Fee9;
			 $DAYCOfee10=$daycollsum[0]->Fee10;
			 $DAYCOfee11=$daycollsum[0]->Fee11;
			 $DAYCOfee12=$daycollsum[0]->Fee12;
			 $DAYCOfee13=$daycollsum[0]->Fee13;
			 $DAYCOfee14=$daycollsum[0]->Fee14;
			 $DAYCOfee15=$daycollsum[0]->Fee15;
			 $DAYCOfee16=$daycollsum[0]->Fee16;
			 $DAYCOfee17=$daycollsum[0]->Fee17;
			 $DAYCOfee18=$daycollsum[0]->Fee18;
			 $DAYCOfee19=$daycollsum[0]->Fee19;
			 $DAYCOfee20=$daycollsum[0]->Fee20;
			 $DAYCOfee21=$daycollsum[0]->Fee21;
			 $DAYCOfee22=$daycollsum[0]->Fee22;
			 $DAYCOfee23=$daycollsum[0]->Fee23;
			 $DAYCOfee24=$daycollsum[0]->Fee24;
			 $DAYCOfee25=$daycollsum[0]->Fee25;
		}
		$unpaid_month = $this->farheen->select('feegeneration','sum(TOTAL)total,sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25',"ADM_NO='$adm_no' AND Month_NM IN ($monthin_n)");
		     $fee_gen_total= $unpaid_month[0]->total;
			 
		     $FEEGENfee[]=(int)$unpaid_month[0]->Fee1-(int)$DAYCOfee1;
			 $FEEGENfee[]=(int)$unpaid_month[0]->Fee2-(int)$DAYCOfee2;
			 $FEEGENfee[]=(int)$unpaid_month[0]->Fee3-(int)$DAYCOfee3;
			 $FEEGENfee[]=(int)$unpaid_month[0]->Fee4-(int)$DAYCOfee4;
			 $FEEGENfee[]=(int)$unpaid_month[0]->Fee5-(int)$DAYCOfee5;
			 $FEEGENfee[]=(int)$unpaid_month[0]->Fee6-(int)$DAYCOfee6;
			 $FEEGENfee[]=(int)$unpaid_month[0]->Fee7-(int)$DAYCOfee7;
			 $FEEGENfee[]=(int)$unpaid_month[0]->Fee8-(int)$DAYCOfee8;
			 $FEEGENfee[]=(int)$unpaid_month[0]->Fee9-(int)$DAYCOfee9;
			 $FEEGENfee[]=(int)$unpaid_month[0]->Fee10-(int)$DAYCOfee10;
			 $FEEGENfee[]=(int)$unpaid_month[0]->Fee11-(int)$DAYCOfee11;
			 $FEEGENfee[]=(int)$unpaid_month[0]->Fee12-(int)$DAYCOfee12;
			 $FEEGENfee[]=(int)$unpaid_month[0]->Fee13-(int)$DAYCOfee13;
			 $FEEGENfee[]=(int)$unpaid_month[0]->Fee14-(int)$DAYCOfee14;
			 $FEEGENfee[]=(int)$unpaid_month[0]->Fee15-(int)$DAYCOfee15;
			 $FEEGENfee[]=(int)$unpaid_month[0]->Fee16-(int)$DAYCOfee16;
			 $FEEGENfee[]=(int)$unpaid_month[0]->Fee17-(int)$DAYCOfee17;
			 $FEEGENfee[]=(int)$unpaid_month[0]->Fee18-(int)$DAYCOfee18;
			 $FEEGENfee[]=(int)$unpaid_month[0]->Fee19-(int)$DAYCOfee19;
			 $FEEGENfee[]=(int)$unpaid_month[0]->Fee20-(int)$DAYCOfee20;
			 $FEEGENfee[]=(int)$unpaid_month[0]->Fee21-(int)$DAYCOfee21;
			 $FEEGENfee[]=(int)$unpaid_month[0]->Fee22-(int)$DAYCOfee22;
			 $FEEGENfee[]=(int)$unpaid_month[0]->Fee23-(int)$DAYCOfee23;
			 $FEEGENfee[]=(int)$unpaid_month[0]->Fee24-(int)$DAYCOfee24;
			 $FEEGENfee[]=(int)$unpaid_month[0]->Fee25-(int)$DAYCOfee25;
			
			
			 $TOTAL_P=0;
			 foreach($FEEGENfee as $vall){
			 if($vall >= 0){
				$FEEGENfee_f[]=$vall;
				$TOTAL_P =$TOTAL_P+(int)$vall; 
				
			 }
			 else{
				 $FEEGENfee_f[]=0;
				continue ;
				} 	 
			 }
			 $class_sec = $student[$i]->DISP_CLASS ."-".$student[$i]->DISP_SEC;
			    $MON_FEE[0] = $student[$i]->APR_FEE;
				$MON_FEE[1] = $student[$i]->MAY_FEE;
				$MON_FEE[2] = $student[$i]->JUNE_FEE;
				$MON_FEE[3] = $student[$i]->JULY_FEE;
				$MON_FEE[4] = $student[$i]->AUG_FEE;
				$MON_FEE[5] = $student[$i]->SEP_FEE;
				$MON_FEE[6] = $student[$i]->OCT_FEE;
				$MON_FEE[7] = $student[$i]->NOV_FEE;
				$MON_FEE[8] = $student[$i]->DEC_FEE;
				$MON_FEE[9] = $student[$i]->JAN_FEE;
				$MON_FEE[10] = $student[$i]->FEB_FEE;
				$MON_FEE[11] = $student[$i]->MAR_FEE;
				@$previous_duess = $student[$i]->previous_dues;
					
		        for($l=0;$l<$loop_cnt;$l++)
				{
					if($MON_FEE[$l]=='N/A' OR  $MON_FEE[$l]=='')
					{
						$month_print.= $monthin[$l].',';
						if($str_month!=''){
						  $str_month = $str_month.",'". $monthin[$l]."'";
							
						}else{
							$str_month ="'".$monthin[$l]."'";
						}
					}
					
				}
				//if(!empty($str_month))
				//{
					//$unpaid_month = $this->farheen->select('feegeneration','sum(TOTAL)total,sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25',"ADM_NO='$adm_no' AND Month_NM in($str_month)");
					//$unpaid_mnth = $unpaid_month[0]->total;
					
				//}
				
					$total_amount =$student[$i]->previous_dues + $TOTAL_P; 
			
					if($TOTAL_P > 0 && $total_amount >0)
				{
				 $grand_tot_prev = $grand_tot_prev+$student[$i]->previous_dues;
                 $grand_tot_currnt=(int)$grand_tot_currnt+$TOTAL_P;
				 $grand_tot_currnt_s=$TOTAL_P+$student[$i]->previous_dues;
				 $grand_tot_currnt_f=$grand_tot_currnt_f+$grand_tot_currnt_s;
                 $grand_tot=$grand_tot+$total_amount;
				
		?>			
		   <tr>
			   <td><?php echo $c; ?></td>
			   <td><?php echo $student[$i]->FIRST_NM; ?></td>
			   <td><?php echo $student[$i]->ADM_NO; ?></td>
			   <td><?php echo $student[$i]->ROLL_NO; ?></td>
			   <td><?php echo $class_sec; ?></td>
			   <td><?php  
			   if($previous_duess>0)
			   {
				   $mntt = 'PREV.DUES'.','.$month_print;
				   $month_upto = rtrim($mntt,',');
				   echo $month_upto;
			   }
			   else{
				   $month_upto = rtrim($month_print,',');
				   echo $month_upto;
			   }
			  
			   ?></td>
			   <td>
			   <?php
			    echo $student[$i]->previous_dues;
		       ?>
			   </td>
			 <td><?php echo $TOTAL_P; ?></td>
			  <td><?php echo $FEEGENfee_f[0] ;?></td>
			  <td><?php echo $FEEGENfee_f[1] ;?></td>
			  <td><?php echo $FEEGENfee_f[2] ;?></td>
			  <td><?php echo $FEEGENfee_f[3] ;?></td>
			  <td><?php echo $FEEGENfee_f[4] ;?></td>
			  <td><?php echo $FEEGENfee_f[5] ;?></td>
			  <td><?php echo $FEEGENfee_f[6] ;?></td>
			  <td><?php echo $FEEGENfee_f[7] ;?></td>
			  <td><?php echo $FEEGENfee_f[8] ;?></td>
			  <td><?php echo $FEEGENfee_f[9] ;?></td>
			  <td><?php echo $FEEGENfee_f[10];?></td>
			  <td><?php echo $FEEGENfee_f[11];?></td>
			  <td><?php echo $FEEGENfee_f[12];?></td>
			  <td><?php echo $FEEGENfee_f[13];?></td>
			  <td><?php echo $FEEGENfee_f[14];?></td>
			  <td><?php echo $FEEGENfee_f[15];?></td>
			  <td><?php echo $FEEGENfee_f[16];?></td>
			  <td><?php echo $FEEGENfee_f[17];?></td>
			  <td><?php echo $FEEGENfee_f[18];?></td>
			  <td><?php echo $FEEGENfee_f[19];?></td>
			  <td><?php echo $FEEGENfee_f[20];?></td>
			  <td><?php echo $FEEGENfee_f[21];?></td>
			  <td><?php echo $FEEGENfee_f[22];?></td>
			  <td><?php echo $FEEGENfee_f[23];?></td>
			  <td><?php echo $FEEGENfee_f[24];?></td>
			  <td><?php echo $grand_tot_currnt_s;?></td>
		  </tr>
		   <?php
		   $c++;	
		   }
             
             $total_amount = 0;
             $unpaid_mnth = 0;	
             $previous_duess = 0;	
		$grand_tot_fee1 =$grand_tot_fee1 +$FEEGENfee_f[0] ;
            $grand_tot_fee2 =$grand_tot_fee2 +$FEEGENfee_f[1] ;
            $grand_tot_fee3 =$grand_tot_fee3 +$FEEGENfee_f[2] ;
            $grand_tot_fee4 =$grand_tot_fee4 +$FEEGENfee_f[3] ;
            $grand_tot_fee5 =$grand_tot_fee5 +$FEEGENfee_f[4] ;
            $grand_tot_fee6 =$grand_tot_fee6 +$FEEGENfee_f[5] ;
            $grand_tot_fee7 =$grand_tot_fee7 +$FEEGENfee_f[6] ;
            $grand_tot_fee8 =$grand_tot_fee8 +$FEEGENfee_f[7] ;
            $grand_tot_fee9 =$grand_tot_fee9 +$FEEGENfee_f[8] ;
            $grand_tot_fee10=$grand_tot_fee10+$FEEGENfee_f[9] ;
            $grand_tot_fee11=$grand_tot_fee11+$FEEGENfee_f[10];
            $grand_tot_fee12=$grand_tot_fee12+$FEEGENfee_f[11];
            $grand_tot_fee13=$grand_tot_fee13+$FEEGENfee_f[12];
            $grand_tot_fee14=$grand_tot_fee14+$FEEGENfee_f[13];
            $grand_tot_fee15=$grand_tot_fee15+$FEEGENfee_f[14];
            $grand_tot_fee16=$grand_tot_fee16+$FEEGENfee_f[15];
            $grand_tot_fee17=$grand_tot_fee17+$FEEGENfee_f[16];
            $grand_tot_fee18=$grand_tot_fee18+$FEEGENfee_f[17];
            $grand_tot_fee19=$grand_tot_fee19+$FEEGENfee_f[18];
            $grand_tot_fee20=$grand_tot_fee20+$FEEGENfee_f[19];
            $grand_tot_fee21=$grand_tot_fee21+$FEEGENfee_f[20];
            $grand_tot_fee22=$grand_tot_fee22+$FEEGENfee_f[21];
            $grand_tot_fee23=$grand_tot_fee23+$FEEGENfee_f[22];
            $grand_tot_fee24=$grand_tot_fee24+$FEEGENfee_f[23];
			$grand_tot_fee25=$grand_tot_fee25+$FEEGENfee_f[24];
			 
		$FEEGENfee=[];			 
		$FEEGENfee_f=[];			 
	   }
	   ?>
	   </tbody>
	   <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><b style="font-size:16px;color:red;font-weight: 900;">GRAND TOTAL</b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_prev;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_currnt;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee1 ;?> </b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee2 ; ?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee3 ;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee4 ;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee5 ;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee6 ;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee7 ;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee8 ;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee9 ;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee10;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee11;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee12;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee13;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee14;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee15;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee16;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee17;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee18;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee19;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee20;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee21;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee22;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee23;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee24;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee25;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_currnt_f;?></b></td>
            </tr>
        </tfoot>
	  </table></br>
	  
	  <script>
	  $('#example').DataTable({
        dom: 'Bfrtip',
		footer: true,
        buttons: [
			 
			{
                extend: 'excelHtml5',
				title: 'All Class wise Fee Head Wise Defaulter Reports',
                
            },
			 {
                extend: 'csvHtml5',
				title: 'All Class wise Fee Head Wise Defaulter Reports',
                
            }, 
			{
                extend: 'pdfHtml5',
				title: 'All Class wise Fee Head Wise Defaulter Reports',
                
            },
			
        ]
     });
	  </script>
	  <?php
	}
}

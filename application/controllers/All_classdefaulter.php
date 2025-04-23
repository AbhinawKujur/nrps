<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class All_classdefaulter extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function defaulter_allclass()
	{
		$viewupto = $this->input->post('viewupto');
		$classs = $this->input->post('classs');
		$sec = $this->input->post('sec');
		$result = array('data'=>array());
		$student = $this->dbcon->select('student','ADM_NO,FIRST_NM,ROLL_NO,APR_FEE,MAY_FEE,JUNE_FEE,JULY_FEE,AUG_FEE,SEP_FEE,OCT_FEE,NOV_FEE,DEC_FEE,JAN_FEE,FEB_FEE,MAR_FEE,DISP_CLASS,DISP_SEC',"Student_Status='ACTIVE'");
		$session_master = $this->dbcon->select('session_master','*',"Active_Status='1'");
		$year = $session_master[0]->Session_Year;
		$sess_year = $year.'-'.'04'.'-'.'01';
		if($viewupto=='APR')
		{
			$sess_year_end = $year.'-'.'04'.'-'.'31';
			$monthin = array('APR');
			$loop_cnt = 1;
		}
		elseif($viewupto=='MAY')
		{
			$sess_year_end = $year.'-'.'05'.'-'.'31';
			$monthin = array('APR','MAY');
			$loop_cnt = 2;
		}
		elseif($viewupto=='JUN')
		{
			$sess_year_end = $year.'-'.'06'.'-'.'31';
			$monthin = array('APR','MAY','JUN');
			$loop_cnt = 3;
		}
		elseif($viewupto=='JUL')
		{
			$sess_year_end = $year.'-'.'07'.'-'.'31';
			$monthin = array('APR','MAY','JUN','JUL');
			$loop_cnt = 4;
		}
		elseif($viewupto=='AUG')
		{
			$sess_year_end = $year.'-'.'08'.'-'.'31';
			$monthin = array('APR','MAY','JUN','JUL','AUG');
			$loop_cnt = 5;
		}
		elseif($viewupto=='SEP')
		{
			$sess_year_end = $year.'-'.'09'.'-'.'31';
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP');
			$loop_cnt = 6;
		}
		elseif($viewupto=='OCT')
		{
			$sess_year_end = $year.'-'.'10'.'-'.'31';
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT');
			$loop_cnt = 7;
		}
		elseif($viewupto=='NOV')
		{
			$sess_year_end = $year.'-'.'11'.'-'.'31';
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV');
			$loop_cnt = 8;
		}
		elseif($viewupto=='DEC')
		{
			$sess_year_end = $year.'-'.'12'.'-'.'31';
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC');
			$loop_cnt = 9;
		}
		elseif($viewupto=='JAN')
		{
			$year +=1;
			$sess_year_end = $year.'-'.'01'.'-'.'31';
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','JAN');
			$loop_cnt = 10;
		}
		elseif($viewupto=='FEB')
		{
			$year +=1;
			$sess_year_end = $year.'-'.'02'.'-'.'31';
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','JAN','FEB');
			$loop_cnt = 11;
		}
		elseif($viewupto=='MAR')
		{
			$year +=1;
			$sess_year_end = $year.'-'.'03'.'-'.'31';
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','JAN','FEB','MAR');
			$loop_cnt = 12;
		}
		else{
			
		}
		$student_cnt = count($student);
		$c=1;
			for($i=0;$i<$student_cnt;$i++)
			{
				$adm_no = $student[$i]->ADM_NO;
				$class_sec = $student[$i]->DISP_CLASS ."-".$student[$i]->DISP_SEC;
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
				$pre_data = $this->dbcon->select('previous_year_feegeneration','SUM(TOTAL)TOTAL',"ADM_NO='$adm_no'");
				if(!empty($pre_data))
				{
					$pre_data1 = $pre_data[0]->TOTAL;
				}
				else{
					$pre_data1 = 0;
				}
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
				$temp_daycoll = $this->dbcon->select('temp_daycoll','sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25',"ADM_NO='adm_no' AND SEC='Z'");
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
				for($l=0;$l<$loop_cnt;$l++)
				{
					if($MON_FEE[$l]!='N/A' AND $MON_FEE[$l]!='')
					{
					}
					else
					{
						$month_print.= $monthin[$l].',';
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
					if($MON_FEE[$l] == 'FREESHIP')
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
				
				$total_amt_fee1 = ($fee1_feegeneration-$fee1_temp_daycoll);
				$total_amt_fee2 = ($fee2_feegeneration-$fee2_temp_daycoll);
				$total_amt_fee3 = ($fee3_feegeneration-$fee3_temp_daycoll);
				$total_amt_fee4 = ($fee4_feegeneration-$fee4_temp_daycoll);
				$total_amt_fee5 = ($fee5_feegeneration-$fee5_temp_daycoll);
				$total_amt_fee6 = ($fee6_feegeneration-$fee6_temp_daycoll);
				$total_amt_fee7 = ($fee7_feegeneration-$fee7_temp_daycoll);
				$total_amt_fee8 = ($fee8_feegeneration-$fee8_temp_daycoll);
				$total_amt_fee9 = ($fee9_feegeneration-$fee9_temp_daycoll);
				$total_amt_fee10 = ($fee10_feegeneration-$fee10_temp_daycoll);
				$total_amt_fee11 = ($fee11_feegeneration-$fee11_temp_daycoll);
				$total_amt_fee12 = ($fee12_feegeneration-$fee12_temp_daycoll);
				$total_amt_fee13 = ($fee13_feegeneration-$fee13_temp_daycoll);
				$total_amt_fee14 = ($fee14_feegeneration-$fee14_temp_daycoll);
				$total_amt_fee15 = ($fee15_feegeneration-$fee15_temp_daycoll);
				$total_amt_fee16 = ($fee16_feegeneration-$fee16_temp_daycoll);
				$total_amt_fee17 = ($fee17_feegeneration-$fee17_temp_daycoll);
				$total_amt_fee18 = ($fee18_feegeneration-$fee18_temp_daycoll);
				$total_amt_fee19 = ($fee19_feegeneration-$fee19_temp_daycoll);
				$total_amt_fee20 = ($fee20_feegeneration-$fee20_temp_daycoll);
				$total_amt_fee21 = ($fee21_feegeneration-$fee21_temp_daycoll);
				$total_amt_fee22 = ($fee22_feegeneration-$fee22_temp_daycoll);
				$total_amt_fee23 = ($fee23_feegeneration-$fee23_temp_daycoll);
				$total_amt_fee24 = ($fee24_feegeneration-$fee24_temp_daycoll);
				$total_amt_fee25 = ($fee25_feegeneration-$fee25_temp_daycoll);
				
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
				
				if($total_amt_fee1 > 0){
					$current_year += $total_amt_fee1;
				}else{
					$current_year += 0;
				}
				if($total_amt_fee2 > 0){
					$current_year += $total_amt_fee2;
				}else{
					$current_year += 0;
				}
				if($total_amt_fee3 > 0){
					$current_year += $total_amt_fee3;
				}else{
					$current_year += 0;
				}
				if($total_amt_fee4 > 0){
					$current_year += $total_amt_fee4;
				}else{
					$current_year += 0;
				}
				if($total_amt_fee5 > 0){
					$current_year += $total_amt_fee5;
				}else{
					$current_year += 0;
				}
				if($total_amt_fee6 > 0){
					$current_year += $total_amt_fee6;
				}else{
					$current_year += 0;
				}
				if($total_amt_fee7 > 0){
					$current_year += $total_amt_fee7;
				}else{
					$current_year += 0;
				}
				if($total_amt_fee8 > 0){
					$current_year += $total_amt_fee8;
				}else{
					$current_year += 0;
				}
				if($total_amt_fee9 > 0){
					$current_year += $total_amt_fee9;
				}else{
					$current_year += 0;
				}
				if($total_amt_fee10 > 0){
					$current_year += $total_amt_fee10;
				}else{
					$current_year += 0;
				}
				if($total_amt_fee11 > 0){
					$current_year += $total_amt_fee11;
				}else{
					$current_year += 0;
				}
				if($total_amt_fee12 > 0){
					$current_year += $total_amt_fee12;
				}else{
					$current_year += 0;
				}
				if($total_amt_fee13 > 0){
					$current_year += $total_amt_fee13;
				}else{
					$current_year += 0;
				}
				if($total_amt_fee14 > 0){
					$current_year += $total_amt_fee14;
				}else{
					$current_year += 0;
				}
				if($total_amt_fee15 > 0){
					$current_year += $total_amt_fee15;
				}else{
					$current_year += 0;
				}
				if($total_amt_fee16 > 0){
					$current_year += $total_amt_fee16;
				}else{
					$current_year += 0;
				}
				if($total_amt_fee17 > 0){
					$current_year += $total_amt_fee17;
				}else{
					$current_year += 0;
				}
				if($total_amt_fee18 > 0){
					$current_year += $total_amt_fee18;
				}else{
					$current_year += 0;
				}
				if($total_amt_fee19 > 0){
					$current_year += $total_amt_fee19;
				}else{
					$current_year += 0;
				}
				if($total_amt_fee20 > 0){
					$current_year += $total_amt_fee20;
				}else{
					$current_year += 0;
				}
				if($total_amt_fee21 > 0){
					$current_year += $total_amt_fee21;
				}else{
					$current_year += 0;
				}
				if($total_amt_fee22 > 0){
					$current_year += $total_amt_fee22;
				}else{
					$current_year += 0;
				}
				if($total_amt_fee23 > 0){
					$current_year += $total_amt_fee23;
				}else{
					$current_year += 0;
				}
				if($total_amt_fee24 > 0){
					$current_year += $total_amt_fee24;
				}else{
					$current_year += 0;
				}
				if($total_amt_fee25 > 0){
					$current_year += $total_amt_fee25;
				}else{
					$current_year += 0;
				}
				$total_defaulter = ($current_year+$pre_data1);
				if($pre_data1>0 || $current_year>0 || $parcial_dues_total > 0)
				{
					if($pre_data1 > 0)
					{
						$PRE_DUES ='PRE,';
						if($current_year>0)
						{
							$mon = $month_print;
							if($parcial_dues_total > 0){
								$par = "PAR";
								$month_upto = $PRE_DUES.$mon.$par;
								$result['data'][] = array(
									$c,
									$student[$i]->FIRST_NM,
									$student[$i]->ADM_NO,
									$student[$i]->ROLL_NO,
									$class_sec,
									$month_upto,
									$pre_data1,
									$current_year,
									$total_defaulter
								);
							}
							else{
								$par = "";
								$month_upto = $PRE_DUES.$mon.$par;
								$result['data'][] = array(
									$c,
									$student[$i]->FIRST_NM,
									$student[$i]->ADM_NO,
									$student[$i]->ROLL_NO,
									$class_sec,
									$month_upto,
									$pre_data1,
									$current_year,
									$total_defaulter
								);
							}
						}
						else{
							$mon = "";
							if($parcial_dues_total > 0){
								$par = "PAR";
								$month_upto = $PRE_DUES.$mon.$par;
								$result['data'][] = array(
									$c,
									$student[$i]->FIRST_NM,
									$student[$i]->ADM_NO,
									$student[$i]->ROLL_NO,
									$class_sec,
									$month_upto,
									$pre_data1,
									$current_year,
									$total_defaulter
								);
							}
							else{
								$par = "";
								$month_upto = $PRE_DUES.$mon.$par;
								$result['data'][] = array(
									$c,
									$student[$i]->FIRST_NM,
									$student[$i]->ADM_NO,
									$student[$i]->ROLL_NO,
									$class_sec,
									$month_upto,
									$pre_data1,
									$current_year,
									$total_defaulter
								);
							}
						}
					}
					else
					{
						$PRE_DUES ="";
						if($current_year>0)
						{
							$mon = $month_print;
							if($parcial_dues_total > 0){
								$par = "PAR";
								$month_upto = $PRE_DUES.$mon.$par;
								$result['data'][] = array(
									$c,
									$student[$i]->FIRST_NM,
									$student[$i]->ADM_NO,
									$student[$i]->ROLL_NO,
									$class_sec,
									$month_upto,
									$pre_data1,
									$current_year,
									$total_defaulter
								);
							}
							else{
								$par = "";
								$month_upto = $PRE_DUES.$mon.$par;
								$result['data'][] = array(
									$c,
									$student[$i]->FIRST_NM,
									$student[$i]->ADM_NO,
									$student[$i]->ROLL_NO,
									$class_sec,
									$month_upto,
									$pre_data1,
									$current_year,
									$total_defaulter
								);
							}
						}
						else{
							$mon = "";
							if($parcial_dues_total > 0){
								$par = "PAR";
								$month_upto = $PRE_DUES.$mon.$par;
								$result['data'][] = array(
									$c,
									$student[$i]->FIRST_NM,
									$student[$i]->ADM_NO,
									$student[$i]->ROLL_NO,
									$class_sec,
									$month_upto,
									$pre_data1,
									$current_year,
									$total_defaulter
								);
							}
							else{
								$par = "";
								$month_upto = $PRE_DUES.$mon.$par;
								$result['data'][] = array(
									$c,
									$student[$i]->FIRST_NM,
									$student[$i]->ADM_NO,
									$student[$i]->ROLL_NO,
									$class_sec,
									$month_upto,
									$pre_data1,
									$current_year,
									$total_defaulter
								);
							}
						}
					}
					$c++;
				}
				// end of the showing student data //
				
			}
			echo json_encode($result);
		
	}
}
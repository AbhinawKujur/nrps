<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Online_paymentcalculation extends MY_Controller{
	public function __construct(){
		parent:: __construct();
	    $this->load->model('Mymodel','dbcon');
	}
	public function show_student()
	{
		$adm_no = $this->input->post('adm');
		$ffm	= $this->input->post('ffm');
		$aprr1	 	= $this->input->post('apr');
		$mayy1 	 	= $this->input->post('may');
		$junn1 	 	= $this->input->post('jun');
		$jull1 	 	= $this->input->post('jul');
		$augg1	 	= $this->input->post('aug');
		$sepp1	 	= $this->input->post('sep');
		$octt1	 	= $this->input->post('oct');
		$novv1	 	= $this->input->post('nov');
		$decc1    	= $this->input->post('dec');
		$jann1 	 	= $this->input->post('jan');
		$febb1	 	= $this->input->post('feb');
		$marr1	 	= $this->input->post('mar');
		//----------------------------------//
		$aprr	 	= $this->input->post('apr');
		$mayy 	 	= $this->input->post('may');
		$junn 	 	= $this->input->post('jun');
		$jull 	 	= $this->input->post('jul');
		$augg	 	= $this->input->post('aug');
		$sepp	 	= $this->input->post('sep');
		$octt	 	= $this->input->post('oct');
		$novv	 	= $this->input->post('nov');
		$decc    	= $this->input->post('dec');
		$jann 	 	= $this->input->post('jan');
		$febb	 	= $this->input->post('feb');
		$marr	 	= $this->input->post('mar');
		//----------------------------------//
		$mid_month = explode('-',$ffm);
		if($adm_no == null)
		{
			redirect('Parent_details/pay_details');
		}
		$total_previous_dues = 0;
		//-------------------------------------//
		$student_data = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
		$session 	  = $this->dbcon->select('session_master','*',"Active_Status='1'");
		
		$pre_details = $this->dbcon->select('previous_year_feegeneration','sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25',"ADM_NO='$adm_no'");
		
		$daycolll = $this->dbcon->select('daycoll','sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25',"ADM_NO='$adm_no'");
		
		$temp_daycoll = $this->dbcon->select('temp_daycoll','sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25',"ADM_NO='$adm_no' AND SEC='Z'");
		
		$feehead1 = $this->dbcon->select('feehead','*');
		
		//-------------------------------------//
		$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','JAN','FEB','MAR');
		
		
		
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
		/* Calculation Of the Previous Year Dues Head Wise */
		$total_previous_dues = $fee1_predues+$fee2_predues+$fee3_predues+$fee4_predues+$fee5_predues+$fee6_predues+$fee7_predues+$fee8_predues+$fee9_predues+$fee10_predues+$fee11_predues+$fee12_predues+$fee13_predues+$fee14_predues+$fee15_predues+$fee16_predues+$fee17_predues+$fee18_predues+$fee19_predues+$fee20_predues+$fee21_predues+$fee22_predues+$fee23_predues+$fee24_predues+$fee25_predues;//
		/* Calculation End Of the Previous Year Dues Head Wise*/
		
		/* calculation of parcial Dues head wise*/
		// startn chekcking the month fee from the student table of perticular student //
				$MON_FEE[0] = $student_data[0]->APR_FEE;
				$MON_FEE[1] = $student_data[0]->MAY_FEE;
				$MON_FEE[2] = $student_data[0]->JUNE_FEE;
				$MON_FEE[3] = $student_data[0]->JULY_FEE;
				$MON_FEE[4] = $student_data[0]->AUG_FEE;
				$MON_FEE[5] = $student_data[0]->SEP_FEE;
				$MON_FEE[6] = $student_data[0]->OCT_FEE;
				$MON_FEE[7] = $student_data[0]->NOV_FEE;
				$MON_FEE[8] = $student_data[0]->DEC_FEE;
				$MON_FEE[9] = $student_data[0]->JAN_FEE;
				$MON_FEE[10] = $student_data[0]->FEB_FEE;
				$MON_FEE[11] = $student_data[0]->MAR_FEE;
				//checking end recpt_no from student no //
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
					if($MON_FEE[$l]=='N/A' || $MON_FEE[$l]=='' || $MON_FEE[$l]=='n/a')
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
					if($MON_FEE[$l] == 'FREESHIP' || $MON_FEE[$l] == "TC_ISSUE" || $MON_FEE[$l] == "PAID" || $MON_FEE[$l] == "FEE_PAID")
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
					 $parcial_fee1;
					 
				}else{
					$parcial_fee1 = 0;
				}
				if($parcial_fee2 > 0)
				{
					$parcial_fee2;
				}else{
					$parcial_fee2 = 0;
				}
				if($parcial_fee3 > 0)
				{
					$parcial_fee3;
				}else{
					$parcial_fee3 = 0;
				}
				if($parcial_fee4 > 0)
				{
					$parcial_fee4;
				}else{
					$parcial_fee4 = 0;
				}
				if($parcial_fee5 > 0)
				{
					$parcial_fee5;
				}else{
					$parcial_fee5 = 0;
				}
				if($parcial_fee6 > 0)
				{
					$parcial_fee6;
				}else{
					$parcial_fee6 = 0;
				}
				if($parcial_fee7 > 0)
				{
					$parcial_fee7;
				}else{
					$parcial_fee7 = 0;
				}
				if($parcial_fee8 > 0)
				{
					$parcial_fee8;
				}else{
					$parcial_fee8 = 0;
				}
				if($parcial_fee9 > 0)
				{
					$parcial_fee9;
				}else{
					$parcial_fee9 = 0;
				}
				if($parcial_fee10 > 0)
				{
					$parcial_fee10;
				}else{
					$parcial_fee10 = 0;
				}
				if($parcial_fee11 > 0)
				{
					$parcial_fee11;
				}else{
					$parcial_fee11 = 0;
				}
				if($parcial_fee12 > 0)
				{
					$parcial_fee12;
				}else{
					$parcial_fee12 = 0;
				}
				if($parcial_fee13 > 0)
				{
					$parcial_fee13;
				}else{
					$parcial_fee13 = 0;
				}
				if($parcial_fee14 > 0)
				{
					$parcial_fee14;
				}else{
					$parcial_fee14 = 0;
				}
				if($parcial_fee15 > 0)
				{
					$parcial_fee15;
				}else{
					$parcial_fee15 = 0;
				}
				if($parcial_fee16 > 0)
				{
					$parcial_fee16;
				}else{
					$parcial_fee16 = 0;
				}
				if($parcial_fee17 > 0)
				{
					$parcial_fee17;
				}else{
					$parcial_fee17 = 0;
				}
				if($parcial_fee18 > 0)
				{
					$parcial_fee18;
				}else{
					$parcial_fee18 = 0;
				}
				if($parcial_fee19 > 0)
				{
					$parcial_fee19;
				}else{
					$parcial_fee19 = 0;
				}
				if($parcial_fee20 > 0)
				{
					$parcial_fee20;
				}else{
					$parcial_fee20 = 0;
				}
				if($parcial_fee21 > 0)
				{
					$parcial_fee21;
				}else{
					$parcial_fee21 = 0;
				}
				if($parcial_fee22 > 0)
				{
					$parcial_fee22;
				}else{
					$parcial_fee22 = 0;
				}
				if($parcial_fee23 > 0)
				{
					$parcial_fee23;
				}else{
					$parcial_fee23 = 0;
				}
				if($parcial_fee24 > 0)
				{
					$parcial_fee24;
				}else{
					$parcial_fee24 = 0;
				}
				if($parcial_fee25 > 0)
				{
					$parcial_fee25;
				}else{
					$parcial_fee25 = 0;
				}
				/* Calculation end of the parcial Dues*/
				$parcial_dues_total = $parcial_fee1+$parcial_fee2+$parcial_fee3+$parcial_fee4+$parcial_fee5+$parcial_fee6+$parcial_fee7+$parcial_fee8+$parcial_fee9+$parcial_fee10+$parcial_fee11+$parcial_fee12+$parcial_fee13+$parcial_fee14+$parcial_fee15+$parcial_fee16+$parcial_fee17+$parcial_fee18+$parcial_fee19+$parcial_fee20+$parcial_fee21+$parcial_fee22+$parcial_fee23+$parcial_fee24+$parcial_fee25;
		if(isset($student_data))
		{
			$admission_no = $student_data[0]->ADM_NO;
			$emp_ward     = $student_data[0]->EMP_WARD;
			$class        = $student_data[0]->CLASS;
			$hostel       = $student_data[0]->HOSTEL;
			$COMPUTER     = $student_data[0]->COMPUTER;
			$SESSIONID    = $student_data[0]->SESSIONID;
			$SCHOLAR      = $student_data[0]->SCHOLAR;
			$science	  = $student_data[0]->BUS_NO;
			$stop_amt_code= $student_data[0]->STOPNO;
			$stu_aprfee   = $student_data[0]->APR_FEE;
			$adm_status   = $student_data[0]->mid_session_admisson_status;
			$Admission_month = $student_data[0]->Admission_month;
			$GetMonthData = $this->dbcon->select('month_master','month_name',"id='$Admission_month'");
			$FinMonth = $GetMonthData[0]->month_name;
			if($FinMonth == "JUN"){
				$MidUnpaidMonth = 'JUNE_FEE';
			}elseif($FinMonth == "JUL"){
				$MidUnpaidMonth = 'JULY_FEE';
			}else{
				$MidUnpaidMonth = $FinMonth.'_FEE';
			}
			$mid_ses_month_paid_status = $student_data[0]->$MidUnpaidMonth;
			if($mid_month[0] == $FinMonth){
				if($mid_month[0] == 'APR'){
					$aprr = $aprr1;
				}elseif($mid_month[0] == 'MAY'){
					$mayy = '';
				}elseif($mid_month[0] == 'JUN'){
					$junn = '';
				}elseif($mid_month[0] == 'JUL'){
					$jull = '';
				}elseif($mid_month[0] == 'AUG'){
					$augg = '';
				}elseif($mid_month[0] == 'SEP'){
					$sepp ='';
				}elseif($mid_month[0] == 'OCT'){
					$octt = '';
				}elseif($mid_month[0] == 'NOV'){
					$novv = '';
				}elseif($mid_month[0] == 'DEC'){
					$decc = '';
				}elseif($mid_month[0] == 'JAN'){
					$jann = '';
				}elseif($mid_month[0] == 'FEB'){
					$febb = '';
				}elseif($mid_month[0] == 'MAR'){
					$marr = '';
				}
			}else{
				$aprr = $aprr1;
			}
		}
		IF(isset($stop_amt_code))
		{
			$stop_amt = $this->dbcon->select('stop_amt','*',"STOP_NO='$stop_amt_code'");
			$stoppage_amounts = $stop_amt[0]->AMT;
			$stop_apr = $stop_amt[0]->APR_FEE;
			$stop_may = $stop_amt[0]->MAY_FEE;
			$stop_jun = $stop_amt[0]->JUN_FEE;
			$stop_jul = $stop_amt[0]->JUL_FEE;
			$stop_aug = $stop_amt[0]->AUG_FEE;
			$stop_sep = $stop_amt[0]->SEP_FEE;
			$stop_oct = $stop_amt[0]->OCT_FEE;
			$stop_nov = $stop_amt[0]->NOV_FEE;
			$stop_dec = $stop_amt[0]->DEC_FEE;
			$stop_jan = $stop_amt[0]->JAN_FEE;
			$stop_feb = $stop_amt[0]->FEB_FEE;
			$stop_mar = $stop_amt[0]->MAR_FEE;
		}
		/* getting session year from database */
		if(isset($session))
		{
			$Session_ID = $session[0]->Session_ID;
			$Session_Nm = $session[0]->Session_Nm;
			$Session_Year = $session[0]->Session_Year;
			$Active_Status = $session[0]->Active_Status;
		}
		/* ending session data from database*/
		if($SCHOLAR==1)
		{
			$scholar_data = $this->dbcon->select('scholarship','*',"ADM_NO='$admission_no'");
			$s[1] = $scholar_data[0]->S1;
			$s[2] = $scholar_data[0]->S2;
			$s[3] = $scholar_data[0]->S3;
			$s[4] = $scholar_data[0]->S4;
			$s[5] = $scholar_data[0]->S5;
			$s[6] = $scholar_data[0]->S6;
			$s[7] = $scholar_data[0]->S7;
			$s[8] = $scholar_data[0]->S8;
			$s[9] = $scholar_data[0]->S9;
			$s[10] = $scholar_data[0]->S10;
			$s[11] = $scholar_data[0]->S11;
			$s[12] = $scholar_data[0]->S12;
			$s[13] = $scholar_data[0]->S13;
			$s[14] = $scholar_data[0]->S14;
			$s[15] = $scholar_data[0]->S15;
			$s[16] = $scholar_data[0]->S16;
			$s[17] = $scholar_data[0]->S17;
			$s[18] = $scholar_data[0]->S18;
			$s[19] = $scholar_data[0]->S19;
			$s[20] = $scholar_data[0]->S20;
			$s[21] = $scholar_data[0]->S21;
			$s[22] = $scholar_data[0]->S22;
			$s[23] = $scholar_data[0]->S23;
			$s[24] = $scholar_data[0]->S24;
			$s[25] = $scholar_data[0]->S25;
			$Apply_From = $scholar_data[0]->Apply_From;
		}
		
		for($i=1;$i<=25;$i++)
		{
			$feehead[$i] 	= $this->dbcon->select('feehead','*',"ACT_CODE='$i'");
			$act_code[$i] 	= $feehead[$i][0]->ACT_CODE;
			$fee_head[$i] 	= $feehead[$i][0]->FEE_HEAD;
			$monthly[$i] 	= $feehead[$i][0]->MONTHLY;
			$CL_BASED[$i]	= $feehead[$i][0]->CL_BASED;
			$AMOUNT[$i]		= $feehead[$i][0]->AMOUNT;
			$EMP[$i]		= $feehead[$i][0]->EMP;
			$CCL[$i]			= $feehead[$i][0]->CCL;
			$SPL[$i]			= $feehead[$i][0]->SPL;
			$EXT[$i]			= $feehead[$i][0]->EXT;
			$INTERNAL[$i]		= $feehead[$i][0]->INTERNAL;
			$HType[$i]			= $feehead[$i][0]->HType;
			$APR[$i]			= $feehead[$i][0]->APR;
			$may[$i]			= $feehead[$i][0]->may;
			$JUN[$i]			= $feehead[$i][0]->JUN;
			$JUL[$i]			= $feehead[$i][0]->JUL;
			$AUG[$i]			= $feehead[$i][0]->AUG;
			$SEP[$i]			= $feehead[$i][0]->SEP;
			$OCT[$i]			= $feehead[$i][0]->OCT;
			$NOV[$i]			= $feehead[$i][0]->NOV;
			$DECM[$i]			= $feehead[$i][0]->DECM;
			$JAN[$i]			= $feehead[$i][0]->JAN;
			$FEB[$i]			= $feehead[$i][0]->FEB;
			$MAR[$i]			= $feehead[$i][0]->MAR;
			
			// fetching data from the database //
			$feeclw   = $this->dbcon->select('fee_clw','*',"FH='$i' AND CL='$class'");
			$feeclw_AMOUNT[$i]   = $feeclw[0]->AMOUNT;
			$feeclw_EMP[$i]      = $feeclw[0]->EMP;
			$feeclw_CCL[$i]      = $feeclw[0]->CCL;
			$feeclw_SPL[$i]      = $feeclw[0]->SPL;
			$feeclw_EXT[$i]      = $feeclw[0]->EXT;
			$feeclw_INTERNAL[$i] = $feeclw[0]->INTERNAL;
			// end of the fetching data form the feeclw //
			if($HType[$i] == "LATEFINE"){
				$late_fine = $this->dbcon->selectSingleData('latefine_master','*',"ID='1'");
				$l_status = $late_fine->status;
				$l_collection_mode = $late_fine->collection_mode;
				$l_month_applied = $late_fine->month_applied;
				$l_date_applied = $late_fine->date_applied;
				$l_late_amount = $late_fine->late_amount;
				if($l_status == 1){
					if($l_collection_mode == 1)// 1= monthly collection
					{
						$current_month = date('m');
						if($current_month>=04 && $current_month<$l_month_applied){
							$amt_feehead[$i] = 0;
						}else{
							$sys_date = date("d-m-Y");
							$sys_num = strtotime($sys_date);
							if($monthly[$i]==1){
								if($mid_month[0] == "APR"){
									if($aprr=='APR' && $APR[$i]==1)
									{
										$apr_date = $l_date_applied."-"."04"."-".$Session_Year;
										$apr_num = strtotime($apr_date);
										if($apr_num<=$sys_num)
										{
											$amt_feehead[$i] = $l_late_amount;
										}else
										{
											$amt_feehead[$i] = 50;
										}
									}
									else
									{
										$amt_feehead[$i] = 0;
									}
								}elseif($mid_month[0] == "MAY"){
									if($mayy=='MAY' && $may[$i]==1)
									{
										$may_date = $l_date_applied."-"."05"."-".$Session_Year;
										$may_num = strtotime($may_date);
										if($may_num<=$sys_num)
										{
											$amt_feehead[$i] = $l_late_amount;
										}else
										{
											$amt_feehead[$i] = 50;
										}
									}
									else
									{
										$amt_feehead[$i] = 0;
									}
								}elseif($mid_month[0] == "JUN"){
									if($junn=='JUN' && $JUN[$i]==1)
									{
										$jun_date = $l_date_applied."-"."06"."-".$Session_Year;
										$jun_num = strtotime($jun_date);
										if($jun_num<=$sys_num)
										{
											$amt_feehead[$i] = $l_late_amount;
										}else
										{
											$amt_feehead[$i] = 50;
										}
									}
									else
									{
										$amt_feehead[$i] = 0;
									}
								}elseif($mid_month[0] == "JUL"){
									if($jull=='JUL' && $JUL[$i]==1)
									{
										$jul_date = $l_date_applied."-"."07"."-".$Session_Year;
										$jul_num = strtotime($jul_date);
										if($jul_num<=$sys_num)
										{
											$amt_feehead[$i] = $l_late_amount;
										}else
										{
											$amt_feehead[$i] = 50;
										}
									}
									else
									{
										$amt_feehead[$i] = 0;
									}
								}elseif($mid_month[0] == "AUG"){
									if($augg=='AUG' && $AUG[$i]==1)
									{
										$aug_date = $l_date_applied."-"."08"."-".$Session_Year;
										$aug_num = strtotime($aug_date);
										if($aug_num<=$sys_num)
										{
											$amt_feehead[$i] = $l_late_amount;
										}else
										{
											$amt_feehead[$i] = 50;
										}
									}
									else
									{
										$amt_feehead[$i] = 0;
									}
								}elseif($mid_month[0] == "SEP"){
									if($sepp=='SEP' && $SEP[$i]==1)
									{
										$sep_date = $l_date_applied."-"."09"."-".$Session_Year;
										$sep_num = strtotime($sep_date);
										if($sep_num<=$sys_num)
										{
											$amt_feehead[$i] = $l_late_amount;
										}else
										{
											$amt_feehead[$i] = 50;
										}
									}
									else
									{
										$amt_feehead[$i] = 0;
									}
								}elseif($mid_month[0] == "OCT"){
									if($octt=='OCT' && $OCT[$i]==1)
									{
										$oct_date = $l_date_applied."-"."10"."-".$Session_Year;
										$oct_num = strtotime($oct_date);
										if($oct_num<=$sys_num)
										{
											$amt_feehead[$i] = $l_late_amount;
										}else
										{
											$amt_feehead[$i] = 50;
										}
									}
									else
									{
										$amt_feehead[$i] = 0;
									}
								}elseif($mid_month[0] == "NOV"){
									if($novv=='NOV' && $NOV[$i]==1)
									{
										$nov_date = $l_date_applied."-"."11"."-".$Session_Year;
										$nov_num = strtotime($nov_date);
										if($nov_num<=$sys_num)
										{
											$amt_feehead[$i] = $l_late_amount;
										}else
										{
											$amt_feehead[$i] = 50;
										}
									}
									else
									{
										$amt_feehead[$i] = 0;
									}
								}elseif($mid_month[0] == "DEC"){
									if($decc=='DEC' && $DECM[$i]==1)
									{
										$dec_date = $l_date_applied."-"."12"."-".$Session_Year;
										$dec_num = strtotime($dec_date);
										if($dec_num<=$sys_num)
										{
											$amt_feehead[$i] = $l_late_amount;
										}else
										{
											$amt_feehead[$i] = 50;
										}
									}
									else
									{
										$amt_feehead[$i] = 0;
									}
								}elseif($mid_month[0] == "JAN"){
									if($jann=='JAN' && $JAN[$i]==1)
									{
										$y = $Session_Year;
										$year = $y+1;
										$jan_date = $l_date_applied."-"."01"."-".$year;
										$jan_num = strtotime($jan_date);
										if($jan_num<=$sys_num)
										{
											$amt_feehead[$i] = $l_late_amount;
										}else
										{
											$amt_feehead[$i] = 50;
										}
									}
									else
									{
										$amt_feehead[$i] = 0;
									}
								}elseif($mid_month[0] == "FEB"){
									if($febb=='FEB' && $FEB[$i]==1)
									{
										$y = $Session_Year;
										$year = $y+1;
										$feb_date = $l_date_applied."-"."02"."-".$year;
										$feb_num = strtotime($feb_date);
										if($feb_num<=$sys_num)
										{
											$amt_feehead[$i] = $l_late_amount;
										}else
										{
											$amt_feehead[$i] = 50;
										}
									}
									else
									{
										$amt_feehead[$i] = 0;
									}
								}elseif($mid_month[0] == "MAR"){
									if($marr=='MAR' && $MAR[$i]==1)
									{
										$y = $Session_Year;
										$year = $y+1;
										$mar_date = $l_date_applied."-"."03"."-".$year;
										$mar_num = strtotime($mar_date);
										if($mar_num<=$sys_num)
										{
											$amt_feehead[$i] = $l_late_amount;
										}else
										{
											$amt_feehead[$i] = 50;
										}
									}
									else
									{
										$amt_feehead[$i] = 0;
									}
								}else{
									$amt_feehead[$i] = 0;
								}
							}
							else{
								$amt_feehead[$i] = 0;
							}
						}
						
						
					}
					elseif($l_collection_mode == 2)// 2= daily collection
					{
						$amt_feehead[$i] = 0;
					}
					else
					{
						$amt_feehead[$i] = 0;
					}
				}else{
					$amt_feehead[$i] = 0;
				}
				
			}elseif($HType[$i]=='BUS'){
				if($monthly[$i]==1){
					if($aprr1=='APR' && $APR[$i]==1)
					{
						$apr_data = $this->dbcon->getbusamountmonthwise('APR_FEE',$adm_no,'1');
						IF(!empty($apr_data)){
							$apr_data_fee = $apr_data[0]->BUSAMOUNT;
						}else{
							$apr_data_fee = 0;
						}
						$apr_fee = $apr_data_fee;
					}
					else
					{
						$apr_fee = 0;
					}
					if($mayy1=='MAY' && $may[$i]==1)
					{
						$apr_data = $this->dbcon->getbusamountmonthwise('MAY_FEE',$adm_no,'2');
						IF(!empty($apr_data)){
							$apr_data_fee = $apr_data[0]->BUSAMOUNT;
						}else{
							$apr_data_fee = 0;
						}
						$may_fee = $apr_data_fee;
					}
					else
					{
						$may_fee = 0;
					}
					if($junn1=='JUN' && $JUN[$i]==1)
					{
						$apr_data = $this->dbcon->getbusamountmonthwise('JUN_FEE',$adm_no,'3');
						IF(!empty($apr_data)){
							$apr_data_fee = $apr_data[0]->BUSAMOUNT;
						}else{
							$apr_data_fee = 0;
						}
						$jun_fee = $apr_data_fee;
					}
					else
					{
						$jun_fee = 0;
					}
					if($jull1=='JUL' && $JUL[$i]==1)
					{
						$apr_data = $this->dbcon->getbusamountmonthwise('JUL_FEE',$adm_no,'4');
						IF(!empty($apr_data)){
							$apr_data_fee = $apr_data[0]->BUSAMOUNT;
						}else{
							$apr_data_fee = 0;
						}
						$jul_fee = $apr_data_fee;
					}
					else
					{
						$jul_fee = 0;
					}
					if($augg1=='AUG' && $AUG[$i]==1)
					{
						$apr_data = $this->dbcon->getbusamountmonthwise('AUG_FEE',$adm_no,'5');
						
						IF(!empty($apr_data)){
							$apr_data_fee = $apr_data[0]->BUSAMOUNT;
						}else{
							$apr_data_fee = 0;
						}
						
						$aug_fee = $apr_data_fee;
					}
					else
					{
						$aug_fee = 0;
					}
					if($sepp1=='SEP' && $SEP[$i]==1)
					{
						$apr_data = $this->dbcon->getbusamountmonthwise('SEP_FEE',$adm_no,'6');
						IF(!empty($apr_data)){
							$apr_data_fee = $apr_data[0]->BUSAMOUNT;
						}else{
							$apr_data_fee = 0;
						}
						$sep_fee = $apr_data_fee;
					}
					else
					{
						$sep_fee = 0;
					}
					if($octt1=='OCT' && $OCT[$i]==1)
					{
						$apr_data = $this->dbcon->getbusamountmonthwise('OCT_FEE',$adm_no,'7');
						IF(!empty($apr_data)){
							$apr_data_fee = $apr_data[0]->BUSAMOUNT;
						}else{
							$apr_data_fee = 0;
						}
						$oct_fee = $apr_data_fee;
					}
					else
					{
						$oct_fee = 0;
					}
					if($novv1=='NOV' && $NOV[$i]==1)
					{
						$apr_data = $this->dbcon->getbusamountmonthwise('NOV_FEE',$adm_no,'8');
						IF(!empty($apr_data)){
							$apr_data_fee = $apr_data[0]->BUSAMOUNT;
						}else{
							$apr_data_fee = 0;
						}
						$nov_fee = $stop_nov;
					}
					else
					{
						$nov_fee = 0;
					}
					if($decc1=='DEC' && $DECM[$i]==1)
					{
						$apr_data = $this->dbcon->getbusamountmonthwise('DEC_FEE',$adm_no,'9');
						IF(!empty($apr_data)){
							$apr_data_fee = $apr_data[0]->BUSAMOUNT;
						}else{
							$apr_data_fee = 0;
						}
						$dec_fee = $apr_data_fee;
					}
					else
					{
						$dec_fee = 0;
					}
					if($jann1=='JAN' && $JAN[$i]==1)
					{
						$apr_data = $this->dbcon->getbusamountmonthwise('JAN_FEE',$adm_no,'10');
						IF(!empty($apr_data)){
							$apr_data_fee = $apr_data[0]->BUSAMOUNT;
						}else{
							$apr_data_fee = 0;
						}
						$jan_fee = $apr_data_fee;
					}
					else
					{
						$jan_fee = 0;
					}
					if($febb1=='FEB' && $FEB[$i]==1)
					{
						$apr_data = $this->dbcon->getbusamountmonthwise('FEB_FEE',$adm_no,'11');
						IF(!empty($apr_data)){
							$apr_data_fee = $apr_data[0]->BUSAMOUNT;
						}else{
							$apr_data_fee = 0;
						}
						$feb_fee = $apr_data_fee;
					}
					else
					{
						$feb_fee = 0;
					}
					if($marr1=='MAR' && $MAR[$i]==1)
					{
						$apr_data = $this->dbcon->getbusamountmonthwise('MAR_FEE',$adm_no,'12');
						IF(!empty($apr_data)){
							$apr_data_fee = $apr_data[0]->BUSAMOUNT;
						}else{
							$apr_data_fee = 0;
						}
						$mar_fee = $apr_data_fee;
					}
					else
					{
						$mar_fee = 0;
					}
					$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
				}
				else{
					$amt_feehead[$i] = 0;
				}
			}
			else{
				if($monthly[$i]==1) // calculation for the month base fee which is old student //
				{
					if($CL_BASED[$i]==1) // calculation on the basis of class base //
					{
						switch($emp_ward)
						{
							case 1:
							$amt_fee = $feeclw_AMOUNT[$i];
							break;
							case 2:
							$amt_fee = $feeclw_EMP[$i];
							break;
							case 3:
							$amt_fee = $feeclw_CCL[$i];
							break;
							case 4:
							$amt_fee = $feeclw_CCL[$i];
							break;
							case 5:
							$amt_fee = $feeclw_SPL[$i];
							break;
							case 6:
							$amt_fee = $feeclw_EXT[$i];
							break;
							default:
							$amt_fee = 0;
							break;
										
						}
						// Checking the head type of the student //
						if($HType[$i]=='No')
						{
							$h_fee = $amt_fee;
						}
						elseif($HType[$i]=='COMPUTER')
						{
							if($COMPUTER==1)
							{
								$h_fee = $amt_fee;
							}
							else
							{
								$h_fee = 0;
							}
						}
						elseif($HType[$i]=='SCIENCE')
						{
							$h_fee = $amt_fee*$science;
						}
						elseif($HType[$i]=='BUS')
						{
							$h_fee = $stoppage_amounts;
						}
						ELSEIF($HType[$i]=='HOSTEL')
						{
							IF($hostel==1)
							{
								$h_fee = $amt_fee;
							}
							ELSE
							{
								$h_fee = 0;
							}
						}
						ELSEIF($HType[$i]=='BOOK')
						{
							$h_fee = $amt_fee;
						}
						elseif($HType[$i]=='DUES'){
							$h_fee = 0;
						}
						ELSE
						{
							$h_fee = 0;
						}
						// End Of Checking Head Type //
						if($SCHOLAR==1) // calculation on the basis of the scholarship //
						{
							if($Apply_From=='APR') // scholar ship apply from apr month
							{
								if($mid_month[0]==$FinMonth && $APR[$i]==1)
								{
									$apr_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$mar_fee = 0;
								}
								$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
							}
							elseif($Apply_From=='MAY') //  scholar ship given from may month
							{
								if($mid_month[0]==$FinMonth && $APR[$i]==1)
								{
									$apr_fee = $h_fee;
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$mar_fee = 0;
								}
								$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
							}
							elseif($Apply_From=='JUN') // scholar given by jun month
							{
								if($mid_month[0]==$FinMonth && $APR[$i]==1)
								{
									$apr_fee = $h_fee;
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = $h_fee;
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$mar_fee = 0;
								}
								$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
							}
							elseif($Apply_From=='JUl') // scholar given from jul
							{
								if($mid_month[0]==$FinMonth && $APR[$i]==1)
								{
									$apr_fee = $h_fee;
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = $h_fee;
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = $h_fee;
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$mar_fee = 0;
								}
								$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
							}
							elseif($Apply_From=='AUG') // scholar given by aug
							{
								if($mid_month[0]==$FinMonth && $APR[$i]==1)
								{
									$apr_fee = $h_fee;
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = $h_fee;
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = $h_fee;
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = $h_fee;
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$mar_fee = 0;
								}
								$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
							}
							elseif($Apply_From=='SEP') // scholar given by sep
							{
								if($mid_month[0]==$FinMonth && $APR[$i]==1)
								{
									$apr_fee = $h_fee;
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = $h_fee;
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = $h_fee;
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = $h_fee;
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = $h_fee;
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$mar_fee = 0;
								}
								$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
							}
							elseif($Apply_From=='OCT')  // scholar given by oct month
							{
								if($mid_month[0]==$FinMonth && $APR[$i]==1)
								{
									$apr_fee = $h_fee;
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = $h_fee;
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = $h_fee;
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = $h_fee;
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = $h_fee;
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = $h_fee;
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$mar_fee = 0;
								}
								$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
							}
							elseif($Apply_From=='NOV') // scholar given by nov month //
							{
								if($mid_month[0]==$FinMonth && $APR[$i]==1)
								{
									$apr_fee = $h_fee;
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = $h_fee;
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = $h_fee;
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = $h_fee;
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = $h_fee;
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = $h_fee;
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = $h_fee;
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$mar_fee = 0;
								}
								$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
							}
							elseif($Apply_From=='DEC') // scholar given from dec month //
							{
								if($mid_month[0]==$FinMonth && $APR[$i]==1)
								{
									$apr_fee = $h_fee;
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = $h_fee;
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = $h_fee;
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = $h_fee;
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = $h_fee;
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = $h_fee;
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = $h_fee;
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = $h_fee;
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$mar_fee = 0;
								}
								$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
							}
							elseif($Apply_From=='JAN') // scholar given from jan month //
							{
								if($mid_month[0]==$FinMonth && $APR[$i]==1)
								{
									$apr_fee = $h_fee;
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = $h_fee;
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = $h_fee;
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = $h_fee;
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = $h_fee;
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = $h_fee;
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = $h_fee;
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = $h_fee;
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = $h_fee;
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$mar_fee = 0;
								}
								$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
							}
							elseif($Apply_From=='FEB') // scholar given from  feb month //
							{
								if($mid_month[0]==$FinMonth && $APR[$i]==1)
								{
									$apr_fee = $h_fee;
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = $h_fee;
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = $h_fee;
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = $h_fee;
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = $h_fee;
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = $h_fee;
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = $h_fee;
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = $h_fee;
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = $h_fee;
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = $h_fee;
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$mar_fee = 0;
								}
								$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
							}
							elseif($Apply_From=='MAR') // scholar given from mar month //
							{
								if($mid_month[0]==$FinMonth && $APR[$i]==1)
								{
									$apr_fee = $h_fee;
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = $h_fee;
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = $h_fee;
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = $h_fee;
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = $h_fee;
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = $h_fee;
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = $h_fee;
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = $h_fee;
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = $h_fee;
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = $h_fee;
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = $h_fee;
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$mar_fee = 0;
								}
								$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
							}
							else // scholar without any month //
							{
								if($mid_month[0]==$FinMonth && $APR[$i]==1)
								{
									$apr_fee = $h_fee;
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = $h_fee;
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = $h_fee;
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = $h_fee;
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = $h_fee;
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = $h_fee;
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = $h_fee;
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = $h_fee;
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = $h_fee;
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = $h_fee;
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = $h_fee;
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = $h_fee;
								}
								else
								{
									$mar_fee = 0;
								}
								$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
							}
						}
						else // calculation without scholarship for student //
						{
							if($mid_month[0]==$FinMonth && $APR[$i]==1)
							{
								$apr_fee = $h_fee;
							}
							else
							{
								$apr_fee = 0;
							}
							if($mayy=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee;
							}
							else
							{
								$may_fee = 0;
							}
							if($junn=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee;
							}
							else
							{
								$jun_fee = 0;
							}
							if($jull=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee;
							}
							else
							{
								$jul_fee = 0;
							}
							if($augg=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee;
							}
							else
							{
								$aug_fee = 0;
							}
							if($sepp=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee;
							}
							else
							{
								$sep_fee = 0;
							}
							if($octt=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee;
							}
							else
							{
								$oct_fee = 0;
							}
							if($novv=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee;
							}
							else
							{
								$nov_fee = 0;
							}
							if($decc=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee;
							}
							else
							{
								$dec_fee = 0;
							}
							if($jann=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee;
							}
							else
							{
								$jan_fee = 0;
							}
							if($febb=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee;
							}
							else
							{
								$feb_fee = 0;
							}
							if($marr=='MAR' && $MAR[$i]==1)
							{
								$mar_fee = $h_fee;
							}
							else
							{
								$mar_fee = 0;
							}
							$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
						}
					}
					else // calculation on the basis of without class base //
					{
						switch($emp_ward)
						{
							case 1:
							$amt_fee = $AMOUNT[$i];
							break;
							case 2:
							$amt_fee = $EMP[$i];
							break;
							case 3:
							$amt_fee = $CCL[$i];
							break;
							case 4:
							$amt_fee = $SPL[$i];
							break;
							case 5:
							$amt_fee = $EXT[$i];
							break;
							case 6:
							$amt_fee = $INTERNAL[$i];
							break;
							default:
							$amt_fee = 0;
							break;
										
						}
						// Checking the head type of the student //
						if($HType[$i]=='No')
						{
							$h_fee = $amt_fee;
						}
						elseif($HType[$i]=='COMPUTER')
						{
							if($COMPUTER==1)
							{
								$h_fee = $amt_fee;
							}
							else
							{
								$h_fee = 0;
							}
						}
						elseif($HType[$i]=='SCIENCE')
						{
							$h_fee = $amt_fee*$science;
						}
						elseif($HType[$i]=='BUS')
						{
							$h_fee = $stoppage_amounts;
						}
						ELSEIF($HType[$i]=='HOSTEL')
						{
							IF($hostel==1)
							{
								$h_fee = $amt_fee;
							}
							ELSE
							{
								$h_fee = 0;
							}
						}
						ELSEIF($HType[$i]=='BOOK')
						{
							$h_fee = $amt_fee;
						}
						ELSE
						{
							$h_fee = 0;
						}
						if($SCHOLAR==1) // calculation on the basis of the scholarship //
						{
							if($Apply_From=='APR') // scholar ship apply from apr month
							{
								if($mid_month[0]==$FinMonth && $APR[$i]==1)
								{
									$apr_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$mar_fee = 0;
								}
								$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
							}
							elseif($Apply_From=='MAY') //  scholar ship given from may month
							{
								if($mid_month[0]==$FinMonth && $APR[$i]==1)
								{
									$apr_fee = $h_fee;
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$mar_fee = 0;
								}
								$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
							}
							elseif($Apply_From=='JUN') // scholar given by jun month
							{
								if($mid_month[0]==$FinMonth && $APR[$i]==1)
								{
									$apr_fee = $h_fee;
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = $h_fee;
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$mar_fee = 0;
								}
								$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
							}
							elseif($Apply_From=='JUl') // scholar given from jul
							{
								if($mid_month[0]==$FinMonth && $APR[$i]==1)
								{
									$apr_fee = $h_fee;
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = $h_fee;
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = $h_fee;
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$mar_fee = 0;
								}
								$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
							}
							elseif($Apply_From=='AUG') // scholar given by aug
							{
								if($mid_month[0]==$FinMonth && $APR[$i]==1)
								{
									$apr_fee = $h_fee;
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = $h_fee;
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = $h_fee;
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = $h_fee;
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$mar_fee = 0;
								}
								$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
							}
							elseif($Apply_From=='SEP') // scholar given by sep
							{
								if($mid_month[0]==$FinMonth && $APR[$i]==1)
								{
									$apr_fee = $h_fee;
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = $h_fee;
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = $h_fee;
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = $h_fee;
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = $h_fee;
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$mar_fee = 0;
								}
								$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
							}
							elseif($Apply_From=='OCT')  // scholar given by oct month
							{
								if($mid_month[0]==$FinMonth && $APR[$i]==1)
								{
									$apr_fee = $h_fee;
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = $h_fee;
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = $h_fee;
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = $h_fee;
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = $h_fee;
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = $h_fee;
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$mar_fee = 0;
								}
								$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
							}
							elseif($Apply_From=='NOV') // scholar given by nov month //
							{
								if($mid_month[0]==$FinMonth && $APR[$i]==1)
								{
									$apr_fee = $h_fee;
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = $h_fee;
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = $h_fee;
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = $h_fee;
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = $h_fee;
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = $h_fee;
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = $h_fee;
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$mar_fee = 0;
								}
								$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
							}
							elseif($Apply_From=='DEC') // scholar given from dec month //
							{
								if($mid_month[0]==$FinMonth && $APR[$i]==1)
								{
									$apr_fee = $h_fee;
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = $h_fee;
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = $h_fee;
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = $h_fee;
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = $h_fee;
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = $h_fee;
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = $h_fee;
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = $h_fee;
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$mar_fee = 0;
								}
								$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
							}
							elseif($Apply_From=='JAN') // scholar given from jan month //
							{
								if($mid_month[0]==$FinMonth && $APR[$i]==1)
								{
									$apr_fee = $h_fee;
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = $h_fee;
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = $h_fee;
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = $h_fee;
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = $h_fee;
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = $h_fee;
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = $h_fee;
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = $h_fee;
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = $h_fee;
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$mar_fee = 0;
								}
								$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
							}
							elseif($Apply_From=='FEB') // scholar given from  feb month //
							{
								if($mid_month[0]==$FinMonth && $APR[$i]==1)
								{
									$apr_fee = $h_fee;
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = $h_fee;
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = $h_fee;
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = $h_fee;
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = $h_fee;
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = $h_fee;
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = $h_fee;
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = $h_fee;
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = $h_fee;
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = $h_fee;
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$mar_fee = 0;
								}
								$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
							}
							elseif($Apply_From=='MAR') // scholar given from mar month //
							{
								if($mid_month[0]==$FinMonth && $APR[$i]==1)
								{
									$apr_fee = $h_fee;
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = $h_fee;
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = $h_fee;
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = $h_fee;
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = $h_fee;
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = $h_fee;
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = $h_fee;
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = $h_fee;
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = $h_fee;
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = $h_fee;
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = $h_fee;
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = round($h_fee-($h_fee*$s[$i]/100));
								}
								else
								{
									$mar_fee = 0;
								}
								$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
							}
							else // scholar without any month //
							{
								if($mid_month[0]==$FinMonth && $APR[$i]==1)
								{
									$apr_fee = $h_fee;
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = $h_fee;
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = $h_fee;
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = $h_fee;
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = $h_fee;
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = $h_fee;
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = $h_fee;
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = $h_fee;
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = $h_fee;
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = $h_fee;
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = $h_fee;
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = $h_fee;
								}
								else
								{
									$mar_fee = 0;
								}
								$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
							}
						}  
						else // calculation without scholarship for student //
						{
							if($mid_month[0]==$FinMonth && $APR[$i]==1)
							{
								$apr_fee = $h_fee;
							}
							else
							{
								$apr_fee = 0;
							}
							if($mayy=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee;
							}
							else
							{
								$may_fee = 0;
							}
							if($junn=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee;
							}
							else
							{
								$jun_fee = 0;
							}
							if($jull=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee;
							}
							else
							{
								$jul_fee = 0;
							}
							if($augg=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee;
							}
							else
							{
								$aug_fee = 0;
							}
							if($sepp=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee;
							}
							else
							{
								$sep_fee = 0;
							}
							if($octt=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee;
							}
							else
							{
								$oct_fee = 0;
							}
							if($novv=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee;
							}
							else
							{
								$nov_fee = 0;
							}
							if($decc=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee;
							}
							else
							{
								$dec_fee = 0;
							}
							if($jann=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee;
							}
							else
							{
								$jan_fee = 0;
							}
							if($febb=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee;
							}
							else
							{
								$feb_fee = 0;
							}
							if($marr=='MAR' && $MAR[$i]==1)
							{
								$mar_fee = $h_fee;
							}
							else
							{
								$mar_fee = 0;
							}
							$amt_feehead[$i] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
						}
						
					}
				}
				else // calculation for the new student where fee type for one month //
				{
					if($Session_Year==$SESSIONID)// Calculation For New Student Without Month Wise //
					{
						if($adm_status == 1){
							if($mid_ses_month_paid_status=='N/A' || $mid_ses_month_paid_status=='')
							{
								if($CL_BASED[$i]==1)
								{
									// echo $fee_head[$i];
									// exit;
									switch($emp_ward)
									{
										case 1:
										$amt_fee = $feeclw_AMOUNT[$i];
										break;
										case 2:
										$amt_fee = $feeclw_EMP[$i];
										break;
										case 3:
										$amt_fee = $feeclw_CCL[$i];
										break;
										case 4:
										$amt_fee = $feeclw_CCL[$i];
										break;
										case 5:
										$amt_fee = $feeclw_SPL[$i];
										break;
										case 6:
										$amt_fee = $feeclw_EXT[$i];
										break;
										default:
										$amt_fee = 0;
										break;
											
									}
									// Checking the head type of the student //
									if($HType[$i]=='No')
									{
										$h_fee = $amt_fee;
									}
									elseif($HType[$i]=='COMPUTER')
									{
										if($COMPUTER==1)
										{
											$h_fee = $amt_fee;
										}
										else
										{
											$h_fee = 0;
										}
									}
									elseif($HType[$i]=='SCIENCE')
									{
										$h_fee = $amt_fee*$science;
									}
									
									ELSEIF($HType[$i]=='HOSTEL')
									{
										IF($hostel==1)
										{
											$h_fee = $amt_fee;
										}
										ELSE
										{
											$h_fee = 0;
										}
									}
									ELSEIF($HType[$i]=='BOOK')
									{
										$h_fee = $amt_fee;
									}
									ELSE
									{
										$h_fee = 0;
									}
									// End Of Checking Head Type //
									if($SCHOLAR==1)
									{
										if($Apply_From==$FinMonth) // scholar ship apply from apr month
										{
											if($mid_month[0]==$FinMonth)
											{
												$apr_fee = round($h_fee-($h_fee*$s[$i]/100));
											}
											else
											{
												$apr_fee = 0;
											}
											$amt_feehead[$i] = $apr_fee;
									
										}
										else
										{
											if($mid_month[0]==$FinMonth)
											{
												$amt_feehead[$i] = $h_fee;
											}
											else
											{
												$amt_feehead[$i] = 0;
											}
											
										}
									}
									else
									{
										if($mid_month[0]==$FinMonth)
										{
											$apr_fee = $h_fee;
										}
										else
										{
											$apr_fee = 0;
										}
										$amt_feehead[$i] = $apr_fee;
									}
								}
								else
								{
									switch($emp_ward)
									{
										case 1:
										$amt_fee = $AMOUNT[$i];
										break;
										case 2:
										$amt_fee = $EMP[$i];
										break;
										case 3:
										$amt_fee = $CCL[$i];
										break;
										case 4:
										$amt_fee = $SPL[$i];
										break;
										case 5:
										$amt_fee = $EXT[$i];
										break;
										case 6:
										$amt_fee = $INTERNAL[$i];
										break;
										default:
										$amt_fee = 0;
										break;
													
									}
									// Checking the head type of the student //
									if($HType[$i]=='No')
									{
										$h_fee = $amt_fee;
									}
									elseif($HType[$i]=='COMPUTER')
									{
										if($COMPUTER==1)
										{
											$h_fee = $amt_fee;
										}
										else
										{
											$h_fee = 0;
										}
									}
									elseif($HType[$i]=='SCIENCE')
									{
										$h_fee = $amt_fee*$science;
									}
									
									ELSEIF($HType[$i]=='HOSTEL')
									{
										IF($hostel==1)
										{
											$h_fee = $amt_fee;
										}
										ELSE
										{
											$h_fee = 0;
										}
									}
									ELSEIF($HType[$i]=='BOOK')
									{
										$h_fee = $amt_fee;
									}
									ELSE
									{
										$h_fee = 0;
									}
									if($SCHOLAR==1)
									{
										if($Apply_From==$FinMonth) // scholar ship apply from apr month
										{
											if($mid_month[0]==$FinMonth)
											{
												$apr_fee = round($h_fee-($h_fee*$s[$i]/100));
											}
											else
											{
												$apr_fee = 0;
											}
											$amt_feehead[$i] = $apr_fee;
									
										}
										else
										{
											if($mid_month[0]==$FinMonth)
											{
												$amt_feehead[$i] = $h_fee;
											}
											else
											{
												$amt_feehead[$i] = 0;
											}
											
										}
									}
									else
									{
										if($mid_month[0]==$FinMonth)
										{
											$apr_fee = $h_fee;
										}
										else
										{
											$apr_fee = 0;
										}
										$amt_feehead[$i] = $apr_fee;
									}
								}
							}
							else
							{
								$amt_feehead[$i] = 0;
							}
						}else{
							if($stu_aprfee=='N/A' || $stu_aprfee=='')
							{
								if($CL_BASED[$i]==1)
								{
									switch($emp_ward)
									{
										case 1:
										$amt_fee = $feeclw_AMOUNT[$i];
										break;
										case 2:
										$amt_fee = $feeclw_EMP[$i];
										break;
										case 3:
										$amt_fee = $feeclw_CCL[$i];
										break;
										case 4:
										$amt_fee = $feeclw_CCL[$i];
										break;
										case 5:
										$amt_fee = $feeclw_SPL[$i];
										break;
										case 6:
										$amt_fee = $feeclw_EXT[$i];
										break;
										default:
										$amt_fee = 0;
										break;
											
									}
									// Checking the head type of the student //
									if($HType[$i]=='No')
									{
										$h_fee = $amt_fee;
									}
									elseif($HType[$i]=='COMPUTER')
									{
										if($COMPUTER==1)
										{
											$h_fee = $amt_fee;
										}
										else
										{
											$h_fee = 0;
										}
									}
									elseif($HType[$i]=='SCIENCE')
									{
										$h_fee = $amt_fee*$science;
									}
									
									ELSEIF($HType[$i]=='HOSTEL')
									{
										IF($hostel==1)
										{
											$h_fee = $amt_fee;
										}
										ELSE
										{
											$h_fee = 0;
										}
									}
									ELSEIF($HType[$i]=='BOOK')
									{
										$h_fee = $amt_fee;
									}
									ELSE
									{
										$h_fee = 0;
									}
									// End Of Checking Head Type //
									if($SCHOLAR==1)
									{
										if($Apply_From=='APR') // scholar ship apply from apr month
										{
											if($aprr=='APR')
											{
												$apr_fee = round($h_fee-($h_fee*$s[$i]/100));
											}
											else
											{
												$apr_fee = 0;
											}
											$amt_feehead[$i] = $apr_fee;
									
										}
										else
										{
											if($aprr=='APR')
											{
												$amt_feehead[$i] = $h_fee;
											}
											else
											{
												$amt_feehead[$i] = 0;
											}
											
										}
									}
									else
									{
										if($aprr=='APR')
										{
											$apr_fee = $h_fee;
										}
										else
										{
											$apr_fee = 0;
										}
										$amt_feehead[$i] = $apr_fee;
									}
								}
								else
								{
									
									switch($emp_ward)
									{
										case 1:
										$amt_fee = $AMOUNT[$i];
										
										break;
										case 2:
										$amt_fee = $EMP[$i];
										break;
										case 3:
										$amt_fee = $CCL[$i];
										break;
										case 4:
										$amt_fee = $SPL[$i];
										break;
										case 5:
										$amt_fee = $EXT[$i];
										break;
										case 6:
										$amt_fee = $INTERNAL[$i];
										break;
										default:
										$amt_fee = 0;
										break;
													
									}
									// Checking the head type of the student //
									if($HType[$i]=='No')
									{
										$h_fee = $amt_fee;
									}
									elseif($HType[$i]=='COMPUTER')
									{
										if($COMPUTER==1)
										{
											$h_fee = $amt_fee;
										}
										else
										{
											$h_fee = 0;
										}
									}
									elseif($HType[$i]=='SCIENCE')
									{
										$h_fee = $amt_fee*$science;
									}
									
									ELSEIF($HType[$i]=='HOSTEL')
									{
										IF($hostel==1)
										{
											$h_fee = $amt_fee;
										}
										ELSE
										{
											$h_fee = 0;
										}
									}
									ELSEIF($HType[$i]=='BOOK')
									{
										$h_fee = $amt_fee;
									}
									ELSE
									{
										$h_fee = 0;
									}
									if($SCHOLAR==1)
									{
										if($Apply_From=='APR') // scholar ship apply from apr month
										{
											if($aprr=='APR')
											{
												$apr_fee = round($h_fee-($h_fee*$s[$i]/100));
											}
											else
											{
												$apr_fee = 0;
											}
											$amt_feehead[$i] = $apr_fee;
									
										}
										else
										{
											if($aprr=='APR')
											{
												$amt_feehead[$i] = $h_fee;
											}
											else
											{
												$amt_feehead[$i] = 0;
											}
											
										}
									}
									else
									{
										if($aprr=='APR')
										{
											$apr_fee = $h_fee;
										}
										else
										{
											$apr_fee = 0;
										}
										$amt_feehead[$i] = $apr_fee;
									}
								}
							}
							else
							{
								$amt_feehead[$i] = 0;
							}
						}
					}
					else // calculation for old student without month wise //
					{
						$amt_feehead[$i] = 0;
					}
				}
			}
			
		}
		if($total_previous_dues > 0){
			if($parcial_dues_total > 0){
				$ffm = "PRE.DUES,PAR.-".$ffm;
			}else{
				$ffm = "PRE.DUES.-".$ffm;
			}
		}else{
			if($parcial_dues_total > 0){
				$ffm = "PAR.-".$ffm;
			}else{
				$ffm = $ffm;
			}
		}
		$total_amount = ($amt_feehead[1]+$parcial_fee1)+($amt_feehead[2]+$parcial_fee2)+($amt_feehead[3]+$parcial_fee3)+($amt_feehead[4]+$parcial_fee4)+($amt_feehead[5]+$parcial_fee5)+($amt_feehead[6]+$parcial_fee6)+($amt_feehead[7]+$parcial_fee7)+($amt_feehead[8]+$parcial_fee8)+($amt_feehead[9]+$parcial_fee9)+($amt_feehead[10]+$parcial_fee10)+($amt_feehead[11]+$parcial_fee11)+($amt_feehead[12]+$parcial_fee12)+($amt_feehead[13]+$parcial_fee13)+($amt_feehead[14]+$parcial_fee14)+($amt_feehead[15]+$parcial_fee15)+($amt_feehead[16]+$parcial_fee16)+($amt_feehead[17]+$parcial_fee17)+($amt_feehead[18]+$parcial_fee18)+($amt_feehead[19]+$parcial_fee19)+($amt_feehead[20]+$parcial_fee20)+($amt_feehead[21]+$parcial_fee21)+($amt_feehead[22]+$parcial_fee21)+($amt_feehead[22]+$parcial_fee22)+($amt_feehead[23]+$parcial_fee23)+($amt_feehead[24]+$parcial_fee24)+($amt_feehead[25]+$parcial_fee25)+$total_previous_dues;
		//$code = 1;
		if($total_previous_dues > 0){
			foreach($feehead1 as $key=>$value){
				if($value->HType == 'DUES' || $value->HType == 'Dues')
				{
					$code = $value->ACT_CODE;
					$amt_feehead[$code] += $total_previous_dues;
				}
			}
		}
		
		$fee_amount = array(
			'amt_feehead1' => $amt_feehead[1]+$parcial_fee1,
			'amt_feehead2' => $amt_feehead[2]+$parcial_fee2,
			'amt_feehead3' => $amt_feehead[3]+$parcial_fee3,
			'amt_feehead4' => $amt_feehead[4]+$parcial_fee4,
			'amt_feehead5' => $amt_feehead[5]+$parcial_fee5,
			'amt_feehead6' => $amt_feehead[6]+$parcial_fee6,
			'amt_feehead7' => $amt_feehead[7]+$parcial_fee7,
			'amt_feehead8' => $amt_feehead[8]+$parcial_fee8,
			'amt_feehead9' => $amt_feehead[9]+$parcial_fee9,
			'amt_feehead10' => $amt_feehead[10]+$parcial_fee10,
			'amt_feehead11' => $amt_feehead[11]+$parcial_fee11,
			'amt_feehead12' => $amt_feehead[12]+$parcial_fee12,
			'amt_feehead13' => $amt_feehead[13]+$parcial_fee13,
			'amt_feehead14' => $amt_feehead[14]+$parcial_fee14,
			'amt_feehead15' => $amt_feehead[15]+$parcial_fee15,
			'amt_feehead16' => $amt_feehead[16]+$parcial_fee16,
			'amt_feehead17' => $amt_feehead[17]+$parcial_fee17,
			'amt_feehead18' => $amt_feehead[18]+$parcial_fee18,
			'amt_feehead19' => $amt_feehead[19]+$parcial_fee19,
			'amt_feehead20' => $amt_feehead[20]+$parcial_fee20,
			'amt_feehead21' => $amt_feehead[21]+$parcial_fee21,
			'amt_feehead22' => $amt_feehead[22]+$parcial_fee22,
			'amt_feehead23' => $amt_feehead[23]+$parcial_fee23,
			'amt_feehead24' => $amt_feehead[24]+$parcial_fee24,
			'amt_feehead25' => $amt_feehead[25]+$parcial_fee25,
		);
		$array = array(
				'apr'       => $aprr,
				'may'       => $mayy,
				'jun'       => $junn,
				'jul'       => $jull,
				'aug'       => $augg,
				'sep'       => $sepp,
				'oct'       => $octt,
				'nov'       => $novv,
				'dec'       => $decc,
				'jan'       => $jann,
				'feb'       => $febb,
				'mar'       => $marr,
				'fee_amount' => $fee_amount,
				'total_amount'  => $total_amount,
				'student_details' => $student_data,
				'ffm'			=> $ffm,
				'total_previous_dues' => $total_previous_dues,
				'feehead' => $feehead1
			);
		// print_r("<pre>");
		// print_r($array);exit();
		$array['sessiondata'] = json_encode($array);
		$this->session->set_userdata('paydata',$array);
		$this->session->set_userdata('allhead',$fee_amount);
		$this->Parent_templete('parents_dashboard/pay_details',$array);
	}
}
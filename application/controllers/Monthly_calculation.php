<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Monthly_calculation extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function get_pay_details()
	{
		$adm_no  	= $this->input->post('adm_no');
		//$rcpt_no 	= $this->input->post('rcpt_no');
		$ward_type  = $this->input->post('ward_type');
		$bsn		= $this->input->post('bsn');
		$bsa		= $this->input->post('bsa');
		$ffm		= $this->input->post('ffm');
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
		
		//fetching data from the data base//
		$student_data = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
		$session 	  = $this->dbcon->select('session_master','*',"Active_Status='1'");
		$payment_mode = $this->dbcon->select('payment_mode','*');
		$bank		  = $this->dbcon->select('bank_master','*');
		//end of fetching of data//
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
			// if($mid_month[0] == $FinMonth){
				// $mayy = '';
				// echo $mayy;
				// exit;
			// }else{
				// $mayy = $mayy1;
				// echo $mayy;
				// exit;
			// }
			// if($mid_month[0] != $FinMonth){
				// $junn = '';
			// }else{
				// $junn = $junn1;
			// }
			// if($mid_month[0] != $FinMonth){
				// $jull = '';
			// }else{
				// $jull = $jull1;
			// }
			// if($mid_month[0] != $FinMonth){
				// $augg = '';
			// }else{
				// $augg = $augg1;
			// }
			// if($mid_month[0] != $FinMonth){
				// $sepp = '';
			// }else{
				// $sepp = $sepp1;
			// }
			// if($mid_month[0] != $FinMonth){
				// $octt = '';
			// }else{
				// $octt = $octt1;
			// }
			// if($mid_month[0] != $FinMonth){
				// $novv = '';
			// }else{
				// $novv = $novv1;
			// }
			// if($mid_month[0] != $FinMonth){
				// $decc = '';
			// }else{
				// $decc = $decc1;
			// }
			// if($mid_month[0] != $FinMonth){
				// $jann = '';
			// }else{
				// $jann = $jann1;
			// }
			// if($mid_month[0] != $FinMonth){
				// $febb = '';
			// }else{
				// $febb = $febb1;
			// }
			// if($mid_month[0] != $FinMonth){
				// $marr = '';
			// }else{
				// $marr = $marr1;
			// }
		}
		IF(isset($stop_amt_code))
		{
			$stop_amt = $this->dbcon->select('stop_amt','*',"STOP_NO='$stop_amt_code'");
			//$stoppage_amounts = $stop_amt[0]->AMT;
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
			$Annual[$i]         = $feehead[$i][0]->Annual;
			
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
								if($aprr=='APR' && $APR[$i]==1)
								{
									$apr_date = $l_date_applied."-"."04"."-".$Session_Year;
									$apr_num = strtotime($apr_date);
									if($apr_num<=$sys_num)
									{
										$apr_fee = $l_late_amount;
									}else
									{
										$apr_fee = 0;
									}
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_date = $l_date_applied."-"."05"."-".$Session_Year;
									$may_num = strtotime($may_date);
									if($may_num<=$sys_num)
									{
										$may_fee = $l_late_amount;
									}else
									{
										$may_fee = 0;
									}
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_date = $l_date_applied."-"."06"."-".$Session_Year;
									$jun_num = strtotime($jun_date);
									if($jun_num<=$sys_num)
									{
										$jun_fee = $l_late_amount;
									}else
									{
										$jun_fee = 0;
									}
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_date = $l_date_applied."-"."07"."-".$Session_Year;
									$jul_num = strtotime($jul_date);
									if($jul_num<=$sys_num)
									{
										$jul_fee = $l_late_amount;
									}else
									{
										$jul_fee = 0;
									}
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_date = $l_date_applied."-"."08"."-".$Session_Year;
									$aug_num = strtotime($aug_date);
									if($aug_num<=$sys_num)
									{
										$aug_fee = $l_late_amount;
									}else
									{
										$aug_fee = 0;
									}
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_date = $l_date_applied."-"."09"."-".$Session_Year;
									$sep_num = strtotime($sep_date);
									if($sep_num<=$sys_num)
									{
										$sep_fee = $l_late_amount;
									}else
									{
										$sep_fee = 0;
									}
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_date = $l_date_applied."-"."10"."-".$Session_Year;
									$oct_num = strtotime($oct_date);
									if($oct_num<=$sys_num)
									{
										$oct_fee = $l_late_amount;
									}else
									{
										$oct_fee = 0;
									}
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_date = $l_date_applied."-"."11"."-".$Session_Year;
									$nov_num = strtotime($nov_date);
									if($nov_num<=$sys_num)
									{
										$nov_fee = $l_late_amount;
									}else
									{
										$nov_fee = 0;
									}
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_date = $l_date_applied."-"."12"."-".$Session_Year;
									$dec_num = strtotime($dec_date);
									if($dec_num<=$sys_num)
									{
										$dec_fee = $l_late_amount;
									}else
									{
										$dec_fee = 0;
									}
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$y = $Session_Year;
									$year = $y+1;
									$jan_date = $l_date_applied."-"."01"."-".$year;
									$jan_num = strtotime($jan_date);
									if($jan_num<=$sys_num)
									{
										$jan_fee = $l_late_amount;
									}else
									{
										$jan_fee = 0;
									}
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$y = $Session_Year;
									$year = $y+1;
									$feb_date = $l_date_applied."-"."02"."-".$year;
									$feb_num = strtotime($feb_date);
									if($feb_num<=$sys_num)
									{
										$feb_fee = $l_late_amount;
									}else
									{
										$feb_fee = 0;
									}
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$y = $Session_Year;
									$year = $y+1;
									$mar_date = $l_date_applied."-"."03"."-".$year;
									$mar_num = strtotime($mar_date);
									if($mar_num<=$sys_num)
									{
										$mar_fee = $l_late_amount;
									}else
									{
										$mar_fee = 0;
									}
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
			}else{
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
									$apr_fee = $h_fee-$s[$i];
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = $h_fee-$s[$i];
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = $h_fee-$s[$i];
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = $h_fee-$s[$i];
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = $h_fee-$s[$i];
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = $h_fee-$s[$i];
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = $h_fee-$s[$i];
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = $h_fee-$s[$i];
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = $h_fee-$s[$i];
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = $h_fee-$s[$i];
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = $h_fee-$s[$i];
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = $h_fee-$s[$i];
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
									$may_fee = $h_fee-$s[$i];
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = $h_fee-$s[$i];
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = $h_fee-$s[$i];
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = $h_fee-$s[$i];
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = $h_fee-$s[$i];
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = $h_fee-$s[$i];
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = $h_fee-$s[$i];
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = $h_fee-$s[$i];
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = $h_fee-$s[$i];
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = $h_fee-$s[$i];
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = $h_fee-$s[$i];
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
									$jun_fee = $h_fee-$s[$i];
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = $h_fee-$s[$i];
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = $h_fee-$s[$i];
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = $h_fee-$s[$i];
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = $h_fee-$s[$i];
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = $h_fee-$s[$i];
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = $h_fee-$s[$i];
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = $h_fee-$s[$i];
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = $h_fee-$s[$i];
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = $h_fee-$s[$i];
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
									$jul_fee = $h_fee-$s[$i];
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = $h_fee-$s[$i];
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = $h_fee-$s[$i];
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = $h_fee-$s[$i];
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = $h_fee-$s[$i];
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = $h_fee-$s[$i];
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = $h_fee-$s[$i];
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = $h_fee-$s[$i];
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = $h_fee-$s[$i];
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
									$aug_fee = $h_fee-$s[$i];
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = $h_fee-$s[$i];
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = $h_fee-$s[$i];
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = $h_fee-$s[$i];
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = $h_fee-$s[$i];
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = $h_fee-$s[$i];
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = $h_fee-$s[$i];
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = $h_fee-$s[$i];
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
									$sep_fee = $h_fee-$s[$i];
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = $h_fee-$s[$i];
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = $h_fee-$s[$i];
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = $h_fee-$s[$i];
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = $h_fee-$s[$i];
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = $h_fee-$s[$i];
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = $h_fee-$s[$i];
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
									$oct_fee = $h_fee-$s[$i];
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = $h_fee-$s[$i];
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = $h_fee-$s[$i];
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = $h_fee-$s[$i];
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = $h_fee-$s[$i];
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = $h_fee-$s[$i];
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
									$nov_fee = $h_fee-$s[$i];
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = $h_fee-$s[$i];
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = $h_fee-$s[$i];
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = $h_fee-$s[$i];
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = $h_fee-$s[$i];
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
									$dec_fee = $h_fee-$s[$i];
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = $h_fee-$s[$i];
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = $h_fee-$s[$i];
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = $h_fee-$s[$i];
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
									$jan_fee = $h_fee-$s[$i];
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = $h_fee-$s[$i];
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = $h_fee-$s[$i];
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
									$feb_fee = $h_fee-$s[$i];
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = $h_fee-$s[$i];
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
									$mar_fee = $h_fee-$s[$i];
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
									$apr_fee = $h_fee-$s[$i];
								}
								else
								{
									$apr_fee = 0;
								}
								if($mayy=='MAY' && $may[$i]==1)
								{
									$may_fee = $h_fee-$s[$i];
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = $h_fee-$s[$i];
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = $h_fee-$s[$i];
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = $h_fee-$s[$i];
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = $h_fee-$s[$i];
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = $h_fee-$s[$i];
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = $h_fee-$s[$i];
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = $h_fee-$s[$i];
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = $h_fee-$s[$i];
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = $h_fee-$s[$i];
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = $h_fee-$s[$i];
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
									$may_fee = $h_fee-$s[$i];
								}
								else
								{
									$may_fee = 0;
								}
								if($junn=='JUN' && $JUN[$i]==1)
								{
									$jun_fee = $h_fee-$s[$i];
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = $h_fee-$s[$i];
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = $h_fee-$s[$i];
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = $h_fee-$s[$i];
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = $h_fee-$s[$i];
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = $h_fee-$s[$i];
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = $h_fee-$s[$i];
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = $h_fee-$s[$i];
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = $h_fee-$s[$i];
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = $h_fee-$s[$i];
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
									$jun_fee = $h_fee-$s[$i];
								}
								else
								{
									$jun_fee = 0;
								}
								if($jull=='JUL' && $JUL[$i]==1)
								{
									$jul_fee = $h_fee-$s[$i];
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = $h_fee-$s[$i];
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = $h_fee-$s[$i];
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = $h_fee-$s[$i];
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = $h_fee-$s[$i];
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = $h_fee-$s[$i];
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = $h_fee-$s[$i];
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = $h_fee-$s[$i];
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = $h_fee-$s[$i];
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
									$jul_fee = $h_fee-$s[$i];
								}
								else
								{
									$jul_fee = 0;
								}
								if($augg=='AUG' && $AUG[$i]==1)
								{
									$aug_fee = $h_fee-$s[$i];
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = $h_fee-$s[$i];
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = $h_fee-$s[$i];
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = $h_fee-$s[$i];
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = $h_fee-$s[$i];
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = $h_fee-$s[$i];
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = $h_fee-$s[$i];
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = $h_fee-$s[$i];
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
									$aug_fee = $h_fee-$s[$i];
								}
								else
								{
									$aug_fee = 0;
								}
								if($sepp=='SEP' && $SEP[$i]==1)
								{
									$sep_fee = $h_fee-$s[$i];
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = $h_fee-$s[$i];
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = $h_fee-$s[$i];
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = $h_fee-$s[$i];
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = $h_fee-$s[$i];
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = $h_fee-$s[$i];
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = $h_fee-$s[$i];
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
									$sep_fee = $h_fee-$s[$i];
								}
								else
								{
									$sep_fee = 0;
								}
								if($octt=='OCT' && $OCT[$i]==1)
								{
									$oct_fee = $h_fee-$s[$i];
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = $h_fee-$s[$i];
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = $h_fee-$s[$i];
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = $h_fee-$s[$i];
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = $h_fee-$s[$i];
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = $h_fee-$s[$i];
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
									$oct_fee = $h_fee-$s[$i];
								}
								else
								{
									$oct_fee = 0;
								}
								if($novv=='NOV' && $NOV[$i]==1)
								{
									$nov_fee = $h_fee-$s[$i];
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = $h_fee-$s[$i];
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = $h_fee-$s[$i];
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = $h_fee-$s[$i];
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = $h_fee-$s[$i];
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
									$nov_fee = $h_fee-$s[$i];
								}
								else
								{
									$nov_fee = 0;
								}
								if($decc=='DEC' && $DECM[$i]==1)
								{
									$dec_fee = $h_fee-$s[$i];
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = $h_fee-$s[$i];
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = $h_fee-$s[$i];
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = $h_fee-$s[$i];
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
									$dec_fee = $h_fee-$s[$i];
								}
								else
								{
									$dec_fee = 0;
								}
								if($jann=='JAN' && $JAN[$i]==1)
								{
									$jan_fee = $h_fee-$s[$i];
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = $h_fee-$s[$i];
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = $h_fee-$s[$i];
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
									$jan_fee = $h_fee-$s[$i];
								}
								else
								{
									$jan_fee = 0;
								}
								if($febb=='FEB' && $FEB[$i]==1)
								{
									$feb_fee = $h_fee-$s[$i];
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = $h_fee-$s[$i];
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
									$feb_fee = $h_fee-$s[$i];
								}
								else
								{
									$feb_fee = 0;
								}
								if($marr=='MAR' && $MAR[$i]==1)
								{
									$mar_fee = $h_fee-$s[$i];
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
									$mar_fee = $h_fee-$s[$i];
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
												$apr_fee = $h_fee-$s[$i];
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
												$apr_fee = $h_fee-$s[$i];
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
												$apr_fee = $h_fee-$s[$i];
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
												$apr_fee = $h_fee-$s[$i];
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
		$total_amount = $amt_feehead[1]+$amt_feehead[2]+$amt_feehead[3]+$amt_feehead[4]+$amt_feehead[5]+$amt_feehead[6]+$amt_feehead[7]+$amt_feehead[8]+$amt_feehead[9]+$amt_feehead[10]+$amt_feehead[11]+$amt_feehead[12]+$amt_feehead[13]+$amt_feehead[14]+$amt_feehead[15]+$amt_feehead[16]+$amt_feehead[17]+$amt_feehead[18]+$amt_feehead[19]+$amt_feehead[20]+$amt_feehead[21]+$amt_feehead[22]+$amt_feehead[22]+$amt_feehead[23]+$amt_feehead[24]+$amt_feehead[25];
		$array = array(
				'adm_no' 	=> $admission_no,
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
				'apr'       => $aprr1,
				'may'       => $mayy1,
				'jun'       => $junn1,
				'jul'       => $jull1,
				'aug'       => $augg1,
				'sep'       => $sepp1,
				'oct'       => $octt1,
				'nov'       => $novv1,
				'dec'       => $decc1,
				'jan'       => $jann1,
				'feb'       => $febb1,
				'mar'       => $marr1,
				'amt_feehead1' => $amt_feehead[1],
				'amt_feehead2' => $amt_feehead[2],
				'amt_feehead3' => $amt_feehead[3],
				'amt_feehead4' => $amt_feehead[4],
				'amt_feehead5' => $amt_feehead[5],
				'amt_feehead6' => $amt_feehead[6],
				'amt_feehead7' => $amt_feehead[7],
				'amt_feehead8' => $amt_feehead[8],
				'amt_feehead9' => $amt_feehead[9],
				'amt_feehead10' => $amt_feehead[10],
				'amt_feehead11' => $amt_feehead[11],
				'amt_feehead12' => $amt_feehead[12],
				'amt_feehead13' => $amt_feehead[13],
				'amt_feehead14' => $amt_feehead[14],
				'amt_feehead15' => $amt_feehead[15],
				'amt_feehead16' => $amt_feehead[16],
				'amt_feehead17' => $amt_feehead[17],
				'amt_feehead18' => $amt_feehead[18],
				'amt_feehead19' => $amt_feehead[19],
				'amt_feehead20' => $amt_feehead[20],
				'amt_feehead21' => $amt_feehead[21],
				'amt_feehead22' => $amt_feehead[22],
				'amt_feehead23' => $amt_feehead[23],
				'amt_feehead24' => $amt_feehead[24],
				'amt_feehead25' => $amt_feehead[25],
				'total_amount'  => $total_amount,
				'payment_mode'  => $payment_mode,
				'bank'			=> $bank,
				'student_data'	=> $student_data,
				'ward_type'     => $ward_type,
				'bsn'           => $bsn,
				'bsa'			=> $bsa,
				'ffm'			=> $ffm
			);
			// echo "<pre>";
			// print_r($array);
			// exit;
			$this->load->view('Fee_collection/feehaead_calculation_monthwise',$array);
	}
}
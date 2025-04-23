<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feegeneration extends MY_Controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Mymodel','dbcon');
	}
	
	public function fee_generation_gui()
	{
		$month_master = $this->dbcon->select('month_master','*');
		$data = array('month_master' => $month_master);
		$this->fee_template('fees_master/feegeneration_gui',$data);
	}
	public function fee_generation()
	{
		$month1 = $this->input->post('month_generation');
		if($month1 == "JUN"){
			$stu_monthFee = "JUNE_FEE";
		}elseif($month1 == "JUL"){
			$stu_monthFee = "JULY_FEE";
		}else{
			$stu_monthFee = $month1."_FEE";
		}
		$data = $this->dbcon->select('student','*',"Student_Status='ACTIVE'");
		$session 	  = $this->dbcon->select('session_master','*',"Active_Status='1'");
		$feehead = $this->dbcon->select('feehead','*');
		$stu_details = $this->dbcon->select('feegeneration','COUNT(ADM_NO) AS TOTAL',"Month_NM='$month1'");
		$TOTAL_STUDENT = $stu_details[0]->TOTAL;
		$countfee = count($feehead);
		$count = count($data);
		$amt_feehead = array();
		$response=0;
		$array =  array();
		/* getting session year from database */
		if(isset($session))
		{
			$Session_ID = $session[0]->Session_ID;
			$Session_Nm = $session[0]->Session_Nm;
			$Session_Year = $session[0]->Session_Year;
			$Active_Status = $session[0]->Active_Status;
		}
		/* ending session data from database*/
		if($TOTAL_STUDENT>0)
		{
			echo 1;
		}
		else
		{
				for($i=0;$i<$count;$i++)
				{
					$stu_name  = $data[$i]->FIRST_NM;
					$STUDENTID = $data[$i]->STUDENTID;
					$ADM_NO    = $data[$i]->ADM_NO;
					$DISP_CLASS= $data[$i]->DISP_CLASS;
					$DISP_SEC  = $data[$i]->DISP_SEC;
					$ROLL_NO   = $data[$i]->ROLL_NO;
					$class     = $data[$i]->CLASS;
					$emp_ward  = $data[$i]->EMP_WARD;
					$hostel    = $data[$i]->HOSTEL;
					$COMPUTER  = $data[$i]->COMPUTER;
					$MUSIC    = $data[$i]->MUSIC;
					$SESSIONID = $data[$i]->SESSIONID;
					$SCHOLAR   = $data[$i]->SCHOLAR;
					$science   = $data[$i]->BUS_NO;
					$stop_amt_code= $data[$i]->STOPNO;
					$stu_aprfee   = $data[$i]->APR_FEE;
					$stu_midSessionStatus = $data[$i]->$stu_monthFee;
					$total_amount = 0;
					$adm_status   = $data[$i]->mid_session_admisson_status;
					$Admission_month = $data[$i]->Admission_month;
					
					$GetMonthData = $this->dbcon->select('month_master','month_name',"id='$Admission_month'");
					$FinMonth = $GetMonthData[0]->month_name;
					if($FinMonth == "JUN"){
						$MidUnpaidMonth = 'JUNE_FEE';
					}elseif($FinMonth == "JUL"){
						$MidUnpaidMonth = 'JULY_FEE';
					}else{
						$MidUnpaidMonth = $FinMonth.'_FEE';
					}
					$mid_ses_month_paid_status = $data[$i]->$MidUnpaidMonth;
					if($FinMonth == $month1){
						$month = "APR";
					}else{
						$month = $month1;
					}
					// IF($ADM_NO == 1031){
						// echo $Admission_month;
						// echo "<br>";
						// echo $FinMonth;
						// echo "<br>";
						// echo $month1;
						// echo "<br>";
						// echo $month;
						// die;
					// }
					if($SCHOLAR==1)
					{
						$scholar_data = $this->dbcon->select('scholarship','*',"ADM_NO='$ADM_NO'");
						if(!empty($scholar_data)){
							$s[0] = $scholar_data[0]->S1;
							$s[1] = $scholar_data[0]->S2;
							$s[2] = $scholar_data[0]->S3;
							$s[3] = $scholar_data[0]->S4;
							$s[4] = $scholar_data[0]->S5;
							$s[5] = $scholar_data[0]->S6;
							$s[6] = $scholar_data[0]->S7;
							$s[7] = $scholar_data[0]->S8;
							$s[8] = $scholar_data[0]->S9;
							$s[9] = $scholar_data[0]->S10;
							$s[10] = $scholar_data[0]->S11;
							$s[11] = $scholar_data[0]->S12;
							$s[12] = $scholar_data[0]->S13;
							$s[13] = $scholar_data[0]->S14;
							$s[14] = $scholar_data[0]->S15;
							$s[15] = $scholar_data[0]->S16;
							$s[16] = $scholar_data[0]->S17;
							$s[17] = $scholar_data[0]->S18;
							$s[18] = $scholar_data[0]->S19;
							$s[19] = $scholar_data[0]->S20;
							$s[20] = $scholar_data[0]->S21;
							$s[21] = $scholar_data[0]->S22;
							$s[22] = $scholar_data[0]->S23;
							$s[23] = $scholar_data[0]->S24;
							$s[24] = $scholar_data[0]->S25;
							$Apply_From = $scholar_data[0]->Apply_From;
						}else{
							$s[0] = 0;
							$s[1] = 0;
							$s[2] = 0;
							$s[3] = 0;
							$s[4] = 0;
							$s[5] = 0;
							$s[6] = 0;
							$s[7] = 0;
							$s[8] = 0;
							$s[9] = 0;
							$s[10] = 0;
							$s[11] = 0;
							$s[12] = 0;
							$s[13] = 0;
							$s[14] = 0;
							$s[15] = 0;
							$s[16] = 0;
							$s[17] = 0;
							$s[18] = 0;
							$s[19] = 0;
							$s[20] = 0;
							$s[21] = 0;
							$s[22] = 0;
							$s[23] = 0;
							$s[24] = 0;
							$Apply_From = "";
						}
					}
					if($stu_midSessionStatus != "ADMITTED"){
						
						for($j=0;$j<$countfee;$j++)
						{
							$act_code[$j] 	= $feehead[$j]->ACT_CODE;
							$fee_head[$j] 	= $feehead[$j]->FEE_HEAD;
							$monthly[$j] 	= $feehead[$j]->MONTHLY;
							$CL_BASED[$j]	= $feehead[$j]->CL_BASED;
							$AMOUNT[$j]		= $feehead[$j]->AMOUNT;
							$EMP[$j]		= $feehead[$j]->EMP;
							$CCL[$j]		= $feehead[$j]->CCL;
							$SPL[$j]		= $feehead[$j]->SPL;
							$EXT[$j]		= $feehead[$j]->EXT;
							$INTERNAL[$j]	= $feehead[$j]->INTERNAL;
							$HType[$j]		= $feehead[$j]->HType;
							$APR[$j]		= $feehead[$j]->APR;
							$may[$j]		= $feehead[$j]->may;
							$JUN[$j]		= $feehead[$j]->JUN;
							$JUL[$j]		= $feehead[$j]->JUL;
							$AUG[$j]		= $feehead[$j]->AUG;
							$SEP[$j]		= $feehead[$j]->SEP;
							$OCT[$j]		= $feehead[$j]->OCT;
							$NOV[$j]		= $feehead[$j]->NOV;
							$DECM[$j]		= $feehead[$j]->DECM;
							$JAN[$j]		= $feehead[$j]->JAN;
							$FEB[$j]		= $feehead[$j]->FEB;
							$MAR[$j]		= $feehead[$j]->MAR;
							
							// fetching data from the database //
							$feeclw   = $this->dbcon->select('fee_clw','*',"FH='$act_code[$j]' AND CL='$class'");
							$feeclw_AMOUNT[$j]   = $feeclw[0]->AMOUNT;
							$feeclw_EMP[$j]      = $feeclw[0]->EMP;
							$feeclw_CCL[$j]      = $feeclw[0]->CCL;
							$feeclw_SPL[$j]      = $feeclw[0]->SPL;
							$feeclw_EXT[$j]      = $feeclw[0]->EXT;
							$feeclw_INTERNAL[$j] = $feeclw[0]->INTERNAL;
							// end of the fetching data form the feeclw //
							if($HType[$j]=='BUS'){
								if($monthly[$j]==1){
									if($month1=='APR' && $APR[$j]==1)
									{
										$apr_data = $this->dbcon->getbusamountmonthwise('APR_FEE',$ADM_NO,'1');
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
									if($month1=='MAY' && $may[$j]==1)
									{
										$apr_data = $this->dbcon->getbusamountmonthwise('MAY_FEE',$ADM_NO,'2');
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
									if($month1=='JUN' && $JUN[$j]==1)
									{
										$apr_data = $this->dbcon->getbusamountmonthwise('JUN_FEE',$ADM_NO,'3');
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
									if($month1=='JUL' && $JUL[$j]==1)
									{
										$apr_data = $this->dbcon->getbusamountmonthwise('JUL_FEE',$ADM_NO,'4');
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
									if($month1=='AUG' && $AUG[$j]==1)
									{
										$apr_data = $this->dbcon->getbusamountmonthwise('AUG_FEE',$ADM_NO,'5');
										
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
									if($month1=='SEP' && $SEP[$j]==1)
									{
										$apr_data = $this->dbcon->getbusamountmonthwise('SEP_FEE',$ADM_NO,'6');
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
									if($month1=='OCT' && $OCT[$j]==1)
									{
										$apr_data = $this->dbcon->getbusamountmonthwise('OCT_FEE',$ADM_NO,'7');
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
									if($month1=='NOV' && $NOV[$j]==1)
									{
										$apr_data = $this->dbcon->getbusamountmonthwise('NOV_FEE',$ADM_NO,'8');
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
									if($month1=='DEC' && $DECM[$j]==1)
									{
										$apr_data = $this->dbcon->getbusamountmonthwise('DEC_FEE',$ADM_NO,'9');
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
									if($month1=='JAN' && $JAN[$j]==1)
									{
										$apr_data = $this->dbcon->getbusamountmonthwise('JAN_FEE',$ADM_NO,'10');
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
									if($month1=='FEB' && $FEB[$j]==1)
									{
										$apr_data = $this->dbcon->getbusamountmonthwise('FEB_FEE',$ADM_NO,'11');
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
									if($month1=='MAR' && $MAR[$j]==1)
									{
										$apr_data = $this->dbcon->getbusamountmonthwise('MAR_FEE',$ADM_NO,'12');
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
									$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
								}
								else{
									$amt_feehead[$j] = 0;
								}
							}
							else
							{
								if($monthly[$j]==1) // calculation for the month base fee which is old student //
								{
								if($CL_BASED[$j]==1) // calculation on the basis of class base //
								{
									switch($emp_ward)
									{
										case 1:
										$amt_fee = $feeclw_AMOUNT[$j];
										break;
										case 2:
										$amt_fee = $feeclw_EMP[$j];
										break;
										case 3:
										$amt_fee = $feeclw_CCL[$j];
										break;
										case 4:
										$amt_fee = $feeclw_SPL[$j];
										break;
										case 5:
										$amt_fee = $feeclw_EXT[$j];
										break;
										case 6:
										$amt_fee = $feeclw_INTERNAL
											
											[$j];
										break;
										default:
										$amt_fee = 0;
										break;
									}
									
									// Checking the head type of the student //
									if($HType[$j]=='No')
									{
										$h_fee = $amt_fee;
									}
									elseif($HType[$j]=='COMPUTER')
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
									elseif ($HType[$j] == 'MUSIC') {
										if ($MUSIC == 1) {
											$h_fee = $amt_fee;
										} else {
											$h_fee = 0;
										}
									}
									elseif($HType[$j]=='SCIENCE')
									{
										$h_fee = $amt_fee*$science;
									}
									ELSEIF($HType[$j]=='HOSTEL')
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
									ELSEIF($HType[$j]=='BOOK')
									{
										$h_fee = $amt_fee;
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
											if($month=='APR' && $APR[$j]==1)
											{
												$apr_fee = $h_fee-$s[$j];
											}
											else
											{
												$apr_fee = 0;
											}
											if($month=='MAY' && $may[$j]==1)
											{
												$may_fee = $h_fee-$s[$j];
											}
											else
											{
												$may_fee = 0;
											}
											if($month=='JUN' && $JUN[$j]==1)
											{
												$jun_fee = $h_fee-$s[$j];
											}
											else
											{
												$jun_fee = 0;
											}
											if($month=='JUL' && $JUL[$j]==1)
											{
												$jul_fee = $h_fee-$s[$j];
											}
											else
											{
												$jul_fee = 0;
											}
											if($month=='AUG' && $AUG[$j]==1)
											{
												$aug_fee = $h_fee-$s[$j];
											}
											else
											{
												$aug_fee = 0;
											}
											if($month=='SEP' && $SEP[$j]==1)
											{
												$sep_fee = $h_fee-$s[$j];
											}
											else
											{
												$sep_fee = 0;
											}
											if($month=='OCT' && $OCT[$j]==1)
											{
												$oct_fee = $h_fee-$s[$j];
											}
											else
											{
												$oct_fee = 0;
											}
											if($month=='NOV' && $NOV[$j]==1)
											{
												$nov_fee = $h_fee-$s[$j];
											}
											else
											{
												$nov_fee = 0;
											}
											if($month=='DEC' && $DECM[$j]==1)
											{
												$dec_fee = $h_fee-$s[$j];
											}
											else
											{
												$dec_fee = 0;
											}
											if($month=='JAN' && $JAN[$j]==1)
											{
												$jan_fee = $h_fee-$s[$j];
											}
											else
											{
												$jan_fee = 0;
											}
											if($month=='FEB' && $FEB[$j]==1)
											{
												$feb_fee = $h_fee-$s[$j];
											}
											else
											{
												$feb_fee = 0;
											}
											if($month=='MAR' && $MAR[$j]==1)
											{
												$mar_fee = $h_fee-$s[$j];
											}
											else
											{
												$mar_fee = 0;
											}
											$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
										}
										elseif($Apply_From=='MAY') //  scholar ship given from may month
										{
											if($month=='APR' && $APR[$j]==1)
											{
												$apr_fee = $h_fee;
											}
											else
											{
												$apr_fee = 0;
											}
											if($month=='MAY' && $may[$j]==1)
											{
												$may_fee = $h_fee-$s[$j];
											}
											else
											{
												$may_fee = 0;
											}
											if($month=='JUN' && $JUN[$j]==1)
											{
												$jun_fee = $h_fee-$s[$j];
											}
											else
											{
												$jun_fee = 0;
											}
											if($month=='JUL' && $JUL[$j]==1)
											{
												$jul_fee = $h_fee-$s[$j];
											}
											else
											{
												$jul_fee = 0;
											}
											if($month=='AUG' && $AUG[$j]==1)
											{
												$aug_fee = $h_fee-$s[$j];
											}
											else
											{
												$aug_fee = 0;
											}
											if($month=='SEP' && $SEP[$j]==1)
											{
												$sep_fee = $h_fee-$s[$j];
											}
											else
											{
												$sep_fee = 0;
											}
											if($month=='OCT' && $OCT[$j]==1)
											{
												$oct_fee = $h_fee-$s[$j];
											}
											else
											{
												$oct_fee = 0;
											}
											if($month=='NOV' && $NOV[$j]==1)
											{
												$nov_fee = $h_fee-$s[$j];
											}
											else
											{
												$nov_fee = 0;
											}
											if($month=='DEC' && $DECM[$j]==1)
											{
												$dec_fee = $h_fee-$s[$j];
											}
											else
											{
												$dec_fee = 0;
											}
											if($month=='JAN' && $JAN[$j]==1)
											{
												$jan_fee = $h_fee-$s[$j];
											}
											else
											{
												$jan_fee = 0;
											}
											if($month=='FEB' && $FEB[$j]==1)
											{
												$feb_fee = $h_fee-$s[$j];
											}
											else
											{
												$feb_fee = 0;
											}
											if($month=='MAR' && $MAR[$j]==1)
											{
												$mar_fee = $h_fee-$s[$j];
											}
											else
											{
												$mar_fee = 0;
											}
											$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
										}
										elseif($Apply_From=='JUN') // scholar given by jun month
										{
											if($month=='APR' && $APR[$j]==1)
											{
												$apr_fee = $h_fee;
											}
											else
											{
												$apr_fee = 0;
											}
											if($month=='MAY' && $may[$j]==1)
											{
												$may_fee = $h_fee;
											}
											else
											{
												$may_fee = 0;
											}
											if($month=='JUN' && $JUN[$j]==1)
											{
												$jun_fee = $h_fee-$s[$j];
											}
											else
											{
												$jun_fee = 0;
											}
											if($month=='JUL' && $JUL[$j]==1)
											{
												$jul_fee = $h_fee-$s[$j];
											}
											else
											{
												$jul_fee = 0;
											}
											if($month=='AUG' && $AUG[$j]==1)
											{
												$aug_fee = $h_fee-$s[$j];
											}
											else
											{
												$aug_fee = 0;
											}
											if($month=='SEP' && $SEP[$j]==1)
											{
												$sep_fee = $h_fee-$s[$j];
											}
											else
											{
												$sep_fee = 0;
											}
											if($month=='OCT' && $OCT[$j]==1)
											{
												$oct_fee = $h_fee-$s[$j];
											}
											else
											{
												$oct_fee = 0;
											}
											if($month=='NOV' && $NOV[$j]==1)
											{
												$nov_fee = $h_fee-$s[$j];
											}
											else
											{
												$nov_fee = 0;
											}
											if($month=='DEC' && $DECM[$j]==1)
											{
												$dec_fee = $h_fee-$s[$j];
											}
											else
											{
												$dec_fee = 0;
											}
											if($month=='JAN' && $JAN[$j]==1)
											{
												$jan_fee = $h_fee-$s[$j];
											}
											else
											{
												$jan_fee = 0;
											}
											if($month=='FEB' && $FEB[$j]==1)
											{
												$feb_fee = $h_fee-$s[$j];
											}
											else
											{
												$feb_fee = 0;
											}
											if($month=='MAR' && $MAR[$j]==1)
											{
												$mar_fee = $h_fee-$s[$j];
											}
											else
											{
												$mar_fee = 0;
											}
											$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
										}
										elseif($Apply_From=='JUl') // scholar given from jul
										{
											if($month=='APR' && $APR[$j]==1)
											{
												$apr_fee = $h_fee;
											}
											else
											{
												$apr_fee = 0;
											}
											if($month=='MAY' && $may[$j]==1)
											{
												$may_fee = $h_fee;
											}
											else
											{
												$may_fee = 0;
											}
											if($month=='JUN' && $JUN[$j]==1)
											{
												$jun_fee = $h_fee;
											}
											else
											{
												$jun_fee = 0;
											}
											if($month=='JUL' && $JUL[$j]==1)
											{
												$jul_fee = $h_fee-$s[$j];
											}
											else
											{
												$jul_fee = 0;
											}
											if($month=='AUG' && $AUG[$j]==1)
											{
												$aug_fee = $h_fee-$s[$j];
											}
											else
											{
												$aug_fee = 0;
											}
											if($month=='SEP' && $SEP[$j]==1)
											{
												$sep_fee = $h_fee-$s[$j];
											}
											else
											{
												$sep_fee = 0;
											}
											if($month=='OCT' && $OCT[$j]==1)
											{
												$oct_fee = $h_fee-$s[$j];
											}
											else
											{
												$oct_fee = 0;
											}
											if($month=='NOV' && $NOV[$j]==1)
											{
												$nov_fee = $h_fee-$s[$j];
											}
											else
											{
												$nov_fee = 0;
											}
											if($month=='DEC' && $DECM[$j]==1)
											{
												$dec_fee = $h_fee-$s[$j];
											}
											else
											{
												$dec_fee = 0;
											}
											if($month=='JAN' && $JAN[$j]==1)
											{
												$jan_fee = $h_fee-$s[$j];
											}
											else
											{
												$jan_fee = 0;
											}
											if($month=='FEB' && $FEB[$j]==1)
											{
												$feb_fee = $h_fee-$s[$j];
											}
											else
											{
												$feb_fee = 0;
											}
											if($month=='MAR' && $MAR[$j]==1)
											{
												$mar_fee = $h_fee-$s[$j];
											}
											else
											{
												$mar_fee = 0;
											}
											$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
										}
										elseif($Apply_From=='AUG') // scholar given by aug
										{
											if($month=='APR' && $APR[$j]==1)
											{
												$apr_fee = $h_fee;
											}
											else
											{
												$apr_fee = 0;
											}
											if($month=='MAY' && $may[$j]==1)
											{
												$may_fee = $h_fee;
											}
											else
											{
												$may_fee = 0;
											}
											if($month=='JUN' && $JUN[$j]==1)
											{
												$jun_fee = $h_fee;
											}
											else
											{
												$jun_fee = 0;
											}
											if($month=='JUL' && $JUL[$j]==1)
											{
												$jul_fee = $h_fee;
											}
											else
											{
												$jul_fee = 0;
											}
											if($month=='AUG' && $AUG[$j]==1)
											{
												$aug_fee = $h_fee-$s[$j];
												
											}
											else
											{
												$aug_fee = 0;
											}
											if($month=='SEP' && $SEP[$j]==1)
											{
												$sep_fee = $h_fee-$s[$j];
											}
											else
											{
												$sep_fee = 0;
											}
											if($month=='OCT' && $OCT[$j]==1)
											{
												$oct_fee = $h_fee-$s[$j];
											}
											else
											{
												$oct_fee = 0;
											}
											if($month=='NOV' && $NOV[$j]==1)
											{
												$nov_fee = $h_fee-$s[$j];
											}
											else
											{
												$nov_fee = 0;
											}
											if($month=='DEC' && $DECM[$j]==1)
											{
												$dec_fee = $h_fee-$s[$j];
											}
											else
											{
												$dec_fee = 0;
											}
											if($month=='JAN' && $JAN[$j]==1)
											{
												$jan_fee = $h_fee-$s[$j];
											}
											else
											{
												$jan_fee = 0;
											}
											if($month=='FEB' && $FEB[$j]==1)
											{
												$feb_fee = $h_fee-$s[$j];
											}
											else
											{
												$feb_fee = 0;
											}
											if($month=='MAR' && $MAR[$j]==1)
											{
												$mar_fee = $h_fee-$s[$j];
											}
											else
											{
												$mar_fee = 0;
											}
											$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
											// if($ADM_NO == 1031){
													// echo $amt_feehead[$j];
													// exit;
												// }
										}
										elseif($Apply_From=='SEP') // scholar given by sep
										{
											if($month=='APR' && $APR[$j]==1)
											{
												$apr_fee = $h_fee;
											}
											else
											{
												$apr_fee = 0;
											}
											if($month=='MAY' && $may[$j]==1)
											{
												$may_fee = $h_fee;
											}
											else
											{
												$may_fee = 0;
											}
											if($month=='JUN' && $JUN[$j]==1)
											{
												$jun_fee = $h_fee;
											}
											else
											{
												$jun_fee = 0;
											}
											if($month=='JUL' && $JUL[$j]==1)
											{
												$jul_fee = $h_fee;
											}
											else
											{
												$jul_fee = 0;
											}
											if($month=='AUG' && $AUG[$j]==1)
											{
												$aug_fee = $h_fee;
											}
											else
											{
												$aug_fee = 0;
											}
											if($month=='SEP' && $SEP[$j]==1)
											{
												$sep_fee = $h_fee-$s[$j];
											}
											else
											{
												$sep_fee = 0;
											}
											if($month=='OCT' && $OCT[$j]==1)
											{
												$oct_fee = $h_fee-$s[$j];
											}
											else
											{
												$oct_fee = 0;
											}
											if($month=='NOV' && $NOV[$j]==1)
											{
												$nov_fee = $h_fee-$s[$j];
											}
											else
											{
												$nov_fee = 0;
											}
											if($month=='DEC' && $DECM[$j]==1)
											{
												$dec_fee = $h_fee-$s[$j];
											}
											else
											{
												$dec_fee = 0;
											}
											if($month=='JAN' && $JAN[$j]==1)
											{
												$jan_fee = $h_fee-$s[$j];
											}
											else
											{
												$jan_fee = 0;
											}
											if($month=='FEB' && $FEB[$j]==1)
											{
												$feb_fee = $h_fee-$s[$j];
											}
											else
											{
												$feb_fee = 0;
											}
											if($month=='MAR' && $MAR[$j]==1)
											{
												$mar_fee = $h_fee-$s[$j];
											}
											else
											{
												$mar_fee = 0;
											}
											$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
										}
										elseif($Apply_From=='OCT')  // scholar given by oct month
										{
											if($month=='APR' && $APR[$j]==1)
											{
												$apr_fee = $h_fee;
											}
											else
											{
												$apr_fee = 0;
											}
											if($month=='MAY' && $may[$j]==1)
											{
												$may_fee = $h_fee;
											}
											else
											{
												$may_fee = 0;
											}
											if($month=='JUN' && $JUN[$j]==1)
											{
												$jun_fee = $h_fee;
											}
											else
											{
												$jun_fee = 0;
											}
											if($month=='JUL' && $JUL[$j]==1)
											{
												$jul_fee = $h_fee;
											}
											else
											{
												$jul_fee = 0;
											}
											if($month=='AUG' && $AUG[$j]==1)
											{
												$aug_fee = $h_fee;
											}
											else
											{
												$aug_fee = 0;
											}
											if($month=='SEP' && $SEP[$j]==1)
											{
												$sep_fee = $h_fee;
											}
											else
											{
												$sep_fee = 0;
											}
											if($month=='OCT' && $OCT[$j]==1)
											{
												$oct_fee = $h_fee-$s[$j];
											}
											else
											{
												$oct_fee = 0;
											}
											if($month=='NOV' && $NOV[$j]==1)
											{
												$nov_fee = $h_fee-$s[$j];
											}
											else
											{
												$nov_fee = 0;
											}
											if($month=='DEC' && $DECM[$j]==1)
											{
												$dec_fee = $h_fee-$s[$j];
											}
											else
											{
												$dec_fee = 0;
											}
											if($month=='JAN' && $JAN[$j]==1)
											{
												$jan_fee = $h_fee-$s[$j];
											}
											else
											{
												$jan_fee = 0;
											}
											if($month=='FEB' && $FEB[$j]==1)
											{
												$feb_fee = $h_fee-$s[$j];
											}
											else
											{
												$feb_fee = 0;
											}
											if($month=='MAR' && $MAR[$j]==1)
											{
												$mar_fee = $h_fee-$s[$j];
											}
											else
											{
												$mar_fee = 0;
											}
											$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
										}
										elseif($Apply_From=='NOV') // scholar given by nov month //
										{
											if($month=='APR' && $APR[$j]==1)
											{
												$apr_fee = $h_fee;
											}
											else
											{
												$apr_fee = 0;
											}
											if($month=='MAY' && $may[$j]==1)
											{
												$may_fee = $h_fee;
											}
											else
											{
												$may_fee = 0;
											}
											if($month=='JUN' && $JUN[$j]==1)
											{
												$jun_fee = $h_fee;
											}
											else
											{
												$jun_fee = 0;
											}
											if($month=='JUL' && $JUL[$j]==1)
											{
												$jul_fee = $h_fee;
											}
											else
											{
												$jul_fee = 0;
											}
											if($month=='AUG' && $AUG[$j]==1)
											{
												$aug_fee = $h_fee;
											}
											else
											{
												$aug_fee = 0;
											}
											if($month=='SEP' && $SEP[$j]==1)
											{
												$sep_fee = $h_fee;
											}
											else
											{
												$sep_fee = 0;
											}
											if($month=='OCT' && $OCT[$j]==1)
											{
												$oct_fee = $h_fee;
											}
											else
											{
												$oct_fee = 0;
											}
											if($month=='NOV' && $NOV[$j]==1)
											{
												$nov_fee = $h_fee-$s[$j];
											}
											else
											{
												$nov_fee = 0;
											}
											if($month=='DEC' && $DECM[$j]==1)
											{
												$dec_fee = $h_fee-$s[$j];
											}
											else
											{
												$dec_fee = 0;
											}
											if($month=='JAN' && $JAN[$j]==1)
											{
												$jan_fee = $h_fee-$s[$j];
											}
											else
											{
												$jan_fee = 0;
											}
											if($month=='FEB' && $FEB[$j]==1)
											{
												$feb_fee = $h_fee-$s[$j];
											}
											else
											{
												$feb_fee = 0;
											}
											if($month=='MAR' && $MAR[$j]==1)
											{
												$mar_fee = $h_fee-$s[$j];
											}
											else
											{
												$mar_fee = 0;
											}
											$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
										}
										elseif($Apply_From=='DEC') // scholar given from dec month //
										{
											if($month=='APR' && $APR[$j]==1)
											{
												$apr_fee = $h_fee;
											}
											else
											{
												$apr_fee = 0;
											}
											if($month=='MAY' && $may[$j]==1)
											{
												$may_fee = $h_fee;
											}
											else
											{
												$may_fee = 0;
											}
											if($month=='JUN' && $JUN[$j]==1)
											{
												$jun_fee = $h_fee;
											}
											else
											{
												$jun_fee = 0;
											}
											if($month=='JUL' && $JUL[$j]==1)
											{
												$jul_fee = $h_fee;
											}
											else
											{
												$jul_fee = 0;
											}
											if($month=='AUG' && $AUG[$j]==1)
											{
												$aug_fee = $h_fee;
											}
											else
											{
												$aug_fee = 0;
											}
											if($month=='SEP' && $SEP[$j]==1)
											{
												$sep_fee = $h_fee;
											}
											else
											{
												$sep_fee = 0;
											}
											if($month=='OCT' && $OCT[$j]==1)
											{
												$oct_fee = $h_fee;
											}
											else
											{
												$oct_fee = 0;
											}
											if($month=='NOV' && $NOV[$j]==1)
											{
												$nov_fee = $h_fee;
											}
											else
											{
												$nov_fee = 0;
											}
											if($month=='DEC' && $DECM[$j]==1)
											{
												$dec_fee = $h_fee-$s[$j];
											}
											else
											{
												$dec_fee = 0;
											}
											if($month=='JAN' && $JAN[$j]==1)
											{
												$jan_fee = $h_fee-$s[$j];
											}
											else
											{
												$jan_fee = 0;
											}
											if($month=='FEB' && $FEB[$j]==1)
											{
												$feb_fee = $h_fee-$s[$j];
											}
											else
											{
												$feb_fee = 0;
											}
											if($month=='MAR' && $MAR[$j]==1)
											{
												$mar_fee = $h_fee-$s[$j];
											}
											else
											{
												$mar_fee = 0;
											}
											$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
										}
										elseif($Apply_From=='JAN') // scholar given from jan month //
										{
											if($month=='APR' && $APR[$j]==1)
											{
												$apr_fee = $h_fee;
											}
											else
											{
												$apr_fee = 0;
											}
											if($month=='MAY' && $may[$j]==1)
											{
												$may_fee = $h_fee;
											}
											else
											{
												$may_fee = 0;
											}
											if($month=='JUN' && $JUN[$j]==1)
											{
												$jun_fee = $h_fee;
											}
											else
											{
												$jun_fee = 0;
											}
											if($month=='JUL' && $JUL[$j]==1)
											{
												$jul_fee = $h_fee;
											}
											else
											{
												$jul_fee = 0;
											}
											if($month=='AUG' && $AUG[$j]==1)
											{
												$aug_fee = $h_fee;
											}
											else
											{
												$aug_fee = 0;
											}
											if($month=='SEP' && $SEP[$j]==1)
											{
												$sep_fee = $h_fee;
											}
											else
											{
												$sep_fee = 0;
											}
											if($month=='OCT' && $OCT[$j]==1)
											{
												$oct_fee = $h_fee;
											}
											else
											{
												$oct_fee = 0;
											}
											if($month=='NOV' && $NOV[$j]==1)
											{
												$nov_fee = $h_fee;
											}
											else
											{
												$nov_fee = 0;
											}
											if($month=='DEC' && $DECM[$j]==1)
											{
												$dec_fee = $h_fee;
											}
											else
											{
												$dec_fee = 0;
											}
											if($month=='JAN' && $JAN[$j]==1)
											{
												$jan_fee = $h_fee-$s[$j];
											}
											else
											{
												$jan_fee = 0;
											}
											if($month=='FEB' && $FEB[$j]==1)
											{
												$feb_fee = $h_fee-$s[$j];
											}
											else
											{
												$feb_fee = 0;
											}
											if($month=='MAR' && $MAR[$j]==1)
											{
												$mar_fee = $h_fee-$s[$j];
											}
											else
											{
												$mar_fee = 0;
											}
											$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
										}
										elseif($Apply_From=='FEB') // scholar given from  feb month //
										{
											if($month=='APR' && $APR[$j]==1)
											{
												$apr_fee = $h_fee;
											}
											else
											{
												$apr_fee = 0;
											}
											if($month=='MAY' && $may[$j]==1)
											{
												$may_fee = $h_fee;
											}
											else
											{
												$may_fee = 0;
											}
											if($month=='JUN' && $JUN[$j]==1)
											{
												$jun_fee = $h_fee;
											}
											else
											{
												$jun_fee = 0;
											}
											if($month=='JUL' && $JUL[$j]==1)
											{
												$jul_fee = $h_fee;
											}
											else
											{
												$jul_fee = 0;
											}
											if($month=='AUG' && $AUG[$j]==1)
											{
												$aug_fee = $h_fee;
											}
											else
											{
												$aug_fee = 0;
											}
											if($month=='SEP' && $SEP[$j]==1)
											{
												$sep_fee = $h_fee;
											}
											else
											{
												$sep_fee = 0;
											}
											if($month=='OCT' && $OCT[$j]==1)
											{
												$oct_fee = $h_fee;
											}
											else
											{
												$oct_fee = 0;
											}
											if($month=='NOV' && $NOV[$j]==1)
											{
												$nov_fee = $h_fee;
											}
											else
											{
												$nov_fee = 0;
											}
											if($month=='DEC' && $DECM[$j]==1)
											{
												$dec_fee = $h_fee;
											}
											else
											{
												$dec_fee = 0;
											}
											if($month=='JAN' && $JAN[$j]==1)
											{
												$jan_fee = $h_fee;
											}
											else
											{
												$jan_fee = 0;
											}
											if($month=='FEB' && $FEB[$j]==1)
											{
												$feb_fee = $h_fee-$s[$j];
											}
											else
											{
												$feb_fee = 0;
											}
											if($month=='MAR' && $MAR[$j]==1)
											{
												$mar_fee = $h_fee-$s[$j];
											}
											else
											{
												$mar_fee = 0;
											}
											$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
										}
										elseif($Apply_From=='MAR') // scholar given from mar month //
										{
											if($month=='APR' && $APR[$j]==1)
											{
												$apr_fee = $h_fee;
											}
											else
											{
												$apr_fee = 0;
											}
											if($month=='MAY' && $may[$j]==1)
											{
												$may_fee = $h_fee;
											}
											else
											{
												$may_fee = 0;
											}
											if($month=='JUN' && $JUN[$j]==1)
											{
												$jun_fee = $h_fee;
											}
											else
											{
												$jun_fee = 0;
											}
											if($month=='JUL' && $JUL[$j]==1)
											{
												$jul_fee = $h_fee;
											}
											else
											{
												$jul_fee = 0;
											}
											if($month=='AUG' && $AUG[$j]==1)
											{
												$aug_fee = $h_fee;
											}
											else
											{
												$aug_fee = 0;
											}
											if($month=='SEP' && $SEP[$j]==1)
											{
												$sep_fee = $h_fee;
											}
											else
											{
												$sep_fee = 0;
											}
											if($month=='OCT' && $OCT[$j]==1)
											{
												$oct_fee = $h_fee;
											}
											else
											{
												$oct_fee = 0;
											}
											if($month=='NOV' && $NOV[$j]==1)
											{
												$nov_fee = $h_fee;
											}
											else
											{
												$nov_fee = 0;
											}
											if($month=='DEC' && $DECM[$j]==1)
											{
												$dec_fee = $h_fee;
											}
											else
											{
												$dec_fee = 0;
											}
											if($month=='JAN' && $JAN[$j]==1)
											{
												$jan_fee = $h_fee;
											}
											else
											{
												$jan_fee = 0;
											}
											if($month=='FEB' && $FEB[$j]==1)
											{
												$feb_fee = $h_fee;
											}
											else
											{
												$feb_fee = 0;
											}
											if($month=='MAR' && $MAR[$j]==1)
											{
												$mar_fee = $h_fee-$s[$j];
											}
											else
											{
												$mar_fee = 0;
											}
											$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
										}
										else // scholar without any month //
										{
											if($month=='APR' && $APR[$j]==1)
											{
												$apr_fee = $h_fee;
											}
											else
											{
												$apr_fee = 0;
											}
											if($month=='MAY' && $may[$j]==1)
											{
												$may_fee = $h_fee;
											}
											else
											{
												$may_fee = 0;
											}
											if($month=='JUN' && $JUN[$j]==1)
											{
												$jun_fee = $h_fee;
											}
											else
											{
												$jun_fee = 0;
											}
											if($month=='JUL' && $JUL[$j]==1)
											{
												$jul_fee = $h_fee;
											}
											else
											{
												$jul_fee = 0;
											}
											if($month=='AUG' && $AUG[$j]==1)
											{
												$aug_fee = $h_fee;
											}
											else
											{
												$aug_fee = 0;
											}
											if($month=='SEP' && $SEP[$j]==1)
											{
												$sep_fee = $h_fee;
											}
											else
											{
												$sep_fee = 0;
											}
											if($month=='OCT' && $OCT[$j]==1)
											{
												$oct_fee = $h_fee;
											}
											else
											{
												$oct_fee = 0;
											}
											if($month=='NOV' && $NOV[$j]==1)
											{
												$nov_fee = $h_fee;
											}
											else
											{
												$nov_fee = 0;
											}
											if($month=='DEC' && $DECM[$j]==1)
											{
												$dec_fee = $h_fee;
											}
											else
											{
												$dec_fee = 0;
											}
											if($month=='JAN' && $JAN[$j]==1)
											{
												$jan_fee = $h_fee;
											}
											else
											{
												$jan_fee = 0;
											}
											if($month=='FEB' && $FEB[$j]==1)
											{
												$feb_fee = $h_fee;
											}
											else
											{
												$feb_fee = 0;
											}
											if($month=='MAR' && $MAR[$j]==1)
											{
												$mar_fee = $h_fee;
											}
											else
											{
												$mar_fee = 0;
											}
											$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
										}
									}
									else // calculation without scholarship for student //
									{
										if($month=='APR' && $APR[$j]==1)
										{
											$apr_fee = $h_fee;
										}
										else
										{
											$apr_fee = 0;
										}
										if($month=='MAY' && $may[$j]==1)
										{
											$may_fee = $h_fee;
										}
										else
										{
											$may_fee = 0;
										}
										if($month=='JUN' && $JUN[$j]==1)
										{
											$jun_fee = $h_fee;
										}
										else
										{
											$jun_fee = 0;
										}
										if($month=='JUL' && $JUL[$j]==1)
										{
											$jul_fee = $h_fee;
										}
										else
										{
											$jul_fee = 0;
										}
										if($month=='AUG' && $AUG[$j]==1)
										{
											$aug_fee = $h_fee;
										}
										else
										{
											$aug_fee = 0;
										}
										if($month=='SEP' && $SEP[$j]==1)
										{
											$sep_fee = $h_fee;
										}
										else
										{
											$sep_fee = 0;
										}
										if($month=='OCT' && $OCT[$j]==1)
										{
											$oct_fee = $h_fee;
										}
										else
										{
											$oct_fee = 0;
										}
										if($month=='NOV' && $NOV[$j]==1)
										{
											$nov_fee = $h_fee;
										}
										else
										{
											$nov_fee = 0;
										}
										if($month=='DEC' && $DECM[$j]==1)
										{
											$dec_fee = $h_fee;
										}
										else
										{
											$dec_fee = 0;
										}
										if($month=='JAN' && $JAN[$j]==1)
										{
											$jan_fee = $h_fee;
										}
										else
										{
											$jan_fee = 0;
										}
										if($month=='FEB' && $FEB[$j]==1)
										{
											$feb_fee = $h_fee;
										}
										else
										{
											$feb_fee = 0;
										}
										if($month=='MAR' && $MAR[$j]==1)
										{
											$mar_fee = $h_fee;
										}
										else
										{
											$mar_fee = 0;
										}
										$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
									}
									
								}
								else // calculation on the basis of without class base //
								{
									switch($emp_ward)
									{
										case 1:
										$amt_fee = $AMOUNT[$j];
										break;
										case 2:
										$amt_fee = $EMP[$j];
										break;
										case 3:
										$amt_fee = $CCL[$j];
										break;
										case 4:
										$amt_fee = $SPL[$j];
										break;
										case 5:
										$amt_fee = $EXT[$j];
										break;
										case 6:
										$amt_fee = $INTERNAL[$j];
										break;
										default:
										$amt_fee = 0;
										break;
												
									}
									// Checking the head type of the student //
									if($HType[$j]=='No')
									{
										$h_fee = $amt_fee;
									}
									elseif($HType[$j]=='COMPUTER')
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
									elseif ($HType[$j] == 'MUSIC') {
										if ($MUSIC == 1) {
											$h_fee = $amt_fee;
										} else {
											$h_fee = 0;
										}
									}
									elseif($HType[$j]=='SCIENCE')
									{
										$h_fee = $amt_fee*$science;
									}
									elseif($HType[$j]=='BUS')
									{
										$h_fee = $stoppage_amounts;
									}
									ELSEIF($HType[$j]=='HOSTEL')
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
									ELSEIF($HType[$j]=='BOOK')
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
											if($month=='APR' && $APR[$j]==1)
											{
												$apr_fee = $h_fee-$s[$j];
											}
											else
											{
												$apr_fee = 0;
											}
											if($month=='MAY' && $may[$j]==1)
											{
												$may_fee = $h_fee-$s[$j];
											}
											else
											{
												$may_fee = 0;
											}
											if($month=='JUN' && $JUN[$j]==1)
											{
												$jun_fee = $h_fee-$s[$j];
											}
											else
											{
												$jun_fee = 0;
											}
											if($month=='JUL' && $JUL[$j]==1)
											{
												$jul_fee = $h_fee-$s[$j];
											}
											else
											{
												$jul_fee = 0;
											}
											if($month=='AUG' && $AUG[$j]==1)
											{
												$aug_fee = $h_fee-$s[$j];
											}
											else
											{
												$aug_fee = 0;
											}
											if($month=='SEP' && $SEP[$j]==1)
											{
												$sep_fee = $h_fee-$s[$j];
											}
											else
											{
												$sep_fee = 0;
											}
											if($month=='OCT' && $OCT[$j]==1)
											{
												$oct_fee = $h_fee-$s[$j];
											}
											else
											{
												$oct_fee = 0;
											}
											if($month=='NOV' && $NOV[$j]==1)
											{
												$nov_fee = $h_fee-$s[$j];
											}
											else
											{
												$nov_fee = 0;
											}
											if($month=='DEC' && $DECM[$j]==1)
											{
												$dec_fee = $h_fee-$s[$j];
											}
											else
											{
												$dec_fee = 0;
											}
											if($month=='JAN' && $JAN[$j]==1)
											{
												$jan_fee = $h_fee-$s[$j];
											}
											else
											{
												$jan_fee = 0;
											}
											if($month=='FEB' && $FEB[$j]==1)
											{
												$feb_fee = $h_fee-$s[$j];
											}
											else
											{
												$feb_fee = 0;
											}
											if($month=='MAR' && $MAR[$j]==1)
											{
												$mar_fee = $h_fee-$s[$j];
											}
											else
											{
												$mar_fee = 0;
											}
											$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
										}
										elseif($Apply_From=='MAY') //  scholar ship given from may month
										{
											if($month=='APR' && $APR[$j]==1)
											{
												$apr_fee = $h_fee;
											}
											else
											{
												$apr_fee = 0;
											}
											if($month=='MAY' && $may[$j]==1)
											{
												$may_fee = $h_fee-$s[$j];
											}
											else
											{
												$may_fee = 0;
											}
											if($month=='JUN' && $JUN[$j]==1)
											{
												$jun_fee = $h_fee-$s[$j];
											}
											else
											{
												$jun_fee = 0;
											}
											if($month=='JUL' && $JUL[$j]==1)
											{
												$jul_fee = $h_fee-$s[$j];
											}
											else
											{
												$jul_fee = 0;
											}
											if($month=='AUG' && $AUG[$j]==1)
											{
												$aug_fee = $h_fee-$s[$j];
											}
											else
											{
												$aug_fee = 0;
											}
											if($month=='SEP' && $SEP[$j]==1)
											{
												$sep_fee = $h_fee-$s[$j];
											}
											else
											{
												$sep_fee = 0;
											}
											if($month=='OCT' && $OCT[$j]==1)
											{
												$oct_fee = $h_fee-$s[$j];
											}
											else
											{
												$oct_fee = 0;
											}
											if($month=='NOV' && $NOV[$j]==1)
											{
												$nov_fee = $h_fee-$s[$j];
											}
											else
											{
												$nov_fee = 0;
											}
											if($month=='DEC' && $DECM[$j]==1)
											{
												$dec_fee = $h_fee-$s[$j];
											}
											else
											{
												$dec_fee = 0;
											}
											if($month=='JAN' && $JAN[$j]==1)
											{
												$jan_fee = $h_fee-$s[$j];
											}
											else
											{
												$jan_fee = 0;
											}
											if($month=='FEB' && $FEB[$j]==1)
											{
												$feb_fee = $h_fee-$s[$j];
											}
											else
											{
												$feb_fee = 0;
											}
											if($month=='MAR' && $MAR[$j]==1)
											{
												$mar_fee = $h_fee-$s[$j];
											}
											else
											{
												$mar_fee = 0;
											}
											$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
										}
										elseif($Apply_From=='JUN') // scholar given by jun month
										{
											if($month=='APR' && $APR[$j]==1)
											{
												$apr_fee = $h_fee;
											}
											else
											{
												$apr_fee = 0;
											}
											if($month=='MAY' && $may[$j]==1)
											{
												$may_fee = $h_fee;
											}
											else
											{
												$may_fee = 0;
											}
											if($month=='JUN' && $JUN[$j]==1)
											{
												$jun_fee = $h_fee-$s[$j];
											}
											else
											{
												$jun_fee = 0;
											}
											if($month=='JUL' && $JUL[$j]==1)
											{
												$jul_fee = $h_fee-$s[$j];
											}
											else
											{
												$jul_fee = 0;
											}
											if($month=='AUG' && $AUG[$j]==1)
											{
												$aug_fee = $h_fee-$s[$j];
											}
											else
											{
												$aug_fee = 0;
											}
											if($month=='SEP' && $SEP[$j]==1)
											{
												$sep_fee = $h_fee-$s[$j];
											}
											else
											{
												$sep_fee = 0;
											}
											if($month=='OCT' && $OCT[$j]==1)
											{
												$oct_fee = $h_fee-$s[$j];
											}
											else
											{
												$oct_fee = 0;
											}
											if($month=='NOV' && $NOV[$j]==1)
											{
												$nov_fee = $h_fee-$s[$j];
											}
											else
											{
												$nov_fee = 0;
											}
											if($month=='DEC' && $DECM[$j]==1)
											{
												$dec_fee = $h_fee-$s[$j];
											}
											else
											{
												$dec_fee = 0;
											}
											if($month=='JAN' && $JAN[$j]==1)
											{
												$jan_fee = $h_fee-$s[$j];
											}
											else
											{
												$jan_fee = 0;
											}
											if($month=='FEB' && $FEB[$j]==1)
											{
												$feb_fee = $h_fee-$s[$j];
											}
											else
											{
												$feb_fee = 0;
											}
											if($month=='MAR' && $MAR[$j]==1)
											{
												$mar_fee = $h_fee-$s[$j];
											}
											else
											{
												$mar_fee = 0;
											}
											$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
										}
										elseif($Apply_From=='JUl') // scholar given from jul
										{
											if($month=='APR' && $APR[$j]==1)
											{
												$apr_fee = $h_fee;
											}
											else
											{
												$apr_fee = 0;
											}
											if($month=='MAY' && $may[$j]==1)
											{
												$may_fee = $h_fee;
											}
											else
											{
												$may_fee = 0;
											}
											if($month=='JUN' && $JUN[$j]==1)
											{
												$jun_fee = $h_fee;
											}
											else
											{
												$jun_fee = 0;
											}
											if($month=='JUL' && $JUL[$j]==1)
											{
												$jul_fee = $h_fee-$s[$j];
											}
											else
											{
												$jul_fee = 0;
											}
											if($month=='AUG' && $AUG[$j]==1)
											{
												$aug_fee = $h_fee-$s[$j];
											}
											else
											{
												$aug_fee = 0;
											}
											if($month=='SEP' && $SEP[$j]==1)
											{
												$sep_fee = $h_fee-$s[$j];
											}
											else
											{
												$sep_fee = 0;
											}
											if($month=='OCT' && $OCT[$j]==1)
											{
												$oct_fee = $h_fee-$s[$j];
											}
											else
											{
												$oct_fee = 0;
											}
											if($month=='NOV' && $NOV[$j]==1)
											{
												$nov_fee = $h_fee-$s[$j];
											}
											else
											{
												$nov_fee = 0;
											}
											if($month=='DEC' && $DECM[$j]==1)
											{
												$dec_fee = $h_fee-$s[$j];
											}
											else
											{
												$dec_fee = 0;
											}
											if($month=='JAN' && $JAN[$j]==1)
											{
												$jan_fee = $h_fee-$s[$j];
											}
											else
											{
												$jan_fee = 0;
											}
											if($month=='FEB' && $FEB[$j]==1)
											{
												$feb_fee = $h_fee-$s[$j];
											}
											else
											{
												$feb_fee = 0;
											}
											if($month=='MAR' && $MAR[$j]==1)
											{
												$mar_fee = $h_fee-$s[$j];
											}
											else
											{
												$mar_fee = 0;
											}
											$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
										}
										elseif($Apply_From=='AUG') // scholar given by aug
										{
											if($month=='APR' && $APR[$j]==1)
											{
												$apr_fee = $h_fee;
											}
											else
											{
												$apr_fee = 0;
											}
											if($month=='MAY' && $may[$j]==1)
											{
												$may_fee = $h_fee;
											}
											else
											{
												$may_fee = 0;
											}
											if($month=='JUN' && $JUN[$j]==1)
											{
												$jun_fee = $h_fee;
											}
											else
											{
												$jun_fee = 0;
											}
											if($month=='JUL' && $JUL[$j]==1)
											{
												$jul_fee = $h_fee;
											}
											else
											{
												$jul_fee = 0;
											}
											if($month=='AUG' && $AUG[$j]==1)
											{
												$aug_fee = $h_fee-$s[$j];
											}
											else
											{
												$aug_fee = 0;
											}
											if($month=='SEP' && $SEP[$j]==1)
											{
												$sep_fee = $h_fee-$s[$j];
											}
											else
											{
												$sep_fee = 0;
											}
											if($month=='OCT' && $OCT[$j]==1)
											{
												$oct_fee = $h_fee-$s[$j];
											}
											else
											{
												$oct_fee = 0;
											}
											if($month=='NOV' && $NOV[$j]==1)
											{
												$nov_fee = $h_fee-$s[$j];
											}
											else
											{
												$nov_fee = 0;
											}
											if($month=='DEC' && $DECM[$j]==1)
											{
												$dec_fee = $h_fee-$s[$j];
											}
											else
											{
												$dec_fee = 0;
											}
											if($month=='JAN' && $JAN[$j]==1)
											{
												$jan_fee = $h_fee-$s[$j];
											}
											else
											{
												$jan_fee = 0;
											}
											if($month=='FEB' && $FEB[$j]==1)
											{
												$feb_fee = $h_fee-$s[$j];
											}
											else
											{
												$feb_fee = 0;
											}
											if($month=='MAR' && $MAR[$j]==1)
											{
												$mar_fee = $h_fee-$s[$j];
											}
											else
											{
												$mar_fee = 0;
											}
											$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
										}
										elseif($Apply_From=='SEP') // scholar given by sep
										{
											if($month=='APR' && $APR[$j]==1)
											{
												$apr_fee = $h_fee;
											}
											else
											{
												$apr_fee = 0;
											}
											if($month=='MAY' && $may[$j]==1)
											{
												$may_fee = $h_fee;
											}
											else
											{
												$may_fee = 0;
											}
											if($month=='JUN' && $JUN[$j]==1)
											{
												$jun_fee = $h_fee;
											}
											else
											{
												$jun_fee = 0;
											}
											if($month=='JUL' && $JUL[$j]==1)
											{
												$jul_fee = $h_fee;
											}
											else
											{
												$jul_fee = 0;
											}
											if($month=='AUG' && $AUG[$j]==1)
											{
												$aug_fee = $h_fee;
											}
											else
											{
												$aug_fee = 0;
											}
											if($month=='SEP' && $SEP[$j]==1)
											{
												$sep_fee = $h_fee-$s[$j];
											}
											else
											{
												$sep_fee = 0;
											}
											if($month=='OCT' && $OCT[$j]==1)
											{
												$oct_fee = $h_fee-$s[$j];
											}
											else
											{
												$oct_fee = 0;
											}
											if($month=='NOV' && $NOV[$j]==1)
											{
												$nov_fee = $h_fee-$s[$j];
											}
											else
											{
												$nov_fee = 0;
											}
											if($month=='DEC' && $DECM[$j]==1)
											{
												$dec_fee = $h_fee-$s[$j];
											}
											else
											{
												$dec_fee = 0;
											}
											if($month=='JAN' && $JAN[$j]==1)
											{
												$jan_fee = $h_fee-$s[$j];
											}
											else
											{
												$jan_fee = 0;
											}
											if($month=='FEB' && $FEB[$j]==1)
											{
												$feb_fee = $h_fee-$s[$j];
											}
											else
											{
												$feb_fee = 0;
											}
											if($month=='MAR' && $MAR[$j]==1)
											{
												$mar_fee = $h_fee-$s[$j];
											}
											else
											{
												$mar_fee = 0;
											}
											$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
										}
										elseif($Apply_From=='OCT')  // scholar given by oct month
										{
											if($month=='APR' && $APR[$j]==1)
											{
												$apr_fee = $h_fee;
											}
											else
											{
												$apr_fee = 0;
											}
											if($month=='MAY' && $may[$j]==1)
											{
												$may_fee = $h_fee;
											}
											else
											{
												$may_fee = 0;
											}
											if($month=='JUN' && $JUN[$j]==1)
											{
												$jun_fee = $h_fee;
											}
											else
											{
												$jun_fee = 0;
											}
											if($month=='JUL' && $JUL[$j]==1)
											{
												$jul_fee = $h_fee;
											}
											else
											{
												$jul_fee = 0;
											}
											if($month=='AUG' && $AUG[$j]==1)
											{
												$aug_fee = $h_fee;
											}
											else
											{
												$aug_fee = 0;
											}
											if($month=='SEP' && $SEP[$j]==1)
											{
												$sep_fee = $h_fee;
											}
											else
											{
												$sep_fee = 0;
											}
											if($month=='OCT' && $OCT[$j]==1)
											{
												$oct_fee = $h_fee-$s[$j];
											}
											else
											{
												$oct_fee = 0;
											}
											if($month=='NOV' && $NOV[$j]==1)
											{
												$nov_fee = $h_fee-$s[$j];
											}
											else
											{
												$nov_fee = 0;
											}
											if($month=='DEC' && $DECM[$j]==1)
											{
												$dec_fee = $h_fee-$s[$j];
											}
											else
											{
												$dec_fee = 0;
											}
											if($month=='JAN' && $JAN[$j]==1)
											{
												$jan_fee = $h_fee-$s[$j];
											}
											else
											{
												$jan_fee = 0;
											}
											if($month=='FEB' && $FEB[$j]==1)
											{
												$feb_fee = $h_fee-$s[$j];
											}
											else
											{
												$feb_fee = 0;
											}
											if($month=='MAR' && $MAR[$j]==1)
											{
												$mar_fee = $h_fee-$s[$j];
											}
											else
											{
												$mar_fee = 0;
											}
											$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
										}
										elseif($Apply_From=='NOV') // scholar given by nov month //
										{
											if($month=='APR' && $APR[$j]==1)
											{
												$apr_fee = $h_fee;
											}
											else
											{
												$apr_fee = 0;
											}
											if($month=='MAY' && $may[$j]==1)
											{
												$may_fee = $h_fee;
											}
											else
											{
												$may_fee = 0;
											}
											if($month=='JUN' && $JUN[$j]==1)
											{
												$jun_fee = $h_fee;
											}
											else
											{
												$jun_fee = 0;
											}
											if($month=='JUL' && $JUL[$j]==1)
											{
												$jul_fee = $h_fee;
											}
											else
											{
												$jul_fee = 0;
											}
											if($month=='AUG' && $AUG[$j]==1)
											{
												$aug_fee = $h_fee;
											}
											else
											{
												$aug_fee = 0;
											}
											if($month=='SEP' && $SEP[$j]==1)
											{
												$sep_fee = $h_fee;
											}
											else
											{
												$sep_fee = 0;
											}
											if($month=='OCT' && $OCT[$j]==1)
											{
												$oct_fee = $h_fee;
											}
											else
											{
												$oct_fee = 0;
											}
											if($month=='NOV' && $NOV[$j]==1)
											{
												$nov_fee = $h_fee-$s[$j];
											}
											else
											{
												$nov_fee = 0;
											}
											if($month=='DEC' && $DECM[$j]==1)
											{
												$dec_fee = $h_fee-$s[$j];
											}
											else
											{
												$dec_fee = 0;
											}
											if($month=='JAN' && $JAN[$j]==1)
											{
												$jan_fee = $h_fee-$s[$j];
											}
											else
											{
												$jan_fee = 0;
											}
											if($month=='FEB' && $FEB[$j]==1)
											{
												$feb_fee = $h_fee-$s[$j];
											}
											else
											{
												$feb_fee = 0;
											}
											if($month=='MAR' && $MAR[$j]==1)
											{
												$mar_fee = $h_fee-$s[$j];
											}
											else
											{
												$mar_fee = 0;
											}
											$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
										}
										elseif($Apply_From=='DEC') // scholar given from dec month //
										{
											if($month=='APR' && $APR[$j]==1)
											{
												$apr_fee = $h_fee;
											}
											else
											{
												$apr_fee = 0;
											}
											if($month=='MAY' && $may[$j]==1)
											{
												$may_fee = $h_fee;
											}
											else
											{
												$may_fee = 0;
											}
											if($month=='JUN' && $JUN[$j]==1)
											{
												$jun_fee = $h_fee;
											}
											else
											{
												$jun_fee = 0;
											}
											if($month=='JUL' && $JUL[$j]==1)
											{
												$jul_fee = $h_fee;
											}
											else
											{
												$jul_fee = 0;
											}
											if($month=='AUG' && $AUG[$j]==1)
											{
												$aug_fee = $h_fee;
											}
											else
											{
												$aug_fee = 0;
											}
											if($month=='SEP' && $SEP[$j]==1)
											{
												$sep_fee = $h_fee;
											}
											else
											{
												$sep_fee = 0;
											}
											if($month=='OCT' && $OCT[$j]==1)
											{
												$oct_fee = $h_fee;
											}
											else
											{
												$oct_fee = 0;
											}
											if($month=='NOV' && $NOV[$j]==1)
											{
												$nov_fee = $h_fee;
											}
											else
											{
												$nov_fee = 0;
											}
											if($month=='DEC' && $DECM[$j]==1)
											{
												$dec_fee = $h_fee-$s[$j];
											}
											else
											{
												$dec_fee = 0;
											}
											if($month=='JAN' && $JAN[$j]==1)
											{
												$jan_fee = $h_fee-$s[$j];
											}
											else
											{
												$jan_fee = 0;
											}
											if($month=='FEB' && $FEB[$j]==1)
											{
												$feb_fee = $h_fee-$s[$j];
											}
											else
											{
												$feb_fee = 0;
											}
											if($month=='MAR' && $MAR[$j]==1)
											{
												$mar_fee = $h_fee-$s[$j];
											}
											else
											{
												$mar_fee = 0;
											}
											$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
										}
										elseif($Apply_From=='JAN') // scholar given from jan month //
										{
											if($month=='APR' && $APR[$j]==1)
											{
												$apr_fee = $h_fee;
											}
											else
											{
												$apr_fee = 0;
											}
											if($month=='MAY' && $may[$j]==1)
											{
												$may_fee = $h_fee;
											}
											else
											{
												$may_fee = 0;
											}
											if($month=='JUN' && $JUN[$j]==1)
											{
												$jun_fee = $h_fee;
											}
											else
											{
												$jun_fee = 0;
											}
											if($month=='JUL' && $JUL[$j]==1)
											{
												$jul_fee = $h_fee;
											}
											else
											{
												$jul_fee = 0;
											}
											if($month=='AUG' && $AUG[$j]==1)
											{
												$aug_fee = $h_fee;
											}
											else
											{
												$aug_fee = 0;
											}
											if($month=='SEP' && $SEP[$j]==1)
											{
												$sep_fee = $h_fee;
											}
											else
											{
												$sep_fee = 0;
											}
											if($month=='OCT' && $OCT[$j]==1)
											{
												$oct_fee = $h_fee;
											}
											else
											{
												$oct_fee = 0;
											}
											if($month=='NOV' && $NOV[$j]==1)
											{
												$nov_fee = $h_fee;
											}
											else
											{
												$nov_fee = 0;
											}
											if($month=='DEC' && $DECM[$j]==1)
											{
												$dec_fee = $h_fee;
											}
											else
											{
												$dec_fee = 0;
											}
											if($month=='JAN' && $JAN[$j]==1)
											{
												$jan_fee = $h_fee-$s[$j];
											}
											else
											{
												$jan_fee = 0;
											}
											if($month=='FEB' && $FEB[$j]==1)
											{
												$feb_fee = $h_fee-$s[$j];
											}
											else
											{
												$feb_fee = 0;
											}
											if($month=='MAR' && $MAR[$j]==1)
											{
												$mar_fee = $h_fee-$s[$j];
											}
											else
											{
												$mar_fee = 0;
											}
											$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
										}
										elseif($Apply_From=='FEB') // scholar given from  feb month //
										{
											if($month=='APR' && $APR[$j]==1)
											{
												$apr_fee = $h_fee;
											}
											else
											{
												$apr_fee = 0;
											}
											if($month=='MAY' && $may[$j]==1)
											{
												$may_fee = $h_fee;
											}
											else
											{
												$may_fee = 0;
											}
											if($month=='JUN' && $JUN[$j]==1)
											{
												$jun_fee = $h_fee;
											}
											else
											{
												$jun_fee = 0;
											}
											if($month=='JUL' && $JUL[$j]==1)
											{
												$jul_fee = $h_fee;
											}
											else
											{
												$jul_fee = 0;
											}
											if($month=='AUG' && $AUG[$j]==1)
											{
												$aug_fee = $h_fee;
											}
											else
											{
												$aug_fee = 0;
											}
											if($month=='SEP' && $SEP[$j]==1)
											{
												$sep_fee = $h_fee;
											}
											else
											{
												$sep_fee = 0;
											}
											if($month=='OCT' && $OCT[$j]==1)
											{
												$oct_fee = $h_fee;
											}
											else
											{
												$oct_fee = 0;
											}
											if($month=='NOV' && $NOV[$j]==1)
											{
												$nov_fee = $h_fee;
											}
											else
											{
												$nov_fee = 0;
											}
											if($month=='DEC' && $DECM[$j]==1)
											{
												$dec_fee = $h_fee;
											}
											else
											{
												$dec_fee = 0;
											}
											if($month=='JAN' && $JAN[$j]==1)
											{
												$jan_fee = $h_fee;
											}
											else
											{
												$jan_fee = 0;
											}
											if($month=='FEB' && $FEB[$j]==1)
											{
												$feb_fee = $h_fee-$s[$j];
											}
											else
											{
												$feb_fee = 0;
											}
											if($month=='MAR' && $MAR[$j]==1)
											{
												$mar_fee = $h_fee-$s[$j];
											}
											else
											{
												$mar_fee = 0;
											}
											$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
										}
										elseif($Apply_From=='MAR') // scholar given from mar month //
										{
											if($month=='APR' && $APR[$j]==1)
											{
												$apr_fee = $h_fee;
											}
											else
											{
												$apr_fee = 0;
											}
											if($month=='MAY' && $may[$j]==1)
											{
												$may_fee = $h_fee;
											}
											else
											{
												$may_fee = 0;
											}
											if($month=='JUN' && $JUN[$j]==1)
											{
												$jun_fee = $h_fee;
											}
											else
											{
												$jun_fee = 0;
											}
											if($month=='JUL' && $JUL[$j]==1)
											{
												$jul_fee = $h_fee;
											}
											else
											{
												$jul_fee = 0;
											}
											if($month=='AUG' && $AUG[$j]==1)
											{
												$aug_fee = $h_fee;
											}
											else
											{
												$aug_fee = 0;
											}
											if($month=='SEP' && $SEP[$j]==1)
											{
												$sep_fee = $h_fee;
											}
											else
											{
												$sep_fee = 0;
											}
											if($month=='OCT' && $OCT[$j]==1)
											{
												$oct_fee = $h_fee;
											}
											else
											{
												$oct_fee = 0;
											}
											if($month=='NOV' && $NOV[$j]==1)
											{
												$nov_fee = $h_fee;
											}
											else
											{
												$nov_fee = 0;
											}
											if($month=='DEC' && $DECM[$j]==1)
											{
												$dec_fee = $h_fee;
											}
											else
											{
												$dec_fee = 0;
											}
											if($month=='JAN' && $JAN[$j]==1)
											{
												$jan_fee = $h_fee;
											}
											else
											{
												$jan_fee = 0;
											}
											if($month=='FEB' && $FEB[$j]==1)
											{
												$feb_fee = $h_fee;
											}
											else
											{
												$feb_fee = 0;
											}
											if($month=='MAR' && $MAR[$j]==1)
											{
												$mar_fee = $h_fee-$s[$j];
											}
											else
											{
												$mar_fee = 0;
											}
											$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
										}
										else // scholar without any month //
										{
											if($month=='APR' && $APR[$j]==1)
											{
												$apr_fee = $h_fee;
											}
											else
											{
												$apr_fee = 0;
											}
											if($month=='MAY' && $may[$j]==1)
											{
												$may_fee = $h_fee;
											}
											else
											{
												$may_fee = 0;
											}
											if($month=='JUN' && $JUN[$j]==1)
											{
												$jun_fee = $h_fee;
											}
											else
											{
												$jun_fee = 0;
											}
											if($month=='JUL' && $JUL[$j]==1)
											{
												$jul_fee = $h_fee;
											}
											else
											{
												$jul_fee = 0;
											}
											if($month=='AUG' && $AUG[$j]==1)
											{
												$aug_fee = $h_fee;
											}
											else
											{
												$aug_fee = 0;
											}
											if($month=='SEP' && $SEP[$j]==1)
											{
												$sep_fee = $h_fee;
											}
											else
											{
												$sep_fee = 0;
											}
											if($month=='OCT' && $OCT[$j]==1)
											{
												$oct_fee = $h_fee;
											}
											else
											{
												$oct_fee = 0;
											}
											if($month=='NOV' && $NOV[$j]==1)
											{
												$nov_fee = $h_fee;
											}
											else
											{
												$nov_fee = 0;
											}
											if($month=='DEC' && $DECM[$j]==1)
											{
												$dec_fee = $h_fee;
											}
											else
											{
												$dec_fee = 0;
											}
											if($month=='JAN' && $JAN[$j]==1)
											{
												$jan_fee = $h_fee;
											}
											else
											{
												$jan_fee = 0;
											}
											if($month=='FEB' && $FEB[$j]==1)
											{
												$feb_fee = $h_fee;
											}
											else
											{
												$feb_fee = 0;
											}
											if($month=='MAR' && $MAR[$j]==1)
											{
												$mar_fee = $h_fee;
											}
											else
											{
												$mar_fee = 0;
											}
											$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
										}
									}  
									else // calculation without scholarship for student //
									{
										if($month=='APR' && $APR[$j]==1)
										{
											$apr_fee = $h_fee;
										}
										else
										{
											$apr_fee = 0;
										}
										if($month=='MAY' && $may[$j]==1)
										{
											$may_fee = $h_fee;
										}
										else
										{
											$may_fee = 0;
										}
										if($month=='JUN' && $JUN[$j]==1)
										{
											$jun_fee = $h_fee;
										}
										else
										{
											$jun_fee = 0;
										}
										if($month=='JUL' && $JUL[$j]==1)
										{
											$jul_fee = $h_fee;
										}
										else
										{
											$jul_fee = 0;
										}
										if($month=='AUG' && $AUG[$j]==1)
										{
											$aug_fee = $h_fee;
										}
										else
										{
											$aug_fee = 0;
										}
										if($month=='SEP' && $SEP[$j]==1)
										{
											$sep_fee = $h_fee;
										}
										else
										{
											$sep_fee = 0;
										}
										if($month=='OCT' && $OCT[$j]==1)
										{
											$oct_fee = $h_fee;
										}
										else
										{
											$oct_fee = 0;
										}
										if($month=='NOV' && $NOV[$j]==1)
										{
											$nov_fee = $h_fee;
										}
										else
										{
											$nov_fee = 0;
										}
										if($month=='DEC' && $DECM[$j]==1)
										{
											$dec_fee = $h_fee;
										}
										else
										{
											$dec_fee = 0;
										}
										if($month=='JAN' && $JAN[$j]==1)
										{
											$jan_fee = $h_fee;
										}
										else
										{
											$jan_fee = 0;
										}
										if($month=='FEB' && $FEB[$j]==1)
										{
											$feb_fee = $h_fee;
										}
										else
										{
											$feb_fee = 0;
										}
										if($month=='MAR' && $MAR[$j]==1)
										{
											$mar_fee = $h_fee;
										}
										else
										{
											$mar_fee = 0;
										}
										$amt_feehead[$j] = $apr_fee+$may_fee+$jun_fee+$jul_fee+$aug_fee+$sep_fee+$oct_fee+$nov_fee+$dec_fee+$jan_fee+$feb_fee+$mar_fee;
									}
								
								}
							}
							else // calculation for the new student where fee type for one month //
							{
								if($Session_Year==$SESSIONID)// Calculation For New Student Without Month Wise //
								{
									if($month=='APR')
									{
										if($CL_BASED[$j]==1)
										{
											switch($emp_ward)
											{
												case 1:
												$amt_fee = $feeclw_AMOUNT[$j];
												break;
												case 2:
												$amt_fee = $feeclw_EMP[$j];
												break;
												case 3:
												$amt_fee = $feeclw_CCL[$j];
												break;
												case 4:
												$amt_fee = $feeclw_SPL[$j];
												break;
												case 5:
												$amt_fee = $feeclw_EXT[$j];
												break;
												case 6:
												$amt_fee = $feeclw_INTERNAL[$j];
												break;
												default:
												$amt_fee = 0;
												break;
												
											}
											// Checking the head type of the student //
											if($HType[$j]=='No')
											{
												$h_fee = $amt_fee;
											}
											elseif($HType[$j]=='COMPUTER')
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
											elseif ($HType[$j] == 'MUSIC') {
											if ($MUSIC == 1) {
											$h_fee = $amt_fee;
											} else {
												$h_fee = 0;
											}
										}
											elseif($HType[$j]=='SCIENCE')
											{
												$h_fee = $amt_fee*$science;
											}
											elseif($HType[$j]=='BUS')
											{
												$h_fee = $stoppage_amounts;
											}
											ELSEIF($HType[$j]=='HOSTEL')
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
											ELSEIF($HType[$j]=='BOOK')
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
													if($month=='APR')
													{
														$apr_fee = $h_fee-$s[$j];
													}
													else
													{
														$apr_fee = 0;
													}
													$amt_feehead[$j] = $apr_fee;
										
												}
												else
												{
													if($month=='APR')
													{
														$amt_feehead[$j] = $h_fee;
													}
													else
													{
													$amt_feehead[$j] = 0;
													}
												
												}
											}
											else
											{
												if($month=='APR')
												{
													$apr_fee = $h_fee;
												}
												else
												{
													$apr_fee = 0;
												}
												$amt_feehead[$j] = $apr_fee;
											}
										}
										else
										{
											switch($emp_ward)
											{
												case 1:
												$amt_fee = $AMOUNT[$j];
												break;
												case 2:
												$amt_fee = $EMP[$j];
												break;
												case 3:
												$amt_fee = $CCL[$j];
												break;
												case 4:
												$amt_fee = $SPL[$j];
												break;
												case 5:
												$amt_fee = $EXT[$j];
												break;
												case 6:
												$amt_fee = $INTERNAL[$j];
												break;
												default:
												$amt_fee = 0;
												break;
														
											}
											// Checking the head type of the student //
											if($HType[$j]=='No')
											{
												$h_fee = $amt_fee;
											}
											elseif($HType[$j]=='COMPUTER')
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
											elseif ($HType[$j] == 'MUSIC') {
										if ($MUSIC == 1) {
											$h_fee = $amt_fee;
										} else {
											$h_fee = 0;
										}
									}
											elseif($HType[$j]=='SCIENCE')
											{
												$h_fee = $amt_fee*$science;
											}
											elseif($HType[$j]=='BUS')
											{
												$h_fee = $stoppage_amounts;
											}
											ELSEIF($HType[$j]=='HOSTEL')
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
											ELSEIF($HType[$j]=='BOOK')
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
													if($month=='APR')
													{
														$apr_fee = $h_fee-$s[$j];
													}
													else
													{
														$apr_fee = 0;
													}
													$amt_feehead[$j] = $apr_fee;
										
												}
												else
												{
													if($month=='APR')
													{
														$amt_feehead[$j] = $h_fee;
													}
													else
													{
														$amt_feehead[$j] = 0;
													}
												
												}
											}
											else
											{
												if($month=='APR')
												{
													$apr_fee = $h_fee;
												}
												else
												{
													$apr_fee = 0;
												}
												$amt_feehead[$j] = $apr_fee;
											}
										}
									}
									else
									{
										$amt_feehead[$j] = 0;
									}
								}
								else // calculation for old student without month wise //
								{
									$amt_feehead[$j] = 0;
								}
							}
						}
						$total_amount += $amt_feehead[$j];
						}
						
							$array[] = array(
								'Month_NM'  	=> $month1,
								'STU_NAME'  	=> $stu_name,
								'STUDENTID' 	=> $STUDENTID,
								'ADM_NO'    	=> $ADM_NO,
								'CLASS'     	=> $DISP_CLASS,
								'SEC'       	=> $DISP_SEC,
								'ROLL_NO'   	=> $ROLL_NO,
								'TOTAL'			=> $total_amount,
								'Fee1'			=> $amt_feehead[0],
								'Fee2'			=> $amt_feehead[1],
								'Fee3'			=> $amt_feehead[2],
								'Fee4'			=> $amt_feehead[3],
								'Fee5'			=> $amt_feehead[4],
								'Fee6'			=> $amt_feehead[5],
								'Fee7'			=> $amt_feehead[6],
								'Fee8'			=> $amt_feehead[7],
								'Fee9'			=> $amt_feehead[8],
								'Fee10'			=> $amt_feehead[9],
								'Fee11'			=> $amt_feehead[10],
								'Fee12'			=> $amt_feehead[11],
								'Fee13'			=> $amt_feehead[12],
								'Fee14'			=> $amt_feehead[13],
								'Fee15'			=> $amt_feehead[14],
								'Fee16'			=> $amt_feehead[15],
								'Fee17'			=> $amt_feehead[16],
								'Fee18'			=> $amt_feehead[17],
								'Fee19'			=> $amt_feehead[18],
								'Fee20'			=> $amt_feehead[19],
								'Fee21'			=> $amt_feehead[20],
								'Fee22'			=> $amt_feehead[21],
								'Fee23'			=> $amt_feehead[22],
								'Fee24'     	=> $amt_feehead[23],
								'Fee25'			=> $amt_feehead[24],
								'Fee_details'   => date("Y-m-d")
							);
					}// END OF ADMITTED CONDITION //
				}
				// echo "<pre>";
				// print_r($array);
				// exit;
				if(!empty($array)){
					if($this->dbcon->createMultiple('feegeneration',$array)){
					echo 2;
					}
				}
				else{
					echo 3;
				}
				
				
		}
		
	}
}
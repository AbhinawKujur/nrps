<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Updatefeegeneration extends CI_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->load->model('Mymodel','dbcon');
	}
	
	public function fee_generation_update()
	{
		$adm_no = $this->input->post('adm_no');
		$u_m = $this->input->post('u_m');
		$stu_details = $this->dbcon->select('feegeneration','COUNT(ADM_NO) AS TOTAL',"Month_NM='$u_m'");
		$TOTAL_STUDENT = $stu_details[0]->TOTAL;
		// fetching details from the student tables //
			$student_details = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
			$stu_name = $student_details[0]->FATHER_NM;
			$stu_id = $student_details[0]->STUDENTID;
			$DISP_CLASS = $student_details[0]->DISP_CLASS;
			$DISP_SEC = $student_details[0]->DISP_SEC;
			$ROLL_NO  = $student_details[0]->ROLL_NO;
		// end of fetching data from student tables //
		// Checking data is on feegeneration or not//
		$fee_details = $this->dbcon->select('feegeneration','*',"ADM_NO='$adm_no' AND Month_NM='$u_m'");
		// End Of fetching data from the feegeneration //
		$student_data = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
		$session 	  = $this->dbcon->select('session_master','*',"Active_Status='1'");
		$cnt = count($fee_details);
		
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
		}
		
		IF(isset($stop_amt_code))
		{
			$stop_amt = $this->dbcon->select('stop_amt','*',"STOP_NO='$stop_amt_code'");
			$stoppage_amounts = $stop_amt[0]->AMT;
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
			$feehead[$i] 		= $this->dbcon->select('feehead','*',"ACT_CODE='$i'");
			$act_code[$i] 		= $feehead[$i][0]->ACT_CODE;
			$fee_head[$i] 		= $feehead[$i][0]->FEE_HEAD;
			$monthly[$i] 		= $feehead[$i][0]->MONTHLY;
			$CL_BASED[$i]		= $feehead[$i][0]->CL_BASED;
			$AMOUNT[$i]			= $feehead[$i][0]->AMOUNT;
			$EMP[$i]			= $feehead[$i][0]->EMP;
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
						$amt_fee = $feeclw_SPL[$i];
						break;
						case 5:
						$amt_fee = $feeclw_EXT[$i];
						break;
						case 6:
						$amt_fee = $feeclw_INTERNAL[$i];
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
					// End Of Checking Head Type //
					if($SCHOLAR==1) // calculation on the basis of the scholarship //
					{
						if($Apply_From=='APR') // scholar ship apply from apr month
						{
							if($u_m=='APR' && $APR[$i]==1)
							{
								$apr_fee = $h_fee-$s[$i];
							}
							else
							{
								$apr_fee = 0;
							}
							if($u_m=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee-$s[$i];
							}
							else
							{
								$may_fee = 0;
							}
							if($u_m=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee-$s[$i];
							}
							else
							{
								$jun_fee = 0;
							}
							if($u_m=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee-$s[$i];
							}
							else
							{
								$jul_fee = 0;
							}
							if($u_m=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee-$s[$i];
							}
							else
							{
								$aug_fee = 0;
							}
							if($u_m=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee-$s[$i];
							}
							else
							{
								$sep_fee = 0;
							}
							if($u_m=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee-$s[$i];
							}
							else
							{
								$oct_fee = 0;
							}
							if($u_m=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee-$s[$i];
							}
							else
							{
								$nov_fee = 0;
							}
							if($u_m=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee-$s[$i];
							}
							else
							{
								$dec_fee = 0;
							}
							if($u_m=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee-$s[$i];
							}
							else
							{
								$jan_fee = 0;
							}
							if($u_m=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee-$s[$i];
							}
							else
							{
								$feb_fee = 0;
							}
							if($u_m=='MAR' && $MAR[$i]==1)
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
							if($u_m=='APR' && $APR[$i]==1)
							{
								$apr_fee = $h_fee;
							}
							else
							{
								$apr_fee = 0;
							}
							if($u_m=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee-$s[$i];
							}
							else
							{
								$may_fee = 0;
							}
							if($u_m=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee-$s[$i];
							}
							else
							{
								$jun_fee = 0;
							}
							if($u_m=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee-$s[$i];
							}
							else
							{
								$jul_fee = 0;
							}
							if($u_m=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee-$s[$i];
							}
							else
							{
								$aug_fee = 0;
							}
							if($u_m=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee-$s[$i];
							}
							else
							{
								$sep_fee = 0;
							}
							if($u_m=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee-$s[$i];
							}
							else
							{
								$oct_fee = 0;
							}
							if($u_m=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee-$s[$i];
							}
							else
							{
								$nov_fee = 0;
							}
							if($u_m=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee-$s[$i];
							}
							else
							{
								$dec_fee = 0;
							}
							if($u_m=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee-$s[$i];
							}
							else
							{
								$jan_fee = 0;
							}
							if($u_m=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee-$s[$i];
							}
							else
							{
								$feb_fee = 0;
							}
							if($u_m=='MAR' && $MAR[$i]==1)
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
							if($u_m=='APR' && $APR[$i]==1)
							{
								$apr_fee = $h_fee;
							}
							else
							{
								$apr_fee = 0;
							}
							if($u_m=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee;
							}
							else
							{
								$may_fee = 0;
							}
							if($u_m=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee-$s[$i];
							}
							else
							{
								$jun_fee = 0;
							}
							if($u_m=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee-$s[$i];
							}
							else
							{
								$jul_fee = 0;
							}
							if($u_m=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee-$s[$i];
							}
							else
							{
								$aug_fee = 0;
							}
							if($u_m=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee-$s[$i];
							}
							else
							{
								$sep_fee = 0;
							}
							if($u_m=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee-$s[$i];
							}
							else
							{
								$oct_fee = 0;
							}
							if($u_m=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee-$s[$i];
							}
							else
							{
								$nov_fee = 0;
							}
							if($u_m=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee-$s[$i];
							}
							else
							{
								$dec_fee = 0;
							}
							if($u_m=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee-$s[$i];
							}
							else
							{
								$jan_fee = 0;
							}
							if($u_m=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee-$s[$i];
							}
							else
							{
								$feb_fee = 0;
							}
							if($u_m=='MAR' && $MAR[$i]==1)
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
							if($u_m=='APR' && $APR[$i]==1)
							{
								$apr_fee = $h_fee;
							}
							else
							{
								$apr_fee = 0;
							}
							if($u_m=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee;
							}
							else
							{
								$may_fee = 0;
							}
							if($u_m=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee;
							}
							else
							{
								$jun_fee = 0;
							}
							if($u_m=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee-$s[$i];
							}
							else
							{
								$jul_fee = 0;
							}
							if($u_m=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee-$s[$i];
							}
							else
							{
								$aug_fee = 0;
							}
							if($u_m=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee-$s[$i];
							}
							else
							{
								$sep_fee = 0;
							}
							if($u_m=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee-$s[$i];
							}
							else
							{
								$oct_fee = 0;
							}
							if($u_m=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee-$s[$i];
							}
							else
							{
								$nov_fee = 0;
							}
							if($u_m=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee-$s[$i];
							}
							else
							{
								$dec_fee = 0;
							}
							if($u_m=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee-$s[$i];
							}
							else
							{
								$jan_fee = 0;
							}
							if($u_m=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee-$s[$i];
							}
							else
							{
								$feb_fee = 0;
							}
							if($u_m=='MAR' && $MAR[$i]==1)
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
							if($u_m=='APR' && $APR[$i]==1)
							{
								$apr_fee = $h_fee;
							}
							else
							{
								$apr_fee = 0;
							}
							if($u_m=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee;
							}
							else
							{
								$may_fee = 0;
							}
							if($u_m=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee;
							}
							else
							{
								$jun_fee = 0;
							}
							if($u_m=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee;
							}
							else
							{
								$jul_fee = 0;
							}
							if($u_m=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee-$s[$i];
							}
							else
							{
								$aug_fee = 0;
							}
							if($u_m=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee-$s[$i];
							}
							else
							{
								$sep_fee = 0;
							}
							if($u_m=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee-$s[$i];
							}
							else
							{
								$oct_fee = 0;
							}
							if($u_m=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee-$s[$i];
							}
							else
							{
								$nov_fee = 0;
							}
							if($u_m=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee-$s[$i];
							}
							else
							{
								$dec_fee = 0;
							}
							if($u_m=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee-$s[$i];
							}
							else
							{
								$jan_fee = 0;
							}
							if($u_m=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee-$s[$i];
							}
							else
							{
								$feb_fee = 0;
							}
							if($u_m=='MAR' && $MAR[$i]==1)
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
							if($u_m=='APR' && $APR[$i]==1)
							{
								$apr_fee = $h_fee;
							}
							else
							{
								$apr_fee = 0;
							}
							if($u_m=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee;
							}
							else
							{
								$may_fee = 0;
							}
							if($u_m=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee;
							}
							else
							{
								$jun_fee = 0;
							}
							if($u_m=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee;
							}
							else
							{
								$jul_fee = 0;
							}
							if($u_m=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee;
							}
							else
							{
								$aug_fee = 0;
							}
							if($u_m=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee-$s[$i];
							}
							else
							{
								$sep_fee = 0;
							}
							if($u_m=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee-$s[$i];
							}
							else
							{
								$oct_fee = 0;
							}
							if($u_m=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee-$s[$i];
							}
							else
							{
								$nov_fee = 0;
							}
							if($u_m=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee-$s[$i];
							}
							else
							{
								$dec_fee = 0;
							}
							if($u_m=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee-$s[$i];
							}
							else
							{
								$jan_fee = 0;
							}
							if($u_m=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee-$s[$i];
							}
							else
							{
								$feb_fee = 0;
							}
							if($u_m=='MAR' && $MAR[$i]==1)
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
							if($u_m=='APR' && $APR[$i]==1)
							{
								$apr_fee = $h_fee;
							}
							else
							{
								$apr_fee = 0;
							}
							if($u_m=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee;
							}
							else
							{
								$may_fee = 0;
							}
							if($u_m=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee;
							}
							else
							{
								$jun_fee = 0;
							}
							if($u_m=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee;
							}
							else
							{
								$jul_fee = 0;
							}
							if($u_m=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee;
							}
							else
							{
								$aug_fee = 0;
							}
							if($u_m=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee;
							}
							else
							{
								$sep_fee = 0;
							}
							if($u_m=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee-$s[$i];
							}
							else
							{
								$oct_fee = 0;
							}
							if($u_m=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee-$s[$i];
							}
							else
							{
								$nov_fee = 0;
							}
							if($u_m=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee-$s[$i];
							}
							else
							{
								$dec_fee = 0;
							}
							if($u_m=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee-$s[$i];
							}
							else
							{
								$jan_fee = 0;
							}
							if($u_m=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee-$s[$i];
							}
							else
							{
								$feb_fee = 0;
							}
							if($u_m=='MAR' && $MAR[$i]==1)
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
							if($u_m=='APR' && $APR[$i]==1)
							{
								$apr_fee = $h_fee;
							}
							else
							{
								$apr_fee = 0;
							}
							if($u_m=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee;
							}
							else
							{
								$may_fee = 0;
							}
							if($u_m=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee;
							}
							else
							{
								$jun_fee = 0;
							}
							if($u_m=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee;
							}
							else
							{
								$jul_fee = 0;
							}
							if($u_m=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee;
							}
							else
							{
								$aug_fee = 0;
							}
							if($u_m=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee;
							}
							else
							{
								$sep_fee = 0;
							}
							if($u_m=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee;
							}
							else
							{
								$oct_fee = 0;
							}
							if($u_m=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee-$s[$i];
							}
							else
							{
								$nov_fee = 0;
							}
							if($u_m=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee-$s[$i];
							}
							else
							{
								$dec_fee = 0;
							}
							if($u_m=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee-$s[$i];
							}
							else
							{
								$jan_fee = 0;
							}
							if($u_m=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee-$s[$i];
							}
							else
							{
								$feb_fee = 0;
							}
							if($u_m=='MAR' && $MAR[$i]==1)
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
							if($u_m=='APR' && $APR[$i]==1)
							{
								$apr_fee = $h_fee;
							}
							else
							{
								$apr_fee = 0;
							}
							if($u_m=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee;
							}
							else
							{
								$may_fee = 0;
							}
							if($u_m=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee;
							}
							else
							{
								$jun_fee = 0;
							}
							if($u_m=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee;
							}
							else
							{
								$jul_fee = 0;
							}
							if($u_m=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee;
							}
							else
							{
								$aug_fee = 0;
							}
							if($u_m=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee;
							}
							else
							{
								$sep_fee = 0;
							}
							if($u_m=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee;
							}
							else
							{
								$oct_fee = 0;
							}
							if($u_m=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee;
							}
							else
							{
								$nov_fee = 0;
							}
							if($u_m=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee-$s[$i];
							}
							else
							{
								$dec_fee = 0;
							}
							if($u_m=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee-$s[$i];
							}
							else
							{
								$jan_fee = 0;
							}
							if($u_m=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee-$s[$i];
							}
							else
							{
								$feb_fee = 0;
							}
							if($u_m=='MAR' && $MAR[$i]==1)
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
							if($u_m=='APR' && $APR[$i]==1)
							{
								$apr_fee = $h_fee;
							}
							else
							{
								$apr_fee = 0;
							}
							if($u_m=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee;
							}
							else
							{
								$may_fee = 0;
							}
							if($u_m=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee;
							}
							else
							{
								$jun_fee = 0;
							}
							if($u_m=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee;
							}
							else
							{
								$jul_fee = 0;
							}
							if($u_m=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee;
							}
							else
							{
								$aug_fee = 0;
							}
							if($u_m=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee;
							}
							else
							{
								$sep_fee = 0;
							}
							if($u_m=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee;
							}
							else
							{
								$oct_fee = 0;
							}
							if($u_m=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee;
							}
							else
							{
								$nov_fee = 0;
							}
							if($u_m=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee;
							}
							else
							{
								$dec_fee = 0;
							}
							if($u_m=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee-$s[$i];
							}
							else
							{
								$jan_fee = 0;
							}
							if($u_m=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee-$s[$i];
							}
							else
							{
								$feb_fee = 0;
							}
							if($u_m=='MAR' && $MAR[$i]==1)
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
							if($u_m=='APR' && $APR[$i]==1)
							{
								$apr_fee = $h_fee;
							}
							else
							{
								$apr_fee = 0;
							}
							if($u_m=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee;
							}
							else
							{
								$may_fee = 0;
							}
							if($u_m=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee;
							}
							else
							{
								$jun_fee = 0;
							}
							if($u_m=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee;
							}
							else
							{
								$jul_fee = 0;
							}
							if($u_m=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee;
							}
							else
							{
								$aug_fee = 0;
							}
							if($u_m=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee;
							}
							else
							{
								$sep_fee = 0;
							}
							if($u_m=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee;
							}
							else
							{
								$oct_fee = 0;
							}
							if($u_m=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee;
							}
							else
							{
								$nov_fee = 0;
							}
							if($u_m=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee;
							}
							else
							{
								$dec_fee = 0;
							}
							if($u_m=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee;
							}
							else
							{
								$jan_fee = 0;
							}
							if($u_m=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee-$s[$i];
							}
							else
							{
								$feb_fee = 0;
							}
							if($u_m=='MAR' && $MAR[$i]==1)
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
							if($u_m=='APR' && $APR[$i]==1)
							{
								$apr_fee = $h_fee;
							}
							else
							{
								$apr_fee = 0;
							}
							if($u_m=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee;
							}
							else
							{
								$may_fee = 0;
							}
							if($u_m=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee;
							}
							else
							{
								$jun_fee = 0;
							}
							if($u_m=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee;
							}
							else
							{
								$jul_fee = 0;
							}
							if($u_m=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee;
							}
							else
							{
								$aug_fee = 0;
							}
							if($u_m=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee;
							}
							else
							{
								$sep_fee = 0;
							}
							if($u_m=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee;
							}
							else
							{
								$oct_fee = 0;
							}
							if($u_m=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee;
							}
							else
							{
								$nov_fee = 0;
							}
							if($u_m=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee;
							}
							else
							{
								$dec_fee = 0;
							}
							if($u_m=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee;
							}
							else
							{
								$jan_fee = 0;
							}
							if($u_m=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee;
							}
							else
							{
								$feb_fee = 0;
							}
							if($u_m=='MAR' && $MAR[$i]==1)
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
							if($u_m=='APR' && $APR[$i]==1)
							{
								$apr_fee = $h_fee;
							}
							else
							{
								$apr_fee = 0;
							}
							if($u_m=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee;
							}
							else
							{
								$may_fee = 0;
							}
							if($u_m=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee;
							}
							else
							{
								$jun_fee = 0;
							}
							if($u_m=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee;
							}
							else
							{
								$jul_fee = 0;
							}
							if($u_m=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee;
							}
							else
							{
								$aug_fee = 0;
							}
							if($u_m=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee;
							}
							else
							{
								$sep_fee = 0;
							}
							if($u_m=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee;
							}
							else
							{
								$oct_fee = 0;
							}
							if($u_m=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee;
							}
							else
							{
								$nov_fee = 0;
							}
							if($u_m=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee;
							}
							else
							{
								$dec_fee = 0;
							}
							if($u_m=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee;
							}
							else
							{
								$jan_fee = 0;
							}
							if($u_m=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee;
							}
							else
							{
								$feb_fee = 0;
							}
							if($u_m=='MAR' && $MAR[$i]==1)
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
						if($u_m=='APR' && $APR[$i]==1)
						{
							$apr_fee = $h_fee;
						}
						else
						{
							$apr_fee = 0;
						}
						if($u_m=='MAY' && $may[$i]==1)
						{
							$may_fee = $h_fee;
						}
						else
						{
							$may_fee = 0;
						}
						if($u_m=='JUN' && $JUN[$i]==1)
						{
							$jun_fee = $h_fee;
						}
						else
						{
							$jun_fee = 0;
						}
						if($u_m=='JUL' && $JUL[$i]==1)
						{
							$jul_fee = $h_fee;
						}
						else
						{
							$jul_fee = 0;
						}
						if($u_m=='AUG' && $AUG[$i]==1)
						{
							$aug_fee = $h_fee;
						}
						else
						{
							$aug_fee = 0;
						}
						if($u_m=='SEP' && $SEP[$i]==1)
						{
							$sep_fee = $h_fee;
						}
						else
						{
							$sep_fee = 0;
						}
						if($u_m=='OCT' && $OCT[$i]==1)
						{
							$oct_fee = $h_fee;
						}
						else
						{
							$oct_fee = 0;
						}
						if($u_m=='NOV' && $NOV[$i]==1)
						{
							$nov_fee = $h_fee;
						}
						else
						{
							$nov_fee = 0;
						}
						if($u_m=='DEC' && $DECM[$i]==1)
						{
							$dec_fee = $h_fee;
						}
						else
						{
							$dec_fee = 0;
						}
						if($u_m=='JAN' && $JAN[$i]==1)
						{
							$jan_fee = $h_fee;
						}
						else
						{
							$jan_fee = 0;
						}
						if($u_m=='FEB' && $FEB[$i]==1)
						{
							$feb_fee = $h_fee;
						}
						else
						{
							$feb_fee = 0;
						}
						if($u_m=='MAR' && $MAR[$i]==1)
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
							if($u_m=='APR' && $APR[$i]==1)
							{
								$apr_fee = $h_fee-$s[$i];
							}
							else
							{
								$apr_fee = 0;
							}
							if($u_m=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee-$s[$i];
							}
							else
							{
								$may_fee = 0;
							}
							if($u_m=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee-$s[$i];
							}
							else
							{
								$jun_fee = 0;
							}
							if($u_m=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee-$s[$i];
							}
							else
							{
								$jul_fee = 0;
							}
							if($u_m=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee-$s[$i];
							}
							else
							{
								$aug_fee = 0;
							}
							if($u_m=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee-$s[$i];
							}
							else
							{
								$sep_fee = 0;
							}
							if($u_m=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee-$s[$i];
							}
							else
							{
								$oct_fee = 0;
							}
							if($u_m=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee-$s[$i];
							}
							else
							{
								$nov_fee = 0;
							}
							if($u_m=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee-$s[$i];
							}
							else
							{
								$dec_fee = 0;
							}
							if($u_m=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee-$s[$i];
							}
							else
							{
								$jan_fee = 0;
							}
							if($u_m=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee-$s[$i];
							}
							else
							{
								$feb_fee = 0;
							}
							if($u_m=='MAR' && $MAR[$i]==1)
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
							if($u_m=='APR' && $APR[$i]==1)
							{
								$apr_fee = $h_fee;
							}
							else
							{
								$apr_fee = 0;
							}
							if($u_m=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee-$s[$i];
							}
							else
							{
								$may_fee = 0;
							}
							if($u_m=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee-$s[$i];
							}
							else
							{
								$jun_fee = 0;
							}
							if($u_m=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee-$s[$i];
							}
							else
							{
								$jul_fee = 0;
							}
							if($u_m=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee-$s[$i];
							}
							else
							{
								$aug_fee = 0;
							}
							if($u_m=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee-$s[$i];
							}
							else
							{
								$sep_fee = 0;
							}
							if($u_m=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee-$s[$i];
							}
							else
							{
								$oct_fee = 0;
							}
							if($u_m=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee-$s[$i];
							}
							else
							{
								$nov_fee = 0;
							}
							if($u_m=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee-$s[$i];
							}
							else
							{
								$dec_fee = 0;
							}
							if($u_m=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee-$s[$i];
							}
							else
							{
								$jan_fee = 0;
							}
							if($u_m=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee-$s[$i];
							}
							else
							{
								$feb_fee = 0;
							}
							if($u_m=='MAR' && $MAR[$i]==1)
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
							if($u_m=='APR' && $APR[$i]==1)
							{
								$apr_fee = $h_fee;
							}
							else
							{
								$apr_fee = 0;
							}
							if($u_m=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee;
							}
							else
							{
								$may_fee = 0;
							}
							if($u_m=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee-$s[$i];
							}
							else
							{
								$jun_fee = 0;
							}
							if($u_m=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee-$s[$i];
							}
							else
							{
								$jul_fee = 0;
							}
							if($u_m=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee-$s[$i];
							}
							else
							{
								$aug_fee = 0;
							}
							if($u_m=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee-$s[$i];
							}
							else
							{
								$sep_fee = 0;
							}
							if($u_m=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee-$s[$i];
							}
							else
							{
								$oct_fee = 0;
							}
							if($u_m=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee-$s[$i];
							}
							else
							{
								$nov_fee = 0;
							}
							if($u_m=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee-$s[$i];
							}
							else
							{
								$dec_fee = 0;
							}
							if($u_m=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee-$s[$i];
							}
							else
							{
								$jan_fee = 0;
							}
							if($u_m=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee-$s[$i];
							}
							else
							{
								$feb_fee = 0;
							}
							if($u_m=='MAR' && $MAR[$i]==1)
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
							if($u_m=='APR' && $APR[$i]==1)
							{
								$apr_fee = $h_fee;
							}
							else
							{
								$apr_fee = 0;
							}
							if($u_m=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee;
							}
							else
							{
								$may_fee = 0;
							}
							if($u_m=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee;
							}
							else
							{
								$jun_fee = 0;
							}
							if($u_m=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee-$s[$i];
							}
							else
							{
								$jul_fee = 0;
							}
							if($u_m=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee-$s[$i];
							}
							else
							{
								$aug_fee = 0;
							}
							if($u_m=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee-$s[$i];
							}
							else
							{
								$sep_fee = 0;
							}
							if($u_m=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee-$s[$i];
							}
							else
							{
								$oct_fee = 0;
							}
							if($u_m=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee-$s[$i];
							}
							else
							{
								$nov_fee = 0;
							}
							if($u_m=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee-$s[$i];
							}
							else
							{
								$dec_fee = 0;
							}
							if($u_m=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee-$s[$i];
							}
							else
							{
								$jan_fee = 0;
							}
							if($u_m=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee-$s[$i];
							}
							else
							{
								$feb_fee = 0;
							}
							if($u_m=='MAR' && $MAR[$i]==1)
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
							if($u_m=='APR' && $APR[$i]==1)
							{
								$apr_fee = $h_fee;
							}
							else
							{
								$apr_fee = 0;
							}
							if($u_m=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee;
							}
							else
							{
								$may_fee = 0;
							}
							if($u_m=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee;
							}
							else
							{
								$jun_fee = 0;
							}
							if($u_m=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee;
							}
							else
							{
								$jul_fee = 0;
							}
							if($u_m=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee-$s[$i];
							}
							else
							{
								$aug_fee = 0;
							}
							if($u_m=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee-$s[$i];
							}
							else
							{
								$sep_fee = 0;
							}
							if($u_m=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee-$s[$i];
							}
							else
							{
								$oct_fee = 0;
							}
							if($u_m=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee-$s[$i];
							}
							else
							{
								$nov_fee = 0;
							}
							if($u_m=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee-$s[$i];
							}
							else
							{
								$dec_fee = 0;
							}
							if($u_m=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee-$s[$i];
							}
							else
							{
								$jan_fee = 0;
							}
							if($u_m=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee-$s[$i];
							}
							else
							{
								$feb_fee = 0;
							}
							if($u_m=='MAR' && $MAR[$i]==1)
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
							if($u_m=='APR' && $APR[$i]==1)
							{
								$apr_fee = $h_fee;
							}
							else
							{
								$apr_fee = 0;
							}
							if($u_m=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee;
							}
							else
							{
								$may_fee = 0;
							}
							if($u_m=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee;
							}
							else
							{
								$jun_fee = 0;
							}
							if($u_m=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee;
							}
							else
							{
								$jul_fee = 0;
							}
							if($u_m=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee;
							}
							else
							{
								$aug_fee = 0;
							}
							if($u_m=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee-$s[$i];
							}
							else
							{
								$sep_fee = 0;
							}
							if($u_m=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee-$s[$i];
							}
							else
							{
								$oct_fee = 0;
							}
							if($u_m=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee-$s[$i];
							}
							else
							{
								$nov_fee = 0;
							}
							if($u_m=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee-$s[$i];
							}
							else
							{
								$dec_fee = 0;
							}
							if($u_m=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee-$s[$i];
							}
							else
							{
								$jan_fee = 0;
							}
							if($u_m=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee-$s[$i];
							}
							else
							{
								$feb_fee = 0;
							}
							if($u_m=='MAR' && $MAR[$i]==1)
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
							if($u_m=='APR' && $APR[$i]==1)
							{
								$apr_fee = $h_fee;
							}
							else
							{
								$apr_fee = 0;
							}
							if($u_m=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee;
							}
							else
							{
								$may_fee = 0;
							}
							if($u_m=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee;
							}
							else
							{
								$jun_fee = 0;
							}
							if($u_m=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee;
							}
							else
							{
								$jul_fee = 0;
							}
							if($u_m=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee;
							}
							else
							{
								$aug_fee = 0;
							}
							if($u_m=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee;
							}
							else
							{
								$sep_fee = 0;
							}
							if($u_m=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee-$s[$i];
							}
							else
							{
								$oct_fee = 0;
							}
							if($u_m=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee-$s[$i];
							}
							else
							{
								$nov_fee = 0;
							}
							if($u_m=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee-$s[$i];
							}
							else
							{
								$dec_fee = 0;
							}
							if($u_m=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee-$s[$i];
							}
							else
							{
								$jan_fee = 0;
							}
							if($u_m=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee-$s[$i];
							}
							else
							{
								$feb_fee = 0;
							}
							if($u_m=='MAR' && $MAR[$i]==1)
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
							if($u_m=='APR' && $APR[$i]==1)
							{
								$apr_fee = $h_fee;
							}
							else
							{
								$apr_fee = 0;
							}
							if($u_m=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee;
							}
							else
							{
								$may_fee = 0;
							}
							if($u_m=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee;
							}
							else
							{
								$jun_fee = 0;
							}
							if($u_m=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee;
							}
							else
							{
								$jul_fee = 0;
							}
							if($u_m=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee;
							}
							else
							{
								$aug_fee = 0;
							}
							if($u_m=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee;
							}
							else
							{
								$sep_fee = 0;
							}
							if($u_m=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee;
							}
							else
							{
								$oct_fee = 0;
							}
							if($u_m=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee-$s[$i];
							}
							else
							{
								$nov_fee = 0;
							}
							if($u_m=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee-$s[$i];
							}
							else
							{
								$dec_fee = 0;
							}
							if($u_m=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee-$s[$i];
							}
							else
							{
								$jan_fee = 0;
							}
							if($u_m=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee-$s[$i];
							}
							else
							{
								$feb_fee = 0;
							}
							if($u_m=='MAR' && $MAR[$i]==1)
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
							if($u_m=='APR' && $APR[$i]==1)
							{
								$apr_fee = $h_fee;
							}
							else
							{
								$apr_fee = 0;
							}
							if($u_m=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee;
							}
							else
							{
								$may_fee = 0;
							}
							if($u_m=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee;
							}
							else
							{
								$jun_fee = 0;
							}
							if($u_m=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee;
							}
							else
							{
								$jul_fee = 0;
							}
							if($u_m=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee;
							}
							else
							{
								$aug_fee = 0;
							}
							if($u_m=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee;
							}
							else
							{
								$sep_fee = 0;
							}
							if($u_m=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee;
							}
							else
							{
								$oct_fee = 0;
							}
							if($u_m=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee;
							}
							else
							{
								$nov_fee = 0;
							}
							if($u_m=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee-$s[$i];
							}
							else
							{
								$dec_fee = 0;
							}
							if($u_m=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee-$s[$i];
							}
							else
							{
								$jan_fee = 0;
							}
							if($u_m=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee-$s[$i];
							}
							else
							{
								$feb_fee = 0;
							}
							if($u_m=='MAR' && $MAR[$i]==1)
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
							if($u_m=='APR' && $APR[$i]==1)
							{
								$apr_fee = $h_fee;
							}
							else
							{
								$apr_fee = 0;
							}
							if($u_m=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee;
							}
							else
							{
								$may_fee = 0;
							}
							if($u_m=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee;
							}
							else
							{
								$jun_fee = 0;
							}
							if($u_m=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee;
							}
							else
							{
								$jul_fee = 0;
							}
							if($u_m=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee;
							}
							else
							{
								$aug_fee = 0;
							}
							if($u_m=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee;
							}
							else
							{
								$sep_fee = 0;
							}
							if($u_m=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee;
							}
							else
							{
								$oct_fee = 0;
							}
							if($u_m=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee;
							}
							else
							{
								$nov_fee = 0;
							}
							if($u_m=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee;
							}
							else
							{
								$dec_fee = 0;
							}
							if($u_m=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee-$s[$i];
							}
							else
							{
								$jan_fee = 0;
							}
							if($u_m=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee-$s[$i];
							}
							else
							{
								$feb_fee = 0;
							}
							if($u_m=='MAR' && $MAR[$i]==1)
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
							if($u_m=='APR' && $APR[$i]==1)
							{
								$apr_fee = $h_fee;
							}
							else
							{
								$apr_fee = 0;
							}
							if($u_m=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee;
							}
							else
							{
								$may_fee = 0;
							}
							if($u_m=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee;
							}
							else
							{
								$jun_fee = 0;
							}
							if($u_m=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee;
							}
							else
							{
								$jul_fee = 0;
							}
							if($u_m=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee;
							}
							else
							{
								$aug_fee = 0;
							}
							if($u_m=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee;
							}
							else
							{
								$sep_fee = 0;
							}
							if($u_m=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee;
							}
							else
							{
								$oct_fee = 0;
							}
							if($u_m=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee;
							}
							else
							{
								$nov_fee = 0;
							}
							if($u_m=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee;
							}
							else
							{
								$dec_fee = 0;
							}
							if($u_m=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee;
							}
							else
							{
								$jan_fee = 0;
							}
							if($u_m=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee-$s[$i];
							}
							else
							{
								$feb_fee = 0;
							}
							if($u_m=='MAR' && $MAR[$i]==1)
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
							if($u_m=='APR' && $APR[$i]==1)
							{
								$apr_fee = $h_fee;
							}
							else
							{
								$apr_fee = 0;
							}
							if($u_m=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee;
							}
							else
							{
								$may_fee = 0;
							}
							if($u_m=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee;
							}
							else
							{
								$jun_fee = 0;
							}
							if($u_m=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee;
							}
							else
							{
								$jul_fee = 0;
							}
							if($u_m=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee;
							}
							else
							{
								$aug_fee = 0;
							}
							if($u_m=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee;
							}
							else
							{
								$sep_fee = 0;
							}
							if($u_m=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee;
							}
							else
							{
								$oct_fee = 0;
							}
							if($u_m=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee;
							}
							else
							{
								$nov_fee = 0;
							}
							if($u_m=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee;
							}
							else
							{
								$dec_fee = 0;
							}
							if($u_m=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee;
							}
							else
							{
								$jan_fee = 0;
							}
							if($u_m=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee;
							}
							else
							{
								$feb_fee = 0;
							}
							if($u_m=='MAR' && $MAR[$i]==1)
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
							if($u_m=='APR' && $APR[$i]==1)
							{
								$apr_fee = $h_fee;
							}
							else
							{
								$apr_fee = 0;
							}
							if($u_m=='MAY' && $may[$i]==1)
							{
								$may_fee = $h_fee;
							}
							else
							{
								$may_fee = 0;
							}
							if($u_m=='JUN' && $JUN[$i]==1)
							{
								$jun_fee = $h_fee;
							}
							else
							{
								$jun_fee = 0;
							}
							if($u_m=='JUL' && $JUL[$i]==1)
							{
								$jul_fee = $h_fee;
							}
							else
							{
								$jul_fee = 0;
							}
							if($u_m=='AUG' && $AUG[$i]==1)
							{
								$aug_fee = $h_fee;
							}
							else
							{
								$aug_fee = 0;
							}
							if($u_m=='SEP' && $SEP[$i]==1)
							{
								$sep_fee = $h_fee;
							}
							else
							{
								$sep_fee = 0;
							}
							if($u_m=='OCT' && $OCT[$i]==1)
							{
								$oct_fee = $h_fee;
							}
							else
							{
								$oct_fee = 0;
							}
							if($u_m=='NOV' && $NOV[$i]==1)
							{
								$nov_fee = $h_fee;
							}
							else
							{
								$nov_fee = 0;
							}
							if($u_m=='DEC' && $DECM[$i]==1)
							{
								$dec_fee = $h_fee;
							}
							else
							{
								$dec_fee = 0;
							}
							if($u_m=='JAN' && $JAN[$i]==1)
							{
								$jan_fee = $h_fee;
							}
							else
							{
								$jan_fee = 0;
							}
							if($u_m=='FEB' && $FEB[$i]==1)
							{
								$feb_fee = $h_fee;
							}
							else
							{
								$feb_fee = 0;
							}
							if($u_m=='MAR' && $MAR[$i]==1)
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
						if($u_m=='APR' && $APR[$i]==1)
						{
							$apr_fee = $h_fee;
						}
						else
						{
							$apr_fee = 0;
						}
						if($u_m=='MAY' && $may[$i]==1)
						{
							$may_fee = $h_fee;
						}
						else
						{
							$may_fee = 0;
						}
						if($u_m=='JUN' && $JUN[$i]==1)
						{
							$jun_fee = $h_fee;
						}
						else
						{
							$jun_fee = 0;
						}
						if($u_m=='JUL' && $JUL[$i]==1)
						{
							$jul_fee = $h_fee;
						}
						else
						{
							$jul_fee = 0;
						}
						if($u_m=='AUG' && $AUG[$i]==1)
						{
							$aug_fee = $h_fee;
						}
						else
						{
							$aug_fee = 0;
						}
						if($u_m=='SEP' && $SEP[$i]==1)
						{
							$sep_fee = $h_fee;
						}
						else
						{
							$sep_fee = 0;
						}
						if($u_m=='OCT' && $OCT[$i]==1)
						{
							$oct_fee = $h_fee;
						}
						else
						{
							$oct_fee = 0;
						}
						if($u_m=='NOV' && $NOV[$i]==1)
						{
							$nov_fee = $h_fee;
						}
						else
						{
							$nov_fee = 0;
						}
						if($u_m=='DEC' && $DECM[$i]==1)
						{
							$dec_fee = $h_fee;
						}
						else
						{
							$dec_fee = 0;
						}
						if($u_m=='JAN' && $JAN[$i]==1)
						{
							$jan_fee = $h_fee;
						}
						else
						{
							$jan_fee = 0;
						}
						if($u_m=='FEB' && $FEB[$i]==1)
						{
							$feb_fee = $h_fee;
						}
						else
						{
							$feb_fee = 0;
						}
						if($u_m=='MAR' && $MAR[$i]==1)
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
					/* if($stu_aprfee=='N/A' || $stu_aprfee=='') */
					/* { */
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
								$amt_fee = $feeclw_SPL[$i];
								break;
								case 5:
								$amt_fee = $feeclw_EXT[$i];
								break;
								case 6:
								$amt_fee = $feeclw_INTERNAL[$i];
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
							// End Of Checking Head Type //
							if($SCHOLAR==1)
							{
								if($Apply_From=='APR') // scholar ship apply from apr month
								{
									if($u_m=='APR')
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
									if($u_m=='APR')
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
								if($u_m=='APR')
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
							if($SCHOLAR==1)
							{
								if($Apply_From=='APR') // scholar ship apply from apr month
								{
									if($u_m=='APR')
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
									if($u_m=='APR')
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
								if($u_m=='APR')
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
					/* }
					else
					{
						$amt_feehead[$i] = 0;
					} */
				}
				else // calculation for old student without month wise //
				{
					$amt_feehead[$i] = 0;
				}
			}
		}
		$total_amount = $amt_feehead[1]+$amt_feehead[2]+$amt_feehead[3]+$amt_feehead[4]+$amt_feehead[5]+$amt_feehead[6]+$amt_feehead[7]+$amt_feehead[8]+$amt_feehead[9]+$amt_feehead[10]+$amt_feehead[11]+$amt_feehead[12]+$amt_feehead[13]+$amt_feehead[14]+$amt_feehead[15]+$amt_feehead[16]+$amt_feehead[17]+$amt_feehead[18]+$amt_feehead[19]+$amt_feehead[20]+$amt_feehead[21]+$amt_feehead[22]+$amt_feehead[22]+$amt_feehead[23]+$amt_feehead[24]+$amt_feehead[25];
		$array = array(
			'Month_NM' => $u_m,
			'STU_NAME' => $stu_name,
			'STUDENTID'=> $stu_id,
			'ADM_NO'   => $adm_no,
			'CLASS'    => $DISP_CLASS,
			'SEC'      => $DISP_SEC,
			'ROLL_NO'  => $ROLL_NO,
			'TOTAL'    => $total_amount,
			'Fee1' 	   => $amt_feehead[1],
			'Fee2'     => $amt_feehead[2],
			'Fee3'     => $amt_feehead[3],
			'Fee4'     => $amt_feehead[4],
			'Fee5'     => $amt_feehead[5],
			'Fee6'     => $amt_feehead[6],
			'Fee7'     => $amt_feehead[7],
			'Fee8'     => $amt_feehead[8],
			'Fee9'     => $amt_feehead[9],
			'Fee10'    => $amt_feehead[10],
			'Fee11'    => $amt_feehead[11],
			'Fee12'    => $amt_feehead[12],
			'Fee13'    => $amt_feehead[13],
			'Fee14'    => $amt_feehead[14],
			'Fee15'    => $amt_feehead[15],
			'Fee16'    => $amt_feehead[16],
			'Fee17'    => $amt_feehead[17],
			'Fee18'    => $amt_feehead[18],
			'Fee19'    => $amt_feehead[19],
			'Fee20'    => $amt_feehead[20],
			'Fee21'    => $amt_feehead[21],
			'Fee22'    => $amt_feehead[22],
			'Fee23'    => $amt_feehead[23],
			'Fee24'    => $amt_feehead[24],
			'Fee25'    => $amt_feehead[25],
			'Fee_details' => date("y-m-d")
		);
		if($cnt==1)
		{
			$this->dbcon->update('feegeneration',$array,"ADM_NO='$adm_no' AND Month_NM='$u_m'");
			echo "DATA UPDATE SUCCESSFULLY";
		}
		else
		{
			if($TOTAL_STUDENT>0)
			{
				$this->dbcon->insert('feegeneration',$array);
				echo "DATA INSERTED SUCCESSFULLY";
			}
			else{
				echo "PLEASE GENERATE ".$u_m." FEE";
			}
			
		}
		/* echo "<pre>";
		print_r($fee_details); */
	}
}
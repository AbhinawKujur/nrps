<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Cmonthly_calculation extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    
		$this->load->model('FARHEEN','farheen');
	}
	public function get_pay_details()
	{
		$adm_no  	= $this->input->post('adm_no');
		$ward_type  = $this->input->post('ward_type');
		$bsn		= $this->input->post('bsn');
		$rect_date = $this->input->post('rcpt_date');
		$bsa		= $this->input->post('bsa');
		$ffm		= $this->input->post('ffm');
		$month_data =$this->input->post('chkbox');
		$totfee9 = $this->farheen->select('daycoll', 'sum(fee9)sumfee9', "ADM_NO='$adm_no'");
		$totfee14 = $this->farheen->select('daycoll', 'sum(fee14)sumfee14', "ADM_NO='$adm_no'");
		$total_fee9  = $totfee9[0]->sumfee9;
		$total_fee14  = $totfee14[0]->sumfee14;
	
		//fetching data from the data base//
		$student_data = $this->farheen->select('student','*',"ADM_NO='$adm_no'");
		$session 	  = $this->farheen->select('session_master','*',"Active_Status='1'");
		$payment_mode = $this->farheen->select('payment_mode','*');
		$bank		  = $this->farheen->select('bank_master','*');
		
		if(isset($student_data))
		{
			$admission_no = $student_data[0]->ADM_NO;
			$STUDENTID = $student_data[0]->STUDENTID;
			$emp_ward     = $student_data[0]->EMP_WARD;
			$class        = $student_data[0]->CLASS;
			$hostel       = $student_data[0]->HOSTEL;
			$COMPUTER     = $student_data[0]->COMPUTER;
			$SESSIONID    = $student_data[0]->SESSIONID;
			$SCHOLAR      = $student_data[0]->SCHOLAR;
			$science	  = $student_data[0]->BUS_NO;
			$stop_amt_code= $student_data[0]->STOPNO;
			$stu_aprfee   = $student_data[0]->APR_FEE;
			$adm_status   = $student_data[0]->mid_session_admission_status;
			$Admission_month = $student_data[0]->Admission_month;
		}
		  if(isset($session))
		{
			$Session_ID = $session[0]->Session_ID;
			$Session_Nm = $session[0]->Session_Nm;
			$Session_Year = $session[0]->Session_Year;
			$Active_Status = $session[0]->Active_Status;
		}
		  if($SCHOLAR==1)
		  {
			$scholar_data = $this->farheen->select('scholarship','*',"STUDENTID='$STUDENTID'");
		    $Apply_From = $scholar_data[0]->Apply_From;
			$Apply_From_ID = $scholar_data[0]->AWARDED;
		  }
		  $cnt=0;
		  $h_fee = 0;
		  $t=0;
		  $total_amt=0;
		  $final_amount = array();
		foreach($month_data as $value)
		{
			$month = $value;
			 $cnt++;
			
		for($i=1;$i<=25;$i++)
		{
		   $t=0;
		   $h_fee = 0;
		 
		    $feehead[$i] 	= $this->farheen->select('feehead','*',"ACT_CODE='$i'");
			@$act_code[$i] 	= $feehead[$i][0]->ACT_CODE;
			@$fee_head[$i] 	= $feehead[$i][0]->FEE_HEAD;
			@$monthly[$i] 	= $feehead[$i][0]->MONTHLY;
			@$CL_BASED[$i]	= $feehead[$i][0]->CL_BASED;
			@$AMOUNT[$i]		= $feehead[$i][0]->AMOUNT;
			@$EMP[$i]		= $feehead[$i][0]->EMP;
			@$CCL[$i]			= $feehead[$i][0]->CCL;
			@$SPL[$i]			= $feehead[$i][0]->SPL;
			@$EXT[$i]			= $feehead[$i][0]->EXT;
			@$INTERNAL[$i]		= $feehead[$i][0]->INTERNAL;
			@$HType[$i]			= $feehead[$i][0]->HType;
			@$APR[$i]			= $feehead[$i][0]->APR;
			@$may[$i]			= $feehead[$i][0]->may;
			@$JUN[$i]			= $feehead[$i][0]->JUN;
			@$JUL[$i]			= $feehead[$i][0]->JUL;
			@$AUG[$i]			= $feehead[$i][0]->AUG;
			@$SEP[$i]			= $feehead[$i][0]->SEP;
			@$OCT[$i]			= $feehead[$i][0]->OCT;
			@$NOV[$i]			= $feehead[$i][0]->NOV;
			@$DECM[$i]			= $feehead[$i][0]->DECM;
			@$JAN[$i]			= $feehead[$i][0]->JAN;
			@$FEB[$i]			= $feehead[$i][0]->FEB;
			@$MAR[$i]			= $feehead[$i][0]->MAR;
			@$Annual[$i]         = $feehead[$i][0]->Annual;
			
			//fetching data from feeclw//
		    $feeclw   = $this->farheen->select('fee_clw','*',"FH='$i' AND CL='$class'");
			$feeclw_AMOUNT[$i]   = $feeclw[0]->AMOUNT;
			$feeclw_EMP[$i]      = $feeclw[0]->EMP;
			$feeclw_CCL[$i]      = $feeclw[0]->CCL;
			$feeclw_SPL[$i]      = $feeclw[0]->SPL;
			$feeclw_EXT[$i]      = $feeclw[0]->EXT;
			$feeclw_INTERNAL[$i] = $feeclw[0]->INTERNAL;
			
			if($monthly[$i] == 1) // calculation on the basis of month base //
			{	
			  $mnth_val = $this->farheen->feehead_mnth($month,$i);
			  $fhead_mnth =  $mnth_val[0]->mnth;
			  if($fhead_mnth == 1)
			  {
				  if($CL_BASED[$i] == 1) // calculation on the basis of class base //
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
						
						if($SCHOLAR==1) // calculation on the basis of the scholarship //
						{
							$scholar = $this->farheen->scholar_data($act_code[$i],$STUDENTID,$Apply_From_ID);
							@$scholar_val =  $scholar[0]->schl;
							
							if($HType[$i] == 'No')
								{
									$h_fee = $amt_fee ;
								}
								elseif($HType[$i] == 'COMPUTER')
								{
									if($COMPUTER==1)
										{
											$h_fee = $amt_fee ;
										}
										else
										{
											$h_fee = 0;
										}
								}
								elseif($HType[$i] == 'BUS')
								{
									$bus_fee = $this->farheen->getbusamountmonthwise($adm_no,$month);
									$h_fee = $bus_fee[0]->BUSAMOUNT;
								}
								elseif($HType[$i] == 'SCIENCE')
								{
									$h_fee = ($amt_fee*$science) ;
								}
								elseif($HType[$i] == 'LATEFINE')
								{
									
									$late_fine = $this->farheen->selectSingleData('latefine_master','*',"ID='1'");
									$l_status = $late_fine->status;
									$l_collection_mode = $late_fine->collection_mode;
									$l_month_applied = $late_fine->month_applied;
									$l_date_applied = $late_fine->date_applied;
									$l_late_amount = $late_fine->late_amount;
									$current_month = date('m');
									$sys_date = date('d');
									if($month==1)
									{
										$m=4;
									}elseif($month==2)
									{
										$m=5;
									}elseif($month==3)
									{
										$m=6;
									}
									elseif($month==4)
									{
										$m=7;
									}elseif($month==5)
									{
										$m=8;
									}elseif($month==6)
									{
										$m=9;
									}elseif($month==7)
									{
										$m=10;
									}
									elseif($month==8)
									{
										$m=11;
									}
									elseif($month==9)
									{
										$m=12;
									}
									elseif($month==10)
									{
										$m=1;
									}
									elseif($month==11)
									{
										$m=2;
									}
									elseif($month==12)
									{
										$m=3;
									}
									
									$diff=$current_month-$m;
									
									if($l_status == 1)
									{
										
										if($diff>0)
										{
											
											$late_fee = $l_late_amount;
										}
										elseif($diff=0)
										{
											
											if($l_date_applied<=$sys_date)
											{
											   $late_fee = $l_late_amount;
											}
											else
											{	
												 $late_fee = 0;
											}
										}								
										else
										{
											
											 $late_fee = 0;
										}
										
										   $h_fee=$late_fee;
										
									}
									else
									{
										$h_fee = 0;
									} 
								}
								
								elseif($HType[$i] == 'HOSTEL')
								{
									$h_fee = 0;
								}
								if($h_fee>0){
								if($scholar_val<=$h_fee)
								{
										$h_fee = $h_fee -$scholar_val;
								}
								else{
										$h_fee;
									}								
			                 	}
								
						}
						else
						{
							
							//Non Scholarship 
								if($HType[$i] == 'No')
								{
									$h_fee = $amt_fee;
								}
								elseif($HType[$i] == 'COMPUTER')
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
								elseif($HType[$i] == 'BUS')
								{
									$bus_fee = $this->farheen->getbusamountmonthwise($adm_no,$month);
									$h_fee = $bus_fee[0]->BUSAMOUNT;
									
								}
								elseif($HType[$i] == 'SCIENCE')
								{
									$h_fee = $amt_fee*$science;
								}
								elseif($HType[$i] == 'LATEFINE')
								{
							$late_fine = $this->farheen->selectSingleData('latefine_master','*',"ID='1'");
									$l_status = $late_fine->status;
									$l_collection_mode = $late_fine->collection_mode;
									$l_month_applied = $late_fine->month_applied;
									$l_date_applied = $late_fine->date_applied;
									$l_late_amount = $late_fine->late_amount;
									$current_month = date('m');
									$sys_date = date('d');
									if($month==1)
									{
										$m=4;
									}elseif($month==2)
									{
										$m=5;
									}elseif($month==3)
									{
										$m=6;
									}
									elseif($month==4)
									{
										$m=7;
									}elseif($month==5)
									{
										$m=8;
									}elseif($month==6)
									{
										$m=9;
									}elseif($month==7)
									{
										$m=10;
									}
									elseif($month==8)
									{
										$m=11;
									}
									elseif($month==9)
									{
										$m=12;
									}
									elseif($month==10)
									{
										$m=1;
									}
									elseif($month==11)
									{
										$m=2;
									}
									elseif($month==12)
									{
										$m=3;
									}
									
									$diff=$current_month-$m;
									
									if($l_status == 1)
									{
										
										if($diff>0)
										{
											
											$late_fee = $l_late_amount;
										}
										elseif($diff=0)
										{
											
											if($l_date_applied<=$sys_date)
											{
											   $late_fee = $l_late_amount;
											}
											else
											{	
												 $late_fee = 0;
											}
										}								
										else
										{
											
											 $late_fee = 0;
										}
										
										   $h_fee=$late_fee;
										
									}
									else
									{
										$h_fee = 0;
									} 
								}
								
								elseif($HType[$i] == 'BOOK')
								{
									$h_fee = 0;
								}
								elseif($HType[$i] == 'DUES')
								{
									$h_fee = 0;
								}
								elseif($HType[$i] == 'HOSTEL')
								{
									$h_fee = 0;
								}
						}
						
				}
				else
				{
					//Non class base
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
						
						if($SCHOLAR==1) // calculation on the basis of the scholarship //
						{
							$scholar = $this->farheen->scholar_data($act_code[$i],$adm_no,$Apply_From_ID);
							@$scholar_val =  $scholar[0]->schl;
							
							if($HType[$i] == 'No')
								{
									$h_fee = $amt_fee ;
								}
								elseif($HType[$i] == 'COMPUTER')
								{
									if($COMPUTER==1)
										{
											$h_fee = $amt_fee ;
										}
										else
										{
											$h_fee = 0;
										}
								}
								elseif($HType[$i] == 'BUS')
								{
									$bus_fee = $this->farheen->getbusamountmonthwise($adm_no,$month);
									$h_fee = (sizeof($bus_fee)==0)?0:$bus_fee[0]->BUSAMOUNT;
								}
								elseif($HType[$i] == 'SCIENCE')
								{
									$h_fee = ($amt_fee*$science) ;
								}
								elseif($HType[$i] == 'LATEFINE')
								{
									
									$late_fine = $this->farheen->selectSingleData('latefine_master','*',"ID='1'");
									$l_status = $late_fine->status;
									$l_collection_mode = $late_fine->collection_mode;
									$l_month_applied = $late_fine->month_applied;
									$l_date_applied = $late_fine->date_applied;
									$l_late_amount = $late_fine->late_amount;
									$current_month = date('m');
									$sys_date = date('d');
									if($month==1)
									{
										$m=4;
									}elseif($month==2)
									{
										$m=5;
									}elseif($month==3)
									{
										$m=6;
									}
									elseif($month==4)
									{
										$m=7;
									}elseif($month==5)
									{
										$m=8;
									}elseif($month==6)
									{
										$m=9;
									}elseif($month==7)
									{
										$m=10;
									}
									elseif($month==8)
									{
										$m=11;
									}
									elseif($month==9)
									{
										$m=12;
									}
									elseif($month==10)
									{
										$m=1;
									}
									elseif($month==11)
									{
										$m=2;
									}
									elseif($month==12)
									{
										$m=3;
									}
									
									$diff=$current_month-$m;
									
									if($l_status == 1)
									{
										
										if($diff>0)
										{
											
											$late_fee = $l_late_amount;
										}
										elseif($diff=0)
										{
											
											if($l_date_applied<=$sys_date)
											{
											   $late_fee = $l_late_amount;
											}
											else
											{	
												 $late_fee = 0;
											}
										}								
										else
										{
											
											 $late_fee = 0;
										}
										
										   $h_fee=$late_fee;
										
									}
									else
									{
										$h_fee = 0;
									} 
								}
								
								elseif($HType[$i] == 'HOSTEL')
								{
									$h_fee = 0;
								}
								if($h_fee>0){
								if($scholar_val<=$h_fee)
								{
										$h_fee = $h_fee;
								}
								else{
										$h_fee;
									}								
			                 	}
								
						}
						else{    // calculation on the basis of without scholarship //
							
							if($HType[$i] == 'No')
								{
									$h_fee = $amt_fee;
								}
								elseif($HType[$i] == 'COMPUTER')
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
								elseif($HType[$i] == 'BUS')
								{
									$bus_fee = $this->farheen->getbusamountmonthwise($adm_no,$month);
									$h_fee = (sizeof($bus_fee)==0)?0:$bus_fee[0]->BUSAMOUNT;
								}
								elseif($HType[$i] == 'SCIENCE')
								{
									$h_fee = $amt_fee*$science;
								}
								elseif($HType[$i] == 'LATEFINE')
								{
										$late_fine = $this->farheen->selectSingleData('latefine_master','*',"ID='1'");
									$l_status = $late_fine->status;
									$l_collection_mode = $late_fine->collection_mode;
									$l_month_applied = $late_fine->month_applied;
									$l_date_applied = $late_fine->date_applied;
									$l_late_amount = $late_fine->late_amount;
									$current_month = date('m');
									$sys_date = date('d');
									if($month==1)
									{
										$m=4;
									}elseif($month==2)
									{
										$m=5;
									}elseif($month==3)
									{
										$m=6;
									}
									elseif($month==4)
									{
										$m=7;
									}elseif($month==5)
									{
										$m=8;
									}elseif($month==6)
									{
										$m=9;
									}elseif($month==7)
									{
										$m=10;
									}
									elseif($month==8)
									{
										$m=11;
									}
									elseif($month==9)
									{
										$m=12;
									}
									elseif($month==10)
									{
										$m=1;
									}
									elseif($month==11)
									{
										$m=2;
									}
									elseif($month==12)
									{
										$m=3;
									}
									
									$diff=$current_month-$m;
									
									if($l_status == 1)
									{
										
										if($diff>0)
										{
											
											$late_fee = $l_late_amount;
										}
										elseif($diff=0)
										{
											
											if($l_date_applied<=$sys_date)
											{
											   $late_fee = $l_late_amount;
											}
											else
											{	
												 $late_fee = 0;
											}
										}								
										else
										{
											
											 $late_fee = 0;
										}
										
										   $h_fee=$late_fee;
										
									}
									else
									{
										$h_fee = 0;
									} 
								}
								elseif($HType[$i] == 'BOOK')
								{
									$h_fee = 0;
								}
								elseif($HType[$i] == 'DUES')
								{
									$h_fee = 0;
								}
								elseif($HType[$i] == 'HOSTEL')
								{
									$h_fee = 0;
								}
							
						}
					
				}
			  }
			  else
			  {
				 // echo 'if month is not Condition for new admission fee';
				 
			  }
				
			
			}
			else
			{
				if($CL_BASED[$i] == 1) // calculation on the basis of class base //
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
						
						if($SCHOLAR==1) // calculation on the basis of the scholarship //
						{
							$scholar = $this->farheen->scholar_data($act_code[$i],$adm_no,$Apply_From_ID);
							@$scholar_val =  $scholar[0]->schl;
							
							if($HType[$i] == 'No')
								{
									if($Session_Year==$SESSIONID)
									{
									if($fhead_mnth == 1)
			                        {
									
									$h_fee = $amt_fee;
									}
									else
									{
									  $h_fee = 0;
									}
									}
								}
								elseif($HType[$i] == 'COMPUTER')
								{
									if($COMPUTER==1)
										{
											$h_fee = $amt_fee ;
										}
										else
										{
											$h_fee = 0;
										}
								}
								elseif($HType[$i] == 'BUS')
								{
									$bus_fee = $this->farheen->getbusamountmonthwise($adm_no,$month);
									$h_fee = (sizeof($bus_fee)==0)?0:$bus_fee[0]->BUSAMOUNT;
								}
								elseif($HType[$i] == 'SCIENCE')
								{
									$h_fee = ($amt_fee*$science) ;
								}
								elseif($HType[$i] == 'LATEFINE')
								{
									
									$late_fine = $this->farheen->selectSingleData('latefine_master','*',"ID='1'");
									$l_status = $late_fine->status;
									$l_collection_mode = $late_fine->collection_mode;
									$l_month_applied = $late_fine->month_applied;
									$l_date_applied = $late_fine->date_applied;
									$l_late_amount = $late_fine->late_amount;
									$current_month = date('m');
									$sys_date = date('d');
									if($month==1)
									{
										$m=4;
									}elseif($month==2)
									{
										$m=5;
									}elseif($month==3)
									{
										$m=6;
									}
									elseif($month==4)
									{
										$m=7;
									}elseif($month==5)
									{
										$m=8;
									}elseif($month==6)
									{
										$m=9;
									}elseif($month==7)
									{
										$m=10;
									}
									elseif($month==8)
									{
										$m=11;
									}
									elseif($month==9)
									{
										$m=12;
									}
									elseif($month==10)
									{
										$m=1;
									}
									elseif($month==11)
									{
										$m=2;
									}
									elseif($month==12)
									{
										$m=3;
									}
									
									$diff=$current_month-$m;
									
									if($l_status == 1)
									{
										
										if($diff>0)
										{
											
											$late_fee = $l_late_amount;
										}
										elseif($diff=0)
										{
											
											if($l_date_applied<=$sys_date)
											{
										
											   $late_fee = $l_late_amount;
											}
											else
											{	
												
												 $late_fee = 0;
											}
										}								
										else
										{
											
											 $late_fee = 0;
										}
										
										   $h_fee=$late_fee;
										
									}
									else
									{
										$h_fee = 0;
									} 
								}
								
								elseif($HType[$i] == 'HOSTEL')
								{
									$h_fee = 0;
								}
								if($h_fee>0){
								if($scholar_val<=$h_fee)
								{
										$h_fee = $h_fee -$scholar_val;
								}
								else{
										$h_fee;
									}								
			                 	}
								
						}
						else
						{
							
							//Non Scholarship 
								if($HType[$i] == 'No')
								{
									if($Session_Year==$SESSIONID)
									{
									if($fhead_mnth == 1)
			                        {
									
									$h_fee = $amt_fee;
									}
									else
									{
									  $h_fee = 0;
									}
									}
									
								}
								elseif($HType[$i] == 'COMPUTER')
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
								elseif($HType[$i] == 'BUS')
								{
									$bus_fee = $this->farheen->getbusamountmonthwise($adm_no,$month);
									$h_fee = (sizeof($bus_fee)==0)?0:$bus_fee[0]->BUSAMOUNT;
									
								}
								elseif($HType[$i] == 'SCIENCE')
								{
									$h_fee = $amt_fee*$science;
								}
								elseif($HType[$i] == 'LATEFINE')
								{
									
									$late_fine = $this->farheen->selectSingleData('latefine_master','*',"ID='1'");
									$l_status = $late_fine->status;
									$l_collection_mode = $late_fine->collection_mode;
									$l_month_applied = $late_fine->month_applied;
									$l_date_applied = $late_fine->date_applied;
									$l_late_amount = $late_fine->late_amount;
									$current_month = date('m');
									$sys_date = date('d');
									if($month==1)
									{
										$m=4;
									}elseif($month==2)
									{
										$m=5;
									}elseif($month==3)
									{
										$m=6;
									}
									elseif($month==4)
									{
										$m=7;
									}elseif($month==5)
									{
										$m=8;
									}elseif($month==6)
									{
										$m=9;
									}elseif($month==7)
									{
										$m=10;
									}
									elseif($month==8)
									{
										$m=11;
									}
									elseif($month==9)
									{
										$m=12;
									}
									elseif($month==10)
									{
										$m=1;
									}
									elseif($month==11)
									{
										$m=2;
									}
									elseif($month==12)
									{
										$m=3;
									}
									
									$diff=$current_month-$m;
									
									if($l_status == 1)
									{
										
										if($diff>0)
										{
											
											$late_fee = $l_late_amount;
										}
										elseif($diff=0)
										{
											
											if($l_date_applied<=$sys_date)
											{
											   $late_fee = $l_late_amount;
											}
											else
											{	
												 $late_fee = 0;
											}
										}								
										else
										{
											
											 $late_fee = 0;
										}
										
										   $h_fee=$late_fee;
										
									}
									else
									{
										$h_fee = 0;
									} 
								}
								elseif($HType[$i] == 'BOOK')
								{
									$h_fee = 0;
								}
								elseif($HType[$i] == 'DUES')
								{
									$h_fee = 0;
								}
								elseif($HType[$i] == 'HOSTEL')
								{
									$h_fee = 0;
								}
						}
				}
				else{
					
				}
			}
				
				if($cnt==1)
				{
				$final_amount[$i] = $h_fee;	
				}
				else{
					
					$t = $final_amount[$i];
					$final_amount[$i] = $t + $h_fee;
				}
				
			}
			
			}
			
			for($i=1;$i<=25;$i++)
			{
				 "feehead".$i."->".$final_amount[$i]."<br/>";
				
				$total_amt +=  $final_amount[$i];
			}
		if ($class_nm == "P.NUR" || $class_nm == "NUR" || $class_nm == "PREP") {
			$fee9amt = '1000';
			$fee14amt = '1000';
		} elseif ($class_nm == "II" || $class_nm == "III" || $class_nm == "IV" || $class_nm == "I" || $class_nm == "V" || $class_nm == "VI" || $class_nm == "VII" || $class_nm == "VIII" || $class_nm == "IX" || $class_nm == "X") {
			$fee9amt = '4500';
			$fee14amt = '4500';
				
		} else {
			if ($WARD == "1" || $WARD == "5" || $WARD == "2"  || $WARD == "4") {
				$fee9amt = '4500';
				$fee14amt = '4500';
			}
		}
		//echo '$final_amount[9]: '.$final_amount[9];
		//echo '<br/>';
		//echo '$total_fee9: '.$total_fee9;	
		//echo '<br/>';
		//echo '$final_amount[14]: '.$final_amount[14];
		//echo '<br/>';
		//echo '$total_fee14: '.$total_fee14;	
		if ($total_fee9 == $final_amount[9]) {
			$finalfee9amt = 0;
		} 
		else
		{
			$finalfee9amt = $final_amount[9];
		}
		
		if ($total_fee14 == $final_amount[14]) {
			$finalfee14amt = 0;
		} 
		else
		{
			$finalfee14amt = $final_amount[14];
		}
								 
			//$total_amount = $final_amount[1]+$final_amount[2]+$final_amount[3]+$final_amount[4]+$final_amount[5]+$final_amount[6]+$final_amount[7]+$final_amount[8]+$final_amount[9]+$final_amount[10]+$final_amount[11]+$final_amount[12]+$final_amount[13]+$final_amount[14]+$final_amount[15]+$final_amount[16]+$final_amount[17]+$final_amount[18]+$final_amount[19]+$final_amount[20]+$final_amount[21]+$final_amount[22]+$final_amount[22]+$final_amount[23]+$final_amount[24]+$final_amount[25];
			
		$total_amount = $final_amount[1]+$final_amount[2]+$final_amount[3]+$final_amount[4]+$final_amount[5]+$final_amount[6]+$final_amount[7]+$final_amount[8]+$finalfee9amt+$final_amount[10]+$final_amount[11]+$final_amount[12]+$final_amount[13]+$finalfee14amt+$final_amount[15]+$final_amount[16]+$final_amount[17]+$final_amount[18]+$final_amount[19]+$final_amount[20]+$final_amount[21]+$final_amount[22]+$final_amount[22]+$final_amount[23]+$final_amount[24]+$final_amount[25];
			
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
				//'apr'       => $aprr1,
				//'may'       => $mayy1,
				//'jun'       => $junn1,
				//'jul'       => $jull1,
				//'aug'       => $augg1,
				//'sep'       => $sepp1,
				//'oct'       => $octt1,
				//'nov'       => $novv1,
				//'dec'       => $decc1,
				//'jan'       => $jann1,
				//'feb'       => $febb1,
				//'mar'       => $marr1,
				'amt_feehead1' => $final_amount[1],
				'amt_feehead2' => $final_amount[2],
				'amt_feehead3' => $final_amount[3],
				'amt_feehead4' => $final_amount[4],
				'amt_feehead5' => $final_amount[5],
				'amt_feehead6' => $final_amount[6],
				'amt_feehead7' => $final_amount[7],
				'amt_feehead8' => $final_amount[8],
				//'amt_feehead9' => $final_amount[9],
				'amt_feehead9' => $finalfee9amt,
				'amt_feehead10' => $final_amount[10],
				'amt_feehead11' => $final_amount[11],
				'amt_feehead12' => $final_amount[12],
				'amt_feehead13' => $final_amount[13],
				//'amt_feehead14' => $final_amount[14],
				'amt_feehead14' => $finalfee14amt,
				'amt_feehead15' => $final_amount[15],
				'amt_feehead16' => $final_amount[16],
				'amt_feehead17' => $final_amount[17],
				'amt_feehead18' => $final_amount[18],
				'amt_feehead19' => $final_amount[19],
				'amt_feehead20' => $final_amount[20],
				'amt_feehead21' => $final_amount[21],
				'amt_feehead22' => $final_amount[22],
				'amt_feehead23' => $final_amount[23],
				'amt_feehead24' => $final_amount[24],
				'amt_feehead25' => $final_amount[25],
				'total_amount'  => $total_amount,
				'payment_mode'  => $payment_mode,
				'bank'			=> $bank,
				'student_data'	=> $student_data,
				'ward_type'     => $ward_type,
				'bsn'           => $bsn,
				'bsa'			=> $bsa,
				'ffm'			=> $ffm,
				'rect_date'    =>$rect_date,
			);
			
			$this->load->view('Fee_collection/feehaead_calculation_monthwise',$array);
			
    }
}
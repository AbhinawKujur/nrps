<html>
  <title>Report Card</title>
  <head>
    <link rel="stylesheet" href="<?php echo base_url('assets/dash_css/bootstrap.min.css'); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Laila:700&display=swap" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Notable' rel='stylesheet' type='text/css'>
	
	<style> 
	  .table > thead > tr > th,
	  .table > tbody > tr > th,
	  .table > tfoot > tr > th,
	  .table > thead > tr > td,
	  .table > tbody > tr > td,
	  .table > tfoot > tr > td {
			font-size:11px;
			padding:1px !important;
			text-align:center;
	   }
	   @media print {
		   padding-top:0px;
		   footer {page-break-after: always;}
	   }
	   .page-break{
			page-break-before:always;
		} 
	   .sign{
		font-family: 'Laila', serif;
		}
		body{
			padding-left:15px;
			padding-right:15px;
		}	
		.table,tr,td,th{
		  border: 1px solid #000000;
		  border-top:1px solid #000 !important;
		}
		.no_border tr td,.no_border tr th{
			border:none !important;
		}
		
		.sin_no_border{
			border:none !important;
		}
		.schl_nm{
			font-family: 'Notable', sans-serif;
			color:#f51322 !important;
		}
	</style>
  </head>
  
  <body>
    <?php
	  foreach($selected_stu as $key => $val){

		  $stu_data = $this->alam->selectA('student','ADM_NO,DISP_CLASS,CLASS,DISP_SEC,SEC,ROLL_NO,FIRST_NM,MIDDLE_NM,MOTHER_NM,FATHER_NM,BIRTH_DT',"ADM_NO='$val' AND Student_Status='ACTIVE'");
		  
		  $ADM_NO     = $stu_data[0]['ADM_NO'];
		  $DISP_CLASS = $stu_data[0]['DISP_CLASS'];
		  $CLASS      = $stu_data[0]['CLASS'];
		  $DISP_SEC   = $stu_data[0]['DISP_SEC'];
		  $SEC        = $stu_data[0]['SEC'];
		  $ROLL_NO    = $stu_data[0]['ROLL_NO'];
		  $FIRST_NM   = $stu_data[0]['FIRST_NM'];
		  $MIDDLE_NM  = $stu_data[0]['MIDDLE_NM'];
		  $MOTHER_NM  = $stu_data[0]['MOTHER_NM'];
		  $FATHER_NM  = $stu_data[0]['FATHER_NM'];
		  $BIRTH_DT   = $stu_data[0]['BIRTH_DT'];
		  
		  //attendance
		  $work_day = 0;
		  $present_day = 0;
		  $att_present = 0;
		  $working_attendance = $this->sumit->fetchSingleData('COUNT(DISTINCT att_date)total_attendance','stu_attendance_entry_periodwise',"date(att_date) between'2019-04-01' AND '2020-03-31' AND class_code='$CLASS' AND sec_code='$SEC' AND admno='$ADM_NO'");
		 
		  $work_day = (!empty($working_attendance['total_attendance']))?$working_attendance['total_attendance']:0;
		  
		  $present_attendance = $this->sumit->fetchSingleData('COUNT(DISTINCT att_date)total_attendance','stu_attendance_entry_periodwise',"date(att_date) between'2019-04-01' AND '2020-03-31' AND class_code='$CLASS' AND sec_code='$SEC' AND admno='$ADM_NO' AND att_status='P'");
		  $this->db->last_query()."<br />";
		  $present_day = (!empty($present_attendance['total_attendance']))?$present_attendance['total_attendance']:0;
		  
		  if($work_day > 0){
			  $final_att = number_format(($present_day/$work_day)*100,2);
		  }else{
			  $final_att = 0;
		  }
		  //$total_attendance = (!empty($attendance[0]['total_attendance']))?$attendance[0]['total_attendance']:0;
		  // if($total_attendance == 0){
			// $total_percentage = 0;
		  // }else{
			//echo "gdfgdfg".$total_percentage = ($total_attendance*100)/$total_attendance;
		  //}
		  
		  $grd        = $this->alam->annual_report_card_student_detail2($class,$sec,$val);
	     
		  $t1_skill_1 = $grd[0]->t1_skill_1;
		  $t1_skill_2 = $grd[0]->t1_skill_2;
		  $t1_skill_3 = $grd[0]->t1_skill_3;
		  $t1_dis_grd = $grd[0]->t1_dis_grd;
		  $t1_rmks    = $grd[0]->t1_rmks;
		  $t2_skill_1 = $grd[0]->t2_skill_1;
		  $t2_skill_2 = $grd[0]->t2_skill_2;
		  $t2_skill_3 = $grd[0]->t2_skill_3;
		  $t2_dis_grd = $grd[0]->t2_dis_grd;
		  $t2_rmks    = $grd[0]->t2_rmks;
		  
		  $t1_dis_skill_1_grd = $grd[0]->t1_dis_skill_1_grd;
		  $t1_dis_skill_2_grd = $grd[0]->t1_dis_skill_2_grd;
		  $t1_dis_skill_3_grd = $grd[0]->t1_dis_skill_3_grd;
		  $t1_dis_skill_4_grd = $grd[0]->t1_dis_skill_4_grd;
		  $t2_dis_skill_1_grd = $grd[0]->t2_dis_skill_1_grd;
		  $t2_dis_skill_2_grd = $grd[0]->t2_dis_skill_2_grd;
		  $t2_dis_skill_3_grd = $grd[0]->t2_dis_skill_3_grd;
		  $t2_dis_skill_4_grd = $grd[0]->t2_dis_skill_4_grd;
		  
		  
		  $grand_total = array();
	?>
	<div style='border:3px solid #000 !important; padding:5px 20px 0px 20px;'>
	<div class='row'>
		<div class="col-sm-3 col-xs-3">
		   <img class="pull-right" src="<?php echo base_url($School_Logo); ?>" style="width:100px;">
		</div>
		<div class='col-sm-6 col-xs-6'>
		  <center>
			<?php
			  echo "<h3 class='schl_nm'>".$school_setting[0]->School_Name."</h3>";
			  echo "<span style='color:#f51322 !important;'>".$school_setting[0]->School_Address ."</span><br/>";
			  echo "<b>ACADEMIC SESSION:</b> ".$school_setting[0]->School_Session ."<br />";
			  //echo "<b>Affiliation No. - </b>".$school_setting[0]->School_AfftNo .",<b> School Code - </b>".$school_setting[0]->School_Code;
			  echo "<h4>REPORT CARD</h4>";
			?>
		  </center>
		</div>
		<div class="col-sm-3 col-xs-3">
		  <img src="<?php echo base_url($school_setting[0]->SCHOOL_LOGO); ?>" style="width:100px;">
		</div>
    </div>
	<div class='row'>
	  <table class='table no_border'>
		<tr>
		  <th style='text-align:left; font-size:15px;'>Admission No.</th>
		  <th><b>:</b></th>
		  <td style='text-align:left; font-size:15px;'><?php echo $ADM_NO; ?></td>
		  <th style='text-align:left; font-size:15px;'>Class - Sec</th>
		  <th><b>:</b></th>
		  <td style='text-align:left; font-size:15px;'><?php echo $DISP_CLASS ." - " . $DISP_SEC; ?></td>
		  <th style='text-align:left; font-size:15px;'>Roll No.</th>
		  <th><b>:</b></th>
		  <td style='text-align:left; font-size:15px;'><?php echo $ROLL_NO; ?></td>
		  <td></td>
		</tr>
		
		<tr>
		  <th style='text-align:left; font-size:15px;'>Student's Name </th>
		  <th><b>:</b></th>
		  <td style='text-align:left; font-size:15px;'><?php echo $FIRST_NM . " " . $MIDDLE_NM; ?></td>
		  <th style='text-align:left; font-size:15px;'>Date of Birth </th>
		  <th><b>:</b></th>
		  <td style='text-align:left; font-size:15px;'><?php echo date('d-M-Y',strtotime($BIRTH_DT)); ?></td>
		  <th style='text-align:left; font-size:15px;'>Attendance</th>
		  <th><b>:</b></th>
		  <td style='text-align:left; font-size:15px;'><?php echo $final_att."%"; ?></td>
		  <td></td>
		</tr>
		
		<tr>
		  <th style='text-align:left; font-size:15px;'>Mother's Name </th>
		  <th><b>:</b></th>
		  <td colspan='1' style='text-align:left; font-size:15px;'><?php echo $MOTHER_NM; ?></td>
		  <th style='text-align:left; font-size:15px;'>Father's Name </th>
		  <th><b>:</b></th>
		  <td colspan='5' style='text-align:left; font-size:15px;'><?php echo $FATHER_NM; ?></td>
		</tr>
	  </table>
	</div>
    <div class='row'>	
    <table border='1' class='table'>
	<thead>
	  <tr>
		<th style='color:#fff !important; background:#f51322 !important; font-weight:bold !important; font-size:13px;'>Scholastic Areas:</th>
		<th  colspan='6' style='color:#fff !important; background:#f51322 !important; font-weight:bold !important; font-size:13px;'>Term-I (100 Marks)</th>
		<th colspan='6' style='color:#fff !important; background:#f51322 !important; font-weight:bold !important; font-size:13px;'>Term-II (100 Marks)</th>
		<th style='color:#fff !important; background:#f51322 !important; font-weight:bold !important; font-size:13px;'></th>
		<th style='color:#fff !important; background:#f51322 !important; font-weight:bold !important; font-size:13px;'></th>
	  </tr>
	  <tr>
	    <td style='background:#faf8e1 !important;'>Subject Name</td>
		<td style='background:#faf8e1 !important;'>Periodic Test (10)</td>
		<td style='background:#faf8e1 !important;'>Note Book (5)</td>
		<td style='background:#faf8e1 !important;'>Subject Enrichment (5)</td>
		<td style='background:#faf8e1 !important;'>Half Yearly (80)</td>
		<td style='background:#faf8e1 !important;'>Marks Obtained (100)</td>
		<td style='background:#faf8e1 !important;'>Grade</td>
		
		<td style='background:#faf8e1 !important;'>Periodic Test (10)</td>
		<td style='background:#faf8e1 !important;'>Note Book (5)</td>
		<td style='background:#faf8e1 !important;'>Subject Enrichment (5)</td>
		<td style='background:#faf8e1 !important;'>Annual (80)</td>
		<td style='background:#faf8e1 !important;'>Marks Obtained (100)</td>
		<td style='background:#faf8e1 !important;'>Grade</td>
		<td style='background:#faf8e1 !important;'>Term-I + Term-II (MO)</td>
		<td style='background:#faf8e1 !important;'>Term-I + Term-II (Grade)</td>
	  </tr>
	  </thead>
	  <tbody>
	  <tr>
	    <!-- term-1 -->
		  <?php
		    $mo = '';
			$subj_mrks = array();
		    foreach($subjectData as $key2 => $val2){
			    $subj_code = $val2['subject_code'];
				$pt_type   = $val2['pt_type'];
				if($val2['opt_code'] == 2){
					
					$check_student_subject = $this->sumit->checkData('*','studentsubject',array('Adm_no'=>$val,'Class'=>$class,'SUBCODE'=>$val2['subject_code']));
				}else{
					
					 $check_student_subject = true;
				}
				$final_marks = array();
				if($check_student_subject){
                   $examcodeT1 = array('1','2','3','4');
                   $examcodeT2 = array('1','2','3','5');
				   
                   foreach($examcodeT1 as $key3 => $val3){

                   	$examC = ($val3==1)?"1,7,8":$val3;
					$wetageData = $this->alam->selectA('exammaster','wetage1',"ExamCode = '$val3'");
					$wetage1 = $wetageData[0]['wetage1'];
					
					$marksData = $this->alam->selectA('marks','*',"admno = '$val' AND Term = 'TERM-1' AND Classes = '$CLASS' AND ExamC IN ($examC) AND SCode = '$subj_code'");
					$mark   = array();
					$absent = array();
					if($val3 == 1){
					//check PT//
					if($pt_type == 1){
						foreach ($marksData as $key4 => $value4) {

							$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetage1;
							$absent[$key4] = $value4['M2'];
						}
						$absent_count = count($absent);
						$total_ab_count = array_count_values($absent);
						$total_ab_count['AB'] = (!isset($total_ab_count['AB']))?0:$total_ab_count['AB'];
						$ab = ($absent_count == $total_ab_count['AB'])?'AB':'0';
						$final_marks[$key3] = ($ab == 'AB')?$ab:number_format(max($mark),2);

					}
					elseif($pt_type == 2){						
						foreach ($marksData as $key4 => $value4) {

							$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetage1;
							$tot_per = $tot_per + $mark[$key4];
							$absent[$key4] = $value4['M2'];
						}
						$absent_count = count($absent);
						$total_ab_count = array_count_values($absent);
						$total_ab_count['AB'] = (!isset($total_ab_count['AB']))?0:$total_ab_count['AB'];
						$ab = ($absent_count == $total_ab_count['AB'])?'AB':'0';
						$final_marks[$key3] = ($ab == 'AB')?$ab:number_format($tot_per/3,2);
					}
					else{
						foreach ($marksData as $key4 => $value4) {

							$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetage1;
							$absent[$key4] = $value4['M2'];
						}
						
						rsort($mark);
						$mark[1] = isset($mark[1])?$mark[1]:0;
						$mark[0] = isset($mark[0])?$mark[0]:0;
						$two_sum = $mark[0] + $mark[1];
						$absent_count = count($absent);
						$total_ab_count = array_count_values($absent);
						$total_ab_count['AB'] = (!isset($total_ab_count['AB']))?0:$total_ab_count['AB'];
						$ab = ($absent_count == $total_ab_count['AB'])?'AB':'0';
						$final_marks[$key3] = ($ab == 'AB')?$ab:number_format($two_sum/2,2);
					}

					$mo=($round==1)?round($final_marks[$key3]):$final_marks[$key3];
				    //end check PT//
					}else{
						if(!empty($marksData)){
							$M2 = $marksData[0]['M2'];
							$M3 = $marksData[0]['M3'];
							$M1 = $marksData[0]['M1'];
							//$mo = ($M2 == 'AB' || $M2 == '-')?$M2:(($round==1)?round(number_format(($M3/$M1)*$wetage1,2)):number_format(($M3/$M1)*$wetage1,2));
							if($val2['opt_code'] == 1){
								$mo = ($M2 == 'AB' || $M2 == '-')?$M2:($M3/$M1)*$wetage1;
							}else{
								$mo = ($M2 == 'AB' || $M2 == '-')?$M2:(($round==1)?round(number_format(($M3/$M1)*$wetage1,2)):number_format(($M3/$M1)*$wetage1,2));
							}
						}else{
							$mo = 0;
						}
					}
                    $subj_mrks[$val][$subj_code]['sub'] = $val2['subj_nm'];
					
                    $subj_mrks[$val][$subj_code]['mrks'][$val3] =  $mo;
					
				   }
                
                   //t2//
				foreach($examcodeT2 as $key3 => $val3){

                   	$examC = ($val3==1)?"1,7,8":$val3;
					$wetageData = $this->alam->selectA('exammaster','wetage1',"ExamCode = '$val3'");
					$wetage1 = $wetageData[0]['wetage1'];
					
					$marksData = $this->alam->selectA('marks','*',"admno = '$val' AND Term = 'TERM-2' AND Classes = '$CLASS' AND ExamC IN ($examC) AND SCode = '$subj_code'");
					$mark   = array();
					$absent = array();
					if($val3 == 1){
					//check PT//
					if($pt_type == 1){
						foreach ($marksData as $key4 => $value4) {

							$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetage1;
							$absent[$key4] = $value4['M2'];
						}
						$absent_count = count($absent);
						$total_ab_count = array_count_values($absent);
						$total_ab_count['AB'] = (!isset($total_ab_count['AB']))?0:$total_ab_count['AB'];
						$ab = ($absent_count == $total_ab_count['AB'])?'AB':'0';
						$final_marks[$key3] = ($ab == 'AB')?$ab:number_format(max($mark),2);

					}
					elseif($pt_type == 2){						
						foreach ($marksData as $key4 => $value4) {

							$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetage1;
							$tot_per = $tot_per + $mark[$key4];
							$absent[$key4] = $value4['M2'];
						}
						$absent_count = count($absent);
						$total_ab_count = array_count_values($absent);
						$total_ab_count['AB'] = (!isset($total_ab_count['AB']))?0:$total_ab_count['AB'];
						$ab = ($absent_count == $total_ab_count['AB'])?'AB':'0';
						$final_marks[$key3] = ($ab == 'AB')?$ab:number_format($tot_per/3,2);
					}
					else{
						foreach ($marksData as $key4 => $value4) {

							$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetage1;
							$absent[$key4] = $value4['M2'];
						}
						
						rsort($mark);
						$mark[1] = isset($mark[1])?$mark[1]:0;
						$mark[0] = isset($mark[0])?$mark[0]:0;
						$two_sum = $mark[0] + $mark[1];
						$absent_count = count($absent);
						$total_ab_count = array_count_values($absent);
						$total_ab_count['AB'] = (!isset($total_ab_count['AB']))?0:$total_ab_count['AB'];
						$ab = ($absent_count == $total_ab_count['AB'])?'AB':'0';
						$final_marks[$key3] = ($ab == 'AB')?$ab:number_format($two_sum/2,2);
					}

					$mo=($round==1)?round($final_marks[$key3]):$final_marks[$key3];
				    //end check PT//
					}else{
						if(!empty($marksData)){
							$M2 = $marksData[0]['M2'];
							$M3 = $marksData[0]['M3'];
							$M1 = $marksData[0]['M1'];
							//$mo = ($M2 == 'AB' || $M2 == '-')?$M2:(($round==1)?round(number_format(($M3/$M1)*$wetage1,2)):number_format(($M3/$M1)*$wetage1,2));
							if($val2['opt_code'] == 1){
								$mo = ($M2 == 'AB' || $M2 == '-')?$M2:($M3/$M1)*$wetage1;
							}else{
								$mo = ($M2 == 'AB' || $M2 == '-')?$M2:(($round==1)?round(number_format(($M3/$M1)*$wetage1,2)):number_format(($M3/$M1)*$wetage1,2));
							}
						}else{
							$mo = 0;
						}
					}
                    $subj_mrks[$val][$subj_code]['sub'] = $val2['subj_nm'];
					
                    $subj_mrks[$val][$subj_code]['mrkss'][$val3] =  $mo;
					
				   }
                   //end t2//				   
				}
				
		    }
            
			foreach($subj_mrks as $key4 => $val4){
				foreach($subjectData as $key2 => $val2){
					if($val2['opt_code'] == 2){
						
						$check_student_subject = $this->sumit->checkData('*','studentsubject',array('Adm_no'=>$val,'Class'=>$class,'SUBCODE'=>$val2['subject_code']));
					}else{
						
						 $check_student_subject = true;
					}
					if($check_student_subject){
						?>
						 <tr>
						   <td style='background:#faf8e1 !important;'><?php echo $val4[$val2['subject_code']]['sub']; ?></td>
						   <?php
						     $tot_moo = 0;
							 foreach($val4[$val2['subject_code']]['mrks'] as $key5 => $val5){
								 ?>
								  <td><?php echo ($val2['opt_code'] != 1)?$val5:'';
								  $val5=($val5=='AB' || $val5=='-')?0:$val5; ?></td>
								 <?php
								 
								//$tot_moo += ($round==1)?round($val5):$val5;
								if($val2['opt_code'] == 1){
									$tot_moo += ($val5*100)/80;
								}else{
									$tot_moo += ($round==1)?round($val5):$val5;
								}
								
							 }
						   ?>
						   <td><?php echo $tot_moo; 
						   $grand_total[$val]['t1'] = isset($grand_total[$val]['t2'])?$grand_total[$val]['t1']:0;
						   $grand_total[$val]['t1'] += ($val2['opt_code'] != 1)?$tot_moo:0;
						   ?></td>
						   <?php
						        $fin_grade = 0;
								foreach($grademaster as $key => $grade){
									if($grade->ORange >=$tot_moo && $grade->CRange <=$tot_moo){
										$fin_grade = $grade->Grade;
										break;
									}
								}
						   ?>
						   <td><?php echo $fin_grade; ?></td>
						    <!-- end term-1 -->
						   
						   
						   <!-- term-2 -->
						   <?php
						     $tot_mo = 0;
							 foreach($val4[$val2['subject_code']]['mrkss'] as $key5 => $val5){
								 ?>
								  <td><?php echo ($val2['opt_code'] != 1)?$val5:'';
								  $val5=($val5=='AB' || $val5=='-')?0:$val5; ?></td>
								 <?php
								 
								//$tot_mo += ($round==1)?round($val5):$val5;
								if($val2['opt_code'] == 1){
									$tot_mo += ($val5*100)/80;
								}else{
									$tot_mo += ($round==1)?round($val5):$val5;
								}
								
							 }
						   ?>
						   <td><?php echo $tot_mo;
						   $grand_total[$val]['t2'] = isset($grand_total[$val]['t2'])?$grand_total[$val]['t2']:0;
						   $grand_total[$val]['t2'] += ($val2['opt_code'] != 1)?$tot_mo:0;
						   ?></td>
						   <?php
						        $fin_grade = 0;
								foreach($grademaster as $key => $grade){
									if($grade->ORange >=$tot_mo && $grade->CRange <=$tot_mo){
										$fin_grade = $grade->Grade;
										break;
									}
								}
						   ?>
						   <td><?php echo $fin_grade; ?></td>
						   <?php
						     $fin_tot_mo = ($tot_moo + $tot_mo)/2;
						   ?>
						   <td><?php echo ($round==1)?round($fin_tot_mo):$fin_tot_mo; ?></td>
						   <td>
						    <?php
						     $fin_grade = 0;
								foreach($grademaster as $key => $grade){
									if($grade->ORange >=$fin_tot_mo && $grade->CRange <=$fin_tot_mo){
										$fin_grade = $grade->Grade;
										break;
									}
								}
								echo $fin_grade;
						    ?>
						   </td>
						   <!-- end term-2 -->
						   
						   
						 </tr>
						<?php
					}
				}
			}
			?>
								
	  </tr>
	  <tr>
	    <td colspan='5' style='text-align:right'>Grand Total</td>
	    <td><?php echo $grand_total[$val]['t1']; ?></td>
	    <td></td>
	    <td colspan='4'></td>
	    <td><?php echo $grand_total[$val]['t2']; ?></td>
	    <td></td>
	    <td></td>
	    <td></td>
	  </tr>	
	  </tbody>
	</table>
	<div class='row'>
	<div class='col-sm-6 col-xs-6'>
	<table class='table' border='1'>
	  <tr>
	    <th style='color:#fff !important; background:#f51322 !important; font-weight:bold !important; text-align:left; font-size:13px;'>Co-Scholastic Areas:</th>
	    <th style='color:#fff !important; background:#f51322 !important; font-weight:bold !important; text-align:left; font-size:13px;'>Grade</th>
	  </tr>
	  <tr>
	    <td style='text-align:left; font-size:13px;'>Work Education (or Pre Vocational Education)</td>
		<td><?php echo $t2_skill_2; ?></td>
	  </tr>
	  <tr>
	    <td style='text-align:left; font-size:13px;'>Art Education</td>
		<td><?php echo $t2_skill_2; ?></td>
	  </tr>
	  <tr>
	    <td style='text-align:left; font-size:13px;'>Health & Physical Education</td>
		<td><?php echo $t2_skill_3; ?></td>
	  </tr>
	  <tr>
	    <td style='text-align:left; font-size:15px;'>Discipline</td>
	    <th style='text-align:left; font-size:15px;'></th>
	  </tr>
	</table>
	</div>
	<div class='col-sm-6 col-xs-6'>
	  <table class='table' border='1'>
	    <tr>
		  <th style='color:#fff !important; background:#f51322 !important; font-weight:bold !important; text-align:left; font-size:13px;'>Class Teacher's Remarks:</th>
	    </tr>
		<tr>
		  <td style='height:78px; font-size:13px; text-align:justify'>
		  <?php 
			if($t2_rmks !=''){
				echo $FIRST_NM.' '.$t2_rmks; 
			}
		  ?></td>
		</tr>
	  </table>
	</div>
	</div>
	</div>
	<!-- signature -->
	<div class='row sign'>
		<div class='col-sm-4 col-xs-4'><center><br /><b>SIGNATURE OF PARENT</b></center></div>
		<div class='col-sm-4 col-xs-4'><center><br /><b>SIGNATURE OF CLASS TEACHER</b></center></div>
		<!--<div class='col-sm-3 col-xs-3'><center><br /><b>SIGNATURE OF SECTION INCHARGE</b></center></div>-->
		<div class='col-sm-4 col-xs-4'>
			<!--<center><br /><img style='width:50px; position:absolute; bottom: 25px;'src='<?php //echo base_url($sign); ?>'></center>-->
			<center><br /><b>SIGNATURE OF PRINCIPAL</b></center>
		</div>
	</div>
	<!-- end signature -->
	</div><br />
	<footer class='page-break'>
	</footer>
	<?php } ?>
	</div>
  </body>
</html>
<style>
  table,tr,th,td{
	  text-align:center;
  }
</style>

<button type='submit' form='temp_sv' class='btn btn-success'><i class="fa fa-floppy-o"></i></button><br /><br />

<form id='temp_sv' action='<?php echo base_url('report_card/Report_card_temp_save/save_temp_tbl'); ?>' method='post'>
<div class='table-responsive'>
<table border='1' class='table'>
  <tr>
    <th style='background:#337ab7; color:#fff !important;'>Adm No</th>
    <th style='background:#337ab7; color:#fff !important;'>Stu Name</th>
    <th style='background:#337ab7; color:#fff !important;'>Roll No.</th>
    <th style='background:#337ab7; color:#fff !important;'>Exam Name</th>
    <!-- subject -->
	<?php
	  $subjectList = $this->alam->getClassWiseSubject(1,$class,$sec);
	  foreach($subjectList as $val){
		$pt_type = $val['pt_type'];  
		  ?>
		    <th style='background:#337ab7; color:#fff !important;'><?php echo $val['subj_nm']."<br /><span style='font-size:8px'>(MO|WT)</span>"; ?></th>
			<input type='hidden' name='subj_nm[]' value='<?php echo $val['subj_nm']; ?>'>
		  <?php
	  }
	?>
    <!-- end subject -->
    <th style='background:#337ab7; color:#fff !important;'>Max Marks</th>
    <th style='background:#337ab7; color:#fff !important;'>Total Marks</th>
    <th style='background:#337ab7; color:#fff !important;'>Total Percent</th>
    <th style='background:#337ab7; color:#fff !important;'>Grade</th>
    <th style='background:#337ab7; color:#fff !important;'>Attendance</th>
  </tr>
  <?php
    $stuData = $this->alam->selectA('student','ADM_NO,ROLL_NO,CLASS,SEC,(SELECT ExamMode FROM classes WHERE Class_No=student.CLASS)examode,DISP_CLASS,DISP_SEC,FIRST_NM,MIDDLE_NM,Height,Weight',"CLASS='$class' AND SEC='$sec' AND Student_Status='ACTIVE' order by ROLL_NO");
	foreach($stuData as $key => $val){
		$totalSubjWetage = array();
		$totalSubjWetagee = array();
		$admno      = $val['ADM_NO'];
		$disp_class = $val['DISP_CLASS'];
		$class = $val['CLASS'];
		$disp_sec   = $val['DISP_SEC'];
		$sec   = $val['SEC'];
		
		//for attendance //
	   $stu_att_type = $this->alam->select('student_attendance_type','*',"class_code='$class'");
	   $att_type     = $stu_att_type[0]->attendance_type;
	   
		if($att_type == 1){
		  $attPresentData = $this->alam->select('stu_attendance_entry','count(DISTINCT att_date)cnt',"class_code='$class' AND sec_code='$sec' AND att_date >= '$dt' AND att_status in('P','HD') AND admno='$admno'");
		  
		  $tot_present_day = $attPresentData[0]->cnt;
						  
		}else{
		  $attPresentData = $this->alam->select('stu_attendance_entry_periodwise','count(DISTINCT att_date)cnt',"class_code='$class' AND sec_code='$sec' AND att_date >= '$dt' AND att_status='P' AND admno='$admno'");
		  
		  $tot_present_day = $attPresentData[0]->cnt;		
		}
		//end attendance //
		$studentSubject = $this->alam->selectA('studentsubject','*',"Adm_no='$admno' AND Class='$class' AND sec = '$sec'");
	    $SUBCODE = isset($studentSubject[0]['SUBCODE'])?$studentSubject[0]['SUBCODE']:0;
  ?>
  <input type='hidden' name='attendance[]' value='<?php echo $tot_present_day."/".$tot_working_day; ?>'>
  <tr>
    <td><?php echo $val['ADM_NO']; ?><input type='hidden' name='adm_no[]' value='<?php echo $val['ADM_NO']; ?>'></td>
    <td><?php echo $val['FIRST_NM']; ?><input type='hidden' name='first_nm[]' value='<?php echo $val['FIRST_NM']; ?>'></td>
    <td colspan='16' style='text-align:left;'><?php echo $val['ROLL_NO']; ?><input type='hidden' name='roll_no[]' value='<?php echo $val['ROLL_NO']; ?>'></td>
	<input type='hidden' name='class[]' value='<?php echo $disp_class; ?>'>
	<input type='hidden' name='sec[]' value='<?php echo $disp_sec; ?>'>
	<input type='hidden' name='term' value='Annual'>
	<!-- exam list -->
	<?php
	  $examList = $this->alam->selectA('exammaster','*',"ExamCode
	  in('1','2','3','4','6')");
      $totalWetage = 0;
	  $totMxMrk = 0;
	  $totMarkObt = 0;
	  $totPercent = 0;
	  foreach($examList as $key2 => $val2){
		  $ExamCode = $val2['ExamCode'];
		  $wetage2  = $val2['wetage2'];
		  ?>
		  <tr>
		    <td colspan='4' style='text-align:right'><?php echo $val2['ExamName']?></td>
			<!--marks-->
			<?php
			  $totalMarks = 0;
			  
			  foreach($subjectList as $key3 => $val3){
				$subject_code = $val3['subject_code']; 
				$opt_code     = $val3['opt_code'];
				
				$marks = $this->alam->selectA('marks','*',"Term='TERM-1' AND classes = '$class' AND sec='$sec' AND admno='$admno' AND SCode = '$subject_code' AND ExamC ='$ExamCode'");
				
				$M1 = isset($marks[0]['M1']) ? $marks[0]['M1'] : 0;
				$M2 = isset($marks[0]['M2']) ? $marks[0]['M2'] : 0;
				$M3 = isset($marks[0]['M3']) ? $marks[0]['M3'] : 0;
				//check PT //
				if($pt_type == 1){
					if($ExamCode == 1){ //for PT
					  $pt_marks = $this->alam->selectA('marks','*',"Term='TERM-1' AND admno='$admno' AND SCode = '$subject_code' AND ExamC in ('1','7','8')");
					  $M3 = array();
					  $wetage_obt = array();
					  
					  foreach($pt_marks as $key4 => $val4){
                        $M3[]         = $val4['M3'];
                        $wetage_obt[] = $val4['M3']/$val4['M1']*$wetage2;
					  }					  
					  rsort($M3);
					  rsort($wetage_obt);
					  $mrk1 = isset($M3[0])?$M3[0]:0;
					  $WT1  = isset($wetage_obt[0])?$wetage_obt[0]:0;
					  
					  $MO         = ($round == 1) ? round (number_format (($mrk1),2)) : number_format (($mrk1),2);
					  $tot_wetage = ($round == 1) ? round (number_format (($WT1),2)) : number_format (($WT1),2);
					}else{
					  $MO         =($round == 1) ? round (number_format (isset($marks[0]['M3']) ? $marks[0]['M3']:0,2)) : number_format (isset($marks[0]['M3']) ? $marks[0]['M3']:0,2);	
					  
					  if($M3 > 0 && $M1 > 0){
					   $tot_wetage = ($round == 1) ? round (number_format(($M3/$M1)*$wetage2,2)) : number_format(($M3/$M1)*$wetage2,2);	 
					  }else{
						$tot_wetage = 0;  
					  }
					}
					
					if($opt_code != 2 || $SUBCODE == $subject_code){
						$maxMarks = $wetage2 * 5;
						$totalSubjWetage[$subject_code] = isset($totalSubjWetage[$subject_code]) ? $totalSubjWetage[$subject_code] : 0;
						$totalSubjWetage[$subject_code] += $tot_wetage;
					?>
					  <td><?php echo ($opt_code != 1) ? $MO .'|'. $tot_wetage : ''; ?></td>
			          <?php
					    $totalMarks += ($opt_code != 1) ? $tot_wetage : 0;
					  ?>
					<?php
					}else{
					?>
					  <td></td>
					<?php	
					}
					
				}else if($pt_type == 2){ 
					if($ExamCode == 1){ //for PT
					  $pt_marks = $this->alam->selectA('marks','*',"Term='TERM-1' AND admno='$admno' AND SCode = '$subject_code' AND ExamC in ('1','7','8')");
					  $M3 = array();
					  $wetage_obt = array();
					  foreach($pt_marks as $key4 => $val4){
                        $M3[]         = $val4['M3'];
                        $wetage_obt[] = $val4['M3']/$val4['M1']*$wetage2;
					  }					  
					  rsort($M3);
					  rsort($wetage_obt);
					  $mrk1 = isset($M3[0]) ? $M3[0] : 0;
					  $mrk2 = isset($M3[1]) ? $M3[1] : 0;
					  $mrk3 = isset($M3[2]) ? $M3[2] : 0;
					  $WT1  = isset($wetage_obt[0]) ? $wetage_obt[0] : 0;
					  $WT2  = isset($wetage_obt[1]) ? $wetage_obt[1] : 0;
					  $WT3  = isset($wetage_obt[2]) ? $wetage_obt[2] : 0;
					  
					  $MO          = ($round == 1) ? round (number_format (($mrk1+$mrk2+$mrk3)/3,2)) : number_format (($mrk1+$mrk2+$mrk3)/3,2);
					  $tot_wetage  = ($round == 1) ? round (number_format (($WT1+$WT2+$WT3)/3,2)) : number_format (($WT1+$WT2+$WT3)/3,2);
					}else{
					  $MO          = ($round == 1) ? round (number_format (isset($marks[0]['M3']) ? $marks[0]['M3'] : 0,2)) : number_format (isset($marks[0]['M3']) ? $marks[0]['M3'] : 0,2);	
					  if($M3 > 0 && $M1 > 0){
					   $tot_wetage = ($round == 1) ? round (number_format(($M3/$M1)*$wetage2,2)) : number_format(($M3/$M1)*$wetage2,2);	 
					  }else{
						$tot_wetage = 0;  
					  }	 
					}
					
					if($opt_code != 2 || $SUBCODE == $subject_code){
						$maxMarks = $wetage2 * 5;
						$totalSubjWetage[$subject_code] = isset($totalSubjWetage[$subject_code]) ? $totalSubjWetage[$subject_code] : 0;
						$totalSubjWetage[$subject_code] += $tot_wetage;
					?>
					  <td><?php echo ($opt_code != 1) ? $MO .'|'. $tot_wetage : ''; ?></td>
			          <?php
					    $totalMarks += ($opt_code != 1) ? $tot_wetage : 0;
					  ?>
					<?php
					}else{
					?>
					  <td></td>
					<?php	
					}
					
				}else{
					if($ExamCode == 1){ //for PT
					  $pt_marks = $this->alam->selectA('marks','*',"Term='TERM-1' AND admno='$admno' AND SCode = '$subject_code' AND ExamC in ('1','7','8')");
					  $M3 = array();
					  $wetage_obt = array();
					  foreach($pt_marks as $key4 => $val4){
                        $M3[]         = $val4['M3'];
                        $wetage_obt[] = $val4['M3']/$val4['M1']*$wetage2;
					  }					  
					  rsort($M3);
					  rsort($wetage_obt);
					  $mrk1 = isset($M3[0]) ? $M3[0] : 0;
					  $mrk2 = isset($M3[1]) ? $M3[1] : 0;
					  $WT1  = isset($wetage_obt[0]) ? $wetage_obt[0] : 0;
					  $WT2  = isset($wetage_obt[1]) ? $wetage_obt[1] : 0;
					  
					  $MO         = ($round == 1) ? round (number_format (($mrk1+$mrk2)/2,2)) : number_format (($mrk1+$mrk2)/2,2);
					  $tot_wetage = ($round == 1) ? round (number_format (($WT1+$WT2)/2,2)) : number_format (($WT1+$WT2)/2,2);
					}else{
					  $MO         = ($round == 1) ? round (number_format (isset($marks[0]['M3']) ? $marks[0]['M3'] : 0,2)) : number_format (isset($marks[0]['M3']) ? $marks[0]['M3'] : 0,2);	
					  if($M3 > 0 && $M1 > 0){
					   $tot_wetage = ($round == 1) ? round (number_format(($M3/$M1)*$wetage2,2)) : number_format(($M3/$M1)*$wetage2,2);	 
					  }else{
						$tot_wetage = 0;  
					  }
					}
			
					if($opt_code != 2 || $SUBCODE == $subject_code){
						$maxMarks = $wetage2 * 5;
						$totalSubjWetage[$subject_code] = isset($totalSubjWetage[$subject_code]) ? $totalSubjWetage[$subject_code] : 0;
						$totalSubjWetage[$subject_code] += $tot_wetage;
					?>
					  <td><?php echo ($opt_code != 1) ? $MO .'|'. $tot_wetage : ''; ?></td>
			          <?php
					    $totalMarks += ($opt_code != 1) ? $tot_wetage : 0;
					  ?>
					<?php
					}else{
					?>
					  <td></td>
					<?php	
					}
				}
				
				// end check PT //
			  }
			?>
			<!--end marks-->
			<td> 
			  <?php 
			   echo $maxMarks;
               $totMxMrk += $maxMarks;		   
			  ?>
			</td>
			<td>
			 <?php 
			   echo $totalMarks;
               $totMarkObt += $totalMarks;			   
			 ?>
			</td>
			<td>
			  <?php 
			    $totPercent = ($totalMarks * 100) / $maxMarks;
			    echo $totPercent; 
			  ?>
			  <!-- grade -->
			  <?php
			    $grade = $this->alam->selectA('grademaster','CRange,ORange,Grade,Qualitative_Norms');
				foreach($grade as $key => $val){
					if($val['ORange'] >=$totPercent && $val['CRange'] <=$totPercent){
					$val['Grade'];
					break;
					}
			    }
			  ?>
			  <!-- end grade -->
			</td>
			<td><?php echo $val['Grade']; ?></td>
			<td></td>
		  </tr>		  
		  <?php
	  }
	?>
	<tr>
	  <td colspan='4' style='text-align:right'>Total</td>
	  <?php
	    foreach($subjectList as $key5 => $val5){
		  ?>
		    <td>
			 <?php 
			 if($val5['opt_code'] != 1){
			  echo isset($totalSubjWetage[$val5['subject_code']]) ? $totalSubjWetage[$val5['subject_code']] : 0;
			 }			  
			 ?>
			</td>
		  <?php
	    }
	  ?>
	  <td><?php echo $totMxMrk; ?></td>
	  <td>
	    <?php 
		  echo $totMarkObt; 
		  $totPercent = ($round == 1) ? round (number_format (($totMarkObt * 100)/$totMxMrk,2)) : number_format (($totMarkObt * 100)/$totMxMrk,2);
		?>
	  </td>
	  <td>
	    <?php 
		  echo $totPercent; 
		  foreach($grade as $key => $val){
			if($val['ORange'] >=$totPercent && $val['CRange'] <=$totPercent){
			$val['Grade'];
			break;
			}
		  }
		?>
	  </td>
	  <td><?php echo $val['Grade']; ?></td>
	  <td></td>
	</tr>
	<tr>
	  <td colspan='4' style='text-align:right'>Grade</td>
	  <?php
	    foreach($subjectList as $key6 => $val6){ 
		  ?>
		    <td>
			  <?php 
			  $totm = isset($totalSubjWetage[$val6['subject_code']]) ? $totalSubjWetage[$val6['subject_code']] : 0; 
			  $totm;
			  
			  foreach($grade as $key => $val){
				if($val['ORange'] >=$totm && $val['CRange'] <=$totm){
				echo $val['Grade'];
				break;
				}
			  }
			  ?>
			</td>
		  <?php
	    }
	  ?>
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	</tr>
	<!-- end exam list -->
	<tr>
	  <td colspan='18' style='height:20px;'></td>
	</tr>
	<!-- exam list -->
	<?php
	  $examList = $this->alam->selectA('exammaster','*',"ExamCode
	  in('1','2','3','5','6')");
      $totalWetage = 0;
	  $totMxMrkk = 0;
	  $totMarkObtt = 0;
	  $totPercentt = 0;
	  foreach($examList as $key2 => $val2){
		  $ExamCode = $val2['ExamCode'];
		  $wetage2  = $val2['wetage2'];
		  ?>
		  <tr>
		    <td colspan='4' style='text-align:right'><?php echo $val2['ExamName']?></td>
			<!--marks-->
			<?php
			  $totalMarkss = 0;
			  
			  foreach($subjectList as $key3 => $val3){
				$subject_code = $val3['subject_code']; 
				$opt_code     = $val3['opt_code'];
				
				$marks = $this->alam->selectA('marks','*',"Term='TERM-2' AND classes = '$class' AND sec='$sec' AND admno='$admno' AND SCode = '$subject_code' AND ExamC ='$ExamCode'");
				
				$M1 = isset($marks[0]['M1']) ? $marks[0]['M1'] : 0;
				$M2 = isset($marks[0]['M2']) ? $marks[0]['M2'] : 0;
				$M3 = isset($marks[0]['M3']) ? $marks[0]['M3'] : 0;
				//check PT //
				if($pt_type == 1){
					if($ExamCode == 1){ //for PT
					  $pt_marks = $this->alam->selectA('marks','*',"Term='TERM-2' AND admno='$admno' AND SCode = '$subject_code' AND ExamC in ('1','7','8')");
					  $M3 = array();
					  $wetage_obt = array();
					  
					  foreach($pt_marks as $key4 => $val4){
                        $M3[]         = $val4['M3'];
                        $wetage_obt[] = $val4['M3']/$val4['M1']*$wetage2;
					  }					  
					  rsort($M3);
					  rsort($wetage_obt);
					  $mrk1 = isset($M3[0])?$M3[0]:0;
					  $WT1  = isset($wetage_obt[0])?$wetage_obt[0]:0;
					  
					  $MO         = ($round == 1) ? round (number_format ($mrk1,2)) : number_format ($mrk1,2);
					  $tot_wetage = ($round == 1) ? round (number_format ($WT1,2)) : number_format ($WT1,2);
					}else{
					  $MO         = ($round == 1) ? round (number_format (isset($marks[0]['M3']) ? $marks[0]['M3']:0,2)) : number_format (isset($marks[0]['M3']) ? $marks[0]['M3']:0,2);	
					  
					  if($M3 > 0 && $M1 > 0){
					   $tot_wetage = ($round == 1) ? round (number_format(($M3/$M1)*$wetage2,2)) : number_format(($M3/$M1)*$wetage2,2);	 
					  }else{
						$tot_wetage = 0;  
					  }
					}
					
					if($opt_code != 2 || $SUBCODE == $subject_code){
						$maxMarks = $wetage2 * 5;
						$totalSubjWetagee[$subject_code] = isset($totalSubjWetagee[$subject_code]) ? $totalSubjWetagee[$subject_code] : 0;
						
						$totalSubjWetagee[$subject_code] += $tot_wetage;
					?>
					  <td><?php echo ($opt_code != 1) ? $MO .'|'. $tot_wetage : ''; ?></td>
			          <?php
					    $totalMarkss += ($opt_code != 1) ? $tot_wetage : 0;
					  ?>
					<?php
					}else{
					?>
					  <td></td>
					<?php	
					}
					
				}else if($pt_type == 2){ 
					if($ExamCode == 1){ //for PT
					  $pt_marks = $this->alam->selectA('marks','*',"Term='TERM-2' AND admno='$admno' AND SCode = '$subject_code' AND ExamC in ('1','7','8')");
					  $M3 = array();
					  $wetage_obt = array();
					  foreach($pt_marks as $key4 => $val4){
                        $M3[]         = $val4['M3'];
                        $wetage_obt[] = $val4['M3']/$val4['M1']*$wetage2;
					  }					  
					  rsort($M3);
					  rsort($wetage_obt);
					  $mrk1 = isset($M3[0]) ? $M3[0] : 0;
					  $mrk2 = isset($M3[1]) ? $M3[1] : 0;
					  $mrk3 = isset($M3[2]) ? $M3[2] : 0;
					  $WT1  = isset($wetage_obt[0]) ? $wetage_obt[0] : 0;
					  $WT2  = isset($wetage_obt[1]) ? $wetage_obt[1] : 0;
					  $WT3  = isset($wetage_obt[2]) ? $wetage_obt[2] : 0;
					  
					  $MO          = ($round == 1) ? round (number_format (($mrk1+$mrk2+$mrk3)/3,2)) : number_format (($mrk1+$mrk2+$mrk3)/3,2);
					  $tot_wetage  = ($round == 1) ? round (number_format (($WT1+$WT2+$WT3)/3,2)) : number_format (($WT1+$WT2+$WT3)/3,2);
					}else{
					  $MO          = ($round == 1) ? round (number_format (isset($marks[0]['M3']) ? $marks[0]['M3'] : 0,2)) : number_format (isset($marks[0]['M3']) ? $marks[0]['M3'] : 0,2);	
					  if($M3 > 0 && $M1 > 0){
					   $tot_wetage = ($round == 1) ? round (number_format(($M3/$M1)*$wetage2,2)) : number_format(($M3/$M1)*$wetage2,2);	 
					  }else{
						$tot_wetage = 0;  
					  }	 
					}
					
					if($opt_code != 2 || $SUBCODE == $subject_code){
						$maxMarks = $wetage2 * 5;
						$totalSubjWetagee[$subject_code] = isset($totalSubjWetagee[$subject_code]) ? $totalSubjWetagee[$subject_code] : 0;
						
						$totalSubjWetagee[$subject_code] += $tot_wetage;
					?>
					  <td><?php echo ($opt_code != 1) ? $MO .'|'. $tot_wetage : ''; ?></td>
			          <?php
					    $totalMarkss += ($opt_code != 1) ? $tot_wetage : 0;
					  ?>
					<?php
					}else{
					?>
					  <td></td>
					<?php	
					}
					
				}else{
					if($ExamCode == 1){ //for PT
					  $pt_marks = $this->alam->selectA('marks','*',"Term='TERM-2' AND admno='$admno' AND SCode = '$subject_code' AND ExamC in ('1','7','8')");
					  $M3 = array();
					  $wetage_obt = array();
					  foreach($pt_marks as $key4 => $val4){
                        $M3[]         = $val4['M3'];
                        $wetage_obt[] = $val4['M3']/$val4['M1']*$wetage2;
					  }					  
					  rsort($M3);
					  rsort($wetage_obt);
					  $mrk1 = isset($M3[0]) ? $M3[0] : 0;
					  $mrk2 = isset($M3[1]) ? $M3[1] : 0;
					  $WT1  = isset($wetage_obt[0]) ? $wetage_obt[0] : 0;
					  $WT2  = isset($wetage_obt[1]) ? $wetage_obt[1] : 0;
					  
					  $MO         = ($round == 1) ? round (number_format (($mrk1+$mrk2)/2,2)) : number_format (($mrk1+$mrk2)/2,2);
					  $tot_wetage = ($round == 1) ? round (number_format (($WT1+$WT2)/2,2)) : number_format (($WT1+$WT2)/2,2);
					}else{
					  $MO         = ($round == 1) ? round (number_format (isset($marks[0]['M3']) ? $marks[0]['M3'] : 0,2)) : number_format (isset($marks[0]['M3']) ? $marks[0]['M3'] : 0,2);	
					  if($M3 > 0 && $M1 > 0){
					   $tot_wetage = ($round == 1) ? round (number_format(($M3/$M1)*$wetage2,2)) : number_format(($M3/$M1)*$wetage2,2);	 
					  }else{
						$tot_wetage = 0;  
					  }
					}
			
					if($opt_code != 2 || $SUBCODE == $subject_code){
						$maxMarks = $wetage2 * 5;
						$totalSubjWetagee[$subject_code] = isset($totalSubjWetagee[$subject_code]) ? $totalSubjWetagee[$subject_code] : 0;
						
						$totalSubjWetagee[$subject_code] += $tot_wetage;
					?>
					  <td><?php echo ($opt_code != 1) ? $MO .'|'. $tot_wetage : ''; ?></td>
			          <?php
					    $totalMarkss += ($opt_code != 1) ? $tot_wetage : 0;
					  ?>
					<?php
					}else{
					?>
					  <td></td>
					<?php	
					}
				}
				// end check PT //
			  }
			?>
			<!--end marks-->
			<td> 
			  <?php 
			   echo $maxMarks;
               $totMxMrkk += $maxMarks;		   
			  ?>
			</td>
			<td>
			 <?php 
			   echo $totalMarkss;
               $totMarkObtt += $totalMarkss;			   
			 ?>
			</td>
			<td>
			  <?php 
			    $totPercentt = ($totalMarkss * 100) / $maxMarks;
			    echo $totPercentt; 
			  ?>
			  <!-- grade -->
			  <?php
			    $grade = $this->alam->selectA('grademaster','CRange,ORange,Grade,Qualitative_Norms');
				foreach($grade as $key => $val){
					if($val['ORange'] >=$totPercentt && $val['CRange'] <=$totPercentt){
					$val['Grade'];
					break;
					}
			    }
			  ?>
			  <!-- end grade -->
			</td>
			<td><?php echo $val['Grade']; ?></td>
			<td></td>
		  </tr>		  
		  <?php
	  }
	?>
	<tr>
	  <td colspan='4' style='text-align:right'>Total</td>
	  <?php
	    foreach($subjectList as $key5 => $val5){
		  ?>
		    <td>
			  <?php 
			    if($val5['opt_code'] != 1){
			     echo isset($totalSubjWetagee[$val5['subject_code']]) ? $totalSubjWetagee[$val5['subject_code']] : 0; 
				}
			  ?>
			</td>
		  <?php
	    }
	  ?>
	  <td><?php echo $totMxMrkk; ?></td>
	  <td>
	    <?php 
		  echo $totMarkObtt; 
		  $totPercentt = ($round == 1) ? round (number_format (($totMarkObtt * 100)/$totMxMrkk,2)) : number_format (($totMarkObtt * 100)/$totMxMrkk,2);
		?>
	  </td>
	  <td>
	    <?php 
		  echo $totPercentt; 
		  foreach($grade as $key => $val){
			if($val['ORange'] >=$totPercentt && $val['CRange'] <=$totPercentt){
			$val['Grade'];
			break;
			}
		  }
		?>
	  </td>
	  <td><?php echo $val['Grade']; ?></td>
	  <td></td>
	</tr>
	<tr>
	  <td colspan='4' style='text-align:right'>Grade</td>
	  <?php
	    foreach($subjectList as $key6 => $val6){ 
		  ?>
		    <td>
			  <?php 
			  $totm = isset($totalSubjWetagee[$val6['subject_code']]) ? $totalSubjWetagee[$val6['subject_code']] : 0; 
			  $totm;
			  
			  foreach($grade as $key => $val){
				if($val['ORange'] >=$totm && $val['CRange'] <=$totm){
				echo $val['Grade'];
				break;
				}
			  }
			  ?>
			</td>
		  <?php
	    }
	  ?>
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	</tr>
	<tr>
	  <th colspan='4' style='text-align:right; background:#000; color:#fff!important;'>Total (Term-I + Term-II)</th>
	  <?php
	    foreach($subjectList as $key7 => $val7){
		  ?>
		    <td style='background:#000; color:#fff!important;'>
			  <?php
			  if($val7['opt_code'] != 1){
			  $term1 = isset($totalSubjWetage[$val7['subject_code']]) ? $totalSubjWetage[$val7['subject_code']] : 0;
			  
			  $term2 = isset($totalSubjWetagee[$val7['subject_code']]) ? $totalSubjWetagee[$val7['subject_code']] : 0;
			  $termTotWet = ($round == 1) ? round (number_format (($term1 + $term2) / 2,2)) : number_format (($term1 + $term2) / 2,2);
              echo 	$termTotWet;
			  }
			  
			  ?>
			</td>
		  <?php
	    }
	  ?>
	  <td style='background:#000; color:#fff!important;'><?php echo ($totMxMrk + $totMxMrkk)/2; ?></td>
	  <td style='background:#000; color:#fff!important;'>
	    <?php 
		  $totTermMrkObt = ($round == 1) ? round (number_format (($totMarkObt + $totMarkObtt)/2,2)) : number_format (($totMarkObt + $totMarkObtt)/2,2);
		  echo $totTermMrkObt; 
		?>
		<input type='hidden' name='tot_wet_mrk[]' value='<?php echo $totTermMrkObt; ?>'>
	  </td>
	  <td style='background:#000; color:#fff!important;'>
	   <?php 
	     $tremTotPercent = ($round == 1) ? round (number_format (($totPercent + $totPercentt)/2 ,2)) : number_format (($totPercent + $totPercentt)/2 ,2);
	     echo $tremTotPercent;		 
	   ?>
	   <input type='hidden' name='tot_per[]' value='<?php echo $tremTotPercent; ?>'>
	  </td>
	  <td style='background:#000; color:#fff!important;'>
	  <?php
	    foreach($grade as $key => $val){
		 if($val['ORange'] >=$tremTotPercent && $val['CRange'] <=$tremTotPercent){
		 echo $val['Grade'];
		 break;
		 }
		}
	  ?>
	  <input type='hidden' name='tot_grd[]' value='<?php echo $val['Grade']; ?>'>
	  </td>
	  <td style='background:#000; color:#fff!important;'></td>
	</tr>
	
	<tr>
	  <th colspan='4' style='text-align:right; background:#000; color:#fff!important;'>Grade (Term-I + Term-II)</th>
	  <?php
	    foreach($subjectList as $key7 => $val7){
		  ?>
		    <td style='background:#000; color:#fff!important;'>
			  <?php
			  if($val7['opt_code'] != 1){
			   $term1 = isset($totalSubjWetage[$val7['subject_code']]) ? $totalSubjWetage[$val7['subject_code']] : 0;
			  
			   $term2 = isset($totalSubjWetagee[$val7['subject_code']]) ? $totalSubjWetagee[$val7['subject_code']] : 0;
			   $termTotWet = ($round == 1) ? round (number_format (($term1 + $term2) / 2,2)) : number_format (($term1 + $term2) / 2,2);
			  }
			  foreach($grade as $key => $val){
				 if($val['ORange'] >=$termTotWet && $val['CRange'] <=$termTotWet){
				 echo $val['Grade'];
				 break;
				 }
			  }
			  
			  ?>
			  <input type='hidden' name='tot_mo[<?php echo $admno; ?>][]' value='<?php echo $termTotWet; ?>'>
			   <input type='hidden' name='grd[<?php echo $admno; ?>][]' value='<?php echo $val['Grade']; ?>'>
			</td>
		  <?php
	    }
	  ?>
	  <td style='background:#000; color:#fff!important;'><?php  ($totMxMrk + $totMxMrkk)/2; ?></td>
	  <td style='background:#000; color:#fff!important;'>
	    <?php 
		  $totTermMrkObt = ($round == 1) ? round (number_format (($totMarkObt + $totMarkObtt)/2,2)) : number_format (($totMarkObt + $totMarkObtt)/2,2);
		  $totTermMrkObt; 
		?>
		<input type='hidden' name='tot_wet_mrk[]' value='<?php echo $totTermMrkObt; ?>'>
	  </td>
	  <td style='background:#000; color:#fff!important;'>
	   <?php 
	     $tremTotPercent = ($round == 1) ? round (number_format (($totPercent + $totPercentt)/2,2)) : number_format (($totPercent + $totPercentt)/2,2);
	     $tremTotPercent;		 
	   ?>
	   <input type='hidden' name='tot_per[]' value='<?php echo $tremTotPercent; ?>'>
	  </td>
	  <td style='background:#000; color:#fff!important;'>
	  <?php
	    foreach($grade as $key => $val){
		 if($val['ORange'] >=$tremTotPercent && $val['CRange'] <=$tremTotPercent){
		 $val['Grade'];
		 break;
		 }
		}
	  ?>
	  <input type='hidden' name='tot_grd[]' value='<?php echo $val['Grade']; ?>'>
	  </td>
	  <td style='background:#000; color:#fff!important;'><?php echo $tot_present_day .'/'. $tot_working_day; ?></td>
	</tr>
	<!-- end exam list -->
  </tr>
 <?php } ?>
</table>
</div>
</form>
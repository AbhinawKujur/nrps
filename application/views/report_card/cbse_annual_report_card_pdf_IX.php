<html>
  <title>Report Card</title>
  <head>
    <link rel="stylesheet" href="<?php echo base_url('assets/dash_css/bootstrap.min.css'); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	
	<style> 
	  .table > thead > tr > th,
	  .table > tbody > tr > th,
	  .table > tfoot > tr > th,
	  .table > thead > tr > td,
	  .table > tbody > tr > td,
	  .table > tfoot > tr > td {
			font-size:10px;
			padding:1px !important;
			text-align:center;
	   }
	   @media print {
		   padding-top:0px;
	   }
	   .page-break{
			page-break-before:always;
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
			  echo "<h3>".$school_setting[0]->School_Name."</h3>";
			  echo $school_setting[0]->School_Address ."<br/>";
			  echo "<b>ACADEMIC SESSION:</b> ".$school_setting[0]->School_Session ."<br />";
			  echo "<b>Affiliation No. - </b>".$school_setting[0]->School_AfftNo .",<b> School Code - </b>".$school_setting[0]->School_Code;
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
		  <td style='text-align:left; font-size:15px;'><?php echo $BIRTH_DT; ?></td>
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
	    <td colspan='2'>Subject Name</td>
		<td colspan='2'>Periodic 1</td>
		<td colspan='2'>Periodic 2</td>
		<td colspan='2'>Periodic 3</td>
		<td>Avg. of Best 2 of (A,B & C)</td>
		<td>Note Book</td>
		<td>Subject Enrichment</td>
		<td>Annual Exam</td>
		<td>Subject Grand Total</td>
		<td>Grade</td>
	  </tr>
	  <tr>
		<td colspan='2'></td>
		<td>20</td>
		<td>10 [A]</td>
		<td>80</td>
		<td>10 [B]</td>
		<td>20</td>
		<td>10 [C]</td>
		<td>10 [D]</td>
		<td>5 [E]</td>
		<td>5 [F]</td>
		<td>80 [G]</td>
		<td>100 (D+E+F+G)</td>
		<td></td>
	  </tr>
	  </thead>
	  <tbody>
	  <tr>
	    <!-- term-1 -->
		<?php
			$bestOfTwo = array();
		    foreach($subjectData as $key2 => $val2){
				$pt1wtgm1res = 0;
				$pt1wtgm1 = 0;
				$pt1m2 = 0;
				$pt2wtgm1res = 0;
				$pt2wtgm1 = 0;
				$pt2m2 = 0;
				$pt3wtgm1res = 0;
				$pt3wtgm1 = 0;
				$pt3m2 = 0;
				$addTwo = 0;
				$nbwtgm1res = 0;
				$nbwtgm1 = 0;
				$nbm2 = 0;
				$sewtgm1res = 0;
				$sewtgm1 = 0;
				$sem2 = 0;
				$stwtgm1res = 0;
				$stwtgm1 = 0;
				$stm2 = 0;
				$subjGandTot = 0;
				
				if($val2['opt_code'] == 2){
					$check_student_subject = $this->sumit->checkData('*','studentsubject',array('Adm_no'=>$val,'Class'=>$class,'SUBCODE'=>$val2['subject_code']));
				}else{
					 $check_student_subject = true;
				}
				
				//pt1
				$pt1 = $this->alam->selectA('marks','M1,M2,M3',"Term='TERM-1' AND ExamC='1' AND SCode='".$val2['subject_code']."' AND admno='$val'");
				
				if(!empty($pt1)){
					$pt1m1 = $pt1[0]['M1'];
					$pt1m2 = $pt1[0]['M2'];
					$pt1m3 = $pt1[0]['M3'];
					$pt1wtgm1res = ($pt1m3*100)/$pt1m1;
					$pt1wtgm1 = ($round==1)?round(($pt1wtgm1res*10)/100):number_format(($pt1wtgm1res*10)/100,2);
				}
				
				//pt2
				$pt2 = $this->alam->selectA('marks','M1,M2,M3',"Term='TERM-1' AND ExamC='4' AND SCode='".$val2['subject_code']."' AND admno='$val'");
				
				if(!empty($pt1)){
					$pt2m1 = isset($pt2[0]['M1'])?$pt2[0]['M1']:0;
					$pt2m2 = isset($pt2[0]['M2'])?$pt2[0]['M2']:0;
					$pt2m3 = isset($pt2[0]['M3'])?$pt2[0]['M3']:0;
					$pt2wtgm1res = ($pt2m3*100)/$pt2m1;
					$pt2wtgm1 = ($round==1)?round(($pt2wtgm1res*10)/100):number_format(($pt2wtgm1res*10)/100,2);
				}
				
				//pt3
				$pt3 = $this->alam->selectA('marks','M1,M2,M3',"Term='TERM-2' AND ExamC='8' AND SCode='".$val2['subject_code']."' AND admno='$val'");
				
				if(!empty($pt1)){
					$pt3m1 = isset($pt3[0]['M1'])?$pt3[0]['M1']:0;
					$pt3m2 = isset($pt3[0]['M2'])?$pt3[0]['M2']:0;
					$pt3m3 = isset($pt3[0]['M3'])?$pt3[0]['M3']:0;
					$pt3wtgm1res = ($pt3m3*100)/$pt3m1;
					$pt3wtgm1 = ($round==1)?round(($pt3wtgm1res*10)/100):number_format(($pt3wtgm1res*10)/100,2);
				}
					
				//avg of best of 2
				$mark = array($pt1wtgm1,$pt2wtgm1,$pt3wtgm1);
				rsort($mark);

				$mark[1] = isset($mark[1])?$mark[1]:0;
				$mark[0] = isset($mark[0])?$mark[0]:0;
				$addTwo = ($mark[1] + $mark[0])/2;
				
				//NB
				$nb = $this->alam->selectA('marks','M1,M2,M3',"Term='TERM-2' AND ExamC='2' AND SCode='".$val2['subject_code']."' AND admno='$val'");
				
				if(!empty($nb)){
					$nbm1 = isset($nb[0]['M1'])?$nb[0]['M1']:0;
					$nbm2 = isset($nb[0]['M2'])?$nb[0]['M2']:0;
					$nbm3 = isset($nb[0]['M3'])?$nb[0]['M3']:0;
					$nbwtgm1res = ($nbm3*100)/$nbm1;
					$nbwtgm1 = ($round==1)?round(($nbwtgm1res*5)/100):number_format(($nbwtgm1res*5)/100,2);
				}
				
				
				//SE
				$se = $this->alam->selectA('marks','M1,M2,M3',"Term='TERM-2' AND ExamC='3' AND SCode='".$val2['subject_code']."' AND admno='$val'");
				
				if(!empty($se)){
					$sem1 = isset($se[0]['M1'])?$se[0]['M1']:0;
					$sem2 = isset($se[0]['M2'])?$se[0]['M2']:0;
					$sem3 = isset($se[0]['M3'])?$se[0]['M3']:0;
					$sewtgm1res = ($sem3*100)/$sem1;
					$sewtgm1 = ($round == 1)?round(($sewtgm1res*5)/100):number_format(($sewtgm1res*5)/100,2);
				}
				
				
				//second term
				$st = $this->alam->selectA('marks','M1,M2,M3',"Term='TERM-2' AND ExamC='5' AND SCode='".$val2['subject_code']."' AND admno='$val'");
				
				if(!empty($st)){
					$stm1 = isset($st[0]['M1'])?$st[0]['M1']:0;
					$stm2 = isset($st[0]['M2'])?$st[0]['M2']:0;
					$stm3 = isset($st[0]['M3'])?$st[0]['M3']:0;
					$stwtgm1res = ($stm3*100)/$stm1;
					$stwtgm1 = ($round==1)?round(($stwtgm1res*80)/100):number_format(($stwtgm1res*80)/100,2);
				}
				
				$subjGandTot = $addTwo+$nbwtgm1+$sewtgm1+$stwtgm1;
			
				$fin_grade = 0;
				foreach($grademaster as $key => $grade){
					if($grade->ORange >=$subjGandTot && $grade->CRange <=$subjGandTot){
						$fin_grade = $grade->Grade;
						break;
					}
				}
				
				if($check_student_subject){
					?>
					<tr>
						<td colspan='2' style='text-align:left'><?php echo $val2['subj_nm']; ?></td>
						<td>
							<span>
								<?php 
								if($val2['opt_code'] != 1){
									echo ($round==1)?round($pt1m3):number_format($pt1m3,2);	
								}
								?>
							</span>
						</td>
						
						<td>
							<span>
								<?php 
								if($val2['opt_code'] != 1){
									echo $pt1wtgm1; 
								}
								?>
							</span>
						</td>
						
						<td>
							<span>
								<?php 
								if($val2['opt_code'] != 1){
									echo ($round==1)?round($pt2m3):number_format($pt2m3,2);
								}
								?>
							</span>
						</td>
						
						<td>
							<span>
								<?php 
								if($val2['opt_code'] != 1){
									echo $pt2wtgm1; 
								}
								?>
							</span>	
						</td>
						
						<td>
							<span>
								<?php 
								if($val2['opt_code'] != 1){	
									echo ($round==1)?round($pt3m3):number_format($pt3m3,2); 
								}
								?>
							</span>
						</td>
						
						<td>
							<span>
								<?php 
								if($val2['opt_code'] != 1){
									echo $pt3wtgm1; 
								}
								?>
							</span>
						</td>
						
						<td>
							<span>
								<?php 
								if($val2['opt_code'] != 1){
									echo ($round==1)?round($addTwo):number_format($addTwo,2); 
								}
								?>
							</span>
						</td>
						
						<td>
							<span>
								<?php 
								if($val2['opt_code'] != 1){
									echo ($nbm2 != 'AB')?$nbwtgm1:'AB'; 
								}
								?>
							</span>	
						</td>
						
						<td>
							<span>
								<?php 
								if($val2['opt_code'] != 1){
									echo ($sem2 != 'AB')?$sewtgm1:'AB'; 
								}
								?>
							</span>
						</td>
						
						<td>
							<span>
								<?php echo ($stm2 != 'AB')?$stwtgm1:'AB'; ?>
							</span>
						</td>
						
						<td>
							<span>
								<?php echo ($round==1)?round($subjGandTot):number_format($subjGandTot,2); ?>
							</span>
						</td>
						
						<td>
							<span>
								<?php echo $fin_grade; ?>
							</span>
						</td>
					</tr>	
					<?php
				}
				
		    }
		?>					
	  </tr>
	  </tbody>
	</table>
	<div class='row'>
	<div class='col-sm-6 col-xs-6'>
	<table class='table' border='1'>
	  <tr>
	    <th style='text-align:left; font-size:15px;'>Co-Scholastic Areas:</th>
	    <th style='font-size:15px;'>Grade</th>
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
		  <th style='text-align:left; font-size:15px;'>Class Teacher's Remarks:</th>
	    </tr>
		<tr>
		  <td style='height:86px; font-size:13px; text-align:justify'>
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
		<div class='col-sm-3 col-xs-3'><center><br /><b>SIGNATURE OF PARENT</b></center></div>
		<div class='col-sm-3 col-xs-3'><center><br /><b>SIGNATURE OF CLASS TEACHER</b></center></div>
		<div class='col-sm-3 col-xs-3'><center><br /><b>SIGNATURE OF SECTION  INCHARGE</b></center></div>
		<div class='col-sm-3 col-xs-3'>
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
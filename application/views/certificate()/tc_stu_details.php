<?php
	error_reporting(0);
	if($student){
		$ADM_NO = $student->ADM_NO;
		$BIRTH_DT = $student->BIRTH_DT;
		$FIRST_NM = $student->FIRST_NM;
		$BLOOD_GRP = $student->BLOOD_GRP;
		$NATION = $student->NATION;
		$MOTHER_NM = $student->MOTHER_NM;
		$FATHER_NM = $student->FATHER_NM;
		$CAT_ABBR = $student->CAT_ABBR;
		$ADM_CLASSS = $student->ADM_CLASSS;
		$DISP_CLASS = $student->DISP_CLASS;
		$CBSE_REG = $student->CBSE_REG;
		$CBSE_ROLL = $student->CBSE_ROLL;
		$ADM_DATE = $student->ADM_DATE;
		$SUBJECT1 = $student->SUBJECT1;
		$SUBJECT2 = $student->SUBJECT2;
		$SUBJECT3 = $student->SUBJECT3;
		$SUBJECT4 = $student->SUBJECT4;
		$SUBJECT5 = $student->SUBJECT5;
		$SUBJECT6 = $student->SUBJECT6;
		$dob = date("d-M-Y",strtotime($BIRTH_DT));
		$adm_no1 = date("d-M-Y",strtotime($ADM_DATE));
		$dob_exp = explode("-",$BIRTH_DT);
		$year = $dob_exp[0];
		$day = $dob_exp[2];
		$mont_alpha = date('F',strtotime($dob));
	}
	if($school_setting){
		$school_name = $school_setting[0]->School_Name;
	}
	
   $number = $year;
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? '' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  $amtinword= $result/* . $points . " Paise" */;
  
  //----------------------------//
		$numbers = $day;
	   $nos = round($numbers);
	   $points = round($numbers - $nos, 2) * 100;
	   $hundreds = null;
	   $digits_1s = strlen($nos);
	   $is = 0;
	   $strs = array();
	   $wordss = array('0' => '', '1' => 'One', '2' => 'Two',
		'3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
		'7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
		'10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
		'13' => 'Thirteen', '14' => 'Fourteen',
		'15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
		'18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
		'30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
		'60' => 'Sixty', '70' => 'Seventy',
		'80' => 'Eighty', '90' => 'Ninety');
	   $digitss = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
	   while ($is < $digits_1s) {
		 $dividers = ($is == 2) ? 10 : 100;
		 $numbers = floor($nos % $dividers);
		 $nos = floor($nos / $dividers);
		 $is += ($dividers == 10) ? 1 : 2;
		 if ($numbers) {
			$plurals = (($counters = count($strs)) && $numbers > 9) ? 's' : null;
			$hundreds = ($counters == 1 && $strs[0]) ? ' and ' : null;
			$strs [] = ($numbers < 21) ? $wordss[$numbers] .
				" " . $digitss[$counters] . $plurals . " " . $hundreds
				:
				$wordss[floor($numbers / 10) * 10]
				. " " . $wordss[$numbers % 10] . " "
				. $digitss[$counters] . $plurals . " " . $hundreds;
		 } else $strs[] = null;
	  }
	  $strs = array_reverse($strs);
	  $results = implode('', $strs);
	  $pointss = ($points) ?
		"." . $wordss[$points / 10] . " " . 
			  $wordss[$points = $points % 10] : '';
	  $amtinwords= $results;
  //----------------------------//
	$mont_alpha = $amtinwords.$mont_alpha." ".$amtinword;
?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-lg-12">
		<b style="font-size:22px; color:black;"><i>Student Details</i></b>
	</div>
</div><br />
<form action="<?php echo base_url('Certificate/tc_datafetch'); ?>" method="POST">
	<div class="row">
		<div class="col-sm-6 col-md-6 col-lg-6">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-lg-12 form-group">
					<label>Student Name</label>
					<input type="hidden" value="<?php echo $ADM_NO; ?>" name="adm_no">
					<input type="text" name="nop" class="form-control" value="<?php echo $FIRST_NM; ?>" readonly>
					<input type="hidden" name="month_alpha_cnt" value="<?php echo $mont_alpha; ?>">
				</div>
				<div class="col-md-12 col-sm-12 col-lg-12 form-group">
					<label>Mother Name</label>
					<input type="text" name="m_name" value="<?php echo $MOTHER_NM; ?>" class="form-control" readonly>
				</div>
				<div class="col-md-12 col-sm-12 col-lg-12 form-group">
					<label>Father Name</label>
					<input type="text" name="f_name" value="<?php echo $FATHER_NM; ?>" class="form-control" readonly>
				</div>
				<div class="col-md-12 col-sm-12 col-lg-12 form-group">
					<label>Nationality</label>
					<input type="text" name="nation" class="form-control" value="<?php echo $NATION; ?>" readonly>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-md-6 col-lg-6">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-lg-12 form-group">
					<label>Board Registration No.</label>
					<input type="text" name="reg_no" value="<?php echo $CBSE_REG; ?>" class="form-control" readonly>
				</div>
				<div class="col-md-12 col-sm-12 col-lg-12 form-group">
					<label>Board Roll No.</label>
					<input value="<?php echo $CBSE_ROLL; ?>" name="cbse_roll" type="text" class="form-control" readonly>
				</div>
				<div class="col-md-12 col-sm-12 col-lg-12 form-group">
					<label>Admission Date</label>
					<input type="text" value="<?php echo $adm_no1; ?>" class="form-control" readonly>
					<input type="hidden" name="adm_date" value="<?php echo $ADM_DATE; ?>">
				</div>
				<div class="col-md-12 col-sm-12 col-lg-12 form-group">
					<label>Admission in Class</label>
					<select class="form-control" readonly id="aic" name="aic">
						<?php
							if($class){
								foreach($class as $classkey){
									?>
										<option <?php if($classkey->CLASS_NM == $ADM_CLASSS){echo "selected";} ?> value="<?php echo $classkey->CLASS_NM; ?>"><?php echo $classkey->CLASS_NM; ?></option>
									<?php
								}
							}
						?>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-6 col-sm-6 form-group">
			<label>Date of Birth</label>
			<input type="text" value="<?php echo $dob; ?>" class="form-control" readonly>
			<input type="hidden" name="BIRTH_DT" value="<?php echo $BIRTH_DT; ?>" class="form-control" readonly>
		</div>
		<div class="col-md-6 col-lg-6 col-sm-6 form-group">
			<label>Whether SC/ST</label>
			<select class="form-control" name="wscst">
				<option value="NO">NO</option>
				<?php
					if($category){
						foreach($category as $ckey){
							?>
								<option <?php if($ckey->CAT_ABBR == $CAT_ABBR){echo "selected";} ?> value="<?php echo $ckey->CAT_ABBR; ?>"><?php echo $ckey->CAT_ABBR; ?></option>
							<?php
						}
					}
				?>
			</select>
		</div>
		<div class="col-md-6 col-lg-6 col-sm-6 form-group">
			<label>Class in which the pupil last studied in</label>
			<select class="form-control" id="cps" name="cps">
				<?php
					if($class){
						foreach($class as $classkey){
							?>
								<option <?php if($DISP_CLASS == $classkey->CLASS_NM) {echo "selected";} ?> value="<?php echo $classkey->CLASS_NM; ?>"><?php echo $classkey->CLASS_NM; ?></option>
							<?php
						}
					}
				?>
			</select>
		</div>
		<div class="col-sm-6 col-md-6 col-lg-6 form-group">
			<label>School/Board Annual Examination Last Taken with Result</label>
			<div class="row">
				<div class="col-md-4 col-sm-4 col-lg-4">
					<input type="text" name="st1" class="form-control" value="PASSED">
				</div>
				<div class="col-md-8 col-sm-8 col-lg-8">
					<input type="text" name="school_name" value="<?php echo $school_name; ?>" class="form-control">
				</div>
			</div>
		</div>
		<div class="col-md-6 col-sm-6 col-lg-6 form-group">
			<label>Whether Failed, in the same Class</label>
			<select class="form-control" name="same_class_status">
				<option value="NO">NO</option>
				<option value="YES">YES</option>
			</select>
		</div>
		<div class="col-md-6 col-sm-6 col-lg-6 form-group">
			<label>Month upto which pupil has paid fees</label>
			<input type="text" required name="muwtphpsf" class="form-control">
		</div>
		<div class="col-md-3 col-sm-3 col-lg-3 form-group">
			<label>Subject 1</label>
			<select class="form-control" required id="sb1" name="sb1">
				<option value="">Select Subject</option>
				<?php
					if($subjects){
						foreach($subjects as $subkey){
							?>
								<option <?php if($SUBJECT1 == $subkey->SubSName){echo "selected";} ?> value="<?php echo $subkey->SubName; ?>"><?php echo $subkey->SubName; ?></option>
							<?php
						}
					}
				?>
			</select>
		</div>
		<div class="col-md-3 col-sm-3 col-lg-3 form-group">
			<label>Subject 2</label>
			<select class="form-control" required name="sb2" id="sb2">
				<option value="">Select Subject</option>
				<?php
					if($subjects){
						foreach($subjects as $subkey){
							?>
								<option <?php if($SUBJECT2 == $subkey->SubSName){echo "selected";} ?> value="<?php echo $subkey->SubName; ?>"><?php echo $subkey->SubName; ?></option>
							<?php
						}
					}
				?>
			</select>
		</div>
		<div class="col-md-3 col-sm-3 col-lg-3 form-group">
			<label>Subject 3</label>
			<select class="form-control" required name="sb3" id="sb3">
				<option>Select Subject</option>
				<?php
					if($subjects){
						foreach($subjects as $subkey){
							?>
								<option <?php if($SUBJECT3 == $subkey->SubSName){echo "selected";} ?> value="<?php echo $subkey->SubName; ?>"><?php echo $subkey->SubName; ?></option>
							<?php
						}
					}
				?>
			</select>
		</div>
		<div class="col-md-3 col-sm-3 col-lg-3 form-group">
			<label>Subject 4</label>
			<select class="form-control" required name="sb4" id="sb4">
				<option value="">Select Subject</option>
				<?php
					if($subjects){
						foreach($subjects as $subkey){
							?>
								<option <?php if($SUBJECT4 == $subkey->SubSName){echo "selected";} ?> value="<?php echo $subkey->SubName; ?>"><?php echo $subkey->SubName; ?></option>
							<?php
						}
					}
				?>
			</select>
		</div>
		<div class="col-md-4 col-sm-4 col-lg-4 form-group">
			<label>Subject 5</label>
			<select class="form-control" required name="sb5" id="sb5">
				<option value="">Select Subject</option>
				<?php
					if($subjects){
						foreach($subjects as $subkey){
							?>
								<option <?php if($SUBJECT5 == $subkey->SubSName){echo "selected";} ?> value="<?php echo $subkey->SubName; ?>"><?php echo $subkey->SubName; ?></option>
							<?php
						}
					}
				?>
			</select>
		</div>
		<div class="col-lg-4 col-sm-4 col-md-4 form-group">
			<label>Subject 6</label>
			<select class="form-control" required name="sb6" id="sb6">
				<option value="">Select Subject</option>
				<?php
					if($subjects){
						foreach($subjects as $subkey){
							?>
								<option <?php if($SUBJECT6 == $subkey->SubSName){echo "selected";} ?> value="<?php echo $subkey->SubName; ?>"><?php echo $subkey->SubName; ?></option>
							<?php
						}
					}
				?>
			</select>
		</div>
		<div class="col-lg-4 col-sm-4 col-md-4 form-group">
			<label>Optional Subject</label>
			<select class="form-control" name="opsub" id="opsub">
				<option value="">Select Subject</option>
				<?php
					if($subjects){
						foreach($subjects as $subkey){
							?>
								<option value="<?php echo $subkey->SubName; ?>"><?php echo $subkey->SubName; ?></option>
							<?php
						}
					}
				?>
			</select>
		</div>
		<div class="col-md-6 col-sm-6 col-lg-6 form-group">
			<label>Total no. of Working Days</label>
			<input type="text" required name="total_day" class="form-control">
		</div>
		<div class="col-md-6 col-sm-6 col-lg-6 form-group">
			<label>Total no. of Days Present</label>
			<input type="text" required name="total_p_day" class="form-control">
		</div>
		<div class="col-md-4 col-sm-4 col-lg-4 form-group">
			<label>Whether Qualified for Promotion to the Higher Class</label>
			<select class="form-control" name="wqfhc">
				<option value="NO">NO</option>
				<option value="YES">YES</option>
			</select>
		</div>
		<div class="col-md-4 col-sm-4 col-lg-4 form-group">
			<br />
			<label>If so, to which Class</label>
			<select class="form-control" id="iswc" name="iswc">
				<option value="">Select Class</option>
				<?php
					if($class){
						foreach($class as $classkey){
							?>
								<option value="<?php echo $classkey->CLASS_NM; ?>"><?php echo $classkey->CLASS_NM; ?></option>
							<?php
						}
					}
				?>
			</select>
		</div>
		<div class="col-md-4 col-sm-4 col-lg-4 form-group">
			<br />
			<label>(In Word)</label>
			<input type="text" name="inword" class="form-control">
		</div>
		<div class="col-md-6 col-sm-6 col-lg-6 form-group">
			<label>Any Fee Concession Available if so, the nature of Concession</label>
			<select class="form-control" name="afcon">
				<option value="NO">NO</option>
				<option value="YES">YES</option>
			</select>
		</div>
		<div class="col-md-6 col-sm-6 col-lg-6 form-group">
			<br />
			<input type="text" name="usual_type" class="form-control" value="AS USUAL">
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-sm-6 col-lg-6 form-group">
			<label>Whether NCC Cadet/Boy Scout/Girl Guide</label>
			<select class="form-control" name="wncc">
				<option value="NO">NO</option>
				<option value="YES">YES</option>
			</select>
		</div>
		<div class="col-md-6 col-sm-6 col-lg-6 form-group">
			<label>Games Played/Extra Curricular or any other (if any mention achivement)</label>
			<input type="text" name="extcur" class="form-control" value="N/A">
		</div>
		<div class="col-md-6 col-sm-6 col-lg-6 form-group">
			<label>General Conduct</label>
			<input type="text" name="general_conduct" class="form-control" value="GOOD">
		</div>
		<div class="col-md-6 col-sm-6 col-lg-6 form-group">
			<label>Date of Application for Certificate</label>
			<input type="date" required name="applied_date" class="form-control">
		</div>
		<div class="col-md-6 col-sm-6 col-lg-6 form-group">
			<label>Date of Issue of Certificate</label>
			<input type="date" required name="issue_date" class="form-control">
		</div>
		<div class="col-md-6 col-sm-6 col-lg-6 form-group">
			<label>Reasons for leaving School</label>
			<select name="rfl" id="rfl" required class="form-control">
				<option value="">Select Reasons</option>
				<?php
					if($TC_REMARKS){
						foreach($TC_REMARKS as $TC_REMARKS_data){
							?>
								<option value="<?php echo $TC_REMARKS_data->REMARKS; ?>"><?php echo $TC_REMARKS_data->REMARKS; ?></option>
							<?php
						}
					}
				?>
			</select>
		</div>
		<div class="col-md-12 col-sm-12 col-lg-12 form-group">
			<label>Any Other Remarks</label>
			<input type="text" class="form-control" value="ACTIVE">
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<center><button class="btn btn-success"><i class="fa fa-save" aria-hidden="true"></i> SAVE & <i class="fa fa-print" aria-hidden="true"></i> PRINT</button>&nbsp;<a href="#" class="btn btn-danger">Cancel <i class="fa fa-window-close"></i></a></center>
		</div>
	</div>
</form>
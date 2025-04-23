<?php
	error_reporting(0);
	if($student){
		$BIRTH_DT = $student[0]->BIRTH_DT;
		$BIRTH_DT1 = date("d-M-Y",strtotime($BIRTH_DT));
	}
?>
<form method="POST" action="<?php echo base_url('Tution_fee_certificate/save_fee_details'); ?>">
	<div class='row'>
		<div class="col-md-6 col-sm-6 col-lg-6 form-group">
			<label>Student Name</label>
			<input type="hidden" name="adm_no" value="<?php echo $student[0]->ADM_NO; ?>">
			<input type="text" value="<?php echo $student[0]->FIRST_NM; ?>" readonly name="stu_name" class="form-control">
		</div>
		<div class="col-md-6 col-sm-6 col-lg-6 form-group">
			<label>Father Name</label>
			<input type="text" value="<?php echo $student[0]->FATHER_NM; ?>" readonly name="f_name" class="form-control">
		</div>
	</div>
	<div class='row'>
		<div class="col-md-6 col-sm-6 col-lg-6 form-group">
			<label>Mother Name</label>
			<input type="text" value="<?php echo $student[0]->MOTHER_NM; ?>" readonly name="m_name" class="form-control">
		</div>
		<div class="col-md-6 col-sm-6 col-lg-6 form-group">
			<label>Date of Birth</label>
			<input type="text" value="<?php echo $BIRTH_DT1;?>" readonly class="form-control">
			<input type="hidden" value="<?php echo $BIRTH_DT; ?>" name="date">
		</div>
	</div>
	<div class='row'>
		<div class="col-md-6 col-sm-6 col-lg-6 form-group">
			<label>Class</label>
			<input type="text" readonly value="<?php echo $student[0]->DISP_CLASS; ?>" name="classes" class="form-control">
		</div>
		<div class="col-md-6 col-sm-6 col-lg-6 form-group">
			<label>Sec</label>
			<input type="text" readonly value="<?php echo $student[0]->DISP_SEC; ?>" name="sec" class="form-control">
		</div>
	</div>
	<div class='row'>
		<div class="col-md-6 col-sm-6 col-lg-6 form-group">
			<label>Fee Paid From</label>
			<input type="text" readonly value="<?php echo "APR"; ?>" name="fpf" class="form-control">
		</div>
		<div class="col-md-6 col-sm-6 col-lg-6 form-group">
			<label>to</label>
			<input type="text" readonly value="<?php echo $final_month; ?>" name="paid_upto" class="form-control">
		</div>
	</div>
	<div class='row'>
		<div class="col-md-6 col-sm-6 col-lg-6 form-group">
			<label>Rate of Tution Fee</label>
			<input type="text" value="<?php echo $tution_fee; ?>" readonly name="rtf" class="form-control">
		</div>
		<div class="col-md-6 col-sm-6 col-lg-6 form-group">
			<label>Total Amount Paid</label>
			<input type="text" value="<?php echo $t_f; ?>" readonly name="total_paid" class="form-control">
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12 form-group">
			<center>
				<button class="btn btn-success">Save & Print</button>
			</center>
		</div>
	</div>
</form>
<?php
	error_reporting(0);
	if($student){
		$BIRTH_DT = $student[0]->BIRTH_DT;
		$BIRTH_DT1 = date("d-M-Y",strtotime($BIRTH_DT));
	}
?>
<form method="POST" action="<?php echo base_url('Date_of_birth_certificate/save_bob_details'); ?>">
	<div class='row'>
		<div class="col-md-6 col-sm-6 col-lg-6 form-group">
			<label>Student Name</label>
			<input type="hidden" name="bon_details" value="<?php echo $bonafide; ?>">
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
			<label>Issue Date</label>
			<input type="text" readonly name="issue_date" value="<?php echo date('d-M-Y'); ?>" class="form-control">
		</div>
		<div class="col-md-6 col-sm-6 col-lg-6 form-group">
			<label>Class</label>
			<input type="text" readonly value="<?php echo $student[0]->DISP_CLASS; ?>" name="class" class="form-control">
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
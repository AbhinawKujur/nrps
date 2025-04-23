<?php
	error_reporting(0);
	if($student){
		$BIRTH_DT = $student[0]->BIRTH_DT;
		$BIRTH_DT1 = date("d-M-Y",strtotime($BIRTH_DT));
	}
?>
<style>
	.head{
		color:#fff !important;
		text-align: center;
		background-color:#5784c3;
	}
	.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    font-size: 0.9em;
    color: #131111;
    border-top: none !important;
    padding-top: 5px !important;
	text-align:center;
}
</style>
<form method="POST" action="<?php echo base_url('Fee_paid_all_certificate/save_fee_details'); ?>">
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
			<input type="text" value="<?php echo $final_month; ?>" readonly name="paid_upto" class="form-control">
		</div>
	</div>
	<div class='row'>
		<div class="col-md-6 col-sm-6 col-lg-6 form-group">
			<label>Total Amount Paid</label>
			<input type="text" value="<?php echo $daycoll[0]->TOTAL; ?>"  readonly name="total_paid" class="form-control">
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12 form-group">
			<center>
				<button class="btn btn-success">Save & Print</button>
			</center>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12">
			<table class="table">
				<tr>
					<th class="head">Fee Head</th>
					<th class="head">Rate</th>
					<th class="head">Fee Paid</th>
				</tr>
				<?php
					if($feehead){
						foreach($feehead as $key => $value){
							$fee = "Fee".$key;
							if($daycoll[0]->$fee > 0){
								?>
								<tr>
									<td><?php echo $value->FEE_HEAD; ?></td>
									<td><?php echo $fee_details[$key]; ?></td>
									<td><?php echo $daycoll[0]->$fee; ?></td>
								</tr>
								<?php
							}
						}
					}
				?>
				<tr>
					<td colspan="2"><b>GRAND TOTAL</b></td>
					<td><?php echo $daycoll[0]->TOTAL; ?></td>
				</tr>
			</table>
		</div>
	</div>
</form>
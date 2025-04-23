<?php
	if($fee_head1)
	{
		$feehead1 = $fee_head1[0]->FEE_HEAD;
	}
	if($fee_head2)
	{
		$feehead2 = $fee_head2[0]->FEE_HEAD;
	}
	if($fee_head3)
	{
		$feehead3 = $fee_head3[0]->FEE_HEAD;
	}
	if($fee_head4)
	{
		$feehead4 = $fee_head4[0]->FEE_HEAD;
	}
	if($fee_head5)
	{
		$feehead5 = $fee_head5[0]->FEE_HEAD;
	}
	if($fee_head6)
	{
		$feehead6 = $fee_head6[0]->FEE_HEAD;
	}
	if($fee_head7)
	{
		$feehead7 = $fee_head7[0]->FEE_HEAD;
	}
	if($fee_head8)
	{
		$feehead8 = $fee_head8[0]->FEE_HEAD;
	}
	if($fee_head9)
	{
		$feehead9 = $fee_head9[0]->FEE_HEAD;
	}
	if($fee_head10)
	{
		$feehead10 = $fee_head10[0]->FEE_HEAD;
	}
	if($fee_head11)
	{
		$feehead11 = $fee_head11[0]->FEE_HEAD;
	}
	if($fee_head12)
	{
		$feehead12 = $fee_head12[0]->FEE_HEAD;
	}
	if($fee_head13)
	{
		$feehead13 = $fee_head13[0]->FEE_HEAD;
	}
	if($fee_head14)
	{
		$feehead14 = $fee_head14[0]->FEE_HEAD;
	}
	if($fee_head15)
	{
		$feehead15 = $fee_head15[0]->FEE_HEAD;
	}
	if($fee_head16)
	{
		$feehead16 = $fee_head16[0]->FEE_HEAD;
	}
	if($fee_head17)
	{
		$feehead17 = $fee_head17[0]->FEE_HEAD;
	}
	if($fee_head18)
	{
		$feehead18 = $fee_head18[0]->FEE_HEAD;
	}
	if($fee_head19)
	{
		$feehead19 = $fee_head19[0]->FEE_HEAD;
	}
	if($fee_head20)
	{
		$feehead20 = $fee_head20[0]->FEE_HEAD;
	}
	if($fee_head21)
	{
		$feehead21 = $fee_head21[0]->FEE_HEAD;
	}
	if($fee_head22)
	{
		$feehead22 = $fee_head22[0]->FEE_HEAD;
	}
	if($fee_head23)
	{
		$feehead23 = $fee_head23[0]->FEE_HEAD;
	}
	if($fee_head24)
	{
		$feehead24 = $fee_head24[0]->FEE_HEAD;
	}
	if($fee_head25)
	{
		$feehead25 = $fee_head25[0]->FEE_HEAD;
	}

	if($scholarship)
	{
		$stu_id=$scholarship[0]->STUDENTID;
		$recomm = $scholarship[0]->recomm;
		$name = $scholarship[0]->STU_NAME;
		$app_no = $scholarship[0]->app_no;
		$admno = $scholarship[0]->ADM_NO;
		$CLASS = $scholarship[0]->CLASS;
		$SEC = $scholarship[0]->SEC;
		$ROLL_NO = $scholarship[0]->ROLL_NO;
		$Apply_From = $scholarship[0]->Apply_From;
		$Owned_By = $scholarship[0]->Owned_By;
		$S1 = $scholarship[0]->S1;
		$S2 = $scholarship[0]->S2;
		$S3 = $scholarship[0]->S3;
		$S4 = $scholarship[0]->S4;
		$S5 = $scholarship[0]->S5;
		$S6 = $scholarship[0]->S6;
		$S7 = $scholarship[0]->S7;
		$S8 = $scholarship[0]->S8;
		$S9 = $scholarship[0]->S9;
		$S10 = $scholarship[0]->S10;
		$S11 = $scholarship[0]->S11;
		$S12 = $scholarship[0]->S12;
		$S13 = $scholarship[0]->S13;
		$S14 = $scholarship[0]->S14;
		$S15 = $scholarship[0]->S15;
		$S16 = $scholarship[0]->S16;
		$S17 = $scholarship[0]->S17;
		$S18 = $scholarship[0]->S18;
		$S18 = $scholarship[0]->S18;
		$S19 = $scholarship[0]->S19;
		$S20 = $scholarship[0]->S20;
		$S21 = $scholarship[0]->S21;
		$S22 = $scholarship[0]->S22;
		$S23 = $scholarship[0]->S23;
		$S24 = $scholarship[0]->S24;
		$S25 = $scholarship[0]->S25;
	}
?>
<style type="text/css">
  body{
   font-family: Verdana,Geneva,sans-serif; 
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Scholarship Information</a> <i class="fa fa-angle-right"></i></li>
</ol>
<div class="row">
	<div class="col-md-11">
		<?php
					   if($this->session->flashdata('msg')){
					   	?>
					   	<div class="alert alert-success" role="alert" id="msg" style="padding: 6px 0px;">
			  				<center><strong><?php echo $this->session->flashdata('msg'); ?></strong></center>
						</div>
					   	<?php
					   }
					?>
	</div>
	<div class='col-sm-1'>		
		  <a href="<?php echo base_url('Student_details/Scholarship'); ?>" class='btn btn-danger pull-right'>BACK</a><br /><br />
        </div><br />
	
</div>
<div class="row" style="border-top:3px solid #5785c3;">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-8">
				<h2 class="pull-right">Student Scholarship Details</h2>
			</div>
			<div class="col-md-4" align="right">
				<br>
					<span class="text-success" id="error"><input type="checkbox" name="update" id="update" style="height: 16px; width: 16px;" onclick="update(this.value)" > Tick For Update</span>
			</div>
		</div>
	</div><br><br>
	<form method="post" action="<?php echo base_url('Student_details/scholarship_update'); ?>" id="form" onsubmit="return validation()">
		<div class="form-group col-md-4">
			<label>Admission No.</label>
			<input type="text" value="<?php echo $admno; ?>" name="admno" id="admno" class="form-control" disabled>
			<input type="hidden" name="admno1" value="<?php echo $admno; ?>">
		</div>
		<input type="hidden" name="stu_id1" value="<?php echo $stu_id; ?>">
		<div class="form-group col-md-4">
			<label>Name</label>
			<input type="text" value="<?php echo $name; ?>" name="name" id="name" class="form-control" autocomplete="off" disabled>
		</div>
		<div class="form-group col-md-4">
			<label>Class/sec</label>
			<div class="row">
				<div class="form-group col-md-6">
					<select class="form-control" id="class" disabled>
						<?php
						if($class){
							foreach($class as $class_data)
							{
								?>
								<option value="<?php echo $class_data->CLASS_NM; ?>" <?php if($CLASS==$class_data->CLASS_NM){echo 'selected';} ?>><?php echo $class_data->CLASS_NM; ?></option>
								<?php
							}
						}
						?>
					</select>
				</div>
				<div class="form-group col-md-6">
					<select class="form-control" id="sec" disabled>
						<?php
						if($sec){
							foreach($sec as $sec_data){
								
								?>
								<option value="<?php echo $sec_data->SECTION_NAME; ?>" <?php if($SEC==$sec_data->SECTION_NAME) {echo "selected";} ?> ><?php echo $sec_data->SECTION_NAME; ?></option>
								<?php
							}
						}
						?>
					</select>
				</div>
			</div>
		</div>
		<div class="form-group col-md-4">
			<label>Roll</label>
			<input type="text" value="<?php echo $ROLL_NO; ?>" name="roll" id="roll" class="form-control" disabled>
		</div>
		<div class="form-group col-md-4">
			<label>Scholarship Apply From</label>
			<select name="saf" id="saf" class="form-control" disabled>
				<?php
				if($month)
				{
					foreach ($month as $month_data) {
					?>
					<option value="<?php echo $month_data->month_name; ?>" <?php if($Apply_From==$month_data->month_name) {echo "selected";} ?> ><?php echo $month_data->month_name; ?></option>
					<?php
					}
				}
				?>
			</select>
		</div>
		<div class="form-group col-md-4">
			<label>Scholarship Given By</label>
			<select class="form-control" name="sgb" id="sgb" disabled>
				<option value="Management" <?php if($Owned_By=='Management') {echo "selected";} ?>>Meritorious Scholarship</option>
				<option value="Land Doner" <?php if($Owned_By=='Land Doner') {echo "selected";} ?> >Management</option>
				<option value="4thGrade" <?php if($Owned_By=='4thGrade') {echo "selected";} ?> >4th Grade Employee</option>
				<option value="Hostel" <?php if($Owned_By=='Hostel') {echo "selected";} ?> >Hostel Students</option>
				<option value="Others" <?php if($Owned_By=='Others') {echo "selected";} ?> >Others</option>
			</select>
		</div>
	   
	   <div class="form-group col-md-4">
			<label>Application No.</label>
			<input type="text" name="app_no" id="app_no" value="<?php echo $app_no; ?>" class="form-control" disabled required>
		</div>
		
		<div class="form-group col-md-4">
			<label>Recommended By</label>
			<input type="text" name="recomm" id="recomm" value="<?php echo $recomm; ?>" class="form-control" disabled required>
		</div>
		
		<hr style="border: 0.5px solid black;">
		<div class="form-group col-md-12">
			<h3>Fee-Head Details (<span style='font-size:28px;'>&#8377;</span>):</h3>
		</div>
		<?php
		  if($feehead1!="" && $feehead1!="-")
		  {
		  	?>
		  	 <div class="form-group col-md-3">
			<label><?php echo $feehead1; ?></label>
			<input type="text" style="text-align: right;" value="<?php echo $S1; ?>" class="form-control" name="regform" id="regform" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode==46' placeholder="Amount" disabled autocomplete="off">
		     </div>
		  	<?php
		  }
		  else
		  {

		  }
		?>
		<?php
		 if($feehead2!="" && $feehead2!="-")
		 {
		 	?>
		 	 <div class="form-group col-md-3">
			<label><?php echo $feehead2; ?></label>
			<input type="text" style="text-align: right;" value="<?php echo $S2; ?>" class="form-control" name="af" id="af" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode==46' placeholder="Amount" disabled autocomplete="off">
		    </div>
		 	<?php
		 }
		 else
		 {

		 }
		?>
		<?php
		 if($feehead3!="" && $feehead3!="-")
		 {
		 	?>
		 	<div class="form-group col-md-3">
			<label><?php echo $feehead3; ?></label>
			<input type="text" style="text-align: right;" value="<?php echo $S3; ?>" class="form-control" name="adf" id="adf" onkeypress="return event.charCode >=48 && event.charCode <= 57 || event.charCode==46" placeholder="Amount" disabled autocomplete="off">
		     </div>
		 	<?php
		 }
		 else
		 {

		 }
		?>
		<?php
		 if($feehead4!="" && $feehead4!="-")
		 {
		 	?>
		 	 <div class="form-group col-md-3">
			<label><?php echo $feehead4; ?></label>
			<input type="text" style="text-align: right;" value="<?php echo $S4; ?>" class="form-control" name="rs" id="rs" onkeypress="return event.charCode >=48 && event.charCode <= 57 || event.charCode==46" placeholder="Amount" disabled autocomplete="off">
		</div>
		 	<?php
		 }
		 else
		 {

		 }
		?>
		<?php
		 if($feehead5!="" && $feehead5!="-")
		 {
		 	?>
		 	 <div class="form-group col-md-3">
			<label><?php echo $feehead5; ?></label>
			<input type="text" style="text-align: right;" value="<?php echo $S5; ?>" class="form-control" name="bf" id="bf" onkeypress="return event.charCode >=48 && event.charCode <=57 || event.charCode==46" placeholder="Amount" disabled autocomplete="off">
		</div>
		 	<?php
		 }
		  else
		  {

		  }
		?>
		<?php
		 if($feehead6!="" && $feehead6!="-")
		 {
		 	?>
		 	  <div class="form-group col-md-3">
			<label><?php echo $feehead6; ?></label>
			<input type="text" style="text-align: right;" value="<?php echo $S6; ?>" class="form-control" name="ef" id="ef" onkeypress="return event.charCode >=48 && event.charCode <=57 || event.charCode==46" placeholder="Amount" disabled autocomplete="off">
		    </div>
		 	<?php
		 }
		 else
		 {

		 }
		?>
		<?php
		 if($feehead7!="" && $feehead7!="-")
		 {
		 	?>
		 	 <div class="form-group col-md-3">
			<label><?php echo $feehead7; ?></label>
			<input type="text" style="text-align: right;" value="<?php echo $S7; ?>" class="form-control" name="hqf" id="hqf" onkeypress="return event.charCode >=48 && event.charCode <=57 || event.charCode==46" placeholder="Amount" disabled autocomplete="off">
		</div>
		 	<?php
		 }
		 else
		 {

		 }
		?>
		<?php
		 if($feehead8!="" && $feehead8!="-")
		 {
		 	?>
		 	 <div class="form-group col-md-3">
			<label><?php echo $feehead8; ?></label>
			<input type="text" style="text-align: right;" value="<?php echo $S8; ?>" class="form-control" name="pf" id="pf" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode==46" placeholder="Amount" disabled autocomplete="off">
		   </div>
		 	<?php
		 }
		 else
		 {

		 }
		?>
		<?php
		 if($feehead9!="" && $feehead9!="-")
		 {
		 	?>
		 	 <div class="form-group col-md-3">
			<label><?php echo $feehead9; ?></label>
			<input type="text" style="text-align: right;" value="<?php echo $S9; ?>" class="form-control" name="asf" id="asf" onkeypress="return event.charCode >=48 && event.charCode <= 57 || event.charCode==46" placeholder="Amount" disabled autocomplete="off">
		   </div>
		 	<?php
		 }
		 else
		 {

		 }
		?>
		<?php
		 if($feehead10!="" && $feehead10!="-")
		 {
		 	?>
		 	 <div class="form-group col-md-3">
			<label><?php echo $feehead10; ?></label>
			<input type="text" style="text-align: right;" value="<?php echo $S10; ?>" class="form-control" name="tf" id="tf" onkeypress="return event.charCode >=48 && event.charCode <= 57 || event.charCode==46" placeholder="Amount" disabled autocomplete="off">
		   </div>
		 	<?php
		 }
		 else
		 {

		 }
		?>
		<?php
		 if($feehead11!="" && $feehead11!="-")
		 {
		 	?>
		 	 <div class="form-group col-md-3">
			<label><?php echo $feehead11; ?></label>
			<input type="text" style="text-align: right;" value="<?php echo $S11; ?>" class="form-control" name="sf" id="sf" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" placeholder="Amount" disabled autocomplete="off">
		</div>
		 	<?php
		 }
		 else
		 {

		 }
		?>
		<?php
		 if($feehead12!="" && $feehead12!="-")
		 {
		 	?>
		 	 <div class="form-group col-md-3">
			<label><?php echo $feehead12; ?></label>
			<input type="text" style="text-align: right;" value="<?php echo $S12; ?>" class="form-control" name="cf" id="cf" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" placeholder="Amount" disabled autocomplete="off">
		    </div>
		 	<?php
		 }
		 else
		 {

		 }
		?>
		<?php
		 if($feehead13!="" && $feehead13!="-")
		 {
		 	?>
		 	 <div class="form-group col-md-3">
			<label><?php echo $feehead13; ?></label>
			<input type="text" style="text-align: right;" value="<?php echo $S13; ?>" class="form-control" name="tb" id="tb" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" placeholder="Amount" disabled autocomplete="off">
		   </div>
		 	<?php
		 }
		 else
		 {

		 }
		?>
		<?php
		 if($feehead14!="" && $feehead14!="-")
		 {
		 	?>
		 	 <div class="form-group col-md-3">
			<label><?php echo $feehead14; ?></label>
			<input type="text" style="text-align: right;" value="<?php echo $S14; ?>" class="form-control" name="ic" id="ic" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" placeholder="Amount" disabled autocomplete="off">
		</div>
		 	<?php
		 }
		 else
		 {

		 }
		?>
		<?php
		 if($feehead15!="" && $feehead15!="-")
		 {
		 	?>
		 	  <div class="form-group col-md-3">
			<label><?php echo $feehead15; ?></label>
			<input type="text" style="text-align: right;" value="<?php echo $S15; ?>" class="form-control" name="lf" id="lf" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" placeholder="Amount" disabled autocomplete="off">
		</div>
		 	<?php
		 }
		 else
		 {

		 }
		?>
		<?php
		 if($feehead16!="" && $feehead16!="-")
		 {
		 	?>
		 	  <div class="form-group col-md-3">
			<label><?php echo $feehead16; ?></label>
			<input type="text" style="text-align: right;" value="<?php echo $S16; ?>" name="srf" id="srf" class="form-control" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" placeholder="Amount" disabled autocomplete="off">
		    </div>
		 	<?php
		 }
		 else
		 {

		 }
		?>
		<?php
			if($feehead17!="" && $feehead17!="-")
			{
				?>
				 <div class="form-group col-md-3">
			<label><?php echo $feehead17; ?></label>
			<input type="text" style="text-align: right;" value="<?php echo $S17; ?>" name="dry" id="dry" class="form-control" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" placeholder="Amount" disabled autocomplete="off">
		</div>
				<?php
			}
			else
			{

			}
		?>
		<?php
		 if($feehead18!="" && $feehead18!="-")
		 {
		 	?>
		 	 <div class="form-group col-md-3">
			<label><?php echo $feehead18; ?></label>
			<input type="text" style="text-align: right;" value="<?php echo $S18; ?>" name="blt" id="blt" class="form-control" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" placeholder="Amount" disabled autocomplete="off">
		    </div>
		 	<?php
		 }
		 else
		 {

		 }
		?>
		<?php
		 if($feehead19!="" && $feehead19!="-")
		 {
		 	?>
		 	 <div class="form-group col-md-3">
			<label><?php echo $feehead19; ?></label>
			<input type="text" style="text-align: right;" value="<?php echo $S19; ?>" name="tie" id="tie" class="form-control" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" placeholder="Amount" disabled autocomplete="off">
		     </div>
		 	<?php
		 }
		 else
		 {

		 }
		?>
		<?php
		 if($feehead20!="" && $feehead20!="-")
		 {
		 	?>
		 	<div class="form-group col-md-3">
			<label><?php echo $feehead20; ?></label>
			<input type="text" style="text-align: right;" value="<?php echo $S20; ?>" name="cdbf" id="cdbf" class="form-control" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" placeholder="Amount" disabled autocomplete="off">
		    </div>	
		 	<?php
		 }
		 else
		 {

		 }
		?>
		<?php
		 if($feehead21!="" && $feehead21!="-")
		 {
		 	?>
		 	 <div class="form-group col-md-3">
			<label><?php echo $feehead21; ?></label>
			<input type="text" style="text-align: right;" value="<?php echo $S21; ?>" name="misc" id="misc" class="form-control" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" placeholder="Amount" disabled autocomplete="off">
		   </div>
		 	<?php
		 }
		 else
		 {

		 }
		?>
		<?php
		  if($feehead22!="" && $feehead22!="-")
		  {
		  	?>
		  	 <div class="form-group col-md-3">
			<label><?php echo $feehead22; ?></label>
			<input type="text" style="text-align: right;" value="<?php echo $S22; ?>" name="others" id="others" class="form-control" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" placeholder="Amount" disabled autocomplete="off">
		    </div>
		  	<?php
		  }
		  else
		  {

		  }
		?>
		<?php 
		  if($feehead23!="" && $feehead23!="-")
		  {
		  	?>
		  	 <div class="form-group col-md-3">
			<label><?php echo $feehead23; ?></label>
			<input type="text" style="text-align: right;" value="<?php echo $S23; ?>" name="books" id="books" class="form-control" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" placeholder="Amount" disabled autocomplete="off">
		    </div>
		  	<?php
		  }
		  else
		  {

		  }
		?>
		<?php
		 if($feehead24!="" && $feehead24!="-")
		 {
		 	?>
		 	<div class="form-group col-md-3">
			<label><?php echo $feehead24; ?></label>
			<input type="text" style="text-align: right;" value="<?php echo $S24; ?>" name="feeopt" id="feeopt" class="form-control" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" placeholder="Amount" disabled autocomplete="off">
		    </div>
		 	<?php
		 }
		 else
		 {

		 }
		?>
		<?php
		 if($feehead25!="" && $feehead25!="-")
		 {
		 	?>
		 	 <div class="form-group col-md-3">
			<label><?php echo $feehead25; ?></label>
			<input type="text" style="text-align: right;" value="<?php echo $S25; ?>" name="feeopt1" id="feeopt1" class="form-control" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" placeholder="Amount" disabled autocomplete="off">
		    </div>
		 	<?php
		 }
		 else
		 {

		 }
		?>
		
		<div class="form-group col-md-12">
			<center><input type="submit" name="update" value="update" class="btn btn-success"></center>
		</div>
	</form>	
</div>
<script type="text/javascript">
		$("#msg").fadeOut(8000);
	function update(val) {
		if($('#update').is(':checked'))
    {
    			//$("#admno").prop('disabled', false);
    			//$("#name").prop('disabled', false);
    			//$('#class').prop('disabled',false);
    			//$('#sec').prop('disabled',false);
    			//$('#roll').prop('disabled',false);
    			$('#saf').prop('disabled',false);
    			$('#sgb').prop('disabled',false);
    			$('#regform').prop('disabled',false);
    			$('#af').prop('disabled',false);
    			$('#adf').prop('disabled',false);
    			$('#rs').prop('disabled',false);
    			$('#bf').prop('disabled',false);
    			$('#ef').prop('disabled',false);
    			$('#hqf').prop('disabled',false);
    			$('#pf').prop('disabled',false);
    			$('#asf').prop('disabled',false);
    			$('#tf').prop('disabled',false);
    			$('#sf').prop('disabled',false);
    			$('#cf').prop('disabled',false);
    			$('#tb').prop('disabled',false);
    			$('#ic').prop('disabled',false);
    			$('#lf').prop('disabled',false);
    			$('#srf').prop('disabled',false);
    			$('#dry').prop('disabled',false);
    			$('#blt').prop('disabled',false);
    			$('#tie').prop('disabled',false);
    			$('#cdbf').prop('disabled',false);
    			$('#misc').prop('disabled',false);
    			$('#others').prop('disabled',false);
    			$('#books').prop('disabled',false);
    			$('#feeopt').prop('disabled',false);
    			$('#feeopt1').prop('disabled',false);
    			$('#app_no').prop('disabled',false);
				$('#recomm').prop('disabled',false);
    }
    else
    {
                //$("#admno").prop('disabled', true);
    			//$("#name").prop('disabled', true);
    			//$('#class').prop('disabled',true);
    			//$('#sec').prop('disabled',true);
    			//$('#roll').prop('disabled',true);
    			$('#saf').prop('disabled',true);
    			$('#sgb').prop('disabled',true);
    			$('#regform').prop('disabled',true);
    			$('#af').prop('disabled',true);
    			$('#adf').prop('disabled',true);
    			$('#rs').prop('disabled',true);
    			$('#bf').prop('disabled',true);
    			$('#ef').prop('disabled',true);
    			$('#hqf').prop('disabled',true);
    			$('#pf').prop('disabled',true);
    			$('#asf').prop('disabled',true);
    			$('#tf').prop('disabled',true);
    			$('#sf').prop('disabled',true);
    			$('#cf').prop('disabled',true);
    			$('#tb').prop('disabled',true);
    			$('#ic').prop('disabled',true);
    			$('#lf').prop('disabled',true);
    			$('#srf').prop('disabled',true);
    			$('#dry').prop('disabled',true);
    			$('#blt').prop('disabled',true);
    			$('#tie').prop('disabled',true);
    			$('#cdbf').prop('disabled',true);
    			$('#misc').prop('disabled',true);
    			$('#others').prop('disabled',true);
    			$('#books').prop('disabled',true);
    			$('#feeopt').prop('disabled',true);
    			$('#feeopt1').prop('disabled',true);
				$('#app_no').prop('disabled',true);
				$('#recomm').prop('disabled',true);

    }
	}
	function validation(){
			var chk = document.getElementById('update');
			if(chk.checked){
				return true;
			}else{
				document.getElementById('error').style.color = 'red';
				document.getElementById('error').style.fontSize = 'larger';
				document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
				return false;
			}
		}
</script>
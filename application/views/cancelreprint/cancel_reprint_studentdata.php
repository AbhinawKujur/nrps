<?php
	if($details){
		$RECT_NO = $details[0]->RECT_NO;
		$RECT_DATE = $details[0]->RECT_DATE;
		$STU_NAME = $details[0]->STU_NAME;
		$STUDENTID = $details[0]->STUDENTID;
		$ADM_NO = $details[0]->ADM_NO;
		$CLASS = $details[0]->CLASS;
		$SEC = $details[0]->SEC;
		$ROLL_NO = $details[0]->ROLL_NO;
		$PERIOD = $details[0]->PERIOD;
		$TOTAL = $details[0]->TOTAL;
		$Fee1 = $details[0]->Fee1;
		$Fee2 = $details[0]->Fee2;
		$Fee3 = $details[0]->Fee3;
		$Fee4 = $details[0]->Fee4;
		$Fee5 = $details[0]->Fee5;
		$Fee6 = $details[0]->Fee6;
		$Fee7 = $details[0]->Fee7;
		$Fee8 = $details[0]->Fee8;
		$Fee9 = $details[0]->Fee9;
		$Fee10 = $details[0]->Fee10;
		$Fee11 = $details[0]->Fee11;
		$Fee12 = $details[0]->Fee12;
		$Fee13 = $details[0]->Fee13;
		$Fee14 = $details[0]->Fee14;
		$Fee15 = $details[0]->Fee15;
		$Fee16 = $details[0]->Fee16;
		$Fee17 = $details[0]->Fee17;
		$Fee18 = $details[0]->Fee18;
		$Fee19 = $details[0]->Fee19;
		$Fee20 = $details[0]->Fee20;
		$Fee21 = $details[0]->Fee21;
		$Fee22 = $details[0]->Fee22;
		$Fee23 = $details[0]->Fee23;
		$Fee24 = $details[0]->Fee24;
		$Fee25 = $details[0]->Fee25;
		$APR_FEE = $details[0]->APR_FEE;
		$MAY_FEE = $details[0]->MAY_FEE;
		$JUNE_FEE = $details[0]->JUNE_FEE;
		$JULY_FEE = $details[0]->JULY_FEE;
		$AUG_FEE = $details[0]->AUG_FEE;
		$SEP_FEE = $details[0]->SEP_FEE;
		$OCT_FEE = $details[0]->OCT_FEE;
		$NOV_FEE = $details[0]->NOV_FEE;
		$DEC_FEE = $details[0]->DEC_FEE;
		$JAN_FEE = $details[0]->JAN_FEE;
		$FEB_FEE = $details[0]->FEB_FEE;
		$MAR_FEE = $details[0]->MAR_FEE;
		$CHQ_NO = $details[0]->CHQ_NO;
		$Narr = $details[0]->Narr;
		$TAmt = $details[0]->TAmt;
		$TAmtFee_Book_No = $details[0]->Fee_Book_No;
		$Collection_Mode = $details[0]->Collection_Mode;
		$User_Id = $details[0]->User_Id;
		$Payment_Mode = $details[0]->Payment_Mode;
		$Bank_Name = $details[0]->Bank_Name;
		$Pay_Date = $details[0]->Pay_Date;
		$Session_Year = $details[0]->Session_Year;
		$FORM_NO = $details[0]->FORM_NO;
		$rect_data = date("d-M-Y",strtotime($RECT_DATE));
	}
	if($feehead){
		$feehead1 = $feehead[0]->FEE_HEAD;
		$feehead2 = $feehead[1]->FEE_HEAD;
		$feehead3 = $feehead[2]->FEE_HEAD;
		$feehead4 = $feehead[3]->FEE_HEAD;
		$feehead5 = $feehead[4]->FEE_HEAD;
		$feehead6 = $feehead[5]->FEE_HEAD;
		$feehead7 = $feehead[6]->FEE_HEAD;
		$feehead8 = $feehead[7]->FEE_HEAD;
		$feehead9 = $feehead[8]->FEE_HEAD;
		$feehead10 = $feehead[9]->FEE_HEAD;
		$feehead11 = $feehead[10]->FEE_HEAD;
		$feehead12 = $feehead[11]->FEE_HEAD;
		$feehead13 = $feehead[12]->FEE_HEAD;
		$feehead14 = $feehead[13]->FEE_HEAD;
		$feehead15 = $feehead[14]->FEE_HEAD;
		$feehead16 = $feehead[15]->FEE_HEAD;
		$feehead17 = $feehead[16]->FEE_HEAD;
		$feehead18 = $feehead[17]->FEE_HEAD;
		$feehead19 = $feehead[18]->FEE_HEAD;
		$feehead20 = $feehead[19]->FEE_HEAD;
		$feehead21 = $feehead[20]->FEE_HEAD;
		$feehead22 = $feehead[21]->FEE_HEAD;
		$feehead23 = $feehead[22]->FEE_HEAD;
		$feehead24 = $feehead[23]->FEE_HEAD;
		$feehead25 = $feehead[24]->FEE_HEAD;
	}
	if($father_name)
	{
		$father_name;
	}
	else{
		$father_name = "N/A";
	}
	if($emp_ward){
		$emp_ward;
	}
	else{
		$emp_ward ="N/A";
	}
	IF($adm_data){
		$adm_data;
	}
	else{
		$adm_data = "N/A";
	}
	IF($adm_date){
		$adm_date;
	}
	else{
		$adm_date = "N/A";
	}

$count_length = strlen($PERIOD);
if ($count_length > 28) {
	$FIRSTEXP = explode(",", $PERIOD);
	$first = $FIRSTEXP[0];
	$middle = $FIRSTEXP[1];
	$last  = substr($PERIOD, -3);
	if ($first == 'PRE.DUES') {
		$FEE_FOR = $first . " " . $middle . " TO " . $last;
	} else {
		$FEE_FOR = $first . " TO " . $last;
	}
} else {
	$FEE_FOR = $PERIOD;
}
?>
<div id='hide_show'>
<div class="row">
	<div class='col-md-12 col-sm-12 col-xl-12 col-sm-12'>
		<div class='row'>
			<div class='col-sm-2 col-md-2 col-lg-2 col-xl-2'>
				<label>Receipt No:</label>
				<p><?php echo $RECT_NO; ?></p>
			</div>
			<div class='col-sm-2 col-md-2 col-lg-2 col-xl-2'>
				<label>Receipt Date:</label>
				<p><?php echo $rect_data; ?></p>
			</div>
			<div class='col-sm-2 col-md-2 col-lg-2 col-xl-2'>
				<label>Admission Date:</label>
				<p><?php echo $adm_data; ?></p>
			</div>
			<div class='col-sm-2 col-md-2 col-lg-2 col-xl-2'>
				<label>Student Id:</label>
				<p><?php echo $STUDENTID; ?></p>
			</div>
			<div class="col-sm-2 col-lg-2 col-md-2 col-xl-2">
				<label>Fee Book No:</label>
				<p><?php echo $TAmtFee_Book_No; ?></p>
			</div>
			<div class='col-sm-2 col-md-2 col-lg-2 col-xl-2'>
				<label>Duplicate Bill Issue:</label>
				<p><?php echo $TAmt; ?></p>
			</div>
			<div class='col-sm-2 col-md-2 col-lg-2 col-xl-2'>
				<label>Admission No:</label>
				<p><?php echo $ADM_NO; ?></p>
			</div>
			<div class='col-sm-4 col-md-4 col-lg-4 col-xl-4'>
				<label>Student Name:</label>
				<p><?php echo $STU_NAME; ?></p>
			</div>
			<div class='col-sm-4 col-md-4 col-lg-4 col-xl-4'>
				<label>Father Name:</label>
				<p><?php echo $father_name; ?></p>
			</div>
			<div class='col-sm-2 col-md-2 col-lg-2 col-xl-2'>
				<label>Ward Type:</label>
				<p><?php echo $emp_ward; ?></p>
			</div>
			<div class='col-sm-2 col-md-2 col-lg-2 col-xl-2'>
				<label>Class:</label>
				<p><?php echo $CLASS; ?></p>
			</div>
			<div class='col-sm-2 col-md-2 col-lg-2 col-xl-2'>
				<label>Sec:</label>
				<p><?php echo $SEC; ?></p>
			</div>
			<div class='col-sm-2 col-md-2 col-lg-2 col-xl-2'>
				<label>Roll:</label>
				<p><?php echo $ROLL_NO; ?></p>
			</div>
			<div class='col-sm-2 col-md-2 col-lg-2 col-xl-2'>
				<label>Cheque No:</label>
				<p><?php echo $CHQ_NO; ?></p>
			</div>
			<div class='col-sm-2 col-md-2 col-lg-2 col-xl-2'>
				<label>Fee For Month:</label>
				<p><?php echo $FEE_FOR; ?></p>
			</div>
			<div class='col-sm-2 col-md-2 col-lg-2 col-xl-2'>
				<label>Payment Mode:</label>
				<p><?php echo $Payment_Mode; ?></p>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4 col-sm-4 col-xl-4 col-lg-4">
		<form action="<?php echo base_url('Cancel_reprint/duplicate_copy'); ?>" method="POST">
			<input type="hidden" name="rect_no" id="rect_no" value="<?php echo $RECT_NO; ?>">
			<?php
				if($PERIOD!="CANCELLED"){
					?>
					<center><button class="btn btn-success">Duplicate Receipt</button></center>
					<?php
				}
			?>
			
		</form>
	</div>
	<div class="col-md-4 col-sm-4 col-xl-4 col-lg-4">
		<?php
				if($PERIOD!="CANCELLED"){
					?>
					<center><button class="btn btn-success" onclick="cancel_rect()">Cancel Receipt</button></center>
					<?php
				}
			?>
		
	</div>
	<div class="col-md-4 col-sm-4 col-xl-4 col-lg-4">
		<center><button class="btn btn-success" onclick="reset()">Reset</button></center>
	</div>
</div><br />
	<div class="row">
	    		<?php
	    		  if($feehead1!="" && $feehead1!="-")
	    		  {
	    		  	?>
	    		  	  <div class="col-md-3 form-group">
	    			  <label><?php echo $feehead1; ?></label>
	    			  <p><?php echo $Fee1; ?></p>
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
	    		 	<div class="col-md-3 form-group">
	    				<label><?php echo $feehead2; ?></label>
	    				<p><?php echo $Fee2; ?></p>
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
	    		  	 <div class="col-md-3 form-group">
	    				<label><?php echo $feehead3; ?></label>
	    				<p><?php echo $Fee3; ?></p>
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
	    		  	 <div class="col-md-3 form-group">
	    		  	 	<label><?php echo $feehead4; ?></label>
	    		  	 	<p><?php echo $Fee4; ?></p>
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
	    		  	<div class="col-md-3 form-group">
	    		  		<label><?php echo $feehead5; ?></label>
	    		  		<p><?php echo $Fee5; ?></p>
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
	    		  	 <div class="col-md-3 form-group">
	    		  	 	<label><?php echo $feehead6; ?></label>
	    		  	 	<p><?php echo $Fee6; ?></p>
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
	    		  	 <div class="col-md-3 form-group">
	    		  	 	<label><?php echo $feehead7; ?></label>
	    		  	 	<p><?php echo $Fee7; ?></p>
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
	    		 	<div class="col-md-3 form-group">
	    		 		<label><?php echo $feehead8; ?></label>
	    		 	   <p><?php echo $Fee8; ?></p>
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
	    		 	<div class="col-md-3 form-group">
	    		 		<label><?php echo $feehead9; ?></label>
	    		 		<p><?php echo $Fee9; ?></p>
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
	    		  	 <div class="col-md-3 form-group">
	    		  	 	<label><?php echo $feehead10; ?></label>
	    		  	 	<p><?php echo $Fee10; ?></p>
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
	  			 	<div class="col-md-3 form-group">
	  			 		<label><?php echo $feehead11; ?></label>
	  			 		<p><?php echo $Fee11; ?></p>
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
	  			 	 <div class="col-md-3 form-group">
	  			 	 	<label><?php echo $feehead12; ?></label>
	  			 	 	<p><?php echo $Fee12; ?></p>
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
	  			  		<div class="col-md-3 form-group">
	  			  			<label><?php echo $feehead13; ?></label>
	  			  			<p><?php echo $Fee13; ?></p>
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
	  			  	 <div class="col-md-3 form-group">
	  			  	 	<label><?php echo $feehead14; ?></label>
	  			  	 	<p><?php echo $Fee14; ?></p>
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
	  			  	<div class="col-md-3 form-group">
	  			  		<label><?php echo $feehead15; ?></label>
	  			  		<p><?php echo $Fee15; ?></p>
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
	  			 	 <div class="col-md-3 form-group">
	  			 	 	<label><?php echo $feehead16; ?></label>
	  			 	 	<p><?php echo $Fee16; ?></p>
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
	  			 	<div class="col-md-3 form-group">
	  			 		<label><?php echo $feehead17; ?></label>
	  			 		<p><?php echo $Fee17; ?></p>
	  			 	</div>
	  			 	<?php
	  			 }
	  			 else
	  			 {

	  			 }
	  			?>
	  			<?php
	  			 if ($feehead18!="" && $feehead18!="=-") 
	  			 {
	  			 	
	  			 	?>
	  			 	<div class="col-md-3 form-group">
	  			 		<label><?php echo $feehead18; ?></label>
	  			 		<p><?php echo $Fee18; ?></p>
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
	  			  	 <div class="col-md-3 form-group">
	  			  	 	<label><?php echo $feehead19; ?></label>
	  			  	 	<p><?php echo $Fee19; ?></p>
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
	  					 <div class="col-md-3 form-group">
	  					 	<label><?php echo $feehead20; ?></label>
	  					 	<p><?php echo $Fee20; ?></p>
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
	  			  	 <div class="col-md-3 form-group">
	  			  	 	<label><?php echo $feehead21; ?></label>
	  			  	 	<p><?php echo $Fee21; ?></p>
	  			  	 </div>
	  			  	<?php
	  			  }
	  			  else{

	  			  } 
	  			?>
	  			<?php
	  			 if($feehead22!="" && $feehead22!="-")
	  			 {
	  			 	?>
	  			 	 <div class="col-md-3 form-group">
	  			 	 	<label><?php echo $feehead22; ?></label>
	  			 	 	<p><?php echo $Fee22; ?></p>
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
	  			 	 <div class="col-md-3 form-group">
	  			 	 	<label><?php echo $feehead23; ?></label>
	  			 	 	<p><?php echo $Fee23; ?></p>
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
	  			  	 <div class="col-md-3 form-group">
	  			  	 	<label><?php echo $feehead24; ?></label>
	  			  	 	<p><?php echo $Fee24; ?></p>
	  			  	 </div>
	  			  	<?php
	  			  }
	  			?>
	  			<?php
	  			  if($feehead25!="" && $feehead25!="-")
	  			  {
	  			  	?>
	  			  	 <div class="col-md-3 form-group">
	  			  	 	<label><?php echo $feehead25; ?></label>
	  			  	 	<p><?php echo $Fee25; ?></p>
	  			  	 </div>
	  			  	<?php
	  			  }
	  			  else
	  			  {

	  			  }
	  			?>
	  			<div class="col-md-3">
	  				
	  			</div>
	  			<div class="col-md-3">
	  				
	  			</div>
	  			<div class="col-md-3">

	  			</div>
	    	</div>
	    	<div class="row">
	    		<div class="col-md-9">
	    			
	    		</div>
	    		<div class="col-md-3">
	    			<label>Total Amount</label>
	  				<p><?php echo $TOTAL; ?></p>
	    		</div>
	    	</div>
</div>
<script>
	function reset(){
		location.reload();
	}
	function cancel_rect(){
		var rect_no =$('#rect_no').val();
		if(rect_no!=""){
			$.ajax({
				url: "<?php echo base_url('Cancel_reprint/canelled'); ?>",
				type: "POST",
				data:{rect_no:rect_no},
				success:function(data){
					if(data == 1)
					{
						alert("Receipt Cancellation Successfull");
						$('#hide_show').hide(1000);
						
					}else{
						alert("Receipt Cancellation Faild");
					}
				},
			});
		}else{
			alert("Sorry No Data Found");
		}
	}
</script>
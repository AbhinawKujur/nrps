 <?php
 	if($master)
 	{
 		$CounterNo = $master[0]->CounterNo;
		$ReceiptNo = $master[0]->ReceiptNo;
		$add_reciptno = ($ReceiptNo+1);
		$length = strlen($ReceiptNo);
		if($length==1)
		{
			$reciptno =$CounterNo.'00000'.$ReceiptNo;
		}
		elseif ($length==2) {
			$reciptno =$CounterNo.'0000'.$ReceiptNo;
		}
		elseif ($length==3) {
			$reciptno =$CounterNo.'000'.$ReceiptNo;
		}
		elseif ($length==4) {
			$reciptno =$CounterNo.'00'.$ReceiptNo;
		}
		elseif ($length==5) {
			$reciptno =$CounterNo.'0'.$ReceiptNo;
		}
		else
		{
			$reciptno = $CounterNo.$ReceiptNo;
		}
 	}
 	if($feehead1)
		{
			$feehead1 = $feehead1[0]->FEE_HEAD;
		}
		if($feehead2)
		{
			$feehead2 = $feehead2[0]->FEE_HEAD;
		}
		if($feehead3)
		{
			$feehead3 = $feehead3[0]->FEE_HEAD;
		}
		if($feehead4)
		{
			$feehead4 = $feehead4[0]->FEE_HEAD;
		}
		if($feehead5)
		{
			$feehead5 = $feehead5[0]->FEE_HEAD;
		}
		if($feehead6)
		{
			$feehead6 = $feehead6[0]->FEE_HEAD;
		}
		if($feehead7)
		{
			$feehead7 = $feehead7[0]->FEE_HEAD;
		}
		if($feehead8)
		{
			$feehead8 = $feehead8[0]->FEE_HEAD;
		}
		if($feehead9)
		{
			$feehead9 = $feehead9[0]->FEE_HEAD;
		}
		if($feehead10)
		{
			$feehead10 = $feehead10[0]->FEE_HEAD;
		}
		if($feehead11)
		{
			$feehead11 = $feehead11[0]->FEE_HEAD;
		}
		if($feehead12)
		{
			$feehead12 = $feehead12[0]->FEE_HEAD;
		}
		if($feehead13)
		{
			$feehead13 = $feehead13[0]->FEE_HEAD;
		}
		if($feehead14)
		{
			$feehead14 = $feehead14[0]->FEE_HEAD;
		}
		if($feehead15)
		{
			$feehead15 = $feehead15[0]->FEE_HEAD;
		}
		if($feehead16)
		{
			$feehead16 = $feehead16[0]->FEE_HEAD;
		}
		if($feehead17)
		{
			$feehead17 = $feehead17[0]->FEE_HEAD;
		}
		if($feehead18)
		{
			$feehead18 = $feehead18[0]->FEE_HEAD;
		}
		if($feehead19)
		{
			$feehead19 = $feehead19[0]->FEE_HEAD;
		}
		if($feehead20)
		{
			$feehead20 = $feehead20[0]->FEE_HEAD;
		}
		if($feehead21)
		{
			$feehead21 = $feehead21[0]->FEE_HEAD;
		}
		if($feehead22)
		{
			$feehead22 = $feehead22[0]->FEE_HEAD;
		}
		if($feehead23)
		{
			$feehead23 = $feehead23[0]->FEE_HEAD;
		}
		if($feehead24)
		{
			$feehead24 = $feehead24[0]->FEE_HEAD;
		}
		if($feehead25)
		{
			$feehead25 = $feehead25[0]->FEE_HEAD;
		}
 ?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Miscellaneous Collection</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
	<form onsubmit="return validation()" action="<?php echo base_url('Fees_collection/misc_collection_data'); ?>" method="post">
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="row">
					<div class="col-xs-3 col-md-3 form-group">
						<label>Receipt No:</label>
						<input type="text" class="form-control" readonly name="rcpt_no" id="rcpt_no" value="<?php echo $reciptno; ?>">
					</div>
					<div class="col-md-3 col-xs-3 form-group">
						<label>Receipt Date:</label>
						<input type="text" class="form-control" name="rcpt_date" id="rcpt_date" readonly value="<?php echo date('d-m-y'); ?>">
					</div>
					<div class="col-md-3 col-xs-3 form-group">
						<label>Admission No:</label>
						<input list="browsers" onchange ="adm_function(this.value)" name="browser" class="form-control">
						  <datalist id="browsers">
							<?php
								foreach($adm as $admdata){
									?>
									<option value="<?php echo $admdata->ADM_NO; ?>">
									<?php
								}
							?>
						  </datalist>
					</div>
					<div class="col-md-3 col-xs-3 form-group">
						<label>Admission Date:</label>
						<input type="text" readonly name="adm_date" id="adm_date" class="form-control">
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-xs-3 form-group">
						<label>Student Name:</label>
						<input type="text" readonly name="std_name" id="std_name" class="form-control">
					</div>
					<div class="col-md-3 col-xs-3 form-group">
						<label>Student Id:</label>
						<input type="text" readonly name="std_id" id="std_id" class="form-control">
					</div>
					<div class="col-md-3 col-xs-3 form-group">
						<label>Father's Name:</label>
					    <input type="text" readonly name="father_name" id="father_name" class="form-control">
					</div>
					<div class="col-xs-3 col-md-3 form-group">
						<label>Ward Type:</label>
						<input type="text" readonly name="ward_type" id="ward_type" class="form-control">
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-xs-3 form-group">
						<label>Class/Sec:</label>
						<input type="text" readonly name="cs_type" id="cs_type" class="form-control">
					</div>
					<div class="col-md-3 col-xs-3 form-group">
						<label>Roll No:</label>
						<input type="text" readonly name="roll" id="roll" class="form-control">
					</div>
					<div class="col-md-3 col-xs-3 form-group">
						<label>Bus Stoppage:</label>
						<input type="text" readonly name="bus_stopage" id="bus_stopage" class="form-control">
					</div>
					<div class="col-md-3 col-xs-3 form-group">
						<label>Bus Amount:</label>
						<input type="text" readonly name="bus_amt" id="bus_amt" class="form-control">
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12">
							<div class="spinner-border text-primary"></div>
						</div>
					</div>
				</div>
				<div class="row" id="coll" style="display: none;">
					<div class="col-sm-12 col-md-12 form-group">
						<label>Collection Type:</label>
						<input type="text" autocomplete="off" name="collection_type" id="collection_type" class="form-control">
					</div>
				</div>
				<div class="row" id="showbutton" style="display: none;">
					<div class="col-sm-12 col-md-12">
						<center><p id="show_ledger_info" class="btn btn-success" onclick="show_ledger()">Show Ledger</p>&nbsp;<input type="reset" onclick="rst()" class="btn btn-success" name="reset" value="reset"></center>
					</div>
				</div>
			</div>
		</div>

		<div id="show_data" style="display: none;">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<label class="text-danger">Check If Collection Type Is One Month Fee</label>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-1 col-md-1 form-group">
					<input type="checkbox" name="apr" value="APR" id="apr">&nbsp;APR
				</div>
				<div class="col-sm-1 col-md-1 form-group">
					<input type="checkbox" name="may" value="MAY" id="apr">&nbsp;MAY
				</div>
				<div class="col-sm-1 col-md-1 form-group">
					<input type="checkbox" name="jun" value="JUN" id="jun">&nbsp;JUN
				</div>
				<div class="col-sm-1 col-md-1 form-group">
					<input type="checkbox" name="jul" value="JUL" id="JUL">&nbsp;JUL
				</div>
				<div class="col-sm-1 col-md-1 form-group">
					<input type="checkbox" name="aug" value="AUG" id="aug">&nbsp;AUG
				</div>
				<div class="col-sm-1 col-md-1 form-group">
					<input type="checkbox" name="sep" value="SEP" id="sep">&nbsp;SEP
				</div>
				<div class="col-sm-1 col-md-1 form-group">
					<input type="checkbox" name="oct" value="OCT" id="oct">&nbsp;OCT
				</div>
				<div class="col-sm-1 col-md-1 form-group">
					<input type="checkbox" name="nov" value="NOV" id="nov">&nbsp;NOV
				</div>
				<div class="col-sm-1 col-md-1 form-group">
					<input type="checkbox" name="dec" value="DEC" id="dec">&nbsp;DEC
				</div>
				<div class="col-sm-1 col-md-1 form-group">
					<input type="checkbox" name="jan" value="JAN" id="jan">&nbsp;JAN
				</div>
				<div class="col-sm-1 col-md-1 form-group">
					<input type="checkbox" name="feb" value="FEB" id="feb">&nbsp;FEB
				</div>
				<div class="col-sm-1 col-md-1 form-group">
					<input type="checkbox" name="mar" value="MAR" id="mar">&nbsp;MAR
				</div>
			</div><br/>
			<div class="row">
				<?php
	    		  if($feehead1!="" && $feehead1!="-")
	    		  {
	    		  	?>
	    		  	  <div class="col-md-3 form-group">
	    			  <label><?php echo $feehead1; ?></label>
	    			  <input type="text" name="feehead1" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead1" onchange="amtref()" class="form-control">
	    		      </div>
	    		 <?php
	    		  }
	    		  else
	    		  {
					  ?>
					<input type="hidden" name="feehead1" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead1" onchange="amtref()" class="form-control">
					<?php
	    		  }
	    		?>
	    		<?php
	    		 if($feehead2!="" && $feehead2!="-")
	    		 {
	    		 	?>
	    		 	<div class="col-md-3 form-group">
	    				<label><?php echo $feehead2; ?></label>
	    				<input type="text" name="feehead2" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead2" onchange="amtref()" class="form-control">
	    		    </div>
	    		 	<?php
	    		 } 
	    		 else
	    		 {
					?>
					<input type="hidden" name="feehead2" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead2" onchange="amtref()" class="form-control">
					<?php
	    		 }
	    		?>
	    		<?php
	    		  if($feehead3!="" && $feehead3!="-")
	    		  {
	    		  	?>
	    		  	 <div class="col-md-3 form-group">
	    				<label><?php echo $feehead3; ?></label>
	    				<input type="text" name="feehead3" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead3" onchange="amtref()" class="form-control">
	    		     </div>
	    		     <?php
	    		  } 
	    		  else
	    		  {
					?>
					<input type="hidden" name="feehead3" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead3" onchange="amtref()" class="form-control">
					<?php
	    		  }
	    		?>
	    		<?php
	    		  if($feehead4!="" && $feehead4!="-")
	    		  {
	    		  	?>
	    		  	 <div class="col-md-3 form-group">
	    		  	 	<label><?php echo $feehead4; ?></label>
	    		  	 	<input type="text" name="feehead4" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead4" onchange="amtref()" class="form-control">
	    		  	 </div>
	    		  	<?php
	    		  } 
	    		  else
	    		  {
					?>
					<input type="hidden" name="feehead4" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead4" onchange="amtref()" class="form-control">
					<?php
	    		  }
	    		?>
	    		<?php
	    		  if($feehead5!="" && $feehead5!="-")
	    		  {
	    		  	?>
	    		  	<div class="col-md-3 form-group">
	    		  		<label><?php echo $feehead5; ?></label>
	    		  		<input type="text" name="feehead5" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead5" onchange="amtref()" class="form-control">
	    		  	</div>
	    		  	<?php
	    		  }
	    		  else
	    		  {
					?>
					<input type="hidden" name="feehead5" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead5" onchange="amtref()" class="form-control">
					<?php
	    		  }
	    		?>
	    		<?php
	    		  if($feehead6!="" && $feehead6!="-")
	    		  {
	    		  	?>
	    		  	 <div class="col-md-3 form-group">
	    		  	 	<label><?php echo $feehead6; ?></label>
	    		  	 	<input type="text" name="feehead6" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead6" onchange="amtref()" class="form-control">
	    		  	 </div>
	    		  	<?php
	    		  } 
	    		  else
	    		  {
					?>
					<input type="hidden" name="feehead6" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead6" onchange="amtref()" class="form-control">
					<?php
	    		  }
	    		?>
	    		<?php
	    		  if($feehead7!="" && $feehead7!="-")
	    		  {
	    		  	?>
	    		  	 <div class="col-md-3 form-group">
	    		  	 	<label><?php echo $feehead7; ?></label>
	    		  	 	<input type="text" name="feehead7" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead7" onchange="amtref()" class="form-control">
	    		  	 </div>
	    		  	<?php
	    		  }
	    		  else
	    		  {
					?>
					<input type="hidden" name="feehead7" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead7" onchange="amtref()" class="form-control">
					<?php
	    		  }
	    		?>
	    		<?php
	    		 if($feehead8!="" && $feehead8!="-")
	    		 {
	    		 	?>
	    		 	<div class="col-md-3 form-group">
	    		 		<label><?php echo $feehead8; ?></label>
	    		 	    <input type="text" name="feehead8" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead8" onchange="amtref()" class="form-control">
	    		 	</div>
	    		 	<?php 
	    		 }
	    		 else
	    		 {
					?>
					<input type="hidden" name="feehead8" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead8" onchange="amtref()" class="form-control">
					<?php
	    		 }
	    		?>
	    		<?php
	    		 if($feehead9!="" && $feehead9!="-")
	    		 {
	    		 	?>
	    		 	<div class="col-md-3 form-group">
	    		 		<label><?php echo $feehead9; ?></label>
	    		 		<input type="text" name="feehead9" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead9" onchange="amtref()" class="form-control">
	    		 	</div>
	    		 	<?php
	    		 }
	    		 else
	    		 {
					?>
					<input type="hidden" name="feehead9" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead9" onchange="amtref()" class="form-control">
					<?php
	    		 }
	    		?>
	    		<?php
	    		  if($feehead10!="" && $feehead10!="-")
	    		  {
	    		  	?>
	    		  	 <div class="col-md-3 form-group">
	    		  	 	<label><?php echo $feehead10; ?></label>
	    		  	 	<input type="text" name="feehead10" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead10" onchange="amtref()" class="form-control">
	    		  	 </div>
	    		  	<?php
	    		  }
	    		  else
	    		  {
					?>
					<input type="hidden" name="feehead10" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead10" onchange="amtref()" class="form-control">
					<?php
	    		  }
	    		?>
	  			<?php
	  			 if($feehead11!="" && $feehead11!="-")
	  			 {
	  			 	?>
	  			 	<div class="col-md-3 form-group">
	  			 		<label><?php echo $feehead11; ?></label>
	  			 		<input type="text" name="feehead11" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead11" onchange="amtref()" class="form-control">
	  			 	</div>
	  			 	<?php
	  			 }
	  			 else
	  			 {
					?>
					<input type="hidden" name="feehead11" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead11" onchange="amtref()" class="form-control">
					<?php
	  			 }
	  			?>
	  			<?php
	  			 if($feehead12!="" && $feehead12!="-")
	  			 {
	  			 	?>
	  			 	 <div class="col-md-3 form-group">
	  			 	 	<label><?php echo $feehead12; ?></label>
	  			 	 	<input type="text" name="feehead12" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead12" onchange="amtref()" class="form-control">
	  			 	 </div>
	  			 	<?php
	  			 }
	  			 else
	  			 {
					?>
					<input type="hidden" name="feehead12" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead12" onchange="amtref()" class="form-control">
					<?php
	  			 }
	  			?>
	  			<?php
	  			  if($feehead13!="" && $feehead13!="-")
	  			  {
	  			  	?>
	  			  		<div class="col-md-3 form-group">
	  			  			<label><?php echo $feehead13; ?></label>
	  			  			<input type="text" name="feehead13" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead13" onchange="amtref()" class="form-control">
	  			  		</div>
	  			  	<?php
	  			  }
	  			  else
	  			  {
					?>
					<input type="hidden" name="feehead13" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead13" onchange="amtref()" class="form-control">
					<?php
	  			  }
	  			?>
	  			<?php
	  			  if($feehead14!="" && $feehead14!="-")
	  			  {
	  			  	?>
	  			  	 <div class="col-md-3 form-group">
	  			  	 	<label><?php echo $feehead14; ?></label>
	  			  	 	<input type="text" name="feehead14" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead14" onchange="amtref()" class="form-control">
	  			  	 </div>
	  			  	<?php
	  			  }
	  			  else
	  			  {
					?>
					<input type="hidden" name="feehead14" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead14" onchange="amtref()" class="form-control">
					<?php
	  			  }
	  			?>
	  			<?php
	  			  if($feehead15!="" && $feehead15!="-")
	  			  {
	  			  	?>
	  			  	<div class="col-md-3 form-group">
	  			  		<label><?php echo $feehead15; ?></label>
	  			  		<input type="text" name="feehead15" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead15" onchange="amtref()" class="form-control">
	  			  	</div>
	  			  	<?php
	  			  }
	  			  else
	  			  {
					?>
					<input type="hidden" name="feehead15" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead15" onchange="amtref()" class="form-control">
					<?php
	  			  }
	  			?>
	  			<?php
	  			 if($feehead16!="" && $feehead16!="-")
	  			 {
	  			 	?>
	  			 	 <div class="col-md-3 form-group">
	  			 	 	<label><?php echo $feehead16; ?></label>
	  			 	 	<input type="text" name="feehead16" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead16" onchange="amtref()" class="form-control">
	  			 	 </div>
	  			 	<?php
	  			 }
	  			 else
	  			 {
					?>
					<input type="hidden" name="feehead16" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead16" onchange="amtref()" class="form-control">
					<?php
	  			 }
	  			?>
	  			<?php
	  			 if($feehead17!="" && $feehead17!="-")
	  			 {
	  			 	?>
	  			 	<div class="col-md-3 form-group">
	  			 		<label><?php echo $feehead17; ?></label>
	  			 		<input type="text" name="feehead17" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead17" onchange="amtref()" class="form-control">
	  			 	</div>
	  			 	<?php
	  			 }
	  			 else
	  			 {
					?>
					<input type="hidden" name="feehead17" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead17" onchange="amtref()" class="form-control">
					<?php
	  			 }
	  			?>
	  			<?php
	  			 if ($feehead18!="" && $feehead18!="=-") 
	  			 {
	  			 	
	  			 	?>
	  			 	<div class="col-md-3 form-group">
	  			 		<label><?php echo $feehead18; ?></label>
	  			 		<input type="text" name="feehead18" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead18" onchange="amtref()" class="form-control">
	  			 	</div>
	  			 	<?php
	  			 }
	  			 else
	  			 {
					?>
					<input type="hidden" name="feehead18" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead18" onchange="amtref()" class="form-control">
					<?php
	  			 }
	  			?>
	  			<?php
	  			  if($feehead19!="" && $feehead19!="-")
	  			  {
	  			  	?>
	  			  	 <div class="col-md-3 form-group">
	  			  	 	<label><?php echo $feehead19; ?></label>
	  			  	 	<input type="text" name="feehead19" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead19" onchange="amtref()" class="form-control">
	  			  	 </div>
	  			  	<?php
	  			  }
	  			  else
	  			  {
					?>
					<input type="hidden" name="feehead19" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead19" onchange="amtref()" class="form-control">
					<?php
	  			  }
	  			?>
	  			<?php
	  				if($feehead20!="" && $feehead20!="-")
	  				{
	  					?>
	  					 <div class="col-md-3 form-group">
	  					 	<label><?php echo $feehead20; ?></label>
	  					 	<input type="text" name="feehead20" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead20" onchange="amtref()" class="form-control">
	  					 </div>
	  					<?php
	  				}
	  				else
	  				{
						?>
					<input type="hidden" name="feehead20" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead20" onchange="amtref()" class="form-control">
					<?php
	  				}
	  			?>
	  			<?php
	  			  if($feehead21!="" && $feehead21!="-")
	  			  {
	  			  	?>
	  			  	 <div class="col-md-3 form-group">
	  			  	 	<label><?php echo $feehead21; ?></label>
	  			  	 	<input type="text" name="feehead21" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead21" onchange="amtref()" class="form-control">
	  			  	 </div>
	  			  	<?php
	  			  }
	  			  else{
					?>
					<input type="hidden" name="feehead21" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead21" onchange="amtref()" class="form-control">
					<?php
	  			  } 
	  			?>
	  			<?php
	  			 if($feehead22!="" && $feehead22!="-")
	  			 {
	  			 	?>
	  			 	 <div class="col-md-3 form-group">
	  			 	 	<label><?php echo $feehead22; ?></label>
	  			 	 	<input type="text" name="feehead22" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead22" onchange="amtref()" class="form-control">
	  			 	 </div>
	  			 	<?php
	  			 }
	  			 else
	  			 {
					?>
					<input type="hidden" name="feehead22" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead22" onchange="amtref()" class="form-control">
					<?php
	  			 }
	  			?>
	  			<?php
	  			 if($feehead23!="" && $feehead23!="-")
	  			 {
	  			 	?>
	  			 	 <div class="col-md-3 form-group">
	  			 	 	<label><?php echo $feehead23; ?></label>
	  			 	 	<input type="text" name="feehead23" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead23" onchange="amtref()" class="form-control">
	  			 	 </div>
	  			 	<?php
	  			 }
	  			 else
	  			 {
					?>
					<input type="hidden" name="feehead23" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead23" onchange="amtref()" class="form-control">
					<?php
	  			 }
	  			?>
	  			<?php
	  			  if($feehead24!="" && $feehead24!="-")
	  			  {
	  			  	?>
	  			  	 <div class="col-md-3 form-group">
	  			  	 	<label><?php echo $feehead24; ?></label>
	  			  	 	<input type="text" name="feehead24" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead24" onchange="amtref()" class="form-control">
	  			  	 </div>
	  			  	<?php
	  			  }
				  else{
					  ?>
					<input type="hidden" name="feehead24" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead24" onchange="amtref()" class="form-control">
					<?php
				  }
	  			?>
	  			<?php
	  			  if($feehead25!="" && $feehead25!="-")
	  			  {
	  			  	?>
	  			  	 <div class="col-md-3 form-group">
	  			  	 	<label><?php echo $feehead25; ?></label>
	  			  	 	<input type="text" name="feehead25" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead25" onchange="amtref()" class="form-control">
	  			  	 </div>
	  			  	<?php
	  			  }
	  			  else
	  			  {
					?>
					<input type="hidden" name="feehead25" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead25" onchange="amtref()" class="form-control">
					<?php
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
	  				<input type="text" readonly style="text-align: right;" name="totalamount" id="totalamount" class="form-control">
	    		</div>
	    	</div>
	    </div>
	    <!--modal start -->
	     	<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background: #5785c3; color: #fff; font-weight: bold;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><CENTER>PAYMENT CONFIRMATION</CENTER></h4>
        </div>
        <div class="modal-body">
        	<div class="row">
        		<div class="form-group col-md-12">
        			<label>Net Payable Amount:</label>
        			<input type="text" style="text-align: right;" name="npa" id="npa" readonly class="form-control">
        		</div>
        	</div>
         <div class="row">
         	<div class="col-md-12 form-group">
         		<label>Payment Mode:<span id="payerror" class="span"></span></label>
         		<select onchange="payment_modee(this.value)" name="pay_mod" class="form-control" id="payment_type">
         			<option value="">Select Option</option>
         			<?php
         			  if($payment_mode)
         			  {
         			  	foreach($payment_mode as $pay_data)
         			  	{
         			  		?>
         			  		<option value="<?php echo $pay_data->payment_mode; ?>"><?php echo $pay_data->payment_mode; ?></option>
         			  		<?php
         			  	}
         			  }
         			?>
         		</select>
         	</div>
         </div>
         <div class="row" id="bank_details" style="display: none;">
         	<div class="col-md-12">
         		BANK DETAILS
         	</div>
         </div>
         <div class="row" style="display: none;" id="card_show">
         		<div class="col-md-12 form-group">
         			<label>Card Number:<span id="carderror" class="span"></span></label>
         			<input type="text" minlength="16" maxlength="16" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Enter Card Number" autocomplete="off" name="card_name" id="card_name" class="form-control">
         		</div>
         	</div>
         	<div class="row" style="display: none;" id="cheque_show">
         		<div class="col-md-12 form-group">
         			<label>Cheque Number: <span id="cheque" class="span"></span></label>
         			<input type="text" placeholder="Enter Cheque" autocomplete="off" name="chque_name" id="chque_name" class="form-control">
         		</div>
         	</div>
         <div class="row" style="display: none;" id="bank_show">
         		<div class="col-md-12 form-group">
         			<label>Bank Name:<span id="bankname" class="span"></span></label>
         			<select id="bank_name" name="bank_name" class="form-control">
         				<option value="">select bank</option>
         				<?php
         					if($bank)
         					{
         						foreach($bank as $bank_data)
         						{
         							?>
         							 <option value="<?php echo $bank_data->Bank_Name; ?>"><?php echo $bank_data->Bank_Name; ?></option>
         							<?php
         						}
         					}
         				?>
         			</select>
         		</div>
         </div>
         <div class="row" id="pay_date" style="display: none;">
         	<div class="form-group col-md-12">
         		<label>Payment Date: <span id="paydateerror" class="span"></span></label>
         		<input type="text" name="pd" id="pd" readonly value="<?php echo date('d-m-y'); ?>" class="form-control">
         	</div>
         </div>
         <div class="row" id="button" style="display: none;">
         	<div class="form-group col-md-12">
         		<center><input type="submit" name="submit" value="CONFIRM PAYMENT" class="btn btn-success"></center>
         	</div>
         </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
	    <!--modal end -->
	</form>



	<div class="row" id="show_p" style="display: none;">
	    <div class="col-md-12">
	    	<center><input type="submit" onclick="modal_validation()" name="submit" value="MAKE PAYMENT" class="btn btn-success"></center>
	   	</div>
	</div>

	<!-- The Modal -->
  <div class="modal fade" id="myleadger">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header" style="background: #5785c3; color: #fff; text-align: center;">
          <h4 class="modal-title">STUDENT LEDGER</h4>
          <!-- <button type="button" class="close" data-dismiss="modal">×</button> -->
        </div>
        <style type="text/css">
        	.table,#thead,tr,td,th
        	{
        		text-align: center;
        		color: #000!important;
        	}
        </style>
        <!-- Modal body -->
        <div class="modal-body">
          <div style="overflow: auto; height: 250px;">
          	<table class="table">
          		<thead id="thead">
          			<tr>
          				<th width="10%">SlNO.</th>
          				<th width="25%">Receipt NO</th>
          				<th width="30%">Receipt Date</th>
          				<th width="20%">Period</th>
          				<th width="15%">Total</th>
          			</tr>
          		</thead>
          		<tbody id="ledger_data">
          			
          		</tbody>
          </table>
          </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  

</div><br/>
<script src="jquery-3.3.1.min.js"></script>
<script type="text/javascript">
	function adm_function(val)
	{
		$.ajax({
			url:"<?php echo base_url('Fees_collection/miss_dataajax'); ?>",
			type:"POST",
			data:{val:val},
			success:function(data){
				if(data != '[]'){
					 var user = JSON.parse(data);
                    $("#adm_date").val(user[0].ADM_DATE);
					$("#std_name").val(user[0].FIRST_NM);
					$("#father_name").val(user[0].FATHER_NM);
					$("#bus_amt").val(user[0].AMT);
					$("#cs_type").val(user[0].DISP_CLASS+"-"+user[0].DISP_SEC);
					$("#std_id").val(user[0].STUDENTID);
					$("#ward_type").val(user[0].HOUSENAME);
					$("#roll").val(user[0].ROLL_NO);
					$("#bus_stopage").val(user[0].STOPPAGE);
					$("#show_data").slideDown(2000);
					$("#showbutton").slideDown(2000);
					$("#coll").slideDown(2000);
					$("#show_p").slideDown(2000);
				}else{
                     alert('Sorry ! No Data Found');
                     $("#adm_date").val("");
					$("#std_name").val("");
					$("#father_name").val("");
					$("#bus_amt").val("");
					$("#cs_type").val("");
					$("#std_id").val("");
					$("#ward_type").val("");
					$("#roll").val("");
					$("#bus_stopage").val("");
					$("#adm_no").val("");
					$("#show_data").slideUp(2000);
					$("#showbutton").slideUp(2000);
					$("#coll").slideUp(2000);
					$("#show_p").slideUp(2000);
				}
					
				}
		});
	}
	function rst()
	{
			$("#show_data").slideUp(2000);
			$("#showbutton").slideUp(2000);
			$("#coll").slideUp(2000);
			$("#show_p").slideUp(2000);
	}
	function amtref()
	 	{
	 		var feehead1 = parseFloat(document.getElementById('feehead1').value);
	 		var feehead2 = parseFloat(document.getElementById('feehead2').value);
	 		var feehead3 = parseFloat(document.getElementById('feehead3').value);
	 		var feehead4 = parseFloat(document.getElementById('feehead4').value);
	 		var feehead5 = parseFloat(document.getElementById('feehead5').value);
	 		var feehead6 = parseFloat(document.getElementById('feehead6').value);
	 		var feehead7 = parseFloat(document.getElementById('feehead7').value);
	 		var feehead8 = parseFloat(document.getElementById('feehead8').value);
	 		var feehead9 = parseFloat(document.getElementById('feehead9').value);
	 		var feehead10 = parseFloat(document.getElementById('feehead10').value);
	 		var feehead11 = parseFloat(document.getElementById('feehead11').value);
	 		var feehead12 = parseFloat(document.getElementById('feehead12').value);
	 		var feehead13 = parseFloat(document.getElementById('feehead13').value);
	 		var feehead14 = parseFloat(document.getElementById('feehead14').value);
	 		var feehead15 = parseFloat(document.getElementById('feehead15').value);
	 		var feehead16 = parseFloat(document.getElementById('feehead16').value);
	 		var feehead17 = parseFloat(document.getElementById('feehead17').value);
	 		var feehead18 = parseFloat(document.getElementById('feehead18').value);
	 		var feehead19 = parseFloat(document.getElementById('feehead19').value);
	 		var feehead20 = parseFloat(document.getElementById('feehead20').value);
	 		var feehead21 = parseFloat(document.getElementById('feehead21').value);
	 		var feehead22 = parseFloat(document.getElementById('feehead22').value);
	 		var feehead23 = parseFloat(document.getElementById('feehead23').value);
	 		var feehead24 = parseFloat(document.getElementById('feehead24').value);
	 		var feehead25 = parseFloat(document.getElementById('feehead25').value);
	 		var sum =(feehead1+feehead2+feehead3+feehead4+feehead5+feehead6+feehead7+feehead8+feehead9+feehead10+feehead11+feehead12+feehead13+feehead14+feehead15+feehead16+feehead17+feehead18+feehead19+feehead20+feehead21+feehead22+feehead23+feehead24+feehead25);
	 		$("#totalamount").val(sum);
	 		$("#npa").val(sum);
	 	}

	 	function modal_validation()
	 	{
	 		var feehead1 = $("#feehead1").val();
	 		var feehead2 = $("#feehead2").val();
	 		var feehead3 = $("#feehead3").val();
	 		var feehead4 = $("#feehead4").val();
	 		var feehead5 = $("#feehead5").val();
	 		var feehead6 = $("#feehead6").val();
	 		var feehead7 = $("#feehead7").val();
	 		var feehead8 = $("#feehead8").val();
	 		var feehead9 = $("#feehead9").val();
	 		var feehead10 = $("#feehead10").val();
	 		var feehead11 = $("#feehead11").val();
	 		var feehead12 = $("#feehead12").val();
	 		var feehead13 = $("#feehead13").val();
	 		var feehead14 = $("#feehead14").val();
	 		var feehead15 = $("#feehead15").val();
	 		var feehead16 = $("#feehead16").val();
	 		var feehead17 = $("#feehead17").val();
	 		var feehead18 = $("#feehead18").val();
	 		var feehead19 = $("#feehead19").val();
	 		var feehead20 = $("#feehead20").val();
	 		var feehead21 = $("#feehead21").val();
	 		var feehead22 = $("#feehead22").val();
	 		var feehead23 = $("#feehead23").val();
	 		var feehead24 = $("#feehead24").val();
	 		var feehead25 = $("#feehead25").val();
	 		var collection_type = $("#collection_type").val();

	 								if(collection_type!="")
	 								{
	 									if(feehead1>0 || feehead2>0 || feehead3>0 || feehead4>0 || feehead5>0 || feehead6>0 || feehead7>0 || feehead8>0 || feehead9>0 || feehead10>0 || feehead11>0 || feehead12>0 || feehead13>0 || feehead14>0 || feehead15>0 || feehead16>0 || feehead17>0 || feehead18>0 || feehead19>0 || feehead20>0 || feehead21>0 || feehead22>0 || feehead23>0 || feehead24>0 || feehead25>0)
	 								{
	 									if(feehead1!="" && feehead2!="" && feehead3!="" && feehead4!="" && feehead5!="" && feehead6!="" && feehead7!="" && feehead8!="" && feehead9!="" && feehead10!="" && feehead11!="" && feehead12!="" && feehead13!="" && feehead14!="" && feehead15!="" && feehead16!="" && feehead17!="" && feehead18!="" && feehead19!="" && feehead20!="" && feehead22!="" && feehead23!="" && feehead24!="" && feehead25!="")
	 									{
	 										 $("#myModal").modal();	
	 									}
	 									else
	 									{
	 										alert("Fee-Head Should Not Be Null Atleast content 0 value");
	 									}
	 								
	 								}
	 								else
	 								{
	 									alert("PLEASE FILL ANY ONE HEAD")
	 								}
	 								}
	 								else
	 								{
	 									alert("Please Enter Collection Type");
	 								}
	 								
	 							
	 		
	 	}
	 	function payment_modee(val)
	 	{
	 		if(val=='CASH')
	 		{
	 			$("#pay_date").show();
	 			$("#button").show();
	 			$("#bank_details").hide();
	 			$("#cheque_show").hide();
	 			$("#card_show").hide();
	 			$("#bank_show").hide();
	 		}
	 		else if(val=='CARD SWAP')
	 		{
	 			$("#bank_details").show();
	 			$("#cheque_show").hide();
	 			$("#pay_date").show();
	 			$("#card_show").show();
	 			$("#bank_show").show();
	 			$("#button").show();
	 		}
	 		else if(val=="CHEQUE")
	 		{
	 			$("#bank_details").show();
	 			$("#card_show").hide();
	 			$("#pay_date").show();
	 			$("#cheque_show").show();
	 			$("#bank_show").show();
	 			$("#button").show();
	 		}
	 		else
	 		{
	 			$("#bank_details").hide();
	 			$("#card_show").hide();
	 			$("#bank_show").hide();
	 			$("#cheque_show").hide();
	 			$("#card_deatis").hide();
	 			$("#pay_date").hide();
	 			$("#button").hide();
	 		}
	 	}

	 	function  validation()
	 	{
	 		var feehead1 = $("#feehead1").val();
	 		var feehead2 = $("#feehead2").val();
	 		var feehead3 = $("#feehead3").val();
	 		var feehead4 = $("#feehead4").val();
	 		var feehead5 = $("#feehead5").val();
	 		var feehead6 = $("#feehead6").val();
	 		var feehead7 = $("#feehead7").val();
	 		var feehead8 = $("#feehead8").val();
	 		var feehead9 = $("#feehead9").val();
	 		var feehead10 = $("#feehead10").val();
	 		var feehead11 = $("#feehead11").val();
	 		var feehead12 = $("#feehead12").val();
	 		var feehead13 = $("#feehead13").val();
	 		var feehead14 = $("#feehead14").val();
	 		var feehead15 = $("#feehead15").val();
	 		var feehead16 = $("#feehead16").val();
	 		var feehead17 = $("#feehead17").val();
	 		var feehead18 = $("#feehead18").val();
	 		var feehead19 = $("#feehead19").val();
	 		var feehead20 = $("#feehead20").val();
	 		var feehead21 = $("#feehead21").val();
	 		var feehead22 = $("#feehead22").val();
	 		var feehead23 = $("#feehead23").val();
	 		var feehead24 = $("#feehead24").val();
	 		var feehead25 = $("#feehead25").val();

	 		if(feehead1>0 || feehead2>0 || feehead3>0 || feehead4>0 || feehead5>0 || feehead6>0 || feehead7>0 || feehead8>0 || feehead9>0 || feehead10>0 || feehead11>0 || feehead12>0 || feehead13>0 || feehead14>0 || feehead15>0 || feehead16>0 || feehead17>0 || feehead18>0 || feehead19>0 || feehead20>0 || feehead21>0 || feehead22>0 || feehead23>0 || feehead24>0 || feehead25>0)
	 		{

	 		}
	 		else
	 		{
	 			return false;
	 			alert("Please Enter Amount In One HEAD");

	 		}
	 	}

	 	function show_ledger()
	 	{
	 		$("#show_ledger_info").prop("disabled",true);
	 		var adm = $("#adm_no").val();
	 		$.ajax({
	 			url:"<?php echo base_url('Fees_collection/showledger_misc'); ?>",
	 			type:"POST",
	 			data:{adm:adm},
	 			success:function(data)
	 			{
	 				if(data!="[]")
	 				{
	 					var html = "";
	 					var user = JSON.parse(data);
	 					var i=1;
	 					for(var count=0; count < user.length; count++)
	 					{
		 					html+="<tr>";
		 					html+="<td>"+i+"</td>"
		 					html+="<td>"+user[count].RECT_NO+"</td>";
		 					html+="<td>"+user[count].RECT_DATE+"</td>";
		 					html+="<td>"+user[count].PERIOD+"</td>";
		 					html+="<td>"+user[count].TOTAL+"</td></tr>";
		 					i++;
	 					}
	 					$("#show_ledger_info").prop("disabled",false);
	 					$("#myleadger").modal();
	 					$('#ledger_data').html(html);
	 				}
	 				else
	 				{
	 					var html ="";
	 					html+="<tr>";
	 					html+="<td colspan='5'><h3>No Data Found</h3></td>";
	 					html+="</tr>";
	 					$("#myleadger").modal();
	 					$('#ledger_data').html(html);
	 				}
	 				
	 			}

	 		});
	 	}

</script>
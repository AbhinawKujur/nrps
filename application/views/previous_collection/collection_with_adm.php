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
 }
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Collection Without Admission</a> <i class="fa fa-angle-right"></i></li>
</ol>
    <div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
    	<form onsubmit="return validation()" action="<?php echo base_url('Fees_collection/collection_without_adm_save'); ?>" method="POST">
	    	 <div class="row">
	    		<div class="col-md-4 form-group">
	    			<label>Receipt No<span id="recpterror"></span></label>
	    			<input type="text" readonly name="recptno" id="recptno" class="form-control" value="<?php echo $reciptno;  ?>">
	    		</div>
	    		<div class="col-md-4 form-group">
	    			<label>Receipt Date<span id="rd" class="span"></span></label>
	    			<input type="text" name="recpitdate" readonly value="<?php echo date('d-m-y'); ?>" id="recpitedate" class="form-control">
	    		</div>
	    		<div class="col-md-4 form-group">
	    			<label>Form No<span id='fn' class="span"></span></label>
	    			<input type="text" name="formno" autocomplete="off" id="formno" placeholder="Enter Form No" class="form-control">
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="col-md-4 form-group">
	    			<label>Student Name<span id="sn" class="span"></span></label>
	    			<input type="text" name="stdname" placeholder="Enter Student Name" id="stdname" class="form-control">
	    		</div>
	    		<div class="col-md-4 form-group">
	    			<label>Class<span id="cls" class="span"></span></label>
	    			<select id="classes" name="class" class="form-control">
	    				<option value="">select class</option>
	    				<?php
	    					if($class)
	    					{
	    						foreach ($class as $class_data)
	    						{
	    							?>
	    							<option value="<?php echo $class_data->CLASS_NM; ?>"><?php echo $class_data->CLASS_NM; ?></option>
	    							<?php
	    						}
	    					}
	    				?>
	    			</select>
	    		</div>
	    		<div class="col-md-4 form-group">
	    			<label>Collection Type<span id="ct" class="span"></span></label>
	    			<input type="text" placeholder="Collection Type" name="collection_type" id="collection_type" class="form-control">
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="col-md-12">
	    		  <h3>Fee-Head Amount Details</h3>
	    		  <hr style="border: .5px solid black;">
	    	    </div>
	    	</div>
	    	
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
	    		
    	</form>
    	<div class="row">
	    		<div class="col-md-12">
	    			<center><input type="submit" onclick="modal_validation()" name="submit" value="MAKE PAYMENT" class="btn btn-success">&nbsp;<!-- <input type="reset" name="reset" value="reset" class="btn btn-success"> --></center>
	    		</div>
	    	</div>	
	</div><br />
	 <div class="clearfix"></div>

	 <script>
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
	 		var recpt = $("#recptno").val();
	 		var recpitedate = $("#recpitedate").val();
	 		var formno = $("#formno").val();
	 		var stdname = $("#stdname").val();
	 		var classs = $("#classes").val();
	 		var ct = $("#collection_type").val();
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

	 		if(recpt!="")
	 		{
	 			if(recpitedate!="")
	 			{
	 				document.getElementById('rd').innerHTML="";
	 				if(formno!="")
	 				{
	 					document.getElementById('fn').innerHTML="";
	 					if(stdname!="")
	 					{
	 						document.getElementById('sn').innerHTML="";
	 						if (classs!="")
	 						{
	 							document.getElementById('cls').innerHTML="";
	 							if(ct!="")
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
	 								document.body.scrollTop=0;
	 								document.documentElement.scrollTop=0;
	 								document.getElementById('ct').innerHTML=" * Please Enter";	
	 							}
	 						}
	 						else
	 						{
	 							document.body.scrollTop=0;
	 							document.documentElement.scrollTop=0;
	 							document.getElementById('cls').innerHTML=" * Please Select Class";
	 						}
	 					}
	 					else
	 					{
	 						document.body.scrollTop = 0;
                			document.documentElement.scrollTop = 0;
	 						document.getElementById('sn').innerHTML=" * Please Fill"
	 					}
	 				}
	 				else
	 				{
	 					document.body.scrollTop = 0;
                        document.documentElement.scrollTop = 0;
	 					document.getElementById('fn').innerHTML=" * Please Fill";
	 				}
	 			}
	 			else
	 			{
	 				document.body.scrollTop = 0;
                    document.documentElement.scrollTop = 0;
	 				document.getElementById('rd').innerHTML=" * Please Fill";
	 			}
	 		}
	 		else
	 		{
	 			document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
	 			document.getElementById("#recpterror").innerHTML=" * Please Fill";
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
	 	function zero(val)
	 	{
	 		if(val == ''){
				$("#feehead8").val('0');
			}
	 	}
	 </script>
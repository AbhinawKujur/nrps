<?php
	if($school_setting)
	{
		$school_logo = $school_setting[0]->SCHOOL_LOGO;
		$school_name = $school_setting[0]->School_Name;
		$school_add  = $school_setting[0]->School_Address;
		$school_aff  = $school_setting[0]->School_AfftNo;
		$school_email = $school_setting[0]->School_Email;
		$school_phone = $school_setting[0]->School_PhoneNo;
		$school_mobile = $school_setting[0]->School_MobileNo;
		$school_web = $school_setting[0]->School_Webaddress;
	}
	if($receipt_details)
	{
		$RECT_NO = $receipt_details[0]->RECT_NO;
		$RECT_DATE = $receipt_details[0]->RECT_DATE;
		$STU_NAME = $receipt_details[0]->STU_NAME;
		$CLASS = $receipt_details[0]->CLASS;
		$Payment_Mode = $receipt_details[0]->Payment_Mode;
		$PERIOD = $receipt_details[0]->PERIOD;
		$FORM_NO = $receipt_details[0]->FORM_NO;
		$TOTAL = $receipt_details[0]->TOTAL;
		$Fee1 = $receipt_details[0]->Fee1;
		$Fee2 = $receipt_details[0]->Fee2;
		$Fee3 = $receipt_details[0]->Fee3;
		$Fee4 = $receipt_details[0]->Fee4;
		$Fee5 = $receipt_details[0]->Fee5;
		$Fee6 = $receipt_details[0]->Fee6;
		$Fee7 = $receipt_details[0]->Fee7;
		$Fee8 = $receipt_details[0]->Fee8;
		$Fee9 = $receipt_details[0]->Fee9;
		$Fee10 = $receipt_details[0]->Fee10;
		$Fee11 = $receipt_details[0]->Fee11;
		$Fee12 = $receipt_details[0]->Fee12;
		$Fee13 = $receipt_details[0]->Fee13;
		$Fee14 = $receipt_details[0]->Fee14;
		$Fee15 = $receipt_details[0]->Fee15;
		$Fee16 = $receipt_details[0]->Fee16;
		$Fee17 = $receipt_details[0]->Fee17;
		$Fee18 = $receipt_details[0]->Fee18;
		$Fee19 = $receipt_details[0]->Fee19;
		$Fee20 = $receipt_details[0]->Fee20;
		$Fee21 = $receipt_details[0]->Fee21;
		$Fee22 = $receipt_details[0]->Fee22;
		$Fee23 = $receipt_details[0]->Fee23;
		$Fee24 = $receipt_details[0]->Fee24;
		$Fee25 = $receipt_details[0]->Fee25;
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

		$Date = explode("-",$RECT_DATE);
		$yy = $Date[0];
		$mm = $Date[1];
		$dd = $Date[2];
		$date_format = $dd."-".$mm."-".$yy;
?>
<!DOCTYPE html>
<html>
<head>
	<title>report</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style type="text/css">
    	body
    	{
    		padding:0px;
    		margin: 0px;
    	}
    	.header
    	{
    		margin-left: 74px;
    		margin-top: -75px;
    	}
    	.add
    	{
    		font-size: 9px;
    		padding-top: -19px;
    	}
    	.hadd
    	{
    		font-size: 12px;
    	}
    	.tel-web
    	{
    		font-size: 10px;
    		padding-top: -17px; 
    	}
    	.webemail
    	{
    		font-size: 10px;
    		padding-top: -21px;
    	}
    	.office_copy
    	{
    		font-size: 10px;
    		padding-top: -19px;
    	}
    	.toffice_copy
    	{
    		padding-top: -17px;
    		padding-left: 5px;
    	}
    	table tr td
    	{
    		font-size: 10px;
    		padding: 0px;
    	}
    </style>
</head>
<body>
	<div style=" width: 49%; float: left; margin-top: -20px; margin-right: -15px;">
		<img class="image" src="<?php echo $school_logo; ?>" style="height: 73px; width:70px;" style="float: left;">
		<div class="header">
			<p class="hadd"><b><?php echo $school_name; ?></b></p>
			<p class="add"><?php echo $school_add; ?></p>
			<p class="tel-web">Tel:<?php echo $school_phone; ?> , Affln No: <?php echo $school_aff; ?></p>
			<p class="webemail">Website: <?php echo $school_web; ?> <br> Email: <?php echo $school_email; ?></p>
			<p class="office_copy">FEE-RECEIPT(OFFICE COPY)</p>
		</div>
		<table width="100%" border="1" class="toffice_copy">
			<tr>
				<td colspan="3">
					<table width="100%" style="padding-left: 5px;">
						<tr>
							<td><b>Receipt No :</b></td>
							<td><b><?php echo $RECT_NO; ?></b></td>
							<td><b>Receipt Date :</b></td>
							<td><b><?php echo $date_format; ?></b></td>
						</tr>
						<tr>
							<td><b>Student Name:</b></td>
							<td colspan="3"><b><?php echo $STU_NAME; ?></b></td>
						</tr>
						<tr>
							<td><b>Class/sec:</b></td>
							<td><b><?php echo $CLASS; ?></b></td>
							<td><b>Payment Mode :</b></td>
							<td><b><?php echo $Payment_Mode; ?></b></td>
						</tr>
						<tr>
							<td><b>Fee For:</b></td>
							<td><b><?php echo $PERIOD; ?></b></td>
							<td><b>Form No :</b></td>
							<td><b><?php echo $FORM_NO; ?></b></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="padding: 0px;"><center><b>Sl.No</b></center></td>
				<td width="70%"><center><b>Description</b></center></td>
				<td width="20%"><center><b>Amount</b></center></td>
			</tr>
			<tr>
				<td>
					<table width="100%" style="text-align: center;">
						<?php
							$i=1;
						  if($Fee1>0)
						  {
						  	?>
						  	 <tr>
							   <td><?php echo $i; ?></td>
						     </tr>
						  	<?php
						  	$i++;
						  	}
						  	else
						  	{
						  	}
						  
						?>
						<?php
							if($Fee2>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
							<?php
							if($Fee3>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee4>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee5>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee6>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee7>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee8>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee9>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee10>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee11>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee12>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee13>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee14>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee15>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee16>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee17>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee18>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee19>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee20>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee21>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee22>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
							<?php
							if($Fee23>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
							<?php
							if($Fee24>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
							<?php
							if($Fee25>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
						  if($Fee1>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee2>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee3>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee4>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee5>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee6>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee7>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee8>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee9>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee10>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee11>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee12>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee13>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee14>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee15>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee16>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee17>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee18>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee19>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
					</table>
				</td>
				<td>
					<table width="100%" style="padding-left: 5px;">
						<?php
						  if($Fee1>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead1; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee2>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead2; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee3>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead3; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee4>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead4; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee5>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead5; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee6>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead6; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee7>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead7; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee8>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead8; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee9>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead9; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee10>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead10; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee11>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead11; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee12>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead12; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee13>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead13; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee14>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead14; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee15>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead15; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee16>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead16; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee17>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead17; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee18>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead18; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee19>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead19; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee20>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead20; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee21>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead21; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee22>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead22; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee23>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead23; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee24>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead24; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee25>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead25; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee1>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee2>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee3>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee4>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee5>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee6>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee7>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee8>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee9>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee10>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee11>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee12>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee13>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee14>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee15>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee16>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee17>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee18>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee19>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
					</table>
				</td>
				<td>
					<table width="100%" style="text-align: right; padding: 2px;">
						<?php
						  if($Fee1>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee1.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {

						  }
						?>
						<?php
						  if($Fee2>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee2.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee3>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee3.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee4>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee4.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee5>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee5.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee6>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee6.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee7>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee7.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee8>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee8.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee9>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee9.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee10>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee10.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee11>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee11.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee12>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee12.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee13>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee13.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee14>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee14.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee15>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee15.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee16>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee16.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee17>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee17.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee18>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee18.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee19>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee19.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee20>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee20.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee21>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee21.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee22>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee22.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee23>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee23.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee24>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee24.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee25>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee25.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee1>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee2>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee3>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee4>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee5>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee6>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee7>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee8>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee9>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee10>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee11>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee12>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee13>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee14>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee15>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee16>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee17>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee18>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee19>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee20>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: right;"><b>Total Amount&nbsp;</b></td>
				<td style="font-weight: bold; text-align: right; padding: 2px;"><?php  echo $TOTAL.".00"; ?></td>
			</tr>
			<tr>
				<td colspan="2"><b><CENTER></CENTER></b></td>
				<td style="text-align: center; padding-top: 10px;"><center>Auth.sign</center></td>
			</tr>
		</table>
	</div>
	<div style="margin-top: -20px; margin-right: -18px; width: 49%; float: right;">
		<img class="image" src="<?php echo $school_logo; ?>" style="height: 73px; width:70px;" style="float: left;">
		<div class="header">
			<p class="hadd"><b><?php echo $school_name; ?></b></p>
			<p class="add"><?php echo $school_add; ?></p>
			<p class="tel-web">Tel:<?php echo $school_phone; ?> , Affln No: <?php echo $school_aff; ?></p>
			<p class="webemail">Website: <?php echo $school_web; ?> <br> Email: <?php echo $school_email; ?></p>
			<p class="office_copy">FEE-RECEIPT(PARENT'S COPY)</p>
		</div>
	</div>
	<table border="1" style="width: 50%; top: 5.5%; left: 53%; position: relative;">
			<tr>
				<td colspan="3">
					<table width="100%" style="padding-left: 5px;">
						<tr>
							<td><b>Receipt No :</b></td>
							<td><b><?php echo $RECT_NO; ?></b></td>
							<td><b>Receipt Date :</b></td>
							<td><b><?php echo $date_format; ?></b></td>
						</tr>
						<tr>
							<td><b>Student Name:</b></td>
							<td colspan="3"><b><?php echo $STU_NAME; ?></b></td>
						</tr>
						<tr>
							<td><b>Class/sec:</b></td>
							<td><b><?php echo $CLASS; ?></b></td>
							<td><b>Payment Mode :</b></td>
							<td><b><?php echo $Payment_Mode; ?></b></td>
						</tr>
						<tr>
							<td><b>Fee For:</b></td>
							<td><b><?php echo $PERIOD; ?></b></td>
							<td><b>Form No :</b></td>
							<td><b><?php echo $FORM_NO; ?></b></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td width="1%" style="font-weight: bold; text-align: center;">Sl No.</td>
				<td width="67%" style="font-weight: bold; text-align: center;">Description</td>
				<td style="font-weight: bold; text-align: center;">Amount</td>
			</tr>
			<tr>
				<td>
					<table width="100%" style="text-align: center;">
						<?php
							$i=1;
						  if($Fee1>0)
						  {
						  	?>
						  	 <tr>
							   <td><?php echo $i; ?></td>
						     </tr>
						  	<?php
						  	$i++;
						  	}
						  	else
						  	{
						  	}
						  
						?>
						<?php
							if($Fee2>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
							<?php
							if($Fee3>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee4>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee5>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee6>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee7>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee8>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee9>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee10>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee11>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee12>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee13>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee14>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee15>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee16>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee17>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee18>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee19>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee20>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee21>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
							if($Fee22>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
							<?php
							if($Fee23>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
							<?php
							if($Fee24>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
							<?php
							if($Fee25>0)
							{
								?>
								<tr>
							      <td><?php echo $i; ?></td>
						        </tr>
								<?php
								$i++;
							}
							else
							{
							}
						?>
						<?php
						  if($Fee1>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee2>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee3>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee4>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee5>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee6>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee7>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee8>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee9>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee10>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee11>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee12>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee13>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee14>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee15>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee16>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee17>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee18>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee19>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
					</table>
				</td>
				<td>
					<table width="100%" style="padding-left: 5px;">
						<?php
						  if($Fee1>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead1; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee2>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead2; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee3>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead3; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee4>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead4; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee5>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead5; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee6>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead6; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee7>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead7; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee8>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead8; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee9>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead9; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee10>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead10; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee11>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead11; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee12>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead12; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee13>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead13; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee14>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead14; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee15>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead15; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee16>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead16; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee17>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead17; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee18>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead18; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee19>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead19; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee20>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead20; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee21>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead21; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee22>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead22; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee23>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead23; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee24>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead24; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee25>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead25; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee1>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee2>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee3>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee4>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee5>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee6>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee7>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee8>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee9>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee10>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee11>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee12>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee13>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee14>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee15>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee16>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee17>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee18>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee19>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
					</table>
				</td>
				<td>
					<table width="100%" style="padding: 2px;">
						<?php
						  if($Fee1>0)
						  {
						  	?>
						  	<tr>
						  		<td style="text-align: right;"><?php echo $Fee1.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {

						  }
						?>
						<?php
						  if($Fee2>0)
						  {
						  	?>
						  	<tr>
						  		<td style="text-align: right;"><?php echo $Fee2.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee3>0)
						  {
						  	?>
						  	<tr>
						  		<td style="text-align: right;"><?php echo $Fee3.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee4>0)
						  {
						  	?>
						  	<tr>
						  		<td style="text-align: right;"><?php echo $Fee4.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee5>0)
						  {
						  	?>
						  	<tr>
						  		<td style="text-align: right;"><?php echo $Fee5.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee6>0)
						  {
						  	?>
						  	<tr>
						  		<td style="text-align: right;"><?php echo $Fee6.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee7>0)
						  {
						  	?>
						  	<tr>
						  		<td style="text-align: right;"><?php echo $Fee7.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee8>0)
						  {
						  	?>
						  	<tr>
						  		<td style="text-align: right;"><?php echo $Fee8.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee9>0)
						  {
						  	?>
						  	<tr>
						  		<td style="text-align: right;"><?php echo $Fee9.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee10>0)
						  {
						  	?>
						  	<tr>
						  		<td style="text-align: right;"><?php echo $Fee10.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee11>0)
						  {
						  	?>
						  	<tr>
						  		<td style="text-align: right;"><?php echo $Fee11.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee12>0)
						  {
						  	?>
						  	<tr>
						  		<td style="text-align: right;"><?php echo $Fee12.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee13>0)
						  {
						  	?>
						  	<tr>
						  		<td style="text-align: right;"><?php echo $Fee13.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee14>0)
						  {
						  	?>
						  	<tr>
						  		<td style="text-align: right;"><?php echo $Fee14.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee15>0)
						  {
						  	?>
						  	<tr>
						  		<td style="text-align: right;"><?php echo $Fee15.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee16>0)
						  {
						  	?>
						  	<tr>
						  		<td style="text-align: right;"><?php echo $Fee16.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee17>0)
						  {
						  	?>
						  	<tr>
						  		<td style="text-align: right;"><?php echo $Fee17.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee18>0)
						  {
						  	?>
						  	<tr>
						  		<td style="text-align: right;"><?php echo $Fee18.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee19>0)
						  {
						  	?>
						  	<tr>
						  		<td style="text-align: right;"><?php echo $Fee19.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee20>0)
						  {
						  	?>
						  	<tr>
						  		<td style="text-align: right;"><?php echo $Fee20.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee21>0)
						  {
						  	?>
						  	<tr>
						  		<td style="text-align: right;"><?php echo $Fee21.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee22>0)
						  {
						  	?>
						  	<tr>
						  		<td style="text-align: right;"><?php echo $Fee22.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee23>0)
						  {
						  	?>
						  	<tr>
						  		<td style="text-align: right;"><?php echo $Fee23.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee24>0)
						  {
						  	?>
						  	<tr>
						  		<td style="text-align: right;"><?php echo $Fee24.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee25>0)
						  {
						  	?>
						  	<tr>
						  		<td style="text-align: right;"><?php echo $Fee25.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee1>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee2>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee3>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee4>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee5>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee6>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee7>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee8>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee9>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee10>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee11>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee12>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee13>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee14>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee15>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee16>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee17>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee18>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee19>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee20>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: right; font-weight: bold;">Total Amount&nbsp;</td>
				<td style="font-weight: bold; text-align: right; padding: 2px;"><?php  echo $TOTAL.".00"; ?></td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td style="text-align: center; padding-top: 10px;">Auth.sign</td>
			</tr>
		</table>
</body>
</html>
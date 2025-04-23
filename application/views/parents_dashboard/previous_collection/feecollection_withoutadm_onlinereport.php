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
	
	$number = $TOTAL;
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
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
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
  $amtinword="Rupees ".$result . "Only" /* . $points . " Paise" */;
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
	<title>format2</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style type="text/css">
    	body
        #body
        {
            position: relative;
            top: 3px;
            margin: 10px;
        }
        .table_data
        {
            position: relative;
            top: -47px;
        }
    	{
    		padding: 0px;
    		margin: 0px;
    	}
    	#box1
    	{
    		width: 48%;
    		height: 10%;
    		
    		float: left;
    	}
    	#box2
    	{
    		float: right;
    		width: 48%;
    		
    	}
    	button
    	{
    		
    	}
    	img
    	{
    		float: left;
    	}
    	.table_heading
    	{
    		position: relative;
    		left: 9px;
    		top: -5px;
    		padding: 0px;
    		margin: 0px;
    	}
    	.heading
    	{
    		font-weight: bold;
    		font-size: 13px;
    	}
    	.address
    	{
    		position: relative;
    		top: -11px;
    		font-size: 13px;
    		/*left: -198px;*/
    	}
    	.telaff
    	{
    		font-size: 13px;
    		position: relative;
    		top: -22px;
    	}
    	.webemail
    	{
    		font-size: 13px;
    		position: relative;
    		top: -34px;
    	}
    	.feecopy
    	{
    		font-size: 14px;
    		position: relative;
    		top: -43px;
            left: 80px;
    	}
        #printing_button
        {
            position: relative;
            top: 10%;
        }
    	@page {
    		size: auto;   /* auto is the initial value */
    		margin-top: 6px;    /* this affects the margin in the printer settings */
    		margin-bottom: 0;
    		margin-right: 20px;
    		margin-left: 20px;
            display: none;
		}
        .table1 .tr1 .td1
        {
            font-weight: bold;
            padding:0px;
            font-size: 12px;
        }
        .table1
        {
            margin-left: 4px;
            margin-right: 2px;
        }
        .table_main,.tr_main,.td_main
        {
            text-align: center;
            font-size: 12px;
            font-weight: bold;
        }
        .fee_data
        {
        	font-size: 12px;
        }
    </style>
</head>
<body>
	<div id="body">
		<div id="box1">
			<img src="<?php echo base_url($school_logo); ?>" height="73px" width="78px;">
			<div class="table_heading">
				<span class="heading"><?php echo $school_name; ?></span><BR>
				<span class="address"><?php echo $school_add; ?></span><br>
				<span class="telaff">Tel No: <?php echo $school_phone; ?> ,</span><span class="telaff"> Affln No: <?php echo $school_aff; ?></span><br>
				<span class="webemail">Website: <?php echo $school_web; ?></span><!-- <span class="webemail"> Email: <?php //echo $school_email; ?></span> --><br>
				<span class="feecopy">FEE-RECEIPT(OFFICE COPY)</span>
			</div>
            <table class="table_data" width="100%" border="1" class="trable_main">
                <tr>
                    <td colspan="3">
                        <table width="100%" class="table1">
                            <tr class="tr1">
                                <td class="td1">Receipt No:</td>
                                <td class="td1"><?php echo $RECT_NO; ?></td>
                                <td class="td1">Receipt Date:</td>
                                <td class="td1"><?php echo $date_format; ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td1">Student Name:</td>
                                <td class="td1" colspan="3"><?php echo $STU_NAME; ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td1">Class/Sec:</td>
                                <td class="td1"><?php echo $CLASS; ?></td>
                                <td class="td1">Payment Mode:</td>
                                <td class="td1"><?php echo $Payment_Mode; ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td1">Fee For:</td>
                                <td class="td1"><?php echo $PERIOD; ?></td>
                                <td class="td1">Form No:</td>
                                <td class="td1"><?php echo $FORM_NO; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="tr_main">
                    <td width="2%" class="td_main">Sl.No</td>
                    <td class="td_main">Description</td>
                    <td width="22%" class="td_main">Amount (&#8377;)</td>
                </tr>
                <tr>
                    <td>
                    	<table width="100%" style="text-align: center; padding: 0px;">
                    		<?php
                    		  $i=1;
                    		   if($Fee1>0)
                    		   {
                    		   		?>
                    		   			<tr class="fee_data">
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    	</table>
                    </td>
                    <td>
                    	<table width="100%" style="padding-left: 5px;">
                    		<?php
						  if($Fee1>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead1; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee2>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead2; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee3>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead3; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee4>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead4; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee5>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead5; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee6>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead6; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee7>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead7; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee8>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead8; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee9>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead9; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee10>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead10; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee11>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead11; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee12>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead12; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee13>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead13; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee14>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead14; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee15>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead15; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee16>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead16; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee17>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead17; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee18>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead18; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee19>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead19; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee20>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead20; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee21>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead21; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee22>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead22; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee23>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead23; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee24>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead24; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee25>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead25; ?></td>
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
                    	</table>
                    </td>
                    <td>
                    	<table width="100%" style="text-align: right; padding: 2px;">
						<?php
						  if($Fee1>0)
						  {
						  	?>
						  	<tr>
						  		<td class="fee_data"><?php echo $Fee1.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee2.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee3.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee4.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee5.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee6.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee7.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee8.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee9.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee10.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee11.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee12.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee13.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee14.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee15.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee16.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee17.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee18.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee19.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee20.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee21.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee22.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee23.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee24.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee25.".00"; ?></td>
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
					</table>
                    </td>
                </tr>
                <tr class="tr_main">
                    <td colspan="2" class="td_main" style="text-align:right; padding-right:5px;">Total Amount</td>
                    <td class="td_main" style="text-align:right; padding-right:3px;"><?php echo $TOTAL.".00"; ?></td>
                </tr>
                <tr class="tr_main">
                    <td colspan="2" style='text-align:left;'><?php echo  $amtinword; ?></td>
                    <td style="padding-top:15px;">Auth.Sign</td>
                </tr>
            </table>
		</div>
		<div id="box2">
			<img src="<?php echo base_url($school_logo); ?>" height="73px" width="78px;">
			<div class="table_heading">
				<span class="heading"><?php echo $school_name; ?></span><BR>
				<span class="address"><?php echo $school_add; ?></span><br>
				<span class="telaff">Tel No: <?php echo $school_phone; ?> ,</span><span class="telaff"> Affln No: <?php echo $school_aff; ?></span><br>
				<span class="webemail">Website: <?php echo $school_web; ?></span><!-- <span class="webemail"> Email: <?php //echo $school_email; ?></span> --><br>
				<span class="feecopy">FEE-RECEIPT(PARENT'S COPY)</span>
			</div>
            <table class="table_data" width="100%" border="1" class="table_main">
                <tr>
                    <td colspan="3">
                        <table width="100%" class="table1">
                            <tr class="tr1">
                                <td class="td1">Receipt No:</td>
                                <td class="td1"><?php echo $RECT_NO; ?></td>
                                <td class="td1">Receipt Date:</td>
                                <td class="td1"><?php echo $date_format; ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td1">Student Name:</td>
                                <td class="td1" colspan="3"><?php echo $STU_NAME; ?></td>
                            </tr>
                             <tr class="tr1">
                                <td class="td1">Class/Sec:</td>
                                <td class="td1"><?php echo $CLASS; ?></td>
                                <td class="td1">Payment Mode:</td>
                                <td class="td1"><?php echo $Payment_Mode; ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td1">Fee For:</td>
                                <td class="td1"><?php echo $PERIOD; ?></td>
                                <td class="td1">Form No:</td>
                                <td class="td1"><?php echo $FORM_NO; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="tr_main">
                    <td width="2%" class="td_main">Sl.No</td>
                    <td class="td_main">Description</td>
                    <td width="22%" class="td_main">Amount (&#8377;)</td>
                </tr>
               <tr>
                    <td>
                    	<table width="100%" style="text-align: center; padding: 0px;">
                    		<?php
                    		  $i=1;
                    		   if($Fee1>0)
                    		   {
                    		   		?>
                    		   			<tr class="fee_data">
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    		   				<td class="fee_data"><?php echo $i; ?></td>
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
                    	</table>
                    </td>
                    <td>
                    	<table width="100%" style="padding-left: 5px;">
                    		<?php
						  if($Fee1>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead1; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee2>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead2; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee3>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead3; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee4>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead4; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee5>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead5; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee6>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead6; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee7>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead7; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee8>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead8; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee9>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead9; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee10>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead10; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee11>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead11; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee12>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead12; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee13>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead13; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee14>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead14; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee15>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead15; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee16>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead16; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee17>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead17; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee18>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead18; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee19>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead19; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee20>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead20; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee21>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead21; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee22>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead22; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee23>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead23; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee24>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead24; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee25>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td class="fee_data"><?php echo $feehead25; ?></td>
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
                    	</table>
                    </td>
                    <td>
                    	<table width="100%" style="text-align: right; padding: 2px;">
						<?php
						  if($Fee1>0)
						  {
						  	?>
						  	<tr>
						  		<td class="fee_data"><?php echo $Fee1.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee2.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee3.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee4.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee5.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee6.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee7.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee8.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee9.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee10.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee11.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee12.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee13.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee14.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee15.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee16.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee17.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee18.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee19.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee20.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee21.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee22.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee23.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee24.".00"; ?></td>
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
						  		<td class="fee_data"><?php echo $Fee25.".00"; ?></td>
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
					</table>
                    </td>
                </tr>
                <tr class="tr_main">
                    <td colspan="2" class="td_main" style="text-align:right; padding-right:5px;">Total Amount</td>
                    <td class="td_main" style="text-align:right; padding-right:3px;"><?php echo $TOTAL.".00"; ?></td>
                </tr>
                <tr class="tr_main">
                    <td colspan="2" style='text-align:left;'><?php echo  $amtinword; ?></td>
                    <td style="padding-top:15px;">Auth.Sign</td>
                </tr>
            </table>
		</div>
	</div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<div style="position: relative; margin-top: 50%; margin-left: 45%;">
		<button class="btn btn-primary" id="printing_button" onclick="printl()">Print</button>&nbsp;<a class="btn btn-danger" id="print_cancel" href="<?php echo base_url('Fees_collection/collection_without_adm/') ?>">BACK</a>
	</div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
    <script
  src="https://code.jquery.com/jquery-3.4.0.js"></script>
	<script type="text/javascript">
		function printl()
		{
			var printButton = document.getElementById("printing_button");
			var print_cancel = document.getElementById('print_cancel');
			print_cancel.style.visibility = 'hidden';
			printButton.style.visibility = 'hidden';
  			window.print();
  			printButton.style.visibility = 'visible';
  			print_cancel.style.visibility = 'visible';
		}
         $(document).ready(function() {
        /*function disableBack() { window.history.forward() }
        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }*/
        function preventBack(){window.history.forward();}
        setTimeout("preventBack()", 0);
        window.onunload=function(){null};
    });
	</script>
</body>
</html>
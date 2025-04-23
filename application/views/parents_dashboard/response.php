
<!DOCTYPE html>
<html>
<head>
	<title>Generated Receipt</title>
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
            top: 5px;
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
    		
    	}
    	#box2
    	{
    		float: right;
    		width: 48%;
    		
    	}
		#box3
    	{
    		width: 48%;
    		height: 10%;
    		
    		
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
    		top: 5px;
    		padding: 10px;
    		margin: 10px;
			line-height: 180%;
    	}
    	.heading
    	{
    		font-weight: bold;
    		font-size: 13px;
			line-height: 180%;
    	}
    	.address
    	{
    		position: relative;
    		top: -11px;
    		font-size: 13px;
			line-height: 180%;
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
            left: 40px;
    	}
		#sysbill{
			
			font-size:12px;
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
		
		<?php

	error_reporting(0);
	$workingKey='7F0876900816421A9BAC221F7FACE121';		//Working Key should be provided here.
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
	echo "<center>";

	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==3)	$order_status=$information[1];
	}

	
	/* else if($order_status==="Aborted")
	{
		echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
	
	}
	else if($order_status==="Failure")
	{
		echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
	}
	else
	{
		echo "<br>Security Error. Illegal access detected";
	
	} */

	//echo "<br><br>";

	//echo "<table cellspacing=4 cellpadding=4>";
	//for($i = 0; $i < $dataSize; $i++) 
	//{
		//$information=explode('=',$decryptValues[$i]);
	    	//echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
		
		 
	//}

	//echo "</table><br>";
	//echo "</center>";
    
   
?>
		
		<?php 
		$today_date = date('Y-m-d');
		$receipt_details = $this->dbcon->select('daycoll','*',"RECT_NO='$rect_no'");
		$student_details = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
		$stuu_name = $student_details[0]->FIRST_NM.''.$student_details[0]->MIDDLE_NM;
		$stu_admno = $student_details[0]->ADM_NO;
		$stu_class = $student_details[0]->DISP_CLASS;
		$stu_sec = $student_details[0]->DISP_SEC;
		$father_name = $student_details[0]->FATHER_NM;
		$mother_name = $student_details[0]->MOTHER_NM;
		
		$receipt_detailsss = $this->dbcon->select('online_transaction','*',"order_id='$orderr_id'");
		$RECT_NOO = $receipt_detailsss[0]->RECT_NO;
		$RECT_DATEE = $receipt_detailsss[0]->RECT_DATE;
		$PRR = $receipt_detailsss[0]->PERIOD;
		
		$RECT_NO = $receipt_details[0]->RECT_NO;
		$RECT_DATE = $receipt_details[0]->RECT_DATE;
		$STU_NAME = $receipt_details[0]->STU_NAME;
		$CLASS = $receipt_details[0]->CLASS;
        $SEC = $receipt_details[0]->SEC;
		$Payment_Mode = $receipt_details[0]->Payment_Mode;
		$PERIOD = $receipt_details[0]->PERIOD;
		$ADM_NO = $receipt_details[0]->ADM_NO;
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
		
		$count_length = strlen($PERIOD);
	IF($count_length > 28)
	{
		$FIRSTEXP = explode("-",$PERIOD);
		$first = $FIRSTEXP[0];
		$last  = substr($PERIOD,-3);
		$FEE_FOR = $first." TO ".$last;
	}
	ELSE
	{
		$FEE_FOR = $PERIOD;
	}
		
		$feehead1 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='1'");
		$feehead2 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='2'");
		$feehead3 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='3'");
		$feehead4 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='4'");
		$feehead5 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='5'");
		$feehead6 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='6'");
		$feehead7 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='7'");
		$feehead8 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='8'");
		$feehead9 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='9'");
		$feehead10 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='10'");
		$feehead11 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='11'");
		$feehead12 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='12'");
		$feehead13 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='13'");
		$feehead14 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='14'");
		$feehead15 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='15'");
		$feehead16 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='16'");
		$feehead17 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='17'");
		$feehead18 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='18'");
		$feehead19 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='19'");
		$feehead20 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='20'");
		$feehead21 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='21'");
		$feehead22 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='22'");
		$feehead23 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='23'");
		$feehead24 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='24'");
		$feehead25 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='25'");
		
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
		
		if($orderr_id == $order_id)
		{
		   if(($pay_amt == $amount)  AND ($order_status == "Success"))
		   {
		
		?> 
		       
			<div id="box1">
			<img src="<?php echo base_url($school_logo); ?>" height="73px" width="78px;">
			<div class="table_heading">
				<span class="heading"><?php echo $school_name; ?></span><br>
				<span class="address"><?php echo $school_add; ?></span><br>
				
				<span class="telaff">Tel No.: <?php echo $school_phone; ?> ,</span><span class="telaff"> Affln No.: <?php echo $school_aff; ?></span><br>
				
				<span class="webemail">Website: <?php echo $school_web; ?></span><!-- <span class="webemail"> Email: <?php echo $school_email; ?></span> --><br>
				
			</div>
            <table class="table_data" width="100%" border="1" class="trable_main">
                <tr>
                    <td colspan="3">
                        <table width="100%" class="table1">
                            <tr class="tr1">
                                <td class="td1">Receipt No.:</td>
                                <td class="td1"><?php echo $RECT_NO; ?></td>
                                <td class="td1">Receipt Date:</td>
                                <td class="td1"><?php echo date('d-M-Y',strtotime($RECT_DATE)); ?></td>
                            </tr>
							<tr class="tr1">
								<td class="td1">Adm No.:</td>
                                <td class="td1"><?php echo $ADM_NO; ?></td>
                                <td class="td1">Class/Sec:</td>
                                <td class="td1"><?php echo $CLASS."/".$SEC; ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td1">Student Name:</td>
                                <td class="td1" colspan="3"><?php echo $STU_NAME; ?></td>
                            </tr>
							<tr class="tr1">
                                <td class="td1">Father's Name:</td>
                                <td class="td1" colspan="3" ><?php echo $father_name; ?></td>
                            </tr>
							
                            <tr class="tr1">
                                <td class="td1">Fee For:</td>
                                <td class="td1"><?php echo $FEE_FOR; ?></td>
								<td class="td1">Payment Mode:</td>
                                <td class="td1"><?php echo $Payment_Mode; ?></td>
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
                    		   if($Fee13>0)
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
						</table>
						</td>
				</tr>			
                <tr class="tr_main">
                    <td colspan="2" class="td_main" style="text-align:right; padding-right:5px;">Total Amount (&#8377;)</td>
                    <td class="td_main" style="text-align:right; padding-right:3px;"><?php echo $TOTAL.".00"; ?></td>
                </tr>
                <tr class="tr_main">
                    <td colspan="2" style='text-align:left;'><?php echo $amtinword; ?></td>
                    <td style="padding-top:15px;"></td>
                </tr>
            </table>

		</div>
		
				  
			 <?php }
			  else
			  {
			
?>
				  <div id="box3">
			<img src="<?php echo base_url($school_logo); ?>" height="73px" width="78px;" float: right;>
			<div class="table_heading">
				<span class="heading"><?php echo $school_name; ?></span><BR>
				<span class="address"><?php echo $school_add; ?></span><br>
				<span class="telaff">Tel No: <?php echo $school_phone; ?> ,</span><span class="telaff"> Affln No: <?php echo $school_aff; ?></span><br>
				<span class="webemail">Website: <?php echo $school_web; ?></span><!-- <span class="webemail"> Email: <?php echo $school_email; ?></span> -->
				
			</div><br>
            <table class="table_data" width="100%" border="1" class="trable_main">
              
                <tr>
                    <td colspan="3">
                        <table width="100%" class="table1">
                            <tr class="tr1">
                                <td class="td1">Date:</td>
                                <td class="td1"><?php echo $today_date; ?></td>
                                
                            </tr>
							<tr class="tr1">
								<td class="td1">Adm No:</td>
                                <td class="td1"><?php echo $stu_admno; ?></td>
                                <td class="td1">Class/Sec:</td>
                                <td class="td1"><?php echo $stu_class."/".$stu_sec; ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td1">Student Name:</td>
                                <td class="td1" colspan="3"><?php echo $stuu_name; ?></td>
                            </tr>
							<tr class="tr1">
                                <td class="td1">Father Name:</td>
                                <td class="td1" colspan="3" ><?php echo $father_name; ?></td>
                            </tr>
							
                            <tr class="tr1">
                                <td class="td1">Fee For:</td>
                                <td class="td1"><?php echo $PRR; ?></td>
								<td class="td1">Payment Mode:</td>
                                <td class="td1"><?php echo 'ONLINE'; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                    	<table width="100%" style="text-align: center; padding: 0px;">
							<tr class="fee_data">
							<br><br><br>
								<td class="fee_data"><h4 style="color:red;">Your Transaction is Failed!!!!!!</h4></td>
								<br><br><br>
                    		</tr>
							
						</table>
					</td>
				</tr>			
                
            </table>
				
		</div>
			 <?php }
		   
		}
		else{
		   
		}
		?>
	</div>
	<br>
	<br>
	<br>
	<br>
	
	<div style="position: relative; margin-top: 50%; margin-left: 10%;">
		<button class="btn btn-primary" id="printing_button" onclick="printl()">PRINT</button>&nbsp;<a class="btn btn-danger" id="print_cancel" href="<?php echo base_url('Onparent_details/pay_details') ?>">BACK</a>
	</div>
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
<?php
	error_reporting(0);
	if($details_fetch){
		$Birth_Date = $details_fetch[0]->Birth_Date;
		$Birth_Date1 = date('d-M-Y',strtotime($Birth_Date));
	}
	
	if($total_paid)
	{
		$total_paid;
	}
	
   $number = $total_paid;
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
        $plural = (($counter = count($str)) && $number > 9) ?"": null;
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
  $amtinword="Rupees ".$result . "Only";
?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.0.js"></script>
	<style  media="print">
		body {
			marging: 0px !important;
			paddging : 0px !important;
		}
		#border{
			width:100%;
			height: 100%;
			padding : 5px 20px 0px 20px;
			border : solid 3px black;
		}
		#image{
			height : 100px;
			width : 100px;
			float : right;
		}
		#heading{
			float : right;
		}
		#content{
			border: solid 1px black;
			border-radius: 10px;
		}
		.text-content{
			text-align:right;
		}
		
		@page {
    		size: auto;   / auto is the initial value /
    		margin-top: -10px;    / this affects the margin in the printer settings /
    		margin-bottom: 0;
    		margin-right: 20px;
    		margin-left: 20px;
			size: landscape;
		}
		.f-s{
			font-size: 22px;
		}
		.st{
			text-align:center;
			font-weight: bold;
			font-style : italic;
		}
		.amt_inword{
			font-weight : bold;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
	 <div id="border">
		<div class="row">
			<div class="col-md-3 col-sm-3 col-lg-3">
				<img src="<?php echo base_url($school_setting[0]->SCHOOL_LOGO); ?>" id="image">
			</div>
			<div class="col-md-7 col-lg-7 col-sm-7">
				<center><h5><?php echo $school_setting[0]->School_Name; ?></h5></center>
				<center><h6><?php echo $school_setting[0]->School_Address; ?></h6></center>
				<center><h6>Affillated to CBSE,New Delhi (Aff No. :<?php echo $school_setting[0]->School_AfftNo; ?>, School Code: <?php echo $school_setting[0]->School_Code; ?>)</h6></center>
				<center><h6>Session (<?php echo $school_setting[0]->School_Session; ?>)</h6></center>
			</div>
			<div class="col-md-2 col-sm-2 col-lg-2">
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-sm-3 col-lg-3">
			</div>
			<div class="col-md-6 col-sm-6 col-lg-6">
				<div id="content"><center><b>TUITION FEE CERTIFICATE</b></center></div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3">
			</div>
		</div><br />
		<center><h3><u>TO WHOMSOEVER IT MAY CONCERN</u></h3></center>
		<table class="table">
			<tr>
				<td class="f-s"><center><i>This is to certify that <b><?php echo $F_NAME; ?></b> & <b><?php echo $M_Name; ?></b> have paid Tuition Fee for the study of their ward in our
school as per details given below:-</i></center></td>
			</tr>
		</table>
		<table width="100%" border="1">
						<tr>
							<td class="st" rowspan="2">Admission No.</td>
							<td class="st" rowspan="2">Ward Name</td>
							<td class="st" rowspan="2">Class</td>
							<td class="st" rowspan="2">Academic Session</td>
							<td class="st" rowspan="2">Tuition Fee</td>
							<td class="st" colspan="2">Period</td>
							<td class="st" rowspan="2">Total Tuition Fee Paid</td>
						</tr>
						<tr>
							<td class="st">From</td>
							<td class="st">To</td>
						</tr>
						<tr>
							<td class="st"><?php echo $ADM_NO; ?></td>
							<td class="st"><?php echo $S_NAME; ?></td>
							<td class="st"><?php echo $class_name."-".$sec; ?></td>
							<td class="st"><?php echo $session_year; ?></td>
							<td class="st"><?php echo $rate_of_tution; ?></td>
							<td class="st"><?php echo $fee_paid_from; ?></td>
							<td class="st"><?php echo $upto; ?></td>
							<td class="st"><?php echo $total_paid; ?></td>
						</tr>
					</table><br />
					<div class="row">
						<div class="col-md-12 col-sm-12 col-lg-12">
							<p class="amt_inword">Amount Paid (in words) : <?php echo $amtinword; ?>.</p>
						</div>
					</div><br /><br /><br /><br />
		<div class="row">
			<table width="100%">
				<tr>
					<td><center><b>Issue Date</b></center></td>
					<td><center><b>Dealing Clerk <br /> Signature</b></center></td>
					<td><center><b>Principal <br /> Signature</b></center></td>
				</tr>
			</table>
		</div>
	 </div><br />
	 <div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<center><button class="btn btn-primary" id="printing_button" onclick="printl()"><i class="fa fa-print"></i>&nbsp;PRINT</button>&nbsp;<a class="btn btn-danger" id="print_cancel" href="<?php echo base_url('Tution_fee_certificate/show_tution'); ?>">BACK</a></center>
		</div>
	 </div><br /><br />
	</div>
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
        function disableBack() { window.history.forward() }
        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
        function preventBack(){window.history.forward();}
        setTimeout("preventBack()", 0);
        window.onunload=function(){null};
    });
	</script>
</body>
</html>
<?php
error_reporting(0);
if ($details_fetch) {
	$Birth_Date = $details_fetch[0]->Birth_Date;
	$Birth_Date1 = date('d-M-Y', strtotime($Birth_Date));
}

if ($total_paid) {
	$total_paid;
}

$number = $total_paid;
$no = round($number);
$point = round($number - $no, 2) * 100;
$hundred = null;
$digits_1 = strlen($no);
$i = 0;
$str = array();
$words = array(
	'0' => '',
	'1' => 'One',
	'2' => 'Two',
	'3' => 'Three',
	'4' => 'Four',
	'5' => 'Five',
	'6' => 'Six',
	'7' => 'Seven',
	'8' => 'Eight',
	'9' => 'Nine',
	'10' => 'Ten',
	'11' => 'Eleven',
	'12' => 'Twelve',
	'13' => 'Thirteen',
	'14' => 'Fourteen',
	'15' => 'Fifteen',
	'16' => 'Sixteen',
	'17' => 'Seventeen',
	'18' => 'Eighteen',
	'19' => 'Nineteen',
	'20' => 'Twenty',
	'30' => 'Thirty',
	'40' => 'Forty',
	'50' => 'Fifty',
	'60' => 'Sixty',
	'70' => 'Seventy',
	'80' => 'Eighty',
	'90' => 'Ninety'
);
$digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
while ($i < $digits_1) {
	$divider = ($i == 2) ? 10 : 100;
	$number = floor($no % $divider);
	$no = floor($no / $divider);
	$i += ($divider == 10) ? 1 : 2;
	if ($number) {
		$plural = (($counter = count($str)) && $number > 9) ? "" : null;
		$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
		$str[] = ($number < 21) ? $words[$number] .
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
$amtinword = "Rupees " . $result . "Only";
?>
<!DOCTYPE html>
<html>

<head>
	<title>Tuition Fee Certificate</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.0.js"></script>
	<style>
		#border {
			/* width: 100%;
			height: 100%; */
			padding: 5px 20px 0px 20px;
			border: solid 3px black;
		}

		#image {
			height: 80px;
			width: 80px;
			margin-top: -10px;
			/* float: center; */
		}

		#heading {
			float: center;
		}


		.text-content {
			text-align: right;
		}

		@page {
			margin: 20px 20px 20px 20px;
		}

		.f-s {
			font-size: 22px;
		}

		.st {
			font-size: 12px !important;
			text-align: center;
			font-weight: bold;
			font-style: italic;
		}

		.amt_inword {
			font-size: 12px !important;
			font-weight: bold;
			font-style: italic;
		}

		td {
			font-size: 14px !important;
		}

		hr {
			width: 100%;
			border: 0.5px solid #000;
		}
	</style>
</head>

<body id=border>

	<div>
		<table width='100%'>
			<tr>
				<th rowspan="5" width='15%'><img src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>" id="image"></th>
				<th width='70%'>
					<center>
						<h6><b><?php echo $school_setting[0]->School_Name; ?></b></h6>
					</center>
				</th>
				<th width='15%'></th>
			</tr>
			<tr>
				<td width='70%'>
					<center>
						<?php echo $school_setting[0]->School_Address; ?>
					</center>
				</td>
				<td width='15%'></td>
			</tr>
			<tr>
				<td width='70%'>
					<center>
						Affillated to CBSE,New Delhi (Aff No. :<?php echo $school_setting[0]->School_AfftNo; ?>, School Code: <?php echo $school_setting[0]->School_Code; ?>)
					</center>
				</td>
				<td width='15%'></td>
			</tr>
			<tr>
				<td width='70%'>
					<center>
						Phone No. : <?php echo $school_setting[0]->School_MobileNo; ?>
					</center>
				</td>
				<td width='15%'></td>
			</tr>
			<tr>
				<td width='70%'>
					<center>
						Website : <?php echo $school_setting[0]->School_Webaddress; ?>, Email : <?php echo $school_setting[0]->School_Email; ?>
					</center>
				</td>
				<td width='15%'></td>
			</tr>
		</table>
		<br>

		<center>
			<h6><u>TO WHOMSOEVER IT MAY CONCERN</u></h6>
		</center>
		<table>
			<tr>
				<td class="f-s">
					<i>This is to certify that <b>Mr. <?php echo $F_NAME; ?></b> & <b>Mrs. <?php echo $M_Name; ?></b> have paid Tuition Fee for the study of their ward in our
						school as per details given below:-</i>
				</td>
			</tr>
		</table>
		<br>
		<table border="1" width="100%">
			<tr>
				<td class="st" rowspan="2">Adm. No.</td>
				<td class="st" rowspan="2">Ward's Name</td>
				<td class="st" rowspan="2">Class</td>
				<td class="st" rowspan="2">Academic<br>Session</td>
				<td class="st" rowspan="2">Tuition<br>Fee<br>Rate</td>
				<td class="st" colspan="2">Period</td>
				<td class="st" rowspan="2">Total<br>Tuition Fee<br>Paid(Rs.)</td>
			</tr>
			<tr>
				<td class="st">From</td>
				<td class="st">To</td>
			</tr>
			<tr>
				<td class="st"><?php echo $ADM_NO; ?></td>
				<td class="st"><?php echo $S_NAME; ?></td>
				<td class="st"><?php echo $class_name . "-" . $sec; ?></td>
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
		</div><br><br><br><br>
		<div class="row">
			<table width="100%">
				<tr>
					<td>
						<center><b><i style="font-size: 12px !important;"><?php echo date("d-M-Y"); ?><br>Issue Date</i></b></center>
					</td>
					<td>
						<center><b><i style="font-size: 12px !important;"><br>Prepared By </i></b></center>
					</td>
					<td>
						<center><b><i style="font-size: 12px !important;">Principal <br /> Signature</i></b></center>
					</td>
				</tr>
			</table>
		</div>

		<hr>

		<table width='100%'>
			<tr>
				<th rowspan="5" width='15%'>
					<img src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>" id="image">
				</th>
				<th width='70%'>
					<center>
						<h6><b><?php echo $school_setting[0]->School_Name; ?></b></h6>
					</center>
				</th>
				<th width='15%'></th>
			</tr>
			<tr>
				<td width='70%'>
					<center>
						<?php echo $school_setting[0]->School_Address; ?>
					</center>
				</td>
				<td width='15%'></td>
			</tr>
			<tr>
				<td width='70%'>
					<center>
						Affillated to CBSE,New Delhi (Aff No. :<?php echo $school_setting[0]->School_AfftNo; ?>, School Code: <?php echo $school_setting[0]->School_Code; ?>)
					</center>
				</td>
				<td width='15%'></td>
			</tr>
			<tr>
				<td width='70%'>
					<center>
						Phone No. : <?php echo $school_setting[0]->School_MobileNo; ?>
					</center>
				</td>
				<td width='15%'></td>
			</tr>
			<tr>
				<td width='70%'>
					<center>
						Website : <?php echo $school_setting[0]->School_Webaddress; ?>, Email : <?php echo $school_setting[0]->School_Email; ?>
					</center>
				</td>
				<td width='15%'></td>
			</tr>
		</table>
		<br>

		<center>
			<h6><u>TO WHOMSOEVER IT MAY CONCERN</u></h6>
		</center>
		<table>
			<tr>
				<td class="f-s">
					<i>This is to certify that <b>Mr. <?php echo $F_NAME; ?></b> & <b>Mrs. <?php echo $M_Name; ?></b> have paid Tuition Fee for the study of their ward in our
						school as per details given below:-</i>
				</td>
			</tr>
		</table>
		<br>
		<table border="1" width="100%">
			<tr>
				<td class="st" rowspan="2">Adm. No.</td>
				<td class="st" rowspan="2">Ward's Name</td>
				<td class="st" rowspan="2">Class</td>
				<td class="st" rowspan="2">Academic<br>Session</td>
				<td class="st" rowspan="2">Tuition<br>Fee<br>Rate</td>
				<td class="st" colspan="2">Period</td>
				<td class="st" rowspan="2">Total<br>Tuition Fee<br>Paid(Rs.)</td>
			</tr>
			<tr>
				<td class="st">From</td>
				<td class="st">To</td>
			</tr>
			<tr>
				<td class="st"><?php echo $ADM_NO; ?></td>
				<td class="st"><?php echo $S_NAME; ?></td>
				<td class="st"><?php echo $class_name . "-" . $sec; ?></td>
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
		</div><br><br><br><br>
		<div class="row">
			<table width="100%">
				<tr>
					<td>
						<center><b><i style="font-size: 12px !important;"><?php echo date("d-M-Y"); ?><br>Issue Date</i></b></center>
					</td>
					<td>
						<center><b><i style="font-size: 12px !important;"><br>Prepared By </i></b></center>
					</td>
					<td>
						<center><b><i style="font-size: 12px !important;">Principal <br /> Signature</i></b></center>
					</td>
				</tr>
			</table>
		</div>
	</div>
</body>

</html>
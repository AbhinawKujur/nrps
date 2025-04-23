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
	<style>
		body {
			marging: 0px !important;
			paddging: 0px !important;
		}

		#img {
			float: left;
			height: 80px;
			width: 80px;
			margin-left: -15px !important;
		}

		#tp-header {
			margin-top: -15px !important;
			font-size: 30px;
		}

		#mid-header {
			margin-top: -10px !important;
			font-size: 26px;
		}

		#last-header {
			margin-top: -10px !important;
			font-size: 22px;
		}


		#content {
			border: solid 1px black;
			border-radius: 10px;
		}

		table thead tr th {
			background: #337ab7;
			color: #fff !important;
			padding: 5px;
			border: 1px solid black;
		}


		#example tbody tr td {
			font-size: 14px !important;
			padding: 2px 0 2px 5px;
			/* border: 1px solid black; */
		}

		.header {
			margin-top: -5%;
			padding: 0;
		}

		@page {
			size: landscape;/ auto is the initial value / margin-top: -10px;/ this affects the margin in the printer settings / margin-bottom: 0;
			margin-right: 20px;
			margin-left: 20px;
		}

		body {
			font-family: Verdana, Geneva, sans-serif;
			font-size: 13px;
		}
	</style>
</head>

<body>
	<img src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>" id="img">
	<p style='float:right; font-size:15px; margin-top:-25px;'>Report Generation Date:<?php echo date('d-m-y'); ?></p><br />
	<table width="100%" style="float:right;">
		<tr>
			<td id="tp-header">
				<center><?php echo $school_setting[0]->School_Name; ?><center>
			</td>
		</tr>
		<tr>
			<td id="mid-header">
				<center><?php echo $school_setting[0]->School_Address; ?><center>
			</td>
		</tr>
		<tr>
			<td id="last-header">
				<center>SESSION (<?php echo $school_setting[0]->School_Session; ?>)<center>
			</td>
		</tr>
	</table><br /><br /><br /><br />
	<hr>
	<table width="100%">
		<tr>
			<td id="content">
				<center><b>STUDENT STRENGTH</b></center>
			</td>
		</tr>
	</table><br />
	<table width="100%">
		<tr>
			<td>
				<center><b>Class-Section Wise Student Strength Report</b></center>
			</td>
		</tr>
	</table><br />
	<div class='row'>
		<div class='col-md-12 col-xl-12 col-sm-12'>
			<div style='overflow:auto;'>
				<table border="1" id='example' style="width: 100%;" cellpadding='0' cellspacing='0'>
					<thead>
						<tr>
							<th rowspan='2' class='th'>Class/sec</th>
							<th class='th'>Total</th>
							<th colspan='2' class='th'>
								<center>Gender</center>
							</th>
							<th colspan='6' class='th'>
								<center>Category</center>
							</th>
							<th colspan='6' class='th'>
								<center>Ward</center>
							</th>
						</tr>
						<tr>
							<th class="th"></th>
							<th class="th">Boys</th>
							<th class="th">Girls</th>
							<th class="th"><?php echo $cat[0]->CAT_ABBR; ?></th>
							<th class="th"><?php echo $cat[1]->CAT_ABBR; ?></th>
							<th class="th"><?php echo $cat[2]->CAT_ABBR; ?></th>
							<th class="th"><?php echo $cat[3]->CAT_ABBR; ?></th>
							<th class="th"><?php echo $cat[4]->CAT_ABBR; ?></th>
							<th class="th"><?php echo $cat[5]->CAT_ABBR; ?></th>
							<th class="th"><?php echo $wardd[0]->HOUSENAME; ?></th>
							<th class="th"><?php echo $wardd[1]->HOUSENAME; ?></th>
							<th class="th"><?php echo $wardd[2]->HOUSENAME; ?></th>
							<th class="th"><?php echo $wardd[3]->HOUSENAME; ?></th>
							<th class="th"><?php echo $wardd[4]->HOUSENAME; ?></th>
							<th class="th"><?php echo $wardd[5]->HOUSENAME; ?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$total = 0;
						$male = 0;
						$female = 0;
						$cat1 = 0;
						$cat2 = 0;
						$cat3 = 0;
						$cat4 = 0;
						$cat5 = 0;
						$cat6 = 0;
						$ward1 = 0;
						$ward2 = 0;
						$ward3 = 0;
						$ward4 = 0;
						$ward5 = 0;
						$ward6 = 0;
						foreach ($all_data as $key => $value) {
							if ($value->DISP_CLASS == null) {
							} else {
						?>
								<tr>
									<td><?php echo $value->DISP_CLASS . "/" . $value->DISP_SEC; ?></td>
									<td><?php echo $value->TOTALSTUDENT; ?></td>
									<td><?php echo $value->MALE; ?></td>
									<td><?php echo $value->FEMALE; ?></td>
									<td><?php echo $value->CAT1; ?></td>
									<td><?php echo $value->CAT2; ?></td>
									<td><?php echo $value->CAT3; ?></td>
									<td><?php echo $value->CAT4; ?></td>
									<td><?php echo $value->CAT5; ?></td>
									<td><?php echo $value->CAT6; ?></td>
									<td><?php echo $value->WARD1; ?></td>
									<td><?php echo $value->WARD2; ?></td>
									<td><?php echo $value->WARD3; ?></td>
									<td><?php echo $value->WARD4; ?></td>
									<td><?php echo $value->WARD5; ?></td>
									<td><?php echo $value->WARD6; ?></td>
								</tr>
							<?php
								$total += $value->TOTALSTUDENT;
								$male += $value->MALE;
								$female += $value->FEMALE;
								$cat1 += $value->CAT1;
								$cat2 += $value->CAT2;
								$cat3 += $value->CAT3;
								$cat4 += $value->CAT4;
								$cat5 += $value->CAT5;
								$cat6 += $value->CAT6;
								$ward1 += $value->WARD1;
								$ward2 += $value->WARD2;
								$ward3 += $value->WARD3;
								$ward4 += $value->WARD4;
								$ward5 += $value->WARD5;
								$ward6 += $value->WARD6;
							}
							?>

						<?php
						}
						?>
						<tr>
							<td>Total Strength</td>
							<td><?php echo $total; ?></td>
							<td><?php echo $male; ?></td>
							<td><?php echo $female; ?></td>
							<td><?php echo $cat1; ?></td>
							<td><?php echo $cat2; ?></td>
							<td><?php echo $cat3; ?></td>
							<td><?php echo $cat4; ?></td>
							<td><?php echo $cat5; ?></td>
							<td><?php echo $cat6; ?></td>
							<td><?php echo $ward1; ?></td>
							<td><?php echo $ward2; ?></td>
							<td><?php echo $ward3; ?></td>
							<td><?php echo $ward4; ?></td>
							<td><?php echo $ward5; ?></td>
							<td><?php echo $ward6; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div><br />
</body>

</html>
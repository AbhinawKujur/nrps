<!DOCTYPE html>
<html>

<head>
	<title>Pre Defaulter Class Wise</title>
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
			margin-left: 20px !important;
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

		#example thead,
		tfoot tr td {
			font-size: 16px !important;
			padding: 2px 0 2px 5px;
			/* border: 1px solid black; */
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
		a{
			color: #000;
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
	<div class='row'>
		<div class='col-md-12 col-xl-12 col-sm-12'>
			<div style='overflow:auto;'>
				<h3>
					<center>RELIGION WISE STUDENT REPORT (<?php echo $wardt; ?>)</center>
				</h3>
				<table border="1" id='example' style="width: 100%;" cellpadding='0' cellspacing='0'>
					<thead>
						<tr>
							<th>Sl no.</th>
							<th>Student Id</th>
							<th>Admission No</th>

							<th>Roll No</th>



							<th>Student Name</th>
							<th>Gender</th>
							<th>DOB</th>
							<th>Category</th>
							<th>House</th>
							<th>Ward Type</th>
							<th>Sub Ward Type</th>
							<th>Class-Sec</th>

							<th>Father Name</th>
							<th>Mother Name</th>
							<th>Mobile No.</th>
							<th>Parent Email-ID.</th>

							<th>Admission Date</th>

							<th>Bus Stoppage</th>
							<th>Bus No.</th>

							<th>Religion</th>


						</tr>
					</thead>
					<tbody>
						<?php
						if ($data) {
							$i = 1;
							foreach ($data as $student_data) {
						?>
								<tr>
									<td><a href="<?php echo base_url('Student_details/show_student_details/' . $student_data->STUDENTID); ?>"><?php echo $i; ?></a></td>
									<td><a href="<?php echo base_url('Student_details/show_student_details/' . $student_data->STUDENTID); ?>"><?php echo $student_data->STUDENTID; ?></a></td>
									<td><a href="<?php echo base_url('Student_details/show_student_details/' . $student_data->STUDENTID); ?>"><?php echo $student_data->ADM_NO; ?></a></td>
									<td><?php echo $student_data->ROLL_NO; ?></td>

									<td><a href="<?php echo base_url('Student_details/show_student_details/' . $student_data->STUDENTID); ?>"><?php echo $student_data->FIRST_NM; ?></a></td>
									<td><a href="<?php echo base_url('Student_details/show_student_details/' . $student_data->STUDENTID); ?>"><?php echo ($student_data->SEX == 1) ? 'MALE' : 'FEMALE'; ?></a></td>
									<td><?php echo date('d-M-Y', strtotime($student_data->BIRTH_DT)); ?></td>
									<td><?php echo $student_data->CATEGORY_NM; ?></td>
									<td><?php echo $student_data->HOUSE_NM; ?></td>
									<td><?php echo $student_data->WARD_NM; ?></td>
									<td><?php echo $student_data->esub_ward_nm; ?></td>


									<td><a href="<?php echo base_url('Student_details/show_student_details/' . $student_data->STUDENTID); ?>"><?php echo $student_data->DISP_CLASS; ?>-<?php echo $student_data->DISP_SEC; ?></a></td>
									<td><a href="<?php echo base_url('Student_details/show_student_details/' . $student_data->STUDENTID); ?>"><?php echo $student_data->FATHER_NM ?></a></td>
									<td><a href="<?php echo base_url('Student_details/show_student_details/' . $student_data->STUDENTID); ?>"><?php echo $student_data->MOTHER_NM ?></a></td>
									<td><a href="<?php echo base_url('Student_details/show_student_details/' . $student_data->STUDENTID); ?>"><?php echo $student_data->C_MOBILE ?></a></td>
									<td><?php echo $student_data->P_EMAIL; ?></td>
									`
									<td><?php echo date('d-M-Y', strtotime($student_data->ADM_DATE)); ?></td>

									<td><?php echo $student_data->STOP_NM; ?></td>
									<td><?php echo $student_data->BUS_NO_C; ?></td>

									<td><?php echo $student_data->religion_nm; ?></td>

								</tr>
						<?php
								$i++;
							}
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<style>
	*{
		text-transform: uppercase;
	}
	body{
		margin : 0px;
	}
	html{
		margin-top : 15px;
		margin-left: -30px;
		}
	@page {
    		size: auto;   / auto is the initial value /
    		margin-top: 20px !important;    / this affects the margin in the printer settings /
    		margin-bottom: 0;
    		margin-right: 20px;
    		margin-left: 20px;
		}
		.img{
			height: 60px;
			width: 60px;
			margin-top: 1px;
			margin-left:10px;
		}
		table,tr,td{
			padding:0px;
			margin:0px;
			font-size: 10px;
			font-weight: bold;
		}
		.school_session{
			position: absolute;
			font-size: 11px;
			top: 32px;
			left: 70px;
		}
		.school_add ,.school_add_second,.school_session,.school_name{
			color: black;
		}
		.std_icard{
			font-size: 12px;
			font-weight: bold;
		}
		.photo{
			height: 70px;
			width: 65px;
			margin: 0px 0px 0px 10px;
			border: solid 1px black;
			padding: 10px;
		}
		.header{
			background-color: #b8bdc3;
			border-top: solid 1px black;
			border-right: solid 1px black;
			border-left: solid 1px black;
		}
		.i-body{
			border-right: solid 1px black;
			border-left: solid 1px black;
			padding: 1px;
		}
		.i-footer{
			background-color: #b8bdc3;
			padding: 1px;
			border-bottom: solid 1px black;
			border-right: solid 1px black;
			border-left: solid 1px black;
		}
		.pri{
			float: right;
		}
		.pri_sign{
			margin-left: 150px;
			height: 30px;
			width: 80px;
		}
</style>
<body>
<div class="container">
	<?php
		$j =1;
		foreach($data as $data_key){
			if($j > 3){
				$j=1;
				?>
				<div style="page-break-after: always"></div>
				<?php
			}
			$j = $j+1;
			?>
		<div class="row">
		<div class="col-sm-6 col-lg-6 col-md-6">
			<div class="header">
				<table cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td rowspan="3"><img class="img" src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>"></td>
						<td><?php echo $school_setting[0]->School_Name; ?></td>
					</tr>
					<tr>
						<td><?php echo $school_setting[0]->School_Address; ?></td>
					</tr>
					<tr>
						<td>Session (<?php echo $school_setting[0]->School_Session; ?>)</td>
					</tr>
				</table>
			</div>
			<div class="i-body">
				<center><span class="std_icard">STUDENT I-CARD</span></center>
				<table cellspacing="0" cellpadding="0" width="100%" class="">
					<tr>
							<td>Adm No.:</td>
							<td><?php echo $data_key->ADM_NO; ?></td>
							<td>D.o.B</td>
							<td><?php echo date('d-M-Y',strtotime($data_key->BIRTH_DT)); ?></td>
							<td colspan="2" rowspan="5">
							<?php
							 
								if($data_key->student_image == null){
									?>
									<img src="assets/student_photo/default.jpg" class="photo">
									<?php
								}
								else{
									?>
									<img src="<?php echo $data_key->student_image; ?>" class="photo">
									<?php
								}
							?>
							</td>
						</tr>
						<tr>
							<td>Student Name:</td>
							<td colspan="3"><?php echo $data_key->FIRST_NM; ?></td>
							
						</tr>
						<tr>
							<td>Class/Sec:</td>
							<td><?php echo $data_key->DISP_CLASS."/".$data_key->DISP_SEC; ?></td>
							<td>Roll:</td>
							<td><?php  if($data_key->ROLL_NO == null){
								echo "N/A";
							}else{
								echo $data_key->ROLL_NO;
							}
							?></td>
						</tr>
						<tr>
							<td>Father Name:</td>
							<td colspan="3"><?php echo $data_key->FATHER_NM; ?></td>
						</tr>
						<tr>
							<td>Mother Name:</td>
							<td colspan="3"><?php echo $data_key->MOTHER_NM; ?></td>
						</tr>
						<tr>
							<td>Bus Stoppage:</td>
							<td colspan="5"><?php 
								if($data_key->STOPPAGE_AMT == null){
									echo "N/A";
								}
								else{
									echo $data_key->STOPPAGE_AMT;
								}
							?></td>
						</tr>
						<tr>
							<td>Phone No:</td>
							<td colspan="5"><?php
								if($data_key->C_MOBILE == null){
									echo "N/A";
								}
								else{
									echo $data_key->C_MOBILE;
								}
							?></td>
						</tr>
						<tr>
							<td>Address:</td>
							<td colspan="5"><?php
								if($data_key->CORR_ADD==null){
									echo "N/A";
								}else{
									echo $data_key->CORR_ADD;
								}
							?></td>
						</tr>					
				</table>
			</div>
			<div class="i-footer">
				<table cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td><?php echo date('d-M-Y',strtotime($date)); ?></td>
						<td><span><img src="assets/school_logo/PPLSIGN.png" class="pri_sign"></span></td>
					</tr>
					<tr>
						<td>valid Date</td>
						<td><span class="pri">Principal Sign</span></td>
					</tr>
				</table>
			</div>
		</div>
	</div><br /><br /><br />
			<?php
		}
	?>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admit Card</title>
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
		margin-bottom : 0px;
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
			font-size: 9px;
			font-weight: bold;
		}
		.school_session{
			position: absolute;
			font-size: 11px;
			top: 32px;
			left: 70px;
		}
		.school_name{
			color: black;
			font-size: 12px;
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
			height: 30px;
			width: 80px;
		}
		.mid_table{
			margin-left:20px;
		}
</style>
<body>
<div class="container">
	<?php
		$j =1;
		foreach($data as $data_key){
			if($j > 4){
				$j=1;
				?>
				<div style="page-break-after: always"></div>
				<?php
			}
			$j = $j+1;
			?>
		<div class="row">
		<div class="col-sm-12 col-lg-12 col-md-12">
			<div class="header">
				<table cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td rowspan="3"><img class="img" src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>"></td>
						<td class="school_name"><center><?php echo $school_setting[0]->School_Name; ?></center></td>
						<td rowspan="3"><center>Admit Card</center></td>
					</tr>
					<tr>
						<td><center><?php echo $school_setting[0]->School_Address; ?></center></td>
					</tr>
					<tr>
						<td><center>Session (<?php echo $school_setting[0]->School_Session; ?>)<center></td>
					</tr>
				</table>
			</div>
			<div class="i-body">
				<center><span class="std_icard">ADMIT CARD</span></center>
				<table cellspacing="0" cellpadding="0" width="100%"  class="mid_table">
					<tr>
						<td>Exam Name</td>
						<td colspan="4">: <?php echo $date; ?></td>
					</tr>
					<tr>
							<td>Admn No</td>
							<td>: <?php echo $data_key->ADM_NO; ?></td>
							<td>D.O.B</td>
							<td>: <?php echo date('d-m-Y',strtotime($data_key->BIRTH_DT)); ?></td>
							<td colspan="2" rowspan="5"><?php
							 
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
							?></td>
						</tr>
						<tr>
							<td>Student Name</td>
							<td colspan="3">: <?php echo $data_key->FIRST_NM; ?></td>
							
						</tr>
						<tr>
							<td>Class/Sec</td>
							<td>: <?php echo $data_key->DISP_CLASS."/".$data_key->DISP_SEC; ?></td>
							<td>Roll</td>
							<td>: <?php  if($data_key->ROLL_NO == null){
								echo "N/A";
							}else{
								echo $data_key->ROLL_NO;
							}
							?></td>
						</tr>
						<tr>
							<td>Father Name</td>
							<td>: <?php echo $data_key->FATHER_NM; ?></td>
							<td>Mother Name</td>
							<td>: <?php echo $data_key->MOTHER_NM; ?></td>
						</tr>
						<tr>
							<td>Address</td>
							<td colspan="5">: <?php
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
						<td></td>
						<td></td>
						<td><span><center><img src="assets/school_logo/PPLSIGN.png" class="pri_sign"></center></span></td>
					</tr>
					<tr>
						<td><center>Exam Controller</center></td>
						<td><center>Class Teacher</center></td>
						<td><span><center>Principal Sign</center></span></td>
					</tr>
				</table>
			</div>
		</div>
	</div><br /><br />
			<?php
		}
	?>
</div>
</body>
</html>

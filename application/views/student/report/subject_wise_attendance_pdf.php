<html>
	<head>
		<title>Subject Wise Attendance Report</title>
		<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css'>
		
		<style>
			body{
				font-size:13px;
			}
			@page { margin: 25px; }
		</style>
	</head>
	
	<body>
		<table class='table'>
				<tr>
					<td colspan='5'>
						<h2>
						<center>
							<?php echo $school_setting[0]['School_Name']; ?><br />
						</center>
						</h2>
						<h6>
							<center>
								<?php echo $school_setting[0]['School_Address']; ?>
							</center>
						</h6>
					</td>
				</tr>
				<tr>
					<th colspan='5'><h4><center>SUBJECT WISE ATTENDANCE REPORT</center></h4></th>
				</tr>
				<tr>
					<td>Date: <?php echo $date; ?></td>
					<td colspan='3'><center><h5><?php //echo $subjnm; ?></h5></center></td>
					<td>Class-Sec: <?php echo $classnm.'-'.$secnm; ?></td>
				</tr>
				<tr>
					<th style='background:#337ab7; color:#fff !important'>Adm No.</th>
					<th style='background:#337ab7; color:#fff !important'>Student Name</th>
					<th style='background:#337ab7; color:#fff !important'>Roll No.</th>
					<th style='background:#337ab7; color:#fff !important'><center>Attendance</center></th>
					<th style='background:#337ab7; color:#fff !important'><center>Subject</center></th>
				</tr>
				<?php
					foreach($getData as $key => $val){
						$bgcolor = ($val['att_status'] == 'P')?'#c3e6cb':'#f5c6cb';
						?>
							<tr style="background:<?php echo $bgcolor; ?>">
								<td><?php echo $val['admno']; ?></td>
								<td><?php echo $val['firstnm']; ?></td>
								<td><?php echo $val['rollno']; ?></td>
								<td><center><?php echo $val['att_status']; ?></center></td>
								<td><center><?php echo $val['subjnm']; ?></center></td>
							</tr>
						<?php
					}
				?>
		</table>
	</body>
</html>
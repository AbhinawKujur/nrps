<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pay Now</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
	.table,td{
		text-align:right;
	}
	.main{
		background:#eee;
		padding:10px;
	}
	body{
		background:#000;
		font-family: Verdana,Geneva,sans-serif !important; 
	}
  </style>
</head>
<body>

<div class="container"><br /><br />
	<div class='col-sm-3'></div>
	<div class='col-sm-6 main'>
		<center>
			
			<table class='table'>
				<tr>
					<td>
						<center>
							<img src="<?php echo base_url($school_photo[0]->School_Logo_RT); ?>" style="width:80px;" class='img-responsive'>
							<span style='font-size:15px !important;'><?php echo $school_setting[0]->School_Name; ?></span><br /
							>
							<span style='font-size:14px !important'>
							Shyamali, Doranda Ranchi- 834002
							</span><br />
							<b><center><span style='font-size:14px !important;'>CLASS THREE REGISTRATION FORM (for session 2020-2021)</span></center></b>
						</center>
					</td>
				</tr>
			</table>
			
			<img src='<?php echo base_url('assets_nur/image/pointer.png'); ?>' class='img-responsive animated bounce infinite' style='width:50px;'>
			<span class='animated rubberBand' style='font-size:16px;'><b>Acknowledgement of Payment</b></span>
				<table class='table'>
					<tr>
						<th>Applicant Name:</th>
						<td><?php echo $allData[0]['stu_nm']; ?></td>
					</tr>
					<tr>
						<th>Father's Name:</th>
						<td><?php echo $allData[0]['f_name']; ?></td>
					</tr>
					<tr style='background:#FADBD8'>
						<th>Username:</th>
						<td><?php echo $allData[0]['id']."/2020"; ?></td>
					</tr>
					<tr style='background:#FADBD8'>
						<th>Password:</th>
						<td><?php echo $allData[0]['mobile']; ?></td>
					</tr>
					<tr>
						<td colspan='2'><span style='color:#fff; background:red; border-radius:2px; padding:3px; font-size:12px;'>Payment of Rs. <?php echo $allData[0]['set_amt']; ?> is due</span></td>
					</tr>
				</table>
			<a href='<?php echo base_url('adm_three/payment/Payment'); ?>' class='btn btn-success form-control'>Pay Now</a>
		</center>
		<p style='text-align:justify; font-size:12px;'><b>Note: </b><i>For further queries, printout & payment of your registered ward kindly <a href='<?php echo base_url('adm_three/Admin'); ?>'>Click Here</a> from your valid username & password</i></p>
	</div>
	<div class='col-sm-3'></div>
</div><br /><br />

</body>
</html>

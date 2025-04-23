<!DOCTYPE html>
<html lang="en">
<head>
  <title>Transaction Failed</title>
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
		
			<img src='<?php echo base_url('assets_nur/image/512.png'); ?>' class='img-responsive animated bounce infinite' style='width:50px;'>
			<h3>Transaction Failed</h3>
			<span>Please try a different payment method</span>
				<table class='table'>
					<tr>
						<th>Applicant Name:</th>
						<td><?php echo $allData[0]['stu_nm']; ?></td>
					</tr>
					<tr>
						<th>Father's Name:</th>
						<td><?php echo $allData[0]['f_name']; ?></td>
					</tr>
					<tr>
						<th>Transaction ID:</th>
						<td><?php echo $allData[0]['transaction_id']; ?></td>
					</tr>
					<tr>
						<th>mmp txn:</th>
						<td><?php echo $allData[0]['mmp_txn']; ?></td>
					</tr>
					<tr>
						<th>bank txn:</th>
						<td><?php echo $allData[0]['bank_txn']; ?></td>
					</tr>
					<tr>
						<th>auth code:</th>
						<td><?php echo $allData[0]['auth_code']; ?></td>
					</tr>
					<tr>
						<th>ipg txn id:</th>
						<td><?php echo $allData[0]['ipg_txn_id']; ?></td>
					</tr>
					<tr>
						<th>desc:</th>
						<td><?php echo $allData[0]['desc']; ?></td>
					</tr>
					<tr>
						<th>Response Date:</th>
						<td><?php echo date('d-M-y',strtotime($allData[0]['response_received_time'])); ?></td>
					</tr>
				</table>
			<a href='<?php echo base_url('adm_three/Admin'); ?>' class='btn btn-warning form-control'>Try again</a>
		</center>
	</div>
	<div class='col-sm-3'></div>
</div><br /><br />

</body>
</html>

<html>
	<head>
		<title>Admit Card</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<style>
			.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
				border-top: none !important;
				line-height:15px;
				padding-top:0px;
			}
			@page { margin-top: 70px; }
			body{
				background:#eee;
			}
		</style>
	</head>
	<body>
	<div style='border:2px solid #000'>
		<table class='table'>
			<tr>
				<td><img src='assets/school_logo/1560227769.png' style='width:110px;'></td>
				<th><center><h3><b>JAWAHAR VIDYA MANDIR SHYAMALI, RANCHI-834002</b></h3></center></th>
				
				<td style='text-align:right;'><img src='<?php echo $stuData[0]['img']; ?>' style='width:100px; position:absolute; top:7px; right:12px;'><br /></td>
			</tr>
			<tr>
				<td colspan='3'><center><strong>
					Class-III Admission Test (Session: 2020-2021) <br/>
					</strong>
					<b>ADMIT CARD <br />(PARENT'S COPY)</b><center></td>
			</tr>
			<tr>
				<th>Name:</th>
				<td><?php echo $stuData[0]['stu_nm']; ?></td>
				<td></td>
			</tr>
			<tr>
				<th>Application No.:</th>
				<td><?php echo $stuData[0]['id'].'/2020'; ?></td>
				<td></td>
			</tr>
			<tr>
				<th>Father's Name:</th>
				<td><?php echo $stuData[0]['f_name']; ?></td>
				<td></td>
			</tr>
			<tr>
				<th>Mother's Name:</th>
				<td><?php echo $stuData[0]['m_name']; ?></td>
				<td></td>
			</tr>
			<tr>
				<th>D.O.B.:</th>
				<td><?php echo date('d-M-Y', strtotime($stuData[0]['dob'])); ?></td>
				<td></td>
			</tr>
			<tr>
				<th>Date of Exam: </th>
				<td>19th March 2020</td>
				<td></td>
			</tr>
			<tr>
				<th>Reporting Time: </th>
				<td>10:00 AM (Sharp)</td>
				<td></td>
			</tr>
			<tr>
				<th>Exam Time: </th>
				<td>10:30 AM - 11:30 AM</td>
				<td></td>
			</tr>
		</table>
		
		<table class='table'>
			
			<tr>
				<th>Parent's Signature</th>
				<th style='text-align:right'><img src='assets/logo/princ.png' style='position:absolute; top:33%; right:23%'>Principal Signature</th>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			
			<tr>
				<th>Invigilator Signature</th>
				<th style='text-align:right'>Date: <?php echo date('d-M-y')?></th>
				<td></td>
			</tr>
		</table>
		</div>
		<br /><br />
		
		<div style='border:2px solid #000'>
		<table class='table'>
			<tr>
				<td><img src='assets/school_logo/1560227769.png' style='width:110px;'></td>
				<th><center><h3><b>JAWAHAR VIDYA MANDIR SHYAMALI, RANCHI-834002</b></h3></center></th>
				<td style='text-align:right'><img src='<?php echo $stuData[0]['img']; ?>' style='width:100px; position:absolute; top:515px; right:12px'><br /></td>
			</tr>
			<tr>
				<td colspan='3'><center>
					<strong>Class-III Admission Test (Session: 2020-2021)</strong>
					<br/><b>ADMIT CARD <br />(SCHOOL COPY: For School Use Only)</b><center></td>
			</tr>
			<tr>
				<th>Name: </th>
				<td><?php echo $stuData[0]['stu_nm']; ?></td>
				<td></td>
			</tr>
			<tr>
				<th>Application No.: </th>
				<td><?php echo $stuData[0]['id'].'/2020'; ?></td>
				<td></td>
			</tr>
			<tr>
				<th>Father's Name: </th>
				<td><?php echo $stuData[0]['f_name']; ?></td>
				<td></td>
			</tr>
			<tr>
				<th>Mother's Name: </th>
				<td><?php echo $stuData[0]['m_name']; ?></td>
				<td></td>
			</tr>
			<tr>
				<th>D.O.B.: </th>
				<td><?php echo date('d-M-Y', strtotime($stuData[0]['dob'])); ?></td>
				<td></td>
			</tr>
			<tr>
				<th>Date of Exam: </th>
				<td>19th March 2020</td>
				<td></td>
			</tr>
			<tr>
				<th>Reporting Time: </th>
				<td>10:00 AM (Sharp)</td>
				<td></td>
			</tr>
			<tr>
				<th>Exam Time: </th>
				<td>10:30 AM - 11:30 AM</td>
				<td></td>
			</tr>
		</table>
		<table class='table'>
			
			<tr>
				<th>Parent's Signature</th>
				<th style='text-align:right'><img src='assets/logo/princ.png' style='position:absolute; top:168%; right:23%'>Principal Signature</th>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			
			<tr>
				<th>Invigilator Signature</th>
				<th style='text-align:right'>Date: <?php echo date('d-M-y')?></th>
				<td></td>
			</tr>
			
		</table>
			
		</div>
	</body>
</html>
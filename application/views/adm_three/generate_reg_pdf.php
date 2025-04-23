<!DOCTYPE HTML>
<html>
	<head>
		<title>Registration Form</title>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo base_url('assets/dash_css/bootstrap-datepicker.min.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/dash_css/bootstrap.min.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/dash_css/font-awesome.css'); ?>">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css"/>
		<script src="<?php echo base_url('assets/dash_js/jquery-2.1.4.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/dash_js/bootstrap.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/dash_js/bootstrap-datepicker.min.js'); ?>"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
		
		<style>
			fieldset.scheduler-border {
				border: 1px groove #ddd !important;
				padding: 0 1.4em 1.4em 1.4em !important;
				margin: 0 0 1.5em 0 !important;
				-webkit-box-shadow:  0px 0px 0px 0px #000;
						box-shadow:  0px 0px 0px 0px #000;
			}

			legend.scheduler-border {
				font-size: 1.2em !important;
				font-weight: bold !important;
				text-align: left !important;
				width:inherit; /* Or auto */
                padding:0 10px; /* To give a bit of padding on the left and right */
                border-bottom:none;
			}
			@page { margin: 40px 5px;}
            body { 
				margin: 0px; 
				font-family: Verdana,Geneva,sans-serif !important; 
			}
			
			.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
				padding: 5px;
				line-height: 1;
				vertical-align: top;
				border-top: none !important;
				font-size:13px;
			}
		</style>
	</head>
	<body><br />
		<div class='container'>
		<div style='border:1px solid #000; padding:4px; font-size:10px;'>
			<!-- header -->
			<table class='table'>
				<tr>
					<td style='text-align:left; width:15%'>
						<img src='<?php echo $allData[0]['img']; ?>' style='width:100px;'>
						<h5 style='background:#fff; color:#000; text-align:center'>Application No.: <?php echo $allData[0]['id'].'/2020'; ?></h4>
					</td>
					<td style='width:70%;'>
						<center>
							<img src="<?php echo $school_photo[0]->School_Logo_RT; ?>" style="width:100px;"><br />
							<span style='font-size:25px !important;'><?php echo $school_setting[0]->School_Name; ?></span><br /
							>
							<span style='font-size:18px !important'>
							Shyamali, Doranda Ranchi - 834002
							</span><br /><br />
							<b><center><span style='font-size:16px !important;'>CLASS THREE REGISTRATION FORM (for session 2020-2021)</span></center></b>
						</center>
					</td>
					<td style='width:15%; text-align:center'>
						<div style='border:2px solid #000; width:100%; height:130px;'>&nbsp;<span style='position:absolute; top:60px; opacity:0.6'>AFFIX PHOTOGRAPH</span></div>
					</td>
				</tr>
			</table>
		    <!-- end header -->
			
			<table class='table' style='padding-top:-20px !important;'>
				<tr>
					<td colspan='6' style='background:#eee; font-size:14px;'>APPLICANT DETAILS</td>
				</tr>
				<tr>	
					<th>Applicant's Name:-</th>
					<td><?php echo $allData[0]['stu_nm']; ?></td>
					<th>Date of Birth:-</th>
					<td><?php echo date('d-M-y',strtotime($allData[0]['dob'])); ?></td>
					<th>Gender:-</th>
					<td><?php echo ($allData[0]['gender'] == 1)?'MALE':'FEMALE'; ?></td>
				</tr>
				<tr>	
					<th>Physically Challenged:-</th>
					<td><?php echo $allData[0]['phy_challenged']; ?></td>
					<th>Category:-</th>
					<td><?php echo $allData[0]['category']; ?></td>
					<th>Aadhaar No.:-</th>
					<td><?php echo $allData[0]['aadhaar_no']; ?></td>
				</tr>
				<tr>	
					<th>Mother Tongue:-</th>
					<td><?php echo $motherTounge[$allData[0]['mother_tounge']]; ?></td>
					<th>Religion:-</th>
					<td><?php echo $allData[0]['religion']; ?></td>
					<th>Blood Group:-</th>
					<td><?php echo $bloodGroup[$allData[0]['blood_group']]; ?></td>
				</tr>
				<tr>
					<td colspan='6' style='background:#eee; font-size:14px;'>FATHER'S DETAILS</td>
				</tr>
				<tr>	
					<th>Name:-</th>
					<td><?php echo $allData[0]['f_name']; ?></td>
					<th>Qualification:-</th>
					<td><?php echo $parent_qualification[$allData[0]['f_qualification']]; ?></td>
					<th>Occupation:-</th>
					<td><?php echo $parent_accupation[$allData[0]['f_accupation']]; ?></td>
				</tr>
				<tr>
					<td colspan='6' style='background:#eee; font-size:14px;'>MOTHER'S DETAILS</td>
				</tr>
				<tr>	
					<th>Name:-</th>
					<td><?php echo $allData[0]['m_name']; ?></td>
					<th>Qualification:-</th>
					<td><?php echo $parent_qualification[$allData[0]['m_qualification']]; ?></td>
					<th>Occupation:-</th>
					<td><?php echo $parent_accupation[$allData[0]['m_accupation']]; ?></td>
				</tr>
			</table>
			<?php
				if($allData[0]['stuofjvm_0'] != 'NO' && $allData[0]['stuofjvm_1'] != 'NO'){
			?>
			<table class='table'>
				<!--<tr>
					<td colspan='8' style='background:#eee; font-size:14px;'>CHILD DETAILS (Studying in this school)</td>
				</tr>
				<tr>	
					<th>No. of Sons:-</th>
					<td><?php //echo $allData[0]['no_of_son']; ?></td>
					<th>No. of Daughters:-</th>
					<td><?php //echo $allData[0]['no_of_daughters']; ?></td>
				</tr>-->
				<tr>
					<td colspan='8' style='background:#eee; font-size:14px;'>Own Brother/Sister presently studying in this School</td>
				</tr>
				<?php
					for($i=0; $i<2; $i++){
						if($allData[0]['stuofjvm_'.$i] != 'NO'){
						?>
							<tr>
								<th>Name of Student:-</th>
								<td><?php echo strtoupper($allData[0]['stuofjvm_'.$i]); ?></td>
								<th>Class:-</th>
								<td><?php echo $allData[0]['class_'.$i]; ?></td>
								<th>Section:-</th>
								<td><?php echo $allData[0]['sec_'.$i]; ?></td>
								<th>Application No.:-</th>
								<td><?php echo $allData[0]['registration_'.$i]; ?></td>
							</tr>
						<?php
						}
					}
				?>
				<tr>
					<td colspan='8' style='background:#eee; font-size:14px;'>LAST ATTENDED SCHOOL</td>
				</tr>
				<tr>	
					<th>Name of the School:-</th>
					<td><?php echo $allData[0]['last_name_school']; ?></td>
					<th>Class Last Attended:-</th>
					<td><?php echo $allData[0]['last_class']; ?></td>
					<th>Year of Study:-</th>
					<td><?php echo $allData[0]['last_year_study']; ?></td>
				</tr>
				<tr>	
					<th>Board Qualifying Exam:-</th>
					<td><?php echo $allData[0]['last_board_qualification']; ?></td>
					<th>Medium of Instruction:-</th>
					<td><?php echo $allData[0]['last_medium']; ?></td>
					<th></th>
					<td></td>
				</tr>
			</table>
				<?php } ?>			
			<table class='table'>
				<tr>
					<td colspan='6' style='background:#eee; font-size:14px;'>RESIDENTIAL ADDRESS</td>
				</tr>
				<tr>
					<th>Residential Address:-</th>
					<td><?php echo $allData[0]['residentail_add']; ?></td>
					<th>PIN Code:-</th>
					<td><?php echo $allData[0]['pin_code']; ?></td>
					<th></th>
					<td></td>
				</tr>
				<tr>
					<th>Phone Residence:-</th>
					<td><?php echo $allData[0]['phone_residence']; ?></td>
					<!--<th>Phone Office:-</th>
					<td><?php echo $allData[0]['phone_ofc']; ?></td>-->
					<th>Mobile:-</th>
					<td><?php echo $allData[0]['mobile']; ?></td>
				</tr>
				<tr>
					<th>Email Id:-</th>
					<td><?php echo $allData[0]['email']; ?></td>
					<th></th>
					<td></td>
					<th></th>
					<td></td>
				</tr>
			</table>
			
			<table class='table'>
				<tr>
					<td colspan='6' style='background:#eee; font-size:14px;'>PERMANENT ADDRESS</td>
				</tr>
				<tr>
					<th>Permanent Address:-</th>
					<td><?php echo $allData[0]['p_residentail_add']; ?></td>
					<th>PIN Code:-</th>
					<td><?php echo $allData[0]['p_pin_code']; ?></td>
					<th></th>
					<td></td>
				</tr>
				<tr>
					<th>Phone Residence:-</th>
					<td><?php echo $allData[0]['p_phone_residence']; ?></td>
					<!--<th>Phone Office:-</th>
					<td><?php echo $allData[0]['p_phone_ofc']; ?></td>-->
					<th>Mobile:-</th>
					<td><?php echo $allData[0]['p_mobile']; ?></td>
				</tr>
				<tr>
					<td colspan='6'>
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan='6' style='background:#eee; font-size:14px;'>PAYMENT DETAILS</td>
				</tr>
				<tr>
					<th>Transaction Id:-</th>
					<td><?php echo $allData[0]['transaction_id']; ?></td>
					<th>Bank transaction Id:-</th>
					<td><?php echo $allData[0]['ipg_txn_id']; ?></td>
					<th>Paid Amount:-</th>
					<td><?php echo $allData[0]['amt']; ?></td>
				</tr>
				<tr>
					<th>Transaction Date and time</th>
					<td><?php echo $allData[0]['response_received_time']; ?></td>
					<th>Merchant Transaction ID</th>
					<td><?php echo $allData[0]['mmp_txn']; ?></td>
				</tr>
			</table><br /><br /><br /><br /><br /><br />
			
			<table class='table'>
			    <tr>
					<th colspan='2' style='text-align:center'><u>DECLARATION FROM PARENT</u></th>
			    </tr>
				<tr>
					<td colspan='2' style='text-align:justify'>I/We hereby declare that the particulars furnished in respect of my son/daughter/ward are true to the best of my knowledge and belief. if any informantion or declaration given by me proves to be false, the candidature of my son/daughter/ward may be cancelled at any stage.</td>
				</tr>
				
				<tr>
					<th>
						&nbsp;
					</th>
					
				</tr>
				<tr>
					<th style='margin-top:20px !important;'>Signature of Mother</th>
					<th style='margin-top:20px !important; text-align:right'>Signature of Father</th>
				</tr>
				
				<tr>
					<th>Mother's Name: <u><?php echo $allData[0]['m_name']; ?></u></th>
					<th style='text-align:right'>Father's Name: <u><?php echo $allData[0]['f_name']; ?></u></th>
				</tr>
				
				<tr>
					<th colspan='2'></th>
				</tr>
				
				<tr>
					<th colspan='2'>The documents required to be submitted along with the filled Application form at the time of verification. -</th>
				</tr>
				<tr>
					<td colspan='2' style='text-align:justify'>
						1. Self-Attested photocopy of birth certificate from Municipal Corporation/ Authorized Government Authorities. <br />
						2. One passport size colour  photograph. <br />
						3. Medical Certificate from Government hospital. (For specially abled children)<br />
						4.	Self-Attested photocoy of Transfer Certificate from Last School attended (if not available, it is required at the time of Admission in original).
					</td>
				</tr>
				<tr>
					<td>------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
				</tr>
			</table>
			<table class='table'>
				<tr>
					<th colspan='4' style='font-size:16px;'><center>For office use only</center></th>
					<br/>
				</tr>
				<tr>
					<td colspan='4'></td>
				</tr>
				<tr>
					<th>Verified by:</th>
					<th>_____________</th>
					<th style='text-align:right'>Checked by:</th>
					<th style='text-align:right'>_____________</th>
				</tr>
				<tr>
					<th>Date:</th>
					<th>_____________</th>
					<th style='text-align:right'>Date:</th>
					<th style='text-align:right'>_____________</th>
				</tr>
				<tr>
					<td colspan='4'></td>
				</tr>
				<tr>	
					<td colspan='4'>------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
				</tr>
				<tr>
					<th>&nbsp;</th>
				</tr>
				<tr>
					<th colspan='4' style='font-size:16px;'><center><strong>ACKNOWLEDGEMENT</strong></center></th>
				</tr>
				<tr>
					<td colspan='4'></td>
				</tr>
				<tr>
					<th>Application No.</th>
					<th><u><?php echo $allData[0]['id']."/2020"; ?></u></th>
					<th style='text-align:right'>Father's Name</th>
					<th style='text-align:right'><u><?php echo $allData[0]['f_name']; ?></u></th>
					
				</tr>
				<tr>
					<th>Applicant's Name</th>
					<th><u><?php echo $allData[0]['stu_nm']; ?></u></th>
					<th style='text-align:right'>Submission date</th>
					<th style='text-align:right'><u><?php echo date('d-M-y',strtotime($allData[0]['created_at'])); ?></u></th>
				</tr>
				<tr>	
					<td colspan='4'></td>
				</tr>
				<tr>
					<th colspan='4' style='font-size:16px;'><center>Registration does not guarantee Admission</center></th>
				</tr>
				<tr>	
					<td colspan='4'></td>
				</tr>
				<tr>
					<th colspan='4' style='text-align:right'>School Management</th>
				</tr>
			</table>
		</div>	
		</div>	
	</body>
</html>
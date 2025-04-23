<html>

<head>
	<title>Report Card</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo base_url('assets/dash_css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Laila:700&display=swap" rel="stylesheet">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
	<style>
		.th {
			border: 1px solid #000 !important;
			padding: 10px !important;
		}


		.table1 {
			padding: 10px !important;
			border-spacing: 40px !important;
			font-size: 10px;
			width: 100%;
			border-spacing: 15px !important;
		}

		@page {
			margin: 30px 12px 0px 12px;
		}

		.sign {
			font-family: 'Laila', serif;
		}

		#background {
			position: absolute;
			z-index: -1;
			display: block;
			min-height: 50%;
			min-width: 50%;
			opacity: 0.2;
			margin-top: 20%;
		}
	</style>
</head>

<body>


	<?php
	if (isset($result)) {
		$j = 1;
		$tot_rec = count($result);
		foreach ($result as $key => $data) {

			// echo '<pre>'; print_r($data); echo '</pre>';die;

	        ?>

			<div style="border:5px solid #000; padding:10px;" id='dyn_<?php echo $j; ?>'>
				<div id='background'>
					<center><img src=<?php echo base_url('assets/school_logo/BG_LOGO.png'); ?> width='80%' height='80%'></center>
				</div>
				<table style='border:none !important;padding-left:5px;padding-right:5px;' class='table1'>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>
							<img src="<?php echo base_url($school_photo[0]->School_Logo); ?>" style="width:90px;">
						</td>
						<td>
							<center><span style='font-size:20px !important;'><?php echo $school_setting[0]->School_Name; ?></span><br />
								<span style='font-size:18px !important'>
									<?php echo $school_setting[0]->School_Address; ?>
								</span><br />
								<b>ACADEMIC SESSION: <?php echo $school_setting[0]->School_Session; ?></b>
								<br />
								<b>WEBSITE: https://davnrps.com</b>
							</center>

						</td>
						<td style='text-align:right'>
							<img src="<?php echo base_url($school_photo[0]->School_Logo_RT); ?>" style="width:90px;">
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>
							<span style='font-size:13px !important'>Affiliation No.-
								<?php echo $school_setting[0]->School_AfftNo; ?></span>
						</td>
						<td>
							<b>
								<center><span style='font-size:16px !important;'><b>REPORT CARD-ANNUAL EXAM</b></span></center>
							</b>
						</td>
						<td style='text-align:right'><span style='font-size:13px !important'>School Code-<?php echo $school_setting[0]->School_Code; ?></span></td>
					</tr>
				</table>

				<table style='font-size: 12px !important;padding: 3px !important;width:100%'>
					<tr>
						<th>Admission No. :</th>
						<td style="padding: 8px !important;"><?php echo $data['ADM_NO']; ?><input type='hidden' value='<?php echo $data['ADM_NO']; ?>' id='adm_<?php echo $j; ?>'></td>
						<th>Class-Sec:</th>
						<td style="padding: 8px !important;"><?php echo $data['DISP_CLASS'] . " - " . $data['DISP_SEC']; ?></td>
						<td rowspan="5" colspan="2">
							<center>
								<img src="<?php echo base_url($data['student_image']); ?>" width='120px' height='120px' style="opacity: 1;margin-right: -30px;z-index:2;">
							</center>
						</td>
					</tr>

					<tr>
						<th>Student's Name :</th>
						<td style="padding: 8px !important;"><b><?php echo $data['FIRST_NM'] . " " . $data['MIDDLE_NM']; ?></b></td>
						<th>Roll No.</th>
						<td style="padding: 8px !important;"><?php echo $data['ROLL_NO']; ?></td>
					</tr>

					<tr>
						<th>Mother's Name :</th>
						<td style="padding: 8px !important;" colspan='3'><?php echo $data['MOTHER_NM']; ?></td>
					</tr>

					<tr>
						<th>Father's Name :</th>
						<td style="padding: 8px !important;" colspan='3'><?php echo $data['FATHER_NM']; ?></td>
					</tr>

					<tr>
						<th>Date of Birth :</th>
						<td style="padding: 8px !important;" ><?php echo date('d-M-y', strtotime($data['BIRTH_DT'])); ?></td>
						<th>Attendance :</th>
						<td style="padding: 8px !important;" colspan='3'><?php echo $data['t2_present_days'].'/206'; ?></td>
					</tr>
				</table>
				<br />
				<br />
				<table class='table1' border='1'>
					<tr>
						<th class='th' colspan='2'>Scholastic Areas :</th>

						<th class='th' colspan='3'>
							<center>THEORY</center>
						</th>
						<th class='th' colspan='2'>
							<center>PRACTICAL / I.A.</center>
						</th>
						<th class='th' colspan='1'></th>
						
					</tr>

					<tr>
						<th class='th'>
							<center>Subject Code</center>
						</th>
						<th class='th' style="width:300px;">
							<center>Subject Name</center>
						</th>
						<th class='th'>
							<center> MAX. MARKS <br /></center>
						</th>
						<th class='th'>
							<center> PASS MARKS <br /></center>
						</th>
						<th class='th'>
							<center> MARKS OBT. <br /></center>
						</th>
						<th class='th'>
							<center> MAX. MARKS <br /></center>
						</th>
						<th class='th'>
							<center> MARKS OBT. <br /></center>
						</th>
						<th class='th'>
							<center> MARKS OBT. <br /> (100)</center>
						</th>

						<th class='th'>
							<center> MARKS OBT. <br /> MID TERM(100)</center>
						</th>
						<th class='th'>
							<center> MID TERM + <br /> TERM II(100)</center>
						</th>


					</tr>
					<?php
					$grnd_tot = 0;
					$i = 0;
					?>
					<?php foreach ($data['sub'] as $subject) { ?>
						<tr>
							<th class='th'>
								<center><?php echo $subject['subject_code']; ?></center>
							</th>

							<th class='th'><?php echo $subject['subject_name']; ?></th>

							<th class='th'>
								<center>
									<?php
									if ($subject['subject_code'] == '184' || $subject['subject_code'] == '002' || $subject['subject_code'] == '122' || $subject['subject_code'] == '041' || $subject['subject_code'] == '086' || $subject['subject_code'] == '087' || $subject['subject_code'] == '301' || $subject['subject_code'] == '302' || $subject['subject_code'] == '322' || $subject['subject_code'] == '055' || $subject['subject_code'] == '054' || $subject['subject_code'] == '030' || $subject['subject_code'] == '027' || $subject['subject_code'] == '028') {
									?>80
								<?php } elseif ($subject['subject_code'] == '402'  || $subject['subject_code'] == '413' || $subject['subject_code'] == '417') {
								?> 50
								<?php } elseif ($subject['subject_code'] == '042' || $subject['subject_code'] == '043' || $subject['subject_code'] == '044' || $subject['subject_code'] == '083'  || $subject['subject_code'] == '048' || $subject['subject_code'] == '029') {
								?> 70
								<?php } elseif ($subject['subject_code'] == '049' || $subject['subject_code'] == '034') {
								?> 30 <?php }  ?>
								</center>
							</th>

							<th class='th'>
								<center>
									<?php
									if ($subject['subject_code'] == '184' || $subject['subject_code'] == '002' || $subject['subject_code'] == '122' || $subject['subject_code'] == '041' || $subject['subject_code'] == '086' || $subject['subject_code'] == '087' || $subject['subject_code'] == '301' || $subject['subject_code'] == '302' || $subject['subject_code'] == '322' || $subject['subject_code'] == '055' || $subject['subject_code'] == '027' || $subject['subject_code'] == '054' || $subject['subject_code'] == '030' || $subject['subject_code'] == '028') {
									?>27
								<?php } elseif ($subject['subject_code'] == '402'  || $subject['subject_code'] == '413' || $subject['subject_code'] == '417') {
								?> 17
								<?php } elseif ($subject['subject_code'] == '042' || $subject['subject_code'] == '043' || $subject['subject_code'] == '044'  || $subject['subject_code'] == '083'  || $subject['subject_code'] == '048' || $subject['subject_code'] == '029') {
								?> 23
								<?php } elseif ($subject['subject_code'] == '049' || $subject['subject_code'] == '034') {
								?> 10 <?php }  ?>
								</center>
							</th>

							<td>
								<?php if ($subject['opt_code'] != 1) { ?>
									<center><?php echo $subject['marks']['marks_obtained_t2']; ?></center>
								<?php } ?>
							</td>


							<th class='th'>
								<center>
									<?php
									if ($subject['subject_code'] == '184' || $subject['subject_code'] == '002' || $subject['subject_code'] == '122' || $subject['subject_code'] == '041' || $subject['subject_code'] == '086' || $subject['subject_code'] == '087' || $subject['subject_code'] == '301' || $subject['subject_code'] == '302' || $subject['subject_code'] == '322' || $subject['subject_code'] == '055' || $subject['subject_code'] == '027' || $subject['subject_code'] == '054' || $subject['subject_code'] == '030' || $subject['subject_code'] == '028' ) {
									?>20
								<?php } elseif ($subject['subject_code'] == '402' || $subject['subject_code'] == '413' || $subject['subject_code'] == '417') {
								?> 50
								<?php } elseif ($subject['subject_code'] == '042' || $subject['subject_code'] == '043' || $subject['subject_code'] == '083' || $subject['subject_code'] == '044'   || $subject['subject_code'] == '048' || $subject['subject_code'] == '029') {
								?> 30
								<?php } elseif ($subject['subject_code'] == '049' || $subject['subject_code'] == '034') {
								?> 70 <?php }  ?>
								</center>
							</th>

							<td>
								<?php if ($subject['opt_code'] != 1) { ?>
									<center><?php echo $subject['marks']['ia']; ?></center>
								<?php } ?>
							</td>

							<td>
								<center><?php echo $subject['marks']['total_t2']; ?></center>
							</td>

							<td>
								<?php if ($subject['opt_code'] != 1) { ?>
									<center><?php echo $subject['marks']['half_yearly']; ?></center>
								<?php } ?>
							</td>
							<td>
								<center><?php echo $subject['marks']['total_marks_obtained_t2']; ?></center>
							</td>

						</tr>
						<?php
						if ($subject['opt_code'] != 1) {
							$grnd_tot += $subject['marks']['marks_obtained'];
							$i += 1;
						}
						$grd = $grnd_tot / $i;
						$grd = ($round_off == 1) ? round($grd) : number_format($grd, 2);
						?>
					<?php } ?>


				</table>


				<div class='row'>
					<div class='col-xs-12'>
						<table class='table1' border='1' style="width:100%;font-size: 12px;">

							<tr>
								<td colspan='2' style='height:100px;' 'border:1px;'><b>Remarks:</b>  <?php echo ucfirst($data['rmks']); ?></td>
							</tr>
						</table>
					</div>



				</div>
				<br />
				<br />
				<br />
				<br />

				<div class='row'>
					<div class='col-sm-12'>
						<table class='table1' style="font-size: 12px;">
							<tr>
								<td class='sign'><br /><br />
									<center>SIGNATURE OF CLASS TEACHER</center>
								</td>
								<td class='sign'><br /><br />
									<center>SIGNATURE OF PARENTS</center>
								</td>
								<td class='sign'><br /><br />
									<center>SIGNATURE OF PRINCIPAL</center>
								</td>
							</tr>
							<tr>
								<td><br /><br /><b>Date of Result declaration:  21-MARCH-2025</b></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<?php if ($tot_rec  > $j++) { ?>
				<div style='page-break-after: always;'></div>
			<?php } ?>
			<?php
			?>

	<?php
		}
	}
	?>

	<!-- Modal -->
	<!-- <div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<center><img class='img-responsive' src="<?php echo base_url('assets/images/loading.gif'); ?>"></center>
				</div>
			</div>
		</div>
	</div> -->
	<!-- end Modal -->
</body>

</html>
<!-- <script>
	var lp = '<?php //echo $j; 
				?>';
	var lp = lp - 1;
	$('#myModal').modal('show');
	for (var i = 1; i <= lp; i++) {
		var ab = $("#dyn_" + i).html();
		var adm = $("#adm_" + i).val();
		$.ajax({
			url: "<?php //echo base_url('report_card/report_card/adpdf') 
					?>",
			data: {
				'value': ab,
				'idd': i,
				'admno': adm,
				'lp': lp
			},
			type: "POST",
			success: function(data) {
				if (lp == data) {
					$('#myModal').modal('hide');
					$.toast({
						heading: 'Success',
						text: 'Successfully Genrated Report Card..!!',
						showHideTransition: 'slide',
						icon: 'success',
						position: 'top-right',
					});
					window.top.close();
				}
			}
		});
	}
</script> -->
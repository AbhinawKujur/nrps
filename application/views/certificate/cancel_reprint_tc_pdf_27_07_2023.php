<html>
	<head>
		<title>School Leaving Certificate</title>
		<style>
			@page { margin: 10px 5px 0px 5px; }
			.table,tr,td{
				height:27px;
				border-top:1px solid #F4F6F6;
				margin:2px 2px;
			}
			
			.border_bottom{
				border-bottom:1px solid #000;
				font-style:italic;
				font-family: "Times New Roman", Times, serif;
				font-size:13px;
				font-weight:bold;
			}
			
			.caption{
				font-family: Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif; 
				font-size:13px;
			}
		</style>
	</head>
	
	<body style='border:5px solid #000;'>
		<?php
			error_reporting(0);
			if($tc_details){
				$adm_date = $tc_details[0]->ADM_DATE;
				$dob      = $tc_details[0]->BIRTH_DT;
				$text019  = $tc_details[0]->text019;
				$text020  = $tc_details[0]->text020;
				$adm_d    = date("d-M-Y",strtotime($adm_date));
				$dob_t    = date("d-M-Y",strtotime($dob));
				$text0191 = date("d-M-Y",strtotime($text019));
				$text0201 = date("d-M-Y",strtotime($text020));
			}
		?>
		<table style='width:100%' class='table'>
			<tr>
				<td style='text-align:left'><img src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>" id="image" style='width:110px'></td>
				<td>
					<center><span style='font-size:19px; font-weight:bold;'><?php echo $school_setting[0]->School_Name; ?></span></center>
					<center><?php echo $school_setting[0]->School_Address; ?></center>
					<center>Session (<?php echo $school_setting[0]->School_Session; ?>)</center>
					<center><span style='font-size:14px;'>Managed By: D.A.V College Managing Committee, New Delhi-55</span></center>
					<center><span style='font-size:14px;'>Affiliated To: C.B.S.E. New Delhi vide Affln. No.: 3430103</span></center>
					<center>(School No.: 66302)</center>
				</td>
				<td style='text-align:right'><img src="assets/school_logo/CBSE_LOGO.jpg" id="image" style='width:100px; margin:5px;'></td>
			</tr>
			<tr>
				<td colspan='3' style='font-size:22px; background:#000; color:#fff;' class='caption'><center><span ><b>TRANSFER CERTIFICATE</b></span></center></td>
			</tr>
		</table>
		
		
		<table style='width:100%' cellspacing='0' class='table'>
			<tr>
				<td class='caption'style="font-family:calibri;font-size:12px;font-weight:bold">TC. No.</td>
				<td colspan='5'>: <?php echo $tc_details[0]->TCNO; ?></td>
			</tr>
			<tr>
				<td class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">Adm No.</td>
				<td>: <?php echo $tc_details[0]->adm_no; ?></td>
				<td class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">Registration No.</td>
				<td>: <?php echo $tc_details[0]->RegistrationNo; ?></td>
				<td class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">Board's Roll No.</td>
				<td>: <?php echo $tc_details[0]->BoardRollNo; ?></td>
			</tr>
			<tr>
				<td class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">01. Name Of The Pupil</td>
				<td colspan='5' class='border_bottom'>: <?php echo $tc_details[0]->Name; ?></td>
			</tr>
			<tr>
				<td class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">02. Mother's Name</td>
				<td colspan='5' class='border_bottom'>: <?php echo $tc_details[0]->Mother_NM; ?></td>
			</tr>
			<tr>
				<td class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">03. Father's Name</td>
				<td colspan='5' class='border_bottom'>: <?php echo $tc_details[0]->Father_NM; ?></td>
			</tr>
			<tr>
				<td class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">04. Nationality</td>
				<td class='border_bottom'>: <?php echo $tc_details[0]->Nation; ?></td>
				<td colspan='2' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">05. Whether S.C or S.T.</td>
				<td colspan='2' class='border_bottom'>: <?php echo $tc_details[0]->Category; ?></td>
			</tr>
			<tr>
				<td colspan='2' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">06. Admission Date In School</td>
				<td class='border_bottom'>: <?php echo $adm_d; ?></td>
				<td class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">In Class</td>
				<td colspan='2' class='border_bottom'>: <?php echo $tc_details[0]->ADM_CLASS; ?></td>
			</tr>
			<tr>
				<td colspan='5' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">07. Date of birth (in Christan Era) as recorded in the Admission Register</td>
				<td class='border_bottom'>: <?php echo $dob_t; ?></td>
			</tr>
			<tr>
				<td class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">In Words</td>
				<td colspan="5" class='border_bottom'>: <?php echo $tc_details[0]->dob_inwords; ?></td>
			</tr>
			<tr>
				<td colspan='2' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">08. Class in which the pupil studied last</td>
				<td class='border_bottom'>: <?php echo $tc_details[0]->current_Class; ?></td>
				<td colspan='2' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">09. Whether failed, in same class </td>
				<td class='border_bottom'>: <?php echo $tc_details[0]->combo09; ?></td>
			</tr>
			<tr>
				<td colspan='3' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">10. School/Board Annual Examinaton Last Taken with Result</td>
				<td colspan='3' class='border_bottom'>: <?php echo $tc_details[0]->TEXT08a; ?> <?php echo $tc_details[0]->text08b; ?></td>
			</tr>
			<tr>
				<td colspan="6" class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">12. Subject Studied</td>
			</tr>
			<tr>
				<td class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">(A) Compulsory</td>
				<td colspan="5">
					<table cellspacing="0" width="100%">
						<tr>
							<td class='border_bottom'>(1) <?php echo $tc_details[0]->textsub1; ?></td>
							<td class='border_bottom'>(2) <?php echo $tc_details[0]->textsub2; ?></td>
						</tr>
						<tr>
							<td class='border_bottom'>(3) <?php echo $tc_details[0]->textsub3; ?></td>
							<td class='border_bottom'>(4) <?php echo $tc_details[0]->textsub4; ?></td>
						</tr>
						<tr>
							<td class='border_bottom'>(5) <?php echo $tc_details[0]->textsub5; ?></td>
							<td class='border_bottom'>(6) <?php echo $tc_details[0]->textsub6; ?></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">(B) Optional</td>
				<td colspan="5">
					<table cellspacing="0" width="100%">
						<tr>
							<td class='border_bottom'>(1) <?php echo $tc_details[0]->textsub7; ?></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan='2' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">13. Whether qualified for promotion to higher class</td>
				<td class='border_bottom'>: <?php echo $tc_details[0]->combo011; ?></td>
				<td colspan='1' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">if so, to which class (in figure)</td>
				<td class='border_bottom'>: <?php echo $tc_details[0]->datacombo011; ?> (<?php echo $tc_details[0]->txtClsW; ?>)</td>
			</tr>
			<tr>
				<td colspan="4" class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">14. Month upto which the pupil has paid school due</td>
				<td colspan="2" class='border_bottom'>: <?php echo $tc_details[0]->combo12a; ?></td>
			</tr>
			<tr>
				<td colspan='2' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">15. Any fee concession availed</td>
				<td class='border_bottom'>: <?php echo $tc_details[0]->combo016; ?></td>
				<td colspan='2' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">if so the nature of such concession</td>
				<td class='border_bottom'>: <?php echo ($tc_details[0]->combo016 == 'NO')?"-":$tc_details[0]->text017; ?></td>
			</tr>
			<tr>
				<td colspan='2' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">16. Total No. of School Working days</td>
				<td class='border_bottom'>: <?php echo $tc_details[0]->text014; ?></td>
				<td colspan='2' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">17. Total No. of Days Present</td>
				<td class='border_bottom'>: <?php echo $tc_details[0]->text015; ?></td>
			</tr>
			<tr>
				<td colspan="4" class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">18. Whether NCC cadet/Boy/Girl Guide (Give Details)</td>
				<td colspan="2" class='border_bottom'>: <?php echo $tc_details[0]->combo013; ?></td>
			</tr>
			<tr>
				<td colspan="4" class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">19. Games played/extra curricular actvites(Please Mention If Any)</td>
				<td colspan="2" class='border_bottom'>: <?php echo $tc_details[0]->combo012b; ?></td>
			</tr>
			<tr>
				<td colspan="3" class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">20. General Conduct</td>
				<td colspan="3" class='border_bottom'>: <?php echo $tc_details[0]->combo018; ?></td>
			</tr>
			<tr>
				<td colspan='2' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">21. Date of applicaton for certficate</td>
				<td class='border_bottom'>: <?php echo $text0191; ?></td>
				<td colspan='2' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">22. Date of issue of Certficate</td>
				<td class='border_bottom'>: <?php echo $text0201; ?></td>
			</tr>
			<tr>
				<td colspan='2' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">23. Reasons for leaving the school</td>
				<td class='border_bottom'>: <?php echo $tc_details[0]->text021; ?></td>
				<td colspan='2' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">24. Any other Remarks</td>
				<td class='border_bottom'>: <?php echo $tc_details[0]->text022; ?></td>
			</tr>
			<tr>
				<td colspan="6"><br /><br /><br /></td>
			</tr>
			<tr>
				<td><center><b>Clerk</b></center></td>
				<td><center><b>Class Teacher</b></center></td>
				<td colspan="3"><center><b>Checked by <br /> ( Name & Designation)</b></center></td>
				<td><b>Principal</b></td>
			</tr>
		</table>
	</body>
</html>
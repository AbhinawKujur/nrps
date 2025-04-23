<html>
	<head>
		<link href='https://fonts.googleapis.com/css?family=Bungee+Inline' rel='stylesheet' type='text/css'>
		<title>Report Card</title>
		<style>
			table{
				width:100%;
			}
			table tr td,th{
				text-align:center;
				font-size:16px;
				height:30px;
			}
			
			
			.page_break { page-break-before: always; }
			@page { margin: 0px;}
            body { margin: 0px 15px 0px 15px;}
			.stu_details{
				text-align:left !important;
				font-size:16px !important;
			}
			.clear{ 
				clear:both
			}
			.school_name{
				font-family: 'Bungee Inline', cursive;
				color:#201542;
			}
			.sign td{
				font-family: 'Bungee Inline', cursive;
			}
		</style>
	</head>
	<body>
	<!-- header -->
		<table style='border:none !important;'>
			<tr>
				<td style='text-align:left'>
					<img src="assets/school_logo/CBSE_LOGO.jpg" style="width:80px;">
				</td>
				<td>
					<center><span style='font-size:25px !important;' class='school_name'><?php echo $school_setting[0]->School_Name; ?></span><br /
					>
					<span style='font-size:18px !important;'>
					<?php echo $school_setting[0]->School_Address; ?>
					</span><br />
					
						<b><center><span style='color:#566573; font-size:18px'>ACHIEVEMENT RECORD</span></center></b>
					</center>
				</td>
				<td style='text-align:right'>
					<img src="<?php echo $school_photo[0]->School_Logo_RT; ?>" style="width:70px;">
				</td>
			</tr>
			<tr>
				<td style='text-align:left'>
					<span style='font-size:13px !important'>Affiliation No.-
					<?php echo $school_setting[0]->School_AfftNo; ?></span>
				</td>
				<td>
					<!--<b><center><span style='color:#566573; font-size:18px'>PROGRESS REPORT</span></center></b>-->
					<b><center><span style='color:#566573; font-size:18px'>ACADEMIC SESSION: 2019-20</span></center></b>
					
				</td>
				<td style='text-align:right'>
					<span style='font-size:13px !important'>School Code-<?php echo $school_setting[0]->School_Code; ?></span>
				</td>
			</tr>
		</table><hr />
		
		<table class='table stu_details'>
			<tr>
			  <th>Admission No.</th>
			  <th>:</th>
			  <td><?php echo $stuData[0]['AdmNo']; ?></td>
			  <th>Class-Sec</th>
			  <th>:</th>
			  <td><?php echo $stuData[0]['Class'].'-'.$stuData[0]['Sec']; ?></td>
			</tr>
			
			<tr>
			  <th>Roll No.</th>
			  <th>:</th>
			  <td><?php echo $stuData[0]['RollNo']; ?></td>	
			  <th>Student's Name</th>
			  <th>:</th>
			  <td><?php echo $stuData[0]['StudentName']; ?></td>
			</tr>
			
			<tr>
			  <th>Mother's Name</th>
			  <th>:</th>
			  <td><?php echo $stuData[0]['MOTHER_NM']; ?></td>
			  <th>Father's Name</th>
			  <th>:</th>
			  <td><?php echo $stuData[0]['FATHER_NM']; ?></td>
			</tr>
			
			<tr>
			  <th>Date of Birth</th>
			  <th>:</th>
			  <td><?php echo date('d-M-Y',strtotime($stuData[0]['BIRTH_DT'])); ?></td>
			  <th>Blood Group</th>
			  <th>:</th>
			  <td><?php echo $stuData[0]['BLOOD_GRP']; ?></td>
			</tr>
	    </table><br />
	<!-- end header -->
		<table border='1' cellspacing='0' class='tb'>
		
			<tr>
				<td style='background:#201542; color:#fff;'>SUBJECTS</td>
				<td style='background:#201542; color:#fff;'>MAX MARKS</td>
				<td style='background:#201542; color:#fff;'>MARKS OBTAINED</td>
				<td style='background:#201542; color:#fff;'>TOTAL MARKS OBTAINED</td>
				
			</tr>
			<!-- english -->
			<?php if($stuData[0]['Sub1']!=""){
			?>
			<tr>
				<td style='background:#EAEDED;'><?php echo $stuData[0]['Sub1']; ?></td>
				<td><?php echo $stuData[0]['sub1_th_max']; ?></td>
				<td><?php echo round($stuData[0]['sub1_tot']); ?></td>
				<td><?php echo round($stuData[0]['sub1_tot']); ?></td>
			</tr>
			<?php } ?>
				<?php if($stuData[0]['sub2']!=""){
				?>
				<tr>
				<td style='background:#EAEDED;'><?php echo $stuData[0]['sub2']; ?></td>
				<td><?php echo $stuData[0]['sub2_th_max']; ?></td>
				<td><?php echo round($stuData[0]['sub2_tot']); ?></td>
				<td><?php echo round($stuData[0]['sub2_tot']); ?></td>
			</tr>
			<?php } ?>
					<?php if($stuData[0]['sub3']!=""){
				?>
			
				<tr>
				<td style='background:#EAEDED;'><?php echo $stuData[0]['sub3']; ?></td>
				<td><?php echo $stuData[0]['sub3_th_max']; ?></td>
				<td><?php echo round($stuData[0]['sub3_tot']); ?></td>
				<td><?php echo round($stuData[0]['sub3_tot']); ?></td>
			</tr>
			<?php } ?>
					<?php if($stuData[0]['sub4']!=""){
				?>
			<tr>
				<td style='background:#EAEDED;'><?php echo $stuData[0]['sub4']; ?></td>
				<td><?php echo $stuData[0]['sub4_th_max']; ?></td>
				<td><?php echo round($stuData[0]['sub4_tot']); ?></td>
				<td><?php echo round($stuData[0]['sub4_tot']); ?></td>
			</tr>
			<?php } ?>
				<?php if($stuData[0]['sub5']!=""){
				?>
				<tr>
				<td style='background:#EAEDED;'><?php echo $stuData[0]['sub5']; ?></td>
				<td><?php echo $stuData[0]['sub5_th_max']; ?></td>
				<td><?php echo round($stuData[0]['sub5_tot']); ?></td>
				<td><?php echo round($stuData[0]['sub5_tot']); ?></td>
			</tr>
			<?php } ?>
					<?php if($stuData[0]['sub6']!=""){
				?>
			<tr>
				<td style='background:#EAEDED;'><?php echo $stuData[0]['sub6']; ?></td>
				<td><?php echo $stuData[0]['sub6_th_max']; ?></td>
				<td><?php echo round($stuData[0]['sub6_tot']); ?></td>
				<td><?php echo round($stuData[0]['sub6_tot']); ?></td>
			</tr>
			<?php } ?>
					<?php if($stuData[0]['sub7']!=""){
				?>
			<tr>
				<td style='background:#EAEDED;'><?php echo $stuData[0]['sub7']; ?></td>
				<td><?php echo $stuData[0]['sub7_th_max']; ?></td>
				<td><?php echo round($stuData[0]['sub7_tot']); ?></td>
				<td><?php echo round($stuData[0]['sub7_tot']); ?></td>
			</tr>
			<?php } ?>
					<?php if($stuData[0]['sub8']!=""){
				?>
			<tr>
				<td style='background:#EAEDED;'><?php echo $stuData[0]['sub8']; ?></td>
				<td><?php echo $stuData[0]['sub8_th_max']; ?></td>
				<td><?php echo round($stuData[0]['sub8_tot']); ?></td>
				<td><?php echo round($stuData[0]['sub8_tot']); ?></td>
			</tr>
			<?php } ?>
			<tr>
				
				<td style='background:#201542; color:#fff;float:right' colspan='4'>TOTAL MARKS: <?php echo $stuData[0]['total_marks']; ?></td>
			</tr>
			<!-- end english -->
			
			<!-- hindi -->
			
			<!-- end music -->
			
			</table>

		<table style="width:100%;" class='clear sign'>
			<tr>
				<td><br /><br /></td>
			</tr>
			<tr>
				<?php
					foreach($signature as $key => $val){
						if($key != 3){
						?>
							<td style="text-align:center;"><?php echo $val['SIGNATURE']; ?></td>
						<?php
						}
					}
				?>
			</tr>
		</table>
	</body>
</html>
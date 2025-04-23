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
				font-size:13px;
			}
			.page_break { page-break-before: always; }
			@page { margin: 0px; }
            body { margin: 0px 15px 0px 15px;}
			#tab1{
				float:left;
				font-size:18px;
				text-align:left !important;
			}
			#tab2{
				float:right;
				font-size:18px;
			}
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
	<?php
	    $j = 1;
	    $tot_rec = count($admno);
		foreach($admno as $keyy => $vall){
			$stuData = $this->alam->selectA('student','ADM_NO,FIRST_NM,BIRTH_DT,DISP_CLASS,DISP_SEC,ROLL_NO,FATHER_NM,MOTHER_NM',"ADM_NO='$vall'");
	?>
	<!-- header -->
		<table style='border:none !important;'>
			<tr>
				<td>
					<img src="<?php echo $school_photo[0]->School_Logo; ?>" style="width:100px;">
				</td>
				<td>
					<center><span style='font-size:25px !important;' class='school_name'><?php echo $school_setting[0]->School_Name; ?></span><br /
					>
					<span style='font-size:18px !important'>
					<?php echo $school_setting[0]->School_Address; ?>
					</span><br />
					<b>ACADEMIC SESSION: <?php echo $school_setting[0]->School_Session; ?></b>
					</center>
				</td>
				<td style='text-align:right'>
					<img src="<?php echo $school_photo[0]->School_Logo_RT; ?>" style="width:120px;">
				</td>
			</tr>
			<tr>
				<td>
				<span style='font-size:13px !important'>Affiliation No.-
				<?php echo $school_setting[0]->School_AfftNo; ?></span>
				</td>
				<td>
				<h2>PROGRESS REPORT</h2>
				</td>
				<td style='text-align:right'><span style='font-size:13px !important'>School Code-<?php echo $school_setting[0]->School_Code; ?></span></td>
			</tr>
		</table><hr />
		
		<table class='table stu_details'>
			<tr>
			  <th>Admission No.</th>
			  <th>:</th>
			  <td><?php echo $stuData[0]['ADM_NO']; ?></td>
			  <th>Class/Sec</th>
			  <th>:</th>
			  <td><?php echo $stuData[0]['DISP_CLASS'] ." - " . $stuData[0]['DISP_SEC']; ?></td>
			</tr>
			
			<tr>
			  <th>Roll No.</th>
			  <th>:</th>
			  <td><?php echo $stuData[0]['ROLL_NO']; ?></td>	
			  <th>Student's Name</th>
			  <th>:</th>
			  <td><?php echo $stuData[0]['FIRST_NM']; ?></td>
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
			  <td><?php echo date('d-M-y',strtotime($stuData[0]['BIRTH_DT'])); ?></td>
			  <th>Attendance</th>
			  <th>:</th>
			  <td></td>
			</tr>
	    </table><br />
	<!-- end header -->
		<table>
		
		</table>
		<table border='1' cellspacing='0'>
			<tr>
				<th style='background:#201542; color:#fff;'>SUBJECTS</th>
				<th style='background:#201542; color:#fff;'>MID TERM</th>
				<th style='background:#201542; color:#fff;'>END TERM</th>
			</tr>
			<?php
				foreach($subSkill as $key => $val){
					$subjid = $val['subject_code'];
					if($subjid != '37'){
						$skillData = $this->alam->selectA('subject_skill_master',"id,skill_name,(SELECT m2 FROM marks_all WHERE admno='$vall' AND examcode='4' AND subject='$subjid' AND class_code='$Class_No' AND sec_code='$sec' AND term='1' AND status='1' AND subject_skill=subject_skill_master.id)T1m2,(SELECT m2 FROM marks_all WHERE admno='$vall' AND examcode='5' AND subject='$subjid' AND class_code='$Class_No' AND sec_code='$sec' AND term='2' AND status='1' AND subject_skill=subject_skill_master.id)T2m2","class_code='$Class_No' AND subject_code='$subjid'");
					}else{
						$skillData = $this->alam->selectA('subject_skill_master',"id,skill_name,(SELECT grade FROM co_scholastic_grade_all WHERE admno='$vall' AND subject='$subjid' AND class_code='$Class_No' AND sec_code='$sec' AND term='1' AND subj_skill_id=subject_skill_master.id)T1m2,(SELECT grade FROM co_scholastic_grade_all WHERE admno='$vall' AND subject='$subjid' AND class_code='$Class_No' AND sec_code='$sec' AND term='2' AND subj_skill_id=subject_skill_master.id)T2m2","class_code='$Class_No' AND subject_code='$subjid'");
					}
					
					//echo $this->db->last_query() ."<br /><br />";
			?>
			<tr>
				<td style='text-align:left !important; background:#EAEDED;' colspan='3'><b><?php echo $val['subjnm']; ?></b></td>
			</tr>
			<?php
				foreach($skillData as $key1 => $val1){
				?>
				<tr>
					<td style='background:#EAEDED;'><?php echo $val1['skill_name']; ?></td>
					<td style='background:<?php echo $color[$val1['T1m2']]; ?>'><?php echo $val1['T1m2']; ?></td>
					<td style='background:<?php echo $color[$val1['T2m2']]; ?>'><?php echo $val1['T2m2']; ?></td>
				</tr>
				<?php } ?>		
				<?php
				}
			?>
		</table >
		<table border='1' cellspacing='0'>
			<tr>
				<th colspan='2' style='background:#201542; color:#fff;'><center>REMARKS</center></th>
			</tr>
			<tr>
				<th>MID TERM</th>
				<th>END TERM</th>
			</tr>
			<?php
				$remarksT1 = $this->alam->selectA('remarks','Remarks',"ADM_NO='$vall' and TERM='TERM-1'");
				$remksT1 = isset($remarksT1[0]['Remarks'])?$remarksT1[0]['Remarks']:'';
				$remarksT2 = $this->alam->selectA('remarks','Remarks',"ADM_NO='$vall' and TERM='TERM-2'");
				$remksT2 = isset($remarksT2[0]['Remarks'])?$remarksT2[0]['Remarks']:'';
			?>
			<tr>
				<td style='height:70px !important; width:50%'>
					<center>
					<?php echo $remksT1; ?>	
					</center>
				</td>
				<td style='height:70px !important; width:50%'>
					<center>
					<?php echo $remksT2; ?>	
					</center>
				</td>
			</tr>
			<tr>
				<th colspan='2' style='background:#201542; color:#fff;'><center>SPECIFIC PARTICIPATION</center></th>
			</tr>
			<tr>
				<td colspan='2' style='height:80px !important'></td>
			</tr>
		</table><br />
		
		<label><b>Congratulations!! Promoted to Class ..........................................</b></label>
		<label><b>New Session Begins on ............................................</b></label>
		
		<table style='width:113%' class='clear sign'>
			<tr>
				<td><br /><br /></td>
			</tr>
			<tr>
				<?php
					foreach($signature as $key => $val){
						if($key != 3){
						?>
							<td style='text-align:left;'><?php echo $val['SIGNATURE']; ?></td>
						<?php
						}
					}
				?>
			</tr>
		</table>
		<?php if($tot_rec  > $j++) { ?>
	    <div style='page-break-after: always;'></div>
	    <?php } ?>
		<?php } ?>
	</body>
</html>
<html>
	<title>MARKS REPORT</title>
	<head>
		<style>
			.page_break { page-break-before: always; }
		</style>
	</head>
		<body>
			<?php
				$i = 0; 
				$len = count($stuList);
				foreach($stuList as $key => $val){
			?>
			<table width='100%'>
				<tr>
					<td><center><img src='<?php echo ('assets/school_logo/dps.png'); ?>' class='img-responsive'></center></td>
					<td><h2><center>Delhi Public School, Ranchi</center></h2></td>
				</tr>
			</table>
			<table style='width:100%'>
				<tr>
					<th>Adm. No.:</th>
					<td><?php echo $val['admno']; ?></td>
					<th>Class/Sec:</th>
					<td><?php echo $val['classnm']."/".$val['secnm']; ?></td>
				</tr>
				<tr>
					<th>Student Name:</th>
					<td><?php echo $val['firstnm']; ?></td>
					<th>Exam Date:</th>
					<td><?php echo $val['examDate']; ?></td>
				</tr>
				<tr>
					<th>Subject:</th>
					<td><?php echo $val['subjnm']; ?></td>
					<th></th>
					<td></td>
				</tr>
			</table><br /><br /><br />
			<p style="font-size:15;font-family:verdana"><center><b>EXAM ANSWER SCRIPT</b></center></p>
			<br>
			<table style='width:100%' border='1' cellspacing='0'>
				
				<?php
				$queAnsRmks = $this->alam->selectA("e_exam_answers","*,(select question from e_exam_questions where id=e_exam_answers.que_id)question,(select max_marks from e_exam_questions where id=e_exam_answers.que_id)mm","class_no='".$val['class_no']."' AND sec_no='".$val['sec_no']."' AND subj_id='".$val['subj_id']."' AND admno='".$val['admno']."'");
				$totobt = 0;
				foreach($queAnsRmks as $key1 => $val1){
					$totobt += $val1['ob_marks'];
				?>
				<tr>
					<th><?php echo"Q".($key1 + 1) ."- ".$val1['question']; ?></th>
					<th><center style='color:red'><?php echo $val1['mm']; ?><center></th>
				</tr>
				<tr>	
					<td><?php echo "Ans- ".$val1['ans']; ?></td>
					<td><center><?php echo $val1['ob_marks']; ?></center></td>
				</tr>
				<tr>	
					<td colspan='2'><b>Remarks-</b><?php echo " ".$val1['remarks']; ?></td>
				</tr>
				<?php } ?>
				<tr>
					<th>Total Marks-</th>
					<td><center><?php echo " ".$totobt; ?></center></td>
				</tr>
			</table>
			<?php
			if ($i < $len - 1) {
				$i++;
			?>
			<div class="page_break"></div>
			<?php } } ?>
		</body>
</html>
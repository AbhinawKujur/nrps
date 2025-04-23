<html>
	<title>HOMEWORK REPORT</title>
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
					<th>Submission Date:</th>
					<td><?php echo date('d-M-Y',strtotime($val['target_date'])); ?></td>
				</tr>
				<tr>
					<th>Subject:</th>
					<td><?php echo $val['subjnm']; ?></td>
					<th></th>
					
				</tr>
			</table><br /><br /><br />
			<p style="font-size:15;font-family:verdana"><center><b>HOMEWORK COPY</b></center></p>
			<br>
			<table style='width:100%' border='1' cellspacing='0'>
			
				<?php
				$queAnsRmks = $this->alam->selectA("e_exam_answers_hw",'*',"class_no='".$val['class_no']."' AND sec_no='".$val['sec_no']."' AND subj_id='".$val['subj_id']."' AND admno='".$val['admno']."' AND homework_id='".$val['homework_id']."' ");
				
				foreach($queAnsRmks as $key1 => $val1){
				$ids	=$val1['que_id'];
				$q_img	=$this->alam->selectA('e_exam_questions_hw_append','*',"id='$ids' and que_img!=''");
				if(!empty($q_img[0]['que_img'])){			
				$img	=$q_img[0]['que_img'];
				}else{
				$img="";
				}
					
				?>
				<tr>
					<th height="50px"><?php echo"Q".($key1 + 1) ."- ".$val1['question']; ?>
					</th>
					<th width="50px"><?php if($img!=""){?><img src="<?=$img;?>" style="width:50px;height:50px;float:right;"><?php } ?></th>
					
				</tr>
				<tr>	
					<td height="50px"><?php echo "Ans- ".$val1['ans']; ?></td>
					<td height="50px"><?php if($val1['img_status']==1){?><img src="<?=$val1['img'];?>" style="width:50px;height:50px;float:right;"><?php } ?></td>
					
				</tr>
				<tr>	
					<td><b>Remarks-</b><?php echo " ".$val1['remarks']; ?></td>
					<td></td>
				</tr>
				<?php } ?>
				
			</table>
			<?php
			if ($i < $len - 1) {
				$i++;
			?>
			<div class="page_break"></div>
			<?php } } ?>
		</body>
</html>
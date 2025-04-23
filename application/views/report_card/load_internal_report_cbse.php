<style>
	table{
		text-align:center;
	}
</style>

<div class='table-responsive'>
<table border='1' class='table dataTable'>
<thead>
	<tr>
		<th><center>Roll No.</center></th>
		<th><center>Adm. No.</center></th>
		<th><center>Name</center></th>
		<?php
			foreach($subjectData as $key => $val){
				?>
					<th></th>
					<th></th>
					<th></th>
					<th><center><?php echo $val['subj_nm']; ?></center></th>
					<th></th>
					<th></th>
					<th></th>
				<?php
			}
		?>
	</tr>
</thead>
<tbody>	
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<?php
			foreach($subjectData as $key => $val){
				?>
					<td><center>PT1</center></td>
					<td><center>PT2</center></td>
					<td><center>PT3</center></td>
					<td><center>Average of Best Two PT</center></td>
					<td><center>NB</center></td>
					<td><center>SE</center></td>
					<td><center>Out of 20</center></td>
				<?php
			}
		?>
	</tr>		
<?php
	foreach($stuData as $key => $val){
		?>
			<tr>
				<td><?php echo $val['ROLL_NO']; ?></td>
				<td><?php echo $val['ADM_NO']; ?></td>
				<td><?php echo $val['FIRST_NM']; ?></td>
				<?php
					$bestTwo = array();
					foreach($subjectData as $key1 => $val1){
						$pt1   = 0;
						$hy    = 0;
						$pt3   = 0;
						$pt    = 0;
						$nbuk  = 0;
	                    $subE  = 0;
						$outof = 0;
						$pt1 = $this->alam->selectA('marks','admno,ExamC,SCode,M1,M2,M3',"admno='".$val['ADM_NO']."' AND Classes='".$val['CLASS']."' AND Sec='".$val['SEC']."' AND Term='TERM-1' AND SCode='".$val1['subject_code']."' AND ExamC='1'");
						
						$hy  = $this->alam->selectA('marks','admno,ExamC,SCode,M1,M2,M3',"admno='".$val['ADM_NO']."' AND Classes='".$val['CLASS']."' AND Sec='".$val['SEC']."' AND Term='TERM-1' AND SCode='".$val1['subject_code']."' AND ExamC='4'");
						
						$pt3 = $this->alam->selectA('marks','admno,ExamC,SCode,M1,M2,M3',"admno='".$val['ADM_NO']."' AND Classes='".$val['CLASS']."' AND Sec='".$val['SEC']."' AND Term='TERM-2' AND SCode='".$val1['subject_code']."' AND ExamC='8'");
						
						$nb =  $this->alam->selectA('marks','admno,ExamC,SCode,M1,M2,M3',"admno='".$val['ADM_NO']."' AND Classes='".$val['CLASS']."' AND Sec='".$val['SEC']."' AND Term='TERM-2' AND SCode='".$val1['subject_code']."' AND ExamC='2'");
						
						$se =  $this->alam->selectA('marks','admno,ExamC,SCode,M1,M2,M3',"admno='".$val['ADM_NO']."' AND Classes='".$val['CLASS']."' AND Sec='".$val['SEC']."' AND Term='TERM-2' AND SCode='".$val1['subject_code']."' AND ExamC='3'");
						
						if(!empty($nb)){
							$nbuk = $nb[0]['M3'];
						}else{
							$nb = 0;
						}
						
						if(!empty($se)){
							$subE = $se[0]['M3'];
						}else{
							$se = 0;
						}
						
						if(!empty($pt1)){
							if($pt1[0]['M2'] != 'AB'){
								$pt1mrks   = $pt1[0]['M3'];
								$pt1Mxmrks = $pt1[0]['M1'];
								$pt1       = ($round==1)?round(($pt1mrks/$pt1Mxmrks)*(10)):number_format(($pt1mrks/$pt1Mxmrks)*(10),2);
							}else{
								$pt1 = 'AB';
							}
						}else{
							$pt1 = 0;
						}
						
						if(!empty($hy)){
							if($hy[0]['M2'] != 'AB'){
								$hymrks    = $hy[0]['M3'];
								$hyMxmrks  = $hy[0]['M1'];
								$hy        = ($round == 1)?round(($hymrks/$hyMxmrks)*(10)):number_format(($hymrks/$hyMxmrks)*(10),2);
							}else{
								$hy = 'AB';
							}
						}else{
							$hy = 0;
						}
						
						if(!empty($pt3)){
							if($pt3[0]['M2'] != 'AB'){
								$pt3mrks   = $pt3[0]['M3'];
								$pt3Mxmrks = $pt3[0]['M1'];
								$pt3       = ($round == 1)?round(($pt3mrks/$pt3Mxmrks)*(10)):number_format(($pt3mrks/$pt3Mxmrks)*(10),2);
							}else{
								$pt3 = 'AB';
							}
						}else{
							$pt3 = 0;
						}
						
						$bestTwo = array($pt1,$hy,$pt3);
						
						rsort($bestTwo);
						$best1 = ($bestTwo[0] != 'AB')?$bestTwo[0]:0;
						$best2 = ($bestTwo[1] != 'AB')?$bestTwo[1]:0;
						$pt    = ($round == 1)?round(($best1+$best2)/(2)):number_format(($best1+$best2)/(2),2);
						$outof = ($pt + $nbuk + $subE);
						?>
							<td><center><?php echo $pt1; ?></center></td>
							<td><center><?php echo $hy; ?></center></td>
							<td><center><?php echo $pt3; ?></center></td>
							<td><center><?php echo $pt; ?></center></td>
							<td><center><?php echo ($nb[0]['M2'] != 'AB')?$nbuk:'AB'; ?></center></td>
							<td><center><?php echo ($se[0]['M2'] != 'AB')?$subE:'AB'; ?></center></td>
							<td><center><?php echo $outof; ?></center></td>
						<?php
					}
				?>
			</tr>
		<?php
	}
?>
</tbody>
</table>
</div>

<script>
	$('.dataTable').DataTable( {
		dom: 'Bfrtip',
		'paging': false,
		'ordering':false,
		buttons: 
		[
			{
				extend: 'excel',
				text: 'EXCEL',
				title: 'Internal CBSE Excel Report',
				className: 'btn btn-default',
			},
		]
	} );
</script>
<?php
	if($cnt == 0){ //check exist data (0 = not exist in marks_all table its mean insert fresh into the database)
?>
<table class='table dataTable'>
	<thead>
	<tr>
		<th style='background:#5785c3; color:#fff !important;'>Adm No.</th>
		<th style='background:#5785c3; color:#fff !important;'>Name</th>
		<th style='background:#5785c3; color:#fff !important;'>Roll No.</th>
	<?php
	if(!empty($skillData)){
		foreach($skillData as $key => $val){
			?>
				<th style='background:#5785c3; color:#fff !important;'><?php echo $val['skill_name']; ?></th>
			<?php	
		}
	}  
	?>
	</tr>
	</thead>
	<tbody>
<?php
$stuData = $this->alam->selectA('student','ADM_NO,CLASS,SEC,ROLL_NO,FIRST_NM',"CLASS='$Class_No' AND SEC='$sec' AND Student_Status = 'ACTIVE' order by $sorting");

if(!empty($stuData)){
	foreach($stuData as $key => $val){
		?>
		<tr>
			<td><?php echo $val['ADM_NO']; ?><input type='hidden' value='<?php echo $val['ADM_NO']; ?>' name='admno[]'></td>
			<td><?php echo $val['FIRST_NM']; ?><input type='hidden' value='<?php echo $trm; ?>' name='trm'></td>
			<td><?php echo $val['ROLL_NO']; ?><input type='hidden' value='<?php echo $val['ROLL_NO']; ?>' name='rollno[]'></td>
			<?php
				if(!empty($skillData)){
					foreach($skillData as $key1 => $val1){
						?>
							<td>
								<select class='form-control' name='subskill_<?php echo $key; ?>[]'>
									<option value='A+'>A+</option>
									<option value='A'>A</option>
									<option value='B'>B</option>
									<option value='C'>C</option>
									<option value='D'>D</option>
									<option value='AB'>AB</option>
								</select>
							</td>
						<?php	
					}
				} 
			?>
		</tr>	
		<?php
	}
}
?>
</tbody>
</table><br />
<button class='btn btn-success'><i class="fa fa-spinner fa-spin" id='process' style='display:none'></i> Verify Grades</button>	
<br /><br />

<?php
	}else{
?>
<table class='table dataTable'>
<thead>
	<tr>
		<th style='background:#5785c3; color:#fff !important;'>Adm No.</th>
		<th style='background:#5785c3; color:#fff !important;'>Name</th>
		<th style='background:#5785c3; color:#fff !important;'>Roll No</th>
		<?php
			foreach($subSkillData as $key => $val){
				?>
					<th style='background:#5785c3; color:#fff !important;'><?php echo $val['skill_name']; ?></th>
				<?php
			}
		?>
	</tr>
</thead>	
<tbody>	
	<?php
		foreach($stuData as $key => $val){
			$admno = $val['ADM_NO'];
			?>
			<tr>
				<td><?php echo $val['ADM_NO']; ?><input type='hidden' value='<?php echo $val['ADM_NO']; ?>' id='admno'></td>
				<td><?php echo $val['FIRST_NM']; ?></td>
				<td><?php echo $val['ROLL_NO']; ?><input type='hidden' value='<?php echo $val['ROLL_NO']; ?>' id='rollno'></td>
				<?php
					foreach($subSkillData as $key1 => $val1){
						$subskilId = $val1['id'];
						$subSill = $this->alam->selectA('marks_all','id,m2',"term='$trm' AND examcode='$exm_typ' AND class_code = '$classs' AND admno = '$admno' AND subject_skill = '$subskilId' AND subject = '$sub'");

						foreach($subSill as $key2 => $val2){
							$id = $val2['id'];
						?>
					      <td>
							  <select class='form-control' id='subskill' onchange='skillUpd(this.value,<?php echo $id; ?>)'>
								<option value='A+' <?php if($val2['m2'] == 'A+'){ echo "selected"; } ?>>A+</option>
								<option value='A' <?php if($val2['m2'] == 'A'){ echo "selected"; } ?>>A</option>
								<option value='B' <?php if($val2['m2'] == 'B'){ echo "selected"; } ?>>B</option>
								<option value='C' <?php if($val2['m2'] == 'C'){ echo "selected"; } ?>>C</option>
								<option value='D' <?php if($val2['m2'] == 'D'){ echo "selected"; } ?>>D</option>
								<option value='AB' <?php if($val2['m2'] == 'AB'){ echo "selected"; } ?>>AB</option>
							  </select>
						  </td>
						<?php
						}
					}
				?>
			</tr>	
			<?php
		}
	?>
</tbody>	
</table>
<?php } ?>
<script>
	$(".dataTable").dataTable({
		"searching":true,
		"paging":   false,
        "ordering": false,
        "info":     false
	});
</script>
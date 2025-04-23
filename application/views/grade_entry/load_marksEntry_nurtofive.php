<div class='table-responsive'>
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
		$admno = $val['ADM_NO'];
		?>
		<tr>
			<td><?php echo $val['ADM_NO']; ?><input type='hidden' value='<?php echo $val['ADM_NO']; ?>' name='admno[]'></td>
			<td><?php echo $val['FIRST_NM']; ?><input type='hidden' value='<?php echo $trm; ?>' name='trm'></td>
			<td><?php echo $val['ROLL_NO']; ?><input type='hidden' value='<?php echo $val['ROLL_NO']; ?>' name='rollno[]'></td>
			<?php
				if(!empty($skillData)){
					$i=1;
					foreach($skillData as $key1 => $val1){
						$id = $val1['id'];
						$qur = $this->alam->selectA('co_scholastic_grade_all',"grade","subj_skill_id='$id' and subject='$sub' and term='$trm' and admno = '$admno'");
						$grd = isset($qur[0]['grade'])?$qur[0]['grade']:'';
						?>
							<td>
								<select class='form-control' name='subskill_<?php echo $key; ?>[]'>
									<option value='A+' <?php if('A+' == $grd){ echo "selected"; }?>>A+</option>
									<option value='A' <?php if('A' == $grd){ echo "selected"; }?>>A</option>
									<option value='B' <?php if('B' == $grd){ echo "selected"; }?>>B</option>
									<option value='C' <?php if('C' == $grd){ echo "selected"; }?>>C</option>
									<option value='D' <?php if('D' == $grd){ echo "selected"; }?>>D</option>
									<option value='AB' <?php if('AB' == $grd){ echo "selected"; }?>>AB</option>
								</select>
							</td>
						<?php
						$i++;	
					}
				} 
			?>
		</tr>	
		<?php
	}
}
?>
</tbody>
</table>
</div>

<br />

<button type='submit' class='btn btn-success'><i class="fa fa-spinner fa-spin" id='process' style='display:none'></i> SAVE</button>
<br /><br />

<script>
	$(".dataTable").dataTable({
		"searching":true,
		"paging":   false,
        "ordering": false,
        "info":     false,
        "destroy":  true,
	});
</script>
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
				<th style='background:#5785c3; color:#fff !important;'><?php echo $val['skill_name']; ?> <span style='background:red; padding:5px;'><b>(<?php echo $val['maxmarks']; ?>)</b></span></th>
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
		$Expld = explode("/",$admno);
		$admExpld = $Expld[0];
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
						$qur = $this->alam->selectA('marks_all',"m2","subject_skill='$id' and examcode='$exm_code' and subject='$sub' and term='$trm' and admno = '$admno'");
						$m2 = isset($qur[0]['m2'])?$qur[0]['m2']:'';
						if($modal != 'Y'){
						?>
							<td>
								<input type='text' value='<?php echo $m2; ?>' maxlength='4' id='key_<?php echo $i .$admExpld ; ?>' class='form-control' name='subskill_<?php echo $key; ?>[]' onchange='save_upd_validate(this.value,<?php echo $val1['maxmarks']; ?>,"<?php echo $i . $admExpld; ?>","<?php echo $val['ADM_NO']; ?>",<?php echo $val1['id']; ?>)' onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode >= 65 && event.charCode <= 66 || event.charCode >= 97 && event.charCode <= 98 || event.charCode == 46' style='text-align:right;' autocomplete='off'>
							</td>
						<?php
						}else{
							?>
							<td>
								<input readonly type='text' value='<?php echo $m2; ?>' maxlength='4' id='key_<?php echo $i .$admExpld; ?>' class='form-control' name='subskill_<?php echo $key; ?>[]' onchange='save_upd_validate(this.value,<?php echo $val1['maxmarks']; ?>,"<?php echo $i . $admExpld; ?>","<?php echo $val['ADM_NO']; ?>",<?php echo $val1['id']; ?>)' onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode >= 65 && event.charCode <= 66 || event.charCode >= 97 && event.charCode <= 98 || event.charCode == 46' style='text-align:right;'>
							</td>
							<?php
						}
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
<?php
	if($modal != 'Y'){
?>
<button type='button' class='btn btn-success' onclick="verifyMarks('<?php echo $sorting; ?>')"><i class="fa fa-spinner fa-spin" id='process' style='display:none'></i> Verify Marks</button>
<?php } ?>	
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
<form action='<?php echo base_url('homework/HomeworkStatus/saveStatus'); ?>' method='post'>
<div class='table-responsive'>
<table class='table dataTable'>
	<thead>
		<tr>
			<th style='background:#5785c3; color:#fff !important'>Adm No</th>
			<th style='background:#5785c3; color:#fff !important'>Name</th>
			<th style='background:#5785c3; color:#fff !important'>Roll No</th>
			<th style='background:#5785c3; color:#fff !important'>Uploaded H/W by Stu.</th>
			<th style='background:#5785c3; color:#fff !important'>
			<?php
				if($sts == 'N'){
			?>
			<input type="checkbox" name="chkall" onchange="checkAll()"> 
			<?php } ?>
			Status
			</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$saveBtn = 0;
			if(!empty($homeworkData)){
				foreach($homeworkData as $key => $val){
					?>
						<tr>
							<td><?php echo $val['admno']; ?><input type='hidden' name='updid' value="<?php echo $val['homework_tbl_id']; ?>"></td>
							<td><?php echo $val['firstnm']; ?></td>
							<td><?php echo $val['roll']; ?></td>
							<td>
								<?php
									echo $val['stuByRemarks']."<br />";
									$stuUploadedimg = unserialize($val['stuUploadedimg']);
									if(!empty($stuUploadedimg)){
										foreach($stuUploadedimg as $key1 => $val1){
											?>
												<a download href='<?php echo base_url($val1); ?>'>
													<i class="fa fa-download" style='color:red;' title='CLICK HERE TO DOWNLOAD FILES'></i>
												</a>&nbsp;
											<?php
										}
									}
								?>
							</td>
							<td>
							<?php
								if($val['homework_status'] == 'N'){
									$saveBtn = 1;
							?>
							<input name='swtch[]' onclick="chk_one(<?php echo $key; ?>)" value='<?php echo $val['admno']; ?>' type="checkbox">
							<textarea class='form-control' id='txtfld_<?php echo $key; ?>' name='txtfld[]' disabled></textarea>
							<?php } else { ?>
							
							<button class='btn btn-success btn-xs'>Completed</button>
							
							<?php } ?>
							</td>
						</tr>
					<?php
				}
			}else{
				?>
					<tr>
						<td colspan='6' align='center'> Data Not Found </td>
					</tr>
				<?php
			}
		?>
	</tbody>
</table>
</div>
<?php
if($saveBtn == 1){
?>
<button type='submit' class='btn btn-success pull-right btn-sm' id='btn_sub' disabled>Save</button>
<?php } ?>

</form>
<script>
	$(function () {
	$('.dataTable').DataTable({
	  'paging'      : false,
	  'lengthChange': false,
	  'searching'   : true,
	  'ordering'    : false,
	  'info'        : true,
	  'autoWidth'   : true,
	  aaSorting: [[0, 'asc']]
	})
  });
  function checkAll(){
	 var val = $("input[name='chkall']").is(":checked");
	 if(val == true){
		$("input[name='swtch[]']").each( function () {
		  $("input[name='swtch[]']").prop('checked', true); 
		  $("textarea[name='txtfld[]']").prop('disabled', false); 
		  $("#btn_sub").prop('disabled',false);
		});
	 }else{
		$("input[name='swtch[]']").each( function () {
		  $("input[name='swtch[]']").prop('checked', false);
          $("textarea[name='txtfld[]']").prop('disabled', true);		  
		  $("#btn_sub").prop('disabled',true);
		});
	 }   
 }
 
 function chk_one(vall){
	 var val = $("input[name='swtch[]']").is(":checked");
	 if(val == true){
		$("#btn_sub").prop('disabled',false); 
		$("#txtfld_"+vall).prop('disabled',false);
	 }else{
		$("#btn_sub").prop('disabled',true);
		$("#txtfld_"+vall).prop('disabled',true);
	 }	 
 }
</script>
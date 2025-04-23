<form id='topicChapterFormUpd' method='post'>
	<table class='table'>
	<input type='hidden' name='id' value='<?php echo $masterTopicData[0]['id'];?>'>
	<tr>
		<th>Class</th>
		<td><input type='text' value='<?php echo $masterTopicData[0]['classnm'];?>' disabled></td>
	</tr>
	
	<tr>
		<th>Section</th>
		<td><input type='text' value='<?php echo $masterTopicData[0]['secnm'];?>' disabled></td>
	</tr>
	
	<tr>
		<th>Subject</th>
		<td><input type='text' value='<?php echo $masterTopicData[0]['subjnm'];?>' disabled></td>
	</tr>
	
	<tr>
		<th>Chapter</th>
		<td><input type='text' name='chapter' id='chapter'  value='<?php echo $masterTopicData[0]['chapter'];?>' class='form-control'></td>
	</tr>
	<tr>
		<th>Topic</th>
		<td>
			<?php
				$topicData = unserialize($masterTopicData[0]['topic']);
				foreach($topicData as $key1 => $val1){
			?>
			<textarea name='topic[]' id='topic' class='form-control'><?php echo $val1; ?></textarea><br />
			<?php } ?>
		</td>
	</tr>
	
	<tr>
		<td colspan='2'><center><button id='btn' class='btn btn-success btn-sm'>UPDATE <i class="fa fa-paper-plane" style='color:#fff'></i></button></center></td>
	</tr>
	</table>
</form>

<script>
	$("#topicChapterFormUpd").on("submit", function (event) {
		event.preventDefault();
		$.ajax({
			url: "<?php echo base_url('e_learning/TopicChapterMaster/updMaster'); ?>",
			type: "POST",
			data: $("#topicChapterFormUpd").serialize(),
			success: function(data){
				location.reload();
			}
		});
	 });
</script>
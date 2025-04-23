<table class='table dataTable'>
<thead>
	<tr>
		<th style='color:#fff !important; background:#5785c3;'>Class</th>
		<th style='color:#fff !important; background:#5785c3;'>Sec</th>
		<th style='color:#fff !important; background:#5785c3;'>Subject</th>
		<th style='color:#fff !important; background:#5785c3;'>Chapter</th>
		<th style='color:#fff !important; background:#5785c3;'>Topic</th>
		<th style='color:#fff !important; background:#5785c3;'>Action</th>
	</tr>
</thead>	
<tbody>
	<?php
	$chapterTopicMaster = $this->alam->selectA('chaptertopicmaster','*,(select CLASS_NM from classes where Class_No=chaptertopicmaster.classes)classnm,(select SECTION_NAME from sections where section_no=chaptertopicmaster.sec)secnm,(select SubName from subjects where SubCode=chaptertopicmaster.subject)subjnm',"status='1' order by id desc");
		foreach($chapterTopicMaster as $key => $val){
			?>
				<tr>
					<td><?php echo $val['classnm']; ?></td>
					<td><?php echo $val['secnm']; ?></td>
					<td><?php echo $val['subjnm']; ?></td>
					<td><?php echo $val['chapter']; ?></td>
					<td>
						<?php 
							$topicData = unserialize($val['topic']); {
								foreach($topicData as $key1 => $val1){
									echo $val1."&nbsp;&nbsp;";
								}
							}
						?>
					</td>
					<td><button class='btn btn-success btn-xs' onclick='edit(<?php echo $val['id']; ?>)'><i class="fa fa-pencil-square-o" style='color:#fff;'></i></button></td>
				</tr>
			<?php
		}
	?>
</tbody>	
</table>
<script>
$(function () {
	$('.dataTable').DataTable({
	  'paging'      : true,
	  'lengthChange': false,
	  'searching'   : true,
	  'ordering'    : false,
	  'info'        : true,
	  'autoWidth'   : true,
	  aaSorting: [[0, 'asc']]
	})
  });
</script>
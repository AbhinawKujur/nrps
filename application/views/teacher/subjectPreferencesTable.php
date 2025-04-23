<table class="table table-striped dataTable">
	<thead>
		<tr>
			<th class="thead-color">S.No</th>
			<th class="thead-color">Subject</th>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1; foreach ($subjectList as $key => $value) { ?>
			<tr>
				<td><?php echo $i++; ?></td>
				<td><?php echo $value['subject_name']; ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>
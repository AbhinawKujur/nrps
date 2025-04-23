<?php $i =1; foreach ($subjectList as $key => $value) { ?>
	<tr>
	  <td><?php echo $i++; ?></td>
	  <td><?php echo $value['Class_name_Roman']; ?></td>
	  <td><?php echo $value['subj_nm']; ?></td>
	  <td><?php echo $value['Total_Period_inWeek']; ?></td>
	</tr>
<?php } ?>
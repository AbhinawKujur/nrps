  <style>
	button.dt-button, div.dt-button, a.dt-button {
		  padding:2px;
	}
	.dataTables_paginate .paginate_button.current {
	 padding:2px;  
	}
	.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
		padding:5px 5px!important;
		white-space: nowrap !important;
	}
  </style>
  <table class='table table-striped' id='periodwise'>
	<thead>
	<tr>
	  <th style="background: #5785c3 !important; color: white !important;">Adm No</th>
	  <th style="background: #5785c3 !important; color: white !important;">Stu Name</th>
	  <th style="background: #5785c3 !important; color: white !important;">Roll</th>
	  <!--<th style="background: #5785c3 !important; color: white !important;">Class</th>
	  <th style="background: #5785c3 !important; color: white !important;">Sec</th>
	  <th style="background: #5785c3 !important; color: white !important;">Mobile</th>-->
	  <th style="background: #5785c3 !important; color: white !important;">Period</th>
	  <?php for ($i=1; $i <= $total_days; $i++){ 
		  $date = $current_year.'-'.$mnth.'-'.$i;
		  ?>
		  <th style="background: #5785c3 !important; color: white !important;"><?php echo $i.'<br> '.date("D", strtotime($date)); ?></th>
	  <?php } ?>
	</tr>
</thead>	
<tbody>	
<?php
foreach($resultList as $key => $value){ 
	for($i=1; $i<=8; $i++){
		?>
		<tr>
		<?php if($i == 1){ ?>
		  <td><?php echo $value['admno']; ?></td>
		  <td><?php echo $value['name']; ?></td>
		  <td><?php echo $value['roll']; ?></td>
		  <!--<td><?php //echo $value['class']; ?></td>
		  <td><?php //echo $value['sec']; ?></td>
		  <td><?php //echo $value['mobile']; ?></td>-->
		<?php }else{ ?>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		<?php } ?>
		  <td><?php echo "<b>P-". $i ."</b>"; ?></td>
		  <?php for ($k=1; $k <= $total_days; $k++) { ?>
			  <td>
			  	<?php 
			  		if($value[$k]['p'.$i] == 'H')
			  		{
			  			echo '<strong><span style="color:#ad7e44;">'.$value[$k]['p'.$i].'</span></strong>'; 
			  		}
			  		elseif($value[$k]['p'.$i] == 'P')
			  		{
			  			echo '<strong><span style="color:green;">'.$value[$k]['p'.$i].'</span></strong>';
			  		}
			  		elseif($value[$k]['p'.$i] == 'A')
			  		{
			  			echo '<strong><span style="color:red;">'.$value[$k]['p'.$i].'</span></strong>';
			  		}else
			  		{
			  			echo '<strong>'.$value[$k]['p'.$i].'</strong>';
			  		}
			  	?></td>
		  <?php } ?> 
		</tr>  
		<?php
	}
}
?>
</tbody>
  </table>
  <script>
  $('#periodwise').DataTable({
  	"ordering":false,
  	"pageLength":40,
	dom: 'Bfrtip',
	buttons: [
		// {
			// extend: 'copyHtml5',
			// title: 'Student Details',
			// exportOptions: {
				// columns: [ 0, 1, 2, 3, 4, 5 , 6, 7]
			// }
		// },
		{
			extend: 'excelHtml5',
			title: 'Student Details',
		},
		// {
			// extend: 'csvHtml5',
			// title: 'Student Details',
			// exportOptions: {
				// columns: [ 0, 1, 2, 3, 4, 5 , 6, 7]
			// }
		// },
		// {
			// extend: 'pdfHtml5',
			// title: 'Student Details',
		// },
	]
});
</script>
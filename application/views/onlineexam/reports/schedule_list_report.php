
<form id='dreport' action='<?php echo base_url('onlineexam/reports/Schedule_report/pdf'); ?>' method='post'>
		<input type='hidden' name='ct1' id='ct1' value="<?php echo $exam_date; ?>">
		<input type='hidden' name='ct2' id='ct2' value="<?php echo $subject; ?>">
			<button class='btn btn-success' align:right;><i class="fa fa-file-pdf-o"></i> Download Report</button>
		
</form></br>
<table class='table' id="tbl1">
	<thead>
		<tr>
			<th style='background:#337ab7; color:#fff !important;'>Sl. NO.</th>
			<?php
			if($subject == 'All')
			{?>
			<th style='background:#337ab7; color:#fff !important;'>Subjects</th>
			<?php }
				else{?>
			
			<?php }
		
		?>
			<th style='background:#337ab7; color:#fff !important;'>Class</th>
			<th style='background:#337ab7; color:#fff !important;'>Section</th>
			<th style='background:#337ab7; color:#fff !important;text-align:center;'>Exam Timing</th>
			<th style='background:#337ab7; color:#fff !important;text-align:center;'>Total Student</th>
			<th style='background:#337ab7; color:#fff !important;text-align:center;'>Student Appeared</th>
			<!--<th style='background:#337ab7; color:#fff !important;'>Student Not Appeared</th>-->
			<th style='background:#337ab7; color:#fff !important;text-align:center;'>Exam Status</th>
		</tr>
	</thead>
	<tbody>
		<?php
			if(!empty($exam_scheduledata)){
				$i=1;
				foreach($exam_scheduledata as $key => $val){
					$nt_app = ($val->totstu - $val->aprstu);
					$myDate = $val->dttime;
					$curDateTime = date("Y-m-d H:i:s");
					if($myDate < $curDateTime){
							$status = "Over";
						}else{
							$status = "Scheduled";
						}
					?>
						<tr>
							<td style='text-align: center; color:black !important;'><?php echo $i; ?></td>
							<?php
			if($subject == 'All')
			{?>
			<td style='text-align: center; color:black !important;'><?php echo $val->subj_name; ?></td>
			<?php }
				else{?>
			
			<?php }
		
		?>
							<td style='text-align: center; color:black !important;'><?php echo $val->CLsnme; ?></td>
							<td style='text-align: center; color:black !important;'><?php echo $val->sectionm; ?></td>
							<td style='text-align: center; color:black !important;'><?php echo $val->exmtime; ?></td>
							<td style='text-align: center; color:black !important;'><?php echo $val->totstu; ?></td>
							<td style='text-align: center; color:black !important;'><?php echo $val->aprstu; ?></td>
						<!--	<td style='text-align: center; color:black !important;'><?php echo $nt_app; ?></td>-->
							<td style='text-align: center; color:black !important;'><?php echo $status; ?></td>
						</tr>
					<?php
					$i++;
				}
			}
		?>
	</tbody>
</table>
<script>
	  $(function () {
		$('#tbl1').DataTable({	
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
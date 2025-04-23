<style>
	#table2 {
		border-collapse: collapse;
	}
	#img{
		float:left;
		height:130px;
		width:130px;
	}
	#tp-header{
		font-size:20px;
	}
	#mid-header{
		font-size:15px;
	}
	#last-header{
		font-size:12px;
	}
	#last-header1{
		font-size:14px;
	}
	.th{
		background-color: #5785c3 !important;
		color : #fff !important;
	}
</style>

<img src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>" style="width:120px;float:left;">
<table width="100%" style="float:right;">
	<tr>
		<td id="tp-header"><center><?php echo $school_setting[0]->School_Name; ?></center></td>
	</tr>
	<tr>
		<td id="mid-header"><center><?php echo $school_setting[0]->School_Address; ?></center></td>
	</tr>
	<tr>
		<td id="last-header"><center>SESSION (<?php echo $school_setting[0]->School_Session; ?>)</center></td>
	</tr>
	<tr>
		<td id="last-header1"><center><b>EXAM STUDENT ATTENDANCE SUMMARY REPORT</b></center></td>
	</tr>
</table><br /><br /><br /><br /><br /><br /><br />
<?php
$original_date = $exam_date;
$timestamp = strtotime($original_date);
 

$new_date = date("d-m-Y", $timestamp);
?>
<table width='100%'>
	<tr>
		
		<th style='font-size:15px!important;'>Exam Date:-  <?php echo $new_date; ?></th>
		<th width='50%' style='color:#fff;font-size:18px!important;'>sdsfdgdf</th>
		<?php
			if($subject != 'All')
			{?>
			<th style='font-size:15px!important;'>Subject:- <?php echo $subj_name; ?></th>
			<?php }
				else{?>
			
			<?php }
		
		?>
		
	</tr>
</table>
<hr>
<br />

 <table width="100%" border="1" id="table2">
	<thead>
		<tr>
			<th class="th">Sl No.</th>
			<?php
			if($subject == 'All')
			{?>
			<th class="th">Subjects</th>
			<?php }
				else{?>
			
			<?php }
		
		?>
			<th class="th">Class</th>
			<th class="th">Section</th>
			<th class="th">Exam Time</th>
			<th class="th">Total Student</th>
		    <th class="th">Student Appeared</th>
			<!--<th class="th">Student Not Appeared</th>-->
			<th class="th">Exam Status</th>
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
							<td style='text-align: center;'><?php echo $i; ?></td>
							<?php
			if($subject == 'All')
			{?>
			<td style='text-align: center;'><?php echo $val->subj_name; ?></td>
			<?php }
				else{?>
			
			<?php }
		
		?>
							<td style='text-align: center;'><?php echo $val->CLsnme; ?></td>
							<td style='text-align: center;'><?php echo $val->sectionm; ?></td>
							<td style='text-align: center;'><?php echo $val->exmtime; ?></td>
							<td style='text-align: center;'><?php echo $val->totstu; ?></td>
							<td style='text-align: center;'><?php echo $val->aprstu; ?></td>
							<!--<td style='text-align: center;'><?php echo $nt_app; ?></td>-->
							<td style='text-align: center;'><?php echo $status; ?></td>
						</tr>
					<?php
					$i++;
				}
			}
		?>
	</tbody>
</table>


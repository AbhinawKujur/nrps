<style>
	#table2 {
		border-collapse: collapse;
	}
	#table3 {
		border-collapse: collapse;
	}
	#img{
		float:left;
		height:100px;
		width:100px;
		margin-left: 1px !important;
	}
	#tp-header{
		font-size:26x;
	}
	#mid-header{
		font-size:20px;
	}
	#last-header{
		font-size:16x;
	}
	.th{
		background-color: #5785c3 !important;
		color : #fff !important;
		font-size:14px;
		text-align:center;
	}
	.tt{
		font-size:12px;
		text-align:center;
	}
	.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
  }
	
</style>
<img src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>" id="img">
<table width="100%" style="float:right;">
	<tr>
		<td id="tp-header"><center><?php echo $school_setting[0]->School_Name; ?><center></td>
	</tr>
	<tr>
		<td id="mid-header"><center><?php echo $school_setting[0]->School_Address; ?><center></td>
	</tr>
	<tr>
		<td id="last-header"><center>SESSION (<?php echo $school_setting[0]->School_Session; ?>)<center></td>
	</tr>
	<tr>
		<td><center><span style="font-size:22px !important;">Class Wise Subject Report (Class <?php echo $class[0]->class_nm ." - ".$sec[0]->section_name; ?>)</span></center></td>
	</tr>
</table><br /><br /><br /><br /><br /><br /><br />
<hr>
<br />
<table width="100%" border="1" id="table2">
	<thead>
		<tr>
            <th class="th">SL.NO</th>
			<th class="th">ADM. NO.</th>
			<th class="th">STUDENT NAME</th>
			<th class="th">ROLL. NO.</th>
			<th class="th">SUBJECT-1</th>
			<th class="th">SUBJECT-2</th>
			<th class="th">SUBJECT-3</th>
			<th class="th">SUBJECT-4</th>
			<th class="th">SUBJECT-5</th>
			<th class="th">SUBJECT-6</th>
		</tr>
		
	</thead>
	<tbody>
		<?php
			$i=1;
			foreach($data as $key=>$value){
				?>
				<tr>
					<td class="tt"><?php echo $i; ?></td>
					<td class="tt"><?php echo $value->ADM_NO; ?></td>
					<td class="tt"><?php echo $value->FIRST_NM; ?></td>
					<td class="tt"><?php echo $value->ROLL_NO; ?></td>
					<td class="tt"><?php echo $value->SUBJECT1; ?></td>
					<td class="tt"><?php echo $value->SUBJECT2; ?></td>
					<td class="tt"><?php echo $value->SUBJECT3; ?></td>
					<td class="tt"><?php echo $value->SUBJECT4; ?></td>
					<td class="tt"><?php echo $value->SUBJECT5; ?></td>
					<td class="tt"><?php echo $value->SUBJECT6; ?></td>
					
				</tr>
				<?php
				$i++;
			}
		?>
	</tbody>
</table>
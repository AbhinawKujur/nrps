
<style>
	#table2 {
		border-collapse: collapse;
	}
	#table3 {
		border-collapse: collapse;
	}
	#img{
		float:left;
		height:120px;
		width:120px;
		margin-left: 150px !important;
	}
	#tp-header{
		font-size:30px;
	}
	#mid-header{
		font-size:26px;
	}
	#last-header{
		font-size:22px;
	}
	.th{
		background-color: #5785c3 !important;
		color : #fff !important;
		font-size:12px;
	}
	.tt{
		font-size:10px;
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
		<td><center><span style="font-size:22px !important;">Monthly <?php if($choice == 1){echo 'Join';}else{echo 'Leave';} ?></span></center></td>
	</tr>
</table><br /><br /><br /><br /><br /><br /><br />
<hr>
<br />
<table width="100%" border="1" id="table2">
	<thead>
    <tr>
			<th>Sl. No.</th>
			<th>ADM. NO</th>
			<th>STU NAME</th>
			<th>CLASS/SEC</th>
			<th>Roll No</th>
			<th>CONTACT</th>
		</tr>
		
	</thead>
	<tbody>
		<?php
			$i=1;
			foreach($data as $key=>$value){
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $value->ADM_NO; ?></td>
					<td><?php echo $value->FIRST_NM; ?></td>
					<td><?php echo $value->DISP_CLASS.'/'.$value->DISP_SEC; ?></td>
					<td><?php echo $value->Roll_no; ?></td>
					<td><?php echo $value->C_MOBILE; ?></td>
				</tr>
				<?php
				$i++;
			}
		?>
	</tbody>
</table>
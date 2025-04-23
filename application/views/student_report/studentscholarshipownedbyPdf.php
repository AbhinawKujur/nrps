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
		
		color : black !important;
		font-size:09px;
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
		<td id="tp-header"><center><?php echo $school_setting[0]->School_Name; ?></center></td>
	</tr>
	<tr>
		<td id="mid-header"><center><?php echo $school_setting[0]->School_Address; ?></center></td>
	</tr>
	<tr>
		<td id="last-header"><center>SESSION (<?php echo $school_setting[0]->School_Session; ?>)</center></td>
	</tr>
	<tr>
		<td><center><span style="font-size:22px !important;">Scholarship Availing Students of Class <?php
		 if ($class!="All"){echo $data[0]->CLASS;}else{ echo $class;} ?> Given By <?php if($owned=='%'){echo "All";}else{echo $owned;}; ?></span></center></td>
	</tr>
</table><br /><br /><br /><br /><br /><br /><br />
<hr>
<br />
<table width="100%" border="1" id="table2">
	<thead>
		<tr>
			<th class="th">Sl No.</th>
			<th class="th">Admission No.</th>
			<th class="th">Student Name</th>
			<th class="th">Roll No.</th>
			<th class="th">Class</th>
			<th class="th">Apply From</th>
			<th class="th">Recommanded By</th>
			<th class="th">Application No.</th>
			<?php
				foreach($feehead as $key=>$value){
					if($value->FEE_HEAD =="" || $value->FEE_HEAD =="-"){
						
					}else{
						?>
							<th class="th"><?php echo $value->SHNAME; ?></th>
						<?php
					}
				}
			?>
		</tr>
	</thead>
	<tbody>
		<?php
			$i=1;
			$t1 = 0;
			$t2 = 0;
			$t3 = 0;
			$t4 = 0;
			$t5 = 0;
			$t6 = 0;
			$t7 = 0;
			$t8 = 0;
			$t9 = 0;
			$t10 = 0;
			$t11 = 0;
			$t12 = 0;
			$t13 = 0;
			$t14 = 0;
			$t15 = 0;
			$t16 = 0;
			$t17 = 0;
			$t18 = 0;
			$t19 = 0;
			$t20 = 0;
			$t21 = 0;
			$t22 = 0;
			$t23 = 0;
			$t24 = 0;
			$t25 = 0;
			foreach($data as $key1=>$value1){
				$t1 += $value1->S1;
				$t2 += $value1->S2;
				$t3 += $value1->S3;
				$t4 += $value1->S4;
				$t5 += $value1->S5;
				$t6 += $value1->S6;
				$t7 += $value1->S7;
				$t8 += $value1->S8;
				$t9 += $value1->S9;
				$t10 += $value1->S10;
				$t11 += $value1->S11;
				$t12 += $value1->S12;
				$t13 += $value1->S13;
				$t14 += $value1->S14;
				$t15 += $value1->S15;
				$t16 += $value1->S16;
				$t17 += $value1->S17;
				$t18 += $value1->S18;
				$t19 += $value1->S19;
				$t20 += $value1->S20;
				$t21 += $value1->S21;
				$t22 += $value1->S22;
				$t23 += $value1->S23;
				$t24 += $value1->S24;
				$t25 += $value1->S25;
				?>
				<tr>
					<td class='tt'><?php echo $i; ?></td>
					<td class='tt'><?php echo $value1->ADM_NO; ?></td>
					<td class='tt'><?php echo $value1->STU_NAME; ?></td>
					<td class='tt'><?php echo $value1->ROLL_NO; ?></td>
					<td class='tt'><?php echo $value1->CLASS; ?></td>
					<td class='tt'><?php echo $value1->Apply_From; ?></td>
					<td class='tt'><?php echo $value1->recomm; ?></td>
					<td class='tt'><?php echo $value1->app_no; ?></td>
					<?php
					foreach($feehead as $key2=>$value2){
						$v = $key2+1;
						$v1 = "S".$v;
						
						if($value2->FEE_HEAD =="" || $value2->FEE_HEAD =="-"){
							
						}else{
							?>
								<td class='tt'><?php echo $value1->$v1; ?></td>
							<?php
							
						}
					}
				?>
				</tr>
				<?php
				$i++;
			}
		?>
		<tr>
			<td colspan='8' class='tt'><center>Grand Total</center></td>
			<td class='tt'><?php echo $t1; ?></td>
			<td class='tt'><?php echo $t2; ?></td>
			<td class='tt'><?php echo $t3; ?></td>
			<td class='tt'><?php echo $t4; ?></td>
			<td class='tt'><?php echo $t5; ?></td>
			<td class='tt'><?php echo $t6; ?></td>
			<td class='tt'><?php echo $t7; ?></td>
			<td class='tt'><?php echo $t8; ?></td>
			<td class='tt'><?php echo $t9; ?></td>
			<td class='tt'><?php echo $t10; ?></td>
			<td class='tt'><?php echo $t11; ?></td>
			<td class='tt'><?php echo $t12; ?></td>
			<td class='tt'><?php echo $t13; ?></td>
			<td class='tt'><?php echo $t14; ?></td>
			<td class='tt'><?php echo $t15; ?></td>
			<td class='tt'><?php echo $t16; ?></td>
			<td class='tt'><?php echo $t17; ?></td>
			<td class='tt'><?php echo $t18; ?></td>
			<td class='tt'><?php echo $t19; ?></td>
			<td class='tt'><?php echo $t20; ?></td>
			<td class='tt'><?php echo $t21; ?></td>
			<td class='tt'><?php echo $t22; ?></td>
			<td class='tt'><?php echo $t23; ?></td>
			<td class='tt'><?php echo $t24; ?></td>
			<td class='tt'><?php echo $t25; ?></td>
		</tr>
	</tbody>
</table>
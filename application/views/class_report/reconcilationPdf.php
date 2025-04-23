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
		white-space: nowrap !important;
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
		<td><center><span style="font-size:22px !important;">Reconciliation Ledger of Class <?php echo $class_name."-".$sec_name; ?></span></center></td>
	</tr>
</table><br /><br /><br /><br /><br /><br /><br />
<hr>
<br />
<table width="100%" border="1" id="table2">
	<thead>
		<tr>
			<th class='th'>Sl No.</th>
			<th class='th'>Adm No. /<br>Adm Date</th>
			<th class='th'>Student Name</th>
			<th class='th'>Roll No.</th>
			<th class='th'>Status</th>
			<?php
				foreach($feehead as $key=>$value){
					if($value->FEE_HEAD=="" || $value->FEE_HEAD=="-"){
						
					}else{
						?>
							<th class='th'><?php echo $value->SHNAME; ?></th>
						<?php
					}
				}
			?>
			<th class="th">Total</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$i=1;
			foreach($cal_data as $key=>$value){
				?>
				<tr>
					<td class='tt'><?php echo $i; ?></td>
					<td class='tt'><?php echo $value['ADM_NO']; ?></td>
					<td class='tt'><?php echo $value['FIRST_NM']; ?></td>
					<td class='tt'><?php echo $value['ROLL_NO']; ?></td>
					<td class='tt'>Dr</td>
					<?php
						for($j=1;$j<=26;$j++){
							?>
							<td class='tt'><?php echo $value['FEEGEN_'.$j]; ?></td>
							<?php
						}
					?>
				</tr>
				<tr>
					<td class='tt'></td>
					<td class='tt'><?php echo date('d-M-Y',strtotime($value['ADM_DATE'])); ?></td>
					<td class='tt'></td>
					<td class='tt'></td>
					<td class='tt'>Cr</td>
					<?php
						for($jk=1;$jk<=26;$jk++){
							?>
							<td class='tt'><?php echo $value['COLL_FEE'.$jk]; ?></td>
							<?php
						}
					?>
				</tr>
				<tr>
					<td class='tt'></td>
					<td class='tt'></td>
					<td class='tt'></td>
					<td class='tt'></td>
					<td class='tt'></td>
					<?php
						for($jkk=1;$jkk<=26;$jkk++){
							?>
							<td class='tt'><?php echo $value['fees_'.$jkk].$value['s'.$jkk]; ?></td>
							<?php
						}
					?>
				</tr>
				<?php
				$i++;
			}
		?>
	</tbody>
</table>
Class Ledger Total(Dr.) Amount :- <?php echo $fin_data['total_feegen_amount']."<br>"; ?>
Total (Cr.) Amount :- <?php echo $fin_data['total_daycoll_amount']."<br>"; ?>
Total (Bal.) Amount :- <?php echo $fin_data['final_amount']." ".$fin_data['final_commnet']."<br><br><br><br><br>"; ?>
<table width="100%">
	<tr>
		<td><center><b>Accountant Signature</b></center></td>
		<td><center><b>Auditor Signature</b></center></td>
		<td><center><b>Principal Signature</b><center></td>
	</tr>
</table>
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
		font-size:18px;
	}
	.tt{
		font-size:15px;
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
		<td><center><span style="font-size:22px !important;">Bus Stoppage Summary Statement as on : <?php
			$currentDate = date('Y-m-d');
				$timestamp = strtotime($currentDate);
				echo $new_date = date("d-m-Y", $timestamp);
			?></span></center></td>
		
	</tr>
	
</table><br /><br /><br /><br /><br /><br /><br /><br />
<hr>
<br />
<table width="100%" border="1" id="table2">
	<thead>
		<tr>
			<th class="th">Sl No.</th>
		    <th class="th">Stoppage Name</th>
			<th class="th">Bus Fair(Rs.)</th>
			<th class="th">Total Students</th>
			<th class="th">Total Boys</th>
			<th class="th">Total Girls</th>
			<th class="th">Total Amount(Rs.)</th>
	   </tr>
	</thead>
	<tbody>
		<?php
		$grand_tot_stu=0;
		$grand_tot_boys=0;
		$grand_tot_girls=0;
		$grand_tot_amt=0;
			$i=1;
			foreach($data as $key=>$value){
				$tot = $value->TOTALSTUDENT;
				  $amt = $value->stp_amt;
				  $tot_amt =  ($tot * $amt);
				  $tot_boys = $value->MALE;
				  $tot_girls = $value->FEMALE;
				  $grand_tot_stu=$grand_tot_stu+$tot;
				  $grand_tot_boys=$grand_tot_boys+$tot_boys;
				  $grand_tot_girls=$grand_tot_girls+$tot_girls;
				  $grand_tot_amt=$grand_tot_amt+$tot_amt;
				
				?>
				<tr>
					<td class="tt"><?php echo $i; ?></td>
				    <td class="tt"><?php echo $value->stopname; ?></td>
					<td class="tt"><?php echo $value->stp_amt; ?>/-</td>
					<td class="tt"><?php echo $value->TOTALSTUDENT; ?></td>
					<td class="tt"><?php echo $value->MALE; ?></td>
		            <td class="tt"><?php echo $value->FEMALE; ?></td>
					<td class="tt"><?php echo $tot_amt; ?>/-</td>
				</tr>
				<?php
				$i++;
			}
		?>
	</tbody>
	<tfoot>
            <tr>
                <td></td>
                 <td><b style="font-size:16px;color:red;font-weight: 900;">GRAND TOTAL</b></td>
                <td></td>
                <td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_stu;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_boys;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_girls;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_amt;?>/-</b></td>
            </tr>
        </tfoot>
</table>
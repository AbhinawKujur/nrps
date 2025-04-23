<style>
	.prt{
		display:none;
		}
	@media print {
		.prt{
		display:block;
		}
		#prnt{
		display:none
		}
			#img{
		float:left;
		height:80px;
		width:80px;
		margin-left: 80px !important;
	}
	#tp-header{
		font-size:32px;
	}
	#mid-header{
		font-size:20px;
	}
	#last-header{
		font-size:18px;
	}
	
	}
	#table2 {
		border-collapse: collapse;
	}
	#table3 {
		border-collapse: collapse;
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
	body{font-size:12px}
</style>
<button class='btn btn-danger' onclick="printDiv('load_data')" id='prnt'>Print</button><br/>
<div id='load_data'>

<table width="100%"  class='prt'>
	<tr>
		<td id="tp-header"><center><?php echo $school_setting[0]->School_Name; ?></center></td>
	</tr>
	<tr>
		<td id="mid-header"><center><?php echo $school_setting[0]->School_Address; ?></center></td>
	</tr>
	<tr>
		<td id="last-header"><center>SESSION (<?php echo $school_setting[0]->School_Session; ?>)</center></td>
	</tr>


</table><br />
			
		<center><h3>BUS NO WISE SUMMARY REPORT</h3></center>
<hr />
<table width="100%" border="1" id="table2">
	<thead>
		<tr>
			
		   <tr>		<th class="th">&nbsp;&nbsp;Sl No.</th>
					<th class="th" >&nbsp;&nbsp;BUS NO</th>
					<th class="th" >&nbsp;&nbsp;TOTAL STOPPAGE</th>
					<th class="th" >&nbsp;&nbsp;TOTAL STUDENT</th>
					<th class="th" >&nbsp;&nbsp;VI-VIII</th>
					<th class="th" >&nbsp;&nbsp;IX-X</th>
					<th class="th" >&nbsp;&nbsp;XI-XII</th>
					<th class="th" >&nbsp;&nbsp;BOYS</th>
					<th class="th" >&nbsp;&nbsp;GIRLS</th>
				   
				</tr>
		</tr>
		
	</thead>
	<tbody>
		<?php
			$i=1;
			$stoppage=0;
			$tot_stu=0;
			$group_a=0;
			$group_b=0;
			$group_c=0;
			$group_m=0;
			$group_f=0;

			foreach($alldata as $key){
				?>
				<tr>
					<td class="tt" >&nbsp;&nbsp;<?php echo $i; ?></td>
					<td class="tt" >&nbsp;&nbsp;<?php echo $key['bus_no']; ?></td>
					<td class="tt" >&nbsp;&nbsp;<?php echo $key['stoppage']; $stoppage +=$key['stoppage'] ?></td>
					<td class="tt" >&nbsp;&nbsp;<?php echo $key['tot_stu'];$tot_stu+=$key['tot_stu']?></td>
					<td class="tt" >&nbsp;&nbsp;<?php echo $key['group_a'];$group_a+=$key['group_a']?></td>
					<td class="tt" >&nbsp;&nbsp;<?php echo $key['group_b'];$group_b+=$key['group_b']?></td>
					<td class="tt" >&nbsp;&nbsp;<?php echo $key['group_c'];$group_c+=$key['group_c']?></td>
					<td class="tt" >&nbsp;&nbsp;<?php echo $key['group_m'];$group_m+=$key['group_m']?></td>
					<td class="tt" >&nbsp;&nbsp;<?php echo $key['group_f'];$group_f+=$key['group_f']?></td>
				   
				</tr>
	
				<?php
				$i++;
			}
		?>
		<tr>
					<th class="th" colspan=2>&nbsp;&nbsp;<span style='float:right'>TOTAL &nbsp;&nbsp;</span></th>
				
					<th class="th" >&nbsp;&nbsp;<?php echo $stoppage;?></th>
					<th class="th" >&nbsp;&nbsp;<?php echo $tot_stu;?></th>
					<th class="th" >&nbsp;&nbsp;<?php echo $group_a;?></th>
					<th class="th" >&nbsp;&nbsp;<?php echo $group_b;?></th>
					<th class="th" >&nbsp;&nbsp;<?php echo $group_c;?></th>
					<th class="th" >&nbsp;&nbsp;<?php echo $group_m;?></th>
					<th class="th" >&nbsp;&nbsp;<?php echo $group_f;?></th>
				   
				</tr>
	</tbody>
</table>
<hr/>
</div>


			<script>
				function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
				</script>
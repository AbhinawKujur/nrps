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
	
</style>
<button class='btn btn-danger' onclick="printDiv('load_data')" id='prnt'>Print</button><br/><br/>
<div class="dt-buttons">
<button class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="example" type="button"><span> Excel</span></button>
</div>
<img src="<?php echo base_url($school_setting[0]->SCHOOL_LOGO); ?>" id="img" class='prt'>
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
<tr>
		<td id="last-header"><center>Bus No wise Student report( <b>Bus NO :</b> <?php echo $bs_no;?> )</center></td>
	</tr>
	

</table><hr />
			
		

<table width="100%" border="1" id="table2">
	<thead>
		<tr>
			<th class="th">&nbsp;&nbsp;Sl No.</th>
		   
			<th class="th">&nbsp;&nbsp;Bus Stoppage</th>
			
			<th class="th">&nbsp;&nbsp;Student Admission No</th>
			<th class="th">&nbsp;&nbsp;Student Name</th>
			<th class="th">&nbsp;&nbsp;Class-Sec</th>
			<th class="th">&nbsp;&nbsp;Mobile No</th>
			
		</tr>
		
	</thead>
	<tbody>
		<?php
			$i=1;
		$itot=0;
			foreach($stu_busno as $key=>$value){
				?>
				<tr>
					<td class="tt" style='background-color:#e6e6e6;width:60px'>&nbsp;&nbsp;<?php echo $i; ?></td>
				   
					<td class="tt" style='background-color:#e6e6e6'>&nbsp;&nbsp;<?php echo $value['stop_nm']; ?>(<?php echo $key; ?>)</td>
					
					<td class="tt" style='background-color:#e6e6e6' colspan=4><center><b>TOTAL STUDENT<br> (<?php echo sizeof($value['stu_data']);?>)</b></center></td>
		        </tr>
		
		<?php
				$itot +=sizeof($value['stu_data']);
				
				foreach($value['stu_data'] as $key2){
					$class=$key2->DISP_CLASS;
					if($class=='VI' || $class=='VII' || $class=='VIII'){
					$cnt['sXe'][]=1;
					}else if($class=='IX' || $class=='X'){
					$cnt['nXt'][]=1;
					}else if($class=='XI' || $class=='XII'){
					$cnt['eXt'][]=1;
					}
					
				?>
			<tr>
					<td class="tt" colspan=2></td>
				   
					<td class="tt">&nbsp;&nbsp;<?php echo $key2->ADM_NO; ?></td>
		            <td class="tt">&nbsp;&nbsp;<?php echo $key2->FIRST_NM; ?></td>
				<td class="tt">&nbsp;&nbsp;<?php echo $key2->DISP_CLASS."-".$key2->DISP_SEC; ?></td>
				<td class="tt">&nbsp;&nbsp;<?php echo $key2->C_MOBILE; ?></td>
				</tr>
		<?php } ?>
				<?php
				$i++;
			}
		?>
		
	</tbody>
</table>
<hr/>
<p><b><u>Class Wise Student Subtotal</u></b></p>
<table border=1 cellspacing=0>
<tr><th style='width:150px'><b><center>Slot of class</center></b></th><th style='width:160px'> <b><center>Total student</center></b></th></tr>
	<tr><td ><b>&nbsp;&nbsp; VI-VIII</b></td><td>&nbsp;&nbsp; <?php echo sizeof($cnt['sXe']);?></td></tr>
	<tr><td><b>&nbsp;&nbsp; IX-X</b></td><td>&nbsp;&nbsp; <?php echo sizeof($cnt['nXt']);?></td></tr>
	<tr><td><b>&nbsp;&nbsp; XI-XII</b></td><td>&nbsp;&nbsp; <?php echo sizeof($cnt['eXt']);?></td></tr>
	<tr><td background-color:#e6e6e6;><b>&nbsp;&nbsp; TOTAL</b></td><td background-color:#e6e6e6;>&nbsp;&nbsp; <b><?php echo $itot;?></b></td></tr>
</table>


			<script>
				function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
				</script>

<script type="text/javascript">
$(document).ready(function() {
$("#msg").fadeOut(8000);
$('#example').DataTable({
	dom: 'Bfrtip',
	buttons: [
		{
			extend: 'excelHtml5',
			title: 'Bus No Wise List',
		},
	]
});
});

</script>
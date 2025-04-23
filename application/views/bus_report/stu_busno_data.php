<table width="100%" border="1" id="example">
	<thead>
		<tr>
			<th>Sl No.</th>
			<th>Bus Stoppage</th>
			<th>Student Admission No</th>
			<th>Student Name</th>
			<th>Class-Sec</th>
			<th>Mobile No</th>
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
						<td class="tt" style='background-color:#e6e6e6'>&nbsp;&nbsp;<?php echo $value['stop_nm']; ?>(<?php echo $key; ?>) <b>Total:-<?php echo sizeof($value['stu_data']);?></b></td>
						<td class="tt" style='background-color:#e6e6e6';></td>
						<td class="tt" style='background-color:#e6e6e6';></td>
						<td class="tt" style='background-color:#e6e6e6';></td>
						<td class="tt" style='background-color:#e6e6e6';></td>
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
					<td class="tt"></td>
					<td class="tt"></td>
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
		<tfoot>
			<tr>
				<td></td>
				<td></td>
				<td><b>(VI-VIII)- <?php echo sizeof($cnt['sXe']);?></b></td>
				<td><b>(IX-X)- <?php echo sizeof($cnt['nXt']);?></b></td>
				<td><b>(XI-XII)- <?php echo sizeof($cnt['eXt']);?></b></td>
				<td>(TOTAL)- <b><?php echo $itot;?></b></td>
			</tr>
		</tfoot>
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
	$(document).ready(function() {
		$('#example').DataTable( {
			dom: 'Bfrtip',
			paging: false,
			ordering: false,
			buttons: [
				{
					extend: 'excel',
					title: 'Bus Stoppage Summary Report',
					footer: true
				},
				{
					extend: 'pdf',
					title: 'Bus Stoppage Summary Report',
					footer: true
				},
			]
		} );
	} );
</script>
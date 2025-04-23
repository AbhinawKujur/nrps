<?php
// echo '<pre>';
// print_r($getBusNoData);
// die;
?>

<style>
	.table>thead>tr>th,
	.table>tbody>tr>th,
	.table>tfoot>tr>th,
	.table>thead>tr>td,
	.table>tbody>tr>td,
	.table>tfoot>tr>td {
		white-space: nowrap !important;
		border: 1px solid #000;
	}
</style>
<form method="post" action="<?php echo base_url('bus_report/download_busnoreport'); ?>" target="_blank">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12">
			<input type="hidden" value="<?php echo $buscode; ?>" name="buscode">
			<!--<input type="hidden" value="<?php //echo $amt; 
											?>" name="amt">-->
			<center>
				<button class="btn btn-primary"><i class="fa fa-file-pdf-o"></i> Download</button>
			</center>

		</div>
	</div>
</form><br />

<br /><br />
<table class="table" id="example">
	<thead>
		<tr>
			<th style="background-color: lightblue !important;border-top: 1px solid #000;">Sl No.</th>
			<th style="background-color: lightblue !important;border-top: 1px solid #000;">Stoppage Name</th>
			<th style="background-color: lightblue !important;border-top: 1px solid #000;">Admission No.</th>
			<th style="background-color: lightblue !important;border-top: 1px solid #000;">Student Name</th>
			<th style="background-color: lightblue !important;border-top: 1px solid #000;">Father's Name</th>
			<th style="background-color: lightblue !important;border-top: 1px solid #000;">Class</th>
			<th style="background-color: lightblue !important;border-top: 1px solid #000;">Section</th>
			<th style="background-color: lightblue !important;border-top: 1px solid #000;">Contact No.</th>
			<th style="background-color: lightblue !important;border-top: 1px solid #000;">Stopno</th>
			<th style="background-color: lightblue !important;border-top: 1px solid #000;">Amt.</th>
			<th style="background-color: lightblue !important;border-top: 1px solid #000;">Bus NO</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sum = 0;
		$tot_stu = 0;
		$grand_tot_stu = 0;
		$grand_tot_amt = 0;
		$i = 1;
		$j = 1;
		$chk = $getBusNoData[0]->STOPNO;
		foreach ($getBusNoData as $key => $value) {
			if ($chk != $value->STOPNO) {
		?>

				<tr>
					<td></td>
					<td style="text-align: right; color: red;font-weight:700">NO. OF STUDENT</td>
					<td style="text-align: right; color: red;font-weight:700"><?php echo $tot_stu; ?></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td style="text-align: right; color: red;font-weight:700">TOTAL</td>
					<td style="text-align: right; color: red;font-weight:700"><?php echo $sum; ?></td>
					<td></td>
				</tr>

			<?php
				$grand_tot_stu += $tot_stu;
				$grand_tot_amt += $sum;
				$tot_stu = 0;
				$sum = 0;
				$i++;
				$j = 1;
			}
			?>
			<tr>
				<td><?php echo $i . '.' . $j; ?></td>
				<td><?php echo $value->stoppage; ?></td>
				<td><?php echo $value->ADM_NO; ?></td>
				<td><?php echo $value->FIRST_NM; ?></td>
				<td><?php echo $value->FATHER_NM; ?></td>
				<td><?php echo $value->DISP_CLASS; ?></td>
				<td><?php echo $value->DISP_SEC; ?></td>
				<td><?php echo $value->C_MOBILE; ?></td>
				<td><?php echo $value->STOPNO; ?></td>
				<td><?php echo $value->AMT; ?></td>
				<td><?php echo $value->Bus_No; ?></td>
			</tr>
		<?php
			$sum = $sum + $value->AMT;
			$chk = $value->STOPNO;
			$tot_stu++;
			$j++;
		}

		$grand_tot_stu += $tot_stu;
		$grand_tot_amt += $sum;
		?>
		<tr>
					<td></td>
					<td style="text-align: right; color: red;font-weight:700">NO. OF STUDENT</td>
					<td style="text-align: right; color: red;font-weight:700"><?php echo $tot_stu; ?></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td style="text-align: right; color: red;font-weight:700">TOTAL</td>
					<td style="text-align: right; color: red;font-weight:700"><?php echo $sum; ?></td>
					<td></td>
				</tr>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="2" style="text-align: right; color: red;font-weight:700">TOTAL STUDENTS</td>
			<td style="text-align: right; color: red;font-weight:700"><?php echo $grand_tot_stu; ?></td>
			<td colspan="6" style="text-align: right; color: red;font-weight:700">TOTAL BUS AMT.</td>
			<td style="text-align: right; color: red;font-weight:700"><?php echo $grand_tot_amt; ?></td>
			<td></td>
		</tr>
	</tfoot>
</table>

<script type="text/javascript">
	$(document).ready(function() {
		$('#example').DataTable({
			dom: 'Bfrpit',
			ordering: false,
			paging: false,
			buttons: [{
				extend: 'excelHtml5',
				title: 'Bus No. Wise Report. Bus no. <?php echo $buscode ?>',
				footer: true,
			}, ]
		});
	});
</script>
<style>
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
  }
</style>
<form method="post" action="<?php echo base_url('Bus_report/stoppage_summary_pdf'); ?>" target="_blank">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12">
				
				<button class="btn pull-right"><i class="fa fa-file-pdf-o"></i> Download</button>
		</div>
	</div>
</form><br />
<table class='table table-bordered' id='example'>
	<thead>
		<tr>
			<th>Sl No.</th>
			<th>Stoppage Name</th>
			<th>Bus Fair(Rs.)</th>
			<th>Total Students</th>
			<th>Total Boys</th>
			<th>Total Girls</th>
			<th>Total Amount</th>
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
					<td><?php echo $i; ?></td>
					<td><?php echo $value->stopname; ?></td>
					<td><?php echo $value->stp_amt; ?>/-</td>
					<td><?php echo $value->TOTALSTUDENT; ?></td>
					<td><?php echo $value->MALE; ?></td>
					<td><?php echo $value->FEMALE; ?></td>
					<td><?php echo $tot_amt; ?>/-</td>
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
<script type="text/javascript">
$(document).ready(function() {
$("#msg").fadeOut(8000);
$('#example').DataTable({
	dom: 'Bfrtip',
	buttons: [
		{
			extend: 'excelHtml5',
			title: 'Bus Stoppage Summary Report',
		},
	]
});
});

</script>
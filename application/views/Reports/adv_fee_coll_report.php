<form method="post" action="<?php echo base_url('Report/adv_coll_data_pdf'); ?>" target="_blank">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12">
			    <input type="hidden" value="<?php echo $start_date; ?>" name="start_date">
			    <input type="hidden" value="<?php echo $end_date; ?>" name="end_date">
				<button class="btn pull-right"><i class="fa fa-file-pdf-o"></i> Download</button>
		</div>
	</div>
	
</form><br />
<div class='row'>
	<div class='col-md-12 col-xl-12 col-sm-12'>
		<div style='overflow:auto;'>
			<table id='example'>
				<thead>
					<tr>
						<th style='color:white!important;'>S.NO</th>
						<th style='color:white!important;'>Fee Head Name</th>
						<th style='color:white!important;'>Amount</th>
					</tr>
				</thead>
				<tbody>
					<?php
					
							foreach($feehead as $key => $value)
							{
								$vl = $key + 1;
								?>
								<tr>
									<td><?php echo $key + 1; ?></td>
									<td><?php echo $value->FEE_HEAD; ?></td>
									<td><?php echo $data[0]['Fee'.$vl]; ?></td>
								</tr>
								<?php
								
							}
						   
					?>
				</tbody>
				<tfoot>
            <tr>
                <td></td>
                 <td><b style="font-size:16px;color:red;font-weight: 900;">GRAND TOTAL</b></td>
                 <td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $data[0]['TOT']; ?></b></td>
				
            </tr>
        </tfoot>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
			/* {
                extend: 'copyHtml5',
				title: 'Daily Collection Reports',
               
            }, */
			{
                extend: 'excelHtml5',
				title: 'Advance Fee Collection Report',
                
            },
			
        ]
    });
 });
</script>
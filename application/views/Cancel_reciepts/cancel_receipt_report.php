<form method="post" action="<?php echo base_url('Cancel_receipt/headwise_data_PDF'); ?>" target="_blank">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12">
				<input type="hidden" value="<?php echo $collectiontype; ?>" name="collectiontype">
				<input type="hidden" value="<?php echo $collectioncounter; ?>" name="collectioncounter">
			    <input type="hidden" value="<?php echo $single; ?>" name="single">
			    <input type="hidden" value="<?php echo $double; ?>" name="double">
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
						<th >S.NO</th>
						<th >Receipt No</th>
						<th >Receipt Date</th>
						<th >Adm No</th>
						<th >Class </th>
						<th >Sec</th>
						<th >Operator ID</th>
					</tr>
				</thead>
				<tbody>
					<?php
					
							foreach($data as $key => $value)
							{
								$vl = $key + 1;
								?>
								<tr>
									<td><?php echo $key + 1; ?></td>
									<td><?php echo $value['RECT_NO']; ?></td>
									<td><?php echo $value['RECT_DATE']; ?></td>
									<td><?php echo $value['ADM_NO']; ?></td>
									<td><?php echo $value['CLASS']; ?></td>
									<td><?php echo $value['SEC']; ?></td>
									<td><?php echo $value['User_Id']; ?></td>
									
								</tr>
								<?php
                                
                                $vl++;
								
							}
						   
					?>
				</tbody>
				<tfoot>
            
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
				title: 'Head Wise Summary Reports',
                
            },
			
        ]
    });
 });
</script>
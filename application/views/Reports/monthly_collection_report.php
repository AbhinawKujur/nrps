<?php
	if($feehead1)
	{
		$feehead1 = $feehead1[0]->FEE_HEAD;
	}
	if($feehead2)
	{
		$feehead2 = $feehead2[0]->FEE_HEAD;
	}
	if($feehead3)
	{
		$feehead3 = $feehead3[0]->FEE_HEAD;
	}
	if($feehead4)
	{
		$feehead4 = $feehead4[0]->FEE_HEAD;
	}
	if($feehead5)
	{
		$feehead5 = $feehead5[0]->FEE_HEAD;
	}
	if($feehead6)
	{
		$feehead6 = $feehead6[0]->FEE_HEAD;
	}
	if($feehead7)
	{
		$feehead7 = $feehead7[0]->FEE_HEAD;
	}
	if($feehead8)
	{
		$feehead8 = $feehead8[0]->FEE_HEAD;
	}
	if($feehead9)
	{
		$feehead9 = $feehead9[0]->FEE_HEAD;
	}
	if($feehead10)
	{
		$feehead10 = $feehead10[0]->FEE_HEAD;
	}
	if($feehead11)
	{
		$feehead11 = $feehead11[0]->FEE_HEAD;
	}
	if($feehead12)
	{
		$feehead12 = $feehead12[0]->FEE_HEAD;
	}
	if($feehead13)
	{
		$feehead13 = $feehead13[0]->FEE_HEAD;
	}
	if($feehead14)
	{
		$feehead14 = $feehead14[0]->FEE_HEAD;
	}
	if($feehead15)
	{
		$feehead15 = $feehead15[0]->FEE_HEAD;
	}
	if($feehead16)
	{
		$feehead16 = $feehead16[0]->FEE_HEAD;
	}
	if($feehead17)
	{
		$feehead17 = $feehead17[0]->FEE_HEAD;
	}
	if($feehead18)
	{
		$feehead18 = $feehead18[0]->FEE_HEAD;
	}
	if($feehead19)
	{
		$feehead19 = $feehead19[0]->FEE_HEAD;
	}
	if($feehead20)
	{
		$feehead20 = $feehead20[0]->FEE_HEAD;
	}
	if($feehead21)
	{
		$feehead21 = $feehead21[0]->FEE_HEAD;
	}
	if($feehead22)
	{
		$feehead22 = $feehead22[0]->FEE_HEAD;
	}
	if($feehead23)
	{
		$feehead23 = $feehead23[0]->FEE_HEAD;
	}
	if($feehead24)
	{
		$feehead24 = $feehead24[0]->FEE_HEAD;
	}
	if($feehead25)
	{
		$feehead25 = $feehead25[0]->FEE_HEAD;
	}
?>
<div class='row'>
	<div class='col-md-12 col-xl-12 col-sm-12'>
		<div style='overflow:auto;'>
			<table id='example'>
				<thead>
					<tr>
						<th style='color:white!important;'>S.NO</th>
						<th style='color:white!important;'>Receipt Date</th>
						<th style='color:white!important;'>Receipt From</th>
						<th style='color:white!important;'>Receipt To</th>
						<th style='color:white!important;'>Paid Amount</th>
						<th style='color:white!important;'>Gross Amount</th>
						<th style='color:white!important;'>Short Amount</th>
						<th style='color:white!important;'>Recovered Amount</th>
						<th style='color:white!important;'><?php echo $feehead1; ?></th>
						<th style='color:white!important;'><?php echo $feehead2; ?></th>
						<th style='color:white!important;'><?php echo $feehead3; ?></th>
						<th style='color:white!important;'><?php echo $feehead4; ?></th>
						<th style='color:white!important;'><?php echo $feehead5; ?></th>
						<th style='color:white!important;'><?php echo $feehead6; ?></th>
						<th style='color:white!important;'><?php echo $feehead7; ?></th>
						<th style='color:white!important;'><?php echo $feehead8; ?></th>
						<th style='color:white!important;'><?php echo $feehead9; ?></th>
						<th style='color:white!important;'><?php echo $feehead10; ?></th>
						<th style='color:white!important;'><?php echo $feehead11; ?></th>
						<th style='color:white!important;'><?php echo $feehead12; ?></th>
						<th style='color:white!important;'><?php echo $feehead13; ?></th>
						<th style='color:white!important;'><?php echo $feehead14; ?></th>
						<th style='color:white!important;'><?php echo $feehead15; ?></th>
						<th style='color:white!important;'><?php echo $feehead16; ?></th>
						<th style='color:white!important;'><?php echo $feehead17; ?></th>
						<th style='color:white!important;'><?php echo $feehead18; ?></th>
						<th style='color:white!important;'><?php echo $feehead19; ?></th>
						<th style='color:white!important;'><?php echo $feehead20; ?></th>
						<th style='color:white!important;'><?php echo $feehead21; ?></th>
						<th style='color:white!important;'><?php echo $feehead22; ?></th>
						<th style='color:white!important;'><?php echo $feehead23; ?></th>
						<th style='color:white!important;'><?php echo $feehead24; ?></th>
						<th style='color:white!important;'><?php echo $feehead25; ?></th>
					</tr>
				</thead>
				<tbody>
					<?php
						if($data_array)
						{
							$i=1;
							$totalamt = 0;
							foreach($data_array as $data_type)
							{
								if($data_type->RECT_DATE!="")
								{
									?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo date('d-M-Y',strtotime($data_type->RECT_DATE)); ?></td>
											<td><?php echo $data_type->RECT_NO_start; ?></td>
											<td><?php echo $data_type->RECT_NO_end; ?></td>
											<td><?php echo $data_type->PAID_AMOUNT; ?></td>
											<td><?php echo $data_type->TOTAL; ?></td>
											<td><?php echo $data_type->SHORT_AMOUNT; ?></td>
											<td><?php echo $data_type->Recovered_Short_Amt; ?></td>
											<td><?php echo $data_type->Fee1; ?></td>
											<td><?php echo $data_type->Fee2; ?></td>
											<td><?php echo $data_type->Fee3; ?></td>
											<td><?php echo $data_type->Fee4; ?></td>
											<td><?php echo $data_type->Fee5; ?></td>
											<td><?php echo $data_type->Fee6; ?></td>
											<td><?php echo $data_type->Fee7; ?></td>
											<td><?php echo $data_type->Fee8; ?></td>
											<td><?php echo $data_type->Fee9; ?></td>
											<td><?php echo $data_type->Fee10; ?></td>
											<td><?php echo $data_type->Fee11; ?></td>
											<td><?php echo $data_type->Fee12; ?></td>
											<td><?php echo $data_type->Fee13; ?></td>
											<td><?php echo $data_type->Fee14; ?></td>
											<td><?php echo $data_type->Fee15; ?></td>
											<td><?php echo $data_type->Fee16; ?></td>
											<td><?php echo $data_type->Fee17; ?></td>
											<td><?php echo $data_type->Fee18; ?></td>
											<td><?php echo $data_type->Fee19; ?></td>
											<td><?php echo $data_type->Fee20; ?></td>
											<td><?php echo $data_type->Fee21; ?></td>
											<td><?php echo $data_type->Fee22; ?></td>
											<td><?php echo $data_type->Fee23; ?></td>
											<td><?php echo $data_type->Fee24; ?></td>
											<td><?php echo $data_type->Fee25; ?></td>
										</tr>
								<?php
								$i++;
								$totalamt = $totalamt+$data_type->TOTAL;
								}
								else
								{
									
								}
							}
						}
					?>
				</tbody>
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
				title: 'Month Collection Reports',
                
            },
			/* {
                extend: 'csvHtml5',
				title: 'Daily Collection Reports',
                
            }, */
			/* {
                extend: 'pdfHtml5',
				title: 'Daily Collection Reports',
                
            }, */
        ]
    });
 });
</script>
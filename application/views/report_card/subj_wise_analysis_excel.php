<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>">Report</a> <i class="fa fa-angle-right"></i> Subject Wise Analysis </li>
</ol>

<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;">
  <div class="row">
    <div class='col-sm-12'> 
		<table class='table dataTable'>
			<thead>
				<tr>
					<th style='color:#fff !important; background:#5785c3;'>Subject Name</th>
					<th style='color:#fff !important; background:#5785c3;'>&gt 90</th>
					<th style='color:#fff !important; background:#5785c3;'>&gt 80</th>
					<th style='color:#fff !important; background:#5785c3;'>&gt 70</th>
					<th style='color:#fff !important; background:#5785c3;'>&gt 60</th>
					<th style='color:#fff !important; background:#5785c3;'>&gt 50</th>
					<th style='color:#fff !important; background:#5785c3;'>&gt 40</th>
					<th style='color:#fff !important; background:#5785c3;'>&gt 32</th>
					<th style='color:#fff !important; background:#5785c3;'>&lt 32</th>
				</tr>
			</thead>
			
			<tbody>
			
			<?php
				foreach($subj_wise_mrks as $key => $val){
			?>
				<tr>
					<td><?php echo $val[0]['subj'.$key.'_nm']; ?></td>
					<td><?php echo $val[0]['subj'.$key.'_abv90']; ?></td>
					<td><?php echo $val[0]['subj'.$key.'_abv80']; ?></td>
					<td><?php echo $val[0]['subj'.$key.'_abv70']; ?></td>
					<td><?php echo $val[0]['subj'.$key.'_abv60']; ?></td>
					<td><?php echo $val[0]['subj'.$key.'_abv50']; ?></td>
					<td><?php echo $val[0]['subj'.$key.'_abv40']; ?></td>
					<td><?php echo $val[0]['subj'.$key.'_abv32']; ?></td>
					<td><?php echo $val[0]['subj'.$key.'_lss32']; ?></td>
				</tr>
			<?php } ?>	
			</tbody>
		</table>
	</div>	
  </div>	
</div><br />

<script>
	$('.dataTable').DataTable({
		'ordering' : false,
        dom: 'Bfrtip',
        buttons: [
            'excel'
        ]
    });
</script>	
<table class="table table-bordered dataTable table-striped">
  <thead style="background: #d2d6de;">
    <tr>
      <th style="background: #337ab7; color: white !important;" class="text-center">S. No</th>
      <th style="background: #337ab7; color: white !important;">Stoppage Name</th>
      <th style="background: #337ab7; color: white !important;">Trip</th>
      <th style="background: #337ab7; color: white !important;">Prefrence</th>
      <th style="background: #337ab7; color: white !important;">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
		$i=1;
		foreach($busstoppagedetails as $key=>$value){
			?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php if(!empty($value->STOPPAGE)){echo $value->STOPPAGE;}else{echo "N/A";} ?></td>
					<td><?php echo $value->Trip_Nm; ?></td>
					<td><?php if($value->Prefer_ID==1){echo "Boys";}elseif($value->Prefer_ID==2){echo "Girls";}elseif($value->Prefer_ID==3){echo "Co.Ed";} ?></td>
					<td><a href='<?php echo base_url('Add_bus_route/edit_details/'.$value->Route_Id); ?>' title='edit'><i class="fa fa-pencil-square-o" aria-hidden="true" style='color:black;' ></i></a></td>
				</tr>
			<?php
			$i++;
		}
	?>
  </tbody>
</table>   
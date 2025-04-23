<style>
label{
	font-size:12px;
	font-weight: bold !important;
}
table{
	padding-right:20px;
}
button.dt-button, div.dt-button, a.dt-button {
	line-height:0.66em;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
	line-height:0.66em;
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

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Almirah Master</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div style="padding-top:20px; padding-left: 25px; background-color: white; border-top:3px solid #337ab7;">
	<div class='row'>
		<div class='col-sm-4'>
		    <?php
			  if($this->session->flashdata('success')){
				  ?>
				    <div class="alert alert-success">
					   <?php echo $this->session->flashdata('success'); ?>
					</div>
				  <?php
			  }
			?>
			<div id='load'>
			<form action="<?php echo base_url('library/RackMaster/saveRack'); ?>" method='post' autocomplete='off'>
			  <div class="form-group">
				<label>Almirah Name:</label>
				<input type="text" class="form-control" name="rack_nm" style='text-transform: uppercase;' required>
			  </div>
			  
			  <div class='row'>
			    <div class='col-sm-6'>
				  <div class="form-group">
					<label>Rack From:</label>
					<input type="number" class="form-control" name="rack_from" style='text-transform: uppercase;' required>
				  </div>
				</div>
				<div class='col-sm-6'>
				  <div class="form-group">
					<label>Rack To:</label>
					<input type="number" class="form-control" name="rack_to" style='text-transform: uppercase;' required>
				  </div>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label>Almirah Description:</label>
				<textarea class="form-control" name="rack_desc" style='text-transform: uppercase;'></textarea>
			  </div>
			  <button type="submit" class="btn btn-success">Submit</button>
			</form>
			</div>
		</div>
		<div class='col-sm-8' style='padding-right:20px;'>
		    <div class='table-responsive'>
			<table class='table' id='example'>
			<thead>
				<tr>
					<th style='background:#337ab7; color:#fff !important;'>Almirah Id</th>
					<th style='background:#337ab7; color:#fff !important;'>Almirah Name</th>
					<th style='background:#337ab7; color:#fff !important;'>Rack From</th>
					<th style='background:#337ab7; color:#fff !important;'>Rack To</th>
					<th style='background:#337ab7; color:#fff !important;'>Almirah Discription</th>
					<th style='background:#337ab7; color:#fff !important;'>Action</th>
				</tr>
			</thead>	
			<tbody>	
				<?php
					foreach($rackMasterData as $key => $val){
						?>
							<tr>
								<td><?php echo $val['RackNo']; ?></td>
								<td><?php echo $val['RackName']; ?></td>
								<td><?php echo $val['rack_from']; ?></td>
								<td><?php echo $val['rack_to']; ?></td>
								<td><?php echo $val['RackDiscription']; ?></td>
								<td><a href='#' onclick="rackMasterEdit(<?php echo $val['RackNo']; ?>,'<?php echo $val['RackName']; ?>',<?php echo $val['rack_from']; ?>,<?php echo $val['rack_to']; ?>,'<?php echo $val['RackDiscription']; ?>')"><i class="fa fa-pencil-square" style=' font-size:20px; color:green'></i></a></td>
							</tr>
						<?php
					}
				?>
			</tbody>	
			</table>
			</div>
		</div>
	</div><br />
</div><br />

<script>
$(".alert").fadeOut(3000);
$('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
			/* {
                extend: 'copyHtml5',
				title: 'Daily Collection Reports',
               
            }, */
			{
                extend: 'excelHtml5',
				title: 'Daily Collection Reports',
                
            },
			/* {
                extend: 'csvHtml5',
				title: 'Daily Collection Reports',
                
            }, */
			{
                extend: 'pdfHtml5',
				title: 'Daily Collection Reports',
                
            },
        ]
    });
	
	function rackMasterEdit(rack_id,rack_nm,rack_from,rack_to,rack_desc){
		$.post("<?php echo base_url('library/RackMaster/edit'); ?>",{rack_id:rack_id,rack_nm:rack_nm,rack_from:rack_from,rack_to:rack_to,rack_desc:rack_desc},function(data){
			$("#load").html(data);
		});
	}
</script>
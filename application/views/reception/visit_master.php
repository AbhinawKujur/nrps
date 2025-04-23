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
    <li class="breadcrumb-item"><a href="index.html">Visits</a> <i class="fa fa-angle-right"></i></li>
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
			<form action="<?php echo base_url('reception/Visit_master/save_visit'); ?>" method='post' autocomplete='off'>
			  <div class="form-group">
				<label>Department:</label>
				<select class='form-control' id='dept_id' name='dept_id' required>
					<option value=''>Select</option>
					<?php
						foreach($deptt as $key => $val){
							?>
								<option value='<?php echo $val->id; ?>'><?php echo $val->dept; ?></option>
							<?php
						}
					?>
				</select>
			  </div>
			  <div class="form-group">
				<label>Visitor Purpose:</label>
				<select class='form-control' id='vis_pur_id' name='vis_pur_id' required>
					<option value=''>Select</option>
					<?php
						foreach($vis_purpose as $key => $val){
							?>
								<option value='<?php echo $val->id; ?>'><?php echo $val->vis_purpose; ?></option>
							<?php
						}
					?>
				</select>
			  </div>
			  <div class="form-group">
				<label>Visitor Type:</label>
				<select class='form-control' id='vis_type_id' name='vis_type_id' required >
					<option value=''>Select</option>
					<?php
						foreach($vis_type as $key => $val){
							?>
								<option value='<?php echo $val->id; ?>'><?php echo $val->vis_type; ?></option>
							<?php
						}
					?>
				</select>
				
			  </div>
			  <div class="form-group">
				<label>Visitor Count(/day):</label>
				<input type="text" class="form-control" name="visit_count" id="visit_count" style='text-transform: uppercase;' maxlength="5" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
			  </div>
			  <div class="form-group">
				<label>Date:</label>
				<input type="date" class="form-control" name="f_date" id="f_date" onchange="dupval(this.value)">
			  </div><label id='ss' style='color:red;'></label>
			  <button type="submit" class="btn btn-success">Save</button>
			</form>
			</div>
		</div>
		<div class='col-sm-8' style='padding-right:20px;'>
		    <div class='table-responsive'>
			<table class='table' id='example'>
			<thead>
				<tr>
					<th style='background:#337ab7; color:#fff !important;'>Sl no.</th>
					<th style='background:#337ab7; color:#fff !important;'>Department</th>
					<th style='background:#337ab7; color:#fff !important;'>Visitor Purpose</th>
					<th style='background:#337ab7; color:#fff !important;'>Visitor Type</th>
					<th style='background:#337ab7; color:#fff !important;'>No. of Count</th>
					<th style='background:#337ab7; color:#fff !important;'>Date</th>
					<th style='background:#337ab7; color:#fff !important;'>Action</th>
				</tr>
			</thead>	
			<tbody>	
				<?php
				$i = 1;
					foreach($visit as $key => $val){
						?>
							<tr>
								<td><?php echo $i; ?></td>
								<td style='text-transform: uppercase;'><?php echo $val->dept; ?></td>
								<td style='text-transform: uppercase;'><?php echo $val->vis_purpose; ?></td>
								<td style='text-transform: uppercase;'><?php echo $val->vis_type; ?></td>
								<td style='text-transform: uppercase;'><?php echo $val->visit_count; ?></td>
								<td style='text-transform: uppercase;'><?php echo $val->f_date; ?></td>
								<td><a href='#' onclick="masterEdit(<?php echo $val->id; ?>,'<?php echo $val->dept; ?>','<?php echo $val->vis_purpose; ?>','<?php echo $val->vis_type; ?>','<?php echo $val->visit_count; ?>','<?php echo $val->f_date; ?>')"><i class="fa fa-pencil-square" style=' font-size:20px; color:green'></i></a></td>
							</tr>
						<?php
						$i++;
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
				title: 'Visits Reports',
                
            },
			/* {
                extend: 'csvHtml5',
				title: 'Daily Collection Reports',
                
            }, */
			{
                extend: 'pdfHtml5',
				title: 'Visits Reports',
                
            },
        ]
    });
	
	function masterEdit(id,dept,vis_purpose,vis_type,visit_count,f_date){
		$.post("<?php echo base_url('reception/Visit_master/edit'); ?>",{id:id,dept:dept,vis_purpose:vis_purpose,vis_type:vis_type,visit_count:visit_count,f_date:f_date},function(data){
			$("#load").html(data);
		});
	}
	function dupval(val){
		
	  var vis_type = $('#vis_type_id').val();
	  var dept_id =$('#dept_id').val();
	  var vis_pur_id =$('#vis_pur_id').val();
	  var f_date =$('#f_date').val();
	  $.ajax({
		url:'<?php echo base_url('reception/Visit_master/dupval'); ?>',
		type: "POST",
		dataType:'json',
		data: {vis_type:vis_type,dept_id:dept_id,vis_pur_id:vis_pur_id,f_date:f_date},
		success: function(data)
        {
          var a=data.msg;
		  if(a=='S')
                {
                  
                  $('#ss').text('Data already exists!!');
				  $('#ss').fadeIn().delay(2000).fadeOut();
				  $("#vis_type_id").val('');
                  $("#dept_id").val('');
				  $("#vis_pur_id").val('');
				  $("#f_date").val('');
                }
				
		  
		}, 
	});
}
</script>
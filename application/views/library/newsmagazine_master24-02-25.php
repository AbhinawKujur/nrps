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
    <li class="breadcrumb-item"><a href="index.html">News Paper Magazine Master</a> <i class="fa fa-angle-right"></i></li>
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
			<form action="<?php echo base_url('library/NewsMagazineMaster/save'); ?>" method='post' autocomplete='off'>
			  <div class="form-group">
				<label>Name:</label>
				<input type="text" class="form-control" name="nm" style='text-transform: uppercase;' required>
			  </div>
			  <div class="form-group">
				<label>Type:</label>
				<select class='form-control' name='type' required>
					<option value=''>Select</option>
					<option value='NewsPaper'>NewsPaper</option>
					<option value='Magazine'>Magazine</option>
					<option value='General'>General</option>
					<option value='Journal'>Journal</option>
				</select>
			  </div>
			  <div class="form-group">
				<label>Description:</label>
				<input type='text' class="form-control" name="desc" style='text-transform: uppercase;'>
			  </div>
			  <div class='row'>
			    <div class='col-sm-6'>
				  <div class="form-group">  
				    <label>MON</label>
					<input type='number' placeholder='0.00' class='form-control' name='mon_price'>
				  </div>
				</div>
				<div class='col-sm-6'>
				  <div class="form-group">  
				    <label>TUE</label>
					<input type='number' placeholder='0.00' class='form-control' name='tue_price'>
				  </div>
				</div>
			  </div>
			  
			  <div class='row'>
			    <div class='col-sm-6'>
				  <div class="form-group">  
				    <label>WED</label>
					<input type='number' placeholder='0.00' class='form-control' name='wed_price'>
				  </div>
				</div>
				<div class='col-sm-6'>
				  <div class="form-group">  
				    <label>THU</label>
					<input type='number' placeholder='0.00' class='form-control' name='thu_price'>
				  </div>
				</div>
			  </div>
			  
			  <div class='row'>
			    <div class='col-sm-6'>
				  <div class="form-group">  
				    <label>FRI</label>
					<input type='number' placeholder='0.00' class='form-control' name='fri_price'>
				  </div>
				</div>
				<div class='col-sm-6'>
				  <div class="form-group">  
				    <label>SAT</label>
					<input type='number' placeholder='0.00' class='form-control' name='sat_price'>
				  </div>
				</div>
			  </div>
			  
			  <div class='row'>
			    <div class='col-sm-6'>
				  <div class="form-group">  
				    <label>SUN</label>
					<input type='number' placeholder='0.00' class='form-control' name='sun_price'>
				  </div>
				</div>
			  </div>
			  <button type="submit" class="btn btn-success">Save</button>
			</form>
			</div>
		</div>
		<div class='col-sm-8' style='padding-right:20px;'>
		    <div class='table-responsive'>
			<table class='table' id='example'>
			<thead>
				<tr>
					<th style='background:#337ab7; color:#fff !important;'>Name</th>
					<th style='background:#337ab7; color:#fff !important;'>Type</th>
					<th style='background:#337ab7; color:#fff !important;'>MON</th>
					<th style='background:#337ab7; color:#fff !important;'>TUE</th>
					<th style='background:#337ab7; color:#fff !important;'>WED</th>
					<th style='background:#337ab7; color:#fff !important;'>THU</th>
					<th style='background:#337ab7; color:#fff !important;'>FRI</th>
					<th style='background:#337ab7; color:#fff !important;'>SAT</th>
					<th style='background:#337ab7; color:#fff !important;'>SUN</th>
					<th style='background:#337ab7; color:#fff !important;'>Action</th>
				</tr>
			</thead>	
			<tbody>	
				<?php
					foreach($newsMagazineMasterData as $key => $val){
						?>
							<tr>
								<td><?php echo $val['ItemName']; ?></td>
								<td><?php echo $val['ItemType']; ?></td>
								<td><?php echo $val['Price_mon']; ?></td>
								<td><?php echo $val['Price_tue']; ?></td>
								<td><?php echo $val['Price_wed']; ?></td>
								<td><?php echo $val['Price_thu']; ?></td>
								<td><?php echo $val['Price_fri']; ?></td>
								<td><?php echo $val['Price_sat']; ?></td>
								<td><?php echo $val['Price_sun']; ?></td>
								<td><a href='#' onclick="newsMagazineMasterEdit(<?php echo $val['ItemID']; ?>)"><i class="fa fa-pencil-square" style=' font-size:20px; color:green'></i></a></td>
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
	
	function newsMagazineMasterEdit(ItemID){
		$.post("<?php echo base_url('library/NewsMagazineMaster/edit'); ?>",{ItemID:ItemID},function(data){
			$("#load").html(data);
		});
	}
</script>
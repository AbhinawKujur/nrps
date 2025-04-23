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
    <li class="breadcrumb-item"><a href="index.html">Almirah Master</a> <i class="fa fa-angle-right"></i></li>
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
			<form action="<?php echo base_url('library/BookTypeMaster/saveBook'); ?>" method='post' autocomplete='off'>
			  <div class="form-group">
				<label>Type of Book:</label>
				<input type="text" class="form-control" name="book_type" style='text-transform: uppercase;' required>
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
					<th style='background:#337ab7; color:#fff !important;'>Book Type Id</th>
					<th style='background:#337ab7; color:#fff !important;'>Book Type</th>
					<th style='background:#337ab7; color:#fff !important;'>Action</th>
				</tr>
			</thead>	
			<tbody>	
				<?php
					foreach($bookTypeData as $key => $val){
						?>
							<tr>
								<td><?php echo $val['id']; ?></td>
								<td><?php echo $val['book_type']; ?></td>
								<td><a href='#' onclick="rackMasterEdit(<?php echo $val['id']; ?>,'<?php echo $val['book_type']; ?>')"><i class="fa fa-pencil-square" style=' font-size:20px; color:green'></i></a></td>
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
	
	function rackMasterEdit(id,book_type){
		$.post("<?php echo base_url('library/BookTypeMaster/edit'); ?>",{id:id,book_type:book_type},function(data){
			$("#load").html(data);
		});
	}
</script>
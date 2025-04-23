
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
 
 .tab1{
 	border:1px solid #dddddd;
 }
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Book Issue Report</a> <i class="fa fa-angle-right"></i></li>
</ol>
==============================================================================-->
<form action="<?php echo base_url('library/LibraryReport/barcode'); ?>" method="post" autocomplete="off">
<div style="padding-top:20px; padding-left: 25px; background-color: white; border-top:3px solid #337ab7;">
	<div class='row' style="margin-right: 0px;">
		<div class="row">
			<div class="col-md-12">
			  <div class="row">
				  <div class="col-sm-3">
					  <div class="form-group">
						<label>Subject Name:</label>
						<select class='form-control' id='subj_id' name='subj_id' >
							<option value=''>--Select--</option>
							<?php
							foreach($subjectname as $key => $val){
							?>
							<option value="<?=$val['id']?>"><?=$val['book_name']?></option>
							<?php }?>							
						</select>
					  </div>
				  </div>
				  
				  <div class="col-sm-3">
					   <div class="form-group">
							<br/>
							<button type="submit" class="btn btn-info" name="search" style="border-radius: 10px"> <i class="fa fa-search"></i> Search</button>
					  </div>
				  </div>				  
			  </div>
			  <hr style="border:1px solid #dddddd">
			  <div class="row" style="margin-right: 0px; margin-left: 0px;">
			  	<div class='table-responsive'>
			  		<?php 
			  		if(isset($book_data)){			  			
			  			foreach($book_data as $key => $val){
							echo "<p class='inline'>".bar128(stripcslashes($val['accno']))."</p>&nbsp&nbsp&nbsp&nbsp";
						} }?>
			  	</div>
			  </div>
			</div>
		</div>
	</div>	
</div>
</form>	
<br />

<script>
$(".alert").fadeOut(3000);	
$("#subj_id").select2();
$('.datepicker').datepicker({
		  format: 'dd-M-yyyy',
		  autoclose: true,
		  orientation: "bottom",
		  todayHighlight: true,
	});

$('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
			
			{
                extend: 'excelHtml5',
				title: 'Book Issued Reports',
                
            },			
			{
                extend: 'pdfHtml5',
				title: 'Book Issued Reports',
                
            },
        ]
    });
	
</script>
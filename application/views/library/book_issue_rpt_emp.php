
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
    <li class="breadcrumb-item"><a href="#">Book Issue Report Employee</a> <i class="fa fa-angle-right"></i></li>
</ol>
<form action="<?php echo base_url('library/LibraryReport/book_report_emp'); ?>" method="post" autocomplete="off">
<div style="padding-top:20px; padding-left: 25px; background-color: white; border-top:3px solid #337ab7;">
	<div class='row' style="margin-right: 0px;">
		<div class="row">
			<div class="col-md-12">
			  <div class="row">
				  <div class="col-sm-3">
					  <div class="form-group">
						<label>Type:</label>
						<select class='form-control' id='rpttyp' name='rpttyp' >
							<option value=''>--Select--</option>
							<option value="0">Issued</option>					
							<option value="1">All Issued</option>
							<option value="2">Defaulter</option>							
						</select>
					  </div>
				  </div>
				  <div class="col-sm-3">
					  <div class="form-group">
						<label>From Date:</label>
						<input type="text"  class="form-control datepicker"  value="<?=date('d-M-Y')?>" maxlength="10" value="<?php if(isset($_POST['fromdt'])){echo $_POST['fromdt'];} ?>" name="fromdt" id="fromdt">
					  </div>
				  </div>
				   <div class="col-sm-3">
					   <div class="form-group">
							<label>To-Date:</label>
							<input type="text"  class="form-control datepicker"  value="<?=date('d-M-Y')?>" maxlength="10" name="to_dt" id="to_dt">
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
			  		if(isset($isuu_rpt)){
			  			
			  			?>
						<table class='table' id="example" style="font-size: 16px;">	
						<thead> 		
				  			<tr>
				  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Book Code</th>
				  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Book Name</th>
				  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Issued Date</th>
				  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Due Date</th>
								<th style="background:#337ab7;color:#fff !important;border:1px solid;">Employee ID</th>
								<th style="background:#337ab7;color:#fff !important;border:1px solid;">Employee Name</th>
				  			</tr>
				  		</thead>
				  		<tbody>
				  			<?php
							foreach($isuu_rpt as $key => $val){
							?>  <tr>
					  				<td class="tab1"><?=$val['BookID']?></td>
					  				<td class="tab1"><?=$val['BName']?></td>
					  				<td class="tab1"><?=date('d-M-Y',strtotime($val['IDate']))?></td>
					  				<td class="tab1"><?=date('d-M-Y',strtotime($val['Due_date']))?></td>
							<td class="tab1"><?=$val['EMPID']?></td>
								<td class="tab1"><?=$val['EMP']?></td>
					  			</tr>
				  			<?php } ?>
				  		</tbody>
				  		</table>
			  		<?php }	?>
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
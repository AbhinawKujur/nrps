
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
    border:1px solid;
 }
 .tab{
 	background:#337ab7; 
 	color:#fff !important;
 	border:1px solid;
 }
 .tab1{
 	border:1px solid #dddddd;
 }
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Book Return Report Employee</a> <i class="fa fa-angle-right"></i></li>
</ol>
<form action="<?php echo base_url('library/LibraryReport/BookReturnRpt'); ?>" method="post" autocomplete="off">
<div style="padding-top:20px; padding-left: 25px; background-color: white; border-top:3px solid #337ab7;">
	<div class='row' style="margin-right: 0px;">
		<div class="row">
			<div class="col-md-12">
			  <div class="row">
				  
				  <div class="col-sm-2" style="text-align: right;">
					  <div class="form-group">
						<label>From Date:</label>						
					  </div>
				  </div>
				  <div class="col-sm-3">
					  <div class="form-group">						
						<input type="text"  class="form-control datepicker"  value="<?=date('d-M-Y')?>" maxlength="10" name="fromdt" id="fromdt">
					  </div>
				  </div>
				   <div class="col-sm-2" style="text-align: right;">
					   <div class="form-group">
							<label>To-Date:</label>							
					  </div>
				  </div>
				  <div class="col-sm-3">
					   <div class="form-group">
							
							<input type="text"  class="form-control datepicker"  value="<?=date('d-M-Y')?>" maxlength="10" name="to_dt" id="to_dt">
					  </div>
				  </div>
				  <div class="col-sm-2">
					   <div class="form-group">							
							<button type="submit" name="search" class="btn btn-info"  style="border-radius: 10px"> <i class="fa fa-search"></i> Search</button>
					  </div>
				  </div>				  
			  </div>
			  <hr style="border:1px solid #dddddd">
			  <div class="row" style="margin-right: 0px; margin-left: 0px;">
			  	<div class='table-responsive'>
			  		<?php 
			  		if(isset($return_rpt)){?>
						<table class='table' id='example' style="font-size: 13px;">		<thead>  		
					  			<tr>
					  			<th style="background:#337ab7;color:#fff !important;border:1px solid;">Acc. No.</th>
					  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Book Name</th>
					  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Issued Date</th>
					  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Return Date</th>
					  			</tr>
					  		</thead>
					  		<tbody>
					  			<?php
									foreach($return_rpt as $key => $val){
									?>
							  			<tr>
							  				<td class="tab1"><?=$val['BookID']?></td>
							  				<td class="tab1"><?=$val['BName']?></td>
							  				<td class="tab1"><?=date('d-M-Y',strtotime($val['IDate']))?></td>
							  				<td class="tab1"><?=date('d-M-Y',strtotime($val['RDate']))?></td>
							  			</tr>
						  		<?php } ?>
						  	</tbody>
				  		</table>
				  	<?php } ?>	
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
			/* {
                extend: 'copyHtml5',
				title: 'Daily Collection Reports',
               
            }, */
			{
                extend: 'excelHtml5',
				title: 'Book Return Reports',
                
            },
			/* {
                extend: 'csvHtml5',
				title: 'Daily Collection Reports',
                
            }, */
			{
                extend: 'pdfHtml5',
				title: 'Book Return Reports',
                
            },
        ]
    });
	
	
</script>
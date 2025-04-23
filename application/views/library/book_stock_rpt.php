
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
 .tab{
 	background:#337ab7; 
 	color:#fff !important;
 	border:1px solid;
 }
 .tab1{
 	border:1px solid black;
 }
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Book Stock Report</a> <i class="fa fa-angle-right"></i></li>
</ol>
<form action="<?php echo base_url('library/LibraryReport'); ?>" method="post" autocomplete="off">
<div style="padding-top:20px; padding-left: 25px; background-color: white; border-top:3px solid #337ab7;">
	<div class='row' style="margin-right: 0px;">
		<div class="row">
			<div class="col-md-12">			 
			  <div class="row" style="margin-right: 0px; margin-left: 0px;">
			  	<div class='table-responsive'>
					<table class='table' id='example' style="font-size: 13px;z-index:50;">	
						<thead>
				  			<tr>
				  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Sl.No.</th>
				  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Subject Name</th>
				  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Total Book</th>
				  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Issued</th>
				  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Damaged</th>
				  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Lost</th>
								<th style="background:#337ab7;color:#fff !important;border:1px solid;">Written off</th>
				  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">In-Stock</th>
				  			</tr>
				  		</thead>
				  		<tbody>
				  			<?php
				  			$c=0;
				  			foreach($tockreg as $key => $val){
								?>
					  			<tr>
					  				<td class="tab1"><?=++$c?></td>
					  				<td class="tab1"><?=$val['book_name']?></td>
					  				<td class="tab1"><?=$val['instok']?></td>
					  				<td class="tab1"><?=$val['totissued']?></td>		
					  				<td class="tab1"><?=$val['totlost']?></td>
					  				<td class="tab1"><?=$val['totdmage']?></td>
									<td class="tab1"><?=$val['totwritten']?></td>
					  				<td class="tab1"><?=($val['instok']-$val['totissued'])-($val['totdmage']+$val['totlost']+$val['totwritten'])?></td></tr>
				  			<?php } ?>
				  			
				  		</tbody>
			  		</table>
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
				title: 'Book Stock Reports',
                
            },
			/* {
                extend: 'csvHtml5',
				title: 'Daily Collection Reports',
                
            }, */
			{
                extend: 'pdfHtml5',
				title: 'Book Stock Reports',
                
            },
        ]
    });
	
	
</script>
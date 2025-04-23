
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
    <li class="breadcrumb-item"><a href="#">Book Lost & Damsge Reports</a> <i class="fa fa-angle-right"></i> 
	</i> 
	</li>
	  <li class="breadcrumb-item" style="display:none"><a href="#" >Sort By <select name="sort_by" id="sort_by">
	<option value="accno">Accession No.</option>
	<option value="BNAME">Book Name</option>
	</select> </a>
	</li>
</ol>
<form action="<?php echo base_url('library/LibraryReport'); ?>" method="post" autocomplete="off">
<div style="padding-top:20px; padding-left: 25px; background-color: white; border-top:3px solid #337ab7;">
	<div class='row' style="margin-right: 0px;">
		<div class="row">
			<div class="col-md-12">			 
			  <div class="row" style="margin-right: 0px; margin-left: 0px;" >
			  	<div class='table-responsive' id="data_show" >
					<table class='table' id='example' style="font-size: 13px;z-index:50;" >	
						<thead>
				  			<tr>
				  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Sl.No.</th>
				  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Acc. No.</th>
				  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Book Name</th>
				  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Author</th>
				  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Publisher</th>
				  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Price</th>
				  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Status</th>
				  			</tr>
				  		</thead>
				  		<tbody >
				  		 <?php
				  			$c=0;
				  			
								foreach($tockreg as $key => $val){
								?>
					  			<tr>
					  				<td class="tab1"><?=++$c?></td>
					  				<td class="tab1"><?=$val['accno']?></td>
					  				<td class="tab1"><?=$val['BNAME']?></td>
					  			
					  				<td class="tab1"><?=$val['AUTHOR']?></td>		
					  				<td class="tab1"><?=$val['PUBLISHER']?></td>
					  				<td class="tab1"><?=$val['PRICE']?></td>
					  				<td class="tab1">
									<?php 
									
										if($val['book_status']=='L'){
										$st="<span style='color:red'>LOST</span>";
									}else if($val['book_status']=='D'){
										$st="<span style='color:red'>Damage</span>";
									}else
									{
										$st="Written off";
									}
									echo $st;
									?>
									
									
									</td>
					  			</tr>
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
$("#sort_by").change(function(){
	var vl=$("#sort_by").val();
	
	$.post("<?php echo base_url('library/LibraryReport/BookStockReg_sort'); ?>",{'sort_by':vl},function(data){
		$("#data_show").html(data);
	});
})
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
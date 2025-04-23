
<style>
.table thead tr th{
	background:#337ab7;
	color:#fff !important;
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
    <li class="breadcrumb-item"><a href="#">Visitor Records</a> <i class="fa fa-angle-right"></i></li>
</ol>
<div style="padding: 10px; background-color: white; border-top:3px solid #5785c3;">
       
<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label><b>Start Date</b></label>
				<input type="date" name="strt_date" id='strt_date' max="2999-12-31" class="form-control" onchange="str_vis(this.value)">
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label><b>End Date</b></label>
				<input type="date" name="end_date" id='end_date' max="2999-12-31" class="form-control" onchange="end_vis(this.value)" readonly>
			</div>
		</div>
		</div>
<!--four-grids here-->
		<div >
		<div class="col-sm-3"></div>
		<div class='col-sm-6'>
		   <?php
		     if($this->session->flashdata('msg')):
		   ?>
		    <div class="alert alert-success" role="alert" id="msg">
			  <strong><?php echo $this->session->flashdata('msg'); ?></strong>
			</div>  
		   <?php endif; ?>	  
		</div>
		
        <div class='col-sm-3'>		
		  <a href="<?php echo base_url('reception/Visitreg_form/add_visit'); ?>" class='btn btn-warning pull-right'>Add visitor form</a><br /><br /><br />
        </div>
		<div class='col-sm-12' style='padding-right:20px;'>
         <div id="vis_det" class="table-responsive">		
		  <table class="table table-bordered" id="data_table">
			<thead>
			  <tr>
				<th>Sl. no.</th>
				<th>Visitor Id</th>
				<th>Entry Mode</th>
				<th>Visit Date</th>
				<th>Name</th>
				<th>Mobile No.</th>
				<th>Department</th>
				<th>Visitor Purpose</th>
				<th>Visitor Type</th>
				<th>In time</th>
			  </tr>
			</thead>
			<tbody >
			 
			</tbody>
		  </table>
		  </div></div>
		</div><br /><br />
        <div class="clearfix"></div>
                   
	
<!-- script-for sticky-nav -->
<script>
$(document).ready(function() {
	 var navoffeset=$(".header-main").offset().top;
	 $(window).scroll(function(){
		var scrollpos=$(window).scrollTop(); 
		if(scrollpos >=navoffeset){
			$(".header-main").addClass("fixed");
		}else{
			$(".header-main").removeClass("fixed");
		}
	 });
	 
});
</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" />


  <script type="text/javascript">
   	$("#msg").fadeOut(6000);
    $('#data_table').DataTable({
        dom: 'Bfrtip',
        buttons: [
			 
			{
                extend: 'excelHtml5',
				title: 'Visitor Reports',
                
            },
			 {
                extend: 'csvHtml5',
				title: 'Visitor Reports',
                
            },
			{
                extend: 'pdfHtml5',
				title: 'Visitor Reports',
                
            },
        ]
    });
 
 function str_vis(val)
	{
		var strr_date = val;
		
		if(strr_date !=''){
		$('#end_date').prop('readonly', false); 
		}
		$.ajax({
        url : "<?php echo base_url('reception/Visitreg_form/str_vis') ?>",
        type: "POST",
		data: {strr_date:strr_date},
        success: function(data)
        {
		   $('#vis_det').html(data);
		}, 
    }); 
	}
	function end_vis(val)
	{
		var endd_date = val;
		var strr_date = $('#strt_date').val();
		
		$.ajax({
        url : "<?php echo base_url('reception/Visitreg_form/endd_vis') ?>",
        type: "POST",
		data: {endd_date:endd_date,strr_date:strr_date},
		success: function(data)
        {
           $('#vis_det').html(data);
		}, 
    }); 
	}

    </script>

<?php
 error_reporting(0);
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Incharge Master</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
		<div style="padding: 10px; background-color: white; border-top:3px solid #5785c3;">
		<div class="row">
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
			<div class='col-sm-3'></div>
		</div>
		
		
<form method="post" class="form-inline" action="<?php echo base_url('Bus_incharge_entry/insert_data'); ?>">
	<div class="row">
		<div class="col-sm-5 col-md-5 form-group">
			<label for="name">Incharge Name:</label>
			<input type="text" class="form-control" id="incharge_name" name="incharge_name" required pattern="[A-Za-z ]{3,}">
		</div>
	  <div class="col-sm-5 col-md-5 form-group">
			<label for="number">Incharge Phone:</label>
			<input type="number" min="0" class="form-control" id="incharge_phone" oninput="validatephno(this.value)" name="incharge_phone" required maxlength="10" pattern="[0-9]{10}">
	  </div>
	  <div class="col-sm-2 col-md-2 form-group">
		<button type="submit" class="btn btn-primary pull-right">Add Bus Incharge</button>
	  </div>
  </div>
</form></br>
<table class="table table-bordered" id="example">
<thead>
  <tr>
	<th>Sl no.</th>
	<th>Incharge Name</th>
	<th>Phone No</th>
	<th>ACTION</th>
  </tr>
</thead>
<tbody>
  <?php
	if($data){
		$i = 1;
		foreach($data as $bus_data){
			?>
			  <tr>
				<td><?php echo $i; ?></td>
				<td><?php if($bus_data->Incharge_nm == null){ echo "N/A";}else{ echo $bus_data->Incharge_nm; } ?></td>
				<td><?php if($bus_data->Incharge_ph_no == null){ echo "N/A";}else{ echo $bus_data->Incharge_ph_no; } ?></td>
				<td><a href="<?php echo base_url('Bus_incharge_entry/edit_busincharge/'.$bus_data->Incharge_Id); ?>"><i style="color:#000; font-size:20px; cursor:pointer;"  class="fa fa-pencil-square"></i></a></td>
			  </tr>
			<?php
			$i++;
		}
	}
  ?>
</tbody>
</table>
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
  function validatephno(val){
	  $.ajax({
		  url : "<?php echo base_url('Bus_incharge_entry/validate_number'); ?>",
		  method: "POST",
		  data: {val:val},
		  success:function(data){
			 if(data == 1){
				 $('#incharge_phone').val("");
				 Command: toastr["error"]("This Mobile Number Is Already Exist Please Enter Another One.", "Warning")

					toastr.options = {
					  "closeButton": false,
					  "debug": true,
					  "newestOnTop": false,
					  "progressBar": true,
					  "positionClass": "toast-top-right",
					  "preventDuplicates": false,
					  "onclick": null,
					  "showDuration": "300",
					  "hideDuration": "1000",
					  "timeOut": "5000",
					  "extendedTimeOut": "1000",
					  "showEasing": "swing",
					  "hideEasing": "linear",
					  "showMethod": "fadeIn",
					  "hideMethod": "fadeOut"
					}
			 }
		  },
	  });
  }
   	$("#msg").fadeOut(6000);
    $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy','excel','pdf','print'
        ]
    } );
 });

    </script>
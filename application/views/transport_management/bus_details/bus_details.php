<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Vehicle Master</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
		<div style="padding: 10px; background-color: white; border-top:3px solid #5785c3;">
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
		  <a href="<?php echo base_url('Bus_master_add/add_bus'); ?>" class='btn btn-warning pull-right'>Add New Bus</a><br /><br /><br />
        </div>		
		  <table class="table table-bordered" id="example">
			<thead>
			  <tr>
				<th>Sl no.</th>
				<th>Bus no</th>
				<th>Vehicle No</th>
				<th>Total Seat</th>
				<th>Gprs Status</th>
				<th>Action</th>
			  </tr>
			</thead>
			<tbody>
			  <?php
			    if($bus_master){
					$i = 1;
					foreach($bus_master as $bus_masterd){
						
						?>
						  <tr>
						    <td><?php echo $i; ?></td>
						    <td><?php if($bus_masterd->bus_no== null){echo "N/A";}else{echo $bus_masterd->bus_no;} ?></td>
						    <td><?php echo $bus_masterd->BusNo; ?></td>
						    <td><?php echo $bus_masterd->seats; ?></td>
						    <td><?php echo ($bus_masterd->gprs_installed == "y")? "INSTALLED": 'NOT INSTALLED'; ?></td>
						    <td><a title="EDIT" href="<?php echo base_url('Bus_master_add/edit_bus/'.$bus_masterd->BusCode); ?>"><i style="color:#000; font-size:20px; cursor:pointer;"  class="fa fa-pencil-square"></i></a>&nbsp;&nbsp;<a title="VIEW DETAILS" href="<?php echo base_url('Bus_master_add/view_bus/'.$bus_masterd->BusCode); ?>"><i style="color:#000; font-size:20px; cursor:pointer;"  class="fa fa-eye"></i></a></td>
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

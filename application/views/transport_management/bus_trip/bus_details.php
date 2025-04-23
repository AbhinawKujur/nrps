<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Bus Trip Master</a> <i class="fa fa-angle-right"></i></li>
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
		  <a href="<?php echo base_url('Bus_trip_master/add_trip'); ?>" class='btn btn-warning pull-right'>Add New Trip</a><br /><br /><br />
        </div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-bordered" id="example">
					<thead>
					  <tr>
						<th>Sl no.</th>
						<th>Trip Name</th>
						<th>Action</th>
					  </tr>
					</thead>
					<tbody>
					  <?php
						if($bus_trip){
							$i = 1;
							foreach($bus_trip as $bus_masterd){
								
								?>
								  <tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $bus_masterd->Trip_Nm; ?></td>
									<td><a title="EDIT" href="<?php echo base_url('Bus_trip_master/edit_trip/'.$bus_masterd->Trip_ID); ?>"><i style="color:#000; font-size:20px; cursor:pointer;"  class="fa fa-pencil-square"></i></a></td>
								  </tr>
								<?php
								$i++;
							}
						}
					  ?>
					</tbody>
				</table>
			</div>
		</div>
		  
		</div><br /><br />
        <div class="clearfix"></div>
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

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Bus Stoppage Master</a> <i class="fa fa-angle-right"></i></li>
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
		  <a href="<?php echo base_url('Fees_master/add_buss'); ?>" class='btn btn-warning pull-right'>Add New</a><br /><br /><br />
        </div>
		<div class="row">
			<div class="col-md-12 col-sm-12" style="overflow-x:scroll;">
				<table class="table table-bordered" id="example">
					<thead>
					  <tr>
						<th>Sl no.</th>
						<th>STOPPAGE</th>
						<th>APR</th>
						<th>MAY</th>
						<th>JUN</th>
						<th>JUL</th>
						<th>AUG</th>
						<th>SEP</th>
						<th>OCT</th>
						<th>NOV</th>
						<th>DEC</th>
						<th>JAN</th>
						<th>FEB</th>
						<th>MAR</th>
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
									<td><?php echo $bus_data->STOPPAGE; ?></td>
									<td><?php echo $bus_data->APR_FEE; ?></td>
									<td><?php echo $bus_data->MAY_FEE; ?></td>
									<td><?php echo $bus_data->JUN_FEE; ?></td>
									<td><?php echo $bus_data->JUL_FEE; ?></td>
									<td><?php echo $bus_data->AUG_FEE; ?></td>
									<td><?php echo $bus_data->SEP_FEE; ?></td>
									<td><?php echo $bus_data->SEP_FEE; ?></td>
									<td><?php echo $bus_data->NOV_FEE; ?></td>
									<td><?php echo $bus_data->DEC_FEE; ?></td>
									<td><?php echo $bus_data->JAN_FEE; ?></td>
									<td><?php echo $bus_data->FEB_FEE; ?></td>
									<td><?php echo $bus_data->MAR_FEE; ?></td>
									<td><a href="<?php echo base_url('Fees_master/edit_busmaster/'.$bus_data->STOPNO); ?>"><i style="color:#000; font-size:20px; cursor:pointer;"  class="fa fa-pencil-square"></i></a></td>
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
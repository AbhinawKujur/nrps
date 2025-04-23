<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Section Master</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
		<div style="padding: 10px; background-color: white">
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
		  <a href="<?php echo base_url('Teacher_master/add_section'); ?>" class='btn btn-warning pull-right'>Add New</a><br /><br /><br />
        </div>		
		  <table class="table table-bordered" id="class_table">
			<thead>
			  <tr>
				<th>Sl no.</th>
				<th>Section Name</th>
				<th>Action</th>
			  </tr>
			</thead>
			<tbody>
			  <?php
			    if($data){
					$i = 1;
					foreach($data as $section_data){
						?>
						  <tr>
						    <td><?php echo $i; ?></td>
						    <td><?php echo $section_data->SECTION_NAME; ?></td>
						    <td><a href="<?php echo base_url('Teacher_master/edit_section/'.$section_data->section_no); ?>"><i style="color:#000; font-size:20px; cursor:pointer;"  class="fa fa-pencil-square"></i></a></td>
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
         <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script>-->
          
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
<!--inner block end here-->
<!--copy rights start here-->

<script>
$("#msg").fadeOut(6000);
$(document).ready( function () {
    $('#class_table').DataTable({
		dom: 'Bfrtip',
        buttons: [
            'copy','excel','pdf','print'
        ]
	});
} );
</script>

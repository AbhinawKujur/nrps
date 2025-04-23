<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Class Master</a> <i class="fa fa-angle-right"></i></li>
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
		  <a href="<?php echo base_url('Teacher_master/add_class'); ?>" class='btn btn-warning pull-right'>Add New</a><br /><br /><br />
        </div>		
		  <table class="table table-bordered" id="class_table">
			<thead>
			  <tr>
				<th>Sl no.</th>
				<th>Class Name</th>
				<th>Exam Mode</th>
				<th>Action</th>
			  </tr>
			</thead>
			<tbody>
			  <?php
			    if($data){
					$i = 1;
					foreach($data as $class_data){
						$exammode = $class_data->ExamMode;
						if($exammode == 1){
							$exammode = 'CBSE';
						}else{
							$exammode = 'OTHERS';
						}
						?>
						  <tr>
						    <td><?php echo $i; ?></td>
						    <td><?php echo $class_data->CLASS_NM; ?></td>
						    <td><?php echo $exammode; ?></td>
						    <td><a href="<?php echo base_url('Teacher_master/edit_class/'.$class_data->Class_No); ?>"><i style="color:#000; font-size:20px; cursor:pointer;"  class="fa fa-pencil-square"></i></a></td>
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

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Add Class</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
		<div style="padding: 10px; background-color: white">
        <div class='col-sm-12'>		
		  <a href="<?php echo base_url('Teacher_master/class_master'); ?>" class='btn btn-danger pull-right'>BACK</a><br /><br /><br />
        </div>
		  <form action="<?php echo base_url('Teacher_master/class_save'); ?>" method="post">
		  <table class="table table-bordered" id="class_table">
			<tr>
			  <td><b>Class Name</b></td>
			  <td><input type="text" name="class_name" class="form-control" autocomplete="off"></td>
			<tr>
			<tr>
			  <td><b>Exam type</b></td>
			  <td>
			    <select class="form-control" name="exam_type">
				  <option value="">Select</option>
				  <option value="1">CBSE</option>
				  <option value="2">OTHERS</option>
			    </select>
			  </td>
			</tr>
			<tr>
			  <td colspan='2' align='center'><input type="submit" name="class_save" value="SAVE" class="btn btn-success"></td>
			</tr>
		  </table>
		  </form>
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
$(document).ready( function () {
    $('#class_table').DataTable();
} );
</script>

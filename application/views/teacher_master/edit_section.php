<?php
  if($data){
	  $section_no = $data[0]->section_no;
	  $SECTION_NAME = $data[0]->SECTION_NAME;
  }
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Edit Section</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
		<div style="padding: 10px; background-color: white">
        <div class='col-sm-12'>		
		  <a href="<?php echo base_url('Fees_master/section_master'); ?>" class='btn btn-danger pull-right'>BACK</a><br /><br /><br />
        </div>
		  <form action="<?php echo base_url('Teacher_master/section_update'); ?>" method="post">
		  <table class="table table-bordered" id="class_table">
			<tr>
			  <td><b>Class Name</b></td>
			  <td><input type="text" name="section_name" class="form-control" value="<?php echo $SECTION_NAME;?>"></td>
			<tr>
			<tr>
			  <input type="hidden" name="upd_id" value="<?php echo $section_no; ?>">
			</tr>
			<tr>
			  <td colspan='2' align='center'><input type="submit" name="class_save" value="UPDATE" class="btn btn-success"></td>
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

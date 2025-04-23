<?php
  if($data){
	  $Class_No = $data[0]->Class_No;
	  $CLASS_NM = $data[0]->CLASS_NM;
	  $ExamMode = $data[0]->ExamMode;
  }
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Edit Class</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
		<div style="padding: 10px; background-color: white">
        <div class='col-sm-12'>		
		  <a href="<?php echo base_url('Fees_master/class_master'); ?>" class='btn btn-danger pull-right'>BACK</a><br /><br /><br />
        </div>
		  <form action="<?php echo base_url('Fees_master/class_update'); ?>" method="post">
		  <table class="table table-bordered" id="class_table">
			<tr>
			  <td><b>Class Name</b></td>
			  <td><input type="text" name="class_name" class="form-control" value="<?php echo $CLASS_NM;?>"></td>
			<tr>
			<tr>
			  <td><b>Exam type</b></td>
			  <td>
			    <select class="form-control" name="exam_type">
				  <option value="">Select</option>
				  <option value="1" <?php if($ExamMode == 1){ echo "selected"; }?>>CBSE</option>
				  <option value="2" <?php if($ExamMode == 2){ echo "selected"; }?>>OTHERS</option>
			    </select>
			  </td>
			  <input type="hidden" name="upd_id" value="<?php echo $Class_No; ?>">
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

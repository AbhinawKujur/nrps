<?php
  if($data){
	  $Incharge_Id = $data[0]->Incharge_Id;
	  $Incharge_nm = $data[0]->Incharge_nm;
	  $Incharge_ph_no = $data[0]->Incharge_ph_no;
  }
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Edit Incharge Details</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
		<div style="padding: 10px; background-color: white; border-top:3px solid #5785c3;">
        <div class='col-sm-12'>		
		  <a href="<?php echo base_url('Bus_incharge_entry/bus_incharge'); ?>" class='btn btn-danger pull-right'>BACK</a><br /><br /><br />
        </div>
		  <form action="<?php echo base_url('Bus_incharge_entry/incharge_update'); ?>" method="post">
		  <table class="table table-bordered" id="class_table">
			<tr>
			  <td><b>Incharge Name</b></td>
			  <td><input type="text" name="incharge_name" class="form-control" value="<?php echo $Incharge_nm; ?>" required pattern="[A-Za-z ]{3,}"></td>
			</tr>
			<tr>
			  <td><b>Incharge Phone No</b></td>
			  <td><input type="text" name="incharge_phone" oninput="checknumber(this.value)" class="form-control" value="<?php echo $Incharge_ph_no; ?>" required maxlength="10" pattern="[0-9]{10}"></td>
			</tr>
			<tr>
			  <input type="hidden" name="upd_id" value="<?php echo $Incharge_Id; ?>">
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
function checknumber(val){
	if(val ==""){
		Command: toastr["info"]("Please Enter Moblie Number!", "Warning")

		toastr.options = {
		  "closeButton": true,
		  "debug": true,
		  "newestOnTop": false,
		  "progressBar": true,
		  "positionClass": "toast-top-right",
		  "preventDuplicates": true,
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
	}else{
		$.ajax({
			url:"<?php echo base_url('Bus_incharge_entry/checkdata'); ?>",
			method:"POST",
			data: {val:val},
			success:function(data){
				if(data == 1){
					Command: toastr["error"]("This Mobile No Is Already Exist!", "Warning")

					toastr.options = {
					  "closeButton": true,
					  "debug": true,
					  "newestOnTop": false,
					  "progressBar": true,
					  "positionClass": "toast-top-right",
					  "preventDuplicates": true,
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
}
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

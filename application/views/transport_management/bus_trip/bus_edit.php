<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Edit Bus Trip Master</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
<div style="padding: 10px; background-color: white">
    <div class='col-sm-12'>		
		<a href="<?php echo base_url('Bus_trip_master/index'); ?>" class='btn btn-danger pull-right'>BACK</a><br /><br /><br />
    </div>
	<form action="<?php echo base_url('Bus_trip_master/trip_update'); ?>" method="post">
		<table class="table table-bordered" id="class_table">
			<tr>
			  <td><b>Trip Name</b></td>
			  <td><input type="text" ID="TN" oninput="checkdata(this.value)" pattern="[A-Za-z]{2,}" name="tn" required name="stop_name" class="form-control" value="<?php  echo $bus_master[0]->Trip_Nm; ?>"></td>
			</tr>
			<tr>
			  <input type="hidden" name="id" value="<?php echo $bus_master[0]->Trip_ID; ?>">
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
function checkdata(val){
	if(val == ""){
		Command: toastr["info"]("Please Enter Trip Name", "Warning")

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
			url: "<?php echo base_url('Bus_trip_master/checkdata'); ?>",
			method: "POST",
			data: {val:val},
			success:function(data){
				if(data==1){
					$('#TN').val("");
					Command: toastr["info"]("Please Enter Another Trip Name This Name Is Already Exist.", "Warning")

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
			}
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

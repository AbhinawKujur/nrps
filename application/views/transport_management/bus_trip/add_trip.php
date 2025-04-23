<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Bus Trip Master</a> <i class="fa fa-angle-right"></i> Add Trip</li>
</ol>
<!--four-grids here-->
	<div style="padding: 10px; background-color: white; border-top:3px solid #5785c3;">
        <div class='col-sm-12'>		
		  <a href="<?php echo base_url('Bus_trip_master/index'); ?>" class='btn btn-danger pull-right'>BACK</a><br /><br /><br />
        </div>
		<form action="<?php echo base_url('Bus_trip_master/save_trip'); ?>" method="post">
		  <table class="table table-bordered" id="class_table">
			<tr>
			  <td><b>Trip Name</b></td>
			  <td><input type="text" oninput="checkdata(this.value)" id="tripname" pattern="[a-zA-Z- 0-9]{2,}" required name="trip_name" class="form-control" autocomplete="off"></td>
			</tr>
			<tr>
			  <td colspan='2' align='center'><input type="submit" name="class_save" value="SAVE" class="btn btn-success"></td>
			</tr>
		  </table>
		</form>
	</div><br /><br />
<div class="clearfix"></div>
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->

<script>
function checkdata(val){
	if(val ==""){
		Command: toastr["info"]("Please Enter Trip Name !", "Warning !")
		toastr.options = {
		  "closeButton": true,
		  "debug": true,
		  "newestOnTop": false,
		  "progressBar": true,
		  "positionClass": "toast-top-right",
		  "preventDuplicates": true,
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
			url: "<?php echo base_url('Bus_trip_master/checktrip'); ?>",
			method: "POST",
			data: {val:val},
			success:function(data){
				if(data > 0){
					$('#tripname').val("");
					Command: toastr["info"]("This Name Already Exist Please Enter Another Name!", "Warning !")
					toastr.options = {
					  "closeButton": true,
					  "debug": true,
					  "newestOnTop": false,
					  "progressBar": true,
					  "positionClass": "toast-top-right",
					  "preventDuplicates": true,
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

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Add Ward</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
		<div style="padding: 10px; background-color: white">
        <div class='col-sm-12'>		
		  <a href="<?php echo base_url('Fees_master/ward_master'); ?>" class='btn btn-danger pull-right'>BACK</a><br /><br /><br />
        </div>
		  <form action="<?php echo base_url('Fees_master/ward_save'); ?>" method="post" onsubmit="return validation()">
		  <table class="table table-bordered" id="class_table">
			<tr>
			  <td><b>Ward Name</b></td>
			  <td><input type="text" id="add_ward" name="ward_name" class="form-control" autocomplete="off"></td>
			<tr>
			<tr>
			  <td colspan='2' align='center'><input type="submit" name="ward_save" value="SAVE" class="btn btn-success"></td>
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
function validation()
{
	var add_ward=document.getElementById('add_ward').value;
	var valadd=/^[a-zA-Z]{1,}$/;
	if(valadd.test(add_ward))
	{
		return true;
	}
	else
	{
		alert('Please Fill Ward Name And Should Not Contain Numeric Value');
		return false;
	}
}
</script>

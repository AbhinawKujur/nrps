<?php
if($data){
	$RNo=$data[0]->RNo;
	$Rname=$data[0]->Rname;
}
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Edit Religion</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
		<div style="padding: 10px; background-color: white">
        <div class='col-sm-12'>		
		  <a href="<?php echo base_url('Fees_master/religion_master'); ?>" class='btn btn-danger pull-right'>BACK</a><br /><br /><br />
        </div>
		  <form action="<?php echo base_url('Fees_master/religion_update'); ?>" method="post" onsubmit="return validation()">
		  <table class="table table-bordered" id="class_table">
			<tr>
			  <td><b>Religion Name</b></td>
			  <td><input type="text" id="Religion" name="Religion" class="form-control" value="<?php echo $Rname;?>"></td>
			<tr>
			<tr>
			  <input type="hidden" name="upd_id" value="<?php echo $RNo; ?>">
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
function validation()
{
	var wardname=document.getElementById('Religion').value;
	if(wardname=='')
	{
		alert('Field Should Not Empty');
		return false;
	}
	else
	{
		return true;
	}
}
</script>

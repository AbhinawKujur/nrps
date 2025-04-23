<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Add Bus Stoppage Master</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
		<div style="padding: 10px; background-color: white; border-top:3px solid #5785c3;">
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
		  <a href="<?php echo base_url('Fees_master/Bus_Stoppage_Master'); ?>" class='btn btn-danger pull-right'>BACK</a><br /><br /><br />
        </div>
		  <form action="<?php echo base_url('Fees_master/add_Stoppage_Master'); ?>" method="post" onsubmit="return validation()">
		  <table class="table table-bordered" id="class_table">
			<tr>
			  <td><b>Stoppage Name</b></td>
			  <td>
				<input list="browsers" name="browser" required class="form-control">
				  <datalist id="browsers">
					<?php
						foreach($stopage_name as $stopage_name_data){
							?>
							<option value="<?php echo $stopage_name_data->STOPPAGE; ?>">
							<?php
						}
					?>
				  </datalist>
			  </td>
			</tr>
			<tr>
			  <td><b>Apr</b></td>
			  <td><input type="number" name="apr" value="0" required min="0" class="form-control"></td>
			</tr>
			<tr>
			  <td><b>May</b></td>
			  <td><input type="number" name="may" value="0" required min="0" class="form-control"></td>
			</tr>
			<tr>
			  <td><b>Jun</b></td>
			  <td><input type="number" name="jun" value="0" required min="0" class="form-control"></td>
			</tr>
			<tr>
			  <td><b>Jul</b></td>
			  <td><input type="number" name="jul" value="0" required min="0" class="form-control"></td>
			</tr>
			<tr>
			  <td><b>Aug</b></td>
			  <td><input type="number" name="aug" value="0" required min="0" class="form-control"></td>
			</tr>
			<tr>
			  <td><b>Sep</b></td>
			  <td><input type="number" name="sep" value="0" required min="0" class="form-control"></td>
			</tr>
			<tr>
			  <td><b>Oct</b></td>
			  <td><input type="number" name="oct" value="0" required min="0" class="form-control"></td>
			</tr>
			<tr>
			  <td><b>Nov</b></td>
			  <td><input type="number" name="nov" value="0" required min="0" class="form-control"></td>
			</tr>
			<tr>
			  <td><b>Dec</b></td>
			  <td><input type="number" name="dec" value="0" required min="0" class="form-control"></td>
			</tr>
			<tr>
			  <td><b>Jan</b></td>
			  <td><input type="number" name="jan" value="0" required min="0" class="form-control"></td>
			</tr>
			<tr>
			  <td><b>Feb</b></td>
			  <td><input type="number" name="feb" value="0" required min="0" class="form-control"></td>
			</tr>
			<tr>
			  <td><b>Mar</b></td>
			  <td><input type="number" name="mar" value="0" required min="0" class="form-control"></td>
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
$("#msg").fadeOut(6000);
$(document).ready( function (){
    $('#class_table').DataTable();
} );
function validation()
{
	var name=document.getElementById('classname').value;
	var type=document.getElementById('exam_type').selectedIndex;

	var valname=/^[a-zA-Z]{1,}$/;
	if(valname.test(name))
	{
		return true;
	}
	else
	{
		alert('Please Fill Class And Not Contain Numeric value');
		return false;
	}
	if (type!="")
	{
		return true;
	}
	else
	{
		alert('Please select Type');
		return false;
	}
}
</script>

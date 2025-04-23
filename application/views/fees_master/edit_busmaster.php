<?php
 if($data){
	$STOPNO = $data[0]->STOPNO; 
	$STOPPAGE = $data[0]->STOPPAGE;
 }
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Edit Bus Master</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
		<div style="padding: 10px; background-color: white; border-top:3px solid #5785c3;">
        <div class='col-sm-12'>		
		  <a href="<?php echo base_url('Fees_master/Bus_Stoppage_Master'); ?>" class='btn btn-danger pull-right'>BACK</a><br /><br /><br />
        </div>
		  <form action="<?php echo base_url('Fees_master/busmaster_update'); ?>" method="post">
		  <table class="table table-bordered" id="class_table">
			<tr>
			  <td><b>Stoppage Name</b></td>
			  <td><input type="text" required name="stop_name" class="form-control" value="<?php echo $STOPPAGE; ?>"></td>
			</tr>
			<tr>
			  <td><b>Apr</b></td>
			  <td><input type="number" min='0' <?php if($STOPNO == 1){echo "readonly";} ?> required name="Apr" class="form-control" value="<?php echo $data[0]->APR_FEE; ?>"></td>
			</tr>
			<tr>
			  <td><b>May</b></td>
			  <td><input type="number" <?php if($STOPNO == 1){echo "readonly";} ?> min='0' required name="May" class="form-control" value="<?php echo $data[0]->MAY_FEE; ?>"></td>
			</tr>
			<tr>
			  <td><b>Jun</b></td>
			  <td><input type="number" <?php if($STOPNO == 1){echo "readonly";} ?> min='0' required name="Jun" class="form-control" value="<?php echo  $data[0]->JUN_FEE; ?>"></td>
			</tr>
			<tr>
			  <td><b>Jul</b></td>
			  <td><input type="number" <?php if($STOPNO == 1){echo "readonly";} ?> min='0' required name="Jul" class="form-control" value="<?php echo  $data[0]->JUL_FEE; ?>"></td>
			</tr>
			<tr>
			  <td><b>Aug</b></td>
			  <td><input type="number" <?php if($STOPNO == 1){echo "readonly";} ?> min='0' required name="Aug" class="form-control" value="<?php echo  $data[0]->AUG_FEE; ?>"></td>
			</tr>
			<tr>
			  <td><b>Sep</b></td>
			  <td><input type="number" <?php if($STOPNO == 1){echo "readonly";} ?> min='0' required name="Sep" class="form-control" value="<?php echo  $data[0]->SEP_FEE; ?>"></td>
			</tr>
			<tr>
			  <td><b>Oct</b></td>
			  <td><input type="number" <?php if($STOPNO == 1){echo "readonly";} ?> min='0' required name="Oct" class="form-control" value="<?php echo  $data[0]->OCT_FEE; ?>"></td>
			</tr>
			<tr>
			  <td><b>Nov</b></td>
			  <td><input type="number" <?php if($STOPNO == 1){echo "readonly";} ?> min='0' required name="Nov" class="form-control" value="<?php echo  $data[0]->NOV_FEE; ?>"></td>
			</tr>
			<tr>
			  <td><b>Dec</b></td>
			  <td><input type="number" <?php if($STOPNO == 1){echo "readonly";} ?> min='0' required name="Dec" class="form-control" value="<?php echo  $data[0]->DEC_FEE; ?>"></td>
			</tr>
			<tr>
			  <td><b>Jan</b></td>
			  <td><input type="number" <?php if($STOPNO == 1){echo "readonly";} ?> min='0' required name="Jan" class="form-control" value="<?php echo  $data[0]->JAN_FEE; ?>"></td>
			</tr>
			<tr>
			  <td><b>Feb</b></td>
			  <td><input type="number" <?php if($STOPNO == 1){echo "readonly";} ?> min='0' required name="Feb" class="form-control" value="<?php echo  $data[0]->FEB_FEE; ?>"></td>
			</tr>
			<tr>
			  <td><b>Mar</b></td>
			  <td><input type="number" <?php if($STOPNO == 1){echo "readonly";} ?> min='0' required name="Mar" class="form-control" value="<?php echo  $data[0]->MAR_FEE; ?>"></td>
			</tr>
			<tr>
			  <input type="hidden" name="id" value="<?php echo $STOPNO; ?>">
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

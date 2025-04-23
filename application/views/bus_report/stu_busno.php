<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  margin: 0px auto;
  z-index:999;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Student List (Bus no wise)</a> <i class="fa fa-angle-right"></i></li>
</ol>
<div class="loader" style="display:none;"></div>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">

		<div class="row">
			<div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group">
				<label>Select Bus No</label>
				<select class="form-control" required name="class_name"  id='b_no'>
					<option value="">--Select--</option>
					<?php foreach($BUS_NO as $key){
					?>
					<option value="<?php echo $key->BUS_NO; ?>"><?php echo $key->BUS_NO; ?></option>
					
					<?php
}?>
					
			
				</select>
			</div>
		
			<div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group">
				<center><br>
					<button type="submit"  onclick="display_stu()" class="btn btn-success">DISPLAY</button>
				</center>
			</div>
		</div>
		
	
	<br />
<div id="load_data" style="overflow:auto;"></div>
</div><br />
<script>
	function display_stu(){
	var b_no=$('#b_no').val();
		if(b_no!=""){
	$.post("<?php echo base_url('Bus_report/stu_data_bus');?>",{b_no:b_no},function(data){
	$('#load_data').html(data);
	
	})
		}else{
		alert('Please Select Bus No!');
		}
	}
</script>
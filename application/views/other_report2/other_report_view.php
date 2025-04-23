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
    <li class="breadcrumb-item"><a href="index.html">Award List</a> <i class="fa fa-angle-right"></i></li>
</ol>
<div class="loader" style="display:none;"></div>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
	<form id="form" method="post">
		<div class="row">
			<div class="col-md-3 col-sm-3 col-lg-3 col-xl-3 form-group">
				<label>Selectn Class:</label>
				<select class="form-control" required name="class_name" id="class_name">
					<option value="">Select Class</option>
					<?php
						if($class){
							foreach($class as $class_data){
								?>
									<option value="<?php echo $class_data->Class_No; ?>"><?php echo $class_data->CLASS_NM; ?></option>
								<?php
							}
						}
					?>
				</select>
			</div>
			<div class="col-md-3 col-sm-3 col-lg-3 col-xl-3 form-group">
				<label>Select Sec:</label>
				<select class="form-control" required name="sec_name" id="sec_name">
					<option value="">Select Section</option>
					<?php
						if($sec){
							foreach($sec as $sec_data){
								?>
								<option value="<?php echo $sec_data->section_no; ?>"><?php echo $sec_data->SECTION_NAME; ?></option>
								<?php
							}
						}
					?>
				</select>
			</div>
			<div class="col-md-3 col-sm-3 col-lg-3 col-xl-3 form-group">
				<label>Short By:</label>
				<select class="form-control" required name="short_by" id="short_by">
					<option value="">Select Option</option>
					<option value="ADM_NO">Admission No</option>
					<option value="FIRST_NM">Name</option>
					<option value="ROLL_NO">Roll No</option>
				</select>
			</div>
			<div class="col-md-3 col-sm-3 col-lg-3 col-xl-3 form-group">
				<br/>
				<label>
    				<input type="radio" name="mobile" id="mobile" value="with_mobile"> With Mobile No.
  				</label>
  				<label>
    				<input type="radio" name="mobile" id="mobile" value="without_mobile"> Without Mobile No.
  				</label>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
				<center>
					<button type="submit" class="btn btn-success">DISPLAY</button>
					<p class="btn btn-success" onclick="download()" id="download" style="display:none;"><i class="fa fa-file-pdf-o"></i> Download</p>
				</center>
			</div>
		</div>
	</form>
	<br />
	<div id="load_data" style="overflow:auto;"></div>
</div><br />
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" />
<script>
	$("#form").on("submit", function (event) {
	event.preventDefault();
		$.ajax({
			url: "<?php echo base_url('Other_report/find_details'); ?>",
			type: "POST",
			data: $('#form').serialize(),
			beforeSend:function(){
				$('.loader').show();
				$('body').css('opacity', '0.5');
			},
			success: function(data){
				$('.loader').hide();
				$('body').css('opacity', '1.0');
				$("#load_data").html(data);
				$('#download').show(1000);
				
			},
		});
	});
	function download(){
		var class_name = $('#class_name').val();
		var sec_name = $('#sec_name').val();
		var short_by = $('#short_by').val();
		var mobile = $('input[name="mobile"]:checked').val();
		window.location="<?php echo base_url('Other_report/pdf'); ?>"+'/'+class_name+'/'+sec_name+'/'+short_by+'/'+mobile+'/';
	}
</script>
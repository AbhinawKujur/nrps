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
    <li class="breadcrumb-item"><a href="index.html">Scholarship Owned By</a> <i class="fa fa-angle-right"></i></li>
</ol>
<div class="loader" style="display:none;"></div>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
	<form id="form" method="post">
		<div class="row">
			<div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group">
				<label>Select Class</label>
				<select class="form-control" required name="class_name">
					<option value="">Select Class</option>
					<option value="All">All Class</option>
					<?php
						if($class){
							foreach($class as $class_data){
								?>
									<option value="<?php echo $class_data->CLASS_NM; ?>"><?php echo $class_data->CLASS_NM; ?></option>
								<?php
							}
						}
					?>
				</select>
			</div>
			<div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group">
				<label>Owned By</label>
				<select class="form-control" required name="Owned" id="sec">
					<option value="">Select</option>
					<Option value="%">All</Option>
					<option value="Land Doner">Land Doner</option>
					<option value="Management">Management</option>
					<option value="4thGrade">4th Grade Employee</option>
					<option value="hostel">Hostel</option>
					<option value="Merit">Merittorious Scholarship</option>
					<option value="Others">Others</option>
				</select>
			</div>
			<div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group">
				<label>Sort By</label>
				<select class="form-control" required name="short_by">
					<option value="">Select Option</option>
					<option value="APP_NO+0">Application No.</option>
					<option value="ADM_NO+0">Admission No</option>
					<option value="STU_NAME">Name</option>
					<option value="ROLL_NO+0">Roll No</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
				<center>
					<button type="submit" class="btn btn-success">DISPLAY</button>
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
			url: "<?php echo base_url('Scholarshipownedby/find_detailsstudentinformation'); ?>",
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
			},
		});
	});
</script>
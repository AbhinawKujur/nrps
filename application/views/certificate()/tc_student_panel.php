<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Transfer Certificate</a> <i class="fa fa-angle-right"></i></li>
</ol>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
	<form id="form">
		<div class="row">
			<div class="col-md-4 col-sm-4 col-lg-4 form-group">
				<label>Admission No.</label>
				<input type="text" class="form-control" id="adm_no" name="adm_no" autocomplete="off" required>
			</div>             
			<div class="col-md-4 col-sm-4 col-lg-4 form-group">
				<label>Transfer Certificate No.</label>
				<input type="text" value="<?php echo $tc_number; ?>" class="form-control" id="tcn" name="tcn" readonly>
			</div>             
			<div class="col-md-4 col-sm-4 col-lg-4">
			<br />
				<button class='btn btn-success btn-sm'>SUBMIT</button>
			</div>
		</div>
	</form>
	<div id="load_data"></div>
</div><br />
<script>
	$("#form").on("submit", function (event) {
    event.preventDefault();
    $.ajax({
		url: "<?php echo base_url('Certificate/details_show'); ?>",
		type: "POST",
		data: $("#form").serialize(),
		success: function(data){
			var user = JSON.parse(data);
			var data_cnt = user[0];
			if(data_cnt == 1){
				var tc_issue = user[2];
				if(tc_issue == 1)
				{
					alert("Tc Already Issue");
					return false;
				}
				else
				{
					var defaulter = user[1];
				if(defaulter > 0){
					if( confirm("Student Comes Under Defaulter List")){
							$.ajax({
							url: "<?php echo base_url('Certificate/student_details'); ?>",
							type: "POST",
							data: $("#form").serialize(),
							success:function(data){
							$("#load_data").html(data);
						},
					});
					}
					else{
						
					}
				}
				else{
					$.ajax({
					url: "<?php echo base_url('Certificate/student_details'); ?>",
					type: "POST",
					data: $("#form").serialize(),
					success:function(data){
						$("#load_data").html(data);
					},
				});
				}
				}
				
			}else{
				alert ("Sorry No Data Found");
				return false;
			}
		},
		error : function(handel){
			alert("data No Found");
		},
	});
 });
</script>
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="index.html">Update Payment Mode</a> <i class="fa fa-angle-right"></i></li>
</ol>
<style>
	.modal-header,
	.modal-footer {
		background-image: linear-gradient(141deg, #9fb8ad 0%, #1fc8db 51%, #2cb5e8 75%);
	}
</style>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
	<div class='row'>
		<div class='col-lg-6 col-md-6 col-sm-10 col-xl-6'>
			<label>Reciept No.</label>
			<input type='text' class='form-control' id='rect' name='rect'>

		</div>
		<div class='col-md-4 col-lg-4 col-sm-4'>
			<br>
			<button class='btn btn-success btn-md' onclick="get_rectdetails()">Get Details</button>
		</div>
		<div class="col-md-4 col-md-4 col-md-4">
		</div>
	</div><br />
	<div id='load_data'></div>
</div><br />

<div id="myModal" class="modal fade" data-backdrop='static' data-keyword='false' role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">ENTER PASSWORD</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class='col-md-8 col-sm-8 col-lg-8'>
						<input type='password' class='form-control' name='pass' id='pass' placeholder='Enter Password'>
					</div>
					<div class="col-md-2 col-sm-2 col-lg-2">
						<button class='btn btn-success btn-sm' onclick='passwordvalidate()'>Click</button>
					</div>
					<div class="col-md-2 col-sm-2 col-lg-2">
						<a class="btn btn-danger btn-sm" href="<?php echo base_url('payroll/dashboard/emp_dashboard'); ?>">BACK</a>
					</div>
				</div>
			</div>
			<div class="modal-footer">
			</div>
		</div>

	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script>
	$(window).load(function() {
		$("#myModal").modal('show');
	});

	function passwordvalidate() {
		var pass = $('#pass').val();
		$.ajax({
			type: 'POST',
			data: {
				pass: pass
			},
			url: "<?php echo base_url('Fees_collection/match_password'); ?>",
			success: function(data) {
				if (data == 1) {
					$("#myModal").modal('hide');
				} else {
					alert("Password Is Incorrect");
					$('#pass').val('');
				}
			},
		});
	}

	$("#rect").select2();

	function get_rectdetails() {
		var recpt_no = $('#rect').val();
		$.ajax({
			type: "POST",
			data: {
				rect_no: recpt_no
			},
			url: "<?php echo base_url('Fees_collection/show_rect_details'); ?>",
			success: function(data) {
				$("#load_data").html(data);
			},
			error: function(data) {
				alert("Sorry No Data Found");
			},

		});
	}
</script>
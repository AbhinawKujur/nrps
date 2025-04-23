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
    <li class="breadcrumb-item"><a href="index.html">Fee Paid Ledger</a> <i class="fa fa-angle-right"></i></li>
</ol>
<div class="loader" style="display:none;"></div>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
	<form id="form" method="post">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 form-group">
				<label>Enter Admission Number</label>
				<input list="browsers" name="browser" required class="form-control">
				  <datalist id="browsers">
						<?php
							foreach($stu_adm as $key => $value){
								?>
								<option value="<?php echo $value->ADM_NO; ?>">
								<?php
							}
						?>
				  </datalist>
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
<script>
	$("#form").on("submit", function (event) {
	event.preventDefault();
		$.ajax({
			url: "<?php echo base_url('Feepaid_ledger/checkdata'); ?>",
			type: "POST",
			data: $('#form').serialize(),
			beforeSend:function(){
				$('.loader').show();
				$('body').css('opacity', '0.5');
			},
			success: function(data){
				$('.loader').hide();
				$('body').css('opacity', '1.0');
				if(data == 1){
					$.ajax({
						url: "<?php echo base_url('Feepaid_ledger/find_details'); ?>",
						type: "POST",
						data: $('#form').serialize(),
						beforeSend:function(){
							$('.loader').show();
							$('body').css('opacity', '0.5');
						},
						success: function(data){
							$('.loader').hide();
							$('body').css('opacity', '1.0');
							$("#load_data").show(1000);
							$("#load_data").html(data);
						},
					});
				}
				else{
					Command: toastr["error"]("No Student Details Found", "Sorry")
					toastr.options = {
					  "closeButton": false,
					  "debug": false,
					  "newestOnTop": false,
					  "progressBar": true,
					  "positionClass": "toast-top-right",
					  "preventDuplicates": false,
					  "onclick": null,
					  "showDuration": "300",
					  "hideDuration": "1000",
					  "timeOut": "5000",
					  "extendedTimeOut": "1000",
					  "showEasing": "swing",
					  "hideEasing": "linear",
					  "showMethod": "fadeIn",
					  "hideMethod": "fadeOut"
					}
					$("#load_data").hide(1000);
				}
			},
		});
		//---------//
		
	});
</script>
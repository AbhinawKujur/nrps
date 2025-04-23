<style>
	label span{
		color:red;
		font-weight:bold;
	}
	fieldset.scheduler-border {
		border: 1px groove #ddd !important;
		padding: 0 1.4em 1.4em 1.4em !important;
		margin: 0 0 1.5em 0 !important;
		-webkit-box-shadow:  0px 0px 0px 0px #000;
				box-shadow:  0px 0px 0px 0px #000;
	}

	legend.scheduler-border {
		font-size: 1.2em !important;
		font-weight: bold !important;
		text-align: left !important;
		width:inherit; /* Or auto */
		padding:0 10px; /* To give a bit of padding on the left and right */
		border-bottom:none;
	}
	.main{
		background:#eee;
		padding:10px;
	}
	body{
		font-family: Verdana,Geneva,sans-serif !important; 
	}
	input,select,textarea{
		text-transform: uppercase
	}
	.form-control:focus{
		border:1px solid red;
	}
	.buttonload {
	  background-color: #4CAF50; /* Green background */
	  border: none; /* Remove borders */
	  color: white; /* White text */
	  padding: 12px 24px; /* Some padding */
	  font-size: 16px; /* Set a font-size */
	}
	
	.switch {
	  position: relative;
	  display: inline-block;
	  width: 60px;
	  height: 34px;
	}

	.switch input { 
	  opacity: 0;
	  width: 0;
	  height: 0;
	}

	.slider {
	  position: absolute;
	  cursor: pointer;
	  top: 0;
	  left: 0;
	  right: 0;
	  bottom: 0;
	  background-color: #ccc;
	  -webkit-transition: .4s;
	  transition: .4s;
	}

	.slider:before {
	  position: absolute;
	  content: "";
	  height: 26px;
	  width: 26px;
	  left: 4px;
	  bottom: 4px;
	  background-color: white;
	  -webkit-transition: .4s;
	  transition: .4s;
	}

	input:checked + .slider {
	  background-color: #2196F3;
	}

	input:focus + .slider {
	  box-shadow: 0 0 1px #2196F3;
	}

	input:checked + .slider:before {
	  -webkit-transform: translateX(26px);
	  -ms-transform: translateX(26px);
	  transform: translateX(26px);
	}

	/* Rounded sliders */
	.slider.round {
	  border-radius: 34px;
	}

	.slider.round:before {
	  border-radius: 50%;
	}
</style>

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Verify Marks</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Verify Marks</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

   
    <section class="content">
      <div class="card">
        <div class="card-body">	
		<div style='color:red'><b>Max Marks: <?php echo $maxmarks[0]['maxmarks']; ?></b></div>
			<table class='table' id='example1'>
				<thead>
					<tr>
						<th><center>Registration No.</center></th>
						<th><center>Student Name</center></th>
						<th><center>Father's Name</center></th>
						<th><center>Marks</center></th>
						<th><center>Verify</center></th>
					</tr>
				</thead>
				<tbody id='load'>
				<?php
					foreach($stuData as $key => $val){
						$marks =  !empty($val['marks'])?$val['marks']:''
				?>
					<tr>
						<td><center><?php echo $val['id']."/2020"; ?></center></td>
						<td><center><?php echo $val['stu_nm']; ?></center></td>
						<td><center><?php echo $val['f_name']; ?><center></td>
						<td><center><?php echo $marks; ?></center></td>
						<td>
							<center>
								<label class="switch">
								  <input type="checkbox" name='marksVarified' id='marksVarified' <?php if($val['marks_status'] == 1){echo "checked"; } ?> onchange="verify(<?php echo $val['id']?>)">
								  <span class="slider round"></span>
								</label>
							</center>
						</td>
					</tr>
				<?php } ?>	
				</tbody>
			</table>
        </div>
      </div>
	  <!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<h4 class="modal-title">Authenticate</h4>
				<a href='<?php echo base_url('adm_three/Admin/dashboard'); ?>'><b>&times;</b></a>
			  </div>
			  <div class="modal-body">
				<div class='row'>
					<div class='col-sm-9'><i class="fas fa-mobile"></i> <?php echo $mob; ?><input type='hidden' id='mobileFull' value='<?php echo $mobileFull; ?>'></div>
					<div class='col-sm-3' style='text-align:right'><button class='btn btn-info btn-xs' onclick='sendOpt()' id='otp_sent_btn'> Send OTP</button></div>
				</div>
			  </div>
			  <div class="modal-footer">
			  </div>
			</div>

		  </div>
		</div>
		
		<div id="myModal1" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<h4 class="modal-title">Authenticate</h4>
			  </div>
			  <div class="modal-body">
				<div class='row'>
					<div class='col-sm-6'><input type='text' id='otp' class='form-control' placeholder='ENTER OTP'></div>
					<div class='col-sm-6' style='text-align:right'><button class='btn btn-info btn-xs' onclick='chk_otp()'>Submit</button></div>
				</div>
			  </div>
			  <div class="modal-footer">
			  </div>
			</div>

		  </div>
		</div>
	  <!-- modal -->	
    </section>
  </div>
  
<script type="text/javascript">
	$("#verifyMarks").addClass('active');
	
	$(document).ready(function() {
		$('#example1').DataTable( {
			'paging':false
		} );
		$('#myModal').modal({backdrop: 'static', keyboard: false});
		$("#example1").attr('style',  'opacity:0.04');	
	} );
	
	function sendOpt(){
		$("#otp_sent_btn").prop('disabled',true);
		var mob =  Number($("#mobileFull").val());
		$.ajax({
			url: "<?php echo base_url('adm_three/MarksEntry/sentOtp'); ?>",
			type: "POST",
			data: {mob:mob},
			success: function(ret){
				$('#myModal').modal('hide');
				$('#myModal1').modal({backdrop: 'static', keyboard: false});
			}
		});
	}
	
	function chk_otp(){
		var otp = Number($("#otp").val());
		$.ajax({
			url: "<?php echo base_url('adm_three/MarksEntry/chkOtpsession'); ?>",
			type: "POST",
			data: {otp:otp},
			success: function(ret){
				if(ret == 1){
					$('#myModal1').modal('hide');
					$("#example1").attr('style',  'opacity:1');
				}else{
					$.toast({
						heading: 'Error',
						text: 'Enter Correct OTP',
						showHideTransition: 'slide',
						icon: 'error',
						position: 'top-right',
					});
				}
			}
		});
	}
	
	function verify(stu_reg_id){
		var chkbox = $("#marksVarified").prop('checked') ? 1: 0;
		$.ajax({
			url: "<?php echo base_url('adm_three/MarksEntry/saveVerified'); ?>",
			type: "POST",
			data:{stu_reg_id:stu_reg_id,chkbox:chkbox},
			success: function(ret){
				$.toast({
						heading: 'Success',
						text: 'Update Marks Successfully',
						showHideTransition: 'slide',
						icon: 'success',
						position: 'top-right',
					});
			}
		})
	}
</script>
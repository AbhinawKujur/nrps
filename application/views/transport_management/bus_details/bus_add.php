<style type="text/css">
   .error{
    color: red;
   }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('payroll/master/pfesi'); ?>">Add Vehicle</a> <i class="fa fa-angle-right"></i> Add Bus Details</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div style="background-color: white;padding: 20px;border-top: 3px solid #5785c3;">
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
		  <a href="<?php echo base_url('Bus_master_add/bus_details'); ?>" class='btn btn-warning pull-right'>Back</a><br /><br /><br />
        </div>
   <div class="row">
    <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <form role="form" action="<?php echo base_url('Bus_master_add/save_busdetails'); ?>" method="post" id="myform">
            <div class="box box-primary">
              <!-- /.box-header -->
              <div class="box-body">
                <?php if($this->session->flashdata('msg')){ 
                  echo $this->session->flashdata('msg');
                 } ?>
				 <div class="row">
					<div class="col-sm-12">
						<span class="span">General Details</span>
					</div>
				</div><br>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Vehicle No:</label><span class="span">*</span>
                        <input type="text" name="vn" onblur="checkbunno(this.value)" id="vn" class="form-control" required>
                      </div>
                    </div>    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>No of Seats:</label><span class="span">*</span>
                        <input type="number" min="1" name="seats" class="form-control" autocomplete="off" required>
                        <span class="validation_error"><?php echo form_error('employee_pf_rate'); ?></span>
                      </div>
                    </div>      
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Regn No:</label><span class="span">*</span>
                        <input type="text" name="Regn" class="form-control"  autocomplete="off" required>
                      </div>
                    </div>  
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Chasis No:</label><span class="span">*</span>
                        <input type="text" name="Chasis" class="form-control"  autocomplete="off" required>
                      </div>
                    </div>    
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Engine No:</label><span class="span">*</span>
						<input type="text" name="engineno" class="form-control" autocomplete="off" required>
                      </div>
                    </div>      
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Tax Paid Date:</label><span class="span">*</span>
                        <input type="date" name="tpd" id="datepicker" class="form-control esi_limit"  autocomplete="off" required>
                      </div>
                    </div>          
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Tax Paid Expiry Date:</label><span class="span">*</span>
                        <input type="date" name="tped" class="form-control" autocomplete="off" required>
                      </div>
                    </div>    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Fitness Date:</label><span class="span">*</span>
                        <input type="date" name="fd" class="form-control esi_emp_rate" autocomplete="off" required>
                      </div>
                    </div>   
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Fitness Renwal Date:</label><span class="span">*</span>
                        <input type="date" name="frd" class="form-control" autocomplete="off" required>
                      </div>
                    </div>   
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Gprs Installed:</label><span class="span">*</span>
                        <select class="form-control" name="gid" required>
							<option value="">Select..</option>
							<option value="y">Y</option>
							<option value="n">N</option>
						</select>
                      </div>
                    </div>     
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Pollution Control Date:</label><span class="span">*</span>
                        <input type="date" name="pcd" class="form-control" autocomplete="off" required>
                      </div>
                    </div>  
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Pollution Control Expiry Date:</label><span class="span">*</span>
                        <input type="date" name="pced" class="form-control" autocomplete="off" required>
                      </div>
                    </div>  
                  </div>
				  <div class="row">
					<div class="col-sm-3">
                      <div class="form-group">
                        <label>Bus No:</label><span class="span">*</span>
                        <input type="number" min="1" name="bn" id="bn" onblur="checkdata(this.value)" class="form-control" autocomplete="off" required>
                      </div>
                    </div>
					<div class="col-sm-3">
                      <div class="form-group">
						<label>Cctv:</label><span class="span">*</span>
                        <select class="form-control" name="cctv" required>
							<option value="">select</option>
							<option value="Y">Yes</option>
							<option value="N">No</option>
						</select>
                      </div>
                    </div>
				  </div>
				<div class="row">
					<div class="col-sm-12">
						<span class="span">Insurance Details:</span>
					</div>
				</div><br>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Name of Insurance Company:</label>
                        <input type="text" name="noic" class="form-control" autocomplete="off" >
                      </div>
                    </div>    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Insurance Policy Number:</label>
                        <input type="text" name="ipn" class="form-control" autocomplete="off" >
                      </div>
                    </div> 
                  </div>
				  <div class="row">
					<div class="col-sm-12">
                      <div class="form-group">
                        <label>Insurance Company Address:</label>
                        <textarea rows="4" name="ica" cols="50" class="form-control"></textarea>
                      </div>
                    </div> 
				  </div>
				  <div class="row">
					<div class="col-sm-4">
                      <div class="form-group">
                        <label>Insurance Amount:</label>
                        <input type="text" name="ia" value="0" class="form-control">
                      </div>
                    </div>
					<div class="col-sm-4">
                      <div class="form-group">
                        <label>Insurance Renwal Date:</label>
                        <input type="date" name="ird" class="form-control">
                      </div>
                    </div>
					<div class="col-sm-4">
                      <div class="form-group">
                        <label>Insurance Expiry Date:</label>
                        <input type="date" name="ied" class="form-control">
                      </div>
                    </div>
				  </div>
              </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right">Save</button>
            </div>
            </div>
          </form>
          <!-- /.box -->
        </section>
      </div>
    </div>
  </div>
</div><br><br>
<script>
	function checkbunno(val){
		if(val == ""){
			Command: toastr["error"]("Please Enter Bus Number!", "Warning")

				toastr.options = {
				  "closeButton": true,
				  "debug": true,
				  "newestOnTop": false,
				  "progressBar": true,
				  "positionClass": "toast-top-right",
				  "preventDuplicates": true,
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
		}else{
			$.ajax({
				url: "<?php echo base_url('Bus_master_add/checkbusno'); ?>",
				method: "POST",
				data:{val:val},
				success:function(data){
					if(data == 1){
						$('#vn').val("");
						Command: toastr["info"]("This Vehicle No Is Already Assing Please Enter Another One!", "Warning")

						toastr.options = {
						  "closeButton": true,
						  "debug": true,
						  "newestOnTop": false,
						  "progressBar": true,
						  "positionClass": "toast-top-right",
						  "preventDuplicates": true,
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
					}else{
						Command: toastr["success"]("Vehicle No Is Accepted", "Granted!")

						toastr.options = {
						  "closeButton": true,
						  "debug": true,
						  "newestOnTop": false,
						  "progressBar": true,
						  "positionClass": "toast-top-right",
						  "preventDuplicates": true,
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
					}
				},
			});
		}
	}
  $( function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );
  function checkdata(val){
	$.ajax({
		url: "<?php echo base_url('Bus_master_add/checkbuno'); ?>",
		type: "POST",
		data: {val:val},
		success:function(data){
			if(data==1){
				alert("This Bus No is Already Assing Please Enter Other");
				$('#bn').val("");
				return false;
			}
		}
	});
  }
</script>

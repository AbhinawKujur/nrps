<style type="text/css">
   .error{
    color: red;
   }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('payroll/master/pfesi'); ?>">Bus Details</a> <i class="fa fa-angle-right"></i></li>
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
          <form role="form" action="<?php echo base_url('Bus_master_add/edit_save'); ?>" method="post" id="myform">
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
					<input type="hidden" value="<?php echo $bus_master[0]->BusCode; ?>" name="id">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Vehicle No:</label><span class="span">*</span>
                        <input type="text" readonly value="<?php echo $bus_master[0]->BusNo; ?>" name="vn" class="form-control" required>
                      </div>
                    </div>    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>No of Seats:</label><span class="span">*</span>
                        <input type="text" readonly value="<?php echo $bus_master[0]->seats; ?>" name="seats" class="form-control" autocomplete="off" required>
                      </div>
                    </div>      
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Regn No:</label><span class="span">*</span>
                        <input type="text" readonly value="<?php echo $bus_master[0]->regn_no; ?>" name="Regn" class="form-control"  autocomplete="off" required>
                      </div>
                    </div>  
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Chasis No:</label><span class="span">*</span>
                        <input type="text" readonly value="<?php echo $bus_master[0]->chasis_no; ?>" name="Chasis" class="form-control"  autocomplete="off" required>
                      </div>
                    </div>    
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Engine No:</label><span class="span">*</span>
						<input type="text" readonly value="<?php echo $bus_master[0]->engine_no; ?>" name="engineno" class="form-control" autocomplete="off" required>
                      </div>
                    </div>      
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Tax Paid Date:</label><span class="span">*</span>
                        <input type="date" readonly value="<?php echo date('Y-m-d',strtotime($bus_master[0]->tax_paid_date)); ?>" name="tpd" id="datepicker" class="form-control esi_limit"  autocomplete="off" required>
                      </div>
                    </div>          
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Tax Paid Expiry Date:</label><span class="span">*</span>
                        <input type="date" readonly value="<?php echo date('Y-m-d',strtotime($bus_master[0]->tax_expiry_date)); ?>" name="tped" class="form-control" autocomplete="off" required>
                      </div>
                    </div>    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Fitness Date:</label><span class="span">*</span>
                        <input type="date" readonly value="<?php echo date('Y-m-d',strtotime($bus_master[0]->fitness_date)); ?>" name="fd" class="form-control esi_emp_rate" autocomplete="off" required>
                      </div>
                    </div>   
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Fitness Renwal Date:</label><span class="span">*</span>
                        <input type="date" readonly value="<?php echo date('Y-m-d',strtotime($bus_master[0]->fitness_renewal_date)); ?>" name="frd" class="form-control" autocomplete="off" required>
                      </div>
                    </div>   
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Gprs Installed:</label><span class="span">*</span>
                        <select class="form-control" readonly name="gid" required>
							<option>Select..</option>
							<option value="y" <?php if($bus_master[0]->gprs_installed == 'Y'){echo "selected";} ?>>Y</option>
							<option value="n" <?php if($bus_master[0]->gprs_installed == 'N'){echo "selected";} ?> >N</option>
						</select>
                      </div>
                    </div>     
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Pollution Control Date:</label><span class="span">*</span>
                        <input type="date" readonly value="<?php echo date('Y-m-d',strtotime($bus_master[0]->pollution_date)); ?>" name="pcd" class="form-control" autocomplete="off" required>
                      </div>
                    </div>  
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Pollution Control Expiry Date:</label><span class="span">*</span>
                        <input type="date" readonly value="<?php echo date('Y-m-d',strtotime($bus_master[0]->pollution_expiry_date)); ?>" name="pced" class="form-control" autocomplete="off" required>
                      </div>
                    </div>  
                  </div>
				  <div class="row">
					<div class="col-sm-3">
                      <div class="form-group">
                        <label>Bus No:</label><span class="span">*</span>
                        <input type="text" readonly name="bn" value="<?php echo $bus_master[0]->bus_no; ?>" id="bn" onblur="checkdata(this.value)" class="form-control" autocomplete="off" required>
                      </div>
                    </div>
					<div class="col-sm-3">
                      <div class="form-group">
						<label>Cctv:</label><span class="span">*</span>
                        <select class="form-control" name="cctv" required>
							<option value="">select</option>
							<option value="Y" <?php if($bus_master[0]->cctv == "Y"){echo "selected";} ?> >Yes</option>
							<option value="N" <?php if($bus_master[0]->cctv == "N"){echo "selected";} ?>>No</option>
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
                        <input type="text" readonly value="<?php echo $bus_master[0]->insuance_comp_name; ?>" name="noic" class="form-control" autocomplete="off" >
                      </div>
                    </div>    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Insurance Policy Number:</label>
                        <input type="text" readonly value="<?php echo $bus_master[0]->insurance_policy_no; ?>" name="ipn" class="form-control" autocomplete="off" >
                      </div>
                    </div> 
                  </div>
				  <div class="row">
					<div class="col-sm-12">
                      <div class="form-group">
                        <label>Insurance Company Address:</label>
                        <textarea rows="4" readonly name="ica" cols="50" class="form-control"><?php echo $bus_master[0]->insuance_comp_address; ?></textarea>
                      </div>
                    </div> 
				  </div>
				  <div class="row">
					<div class="col-sm-4">
                      <div class="form-group">
                        <label>Insurance Amount:</label>
                        <input type="text" readonly value="<?php echo $bus_master[0]->insurance_amt; ?>" name="ia" value="0" class="form-control">
                      </div>
                    </div>
					<div class="col-sm-4">
                      <div class="form-group">
                        <label>Insurance Renwal Date:</label>
                        <input type="date" readonly value="<?php echo date('Y-m-d',strtotime($bus_master[0]->insurance_renewal_date)); ?>" name="ird" class="form-control">
                      </div>
                    </div>
					<div class="col-sm-4">
                      <div class="form-group">
                        <label>Insurance Expiry Date:</label>
                        <input type="date" readonly value="<?php echo date('Y-m-d',strtotime($bus_master[0]->insurance_expiry_date)); ?>" name="ied" class="form-control">
                      </div>
                    </div>
				  </div>
              </div>
            <div class="box-footer">
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

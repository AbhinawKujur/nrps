<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Character Certificate</a> <i class="fa fa-angle-right"></i></li>
</ol>
<div id="myModal" class="modal fade" data-backdrop='static' data-keyword='false' role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Change Financial Year</h4>
      </div>
      <div class="modal-body">
	  <form method="POST" action="<?php echo base_url('Certificate/char_show_details'); ?>">
        <div class="row">
			<div class='col-md-8 col-sm-8 col-lg-8'>
				<select name="session_year" id="session_year" class='form-control'>
					<option value="">Select Year</option>
					<?php
						if($session_data){
							foreach($session_data as $data_value){
								?>
									<option <?php if($data_value->Active_Status == 1){ echo "selected";} ?> value="<?php echo $data_value->Session_Nm; ?>"><?php echo $data_value->Session_Nm; ?></option>
								<?php
							}
						}
					?>
				</select>
			</div>
			<div class="col-md-2 col-sm-2 col-lg-2">
				<button class='btn btn-success btn-sm'>Change</button>
			</div>
			<div class="col-md-2 col-sm-2 col-lg-2">
				<button class='btn btn-success btn-sm'>Close</button>
			</div>
		</div>
	 </form>
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
</script>
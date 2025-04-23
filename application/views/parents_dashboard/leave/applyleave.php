<style type="text/css">
  .table-header{
      background: #c3c7c4;
    }
    @media only screen and (max-width: 800px) {
  
  /* Force table to not be like tables anymore */
  #no-more-tables table, 
  #no-more-tables thead, 
  #no-more-tables tbody, 
  #no-more-tables th, 
  #no-more-tables td, 
  #no-more-tables tr { 
    display: block; 
  }
 
  /* Hide table headers (but not display: none;, for accessibility) */
  #no-more-tables thead tr { 
    position: absolute;
    top: -9999px;
    left: -9999px;
  }
 
  #no-more-tables tr { border: 1px solid #ccc; }
 
  #no-more-tables td { 
    /* Behave  like a "row" */
    border: none;
    border-bottom: 1px solid #eee; 
    position: relative;
    padding-left: 50%; 
    white-space: normal;
    text-align:left;
  }
 
  #no-more-tables td:before { 
    /* Now like a table header */
    position: absolute;
    /* Top/left values mimic padding */
    top: 6px;
    left: 6px;
    width: 45%; 
    padding-right: 10px; 
    white-space: nowrap;
    text-align:left;
    font-weight: bold;
  }
 
  /*
  Label the data
  */
  #no-more-tables td:before { content: attr(data-title); }
}
</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Apply Leave
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-clipboard"></i> Home</a></li>
        <li class="active">Apply Leave</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <button class='btn btn-success' data-toggle="modal" data-target="#applyLeave">Apply New Leave</button>
        </div>
        <!-- /.box-header -->
      </div>

      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-clipboard"></i> Leave List</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" >
          <div class="row">
            <div class="col-sm-12">
              <div class="table-responsive" id="no-more-tables">
                <table class="table table-striped table-bordered datatable">
                  <thead class="table-header">
                    <tr>
                      <th>From Date</th>
                      <th>To Date</th>
                      <th>Reason</th>
                      <th>Leave Date</th>
                      <th>Leave Status</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
					foreach($stuLeaveData as $key => $val){
				  ?>
                   <tr>
						<td><?php echo date('d-M',strtotime($val['from_date'])); ?></td>
						<td><?php echo date('d-M',strtotime($val['to_date'])); ?></td>
						<td><?php echo $val['reason']; ?></td>
						<td><?php echo date('d-M',strtotime($val['created_at'])); ?></td>
						<td>
							<?php
								if($val['leave_status_by_teacher'] == 0){
									?>
										<label class='label label-danger'>PENDING</label>
									<?php
								}elseif($val['leave_status_by_teacher'] == 1){
									?>
										<label class='label label-success'>APPROVED</label>
									<?php
								}else{
									?>
										<label class='label label-warning'>DISAPPROVED</label>
									<?php
								}
							?>
						</td>
                   </tr>
				  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
	  <!-- Modal -->
		<div id="applyLeave" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Apply Leave</h4>
			  </div>
			  <div class="modal-body">
				<form id='leaveForm' enctype='multipart/form-data' autocomplete='off'>
					<table class='table'>
						<tr>
							<th>From Date</th>
							<td><input type='text' name='formDate' class='form-control datepicker' required></td>
							<th>To Date</th>
							<td><input type='text' name='toDate' class='form-control datepicker' required></td>
						</tr>
						<tr>
							<th>Reason In Details</th>
							<td colspan='3'><textarea name='reason' class='form-control' required></textarea></td>
						</tr>
						<tr>
							<th>Document</th>
							<td colspan='3'><input type='file' name='img[]' class='form-control'></td>
						</tr>
					</table>
			  </div>
			  <div class="modal-footer">
				<button type="submit" class="btn btn-success" id='bnt'><i class="fa fa-circle-o-notch fa-spin" id='process' style='display:none'></i> Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			  </div>
			  </form>
			</div>
		  </div>
		</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
	$(function () {
    $('.datatable').DataTable( {
		  responsive: true
		});
	  });
	  
	$(".datepicker").datepicker({ format: 'dd-M-yyyy',autoclose: true, startDate:new Date() });

	$("#leaveForm").on("submit", function (event) {
    event.preventDefault();
	var formData = new FormData(this);
	$("#bnt").prop('disabled',true);
	$("#process").show();
    $.ajax({
			url: "<?php echo base_url('parent_dashboard/leave/ApplyLeave/applyLeaveSave'); ?>",
			type: "POST",
			data:formData,
            cache:false,
            contentType: false,
            processData: false,
			success: function(ret){
				$("#applyLeave").modal('hide');
				$("#leaveForm").trigger("reset");
				toastr.success('Save successfully');
				setTimeout(function(){ 
					location.reload();
				}, 1000);
				$("#process").hide();
			}
		});
	 });	
</script>
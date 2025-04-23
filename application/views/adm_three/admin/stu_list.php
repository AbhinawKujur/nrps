<style>
	.table > thead > tr > th,
	.table > tbody > tr > th,
	.table > tfoot > tr > th,
	.table > thead > tr > td,
	.table > tbody > tr > td,
	.table > tfoot > tr > td {
		white-space: nowrap !important;
	  }
</style>
<div class="content-wrapper">
<section class="content-header">
  <div class="container-fluid">
	<div class="row mb-2">
	  <div class="col-sm-6">
		<h1>Students List</h1>
	  </div>
	  <div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
		  <li class="breadcrumb-item"><a href="#">Home</a></li>
		  <li class="breadcrumb-item active">Students List</li>
		</ol>
	  </div>
	</div>
  </div>
</section>

<section class="content">
  <div class="row">
	<div class="col-12">
	  <div class="card">
		<table class='table'>
			<tr>
				<th>Start Date</th>
				<td><input type='text' id='start_date' class='form-control datepicker'onchange='startDate(this.value)' autocomplete='off'></td>
				<th>End Date</th>
				<td><input type='text' id='end_date' class='form-control datepicker'onchange='endDate()' disabled autocomplete='off'></td>
				<th>Verified Status</th>
				<td>
					<select id='verified_status' class='form-control' onchange='verifiedReportDateRange()' disabled>
						<option value=''>Select</option>
						<option value='1'>Verified</option>
						<option value='0'>Pending</option>
						<option value='2'>Rejected</option>
					</select>
				</td>
			</tr>
		</table>
	  </div>
	</div>
  </div>
  
  <div class="row">
	<div class="col-12">
	  <div class="card">
		<div class="card-body table-responsive">
		  <table id="example1" class="table table-bordered table-striped">
			<thead>
			<tr>
			  <th>Name</th>
			  <th>DOB</th>
			  <th>Father's Name</th>
			  <th>Registration No.</th>
			  <th>Mobile</th>
			  <th>Verified Status</th>
			  <th>Action</th>
			</tr>
			</thead>
			<tbody id='load'>
			<?php
				foreach($stuData as $key => $val){
					?>
						<tr>
							<td><?php echo $val['stu_nm']; ?></td>
							<td><?php echo date('d-M-y',strtotime($val['dob'])); ?></td>
							<td><?php echo $val['f_name']; ?></td>
							<td><?php echo $val['id'].'/2020'; ?></td>
							<td><?php echo $val['mobile']; ?></td>
							<td>
								<?php
									if($val['verified_status'] == 2){
								?>
								<button class='btn btn-danger btn-xs'>REJECTED</button>
								<?php } elseif($val['verified_status'] == 1) { ?>
								<button class='btn btn-success btn-xs'>VERIFIED</button>
								<?php }else{
								?>
								<button class='btn btn-default btn-xs'>PENDING</button>
								<?php	
								} ?>
							</td>
							<td>
							<?php
								if($nur_reg_user[0]['updpermission_status'] == 1){
							?>
								<a href="<?php echo base_url('adm_three/Stu_list/edit/'.$val['id']); ?>" class='btn btn-info btn-xs' title='EDIT'>
								  <i class="fas fa-external-link-alt"></i>
								</a>
							<?php } ?>	
								<a href="<?php echo base_url('adm_three/Stu_list/downloadPDF/'.$val['id']); ?>" class='btn btn-danger btn-xs' title='DOWNLOAD'>
								  <i class="fas fa-download"></i>
								</a>
								<?php
									if($val['verified_status'] == 1){
								?>
								<a href="<?php echo base_url('adm_three/Stu_list/admitCardByadmin/'.$val['id']); ?>" class='btn btn-warning btn-xs' title='DOWNLOAD'>
								  <i class="fas fa-download"></i> ADMIT CARD
								</a>
								<?php } ?>
							</td>
						</tr>
					<?php
				}
			?>
			</tbody>
		  </table>
		</div>
	  </div>
	</div>
  </div>
</section>
</div>

<script>
	$('.datepicker').datepicker({
	    format: 'dd-M-yyyy',
	    autoclose:true,
	});
	
    $(document).ready(function() {
		$('#example1').DataTable( {
			dom: 'Bfrtip',
			buttons: 
			[
				{
					extend: 'excel',
					text: 'EXCEL',
					title: 'Total Registered Students',
					className: 'btn btn-default',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5]
					}
				},
				{
					extend: 'pdf',
					text: 'PDF',
					title: 'Total Registered Students',
					className: 'btn btn-default',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5]
					}
				}
			]
		} );
	} );
	
	$("#stulist_menu").addClass('active');
	
	function startDate(value){
		$("body").css({"opacity": "0.5"})
		$("#end_date").prop('disabled',false);
		$.ajax({
			url: "<?php echo base_url('adm_three/reports/RegisteredStu/ReportStuData'); ?>",
			type: "POST",
			data: {value:value},
			success:function(data){
				$("body").css({"opacity": ""})
				$(".card-body").html(data);
			}
		});
	}
	
	function endDate(){
		$("body").css({"opacity": "0.5"})
		$("#verified_status").prop('disabled',false)
		var start_date = $("#start_date").val();
		var end_date   = $("#end_date").val();
		$.ajax({
			url: "<?php echo base_url('adm_three/reports/RegisteredStu/ReportStuDateRange'); ?>",
			type: "POST",
			data: {start_date:start_date,end_date:end_date},
			success:function(data){
				$("body").css({"opacity": ""})
				$(".card-body").html(data);
			}
		});
	}
	
	function verifiedReportDateRange(){
		$("body").css({"opacity": "0.5"})
		var start_date      = $("#start_date").val();
		var end_date        = $("#end_date").val();
		var verified_status = $("#verified_status").val();
		$.ajax({
			url: "<?php echo base_url('adm_three/reports/RegisteredStu/ReportStuDateRangeStatus'); ?>",
			type: "POST",
			data: {start_date:start_date,end_date:end_date,verified_status:verified_status},
			success:function(data){
				$("body").css({"opacity": ""})
				$(".card-body").html(data);
			}
		});
	}
</script>
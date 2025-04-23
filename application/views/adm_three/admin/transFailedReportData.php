<div class="content-wrapper">
<section class="content-header">
  <div class="container-fluid">
	<div class="row mb-2">
	  <div class="col-sm-6">
		<h1>Transaction Failed List</h1>
	  </div>
	  <div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
		  <li class="breadcrumb-item"><a href="#">Home</a></li>
		  <li class="breadcrumb-item active">Transaction Failed List</li>
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
			</tr>
		</table>
	  </div>
	</div>
  </div>
  
  <div class="row">
	<div class="col-12">
	  <div class="card">
		<div class="card-body">
		  <table id="example1" class="table table-bordered table-striped">
			<thead>
			<tr>
			  <th>Name</th>
			  <th>DOB</th>
			  <th>Father's Name</th>
			  <th>Registration No.</th>
			  <th>Mobile</th>
			  <th>Transaction Id</th>
			  <th>DESC</th>
			</tr>
			</thead>
			<tbody id='load'>
			<?php
				foreach($transFailedReportData as $key => $val){
					?>
						<tr>
							<td><?php echo $val['stu_nm']; ?></td>
							<td><?php echo date('d-M-y',strtotime($val['dob'])); ?></td>
							<td><?php echo $val['f_name']; ?></td>
							<td><?php echo $val['id'].'/2020'; ?></td>
							<td><?php echo $val['mobile']; ?></td>
							<td><?php echo $val['transaction_id']; ?></td>
							<td><?php echo $val['desc']; ?></td>
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
						columns: [0, 1, 2, 3, 4, 5, 6]
					}
				},
				{
					extend: 'pdf',
					text: 'PDF',
					title: 'Total Registered Students',
					className: 'btn btn-default',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5, 6]
					}
				}
			]
		} );
	} );
	
	$("#failed_menu").addClass('active');
	
	function startDate(value){
		$("#end_date").prop('disabled',false);
		$.ajax({
			url: "<?php echo base_url('adm_three/reports/FailedTransReport/ReportStuData'); ?>",
			type: "POST",
			data: {value:value},
			success:function(data){
				$(".card-body").html(data);
			}
		});
	}
	
	function endDate(){
		$("#verified_status").prop('disabled',false)
		var start_date = $("#start_date").val();
		var end_date   = $("#end_date").val();
		$.ajax({
			url: "<?php echo base_url('adm_three/reports/FailedTransReport/ReportStuDateRange'); ?>",
			type: "POST",
			data: {start_date:start_date,end_date:end_date},
			success:function(data){
				$(".card-body").html(data);
			}
		});
	}
</script>
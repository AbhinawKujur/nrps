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
		<h1>Rejected List</h1>
	  </div>
	  <div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
		  <li class="breadcrumb-item"><a href="#">Home</a></li>
		  <li class="breadcrumb-item active">Rejected List</li>
		</ol>
	  </div>
	</div>
  </div>
</section>

<section class="content">
  <div class="row">
	<div class="col-12">
	  <div class="card">
		<div class="card-body table-responsive">
		  <table id="example1" class="table table-bordered table-striped">
			<thead>
			<tr>
			  <th>Registration No.</th>
			  <th>Name</th>
			  <th>DOB</th>
			  <th>Gender</th>
			  <th>Category</th>
			  <th>Mother Tongue</th>
			  <th>Religion</th>
			  <th>Blood Group</th>
			  <th>Father's Name</th>
			  <th>Qualification</th>
			  <th>Occupation</th>
			  <th>Mother's Name</th>
			  <th>Qualification</th>
			  <th>Occupation</th>
			  <th>Redidentail Address</th>
			  <th>PIN Code</th>
			  <th>Mobile</th>
			  <th>Distance KM</th>
			  <th>Permanent Address</th>
			  <th>PIN Code</th>
			  <th>Mobile</th>
			  <th>Amount</th>
			  <th>Reject Reason</th>
			  <th>Transaction Id</th>
			  <th>Payment time</th>
			</tr>
			</thead>
			<tbody>
				<?php
					foreach($verifiedData as $key => $val){
						?>
							<tr>
								<td><?php echo $val['id'].'/2020'; ?></td>
								<td><?php echo $val['stu_nm']; ?></td>
								<td><?php echo $val['dob']; ?></td>
								<td><?php echo ($val['gender']==1)?'Male':'Female' ?></td>
								<td><?php echo $val['catnm']; ?></td>
								<td><?php echo $motherTounge[$val['mother_tounge']]; ?></td>
								<td><?php echo $val['religionnm']; ?></td>
								<td><?php echo $bloodGroup[$val['blood_group']]; ?></td>
								<td><?php echo $val['f_name']; ?></td>
								<td><?php echo $parent_qualification[$val['f_qualification']]; ?></td>
								<td><?php echo $parent_accupation[$val['f_accupation']]; ?></td>
								<td><?php echo $val['m_name']; ?></td>
								<td><?php echo $parent_qualification[$val['m_qualification']]; ?></td>
								<td><?php echo $parent_accupation[$val['m_accupation']]; ?></td>
								<td><?php echo $val['residentail_add']; ?></td>
								<td><?php echo $val['pin_code']; ?></td>
								<td><?php echo $val['mobile']; ?></td>
								<td><?php echo $val['distance']; ?></td>
								<td><?php echo $val['p_residentail_add']; ?></td>
								<td><?php echo $val['p_pin_code']; ?></td>
								<td><?php echo $val['p_mobile']; ?></td>
								<td><?php echo $val['amt']; ?></td>
								<td><?php echo $val['reject_reason']; ?></td>
								<td><?php echo $val['transaction_id']; ?></td>
								<td><?php echo $val['response_received_time']; ?></td>
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
				},
			]
		} );
	} );
	
	$("#rejected_menu").addClass('active');
</script>
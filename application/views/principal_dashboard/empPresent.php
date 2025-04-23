<br>
<style type="text/css">
	.thead-color{
		background: #bac9e2 !important;
	}
</style>
	<div class="employee-dashboard">
		<div class="row"> 
          	<div class="col-sm-12">
          		<div class="panel panel-default" style="background: #3278ab !important;color: white;font-size: 13px">
		            <div class="panel-heading text-center">No of Employee Present</div>
		            <div class="table-responsive" style="background: white !important;border:1px solid #3278ab;color: white;">
		              	<table class='table table-bordered table-striped'>
							<thead>
							   <tr>
							     <th class="text-center thead-color">Wing Type</th>
							     <th class="text-center thead-color">Total Employee</th> 
							     <th class="text-center thead-color">Male</th>
							     <th class="text-center thead-color">Female</th>
							     <th class="text-center thead-color">Teaching</th>
							     <th class="text-center thead-color">Non-Teaching</th>
							   </tr>
							</thead>
							<tbody>
								<?php foreach ($todayPresentEmp as $key => $value) { ?>
									<tr>
										<td><?php echo $value['NAME'];  ?></td>
										<td class="text-center"><?php echo $value['total_emp'];  ?></td>
										<td class="text-center"><?php echo $value['total_male_pre']; ?></td>
										<td class="text-center"><?php echo $value['total_female_pre']; ?></td>
										<td class="text-center"><?php echo $value['total_teaching_pre']; ?></td>
										<td class="text-center"><?php echo $value['total_nonteaching_pre']; ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
		            </div>
		         </div>
          	</div>

          	<div class="col-sm-12">
          		<div class="panel panel-default" style="background: #3278ab !important;color: white;font-size: 13px">
		            <div class="panel-heading text-center">No of Employee Absent</div>
		            <div class="table-responsive" style="background: white !important;border:1px solid #3278ab;color: white;">
		              	<table class='table table-bordered table-striped datatable table-hover'>
							<thead>
							   <tr>
							     <th class="text-center thead-color">EMPID</th>
							     <th class="text-center thead-color">Name</th> 
							     <th class="text-center thead-color">Designation</th>
							     <th class="text-center thead-color">Wing</th>
							     <th class="text-center thead-color">Staff</th>
							     <th class="text-center thead-color">Shift Time</th>
							   </tr>
							</thead>
							<tbody>
								<?php foreach ($todayAbsentEmp as $key => $value) { ?>
									<tr>
										<td><?php echo $value['EMPID']; ?></td>
										<td><?php echo $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']; ?></td>
										<td><?php echo $value['DESIGNATION']; ?></td>
										<td><?php echo $value['wing']; ?></td>
										<td><?php echo ($value['STAFF_TYPE']==1)?"Teaching":"Non Teaching"; ?></td>
										<td><?php echo $value['IN_TIME'].' <b>to</b> '.$value['OUT_TIME']; ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
		            </div>
		         </div>
          	</div>
        </div>
    </div>
          <br>
          <script type="text/javascript">
          	   $(function () {
				    $('.datatable').DataTable({
				      'paging'      : true,
				      'lengthChange': true,
				      'searching'   : true,
				      'ordering'    : true,
				      'info'        : true,
				      'autoWidth'   : true,
				      "pageLength": 50
				    })
				  });
          </script>
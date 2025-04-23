  <style>
  	.table-header{
  		background: #c3c7c4;
  	}
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Student Attendance
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Student Details</li>
		<li class="active">Attendance</li>
      </ol>
    </section>

    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-primary" data-select2-id="15">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-calendar-check-o"></i> Month Wise Attendance Details</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" >
        	<div class="row">
        		<div class="col-sm-12">
        			<div class="table-responsive">
        				<table class="table table-striped">
        					<thead class="table-header">
        						<tr>
        							<th class="text-center">Month Name</th>
        							<th class="text-center">Total Working Days</th>
        							<th class="text-center">Total Present</th>
        							<th class="text-center">Total Absent</th>
        						</tr>
        					</thead>
        					<tbody>
        						<?php foreach ($attendanceList as $key => $value) { ?>
        							<tr>
        								<td class="text-center">
        									<a href="<?php echo base_url('Parent_details/monthlyAttendanceDetails/'.$value['month_code']); ?>">
        									<strong><u>
        										<?php echo $value['month_name']; ?>
        									</u></strong>
        									</a>
        								</td>
        								<td class="text-center"><?php echo $value['total_working_days']; ?></td>
        								<td class="text-center"><?php echo $value['present_days']; ?></td>
        								<td class="text-center"><?php echo $value['absent_days']; ?></td>
        							</tr>
        						<?php } ?>
        					</tbody>
        				</table>
        			</div>
        		</div>
        	</div>
        </div>
      </div>
      <!-- /.box -->
    </section>
  </div>
  <!-- /.content-wrapper -->
  
  <script type="text/javascript">
  $(function () {
    $('#example2').DataTable()
  })

</script>
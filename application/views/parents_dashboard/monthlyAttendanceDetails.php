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

      <div class="box box-primary" data-select2-id="15">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-calendar-check-o"></i> Monthly Attendance Details</h3>
          <div class="pull-right">
            <span style="color: #3c8dbc;"><b>H</b> = Holiday</span>,
            <span style="color: green;"><b>P</b> = Present</span>, 
            <span style="color: red;"><b>A</b> = Absent</span>, 
            <span style="color: #e35729;"><b>HD</b> = Half Day</span>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" >
        	<div class="row">
        		<div class="col-sm-12">
        			<div class="table-responsive">
              <?php if($attendance_type == 1){  ?>
        				<table class="table table-striped">
        					<thead class="table-header">
        						<tr>
        							<th class="text-center">Date</th>
        							<th class="text-center">Status</th>
        						</tr>
        					</thead>
        					<tbody>
        						<?php foreach ($attendanceList as $key => $value) { ?>
        							<tr>
        								<td class="text-center"><?php echo date('d-M-Y',strtotime($value['date'])); ?></td>
        								<td class="text-center">
                          <?php if($value['status'] == 'P'){
                            $color = "green";
                          }else if($value['status'] == 'A')
                          {
                            $color = "red";
                          }else if($value['status'] == 'HD')
                          {
                            $color = "#e35729";
                          }else
                          {
                            $color = "#3c8dbc";
                          } ?>
                          <span style="color: <?php echo $color; ?>"><strong>
                            <?php echo $value['status']; ?>
                          </strong></span>
                        </td>
        							</tr>
        						<?php } ?>
        					</tbody>
        				</table>
              <?php } else { ?>
                <table class="table table-striped">
                  <thead class="table-header">
                    <tr>
                      <th class="text-center">Date</th>
                      <th class="text-center">P1</th>
                      <th class="text-center">P2</th>
                      <th class="text-center">P3</th>
                      <th class="text-center">P4</th>
                      <th class="text-center">P5</th>
                      <th class="text-center">P6</th>
                      <th class="text-center">P7</th>
                      <th class="text-center">P8</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($attendanceList as $key => $value) { ?>
                      <tr>
                        <td class="text-center"><?php echo date('d-M-Y',strtotime($value['date'])); ?></td>
                        <td class="text-center">
                          <?php if($value['p1'] == 'P'){
                            $p1color = "green";
                          }else if($value['p1'] == 'A')
                          {
                            $p1color = "red";
                          }else
                          {
                            $p1color = "#3c8dbc";
                          } ?>
                          <span style="color: <?php echo $p1color; ?>"><strong>
                            <?php echo $value['p1']; ?>
                          </strong></span>
                        </td>
                        <td class="text-center">
                          <?php if($value['p2'] == 'P'){
                            $p2color = "green";
                          }else if($value['p2'] == 'A')
                          {
                            $p2color = "red";
                          }else
                          {
                            $p2color = "#3c8dbc";
                          } ?>
                          <span style="color: <?php echo $p2color; ?>"><strong>
                            <?php echo $value['p2']; ?>
                          </strong></span>
                        </td>
                        <td class="text-center">
                          <?php if($value['p3'] == 'P'){
                            $p3color = "green";
                          }else if($value['p3'] == 'A')
                          {
                            $p3color = "red";
                          }else
                          {
                            $p3color = "#3c8dbc";
                          } ?>
                        <span style="color: <?php echo $p3color; ?>"><strong>
                            <?php echo $value['p3']; ?>
                          </strong></span>
                        </td>
                        <td class="text-center">
                         <?php if($value['p4'] == 'P'){
                            $p4color = "green";
                          }else if($value['p4'] == 'A')
                          {
                            $p4color = "red";
                          }else
                          {
                            $p4color = "#3c8dbc";
                          } ?>
                        <span style="color: <?php echo $p4color; ?>"><strong>
                            <?php echo $value['p4']; ?>
                          </strong></span>
                        </td>

                        <td class="text-center">
                          <?php if($value['p5'] == 'P'){
                            $p5color = "green";
                          }else if($value['p5'] == 'A')
                          {
                            $p5color = "red";
                          }else
                          {
                            $p5color = "#3c8dbc";
                          } ?>
                        <span style="color: <?php echo $p5color; ?>"><strong>
                            <?php echo $value['p5']; ?>
                          </strong></span>
                        </td>
                        <td class="text-center">
                          <?php if($value['p6'] == 'P'){
                            $p6color = "green";
                          }else if($value['p6'] == 'A')
                          {
                            $p6color = "red";
                          }else
                          {
                            $p6color = "#3c8dbc";
                          } ?>
                        <span style="color: <?php echo $p6color; ?>"><strong>
                            <?php echo $value['p6']; ?>
                          </strong></span>
                        </td>
                        <td class="text-center">
                         <?php if($value['p7'] == 'P'){
                            $p7color = "green";
                          }else if($value['p7'] == 'A')
                          {
                            $p7color = "red";
                          }else
                          {
                            $p7color = "#3c8dbc";
                          } ?>
                        <span style="color: <?php echo $p7color; ?>"><strong>
                            <?php echo $value['p7']; ?>
                          </strong></span>
                        </td>

                        <td class="text-center">
                          <?php if($value['p8'] == 'P'){
                            $p8color = "green";
                          }else if($value['p8'] == 'A')
                          {
                            $p8color = "red";
                          }else
                          {
                            $p8color = "#3c8dbc";
                          } ?>
                          <span style="color: <?php echo $p8color; ?>"><strong>
                            <?php echo $value['p8']; ?>
                          </strong></span>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              <?php } ?>
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
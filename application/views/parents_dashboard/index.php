  <?php
	error_reporting(0);
    if($data){
      $stu_aatt = $data[0]->attendance_type;
    }
	if($half_day){
		$half_day = $half_day[0]->Halfday;
	}
	else{
		$half_day = 0;
	}
	if($absent_day){
		$absent_day = $absent_day[0]->Absent;
	}else{
		$absent_day = 0;
	}
	if($present_day){
		$present_day = $present_day[0]->Present;
	}
	else{
		$present_day = 0;
	}
   ?>
  <style>
	 .A {
    background-color: #dd4b39;
  }
  .P {
    background-color: #00a65a;
  }
  .HD {
    background-color: #f39c12;
  }
  .present {
    background-color: #00a65a;
  }
  .absent{
     background-color: #dd4b39;
  }
  .halfday{
     background-color: #f39c12;
  }
  div.legend span {
    color: #1d1b1b !important;
    font-size: 20px !important;
    font-weight: normal !important;
	padding-right:10px;
}
ul.legend li {
    display: inline-block;
    height: 14px !important;
    width: 14px !important;
    margin-left: 5px;
}
.box {
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    border-top: 3px solid #3c8cbc;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
}
.notice_para{
	font-weight: bold;
	font-size: 14px;
}

.download-file-color-change{
    -webkit-animation: color-change 1s infinite;
    -moz-animation: color-change 1s infinite;
    -o-animation: color-change 1s infinite;
    -ms-animation: color-change 1s infinite;
    animation: color-change 1s infinite;
}

@-webkit-keyframes color-change {
    0% { color: red; }
    50% { color: blue; }
    100% { color: red; }
}
@-moz-keyframes color-change {
    0% { color: red; }
    50% { color: blue; }
    100% { color: red; }
}
@-ms-keyframes color-change {
    0% { color: red; }
    50% { color: blue; }
    100% { color: red; }
}
@-o-keyframes color-change {
    0% { color: red; }
    50% { color: blue; }
    100% { color: red; }
}
@keyframes color-change {
    0% { color: red; }
    50% { color: blue; }
    100% { color: red; }
}
  </style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
     <!--  <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h4>Check</h4>

              <p>Attendance</p>
            </div>
            <div class="icon">
              <i class="fa fa-calendar"></i>
            </div>
            <a href="<?php echo base_url('Parent_details/stu_attendance'); ?>" class="small-box-footer">Show <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h4>Pay Fee</h4>

              <p>Online</p>
            </div>
            <div class="icon">
              <i class="fa fa-rupee"></i>
            </div>
            <a href="<?php echo base_url('Parent_details/pay_details'); ?>" class="small-box-footer">Show Fees Details <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div> -->
      <!-- /.row -->
		<div class='row'>
			<div class='col-md-6 col-sm-6 col-lg-6'>
			<?php
				$t1_report_card_status = $reportCard[0]['t1_report_card_status'];
				$adm = str_replace('/','-',$adm);
				$class_code = $this->session->userdata('class_code');
				if($class_code != '16' && $class_code !='17' && $class_code !='19' && $class_code !='21' && $class_code !='22'){
				if($t1_report_card_status == 1)
					{
					?>
						<a download href='<?php echo base_url('report_card/term2/'.$adm.'.pdf'); ?>' class='btn btn-success'><i class="fa fa-download"></i> DOWNLOAD REPORT CARD TERM-1</a><br /><br />
					<?php 
				}
					
				
				}
				?>
			
				<?php
				if($stu_aatt==1){
				?>
				 <div class="full_calendar box box-primary"></div>
				<?php
				}
				elseif($stu_aatt==2){
					?>
			<div style="overflow:auto;">
			<div class="box">
	            <div class="box-header">
	              <h3 class="box-title">ATTENDANCE PERIOD WISE</h3>
	            </div>
            <!-- /.box-header -->
	            <div class="box-body">
	              <table id="example2" class="table table-bordered table-hover">
	                <thead>
					<tr>
						<th>DATE</th>
						<th colspan="8"><center>PERIOD</center></th>
					</tr>
					<tr>
					  <th></th>
	                  <th>P1</th>
	                  <th>P2</th>
	                  <th>P3</th>
	                  <th>P4</th>
	                  <th>P5</th>
	                  <th>P6</th>
	                  <th>P7</th>
	                  <th>P8</th>
	                </tr>
	                </thead>
	                <tbody>
						<?php
							if($period_wise_att){
								foreach($period_wise_att as $key => $value){
									?>
										<tr>
											<td><?php echo date('d-M-Y',strtotime($value->att_date)); ?></td>
											<?php
												if($value->P1 == "A"){
													?>
													<td style="background:#dc3911; font-weight:bold; color:#fff;"><center><?php echo $value->P1; ?></center></td>
													<?php
												}
												elseif($value->P1 == "P"){
													?>
													<td style="background:#30a55a; font-weight:bold; color:#fff;"><center><?php echo $value->P1; ?></center></td>
													<?php
													
												}
												else{
													?>
													<td></td>
													<?php
												}
											?>
											<?php
												if($value->P2 == "A"){
													?>
													<td style="background:#dc3911; font-weight:bold; color:#fff;"><center><?php echo $value->P2; ?></center></td>
													<?php
												}
												elseif($value->P2 == "P"){
													?>
													<td style="background:#30a55a; font-weight:bold; color:#fff;"><center><?php echo $value->P2; ?></center></td>
													<?php
													
												}
												else{
													?>
														<td></td>
													<?php
												}
											?>
											<?php
												if($value->P3 == "A"){
													?>
													<td style="background:#dc3911; font-weight:bold; color:#fff;"><center><?php echo $value->P3; ?></center></td>
													<?php
												}
												elseif($value->P3 == "P"){
													?>
													<td style="background:#30a55a; font-weight:bold; color:#fff;"><center><?php echo $value->P3; ?></center></td>
													<?php
													
												}
												else{
													?>
													<td></td>
													<?php
												}
											?>
											<?php
												if($value->P4 == "A"){
													?>
													<td style="background:#dc3911; font-weight:bold; color:#fff;"><center><?php echo $value->P4; ?></center></td>
													<?php
												}
												elseif($value->P4 == "P"){
													?>
													<td style="background:#30a55a; font-weight:bold; color:#fff;"><center><?php echo $value->P4; ?></center></td>
													<?php
													
												}
												else{
													?>
													<td></td>
													<?php
												}
												
											?>
											<?php
												if($value->P5 == "A"){
													?>
													<td style="background:#dc3911; font-weight:bold; color:#fff;"><center><?php echo $value->P5; ?></center></td>
													<?php
												}
												elseif($value->P5 == "P"){
													?>
													<td style="background:#30a55a; font-weight:bold; color:#fff;"><center><?php echo $value->P5; ?></center></td>
													<?php
													
												}
												else{
													?>
													<td></td>
													<?php
												}
											?>
											<?php
												if($value->P6 == "A"){
													?>
													<td style="background:#dc3911; font-weight:bold; color:#fff;"><center><?php echo $value->P6; ?></center></td>
													<?php
												}
												elseif($value->P6 == "P"){
													?>
													<td style="background:#30a55a; font-weight:bold; color:#fff;"><center><?php echo $value->P6; ?></center></td>
													<?php
													
												}
												else{
													?>
													<td></td>
													<?php
												}
											?>
											<?php
												if($value->P7 == "A"){
													?>
													<td style="background:#dc3911; font-weight:bold; color:#fff;"><center><?php echo $value->P7; ?></center></td>
													<?php
												}
												elseif($value->P7 == "P"){
													?>
													<td style="background:#30a55a; font-weight:bold; color:#fff;"><center><?php echo $value->P7; ?></center></td>
													<?php
													
												}
												else{
													?>
														<td></td>
													<?php
												}
											?>
											<?php
												if($value->P8 == "A"){
													?>
													<td style="background:#dc3911; font-weight:bold; color:#fff;"><center><?php echo $value->P8; ?></center></td>
													<?php
												}
												elseif($value->P8 == "P"){
													?>
													<td style="background:#30a55a; font-weight:bold; color:#fff;"><center><?php echo $value->P8; ?></center></td>
													<?php
													
												}
												else{
													?>
													<td></td>
													<?php
												}
											?>
										</tr>
									<?php
								}
							}
						?>
	                </tbody>
	              </table>
	            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		  </div>
					<?php
					}
				?>
			</div>
			<!-- <div class='col-md-6 col-sm-6 col-lg-6'>
				<div id="piechart_3d" style="width: 100%; height: 100%;"></div>
			</div> -->

			<div class="col-md-6">
              <!-- DIRECT CHAT -->
              <div class="box" style="height: 180px;">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-bullhorn"></i> Notice List</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                	<?php if(!empty($noticeList)){ ?>
	                	<marquee  behavior="scroll" direction="up" scrolldelay="300" onmouseover="this.stop();" onmouseout="this.start();" height="120px">
	                		<?php foreach ($noticeList as $key => $value) { ?>
		                 		<p class="notice_para"><i class="fa fa-hand-o-right"></i> <?php echo $value['notice_details']; ?>
		                 			<?php if($value['notice_img'] != ''){ ?> 
		                 				<a href="<?php echo base_url($value['notice_img']); ?>" class="download-file-color-change" target="_blank"><i class="fa fa-download"></i> Download File</a>
		                 			<?php } ?>
		                 		</p>
		                 	<?php } ?>
			            </marquee>
			        <?php } ?>
                </div>
              </div>
			  
			  <!-- homework -->
			  <div class="box" style="height: 180px;">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-pencil-square-o"></i> Homework List</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                	<?php if(!empty($homeworkList)){ ?>
	                	<marquee  behavior="scroll" direction="up" scrolldelay="300" onmouseover="this.stop();" onmouseout="this.start();" height="120px">
	                		<?php foreach ($homeworkList as $key => $value) { ?>
							
		                 		<p class="notice_para"><i class="fa fa-hand-o-right"></i> 
								<?php 
								  echo $value['subjnm'] .' / ' .$value['catnm']."<br /> 
								  <span style='color:red;'>Submission date</span> - ".$value['subdate']."<br />
								  <span style='color:red;'>H/W date</span> - ".$value['hwDate']."<br />								  
								  <span style='color:red;'>Description </span> - " .$value['remarks']; 
								?>
								<?php 
								$imgList = unserialize($value['img']);
								if(!empty($imgList)){
								foreach($imgList as $key => $val){
								 ?> 
								    <br />
									<a href="<?php echo base_url($val); ?>" class="download-file-color-change" target="_blank"><span>File <?php echo $key + 1; ?></span> <i class="fa fa-download" title='DOWNLOAD FILE'></i></a>
								<?php }  } ?>
		                 		</p>
								
		                 	<?php } ?>
			            </marquee>
			        <?php } ?>
                </div>
              </div>
			  <!-- end homework -->
            </div>
		</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    <script type="text/javascript">
	$(function () {
    $('#example2').DataTable()
  })
  $(".full_calendar").zabuto_calendar({
      today: true,
      cell_border: true,
      weekstartson: 0,
      ajax: {
          url: "<?php echo base_url('Parent_details/attendance'); ?>",
          modal: true,
      },
      /* nav_icon: {
        prev: '<i class="fa fa-chevron-circle-left"></i>',
        next: '<i class="fa fa-chevron-circle-right"></i>'
      }, */
      // limit months navigation to a specific range
        legend: [
       {
          type: "block",
          label: "Present",
          classname: "P"
        },
        {
          type: "block",
          label: "Absent",
          classname: "A"
        },
        {
          type: "block",
          label: "Halfday",
          classname: "HD"
        },
      ], 
    });
	
	  google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Present',     <?php echo $present_day; ?>],
          ['Absent',      <?php echo $absent_day; ?>],
          ['Halfday',  	  <?php echo $half_day; ?>],
        ]);

        var options = {
          title: 'Attendance Graph',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
</script>
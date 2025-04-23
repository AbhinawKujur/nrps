  <?php
  error_reporting(0);
	if($student_details){
		$stu_img = $student_details->student_image;
		$stu_name = $student_details->FIRST_NM;
		$stu_adm = $student_details->ADM_NO;
		$stu_roll = $student_details->ROLL_NO;
		$stu_class = $student_details->DISP_CLASS;
		$stu_sec = $student_details->DISP_SEC;
		$apr_fee1 = $student_details->APR_FEE;
		$may_fee1 = $student_details->MAY_FEE;
		$jun_fee1 = $student_details->JUNE_FEE;
		$jul_fee1 = $student_details->JULY_FEE;
		$aug_fee1 = $student_details->AUG_FEE;
		$sep_fee1 = $student_details->SEP_FEE;
		$oct_fee1 = $student_details->OCT_FEE;
		$nov_fee1 = $student_details->NOV_FEE;
		$dec_fee1 = $student_details->DEC_FEE;
		$jan_fee1 = $student_details->JAN_FEE;
		$feb_fee1 = $student_details->FEB_FEE;
		$mar_fee1 = $student_details->MAR_FEE;
		//=======================//
		$FEE[0] = $student_details->APR_FEE;
 		$FEE[1] = $student_details->MAY_FEE;
 		$FEE[2] = $student_details->JUNE_FEE;
 		$FEE[3] = $student_details->JULY_FEE;
 		$FEE[4] = $student_details->AUG_FEE;
 		$FEE[5] = $student_details->SEP_FEE;
 		$FEE[6] = $student_details->OCT_FEE;
 		$FEE[7] = $student_details->NOV_FEE;
 		$FEE[8] = $student_details->DEC_FEE;
 		$FEE[9] = $student_details->JAN_FEE;
 		$FEE[10] = $student_details->FEB_FEE;
 		$FEE[11] = $student_details->MAR_FEE;
		//=======================//
	}
	$val = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','JAN','FEB','MAR');
	$id = array('apr','may','jun','jul','aug','sep','oct','nov','dec','jan','feb','mar');
	if($previous_dues){
		$pre_dues = $previous_dues;
	}
	// if($apr_fee){
		// $apr_fee = $apr_fee->TOTAL;
	// }
	// if($may_fee){
		// $may_fee = $may_fee->TOTAL;
	// }
	// if($jun_fee){
		// $jun_fee = $jun_fee->TOTAL;
	// }
	// if($jul_fee){
		// $jul_fee = $jul_fee->TOTAL;
	// }
	// if($aug_fee){
		// $aug_fee = $aug_fee->TOTAL;
	// }
	// if($sep_fee){
		// $sep_fee = $sep_fee->TOTAL;
	// }
	// if($oct_fee){
		// $oct_fee = $oct_fee->TOTAL;
	// }
	// if($nov_fee){
		// $nov_fee = $nov_fee->TOTAL;
	// }
	// if($dec_fee){
		// $dec_fee = $dec_fee->TOTAL;
	// }
	// if($jan_fee){
		// $jan_fee = $jan_fee->TOTAL;
	// }
	// if($feb_fee){
		// $feb_fee = $feb_fee->TOTAL;
	// }
	// if($mar_fee){
		// $mar_fee = $mar_fee->TOTAL;
	// }
	if($parcial_dues_total){
		$parcial_dues_total = $parcial_dues_total;
	}
	
  ?>
  <style>
	.profile-user-img {
		height: 110px;
		}
		.box.box-primary {
		border-top-color: #faa21c;
		}
		#pd{
			cursor:pointer;
		}
		tr:nth-child(even) {
		background-color: #dddddd;
		}
		.th{
			background-color:#222e33;
			color:white;
		}
		.label{
			font-size:12px;
			cursor:pointer;
		}
		.loader{
			position: fixed;
			z-index: 999;
			top: 30%;
			left: 50%;
			display:none;
		}
		/* The container */
.container {
  display: block;
  position: relative;
  padding-left: 29px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 20px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #2196F3;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}
.container input ~ .checkmark {
  background-color: #ccc;
}
/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
  </style>
	
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
	
    <section class="content-header">
      <h1>
       Fees Details
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Fees Summary</a></li>
        <li class="active">Payment Details</li>
      </ol>
    </section>
		
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
			<?php
				 if($stu_img==null){
					 ?>
					 <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('assets/student_photo/default.jpg'); ?>" alt="User profile picture">
					 <?php
				 }else{
					?>
					<img class="profile-user-img img-responsive img-circle" src="<?php echo base_url($stu_img); ?>" alt="User profile picture">
					<?php
				 }
				?>
              <h3 class="profile-username text-center"><?php echo $stu_name; ?></h3>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Admission Number</b> <a class="pull-right"><?php echo $stu_adm; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Roll Number</b> <a class="pull-right"><?php echo $stu_roll; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Class</b> <a class="pull-right"><?php echo $stu_class; ?></a>
                </li>
				<li class="list-group-item">
                  <b>Section</b> <a class="pull-right"><?php echo $stu_sec; ?></a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Fees Details</a></li>
              <!--<li><a href="#timeline" data-toggle="tab">Timeline</a></li>
              <li><a href="#settings" data-toggle="tab">Settings</a></li>-->
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
				<?php
					if($pre_dues > 0 || $parcial_dues_total > 0)
					{
						?>
						<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
                  <b>Dues Type</b> <a class="pull-right"><i class="fa fa-rupee pull-right"></i>&nbsp;&nbsp;</a>
                </li>
				<?php
					if($pre_dues>0){
						?>
							<li class="list-group-item">
                  <b>Previous Year Dues</b> <a class="pull-right"><?php echo $pre_dues; ?></a>
                </li>
						<?php
					}
				?>
                <?php
					if($parcial_dues_total > 0){
						?>
							<li class="list-group-item">
                  <b>Partial Dues</b> <a class="pull-right"id='pd'><?php echo $parcial_dues_total; ?></a>
                </li>
						<?php
					}
				?>
                
				</ul>
						<?php
					}
				?>
				
                <div class='table-responsive'>
					<table class='table table-striped table-hover'>
						<caption style="font-size:18px;" class='text-info text-center'><b>Monthly Payment Status</b></caption>
						<thead>
							<tr>
								<th class='th'>Month</th>
								<th class='th'>( <i class='fa fa-rupee'></i> ) Amount</th>
								<th class='th'>Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td Class='text-bold'>April</td>
								<td><?php 
									if($apr_fee1!='' && $apr_fee1!='N/A' && $apr_fee1!='n/a')
									{
										echo "<span class='label label-success'><i class='fa fa-rupee'></i> ".$fee_paid_details[0]."</span>";
									}
								?></td>
								<td>
									<?php
										if($apr_fee1!='' && $apr_fee1!='N/A' && $apr_fee1!='n/a'){
											?>
											<span  class='label label-success' title='Click for Download Recipet' onclick="download_recpt('<?php echo $apr_fee1; ?>')"><i class="fa fa-download" aria-hidden="true"></i> <?php echo $apr_fee1; ?></span>
											<?php
										}
										else{
											echo "<span class='label label-warning' onclick='show_month_details()'>Unpaid</span>";
										}
									?>
								</td>
							</tr>
							<tr>
								<td Class='text-bold'>May</td>
								<td><?php 
									if($may_fee1!='' && $may_fee1!='N/A' && $may_fee1!='n/a')
									{
										echo "<span class='label label-success'><i class='fa fa-rupee'></i> ".$fee_paid_details[1]."</span>";
									}
								?></td>
								<td>
									<?php
										if($may_fee1!='' && $may_fee1!='N/A' && $may_fee1!='n/a'){
											?>
											<span  class='label label-success' title='Click for Download Recipet' onclick="download_recpt('<?php echo $may_fee1; ?>')"><i class="fa fa-download" aria-hidden="true"></i> <?php echo $may_fee1; ?></span>
											<?php
										}
										else{
											echo "<span class='label label-warning' onclick='show_month_details()'>Unpaid</span>";
										}
									?>
								</td>
							</tr>
							<tr>
								<td Class='text-bold'>June</td>
								<td><?php 
									if($jun_fee1!='' && $jun_fee1!='N/A' && $jun_fee1!='n/a')
									{
										echo "<span class='label label-success'><i class='fa fa-rupee'></i> ".$fee_paid_details[2]."</span>";
									}
								?></td>
								<td>
									<?php
										if($jun_fee1!='' && $jun_fee1!='N/A' && $jun_fee1!='n/a'){
											?>
											<span  class='label label-success' title='Click for Download Recipet' onclick="download_recpt('<?php echo $jun_fee1; ?>')"><i class="fa fa-download" aria-hidden="true"></i> <?php echo $jun_fee1; ?></span>
											<?php
										}
										else{
											echo "<span class='label label-warning' onclick='show_month_details()'>Unpaid</span>";
										}
									?>
								</td>
							</tr>
							<tr>
								<td Class='text-bold'>July</td>
								<td><?php 
									if($jul_fee1!='' && $jul_fee1!='N/A' && $jul_fee1!='n/a')
									{
										echo "<span class='label label-success'><i class='fa fa-rupee'></i> ".$fee_paid_details[3]."</span>";
									}
								?></td>
								<td>
								<?php
										if($jul_fee1!='' && $jul_fee1!='N/A' && $jul_fee1!='n/a'){
											?>
											<span  class='label label-success' title='Click for Download Recipet' onclick="download_recpt('<?php echo $jul_fee1; ?>')"><i class="fa fa-download" aria-hidden="true"></i> <?php echo $jul_fee1; ?></span>
											<?php
										}
										else{
											echo "<span class='label label-warning' onclick='show_month_details()'>Unpaid</span>";
										}
									?>
								</td>
							</tr>
							<tr>
								<td Class='text-bold'>August</td>
								<td><?php 
									if($aug_fee1!='' && $aug_fee1!='N/A' && $aug_fee1!='n/a')
									{
										echo "<span class='label label-success'><i class='fa fa-rupee'></i> ".$fee_paid_details[4]."</span>";
									}
								?></td>
								<td>
									<?php
										if($aug_fee1!='' && $aug_fee1!='N/A' && $aug_fee1!='n/a'){
											?>
											<span  class='label label-success' title='Click for Download Recipet' onclick="download_recpt('<?php echo $aug_fee1; ?>')"><i class="fa fa-download" aria-hidden="true"></i> <?php echo $aug_fee1; ?></span>
											<?php
										}
										else{
											echo "<span class='label label-warning' onclick='show_month_details()'>Unpaid</span>";
										}
									?>
								</td>
							</tr>
							<tr>
								<td Class='text-bold'>September</td>
								<td><?php 
									if($sep_fee1!='' && $sep_fee1!='N/A' && $sep_fee1!='n/a')
									{
										echo "<span class='label label-success'><i class='fa fa-rupee'></i> ".$fee_paid_details[5]."</span>";
									}
								?></td>
								<td>
									<?php
										if($sep_fee1!='' && $sep_fee1!='N/A' && $sep_fee1!='n/a'){
											?>
											<span  class='label label-success' title='Click for Download Recipet' onclick="download_recpt('<?php echo $sep_fee1; ?>')"><i class="fa fa-download" aria-hidden="true"></i> <?php echo $sep_fee1; ?></span>
											<?php
										}
										else{
											echo "<span class='label label-warning' onclick='show_month_details()'>Unpaid</span>";
										}
									?>
								</td>
							</tr>
							<tr>
								<td Class='text-bold'>October</td>
								<td><?php 
									if($oct_fee1!='' && $oct_fee1!='N/A' && $oct_fee1!='n/a')
									{
										echo "<span class='label label-success'><i class='fa fa-rupee'></i> ".$fee_paid_details[6]."</span>";
									}
								?></td>
								<td>
									<?php
										if($oct_fee1!='' && $oct_fee1!='N/A' && $oct_fee1!='n/a'){
											?>
											<span  class='label label-success' title='Click for Download Recipet' onclick="download_recpt('<?php echo $oct_fee1; ?>')"><i class="fa fa-download" aria-hidden="true"></i> <?php echo $oct_fee1; ?></span>
											<?php
										}
										else{
											echo "<span class='label label-warning' onclick='show_month_details()'>Unpaid</span>";
										}
									?>
								</td>
							</tr>
							<tr>
								<td Class='text-bold'>November</td>
								<td><?php 
									if($nov_fee1!='' && $nov_fee1!='N/A' && $nov_fee1!='n/a')
									{
										echo "<span class='label label-success'><i class='fa fa-rupee'></i> ".$fee_paid_details[7]."</span>";
									}
								?></td>
								<td>
									<?php
										if($nov_fee1!='' && $nov_fee1!='N/A' && $nov_fee1!='n/a'){
											?>
											<span  class='label label-success' title='Click for Download Recipet' onclick="download_recpt('<?php echo $nov_fee1; ?>')"><i class="fa fa-download" aria-hidden="true"></i> <?php echo $nov_fee1; ?></span>
											<?php
										}
										else{
											echo "<span class='label label-warning' onclick='show_month_details()'>Unpaid</span>";
										}
									?>
								</td>
							</tr>
							<tr>
								<td Class='text-bold'>December</td>
								<td><?php 
									if($dec_fee1!='' && $dec_fee1!='N/A' && $dec_fee1!='n/a')
									{
										echo "<span class='label label-success'><i class='fa fa-rupee'></i> ".$fee_paid_details[8]."</span>";
									}
								?></td>
								<td>
									<?php
										if($dec_fee1!='' && $dec_fee1!='N/A' && $dec_fee1!='n/a'){
											?>
											<span  class='label label-success' title='Click for Download Recipet' onclick="download_recpt('<?php echo $dec_fee1; ?>')"><i class="fa fa-download" aria-hidden="true"></i> <?php echo $dec_fee1; ?></span>
											<?php
										}
										else{
											echo "<span class='label label-warning' onclick='show_month_details()'>Unpaid</span>";
										}
									?>
								</td>
							</tr>
							<tr>
								<td Class='text-bold'>January</td>
								<td><?php 
									if($jan_fee1!='' && $jan_fee1!='N/A' && $jan_fee1!='n/a')
									{
										echo "<span class='label label-success'><i class='fa fa-rupee'></i> ".$fee_paid_details[9]."</span>";
									}
								?></td>
								<td>
									<?php
										if($jan_fee1!='' && $jan_fee1!='N/A' && $jan_fee1!='n/a'){
											?>
											<span  class='label label-success' title='Click for Download Recipet' onclick="download_recpt('<?php echo $jan_fee1; ?>')"><i class="fa fa-download" aria-hidden="true"></i> <?php echo $jan_fee1; ?></span>
											<?php
										}
										else{
											echo "<span class='label label-warning' onclick='show_month_details()'>Unpaid</span>";
										}
									?>
								</td>
							</tr>
							<tr>
								<td Class='text-bold'>February</td>
								<td><?php 
									if($feb_fee1!='' && $feb_fee1!='N/A' && $feb_fee1!='n/a')
									{
										echo "<span class='label label-success'><i class='fa fa-rupee'></i> ".$fee_paid_details[10]."</span>";
									}
								?></td>
								<td>
									<?php
										if($feb_fee1!='' && $feb_fee1!='N/A' && $feb_fee1!='n/a'){
											?>
											<span  class='label label-success' title='Click for Download Recipet' onclick="download_recpt('<?php echo $feb_fee1; ?>')"><i class="fa fa-download" aria-hidden="true"></i> <?php echo $feb_fee1; ?></span>
											<?php
										}
										else{
											echo "<span class='label label-warning' onclick='show_month_details()'>Unpaid</span>";
										}
									?>
								</td>
							</tr>
							<tr>
								<td Class='text-bold'>March</td>
								<td><?php 
									if($mar_fee1!='' && $mar_fee1!='N/A' && $mar_fee1!='n/a')
									{
										echo "<span class='label label-success'><i class='fa fa-rupee'></i> ".$fee_paid_details[11]."</span>";
									}
								?></td>
								<td>
									<?php
										if($mar_fee1!='' && $mar_fee1!='N/A' && $mar_fee1!='n/a'){
											?>
											<span  class='label label-success' title='Click for Download Recipet' onclick="download_recpt('<?php echo $mar_fee1; ?>')"><i class="fa fa-download" aria-hidden="true"></i> <?php echo $mar_fee1; ?></span>
											<?php
										}
										else{
											echo "<span class='label label-warning' onclick='show_month_details()'>Unpaid</span>";
										}
									?>
								</td>
							</tr>
							<tr>
								<td colspan='3'><center><button class='btn btn-success btn-sm' onclick='show_month_details()'>Pay Fee Online</button></center></td>
							</tr>
							<tr>
								<td colspan='3'><strong><i>Previous Year Dues Or partial Dues Will Be Added (If Any).</i></strong></td>
							</tr>
						</tbody>
					</table>
					
				</div>
              </div>
              <!-- /.tab-pane -->

            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade" id="modal-success">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style='background-image: linear-gradient(to right,#03709e,#18c3fd 100%);'>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="color:white; font-weight: bold;">Month Dues</h4>
              </div>
              <div class="modal-body">
			  <form action="<?php echo base_url('Online_paymentcalculation/show_student'); ?>" onsubmit="return validation()" method="POST">
				
				<div class="row">
				
				<div class='col-md-12 col-sm-12'>
					<p class='text-warning' style='font-size:18px;'>Please Tick Month For Payment</p>
				
			  </div>
				<?php
					$i=1;
					foreach($FEE as $key => $value){
						if($value == 'N/A' || $value == ''){
							?>
							<div class="col-sm-2 col-md-2 form-group">
								<label class="container"><?php echo $val[$key]; ?>
								<input type="checkbox" class="<?php echo $i; ?>" onchange="monthckechk()" name="<?php echo $id[$key]; ?>" value="<?php echo $val[$key]; ?>" id="<?php echo $id[$key]; ?>">
								<span class="checkmark"></span>
								</label>
							</div>
							<?php
							$i++;
						}
						
					}
				?>
				<div class='col-sm-12 col-md-12 form-group'>
				<p class='text-danger' id='flash' style='display:none'></p>
				<input type='hidden' id='ffm' name='ffm'>
				<input type='hidden' name='adm' id='adm' value='<?php echo $stu_adm; ?>'>
				<input type='hidden' name='parcial' id='parcial' value='<?php echo $parcial_dues_total; ?>'>
				<input type='hidden' name='pre_dues' id='pre_dues' value='<?php echo $pre_dues; ?>'>
				</div>
				<div class='col-sm-12 col-md-12 form-group'>
					<center><button style='font-size:16px;' class='btn btn-info btn-block btn-sm'>Pay Fee</button></center>
				</div>
				
			</div>
			
			</form>
                
              </div>
              <div class="modal-footer" style='background-image: linear-gradient(to right,#18c3fd,#03709e 100%);'>
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-outline">Save changes</button> -->
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
  <script>
  function validation(){
	  if($('.1').is(':checked'))
	  {
		  return true;
	  }else{
		  alert("Please Select Month");
		  return false;
	  }
  }
	function show_month_details(){
		$('#modal-success').modal();
	}
	function download_recpt(val){
		if(val=='FREESHIP' || val=='TC ISSUE' || val=='PAID' || val=='paid' || val=='tc issue' || val=='freeship'){
			alert('In This Month Your Child Has Fees Concession');
		}else{
			
			$.ajax({
			type: "POST",
			url: "<?php echo base_url('Parent_details/rect_download'); ?>",
			data: {rect_no:val},
			success:function(data){
				if(data==1){
					window.setTimeout(function() {
					window.location.href = '<?php echo base_url('Parent_details/report_data'); ?>';
						}, 1000);
				}
				else{
					alert('! Sorry No Data Found');
				}
				},
			});
		}
		
	}
	$('#fee_summary').addClass('active');
	$('#payment_details').addClass('active');
	function monthckechk()
	{
		var val1 = $('.1').val();
		if($('.1').is(':checked')){
			var count=parseInt(0);
		if($('#apr').is(':checked'))
		{
			if($('#apr').is(':checked'))
			{
				var apr = $("#apr").val();
				var space1 ="-";
				$("#ffm").val(apr);
				count++;
				$.ajax({
					url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
					type: "POST",
					data: $("#student_details").serialize(),
					success: function(data){
						$('#load_calulation').show(2000);
						$('#load_calulation').html(data);
						$('#get_details_p').hide(1000);
					}
				});
				$('#month_count').val(count);
				if($('#may').is(':checked'))
				{
					var may = $("#may").val();
					var space2 ="-";
					$("#ffm").val(apr+space1+may);
					count++;
					$.ajax({
					url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
					type: "POST",
					data: $("#student_details").serialize(),
					success: function(data){
						$('#load_calulation').show(2000);
						$('#load_calulation').html(data);
						$('#get_details_p').hide(1000);
					}
				});
					$('#month_count').val(count);
					if($('#jun').is(':checked'))
					{
						var jun = $("#jun").val();
						var space3 ="-";
						$("#ffm").val(apr+space1+may+space2+jun);
						count++;
						$.ajax({
					url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
					type: "POST",
					data: $("#student_details").serialize(),
					success: function(data){
						$('#load_calulation').show(2000);
						$('#load_calulation').html(data);
						$('#get_details_p').hide(1000);
					}
				});
						$('#month_count').val(count);
						if( $('#jul').is(':checked') )
						{
							var jul = $("#jul").val();
							var space4 ="-";
							$("#ffm").val(apr+space1+may+space2+jun+space3+jul);
							count++;
							$.ajax({
								url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
								type: "POST",
								data: $("#student_details").serialize(),
								success: function(data){
									$('#load_calulation').show(2000);
									$('#load_calulation').html(data);
									$('#get_details_p').hide(1000);
								}
							});
							$('#month_count').val(count);
							if($('#aug').is(':checked'))
							{
								var aug = $('#aug').val();
								var space5="-";
								$('#ffm').val(apr+space1+may+space2+jun+space3+jul+space4+aug);
								count++;
								$.ajax({
								url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
								type: "POST",
								data: $("#student_details").serialize(),
								success: function(data){
									$('#load_calulation').show(2000);
									$('#load_calulation').html(data);
									$('#get_details_p').hide(1000);
								}
							});
								$('#month_count').val(count);
								if($('#sep').is(':checked'))
								{
									var sep = $('#sep').val();
									var space6='-';
									$('#ffm').val(apr+space1+may+space2+jun+space3+jul+space4+aug+space5+sep);
									count++;
									$.ajax({
									url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
									type: "POST",
									data: $("#student_details").serialize(),
									success: function(data){
										$('#load_calulation').show(2000);
										$('#load_calulation').html(data);
										$('#get_details_p').hide(1000);
									}
								});
									$('#month_count').val(count);
									if($('#oct').is(':checked'))
									{
										var oct = $('#oct').val();
										var space7='-';
										$('#ffm').val(apr+space1+may+space2+jun+space3+jul+space4+aug+space5+sep+space6+oct);
										count++;
										$.ajax({
										url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
										type: "POST",
										data: $("#student_details").serialize(),
										success: function(data){
											$('#load_calulation').show(2000);
											$('#load_calulation').html(data);
											$('#get_details_p').hide(1000);
										}
									});
										$('#month_count').val(count);
										if($('#nov').is(':checked'))
										{
											var nov = $('#nov').val();
											var space8='-';
											$('#ffm').val(apr+space1+may+space2+jun+space3+jul+space4+aug+space5+sep+space6+oct+space7+nov);
											count++;
											$.ajax({
											url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
											type: "POST",
											data: $("#student_details").serialize(),
											success: function(data){
												$('#load_calulation').show(2000);
												$('#load_calulation').html(data);
												$('#get_details_p').hide(1000);
											}
										});
											$('#month_count').val(count);
											if( $('#dec').is(':checked') )
											{
												var dec = $('#dec').val();
												var space9='-';
												$('#ffm').val(apr+space1+may+space2+jun+space3+jul+space4+aug+space5+sep+space6+oct+space7+nov+space8+dec);
												count++;
												$.ajax({
												url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
												type: "POST",
												data: $("#student_details").serialize(),
												success: function(data){
													$('#load_calulation').show(2000);
													$('#load_calulation').html(data);
													$('#get_details_p').hide(1000);
												}
											});
												$('#month_count').val(count);
												if($('#jan').is(':checked'))
												{
													var jan = $('#jan').val();
													var space10='-';
													$('#ffm').val(apr+space1+may+space2+jun+space3+jul+space4+aug+space5+sep+space6+oct+space7+nov+space8+dec+space9+jan);
													count++;
													$.ajax({
												url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
												type: "POST",
												data: $("#student_details").serialize(),
												success: function(data){
													$('#load_calulation').show(2000);
													$('#load_calulation').html(data);
													$('#get_details_p').hide(1000);
												}
											});
													$('#month_count').val(count);
													if($('#feb').is(':checked'))
													{
														var feb = $('#feb').val();
														var space11='-';
														$('#ffm').val(apr+space1+may+space2+jun+space3+jul+space4+aug+space5+sep+space6+oct+space7+nov+space8+dec+space9+jan+space10+feb);
														count++;
														$.ajax({
													url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
													type: "POST",
													data: $("#student_details").serialize(),
													success: function(data){
														$('#load_calulation').show(2000);
														$('#load_calulation').html(data);
														$('#get_details_p').hide(1000);
													}
												});
														$('#month_count').val(count);
														if($('#mar').is(':checked') )
														{
															var mar = $('#mar').val();
															var space12='-';
															$('#ffm').val(apr+space1+may+space2+jun+space3+jul+space4+aug+space5+sep+space6+oct+space7+nov+space8+dec+space9+jan+space10+feb+space11+mar);
															count++
															$.ajax({
														url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
														type: "POST",
														data: $("#student_details").serialize(),
														success: function(data){
															$('#load_calulation').show(2000);
															$('#load_calulation').html(data);
															$('#get_details_p').hide(1000);
														}
													});
															$('#month_count').val(count);
															
														}
													}
													else
													{
														$('#mar').prop('checked',false);
													}
												}
												else
												{
													$('#feb').prop('checked',false);
													$('#mar').prop('checked',false);
												}
											}
											else
											{
												$('#jan').prop('checked',false);
												$('#feb').prop('checked',false);
												$('#mar').prop('checked',false);
											}
										}
										else
										{
											$('#dec').prop('checked',false);
											$('#jan').prop('checked',false);
											$('#feb').prop('checked',false);
											$('#mar').prop('checked',false);
										}
									}
									else
									{
										$('#nov').prop('checked',false);
										$('#dec').prop('checked',false);
										$('#jan').prop('checked',false);
										$('#feb').prop('checked',false);
										$('#mar').prop('checked',false);
									}
								}
								else
								{
									$('#oct').prop('checked',false);
									$('#nov').prop('checked',false);
									$('#dec').prop('checked',false);
									$('#jan').prop('checked',false);
									$('#feb').prop('checked',false);
									$('#mar').prop('checked',false);
								}
							}
							else
							{
								$('#sep').prop('checked',false);
								$('#oct').prop('checked',false);
								$('#nov').prop('checked',false);
								$('#dec').prop('checked',false);
								$('#jan').prop('checked',false);
								$('#feb').prop('checked',false);
								$('#mar').prop('checked',false);
							}
						}
						else
						{
							$('#aug').prop('checked',false);
							$('#sep').prop('checked',false);
							$('#oct').prop('checked',false);
							$('#nov').prop('checked',false);
							$('#dec').prop('checked',false);
							$('#jan').prop('checked',false);
							$('#feb').prop('checked',false);
							$('#mar').prop('checked',false);
						}
					}
					else
					{
						$('#jul').prop('checked',false);
						$('#aug').prop('checked',false);
						$('#sep').prop('checked',false);
						$('#oct').prop('checked',false);
						$('#nov').prop('checked',false);
						$('#dec').prop('checked',false);
						$('#jan').prop('checked',false);
						$('#feb').prop('checked',false);
						$('#mar').prop('checked',false);
					}
				}
				else
				{
					$('#jun').prop('checked',false);
					$('#jul').prop('checked',false);
					$('#aug').prop('checked',false);
					$('#sep').prop('checked',false);
					$('#oct').prop('checked',false);
					$('#nov').prop('checked',false);
					$('#dec').prop('checked',false);
					$('#jan').prop('checked',false);
					$('#feb').prop('checked',false);
					$('#mar').prop('checked',false);
				}
			
			}
			else
			{
				$('#may').prop('checked',false);
				$('#jun').prop('checked',false);
				$('#jul').prop('checked',false);
				$('#aug').prop('checked',false);
				$('#sep').prop('checked',false);
				$('#oct').prop('checked',false);
				$('#nov').prop('checked',false);
				$('#dec').prop('checked',false);
				$('#jan').prop('checked',false);
				$('#feb').prop('checked',false);
				$('#mar').prop('checked',false);
			}
		}
		else if($('#may').is(':checked'))
		{
			if($('#may').is(':checked'))
			{
				var may = $("#may").val();
				var space1 ="-";
				$("#ffm").val(may);
				count++;
				$.ajax({
					url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
					type: "POST",
					data: $("#student_details").serialize(),
					success: function(data){
						$('#load_calulation').show(2000);
						$('#load_calulation').html(data);
						$('#get_details_p').hide(1000);
					}
				});
				$('#month_count').val(count);
				if($('#jun').is(':checked'))
				{
					var jun = $('#jun').val();
					var space2 = '-';
					count++;
					$('#month_count').val(count);
					$('#ffm').val(may+space1+jun);
					$.ajax({
					url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
					type: "POST",
					data: $("#student_details").serialize(),
					success: function(data){
						$('#load_calulation').show(2000);
						$('#load_calulation').html(data);
						$('#get_details_p').hide(1000);
					}
				});
					
					if($('#jul').is(':checked'))
					{
						var jul = $('#jul').val();
						var space3 = '-';
						count++;
						$('#month_count').val(count);
						$('#ffm').val(may+space1+jun+space2+jul);
						$.ajax({
							url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
							type: "POST",
							data: $("#student_details").serialize(),
							success: function(data){
								$('#load_calulation').show(2000);
								$('#load_calulation').html(data);
								$('#get_details_p').hide(1000);
							}
						});
						
						if($('#aug').is(':checked'))
						{
							var aug = $('#aug').val();
							var space4 = '-';
							count++;
							$('#month_count').val(count);
							$('#ffm').val(may+space1+jun+space2+jul+space3+aug);
							$.ajax({
								url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
								type: "POST",
								data: $("#student_details").serialize(),
								success: function(data){
									$('#load_calulation').show(2000);
									$('#load_calulation').html(data);
									$('#get_details_p').hide(1000);
								}
							});
							
							if($('#sep').is(':checked'))
							{
								var sep = $('#sep').val();
								var space5 = '-';
								count++;
								$('#month_count').val(count);
								$('#ffm').val(may+space1+jun+space2+jul+space3+aug+space4+sep);
								$.ajax({
								url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
								type: "POST",
								data: $("#student_details").serialize(),
								success: function(data){
									$('#load_calulation').show(2000);
									$('#load_calulation').html(data);
									$('#get_details_p').hide(1000);
								}
							});
								if($('#oct').is(':checked'))
								{
									var oct = $('#oct').val();
									var space6 = '-';
									count++;
									$('#month_count').val(count);
									$('#ffm').val(may+space1+jun+space2+jul+space3+aug+space4+sep+space5+oct);
									$.ajax({
									url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
									type: "POST",
									data: $("#student_details").serialize(),
									success: function(data){
										$('#load_calulation').show(2000);
										$('#load_calulation').html(data);
										$('#get_details_p').hide(1000);
									}
								});
									if( $('#nov').is(':checked') )
									{
										var nov = $('#nov').val();
										var space7 ='-';
										count++;
										$('#month_count').val(count);
										$('#ffm').val(may+space1+jun+space2+jul+space3+aug+space4+sep+space5+oct+space6+nov);
										$.ajax({
										url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
										type: "POST",
										data: $("#student_details").serialize(),
										success: function(data){
											$('#load_calulation').show(2000);
											$('#load_calulation').html(data);
											$('#get_details_p').hide(1000);
										}
									});
										if( $('#dec').is(':checked') )
										{
											var dec = $('#dec').val();
											var space8 = '-';
											count++;
											$('#month_count').val(count);
											$('#ffm').val(may+space1+jun+space2+jul+space3+aug+space4+sep+space5+oct+space6+nov+space7+dec);
											$.ajax({
											url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
											type: "POST",
											data: $("#student_details").serialize(),
											success: function(data){
												$('#load_calulation').show(2000);
												$('#load_calulation').html(data);
												$('#get_details_p').hide(1000);
											}
										});
											if( $('#jan').is(':checked') )
											{
												var jan = $('#jan').val();
												var space9 = '-';
												count++;
												$('#month_count').val(count);
												$('#ffm').val(may+space1+jun+space2+jul+space3+aug+space4+sep+space5+oct+space6+nov+space7+dec+space8+jan);
												$.ajax({
												url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
												type: "POST",
												data: $("#student_details").serialize(),
												success: function(data){
													$('#load_calulation').show(2000);
													$('#load_calulation').html(data);
													$('#get_details_p').hide(1000);
												}
											});
												if( $('#feb').is(':checked') )
												{
													var feb = $('#feb').val();
													var space10 = '-';
													count++;
													$('#month_count').val(count);
													$('#ffm').val(may+space1+jun+space2+jul+space3+aug+space4+sep+space5+oct+space6+nov+space7+dec+space8+jan+space9+feb);
													$.ajax({
													url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
													type: "POST",
													data: $("#student_details").serialize(),
													success: function(data){
														$('#load_calulation').show(2000);
														$('#load_calulation').html(data);
														$('#get_details_p').hide(1000);
													}
												});
													if( $('#mar').is(':checked') )
													{
														var mar = $('#mar').val();
														var space11 = '-';
														count++;
														$('#month_count').val(count);
														$('#ffm').val(may+space1+jun+space2+jul+space3+aug+space4+sep+space5+oct+space6+nov+space7+dec+space8+jan+space9+feb+space10+mar);
														$.ajax({
													url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
													type: "POST",
													data: $("#student_details").serialize(),
													success: function(data){
														$('#load_calulation').show(2000);
														$('#load_calulation').html(data);
														$('#get_details_p').hide(1000);
													}
												});
													}
												}
												else{
													$('#mar').prop('checked',false);
												}
											}
											else
											{
												$('#feb').prop('checked',false);
												$('#mar').prop('checked',false);
											}
										}
										else
										{
											$('#jan').prop('checked',false);
											$('#feb').prop('checked',false);
											$('#mar').prop('checked',false);
										}
									}
									else
									{
										$('#dec').prop('checked',false);
										$('#jan').prop('checked',false);
										$('#feb').prop('checked',false);
										$('#mar').prop('checked',false);
									}
								}
								else{
									$('#nov').prop('checked',false);
									$('#dec').prop('checked',false);
									$('#jan').prop('checked',false);
									$('#feb').prop('checked',false);
									$('#mar').prop('checked',false);
								}
								
							}
							else
							{
								$('#oct').prop('checked',false);
								$('#nov').prop('checked',false);
								$('#dec').prop('checked',false);
								$('#jan').prop('checked',false);
								$('#feb').prop('checked',false);
								$('#mar').prop('checked',false);
							}
						}
						else
						{
							$('#sep').prop('checked',false);
							$('#oct').prop('checked',false);
							$('#nov').prop('checked',false);
							$('#dec').prop('checked',false);
							$('#jan').prop('checked',false);
							$('#feb').prop('checked',false);
							$('#mar').prop('checked',false);
						}
					}
					else
					{
						$('#aug').prop('checked',false);
						$('#sep').prop('checked',false);
						$('#oct').prop('checked',false);
						$('#nov').prop('checked',false);
						$('#dec').prop('checked',false);
						$('#jan').prop('checked',false);
						$('#feb').prop('checked',false);
						$('#mar').prop('checked',false);
					}
				}
				else
				{
					$('#jul').prop('checked',false);
					$('#aug').prop('checked',false);
					$('#sep').prop('checked',false);
					$('#oct').prop('checked',false);
					$('#nov').prop('checked',false);
					$('#dec').prop('checked',false);
					$('#jan').prop('checked',false);
					$('#feb').prop('checked',false);
					$('#mar').prop('checked',false);
				}
			}
			else
			{
				$('#jun').prop('checked',false);
				$('#jul').prop('checked',false);
				$('#aug').prop('checked',false);
				$('#sep').prop('checked',false);
				$('#oct').prop('checked',false);
				$('#nov').prop('checked',false);
				$('#dec').prop('checked',false);
				$('#jan').prop('checked',false);
				$('#feb').prop('checked',false);
				$('#mar').prop('checked',false);
			}
		}
		else if($('#jun').is(':checked'))
		{
			if($('#jun').is(':checked'))
			{
				var jun = $('#jun').val();
				var space1 = '-';
				count++;
				$('#month_count').val(count);
				$('#ffm').val(jun);
				$.ajax({
					url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
					type: "POST",
					data: $("#student_details").serialize(),
					success: function(data){
						$('#load_calulation').show(2000);
						$('#load_calulation').html(data);
						$('#get_details_p').hide(1000);
					}
				});
				if($('#jul').is(':checked'))
				{
					var jul = $('#jul').val();
					var space2='-';
					count++;
					$('#month_count').val(count);
					$('#ffm').val(jun+space1+jul);
					$.ajax({
						url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
						type: "POST",
						data: $("#student_details").serialize(),
						success: function(data){
							$('#load_calulation').show(2000);
							$('#load_calulation').html(data);
							$('#get_details_p').hide(1000);
						}
					});
					if($('#aug').is(':checked'))
					{
						var aug = $('#aug').val();
						var space3 = '-';
						count++
						$('#month_count').val(count);
						$('#ffm').val(jun+space1+jul+space2+aug);
						$.ajax({
							url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
							type: "POST",
							data: $("#student_details").serialize(),
							success: function(data){
								$('#load_calulation').show(2000);
								$('#load_calulation').html(data);
								$('#get_details_p').hide(1000);
							}
						});
						if($('#sep').is(':checked'))
						{
							var sep = $('#sep').val();
							var space4 = '-';
							count++
							$('#month_count').val(count);
							$('#ffm').val(jun+space1+jul+space2+aug+space3+sep);
							$.ajax({
								url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
								type: "POST",
								data: $("#student_details").serialize(),
								success: function(data){
									$('#load_calulation').show(2000);
									$('#load_calulation').html(data);
									$('#get_details_p').hide(1000);
								}
							});
							if($('#oct').is(':checked'))
							{
								var oct = $('#oct').val();
								var space5 = '-';
								count++;
								$('#month_count').val(count);
								$('#ffm').val(jun+space1+jul+space2+aug+space3+sep+space4+oct);
								$.ajax({
								url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
								type: "POST",
								data: $("#student_details").serialize(),
								success: function(data){
									$('#load_calulation').show(2000);
									$('#load_calulation').html(data);
									$('#get_details_p').hide(1000);
								}
							});
								if($('#nov').is(':checked'))
								{
									var nov = $('#nov').val();
									var space6 = '-';
									count++;
									$('#month_count').val(count);
									$('#ffm').val(jun+space1+jul+space2+aug+space3+sep+space4+oct+space5+nov);
									$.ajax({
									url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
									type: "POST",
									data: $("#student_details").serialize(),
									success: function(data){
										$('#load_calulation').show(2000);
										$('#load_calulation').html(data);
										$('#get_details_p').hide(1000);
									}
								});
									if($('#dec').is(':checked'))
									{
										var dec = $('#dec').val();
										var space7 = '-';
										count++;
										$('#month_count').val(count);
										$('#ffm').val(jun+space1+jul+space2+aug+space3+sep+space4+oct+space5+nov+space6+dec);
										$.ajax({
										url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
										type: "POST",
										data: $("#student_details").serialize(),
										success: function(data){
											$('#load_calulation').show(2000);
											$('#load_calulation').html(data);
											$('#get_details_p').hide(1000);
										}
									});
										if($('#jan').is(':checked'))
										{
											var jan = $('#jan').val();
											var space8 = '-';
											count++;
											$('#month_count').val(count);
											$('#ffm').val(jun+space1+jul+space2+aug+space3+sep+space4+oct+space5+nov+space6+dec+space7+jan);
											$.ajax({
											url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
											type: "POST",
											data: $("#student_details").serialize(),
											success: function(data){
												$('#load_calulation').show(2000);
												$('#load_calulation').html(data);
												$('#get_details_p').hide(1000);
											}
										});
											if($('#feb').is(':checked'))
											{
												var feb = $('#feb').val();
												var space9 = '-';
												count++;
												$('#month_count').val(count);
												$('#ffm').val(jun+space1+jul+space2+aug+space3+sep+space4+oct+space5+nov+space6+dec+space7+jan+space8+feb);
												$.ajax({
												url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
												type: "POST",
												data: $("#student_details").serialize(),
												success: function(data){
													$('#load_calulation').show(2000);
													$('#load_calulation').html(data);
													$('#get_details_p').hide(1000);
												}
											});
												if($('#mar').is(':checked'))
												{
													var mar = $('#mar').val();
													var space10 = '-';
													count++;
													$('#month_count').val(count);
													$('#ffm').val(jun+space1+jul+space2+aug+space3+sep+space4+oct+space5+nov+space6+dec+space7+jan+space8+feb+space9+mar);
													$.ajax({
												url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
												type: "POST",
												data: $("#student_details").serialize(),
												success: function(data){
													$('#load_calulation').show(2000);
													$('#load_calulation').html(data);
													$('#get_details_p').hide(1000);
												}
											});
												}
											}
											else
											{
												$('#mar').prop('checked',false);
											}
										}
										else
										{
											$('#feb').prop('checked',false);
											$('#mar').prop('checked',false);
										}
									}
									else
									{
										$('#jan').prop('checked',false);
										$('#feb').prop('checked',false);
										$('#mar').prop('checked',false);
									}
								}
								else
								{
									$('#dec').prop('checked',false);
									$('#jan').prop('checked',false);
									$('#feb').prop('checked',false);
									$('#mar').prop('checked',false);
								}
							}
							else
							{
								$('#nov').prop('checked',false);
								$('#dec').prop('checked',false);
								$('#jan').prop('checked',false);
								$('#feb').prop('checked',false);
								$('#mar').prop('checked',false);
							}
						}
						else
						{
							$('#oct').prop('checked',false);
							$('#nov').prop('checked',false);
							$('#dec').prop('checked',false);
							$('#jan').prop('checked',false);
							$('#feb').prop('checked',false);
							$('#mar').prop('checked',false);
						}
					}
					else
					{
						$('#sep').prop('checked',false);
						$('#oct').prop('checked',false);
						$('#nov').prop('checked',false);
						$('#dec').prop('checked',false);
						$('#jan').prop('checked',false);
						$('#feb').prop('checked',false);
						$('#mar').prop('checked',false);
					}
				}
				else
				{
					$('#aug').prop('checked',false);
					$('#sep').prop('checked',false);
					$('#oct').prop('checked',false);
					$('#nov').prop('checked',false);
					$('#dec').prop('checked',false);
					$('#jan').prop('checked',false);
					$('#feb').prop('checked',false);
					$('#mar').prop('checked',false);
				}
			}
			else
			{
				$('#jul').prop('checked',false);
				$('#aug').prop('checked',false);
				$('#sep').prop('checked',false);
				$('#oct').prop('checked',false);
				$('#nov').prop('checked',false);
				$('#dec').prop('checked',false);
				$('#jan').prop('checked',false);
				$('#feb').prop('checked',false);
				$('#mar').prop('checked',false);
			}
		}
		else if($('#jul').is(':checked'))
		{
			if($('#jul').is(':checked'))
			{
				var jul = $('#jul').val();
				var space1 = '-';
				count++;
				$('#month_count').val(count);
				$('#ffm').val(jul);
				$.ajax({
					url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
					type: "POST",
					data: $("#student_details").serialize(),
					success: function(data){
						$('#load_calulation').show(2000);
						$('#load_calulation').html(data);
						$('#get_details_p').hide(1000);
					}
				});
				if($('#aug').is(':checked'))
				{
					var aug  = $('#aug').val();
					var space2 = '-';
					count++;
					$('#month_count').val(count);
					$('#ffm').val(jul+space1+aug);
					$.ajax({
					url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
					type: "POST",
					data: $("#student_details").serialize(),
					success: function(data){
						$('#load_calulation').show(2000);
						$('#load_calulation').html(data);
						$('#get_details_p').hide(1000);
					}
				});
					if($('#sep').is(':checked'))
					{
						var sep = $('#sep').val();
						var space3 = '-';
						count++;
						$('#month_count').val(count);
						$('#ffm').val(jul+space1+aug+space2+sep);
						$.ajax({
							url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
							type: "POST",
							data: $("#student_details").serialize(),
							success: function(data){
								$('#load_calulation').show(2000);
								$('#load_calulation').html(data);
								$('#get_details_p').hide(1000);
							}
						});
						if($('#oct').is(':checked') )
						{
							var oct = $('#oct').val();
							var space4 = '-';
							count++;
							$('#month_count').val(count);
							$('#ffm').val(jul+space1+aug+space2+sep+space3+oct);
							$.ajax({
								url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
								type: "POST",
								data: $("#student_details").serialize(),
								success: function(data){
									$('#load_calulation').show(2000);
									$('#load_calulation').html(data);
									$('#get_details_p').hide(1000);
								}
							});
							if( $('#nov').is(':checked') )
							{
								var nov = $('#nov').val();
								var space5 = '-';
								count++;
								$('#month_count').val(count);
								$('#ffm').val(jul+space1+aug+space2+sep+space3+oct+space4+nov);
								$.ajax({
								url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
								type: "POST",
								data: $("#student_details").serialize(),
								success: function(data){
									$('#load_calulation').show(2000);
									$('#load_calulation').html(data);
									$('#get_details_p').hide(1000);
								}
							});
								if($('#dec').is(':checked'))
								{
									var dec = $('#dec').val();
									var space6 = '-';
									count++;
									$('#month_count').val(count);
									$('#ffm').val(jul+space1+aug+space2+sep+space3+oct+space4+nov+space5+dec);
									$.ajax({
									url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
									type: "POST",
									data: $("#student_details").serialize(),
									success: function(data){
										$('#load_calulation').show(2000);
										$('#load_calulation').html(data);
										$('#get_details_p').hide(1000);
									}
								});
									if($('#jan').is(':checked'))
									{
										var jan = $('#jan').val();
										var space7 = '-';
										count++;
										$('#month_count').val(count);
										$('#ffm').val(jul+space1+aug+space2+sep+space3+oct+space4+nov+space5+dec+space6+jan);
										$.ajax({
									url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
									type: "POST",
									data: $("#student_details").serialize(),
									success: function(data){
										$('#load_calulation').show(2000);
										$('#load_calulation').html(data);
										$('#get_details_p').hide(1000);
									}
								});
										if($('#feb').is(':checked'))
										{
											var feb = $('#feb').val();
											var space8 = '-';
											count++;
											$('#month_count').val(count);
											$('#ffm').val(jul+space1+aug+space2+sep+space3+oct+space4+nov+space5+dec+space6+jan+space7+feb);
											$.ajax({
											url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
											type: "POST",
											data: $("#student_details").serialize(),
											success: function(data){
												$('#load_calulation').show(2000);
												$('#load_calulation').html(data);
												$('#get_details_p').hide(1000);
											}
										});
											if($('#mar').is(':checked'))
											{
												var mar = $('#mar').val();
												var space9 = '-';
												count++;
												$('#month_count').val(count);
												$('#ffm').val(jul+space1+aug+space2+sep+space3+oct+space4+nov+space5+dec+space6+jan+space7+feb+space8+mar);
												$.ajax({
												url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
												type: "POST",
												data: $("#student_details").serialize(),
												success: function(data){
													$('#load_calulation').show(2000);
													$('#load_calulation').html(data);
													$('#get_details_p').hide(1000);
												}
											});
											}
										}
										else
										{
											$('#mar').prop('checked',false);
										}
									}
									else
									{
										$('#feb').prop('checked',false);
										$('#mar').prop('checked',false);
									}
								}
								else
								{
									$('#jan').prop('checked',false);
									$('#feb').prop('checked',false);
									$('#mar').prop('checked',false);
								}
							}
							else
							{
								$('#dec').prop('checked',false);
								$('#jan').prop('checked',false);
								$('#feb').prop('checked',false);
								$('#mar').prop('checked',false);
							}
						}
						else
						{
							$('#nov').prop('checked',false);
							$('#dec').prop('checked',false);
							$('#jan').prop('checked',false);
							$('#feb').prop('checked',false);
							$('#mar').prop('checked',false);
						}
					}
					else
					{
						$('#oct').prop('checked',false);
						$('#nov').prop('checked',false);
						$('#dec').prop('checked',false);
						$('#jan').prop('checked',false);
						$('#feb').prop('checked',false);
						$('#mar').prop('checked',false);
					}
				}
				else
				{
					$('#sep').prop('checked',false);
					$('#oct').prop('checked',false);
					$('#nov').prop('checked',false);
					$('#dec').prop('checked',false);
					$('#jan').prop('checked',false);
					$('#feb').prop('checked',false);
					$('#mar').prop('checked',false);
				}
			}
			else
			{
				$('#aug').prop('checked',false);
				$('#sep').prop('checked',false);
				$('#oct').prop('checked',false);
				$('#nov').prop('checked',false);
				$('#dec').prop('checked',false);
				$('#jan').prop('checked',false);
				$('#feb').prop('checked',false);
				$('#mar').prop('checked',false);
			}
		}
		else if($('#aug').is(':checked'))
		{
			if($('#aug').is(':checked'))
			{
				var aug = $('#aug').val();
				var space1  = '-';
				count++;
				$('#month_count').val(count);
				$('#ffm').val(aug);
				$.ajax({
					url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
					type: "POST",
					data: $("#student_details").serialize(),
					success: function(data){
						$('#load_calulation').show(2000);
						$('#load_calulation').html(data);
						$('#get_details_p').hide(1000);
					}
				});
				if($('#sep').is(':checked'))
				{
					var sep = $('#sep').val();
					var space2 = '-';
					count++;
					$('#month_count').val(count);
					$('#ffm').val(aug+space1+sep);
					$.ajax({
					url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
					type: "POST",
					data: $("#student_details").serialize(),
					success: function(data){
						$('#load_calulation').show(2000);
						$('#load_calulation').html(data);
						$('#get_details_p').hide(1000);
					}
				});
					if($('#oct').is(':checked'))
					{
						var oct = $('#oct').val();
						var space3 = '-';
						count++;
						$('#month_count').val(count);
						$('#ffm').val(aug+space1+sep+space2+oct);
						$.ajax({
							url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
							type: "POST",
							data: $("#student_details").serialize(),
							success: function(data){
								$('#load_calulation').show(2000);
								$('#load_calulation').html(data);
								$('#get_details_p').hide(1000);
							}
						});
						if($('#nov').is(':checked'))
						{
							var nov = $('#nov').val();
							var space4 = '-';
							count++;
							$('#month_count').val(count);
							$('#ffm').val(aug+space1+sep+space2+oct+space3+nov);
							$.ajax({
								url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
								type: "POST",
								data: $("#student_details").serialize(),
								success: function(data){
									$('#load_calulation').show(2000);
									$('#load_calulation').html(data);
									$('#get_details_p').hide(1000);
								}
							});
							if($('#dec').is(':checked'))
							{
								var dec = $('#dec').val();
								var space5 = '-';
								count++;
								$('#month_count').val(count);
								$('#ffm').val(aug+space1+sep+space2+oct+space3+nov+space4+dec);
								$.ajax({
									url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
									type: "POST",
									data: $("#student_details").serialize(),
									success: function(data){
										$('#load_calulation').show(2000);
										$('#load_calulation').html(data);
										$('#get_details_p').hide(1000);
									}
								});
								if($('#jan').is(':checked'))
								{
									var jan = $('#jan').val();
									var space6 = '-';
									count++;
									$('#month_count').val(count);
									$('#ffm').val(aug+space1+sep+space2+oct+space3+nov+space4+dec+space5+jan);
									$.ajax({
										url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
										type: "POST",
										data: $("#student_details").serialize(),
										success: function(data){
											$('#load_calulation').show(2000);
											$('#load_calulation').html(data);
											$('#get_details_p').hide(1000);
										}
									});
									if($('#feb').is(':checked'))
									{
										var feb  = $('#feb').val();
										var space7 = '-';
										count++;
										$('#month_count').val(count);
										$('#ffm').val(aug+space1+sep+space2+oct+space3+nov+space4+dec+space5+jan+space6+feb);
										$.ajax({
											url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
											type: "POST",
											data: $("#student_details").serialize(),
											success: function(data){
												$('#load_calulation').show(2000);
												$('#load_calulation').html(data);
												$('#get_details_p').hide(1000);
											}
										});
										if($('#mar').is(':checked'))
										{
											var mar = $('#mar').val();
											var space8 = '-';
											count++;
											$('#month_count').val(count);
											$('#ffm').val(aug+space1+sep+space2+oct+space3+nov+space4+dec+space5+jan+space6+feb+space7+mar);
											$.ajax({
												url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
												type: "POST",
												data: $("#student_details").serialize(),
												success: function(data){
													$('#load_calulation').show(2000);
													$('#load_calulation').html(data);
													$('#get_details_p').hide(1000);
												}
											});
										}
									}
									else
									{
										$('#mar').prop('checked',false);
									}
								}
								else
								{
									$('#feb').prop('checked',false);
									$('#mar').prop('checked',false);
								}
							}
							else
							{
								$('#jan').prop('checked',false);
								$('#feb').prop('checked',false);
								$('#mar').prop('checked',false);
							}
						}
						else
						{
							$('#dec').prop('checked',false);
							$('#jan').prop('checked',false);
							$('#feb').prop('checked',false);
							$('#mar').prop('checked',false);
						}
						
					}
					else
					{
						$('#nov').prop('checked',false);
						$('#dec').prop('checked',false);
						$('#jan').prop('checked',false);
						$('#feb').prop('checked',false);
						$('#mar').prop('checked',false);
					}
				}
				else
				{
					$('#oct').prop('checked',false);
					$('#nov').prop('checked',false);
					$('#dec').prop('checked',false);
					$('#jan').prop('checked',false);
					$('#feb').prop('checked',false);
					$('#mar').prop('checked',false);
				}
			}
			else
			{
				$('#sep').prop('checked',false);
				$('#oct').prop('checked',false);
				$('#nov').prop('checked',false);
				$('#dec').prop('checked',false);
				$('#jan').prop('checked',false);
				$('#feb').prop('checked',false);
				$('#mar').prop('checked',false);
			}
		}
		else if($('#sep').is(':checked'))
		{
			if($('#sep').is(':checked'))
			{
				var sep = $('#sep').val();
				var space1 = '-';
				count++;
				$('#month_count').val(count);
				$('#ffm').val(sep);
				$.ajax({
					url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
					type: "POST",
					data: $("#student_details").serialize(),
					success: function(data){
						$('#load_calulation').show(2000);
						$('#load_calulation').html(data);
						$('#get_details_p').hide(1000);
					}
				});
				if($('#oct').is(':checked'))
				{
					var oct = $('#oct').val();
					var space2 = '-';
					count++;
					$('#month_count').val(count);
					$('#ffm').val(sep+space1+oct);
					$.ajax({
						url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
						type: "POST",
						data: $("#student_details").serialize(),
						success: function(data){
							$('#load_calulation').show(2000);
							$('#load_calulation').html(data);
							$('#get_details_p').hide(1000);
						}
					});
					if($('#nov').is(':checked'))
					{
						var nov  = $('#nov').val();
						var space3 = '-';
						count++;
						$('#month_count').val(count);
						$('#ffm').val(sep+space1+oct+space2+nov);
						$.ajax({
							url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
							type: "POST",
							data: $("#student_details").serialize(),
							success: function(data){
								$('#load_calulation').show(2000);
								$('#load_calulation').html(data);
								$('#get_details_p').hide(1000);
							}
						});
						if($('#dec').is(':checked'))
						{
							var dec = $('#dec').val();
							var space4 = '-';
							count++;
							$('#month_count').val(count);
							$('#ffm').val(sep+space1+oct+space2+nov+space3+dec);
							$.ajax({
								url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
								type: "POST",
								data: $("#student_details").serialize(),
								success: function(data){
									$('#load_calulation').show(2000);
									$('#load_calulation').html(data);
									$('#get_details_p').hide(1000);
								}
							});
							if($('#jan').is(':checked'))
							{
								var jan = $('#jan').val();
								var space5 = '-';
								count++;
								$('#month_count').val(count);
								$('#ffm').val(sep+space1+oct+space2+nov+space3+dec+space4+jan);
								$.ajax({
									url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
									type: "POST",
									data: $("#student_details").serialize(),
									success: function(data){
										$('#load_calulation').show(2000);
										$('#load_calulation').html(data);
										$('#get_details_p').hide(1000);
									}
								});
								if($('#feb').is(':checked'))
								{
									var feb = $('#feb').val();
									var space6 = '-';
									count++;
									$('#month_count').val(count);
									$('#ffm').val(sep+space1+oct+space2+nov+space3+dec+space4+jan+space5+feb);
									$.ajax({
										url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
										type: "POST",
										data: $("#student_details").serialize(),
										success: function(data){
											$('#load_calulation').show(2000);
											$('#load_calulation').html(data);
											$('#get_details_p').hide(1000);
										}
									});
									if($('#mar').is(':checked'))
									{
										var mar = $('#mar').val();
										var space7 = '-';
										count++;
										$('#month_count').val(count);
										$('#ffm').val(sep+space1+oct+space2+nov+space3+dec+space4+jan+space5+feb+space6+mar);
										$.ajax({
										url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
										type: "POST",
										data: $("#student_details").serialize(),
										success: function(data){
											$('#load_calulation').show(2000);
											$('#load_calulation').html(data);
											$('#get_details_p').hide(1000);
										}
									});
									}
								}
								else
								{
									$('#mar').prop('checked',false);
								}
							}
							else
							{
								$('#feb').prop('checked',false);
								$('#mar').prop('checked',false);
							}
						}
						else
						{
							$('#jan').prop('checked',false);
							$('#feb').prop('checked',false);
							$('#mar').prop('checked',false);
						}
					}
					else
					{
						$('#dec').prop('checked',false);
						$('#jan').prop('checked',false);
						$('#feb').prop('checked',false);
						$('#mar').prop('checked',false);
					}
					
				}
				else
				{
					$('#nov').prop('checked',false);
					$('#dec').prop('checked',false);
					$('#jan').prop('checked',false);
					$('#feb').prop('checked',false);
					$('#mar').prop('checked',false);
				}
			}
			else
			{
				$('#oct').prop('checked',false);
				$('#nov').prop('checked',false);
				$('#dec').prop('checked',false);
				$('#jan').prop('checked',false);
				$('#feb').prop('checked',false);
				$('#mar').prop('checked',false);
			}
		}
		else if($('#oct').is(':checked'))
		{
			if($('#oct').is(':checked'))
			{
				var oct = $('#oct').val();
				var space1 = '-';
				count++;
				$('#month_count').val(count);
				$('#ffm').val(oct);
				$.ajax({
					url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
					type: "POST",
					data: $("#student_details").serialize(),
					success: function(data){
						$('#load_calulation').show(2000);
						$('#load_calulation').html(data);
						$('#get_details_p').hide(1000);
					}
				});
				if($('#nov').is(':checked'))
				{
					var nov = $('#nov').val();
					var space2 = '-';
					count++;
					$('#month_count').val(count);
					$('#ffm').val(oct+space1+nov);
					$.ajax({
						url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
						type: "POST",
						data: $("#student_details").serialize(),
						success: function(data){
							$('#load_calulation').show(2000);
							$('#load_calulation').html(data);
							$('#get_details_p').hide(1000);
						}
					});
					if($('#dec').is(':checked'))
					{
						var dec = $('#dec').val();
						var space3 = '-';
						count++;
						$('#month_count').val(count);
						$('#ffm').val(oct+space1+nov+space2+dec);
						$.ajax({
							url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
							type: "POST",
							data: $("#student_details").serialize(),
							success: function(data){
								$('#load_calulation').show(2000);
								$('#load_calulation').html(data);
								$('#get_details_p').hide(1000);
							}
						});
						if($('#jan').is(':checked'))
						{
							var jan = $('#jan').val();
							var space4 = '-';
							count++;
							$('#month_count').val(count);
							$('#ffm').val(oct+space1+nov+space2+dec+space3+jan);
							$.ajax({
								url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
								type: "POST",
								data: $("#student_details").serialize(),
								success: function(data){
									$('#load_calulation').show(2000);
									$('#load_calulation').html(data);
									$('#get_details_p').hide(1000);
								}
							});
							if($('#feb').is(':checked'))
							{
								var feb = $('#feb').val();
								var space5 = '-';
								count++;
								$('#month_count').val(count);
								$('#ffm').val(oct+space1+nov+space2+dec+space3+jan+space4+feb);
								$.ajax({
									url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
									type: "POST",
									data: $("#student_details").serialize(),
									success: function(data){
										$('#load_calulation').show(2000);
										$('#load_calulation').html(data);
										$('#get_details_p').hide(1000);
									}
								});
								if($('#mar').is(':checked'))
								{
									var mar = $('#mar').val();
									var space6 = '-';
									count++;
									$('#month_count').val(count);
									$('#ffm').val(oct+space1+nov+space2+dec+space3+jan+space4+feb+space5+mar);
									$.ajax({
									url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
									type: "POST",
									data: $("#student_details").serialize(),
									success: function(data){
										$('#load_calulation').show(2000);
										$('#load_calulation').html(data);
										$('#get_details_p').hide(1000);
									}
								});
								}
							}
							else
							{
								$('#mar').prop('checked',false);
							}
						}
						else
						{
							$('#feb').prop('checked',false);
							$('#mar').prop('checked',false);
						}
					}
					else
					{
						$('#jan').prop('checked',false);
						$('#feb').prop('checked',false);
						$('#mar').prop('checked',false);
					}
				}
				else
				{
					$('#dec').prop('checked',false);
					$('#jan').prop('checked',false);
					$('#feb').prop('checked',false);
					$('#mar').prop('checked',false);
				}
			}
			else
			{
				$('#nov').prop('checked',false);
				$('#dec').prop('checked',false);
				$('#jan').prop('checked',false);
				$('#feb').prop('checked',false);
				$('#mar').prop('checked',false);
			}
		}
		else if($('#nov').is(':checked'))
		{
			if($('#nov').is(':checked'))
			{
				var nov = $('#nov').val();
				var space1 = '-';
				count++;
				$('#month_count').val(count);
				$('#ffm').val(nov);
				$.ajax({
					url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
					type: "POST",
					data: $("#student_details").serialize(),
					success: function(data){
						$('#load_calulation').show(2000);
						$('#load_calulation').html(data);
						$('#get_details_p').hide(1000);
					}
				});
				if($('#dec').is(':checked'))
				{
					var dec = $('#dec').val();
					var space2 = '-';
					count++;
					$('#month_count').val(count);
					$('#ffm').val(nov+space1+dec);
					$.ajax({
					url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
					type: "POST",
					data: $("#student_details").serialize(),
					success: function(data){
						$('#load_calulation').show(2000);
						$('#load_calulation').html(data);
						$('#get_details_p').hide(1000);
					}
				});
					if($('#jan').is(':checked'))
					{
						var jan = $('#jan').val();
						var space3 = '-';
						count++;
						$('#month_count').val(count);
						$('#ffm').val(nov+space1+dec+space2+jan);
						$.ajax({
							url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
							type: "POST",
							data: $("#student_details").serialize(),
							success: function(data){
								$('#load_calulation').show(2000);
								$('#load_calulation').html(data);
								$('#get_details_p').hide(1000);
							}
						});
						if($('#feb').is(':checked'))
						{
							var feb = $('#feb').val();
							var space4 = '-';
							count++;
							$('#month_count').val(count);
							$('#ffm').val(nov+space1+dec+space2+jan+space3+feb);
							$.ajax({
								url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
								type: "POST",
								data: $("#student_details").serialize(),
								success: function(data){
									$('#load_calulation').show(2000);
									$('#load_calulation').html(data);
									$('#get_details_p').hide(1000);
								}
							});
							if($('#mar').is(':checked'))
							{
								var mar = $('#mar').val();
								var space5 = '-';
								count++;
								$('#month_count').val(count);
								$('#ffm').val(nov+space1+dec+space2+jan+space3+feb+space4+mar);
								$.ajax({
								url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
								type: "POST",
								data: $("#student_details").serialize(),
								success: function(data){
									$('#load_calulation').show(2000);
									$('#load_calulation').html(data);
									$('#get_details_p').hide(1000);
								}
							});
							}
						}
						else
						{
							$('#mar').prop('checked',false);
						}
					}
					else
					{
						$('#feb').prop('checked',false);
						$('#mar').prop('checked',false);
					}
				}
				else
				{
					$('#jan').prop('checked',false);
					$('#feb').prop('checked',false);
					$('#mar').prop('checked',false);
				}
			}
			else
			{
				$('#dec').prop('checked',false);
				$('#jan').prop('checked',false);
				$('#feb').prop('checked',false);
				$('#mar').prop('checked',false);
			}
		}
		else if($('#dec').is(':checked'))
		{
			if($('#dec').is(':checked'))
			{
				var dec = $('#dec').val();
				var space1 = '-';
				count++;
				$('#month_count').val(count);
				$('#ffm').val(dec);
				$.ajax({
					url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
					type: "POST",
					data: $("#student_details").serialize(),
					success: function(data){
						$('#load_calulation').show(2000);
						$('#load_calulation').html(data);
						$('#get_details_p').hide(1000);
					}
				});
				if($('#jan').is(':checked'))
				{
					var jan = $('#jan').val();
					var space2 = '-';
					count++;
					$('#month_count').val(count);
					$('#ffm').val(dec+space1+jan);
					$.ajax({
						url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
						type: "POST",
						data: $("#student_details").serialize(),
						success: function(data){
							$('#load_calulation').show(2000);
							$('#load_calulation').html(data);
							$('#get_details_p').hide(1000);
						}
					});
					if($('#feb').is(':checked'))
					{
						var feb = $('#feb').val();
						var space3 = '-';
						count++;
						$('#month_count').val(count);
						$('#ffm').val(dec+space1+jan+space2+feb);
						$.ajax({
							url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
							type: "POST",
							data: $("#student_details").serialize(),
							success: function(data){
								$('#load_calulation').show(2000);
								$('#load_calulation').html(data);
								$('#get_details_p').hide(1000);
							}
						});
						if($('#mar').is(':checked'))
						{
							var mar = $('#mar').val();
							var space4 = '-';
							count++;
							$('#month_count').val(count);
							$('#ffm').val(dec+space1+jan+space2+feb+space3+mar);
							$.ajax({
							url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
							type: "POST",
							data: $("#student_details").serialize(),
							success: function(data){
								$('#load_calulation').show(2000);
								$('#load_calulation').html(data);
								$('#get_details_p').hide(1000);
							}
						});
						}
					}
					else{
						$('#mar').prop('checked',false);
					}
				}
				else
				{
					$('#feb').prop('checked',false);
					$('#mar').prop('checked',false);
				}
			}
			else
			{
				$('#jan').prop('checked',false);
				$('#feb').prop('checked',false);
				$('#mar').prop('checked',false);
			}
		}
		else if($('#jan').is(':checked'))
		{
			if($('#jan').is(':checked'))
			{
				var jan = $('#jan').val();
				var space1 = '-';
				count++;
				$('#month_count').val(count);
				$('#ffm').val(jan);
				$.ajax({
					url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
					type: "POST",
					data: $("#student_details").serialize(),
					success: function(data){
						$('#load_calulation').show(2000);
						$('#load_calulation').html(data);
						$('#get_details_p').hide(1000);
					}
				});
				if($('#feb').is(':checked'))
				{
					var feb = $('#feb').val();
					var space2 = '-';
					count++;
					$('#month_count').val(count);
					$('#ffm').val(jan+space1+feb);
					$.ajax({
						url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
						type: "POST",
						data: $("#student_details").serialize(),
						success: function(data){
							$('#load_calulation').show(2000);
							$('#load_calulation').html(data);
							$('#get_details_p').hide(1000);
						}
					});
					if($('#mar').is(':checked'))
					{
						var mar = $('#mar').val();
						var space3 = '-';
						count++;
						$('#month_count').val(count);
						$('#ffm').val(jan+space1+feb+space2+mar);
						$.ajax({
						url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
						type: "POST",
						data: $("#student_details").serialize(),
						success: function(data){
							$('#load_calulation').show(2000);
							$('#load_calulation').html(data);
							$('#get_details_p').hide(1000);
						}
					});
					}
				}
				else{
					$('#mar').prop('checked',false);
				}
			}
			else{
				$('#feb').prop('checked',false);
				$('#mar').prop('checked',false);
			}
		}
		else if($('#feb').is(':checked'))
		{
			if($('#feb').is(':checked'))
			{
				var feb = $('#feb').val();
				var space1 = '-';
				count++;
				$('#month_count').val(count);
				$('#ffm').val(feb);
				$.ajax({
					url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
					type: "POST",
					data: $("#student_details").serialize(),
					success: function(data){
						$('#load_calulation').show(2000);
						$('#load_calulation').html(data);
						$('#get_details_p').hide(1000);
					}
				});
				if($('#mar').is(':checked'))
				{
					var mar = $('#mar').val();
					var space2 = '-';
					count++;
					$('#month_count').val(count);
					$('#ffm').val(feb+space1+mar);
					$.ajax({
					url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
					type: "POST",
					data: $("#student_details").serialize(),
					success: function(data){
						$('#load_calulation').show(2000);
						$('#load_calulation').html(data);
						$('#get_details_p').hide(1000);
					}
				});
				}
				
			}
			else
			{
				$('#mar').prop('checked',false);
			}
		}
		else if($('#mar').is(':checked'))
		{
			if($('#mar').is(':checked'))
			{
				var mar = $('#mar').val();
				count++
				$('#month_count').val(count);
				$('#ffm').val(mar);
				$.ajax({
					url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
					type: "POST",
					data: $("#student_details").serialize(),
					success: function(data){
						$('#load_calulation').show(2000);
						$('#load_calulation').html(data);
						$('#get_details_p').hide(1000);
					}
				});
			}
		}
		else
		{
			$('#month_count').val('');
			$('#ffm').val('');
		}
		if($('#apr').is(':checked') || $('#may').is(':checked') || $('#jun').is(':checked') || $('#jul').is(':checked') || $('#aug').is(':checked') || $('#sep').is(':checked') || $('#oct').is(':checked') || $('#nov').is(':checked') || $('#dec').is(':checked') || $('#jan').is(':checked') || $('#feb').is(':checked') || $('#mar').is(':checked')){
		}
	else
	{
		alert('Please Select Unpaid Month');
		$('#load_calulation').hide(2000);
		return false;
	}
			
		}else{
			alert("Please Select "+val1+" First");
			$('#load_calulation').hide(2000);
			$("#ffm").val("");
			$("#month_count").val("");
			$('.1').prop('checked',false);
			$('.2').prop('checked',false);
			$('.3').prop('checked',false);
			$('.4').prop('checked',false);
			$('.5').prop('checked',false);
			$('.6').prop('checked',false);
			$('.7').prop('checked',false);
			$('.8').prop('checked',false);
			$('.9').prop('checked',false);
			$('.10').prop('checked',false);
			$('.11').prop('checked',false);
			$('.12').prop('checked',false);
			return false;
			
		}
		
	}
  </script>
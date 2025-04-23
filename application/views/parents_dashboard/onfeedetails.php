  <?php
  error_reporting(0);
	if($student_details){
		$stu_img = $student_details->student_image;
		$stu_name = $student_details->FIRST_NM;
		$stu_adm = $student_details->ADM_NO;
		$stu_iddd = $student_details->STUDENTID;
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
		  <p></p>
		</h1><br>
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
						<input type='hidden' name='pree' id='pree' value='<?php echo $pre_dues; ?>'>
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
						<?php
					if($pre_dues>0){
						$dis = 'disabled';
						?>
						<button type="button" class="btn btn-warning pull-right" onclick="pageRedirect()" >Pay Previous Dues</button>
						<?php
					}
						else{
						   $dis = '';
						}
				?>
						<caption style="font-size:18px;" class='text-info text-center'><b></b></caption>
						<thead>
							<tr>
								<th class='th'>Month</th>
								<th class='th'>Paid Amount ( <i class='fa fa-rupee'></i> )</th>
								<th class='th'>Paid Status</th>
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
								<td colspan='3'><center><button class='btn btn-success btn-sm' onclick='show_month_details()'>PAY FEE</button></center></td>
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
			  <form action="<?php echo base_url('Online_paymentcal/show_student'); ?>" onsubmit="return validation()" method="POST">
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
							<label><input type="checkbox" class="chkboxx" onchange="monthckechk(<?php echo $i?>)" name="chkbox[]" id="chkbox_<?php echo $i?>" disabled value="<?php echo $key+1; ?>" >&nbsp;<?php echo $val[$key]; ?></label>
							
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
					<center><input type="submit" name="save" value="PAY FEE" style='font-size:16px;' class='btn btn-info btn-block btn-sm'></center>
				</div>
				
			</div>
			
			</form>
                
              </div>
              <div class="modal-footer" style='background-image: linear-gradient(to right,#18c3fd,#03709e 100%);'>
                
				  <button type="button" class="btn btn-outline pull-right" onclick='clos()' data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-outline">Save changes</button> -->
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
  <script>
	 function pageRedirect() {
      window.location.href='<?php echo base_url('Onparent_details/pre_details/'."$stu_iddd"); ?>';
    } 
	  
	  
	 function clos(){
	
	 $('input[type="checkbox"]').not(this).prop("checked", false);
	 //$('input[type="checkbox"]').not(this).prop("disabled", true);
		//$("#ffm").val('');
		$("#chkbox_1").prop('disabled',false);
		$("#chkbox_2").prop('disabled',true);
		$("#chkbox_3").prop('disabled',true);
		$("#chkbox_4").prop('disabled',true);
		$("#chkbox_5").prop('disabled',true);
		$("#chkbox_6").prop('disabled',true);
		$("#chkbox_7").prop('disabled',true);
		$("#chkbox_8").prop('disabled',true);
		$("#chkbox_9").prop('disabled',true);
		$("#chkbox_10").prop('disabled',true);
		$("#chkbox_11").prop('disabled',true);
		$("#chkbox_12").prop('disabled',true);
 }

						
       function validation(){
	  if($('#chkbox_1').is(':checked'))
	  {
		  return true;
	  }else{
		  alert("Please Select Month");
		  return false;
	  }
  }
	  $("#chkbox_1").prop('disabled',false);
	  
	  function monthckechk(val)
	{
		var chkbox = $("#chkbox_"+val).prop('checked') ? 1: 0;
		if(chkbox == 1){
			var next = val + 1;
			$("#chkbox_"+next).prop('disabled',false);
		}else{
			var next = val + 1;
			var next1 = val + 2;
			var next2 = val + 3;
			var next3 = val + 4;
			var next4 = val + 5;
			var next5 = val + 6;
			var next6 = val + 7;
			var next7 = val + 8;
			var next8 = val + 9;
			var next9 = val + 10;
			var next10 = val + 11;
			var next11 = val + 12;
			$("#chkbox_"+next).prop('disabled',true);
			$("#chkbox_"+next).prop('checked',false);
			
			$("#chkbox_"+next1).prop('disabled',true);
			$("#chkbox_"+next1).prop('checked',false);
			
			$("#chkbox_"+next2).prop('disabled',true);
			$("#chkbox_"+next2).prop('checked',false);
			
			$("#chkbox_"+next3).prop('disabled',true);
			$("#chkbox_"+next3).prop('checked',false);
			
			$("#chkbox_"+next4).prop('disabled',true);
			$("#chkbox_"+next4).prop('checked',false);
			
			$("#chkbox_"+next5).prop('disabled',true);
			$("#chkbox_"+next5).prop('checked',false);
			
			$("#chkbox_"+next6).prop('disabled',true);
			$("#chkbox_"+next6).prop('checked',false);
			
			$("#chkbox_"+next7).prop('disabled',true);
			$("#chkbox_"+next7).prop('checked',false);
			
			$("#chkbox_"+next8).prop('disabled',true);
			$("#chkbox_"+next8).prop('checked',false);
			
			$("#chkbox_"+next9).prop('disabled',true);
			$("#chkbox_"+next9).prop('checked',false);
			
			$("#chkbox_"+next10).prop('disabled',true);
			$("#chkbox_"+next10).prop('checked',false);
			
			$("#chkbox_"+next11).prop('disabled',true);
			$("#chkbox_"+next11).prop('checked',false);
		}
	}
	function show_month_details(){
			var pree_du = $('#pree').val();	
						
		if(pree_du>0)
		{
			alert('Please pay your previous dues!!!');		
		}
		else
		{
			$('#modal-success').modal();			
		}				
		
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
	
  </script>
  <?php
  error_reporting(0);
	if($student_details){
		$stu_img = $student_details[0]->student_image;
		$stu_name = $student_details[0]->FIRST_NM;
		$stu_adm = $student_details[0]->ADM_NO;
		$stu_roll = $student_details[0]->ROLL_NO;
		$stu_class = $student_details[0]->DISP_CLASS;
		$stu_sec = $student_details[0]->DISP_SEC;
	}
	IF($ffm){
		$ffm;
	}
	IF($total_previous_dues > 0){
		$ffml = "PRE.DUES-".$ffm;
	}
	else{
		$ffml = $ffm;
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
        <li><a href="#">Payment Details</a></li>
        <li class="active">Payment Summary</li>
      </ol>
    </section>
		
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php 
			    if($stu_img == null){
					echo base_url('assets/student_photo/default.jpg');
				}else{
					echo base_url($stu_img);
				}
			  ?>" alt="User profile picture">

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
              <li class="active"><a href="#activity" data-toggle="tab">Payment Details</a></li>
            </ul>
            <div class="tab-content">
            <div class="active tab-pane" id="activity">
			<form method="POST" action="<?php echo base_url('Online_pay/onlinePayment'); ?>">
                <ul class="list-group list-group-unbordered">
					<li class="list-group-item">
                  <b>FEE DETAILS</b> <a class="pull-right"><i class="fa fa-rupee pull-right"></i>&nbsp;&nbsp;</a>
                </li>
					<?php
						if($feehead){
							foreach($feehead as $key => $value){
								$i = $key +1;
								?>
									<input type='hidden' name='fee[<?php echo $i; ?>]' value='<?php echo $fee_amount['amt_feehead'.$i]; ?>'>
								<?php
									if($value->HType == 'DUES' || $value->HType == 'Dues')
									{
										if($total_previous_dues > 0){
											?>
											<li class="list-group-item">
											<b><?php echo $value->FEE_HEAD; ?></b> <a class="pull-right"><?php echo $total_previous_dues; ?></a>
											</li>
											<?php
										}
									}
									else{
										$head_type = $fee_amount['amt_feehead'.$i];
										if($head_type > 0){
											?>
												<li class="list-group-item">
										<b><?php echo $value->FEE_HEAD; ?></b> <a class="pull-right"><?php echo $head_type; ?></a>
										</li>
											<?php
										}
									}
							}
						}
					?>
					<li class="list-group-item">
						<b>GRAND TOTAL</b> <a class="pull-right"><?php echo $total_amount; ?></a>
					</li>
					<li class="list-group-item">
						<b>PAYMENT FOR MONTH</b> <a class="pull-right"><?php echo $ffml; ?></a>
					</li>
					<li class="list-group-item">
						<center><a href="#" class='btn btn-success btn-sm'>Pay Fee</a>&nbsp;<a class='btn btn-success btn-sm' href='<?php echo base_url('Parent_details/pay_details'); ?>'>GO BACK</a></center>
					</li>
				</ul>
				<input type="hidden" name='total_amount' value='<?php echo $total_amount; ?>'>
				<input type="hidden" name='adm_no' value='<?php echo $stu_adm; ?>'>
				<input type="hidden" class="merchant_id" value="STCR">
				<input type='hidden' value="<?php echo $apr; ?>" name='apr'>
				<input type='hidden' value="<?php echo $may; ?>" name='may'>
				<input type='hidden' value="<?php echo $jun; ?>" name='jun'>
				<input type='hidden' value="<?php echo $jul; ?>" name='jul'>
				<input type='hidden' value="<?php echo $aug; ?>" name='aug'>
				<input type='hidden' value="<?php echo $sep; ?>" name='sep'>
				<input type='hidden' value="<?php echo $oct; ?>" name='oct'>
				<input type='hidden' value="<?php echo $nov; ?>" name='nov'>
				<input type='hidden' value="<?php echo $dec; ?>" name='dec'>
				<input type='hidden' value="<?php echo $jan; ?>" name='jan'>
				<input type='hidden' value="<?php echo $feb; ?>" name='feb'>
				<input type='hidden' value="<?php echo $mar; ?>" name='mar'>
				<input type='hidden' value="<?php echo $recpt_no; ?>" name='rcpt_no'>
				<input type='hidden' value="<?php echo $ffm; ?>" name="ffm">
				<input type='hidden' value="<?php print_r(json_decode($sessiondata)); ?>" name="sessiondata">
			</form>
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

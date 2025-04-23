<?php
error_reporting(0);
	if($father_details)
	{
		$F_QUA = $father_details->ED_QUA;
		$F_OCCUPATION = $father_details->OCCUPATION;
		$F_DESIG = $father_details->DESIG;
		$F_MTH_INCOME = $father_details->MTH_INCOME;
		$F_MOBILE = $father_details->MOBILE;
		$F_EMAIL = $father_details->EMAIL;
		$F_ADDRESS = $father_details->ADDRESS;
		$F_CITY = $father_details->CITY;
		$F_STATE = $father_details->STATE;
		$F_PIN = $father_details->PIN;
		$F_NATION = $father_details->NATION;
	}
	if($student){
		$f_name = $student->FATHER_NM;
		$name = $student->FIRST_NM;
		$ADM_NO = $student->ADM_NO;
		$STUDENTID = $student->STUDENTID;
		$ADM_DATE = $student->ADM_DATE;
		$ROLL_NO = $student->ROLL_NO;
		$DISP_CLASS = $student->DISP_CLASS;
		$DISP_SEC = $student->DISP_SEC;
		$CORR_ADD = $student->CORR_ADD;
		$C_CITY = $student->C_CITY;
		$C_PIN = $student->C_PIN;
		$C_STATE = $student->C_STATE;
		$C_NATION = $student->C_NATION;
		$PERM_ADD = $student->PERM_ADD;
		$P_CITY = $student->P_CITY;
		$P_STATE = $student->P_STATE;
		$P_NATION = $student->P_NATION;
		$P_PIN = $student->P_PIN;
		$student_image = $student->student_image;
		$classec = $DISP_CLASS."/".$DISP_SEC;
		$date = date('d-m-y',strtotime($ADM_DATE));
	}
?>
<style>
	/*.box-header {
    color: #444;
	background-color:#3c8cbc;
    display: block;
    padding: 10px;
    position: relative;
	}*/
	
	.p_detils{
		font-size:17px !important;
	}
	.box.box-default {
    border-top-color: #3c8cbc;
}
}
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Profile</a></li>
        <li class="active">Deatils View</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Personal Details</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
			<div class='col-md-2 col-sm-2 col-lg-2'>
				<img class="img-thumbnail" src="<?php echo base_url(); ?>assets/admin_lte/dist/img/user2-160x160.jpg" style='height:120px; width:110px; margin-left:30px;'>
			</div>
			<div class='col-md-10 col-sm-10 col-lg-10'>
				<div class='row'>
					<div class='col-md-4 '>
					<label>Name:</label>
						<p class='p_detils'><?php echo $f_name; ?></p>
					</div>
					<div class='col-md-4'>
					<label>Designation:</label>
						<p class='p_detils'><?php echo $F_DESIG; ?></p>
					</div>
					<div class='col-md-4'>
					<label>Qualification:</label>
						<p class='p_detils'><?php echo $F_QUA; ?></p>
					</div>
				</div>
				<div class='row'>
					<div class='col-md-4 '>
					<label>Monthly Income:</label>
						<p class='p_detils'><?php echo $F_MTH_INCOME;  ?></p>
					</div>
					<div class='col-md-4'>
					<label>Mobile No:</label>
						<p class='p_detils'><?php echo $F_MOBILE; ?></p>
					</div>
					<div class='col-md-4'>
					<label>Email:</label>
						<p class='p_detils'><?php echo $F_EMAIL; ?></p>
					</div>
				</div>
			</div>
          </div>
		  <div class='row'>
			<div class='col-md-12'>
				<label>Address:</label>
				<p class='p_detils'><?php echo $F_ADDRESS; ?></p>
			</div>
		  </div>
		   <div class='row'>
		    <div class='col-md-3'>
				<label>City:</label>
				<p class='p_detils'><?php echo $F_CITY; ?></p>
			</div>
			<div class='col-md-3'>
				<label>Pin:</label>
				<p class='p_detils'><?php echo $F_PIN; ?></p>
			</div>
			<div class='col-md-3'>
				<label>State:</label>
				<p class='p_detils'><?php echo $F_STATE; ?></p>
			</div>
			<div class='col-md-3'>
				<label>Nation:</label>
				<p class='p_detils'><?php echo $F_NATION; ?></p>
			</div>
		  </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
	  
	   <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Student Details</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
			<div class='col-md-2 col-sm-2 col-lg-2'>
				<img class="img-thumbnail" src='<?php 
				if($student_image == null){
					echo base_url('assets/student_photo/default.jpg');
				}else{
					echo base_url($student_image);
				}
				?>' style='height:130px; width:110px; margin-left:30px;'>
			</div>
			<div class='col-md-10 col-sm-10 col-lg-10'>
				<div class='row'>
					<div class='col-md-4 '>
					<label>Name:</label>
						<p class='p_detils'><?php echo $name; ?></p>
					</div>
					<div class='col-md-4'>
					<label>Admission No:</label>
						<p class='p_detils'><?php echo $ADM_NO; ?></p>
					</div>
					<div class='col-md-4'>
					<label>Student Id:</label>
						<p class='p_detils'><?php echo $STUDENTID; ?></p>
					</div>
				</div>
				<div class='row'>
					<div class='col-md-4 '>
					<label>Admission Date:</label>
						<p class='p_detils'><?php echo $date; ?></p>
					</div>
					<div class='col-md-4'>
					<label>Roll No:</label>
						<p class='p_detils'><?php echo $ROLL_NO; ?></p>
					</div>
					<div class='col-md-4'>
					<label>Class/Sec:</label>
						<p class='p_detils'><?php echo $classec; ?></p>
					</div>
				</div>
			</div>
          </div>
		  <h3>Present Address:</h3>
		  <div class='row'>
			<div class='col-md-12'>
				<label>Address:</label>
				<p class='p_detils'><?php echo $CORR_ADD; ?></p>
			</div>
		  </div>
		   <div class='row'>
			<div class='col-md-3'>
				<label>Pin:</label>
				<p class='p_detils'><?php echo $C_PIN; ?></p>
			</div>
			<div class='col-md-3'>
				<label>City:</label>
				<p class='p_detils'><?php echo $C_CITY; ?></p>
			</div>
			<div class='col-md-3'>
				<label>State:</label>
				<p class='p_detils'><?php echo $C_STATE; ?></p>
			</div>
			<div class='col-md-3'>
				<label>Nation:</label>
				<p class='p_detils'><?php echo $C_NATION; ?></p>
			</div>
		  </div>
		  <h3>Permanent Address:</h3>
		  <div class='row'>
			<div class='col-md-12'>
				<label>Address:</label>
				<p class='p_detils'><?php echo $PERM_ADD; ?></p>
			</div>
		  </div>
		   <div class='row'>
			<div class='col-md-3'>
				<label>Pin:</label>
				<p class='p_detils'><?php echo $P_PIN; ?></p>
			</div>
			<div class='col-md-3'>
				<label>City:</label>
				<p class='p_detils'><?php echo $P_CITY; ?></p>
			</div>
			<div class='col-md-3'>
				<label>State:</label>
				<p class='p_detils'><?php echo $P_STATE; ?></p>
			</div>
			<div class='col-md-3'>
				<label>Nation:</label>
				<p class='p_detils'><?php echo $P_NATION; ?></p>
			</div>
		  </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
	  </div>
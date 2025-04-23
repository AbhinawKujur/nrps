  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
		<?php
			if(generate_session['role'] == 'ADMIN'){
		?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $three_adm_data[0]['tot_reg_stu']; ?></h3>

                <p>Total Registered Students</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php echo base_url('adm_three/Stu_list/index'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!--small box--> 
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $verified_stu[0]['tot_verified_stu']; ?></h3>
                <p>Verified Students</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php echo base_url('adm_three/reports/Verified_list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
		  
		  <!-- ./col -->
         <!--<div class="col-lg-3 col-6">
            <!-- small box 
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php //echo $success_trns[0]['tot_success_trans']; ?></h3>
                <p>Successful Transaction</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php //echo base_url('adm_three/reports/SuccessTransReport'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>-->
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $trns_faield[0]['tot_trns_faield']; ?></h3>
                <p>Failed Transaction</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php echo base_url('adm_three/reports/FailedTransReport'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
		  
		  <div class="col-lg-3 col-6">
            <!--small box--> 
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $not_attempted[0]['not_attemp']; ?></h3>
                <p>Not attempted for payment</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php echo base_url('adm_three/reports/NotAttempted'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
		  
		  <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $rejected_list[0]['tot_rejected_stu']; ?></h3>
                <p>Rejected List</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php echo base_url('adm_three/reports/RejectedReport'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
		<?php } else { ?> 
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="<?php if(generate_session['verified_status'] == 1){ echo "small-box bg-success"; }else{ echo "small-box bg-danger"; } ?>">
              <div class="inner">
                <h3>STATUS</h3>
				<?php
					if(generate_session['verified_status'] == 1){
				?>
                <p>VERIFIED</p>
				<?php } else{ ?>
				<p>NOT VERIFIED</p>
				<?php } ?>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php echo base_url('adm_three/Stu_list/viewOwnData'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
		<?php } ?>
          
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">
		  <!-- starting codeing here -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <script>	
	$("#dashboard_menu").addClass('active');
  </script>
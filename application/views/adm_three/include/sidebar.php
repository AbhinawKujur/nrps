<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
		<?php
			if(generate_session['role'] == 'ADMIN'){
		?>
          <img src="<?php echo base_url(); ?>assets2/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
		<?php } else{ ?>
		  <img src="<?php echo base_url(generate_session['img']); ?>" class="img-circle elevation-2" alt="User Image" style='width:40px; height:40px;'> 	
		<?php } ?>	
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo strtoupper (generate_session['name']); ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo base_url('adm_three/Admin/dashboard'); ?>" class="nav-link" id='dashboard_menu'>
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
		  <?php
			if(generate_session['role'] == 'ADMIN'){
		  ?>
          <li class="nav-item">
            <a href="<?php echo base_url('adm_three/Stu_list/index'); ?>" class="nav-link" id='stulist_menu'>
              <i class="nav-icon fas fa-th"></i>
              <p>
                Student List
              </p>
            </a>
          </li>
		  <li class="nav-item">
            <a href="<?php echo base_url('adm_three/reports/FailedTransReport'); ?>" class="nav-link" id='failed_menu'>
              <i class="nav-icon fas fa-th"></i>
              <p>
                Trans. failed list
              </p>
            </a>
          </li>
		  <li class="nav-item">
            <a href="<?php echo base_url('adm_three/reports/NotAttempted'); ?>" class="nav-link" id='notAttempted_menu'>
              <i class="nav-icon fas fa-th"></i>
              <p>
                Not Attempted list
              </p>
            </a>
          </li>
		  
		  <li class="nav-item">
            <a href="<?php echo base_url('adm_three/MarksEntry'); ?>" class="nav-link" id='marks'>
              <i class="nav-icon fas fa-th"></i>
              <p>
                Marks Entry
              </p>
            </a>
          </li>
		  
		  <li class="nav-item">
            <a href="<?php echo base_url('adm_three/MarksEntry/verifyMarks'); ?>" class="nav-link" id='verifyMarks'>
              <i class="nav-icon fas fa-th"></i>
              <p>
                Verify Marks
              </p>
            </a>
          </li>
		  
		  <li class="nav-item">
            <a href="<?php echo base_url('adm_three/reports/Verified_list'); ?>" class="nav-link" id='verified_menu'>
              <i class="nav-icon fas fa-th"></i>
              <p>
                Verified List
              </p>
            </a>
          </li>
		  
		  <li class="nav-item">
            <a href="<?php echo base_url('adm_three/reports/RejectedReport'); ?>" class="nav-link" id='rejected_menu'>
              <i class="nav-icon fas fa-th"></i>
              <p>
                Rejected List
              </p>
            </a>
          </li>
		<?php } else { ?>
		<li class="nav-item">
			<a href="<?php echo base_url('adm_three/Stu_list/viewOwnData'); ?>" class="nav-link" id='my_form'>
			  <i class="nav-icon fas fa-rupee-sign"></i>
			  <p>
				Payment
			  </p>
			</a>
	    </li>
		<?php
			if(generate_session['verified_status'] == 1){
		?>
		<li class="nav-item">
			<a href="<?php echo base_url('adm_three/Stu_list/admitCard'); ?>" class="nav-link" id='updByUser_menu'>
			  <i class="nav-icon fas fa-download"></i>
			  <p>
				Admit Card
			  </p>
			</a>
	    </li>
		<?php } ?>
		<?php } ?>
          
          <!--<li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Charts
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/charts/chartjs.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ChartJS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/flot.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Flot</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/inline.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inline</p>
                </a>
              </li>
            </ul>
          </li>-->
		  
		  <li class="nav-item">
            <a href="<?php echo base_url('adm_three/Admin/logout'); ?>" class="nav-link">
             <i class="fas fa-power-off nav-icon"></i> 
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
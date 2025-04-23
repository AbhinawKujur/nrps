<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(); ?>assets/admin_lte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('student_name'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN MENU</li>
        <li>
          <a href="<?php echo base_url('Parentlogin/parent_dashboard/'); ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <!--<i class="fa fa-angle-left pull-right"></i>-->
            </span>
          </a>
		  </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Student Details</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('Parent_details/student_profile'); ?>"><i class="fa fa-circle-o"></i> Student Profile</a></li>
			 <li><a href="<?php echo base_url('Parent_details/stu_attendance'); ?>"><i class="fa fa-circle-o"></i>Attendance</a></li>
          </ul>
        </li>
	 <!--<li id='payment_details'><a href="<?php  //echo base_url('Onparent_details/pay_details'); ?>"><i class="fa fa-circle-o"></i>Pay Fees</a></li>-->
        <!--<li>
          <a href="<?php //echo base_url('parent_dashboard/noticelist'); ?>">
            <i class="fa fa-bullhorn"></i> <span>Notice</span>
          </a>
        </li>-->
		
		  
<!--		
 <li>
          <a href="<?php echo base_url('parent_dashboard/homeworklist'); ?>">
            <i class="fa fa-clipboard"></i> <span>Homework</span>
          </a>
        </li> --!>

		  <li>
        <a href="<?php echo base_url('parent_dashboard/StudyTopiclist'); ?>">
          <i class="fa fa-book"></i> <span>e-Learning</span>
        </a>
      </li>


      <li>
        <a href="<?php echo base_url('parent_dashboard/e_exam/homework/homework'); ?>">
          <i class="fa fa-clipboard"></i> <span>e-Homework</span>
        </a>
      </li>

<!--<li class="treeview" id='fee_summary'>
          <a href="#">
            <i class="fa fa-envelope-o"></i> <span>SMS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id='payment_details'><a href="<?php //echo base_url('parent_dashboard/sms/ComposeMessage'); ?>"><i class="fa fa-circle-o"></i>Compose Message</a></li>
            <li id='payment_details'><a href="<?php //echo base_url(); ?>"><i class="fa fa-circle-o"></i>Inbox</a></li>
			 <li id='payment_details'><a href="<?php// echo base_url(); ?>"><i class="fa fa-circle-o"></i>Sent Message</a></li>
          </ul> 
        </li>-->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

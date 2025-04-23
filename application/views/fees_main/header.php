<!DOCTYPE HTML>
<html>
<head>
<title>Dashboard<?php echo $this->session->userdata('userlevel'); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="<?php echo base_url(); ?>assets/dash_css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="<?php echo base_url(); ?>assets/dash_css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dash_css/morris.css" type="text/css"/>
<!-- Graph CSS -->
<link href="<?php echo base_url(); ?>assets/dash_css/font-awesome.css" rel="stylesheet">
<!--toster cdn css-->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/toster/build/toastr.css">

<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/dash_js/jquery-2.1.4.min.js"></script>
<!-- //jQuery -->
<!-- toster cdn java script-->
<script src="<?php echo base_url(); ?>assets/toster/build/toastr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/toster/toastr.js"></script>
<!-- toster cdn java script end-->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dash_css/icon-font.min.css" type='text/css' />
<link href='https://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet' type='text/css'>
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css'>
<!-- //lined-icons -->
<style>
	#class_table th{
		background-color: #5785c3;
		color: white;
	}
	#class_table tr td{
		color: black;
	}
	#example th{
		background-color: #5785c3;
		color: white;
	}
	#example tr td{
		color: black;
	}
	 #form ul li a
        {
            background-color: #5785c3;
            color: white;
            font-size: 15px;
            text-align: center;
            padding-left: 7px;
            font-weight: 10px;
            margin-left: 0px;
        }
       #row
       {
        margin:0px auto;
        position: relative;
       }
       .span{
       	color: red;
       }
</style>
</head> 
<body>
	
   <div class="page-container">
   <!--/content-inner-->
<div class="left-content">
	   <div class="mother-grid-inner">
             <!--header start here-->
				<div class="header-main">
					<div class="logo-w3-agile">
					    <h1 style="font-size: 16px;font-weight: bold;"><a href="<?php echo base_url(); ?>"><?php echo role_details['NAME'].' Dashboard ('. schoolData['short_nm'].' '.schoolData['School_Session'].')'; ?></a></h1>
					</div>
						<div class="profile_details w3l" style="float: right;">	
							<ul>
								<li class="dropdown profile_details_drop">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<div class="profile_img">	
											<?php if(login_details['user_image'] == ''){ ?>
												<span class="prfil-img"><img src="<?php echo base_url(); ?>assets/dash_images/in4.png" alt=""> </span> 
											<?php } else { ?>
												<span class="prfil-img"><img src="<?php echo base_url(login_details['user_image']); ?>" alt=""> </span> 
											<?php } ?>
												<div class="user-name">
													<p style="line-height:40px;">
													  <?php echo $this->session->userdata('emp_name'); ?>
													</p>
												</div>
												<i class="fa fa-angle-down"></i>
												<i class="fa fa-angle-up"></i>
												<div class="clearfix"></div>	
											</div>	
									</a>
									<ul class="dropdown-menu drp-mnu">
										<li> <a href="#" onclick="changePassword('<?php echo $this->session->userdata('user_id'); ?>')"><i class="fa fa-key"></i> Change Password</a> </li> 
										<li> <a href="<?php echo base_url('payroll/dashboard/dashboard/profile'); ?>"><i class="fa fa-user"></i> Profile</a> </li> 
										<li> <a href="<?php echo base_url('Login/logout'); ?>"><i class="fa fa-sign-out"></i> Logout</a> </li>
									</ul>
								</li>
							</ul>
						</div>
							
				     <div class="clearfix"> </div>	
				</div>
<!--heder end here-->
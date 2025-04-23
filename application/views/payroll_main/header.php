<!DOCTYPE HTML>
<html>
<head>
<title>Dashboard<?php echo $this->session->userdata('userlevel'); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="https://cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="<?php echo base_url(); ?>assets/dash_css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="<?php echo base_url(); ?>assets/dash_css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dash_css/morris.css" type="text/css"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dash_css/multiselect.css" type="text/css"/>
<!-- Graph CSS -->
<link href="<?php echo base_url(); ?>assets/dash_css/font-awesome.css" rel="stylesheet"> 

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.27/daterangepicker.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.9.1/fullcalendar.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/zabuto_calendar/1.3.0/zabuto_calendar.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
<!-- jQuery -->
<!-- <script src="<?php //echo base_url(); ?>assets/dash_js/jquery-2.1.4.min.js"></script> -->

<!-- //jQuery -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dash_css/icon-font.min.css" type='text/css' />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css"/>
<!-- //lined-icons -->
<link href='https://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/all.css">
<!--data table-->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.9.1/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.27/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/zabuto_calendar/1.3.0/zabuto_calendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/additional-methods.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dash_js/multiselect.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/css/myStyle.css" rel="stylesheet"> 
<link href="<?php echo base_url(); ?>assets/loader_plugin/waitMe.min.css" rel="stylesheet"> 
 <script src="<?php echo base_url(); ?>assets/loader_plugin/waitMe.min.js" type="text/javascript">  </script>
	<script src="<?php echo base_url(); ?>assets/dash_js/table2excel.js" type="text/javascript">  </script>
<!--//data table-->
<style>
	#class_table th{
		background-color: #e74c3c;
		color: white;
	}
	#class_table tr td{
		color: black;
	}
	body{
		font-family: 'verdana' !important;
	}
	.dataTables_wrapper .dataTables_info {
	    font-size: 11px;
	}
	.dataTables_wrapper .dataTables_paginate .paginate_button {
	    padding: none;
	}
	
	/*.table-striped > tbody > tr:nth-of-type(odd) {
	  background-color: #ebf6fa;
	}*/
	/*.table-striped > tbody > tr:nth-of-type(even) {
	  background-color: #ede88a;
	}*/
</style>
<script type="text/javascript">
	function showLoader()
	{
		$('#containerss').waitMe({
			effect : 'bounce',
			text : '',
			bg : "rgba(255,255,255,0.7)",
			color : "#000",
			maxSize : '',
			waitTime : -1,
			textPos : 'vertical',
			fontSize : '',
			source : '',
			});
	}
	// $(document).ready(function(){
	// 	showLoader();
	// });
</script>
</head> 
<body id="containerss">
   <div class="page-container">
   <!--/content-inner-->
<div class="left-content">
	   <div class="mother-grid-inner">
             <!--header start here-->
			<div class="header-main">
				<div class="row">
					<div class="col-sm-6 logo-w3-agile">
					    <h1 style="font-size: 16px;font-weight: bold;"><a href="<?php echo base_url(); ?>"><?php echo schoolData['short_nm'].' <br />('. schoolData['School_Session'].')'; ?></a></h1>
					</div>	
					
					<div class="col-sm-6 profile_details w3l pull-right">		
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
				</div>
				<div class="clearfix"> </div>	
			</div>
<!--heder end here-->
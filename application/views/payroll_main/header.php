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
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- Google Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
    <link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!-- lined-icons -->
    <link href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dash_css/icon-font.min.css" type='text/css' />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css"/>
    <!-- Additional Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/all.css">
    <!-- DataTable and Other Scripts -->
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
    <script src="<?php echo base_url(); ?>assets/loader_plugin/waitMe.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/dash_js/table2excel.js" type="text/javascript"></script>
    <!-- Custom CSS for Header -->
    <link href="<?php echo base_url(); ?>assets/css/custom_dashboard.css" rel="stylesheet">
    <script type="text/javascript">
        function showLoader() {
            $('#containerss').waitMe({
                effect: 'bounce',
                text: '',
                bg: "rgba(255,255,255,0.7)",
                color: "#000",
                maxSize: '',
                waitTime: -1,
                textPos: 'vertical',
                fontSize: '',
                source: ''
            });
        }
    </script>
	<style>
		/* School Pill Container */
.logo-w3-agile {
    display: flex;
    align-items: center;
}

.school-pill {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    color: black;
    padding: 15px 10px;
    border-radius: 10px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    width: 500px;
    height: 60px;
    text-align: center;
}

.school-pill:hover {
    transform: translateY(-3px);
    background: #3498db;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.school-pill a {
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.school-name {
    font-size: 14px;
    font-weight: 700;
}

.school-session {
    font-size: 11px;
    font-weight: 400;
}

.school-pill::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: 0.5s;
}

.school-pill:hover::before {
    left: 100%;
}

/* User Profile Section */
.profile_details.w3l {
    display: flex;
    align-items: center;
}

.user-profile {
    display: flex;
    align-items: center;
    gap: 10px;
}

.user-name {
    font-size: 18px;
    font-weight: 500;
    color: #333;
}

.user-action {
    color: #666;
    font-size: 24px;
	padding: 10px;
	border-radius: 30%;
    transition: color 0.3s ease;
}

.user-action:hover {
    color: #3498db;
}

.prfil-img {
    display: inline-block;
}

.prfil-img img {
    width: 70px;
    height: 70px;
	border-radius: 50%;
    object-fit: cover;
	box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    border: 2px solid #3498db;
    transition: transform 0.3s ease;
}

.prfil-img img:hover {
    transform: scale(1.1);
}

/* Ensure Bootstrap compatibility */
.clearfix {
    clear: both;
}
	</style>
</head> 
<body id="containerss">
    <div class="page-container">
        <!--/content-inner-->
        <div class="left-content">
            <div class="mother-grid-inner">
                <!-- Header Start -->
                <div class="header-main">
                    <div class="logo-w3-agile">
                        <div class="school-pill">
                            <a href="<?php echo base_url(); ?>">
                                <span class="school-name"><?php echo schoolData['short_nm']; ?></span>
                                <span class="school-session"><?php echo schoolData['School_Session']; ?></span>
                            </a>
                        </div>
                    </div>
                    <div class="profile_details w3l pull-right">
                        <div class="user-profile">
                            
                            <a href="#" onclick="changePassword('<?php echo $this->session->userdata('user_id'); ?>')" class="user-action">
                                <i class="fa fa-key"></i>
                            </a>
                            <a href="<?php echo base_url('Login/logout'); ?>" class="user-action">
                                <i class="fa fa-sign-out"></i>
                            </a>
							<span class="user-name"><?php echo $this->session->userdata('emp_name'); ?></span>
                            <a href="<?php echo base_url('payroll/dashboard/dashboard/profile'); ?>" class="prfil-img">
                                <?php if(login_details['user_image'] == ''){ ?>
                                    <img src="<?php echo base_url(); ?>assets/dash_images/in4.png" alt="Profile">
                                <?php } else { ?>
                                    <img src="<?php echo base_url(login_details['user_image']); ?>" alt="Profile">
                                <?php } ?>
                            </a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- Header End -->
            </div>
        </div>
    </div>
</body>
</html>